/*
MySQL Data Transfer
Source Host: localhost
Source Database: cnpse
Target Host: localhost
Target Database: cnpse
Date: 2018/10/14 0:25:15
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `top1` int(11) DEFAULT NULL,
  `top2` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top4` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 DELAY_KEY_WRITE=1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `cnpse_column` VALUES ('1', '机构介绍', null);
INSERT INTO `cnpse_column` VALUES ('2', '通知公告', null);
INSERT INTO `cnpse_column` VALUES ('3', '资讯聚焦', null);
INSERT INTO `cnpse_column` VALUES ('4', '政策法规', null);
INSERT INTO `cnpse_column` VALUES ('5', '机构公告', '2');
INSERT INTO `cnpse_column` VALUES ('6', '培训招生', '2');
INSERT INTO `cnpse_column` VALUES ('7', '中心要闻', '3');
INSERT INTO `cnpse_column` VALUES ('8', '最新资讯', '3');
INSERT INTO `cnpse_column` VALUES ('9', '视频中心', '3');
INSERT INTO `cnpse_column` VALUES ('10', '国家政策', '4');
INSERT INTO `cnpse_column` VALUES ('11', '部委法规', '4');
INSERT INTO `cnpse_column` VALUES ('12', '中心规章', '4');
