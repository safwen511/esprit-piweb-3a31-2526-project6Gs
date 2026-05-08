package com.esprit.animal.controllers;

import com.esprit.animal.Services.adoptionservices;
import com.esprit.animal.entities.adoptionRequest;
import com.esprit.animal.utils.StageSceneHelper;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.control.ListView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

public class requestupdate extends BaseUIController {

    @FXML
    private TextField animalidfield;
    @FXML
    private TextField clientidfield;

    @FXML
    private TextArea messagefield;

    @FXML
    private TextField phonefield;

    @FXML
    private TextField addressfield;

    @FXML
    private Button saveButton;

    @FXML
    private TextField statusField;

    private adoptionRequest requestSelected;
    private ListView<adoptionRequest> listView;

    @Override
    protected String getViewPath() {
        return "/animal/RequestUpdate.fxml";
    }

    @Override
    protected String getBackViewPath() {
        return "/animal/AfficherRequest.fxml";
    }

    public void setRequest(adoptionRequest request) {
        this.requestSelected = request;

        animalidfield.setText(String.valueOf(request.getAnimal_id()));
        clientidfield.setText(String.valueOf(request.getClientCompteId()));
        messagefield.setText(request.getMessage());
        phonefield.setText(request.getPhone());
        addressfield.setText(request.getAddress());
        statusField.setText(request.getStatus().toString());
    }

    public void setListView(ListView<adoptionRequest> listView) {
        this.listView = listView;
    }

    @FXML
    void handleSave(ActionEvent event) {
        try {
            requestSelected.setAnimal_id(Integer.parseInt(animalidfield.getText()));
            requestSelected.setClientCompteId(Integer.parseInt(clientidfield.getText()));
            requestSelected.setMessage(messagefield.getText());
            requestSelected.setPhone(phonefield.getText());
            requestSelected.setAddress(addressfield.getText());
            requestSelected.setStatus(com.esprit.animal.entities.adoptionRequest.status.valueOf(statusField.getText()));

            adoptionservices service = new adoptionservices();
            service.modifier(requestSelected);

            if (listView != null) {
                listView.refresh();
            }

            FXMLLoader loader = createLoader("/animal/AfficherRequest.fxml");
            Parent root = loader.load();

            Stage stage = (Stage) saveButton.getScene().getWindow();
            StageSceneHelper.setScene(stage, root);
            stage.setMaximized(true);
            stage.show();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
