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
-- Dumping data for table `mr_groups`
--

LOCK TABLES `mr_groups` WRITE;
/*!40000 ALTER TABLE `mr_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_manga`
--

LOCK TABLES `mr_manga` WRITE;
/*!40000 ALTER TABLE `mr_manga` DISABLE KEYS */;
INSERT INTO `mr_manga` VALUES (1,'Doulou Dalu','doulou-dalu','Tang Jia San Shao','Mu Feng Chun',2011,'æ–—ç½—å¤§é™†; Combat Continent; Lands of Battle; Soul Land; Douluo Dalu; Äáº¥u La Äáº¡i Lá»¥c','Action, Adventure, Fantasy, Martial Arts, Romance, School Life, Shounen, Supernatural','A Seita Tang, a mais famosa seita de artes marciais de todo o mundo. Ao roubar os seus ensinamentos mais secretos para cumprir seus sonhos, Tang San cometeu um crime imperdoÃ¡vel. Com sua ambiÃ§Ã£o atingida, ele entrega seu legado Ã  seita e se joga do temÃ­vel &quot;Pico do Inferno&quot;. Mas ele nunca poderia ter imaginado que isso iria levÃ¡-lo para um outro mundo, um sem artes marciais ou ressentimentos. Uma terra onde sÃ³ as almas mÃ­sticas de batalha habitam. O continente Douro. Como Tang San irÃ¡ sobreviver nesse ambiente desconhecido? Com um novo caminho a seguir, uma nova lenda comeÃ§a...',0,0,'%2$s/66ea01353c616e2b43f3d23badc26c75.jpg','1970-01-01 00:00:01',0);
/*!40000 ALTER TABLE `mr_manga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_manga_chapter`
--

LOCK TABLES `mr_manga_chapter` WRITE;
/*!40000 ALTER TABLE `mr_manga_chapter` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_manga_chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_manga_chapter_q`
--

LOCK TABLES `mr_manga_chapter_q` WRITE;
/*!40000 ALTER TABLE `mr_manga_chapter_q` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_manga_chapter_q` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_manga_q`
--

LOCK TABLES `mr_manga_q` WRITE;
/*!40000 ALTER TABLE `mr_manga_q` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_manga_q` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_option`
--

LOCK TABLES `mr_option` WRITE;
/*!40000 ALTER TABLE `mr_option` DISABLE KEYS */;
INSERT INTO `mr_option` VALUES ('app_manga_genre','a:38:{i:0;s:6:\"Action\";i:1;s:5:\"Adult\";i:2;s:5:\"Anime\";i:3;s:6:\"Comedy\";i:4;s:5:\"Comic\";i:5;s:9:\"Doujinshi\";i:6;s:5:\"Drama\";i:7;s:5:\"Ecchi\";i:8;s:7:\"Fantasy\";i:9;s:13:\"Gender Bender\";i:10;s:5:\"Harem\";i:11;s:10:\"Historical\";i:12;s:6:\"Horror\";i:13;s:5:\"Josei\";i:14;s:11:\"Live action\";i:15;s:6:\"Manhua\";i:16;s:6:\"Manhwa\";i:17;s:11:\"Martial Art\";i:18;s:6:\"Mature\";i:19;s:5:\"Mecha\";i:20;s:7:\"Mystery\";i:21;s:8:\"One shot\";i:22;s:13:\"Psychological\";i:23;s:7:\"Romance\";i:24;s:11:\"School Life\";i:25;s:6:\"Sci-fi\";i:26;s:6:\"Seinen\";i:27;s:6:\"Shoujo\";i:28;s:9:\"Shojou Ai\";i:29;s:7:\"Shounen\";i:30;s:10:\"Shounen Ai\";i:31;s:13:\"Slice of Life\";i:32;s:4:\"Smut\";i:33;s:6:\"Sports\";i:34;s:12:\"Supernatural\";i:35;s:7:\"Tragedy\";i:36;s:9:\"Adventure\";i:37;s:4:\"Yaoi\";}','yes'),('app_title','MangaReader','yes');
/*!40000 ALTER TABLE `mr_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_user`
--

LOCK TABLES `mr_user` WRITE;
/*!40000 ALTER TABLE `mr_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mr_user_meta`
--

LOCK TABLES `mr_user_meta` WRITE;
/*!40000 ALTER TABLE `mr_user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `mr_user_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-28 18:13:01
