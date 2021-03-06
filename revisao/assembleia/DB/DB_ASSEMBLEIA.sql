CREATE DATABASE IF NOT EXISTS DB_ASSEMBLEIA;

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_BLOCOS(
	PK_BLO TINYINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
    BLO_NOME VARCHAR(10),
    BLO_APELIDO VARCHAR(10) NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_BLO),
    CONSTRAINT UK_BLO_NOME UNIQUE KEY (BLO_NOME)
);

INSERT INTO TB_BLOCOS 
	(BLO_NOME, BLO_APELIDO)
VALUES 
	('TORRE 1', 'NICE'),
    ('TORRE 2', 'LYON');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_ADIMPLENTES(
	PK_ADI TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ADI_NOME VARCHAR(25) NOT NULL,
    ADI_IMAGEM VARCHAR(100),
    CONSTRAINT PRIMARY KEY(PK_ADI),
    CONSTRAINT UK_ADI_NOME UNIQUE KEY (ADI_NOME)
);

INSERT INTO TB_ADIMPLENTES
	(ADI_NOME)
VALUES
	('LIBERADO'),
    ('BLOQUEADO');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_PERFIS(
	PK_PER SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PER_NOME VARCHAR(25) NOT NULL,
	CONSTRAINT PRIMARY KEY(PK_PER),
    CONSTRAINT UK_PER_NOME UNIQUE KEY(PER_NOME)
);

INSERT INTO TB_PERFIS 
	(PER_NOME) 
VALUES 
	('ROOT'),
    ('ADMINISTRADOR'),
    ('SINDICO'),
    ('USUARIO');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_SITUACAO(
	PK_SIT TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    SIT_NOME VARCHAR(25) NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_SIT),
    CONSTRAINT UK_SIT_NOME UNIQUE KEY(SIT_NOME)
);

INSERT INTO TB_SITUACAO
	(SIT_NOME) 
VALUES 
    ('ATIVO'),
    ('INATIVO');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_MORADORES(
	PK_MOR INT UNSIGNED NOT NULL AUTO_INCREMENT,
    MOR_NOME VARCHAR(100) NOT NULL,
    MOR_CPF VARCHAR(11) NOT NULL,
    MOR_LOGIN VARCHAR(50) NOT NULL,
    MOR_SENHA VARCHAR(25) NOT NULL,
    FK_MOR_SIT TINYINT UNSIGNED NOT NULL,
    FK_MOR_PER SMALLINT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_MOR, MOR_CPF),
    CONSTRAINT UK_MOR_CPF UNIQUE KEY(MORtb_pautas_opcoes_respostastb_pautas_opcoes_respostas_CPF),
    CONSTRAINT UK_MOR_LOGIN UNIQUE KEY(MOR_LOGIN),
    CONSTRAINT FK_SIT_MOR FOREIGN KEY(FK_MOR_SIT) REFERENCES TB_SITUACAO(PK_SIT),
    CONSTRAINT FK_PER_MOR FOREIGN KEY(FK_MOR_PER) REFERENCES TB_PERFIS(PK_PER)
);

INSERT INTO TB_MORADORES 
	(MOR_NOME, MOR_CPF, MOR_LOGIN, MOR_SENHA, FK_MOR_SIT, FK_MOR_PER) 
VALUES 
    ('CARLA AGUIAR FALCAO', '11111111111', 'CAF', '111', 1, 1),
    ('MARIA DA CONCEIÇÃO AGUIAR', '22222222222', 'MCA', '222', 1, 2),
    ('GEORGE ANDERSON', '33333333333', 'GA', '333', 2, 4),
    ('GEORGE WANDEMOND', '44444444444', 'GW', '444', 1, 4);

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_OCUPACAO(
	PK_OCU TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    OCU_NOME VARCHAR(25) NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_OCU),
    CONSTRAINT UK_OCU_NOME UNIQUE KEY(OCU_NOME)
);

INSERT INTO TB_OCUPACAO
	(OCU_NOME) 
VALUES 
    ('OCUPADO'),
    ('LIVRE');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_APARTAMENTOS(
	PK_APA SMALLINT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
    APA_NOME SMALLINT(4) ZEROFILL NOT NULL,
    FK_APA_OCU TINYINT UNSIGNED NOT NULL,
    FK_APA_BLO TINYINT UNSIGNED NOT NULL,
    FK_APA_ADI TINYINT UNSIGNED NOT NULL,
--   FK_APA_MOR 	INT UNSIGNED,
    CONSTRAINT PRIMARY KEY(PK_APA),
    CONSTRAINT FK_BLO_APA FOREIGN KEY(FK_APA_BLO) REFERENCES TB_BLOCOS(PK_BLO),
--    CONSTRAINT FK_MOR_APA FOREIGN KEY(FK_APA_MOR) REFERENCES TB_MORADORES(PK_MOR),
    CONSTRAINT FK_OCU_APA FOREIGN KEY(FK_APA_OCU) REFERENCES TB_OCUPACAO(PK_OCU),
    CONSTRAINT FK_ADI_APA FOREIGN KEY(FK_APA_ADI) REFERENCES TB_ADIMPLENTES(PK_ADI)
);

INSERT INTO TB_APARTAMENTOS 
	(FK_APA_BLO, APA_NOME, FK_APA_OCU,FK_APA_ADI) 
