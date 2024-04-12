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
    sizeItem TEXT NOT NULL,
    price INTEGER NOT NULL,
    brand TEXT NOT NULL,
    model TEXT NOT NULL,
    condition TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerUser) REFERENCES users(username)
);

DROP TABLE IF EXISTS buy;

CREATE TABLE buy(
    id INTEGER,
    user TEXT NOT NULL,
    PRIMARY KEY (id, user),
    FOREIGN KEY (id) REFERENCES items(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS sold;

CREATE TABLE sold(
    id INTEGER,
    user TEXT NOT NULL,
    PRIMARY KEY (id, user),
    FOREIGN KEY (id) REFERENCES items(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS wishlist;

CREATE TABLE wishlist(
    id INTEGER,
    user TEXT NOT NULL,
    PRIMARY KEY (id, user),
    FOREIGN KEY (id) REFERENCES items(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS comment;

CREATE TABLE comment(
    id INTEGER NOT NULL,
    idItem INTEGER NOT NULL,
    user TEXT NOT NULL,
    texto TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idItem) REFERENCES items(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS reply;

CREATE TABLE reply(
    idComment INTEGER NOT NULL,
    user TEXT NOT NULL,
    texto TEXT NOT NULL,
    PRIMARY KEY (idComment, user),
    FOREIGN KEY (idComment) REFERENCES comment(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS adminUser;

CREATE TABLE adminUser(
    username TEXT NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES users(username)
);

INSERT INTO users VALUES ('jgmesquita', 'pw', 'Jorge', 'Mesquita', 'adress', 'city', 'country', 'postalCode', 'email', 'phone');
INSERT INTO users VALUES ('user1', 'pw', 'Jorge', 'Mesquita', 'adress', 'city', 'country', 'postalCode', 'email', 'phone');
INSERT INTO adminUser VALUES ('jgmesquita');
INSERT INTO items VALUES (1, 'jgmesquita', 'camisola', 'S', 40, 'brand', 'model', 'new');
INSERT INTO items VALUES (2, 'jgmesquita', 'tshirt', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES (3, 'jgmesquita', 'tshirt', 'S', 20, 'brand', 'model', 'new');
INSERT INTO items VALUES (4, 'jgmesquita', 'tshirt', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES (5, 'jgmesquita', 'tshirt', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES (6, 'jgmesquita', 'tshirt', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES (7, 'jgmesquita', 'camisola', 'S', 20, 'brand', 'model', 'new');
INSERT INTO items VALUES (8, 'jgmesquita', 'camisola', 'S', 10, 'brand', 'model', 'new');
INSERT INTO items VALUES (9, 'jgmesquita', 'camisola', 'S', 30, 'brand', 'model', 'new');
INSERT INTO items VALUES (10, 'jgmesquita', 'camisola', 'S', 40, 'brand', 'model', 'new');
INSERT INTO comment VALUES(1,1, 'user1', 'What is the price?');