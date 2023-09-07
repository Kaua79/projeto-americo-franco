CREATE DATABASE IF NOT EXISTS americofranco;

CREATE TABLE alunos(
    id int NOT NULL AUTO_INCREMENT,
    nome varchar (255) NOT NULL,
    cpf varchar (11) NOT NULL,
    telefone varchar(255) NOT NULL, 
    endereco varchar(255) NOT NULL,
    ra varchar(12),
    PRIMARY KEY(id)
);

CREATE TABLE imagem(
    id_imagem int NOT NULL AUTO_INCREMENT,
    nome_imagem varchar (255) NOT NULL,
    PRIMARY KEY(id_imagem)
);