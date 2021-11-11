-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: dblogin
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.21.04.1

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'livro1','autor1',10.50,1),(2,'livro2','autor2',40.00,1),(3,'livro3','autor2',50.00,2),(4,'livro 4','autor1',5.00,3),(5,'Maias','Eça de Queirós',20.00,3),(6,'second','author3',12.00,3),(9,'tete','tete',123.00,5),(10,'gambu','gambu',34.00,5),(11,'fgfg','fgfg',56.00,5),(12,'5656','asdff asdaa',56.00,3),(16,'3333','333',33.00,3),(17,'33333','333',33.00,3),(18,'4444','&lt;script&gt;&lt;/script&gt;',44.00,3),(19,'&#039; or &#039;1&#039;=&#039;1&#039; // --','sdfsf',44.00,3),(20,'1 or 1=1 -- //','1 or 1=1 -- //',2.00,3);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'teste','teste@ua.pt','$2y$10$j.UodctxbZYPkGMGmTQ4EubqbmHqOSzub/qM8IA7x6yL.ynBdK18i','2021-10-20 14:48:19',''),(2,'qwerqewr','qwerqwer@gmail.com','$2y$10$iavaBiIZeZL8gA4H8VgdiOUGoNcR2nSEgbQwWBP2oRE5p9D.zHnYG','2021-10-21 12:45:12',''),(3,'qwerqwer','qwerqwerqwer@gmail.com','$2y$10$POq33z5p3KRI9YedWtUMSup.KxrbISbL9oL1Ghe6/r0AQU2nlOZjG','2021-10-21 12:45:36','admin'),(4,'teste2','teseete@ua.pt','$2y$10$iu6OYfhBjBFYhXx9GqvX1eeykuZBncbCbdcwTTVsv07mXEV9QSt0.','2021-10-23 14:37:55',''),(5,'admin@ua.pt','admin@ua.pt','$2y$10$rsEa/zyAyltKL1LhKZ393ed0m4OoNavDOjHNZrFHbqOatstkCyOV2','2021-10-25 18:36:00','admin');
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

-- Dump completed on 2021-11-04 21:44:10
