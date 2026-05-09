package com.esprit.animal.Services;

import com.esprit.animal.entities.Compte;
import com.esprit.animal.entities.User;
import com.esprit.animal.entities.adoptionRequest;
import com.esprit.animal.entities.animal;
import com.esprit.animal.utils.MyDataBase;

import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class adoptionservices implements ICrud<adoptionRequest> {
    private final Connection con;

    public adoptionservices() {
        con = MyDataBase.getInstance().getConnection();
        AnimalSchemaBootstrapService.ensureSchemaReady();
    }

    @Override
    public void ajouter(adoptionRequest adoption) throws SQLException {
        String sql = "INSERT INTO adoptionrequest (animal_id, client_compte_id, message, phone, address, status) VALUES (?, ?, ?, ?, ?, ?)";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, adoption.getAnimal_id());
            ps.setInt(2, adoption.getClientCompteId());
            ps.setString(3, adoption.getMessage());
            ps.setString(4, adoption.getPhone());
            ps.setString(5, adoption.getAddress());
            ps.setString(6, adoption.getStatus().toString());
            ps.executeUpdate();
        }
    }

    @Override
    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM adoptionrequest WHERE id = ?";
        try (PreparedStatement preparedStatement = con.prepareStatement(sql)) {
            preparedStatement.setInt(1, id);
            preparedStatement.executeUpdate();
        }
    }

    @Override
    public List<adoptionRequest> afficher() throws SQLException {
        List<adoptionRequest> requests = new ArrayList<>();
        String userIdColumn = resolveUserIdColumn();
        String sql = "SELECT r.*, " +
                "c.id_compte AS client_compte_id, c.user_id AS client_user_id, c.username AS client_username, c.role AS client_role, c.status AS client_status, " +
                "u." + userIdColumn + " AS client_user_row_id, u.name AS client_name, u.email AS client_email, u.phone AS client_phone " +
                "FROM adoptionrequest r " +
                "LEFT JOIN compte c ON r.client_compte_id = c.id_compte " +
                "LEFT JOIN user u ON c.user_id = u." + userIdColumn;

        try (Statement statement = con.createStatement();
             ResultSet rs = statement.executeQuery(sql)) {
            while (rs.next()) {
                adoptionRequest request = new adoptionRequest();
                request.setId(rs.getInt("id"));
                request.setAnimal_id(rs.getInt("animal_id"));
                request.setClientCompteId(rs.getInt("client_compte_id"));
                request.setMessage(rs.getString("message"));
                request.setPhone(rs.getString("phone"));
                request.setAddress(rs.getString("address"));
                request.setStatus(readRequestStatus(rs.getString("status")));

                int compteId = rs.getInt("client_compte_id");
                if (!rs.wasNull() && compteId > 0) {
                    User clientUser = new User();
                    clientUser.setId(rs.getInt("client_user_row_id"));
                    clientUser.setName(rs.getString("client_name"));
                    clientUser.setEmail(rs.getString("client_email"));
                    clientUser.setPhone(readPhoneAsInt(rs, "client_phone"));
                    clientUser.setRole(rs.getString("client_role"));

                    Compte clientCompte = new Compte();
                    clientCompte.setIdCompte(compteId);
                    clientCompte.setUserId(rs.getInt("client_user_id"));
                    clientCompte.setUsername(rs.getString("client_username"));
                    clientCompte.setRole(rs.getString("client_role"));
                    clientCompte.setStatus(rs.getString("client_status"));
                    clientCompte.setUser(clientUser);

                    request.setClientCompte(clientCompte);
                }

                requests.add(request);
            }
        }

        return requests;
    }

    @Override
    public void modifier(adoptionRequest request) throws SQLException {
        String sql = "UPDATE adoptionrequest SET animal_id = ?, client_compte_id = ?, message = ?, phone = ?, address = ?, status = ? WHERE id = ?";
        try (PreparedStatement preparedStatement = con.prepareStatement(sql)) {
            preparedStatement.setInt(1, request.getAnimal_id());
            preparedStatement.setInt(2, request.getClientCompteId());
            preparedStatement.setString(3, request.getMessage());
            preparedStatement.setString(4, request.getPhone());
            preparedStatement.setString(5, request.getAddress());
            preparedStatement.setString(6, request.getStatus().toString());
            preparedStatement.setInt(7, request.getId());
            preparedStatement.executeUpdate();
        }
    }

    public List<adoptionRequest> getRequestsForMyAnimals(int ownerCompteId) throws SQLException {
        return getRequestsForMyAnimals(ownerCompteId, 0);
    }

    public List<adoptionRequest> getRequestsForMyAnimals(int ownerCompteId, int ownerUserId) throws SQLException {
        List<adoptionRequest> requests = new ArrayList<>();
        String userIdColumn = resolveUserIdColumn();

        String sql = "SELECT r.*, " +
                "a.name AS animal_name, a.species, a.breed, a.age, a.gender, a.image, a.owner_compte_id, " +
                "cc.id_compte AS client_compte_id, cc.user_id AS client_user_id, cc.username AS client_username, cc.role AS client_role, cc.status AS client_status, " +
                "cu." + userIdColumn + " AS client_user_row_id, cu.name AS client_name, cu.email AS client_email, cu.phone AS client_phone " +
                "FROM adoptionrequest r " +
                "JOIN animal a ON r.animal_id = a.idAnimal " +
                "LEFT JOIN compte cc ON r.client_compte_id = cc.id_compte " +
                "LEFT JOIN user cu ON cc.user_id = cu." + userIdColumn + " " +
                "WHERE (a.owner_compte_id = ? " +
                "OR a.owner_compte_id = ? " +
                "OR a.owner_compte_id IN (SELECT id_compte FROM compte WHERE user_id = ?))";

        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, ownerCompteId);
            ps.setInt(2, ownerUserId);
            ps.setInt(3, ownerUserId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    adoptionRequest request = new adoptionRequest();
                    request.setId(rs.getInt("id"));
                    request.setAnimal_id(rs.getInt("animal_id"));
                    request.setClientCompteId(rs.getInt("client_compte_id"));
                    request.setMessage(rs.getString("message"));
                    request.setPhone(rs.getString("phone"));
                    request.setAddress(rs.getString("address"));
                    request.setStatus(readRequestStatus(rs.getString("status")));

                    animal pet = new animal();
                    pet.setId(rs.getInt("animal_id"));
                    pet.setName(rs.getString("animal_name"));
                    pet.setSpecies(rs.getString("species"));
                    pet.setBreed(rs.getString("breed"));
                    pet.setAge(rs.getInt("age"));
                    pet.setGender(readAnimalGender(rs.getString("gender")));
                    pet.setImage(rs.getString("image"));
                    pet.setOwnerCompteId(rs.getInt("owner_compte_id"));
                    request.setAnimal(pet);

                    int clientCompteId = rs.getInt("client_compte_id");
                    if (!rs.wasNull() && clientCompteId > 0) {
                        User clientUser = new User();
                        clientUser.setId(rs.getInt("client_user_row_id"));
                        clientUser.setName(rs.getString("client_name"));
                        clientUser.setEmail(rs.getString("client_email"));
                        clientUser.setPhone(readPhoneAsInt(rs, "client_phone"));
                        clientUser.setRole(rs.getString("client_role"));

                        Compte clientCompte = new Compte();
                        clientCompte.setIdCompte(clientCompteId);
                        clientCompte.setUserId(rs.getInt("client_user_id"));
                        clientCompte.setUsername(rs.getString("client_username"));
                        clientCompte.setRole(rs.getString("client_role"));
                        clientCompte.setStatus(rs.getString("client_status"));
                        clientCompte.setUser(clientUser);

                        request.setClientCompte(clientCompte);
                    }

                    requests.add(request);
                }
            }
        }

        return requests;
    }

    public List<adoptionRequest> getRequestsByClientSession(int sessionCompteId, int sessionUserId) throws SQLException {
        List<adoptionRequest> requests = new ArrayList<>();
        String userIdColumn = resolveUserIdColumn();
        String sql = "SELECT r.*, " +
                "c.id_compte AS client_compte_id, c.user_id AS client_user_id, c.username AS client_username, c.role AS client_role, c.status AS client_status, " +
                "u." + userIdColumn + " AS client_user_row_id, u.name AS client_name, u.email AS client_email, u.phone AS client_phone " +
                "FROM adoptionrequest r " +
                "LEFT JOIN compte c ON r.client_compte_id = c.id_compte " +
                "LEFT JOIN user u ON c.user_id = u." + userIdColumn + " " +
                "WHERE (r.client_compte_id = ? " +
                "OR r.client_compte_id = ? " +
                "OR r.client_compte_id IN (SELECT id_compte FROM compte WHERE user_id = ?)) " +
                "ORDER BY r.id DESC";

        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, sessionCompteId);
            ps.setInt(2, sessionUserId);
            ps.setInt(3, sessionUserId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    adoptionRequest request = new adoptionRequest();
                    request.setId(rs.getInt("id"));
                    request.setAnimal_id(rs.getInt("animal_id"));
                    request.setClientCompteId(rs.getInt("client_compte_id"));
                    request.setMessage(rs.getString("message"));
                    request.setPhone(rs.getString("phone"));
                    request.setAddress(rs.getString("address"));
                    request.setStatus(readRequestStatus(rs.getString("status")));

                    int compteId = rs.getInt("client_compte_id");
                    if (!rs.wasNull() && compteId > 0) {
                        User clientUser = new User();
                        clientUser.setId(rs.getInt("client_user_row_id"));
                        clientUser.setName(rs.getString("client_name"));
                        clientUser.setEmail(rs.getString("client_email"));
                        clientUser.setPhone(readPhoneAsInt(rs, "client_phone"));
                        clientUser.setRole(rs.getString("client_role"));

                        Compte clientCompte = new Compte();
                        clientCompte.setIdCompte(compteId);
                        clientCompte.setUserId(rs.getInt("client_user_id"));
                        clientCompte.setUsername(rs.getString("client_username"));
                        clientCompte.setRole(rs.getString("client_role"));
                        clientCompte.setStatus(rs.getString("client_status"));
                        clientCompte.setUser(clientUser);

                        request.setClientCompte(clientCompte);
                    }

                    requests.add(request);
                }
            }
        }

        return requests;
    }

    private String resolveUserIdColumn() throws SQLException {
        if (columnExists("user", "id_user")) {
            return "id_user";
        }
        if (columnExists("user", "id")) {
            return "id";
        }
        throw new SQLException("User table must contain id_user or id.");
    }

    private boolean columnExists(String tableName, String columnName) throws SQLException {
        DatabaseMetaData metaData = con.getMetaData();
        try (ResultSet resultSet = metaData.getColumns(con.getCatalog(), null, tableName, columnName)) {
            if (resultSet.next()) {
                return true;
            }
        }
        try (ResultSet resultSet = metaData.getColumns(con.getCatalog(), null, tableName.toUpperCase(), columnName)) {
            return resultSet.next();
        }
    }

    private adoptionRequest.status readRequestStatus(String value) {
        if (value == null || value.isBlank()) {
            return adoptionRequest.status.PENDING;
        }
        try {
            return adoptionRequest.status.valueOf(value.trim().toUpperCase(Locale.ROOT));
        } catch (IllegalArgumentException e) {
            return adoptionRequest.status.PENDING;
        }
    }

    private animal.gender readAnimalGender(String value) {
        if (value == null || value.isBlank()) {
            return animal.gender.MALE;
        }
        try {
            return animal.gender.valueOf(value.trim().toUpperCase(Locale.ROOT));
        } catch (IllegalArgumentException e) {
            return animal.gender.MALE;
        }
    }

    private int readPhoneAsInt(ResultSet rs, String columnName) throws SQLException {
        String value = rs.getString(columnName);
        if (value == null || value.isBlank()) {
            return 0;
        }
        String digits = value.replaceAll("\\D", "");
        if (digits.isEmpty()) {
            return 0;
        }
        try {
            return Integer.parseInt(digits.length() > 9 ? digits.substring(digits.length() - 9) : digits);
        } catch (NumberFormatException e) {
            return 0;
        }
    }
}
