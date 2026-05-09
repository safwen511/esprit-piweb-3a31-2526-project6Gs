package com.esprit.utils;

import com.esprit.config.DatabaseConfig;
import services.DatabaseSchemaService;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class MyDataBase {

    private Connection connection;
    private static volatile MyDataBase instance;

    private MyDataBase() {
        reconnect();
    }

    public static MyDataBase getInstance() {
        if (instance == null) {
            synchronized (MyDataBase.class) {
                if (instance == null) {
                    instance = new MyDataBase();
                }
            }
        }
        return instance;
    }

    public synchronized Connection getConnection() {
        try {
            if (connection == null || connection.isClosed() || !connection.isValid(2)) {
                reconnect();
            }
        } catch (SQLException e) {
            reconnect();
        }
        return connection;
    }

    private synchronized void reconnect() {
        closeQuietly(connection);
        connection = null;
        try {
            Class.forName("org.mariadb.jdbc.Driver");
            String password = DatabaseConfig.password();
            if ("CHANGE_ME".equals(password)) {
                throw new SQLException("Database password is not configured. Set db.password or DB_PASSWORD.");
            }
            connection = DriverManager.getConnection(
                    DatabaseConfig.jdbcUrl(),
                    DatabaseConfig.user(),
                    password
            );
            DatabaseSchemaService.ensureSecuritySchema(connection);
            System.out.println("Connected to database successfully");
        } catch (ClassNotFoundException e) {
            System.err.println("MariaDB JDBC driver not found.");
            e.printStackTrace();
        } catch (SQLException e) {
            System.err.println("Database connection failed:");
            e.printStackTrace();
        }
    }

    private void closeQuietly(Connection oldConnection) {
        if (oldConnection == null) {
            return;
        }
        try {
            oldConnection.close();
        } catch (SQLException ignored) {
        }
    }
}
