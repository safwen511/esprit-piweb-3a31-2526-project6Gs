package com.esprit.animal.controllers;

import com.esprit.animal.Services.adoptionservices;
import com.esprit.animal.entities.adoptionRequest;
import com.esprit.animal.utils.StageSceneHelper;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.stage.Stage;

public class requestdetails extends BaseUIController {
    @FXML
    private Label animalidlabel;

    @FXML
    private Label clientidlabel;

    @FXML
    private Label messagelabel;

    @FXML
    private Label phonelabel;

    @FXML
    private Label addresslabel;

    @FXML
    private Label statusLabel;

    private adoptionRequest requestSelected;
    private ListView<adoptionRequest> listView;

    @Override
    protected String getViewPath() {
        return "/animal/RequestDetails.fxml";
    }

    @Override
    protected String getBackViewPath() {
        return "/animal/AfficherRequest.fxml";
    }

    public void setRequest(adoptionRequest request) {
        this.requestSelected = request;

        animalidlabel.setText(String.valueOf(request.getAnimal_id()));
        clientidlabel.setText(String.valueOf(request.getClientCompteId()));
        messagelabel.setText(request.getMessage());
        phonelabel.setText(request.getPhone());
        addresslabel.setText(request.getAddress());
        statusLabel.setText(request.getStatus().toString());
    }

    @FXML
    void handlemodifier(ActionEvent event) {
        try {
            if (requestSelected == null) {
                Alert alert = new Alert(Alert.AlertType.WARNING);
                alert.setTitle("No selection");
                alert.setHeaderText("Error");
                alert.setContentText("No request selected for update.");
                alert.showAndWait();
                return;
            }

            FXMLLoader loader = createLoader("/animal/RequestUpdate.fxml");
            Parent root = loader.load();

            requestupdate controller = loader.getController();
            controller.setRequest(requestSelected);
            controller.setListView(listView);

            Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
            StageSceneHelper.setScene(stage, root);
            stage.setTitle("Update request");
            stage.setMaximized(true);
            stage.show();

        } catch (Exception e) {
            e.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setHeaderText("Cannot open update form");
            alert.setContentText(e.getMessage());
            alert.showAndWait();
        }
    }

    @FXML
    void handlesupprimer(ActionEvent event) {
        try {
            if (requestSelected == null) {
                Alert alert = new Alert(Alert.AlertType.WARNING);
                alert.setTitle("No selection");
                alert.setHeaderText("Error");
                alert.setContentText("No request selected for delete.");
                alert.showAndWait();
                return;
            }

            adoptionservices service = new adoptionservices();
            service.supprimer(requestSelected.getId());

            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Deleted");
            alert.setHeaderText("Request deleted");
            alert.setContentText("The request was deleted successfully.");
            alert.showAndWait();

            FXMLLoader loader = createLoader("/animal/AfficherRequest.fxml");
            Parent root = loader.load();

            AfficherRequest controller = loader.getController();
            controller.removeDemandeFromList(requestSelected);

            Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
            StageSceneHelper.setScene(stage, root);
            stage.setMaximized(true);
            stage.show();

        } catch (Exception e) {
            e.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setHeaderText("Cannot delete request");
            alert.setContentText(e.getMessage());
            alert.showAndWait();
        }
    }
}
