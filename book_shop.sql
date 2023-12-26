-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: book_shop_db
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'John','smithjohn@gmail.com','$2y$10$SAsrN2wJaQzz6fcBCXPDce6AkIaKTxgsphkxdLErph8/i0ORBrXHW','2023-12-13 08:30:24','2023-12-13 08:30:24');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `bookId` int NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `author` varchar(60) NOT NULL,
  `categoryId` int NOT NULL,
  `description` text,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT NULL,
  `fine` float NOT NULL,
  PRIMARY KEY (`bookId`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'The Great Gatsby','F. Scott Fitzgerald',12,'The novel tells the tragic story of Jay Gatsby, a self-made millionaire, and his pursuit of Daisy Buchanan, a wealthy young woman whom he loved in his youth.',2,40,'gatsby.jpg','2023-12-13 11:22:56','2023-12-13 11:22:56','Available',8),(2,'Guns, Germs, and Steel','Jared Diamond	',6,'The book attempts to explain why Eurasian and North African civilizations have survived and conquered others.',5,70,'Guns.jpg','2023-12-13 11:28:45','2023-12-13 11:28:45','Available',10),(3,'The Lean Startup',' Eric Ries',4,' How Today Entrepreneurs Use Continuous Innovation to Create Radically Successful.',6,80,'LeanStartup.jpg','2023-12-15 12:28:44','2023-12-15 12:28:44','Available',8),(4,'Think and Grow Rich','Napoleon Hill and Rosa Lee Beeland',4,'Weak desire brings weak results, just as a small fire makes a small amount of heat. ',3,70,'thinkandgrow.jpg','2023-12-15 12:35:29','2023-12-15 12:35:29','Available',7),(5,'Getting Things Done','David Allen',4,'Getting Things Done details how to build a system for capturing ideas and working on the right things at the right time. ',6,120,'Things.jpg','2023-12-15 12:38:59','2023-12-15 12:38:59','Available',10),(6,'Milk and Honey','Rupi Kaur',10,'Where the Sidewalk Ends Shel Silverstein. Where the Sidewalk Ends. Want to Read.',3,50,'MlkHoney.jpg','2023-12-15 12:42:10','2023-12-15 12:42:10','Available',5),(7,'Devotions','Mary Oliver',10,'Oprah s Book ClubChosen by Poetry Book Society as their special commendation No matter where one starts reading.',3,60,'Devotions.jpg','2023-12-15 12:49:56','2023-12-15 12:49:56','Available',6),(8,'Sapiens','Yuval Noah Harari',6,'Sapiens is your guide to becoming an expert on the entire history of the human race',4,100,'Sapien.jpg','2023-12-15 12:54:04','2023-12-15 12:54:04','Available',8),(9,'A Brief History of Time','Stephen Hawking',3,'A Short History of Nearly Everything Bill Bryson . The Selfish Gene Richard Dawkins.',7,200,'HistoryofTime.jpg','2023-12-15 13:00:29','2023-12-15 13:00:29','Available',20);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fiction','2023-12-13 08:30:24','2023-12-13 08:30:24','Unavailable'),(2,'Non-Fiction','2023-12-13 08:30:24','2023-12-13 08:30:24','Unavailable'),(3,'Science','2023-12-13 08:30:24','2023-12-13 12:38:19','Available'),(4,'Business','2023-12-13 08:30:24','2023-12-13 12:39:17','Available'),(6,'History','2023-12-13 08:30:24','2023-12-13 08:30:24','Available'),(7,'Philosophy','2023-12-13 08:30:24','2023-12-13 08:30:24','Unavailable'),(9,'Technology','2023-12-13 08:30:24','2023-12-13 08:30:24','Unavailable'),(10,'Poetry','2023-12-13 08:30:24','2023-12-13 08:30:24','Available'),(11,'Philosophy','2023-12-13 08:30:24','2023-12-13 08:30:24','Unavailable'),(12,'Novel','2023-12-13 08:30:24','2023-12-13 08:30:24','Available');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_file`
--

