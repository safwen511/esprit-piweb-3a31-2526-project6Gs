package com.esprit.services;

import entities.User;
import com.esprit.utils.MyDataBase;
import org.mindrot.jbcrypt.BCrypt;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.OptionalInt;

public class userservices implements ICrud<User> {

    private static final Object SCHEMA_LOCK = new Object();
    private static volatile boolean profileSchemaReady;
    private Connection con;

    public userservices() {
        con = MyDataBase.getInstance().getConnection();
        if (con == null) {
            throw new RuntimeException("Database connection unavailable. Check MariaDB credentials and db.* configuration.");
        }
        try {
            ensureProfileImageColumn(con);
        } catch (SQLException e) {
            throw new RuntimeException("Failed to verify user profile image schema.", e);
        }
    }

    // ===============================
    // ADD USER (Sign Up)
    // ===============================
    @Override
    public void ajouter(User user) throws SQLException {

        String sql = "INSERT INTO user " +
                "(first_name, last_name, email, password, phone, phone_number, roles, is_verified, is_active, " +
                "is_veteran_applicant, is_veteran_approved, created_at, updated_at, profile_image_url, profile_image_path) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";

        PreparedStatement ps = con.prepareStatement(sql);
        boolean isVetApplicant = "VETERINAIRE".equalsIgnoreCase(user.getRole());

        ps.setString(1, user.getFirstName());
        ps.setString(2, user.getLastName());
        ps.setString(3, user.getEmail());
        ps.setString(4, hashPasswordForSymfony(user.getPassword()));
        ps.setString(5, user.getPhone());
        ps.setString(6, user.getPhone());
        ps.setString(7, rolesJson(user.getRole()));
        ps.setBoolean(8, false);
        ps.setBoolean(9, user.isActive());
        ps.setBoolean(10, isVetApplicant);
        ps.setBoolean(11, false);
        ps.setString(12, user.getProfileImagePath());
        ps.setString(13, user.getProfileImagePath());

        ps.executeUpdate();

        System.out.println("User added successfully!");
    }

    // ===============================
    // DELETE USER
    // ===============================
    @Override
    public void supprimer(int id) throws SQLException {

        String sql = "DELETE FROM user WHERE id = ?";

        PreparedStatement ps = con.prepareStatement(sql);
        ps.setInt(1, id);
        ps.executeUpdate();

        System.out.println("User deleted successfully!");
    }

    // ===============================
    // DISPLAY USERS
    // ===============================
    @Override
    public List<User> afficher() throws SQLException {

        List<User> user = new ArrayList<>();

        String sql = "SELECT * FROM user";
        Statement st = con.createStatement();
        ResultSet rs = st.executeQuery(sql);

        while (rs.next()) {
            user.add(mapUser(rs));
        }

        return user;
    }

    // ===============================
    // UPDATE USER
    // ===============================
    public void modifier(User user) throws SQLException {
        List<Object> values = new ArrayList<>();
        StringBuilder sql = new StringBuilder("UPDATE user SET first_name=?, last_name=?, email=?, password=?");
        values.add(user.getFirstName());
        values.add(user.getLastName());
        values.add(user.getEmail());
        values.add(hashPasswordForSymfony(user.getPassword()));

        appendColumnUpdate(sql, values, "phone", user.getPhone());
        appendColumnUpdate(sql, values, "phone_number", user.getPhone());
        appendColumnUpdate(sql, values, "address", user.getAddress());
        appendColumnUpdate(sql, values, "city", user.getCity());
        appendColumnUpdate(sql, values, "role", user.getRole());
        appendColumnUpdate(sql, values, "roles", rolesJson(user.getRole()));
        appendColumnUpdate(sql, values, "active", user.isActive());
        appendColumnUpdate(sql, values, "is_active", user.isActive());
        appendColumnUpdate(sql, values, "profile_image_path", user.getProfileImagePath());
        appendColumnUpdate(sql, values, "profile_image_url", user.getProfileImagePath());
        if (columnExists(con, "user", "updated_at")) {
            sql.append(", updated_at=NOW()");
        }
        sql.append(" WHERE id=?");

        try (PreparedStatement ps = con.prepareStatement(sql.toString())) {
            int index = 1;
            for (Object value : values) {
                ps.setObject(index++, value);
            }
            ps.setInt(index, user.getId());
            ps.executeUpdate();
        }

        System.out.println("User updated successfully!");
    }

