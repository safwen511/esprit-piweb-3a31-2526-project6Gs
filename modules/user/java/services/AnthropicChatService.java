package services;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import okhttp3.HttpUrl;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import utils.Config;

import java.io.IOException;
import java.util.concurrent.TimeUnit;

public class AnthropicChatService {

    private static final String DEFAULT_GROQ_URL = "https://api.groq.com/openai/v1/chat/completions";
    private static final String DEFAULT_GROQ_MODEL = "llama-3.1-8b-instant";
    private static final String PUBLIC_CHATBOT_URL = "https://text.pollinations.ai";

    private static final String SYSTEM_PROMPT =
            "Tu es un assistant medical et veterinaire. " +
            "Reponds en francais, de facon claire et concise. " +
            "Tu peux aider sur vaccins, symptomes, prevention, et premiers conseils. " +
            "Rappelle de consulter un medecin ou veterinaire pour un diagnostic officiel.";

    private final String apiKey;
    private final String apiUrl;
    private final String model;

    private final OkHttpClient httpClient = new OkHttpClient.Builder()
            .connectTimeout(30, TimeUnit.SECONDS)
            .readTimeout(30, TimeUnit.SECONDS)
            .writeTimeout(30, TimeUnit.SECONDS)
            .build();

    private final Gson gson = new Gson();

    public AnthropicChatService() {
        this.apiKey = firstNonBlank(
                System.getenv("GROQ_API_KEY"),
                System.getenv("GROQ_KEY"),
                Config.get("groq.api.key"),
                Config.get("GROQ_API_KEY"),
                Config.get("GROQ_KEY")
        );

        this.apiUrl = firstNonBlank(
                System.getenv("GROQ_URL"),
                Config.get("groq.api.url"),
                Config.get("GROQ_URL"),
                DEFAULT_GROQ_URL
        );

        this.model = firstNonBlank(
                System.getenv("GROQ_MODEL"),
                Config.get("groq.model"),
                Config.get("GROQ_MODEL"),
                DEFAULT_GROQ_MODEL
        );
    }

    public String sendMessage(String userMessage) throws IOException {
        String message = userMessage == null ? "" : userMessage.trim();
        if (message.isEmpty()) {
            return "Je n'ai pas recu de question.";
        }

        if (hasGroqConfig()) {
            try {
                return sendViaGroq(message);
            } catch (Exception ignored) {
                return sendViaPublicApi(message);
            }
        }

        return sendViaPublicApi(message);
    }

    private boolean hasGroqConfig() {
        return apiKey != null && !apiKey.isBlank() && apiUrl != null && !apiUrl.isBlank();
    }

    private String sendViaGroq(String userMessage) throws IOException {
        JsonArray messages = new JsonArray();

        JsonObject systemMsg = new JsonObject();
        systemMsg.addProperty("role", "system");
        systemMsg.addProperty("content", SYSTEM_PROMPT);
        messages.add(systemMsg);

        JsonObject userMsg = new JsonObject();
        userMsg.addProperty("role", "user");
        userMsg.addProperty("content", userMessage);
        messages.add(userMsg);

        JsonObject body = new JsonObject();
        body.addProperty("model", model);
        body.add("messages", messages);
        body.addProperty("max_tokens", 1024);
        body.addProperty("temperature", 0.6);

        RequestBody requestBody = RequestBody.create(
                gson.toJson(body),
                MediaType.get("application/json")
        );

        Request request = new Request.Builder()
                .url(apiUrl)
                .addHeader("Authorization", "Bearer " + apiKey)
                .addHeader("Content-Type", "application/json")
                .post(requestBody)
                .build();

        try (Response response = httpClient.newCall(request).execute()) {
            if (!response.isSuccessful()) {
                String errorBody = response.body() != null ? response.body().string() : "";
                throw new IOException("Groq error " + response.code() + ": " + errorBody);
            }

            String responseBody = response.body() != null ? response.body().string() : "";
            JsonObject json = gson.fromJson(responseBody, JsonObject.class);
            return json.getAsJsonArray("choices")
                    .get(0).getAsJsonObject()
                    .getAsJsonObject("message")
                    .get("content").getAsString();
        }
    }

    private String sendViaPublicApi(String userMessage) throws IOException {
        HttpUrl baseUrl = HttpUrl.parse(PUBLIC_CHATBOT_URL);
        if (baseUrl == null) {
            throw new IOException("Public chatbot URL is invalid");
        }

        String prompt = "SYSTEM: " + SYSTEM_PROMPT + "\nUSER: " + userMessage + "\nASSISTANT:";
        HttpUrl url = baseUrl.newBuilder()
                .addPathSegment(prompt)
                .addQueryParameter("model", "openai")
                .build();

        Request request = new Request.Builder()
                .url(url)
                .get()
                .build();

        try (Response response = httpClient.newCall(request).execute()) {
            if (!response.isSuccessful()) {
                throw new IOException("Public chatbot error " + response.code());
            }

            String content = response.body() != null ? response.body().string().trim() : "";
            if (content.isBlank()) {
                throw new IOException("Public chatbot returned an empty response");
            }
            return content;
        }
    }

    private String firstNonBlank(String... values) {
        if (values == null) {
            return null;
        }
        for (String value : values) {
            if (value != null && !value.isBlank()) {
                return value.trim();
            }
        }
        return null;
    }
}
