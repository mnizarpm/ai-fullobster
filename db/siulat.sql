/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : skripsi_tarom

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 07/07/2021 17:51:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for atribut
-- ----------------------------
DROP TABLE IF EXISTS `atribut`;
CREATE TABLE `atribut`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of atribut
-- ----------------------------
INSERT INTO `atribut` VALUES (1, 'Hasil', 1);
INSERT INTO `atribut` VALUES (2, 'SUHU', 0);
INSERT INTO `atribut` VALUES (3, 'PH', 0);
INSERT INTO `atribut` VALUES (4, 'TDS', 0);
INSERT INTO `atribut` VALUES (5, 'DO', 0);
INSERT INTO `atribut` VALUES (6, 'Amonia', 0);
INSERT INTO `atribut` VALUES (7, 'Nitrit', 0);

-- ----------------------------
-- Table structure for dataset
-- ----------------------------
DROP TABLE IF EXISTS `dataset`;
CREATE TABLE `dataset`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suhu` decimal(65, 0) NULL DEFAULT NULL,
  `ph` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tds` decimal(65, 0) NULL DEFAULT NULL,
  `do` decimal(65, 0) NULL DEFAULT NULL,
  `amonia` decimal(65, 0) NULL DEFAULT NULL,
  `nitrit` decimal(65, 0) NULL DEFAULT NULL,
  `hasil` enum('1','2','3') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dataset
