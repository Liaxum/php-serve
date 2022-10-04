-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: projet_S3
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CapitaineDEquipe`
--

DROP TABLE IF EXISTS `CapitaineDEquipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CapitaineDEquipe` (
  `idEquipe` int(10) NOT NULL,
  `nomUtilisateur` varchar(20) NOT NULL,
  PRIMARY KEY (`idEquipe`,`nomUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CapitaineDEquipe`
--

LOCK TABLES `CapitaineDEquipe` WRITE;
/*!40000 ALTER TABLE `CapitaineDEquipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `CapitaineDEquipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Competition`
--

DROP TABLE IF EXISTS `Competition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Competition` (
  `id` int(5) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `lieu` varchar(20) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateDin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Competition`
--

LOCK TABLES `Competition` WRITE;
/*!40000 ALTER TABLE `Competition` DISABLE KEYS */;
/*!40000 ALTER TABLE `Competition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipe`
--

DROP TABLE IF EXISTS `Equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipe` (
  `nom` int(10) NOT NULL,
  `joueurID` int(5) DEFAULT NULL,
  `nRonde` int(2) DEFAULT NULL,
  `competitionID` int(5) DEFAULT NULL,
  `niveauIntitule` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`nom`),
  KEY `nRonde` (`nRonde`,`competitionID`,`niveauIntitule`),
  CONSTRAINT `Equipe_ibfk_1` FOREIGN KEY (`nRonde`, `competitionID`, `niveauIntitule`) REFERENCES `Ronde` (`nRonde`, `competitionID`, `niveauIntitule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipe`
--

LOCK TABLES `Equipe` WRITE;
/*!40000 ALTER TABLE `Equipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `Equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Joueur`
--

DROP TABLE IF EXISTS `Joueur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Joueur` (
  `id` int(5) NOT NULL,
  `nFFE` varchar(10) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `elo` int(4) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `mute` varchar(1) DEFAULT NULL,
  `nomEquipe` int(10) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `nFFE` (`nFFE`),
  KEY `nomEquipe` (`nomEquipe`),
  CONSTRAINT `Joueur_ibfk_1` FOREIGN KEY (`nomEquipe`) REFERENCES `Equipe` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Joueur`
--

LOCK TABLES `Joueur` WRITE;
/*!40000 ALTER TABLE `Joueur` DISABLE KEYS */;
/*!40000 ALTER TABLE `Joueur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `JoueurDansEquipe`
--

DROP TABLE IF EXISTS `JoueurDansEquipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JoueurDansEquipe` (
  `idCompetition` int(10) NOT NULL,
  `idEquipe` int(10) NOT NULL,
  PRIMARY KEY (`idCompetition`,`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JoueurDansEquipe`
--

LOCK TABLES `JoueurDansEquipe` WRITE;
/*!40000 ALTER TABLE `JoueurDansEquipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `JoueurDansEquipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Niveau`
--

DROP TABLE IF EXISTS `Niveau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Niveau` (
  `intitule` varchar(5) NOT NULL,
  PRIMARY KEY (`intitule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Niveau`
--

LOCK TABLES `Niveau` WRITE;
/*!40000 ALTER TABLE `Niveau` DISABLE KEYS */;
/*!40000 ALTER TABLE `Niveau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ronde`
--

DROP TABLE IF EXISTS `Ronde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ronde` (
  `nRonde` int(2) NOT NULL,
  `competitionID` int(5) NOT NULL,
  `niveauIntitule` varchar(5) NOT NULL,
  PRIMARY KEY (`nRonde`,`competitionID`,`niveauIntitule`),
  KEY `competitionID` (`competitionID`),
  KEY `niveauIntitule` (`niveauIntitule`),
  CONSTRAINT `Ronde_ibfk_1` FOREIGN KEY (`competitionID`) REFERENCES `Competition` (`id`),
  CONSTRAINT `Ronde_ibfk_2` FOREIGN KEY (`niveauIntitule`) REFERENCES `Niveau` (`intitule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ronde`
--

LOCK TABLES `Ronde` WRITE;
/*!40000 ALTER TABLE `Ronde` DISABLE KEYS */;
/*!40000 ALTER TABLE `Ronde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilisateur`
--

DROP TABLE IF EXISTS `Utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Utilisateur` (
  `nom` varchar(20) NOT NULL,
  `motDePasse` varchar(256) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `nomEquipe` int(10) DEFAULT NULL,
  PRIMARY KEY (`nom`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilisateur`
--

LOCK TABLES `Utilisateur` WRITE;
/*!40000 ALTER TABLE `Utilisateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `Utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-13 15:50:56
