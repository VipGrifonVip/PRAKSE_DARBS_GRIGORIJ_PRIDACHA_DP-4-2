CREATE DATABASE Kursac;
USE Kursac;

CREATE TABLE Users(
	Vards VARCHAR(25) NOT NULL,
	Uzvards VARCHAR(25) NOT NULL,
	Dimums VARCHAR(25) NOT NULL,
	Vecums INT(3) NOT NULL,
	Email VARCHAR(100) NOT NULL,
	Parole VARCHAR(255) NOT NULL,
	Roole  Varchar(25) NOT NULL,
	SP_ID INT(15) AUTO_INCREMENT,
	PRIMARY KEY( SP_ID)
);

CREATE TABLE Disciplina(
	Nosaukums VARCHAR(4) NOT NULL,
	savenuserijas INT(2) NOT NULL,
	Attalums INT(3) NOT NULL,
	Laiks TIME NOT NULL,
	Ierocu_tips VARCHAR(25) NOT NULL,
	PRIMARY KEY (Nosaukums)
);


CREATE TABLE sporta_klase(
	Sporta_klases VARCHAR(4) NOT NULL,  
	Rezultats INT(15) NOT NULL,
	Nosaukums VARCHAR(15) NOT NULL,
	FOREIGN KEY (Nosaukums) REFERENCES Disciplina(Nosaukums)
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(255),
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PP60",6,10,"1:30:00","Pistole");
INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PŠ60",6,10,"1:30:00","Šautene");
INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PP40",4,10,"1:00:00","Pistole");
INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PŠ40",4,10,"1:00:00","Šautene");
INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PP20",2,10,"0:30:00","Pistole");
INSERT INTO Disciplina (Nosaukums, savenuserijas, Attalums, Laiks, Ierocu_tips) VALUES ("PŠ20",2,10,"0:30:00","Šautene");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SKSM",584,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SM",573,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SMK",559,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("1",545,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("2",510,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("3",490,"PP60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SKSM",384,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SM",378,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SMK",370,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("1",357,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("2",340,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("3",310,"PP40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SKSM",624,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SM",612,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SMK",602,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("1",578,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("2",554,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("3",532,"PŠ60");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SKSM",416,"PŠ40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SM",408,"PŠ40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("SMK",398,"PŠ40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("1",380,"PŠ40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("2",362,"PŠ40");
INSERT INTO sporta_klase (Sporta_klases, Rezultats, Nosaukums)VALUE ("3",343,"PŠ40");
INSERT INTO users(Vards,Uzvards,Dimums,Vecums,Email,Parole,Roole) VALUE ("Admin","Admin","Admin",2,"Admin@123","Admin","Admin");
