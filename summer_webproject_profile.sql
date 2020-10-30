-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: summer_webproject
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
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'karyj101','$2y$10$CpR9iNahcf5rFDcFFBVMlOmcmswatl7jstYyURiJfk5yyOFuk1.Vy'),(2,'kary101','$2y$10$KJR0u.GxsVLl5p2MheCmFeUil6pYIJwdRyDDXaf2qRP3YbF5yhlyW'),(3,'','$2y$10$E68mEmKhipK1lDr0/ClGN.y0UMDvJi0oN05oK9hf3xsCAE8LiZAjK'),(4,'tester','$2y$10$gmF0ZWJ.XoEWQo1eDxN3s.HXO2/vaXa5cEb3p73wYNht2op2iaTcG'),(5,'moretests','$2y$10$BjD6pwG0Z7kQWni9HA1qt.0k2fJnKI6a4TeY5Y/V6VpyW9dNy.2iy'),(6,'another','$2y$10$M2qpM0cIQxXCMbpcYDaSu.Taa6Dh.EltwGvYuQXq6jzIxvKOD0bMy'),(7,'bird','$2y$10$5m7bUZaNEp75Bn0oQYNvtOaSUtU1X37r9/SE5w1Dvj4OZciGWA1N6'),(8,'test','$2y$10$TMRSzc/dpjugr1YLGCfboeJr6nzhvIiotkcRkbzsJIjMI40AX0lPm'),(9,'test101','$2y$10$vO9Jt.AglN2Bu6J45vksZO7fsNNaTRGnIQrf7IofcvwLYMm8PDenC'),(10,'adri','$2y$10$fEDeITMc4PtlezL/uk0fKOFvzTYXzCk4J5zx25dqwM9R86Q8swRGm'),(11,'testy','$2y$10$Gl/33v/6doMOoeNfsxLYJO2liZCoy7ITVTr7Px0Crvr85IJeqb.oC'),(12,'adrii1','$2y$10$Xu7bKxKMAJVXjWBjxx/wc.nubi..KE70t5LnTk2EO1zbaD0Ulj.o6'),(13,'person','$2y$10$RFD/cvjX.6Mkzkes/wUl4.0KCaDYsBKNkgeLAKp/TwNEFfw8HXeya');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-10 13:41:07
