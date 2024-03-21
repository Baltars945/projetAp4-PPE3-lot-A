-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: AP3Bdd
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES (1,1,'vélo template',5,'vélo template','TEMCYC123456789123','template'),(2,1,'Vélo électrique ',35,'Un vélo électrique ','VELCYC123456789123','Vélobuilder'),(3,1,'Vélo Rouge',15,'Un vélo qui a la couleur rouge ','VELCYC323073375439','Vélobuilder'),(4,1,'Vélo Vert ',35,'Un vélo qui a la couleur Verte','VELCYC355554456662','Vélobuilder'),(5,1,'Vélo Violet',40.5,'Un vélo qui a la couleur Violette ','VELCYC517089477224','Vélobuilder'),(6,1,'Vélo Jaune',0.54,'Un vélo qui a la couleur jaune','VELCYC163768752119','Velaubuilder'),(7,2,'Gant Bleu',10.35,'Une paire de gant de boxe de couleur bleu','PUNBOX123456789123','PUNCHOUT'),(8,2,'Gant Rouge',10.35,'Une paire de gant de boxe rouge','PUNBOX358706890401','PUNCHOUT'),(9,2,'Gant Noir',12.35,'Une paire de gant de couleur noire','PUNBOX202518300583','PUNCHOUT'),(10,2,'Little Mac',14.99,'Une paire de gant de boxe de couleur verte, c\'est une référence à un personnage célébre','PUNBOX854326571366','PUNCHOUT'),(11,2,'Protège dent',5,'Un protège dent','SUPBOX350697068628','SUPLEX'),(12,2,'Sous-gant',8.52,'Une paire de sous gant ','PUNBOX731837389111','PUNCHOUT'),(13,3,'Volant',1,'Un volant de badminto','WIIBAD523023210973','WIISPORT'),(14,3,'Raquette',14,'Une raquette de badminton','WIIBAD502278783348','WIISPORT'),(15,4,'Chaussure Noire ',40,'Une paire de chassure noires=','2FACOU849329674704','2FAST4YU'),(16,5,'Poids 5 kg',15,'Un poids de musculation de 5 Kilograme ','HEMMUS580074968599','HEMAN'),(17,5,'Poids 10 kg',20,'Un poids de musculation de 10 kilogramme','HEMMUS756802203063','HEMAN'),(18,5,'Poids 15 kg',30,'Un poids de musculation de 15 kilogramme ','HEMMUS289325211985','HEMAN'),(19,5,'Poids 20 kg',40,'Un poids de 40 kilogramme ','HEMMUS450006027234','HEMAN'),(20,6,'Club de golf ',145,'Un club de golf','GOLGOL604451420922','GOLFCOMPANY'),(21,6,'Balle de golf',1.68,'Une balle de golf ','GOLGOL597570253711','GOLFCOMPANY'),(22,6,'Gants de golf ',19.99,'Une paire de gant de golf ','GOLGOL961965595080','GOLFCOMPANY'),(23,6,'Sac de golf ',70,'Un sac de golf pour stocker les clubs de golf ','GOLGOL606493813464','GOLFCOMPANY');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-19 13:34:20
