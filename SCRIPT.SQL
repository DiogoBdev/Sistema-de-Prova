CREATE DATABASE Sistema;

USE Sistema;

-- Tabela de usuários (professores e alunos)
CREATE TABLE Usuarios (
    id INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('professor', 'aluno') NOT NULL
);

-- Tabela de provas
CREATE TABLE Provas (
    id INT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_inicio DATETIME NOT NULL,
    data_fim DATETIME NOT NULL,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES Usuarios(id)
);

-- Tabela de questões
CREATE TABLE Questoes (
    id INT PRIMARY KEY,
    enunciado TEXT NOT NULL,
    peso DECIMAL(5, 2) NOT NULL,
    prova_id INT,
    FOREIGN KEY (prova_id) REFERENCES Provas(id)
);

-- Tabela de alternativas
CREATE TABLE Alternativas (
    id INT PRIMARY KEY,
    texto TEXT NOT NULL,
    correta BOOLEAN NOT NULL,
    questao_id INT,
    FOREIGN KEY (questao_id) REFERENCES Questoes(id)
);

-- Tabela de respostas dos alunos
CREATE TABLE Respostas (
    id INT PRIMARY KEY,
    aluno_id INT,
    prova_id INT,
    questao_id INT,
    alternativa_id INT,
    FOREIGN KEY (aluno_id) REFERENCES Usuarios(id),
    FOREIGN KEY (prova_id) REFERENCES Provas(id),
    FOREIGN KEY (questao_id) REFERENCES Questoes(id),
    FOREIGN KEY (alternativa_id) REFERENCES Alternativas(id)
);

delete from
    usuarios;

INSERT INTO
    usuarios (nome, email, senha, tipo)
VALUES
    (
        'Professor João',
        'joao@email.com',
        'senha123',
        'professor'
    ),
    (
        'Aluno Maria',
        'maria@email.com',
        'senha456',
        'aluno'
    ),
    (
        'Professor Ana',
        'ana@email.com',
        'senha789',
        'professor'
    ),
    (
        'Aluno Pedro',
        'pedro@email.com',
        'senhaabc',
        'aluno'
    ),
    (
        'Professor Carla',
        'carla@email.com',
        'senhaxyz',
        'professor'
    );

select
    *
from
    usuarios;