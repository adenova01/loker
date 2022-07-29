-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.6.7-MariaDB-2ubuntu1 - Ubuntu 22.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for loker_app
CREATE DATABASE IF NOT EXISTS `loker_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `loker_app`;

-- Dumping structure for table loker_app.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `login_terakhir` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.admin: ~1 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `nama_lengkap`, `email`, `password`, `login_terakhir`) VALUES
	(1, 'Administrator', 'admin@gmail.com', 'admin123', '2022-06-15 10:56:09');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table loker_app.kesehatan
CREATE TABLE IF NOT EXISTS `kesehatan` (
  `id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `pendaftaran_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `kesehatan_nilai` int(3) DEFAULT NULL,
  `kesehatan_bobot` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id` (`pendaftaran_id`),
  CONSTRAINT `kesehatan_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.kesehatan: ~1 rows (approximately)
DELETE FROM `kesehatan`;
/*!40000 ALTER TABLE `kesehatan` DISABLE KEYS */;
INSERT INTO `kesehatan` (`id`, `pendaftaran_id`, `kesehatan_nilai`, `kesehatan_bobot`) VALUES
	('SEHAT00001', 'DAFTAR00001', NULL, NULL);
/*!40000 ALTER TABLE `kesehatan` ENABLE KEYS */;

-- Dumping structure for table loker_app.lowongan
CREATE TABLE IF NOT EXISTS `lowongan` (
  `id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `provinsi_id` char(2) CHARACTER SET latin1 NOT NULL,
  `judul` text CHARACTER SET latin1 DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 DEFAULT NULL,
  `kuota` int(3) DEFAULT NULL,
  `tipe` enum('fulltime','kontrak','magang','') CHARACTER SET latin1 NOT NULL,
  `mulai_pendaftaran` date NOT NULL,
  `akhir_pendaftaran` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `provinsi_id` (`provinsi_id`),
  CONSTRAINT `lowongan_ibfk_1` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.lowongan: ~2 rows (approximately)
DELETE FROM `lowongan`;
/*!40000 ALTER TABLE `lowongan` DISABLE KEYS */;
INSERT INTO `lowongan` (`id`, `provinsi_id`, `judul`, `deskripsi`, `kuota`, `tipe`, `mulai_pendaftaran`, `akhir_pendaftaran`) VALUES
	('LOKER00001', '33', 'coba loker', 'ini coba loker', 120, 'fulltime', '2022-06-15', '2022-06-25');
/*!40000 ALTER TABLE `lowongan` ENABLE KEYS */;

-- Dumping structure for table loker_app.pemberkasan
CREATE TABLE IF NOT EXISTS `pemberkasan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `file_ktp_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `file_kk_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `file_ijazah_skl_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `file_skck_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `file_surat_domisili_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `file_cv_upload` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `pemberkasan_nilai` int(3) DEFAULT NULL,
  `pemberkasan_bobot` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pemberkasan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.pemberkasan: ~1 rows (approximately)
DELETE FROM `pemberkasan`;
/*!40000 ALTER TABLE `pemberkasan` DISABLE KEYS */;
INSERT INTO `pemberkasan` (`id`, `user_id`, `file_ktp_upload`, `file_kk_upload`, `file_ijazah_skl_upload`, `file_skck_upload`, `file_surat_domisili_upload`, `file_cv_upload`, `pemberkasan_nilai`, `pemberkasan_bobot`) VALUES
	(7, 'USER000001', NULL, NULL, NULL, NULL, NULL, NULL, 0, 25);
/*!40000 ALTER TABLE `pemberkasan` ENABLE KEYS */;

-- Dumping structure for table loker_app.pendaftaran
CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `id` varchar(11) CHARACTER SET latin1 NOT NULL,
  `lowongan_id` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `user_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `pendaftaran_status` enum('proses','lulus','gagal') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lowongan_id` (`lowongan_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`),
  CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.pendaftaran: ~1 rows (approximately)
