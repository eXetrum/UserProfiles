/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : users

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-04-10 03:38:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for userslab6
-- ----------------------------
DROP TABLE IF EXISTS `userslab6`;
CREATE TABLE `userslab6` (
  `compid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` varchar(255) NOT NULL,
  `frozen` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  PRIMARY KEY (`compid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userslab6
-- ----------------------------
INSERT INTO `userslab6` VALUES ('1', 'mem1', 'mem1', 'member', '1');
INSERT INTO `userslab6` VALUES ('2', 'mem2', 'mem2', 'member', '0');
INSERT INTO `userslab6` VALUES ('3', 'admin1', 'admin1', 'admin', '0');
INSERT INTO `userslab6` VALUES ('4', 'admin2', 'admin2', 'admin', '1');
INSERT INTO `userslab6` VALUES ('5', 'mem3', 'mem3', 'member', '0');
INSERT INTO `userslab6` VALUES ('7', 'test', 'test', 'admin', '0');
INSERT INTO `userslab6` VALUES ('8', 'test2', 'test2', 'member', '0');
