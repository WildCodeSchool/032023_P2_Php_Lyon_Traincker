-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: traincker
-- ------------------------------------------------------
-- Server version	8.0.32
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
-- Table structure for table `station`
--
DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `station` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `station`
--
LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
INSERT INTO `station` VALUES (1,'Lyon'),(2,'Marseille'),(3,'Dijon'),(4,'Paris'),(5,'Toulouse'),(6,'Rennes'),(7,'Nantes'),(8,'Pau'),(9,'Bayonne'),(10,'Bordeaux'),(11,'Annecy'),(12,'Montpellier');
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `train`
--
DROP TABLE IF EXISTS `train`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `train` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `train`
--
LOCK TABLES `train` WRITE;
/*!40000 ALTER TABLE `train` DISABLE KEYS */;
INSERT INTO `train` VALUES (1,68549),(2,78961),(3,86122),(4,78952),(5,31586),(6,45965),(7,98126),(8,65899),(9,12995),(10,98132),(11,28552),(12,33446);
/*!40000 ALTER TABLE `train` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `transit`
--
DROP TABLE IF EXISTS `transit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `train_id` int NOT NULL,
  `station_id` int NOT NULL,
  `transit_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `transit`
--
LOCK TABLES `transit` WRITE;
/*!40000 ALTER TABLE `transit` DISABLE KEYS */;
INSERT INTO `transit` VALUES (1,1,1,'08:50:00'),(2,1,2,'09:00:00'),(3,1,3,'09:08:00'),(4,2,4,'08:15:00'),(5,2,5,'08:22:00'),(6,2,6,'08:27:00'),(7,3,7,'06:48:00'),(8,3,8,'06:55:00'),(9,3,9,'07:03:00'),(10,4,10,'17:40:00'),(11,4,11,'17:49:00'),(12,4,12,'17:55:00'),(13,5,1,'08:50:00'),(14,5,3,'08:55:00'),(15,5,5,'09:04:00'),(16,6,8,'12:50:00'),(17,6,1,'12:55:00'),(18,6,11,'13:04:00'),(19,7,8,'15:28:00'),(20,7,6,'15:34:00'),(21,7,4,'15:41:00'),(22,8,7,'18:11:00'),(23,8,4,'18:17:00'),(24,8,2,'18:26:00'),(25,9,3,'18:42:00'),(26,9,7,'18:50:00'),(27,9,1,'18:59:00'),(28,10,2,'07:44:00'),(29,10,9,'07:52:00'),(30,10,3,'07:59:00'),(31,11,5,'08:22:00'),(32,11,10,'08:30:00'),(33,11,11,'08:37:00'),(34,12,4,'11:11:00'),(35,12,12,'11:17:00'),(36,12,2,'11:22:00');
/*!40000 ALTER TABLE `transit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
-- Dump completed on 2023-04-18 15:40:47