PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS users;

CREATE TABLE users(
    username TEXT NOT NULL,
    pw TEXT NOT NULL,
    nome TEXT NOT NULL,
    email TEXT NOT NULL,
    PRIMARY KEY(username)
);

DROP TABLE IF EXISTS items;

CREATE TABLE items(
    id INTEGER,
    ownerUser TEXT NOT NULL,
    descriptionItem TEXT NOT NULL,
    sizeItem VARCHAR(1),
    PRIMARY KEY (id),
    FOREIGN KEY (ownerUser) REFERENCES users(username)
);
