PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS users;

CREATE TABLE users(
    username TEXT NOT NULL,
    pw TEXT NOT NULL,
    firstName TEXT NOT NULL,
    lastName TEXT NOT NULL,
    address_ TEXT NOT NULL,
    city TEXT NOT NULL,
    country TEXT NOT NULL,
    postalCode TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    PRIMARY KEY(username)
);

DROP TABLE IF EXISTS items;

CREATE TABLE items(
    id INTEGER,
    ownerUser TEXT NOT NULL,
    descriptionItem TEXT NOT NULL,
    sizeItem VARCHAR(1),
    price TEXT NOT NULL,
    brand TEXT NOT NULL,
    model TEXT NOT NULL,
    condition TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerUser) REFERENCES users(username)
);