    // ===============================
    // LOGIN METHOD
    // ===============================
    public User login(String email, String password) throws SQLException {

        String sql = "SELECT * FROM user WHERE email = ?";

        PreparedStatement ps = con.prepareStatement(sql);
        ps.setString(1, email);

        ResultSet rs = ps.executeQuery();

        if (!rs.next()) {
            // Email does not exist
            throw new RuntimeException("EMAIL_NOT_FOUND");
        }

        String storedPassword = rs.getString("password");

        if (!passwordMatches(password, storedPassword)) {
            // Password is wrong
            throw new RuntimeException("WRONG_PASSWORD");
        }

        // Correct login:
        // pending vets can still access regular user pages until approval.
        User user = mapUser(rs);
        if (!user.isActive() && !"VETERINAIRE".equalsIgnoreCase(user.getRole())) {
            throw new RuntimeException("ACCOUNT_INACTIVE");
        }

        return user;
    }

    public List<User> getPendingVets() throws SQLException {
        List<User> users = new ArrayList<>();
        String sql = """
                SELECT *
                FROM user
                WHERE (
                    COALESCE(is_veteran_applicant, 0) = 1
                    OR COALESCE(roles, '') LIKE '%ROLE_VETERINAIRE%'
                    OR UPPER(COALESCE(role, '')) = 'VETERINAIRE'
                )
                AND COALESCE(is_veteran_approved, 0) = 0
                ORDER BY id DESC
                """;

        try (PreparedStatement ps = con.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                users.add(mapUser(rs));
            }
        }
        return users;
    }

    public void approveUser(int id) throws SQLException {
        List<Object> values = new ArrayList<>();
        StringBuilder sql = new StringBuilder("UPDATE user SET ");
        List<String> assignments = new ArrayList<>();
        if (columnExists(con, "user", "is_active")) {
            assignments.add("is_active = ?");
            values.add(true);
        }
        if (columnExists(con, "user", "active")) {
            assignments.add("active = ?");
            values.add(true);
        }
        if (columnExists(con, "user", "is_verified")) {
            assignments.add("is_verified = ?");
            values.add(true);
        }
        if (columnExists(con, "user", "is_veteran_applicant")) {
            assignments.add("is_veteran_applicant = ?");
            values.add(true);
        }
        if (columnExists(con, "user", "is_veteran_approved")) {
            assignments.add("is_veteran_approved = ?");
            values.add(true);
        }
        if (columnExists(con, "user", "roles")) {
            assignments.add("roles = CASE WHEN roles LIKE '%ROLE_VETERINAIRE%' THEN roles ELSE '[\"ROLE_USER\",\"ROLE_VETERINAIRE\"]' END");
        }
        if (columnExists(con, "user", "role")) {
            assignments.add("role = ?");
            values.add("VETERINAIRE");
        }
        if (columnExists(con, "user", "updated_at")) {
            assignments.add("updated_at = NOW()");
        }
        if (assignments.isEmpty()) {
            return;
        }
        sql.append(String.join(", ", assignments)).append(" WHERE id = ?");
        try (PreparedStatement ps = con.prepareStatement(sql.toString())) {
            int index = 1;
            for (Object value : values) {
                ps.setObject(index++, value);
            }
            ps.setInt(index, id);
            ps.executeUpdate();
        }
    }

    public void setActive(int id, boolean active) throws SQLException {
        List<Object> values = new ArrayList<>();
        StringBuilder sql = new StringBuilder("UPDATE user SET ");
        List<String> assignments = new ArrayList<>();
        if (columnExists(con, "user", "active")) {
            assignments.add("active = ?");
            values.add(active);
        }
        if (columnExists(con, "user", "is_active")) {
            assignments.add("is_active = ?");
            values.add(active);
        }
        if (columnExists(con, "user", "updated_at")) {
            assignments.add("updated_at = NOW()");
        }
        if (assignments.isEmpty()) {
            return;
        }
        sql.append(String.join(", ", assignments)).append(" WHERE id = ?");
        try (PreparedStatement ps = con.prepareStatement(sql.toString())) {
            int index = 1;
            for (Object value : values) {
                ps.setObject(index++, value);
            }
            ps.setInt(index, id);
            ps.executeUpdate();
        }
    }

    public boolean existsByEmail(String email) throws SQLException {
        String sql = "SELECT 1 FROM user WHERE email = ? LIMIT 1";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, email);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        }
    }

    public boolean existsByEmailExcludingId(String email, int userId) throws SQLException {
        String sql = "SELECT 1 FROM user WHERE email = ? AND id <> ? LIMIT 1";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, email);
            ps.setInt(2, userId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        }
    }

    public User findByEmail(String email) throws SQLException {
        String sql = "SELECT * FROM user WHERE email = ? LIMIT 1";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, email);
            try (ResultSet rs = ps.executeQuery()) {
                if (!rs.next()) {
                    return null;
                }
                return mapUser(rs);
            }
        }
    }

    public void updatePasswordById(int userId, String newPassword) throws SQLException {
        String sql = "UPDATE user SET password = ? WHERE id = ?";
        try (PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, hashPasswordForSymfony(newPassword));
            ps.setInt(2, userId);
            ps.executeUpdate();
        }
    }

    public OptionalInt findFirstActiveAdminId() throws SQLException {
        List<String> roleFilters = new ArrayList<>();
        if (columnExists(con, "user", "role")) {
            roleFilters.add("UPPER(role) = 'ADMIN'");
        }
        if (columnExists(con, "user", "roles")) {
            roleFilters.add("roles LIKE '%ROLE_ADMIN%'");
        }
        if (roleFilters.isEmpty()) {
            return OptionalInt.empty();
        }
        StringBuilder sql = new StringBuilder("SELECT id FROM user WHERE (");
        sql.append(String.join(" OR ", roleFilters)).append(")");
        if (columnExists(con, "user", "is_active")) {
            sql.append(" AND is_active = 1");
        } else if (columnExists(con, "user", "active")) {
            sql.append(" AND active = 1");
        }
        sql.append(" ORDER BY id ASC LIMIT 1");
        try (PreparedStatement ps = con.prepareStatement(sql.toString());
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) {
                return OptionalInt.of(rs.getInt("id"));
            }
            return OptionalInt.empty();
        }
    }

    private User mapUser(ResultSet rs) throws SQLException {
        User u = new User();

        u.setId(readInt(rs, "id", "id_user", "user.id", "user.id_user"));
        u.setFirstName(readString(rs, "first_name", "user.first_name"));
        u.setLastName(readString(rs, "last_name", "user.last_name"));
        u.setEmail(readString(rs, "email", "user.email"));
        u.setPassword(readString(rs, "password", "user.password"));
        u.setPhone(readString(rs, "phone", "phone_number", "user.phone", "user.phone_number"));
        u.setAddress(readString(rs, "address", "user.address"));
        u.setCity(readString(rs, "city", "user.city"));
        u.setRole(readRole(rs));
        u.setActive(readBoolean(rs, true, "active", "is_active", "user.active", "user.is_active"));
        u.setProfileImagePath(readString(rs, "profile_image_url", "profile_image_path", "user.profile_image_url", "user.profile_image_path"));

        Timestamp timestamp = readTimestamp(rs, "created_at", "user.created_at");
        if (timestamp != null) {
            u.setCreatedAt(timestamp.toLocalDateTime());
        }

        return u;
    }

    private String readRole(ResultSet rs) throws SQLException {
        String role = readString(rs, "role", "user.role");
        if (role == null || role.isBlank()) {
            role = readString(rs, "roles", "user.roles");
        }
        if (role == null || role.isBlank()) {
            return "USER";
        }

        String normalized = role.toUpperCase();
        if (normalized.contains("ADMIN")) {
            return "ADMIN";
        }
        if (normalized.contains("VETERINAIRE") || normalized.contains("VETERINARY") || normalized.contains("VET")) {
            return "VETERINAIRE";
        }
        return "USER";
    }

    private String readString(ResultSet rs, String... columns) throws SQLException {
        for (String column : columns) {
            if (hasColumn(rs, column)) {
                return rs.getString(column);
            }
        }
        return null;
    }

    private int readInt(ResultSet rs, String... columns) throws SQLException {
        for (String column : columns) {
            if (hasColumn(rs, column)) {
                return rs.getInt(column);
            }
        }
        return 0;
    }

    private boolean readBoolean(ResultSet rs, boolean fallback, String... columns) throws SQLException {
        for (String column : columns) {
            if (hasColumn(rs, column)) {
                return rs.getBoolean(column);
            }
        }
        return fallback;
    }

    private Timestamp readTimestamp(ResultSet rs, String... columns) throws SQLException {
        for (String column : columns) {
            if (hasColumn(rs, column)) {
                return rs.getTimestamp(column);
            }
        }
        return null;
    }

    private boolean hasColumn(ResultSet rs, String column) throws SQLException {
        ResultSetMetaData metaData = rs.getMetaData();
        for (int i = 1; i <= metaData.getColumnCount(); i++) {
            if (column.equalsIgnoreCase(metaData.getColumnLabel(i))
                    || column.equalsIgnoreCase(metaData.getColumnName(i))) {
                return true;
            }
        }
        return false;
    }

    private String rolesJson(String role) {
        if ("ADMIN".equalsIgnoreCase(role)) {
            return "[\"ROLE_ADMIN\",\"ROLE_USER\"]";
        }
        return "[\"ROLE_USER\"]";
    }

    private String hashPasswordForSymfony(String password) {
        if (password == null || password.isBlank() || isHashedPassword(password)) {
            return password;
        }
        return BCrypt.hashpw(password, BCrypt.gensalt(12));
    }

    private void appendColumnUpdate(StringBuilder sql, List<Object> values, String column, Object value) throws SQLException {
        if (!columnExists(con, "user", column)) {
            return;
        }
        sql.append(", ").append(column).append("=?");
        values.add(value);
    }

    private boolean passwordMatches(String plainPassword, String storedPassword) {
        if (storedPassword == null) {
            return false;
        }
        if (storedPassword.startsWith("$2")) {
            try {
                return BCrypt.checkpw(plainPassword, normalizeBcryptHash(storedPassword));
            } catch (IllegalArgumentException e) {
                return false;
            }
        }
        return storedPassword.equals(plainPassword);
    }

    private String normalizeBcryptHash(String hash) {
        if (hash.startsWith("$2y$") || hash.startsWith("$2b$")) {
            return "$2a$" + hash.substring(4);
        }
        return hash;
    }

    private boolean isHashedPassword(String password) {
        return password.startsWith("$2")
                || password.startsWith("$argon2i$")
                || password.startsWith("$argon2id$");
    }

    private static void ensureProfileImageColumn(Connection connection) throws SQLException {
        synchronized (SCHEMA_LOCK) {
            if (profileSchemaReady) {
                return;
            }
            if (!columnExists(connection, "user", "profile_image_path")) {
                try (Statement statement = connection.createStatement()) {
                    statement.executeUpdate("ALTER TABLE user ADD COLUMN profile_image_path VARCHAR(1024) NULL");
                }
            }
            profileSchemaReady = true;
        }
    }

    private static boolean columnExists(Connection connection, String table, String column) throws SQLException {
        DatabaseMetaData metaData = connection.getMetaData();
        try (ResultSet rs = metaData.getColumns(connection.getCatalog(), null, table, column)) {
            if (rs.next()) {
                return true;
            }
        }
        try (ResultSet rs = metaData.getColumns(connection.getCatalog(), null, table.toUpperCase(), column.toUpperCase())) {
            return rs.next();
        }
    }

}
