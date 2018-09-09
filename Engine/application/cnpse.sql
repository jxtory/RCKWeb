/*
MySQL Data Transfer
Source Host: localhost
Source Database: cnpse
Target Host: localhost
Target Database: cnpse
Date: 2018/9/10 1:22:15
*/

SET FOREIGN_KEY_CHECKS=0;
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
