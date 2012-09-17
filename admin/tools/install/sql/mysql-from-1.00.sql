alter TABLE active_sessions add column dl_count int(11);
alter TABLE active_sessions add column dl_byte_count int(11);

alter table other_userprefs add column  `user_phone` varchar(30) NOT NULL;
alter table other_userprefs add column  `user_department` varchar(255) NOT NULL;
alter table other_userprefs add column  `user_address` varchar(255) NOT NULL;
alter table other_userprefs add column  `user_note` text NOT NULL;

alter table prefs add column `docRel` int(4) default NULL;
alter table prefs add column `ppttotext_path` varchar(80) default NULL;
update users set buttonstyle = 'Roma 2011';
update html set owl_logo = 'doxbox_Logo.png';

CREATE TABLE `ext_dictionary` (
  `idDictionary` int(11) NOT NULL AUTO_INCREMENT,
  `tableName` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idDictionary`),
  KEY `idDictionary` (`idDictionary`),
  KEY `tableName` (`tableName`),
  KEY `description` (`description`)
);

INSERT INTO `ext_dictionary` VALUES (1,'ut_entities','Entities');

CREATE TABLE `ut_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) NOT NULL DEFAULT '',
  `descr2` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
);

INSERT INTO `ut_entities` VALUES (1,'Chevy Impala',''),(2,'Eagle Talon TSI',''),(3,'Corvette',''),(4,'Mazaratti',''),(13,'Ford Edge',''),(12,'BMW M5','');

alter table files add column `name_search` varchar(255) NOT NULL;
alter table files add column `filename_search` varchar(255) NOT NULL;
alter table files add column `description_search` varchar(255) NOT NULL;
alter table files add column `metadata_search` varchar(255) NOT NULL;

CREATE TABLE `docRel` (
  `docRel_id` int(4) NOT NULL AUTO_INCREMENT,
  `file_id` int(4) NOT NULL DEFAULT '0',
  `related_file_id` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`docRel_id`)
);

