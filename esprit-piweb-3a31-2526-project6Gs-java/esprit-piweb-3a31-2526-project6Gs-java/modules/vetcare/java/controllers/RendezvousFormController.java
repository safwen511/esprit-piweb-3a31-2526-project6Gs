package controllers;

import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import model.Disponibilite;
import model.Rendezvous;
import services.EmailService;
import services.ServiceDisponibilite;
import services.ServiceRendezvous;
import utils.MyDatabase;
import utils.SessionManager;
import utils.ViewNavigator;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.CompletableFuture;

public class RendezvousFormController {

    @FXML private Label titleLabel;
    @FXML private Label vetLabel;
    @FXML private Label errorLabel;
    @FXML private ComboBox<String> disponibiliteBox;
    @FXML private TextField animalNomField;
    @FXML private ComboBox<String> animalTypeBox;
    @FXML private TextArea descriptionArea;
    @FXML private Button saveButton;
    @FXML private TextField numField;

    private final ServiceDisponibilite serviceDispo = new ServiceDisponibilite();
    private final ServiceRendezvous serviceRdv = new ServiceRendezvous();
    private final EmailService emailService = new EmailService();

    private final Map<String, Integer> disponibiliteIds = new HashMap<>();
    private final Map<String, String> slotStartTimes = new HashMap<>();

    @FXML
    public void initialize() {
        vetLabel.setText("Veterinaire : " + SessionManager.getSelectedVetNom());
        animalTypeBox.setItems(FXCollections.observableArrayList(
                "Chien", "Chat", "Oiseau", "Hamster", "Lapin", "Reptile", "Autre"
        ));
        loadDisponibilites();
        prefillPhone();
    }

    private void loadDisponibilites() {
        try {
            int vetId = SessionManager.getSelectedVetId();
            List<Disponibilite> dispos = serviceDispo.readByVetId(vetId);
            List<String> takenSlots = serviceRdv.getTakenSlots(vetId);

            for (Disponibilite d : dispos) {
                if (d.getStatut() != Disponibilite.Statut.VALABLE || d.getStarttime() == null || d.getEndtime() == null) {
                    continue;
                }

                LocalDateTime start = d.getStarttime();
                LocalDateTime end = d.getEndtime();

                while (!start.plusHours(1).isAfter(end)) {
                    LocalDateTime slotEnd = start.plusHours(1);
                    String slotStart = String.format(
                            "%s %s",
                            start.toLocalDate(),
                            start.toLocalTime().toString().substring(0, 5)
                    );

                    if (!takenSlots.contains(slotStart)) {
                        String label = String.format(
                                "%s %s -> %s",
                                start.toLocalDate(),
                                start.toLocalTime().toString().substring(0, 5),
                                slotEnd.toLocalTime().toString().substring(0, 5)
                        );
                        disponibiliteBox.getItems().add(label);
                        disponibiliteIds.put(label, d.getId_disponibilite());
                        slotStartTimes.put(label, slotStart);
                    }

                    start = slotEnd;
                }
            }

            if (disponibiliteBox.getItems().isEmpty()) {
                disponibiliteBox.setPromptText("Aucun creneau disponible");
                disponibiliteBox.setDisable(true);
            }

        } catch (Exception e) {
            errorLabel.setText("Erreur disponibilites : " + e.getMessage());
        }
    }

