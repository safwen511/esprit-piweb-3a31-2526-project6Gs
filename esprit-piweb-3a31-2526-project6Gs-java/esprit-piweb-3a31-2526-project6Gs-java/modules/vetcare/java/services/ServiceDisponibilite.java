package services;

import model.Disponibilite;
import utils.MyDatabase;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Time;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.ArrayList;
import java.util.List;

public class ServiceDisponibilite implements IService<Disponibilite> {

    private final MyDatabase database;

    public ServiceDisponibilite() {
        database = MyDatabase.getInstance();
    }

    @Override
    public void add(Disponibilite disponibilite) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "INSERT INTO disponibilite (date, vet_id, start_time, end_time, is_available) VALUES (?, ?, ?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setDate(1, Date.valueOf(toLocalDate(disponibilite.getStarttime())));
            ps.setInt(2, disponibilite.getId());
            ps.setTime(3, Time.valueOf(toLocalTime(disponibilite.getStarttime())));
            ps.setTime(4, Time.valueOf(toLocalTime(disponibilite.getEndtime())));
            ps.setBoolean(5, disponibilite.getStatut() == Disponibilite.Statut.VALABLE);
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) {
                    disponibilite.setId_disponibilite(rs.getInt(1));
                }
            }
        }
    }

    @Override
    public void update(Disponibilite disponibilite) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "UPDATE disponibilite SET date = ?, vet_id = ?, start_time = ?, end_time = ?, is_available = ? WHERE id_disponibilite = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setDate(1, Date.valueOf(toLocalDate(disponibilite.getStarttime())));
            ps.setInt(2, disponibilite.getId());
            ps.setTime(3, Time.valueOf(toLocalTime(disponibilite.getStarttime())));
            ps.setTime(4, Time.valueOf(toLocalTime(disponibilite.getEndtime())));
            ps.setBoolean(5, disponibilite.getStatut() == Disponibilite.Statut.VALABLE);
            ps.setInt(6, disponibilite.getId_disponibilite());
            ps.executeUpdate();
        }
    }

    public void updateStatut(int dispoId, String statut) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "UPDATE disponibilite SET is_available = ? WHERE id_disponibilite = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            boolean available = "valable".equalsIgnoreCase(statut)
                    || "active".equalsIgnoreCase(statut)
                    || "true".equalsIgnoreCase(statut)
                    || "1".equals(statut);
            ps.setBoolean(1, available);
            ps.setInt(2, dispoId);
            ps.executeUpdate();
        }
    }

    @Override
    public void delete(int id_disponibilite) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "DELETE FROM disponibilite WHERE id_disponibilite = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id_disponibilite);
            ps.executeUpdate();
        }
    }

    @Override
    public List<Disponibilite> read() throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT * FROM disponibilite ORDER BY id_disponibilite DESC";
        List<Disponibilite> disponibilites = new ArrayList<>();
        try (Statement statement = connection.createStatement();
             ResultSet rs = statement.executeQuery(sql)) {
            while (rs.next()) {
                disponibilites.add(mapRow(rs));
            }
        }
        return disponibilites;
    }

    public List<Disponibilite> readValables() throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT * FROM disponibilite WHERE is_available = 1 AND date >= CURRENT_DATE() ORDER BY date, start_time";
        List<Disponibilite> disponibilites = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                disponibilites.add(mapRow(rs));
            }
        }
        return disponibilites;
    }

    public List<Disponibilite> readByVetId(int vetId) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT * FROM disponibilite WHERE vet_id = ? AND date >= CURRENT_DATE() ORDER BY date, start_time";
        List<Disponibilite> disponibilites = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    disponibilites.add(mapRow(rs));
                }
            }
        }
        return disponibilites;
    }

    public Disponibilite findById(int id) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT * FROM disponibilite WHERE id_disponibilite = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return mapRow(rs);
                }
            }
        }
        return null;
    }

    private Disponibilite mapRow(ResultSet rs) throws SQLException {
        Disponibilite d = new Disponibilite();
        d.setId_disponibilite(rs.getInt("id_disponibilite"));
        d.setId(rs.getInt("vet_id"));

        Time startTime = rs.getTime("start_time");
        Time endTime = rs.getTime("end_time");
        Date date = rs.getDate("date");
        LocalDate availabilityDate = date != null ? date.toLocalDate() : LocalDate.now();

        if (startTime != null) {
            d.setStarttime(LocalDateTime.of(availabilityDate, startTime.toLocalTime()));
        }
        if (endTime != null) {
            d.setEndtime(LocalDateTime.of(availabilityDate, endTime.toLocalTime()));
        }

        d.setStatut(rs.getBoolean("is_available") ? Disponibilite.Statut.VALABLE : Disponibilite.Statut.NONVALABLE);
        return d;
    }

    private LocalTime toLocalTime(LocalDateTime value) {
        if (value == null) {
            return LocalTime.of(8, 0);
        }
        return value.toLocalTime();
    }

    private LocalDate toLocalDate(LocalDateTime value) {
        if (value == null) {
            return LocalDate.now();
        }
        return value.toLocalDate();
    }
}