VALUES 
	(1, 001, 1, 1), (1, 002, 1, 1), (1, 003, 1, 2),
	(1, 101, 1, 1), (1, 102, 2, 1), (1, 103, 2, 1), (1, 104, 2, 1), (1, 105, 2, 1), (1, 106, 2, 1),
	(1, 201, 2, 1), (1, 202, 2, 1), (1, 203, 2, 1), (1, 204, 2, 1), (1, 205, 2, 1), (1, 206, 2, 1),
	(1, 301, 2, 1), (1, 302, 2, 1), (1, 303, 2, 1), (1, 304, 2, 1), (1, 305, 2, 1), (1, 306, 2, 1),
	(1, 401, 2, 1), (1, 402, 2, 1), (1, 403, 2, 1), (1, 404, 2, 1), (1, 405, 2, 1), (1, 406, 2, 1),
	(1, 501, 2, 1), (1, 502, 2, 1), (1, 503, 2, 1), (1, 504, 2, 1), (1, 505, 2, 1), (1, 506, 2, 1),
	(1, 601, 2, 1), (1, 602, 2, 1), (1, 603, 2, 1), (1, 604, 2, 1), (1, 605, 2, 1), (1, 606, 2, 1),
	(1, 701, 2, 1), (1, 702, 2, 1), (1, 703, 2, 1), (1, 704, 2, 1), (1, 705, 2, 1), (1, 706, 2, 1),
	(1, 801, 2, 1), (1, 802, 2, 1), (1, 803, 2, 1), (1, 804, 2, 1), (1, 805, 2, 1), (1, 806, 2, 1),
	(1, 901, 2, 1), (1, 902, 2, 1), (1, 903, 2, 1), (1, 904, 2, 1), (1, 905, 2, 1), (1, 906, 2, 1),
	(1, 1001, 2, 1), (1, 1002, 2, 1), (1, 1003, 2, 1), (1, 1004, 2, 1), (1, 1005, 2, 1), (1, 1006, 2, 1),
	(1, 1101, 2, 1), (1, 1102, 2, 1), (1, 1103, 2, 1), (1, 1104, 2, 1), (1, 1105, 2, 1), (1, 1106, 2, 1),
	(1, 1201, 2, 1), (1, 1202, 2, 1), (1, 1203, 2, 1), (1, 1204, 2, 1), (1, 1205, 2, 1), (1, 1206, 2, 1),
	(1, 1301, 2, 1), (1, 1302, 2, 1), (1, 1303, 2, 1), (1, 1304, 2, 1), (1, 1305, 2, 1), (1, 1306, 2, 1),
	(1, 1401, 2, 1), (1, 1402, 2, 1), (1, 1403, 2, 1), (1, 1404, 2, 1), (1, 1405, 2, 1), (1, 1406, 2, 1),
	(1, 1501, 2, 1), (1, 1502, 2, 1), (1, 1503, 2, 1), (1, 1504, 2, 1), (1, 1505, 2, 1), (1, 1506, 2, 1),
	(1, 1601, 2, 1), (1, 1602, 2, 1), (1, 1603, 2, 1), (1, 1604, 2, 1), (1, 1605, 2, 1), (1, 1606, 2, 1),
	(1, 1701, 2, 1), (1, 1702, 2, 1), (1, 1703, 2, 1), (1, 1704, 2, 1), (1, 1705, 2, 1), (1, 1706, 2, 1),
	(1, 1801, 2, 1), (1, 1802, 2, 1), (1, 1803, 2, 1), (1, 1804, 2, 1), (1, 1805, 2, 1), (1, 1806, 2, 1),
	(1, 1901, 2, 1), (1, 1902, 2, 1), (1, 1903, 2, 1), (1, 1904, 2, 1), (1, 1905, 2, 1), (1, 1906, 2, 1),
	(1, 2001, 2, 1), (1, 2002, 2, 1), (1, 2003, 2, 1), (1, 2004, 2, 1), (1, 2005, 2, 1), (1, 2006, 2, 1),
	(2, 001, 2, 1), (2, 002, 2, 1), (2, 003, 2, 1),
	(2, 101, 2, 1), (2, 102, 2, 1), (2, 103, 2, 1), (2, 104, 2, 1), (2, 105, 2, 1), (2, 106, 2, 1),
	(2, 201, 2, 1), (2, 202, 2, 1), (2, 203, 2, 2), (2, 204, 2, 1), (2, 205, 2, 1), (2, 206, 2, 1),
	(2, 301, 2, 2), (2, 302, 2, 1), (2, 303, 2, 1), (2, 304, 2, 1), (2, 305, 2, 1), (2, 306, 2, 1),
	(2, 401, 2, 2), (2, 402, 2, 1), (2, 403, 2, 1), (2, 404, 2, 1), (2, 405, 2, 1), (2, 406, 2, 1),
	(2, 501, 2, 2), (2, 502, 2, 1), (2, 503, 2, 1), (2, 504, 2, 1), (2, 505, 2, 1), (2, 506, 2, 1),
	(2, 601, 2, 1), (2, 602, 2, 1), (2, 603, 2, 1), (2, 604, 2, 1), (2, 605, 2, 1), (2, 606, 2, 1),
	(2, 701, 2, 1), (2, 702, 2, 1), (2, 703, 2, 1), (2, 704, 2, 1), (2, 705, 2, 1), (2, 706, 2, 1),
	(2, 801, 2, 1), (2, 802, 2, 2), (2, 803, 2, 1), (2, 804, 2, 1), (2, 805, 2, 1), (2, 806, 2, 1),
	(2, 901, 2, 2), (2, 902, 2, 1), (2, 903, 2, 1), (2, 904, 2, 1), (2, 905, 2, 1), (2, 906, 2, 1),
	(2, 1001, 2, 1), (2, 1002, 2, 1), (2, 1003, 2, 1), (2, 1004, 2, 1), (2, 1005, 2, 1), (2, 1006, 2, 1),
	(2, 1101, 2, 1), (2, 1102, 2, 1), (2, 1103, 2, 1), (2, 1104, 2, 1), (2, 1105, 2, 1), (2, 1106, 2, 1),
	(2, 1201, 2, 1), (2, 1202, 2, 1), (2, 1203, 2, 1), (2, 1204, 2, 1), (2, 1205, 2, 1), (2, 1206, 2, 1),
	(2, 1301, 2, 1), (2, 1302, 2, 1), (2, 1303, 2, 1), (2, 1304, 2, 1), (2, 1305, 2, 1), (2, 1306, 2, 1),
	(2, 1401, 2, 1), (2, 1402, 2, 1), (2, 1403, 2, 1), (2, 1404, 2, 1), (2, 1405, 2, 1), (2, 1406, 2, 1),
	(2, 1501, 2, 1), (2, 1502, 2, 1), (2, 1503, 2, 1), (2, 1504, 2, 1), (2, 1505, 2, 1), (2, 1506, 2, 1),
	(2, 1601, 2, 1), (2, 1602, 2, 1), (2, 1603, 2, 1), (2, 1604, 2, 1), (2, 1605, 2, 1), (2, 1606, 2, 1),
	(2, 1701, 2, 1), (2, 1702, 2, 1), (2, 1703, 2, 1), (2, 1704, 2, 1), (2, 1705, 2, 1), (2, 1706, 2, 1),
	(2, 1801, 2, 1), (2, 1802, 2, 1), (2, 1803, 2, 1), (2, 1804, 2, 1), (2, 1805, 2, 1), (2, 1806, 2, 1),
	(2, 1901, 2, 1), (2, 1902, 2, 1), (2, 1903, 2, 1), (2, 1904, 2, 1), (2, 1905, 2, 1), (2, 1906, 2, 1);
    /*(2, 2001, 1), (2, 2002, 1), (2, 2003, 1), (2, 2004, 1), (2, 2005, 1), (2, 2006, 1);*/
    

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_TIPOS_ASSEMBLEIAS(
	PK_TDA TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    TDA_NOME VARCHAR(25) NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_TDA),
    CONSTRAINT UK_TDA_NOME UNIQUE KEY(TDA_NOME)
);

