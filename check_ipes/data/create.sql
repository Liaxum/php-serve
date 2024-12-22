/*CREATE DATABASE IF NOT EXISTS check_ipes;

USE check_ipes;*/

DROP TABLE IF EXISTS JoueurDansEquipe;
DROP TABLE IF EXISTS CapitaineDEquipe;
DROP TABLE IF EXISTS Equipe;
DROP TABLE IF EXISTS Joueur;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Ronde;
DROP TABLE IF EXISTS Competition;


CREATE TABLE Competition (id int(10) NOT NULL AUTO_INCREMENT,
                            nom varchar(30) DEFAULT NULL,
                            dateDebut date DEFAULT NULL,
                            dateFin date DEFAULT NULL,
                            PRIMARY KEY (id),
                            UNIQUE KEY id (id));

CREATE TABLE Ronde (id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    nRonde int(10) NOT NULL,
                    dateRonde varchar(50),
                    lieu varchar(100),
                    competitionID int(10) NOT NULL REFERENCES Competition (id),
                    estRondeCourante BOOLEAN,
                    niveau varchar(10) NOT NULL,
                    UNIQUE KEY UC_Ronde (nRonde,competitionID,niveau));


CREATE TABLE Equipe (id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     nom varchar(150) DEFAULT NULL,
                     idRonde int(10) DEFAULT NULL REFERENCES Ronde (id),
                     estValide BOOLEAN);

CREATE TABLE Joueur (id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                     nFFE varchar(10) DEFAULT NULL UNIQUE,
                     nom varchar(50) DEFAULT NULL,
                     elo int(10) DEFAULT NULL,
                     sexe char(1) DEFAULT NULL,
                     mute varchar(3) DEFAULT NULL,
                     info varchar(500) DEFAULT NULL);

CREATE TABLE Utilisateur (nom varchar(50) NOT NULL PRIMARY KEY,
                            motDePasse varchar(256) NOT NULL,
                            role varchar(20) DEFAULT NULL);

CREATE TABLE CapitaineDEquipe (idEquipe int(10) NOT NULL REFERENCES Equipe (id),
                               nomUtilisateur varchar(50) NOT NULL REFERENCES Utilisateur(nom),
                               PRIMARY KEY (idEquipe,nomUtilisateur));

CREATE TABLE JoueurDansEquipe (idJoueur int(10) NOT NULL REFERENCES Joueur (id),
                                 idEquipe int(10) NOT NULL REFERENCES Equipe (id),
                                 position int(10) NOT NULL,
                                 PRIMARY KEY (idJoueur,idEquipe));

insert into Utilisateur values ('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin');