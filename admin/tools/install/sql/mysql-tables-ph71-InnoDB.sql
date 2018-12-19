-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: prototype
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `active_sessions`
--

DROP TABLE IF EXISTS `active_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_sessions` (
  `sessid` char(32) NOT NULL DEFAULT '',
  `usid` char(25) DEFAULT NULL,
  `lastused` int(10) unsigned DEFAULT NULL,
  `ip` char(45) DEFAULT NULL,
  `currentdb` int(4) DEFAULT NULL,
  `dl_count` int(11) NOT NULL,
  `dl_byte_count` int(11) NOT NULL,
  PRIMARY KEY (`sessid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_sessions`
--

LOCK TABLES `active_sessions` WRITE;
/*!40000 ALTER TABLE `active_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `active_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advanced_acl`
--

DROP TABLE IF EXISTS `advanced_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advanced_acl` (
  `group_id` int(4) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `file_id` int(4) DEFAULT NULL,
  `folder_id` int(4) DEFAULT NULL,
  `owlread` int(4) DEFAULT '0',
  `owlwrite` int(4) DEFAULT '0',
  `owlviewlog` int(4) DEFAULT '0',
  `owldelete` int(4) DEFAULT '0',
  `owlcopy` int(4) DEFAULT '0',
  `owlmove` int(4) DEFAULT '0',
  `owlproperties` int(4) DEFAULT '0',
  `owlupdate` int(4) DEFAULT '0',
  `owlcomment` int(4) DEFAULT '0',
  `owlcheckin` int(4) DEFAULT '0',
  `owlemail` int(4) DEFAULT '0',
  `owlrelsearch` int(4) DEFAULT '0',
  `owlsetacl` int(4) DEFAULT '0',
  `owlmonitor` int(4) DEFAULT '0',
  KEY `acl_folderid` (`folder_id`),
  KEY `acl_fileid` (`file_id`),
  KEY `acl_userid` (`user_id`),
  KEY `acl_groupid_index` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advanced_acl`
--

LOCK TABLES `advanced_acl` WRITE;
/*!40000 ALTER TABLE `advanced_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `advanced_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `fid` int(4) NOT NULL DEFAULT '0',
  `userid` int(4) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docRel`
--

DROP TABLE IF EXISTS `docRel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docRel` (
  `docRel_id` int(4) NOT NULL AUTO_INCREMENT,
  `file_id` int(4) NOT NULL DEFAULT '0',
  `related_file_id` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`docRel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docRel`
--

LOCK TABLES `docRel` WRITE;
/*!40000 ALTER TABLE `docRel` DISABLE KEYS */;
/*!40000 ALTER TABLE `docRel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docfields`
--

DROP TABLE IF EXISTS `docfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docfields` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `doc_type_id` int(4) NOT NULL DEFAULT '0',
  `field_name` varchar(80) NOT NULL DEFAULT '',
  `field_position` int(4) NOT NULL DEFAULT '0',
  `field_type` varchar(80) NOT NULL DEFAULT '',
  `field_values` text NOT NULL,
  `field_size` bigint(20) NOT NULL DEFAULT '0',
  `searchable` int(4) NOT NULL DEFAULT '0',
  `show_desc` int(4) NOT NULL DEFAULT '0',
  `required` int(4) NOT NULL DEFAULT '0',
  `show_in_list` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_name` (`field_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docfields`
--

LOCK TABLES `docfields` WRITE;
/*!40000 ALTER TABLE `docfields` DISABLE KEYS */;
INSERT INTO `docfields` VALUES (4,45,'A',1,'text','A',40,0,1,1,1),(5,45,'B',2,'picklist','1|2|3|4|',1,0,0,1,1),(6,45,'C',3,'radio','M|F',10,1,1,1,1),(7,45,'D',4,'textarea','Enter your Data here 4',10,0,0,1,1),(11,45,'E',5,'checkbox','Insured',11,0,0,1,1),(12,45,'F',6,'mcheckbox','A|B|C|D|E|F|G',3,0,0,1,1),(14,45,'G',7,'seperator','Some VALUE FOR SEPERATOR',12,0,0,0,1),(16,45,'H',8,'url','BOZZ IT|http://www.bozzit.com',30,0,0,0,1),(17,45,'I',9,'date','',20,0,0,1,1),(19,45,'J',10,'table','ut_entities',40,0,0,1,1);
/*!40000 ALTER TABLE `docfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docfieldslabel`
--

DROP TABLE IF EXISTS `docfieldslabel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docfieldslabel` (
  `doc_field_id` int(4) NOT NULL DEFAULT '0',
  `field_label` char(80) NOT NULL DEFAULT '',
  `locale` char(80) NOT NULL DEFAULT '',
  KEY `doc_field_id` (`doc_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docfieldslabel`
--

LOCK TABLES `docfieldslabel` WRITE;
/*!40000 ALTER TABLE `docfieldslabel` DISABLE KEYS */;
INSERT INTO `docfieldslabel` VALUES (4,'A','TMP'),(4,'A','English'),(5,'B','TMP'),(5,'B','English'),(6,'C','English'),(6,'C','TMP'),(7,'D','TMP'),(7,'D','English'),(11,'E','TMP'),(11,'E','English'),(12,'F','TMP'),(12,'F','English'),(14,'G','TMP'),(14,'G','English'),(16,'H','TMP'),(16,'H','English'),(17,'I','TMP'),(17,'I','English'),(19,'J','TMP'),(19,'J','English'),(20,'J','English'),(20,'J','TMP'),(21,'J','English'),(21,'J','TMP');
/*!40000 ALTER TABLE `docfieldslabel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docfieldvalues`
--

DROP TABLE IF EXISTS `docfieldvalues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docfieldvalues` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `file_id` int(4) NOT NULL DEFAULT '0',
  `field_name` varchar(80) NOT NULL DEFAULT '',
  `field_value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `docvalue_fileid` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docfieldvalues`
--

LOCK TABLES `docfieldvalues` WRITE;
/*!40000 ALTER TABLE `docfieldvalues` DISABLE KEYS */;
/*!40000 ALTER TABLE `docfieldvalues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctype`
--

DROP TABLE IF EXISTS `doctype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctype` (
  `doc_type_id` int(4) NOT NULL AUTO_INCREMENT,
  `doc_type_name` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`doc_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctype`
--

LOCK TABLES `doctype` WRITE;
/*!40000 ALTER TABLE `doctype` DISABLE KEYS */;
INSERT INTO `doctype` VALUES (1,'Default'),(45,'A');
/*!40000 ALTER TABLE `doctype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_dictionary`
--

DROP TABLE IF EXISTS `ext_dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_dictionary` (
  `idDictionary` int(11) NOT NULL AUTO_INCREMENT,
  `tableName` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idDictionary`),
  KEY `idDictionary` (`idDictionary`),
  KEY `tableName` (`tableName`),
  KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_dictionary`
--

LOCK TABLES `ext_dictionary` WRITE;
/*!40000 ALTER TABLE `ext_dictionary` DISABLE KEYS */;
INSERT INTO `ext_dictionary` VALUES (1,'ut_entities','Entities');
/*!40000 ALTER TABLE `ext_dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `userid` int(4) NOT NULL DEFAULT '0',
  `folder_id` int(4) NOT NULL DEFAULT '1',
  `fav_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_checksum`
--

DROP TABLE IF EXISTS `file_checksum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_checksum` (
  `file_id` int(4) NOT NULL DEFAULT '0',
  `hash1` text,
  `hash2` text,
  `hash3` text,
  `signature` text,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_checksum`
--

LOCK TABLES `file_checksum` WRITE;
/*!40000 ALTER TABLE `file_checksum` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_checksum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filedata`
--

DROP TABLE IF EXISTS `filedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filedata` (
  `id` int(4) NOT NULL DEFAULT '0',
  `compressed` int(4) NOT NULL DEFAULT '0',
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filedata`
--

LOCK TABLES `filedata` WRITE;
/*!40000 ALTER TABLE `filedata` DISABLE KEYS */;
/*!40000 ALTER TABLE `filedata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL DEFAULT '',
  `f_size` bigint(20) NOT NULL DEFAULT '0',
  `creatorid` int(4) NOT NULL DEFAULT '0',
  `parent` int(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `metadata` text NOT NULL,
  `security` int(4) NOT NULL DEFAULT '0',
  `groupid` int(4) NOT NULL DEFAULT '0',
  `smodified` datetime DEFAULT NULL,
  `checked_out` int(4) NOT NULL DEFAULT '0',
  `major_revision` int(4) NOT NULL DEFAULT '0',
  `minor_revision` int(4) NOT NULL DEFAULT '1',
  `url` int(4) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '',
  `doctype` int(4) DEFAULT NULL,
  `updatorid` int(4) DEFAULT NULL,
  `linkedto` int(4) DEFAULT NULL,
  `approved` int(4) DEFAULT NULL,
  `infected` int(4) DEFAULT '0',
  `expires` datetime DEFAULT NULL,
  `name_search` varchar(255) DEFAULT NULL,
  `metadata_search` text,
  `description_search` text,
  `filename_search` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_filetype` (`url`),
  KEY `creatorid` (`creatorid`),
  KEY `parent` (`parent`),
  KEY `groupid` (`groupid`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `filename` (`filename`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `metadata` (`metadata`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folders` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `parent` int(4) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `security` varchar(5) NOT NULL DEFAULT '',
  `groupid` int(4) NOT NULL DEFAULT '0',
  `creatorid` int(4) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '',
  `smodified` datetime DEFAULT NULL,
  `linkedto` int(4) DEFAULT NULL,
  `rss_feed` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `groupid` (`groupid`),
  KEY `creatorid` (`creatorid`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=1931 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folders`
--

LOCK TABLES `folders` WRITE;
/*!40000 ALTER TABLE `folders` DISABLE KEYS */;
INSERT INTO `folders` VALUES (1,'Documents',0,'','51',0,1,'','2005-04-22 08:13:42',0,NULL);
/*!40000 ALTER TABLE `folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (0,'Administrators'),(1,'Anonymous'),(2,'File Admin'),(3,'Users');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `html`
--

DROP TABLE IF EXISTS `html`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `html` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `table_expand_width` char(15) DEFAULT NULL,
  `table_collapse_width` char(15) DEFAULT NULL,
  `body_background` char(255) DEFAULT NULL,
  `owl_logo` char(255) DEFAULT NULL,
  `body_textcolor` char(15) DEFAULT NULL,
  `body_link` char(15) DEFAULT NULL,
  `body_vlink` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `html`
--

LOCK TABLES `html` WRITE;
/*!40000 ALTER TABLE `html` DISABLE KEYS */;
INSERT INTO `html` VALUES (1,'100%','90%','BODY','doxbox_Logo.png','','','');
/*!40000 ALTER TABLE `html` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membergroup`
--

DROP TABLE IF EXISTS `membergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membergroup` (
  `userid` int(4) NOT NULL DEFAULT '0',
  `groupid` int(4) DEFAULT NULL,
  `groupadmin` int(4) DEFAULT NULL,
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membergroup`
--

LOCK TABLES `membergroup` WRITE;
/*!40000 ALTER TABLE `membergroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `membergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metakeywords`
--

DROP TABLE IF EXISTS `metakeywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metakeywords` (
  `keyword_id` int(4) NOT NULL AUTO_INCREMENT,
  `keyword_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metakeywords`
--

LOCK TABLES `metakeywords` WRITE;
/*!40000 ALTER TABLE `metakeywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `metakeywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mimes`
--

DROP TABLE IF EXISTS `mimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mimes` (
  `filetype` char(10) NOT NULL DEFAULT '',
  `mimetype` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`filetype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mimes`
--

LOCK TABLES `mimes` WRITE;
/*!40000 ALTER TABLE `mimes` DISABLE KEYS */;
INSERT INTO `mimes` VALUES ('ai','application/postscript'),('aif','audio/x-aiff'),('aifc','audio/x-aiff'),('aiff','audio/x-aiff'),('asc','text/plain'),('au','audio/basic'),('avi','video/x-msvideo'),('bcpio','application/x-bcpio'),('bin','application/octet-stream'),('bmp','image/bmp'),('cdf','application/x-netcdf'),('class','application/octet-stream'),('cpio','application/x-cpio'),('cpt','application/mac-compactpro'),('csh','application/x-csh'),('css','text/css'),('dcr','application/x-director'),('dir','application/x-director'),('dms','application/octet-stream'),('doc','application/msword'),('docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document'),('dvi','application/x-dvi'),('dxr','application/x-director'),('eps','application/postscript'),('etx','text/x-setext'),('exe','application/octet-stream'),('ez','application/andrew-inset'),('gif','image/gif'),('gtar','application/x-gtar'),('gz','application/x-gzip'),('hdf','application/x-hdf'),('hqx','application/mac-binhex40'),('htm','text/html'),('html','text/html'),('ice','x-conference/x-cooltalk'),('ief','image/ief'),('iges','model/iges'),('igs','model/iges'),('jpe','image/jpeg'),('jpeg','image/jpeg'),('jpg','image/jpeg'),('js','application/x-javascript'),('kar','audio/midi'),('latex','application/x-latex'),('lha','application/octet-stream'),('lzh','application/octet-stream'),('man','application/x-troff-man'),('me','application/x-troff-me'),('mesh','model/mesh'),('mid','audio/midi'),('midi','audio/midi'),('mif','application/vnd.mif'),('mov','video/quicktime'),('movie','video/x-sgi-movie'),('mp2','audio/mpeg'),('mp3','audio/mpeg'),('mpe','video/mpeg'),('mpeg','video/mpeg'),('mpg','video/mpeg'),('mpga','audio/mpeg'),('ms','application/x-troff-ms'),('msh','model/mesh'),('nc','application/x-netcdf'),('oda','application/oda'),('pbm','image/x-portable-bitmap'),('pdb','chemical/x-pdb'),('pdf','application/pdf'),('pgm','image/x-portable-graymap'),('pgn','application/x-chess-pgn'),('png','image/png'),('pnm','image/x-portable-anymap'),('ppm','image/x-portable-pixmap'),('ppt','application/vnd.ms-powerpoint'),('pptx','application/vnd.openxmlformats-officedocument.presentationml.presentation'),('ps','application/postscript'),('qt','video/quicktime'),('ra','audio/x-realaudio'),('ram','audio/x-pn-realaudio'),('ras','image/x-cmu-raster'),('rgb','image/x-rgb'),('rm','audio/x-pn-realaudio'),('roff','application/x-troff'),('rpm','audio/x-pn-realaudio-plugin'),('rtf','text/rtf'),('rtx','text/richtext'),('sgm','text/sgml'),('sgml','text/sgml'),('sh','application/x-sh'),('shar','application/x-shar'),('silo','model/mesh'),('sit','application/x-stuffit'),('skd','application/x-koan'),('skm','application/x-koan'),('skp','application/x-koan'),('skt','application/x-koan'),('smi','application/smil'),('smil','application/smil'),('snd','audio/basic'),('spl','application/x-futuresplash'),('src','application/x-wais-source'),('stc','application/vnd.sun.xml.calc.template'),('std','application/vnd.sun.xml.draw.template'),('sti','application/vnd.sun.xml.impress.template'),('stw','application/vnd.sun.xml.writer.template'),('sv4cpio','application/x-sv4cpio'),('sv4crc','application/x-sv4crc'),('swf','application/x-shockwave-flash'),('sxc','application/vnd.sun.xml.calc'),('sxd','application/vnd.sun.xml.draw'),('sxg','application/vnd.sun.xml.writer.global'),('sxi','application/vnd.sun.xml.impress'),('sxm','application/vnd.sun.xml.math'),('sxw','application/vnd.sun.xml.writer'),('t','application/x-troff'),('tar','application/x-tar'),('tcl','application/x-tcl'),('tex','application/x-tex'),('texi','application/x-texinfo'),('texinfo','application/x-texinfo'),('tgz','application/x-gzip'),('tif','image/tiff'),('tiff','image/tiff'),('tr','application/x-troff'),('tsv','text/tab-separated-values'),('txt','text/plain'),('ustar','application/x-ustar'),('vcd','application/x-cdlink'),('vrml','model/vrml'),('wav','audio/x-wav'),('wpd','application/wordperfect'),('wrl','model/vrml'),('xbm','image/x-xbitmap'),('xls','application/vnd.ms-excel'),('xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),('xml','text/xml'),('xpm','image/x-xpixmap'),('xwd','image/x-xwindowdump'),('xyz','chemical/x-pdb'),('zip','application/zip');
/*!40000 ALTER TABLE `mimes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitored_file`
--

DROP TABLE IF EXISTS `monitored_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitored_file` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `userid` int(4) NOT NULL DEFAULT '0',
  `fid` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitored_file`
--

LOCK TABLES `monitored_file` WRITE;
/*!40000 ALTER TABLE `monitored_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitored_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitored_folder`
--

DROP TABLE IF EXISTS `monitored_folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitored_folder` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `userid` int(4) NOT NULL DEFAULT '0',
  `fid` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitored_folder`
--

LOCK TABLES `monitored_folder` WRITE;
/*!40000 ALTER TABLE `monitored_folder` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitored_folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `gid` int(4) NOT NULL DEFAULT '0',
  `news_title` varchar(255) NOT NULL DEFAULT '',
  `news_date` datetime DEFAULT NULL,
  `news` text NOT NULL,
  `news_end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (20,-1,'XTPL Created news','2011-05-18 08:51:02','Only Edit Left','2011-05-31 10:39:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other_userprefs`
--

DROP TABLE IF EXISTS `other_userprefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other_userprefs` (
  `upref_id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) DEFAULT NULL,
  `email_sig` text,
  `user_phone` varchar(30) NOT NULL,
  `user_department` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_note` text NOT NULL,
  PRIMARY KEY (`upref_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_userprefs`
--

LOCK TABLES `other_userprefs` WRITE;
/*!40000 ALTER TABLE `other_userprefs` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_userprefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owl_log`
--

DROP TABLE IF EXISTS `owl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owl_log` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `userid` int(4) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `parent` int(4) DEFAULT NULL,
  `action` varchar(40) DEFAULT NULL,
  `details` text,
  `ip` varchar(45) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `logdate` datetime DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `filesize` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `parent` (`parent`),
  KEY `action` (`action`),
  KEY `logdate` (`logdate`)
) ENGINE=InnoDB AUTO_INCREMENT=2670 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owl_log`
--

LOCK TABLES `owl_log` WRITE;
/*!40000 ALTER TABLE `owl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `owl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peerreview`
--

DROP TABLE IF EXISTS `peerreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peerreview` (
  `reviewer_id` int(4) NOT NULL DEFAULT '0',
  `file_id` int(4) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '0',
  KEY `reviewer_id` (`reviewer_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peerreview`
--

LOCK TABLES `peerreview` WRITE;
/*!40000 ALTER TABLE `peerreview` DISABLE KEYS */;
/*!40000 ALTER TABLE `peerreview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefs`
--

DROP TABLE IF EXISTS `prefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefs` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `email_from` varchar(80) DEFAULT NULL,
  `email_fromname` varchar(80) DEFAULT NULL,
  `email_replyto` varchar(80) DEFAULT NULL,
  `email_server` varchar(80) DEFAULT NULL,
  `email_subject` varchar(60) DEFAULT NULL,
  `lookathd` varchar(15) DEFAULT NULL,
  `lookathddel` int(4) DEFAULT NULL,
  `def_file_security` int(4) DEFAULT NULL,
  `def_file_group_owner` int(4) DEFAULT NULL,
  `def_file_owner` int(4) DEFAULT NULL,
  `def_file_title` varchar(40) DEFAULT NULL,
  `def_file_meta` varchar(40) DEFAULT NULL,
  `def_fold_security` int(4) DEFAULT NULL,
  `def_fold_group_owner` int(4) DEFAULT NULL,
  `def_fold_owner` int(4) DEFAULT NULL,
  `max_filesize` int(4) DEFAULT NULL,
  `tmpdir` varchar(255) DEFAULT NULL,
  `timeout` int(4) DEFAULT NULL,
  `expand` int(4) DEFAULT NULL,
  `version_control` int(4) DEFAULT NULL,
  `restrict_view` int(4) DEFAULT NULL,
  `hide_backup` int(4) DEFAULT NULL,
  `dbdump_path` varchar(512) DEFAULT NULL,
  `gzip_path` varchar(512) DEFAULT NULL,
  `tar_path` varchar(512) DEFAULT NULL,
  `unzip_path` varchar(512) DEFAULT NULL,
  `pod2html_path` varchar(512) DEFAULT NULL,
  `pdftotext_path` varchar(512) DEFAULT NULL,
  `wordtotext_path` varchar(512) DEFAULT NULL,
  `ppttotext_path` varchar(512) DEFAULT NULL,
  `file_perm` int(4) DEFAULT NULL,
  `folder_perm` int(4) DEFAULT NULL,
  `logging` int(4) DEFAULT NULL,
  `log_file` int(4) DEFAULT NULL,
  `log_login` int(4) DEFAULT NULL,
  `log_rec_per_page` int(4) DEFAULT NULL,
  `rec_per_page` int(4) DEFAULT NULL,
  `self_reg` int(4) DEFAULT NULL,
  `self_reg_quota` int(4) DEFAULT NULL,
  `self_reg_notify` int(4) DEFAULT NULL,
  `self_reg_attachfile` int(4) DEFAULT NULL,
  `self_reg_disabled` int(4) DEFAULT NULL,
  `self_reg_noprefacces` int(4) DEFAULT NULL,
  `self_reg_maxsessions` int(4) DEFAULT NULL,
  `self_reg_group` int(4) DEFAULT NULL,
  `anon_ro` int(4) DEFAULT NULL,
  `anon_user` int(4) DEFAULT NULL,
  `file_admin_group` int(4) DEFAULT NULL,
  `forgot_pass` int(4) DEFAULT NULL,
  `collect_trash` int(4) DEFAULT NULL,
  `trash_can_location` varchar(512) DEFAULT NULL,
  `allow_popup` int(4) DEFAULT NULL,
  `allow_custpopup` int(5) DEFAULT NULL,
  `status_bar_location` int(4) DEFAULT NULL,
  `remember_me` int(4) DEFAULT NULL,
  `cookie_timeout` int(4) DEFAULT NULL,
  `use_smtp` int(4) DEFAULT NULL,
  `use_smtp_auth` int(4) DEFAULT NULL,
  `smtp_passwd` varchar(40) DEFAULT NULL,
  `search_bar` int(4) DEFAULT NULL,
  `bulk_buttons` int(4) DEFAULT NULL,
  `action_buttons` int(4) DEFAULT NULL,
  `folder_tools` int(4) DEFAULT NULL,
  `pref_bar` int(4) DEFAULT NULL,
  `smtp_auth_login` varchar(50) DEFAULT NULL,
  `expand_disp_status` int(4) DEFAULT NULL,
  `expand_disp_doc_num` int(4) DEFAULT NULL,
  `expand_disp_doc_type` int(4) DEFAULT NULL,
  `expand_disp_title` int(4) DEFAULT NULL,
  `expand_disp_version` int(4) DEFAULT NULL,
  `expand_disp_file` int(4) DEFAULT NULL,
  `expand_disp_size` int(4) DEFAULT NULL,
  `expand_disp_posted` int(4) DEFAULT NULL,
  `expand_disp_modified` int(4) DEFAULT NULL,
  `expand_disp_action` int(4) DEFAULT NULL,
  `expand_disp_held` int(4) DEFAULT NULL,
  `collapse_disp_status` int(4) DEFAULT NULL,
  `collapse_disp_doc_num` int(4) DEFAULT NULL,
  `collapse_disp_doc_type` int(4) DEFAULT NULL,
  `collapse_disp_title` int(4) DEFAULT NULL,
  `collapse_disp_version` int(4) DEFAULT NULL,
  `collapse_disp_file` int(4) DEFAULT NULL,
  `collapse_disp_size` int(4) DEFAULT NULL,
  `collapse_disp_posted` int(4) DEFAULT NULL,
  `collapse_disp_modified` int(4) DEFAULT NULL,
  `collapse_disp_action` int(4) DEFAULT NULL,
  `collapse_disp_held` int(4) DEFAULT NULL,
  `expand_search_disp_score` int(4) DEFAULT NULL,
  `expand_search_disp_folder_path` int(4) DEFAULT NULL,
  `expand_search_disp_doc_type` int(4) DEFAULT NULL,
  `expand_search_disp_file` int(4) DEFAULT NULL,
  `expand_search_disp_size` int(4) DEFAULT NULL,
  `expand_search_disp_posted` int(4) DEFAULT NULL,
  `expand_search_disp_modified` int(4) DEFAULT NULL,
  `expand_search_disp_action` int(4) DEFAULT NULL,
  `collapse_search_disp_score` int(4) DEFAULT NULL,
  `colps_search_disp_fld_path` int(4) DEFAULT NULL,
  `collapse_search_disp_doc_type` int(4) DEFAULT NULL,
  `collapse_search_disp_file` int(4) DEFAULT NULL,
  `collapse_search_disp_size` int(4) DEFAULT NULL,
  `collapse_search_disp_posted` int(4) DEFAULT NULL,
  `collapse_search_disp_modified` int(4) DEFAULT NULL,
  `collapse_search_disp_action` int(4) DEFAULT NULL,
  `hide_folder_doc_count` int(4) DEFAULT NULL,
  `old_action_icons` int(4) DEFAULT NULL,
  `search_result_folders` int(4) DEFAULT NULL,
  `restore_file_prefix` varchar(50) DEFAULT NULL,
  `major_revision` int(4) DEFAULT NULL,
  `minor_revision` int(4) DEFAULT NULL,
  `doc_id_prefix` varchar(10) DEFAULT NULL,
  `doc_id_num_digits` int(4) DEFAULT NULL,
  `view_doc_in_new_window` int(4) DEFAULT NULL,
  `admin_login_to_browse_page` int(4) DEFAULT NULL,
  `save_keywords_to_db` int(4) DEFAULT NULL,
  `self_reg_homedir` int(4) DEFAULT NULL,
  `self_reg_firstdir` int(4) DEFAULT NULL,
  `virus_path` varchar(512) DEFAULT NULL,
  `peer_review` int(4) DEFAULT NULL,
  `peer_opt` int(4) DEFAULT NULL,
  `folder_size` int(4) DEFAULT NULL,
  `download_folder_zip` int(4) DEFAULT NULL,
  `display_password_override` int(4) DEFAULT NULL,
  `thumb_disp_status` int(4) DEFAULT NULL,
  `thumb_disp_doc_num` int(4) DEFAULT NULL,
  `thumb_disp_image_info` int(4) DEFAULT NULL,
  `thumb_disp_version` int(4) DEFAULT NULL,
  `thumb_disp_size` int(4) DEFAULT NULL,
  `thumb_disp_posted` int(4) DEFAULT NULL,
  `thumb_disp_modified` int(4) DEFAULT NULL,
  `thumb_disp_action` int(4) DEFAULT NULL,
  `thumb_disp_held` int(4) DEFAULT NULL,
  `thumbnails_tool_path` varchar(512) DEFAULT NULL,
  `thumbnails_video_tool_path` varchar(512) DEFAULT NULL,
  `thumbnails_video_tool_opt` varchar(512) DEFAULT NULL,
  `thumbnails` int(4) DEFAULT NULL,
  `thumbnails_small_width` int(4) DEFAULT NULL,
  `thumbnails_med_width` int(4) DEFAULT NULL,
  `thumbnails_large_width` int(4) DEFAULT NULL,
  `thumbnail_view_columns` int(4) DEFAULT NULL,
  `rtftotext_path` varchar(512) DEFAULT NULL,
  `min_pass_length` int(4) DEFAULT NULL,
  `min_username_length` int(4) DEFAULT NULL,
  `min_pass_numeric` int(4) DEFAULT NULL,
  `min_pass_special` int(4) DEFAULT NULL,
  `enable_lock_account` int(4) DEFAULT NULL,
  `lock_account_bad_password` int(4) DEFAULT NULL,
  `track_user_passwords` int(4) DEFAULT NULL,
  `change_password_every` int(4) DEFAULT NULL,
  `folderdescreq` int(4) DEFAULT NULL,
  `show_user_info` int(4) DEFAULT NULL,
  `filedescreq` int(4) DEFAULT NULL,
  `collapse_search_disp_doc_num` int(4) DEFAULT NULL,
  `expand_search_disp_doc_num` int(4) DEFAULT NULL,
  `colps_search_disp_doc_fields` int(4) DEFAULT NULL,
  `expand_search_disp_doc_fields` int(4) DEFAULT NULL,
  `collapse_disp_doc_fields` int(4) DEFAULT NULL,
  `expand_disp_doc_fields` int(4) DEFAULT NULL,
  `self_create_homedir` int(4) DEFAULT NULL,
  `self_captcha` int(4) DEFAULT NULL,
  `info_panel_wide` int(4) DEFAULT NULL,
  `track_favorites` int(4) DEFAULT NULL,
  `expand_disp_updated` int(4) DEFAULT NULL,
  `collapse_disp_updated` int(4) DEFAULT NULL,
  `expand_search_disp_updated` int(4) DEFAULT NULL,
  `collapse_search_disp_updated` int(4) DEFAULT NULL,
  `thumb_disp_updated` int(4) DEFAULT NULL,
  `default_revision` int(4) DEFAULT NULL,
  `pdf_watermark_path` varchar(512) DEFAULT NULL,
  `pdf_custom_watermark_filepath` varchar(512) DEFAULT NULL,
  `pdf_watermarks` int(4) DEFAULT NULL,
  `pdf_pdftk_tool_greater_than_1_40` int(4) DEFAULT NULL,
  `machine_time_zone` int(4) DEFAULT NULL,
  `show_folder_desc_as_popup` int(4) DEFAULT NULL,
  `make_file_indexing_user_selectable` int(4) DEFAULT NULL,
  `turn_file_index_off` int(4) DEFAULT NULL,
  `use_wysiwyg_for_textarea` int(4) DEFAULT NULL,
  `force_ssl` int(4) DEFAULT NULL,
  `smtp_ssl` int(11) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT NULL,
  `leave_old_file_accessible` int(11) DEFAULT NULL,
  `auto_checkout_checking` int(4) DEFAULT NULL,
  `different_filename_update` int(4) DEFAULT NULL,
  `owl_maintenance_mode` int(4) DEFAULT NULL,
  `smtp_max_size` varchar(15) DEFAULT NULL,
  `motd` text,
  `docRel` int(4) DEFAULT NULL,
  `dl_count` int(11) NOT NULL,
  `dl_block` int(11) NOT NULL,
  `dl_count_trigger` int(11) NOT NULL,
  `dl_size_trigger` int(11) NOT NULL,
  `dl_notification_list` varchar(512) NOT NULL,
  `dl_len` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefs`
--

LOCK TABLES `prefs` WRITE;
/*!40000 ALTER TABLE `prefs` DISABLE KEYS */;
INSERT INTO `prefs` VALUES (1,'owl@yourdomain.com','OWL','owl@yourdomain.com','localhost','[OWL] : AUTOMATED MAIL','true',1,0,0,1,'','',0,0,1,0,'/tmp',9000,1,1,0,1,'/usr/bin/mysqldump','/bin/gzip','/bin/tar','/usr/bin/unzip','/usr/bin/perl','/usr/bin/pdftotext','/usr/bin/antiword','/usr/bin/catppt',0,0,1,1,1,25,0,1,0,0,0,0,0,-1,0,2,2,2,1,0,'/u01/sites/sandbox/htdocs/bozz/doxbox-dms/TrashCan',1,1,1,1,10,0,0,'',1,1,1,1,1,'',1,1,1,1,1,1,1,1,1,1,1,0,1,1,0,0,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,0,0,1,0,0,1,'Restored-',1,0,'3',3,1,0,1,1,1,'',1,1,1,0,0,1,1,1,1,1,1,1,1,1,'/usr/bin/convert','/usr/local/bin/mplayer','-vo png -ss 0:05 -frames 2 -nosound -really-quiet',1,100,200,400,4,'/usr/bin/unrtf',0,0,0,0,0,0,0,0,1,1,0,0,1,0,0,0,0,0,0,1,0,1,0,1,0,1,2,'/usr/bin/pdftk','',1,1,-5,0,0,0,0,0,0,'25',0,1,1,0,'5242880','Welcome to BETA 2',0,0,0,0,0,'',0);
/*!40000 ALTER TABLE `prefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `searchidx`
--

DROP TABLE IF EXISTS `searchidx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `searchidx` (
  `wordid` int(4) DEFAULT NULL,
  `owlfileid` int(4) DEFAULT NULL,
  KEY `searchidx_wordid` (`wordid`),
  KEY `searchidx_fileid` (`owlfileid`),
  KEY `searchidx_fidwordid` (`owlfileid`,`wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `searchidx`
--

LOCK TABLES `searchidx` WRITE;
/*!40000 ALTER TABLE `searchidx` DISABLE KEYS */;
/*!40000 ALTER TABLE `searchidx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trackoldpasswd`
--

DROP TABLE IF EXISTS `trackoldpasswd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trackoldpasswd` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `userid` int(4) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trackoldpasswd`
--

LOCK TABLES `trackoldpasswd` WRITE;
/*!40000 ALTER TABLE `trackoldpasswd` DISABLE KEYS */;
/*!40000 ALTER TABLE `trackoldpasswd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_downloads`
--

DROP TABLE IF EXISTS `user_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `dnld_time` datetime DEFAULT NULL,
  `dnld_size` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_downloads`
--

LOCK TABLES `user_downloads` WRITE;
/*!40000 ALTER TABLE `user_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `groupid` varchar(10) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `quota_max` bigint(20) unsigned NOT NULL DEFAULT '0',
  `quota_current` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notify` int(4) DEFAULT NULL,
  `attachfile` int(4) DEFAULT NULL,
  `disabled` int(4) DEFAULT NULL,
  `noprefaccess` int(4) DEFAULT '0',
  `language` varchar(15) DEFAULT NULL,
  `maxsessions` int(4) DEFAULT '0',
  `lastlogin` datetime DEFAULT NULL,
  `curlogin` datetime DEFAULT NULL,
  `lastnews` int(4) NOT NULL DEFAULT '0',
  `newsadmin` int(4) NOT NULL DEFAULT '0',
  `comment_notify` int(4) NOT NULL DEFAULT '0',
  `buttonstyle` varchar(255) DEFAULT NULL,
  `homedir` int(4) DEFAULT NULL,
  `firstdir` int(4) DEFAULT NULL,
  `email_tool` int(4) DEFAULT NULL,
  `change_paswd_at_login` int(4) DEFAULT NULL,
  `login_failed` int(4) DEFAULT NULL,
  `passwd_last_changed` datetime DEFAULT NULL,
  `expire_account` varchar(80) DEFAULT NULL,
  `user_auth` char(2) DEFAULT NULL,
  `logintonewrec` int(4) DEFAULT NULL,
  `groupadmin` int(4) DEFAULT NULL,
  `user_offset` varchar(4) DEFAULT NULL,
  `useradmin` int(4) DEFAULT NULL,
  `viewlogs` int(4) DEFAULT NULL,
  `viewreports` int(4) DEFAULT NULL,
  `user_default_view` int(4) DEFAULT NULL,
  `user_minor_revision` int(4) DEFAULT NULL,
  `user_major_revision` int(4) DEFAULT '1',
  `user_default_revision` int(4) DEFAULT NULL,
  `pdf_watermarks` int(4) DEFAULT NULL,
  `dl_count_excluded` int(4) NOT NULL,
  `user_access` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0','admin','Administrator','21232f297a57a5a743894a0e4a801fc3',0,15681406,'bozz',0,0,0,0,'English',0,'2018-09-27 12:30:14','2018-09-27 12:33:25',8,0,1,'Roma 2012',1,1,1,0,0,'2011-07-04 09:29:08','','0',0,0,'-5',0,0,0,1,0,1,0,0,0,1),(2,'1','guest','Anonymous','21232f297a57a5a743894a0e4a801fc3',0,0,'',0,0,1,0,'English',19,'2004-11-10 05:02:42','2005-10-23 08:22:16',0,0,0,'Roma 2012',1,1,0,0,0,'2005-10-23 08:22:16','','0',0,0,'-12',0,0,0,0,0,1,2,0,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ut_entities`
--

DROP TABLE IF EXISTS `ut_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ut_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) NOT NULL DEFAULT '',
  `descr2` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ut_entities`
--

LOCK TABLES `ut_entities` WRITE;
/*!40000 ALTER TABLE `ut_entities` DISABLE KEYS */;
INSERT INTO `ut_entities` VALUES (1,'Chevy Impala',''),(2,'Eagle Talon TSI',''),(3,'Corvette',''),(4,'Mazaratti',''),(12,'BMW M5',''),(13,'Ford Edge','');
/*!40000 ALTER TABLE `ut_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wordidx`
--

DROP TABLE IF EXISTS `wordidx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wordidx` (
  `wordid` int(4) NOT NULL DEFAULT '0',
  `word` char(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`wordid`),
  UNIQUE KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wordidx`
--

LOCK TABLES `wordidx` WRITE;
/*!40000 ALTER TABLE `wordidx` DISABLE KEYS */;
/*!40000 ALTER TABLE `wordidx` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-27 14:03:41
