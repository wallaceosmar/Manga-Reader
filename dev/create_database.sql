-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: manga-reader
-- ------------------------------------------------------
-- Server version	5.7.9

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
-- Table structure for table `mr_groups`
--

DROP TABLE IF EXISTS `mr_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_groups` (
  `idgroups` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `url` varchar(250) COLLATE utf8_bin NOT NULL,
  `twitter` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idgroups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_manga`
--

DROP TABLE IF EXISTS `mr_manga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_manga` (
  `id_manga` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(150) COLLATE utf8_bin NOT NULL,
  `authors` varchar(150) COLLATE utf8_bin NOT NULL,
  `artists` varchar(150) COLLATE utf8_bin NOT NULL,
  `released` int(4) NOT NULL,
  `other_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `genres` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `m_status` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cover` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_update` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  `last_chapter` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_manga`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_manga_chapter`
--

DROP TABLE IF EXISTS `mr_manga_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_manga_chapter` (
  `id_chapter` bigint(20) NOT NULL,
  `chapter` float NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `manga` varchar(150) COLLATE utf8_bin NOT NULL,
  `trans_group` varchar(255) COLLATE utf8_bin NOT NULL,
  `views` bigint(20) unsigned NOT NULL,
  `last_update` datetime NOT NULL,
  `submiter` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_chapter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_manga_chapter_q`
--

DROP TABLE IF EXISTS `mr_manga_chapter_q`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_manga_chapter_q` (
  `id_chapter` bigint(20) NOT NULL,
  `chapter` float NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `manga` varchar(150) COLLATE utf8_bin NOT NULL,
  `trans_group` varchar(255) COLLATE utf8_bin NOT NULL,
  `views` bigint(20) unsigned NOT NULL,
  `last_update` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  `submiter` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_chapter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_manga_q`
--

DROP TABLE IF EXISTS `mr_manga_q`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_manga_q` (
  `id_manga` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(150) COLLATE utf8_bin NOT NULL,
  `authors` varchar(150) COLLATE utf8_bin NOT NULL,
  `artists` varchar(150) COLLATE utf8_bin NOT NULL,
  `released` int(4) NOT NULL,
  `other_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `genres` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `m_status` int(1) NOT NULL DEFAULT '0',
  `views` bigint(20) unsigned NOT NULL DEFAULT '0',
  `cover` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_update` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  `last_chapter` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_manga`),
  UNIQUE KEY `UN_SLUG_MANGA_Q_KEY` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_option`
--

DROP TABLE IF EXISTS `mr_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_option` (
  `option_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8_bin NOT NULL,
  `autoload` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_user`
--

DROP TABLE IF EXISTS `mr_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_user` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_pass` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  `user_activation_key` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mr_user_meta`
--

DROP TABLE IF EXISTS `mr_user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mr_user_meta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_bin,
  PRIMARY KEY (`umeta_id`),
  KEY `FK_USER_META_USER_ID_idx` (`user_id`),
  CONSTRAINT `FK_USER_META_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-28 17:20:30
