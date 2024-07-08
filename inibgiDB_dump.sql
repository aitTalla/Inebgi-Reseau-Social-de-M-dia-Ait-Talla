-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: inebgiDB
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- creating user `admin`
--

CREATE USER "admin"@"127.0.0.1" IDENTIFIED BY "admin";


--
-- creating database `inibgiDB`
--
DROP DATABASE inebgiDB;
CREATE database inebgiDB;
use inebgiDB;

GRANT ALL ON inebgiDB.* TO "admin"@'127.0.0.1';

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `dateUploade` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `commentsToken` text DEFAULT NULL,
  `covers` text DEFAULT NULL,
  `likeLen` int(11) DEFAULT NULL,
  `commentLen` int(11) DEFAULT NULL,
  `likesUsers` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(59,'agelid','2022-07-15 12:28:32','Azul Fellawen !','Tpom4IWGRUP0mXtQfNN3xF1fSd5XzQJK','',2,0,'bot , agelid , admin , ',NULL),
(60,'agelid','2022-07-15 12:29:06','Walit achal tecbah la photo-agi.','q1G8XjA/Ya5gL9fsYnkwlr/guiRdNaWv','icon.png',3,0,'bot , agelid , inebgi_bot , admin , ',NULL),
(61,'leptis_magnet','2022-07-15 17:29:52','Im The Authors Of This Web !','Cz+TwnwSuMf5inDFLxHIuee3leNOPhDD','',1,0,'bot , admin , ',NULL),
(62,'admin','2022-07-17 12:10:18','Hello World !','J/yCdu4yWguzG8Ui3vkmH7CST6u7z0M7','banner2048x1152.png',1,0,'bot , admin , ',NULL),
(63,'admin','2022-07-17 12:11:18','','D/izRLO+g2kvoZ/zuemMYp08ZviEhc6O','icon.png',1,0,'bot , admin , ',NULL),
(64,'admin','2024-07-08 07:53:12','AIT TALLA Is Securised No XSS Attack\n&lt;script&gt;alert(&quot;HACKED !!!&quot;)&lt;/script&gt;','QcQOCtvql01IYeLFnhiR+pvCLVRAircb','',1,0,'bot , admin , ',NULL),
(65,'admin','2024-07-08 07:54:43','Bonjour tout le monde ! Voici ma première vidéo de vlog, j&#039;espère que vous allez aimer !','loHbz2K+ZDWIr8xzalRLC+90TfXYwWLb','',1,0,'bot , admin , ',NULL),
(66,'admin','2024-07-08 07:54:56','Quel est votre plat préféré ? Le mien, c&#039;est sans aucun doute les sushis ! 🍣','rVg2VaxXj9B0+X1E6HRaGfiBD0YZP8At','',0,0,'bot , ',NULL),
(67,'admin','2024-07-08 07:55:08','Avez-vous des recommandations de livres passionnants à lire ce mois-ci ? 📚','BbgMn+Hxtxo5getS1WBgIz0HXpYvL1Lx','',1,0,'bot , admin , ',NULL),
(68,'admin','2024-07-08 07:55:15','Mon chat vient de faire quelque chose de vraiment drôle, je devais le partager avec vous ! 😺','MX1kFA4kJ/7ozWo0lxnoYXfvXev+ANHh','',1,0,'bot , admin , ',NULL),
(69,'admin','2024-07-08 07:57:40','C&#039;est l&#039;anniversaire de mon meilleur ami aujourd&#039;hui, des idées de cadeaux de dernière minute ? 🎁','hKiQEZlMRepXSxFy3yCAmU1SaaMcoifr','',0,0,'bot , ',NULL),
(70,'admin','2024-07-08 07:58:40','','mGBHa5gay07XoOBCrFdG6Ig3uS+/QpSj','63d6e1eb7d334ab63f1a1ac1b104cb8a.png',1,0,'bot , admin , ',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `coverImg` text DEFAULT NULL,
  `folowerLen` int(11) DEFAULT NULL,
  `folower` text DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(12,'inebgi_bot','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',NULL,'30c80db6ff2872a4b165c2a472f40c37.png','banner2048x1152.png',0,NULL,'2022-07-15 12:11:56',1,NULL,'tYu93Ri+gLiWT0dKlGbpiMeY4HjAm9os'),
(13,'agelid','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',NULL,'1f4ff1f0dd337bb314b3bb0069b06b95.png','banner2048x1152.png',0,NULL,'2022-07-15 12:21:23',1,NULL,'oW5WAsxQHheB7GLYJ+ssInY0BZ08CVDr'),
(14,'leptis_magnet','9486447f4fed5c342ce99b155f65f314eecb0e4a6ad6c587ccfd8245c14ff1dd',NULL,'8e09dc5520e6c306c53adb7c8b538182.png','banner2048x1152.png',0,NULL,'2022-07-15 17:29:21',1,NULL,'SKfYMkEmJV8AkbgH0Q36foXPbV2XY+h6'),
(15,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',NULL,'elyse.png','banner2048x1152.png',0,NULL,'2022-07-17 12:09:39',1,NULL,'+R7wstgDPP7AJjoq+4/Izh1Q8RnHpsYH'),
(16,'admin5','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',NULL,'elyse.png','banner2048x1152.png',0,NULL,'2024-07-08 07:28:00',1,NULL,'aUPHmwvOMDlXl25k2Z2rVcsQir9L5Isw');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-08  9:06:51
