-- CREATE DATABASE IF NOT EXISTS HIVE_Admin

CREATE TABLE users(
    _id CHAR(36) PRIMARY KEY NOT NULL DEFAULT (UUID()),
    userName TEXT NOT NULL,
    userLastname TEXT NOT NULL,
    userExtraname TEXT NULL,
    userEmail VARCHAR(255) UNIQUE NOT NULL,
    userPassword TEXT NOT NULL,
    userAuthAttemps INT NOT NULL DEFAULT 0,
    userLastAuthAttemp DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NULL
);

CREATE TABLE organizations(
    _id CHAR(36) PRIMARY KEY NOT NULL DEFAULT (UUID()),
    organizationName TEXT NOT NULL,
    organizationCode TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NULL
);

CREATE TABLE user_organizations(
    _id CHAR(36) PRIMARY KEY NOT NULL DEFAULT (UUID()),
    userFK CHAR(36),
    organizationFK CHAR(36),
    isAdmin BOOLEAN DEFAULT 0,
    FOREIGN KEY (userFK) REFERENCES users(_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (organizationFK) REFERENCES organizations(_id) ON UPDATE CASCADE ON DELETE CASCADE,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NULL
);