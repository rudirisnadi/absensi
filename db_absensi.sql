/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 100417
Source Host           : localhost:3306
Source Database       : db_absensi

Target Server Type    : MYSQL
Target Server Version : 100417
File Encoding         : 65001

Date: 2022-06-23 10:11:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_absn
-- ----------------------------
DROP TABLE IF EXISTS `data_absn`;
CREATE TABLE `data_absn` (
  `idxx_absn` int(11) NOT NULL AUTO_INCREMENT,
  `tglx_absn` date DEFAULT NULL,
  `jamx_msuk` time DEFAULT NULL,
  `jamx_klar` time DEFAULT NULL,
  `idxx_user` int(11) DEFAULT NULL,
  `auth_xxxx` int(11) DEFAULT NULL,
  `crtd_date` datetime DEFAULT NULL,
  PRIMARY KEY (`idxx_absn`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of data_absn
-- ----------------------------

-- ----------------------------
-- Table structure for mstx_user
-- ----------------------------
DROP TABLE IF EXISTS `mstx_user`;
CREATE TABLE `mstx_user` (
  `idxx_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(250) DEFAULT NULL,
  `mail_user` varchar(250) DEFAULT NULL,
  `telp_user` varchar(25) DEFAULT NULL,
  `user_name` varchar(250) DEFAULT NULL,
  `pass_word` varchar(250) DEFAULT NULL,
  `idxx_role` int(11) DEFAULT NULL,
  `imgx_user` varchar(255) DEFAULT NULL,
  `idxx_webx` int(11) DEFAULT NULL,
  PRIMARY KEY (`idxx_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mstx_user
-- ----------------------------
INSERT INTO `mstx_user` VALUES ('1', 'Administrator', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'upload/1655865391_luffy.jpg', null);

-- ----------------------------
-- Table structure for sett_akss
-- ----------------------------
DROP TABLE IF EXISTS `sett_akss`;
CREATE TABLE `sett_akss` (
  `idxx_accs` int(11) NOT NULL AUTO_INCREMENT,
  `idxx_role` varchar(2) DEFAULT NULL,
  `idxx_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idxx_accs`)
) ENGINE=InnoDB AUTO_INCREMENT=436 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sett_akss
-- ----------------------------
INSERT INTO `sett_akss` VALUES ('428', '1', '3');
INSERT INTO `sett_akss` VALUES ('429', '1', '7');
INSERT INTO `sett_akss` VALUES ('430', '1', '62');
INSERT INTO `sett_akss` VALUES ('431', '1', '65');
INSERT INTO `sett_akss` VALUES ('432', '1', '74');
INSERT INTO `sett_akss` VALUES ('433', '1', '75');
INSERT INTO `sett_akss` VALUES ('434', '9', '3');
INSERT INTO `sett_akss` VALUES ('435', '9', '75');

-- ----------------------------
-- Table structure for sett_mdul
-- ----------------------------
DROP TABLE IF EXISTS `sett_mdul`;
CREATE TABLE `sett_mdul` (
  `idxx_mdul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mdul` varchar(255) DEFAULT NULL,
  `posx_mdul` int(11) DEFAULT NULL,
  `icon_mdul` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idxx_mdul`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sett_mdul
-- ----------------------------
INSERT INTO `sett_mdul` VALUES ('1', 'Data', '1', 'fa fa-list-alt');
INSERT INTO `sett_mdul` VALUES ('3', 'Setting', '6', 'fa fa-cogs');

-- ----------------------------
-- Table structure for sett_menu
-- ----------------------------
DROP TABLE IF EXISTS `sett_menu`;
CREATE TABLE `sett_menu` (
  `idxx_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) DEFAULT NULL,
  `urlx_menu` varchar(255) DEFAULT NULL,
  `idxx_mdul` int(11) DEFAULT NULL,
  `posx_menu` int(11) DEFAULT NULL,
  `idxx_parn` int(11) DEFAULT NULL,
  PRIMARY KEY (`idxx_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sett_menu
-- ----------------------------
INSERT INTO `sett_menu` VALUES ('3', 'Karyawan', 'setting/user', '1', '1', null);
INSERT INTO `sett_menu` VALUES ('7', 'Access', 'setting/akses', '3', '2', null);
INSERT INTO `sett_menu` VALUES ('62', 'Menu', 'setting/menu', '3', '3', null);
INSERT INTO `sett_menu` VALUES ('65', 'Group Access', 'setting/group', '3', '7', null);
INSERT INTO `sett_menu` VALUES ('74', 'Absensi', 'master/absensi', '1', '2', null);
INSERT INTO `sett_menu` VALUES ('75', 'Laporan Kehadiran', 'master/laporan', '1', '3', null);

-- ----------------------------
-- Table structure for sett_role
-- ----------------------------
DROP TABLE IF EXISTS `sett_role`;
CREATE TABLE `sett_role` (
  `idxx_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(250) DEFAULT NULL,
  `desc_role` text DEFAULT NULL,
  PRIMARY KEY (`idxx_role`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sett_role
-- ----------------------------
INSERT INTO `sett_role` VALUES ('1', 'Administrator', '');
INSERT INTO `sett_role` VALUES ('9', 'Karyawan', '');
SET FOREIGN_KEY_CHECKS=1;
