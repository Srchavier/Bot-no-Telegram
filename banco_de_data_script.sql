create database BD_telegram;

use BD_telegram;

select * from BD_resposta;

CREATE TABLE BD_resposta (
    id BIGINT,
    nome VARCHAR(50),
    mens_rec VARCHAR(250),
    num_mega VARCHAR(30),
    num_lotf varchar(25),
    Data DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (id)
);
