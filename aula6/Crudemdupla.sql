CREATE DATABASE escola;

USE escola;

CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE diaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hora_aula DECIMAL(5,2) DEFAULT 0
);

CREATE TABLE aulas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sala VARCHAR(50),
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);
