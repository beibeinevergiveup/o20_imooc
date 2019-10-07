/*
 Navicat Premium Data Transfer

 Source Server         : beibei
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : imooc_o2o

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 07/10/2019 23:46:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for o2o_area
-- ----------------------------
DROP TABLE IF EXISTS `o2o_area`;
CREATE TABLE `o2o_area`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `city_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `city_id`(`city_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for o2o_bis
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis`;
CREATE TABLE `o2o_bis`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `licence_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_path` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bank_info` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `money` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `bank_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bank_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `faren` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `faren_tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `city_id`(`city_id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_bis
-- ----------------------------
INSERT INTO `o2o_bis` VALUES (12, '贝贝麻辣烫', 'tttbd@qq.com', '/upload/20190913/458256e49c25970e8b53f582f2bcf03d.jpg', '/upload/20190913/db32da644cd239f1d7113b19d0fcd486.jpg', '<p>beibei</p>', 1, '1,4', '3565656465465', 0.00, '中国农业银行', '李森宇', '李森宇', '15659720810', 0, 1, 1568362485, 1568371880);
INSERT INTO `o2o_bis` VALUES (13, '吴珍煌狗肉店', 'tttbd@qq.com', '/upload/20190923/ce0d8944d291f1246faa2807adb2670f.jpg', '/upload/20190923/b5f2a4e048aa498a2293bd31c09f7437.jpg', '<p>你值得拥有</p>', 1, '1,4', '3565656465465', 0.00, '中国农业银行', '吴镇黄', '吴镇黄', '2222222', 0, 0, 1569252656, 1569252656);

-- ----------------------------
-- Table structure for o2o_bis_account
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_account`;
CREATE TABLE `o2o_bis_account`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bis_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `is_main` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bis_id`(`bis_id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_bis_account
-- ----------------------------
INSERT INTO `o2o_bis_account` VALUES (6, 'beibei', 'e99f494d2be88fb15378eb50ca754104', '1063', 12, '', 1570031455, 1, 0, 1, 1568362485, 1570031455);
INSERT INTO `o2o_bis_account` VALUES (7, 'beibei1', 'ee4865eb7ff97282d3b8c9457b423252', '7737', 13, '', 0, 1, 0, 0, 1569252656, 1569252656);

-- ----------------------------
-- Table structure for o2o_bis_location
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_location`;
CREATE TABLE `o2o_bis_location`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contact` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `xpoint` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ypoint` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bis_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `open_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_main` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `api_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `city_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_path` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `category_path` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bank_info` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `city_id`(`city_id`) USING BTREE,
  INDEX `bis_id`(`bis_id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_bis_location
-- ----------------------------
INSERT INTO `o2o_bis_location` VALUES (11, '贝贝麻辣烫', '/upload/20190913/458256e49c25970e8b53f582f2bcf03d.jpg', '', '15659720810', '李森宇', '118.6233437389', '25.117313427025', 12, 9, '<p>asdasd</p>', 1, '福建省泉州市仰恩大学第一教学区', 1, '1,4', 5, '5,', '', 0, 1, 1568362485, 1568371880);
INSERT INTO `o2o_bis_location` VALUES (12, '贝贝麻辣烫', '/upload/20190915/8d365ab111d3fa52366ef245c2aab260.jpg', '', '15659720810', '李森宇', '118.6233437389', '25.117313427025', 12, 9, '<p>beibei</p>', 0, '福建省泉州市仰恩大学第一教学区', 1, '1,4', 5, '5,11', '', 0, 1, 1568477730, 1568481516);
INSERT INTO `o2o_bis_location` VALUES (13, '贝贝麻辣烫2', '/upload/20190915/64245fa126b43ca9648cb4cef2a5bdce.jpg', '', '15659720810', '李森宇', '118.6233437389', '25.117313427025', 12, 9, '<p>eqweqwe</p>', 0, '福建省泉州市仰恩大学第一教学区', 1, '1,4', 5, '5,11', '', 0, 0, 1568480823, 1568481955);
INSERT INTO `o2o_bis_location` VALUES (14, '吴珍煌狗肉店', '/upload/20190923/ce0d8944d291f1246faa2807adb2670f.jpg', '', '23', '李森宇', '118.6233437389', '25.117313427025', 13, 9, '<p>1111</p>', 1, '福建省泉州市仰恩大学第一教学区', 1, '1,4', 1, '1,', '', 0, 0, 1569252656, 1569252656);

-- ----------------------------
-- Table structure for o2o_category
-- ----------------------------
DROP TABLE IF EXISTS `o2o_category`;
CREATE TABLE `o2o_category`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_category
-- ----------------------------
INSERT INTO `o2o_category` VALUES (1, '美食', 0, 0, 1, 1564936413, 1564936413);
INSERT INTO `o2o_category` VALUES (3, 'KTV', 0, 3, -1, 1564968145, 1565021966);
INSERT INTO `o2o_category` VALUES (4, '电影', 5, 1, -1, 1564968165, 1567270880);
INSERT INTO `o2o_category` VALUES (5, '娱乐', 0, 0, 1, 1567269020, 1567270786);
INSERT INTO `o2o_category` VALUES (11, 'KTV', 5, 0, 1, 1567270838, 1567270838);
INSERT INTO `o2o_category` VALUES (12, '丽人', 0, 0, 1, 1569686523, 1569686523);
INSERT INTO `o2o_category` VALUES (13, '休闲', 0, 0, 1, 1569686539, 1569686539);
INSERT INTO `o2o_category` VALUES (14, '娱乐', 0, 0, -1, 1569686549, 1569686567);
INSERT INTO `o2o_category` VALUES (15, '酒店', 0, 0, 1, 1569686579, 1569686579);
INSERT INTO `o2o_category` VALUES (16, '住宿', 15, 0, 1, 1569687228, 1569687228);
INSERT INTO `o2o_category` VALUES (17, '洗浴', 15, 0, 1, 1569687243, 1569687243);
INSERT INTO `o2o_category` VALUES (18, '棋牌', 13, 0, 1, 1569687250, 1569687250);
INSERT INTO `o2o_category` VALUES (19, '游戏', 13, 0, 1, 1569687273, 1569687273);
INSERT INTO `o2o_category` VALUES (20, '纹身', 12, 0, 1, 1569687283, 1569687283);
INSERT INTO `o2o_category` VALUES (21, '化妆品', 12, 0, 1, 1569687297, 1569687297);
INSERT INTO `o2o_category` VALUES (22, '赌场', 5, 0, 1, 1569687311, 1569687311);
INSERT INTO `o2o_category` VALUES (23, '零食', 1, 0, 1, 1569687329, 1569687329);
INSERT INTO `o2o_category` VALUES (24, '烧烤', 1, 0, 1, 1569687344, 1569687344);

-- ----------------------------
-- Table structure for o2o_city
-- ----------------------------
DROP TABLE IF EXISTS `o2o_city`;
CREATE TABLE `o2o_city`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_city
-- ----------------------------
INSERT INTO `o2o_city` VALUES (1, '北京', 0, 0, 1, 0, 1564936413, 1564936413);
INSERT INTO `o2o_city` VALUES (4, '朝阳区', 1, 0, 1, 0, 1564936413, 1564936413);
INSERT INTO `o2o_city` VALUES (21, '福建', 0, 0, 1, 0, 0, 0);
INSERT INTO `o2o_city` VALUES (22, '泉州', 21, 0, 1, 1, 1569422859, 1569422859);
INSERT INTO `o2o_city` VALUES (23, '厦门', 21, 0, 1, 0, 1569422906, 1569422906);

-- ----------------------------
-- Table structure for o2o_deal
-- ----------------------------
DROP TABLE IF EXISTS `o2o_deal`;
CREATE TABLE `o2o_deal`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL DEFAULT 0,
  `se_category_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bis_id` int(11) NOT NULL DEFAULT 0,
  `location_ids` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT 0,
  `end_time` int(11) NOT NULL DEFAULT 0,
  `origin_price` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `current_price` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `city_path` int(11) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `buy_count` int(11) NOT NULL DEFAULT 0,
  `total_count` int(11) NOT NULL DEFAULT 0,
  `coupons_begin_time` int(11) NOT NULL DEFAULT 0,
  `coupons_end_time` int(11) NOT NULL DEFAULT 0,
  `xpoint` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ypoint` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `bis_account_id` int(10) NOT NULL DEFAULT 0,
  `balance_price` decimal(20, 2) NOT NULL DEFAULT 0.00,
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE,
  INDEX `se_category_id`(`se_category_id`) USING BTREE,
  INDEX `city_id`(`city_id`) USING BTREE,
  INDEX `start_time`(`start_time`) USING BTREE,
  INDEX `end_time`(`end_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_deal
-- ----------------------------
INSERT INTO `o2o_deal` VALUES (1, '贝贝', 1, '0', 12, '12,11', '/upload/20190921/fc5ee7ce4f8d6b3b8139612bd77da7d9.jpg', '<p>撒大声地</p>', 1569049405, 1569049405, 0.00, 3.00, 4, 1, 0, 0, 1569049140, 1569049140, '118.6233437389', '25.117313427025', 6, 0.00, '<p>萨达</p>', 0, 0, 1569049405, 1569049405);
INSERT INTO `o2o_deal` VALUES (2, '牛肉面', 1, '0', 12, '12,11', '/upload/20190922/164e6bbb447ac405e830bb949129e929.jpg', '<p>很好吃的牛肉面</p>', 1569049405, 1569049405, 0.00, 3.00, 4, 1, 0, 0, 1569129480, 1569129480, '118.6233437389', '25.117313427025', 6, 0.00, '<p>好吃的牛肉面</p>', 0, 0, 1569129510, 1569129510);
INSERT INTO `o2o_deal` VALUES (3, '吴珍煌狗肉店', 1, '24,23', 12, '12,11', '/upload/20191001/e3efd3703d45259af22dc98f3025f931.jpg', '<p>aaa</p>', 1569935640, 1601558040, 0.00, 9.00, 22, 21, 0, 99, 1569935640, 1601558040, '118.6233437389', '25.117313427025', 6, 0.00, '<p>aaa</p>', 0, 1, 1569935704, 1569935961);
INSERT INTO `o2o_deal` VALUES (4, '牛肉面', 1, '24,23', 12, '12,11', '/upload/20191002/37688b3d8fd91850bf8555b345aa0a37.jpg', '<p>好吃哦不上火</p>', 1569983040, 1601605440, 90.00, 3.00, 22, 21, 99, 99, 1569983040, 1604283840, '118.6233437389', '25.117313427025', 6, 0.00, '<p>遵守交通法规</p>', 0, 1, 1569983122, 1569983498);
INSERT INTO `o2o_deal` VALUES (5, '炸鸡', 1, '24', 12, '12,11', '/upload/20191002/555e55a1173121ca8ce87faf28e34a4e.jpg', '<p>好吃的炸鸡</p>', 1572018660, 1604332260, 80.00, 20.00, 22, 21, 0, 88, 1570809120, 1601653920, '118.6233437389', '25.117313427025', 6, 0.00, '<p>一定要好好吃</p>', 0, 1, 1570031552, 1570031576);

-- ----------------------------
-- Table structure for o2o_featured
-- ----------------------------
DROP TABLE IF EXISTS `o2o_featured`;
CREATE TABLE `o2o_featured`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_featured
-- ----------------------------
INSERT INTO `o2o_featured` VALUES (1, 0, '吴珍煌狗肉店', '/upload/20190924/c5c777618af4f242296da0b7621b3861.jpg', 'http://www.baidu.com', '好吃不上火', 0, 1, 1569303461, 1569311372);
INSERT INTO `o2o_featured` VALUES (2, 1, '贝贝牛肉店', '/upload/20190924/d28c3f1c37a6b31c9c7c4074cf79b24d.jpg', 'www', '好吃不上火', 0, -1, 1569304725, 1569311461);
INSERT INTO `o2o_featured` VALUES (3, 0, '贝贝牛肉店', '/upload/20190929/c4e674f4f50505c90cae26a2470abbb2.jpg', '', '好吃不上火', 0, 1, 1569716793, 1569716877);
INSERT INTO `o2o_featured` VALUES (4, 1, '贝贝牛肉店', '/upload/20190929/389ca6e7c03aaed88f5c9f7b15ad333d.jpg', '', '好吃不上火', 0, 1, 1569717144, 1569717163);

-- ----------------------------
-- Table structure for o2o_user
-- ----------------------------
DROP TABLE IF EXISTS `o2o_user`;
CREATE TABLE `o2o_user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of o2o_user
-- ----------------------------
INSERT INTO `o2o_user` VALUES (4, 'beibei', '9b8883ddaba9bcfcf744231c935f1057', '1228', '', 0, 'tttbd@qq.com', '', 0, 1, 1569506158, 1569506158);

SET FOREIGN_KEY_CHECKS = 1;
