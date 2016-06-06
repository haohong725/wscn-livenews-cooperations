# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.27)
# Database: zhongxinjiantou
# Generation Time: 2016-06-06 02:52:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table livenews
# ------------------------------------------------------------

CREATE TABLE `livenews` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('deleted','draft','published','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `importance` smallint(1) NOT NULL DEFAULT '0',
  `flag` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visibility` enum('public','private','password') COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('news','data') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'news',
  `codeType` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'markdown',
  `language` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'en',
  `parentId` int(10) DEFAULT '0',
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortOrder` int(10) DEFAULT '0',
  `createdAt` int(10) NOT NULL,
  `birthAt` int(10) DEFAULT NULL COMMENT '记录createdAt时间，（现有createdAt意为publishedAt，历史遗留问题',
  `userId` bigint(19) DEFAULT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedAt` int(10) DEFAULT NULL,
  `editorId` bigint(19) DEFAULT NULL,
  `editorName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentStatus` enum('open','closed','authority') COLLATE utf8_unicode_ci DEFAULT 'open',
  `commentType` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'local',
  `commentCount` int(10) DEFAULT '0',
  `viewCount` bigint(20) DEFAULT '0',
  `shareCount` int(10) NOT NULL DEFAULT '0',
  `imageId` int(10) DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageCount` int(2) NOT NULL DEFAULT '0',
  `videoId` int(11) NOT NULL DEFAULT '0',
  `video` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `videoCount` tinyint(2) NOT NULL DEFAULT '0',
  `summary` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `sourceName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sourceUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorySet` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hasMore` tinyint(1) NOT NULL DEFAULT '0',
  `extra` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channelSet` varchar(200) COLLATE utf8_unicode_ci DEFAULT '1',
  `detailNid` int(10) DEFAULT NULL,
  `contentExtra` text COLLATE utf8_unicode_ci,
  `contentFollowup` text COLLATE utf8_unicode_ci,
  `contentAnalysis` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `categorySet` (`categorySet`(255)),
  KEY `updatedAt` (`updatedAt`),
  KEY `channelSet` (`channelSet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
