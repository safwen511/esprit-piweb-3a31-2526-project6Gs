package com.esprit.services;

import com.esprit.entities.Reclamation;
import com.esprit.utils.MyDataBase;

import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

public class ReclamationService implements ICrud<Reclamation> {

    private final Connection con;

    public ReclamationService() {
        this.con = MyDataBase.getInstance().getConnection();
        try {
            ensureSchema();
        } catch (SQLException e) {
            throw new RuntimeException("Unable to prepare reclamation tables.", e);
        }
    }

    @Override
    public void ajouter(Reclamation reclamation) throws SQLException {
        String sql = "INSERT INTO reclamation (client_id, sujet, description, status) VALUES (?, ?, ?, ?)";
        try (PreparedStatement ps = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, reclamation.getClientId());
            ps.setString(2, reclamation.getSujet());
            ps.setString(3, reclamation.getDescription());
            ps.setString(4, reclamation.getStatus());
            ps.executeUpdate();
            try (ResultSet keys = ps.getGeneratedKeys()) {
                if (keys.next()) {
                    reclamation.setId(keys.getInt(1));
                }
            }
        }
    }

    @Override
    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM reclamation WHERE id = ?";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    @Override
    public List<Reclamation> afficher() throws SQLException {
        List<Reclamation> reclamations = new ArrayList<>();
        String sql = "SELECT * FROM reclamation ORDER BY id DESC";
        try (Statement st = con.createStatement(); ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                reclamations.add(mapReclamation(rs));
            }
        }
        return reclamations;
    }

    public List<Reclamation> afficherParClient(int clientId) throws SQLException {
        List<Reclamation> reclamations = new ArrayList<>();
        String sql = "SELECT * FROM reclamation WHERE client_id = ? ORDER BY id DESC";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, clientId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    reclamations.add(mapReclamation(rs));
                }
            }
        }
        return reclamations;
    }

    @Override
    public void modifier(Reclamation reclamation) throws SQLException {
        String sql = "UPDATE reclamation SET sujet = ?, description = ?, status = ? WHERE id = ?";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, reclamation.getSujet());
            ps.setString(2, reclamation.getDescription());
            ps.setString(3, reclamation.getStatus());
            ps.setInt(4, reclamation.getId());
            ps.executeUpdate();
        }
    }

    public boolean isOwnedByClient(int reclamationId, int clientId) throws SQLException {
        String sql = "SELECT 1 FROM reclamation WHERE id = ? AND client_id = ?";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setInt(1, reclamationId);
            ps.setInt(2, clientId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        }
    }

    private Reclamation mapReclamation(ResultSet rs) throws SQLException {
        Reclamation reclamation = new Reclamation();
        reclamation.setId(rs.getInt("id"));
        reclamation.setClientId(rs.getInt("client_id"));
        reclamation.setSujet(rs.getString("sujet"));
        reclamation.setDescription(rs.getString("description"));
        reclamation.setStatus(rs.getString("status"));
        Timestamp timestamp = rs.getTimestamp("created_at");
        if (timestamp != null) {
            reclamation.setCreatedAt(timestamp.toLocalDateTime());
        }
        return reclamation;
    }

    private void ensureSchema() throws SQLException {
        try (Statement st = con.createStatement()) {
            if (!tableExists("reclamation")) {
                st.executeUpdate(
                        """
                        CREATE TABLE reclamation (
                            id INT AUTO_INCREMENT NOT NULL,
                            client_id INT NOT NULL,
                            sujet VARCHAR(180) NOT NULL,
                            description TEXT NOT NULL,
                            status VARCHAR(30) NOT NULL DEFAULT 'OPEN',
                            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            INDEX fk_reclamation_client (client_id),
                            PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB
                        """
                );
            }
            if (!tableExists("reponse")) {
                st.executeUpdate(
                        """
                        CREATE TABLE reponse (
                            id INT AUTO_INCREMENT NOT NULL,
                            reclamation_id INT NOT NULL,
                            admin_id INT NOT NULL,
                            message TEXT NOT NULL,
                            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            sender_id INT DEFAULT NULL,
                            sender_type VARCHAR(16) DEFAULT NULL,
                            rating INT DEFAULT NULL,
                            INDEX fk_reponse_reclamation (reclamation_id),
                            INDEX fk_reponse_admin (admin_id),
                            PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB
                        """
                );
            }
        }
    }

    private boolean tableExists(String table) throws SQLException {
        DatabaseMetaData metaData = con.getMetaData();
        try (ResultSet rs = metaData.getTables(con.getCatalog(), null, table, new String[]{"TABLE"})) {
            if (rs.next()) {
                return true;
            }
        }
        try (ResultSet rs = metaData.getTables(con.getCatalog(), null, table.toUpperCase(), new String[]{"TABLE"})) {
            return rs.next();
        }
    }
}
