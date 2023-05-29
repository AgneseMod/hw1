CREATE DATABASE hw1;
USE hw1;

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    propic VARCHAR(255)
);

CREATE TABLE film_salvati (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  film_id VARCHAR(255),
  user_id INT,
  titolo VARCHAR(255),
  anno INT,
  voto FLOAT,
  img VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE serie_tv_selezionate (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  serie_id VARCHAR(255),
  user_id INT,
  titolo VARCHAR(255),
  anno INT,
  voto FLOAT,
  img VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
