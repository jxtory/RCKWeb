/*
MySQL Data Transfer
Source Host: localhost
Source Database: cnpse
Target Host: localhost
Target Database: cnpse
Date: 2018/10/22 21:55:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cnpse_column
-- ----------------------------
CREATE TABLE `cnpse_column` (
  `id` int(11) NOT NULL,
  `columnname` text NOT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cnpse_contents
-- ----------------------------
CREATE TABLE `cnpse_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `cid` int(11) NOT NULL,
  `purl` varchar(255) DEFAULT NULL,
  `content` text,
  `createtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cnpse_contenttop
-- ----------------------------
CREATE TABLE `cnpse_contenttop` (
  `cid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cnpse_subpages
-- ----------------------------
CREATE TABLE `cnpse_subpages` (
  `title` varchar(50) NOT NULL,
  `content` text,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cnpse_users
-- ----------------------------
CREATE TABLE `cnpse_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `regtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 DELAY_KEY_WRITE=1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `cnpse_column` VALUES ('1', '通知公告', null);
INSERT INTO `cnpse_column` VALUES ('2', '资讯聚焦', null);
INSERT INTO `cnpse_column` VALUES ('3', '政策法规', null);
INSERT INTO `cnpse_column` VALUES ('4', '机构公告', '1');
INSERT INTO `cnpse_column` VALUES ('5', '培训招生', '1');
INSERT INTO `cnpse_column` VALUES ('6', '中心要闻', '2');
INSERT INTO `cnpse_column` VALUES ('7', '最新资讯', '2');
INSERT INTO `cnpse_column` VALUES ('8', '视频中心', '2');
INSERT INTO `cnpse_column` VALUES ('9', '国家政策', '3');
INSERT INTO `cnpse_column` VALUES ('10', '部委法规', '3');
INSERT INTO `cnpse_column` VALUES ('11', '中心规章', '3');