INSERT INTO TB_TIPOS_ASSEMBLEIAS 
	(TDA_NOME) 
VALUES 
	('ORDINÁRIA'),
    ('EXTRAORDINÁRIA');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_ASSEMBLEIAS(
	PK_ASS INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ASS_NOME VARCHAR(100) NOT NULL,
    ASS_DATA DATE NOT NULL,
    FK_ASS_TDA TINYINT UNSIGNED NOT NULL, 
    CONSTRAINT PRIMARY KEY(PK_ASS),    
    CONSTRAINT UK_ASS_DATA UNIQUE KEY(ASS_DATA),
    CONSTRAINT FK_TDA_ASS FOREIGN KEY(FK_ASS_TDA) REFERENCES TB_TIPOS_ASSEMBLEIAS(PK_TDA)
);

INSERT INTO TB_ASSEMBLEIAS 
	(ASS_NOME, ASS_DATA, FK_ASS_TDA) 
VALUES 
	('ASSEMBLEIA EXTRAORDINÁRIA DO ANO DE 2018', '2018-04-18', 2),
    ('ASSEMBLEIA ORDINÁRIA SEGUNDO TRIMESTRE', '2018-06-20', 1),
    ('ASSEMBLEIA ORDINÁRIA TERCEIRO TRIMESTRE', '2018-09-10', 1);
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_LISTAS_PARTICIPANTES(
	PK_LDP INT UNSIGNED NOT NULL AUTO_INCREMENT,
    LDP_DISPOSITIVO_ACESSO VARCHAR(100),
    FK_LDP_ASS INT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_LDP),
    CONSTRAINT FK_ASS_LDP FOREIGN KEY(FK_LDP_ASS) REFERENCES TB_ASSEMBLEIAS(PK_ASS)
);

INSERT INTO TB_LISTAS_PARTICIPANTES 
	(FK_LDP_ASS, LDP_DISPOSITIVO_ACESSO) 
VALUES 
	(1, 'IOS'),
    (1, 'ANDROID'),
    (1, 'ANDROID'),
    (2, 'ANDROID'),
    (2, 'IOS'),
    (2, 'ANDROID');  
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_SINDICOS(
	PK_SIN SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    SIN_DATA_INICIO DATE,
    SIN_DATA_FIM DATE,
    FK_SIN_MOR INT UNSIGNED,
    CONSTRAINT PRIMARY KEY(PK_SIN),
    CONSTRAINT FK_MOR_SIN FOREIGN KEY(FK_SIN_MOR) REFERENCES TB_MORADORES(PK_MOR)
);

INSERT INTO TB_SINDICOS 
	(FK_SIN_MOR) 
VALUES 
	(1),
    (2);

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_MORADORES_ASSEMBLEIAS(
	FK_MDA_MOR INT UNSIGNED NOT NULL,
    FK_MDA_ASS INT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_MDA_MOR, FK_MDA_ASS),
    CONSTRAINT FK_MOR_MDA FOREIGN KEY(FK_MDA_MOR) REFERENCES TB_MORADORES(PK_MOR),
    CONSTRAINT FK_ASS_MDA FOREIGN KEY(FK_MDA_ASS) REFERENCES TB_ASSEMBLEIAS(PK_ASS)
);

