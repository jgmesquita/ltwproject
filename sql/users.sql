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
    category TEXT NOT NULL,
    descriptionItem TEXT NOT NULL,
    sizeItem TEXT NOT NULL,
    color TEXT NOT NULL,
    price INTEGER NOT NULL,
    brand TEXT NOT NULL,
    model TEXT NOT NULL,
    condition TEXT NOT NULL,
    imagePath TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerUser) REFERENCES users(username)
);

DROP TABLE IF EXISTS sizes;

CREATE TABLE sizes(
    sizeText TEXT NOT NULL,
    PRIMARY KEY (sizeText)
);

DROP TABLE IF EXISTS categories;

CREATE TABLE categories(
    category TEXT NOT NULL,
    PRIMARY KEY (category)
);

DROP TABLE IF EXISTS conditions;

CREATE TABLE conditions(
    condition TEXT NOT NULL,
    PRIMARY KEY (condition)
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
    id INTEGER NOT NULL,
    idComment INTEGER NOT NULL,
    user TEXT NOT NULL,
    texto TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idComment) REFERENCES comment(id),
    FOREIGN KEY (user) REFERENCES users(username)
);

DROP TABLE IF EXISTS adminUser;

CREATE TABLE adminUser(
    username TEXT NOT NULL,
    PRIMARY KEY (username),
    FOREIGN KEY (username) REFERENCES users(username)
);

DROP TABLE IF EXISTS review;

CREATE TABLE review(
    idItem INTEGER NOT NULL,
    username TEXT NOT NULL,
    rating TEXT NOT NULL,
    texto TEXT NOT NULL,
    PRIMARY KEY (idItem, username),
    FOREIGN KEY (idItem) REFERENCES items(id),
    FOREIGN KEY (username) REFERENCES users(username)
);

INSERT INTO users VALUES ('jgmesquita', 'pw', 'Jorge', 'Mesquita', 'adress', 'city', 'country', 'postalCode', 'email', 'phone');
INSERT INTO users VALUES ('user1', 'pw', 'Jorge', 'Mesquita', 'adress', 'city', 'country', 'postalCode', 'email', 'phone');
INSERT INTO adminUser VALUES ('jgmesquita');
INSERT INTO sizes VALUES ('S');
INSERT INTO sizes VALUES ('M');
INSERT INTO sizes VALUES ('L');
INSERT INTO sizes VALUES ('XL');
INSERT INTO categories VALUES ('Roupa - Camisola');
INSERT INTO categories VALUES ('Roupa - T-Shirt');
INSERT INTO categories VALUES ('Roupa - Calças');
INSERT INTO categories VALUES ('Roupa - Vestido');
INSERT INTO categories VALUES ('Calçado - Botas');
INSERT INTO categories VALUES ('Calçado - Sapatilhas');
INSERT INTO categories VALUES ('Calçado - Chinelos');
INSERT INTO categories VALUES ('Acessório - Brincos');
INSERT INTO categories VALUES ('Acessório - Colar');
INSERT INTO categories VALUES ('Acessório - Pulseira');
INSERT INTO categories VALUES ('Acessório - Chapéu');
INSERT INTO categories VALUES ('Tecnologia - Computador');
INSERT INTO categories VALUES ('Tecnologia - Teclado');
INSERT INTO categories VALUES ('Tecnologia - Rato');
INSERT INTO categories VALUES ('Outro - Carro');
INSERT INTO categories VALUES ('Outro - Bicicleta');
INSERT INTO conditions VALUES ('Pouco Usado');
INSERT INTO conditions VALUES ('Muito Usado');
INSERT INTO conditions VALUES ('Com Defeito');
INSERT INTO conditions VALUES ('Novo');
INSERT INTO items VALUES (1, 'jgmesquita','Roupa - Camisola' ,'camisola', 'S', 'c', 40, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (2, 'jgmesquita', 'Roupa - T-Shirt','tshirt', 'S', 'c', 30, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (3, 'jgmesquita','Roupa - Camisola','tshirt', 'S', 'c', 20, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (4, 'jgmesquita', 'Roupa - T-Shirt','tshirt', 'S', 'c', 10, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (5, 'jgmesquita', 'Roupa - T-Shirt','tshirt', 'S', 'c', 30, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (6, 'jgmesquita', 'Roupa - T-Shirt','tshirt', 'S', 'c', 10, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (7, 'jgmesquita', 'Roupa - Camisola','camisola', 'S', 'c', 20, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (8, 'jgmesquita', 'Roupa - Camisola','camisola', 'S', 'c', 10, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (9, 'jgmesquita', 'Roupa - Camisola','camisola', 'S', 'c', 30, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO items VALUES (10, 'jgmesquita','Roupa - Camisola', 'camisola', 'S', 'c', 40, 'brand', 'model', 'new', '/images/path.png');
INSERT INTO comment VALUES(1,1, 'user1', 'What is the price?');