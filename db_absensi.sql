/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `gedung`;
CREATE TABLE `gedung` (
  `gedung_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gedung` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`gedung_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` varchar(20) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `id_shift` int(20) NOT NULL,
  `gedung_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `kehadiran`;
CREATE TABLE `kehadiran` (
  `id_khd` int(11) NOT NULL AUTO_INCREMENT,
  `nama_khd` varchar(10) NOT NULL,
  PRIMARY KEY (`id_khd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `protected` tinyint(4) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `presensi`;
CREATE TABLE `presensi` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam_msk` time NOT NULL,
  `jam_klr` time NOT NULL,
  `id_khd` int(11) DEFAULT NULL,
  `ket` varchar(150) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `shift`;
CREATE TABLE `shift` (
  `id_shift` int(11) NOT NULL AUTO_INCREMENT,
  `nama_shift` varchar(20) NOT NULL,
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `stts`;
CREATE TABLE `stts` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO `gedung` (`gedung_id`, `nama_gedung`, `alamat`) VALUES
(15, 'PKS PT. MERBAUJAYA INDAHRAYA', 'Desa Pulo Jantan');
INSERT INTO `gedung` (`gedung_id`, `nama_gedung`, `alamat`) VALUES
(16, 'KEBUN PT. MERBAUJYAYA INDAHRAYA', 'Desa Aek Korsik');


INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(3, 'Operator', 'Operator');


INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(9, 'KANTOR');
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(10, 'SATPAM');
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(11, 'DIVISI I');
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(12, 'DIVISI II'),
(13, 'DIVISI III');

INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `jabatan`, `id_shift`, `gedung_id`) VALUES
(135, 'K2211001', 'Teguh Eka Syahputra', 9, 19, 16);
INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `jabatan`, `id_shift`, `gedung_id`) VALUES
(136, 'D2211135', 'Irwan Darmansyah', 11, 19, 16);


INSERT INTO `kehadiran` (`id_khd`, `nama_khd`) VALUES
(1, 'Hadir');
INSERT INTO `kehadiran` (`id_khd`, `nama_khd`) VALUES
(2, 'Sakit');
INSERT INTO `kehadiran` (`id_khd`, `nama_khd`) VALUES
(3, 'Ijin');
INSERT INTO `kehadiran` (`id_khd`, `nama_khd`) VALUES
(4, 'Alpha'),
(5, 'Lepas/Off');



INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `protected`, `is_active`, `is_parent`, `sort`) VALUES
(15, 'menu management', 'menu', 'fa fa-list-alt', NULL, 1, 42, 14);
INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `protected`, `is_active`, `is_parent`, `sort`) VALUES
(16, 'master data', 'sdf', 'fa fa-folder', NULL, 1, 0, 1);
INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `protected`, `is_active`, `is_parent`, `sort`) VALUES
(18, 'Data Karyawan', 'karyawan', 'fa fa-user', NULL, 1, 16, 2);
INSERT INTO `menu` (`id`, `name`, `link`, `icon`, `protected`, `is_active`, `is_parent`, `sort`) VALUES
(19, 'data Jabatan', 'jabatan', 'fa fa-briefcase', NULL, 1, 16, 3),
(21, 'Data Shift', 'shift', 'fa fa-retweet', NULL, 1, 16, 4),
(22, 'data Lokasi', 'lokasi', 'fa fa-location-arrow', NULL, 1, 16, 5),
(31, 'Ambil QR Code', 'GenBar', 'fa fa-qrcode', NULL, 1, 0, 6),
(33, 'Scan QRCODE', 'scan', 'fa fa-search-plus', NULL, 1, 0, 7),
(35, 'User management', 'users', 'fa fa-users', NULL, 1, 42, 13),
(36, 'Histori Absensi', 'presensi', 'fa fa-paperclip', NULL, 1, 41, 9),
(39, 'Rekap Absensi', 'rekap', 'fa fa-list-alt', NULL, 1, 41, 10),
(41, 'Data Absensi', 'dataabs', 'far fa-folder-open', NULL, 1, 0, 8),
(42, 'setting', 'setting', 'fas fa-cogs', NULL, 1, 0, 11);

INSERT INTO `presensi` (`id_absen`, `id_karyawan`, `tgl`, `jam_msk`, `jam_klr`, `id_khd`, `ket`, `id_status`) VALUES
(64, 'S2008001', '2020-08-02', '12:52:43', '12:52:46', 1, '', 2);
INSERT INTO `presensi` (`id_absen`, `id_karyawan`, `tgl`, `jam_msk`, `jam_klr`, `id_khd`, `ket`, `id_status`) VALUES
(65, 'S2207132', '2022-07-02', '05:06:17', '05:10:10', 1, '', 2);
INSERT INTO `presensi` (`id_absen`, `id_karyawan`, `tgl`, `jam_msk`, `jam_klr`, `id_khd`, `ket`, `id_status`) VALUES
(66, 'K2211001', '2022-11-03', '07:10:51', '07:12:00', 1, '', 2);
INSERT INTO `presensi` (`id_absen`, `id_karyawan`, `tgl`, `jam_msk`, `jam_klr`, `id_khd`, `ket`, `id_status`) VALUES
(67, 'K2211001', '2022-11-20', '03:26:45', '03:27:34', 1, '', 2),
(68, 'D2211135', '2023-01-02', '09:03:41', '09:04:26', 1, '', 2),
(69, 'K2211001', '2023-03-03', '09:21:11', '21:23:28', 1, '', 2),
(70, 'K2211001', '2023-06-04', '18:23:56', '00:00:00', 1, '', 1);

INSERT INTO `shift` (`id_shift`, `nama_shift`) VALUES
(16, 'PAGI');
INSERT INTO `shift` (`id_shift`, `nama_shift`) VALUES
(17, 'SORE');
INSERT INTO `shift` (`id_shift`, `nama_shift`) VALUES
(18, 'MALAM');
INSERT INTO `shift` (`id_shift`, `nama_shift`) VALUES
(19, 'FULL TIME');

INSERT INTO `stts` (`id_status`, `nama_status`) VALUES
(1, 'Masuk');
INSERT INTO `stts` (`id_status`, `nama_status`) VALUES
(2, 'Pulang');
INSERT INTO `stts` (`id_status`, `nama_status`) VALUES
(3, 'tidak hadir');

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`) VALUES
(48, '::1', 'bangrobin71@gmail.com', '$2a$12$rcPqiSm2usg0meP1hklRJe4MK6/VjfD7P6njeenqCtVAoAOwBIeGW', 'bangrobin71@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1656751712, 1675654805, 1, 'Robin', 'Irawan', 'Nama Perusahaan', '081283328655', 'assets/dist/img/robin.jpg\nassets/dist/img/robin.jpg');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`) VALUES
(49, '::1', 'tomi81@operator.com', '$2y$10$mTjzuKXdV/eHniefOewTxO5LOcQQGa4x89D6d30WCSTNT175JvHKK', 'tomi81@operator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1656751943, 1656756514, 1, 'Tomi', 'Setiawan', 'Nama Perusahaan', '081283328656', NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`) VALUES
(50, '::1', 'teguh', '$2y$12$Uwm5AS/xKjFG9YKMaRIK9O/M7MV/nCAvLJ1luG1dj/t5ZeWr1lRDG', 'teguh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1656751943, 1691135877, 1, 'Teguh', 'Eka Syahputra', 'PT. Merbaujaya Indahraya', '082267274599', 'assets/dist/img/teguh.jpg');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`) VALUES
(51, '::1', 'user', '$2y$10$jos66mVUdGmgrbxyt1zW4ew0lAtdnhLX.DcucV5h4G4B5OnM9UwY.', 'user@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, 1656751943, 1677853245, 1, 'Teguh', 'Eka Syahputra', 'PT. Merbaujaya Indahraya', '082267274599', 'assets/dist/img/teguh.jpg'),
(57, '::1', 'rjn', '$2y$12$5H.AntEwtei1HgzRXGIKUuojygi.Qd9JsuPp.C10f7t7v7ToJi3ue', 'rjn@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1656751943, 1692327055, 1, 'Rezha', 'Jamil', 'PT. Merbaujaya Indahraya', '082267274590', 'assets/dist/img/teguh.jpg');

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(51, 48, 1);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(52, 49, 3);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(53, 50, 1);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(54, 51, 3),
(55, 57, 1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;