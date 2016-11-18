create database BD_telegram;

use BD_telegram;

CREATE TABLE BD_resposta (
    id BIGINT,
    nome VARCHAR(50),
    mensagem VARCHAR(400),
    Data DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (id)
);


select * from BD_resposta;