INSERT INTO TB_MORADORES_ASSEMBLEIAS 
	(FK_MDA_MOR, FK_MDA_ASS) 
VALUES 
	(1,1),(1,2),(1,3),
    (2,1),(2,2),(2,3),
    (3,1),(3,2),(3,3),
    (4,1),(4,2),(4,3);
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_EMAILS_MORADORES(
	FK_EDM_MOR INT UNSIGNED NOT NULL,
    EDM_EMAIL VARCHAR(100) NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_EDM_MOR, EDM_EMAIL),
    CONSTRAINT FK_MOR_EDM FOREIGN KEY(FK_EDM_MOR) REFERENCES TB_MORADORES(PK_MOR)
);

INSERT INTO TB_EMAILS_MORADORES 
	(FK_EDM_MOR, EDM_EMAIL) 
VALUES 
    (1, 'carla.falcao@gmail.com'),
    (2, 'concita.aguar@bol.com'),
    (3, 'george.anderson@gmail.com'),
    (4, 'george@gmail.com');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_FONE_MORADORES(
	FK_FDM_MOR INT UNSIGNED NOT NULL,
    FDM_FONE VARCHAR(12) NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_FDM_MOR, FDM_FONE),
    CONSTRAINT FK_MOR_FDM FOREIGN KEY(FK_FDM_MOR) REFERENCES TB_MORADORES(PK_MOR)
);

INSERT INTO TB_FONE_MORADORES 
	(FK_FDM_MOR, FDM_FONE) 
VALUES 
    (1, '84999215689'),
    (2, '84123456789'),
    (3, '84222222222'),
    (4, '84333333333');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_DEPENDENTES(
	PK_DEP SMALLINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
    DEP_NOME VARCHAR(100) NOT NULL,
    DEP_CPF VARCHAR(11),
    CONSTRAINT PRIMARY KEY(PK_DEP)
);

INSERT INTO TB_DEPENDENTES 
	(DEP_NOME) 
VALUES 
	('FABIANO FAUSTINO DE OLIVEIRA'),
	('MARIA CLARA FALCÃO FAUSTINO'),
    ('MARIA LUA');

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_DEPENDENTES_MORADORES(
	FK_DDM_DEP SMALLINT UNSIGNED ZEROFILL NOT NULL,
    FK_DDM_MOR INT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_DDM_DEP, FK_DDM_MOR),
    CONSTRAINT FK_DEP_DDM FOREIGN KEY(FK_DDM_DEP) REFERENCES TB_DEPENDENTES(PK_DEP),
    CONSTRAINT FK_MOR_DDM FOREIGN KEY(FK_DDM_MOR) REFERENCES TB_MORADORES(PK_MOR)
);

INSERT INTO TB_DEPENDENTES_MORADORES 
	(FK_DDM_DEP, FK_DDM_MOR) 
VALUES 
	(1,1),
    (2,1),
    (3,4);

USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_FONES_DEPENDENTES(
	FK_FDD_DEP SMALLINT UNSIGNED NOT NULL,
    FDD_FONE VARCHAR(12) NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_FDD_DEP, FDD_FONE),
    CONSTRAINT FK_DEP_FDD FOREIGN KEY(FK_FDD_DEP) REFERENCES TB_DEPENDENTES(PK_DEP)
);

INSERT INTO TB_FONES_DEPENDENTES 
	(FK_FDD_DEP, FDD_FONE) 
VALUES 
	(1, '84991143397'),
    (2, '84555555555'),
    (3, '84147258369');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_EMAILS_DEPENDENTES(
	FK_EDD_DEP SMALLINT UNSIGNED NOT NULL,
    FDD_EMAILS VARCHAR(100) NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_EDD_DEP, FDD_EMAILS),
    CONSTRAINT FK_DEP_EDD FOREIGN KEY(FK_EDD_DEP) REFERENCES TB_DEPENDENTES(PK_DEP)
);

INSERT INTO TB_EMAILS_DEPENDENTES 
	(FK_EDD_DEP, FDD_EMAILS) 
