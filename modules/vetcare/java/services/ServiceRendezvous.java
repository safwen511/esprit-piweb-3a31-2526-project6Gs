package services;

import model.Rendezvous;
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
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

public class ServiceRendezvous implements IService<Rendezvous> {

    private static final DateTimeFormatter SLOT_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    private final MyDatabase database;

    public ServiceRendezvous() {
        database = MyDatabase.getInstance();
    }

    @Override
    public void add(Rendezvous rendezvous) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        SlotDateTime slot = resolveSlotDateTime(rendezvous);
        int vetId = rendezvous.getVet_id() > 0 ? rendezvous.getVet_id() : findVetIdByDisponibilite(rendezvous.getDisponibilite_id());

        String sql = "INSERT INTO rendezvous (appointment_date, appointment_time, status, description, client_id, vet_id, animal_id, disponibilite_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setDate(1, Date.valueOf(slot.date));
            ps.setTime(2, Time.valueOf(slot.time));
            ps.setString(3, rendezvous.getStatus());
            ps.setString(4, rendezvous.getDescription());
            ps.setInt(5, rendezvous.getClient_id());
            ps.setInt(6, vetId);
            ps.setInt(7, rendezvous.getAnimal_id());
            ps.setInt(8, rendezvous.getDisponibilite_id());
            ps.executeUpdate();

            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) {
                    rendezvous.setId_rdv(rs.getInt(1));
                }
            }
        }
    }

    @Override
    public void update(Rendezvous rendezvous) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        SlotDateTime slot = resolveSlotDateTime(rendezvous);
        int vetId = rendezvous.getVet_id() > 0 ? rendezvous.getVet_id() : findVetIdByDisponibilite(rendezvous.getDisponibilite_id());

        String sql = "UPDATE rendezvous SET appointment_date = ?, appointment_time = ?, status = ?, description = ?, client_id = ?, vet_id = ?, animal_id = ?, disponibilite_id = ? WHERE id_rdv = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setDate(1, Date.valueOf(slot.date));
            ps.setTime(2, Time.valueOf(slot.time));
            ps.setString(3, rendezvous.getStatus());
            ps.setString(4, rendezvous.getDescription());
            ps.setInt(5, rendezvous.getClient_id());
            ps.setInt(6, vetId);
            ps.setInt(7, rendezvous.getAnimal_id());
            ps.setInt(8, rendezvous.getDisponibilite_id());
            ps.setInt(9, rendezvous.getId_rdv());
            ps.executeUpdate();
        }
    }

    @Override
    public void delete(int id_rdv) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "DELETE FROM rendezvous WHERE id_rdv = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id_rdv);
            ps.executeUpdate();
        }
    }

    @Override
    public List<Rendezvous> read() throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT r.*, u.phone AS client_phone FROM rendezvous r LEFT JOIN user u ON u.id = r.client_id ORDER BY r.id_rdv DESC";
        List<Rendezvous> rendezvousList = new ArrayList<>();
        try (Statement st = connection.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                rendezvousList.add(mapRow(rs));
            }
        }
        return rendezvousList;
    }

    public List<Rendezvous> readByVetId(int vetId) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT r.*, u.phone AS client_phone FROM rendezvous r LEFT JOIN user u ON u.id = r.client_id WHERE r.vet_id = ? ORDER BY r.id_rdv DESC";
        List<Rendezvous> rendezvousList = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    rendezvousList.add(mapRow(rs));
                }
            }
        }
        return rendezvousList;
    }

    public String getVetEmail(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        try (PreparedStatement ps = conn.prepareStatement("SELECT email FROM user WHERE id = ?")) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getString("email");
                }
            }
        }
        return "";
    }

    public String getVetNom(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        try (PreparedStatement ps = conn.prepareStatement("SELECT first_name, last_name FROM user WHERE id = ?")) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getString("first_name") + " " + rs.getString("last_name");
                }
            }
        }
        return "";
    }

    public String getClientEmail(int clientId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        try (PreparedStatement ps = conn.prepareStatement("SELECT email FROM user WHERE id = ?")) {
            ps.setInt(1, clientId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getString("email");
                }
            }
        }
        return "";
    }

    public String getClientNum(int clientId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        try (PreparedStatement ps = conn.prepareStatement("SELECT phone FROM user WHERE id = ?")) {
            ps.setInt(1, clientId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return normalizePhone(rs.getString("phone"));
                }
            }
        }
        return "";
    }

    public void updateClientPhone(int clientId, String phone) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        String sql = "UPDATE user SET phone = ? WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, normalizePhone(phone));
            ps.setInt(2, clientId);
            ps.executeUpdate();
        }
    }

    private Rendezvous mapRow(ResultSet rs) throws SQLException {
        Rendezvous r = new Rendezvous();
        r.setId_rdv(rs.getInt("id_rdv"));
        r.setStatus(rs.getString("status"));
        r.setDescription(rs.getString("description"));
        r.setClient_id(rs.getInt("client_id"));
        r.setVet_id(rs.getInt("vet_id"));
        r.setAnimal_id(rs.getInt("animal_id"));
        r.setDisponibilite_id(rs.getInt("disponibilite_id"));

        Date appointmentDate = rs.getDate("appointment_date");
        Time appointmentTime = rs.getTime("appointment_time");
        if (appointmentDate != null && appointmentTime != null) {
            r.setSlotStart(formatSlot(appointmentDate.toLocalDate(), appointmentTime.toLocalTime()));
        }

        int phoneAsInt = parsePhoneAsInt(rs.getString("client_phone"));
        r.setNum(phoneAsInt);
        return r;
    }

    public boolean slotAlreadyTaken(int vetId, int dispoId, String slotStart) throws SQLException {
        SlotDateTime slot = parseSlotDateTime(slotStart);
        if (slot == null) {
            return false;
        }

        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT COUNT(*) FROM rendezvous WHERE vet_id = ? AND disponibilite_id = ? AND appointment_date = ? AND appointment_time = ? AND status != 'ANNULE'";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            ps.setInt(2, dispoId);
            ps.setDate(3, Date.valueOf(slot.date));
            ps.setTime(4, Time.valueOf(slot.time));
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1) > 0;
                }
            }
        }
        return false;
    }

    public List<String> getTakenSlots(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT appointment_date, appointment_time FROM rendezvous WHERE vet_id = ? AND status != 'ANNULE'";
        List<String> taken = new ArrayList<>();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    Date d = rs.getDate("appointment_date");
                    Time t = rs.getTime("appointment_time");
                    if (d != null && t != null) {
                        taken.add(formatSlot(d.toLocalDate(), t.toLocalTime()));
                    }
                }
            }
        }
        return taken;
    }

    public List<Rendezvous> readByClientId(int clientId) throws SQLException {
        Connection connection = database.getConnectionOrThrow();
        String sql = "SELECT r.*, u.phone AS client_phone FROM rendezvous r LEFT JOIN user u ON u.id = r.client_id WHERE r.client_id = ? ORDER BY r.id_rdv DESC";
        List<Rendezvous> list = new ArrayList<>();

        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, clientId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(mapRow(rs));
                }
            }
        }
        return list;
    }

    public Map<String, Integer> getRdvParJourCeMois(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT appointment_date as jour, COUNT(*) as total " +
                "FROM rendezvous WHERE vet_id = ? " +
                "AND MONTH(appointment_date) = MONTH(CURRENT_DATE()) " +
                "AND YEAR(appointment_date) = YEAR(CURRENT_DATE()) " +
                "GROUP BY appointment_date ORDER BY jour";
        Map<String, Integer> data = new LinkedHashMap<>();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    data.put(rs.getString("jour"), rs.getInt("total"));
                }
            }
        }
        return data;
    }

    public Map<String, Integer> getStatsMoisActuel(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT status, COUNT(*) as total FROM rendezvous " +
                "WHERE vet_id = ? " +
                "AND MONTH(appointment_date) = MONTH(CURRENT_DATE()) " +
                "AND YEAR(appointment_date) = YEAR(CURRENT_DATE()) " +
                "GROUP BY status";
        Map<String, Integer> stats = new HashMap<>();
        stats.put("CONFIRME", 0);
        stats.put("ANNULE", 0);
        stats.put("EN_ATTENTE", 0);
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    stats.put(rs.getString("status"), rs.getInt("total"));
                }
            }
        }
        return stats;
    }

    public Map<String, Integer> getStatsMoisPrecedent(int vetId) throws SQLException {
        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT status, COUNT(*) as total FROM rendezvous " +
                "WHERE vet_id = ? " +
                "AND MONTH(appointment_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) " +
                "AND YEAR(appointment_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) " +
                "GROUP BY status";
        Map<String, Integer> stats = new HashMap<>();
        stats.put("CONFIRME", 0);
        stats.put("ANNULE", 0);
        stats.put("EN_ATTENTE", 0);
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, vetId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    stats.put(rs.getString("status"), rs.getInt("total"));
                }
            }
        }
        return stats;
    }

    private SlotDateTime resolveSlotDateTime(Rendezvous rendezvous) throws SQLException {
        SlotDateTime parsed = parseSlotDateTime(rendezvous.getSlotStart());
        if (parsed != null) {
            return parsed;
        }

        SlotDateTime fromDescription = parseSlotDateTime(extractSlotFromDescription(rendezvous.getDescription()));
        if (fromDescription != null) {
            return fromDescription;
        }

        SlotDateTime fromDisponibilite = findSlotByDisponibilite(rendezvous.getDisponibilite_id());
        if (fromDisponibilite != null) {
            return fromDisponibilite;
        }

        LocalDateTime now = LocalDateTime.now();
        return new SlotDateTime(now.toLocalDate(), now.toLocalTime().withSecond(0).withNano(0));
    }

    private SlotDateTime findSlotByDisponibilite(int disponibiliteId) throws SQLException {
        if (disponibiliteId <= 0) {
            return null;
        }

        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT start_time FROM disponibilite WHERE id_disponibilite = ? LIMIT 1";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, disponibiliteId);
            try (ResultSet rs = ps.executeQuery()) {
                if (!rs.next()) {
                    return null;
                }
                Time start = rs.getTime("start_time");
                if (start == null) {
                    return null;
                }
                return new SlotDateTime(LocalDate.now(), start.toLocalTime().withSecond(0).withNano(0));
            }
        }
    }

    private int findVetIdByDisponibilite(int disponibiliteId) throws SQLException {
        if (disponibiliteId <= 0) {
            return 0;
        }
        Connection conn = database.getConnectionOrThrow();
        String sql = "SELECT vet_id FROM disponibilite WHERE id_disponibilite = ? LIMIT 1";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, disponibiliteId);
            try (ResultSet rs = ps.executeQuery()) {
                if (!rs.next()) {
                    return 0;
                }
                return rs.getInt("vet_id");
            }
        }
    }

    private SlotDateTime parseSlotDateTime(String slotStart) {
        if (slotStart == null || slotStart.isBlank()) {
            return null;
        }
        try {
            LocalDateTime dt = LocalDateTime.parse(slotStart.trim(), SLOT_FORMATTER);
            return new SlotDateTime(dt.toLocalDate(), dt.toLocalTime().withSecond(0).withNano(0));
        } catch (DateTimeParseException ignored) {
            return null;
        }
    }

    private String extractSlotFromDescription(String description) {
        if (description == null || description.isBlank()) {
            return null;
        }
        java.util.regex.Matcher matcher = java.util.regex.Pattern
                .compile("(\\d{4}-\\d{2}-\\d{2}\\s+\\d{2}:\\d{2})")
                .matcher(description);
        if (matcher.find()) {
            return matcher.group(1);
        }
        return null;
    }

    private String formatSlot(LocalDate date, LocalTime time) {
        return SLOT_FORMATTER.format(LocalDateTime.of(date, time.withSecond(0).withNano(0)));
    }

    private int parsePhoneAsInt(String phone) {
        String normalized = normalizePhone(phone);
        if (normalized.isBlank()) {
            return 0;
        }
        try {
            if (normalized.length() > 9) {
                normalized = normalized.substring(normalized.length() - 9);
            }
            return Integer.parseInt(normalized);
        } catch (NumberFormatException ignored) {
            return 0;
        }
    }

    private String normalizePhone(String phone) {
        if (phone == null) {
            return "";
        }
        return phone.replaceAll("[^0-9]", "");
    }

    private static class SlotDateTime {
        private final LocalDate date;
        private final LocalTime time;

        private SlotDateTime(LocalDate date, LocalTime time) {
            this.date = date;
            this.time = time;
        }
    }
}