-- ----------------------------
INSERT INTO `dataset` VALUES (1, 25, '7.3', 200, '3');
INSERT INTO `dataset` VALUES (2, 26, '7.5', 300, '1');
INSERT INTO `dataset` VALUES (3, 25, '7.0', 250, '1');
INSERT INTO `dataset` VALUES (4, 24, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (5, 23, '7.2', 250, '1');
INSERT INTO `dataset` VALUES (6, 24, '7.1', 200, '1');
INSERT INTO `dataset` VALUES (7, 26, '7.2', 200, '1');
INSERT INTO `dataset` VALUES (8, 23, '7.3', 250, '1');
INSERT INTO `dataset` VALUES (9, 26, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (10, 25, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (11, 24, '7.0', 250, '1');
INSERT INTO `dataset` VALUES (12, 23, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (13, 27, '7.2', 200, '1');
INSERT INTO `dataset` VALUES (14, 26, '7.1', 250, '1');
INSERT INTO `dataset` VALUES (15, 24, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (16, 25, '7.0', 200, '1');
INSERT INTO `dataset` VALUES (17, 26, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (18, 27, '7.2', 200, '1');
INSERT INTO `dataset` VALUES (19, 23, '7.3', 250, '1');
INSERT INTO `dataset` VALUES (20, 23, '7.2', 200, '1');
INSERT INTO `dataset` VALUES (21, 23, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (22, 25, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (23, 26, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (24, 25, '7.0', 250, '1');
INSERT INTO `dataset` VALUES (25, 24, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (26, 23, '7.2', 200, '1');
INSERT INTO `dataset` VALUES (27, 27, '7.1', 250, '1');
INSERT INTO `dataset` VALUES (28, 26, '7.3', 200, '1');
INSERT INTO `dataset` VALUES (29, 25, '7.5', 200, '1');
INSERT INTO `dataset` VALUES (30, 26, '7.0', 250, '1');
INSERT INTO `dataset` VALUES (31, 22, '6.9', 180, '2');
INSERT INTO `dataset` VALUES (32, 30, '9.0', 190, '2');
INSERT INTO `dataset` VALUES (33, 22, '6.7', 400, '2');
INSERT INTO `dataset` VALUES (34, 29, '6.8', 350, '2');
INSERT INTO `dataset` VALUES (35, 21, '8.5', 170, '2');
INSERT INTO `dataset` VALUES (36, 28, '8.7', 400, '2');

-- ----------------------------
-- Table structure for datates
-- ----------------------------
DROP TABLE IF EXISTS `datates`;
CREATE TABLE `datates`  (
  `id` int(11) NOT NULL,
  `hasil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `suhu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ph` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tds` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `do` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amonia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nitrit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of datates
-- ----------------------------
INSERT INTO `datates` VALUES (1, '0.0057817838630959', '0.23488804453939', '0.63105490193253', '0.039006213692279');
INSERT INTO `datates` VALUES (2, '0.0024364848572471', '0.20337322865351', '0.31975723060956', '0.037467055131434');

-- ----------------------------
-- Table structure for deviasi
-- ----------------------------
DROP TABLE IF EXISTS `deviasi`;
CREATE TABLE `deviasi`  (
  `id` int(11) NOT NULL,
  `hasil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `suhu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ph` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tds` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `do` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amonia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nitrit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of deviasi
-- ----------------------------
INSERT INTO `deviasi` VALUES (1, 'Layak', '1.3186693629901651', '0.16868774571839998', '27.335365778094545');
INSERT INTO `deviasi` VALUES (2, 'Tidak Layak', '3.72677996249965', '0.9792287214378919', '103.1853779477607');

-- ----------------------------
-- Table structure for mean
-- ----------------------------
DROP TABLE IF EXISTS `mean`;
CREATE TABLE `mean`  (
  `id` int(11) NOT NULL,
  `hasil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `suhu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ph` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tds` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `do` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amonia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nitrit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mean
-- ----------------------------
INSERT INTO `mean` VALUES (1, 'Layak', '24.8333', '7.256666666666667', '218.3333');
INSERT INTO `mean` VALUES (2, 'Tidak Layak', '25.3333', '7.766666666666668', '281.6667');

-- ----------------------------
-- Table structure for naive
-- ----------------------------
DROP TABLE IF EXISTS `naive`;
CREATE TABLE `naive`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suhu` decimal(65, 0) NULL DEFAULT NULL,
  `ph` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tds` decimal(65, 0) NULL DEFAULT NULL,
  `do` decimal(65, 0) NULL DEFAULT NULL,
  `amonia` decimal(65, 0) NULL DEFAULT NULL,
  `nitrit` decimal(65, 0) NULL DEFAULT NULL,
  `hasil` enum('1','2','3') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of naive
-- ----------------------------
INSERT INTO `naive` VALUES (6, 26, '7', 250, NULL);
INSERT INTO `naive` VALUES (7, 26, '7.1', 250, NULL);
INSERT INTO `naive` VALUES (8, 26, '7.1', 250, NULL);
INSERT INTO `naive` VALUES (9, 26, '7.1', 250, NULL);
INSERT INTO `naive` VALUES (10, 26, '7.1', 250, NULL);
INSERT INTO `naive` VALUES (11, 26, '7.1', 250, NULL);

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_atribut` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nilai
-- ----------------------------
INSERT INTO `nilai` VALUES (13, 7, 'Bagus');
INSERT INTO `nilai` VALUES (14, 7, 'Kurang Bagus');
INSERT INTO `nilai` VALUES (15, 8, 'Cukup');
INSERT INTO `nilai` VALUES (16, 8, 'Kurang');
INSERT INTO `nilai` VALUES (17, 9, 'Normal');
INSERT INTO `nilai` VALUES (18, 9, 'Mboler');
INSERT INTO `nilai` VALUES (19, 9, 'Ulat');
INSERT INTO `nilai` VALUES (20, 10, 'Sangat Cukup');
INSERT INTO `nilai` VALUES (21, 10, 'Sedang');
INSERT INTO `nilai` VALUES (22, 10, 'Kurang');
INSERT INTO `nilai` VALUES (23, 11, 'Cukup');
INSERT INTO `nilai` VALUES (24, 11, 'Kurang');
INSERT INTO `nilai` VALUES (25, 12, 'Panen');
INSERT INTO `nilai` VALUES (26, 12, 'Gagal');

-- ----------------------------
-- Table structure for prohasil
-- ----------------------------
DROP TABLE IF EXISTS `prohasil`;
CREATE TABLE `prohasil`  (
  `id` int(11) NOT NULL,
  `hasil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prohasil
-- ----------------------------
INSERT INTO `prohasil` VALUES (1, 'Layak', '0.83333333333333');
INSERT INTO `prohasil` VALUES (2, 'Tidak Layak', '0.16666666666667');
INSERT INTO `prohasil` VALUES (3, 'Optimal', '0.16666666666667');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','pengguna') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (5, 'Ali Muchtarom', 'admin', '$2y$10$X4hMQVBYfggxi5Wr7vAFTus7LeMFK0XuZmvQ5sc6x2F2h66RC8at2', 'nama-2021_07_03_012351.png', 'admin', '2021-07-03 07:51:41', '2021-07-03 08:24:05');

SET FOREIGN_KEY_CHECKS = 1;