DROP TABLE IF EXISTS `image_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image_file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `unique_name` varchar(200) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `image_file_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_file`
--

LOCK TABLES `image_file` WRITE;
/*!40000 ALTER TABLE `image_file` DISABLE KEYS */;
INSERT INTO `image_file` VALUES (1,1,'65673845868a5.jpg','user.jpg','2023-11-29 14:10:29','2023-11-29 14:10:29','http://localhost/uploads/65673845868a5.jpg'),(12,12,'65757d0d4fe4a.png','11.png','2023-12-10 09:55:41','2023-12-10 09:55:41','http://localhost/uploads/65757d0d4fe4a.png'),(13,13,'658000fd1336c.png','avatar.png','2023-12-18 09:21:17','2023-12-18 09:21:17','http://localhost/uploads/658000fd1336c.png'),(14,14,'658a18429ed7e.jpg','user5.jpg','2023-12-26 01:03:14','2023-12-26 01:03:14','http://localhost/uploads/658a18429ed7e.jpg'),(15,15,'658a6060c1d22.jpg','user4.jpg','2023-12-26 06:10:56','2023-12-26 06:10:56','http://localhost/uploads/658a6060c1d22.jpg'),(16,16,'658a718fd19ce.jpg','usrs.jpg','2023-12-26 07:24:15','2023-12-26 07:24:15','http://localhost/uploads/658a718fd19ce.jpg');
/*!40000 ALTER TABLE `image_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `transactionId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `bookId` int NOT NULL,
  `cardNumber` mediumtext NOT NULL,
  `name` varchar(50) NOT NULL,
  `transactionDate` datetime DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` enum('Success','Failed') DEFAULT NULL,
  PRIMARY KEY (`transactionId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,12,2,'7691824563890113','Honey','2023-12-21 19:22:06',537,'Success'),(2,13,3,'7596894563589137','Rajiv','2023-12-26 07:55:44',414,'Success');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rentedbooks`
--

DROP TABLE IF EXISTS `rentedbooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rentedbooks` (
  `rentId` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `bookId` int DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `days` int NOT NULL,
  `price` float NOT NULL,
  `fine` float NOT NULL,
  `rentDate` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  `paymentStatus` enum('Paid','Unpaid') DEFAULT NULL,
  PRIMARY KEY (`rentId`),
  KEY `userId` (`userId`),
  KEY `bookId` (`bookId`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `rentedbooks_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  CONSTRAINT `rentedbooks_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `books` (`bookId`),
  CONSTRAINT `rentedbooks_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rentedbooks`
--

LOCK TABLES `rentedbooks` WRITE;
/*!40000 ALTER TABLE `rentedbooks` DISABLE KEYS */;
INSERT INTO `rentedbooks` VALUES (1,12,2,6,3,70,10,'2023-12-14 01:31:59','2023-12-17 01:31:59','Paid'),(2,13,3,4,4,80,8,'2023-12-20 13:43:03','2023-12-24 13:43:03','Paid'),(3,14,5,4,2,120,10,'2023-12-26 01:09:06','2023-12-28 01:09:06','Unpaid'),(5,15,9,3,3,200,20,'2023-12-26 06:21:49','2023-12-29 06:21:49','Unpaid'),(7,15,4,4,2,70,7,'2023-12-26 09:11:21','2023-12-28 09:11:21','Unpaid');
/*!40000 ALTER TABLE `rentedbooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returnedbooks`
--

DROP TABLE IF EXISTS `returnedbooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `returnedbooks` (
  `returnId` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `bookId` int DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `rentDate` datetime DEFAULT NULL,
  `dueDate` datetime DEFAULT NULL,
  `returnDate` datetime DEFAULT NULL,
  `status` enum('Paid','Unpaid') DEFAULT NULL,
  PRIMARY KEY (`returnId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returnedbooks`
--

LOCK TABLES `returnedbooks` WRITE;
/*!40000 ALTER TABLE `returnedbooks` DISABLE KEYS */;
INSERT INTO `returnedbooks` VALUES (1,12,2,6,'2023-12-14 01:31:59','2023-12-17 01:31:59','2023-12-21 19:22:06','Paid'),(2,13,3,4,'2023-12-20 13:43:03','2023-12-24 13:43:03','2023-12-26 07:55:44','Paid'),(3,13,3,4,'2023-12-20 13:43:03','2023-12-24 13:43:03','2023-12-26 07:56:51','Paid');
/*!40000 ALTER TABLE `returnedbooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `address` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Abhay Singh','singhabhay@gmail.com','7894152368','$2y$10$ea39g./YIPeWLi640S1djuQedgeX7eipS5AIhwftvvnO3LAD8LoOK','Male','# 9 Vivek Vihar , Mohali.','2023-11-29 14:10:29','2023-11-29 14:10:29'),(12,'Honey','honey@gmail.com','9639653112','$2y$10$dQ4lp65LCJxPMipuENF0qOoQ0ll8.i/WedZ3ALMti2pFzZaefWore','Male','sector 43 market Chandigarh. ','2023-12-10 09:55:41','2023-12-10 09:55:41'),(13,'Rajiv','rajiv@gmail.com','6745233899','$2y$10$Be9M2zrogGQVs4175B/JZ..8Z9mMXSqb6xYhl5PGRffWpz59uR4Ke','Male','# 902 Nehru place Delhi.','2023-12-18 09:21:17','2023-12-18 09:21:17'),(14,'Arun','arun@gmail.com','8496375129','$2y$10$.xllQ5ax3Jns37LbLrbx..GiWDpQBoKtzI759Qsxn.W3JkSdiddOi','Male','# 109 Sunny Enclave Panipat , Haryana.','2023-12-26 01:03:14','2023-12-26 01:03:14'),(15,'Raman','raman@gmail.com','7361948320','$2y$10$f.ZiRCsT1FziJJU/gFVDpOz7RvJNq7DFH0ityjMANnnsB2nIcPwey','Male','# 451 Sector 62 Noida Uttar Pradesh.','2023-12-26 06:10:56','2023-12-26 06:10:56'),(16,'Akshit','akshit@gmail.com','7394468291','$2y$10$6lYWMh96ZGs5x5BOvm6X3eI9G9KDtjQLDEfXzeve04AWc5ji2BEoG','Male','# 72 Vikash Nagar Colony  Chandigarh. ','2023-12-26 07:24:15','2023-12-26 07:24:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verification_codes`
--

DROP TABLE IF EXISTS `verification_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verification_codes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` int NOT NULL,
  `created` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `userId` (`userId`),
  CONSTRAINT `verification_codes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verification_codes`
--

LOCK TABLES `verification_codes` WRITE;
/*!40000 ALTER TABLE `verification_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `verification_codes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-26 14:33:02
