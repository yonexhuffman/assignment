/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.35-MariaDB : Database - assignment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`assignment` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `assignment`;

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `s_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acc_id` int(10) NOT NULL,
  `s_serialNo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `s_gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:male 2:female',
  `s_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default_man.jpg',
  `s_birth` date DEFAULT NULL,
  `s_schoolname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_grade` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sg_id` int(10) NOT NULL,
  `s_rival_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `student` */

insert  into `student`(`s_id`,`acc_id`,`s_serialNo`,`s_name`,`s_gender`,`s_photo`,`s_birth`,`s_schoolname`,`s_grade`,`sg_id`,`s_rival_id`) values 
(1,16,'15635652','MikeJason',1,'16_1_MikeJason.png','2018-10-11','1565589653',NULL,1,'0'),
(2,17,'15635653','Jackson',1,'17_2_Jackson.jpg','2018-10-12','1565589653',NULL,6,'0'),
(3,18,'15635654','mourinho',1,'18_3_mourinho.jpg','2018-10-19','1536568654',NULL,7,'0'),
(4,19,'15635655','zinedine zidane',1,'19_4_zinedine zidane.jpg','2018-10-30','1536568654',NULL,1,'0'),
(5,20,'15635656','ronaldo',1,'20_5_ronaldo.jpg','2018-10-18','1536568654',NULL,6,'0'),
(6,21,'15635657','Enrique',1,'21_6_Enrique.jpg','2018-10-11','123465798',NULL,1,'0'),
(7,22,'15635658','Mike Tyson',1,'22_7_Mike Tyson.jpg','2018-10-18','1536568654','2010년입학',2,'0'),
(8,23,'15635652','anna',2,'23_8_anna.jpg','2018-10-12','1536568654',NULL,7,'0'),
(9,24,'1895653','한철혁',1,'24_9_한철혁.png','2018-10-24','1536568654','2010년입학',2,'0'),
(10,25,'5654846485','황성혜',2,'25_10_황성혜.jpg','2018-10-02','1536568654','2010년입학',2,'9,11'),
(11,26,'454246515','송철진',1,'26_11_송철진.png','2018-10-25','1536568654','2010년입학',2,'0'),
(12,27,'789465132','손철범',1,'27_12_손철범.png','2018-10-21','1536568654','2010년입학',2,'0'),
(13,28,'1568794512','박철진',1,'28_13_박철진.png','2018-07-22','1536568654',NULL,1,'0'),
(14,29,'18465515','최승철',1,'29_14_최승철.png','2018-02-07','1565589653',NULL,1,'0'),
(15,30,'7846515','송영준',1,'30_15_송영준.png','2018-05-01','1536568654',NULL,7,'0'),
(16,31,'1856515','안영철',1,'31_16_안영철.png','2018-10-18','1536568654',NULL,7,'0'),
(17,32,'15635658','Jason',2,'32_17_Jason.png','2018-10-24','1536568654',NULL,7,'0');

/*Table structure for table `studentgroup` */

DROP TABLE IF EXISTS `studentgroup`;

CREATE TABLE `studentgroup` (
  `sg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sg_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sg_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `t_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`sg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `studentgroup` */

insert  into `studentgroup`(`sg_id`,`sg_number`,`sg_label`,`t_id`) values 
(1,'一年级1234','数学一年级',7),
(2,'123457','물리',8),
(3,'123458','화학',12),
(5,'234567','정보',11),
(6,'123458','자연',10),
(7,'256945','외국어',11);

/*Table structure for table `tbl_account` */

DROP TABLE IF EXISTS `tbl_account`;

CREATE TABLE `tbl_account` (
  `acc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` enum('ADM','TEA','STU') COLLATE utf8_unicode_ci NOT NULL COMMENT 'AMD:Administrator TEA:Teacher STU:Student',
  PRIMARY KEY (`acc_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_account` */

insert  into `tbl_account`(`acc_id`,`user_id`,`user_pass`,`user_role`) values 
(1,'admin','7c50a2551b0ed04ca7a62cd6a0b6ddc1','ADM'),
(2,'최승찬20181002','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(8,'Jane20181001','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(9,'csa20181026','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(11,'김광혁20181011','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(12,'cjc20181027','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(13,'리옥희20181025','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(14,'선승주20181025','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(15,'cym20180210','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA'),
(16,'MikeJason20181011','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(17,'Jackson20181012','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(18,'mourinho20181019','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(19,'zinedine zidane20181030','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(20,'ronaldo20181018','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(21,'Enrique20181011','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(22,'Mike Tyson20181018','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(23,'anna20181012','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(24,'한철혁20181024','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(25,'황성혜20181002','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(26,'송철진20181025','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(27,'손철범20181021','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(28,'박철진20180722','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(29,'최승철20180207','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(30,'송영준20180501','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(31,'안영철20181018','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(32,'Jason20181024','7c50a2551b0ed04ca7a62cd6a0b6ddc1','STU'),
(33,'한송이20180613','7c50a2551b0ed04ca7a62cd6a0b6ddc1','TEA');

/*Table structure for table `tbl_ans_files` */

DROP TABLE IF EXISTS `tbl_ans_files`;

CREATE TABLE `tbl_ans_files` (
  `ans_file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ans_id` int(10) NOT NULL,
  `ans_file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ans_file_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ans_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_ans_files` */

/*Table structure for table `tbl_ass_files` */

DROP TABLE IF EXISTS `tbl_ass_files`;

CREATE TABLE `tbl_ass_files` (
  `ass_file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ass_id` int(10) NOT NULL,
  `ass_file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ass_file_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ass_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_ass_files` */

/*Table structure for table `tbl_assignment` */

DROP TABLE IF EXISTS `tbl_assignment`;

CREATE TABLE `tbl_assignment` (
  `ass_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `give_date` date NOT NULL,
  `t_id` int(10) unsigned NOT NULL,
  `sg_id` int(10) unsigned NOT NULL,
  `ref_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_file_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_assignment` */

/*Table structure for table `tbl_assignment_answers` */

DROP TABLE IF EXISTS `tbl_assignment_answers`;

CREATE TABLE `tbl_assignment_answers` (
  `ans_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ass_id` int(10) unsigned NOT NULL,
  `s_id` int(10) unsigned NOT NULL,
  `point` float DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_assignment_answers` */

/*Table structure for table `teacher` */

DROP TABLE IF EXISTS `teacher`;

CREATE TABLE `teacher` (
  `t_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acc_id` int(10) NOT NULL,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:male 2:female',
  `t_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default_man.png',
  `t_birth` date DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `teacher` */

insert  into `teacher`(`t_id`,`acc_id`,`t_name`,`t_gender`,`t_photo`,`t_birth`) values 
(1,1,'admin',2,'admin_1_1.jpg','1985-01-01'),
(2,2,'최승찬',1,'2_2_최승찬.jpg','2018-10-02'),
(7,8,'Jane',2,'8_7_Jane.jpg','2018-10-01'),
(8,9,'최송애',2,'9_8_최송애.jpg','2018-10-26'),
(10,11,'김광혁',1,'11_10_김광혁.jpg','2018-10-11'),
(11,12,'최진철',1,'12_11_최진철.jpg','2018-10-27'),
(12,13,'리옥희',2,'13_12_리옥희.jpg','2018-10-25'),
(13,14,'선승주',1,'14_13_선승주.jpg','2018-10-25'),
(14,15,'최영미',2,'15_14_최영미.jpg','2018-02-10'),
(15,33,'한송이',2,'33_15_한송이.jpg','2018-06-13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
