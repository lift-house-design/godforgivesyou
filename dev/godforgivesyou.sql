-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: godforgivesyou
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `backgrounds`
--

DROP TABLE IF EXISTS `backgrounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backgrounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_file` (`file`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backgrounds`
--

LOCK TABLES `backgrounds` WRITE;
/*!40000 ALTER TABLE `backgrounds` DISABLE KEYS */;
INSERT INTO `backgrounds` VALUES (1,'bench.png'),(2,'coolsunset.png'),(3,'cross.png'),(4,'crossbanner.png'),(5,'largecross.png'),(6,'light.png'),(7,'rainbow.png'),(8,'sky.png'),(9,'stonecross.png'),(10,'sunset.png'),(11,'thorns.png'),(12,'trail.png'),(13,'wolf.png');
/*!40000 ALTER TABLE `backgrounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(10) unsigned NOT NULL DEFAULT '1',
  `tags` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bot_check`
--

DROP TABLE IF EXISTS `bot_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bot_check` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` char(42) NOT NULL,
  KEY `time` (`time`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bot_check`
--

LOCK TABLES `bot_check` WRITE;
/*!40000 ALTER TABLE `bot_check` DISABLE KEYS */;
INSERT INTO `bot_check` VALUES ('2014-07-17 15:56:39','0010502303322ef07cf79d7e406cb0fa64e2adad62'),('2014-07-17 15:57:48','004c3b37da351cf997a48ab54dbf4e7f8852cc6686'),('2014-07-17 16:52:44','00151bae294ebb430592bfbc5a4356ec8b4e71b02b'),('2014-07-17 17:15:02','004ab292bf6536fbf7e3faf652a53e7453047843c2'),('2014-07-17 17:16:55','0080081279609817920e0da73ec3733d32068db739'),('2014-07-17 17:18:49','0024768effeb4efe544b51cacf99688682cac3df17'),('2014-07-17 17:19:57','0006fb340ef4ed8851bb690b30503e31c9f4307395'),('2014-07-17 19:06:15','00f00c96bda449462df6c6c7abab01014de4a28d73'),('2014-07-17 19:08:11','00a2b3aa4060d05946079650561390145ee7c3d7a0'),('2014-07-18 15:24:36','00a70e3b41b61c1b146662c051dbc57c569a290245'),('2014-07-18 16:08:02','0055ea60f997e116661fe1b950e6eb7d87c5a15603'),('2014-07-18 16:10:11','00898b7dea21bdcba0b1dee470395439264da67529'),('2014-07-18 16:12:00','00a5d7b349912048ec8dc97a7e3510afc0dde0b0bd'),('2014-07-18 16:12:57','00dca929bd790f3c0e005a3cd786e3c4c4fe36d526'),('2014-07-18 16:13:19','008dc5b0253d9b1700aeec409f4c05851f9985dba2'),('2014-07-18 16:14:04','00414722b56a58c574ea6af3ca1c577960c6433824'),('2014-07-18 16:47:48','001cc1b6eb331137a6c9a81b783e1bfb2405ede3ef'),('2014-07-18 19:50:30','00b5a359e9a92727fc3038d715f8efa9c6703ff020'),('2014-07-18 20:07:29','0076b89e3203570b5613815220ee35f755443bac2c'),('2014-07-18 21:13:25','00f974f6d99b9ad31e8762360ea933edfcd7c8d32f'),('2014-07-18 21:14:51','00b3091adcfc03deb6e25552960974903f2d576711'),('2014-07-21 16:00:25','002be92e8c72996302125aea4399ca7b3c745a7c42'),('2014-07-21 16:26:42','0038b414579970f16a294e0d5e465dbf03ebbe2885'),('2014-07-21 16:28:15','00fa8e5232832b24a64b1def7e0989c9928a90cfca'),('2014-07-21 16:43:00','00f4d4a1b438b2ff6314caa9d6d87d93e9478c78cf'),('2014-07-21 20:21:46','00272a0493dbbb1feaefd726aa307f5b132dc8e395'),('2014-07-21 20:31:50','007f2e49e82e322b05118ab3b66c8a3109f920f261'),('2014-07-21 20:33:34','00063551d21f2224e432402708f9f641f5901cf650'),('2014-07-21 20:35:45','00299025b0acce1d7f0b5f7d573f11c80020026023'),('2014-07-21 20:36:25','004f498e637700effa28ce0467f5e1384a16bbee31'),('2014-07-21 20:39:43','004be72f0da07debeaef395ccb59ee7b9fa875b14e'),('2014-07-21 20:40:06','005a8b40d3b7696d314bde840d2aa27b343b9f0272'),('2014-07-21 20:40:29','008fc8a39b944273c7a0a6615b3ccf59fddf7d6e17'),('2014-07-21 20:42:54','0032a1f5c485d9252cf5be884f6faa10a865f3a7ac'),('2014-07-21 21:11:42','0069131116885634320a75afd8dcb185210098ce3d'),('2014-07-21 21:17:33','008ecbf47eaae63d196fc62ca3c1872d600d46d2bc'),('2014-07-23 16:57:01','00480060814712b38dd838a3dd4cc051754afa3232'),('2014-07-23 20:34:00','009df519b383b2452579ef49120499ec59ff90e1c4'),('2014-07-24 19:30:42','009d2cacab2a86d28ac9d4ed4cabfc4a8297609fb3'),('2014-10-06 21:25:14','0019c74f26c57ec08e2404d83e25149249f169307d'),('2014-10-06 21:27:22','005428583c592bf8b8f188c59b93e0a2f270e8a0df'),('2014-10-06 21:35:07','00d81dd18b43257e8eeb4022e43e7e89aa52276436'),('2014-10-14 18:02:38','003590671017ad7a8f204296edcf880ea18a26212f'),('2014-10-14 18:36:28','008c3931d516480a4a4bf9ad13d5eb463fb9c87598'),('2014-10-14 18:38:03','002297016a5c4c9f98367465c8215e9b82b4b9f574'),('2014-10-14 18:43:46','006659182ae77681db057c9226adfc51981a6aba13'),('2014-10-14 18:44:18','00dd09587dbdb968f53d40200e3389ca6d83e9d514'),('2014-10-14 19:25:29','00f2aec26bd84769dc86274fb19b870b70a32e4daa');
/*!40000 ALTER TABLE `bot_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confessions`
--

DROP TABLE IF EXISTS `confessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(700) NOT NULL,
  `bg` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `spam` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confessions`
--

LOCK TABLES `confessions` WRITE;
/*!40000 ALTER TABLE `confessions` DISABLE KEYS */;
INSERT INTO `confessions` VALUES (1,'I cheated on a test',1,1,'No'),(2,'I stole a candy bar',5,1,'No'),(3,'I broke the speed limit',9,1,'No'),(4,'I lied to my brother',11,1,'No');
/*!40000 ALTER TABLE `confessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `name` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `example` varchar(100) NOT NULL,
  `help` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`),
  KEY `name_2` (`name`,`label`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES ('contact_recipient','Contact Recipient Email','','bain@lifthousedesign.com','This is the email address that will received messages sent through the contact form.'),('ga_code','Google Analytics Code','','UA-000000-01','If you want to track your page views using Google Analytics, enter the provided code here.'),('google_site_verification','Allow Google Site Verification','No','No','Setting this field to \"Yes\" will allow Google to automatically verify your website (required for Google Webmaster Tools). It is important that you set this field back to \"No\" after your site has been verified or someone else may try to claim it!');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `type` enum('permanent','aside','page') NOT NULL DEFAULT 'page',
  `topbar` enum('Yes','No') NOT NULL DEFAULT 'No',
  `footer` enum('Yes','No') NOT NULL DEFAULT 'No',
  `title` varchar(500) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES ('careers','<h1>Careers</h1>\n<h2>Interns</h2>\n<ul>\n<li>We are currently looking for Interns for our office. Please contact us for more detail.</li>\n</ul>\n<h2>Employment</h2>\n<ul>\n<li>If you are looking for a career in accounting, <em><a href=\"/contact\">click here</a></em>.</li>\n</ul>\n<h1>Accounting Firms</h1>\n<h2>Firms</h2>\n<ul>\n<li>We would love to hear from you if you&rsquo;re for an accounting firm. Please contact us for more detail.</li>\n</ul>','page','Yes','Yes','Careers','Careers'),('home','<h2>God Forgives</h2>\n<p>Our lives are busier than ever. Sometimes taking a minute to step back, and reflect on your day seems nearly impossible. We are often tied to our mobile devices, laptops, and televisions. So when do we make time for prayer, and asking God for Forgiveness?</p>\n<br />\n<p>GodForgivesYou.com is dedicated to helping you find the time to ask for forgivesness. In this web centric life, we recognize that you are quite often in front of a web based device. This is why we created a web based environment for you to take several minutes out of your day, and say to God, “Forgive Me”. </p>\n<br />\n<p>There are many Bible verses about the forgiveness God offers. Start the forgiveness process now. Our “Ask” page creates a safe environment for you to jot down the thoughts or actions that are troubling you. </p>\n<br />\n<p>But maybe you are looking for some reassurance about the healing power of God. You may want to receive some counsel, or advice on how to accept the power of God\'s forgiveness. Sign up for a private account by creating a user name, and adding your email. Our group of counselors and advisors will respond privately to your concerns. Worried about signing up with your email address? Don’t be. We will never publish your email. We believe in the anonymous nature of what should be shared between you and God. </p>\n<br />\n<p>Our “Ask” page also features anonymous posts for forgiveness that others have created. But why would we do this? We want you to realize that you are not alone. After all, none of us are perfect. Take time today to speak to God, and realize His immense healing powers.</p>','aside','No','No','',''),('services','<h1>Services</h1>\n<h2>&nbsp;Tax Services</h2>\n<ul>\n<li>Federal tax</li>\n<li>State taxes</li>\n<li>International taxes</li>\n</ul>\n<h2>Business Consulting</h2>\n<ul>\n<li>Business investments in China</li>\n<li>Foreigners opening business in USA</li>\n<li>Tax consequence of foreign investor&rsquo;s real estate investment</li>\n<li>EB-5 immigrant investor tax planning</li>\n<li>Startup company financial resources</li>\n<li>Cash shortage solution</li>\n<li>China business doing business in USA</li>\n</ul>\n<h2>Accounting</h2>\n<ul>\n<li>Financial controller outsourcing</li>\n<li>Compilation financial statements</li>\n<li>Bookkeeping</li>\n</ul>\n<h1>Fees</h1>\n<h2>Flat Fees</h2>\n<ul>\n<li>We are flat fee fans. If you referral a new client to us, we will give you six months service for free. In&nbsp;addition, the one who you referred will have three months service for free as well.</li>\n</ul>','page','Yes','Yes','Services','Services');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forgives`
--

DROP TABLE IF EXISTS `forgives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forgives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `confession` int(10) unsigned NOT NULL,
  `type` enum('forgive','condemn','ignore','spam') DEFAULT NULL,
  `user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forgives`
--

LOCK TABLES `forgives` WRITE;
/*!40000 ALTER TABLE `forgives` DISABLE KEYS */;
/*!40000 ALTER TABLE `forgives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  `data` text,
  `type` enum('log','error') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prayers`
--

DROP TABLE IF EXISTS `prayers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prayers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(700) NOT NULL,
  `bg` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `spam` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prayers`
--

LOCK TABLES `prayers` WRITE;
/*!40000 ALTER TABLE `prayers` DISABLE KEYS */;
/*!40000 ALTER TABLE `prayers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prayers_for`
--

DROP TABLE IF EXISTS `prayers_for`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prayers_for` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prayer` int(10) unsigned NOT NULL,
  `type` enum('forgive','condemn','ignore','spam') DEFAULT NULL,
  `user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prayers_for`
--

LOCK TABLES `prayers_for` WRITE;
/*!40000 ALTER TABLE `prayers_for` DISABLE KEYS */;
/*!40000 ALTER TABLE `prayers_for` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_media`
--

DROP TABLE IF EXISTS `social_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_media` (
  `label` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL DEFAULT '',
  `name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_media`
--

LOCK TABLES `social_media` WRITE;
/*!40000 ALTER TABLE `social_media` DISABLE KEYS */;
INSERT INTO `social_media` VALUES ('Facebook','','facebook'),('Google+','','googleplus'),('Instagram','','instagram'),('LinkedIn','','linkedin'),('Pinterest','','pinterest'),('Twitter','','twitter'),('YouTube','','youtube');
/*!40000 ALTER TABLE `social_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `phone_text_capable` tinyint(4) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirm_code` char(80) DEFAULT NULL,
  `role` enum('developer','administrator','manager','blogger','user') NOT NULL DEFAULT 'user',
  `status` enum('unconfirmed','confirmed','banned') NOT NULL DEFAULT 'unconfirmed',
  `name` varchar(64) NOT NULL DEFAULT 'Anonymous',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'nick@nickniebaum.com','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','Nick','Niebaum',NULL,0,'2014-10-14 13:12:21','2014-10-14 13:12:21',NULL,NULL,'administrator','confirmed','Anonymous'),(2,'mike@lifthousedesign.com','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','Mike','Beattie',NULL,0,'0000-00-00 00:00:00',NULL,NULL,NULL,'administrator','unconfirmed','Anonymous'),(3,'tara@lifthousedesign.com','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','Tara','Beattie',NULL,0,'0000-00-00 00:00:00','2014-07-24 14:27:17','2014-07-24 14:27:17',NULL,'administrator','unconfirmed','Anonymous');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-14 15:45:12
