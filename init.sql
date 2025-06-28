CREATE DATABASE IF NOT EXISTS app;
USE app;
CREATE TABLE IF NOT EXISTS users (
    id CHAR(8) PRIMARY KEY,
    login VARCHAR(8) NOT NULL,
    password VARCHAR(8) NOT NULL,
    phone VARCHAR(8) NOT NULL,
    UNIQUE INDEX unique_login_pass (login, password)
);
