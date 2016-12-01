

create database Scrip_telegram;

use Scrip_telegram;

select * from BD_resposta;

CREATE TABLE BD_resposta (
    id BIGINT ,
    nome VARCHAR(50),
    mens_comd VARCHAR(250),
    num_mega VARCHAR(30),
    num_quin varchar(25),
    Dat_resp timestamp default current_timestamp,
    PRIMARY KEY (id)
);
drop table BD_resposta;

/* Data DATETIME NOT NULL DEFAULT NOW(),*/