DELETE FROM `pendaftaran`;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` (`id`, `lowongan_id`, `user_id`, `tgl_daftar`, `pendaftaran_status`) VALUES
	('DAFTAR00001', 'LOKER00001', 'USER000001', '2022-06-15', 'proses');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;

-- Dumping structure for table loker_app.provinsi
CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` char(2) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table loker_app.provinsi: ~34 rows (approximately)
DELETE FROM `provinsi`;
/*!40000 ALTER TABLE `provinsi` DISABLE KEYS */;
INSERT INTO `provinsi` (`id`, `nama`) VALUES
	('11', 'ACEH'),
	('12', 'SUMATERA UTARA'),
	('13', 'SUMATERA BARAT'),
	('14', 'RIAU'),
	('15', 'JAMBI'),
	('16', 'SUMATERA SELATAN'),
	('17', 'BENGKULU'),
	('18', 'LAMPUNG'),
	('19', 'KEPULAUAN BANGKA BELITUNG'),
	('21', 'KEPULAUAN RIAU'),
	('31', 'DKI JAKARTA'),
	('32', 'JAWA BARAT'),
	('33', 'JAWA TENGAH'),
	('34', 'DI YOGYAKARTA'),
	('35', 'JAWA TIMUR'),
	('36', 'BANTEN'),
	('51', 'BALI'),
	('52', 'NUSA TENGGARA BARAT'),
	('53', 'NUSA TENGGARA TIMUR'),
	('61', 'KALIMANTAN BARAT'),
	('62', 'KALIMANTAN TENGAH'),
	('63', 'KALIMANTAN SELATAN'),
	('64', 'KALIMANTAN TIMUR'),
	('65', 'KALIMANTAN UTARA'),
	('71', 'SULAWESI UTARA'),
	('72', 'SULAWESI TENGAH'),
	('73', 'SULAWESI SELATAN'),
	('74', 'SULAWESI TENGGARA'),
	('75', 'GORONTALO'),
	('76', 'SULAWESI BARAT'),
	('81', 'MALUKU'),
	('82', 'MALUKU UTARA'),
	('91', 'PAPUA BARAT'),
	('94', 'PAPUA');
/*!40000 ALTER TABLE `provinsi` ENABLE KEYS */;

-- Dumping structure for table loker_app.psikotest
CREATE TABLE IF NOT EXISTS `psikotest` (
  `id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `pendaftaran_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `psikotest_nilai` int(3) DEFAULT NULL,
  `psikotest_bobot` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id` (`pendaftaran_id`),
  CONSTRAINT `psikotest_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.psikotest: ~1 rows (approximately)
DELETE FROM `psikotest`;
/*!40000 ALTER TABLE `psikotest` DISABLE KEYS */;
INSERT INTO `psikotest` (`id`, `pendaftaran_id`, `psikotest_nilai`, `psikotest_bobot`) VALUES
	('PSIKO00001', 'DAFTAR00001', NULL, NULL);
/*!40000 ALTER TABLE `psikotest` ENABLE KEYS */;

-- Dumping structure for table loker_app.ranking
CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pendaftaran_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `ranking_nilai` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id` (`pendaftaran_id`),
  CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.ranking: ~0 rows (approximately)
DELETE FROM `ranking`;
/*!40000 ALTER TABLE `ranking` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking` ENABLE KEYS */;

-- Dumping structure for table loker_app.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `login_terakhir` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table loker_app.user: ~1 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nik`, `nama_lengkap`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `email`, `no_hp`, `password`, `image_url`, `login_terakhir`) VALUES
	('USER000001', NULL, NULL, NULL, NULL, NULL, 'adenova@gmail.com', '089532633907', 'adenova01', NULL, '2022-06-15 10:37:55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table loker_app.wawancara
CREATE TABLE IF NOT EXISTS `wawancara` (
  `id` varchar(14) CHARACTER SET latin1 NOT NULL,
  `pendaftaran_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `wawancara_nilai` int(3) DEFAULT NULL,
  `wawancara_bobot` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id` (`pendaftaran_id`),
  CONSTRAINT `wawancara_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table loker_app.wawancara: ~1 rows (approximately)
DELETE FROM `wawancara`;
/*!40000 ALTER TABLE `wawancara` DISABLE KEYS */;
INSERT INTO `wawancara` (`id`, `pendaftaran_id`, `wawancara_nilai`, `wawancara_bobot`) VALUES
	('WAWANCARA00001', 'DAFTAR00001', NULL, NULL);
/*!40000 ALTER TABLE `wawancara` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
