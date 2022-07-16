/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - bumdes_sarining_winangun_kukuh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bumdes_sarining_winangun_kukuh` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bumdes_sarining_winangun_kukuh`;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `key` varchar(50) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `config` */

insert  into `config`(`key`,`value`) values 
('biaya_jasa','4000'),
('upah_pungut','17000'),
('biaya_vendor','1000');

/*Table structure for table `m_akun` */

DROP TABLE IF EXISTS `m_akun`;

CREATE TABLE `m_akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(15) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `kelompok` varchar(50) NOT NULL,
  `normal_pos` varchar(50) DEFAULT NULL,
  `saldo_awal` float DEFAULT NULL,
  `saldo_akhir` float DEFAULT NULL,
  PRIMARY KEY (`id`,`kode_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_akun` */

insert  into `m_akun`(`id`,`kode_akun`,`nama_akun`,`golongan`,`kelompok`,`normal_pos`,`saldo_awal`,`saldo_akhir`) values 
(1,'10001','Kas','Aktiva','Aktiva Lancar','Debit',0,NULL),
(2,'10002','Bank Koperasi','Aktiva','Aktiva Lancar','Debit',0,NULL);

/*Table structure for table `m_pelanggan` */

DROP TABLE IF EXISTS `m_pelanggan`;

CREATE TABLE `m_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_pelanggan` */

insert  into `m_pelanggan`(`id`,`kode`,`nama`,`alamat`,`jenis_kelamin`,`no_telepon`) values 
(1,'PL001','I Made Susila Putra','Denpasar Timur','Laki-Laki','081788787222');

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  PRIMARY KEY (`id`,`kode_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `m_user` */

insert  into `m_user`(`id`,`kode_user`,`nama`,`no_telepon`,`username`,`password`,`jabatan`) values 
(1,'U00001','I Nyoman Antara Surata','081999787222','admin','$2y$10$S5zgiJ40qAfX/jFd2v/.K.MuQhYX09VyRHNnzWgC6qDz/FL4t0zwC','Admin'),
(2,'U00002','Wayan Darmawan','081999787333','direktur','$2y$10$uLVJ4UVE6tJv1i8b.70i6OVBYdyNTqoTpldgkarbDc6gOnlkX97si','Direktur');

/*Table structure for table `t_jurnal_umum` */

DROP TABLE IF EXISTS `t_jurnal_umum`;

CREATE TABLE `t_jurnal_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `reff` int(11) NOT NULL,
  `debet` float NOT NULL,
  `kredit` float NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_jurnal_umum` */

/*Table structure for table `t_online` */

DROP TABLE IF EXISTS `t_online`;

CREATE TABLE `t_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jenis_transaksi_id` int(11) NOT NULL,
  `biaya_jasa` float DEFAULT NULL,
  `jumlah` float NOT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_online` */

/*Table structure for table `t_pengeluaran` */

DROP TABLE IF EXISTS `t_pengeluaran`;

CREATE TABLE `t_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `debet` float DEFAULT NULL,
  `kredit` float DEFAULT NULL,
  `reff` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_pengeluaran` */

/*Table structure for table `t_sampah` */

DROP TABLE IF EXISTS `t_sampah`;

CREATE TABLE `t_sampah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi_sampah` varchar(15) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` float NOT NULL,
  `biaya_jasa` float DEFAULT NULL,
  `total_bayar` float DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode_transaksi_sampah`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_sampah` */

insert  into `t_sampah`(`id`,`kode_transaksi_sampah`,`pelanggan_id`,`user_id`,`tanggal`,`jumlah`,`biaya_jasa`,`total_bayar`,`keterangan`) values 
(4,'SP00001',1,1,'2022-07-02 00:00:00',17000,8000,25000,NULL);

/*Table structure for table `t_samsat` */

DROP TABLE IF EXISTS `t_samsat`;

CREATE TABLE `t_samsat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `plat_nomor` varchar(10) NOT NULL,
  `tanggal_samsat` date NOT NULL,
  `jenis_kendaraan` varchar(30) NOT NULL,
  `jumlah_tagihan` float NOT NULL,
  `biaya_jasa` float NOT NULL,
  `jenis_pembayaran` varchar(30) NOT NULL,
  `tanggal_lunas` datetime NOT NULL,
  `total_bayar` float NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_samsat` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
