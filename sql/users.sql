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
    price INTEGER NOT NULL,
    brand TEXT NOT NULL,
    model TEXT NOT NULL,
    condition TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerUser) REFERENCES users(username)
);

INSERT INTO users VALUES ('jgmesquita', 'pw', 'Jorge', 'Mesquita', 'adress', 'city', 'country', 'postalCode', 'email', 'phone');
INSERT INTO items VALUES ('1', 'jgmesquita', 'camisola', 'S', 40, 'brand', 'model', 'new');
INSERT INTO items VALUES ('2', 'jgmesquita', 'tshirt', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES ('3', 'jgmesquita', 'tshirt', 'S', 20, 'brand', 'model', 'new');
INSERT INTO items VALUES ('4', 'jgmesquita', 'tshirt', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES ('5', 'jgmesquita', 'tshirt', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES ('6', 'jgmesquita', 'tshirt', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES ('7', 'jgmesquita', 'camisola', 'S', 20, 'brand', 'model', 'new');
INSERT INTO items VALUES ('8', 'jgmesquita', 'camisola', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES ('9', 'jgmesquita', 'camisola', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES ('10', 'jgmesquita', 'camisola', 'S', 40, 'brand', 'model', 'new');