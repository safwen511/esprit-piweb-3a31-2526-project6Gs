package com.esprit.animal.Services;

import org.json.JSONObject;

import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;

public class AdoptionPublicApiService {

    private static final String DOG_RANDOM_IMAGE_URL = "https://dog.ceo/api/breeds/image/random";
    private static final String FOX_RANDOM_IMAGE_URL = "https://randomfox.ca/floof/";
    private static final String CAT_FACT_URL = "https://catfact.ninja/fact";

    private static final Duration REQUEST_TIMEOUT = Duration.ofSeconds(8);

    private final HttpClient httpClient = HttpClient.newBuilder()
            .connectTimeout(REQUEST_TIMEOUT)
            .build();

    public ApiSnapshot fetchSnapshot() {
        String dogImageUrl = safeFetch(this::fetchDogImageUrl);
        String foxImageUrl = safeFetch(this::fetchFoxImageUrl);
        String catFact = safeFetch(this::fetchCatFact);

        return new ApiSnapshot(dogImageUrl, foxImageUrl, catFact);
    }

    private String fetchDogImageUrl() throws IOException, InterruptedException {
        JSONObject json = requestJson(DOG_RANDOM_IMAGE_URL);
        String status = json.optString("status", "");
        if (!"success".equalsIgnoreCase(status)) {
            throw new IOException("Dog API returned non-success status");
        }
        String imageUrl = json.optString("message", "").trim();
        validateHttpUrl(imageUrl);
        return imageUrl;
    }

    private String fetchFoxImageUrl() throws IOException, InterruptedException {
        JSONObject json = requestJson(FOX_RANDOM_IMAGE_URL);
        String imageUrl = json.optString("image", "").trim();
        validateHttpUrl(imageUrl);
        return imageUrl;
    }

    private String fetchCatFact() throws IOException, InterruptedException {
        JSONObject json = requestJson(CAT_FACT_URL);
        String fact = json.optString("fact", "").trim();
        if (fact.isEmpty()) {
            throw new IOException("Cat fact was empty");
        }
        return fact;
    }

    private JSONObject requestJson(String url) throws IOException, InterruptedException {
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .timeout(REQUEST_TIMEOUT)
                .header("Accept", "application/json")
                .header("User-Agent", "FurHope-Adoption/1.0")
                .GET()
                .build();

        HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
        int statusCode = response.statusCode();
        if (statusCode < 200 || statusCode >= 300) {
            throw new IOException("HTTP " + statusCode + " from " + url);
        }
        return new JSONObject(response.body());
    }

    private String safeFetch(ThrowingSupplier supplier) {
        try {
            return supplier.get();
        } catch (Exception ignored) {
            return null;
        }
    }

    private void validateHttpUrl(String url) throws IOException {
        if (url == null || url.isBlank() || !(url.startsWith("http://") || url.startsWith("https://"))) {
            throw new IOException("Invalid URL payload");
        }
    }

    @FunctionalInterface
    private interface ThrowingSupplier {
        String get() throws Exception;
    }

    public static class ApiSnapshot {
        private final String dogImageUrl;
        private final String foxImageUrl;
        private final String catFact;

        public ApiSnapshot(String dogImageUrl, String foxImageUrl, String catFact) {
            this.dogImageUrl = dogImageUrl;
            this.foxImageUrl = foxImageUrl;
            this.catFact = catFact;
        }

        public String getDogImageUrl() {
            return dogImageUrl;
        }

        public String getFoxImageUrl() {
            return foxImageUrl;
        }

        public String getCatFact() {
            return catFact;
        }

        public boolean isComplete() {
            return dogImageUrl != null && foxImageUrl != null && catFact != null;
        }
    }
}