VALUES 
	(1, 'ffo13@hotmail.com'),
    (2, 'maria.clara@gmail.com'),
    (3, 'maria.lua@gmail.com');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_APARTAMENTOS_MORADORES(
	PK_ADM INT UNSIGNED NOT NULL AUTO_INCREMENT,
    FK_ADM_APA SMALLINT UNSIGNED NOT NULL,
    FK_ADM_MOR INT UNSIGNED NOT NULL,
    ADM_DATA DATETIME,
    CONSTRAINT PRIMARY KEY(PK_ADM, FK_ADM_MOR, FK_ADM_APA),
    CONSTRAINT FK_APA_ADM FOREIGN KEY(FK_ADM_APA) REFERENCES TB_APARTAMENTOS(PK_APA),
    CONSTRAINT FK_MOR_ADM FOREIGN KEY(FK_ADM_MOR) REFERENCES TB_MORADORES(PK_MOR)
);

INSERT INTO TB_APARTAMENTOS_MORADORES 
	(FK_ADM_APA, FK_ADM_MOR) 
VALUES 
	(1,1),
    (2,2),
    (3,3),
    (4,4);
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_PAUTAS(
	PK_PAU INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PAU_NOME VARCHAR(100) NOT NULL,
    PAU_DESCRICAO VARCHAR(1000),
    PAU_STATUS BOOLEAN,
    PAU_VOTOS INT UNSIGNED,
    FK_PAU_ASS INT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(PK_PAU), 
    CONSTRAINT FK_ASS_PAU FOREIGN KEY(FK_PAU_ASS) REFERENCES TB_ASSEMBLEIAS(PK_ASS)
);

INSERT INTO TB_PAUTAS 
	(PAU_NOME, FK_PAU_ASS) 
VALUES 
	('CANCELAR AS ASSINATURAS DE TV DAS ÁREAS COMUNS',1),
    ('AUMENTO DA TAXA DE CONDOMÍNIO',1),
    ('TAXA EXTRA PARA AMPLIAÇÃO DA ACADEMIA',2),
    ('COMPRA DE LIXEIRAS PARA OS HALLS',3);
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_OPCOES_RESPOSTAS(
	PK_ODR TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ODR_NOME VARCHAR(25) NOT NULL,
    ODR_IMAGEM VARCHAR(100),
    CONSTRAINT PRIMARY KEY(PK_ODR),
    CONSTRAINT UK_ODR_NOME UNIQUE KEY(ODR_NOME)
);
    
INSERT INTO TB_OPCOES_RESPOSTAS 
	(ODR_NOME) 
VALUES 
	('SIM'),
    ('NÃO'),
    ('ABSTENÇÃO');
    
USE DB_ASSEMBLEIA;

CREATE TABLE IF NOT EXISTS TB_PAUTAS_OPCOES_RESPOSTAS(
    FK_POR_MOR INT UNSIGNED NOT NULL,
    FK_POR_PAU INT UNSIGNED NOT NULL,
    FK_POR_ODR TINYINT UNSIGNED NOT NULL,
    CONSTRAINT PRIMARY KEY(FK_POR_MOR, FK_POR_PAU, FK_POR_ODR),
	CONSTRAINT FK_MOR_POR FOREIGN KEY(FK_POR_MOR) REFERENCES TB_MORADORES(PK_MOR),
    CONSTRAINT FK_PAU_POR FOREIGN KEY(FK_POR_PAU) REFERENCES TB_PAUTAS(PK_PAU),
    CONSTRAINT FK_ODR_POR FOREIGN KEY(FK_POR_ODR) REFERENCES TB_OPCOES_RESPOSTAS(PK_ODR)
);

INSERT INTO TB_PAUTAS_OPCOES_RESPOSTAS 
	(FK_POR_MOR, FK_POR_PAU, FK_POR_ODR) 
VALUES 
	(1,1,1), (1,2,2), (1,3,2), (1,4,1),
    (2,1,3), (2,2,1), (2,3,3), (2,4,1),
    (3,1,2), (3,2,1), (3,3,1), (3,4,1),
    (4,1,1), (4,2,1), (4,3,1), (4,4,1);