    private void prefillPhone() {
        String sql = "SELECT COALESCE(phone, phone_number) AS phone FROM user WHERE id = ?";
        try (Connection conn = MyDatabase.getInstance().getConnectionOrThrow();
             PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, SessionManager.getUserId());
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    String phone = rs.getString("phone");
                    if (phone != null && !phone.isBlank()) {
                        numField.setText(phone);
                    }
                }
            }
        } catch (Exception ignored) {
        }
    }

    @FXML
    private void onSave(ActionEvent event) {
        errorLabel.setText("");

        if (disponibiliteBox.getValue() == null) {
            errorLabel.setText("Choisissez un creneau.");
            return;
        }
        if (animalNomField.getText().trim().isEmpty()) {
            errorLabel.setText("Entrez le nom de votre animal.");
            return;
        }
        if (animalTypeBox.getValue() == null) {
            errorLabel.setText("Choisissez le type d'animal.");
            return;
        }
        if (numField.getText().trim().isEmpty()) {
            errorLabel.setText("Entrez votre numero de telephone.");
            return;
        }
        if (descriptionArea.getText().trim().isEmpty()) {
            errorLabel.setText("Ajoutez une description.");
            return;
        }

        try {
            int dispoId = disponibiliteIds.get(disponibiliteBox.getValue());
            int clientId = SessionManager.getUserId();
            int vetId = SessionManager.getSelectedVetId();

            String slotStart = slotStartTimes.get(disponibiliteBox.getValue());
            if (slotStart == null || slotStart.isBlank()) {
                errorLabel.setText("Creneau invalide.");
                return;
            }

            String normalizedPhone = normalizePhone(numField.getText());
            if (normalizedPhone.length() < 8) {
                errorLabel.setText("Numero de telephone invalide.");
                return;
            }

            if (serviceRdv.slotAlreadyTaken(vetId, dispoId, slotStart)) {
                errorLabel.setText("Ce creneau est deja reserve.");
                return;
            }

            String animalInfo = animalNomField.getText().trim() + " (" + animalTypeBox.getValue() + ")";

            Rendezvous rdv = new Rendezvous();
            rdv.setClient_id(clientId);
            rdv.setVet_id(vetId);
            rdv.setAnimal_id(0);
            rdv.setDisponibilite_id(dispoId);
            rdv.setSlotStart(slotStart);
            rdv.setStatus("pending");
            rdv.setDescription("[ANIMAL " + animalInfo + "] [SLOT " + slotStart + "] " + descriptionArea.getText().trim());
            rdv.setNum(parseDisplayPhoneAsInt(normalizedPhone));

            serviceRdv.updateClientPhone(clientId, normalizedPhone);
            serviceRdv.add(rdv);

            CompletableFuture.runAsync(() -> {
                try {
                    String vetEmail = serviceRdv.getVetEmail(vetId);
                    String vetNom = serviceRdv.getVetNom(vetId);
                    emailService.notifyVetNewRdv(vetEmail, vetNom, normalizedPhone, rdv.getDescription());
                } catch (Exception ignored) {
                }
            });

            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Succes");
            alert.setHeaderText(null);
            alert.setContentText("Votre rendez-vous a ete envoye. En attente de confirmation.");
            alert.showAndWait();

            ViewNavigator.goTo(event, "/DashboardClient.fxml", "Mon Espace");

        } catch (Exception e) {
            errorLabel.setText("Erreur : " + e.getMessage());
            e.printStackTrace();
        }
    }

    @FXML
    private void onRefreshDisponibilites(ActionEvent event) {
        disponibiliteBox.getItems().clear();
        disponibiliteIds.clear();
        slotStartTimes.clear();
        loadDisponibilites();
    }

    @FXML
    private void onGoHome(ActionEvent event) {
        ViewNavigator.goTo(event, "/ListeVeterinaires.fxml", "Nos Veterinaires");
    }

    private String normalizePhone(String value) {
        if (value == null) {
            return "";
        }
        return value.replaceAll("[^0-9]", "");
    }

    private int parseDisplayPhoneAsInt(String normalizedPhone) {
        if (normalizedPhone == null || normalizedPhone.isBlank()) {
            return 0;
        }
        try {
            String digits = normalizedPhone;
            if (digits.length() > 9) {
                digits = digits.substring(digits.length() - 9);
            }
            return Integer.parseInt(digits);
        } catch (NumberFormatException ex) {
            return 0;
        }
    }
}
