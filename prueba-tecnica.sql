/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : prueba-tecnica

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-10-23 18:09:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_area`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_area`;
CREATE TABLE `tbl_area` (
  `id_area` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tbl_area
-- ----------------------------
INSERT INTO `tbl_area` VALUES ('1', 'Recursos Humanos', '1');
INSERT INTO `tbl_area` VALUES ('2', 'Informática', '1');
INSERT INTO `tbl_area` VALUES ('3', 'Gerencia', '1');
INSERT INTO `tbl_area` VALUES ('4', 'Recepción', '1');
INSERT INTO `tbl_area` VALUES ('5', 'Limpieza', '1');

-- ----------------------------
-- Table structure for `tbl_country`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_country`;
CREATE TABLE `tbl_country` (
  `id_country` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT 0,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tbl_country
-- ----------------------------
INSERT INTO `tbl_country` VALUES ('1', 'El salvador', '1');

-- ----------------------------
-- Table structure for `tbl_state`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_state`;
CREATE TABLE `tbl_state` (
  `id_state` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tbl_state
-- ----------------------------
INSERT INTO `tbl_state` VALUES ('1', 'Santa Ana', '1');
INSERT INTO `tbl_state` VALUES ('2', 'San Salvador', '1');
INSERT INTO `tbl_state` VALUES ('3', 'San Miguel', '1');
INSERT INTO `tbl_state` VALUES ('4', 'Sonsonate', '1');
INSERT INTO `tbl_state` VALUES ('5', 'Ahuachapan', '1');
INSERT INTO `tbl_state` VALUES ('6', 'La Libertad', '1');
INSERT INTO `tbl_state` VALUES ('7', 'Morazan', '1');
INSERT INTO `tbl_state` VALUES ('8', 'La Unión', '1');
INSERT INTO `tbl_state` VALUES ('9', 'San Vicente', '1');
INSERT INTO `tbl_state` VALUES ('10', 'Cabañas', '1');
INSERT INTO `tbl_state` VALUES ('11', 'Usulután', '1');
INSERT INTO `tbl_state` VALUES ('12', 'Chalatenango', '1');
INSERT INTO `tbl_state` VALUES ('13', 'Cuscatlán', '1');
INSERT INTO `tbl_state` VALUES ('14', 'La Paz', '1');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `id_state` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('9', 'Pedro', 'Acevedo', 'masculino', '1', '1', 'El Trebol', 'pedro@gmail.com', '1999-08-30', '1', '1');
INSERT INTO `tbl_user` VALUES ('10', 'Melvin', 'Jimenez', 'masculino', '1', '4', 'Colonia Miraflor', 'melvin@gmail.com', '1987-08-30', '2', '1');
INSERT INTO `tbl_user` VALUES ('11', 'Josselyn ', 'Ramirez', 'femenino', '1', '2', 'Residencial Valladolid', 'josselyn@gmail.com', '1967-08-30', '3', '1');
