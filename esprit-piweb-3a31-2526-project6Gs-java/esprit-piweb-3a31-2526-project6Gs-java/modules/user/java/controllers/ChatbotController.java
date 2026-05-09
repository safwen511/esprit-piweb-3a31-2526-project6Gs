package controllers;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.scene.text.TextFlow;
import services.AnthropicChatService;

import java.util.concurrent.CompletableFuture;

public class ChatbotController {

    @FXML private VBox messagesContainer;
    @FXML private TextField messageField;
    @FXML private Button sendButton;
    @FXML private ScrollPane scrollPane;

    private final AnthropicChatService chatService = new AnthropicChatService();
    private Label typingLabel;

    @FXML
    public void initialize() {
        addBotMessage("Bonjour. Je suis votre assistant medical et veterinaire. " +
                "Posez vos questions sur les vaccins, symptomes et soins.");
    }

    @FXML
    private void onSendMessage() {
        String text = messageField.getText().trim();
        if (text.isEmpty()) {
            return;
        }
        sendMessage(text);
    }

    @FXML
    private void onSuggestionVaccin() {
        sendMessage("Quels sont les vaccins obligatoires pour un enfant et a quel age ?");
    }

    @FXML
    private void onSuggestionAnimal() {
        sendMessage("Quels vaccins faut-il pour un chien et a quelle frequence ?");
    }

    @FXML
    private void onSuggestionSymptomes() {
        sendMessage("Quels sont les symptomes de la grippe et quand consulter ?");
    }

    private void sendMessage(String text) {
        messageField.clear();
        sendButton.setDisable(true);
        addUserMessage(text);
        addTypingIndicator();

        CompletableFuture.runAsync(() -> {
            try {
                String response = chatService.sendMessage(text);
                Platform.runLater(() -> {
                    removeTypingIndicator();
                    addBotMessage(response);
                    sendButton.setDisable(false);
                    scrollToBottom();
                });
            } catch (Exception e) {
                Platform.runLater(() -> {
                    removeTypingIndicator();
                    addBotMessage("Erreur: " + e.getMessage());
                    sendButton.setDisable(false);
                    scrollToBottom();
                });
            }
        });
    }

    private void addUserMessage(String text) {
        messagesContainer.getChildren().add(createBubble(text, true));
        scrollToBottom();
    }

    private void addBotMessage(String text) {
        messagesContainer.getChildren().add(createBubble(text, false));
        scrollToBottom();
    }

    private HBox createBubble(String text, boolean isUser) {
        Text msgText = new Text(text);
        msgText.setWrappingWidth(380);
        msgText.setStyle(isUser ? "-fx-fill: white;" : "-fx-fill: #2c3e50;");

        TextFlow flow = new TextFlow(msgText);
        flow.setPadding(new Insets(10, 14, 10, 14));
        flow.setMaxWidth(420);
        flow.setStyle(isUser
                ? "-fx-background-color: #3498db; -fx-background-radius: 18 18 4 18;"
                : "-fx-background-color: white; -fx-background-radius: 18 18 18 4;" +
                "-fx-effect: dropshadow(gaussian,rgba(0,0,0,0.08),6,0,0,2);");

        HBox box = new HBox(flow);
        box.setAlignment(isUser ? Pos.CENTER_RIGHT : Pos.CENTER_LEFT);
        box.setPadding(new Insets(3, 8, 3, 8));
        return box;
    }

    private void addTypingIndicator() {
        typingLabel = new Label("En cours de redaction...");
        typingLabel.setStyle("-fx-text-fill: #999; -fx-font-style: italic; -fx-font-size: 12px;");
        messagesContainer.getChildren().add(typingLabel);
        scrollToBottom();
    }

    private void removeTypingIndicator() {
        if (typingLabel != null) {
            messagesContainer.getChildren().remove(typingLabel);
        }
    }

    private void scrollToBottom() {
        Platform.runLater(() -> scrollPane.setVvalue(1.0));
    }
}
