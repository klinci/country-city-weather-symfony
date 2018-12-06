-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: geolocation
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `citys`
--

DROP TABLE IF EXISTS `citys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citys_country_id_foreign` (`country_id`),
  CONSTRAINT `citys_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countrys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citys`
--

LOCK TABLES `citys` WRITE;
/*!40000 ALTER TABLE `citys` DISABLE KEYS */;
/*!40000 ALTER TABLE `citys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countrys`
--

DROP TABLE IF EXISTS `countrys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countrys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countrys`
--

LOCK TABLES `countrys` WRITE;
/*!40000 ALTER TABLE `countrys` DISABLE KEYS */;
INSERT INTO `countrys` VALUES (1,'Afghanistan',NULL,NULL),(2,'Åland Islands',NULL,NULL),(3,'Albania',NULL,NULL),(4,'Algeria',NULL,NULL),(5,'American Samoa',NULL,NULL),(6,'Andorra',NULL,NULL),(7,'Angola',NULL,NULL),(8,'Anguilla',NULL,NULL),(9,'Antarctica',NULL,NULL),(10,'Antigua and Barbuda',NULL,NULL),(11,'Argentina',NULL,NULL),(12,'Armenia',NULL,NULL),(13,'Aruba',NULL,NULL),(14,'Australia',NULL,NULL),(15,'Austria',NULL,NULL),(16,'Azerbaijan',NULL,NULL),(17,'Bahamas',NULL,NULL),(18,'Bahrain',NULL,NULL),(19,'Bangladesh',NULL,NULL),(20,'Barbados',NULL,NULL),(21,'Belarus',NULL,NULL),(22,'Belgium',NULL,NULL),(23,'Belize',NULL,NULL),(24,'Benin',NULL,NULL),(25,'Bermuda',NULL,NULL),(26,'Bhutan',NULL,NULL),(27,'Bolivia',NULL,NULL),(28,'Bonaire, Sint Eustatius and Saba',NULL,NULL),(29,'Bosnia and Herzegovina',NULL,NULL),(30,'Botswana',NULL,NULL),(31,'Bouvet Island',NULL,NULL),(32,'Brazil',NULL,NULL),(33,'British Indian Ocean Territory',NULL,NULL),(34,'Brunei Darussalam',NULL,NULL),(35,'Bulgaria',NULL,NULL),(36,'Burkina Faso',NULL,NULL),(37,'Burundi',NULL,NULL),(38,'Cabo Verde',NULL,NULL),(39,'Cambodia',NULL,NULL),(40,'Cameroon',NULL,NULL),(41,'Canada',NULL,NULL),(42,'Cayman Islands',NULL,NULL),(43,'Central African Republic',NULL,NULL),(44,'Chad',NULL,NULL),(45,'Chile',NULL,NULL),(46,'China',NULL,NULL),(47,'Christmas Island',NULL,NULL),(48,'Cocos Islands',NULL,NULL),(49,'Colombia',NULL,NULL),(50,'Comoros',NULL,NULL),(51,'Congo',NULL,NULL),(52,'Congo',NULL,NULL),(53,'Cook Islands',NULL,NULL),(54,'Costa Rica',NULL,NULL),(55,'Côte d\'Ivoire',NULL,NULL),(56,'Croatia',NULL,NULL),(57,'Cuba',NULL,NULL),(58,'Curaçao',NULL,NULL),(59,'Cyprus',NULL,NULL),(60,'Czech Republic',NULL,NULL),(61,'Denmark',NULL,NULL),(62,'Djibouti',NULL,NULL),(63,'Dominica',NULL,NULL),(64,'Dominican Republic',NULL,NULL),(65,'Ecuador',NULL,NULL),(66,'Egypt',NULL,NULL),(67,'El Salvador',NULL,NULL),(68,'Equatorial Guinea',NULL,NULL),(69,'Eritrea',NULL,NULL),(70,'Estonia',NULL,NULL),(71,'Ethiopia',NULL,NULL),(72,'Falkland Islands [Malvinas]',NULL,NULL),(73,'Faroe Islands',NULL,NULL),(74,'Fiji',NULL,NULL),(75,'Finland',NULL,NULL),(76,'France',NULL,NULL),(77,'French Guiana',NULL,NULL),(78,'French Polynesia',NULL,NULL),(79,'French Southern Territories',NULL,NULL),(80,'Gabon',NULL,NULL),(81,'Gambia',NULL,NULL),(82,'Georgia',NULL,NULL),(83,'Germany',NULL,NULL),(84,'Ghana',NULL,NULL),(85,'Gibraltar',NULL,NULL),(86,'Greece',NULL,NULL),(87,'Greenland',NULL,NULL),(88,'Grenada',NULL,NULL),(89,'Guadeloupe',NULL,NULL),(90,'Guam',NULL,NULL),(91,'Guatemala',NULL,NULL),(92,'Guernsey',NULL,NULL),(93,'Guinea',NULL,NULL),(94,'Guinea-Bissau',NULL,NULL),(95,'Guyana',NULL,NULL),(96,'Haiti',NULL,NULL),(97,'Heard Island and McDonald Islands',NULL,NULL),(98,'Holy See',NULL,NULL),(99,'Honduras',NULL,NULL),(100,'Hong Kong',NULL,NULL),(101,'Hungary',NULL,NULL),(102,'Iceland',NULL,NULL),(103,'India',NULL,NULL),(104,'Indonesia',NULL,NULL),(105,'Iran',NULL,NULL),(106,'Iraq',NULL,NULL),(107,'Ireland',NULL,NULL),(108,'Isle of Man',NULL,NULL),(109,'Israel',NULL,NULL),(110,'Italy',NULL,NULL),(111,'Jamaica',NULL,NULL),(112,'Japan',NULL,NULL),(113,'Jersey',NULL,NULL),(114,'Jordan',NULL,NULL),(115,'Kazakhstan',NULL,NULL),(116,'Kenya',NULL,NULL),(117,'Kiribati',NULL,NULL),(118,'Korea (the Democratic People\'s Republic of)',NULL,NULL),(119,'Korea',NULL,NULL),(120,'Kuwait',NULL,NULL),(121,'Kyrgyzstan',NULL,NULL),(122,'Lao People\'s Democratic Republic',NULL,NULL),(123,'Latvia',NULL,NULL),(124,'Lebanon',NULL,NULL),(125,'Lesotho',NULL,NULL),(126,'Liberia',NULL,NULL),(127,'Libya',NULL,NULL),(128,'Liechtenstein',NULL,NULL),(129,'Lithuania',NULL,NULL),(130,'Luxembourg',NULL,NULL),(131,'Macao',NULL,NULL),(132,'Macedonia',NULL,NULL),(133,'Madagascar',NULL,NULL),(134,'Malawi',NULL,NULL),(135,'Malaysia',NULL,NULL),(136,'Maldives',NULL,NULL),(137,'Mali',NULL,NULL),(138,'Malta',NULL,NULL),(139,'Marshall Islands',NULL,NULL),(140,'Martinique',NULL,NULL),(141,'Mauritania',NULL,NULL),(142,'Mauritius',NULL,NULL),(143,'Mayotte',NULL,NULL),(144,'Mexico',NULL,NULL),(145,'Micronesia',NULL,NULL),(146,'Moldova',NULL,NULL),(147,'Monaco',NULL,NULL),(148,'Mongolia',NULL,NULL),(149,'Montenegro',NULL,NULL),(150,'Montserrat',NULL,NULL),(151,'Morocco',NULL,NULL),(152,'Mozambique',NULL,NULL),(153,'Myanmar',NULL,NULL),(154,'Namibia',NULL,NULL),(155,'Nauru',NULL,NULL),(156,'Nepal',NULL,NULL),(157,'Netherlands',NULL,NULL),(158,'New Caledonia',NULL,NULL),(159,'New Zealand',NULL,NULL),(160,'Nicaragua',NULL,NULL),(161,'Niger',NULL,NULL),(162,'Nigeria',NULL,NULL),(163,'Niue',NULL,NULL),(164,'Norfolk Island',NULL,NULL),(165,'Northern Mariana Islands',NULL,NULL),(166,'Norway',NULL,NULL),(167,'Oman',NULL,NULL),(168,'Pakistan',NULL,NULL),(169,'Palau',NULL,NULL),(170,'Palestine, State of',NULL,NULL),(171,'Panama',NULL,NULL),(172,'Papua New Guinea',NULL,NULL),(173,'Paraguay',NULL,NULL),(174,'Peru',NULL,NULL),(175,'Philippines',NULL,NULL),(176,'Pitcairn',NULL,NULL),(177,'Poland',NULL,NULL),(178,'Portugal',NULL,NULL),(179,'Puerto Rico',NULL,NULL),(180,'Qatar',NULL,NULL),(181,'Réunion',NULL,NULL),(182,'Romania',NULL,NULL),(183,'Russian Federation',NULL,NULL),(184,'Rwanda',NULL,NULL),(185,'Saint Barthélemy',NULL,NULL),(186,'Saint Helena, Ascension and Tristan da Cunha',NULL,NULL),(187,'Saint Kitts and Nevis',NULL,NULL),(188,'Saint Lucia',NULL,NULL),(189,'Saint Martin',NULL,NULL),(190,'Saint Pierre and Miquelon',NULL,NULL),(191,'Saint Vincent and the Grenadines',NULL,NULL),(192,'Samoa',NULL,NULL),(193,'San Marino',NULL,NULL),(194,'Sao Tome and Principe',NULL,NULL),(195,'Saudi Arabia',NULL,NULL),(196,'Senegal',NULL,NULL),(197,'Serbia',NULL,NULL),(198,'Seychelles',NULL,NULL),(199,'Sierra Leone',NULL,NULL),(200,'Singapore',NULL,NULL),(201,'Sint Maarten',NULL,NULL),(202,'Slovakia',NULL,NULL),(203,'Slovenia',NULL,NULL),(204,'Solomon Islands',NULL,NULL),(205,'Somalia',NULL,NULL),(206,'South Africa',NULL,NULL),(207,'South Georgia and the South Sandwich Islands',NULL,NULL),(208,'South Sudan',NULL,NULL),(209,'Spain',NULL,NULL),(210,'Sri Lanka',NULL,NULL),(211,'Sudan',NULL,NULL),(212,'Suriname',NULL,NULL),(213,'Svalbard and Jan Mayen',NULL,NULL),(214,'Swaziland',NULL,NULL),(215,'Sweden',NULL,NULL),(216,'Switzerland',NULL,NULL),(217,'Syrian Arab Republic',NULL,NULL),(218,'Taiwan',NULL,NULL),(219,'Tajikistan',NULL,NULL),(220,'Tanzania, United Republic of',NULL,NULL),(221,'Thailand',NULL,NULL),(222,'Timor-Leste',NULL,NULL),(223,'Togo',NULL,NULL),(224,'Tokelau',NULL,NULL),(225,'Tonga',NULL,NULL),(226,'Trinidad and Tobago',NULL,NULL),(227,'Tunisia',NULL,NULL),(228,'Turkey',NULL,NULL),(229,'Turkmenistan',NULL,NULL),(230,'Turks and Caicos Islands',NULL,NULL),(231,'Tuvalu',NULL,NULL),(232,'Uganda',NULL,NULL),(233,'Ukraine',NULL,NULL),(234,'United Arab Emirates',NULL,NULL),(235,'United Kingdom of Great Britain and Northern Ireland',NULL,NULL),(236,'United States Minor Outlying Islands',NULL,NULL),(237,'United States of America',NULL,NULL),(238,'Uruguay',NULL,NULL),(239,'Uzbekistan',NULL,NULL),(240,'Vanuatu',NULL,NULL),(241,'Venezuela',NULL,NULL),(242,'Viet Nam',NULL,NULL),(243,'Virgin Islands',NULL,NULL),(244,'Virgin Islands',NULL,NULL),(245,'Wallis and Futuna',NULL,NULL),(246,'Western Sahara*',NULL,NULL),(247,'Yemen',NULL,NULL),(248,'Zambia',NULL,NULL),(249,'Zimbabwe',NULL,NULL);
/*!40000 ALTER TABLE `countrys` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-06  0:23:50
