/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zty

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-02-13 12:27:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for teach
-- ----------------------------
DROP TABLE IF EXISTS `teach`;
CREATE TABLE `teach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teach
-- ----------------------------
INSERT INTO `teach` VALUES ('1', 'w', '123456');
INSERT INTO `teach` VALUES ('2', 'g', '123456');
INSERT INTO `teach` VALUES ('3', 'q', '12346');

-- ----------------------------
-- Table structure for zty_article
-- ----------------------------
DROP TABLE IF EXISTS `zty_article`;
CREATE TABLE `zty_article` (
  `article_id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `article_tittle` varchar(255) DEFAULT NULL,
  `article_uid` int(11) DEFAULT NULL,
  `article_content` text,
  `article_ctime` int(11) NOT NULL,
  `article_isdel` tinyint(1) DEFAULT '0' COMMENT '是否删除 1 ：yes 0:no',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zty_article
-- ----------------------------
INSERT INTO `zty_article` VALUES ('00000000002', '222222', '1', '我可接受的VB理发店方是看你丰富的VB不大V好看    ', '1517894204', '0');
INSERT INTO `zty_article` VALUES ('00000000003', '222222', '4', '不克价', '1517894424', '0');
INSERT INTO `zty_article` VALUES ('00000000004', '222222', '4', '除个别好年就', '1517894607', '0');
INSERT INTO `zty_article` VALUES ('00000000005', 'this', '1', null, '1517894649', '0');
INSERT INTO `zty_article` VALUES ('00000000006', '文化', '3', '&lt;script&gt;alert(htis is )&lt;/script&gt;', '1517974105', '0');
INSERT INTO `zty_article` VALUES ('00000000007', '文化', '4', '&lt;script&gt;alert(htis is )&lt;/script&gt;', '1517974319', '1');

-- ----------------------------
-- Table structure for zty_user
-- ----------------------------
DROP TABLE IF EXISTS `zty_user`;
CREATE TABLE `zty_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `userpwd` int(32) NOT NULL,
  `token` varchar(255) NOT NULL,
  `time` int(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zty_user
-- ----------------------------
INSERT INTO `zty_user` VALUES ('4', 'this his ', '1234567', 'qwertyu', '0');
