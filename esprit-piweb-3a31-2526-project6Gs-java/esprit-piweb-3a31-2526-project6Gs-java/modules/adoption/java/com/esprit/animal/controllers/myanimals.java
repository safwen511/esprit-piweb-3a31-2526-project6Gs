package com.esprit.animal.controllers;

import com.esprit.animal.Services.animalServices;
import com.esprit.animal.entities.animal;
import com.esprit.animal.utils.StageSceneHelper;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

import java.util.List;

public class myanimals extends BaseUIController {

    @FXML
    private GridPane myanimalsGrid;

    private final animalServices service = new animalServices();

    @Override
    protected String getViewPath() {
        return "/animal/MyAnimals.fxml";
    }

    @FXML
    public void initialize() {
        loadAnimals();
    }

    private void loadAnimals() {
        try {
            myanimalsGrid.getChildren().clear();

            List<animal> animals = service.afficher();
            int column = 0;
            int row = 0;
            int currentCompteId = com.esprit.animal.utils.Session.getCompteId();
            int currentUserId = com.esprit.animal.utils.Session.getUserId();

            for (animal a : animals) {
                if (a.getOwnerCompteId() == currentCompteId || a.getOwnerCompteId() == currentUserId) {
                    FXMLLoader loader = createLoader("/animal/AnimalCard.fxml");
                    Node card = loader.load();

                    AnimalCard controller = loader.getController();
                    controller.setData(a);

                    card.setOnMouseClicked(event -> {
                        if (event.getClickCount() == 2) {
                            openAnimalDetails(a);
                        }
                    });

                    myanimalsGrid.add(card, column, row);

                    column++;
                    if (column == 3) {
                        column = 0;
                        row++;
                    }
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void openAnimalDetails(animal selectedAnimal) {
        try {
            FXMLLoader loader = createLoader("/animal/animalDetails.fxml");
            Parent root = loader.load();

            AnimalDetails controller = loader.getController();
            controller.setAnimal(selectedAnimal);

            Stage stage = (Stage) myanimalsGrid.getScene().getWindow();
            stage.setTitle("Animal Details");
            StageSceneHelper.setScene(stage, root);
            stage.setMaximized(true);
            stage.show();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
