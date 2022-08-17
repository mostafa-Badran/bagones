-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: bagdonesdb
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fs_appearances`
--

DROP TABLE IF EXISTS `fs_appearances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_appearances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type_id` bigint unsigned NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_appearances_number_unique` (`number`),
  KEY `fs_appearances_content_type_id_foreign` (`content_type_id`),
  CONSTRAINT `fs_appearances_content_type_id_foreign` FOREIGN KEY (`content_type_id`) REFERENCES `fs_content_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_appearances`
--

LOCK TABLES `fs_appearances` WRITE;
/*!40000 ALTER TABLE `fs_appearances` DISABLE KEYS */;
INSERT INTO `fs_appearances` VALUES (1,'400',1,'20220603171229.jpeg','2022-06-03 17:12:29','2022-06-04 21:15:27',NULL),(2,'101',2,'20220603171257.jpeg','2022-06-03 17:12:57','2022-06-05 13:05:52',NULL),(3,'102',2,'20220603171316.jpeg','2022-06-03 17:13:16','2022-06-05 13:05:40',NULL),(4,'103',2,'20220603171536.jpeg','2022-06-03 17:15:36','2022-06-04 21:08:04',NULL),(5,'201',3,'20220604124601.png','2022-06-04 12:46:01','2022-06-04 21:08:17',NULL),(6,'300',5,NULL,'2022-06-04 20:31:36','2022-06-04 20:31:36',NULL),(7,'202',3,NULL,'2022-06-06 22:14:35','2022-06-06 22:14:35',NULL),(8,'203',3,NULL,'2022-06-06 22:25:00','2022-06-06 22:25:00',NULL),(9,'204',3,NULL,'2022-06-07 00:18:28','2022-06-07 00:18:28',NULL);
/*!40000 ALTER TABLE `fs_appearances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_area_store`
--

DROP TABLE IF EXISTS `fs_area_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_area_store` (
  `store_id` bigint unsigned NOT NULL,
  `area_id` mediumint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `fs_area_store_store_id_foreign` (`store_id`),
  KEY `fs_area_store_area_id_foreign` (`area_id`),
  CONSTRAINT `fs_area_store_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `fs_areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fs_area_store_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `fs_stores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_area_store`
--

LOCK TABLES `fs_area_store` WRITE;
/*!40000 ALTER TABLE `fs_area_store` DISABLE KEYS */;
INSERT INTO `fs_area_store` VALUES (1,91,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_area_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_areas`
--

DROP TABLE IF EXISTS `fs_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_areas` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'This auto increment column to generate unique id.',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column help to store city name.',
  `name_local` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column help to store city name in local language.',
  `city_id` mediumint unsigned NOT NULL COMMENT 'This column stores state for the city and references state table.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_areas_name_city_id_unique` (`name`,`city_id`),
  KEY `fs_areas_city_id_foreign` (`city_id`),
  CONSTRAINT `fs_areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `fs_cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_areas`
--

LOCK TABLES `fs_areas` WRITE;
/*!40000 ALTER TABLE `fs_areas` DISABLE KEYS */;
INSERT INTO `fs_areas` VALUES (1,'Abu Dhabi Gate City','بوابة ابوظبي',1,NULL,NULL,NULL),(2,'Airport Road','شارع المطار',1,NULL,NULL,NULL),(3,'Al Bahia','الباهية',1,NULL,NULL,NULL),(4,'Al Baniyas','بني ياس',1,NULL,NULL,NULL),(5,'Al Baraha','البراحة',1,NULL,NULL,NULL),(6,'Al Bateen','البطين',1,NULL,NULL,NULL),(7,'Al Dhafrah','الظفرة',1,NULL,NULL,NULL),(8,'Al Falah City','مدينة الفلاح',1,NULL,NULL,NULL),(9,'Al Ghadeer','الغدير',1,NULL,NULL,NULL),(10,'Al Gurm','القرم',1,NULL,NULL,NULL),(11,'Al Gurm West','القرم الغربية',1,NULL,NULL,NULL),(12,'Al Hudayriat Island','جزيرة الحضيريات',1,NULL,NULL,NULL),(13,'Al Ittihad Road','شارع الاتحاد',1,NULL,NULL,NULL),(14,'Al Karama','الكرامة',1,NULL,NULL,NULL),(15,'Al Khalidiya','الخالدية',1,NULL,NULL,NULL),(16,'Al Khatim','الخاتم',1,NULL,NULL,NULL),(17,'Al Maffraq','المفرق',1,NULL,NULL,NULL),(18,'Al Manaseer','المناصير',1,NULL,NULL,NULL),(19,'Al Manhal','المنهل',1,NULL,NULL,NULL),(20,'Al Maqtaa','منطقة المقطع',1,NULL,NULL,NULL),(21,'Al Markaziyah','المركزية',1,NULL,NULL,NULL),(22,'Al Maryah','جزيرة الماريه الصواح',1,NULL,NULL,NULL),(23,'Al Mina','ميتاء زايد',1,NULL,NULL,NULL),(24,'Al Mushrif','المشرف',1,NULL,NULL,NULL),(25,'Al Nahda','النهضة ابوظبي',1,NULL,NULL,NULL),(26,'Al Nahyan Camp','معسكر ال نهيان',1,NULL,NULL,NULL),(27,'Al Najda Street','شارع النجدة',1,NULL,NULL,NULL),(28,'Al Raha Beach','شاطئ الراحه',1,NULL,NULL,NULL),(29,'Al Raha Gardens','حدائق الراحة',1,NULL,NULL,NULL),(30,'Al Raha Golf Gardens','حدائق الجولف في الراحة',1,NULL,NULL,NULL),(31,'Al Rahba','الرجبة',1,NULL,NULL,NULL),(32,'Al Rawdah','الروضة',1,NULL,NULL,NULL),(33,'Al Rayhan','الريحان',1,NULL,NULL,NULL),(34,'Al Reef','مشروع الريف',1,NULL,NULL,NULL),(35,'Al Reem Island','جزيرة الريم',1,NULL,NULL,NULL),(36,'Al Ruwais','الرويس',1,NULL,NULL,NULL),(37,'Al Salam Street','شارع السلام',1,NULL,NULL,NULL),(38,'Al Samha','السمحة',1,NULL,NULL,NULL),(39,'Al Shahama','الشهامة',1,NULL,NULL,NULL),(40,'Al Shamkha','الشمخة',1,NULL,NULL,NULL),(41,'Al Shawamekh','الشوامخ',1,NULL,NULL,NULL),(42,'Al Wahda','الوحدة',1,NULL,NULL,NULL),(43,'Al Wathba','الوثبة',1,NULL,NULL,NULL),(44,'Al Zaab','الزعاب',1,NULL,NULL,NULL),(45,'Al Zahraa','الزهراء',1,NULL,NULL,NULL),(46,'Al-Forsan','قرية الفرسان',1,NULL,NULL,NULL),(47,'Badaa','البدع',1,NULL,NULL,NULL),(48,'Between Tow Bridges','منطقة بين الجسرين',1,NULL,NULL,NULL),(49,'Building Materials City','مدينة خامات البناء',1,NULL,NULL,NULL),(50,'Capital Centre','كابيتال سنتر',1,NULL,NULL,NULL),(51,'City Downtown','وسط المدينة',1,NULL,NULL,NULL),(52,'Corniche Area','منطقة خلف شارع الكورنيش',1,NULL,NULL,NULL),(53,'Corniche Road','شارع الكورنيش',1,NULL,NULL,NULL),(54,'Danet Abu Dhabi','دانة ابوظبي',1,NULL,NULL,NULL),(55,'Defence Street','شارع الدفاع',1,NULL,NULL,NULL),(56,'Desert Village','القرية الصحراوية',1,NULL,NULL,NULL),(57,'Eastern Road','الطريق الشرقي',1,NULL,NULL,NULL),(58,'Electra Street','شارع الكترا',1,NULL,NULL,NULL),(60,'Ghantoot','غنتوت',1,NULL,NULL,NULL),(61,'Grand Mosque District','منطقة المسجد الكبير',1,NULL,NULL,NULL),(62,'Hamdan Street','شارع حمدان',1,NULL,NULL,NULL),(63,'Hameem','حميم',1,NULL,NULL,NULL),(64,'Hydra Village','قرية هيدار',1,NULL,NULL,NULL),(65,'Jawazat Street','شارع الجوازات',1,NULL,NULL,NULL),(66,'Khalifa City','مدينة خليفة',1,NULL,NULL,NULL),(67,'Khalifa Street','شارع خليفة',1,NULL,NULL,NULL),(68,'Liwa','ليوا',1,NULL,NULL,NULL),(69,'Lulu Island','جزيرة اللولو',1,NULL,NULL,NULL),(70,'Madinat Zayed','مدينة زايد',1,NULL,NULL,NULL),(71,'Marina Village','قرية مارينا',1,NULL,NULL,NULL),(72,'Masdar City','مدينة مصدر',1,NULL,NULL,NULL),(73,'Mina Zayed','مناء زايد',1,NULL,NULL,NULL),(74,'Mohammad Bin Zayed City','مدينة محمد بن زايد',1,NULL,NULL,NULL),(75,'Muroor Area','منطقة المرور',1,NULL,NULL,NULL),(76,'Mussafah','مصفح',1,NULL,NULL,NULL),(77,'Nurai Island','جزيرة نوراي',1,NULL,NULL,NULL),(78,'Saadiyat Island','جزيرة السعديات',1,NULL,NULL,NULL),(79,'Sas Al Nakheel','ساس النخيل',1,NULL,NULL,NULL),(80,'Tourist Club Area','منطقة النادي السياحي',1,NULL,NULL,NULL),(81,'Umm Al Nar','ام النار',1,NULL,NULL,NULL),(82,'Yas Island','جزيرة الياس',1,NULL,NULL,NULL),(83,'Zayed Military City','مدينة زايد العسكرية',1,NULL,NULL,NULL),(84,'Zayed Sports City','مدينة زايد الرياضية',1,NULL,NULL,NULL),(85,'sila\'a','السلع',1,NULL,NULL,NULL),(86,'Acacia Avenues','القوز',2,NULL,NULL,NULL),(87,'Academic City','المدينة الأكاديمية',2,NULL,NULL,NULL),(88,'Al Aweer','العوير',2,NULL,NULL,NULL),(89,'Al Badaa','البدع',2,NULL,NULL,NULL),(90,'Al Barari','البراري',2,NULL,NULL,NULL),(91,'Al Barsha','البرشاء',2,NULL,NULL,NULL),(92,'Al Furjan','الفرجان',2,NULL,NULL,NULL),(93,'Al Garhoud','القرهود',2,NULL,NULL,NULL),(94,'Al Hamriya','الحميرية',2,NULL,NULL,NULL),(95,'Al Jaddaf','الجداف',2,NULL,NULL,NULL),(96,'Al Jafiliya','الجافلية',2,NULL,NULL,NULL),(97,'Al Khawaneej','الكورنيش',2,NULL,NULL,NULL),(98,'Al Manara','المنارة',2,NULL,NULL,NULL),(99,'Al Mizhar','المزهر',2,NULL,NULL,NULL),(100,'Al Muhaisnah','المحيسنية',2,NULL,NULL,NULL),(101,'Al Nahda','النهدا',2,NULL,NULL,NULL),(102,'Al Quoz','القوز',2,NULL,NULL,NULL),(103,'Al Qusais','القصيص',2,NULL,NULL,NULL),(104,'Al Rashidiya','الراشدية',2,NULL,NULL,NULL),(105,'Al Safa','الصفا',2,NULL,NULL,NULL),(106,'Al Satwa','السطوة',2,NULL,NULL,NULL),(107,'Al Shindagah','الشندغة',2,NULL,NULL,NULL),(108,'Al Sufouh','الصفة',2,NULL,NULL,NULL),(109,'Al Twar','الطور',2,NULL,NULL,NULL),(110,'Al Warqa\'a','الورقاء',2,NULL,NULL,NULL),(111,'Al Warsan','الورسان',2,NULL,NULL,NULL),(112,'Al Wasl','الوصل',2,NULL,NULL,NULL),(113,'Arabian Ranches','المرابع العربية',2,NULL,NULL,NULL),(114,'Bluewaters Island','جزيرة بلوواترز',2,NULL,NULL,NULL),(115,'Bur Dubai','بر دبي',2,NULL,NULL,NULL),(116,'Business Bay','الخليج التجاري',2,NULL,NULL,NULL),(117,'Culture Village','القرية الثقافية',2,NULL,NULL,NULL),(118,'DIFC','القضائية',2,NULL,NULL,NULL),(119,'Damac Hills','داماك هيلز',2,NULL,NULL,NULL),(120,'Deira','ديرة',2,NULL,NULL,NULL),(121,'Discovery Gardens','ديسكفري جاردنز',2,NULL,NULL,NULL),(122,'DuBiotech','المركز الالكتروني بدبي',2,NULL,NULL,NULL),(123,'Dubai Design District','حي دبي للتصميم',2,NULL,NULL,NULL),(124,'Dubai Downtown Dubai','وسط المدينة',2,NULL,NULL,NULL),(125,'Dubai Downtown Jebel Ali','وسط المدينة جبل علي',2,NULL,NULL,NULL),(126,'Dubai Festival City','فيستيفال سيتي',2,NULL,NULL,NULL),(127,'Dubai Healthcare City','مدينة الرعاية الصحية ',2,NULL,NULL,NULL),(128,'Dubai Land','لاند',2,NULL,NULL,NULL),(129,'Dubai Marina','مارينا',2,NULL,NULL,NULL),(130,'Dubai Pearl','لؤلؤة',2,NULL,NULL,NULL),(131,'Dubai Promenade','الممشى',2,NULL,NULL,NULL),(132,'Dubai Silicon Oasis','واحة السيليكون',2,NULL,NULL,NULL),(133,'Dubai Sports City','مدينة دبي الرياضية',2,NULL,NULL,NULL),(134,'Dubai Studio City','استوديو سيتي',2,NULL,NULL,NULL),(135,'Dubai Waterfront','الواجهة البحرية',2,NULL,NULL,NULL),(136,'Dubai World Central','مركز دبي العالمي',2,NULL,NULL,NULL),(137,'Emirates Golf Club','نادي الإمارات للجولف',2,NULL,NULL,NULL),(138,'Emirates Hills','تلال الامارات',2,NULL,NULL,NULL),(139,'Global Village','القرية العالمية',2,NULL,NULL,NULL),(140,'Green Community','مجتمع الحدائق',2,NULL,NULL,NULL),(141,'Greens','جرينز',2,NULL,NULL,NULL),(142,'Hatta','حتا',2,NULL,NULL,NULL),(143,'Hills Estate','هيلز استيت',2,NULL,NULL,NULL),(144,'IMPZ','مدينة الانتاج الاعلامي',2,NULL,NULL,NULL),(145,'Industrial City','الصناعيّة',2,NULL,NULL,NULL),(146,'International City','القرية العالمية',2,NULL,NULL,NULL),(147,'Investment Park','مجمع دبي للإستثمار',2,NULL,NULL,NULL),(148,'Jebel Ali','جبل علي',2,NULL,NULL,NULL),(149,'Jumeirah','جميرا',2,NULL,NULL,NULL),(150,'Jumeirah Beach Residence','مساكن شاطئ جميرا',2,NULL,NULL,NULL),(151,'Jumeirah Golf Estates','منطقة الجولف الجميرا',2,NULL,NULL,NULL),(152,'Jumeirah Heights','تلال الامارات',2,NULL,NULL,NULL),(153,'Jumeirah Islands','جزر الجميرا',2,NULL,NULL,NULL),(154,'Jumeirah Lake Towers','ابراج بحيرة الجميرا',2,NULL,NULL,NULL),(155,'Jumeirah Park','جميرا بارك',2,NULL,NULL,NULL),(156,'Jumeirah Village Circle','قرية الجميرا سركل',2,NULL,NULL,NULL),(157,'Jumeirah Village Triangle','مثلث قرية الجميرا',2,NULL,NULL,NULL),(158,'Karama','الكرامة',2,NULL,NULL,NULL),(159,'Liwan','ليوان',2,NULL,NULL,NULL),(160,'Maritime City','المدينة الملاحية',2,NULL,NULL,NULL),(161,'Meadows','ميدوز',2,NULL,NULL,NULL),(162,'Media City','المدينة الاعلامية',2,NULL,NULL,NULL),(163,'Meydan Avenue','ميدان افينو',2,NULL,NULL,NULL),(164,'Meydan Gated Community','ميدان غايتد كوميونيتي',2,NULL,NULL,NULL),(165,'Mina Al Arab','ميناء العرب',2,NULL,NULL,NULL),(166,'Mirdif','مردف',2,NULL,NULL,NULL),(167,'Mohammad Bin Rashid City','مدينة محمد بن راشد',2,NULL,NULL,NULL),(168,'Motor City','مدينة السيارات',2,NULL,NULL,NULL),(169,'Mudon','مدن',2,NULL,NULL,NULL),(170,'Mushrif Park','حديقة المشرف',2,NULL,NULL,NULL),(171,'Nadd Al Hammar','ند الحمر',2,NULL,NULL,NULL),(172,'Nadd Al Sheba','ند الشبا',2,NULL,NULL,NULL),(173,'Old Town','المدينة القديمة',2,NULL,NULL,NULL),(174,'Oud Al Muteena','عود المطينة',2,NULL,NULL,NULL),(175,'Palm Jebel Ali','نخلة جبل علي',2,NULL,NULL,NULL),(176,'Palm jumeirah','نخلة الجميرا',2,NULL,NULL,NULL),(177,'Port Rashid','ميناء راشد',2,NULL,NULL,NULL),(178,'Ras Al Khor','رأس الخور',2,NULL,NULL,NULL),(179,'Reem','ريم',2,NULL,NULL,NULL),(180,'Remram','رامرام',2,NULL,NULL,NULL),(181,'Residence Complex','مجمع دبي السكني',2,NULL,NULL,NULL),(182,'Sceince Park','مجمع دبي للعلوم',2,NULL,NULL,NULL),(183,'Serena','سيرينا',2,NULL,NULL,NULL),(184,'Sheikh Zayed Road','شارع الشيخ زايد',2,NULL,NULL,NULL),(185,'South Dubai','دبي جنوب',2,NULL,NULL,NULL),(186,'TECOM','تيكوم',2,NULL,NULL,NULL),(187,'Technology Park','واحة التكنولوجيا',2,NULL,NULL,NULL),(188,'The Gardens','الحدائق',2,NULL,NULL,NULL),(189,'The Hills','مشروع التلال',2,NULL,NULL,NULL),(190,'The Lagoons','ذا لاجونز',2,NULL,NULL,NULL),(191,'The Lakes','البحيرات',2,NULL,NULL,NULL),(192,'The Meadows','المروج',2,NULL,NULL,NULL),(193,'The Palm Deira','جزيرة النخلة ديرة',2,NULL,NULL,NULL),(194,'The Springs','الينابيع',2,NULL,NULL,NULL),(195,'The Views','ذا فيوز',2,NULL,NULL,NULL),(196,'The World Islands','جزر العالم',2,NULL,NULL,NULL),(197,'Umm Al Sheif','ام الشيف',2,NULL,NULL,NULL),(198,'Umm Hurair','ام الحرير',2,NULL,NULL,NULL),(199,'Umm Ramool','ام الرمول',2,NULL,NULL,NULL),(200,'Umm Suqeim','ام سقيم',2,NULL,NULL,NULL),(201,'Victory Heights','فيكتوري هايتس',2,NULL,NULL,NULL),(202,'Wadi Al Amardi','وادي الاماردي',2,NULL,NULL,NULL),(203,'World Trade Center','المركز المالي العالمي',2,NULL,NULL,NULL),(204,'Zabeel','زعبيل',2,NULL,NULL,NULL),(205,'Zulal','زلال',2,NULL,NULL,NULL),(206,'jmc','جميرة',2,NULL,NULL,NULL),(207,'Aalwan','حلوان',3,NULL,NULL,NULL),(208,'Aaterfront City Marina','الواجهة المائية',3,NULL,NULL,NULL),(209,'Abu Shagra','ابو شغارة',3,NULL,NULL,NULL),(210,'Airport Freezon','المنطقة الحرة بمطار الشارقة',3,NULL,NULL,NULL),(211,'Al Azra','العزرة',3,NULL,NULL,NULL),(212,'Al Badie','البادي',3,NULL,NULL,NULL),(213,'Al Brashi','البراشي',3,NULL,NULL,NULL),(214,'Al Butina','البطينة',3,NULL,NULL,NULL),(215,'Al Ettihad Street','شارع الاتحاد',3,NULL,NULL,NULL),(216,'Al Falaj','الفلج',3,NULL,NULL,NULL),(217,'Al Fayha','الفيحاء',3,NULL,NULL,NULL),(218,'Al Fisht','منطقة الفشت',3,NULL,NULL,NULL),(219,'Al Garayen','القرائن',3,NULL,NULL,NULL),(220,'Al Ghafeyah Area','الغافية',3,NULL,NULL,NULL),(221,'Al Gharb','الغرب',3,NULL,NULL,NULL),(222,'Al Ghuair','الغوير',3,NULL,NULL,NULL),(223,'Al Jada','شارع الاتحاد',3,NULL,NULL,NULL),(224,'Al Jubail','الجبيل',3,NULL,NULL,NULL),(225,'Al Jurainah','الجرينة',3,NULL,NULL,NULL),(226,'Al Khezamia','الحزامية',3,NULL,NULL,NULL),(227,'Al Majaz','المجاز',3,NULL,NULL,NULL),(228,'Al Mareija','المريجة',3,NULL,NULL,NULL),(229,'Al Mujarrah','المجرة',3,NULL,NULL,NULL),(230,'Al Nabba','النباعة',3,NULL,NULL,NULL),(231,'Al Nahda','النهدة',3,NULL,NULL,NULL),(232,'Al Naimiya Area','منطقة النعيمية',3,NULL,NULL,NULL),(233,'Al Nasreya','الناصرية',3,NULL,NULL,NULL),(234,'Al Nekhailat','النخيلات',3,NULL,NULL,NULL),(235,'Al Nouf','النوف',3,NULL,NULL,NULL),(236,'Al Nujoom Islands','جزيرة النجوم',3,NULL,NULL,NULL),(237,'Al Qarain','القرين',3,NULL,NULL,NULL),(238,'Al Qasbaa','القصباء',3,NULL,NULL,NULL),(239,'Al Qasemiya','القاسمية',3,NULL,NULL,NULL),(240,'Al Rahmaniya','الرحمانية',3,NULL,NULL,NULL),(241,'Al Ramaqiya','الرماقية',3,NULL,NULL,NULL),(242,'Al Ramla','الرملة',3,NULL,NULL,NULL),(243,'Al Ramtha','الرمثاء',3,NULL,NULL,NULL),(244,'Al Riffa Area','منطقة الرفاع',3,NULL,NULL,NULL),(245,'Al Riqqa','ضاحية الرقة',3,NULL,NULL,NULL),(246,'Al Sajaa','السجع',3,NULL,NULL,NULL),(247,'Al Shahba','الشهباء',3,NULL,NULL,NULL),(248,'Al Sharq','الشرق',3,NULL,NULL,NULL),(249,'Al Suyoh','السيوح',3,NULL,NULL,NULL),(250,'Al Suyoh Suburb','ضاحية السيوح',3,NULL,NULL,NULL),(251,'Al Taawun','التعاون',3,NULL,NULL,NULL),(252,'Al Tai','الطي',3,NULL,NULL,NULL),(253,'Al Tayy Suburb','ضاحية الطي',3,NULL,NULL,NULL),(254,'Al Wahda','الوحدة',3,NULL,NULL,NULL),(255,'Al Yarmouk','اليرموك',3,NULL,NULL,NULL),(256,'Al Yash','الياش',3,NULL,NULL,NULL),(257,'Al Zubair','الزبير',3,NULL,NULL,NULL),(258,'Bu Tina','بوطينة',3,NULL,NULL,NULL),(259,'Cornich Al Buhaira','كورنيش البحيرة',3,NULL,NULL,NULL),(260,'Hamriyah Free Zone','المنطقة الحرة بالحامرية',3,NULL,NULL,NULL),(261,'Hoshi','حوشي',3,NULL,NULL,NULL),(262,'Industrial Area','المنطقة الصناعية',3,NULL,NULL,NULL),(263,'Jwezaa','جويرة',3,NULL,NULL,NULL),(264,'Maysaloon','ميسلون',3,NULL,NULL,NULL),(265,'Muelih','مويلح',3,NULL,NULL,NULL),(266,'Muelih Commercial','تجارية مويلح',3,NULL,NULL,NULL),(267,'Mughaidir','مغيدر',3,NULL,NULL,NULL),(268,'Rolla Area','منطقة الرولة',3,NULL,NULL,NULL),(269,'Sharqan','شرقان',3,NULL,NULL,NULL),(270,'Tilal City','تلال سيتي',3,NULL,NULL,NULL),(271,'Um Altaraffa','ام الطرفة',3,NULL,NULL,NULL),(272,'Umm Khanoor','ام خنور',3,NULL,NULL,NULL),(273,'University City','المدينة الجامعية',3,NULL,NULL,NULL),(274,'Wasit','ضاحية واسط',3,NULL,NULL,NULL),(275,'Al Ain Industrial Area','العين الصناعية',4,NULL,NULL,NULL),(276,'Al Faqa\'a','الفقع',4,NULL,NULL,NULL),(277,'Al Grayyeh','القرية',4,NULL,NULL,NULL),(278,'Al Hili','الهيلي',4,NULL,NULL,NULL),(279,'Al Jaheli','الجهلي',4,NULL,NULL,NULL),(280,'Al Jimi','الجيمي',4,NULL,NULL,NULL),(281,'Al Khabisi','الخبيصي',4,NULL,NULL,NULL),(282,'Al Manaseer','المناصير',4,NULL,NULL,NULL),(283,'Al Maqam','المقام',4,NULL,NULL,NULL),(284,'Al Markhaniya','المرخانية',4,NULL,NULL,NULL),(285,'Al Murabaa','المرابعة',4,NULL,NULL,NULL),(286,'Al Mutarad','المطارد',4,NULL,NULL,NULL),(287,'Al Mutawaa','المطوعة',4,NULL,NULL,NULL),(288,'Al Muwahie','المواهي',4,NULL,NULL,NULL),(289,'Al Muwaiji','المويجي',4,NULL,NULL,NULL),(290,'Al Neyadat','النيادات',4,NULL,NULL,NULL),(291,'Al Oyoun Village','قرية العيون',4,NULL,NULL,NULL),(292,'Al Sinaiya','السنية',4,NULL,NULL,NULL),(293,'Tawam','توام',4,NULL,NULL,NULL),(294,'Wahat Al Zaweya','واحة الزاوية',4,NULL,NULL,NULL),(295,'Zakher','زاخر',4,NULL,NULL,NULL),(296,'Ain Ajman','عين عجمان',5,NULL,NULL,NULL),(297,'Ajman Corniche Road','كورنيش عجمان',5,NULL,NULL,NULL),(298,'Ajman Downtown','عجمان وسط المدينة',5,NULL,NULL,NULL),(299,'Ajman Industrial Area','المنطقة الصناعية',5,NULL,NULL,NULL),(300,'Ajman Meadows','مروج عجمان',5,NULL,NULL,NULL),(301,'Ajman Uptown','ضواحي عجمان',5,NULL,NULL,NULL),(302,'Al Amerah','العامرة',5,NULL,NULL,NULL),(303,'Al Amerah Village','قرية العامرة',5,NULL,NULL,NULL),(304,'Al Bustan','البستان',5,NULL,NULL,NULL),(305,'Al Hamidiya','الحميدية',5,NULL,NULL,NULL),(306,'Al Helio','الحيلو',5,NULL,NULL,NULL),(307,'Al Humaid City','مدينة الحميدية',5,NULL,NULL,NULL),(308,'Al Ittihad Village','قرية الاتحاد',5,NULL,NULL,NULL),(309,'Al Jurf','الجرف',5,NULL,NULL,NULL),(310,'Al Mwaihat','المويحات',5,NULL,NULL,NULL),(311,'Al Naemiyah','النعيمية',5,NULL,NULL,NULL),(312,'Al Raqaib','الرقيب',5,NULL,NULL,NULL),(313,'Al Rashidiya','الراشدية',5,NULL,NULL,NULL),(314,'Al Rawda','الروضة',5,NULL,NULL,NULL),(315,'Al Rumaila','الراشدية',5,NULL,NULL,NULL),(316,'Al Sawan','الصوان',5,NULL,NULL,NULL),(317,'Al Zahraa','الزهراء',5,NULL,NULL,NULL),(318,'Al Zorah','الزهراء',5,NULL,NULL,NULL),(319,'Awali City','مدينة عوالي',5,NULL,NULL,NULL),(320,'Green City','مدينة الحدائق',5,NULL,NULL,NULL),(321,'Manama','المنامة',5,NULL,NULL,NULL),(322,'Marmooka City','مدينة مرموكة',5,NULL,NULL,NULL),(323,'Masfoot','مصفوط',5,NULL,NULL,NULL),(324,'Musheiref','مشيرف',5,NULL,NULL,NULL),(325,'New Industrial Area','المنطقة الصناعية الجديدة',5,NULL,NULL,NULL),(326,'Park View City','بارك فيو سيتي',5,NULL,NULL,NULL),(327,'Sheikh Khalifa Bin Zayed Street','شارع الشيخ خليفة بن زايد',5,NULL,NULL,NULL),(328,'Sheikh Maktoum Bin Rashid Rd','شارع الشيخ مكتوم بن راشد',5,NULL,NULL,NULL),(329,'Al Dhait','الظيت',6,NULL,NULL,NULL),(330,'Al Ghubb','الغب',6,NULL,NULL,NULL),(331,'Al Huamra','الحمرا',6,NULL,NULL,NULL),(332,'Al Huamra Village','قرية الحمرا',6,NULL,NULL,NULL),(333,'Al Juwais','الجويس',6,NULL,NULL,NULL),(334,'Al Mamourah','المعمورة',6,NULL,NULL,NULL),(335,'Al Marjan Island','جزيرة المرجان',6,NULL,NULL,NULL),(336,'Al Nakheel','النخيل',6,NULL,NULL,NULL),(337,'Al Qusaidat','القصيدات',6,NULL,NULL,NULL),(338,'Al Uraibi','العريبي',6,NULL,NULL,NULL),(339,'Al kornish','كورنيش راس الخيمة',6,NULL,NULL,NULL),(340,'Creek','خليج راس الخيمة',6,NULL,NULL,NULL),(341,'Dana Island','جزيرة الدانة',6,NULL,NULL,NULL),(342,'Gateway','راس الخيمة جيتواي',6,NULL,NULL,NULL),(343,'Julfa','جلفار',6,NULL,NULL,NULL),(344,'Khuzam','خزام',6,NULL,NULL,NULL),(345,'Mina Al Arab','ميناء العرب راس الخيمة',6,NULL,NULL,NULL),(346,'PAK FTZ','المنطقة التجارية الحرة',6,NULL,NULL,NULL),(347,'PAK Industrial And Technology Park','واحة التكنولوجيا',6,NULL,NULL,NULL),(348,'Saraya Islands','جزر سرايا',6,NULL,NULL,NULL),(349,'Sheikh Mohammad Bin Zayed Road','شارع الشيخ محمد بن زايد',6,NULL,NULL,NULL),(350,'Sidroh','سدورة',6,NULL,NULL,NULL),(351,'Waterfront','الواجهة المائية',6,NULL,NULL,NULL),(352,'Yasmin Village','قرية الياسمين',6,NULL,NULL,NULL),(353,'Al Aahad','الآحاد',7,NULL,NULL,NULL),(354,'Al Dar Al Baidaa','الدار البيضاء',7,NULL,NULL,NULL),(355,'Al Haditha','الحديثة',7,NULL,NULL,NULL),(356,'Al Humra','الحمرة',7,NULL,NULL,NULL),(357,'Al Kaber','منطقة الكابر',7,NULL,NULL,NULL),(358,'Al Khor','الخور',7,NULL,NULL,NULL),(359,'Al Maidan','الميدان',7,NULL,NULL,NULL),(360,'Al Raas','الراس',7,NULL,NULL,NULL),(361,'Al Ramla','الرملة',7,NULL,NULL,NULL),(362,'Al Raudah','الروضة',7,NULL,NULL,NULL),(363,'Al Riqqa','الرقة',7,NULL,NULL,NULL),(364,'Al Salam City','مدينة السلام',7,NULL,NULL,NULL),(365,'Al Salamah','ضاحية السلام',7,NULL,NULL,NULL),(366,'Al Surra','السرة',7,NULL,NULL,NULL),(367,'Beidah','خور البيضاء',7,NULL,NULL,NULL),(368,'Emirates Modern Industrial','منطقة الامارات الصناعية الحديثة',7,NULL,NULL,NULL),(369,'Marina','مارينا ام القوين',7,NULL,NULL,NULL),(370,'Moalla','فلج المعلا',7,NULL,NULL,NULL),(371,'Old Induustrial Area','المنطقة الصناعية القديمة',7,NULL,NULL,NULL),(372,'White Bay','الخليج الابيض',7,NULL,NULL,NULL),(373,'Corniche Fujairah','كورنيش الفجيرة',8,NULL,NULL,NULL),(374,'Deba Fujairah','دبا',8,NULL,NULL,NULL),(375,'Downtown Fujairah','وسط المدينة',8,NULL,NULL,NULL),(376,'Faseel','الفصيل',8,NULL,NULL,NULL),(377,'Fujairah Freezone','المنطقة الحرة',8,NULL,NULL,NULL),(378,'Gurfah','الغرفة',8,NULL,NULL,NULL),(379,'Merashid','مراشد',8,NULL,NULL,NULL),(380,'Sakamkam','سكمكم',8,NULL,NULL,NULL),(381,'Saniaya','سنايا',8,NULL,NULL,NULL),(382,'Sharm','شرم',8,NULL,NULL,NULL),(383,'Sheikh Hamad Bin Abdullah St','شارع الشيخ حمد بن عبدالله',8,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_attribute_entries`
--

DROP TABLE IF EXISTS `fs_attribute_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_attribute_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_attribute_entries_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `fs_attribute_entries_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `fs_attributes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_attribute_entries`
--

LOCK TABLES `fs_attribute_entries` WRITE;
/*!40000 ALTER TABLE `fs_attribute_entries` DISABLE KEYS */;
INSERT INTO `fs_attribute_entries` VALUES (3,2,'small','صغير',NULL,NULL,NULL),(4,2,'medium','متوسط',NULL,NULL,NULL),(5,2,'larg','كبير',NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_attribute_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_attribute_files`
--

DROP TABLE IF EXISTS `fs_attribute_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_attribute_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint unsigned NOT NULL,
  `file_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_attribute_files_attribute_id_file_id_unique` (`attribute_id`,`file_id`),
  KEY `fs_attribute_files_file_id_foreign` (`file_id`),
  CONSTRAINT `fs_attribute_files_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `fs_attributes` (`id`),
  CONSTRAINT `fs_attribute_files_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `fs_files` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_attribute_files`
--

LOCK TABLES `fs_attribute_files` WRITE;
/*!40000 ALTER TABLE `fs_attribute_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_attribute_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_attribute_item`
--

DROP TABLE IF EXISTS `fs_attribute_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_attribute_item` (
  `item_id` bigint unsigned NOT NULL,
  `attribute_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fs_attribute_item_item_id_foreign` (`item_id`),
  KEY `fs_attribute_item_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `fs_attribute_item_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `fs_attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fs_attribute_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_attribute_item`
--

LOCK TABLES `fs_attribute_item` WRITE;
/*!40000 ALTER TABLE `fs_attribute_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_attribute_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_attribute_types`
--

DROP TABLE IF EXISTS `fs_attribute_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_attribute_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasPictures` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_attribute_types_type_user_id_unique` (`type`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_attribute_types`
--

LOCK TABLES `fs_attribute_types` WRITE;
/*!40000 ALTER TABLE `fs_attribute_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_attribute_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_attributes`
--

DROP TABLE IF EXISTS `fs_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_locale` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_attributes`
--

LOCK TABLES `fs_attributes` WRITE;
/*!40000 ALTER TABLE `fs_attributes` DISABLE KEYS */;
INSERT INTO `fs_attributes` VALUES (2,'Size','المقاس',NULL,NULL,'2022-06-03 20:40:35','2022-06-03 20:40:35',NULL);
/*!40000 ALTER TABLE `fs_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_cart`
--

DROP TABLE IF EXISTS `fs_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_cart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_cart`
--

LOCK TABLES `fs_cart` WRITE;
/*!40000 ALTER TABLE `fs_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_categories`
--

DROP TABLE IF EXISTS `fs_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is to store category name.',
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is to store category locale name.',
  `parent_id` bigint unsigned DEFAULT NULL COMMENT 'This column is to store parent category.',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is used to store category image.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_categories_name_unique` (`name`),
  UNIQUE KEY `fs_categories_name_locale_unique` (`name_locale`),
  KEY `fs_categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `fs_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `fs_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_categories`
--

LOCK TABLES `fs_categories` WRITE;
/*!40000 ALTER TABLE `fs_categories` DISABLE KEYS */;
INSERT INTO `fs_categories` VALUES (1,'Abaya','عباية',NULL,'20220815141545.jpeg','2022-04-27 16:40:58','2022-08-15 14:15:45',NULL),(2,'Cake modl','قالب كيك',1,'20220603165625.jpeg','2022-04-27 17:38:47','2022-06-03 16:56:25',NULL),(3,'Arabian Clothing','ازياء عربية',NULL,'20220815142034.jpeg','2022-04-28 11:02:50','2022-08-15 14:20:34',NULL),(4,'JALABIYAS','جلابيات',NULL,'20220815142739.png','2022-06-03 16:51:24','2022-08-15 14:27:39',NULL),(5,'Dresses','الفساتين',NULL,'20220815143158.png','2022-06-03 16:52:31','2022-08-15 14:31:58',NULL),(6,'Dress','فساتين',4,'20220603165736.png','2022-06-03 16:57:36','2022-06-27 20:20:37',NULL),(7,'Sets','اطقم',3,'20220603165903.png','2022-06-03 16:59:03','2022-06-03 16:59:03',NULL),(8,'Woman Shoes','احذية نسائية',4,'20220603170133.png','2022-06-03 17:01:33','2022-06-03 17:01:33',NULL),(9,'Woman T-Shirt','نصف كم نسائي',5,'20220603170312.png','2022-06-03 17:03:12','2022-06-03 17:03:12',NULL),(10,'Cheshno carpets','سجاد بني',1,'20220628202430.png','2022-06-28 20:24:30','2022-06-29 01:32:35',NULL),(11,'Cheshno chandelier','ثريات شيشنو',3,'20220628215359.png','2022-06-28 21:53:59','2022-06-28 22:32:45',NULL),(12,'Royal Chandelier','الثريا الملكية',3,'20220628225739.jpeg','2022-06-28 22:57:40','2022-06-28 22:57:40',NULL),(13,'Offers','عروض',NULL,'20220815143259.png','2022-06-28 23:26:23','2022-08-15 14:32:59',NULL),(14,'Special offers','عروض تشيسنو',13,'20220628232904.png','2022-06-28 23:29:04','2022-06-28 23:29:04',NULL),(15,'Carpet sets','مجموعات السجاد',1,'20220629001050.png','2022-06-29 00:10:50','2022-06-29 00:10:50',NULL),(16,'Outside lights','الأضواء الخارجية',3,'20220629004520.jpg','2022-06-29 00:45:20','2022-06-29 00:45:20',NULL);
/*!40000 ALTER TABLE `fs_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_cities`
--

DROP TABLE IF EXISTS `fs_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_cities` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'This auto increment column to generate unique id.',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column help to store city name.',
  `name_local` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column help to store city forign name.',
  `country_id` tinyint unsigned NOT NULL COMMENT 'This column stores country for the city and references countries table.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_cities_name_country_id_unique` (`name`,`country_id`),
  KEY `fs_cities_country_id_foreign` (`country_id`),
  CONSTRAINT `fs_cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `fs_countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_cities`
--

LOCK TABLES `fs_cities` WRITE;
/*!40000 ALTER TABLE `fs_cities` DISABLE KEYS */;
INSERT INTO `fs_cities` VALUES (1,'Abu Dhabi','ابو ظبي',1,NULL,NULL,NULL),(2,'Dubai','دبي',1,NULL,NULL,NULL),(3,'Sharjah','الشارقة',1,NULL,NULL,NULL),(4,'Al Ain','العين',1,NULL,NULL,NULL),(5,'Ajman','عجمان',1,NULL,NULL,NULL),(6,'Ras Al Khaimah','راس الخيمة',1,NULL,NULL,NULL),(7,'Um Al Quwain','ام القوين',1,NULL,NULL,NULL),(8,'Fujairah','الفجيرة',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_compulsory_choice_entries`
--

DROP TABLE IF EXISTS `fs_compulsory_choice_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_compulsory_choice_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `compulsory_choice_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_compulsory_choice_entries_compulsory_choice_id_foreign` (`compulsory_choice_id`),
  CONSTRAINT `fs_compulsory_choice_entries_compulsory_choice_id_foreign` FOREIGN KEY (`compulsory_choice_id`) REFERENCES `fs_compulsory_choices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_compulsory_choice_entries`
--

LOCK TABLES `fs_compulsory_choice_entries` WRITE;
/*!40000 ALTER TABLE `fs_compulsory_choice_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_compulsory_choice_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_compulsory_choice_item`
--

DROP TABLE IF EXISTS `fs_compulsory_choice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_compulsory_choice_item` (
  `item_id` bigint unsigned NOT NULL,
  `compulsory_choice_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fs_compulsory_choice_item_item_id_foreign` (`item_id`),
  KEY `fs_compulsory_choice_item_compulsory_choice_id_foreign` (`compulsory_choice_id`),
  CONSTRAINT `fs_compulsory_choice_item_compulsory_choice_id_foreign` FOREIGN KEY (`compulsory_choice_id`) REFERENCES `fs_compulsory_choices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fs_compulsory_choice_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_compulsory_choice_item`
--

LOCK TABLES `fs_compulsory_choice_item` WRITE;
/*!40000 ALTER TABLE `fs_compulsory_choice_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_compulsory_choice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_compulsory_choices`
--

DROP TABLE IF EXISTS `fs_compulsory_choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_compulsory_choices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_locale` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_compulsory_choices`
--

LOCK TABLES `fs_compulsory_choices` WRITE;
/*!40000 ALTER TABLE `fs_compulsory_choices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_compulsory_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_content_types`
--

DROP TABLE IF EXISTS `fs_content_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_content_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_content_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_content_types`
--

LOCK TABLES `fs_content_types` WRITE;
/*!40000 ALTER TABLE `fs_content_types` DISABLE KEYS */;
INSERT INTO `fs_content_types` VALUES (1,'offer','2022-05-04 11:06:35','2022-05-04 11:06:35',NULL),(2,'category','2022-05-04 11:06:36','2022-05-04 11:06:36',NULL),(3,'sub category','2022-05-04 11:06:36','2022-05-04 11:06:36',NULL),(4,'The Empire Strikes Back','2022-05-04 11:06:36','2022-05-04 11:06:36',NULL),(5,'item','2022-05-04 11:06:36','2022-05-04 11:06:36',NULL),(6,'store','2022-05-04 11:06:36','2022-05-04 11:06:36',NULL);
/*!40000 ALTER TABLE `fs_content_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_countries`
--

DROP TABLE IF EXISTS `fs_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_countries` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT COMMENT 'This auto increment column to generate unique id.',
  `iso` char(2) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is to store iso (short name) for the country.',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is to store country name.',
  `name_local` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is to store country name.',
  `phone` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is used to store country code.',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This column is used to flag of country.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_countries_iso_name_phone_unique` (`iso`,`name`,`phone`),
  UNIQUE KEY `fs_countries_iso_unique` (`iso`),
  UNIQUE KEY `fs_countries_name_unique` (`name`),
  UNIQUE KEY `fs_countries_name_local_unique` (`name_local`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_countries`
--

LOCK TABLES `fs_countries` WRITE;
/*!40000 ALTER TABLE `fs_countries` DISABLE KEYS */;
INSERT INTO `fs_countries` VALUES (1,'AE','United Arab Emarits','الامارات العربية المتحدة','971','20220416185058.png',NULL,NULL,NULL),(2,'JO','Jordan','المملكة الاردنية الهاشمية','962','20220416185140.png',NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_devices`
--

DROP TABLE IF EXISTS `fs_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_devices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_devices_token_unique` (`token`),
  KEY `fs_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `fs_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `fs_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_devices`
--

LOCK TABLES `fs_devices` WRITE;
/*!40000 ALTER TABLE `fs_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_discount_types`
--

DROP TABLE IF EXISTS `fs_discount_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_discount_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_discount_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_discount_types`
--

LOCK TABLES `fs_discount_types` WRITE;
/*!40000 ALTER TABLE `fs_discount_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_discount_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_failed_jobs`
--

DROP TABLE IF EXISTS `fs_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_failed_jobs`
--

LOCK TABLES `fs_failed_jobs` WRITE;
/*!40000 ALTER TABLE `fs_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_file_types`
--

DROP TABLE IF EXISTS `fs_file_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_file_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_file_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_file_types`
--

LOCK TABLES `fs_file_types` WRITE;
/*!40000 ALTER TABLE `fs_file_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_file_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_files`
--

DROP TABLE IF EXISTS `fs_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_files_type_id_foreign` (`type_id`),
  KEY `fs_files_user_id_foreign` (`user_id`),
  CONSTRAINT `fs_files_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `fs_file_types` (`id`),
  CONSTRAINT `fs_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `fs_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_files`
--

LOCK TABLES `fs_files` WRITE;
/*!40000 ALTER TABLE `fs_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_homes`
--

DROP TABLE IF EXISTS `fs_homes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_homes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `content_type_id` bigint unsigned DEFAULT NULL,
  `sub_category_id` bigint unsigned DEFAULT NULL,
  `item_id` bigint unsigned DEFAULT NULL,
  `offer_id` bigint unsigned DEFAULT NULL,
  `appearance_number` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_homes_category_id_foreign` (`category_id`),
  KEY `fs_homes_content_type_id_foreign` (`content_type_id`),
  KEY `fs_homes_sub_category_id_foreign` (`sub_category_id`),
  KEY `fs_homes_item_id_foreign` (`item_id`),
  CONSTRAINT `fs_homes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `fs_categories` (`id`),
  CONSTRAINT `fs_homes_content_type_id_foreign` FOREIGN KEY (`content_type_id`) REFERENCES `fs_content_types` (`id`),
  CONSTRAINT `fs_homes_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`),
  CONSTRAINT `fs_homes_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `fs_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_homes`
--

LOCK TABLES `fs_homes` WRITE;
/*!40000 ALTER TABLE `fs_homes` DISABLE KEYS */;
INSERT INTO `fs_homes` VALUES (1,NULL,3,12,NULL,NULL,7,NULL,NULL,NULL),(2,NULL,3,15,NULL,NULL,5,NULL,NULL,NULL),(3,NULL,2,NULL,NULL,NULL,4,NULL,NULL,NULL),(5,NULL,3,10,NULL,NULL,7,NULL,NULL,NULL),(6,NULL,3,14,NULL,NULL,8,NULL,NULL,NULL),(7,NULL,3,16,NULL,NULL,5,NULL,NULL,NULL),(8,NULL,3,12,NULL,NULL,7,NULL,NULL,NULL),(9,NULL,5,NULL,93,NULL,6,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fs_homes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_influencer_stores`
--

DROP TABLE IF EXISTS `fs_influencer_stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_influencer_stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `influencer_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_influencer_stores_influencer_id_store_id_unique` (`influencer_id`,`store_id`),
  KEY `fs_influencer_stores_store_id_foreign` (`store_id`),
  CONSTRAINT `fs_influencer_stores_influencer_id_foreign` FOREIGN KEY (`influencer_id`) REFERENCES `fs_users` (`id`),
  CONSTRAINT `fs_influencer_stores_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `fs_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_influencer_stores`
--

LOCK TABLES `fs_influencer_stores` WRITE;
/*!40000 ALTER TABLE `fs_influencer_stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_influencer_stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_item_files`
--

DROP TABLE IF EXISTS `fs_item_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_item_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `file_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_item_files_item_id_file_id_unique` (`item_id`,`file_id`),
  KEY `fs_item_files_file_id_foreign` (`file_id`),
  CONSTRAINT `fs_item_files_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `fs_files` (`id`),
  CONSTRAINT `fs_item_files_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_item_files`
--

LOCK TABLES `fs_item_files` WRITE;
/*!40000 ALTER TABLE `fs_item_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_item_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_item_images`
--

DROP TABLE IF EXISTS `fs_item_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_item_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_item_images_item_id_foreign` (`item_id`),
  CONSTRAINT `fs_item_images_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_item_images`
--

LOCK TABLES `fs_item_images` WRITE;
/*!40000 ALTER TABLE `fs_item_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_item_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_item_multiple_choice`
--

DROP TABLE IF EXISTS `fs_item_multiple_choice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_item_multiple_choice` (
  `item_id` bigint unsigned NOT NULL,
  `multiple_choice_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fs_item_multiple_choice_item_id_foreign` (`item_id`),
  KEY `fs_item_multiple_choice_multiple_choice_id_foreign` (`multiple_choice_id`),
  CONSTRAINT `fs_item_multiple_choice_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fs_item_multiple_choice_multiple_choice_id_foreign` FOREIGN KEY (`multiple_choice_id`) REFERENCES `fs_multiple_choices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_item_multiple_choice`
--

LOCK TABLES `fs_item_multiple_choice` WRITE;
/*!40000 ALTER TABLE `fs_item_multiple_choice` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_item_multiple_choice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_items`
--

DROP TABLE IF EXISTS `fs_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_locale` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `sub_category_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_locale` text COLLATE utf8mb4_unicode_ci,
  `main_screen_image` text COLLATE utf8mb4_unicode_ci,
  `cover_image` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) unsigned DEFAULT NULL,
  `new_price` decimal(8,2) unsigned DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_items_store_id_foreign` (`store_id`),
  KEY `fs_items_sub_category_id_foreign` (`sub_category_id`),
  CONSTRAINT `fs_items_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `fs_stores` (`id`),
  CONSTRAINT `fs_items_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `fs_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_items`
--

LOCK TABLES `fs_items` WRITE;
/*!40000 ALTER TABLE `fs_items` DISABLE KEYS */;
INSERT INTO `fs_items` VALUES (1,'Adidas T Shirt','نصف كم',1,9,'Long description to T shirt','نصف كم نصف كم نصف كم','20220604120634.jpeg','1656360757.jpeg',80.00,69.00,1,'2022-06-04 12:06:34','2022-06-27 20:12:37',NULL),(2,'Eid cake','كيكة العيد',1,2,'Long description to Eid cake','كيكة العيد كيكة العيد كيكة العيد كيكة العيد','20220604123757.png',NULL,120.00,99.00,1,'2022-06-04 12:37:57','2022-06-05 00:52:12',NULL),(3,'Eggs cake','كيكة بيض الحمام',1,2,'Long description to eggs cake','كيكة بيض الحمام كيكة بيض الحمام','20220604182854.jpeg',NULL,70.00,55.00,1,'2022-06-04 18:28:54','2022-06-05 00:52:46',NULL),(4,'Fish cake','كيكة السمكة',1,2,'Long description to fish cake',NULL,'20220604203945.jpeg',NULL,200.00,179.00,1,'2022-06-04 20:39:45','2022-06-04 20:39:45',NULL),(5,'Flower cake','كيكة الورد',1,2,'Long description to flower cake','كيكة الورد كيكة الورد كيكة الورد','20220604204146.jpeg',NULL,150.00,99.00,1,'2022-06-04 20:41:46','2022-06-05 00:53:08',NULL),(6,'Halloween cake','كيكة الهالوين',1,2,'Long description to halloween cake','توصيف بالعربي','20220604204351.jpeg',NULL,90.00,79.00,1,'2022-06-04 20:43:52','2022-06-04 23:41:39',NULL),(7,'Karaz cake','كيك',1,2,'Long description to Karaz cake',NULL,'20220604204617.jpeg',NULL,200.00,189.00,1,'2022-06-04 20:46:17','2022-06-04 20:46:17',NULL),(8,'Love cake','كيكه قلب الحب',1,2,'Long description to love cake',NULL,'20220604204758.jpeg',NULL,200.00,159.00,1,'2022-06-04 20:47:58','2022-06-04 20:47:58',NULL),(9,'M&M Cake','كيكة ايمينيمز',1,2,'M&M Cake Long description',NULL,'20220604204949.jpeg',NULL,250.00,199.00,1,'2022-06-04 20:49:49','2022-06-04 20:49:49',NULL),(10,'Oreo cake','كعكة أوريو',1,2,'Long description to oreo cake',NULL,'20220604210702.jpeg',NULL,140.00,139.00,1,'2022-06-04 20:51:47','2022-06-04 21:07:02',NULL),(11,'WOW Cake','واو كيك',1,2,'WOW Cake eng description test',NULL,'20220604205629.jpeg',NULL,100.00,69.00,1,'2022-06-04 20:56:29','2022-06-04 20:56:29',NULL),(12,'kids cake','كيكة الاطفال',1,2,'Long description to kids cake',NULL,'20220604205807.jpeg',NULL,190.00,170.00,1,'2022-06-04 20:58:07','2022-06-04 20:58:07',NULL),(13,'Adidas Flower','نصف كم',1,9,'Description Adidas Flower',NULL,'20220604210025.jpeg',NULL,230.00,199.00,1,'2022-06-04 21:00:25','2022-06-04 21:00:25',NULL),(14,'Adidas pajamas','بيجامه سوداء',1,7,'Long description to adidas Black pajamas',NULL,'20220604210243.jpeg',NULL,300.00,289.00,1,'2022-06-04 21:02:43','2022-06-04 21:02:43',NULL),(15,'Adidas pajamas','بيجامه سوداء',1,7,'Long description to Adidas pajamas',NULL,'20220604210421.jpeg',NULL,200.00,189.00,1,'2022-06-04 21:04:21','2022-06-04 21:04:21',NULL),(16,'Adidas purple','الحذاء الارجواني',1,8,'Long description to purple adidas',NULL,'20220604210626.jpeg',NULL,200.00,149.00,1,'2022-06-04 21:06:26','2022-06-04 21:06:26',NULL),(17,'Adidas set','طقم اديدس',1,7,'Adidas set description',NULL,'20220604211841.jpeg',NULL,170.00,149.00,1,'2022-06-04 21:18:41','2022-06-04 21:18:41',NULL),(18,'Adidas shoes','حذاء لطيف',1,8,'Long description adidas shoes',NULL,'20220604212040.jpeg',NULL,400.00,349.00,1,'2022-06-04 21:20:40','2022-06-04 21:20:40',NULL),(19,'Blue shoes','بوت اديدس',1,8,'Description Adidas shoes','بوت اديدس بوت اديدس بوت اديدس','20220604212244.png','1654386032.jpeg',200.00,189.00,1,'2022-06-04 21:22:44','2022-06-04 23:40:32',NULL),(20,'Baby Adidas','بيجامه طفل',1,7,'Long description to baby adidas',NULL,'20220604212419.jpeg',NULL,200.00,177.00,1,'2022-06-04 21:24:19','2022-06-04 21:24:19',NULL),(21,'Baby adidas pajamas','بيجامه طفل',1,7,'Long description to baby adidas pajamas',NULL,'20220604212617.jpeg',NULL,120.00,99.00,1,'2022-06-04 21:26:17','2022-06-04 21:26:17',NULL),(22,'Baby green pajamas','بيجامه طفل خضراء',1,7,'Long description to baby green pajamas',NULL,'20220604212758.jpeg',NULL,77.00,39.00,1,'2022-06-04 21:27:58','2022-06-04 21:27:58',NULL),(23,'Basic t shirt','نصف كم',1,9,'Long description to basic t shirt',NULL,'20220604212929.jpeg',NULL,120.00,99.00,1,'2022-06-04 21:29:29','2022-06-04 21:29:29',NULL),(24,'Black and white','حذاء الابيض و والاسود',1,8,'Long description to Black and white',NULL,'20220604213055.jpeg',NULL,700.00,599.00,1,'2022-06-04 21:30:55','2022-06-04 21:30:55',NULL),(25,'Blue nike','نصف كم',1,9,'Long description to blue nike t shirt',NULL,'20220604213515.jpeg',NULL,300.00,240.00,1,'2022-06-04 21:35:15','2022-06-04 21:35:15',NULL),(26,'Blue shoes','الحذاء الازرق',1,8,'Blue shoes description',NULL,'20220604213704.png',NULL,450.00,399.00,1,'2022-06-04 21:37:04','2022-06-04 21:37:04',NULL),(27,'Baby dress','فستان',1,6,'Longe description baby dress',NULL,'20220604214913.png',NULL,290.00,255.00,1,'2022-06-04 21:49:13','2022-06-04 21:49:13',NULL),(28,'Dress 10','فستان رقم ١٠',1,6,'Long description to dress 10',NULL,'20220604215220.png',NULL,200.00,153.00,1,'2022-06-04 21:52:20','2022-06-04 21:52:20',NULL),(29,'Dress 11','فستان سهرة',1,6,'Long description to dress 11',NULL,'20220604215412.jpeg',NULL,300.00,239.00,1,'2022-06-04 21:54:12','2022-06-04 21:54:12',NULL),(30,'Dress 12','فستان الاناقة',1,6,'Long description to dress 12',NULL,'20220604215549.jpeg',NULL,149.00,120.00,1,'2022-06-04 21:55:49','2022-06-04 21:55:49',NULL),(31,'Dress 3','الفستان ٣',1,6,'Dress 3 description',NULL,'20220604215816.jpeg',NULL,400.00,350.00,1,'2022-06-04 21:58:16','2022-06-04 21:58:16',NULL),(32,'Dress 4','الفستان ٤',1,6,'Description dress 4',NULL,'20220604215947.jpeg',NULL,200.00,159.00,1,'2022-06-04 21:59:47','2022-06-04 21:59:47',NULL),(33,'Dress 5','الفستان ٥',1,6,'Description dress 5',NULL,'20220604220124.jpeg',NULL,400.00,350.00,1,'2022-06-04 22:01:24','2022-06-04 22:01:24',NULL),(34,'Dress 6','الفستان ٦',1,6,'Description dress 6',NULL,'20220604220251.png',NULL,700.00,500.00,1,'2022-06-04 22:02:51','2022-06-04 22:02:51',NULL),(35,'Dress 7','الفستان ٧',1,6,'Description dress 7',NULL,'20220604220459.jpeg',NULL,200.00,140.00,1,'2022-06-04 22:04:59','2022-06-04 22:04:59',NULL),(36,'Dress 8','الفستان ٨',1,6,'Dress 8 description',NULL,'20220604220733.jpeg',NULL,400.00,349.00,1,'2022-06-04 22:07:33','2022-06-04 22:07:33',NULL),(37,'Full set 1','الفستان ٩',1,7,'Full set test des 1',NULL,'20220604221615.jpeg',NULL,300.00,259.00,1,'2022-06-04 22:16:15','2022-06-04 22:16:15',NULL),(38,'Full set 2','طكم كامل ٢',1,7,'Full set description 2',NULL,'20220604221840.jpeg',NULL,340.00,319.00,1,'2022-06-04 22:18:40','2022-06-04 22:18:40',NULL),(39,'Full set 3','طكم كامل ٣',1,7,'descriptions set 3 full',NULL,'20220604222021.jpeg',NULL,200.00,159.00,1,'2022-06-04 22:20:21','2022-06-04 22:20:21',NULL),(40,'Full shirt','كم',1,9,'Long description to full shirt',NULL,'20220604222205.jpeg',NULL,320.00,299.00,1,'2022-06-04 22:22:05','2022-06-04 22:22:05',NULL),(41,'GG Adidas','لحذاء لطيف',1,8,'Long description to gg adidas',NULL,'20220604222343.jpeg',NULL,200.00,166.00,1,'2022-06-04 22:23:43','2022-06-04 22:23:43',NULL),(42,'Italy dress','الفستان الايطالي',1,6,'Italy dress  description',NULL,'20220604222519.png',NULL,500.00,399.00,1,'2022-06-04 22:25:19','2022-06-04 22:25:19',NULL),(43,'Lacoste shoes','بوت لاكوست',1,8,'Lacoste shoes description',NULL,'20220604222654.jpeg',NULL,333.00,199.00,1,'2022-06-04 22:26:54','2022-06-04 22:26:54',NULL),(44,'Lacoste t shirt','نصف كم',1,9,'Description t shirt',NULL,'20220604222822.jpeg',NULL,150.00,99.00,1,'2022-06-04 22:28:22','2022-06-04 22:28:22',NULL),(45,'Nice adidas Shoes','حذاء انيق',1,8,'Long description to adidas shoes',NULL,'20220604223012.jpeg',NULL,800.00,760.00,1,'2022-06-04 22:30:12','2022-06-04 22:30:12',NULL),(46,'Nice t shirt','نصف كم',1,9,'Long description to nice t shirt',NULL,'20220604223134.jpeg',NULL,130.00,90.00,1,'2022-06-04 22:31:34','2022-06-04 22:31:34',NULL),(47,'Nike Shoes black','حذاء نايك',1,8,'Long description to Nike Shoes black',NULL,'20220604223300.jpeg',NULL,1200.00,999.00,1,'2022-06-04 22:33:00','2022-06-04 22:33:00',NULL),(48,'Nike pink','الحذاء الزهري',1,8,'Long description to nike pink',NULL,'20220604223434.jpeg',NULL,190.00,99.00,1,'2022-06-04 22:34:34','2022-06-04 22:34:34',NULL),(49,'Nike shoes','بوت نايك',1,8,'Nike shoes Description',NULL,'20220604223606.jpeg',NULL,270.00,220.00,1,'2022-06-04 22:36:06','2022-06-04 22:36:06',NULL),(50,'Nike silver','حذاء نايك السكني',1,8,'Long description to Nike silver',NULL,'20220604223747.jpeg',NULL,1300.00,899.00,1,'2022-06-04 22:37:47','2022-06-04 22:37:47',NULL),(51,'Silver t shirt','نصف كم',1,9,'Long description to Silver t shirt',NULL,'20220604223938.jpeg',NULL,110.00,70.00,1,'2022-06-04 22:39:38','2022-06-04 22:39:38',NULL),(52,'Space t shirt','نصف كم',1,9,'Long description to space t shirt',NULL,'20220604224112.jpeg',NULL,90.00,80.00,1,'2022-06-04 22:41:12','2022-06-04 22:41:12',NULL),(53,'T shirt nike','نص كم نايك',1,9,'Description T shirt nike',NULL,'20220604224300.jpeg',NULL,350.00,199.00,1,'2022-06-04 22:43:00','2022-06-04 22:43:00',NULL),(56,'Haya\'s Closet','هيا كلوزيت',3,10,'Product Description\r\nThis timeless abaya from Haya\'s Closet stays true to the sensibilities of the region while bringing elegance to the design.\r\n\r\n\r\nCut from lightweight fluid fabric\r\nTonal embroidered floral patterns all over\r\nLong sleeves with roll up cuffs\r\nMatching Sheila included\r\nInner dress sold separately','تفاصيل المنتج\r\nعباية بتصميم لا يخرج عن الموضة من هيا كلوزيت تمنحك الاحساس بالانتماء الحقيقي للمنطقة مع إطلالة تتمتع بالأناقة.\r\n\r\n\r\nقطعة مصنوعة من نسيج منسدل خفيف\r\nمزين بتطريز ازهار\r\nاكمام طويلة بأساور مطوية\r\nمع شيلا مماثلة\r\nيباع الفستان الداخلي على حدة','20220815194126.png','1660592486.png',272.00,272.00,1,'2022-06-28 20:30:02','2022-08-15 19:41:26',NULL),(57,'Luxurious carpet','سجاد فاخر',3,10,'The soft, welcoming coloration of this luxurious carpet, the result of nuanced, expertly chosen natural dyes and the inimitable patina of substantial age, imparts a gentle luminosity to every inch of its expansive allover design, enveloping the viewer in harmonious hues that include rose, terracotta, coral, celadon, apple green and French blue. Spaciously arranged blossoms are each individually rendered, yet come together in the highly balanced composition of this valuable carpet.','يضفي اللون الناعم والترحيب لهذه السجادة الفاخرة ، نتيجة الأصباغ الطبيعية الدقيقة المختارة بخبرة واللمعان الذي لا يضاهى من العمر الكبير ، لمعانًا لطيفًا على كل شبر من تصميمها الواسع الشامل ، وتغلف المشاهد بألوان متناغمة تشمل الورد ، الطين ، المرجان ، السيلادون ، التفاح الأخضر والأزرق الفرنسي. يتم تقديم كل زهور مرتبة بشكل واسع بشكل فردي ، ولكنها تتحد معًا في تكوين متوازن للغاية لهذه السجادة القيمة.','20220628204153.png',NULL,7000.00,6499.00,1,'2022-06-28 20:41:53','2022-06-28 20:41:53',NULL),(58,'Cheshno carpets','سجاد شيشنو',3,10,'cheshno, each pattern tells a story; our carpets are a narration of ancient heritage designs. A house is much more than just a place; it is connected spiritually with your emotions; design it with the best products. Select luxury, select Cheshno!','شيشنو ، كل نمط يروي قصة ؛ سجادنا هو سرد للتصاميم التراثية القديمة. المنزل هو أكثر بكثير من مجرد مكان ؛ إنه مرتبط روحانيًا بمشاعرك ؛ تصميمه بأفضل المنتجات. حدد الفخامة ، حدد شيشنو!','20220628205742.png',NULL,12000.00,9999.00,1,'2022-06-28 20:57:42','2022-06-28 20:57:42',NULL),(59,'Cheshno carpets','سجاد شيشنو',3,10,'At cheshno, each pattern tells a story; our carpets are a narration of ancient heritage designs. A house is much more than just a place; it is connected spiritually with your emotions; design it with the best products. Select luxury, select Cheshno!','في شيشنو ، كل نمط يروي قصة ؛ سجادنا هو سرد للتصاميم التراثية القديمة. المنزل هو أكثر بكثير من مجرد مكان ؛ إنه مرتبط روحانيًا بمشاعرك ؛ تصميمه بأفضل المنتجات. حدد الفخامة ، حدد شيشنو!','20220628210103.png',NULL,9800.00,7999.00,1,'2022-06-28 21:01:03','2022-06-28 21:01:03',NULL),(60,'SULTANABAD Persian Carpet!','سجاد سلطان أباد الفارسي!',3,10,'27.4M 170 years old SULTANABAD Persian Carpet! circa 1850\r\nEnchanting and unique SULTANABAD carpet, a deep look at the feelings of persian carpet artists! Who carries secrets and mysteries with him from very distant days! Secrets that require eloquent language!\r\n\r\n447cm x 615cm\r\nCirca 1850\r\n\r\n(Connoisseur-Caliber) Radiating a deep patina, this palace size, profoundly artful carpet with its variously scaled overall pattern graciously offers many softened accent colors on a warm copper background. Its glorious, uplifting palette is uniquely without the traditional contrasting midnight blues, resonating a sunny, welcoming ambiance instead. Exemplifying the singularity of our very large carpets for quintessential home design, this grand 170-year-old piece could be considered for either contemporary or traditional settings.','27.4 م 170 سنة سجادة سلطان أباد الفارسية! حوالي عام 1850\r\nسجادة سلطان أباد الساحرة والفريدة من نوعها ، نظرة عميقة على مشاعر فناني السجاد الفارسي! من يحمل معه الأسرار والألغاز منذ أيام بعيدة! أسرار تتطلب لغة بليغة!\r\n\r\n447 سم × 615 سم\r\nحوالي 1850\r\n\r\n(متذوق من العيار) يشع الزنجار العميق ، حجم القصر هذا ، السجادة الفنية العميقة بنمطها العام المتدرج بشكل متنوع ، تقدم بكرم العديد من الألوان اللطيفة على خلفية نحاسية دافئة. تتميز لوحة ألوانها المجيدة والراقية بشكل فريد من نوعه بدون تباين البلوز التقليدي في منتصف الليل ، مما يضفي صدى بدلاً من ذلك على أجواء مشمسة وترحيبية. تجسيدًا لتفرد سجادنا الكبير جدًا لتصميم المنزل المثالي ، يمكن اعتبار هذه القطعة الكبيرة التي يبلغ عمرها 170 عامًا للإعدادات المعاصرة أو التقليدية.','20220628210548.png',NULL,1000.00,399.00,1,'2022-06-28 21:05:48','2022-06-28 21:24:26',NULL),(61,'FERAHAN SAROUGH','فراهان سروج',2,10,'33 meters,120-130 years old, FERAHAN SAROUGH ⚜️\r\ncharacteristic of the name of persian carpet, beautiful and original. An unattainable treasure!\r\n\r\n457cm x 724cm\r\nCirca 1900\r\n\r\nIncredibly impressive in the magnitude of its dimensions and the majesty of its artistry, this most distinguished antique Ferahan Sarough palace size carpet is an accomplishment that expands the boundaries of art weaving. Burnished golden accents around its inner medallion bring a shimmering, luxurious effect that is seamlessly reaffirmed by the sumptuous array of precious garnet, celadon, coral and exquisite terracotta hues that adorn every part of its bejeweled expanse. Entirely immersive in its experience, its nuanced floral garlands and expressive boughs are subtly amplified by the shimmering patina of time-softened, artisan-dyed wool. Its heavy pile condition ensures the great durability of this antique Persian rug for decades to come.','33 مترًا ، 120-130 عامًا ، فراهان سروج ⚜️\r\nما يميز اسم السجاد الفارسي ، جميل ومبتكر. كنز بعيد المنال!\r\n\r\n457 سم × 724 سم\r\nحوالي عام 1900\r\n\r\nمثيرة للإعجاب بشكل لا يصدق في حجم أبعادها وعظمة فنها ، هذه السجادة الأثرية الأكثر تميزًا في حجم قصر Ferahan Sarough هي إنجاز يوسع حدود فن النسيج. تضفي اللمسات الذهبية المصقولة حول رصيعتها الداخلية تأثيرًا متلألئًا وفاخرًا يتم إعادة تأكيده بسلاسة من خلال المجموعة الفخمة من العقيق الثمين ، والسيلادون ، والشعاب المرجانية وألوان التيراكوتا الرائعة التي تزين كل جزء من امتدادها المرصع بالجواهر. غامرة تمامًا في تجربتها ، يتم تضخيم أكاليل الزهور الدقيقة والأغصان المعبرة بمهارة من خلال الزنجار المتلألئ للصوف المصبوغ يدويًا المرن بمرور الوقت. تضمن حالة الوبر الثقيل المتانة الكبيرة لهذه السجادة الفارسية العتيقة لعقود قادمة.','20220628211816.png',NULL,1500.00,999.00,1,'2022-06-28 21:18:16','2022-06-28 21:18:16',NULL),(62,'Cheshno luxury and class.','شيشنو الفخامة والراقية.',3,10,'The components of an intricate design depict the idea behind the spectacular interiors. Cheshno speaks for luxury and class.','تصور مكونات التصميم المعقد الفكرة الكامنة وراء التصميمات الداخلية المذهلة. تشيشنو يتحدث عن الفخامة والرقي.','20220628212945.png',NULL,9800.00,6799.00,1,'2022-06-28 21:23:25','2022-06-28 21:29:45',NULL),(63,'Stunning lights','أضواء مذهلة',3,11,'Let all the stunning lights from Cheshno flourish your home in the best way possible.','دع كل الأضواء المذهلة من Cheshno تزدهر منزلك بأفضل طريقة ممكنة.','20220628215826.png',NULL,299.00,199.00,1,'2022-06-28 21:58:26','2022-06-28 21:58:26',NULL),(64,'Cheshno stunning lights','أضواء شيشنو مذهلة',3,11,'Let all the stunning lights from Cheshno flourish your home in the best way possible.','دع كل الأضواء المذهلة من شيشنو تزدهر منزلك بأفضل طريقة ممكنة.','20220628220337.png',NULL,190.00,99.00,1,'2022-06-28 22:03:37','2022-06-28 22:03:37',NULL),(65,'Stunning lights','أضواء مذهلة',3,11,'Let all the stunning lights from Cheshno flourish your home in the best way possible.','دع كل الأضواء المذهلة من Cheshno تزدهر منزلك بأفضل طريقة ممكنة.','20220628220828.png',NULL,500.00,399.00,1,'2022-06-28 22:08:28','2022-06-28 22:08:28',NULL),(66,'Stunning lights','أضواء مذهلة',3,11,'Chandeliers are the sensations of ravishing flamboyance, the gemstones of architecture, and at Cheshno, we know how to create those masterworks.','الثريات هي أحاسيس التألق الساحر ، والأحجار الكريمة للهندسة المعمارية ، وفي شيشنو ، نحن نعرف كيفية إنشاء تلك الأعمال الفنية.','20220628221228.png',NULL,800.00,699.00,1,'2022-06-28 22:12:28','2022-06-28 22:13:08',NULL),(67,'Cheshno  stunning lights','شيشنو أضواء مذهلة',3,11,'Chandeliers are the sensations of ravishing flamboyance, the gemstones of architecture, and at Cheshno, we know how to create those masterworks.','الثريات هي أحاسيس التألق الساحر ، والأحجار الكريمة للهندسة المعمارية ، وفي شيشنو ، نحن نعرف كيفية إنشاء تلك الأعمال الفنية.','20220628221648.png',NULL,800.00,580.00,1,'2022-06-28 22:16:48','2022-06-28 22:16:48',NULL),(68,'Cheshno premium chandeliers','ثريات شيشنو الفاخرة',3,11,'The design of your space is defined by the choice of lighting you pick for your environment. Make sure you decorate it with Cheshno premium chandeliers.','يتم تحديد تصميم مساحتك من خلال اختيار الإضاءة التي تختارها لبيئتك. تأكد من تزيينها بثريات شيشنو الفاخرة.','20220628222131.png',NULL,4500.00,3999.00,1,'2022-06-28 22:21:31','2022-06-28 22:21:31',NULL),(69,'Cheshno premium chandeliers','ثريات شيشنو الفاخرة',3,11,'A beautifully decorated home is a treasure to carry forward in your life; adorn it with the luxury of Cheshno carpets and chandeliers.','المنزل المزين بشكل جميل هو كنز للمضي قدمًا في حياتك ؛ زينها بفخامة سجاد وثريات شيشنو.','20220628222647.png',NULL,1200.00,999.00,1,'2022-06-28 22:26:47','2022-06-28 22:26:47',NULL),(70,'Cheshno premium chandeliers','ثريات شيشنو الفاخرة',3,11,'Beneath all the designs we create at Cheshno lies the substantial sentiment that magnificence is buoyant energy. Our chandeliers and carpets portray the best you can imagine for your home design to be.','تحت كل التصاميم التي أنشأناها في شيشنو يكمن الشعور الأساسي بأن الروعة هي طاقة طافية. الثريات والسجاد لدينا تصور أفضل ما يمكن أن تتخيله لتصميم منزلك.','20220628223035.png',NULL,8000.00,4999.00,1,'2022-06-28 22:30:35','2022-06-28 22:30:35',NULL),(71,'Cheshno Royal Chandelier','ثريا تشيشنو الملكية',3,12,'For you, exceptional offers on new designs\r\nDiscounts from 50% to 90%\r\nDon\'t miss this opportunity, only for 10 days\r\n\r\nChechno, an enchanting world of colors and shapes for carpets and chandeliers\r\nWe have more than ten thousand chandeliers hanging under one roof with a million square meters of luxurious and elegant carpets in various sizes, shapes and colors\r\n\r\nChechno includes enough exquisite designs to add luxury and luxury to your home','من أجلكم عروض استثنائية على التصاميم الجديدة\r\nخصومات من ٥٠٪؜ لغاية ٩٠٪؜\r\nلا تفوتوا الفرصة فقط لمدة ١٠ ايام\r\n\r\nچشنو عالم ساحر من الألوان و الأشكال للسجاد و الثريات\r\nلدينا أكثر من عشرة آلاف ثريات معلقة تحت سقف واحد مع مليون متر مربع سجاد فاخر و أنيق بأحجام و أشكال و ألوان متنوعة\r\n\r\n‎تضم چشنو تصاميم رائعة كافية لإضافة الترف و الفخامة لمنزلك','20220628230214.png',NULL,4000.00,2499.00,1,'2022-06-28 23:02:14','2022-06-28 23:02:14',NULL),(72,'Empire chandelier','الثريا الإمبراطورية',3,12,'Empire chandeliers are iconic pieces that reminisce our lineage and glow a light on trendy tones. Cheshno chandeliers fraternize with luxurious carpet collections to form a soothing view.','إمبراطورية\r\nالثريات هي قطع أيقونية تذكر بنسبنا وتضيء بدرجات ألوان عصرية. تتآزر ثريات شيشينو مع مجموعات السجاد الفاخرة لتشكل منظرًا مريحًا.','20220628230749.png',NULL,9000.00,6999.00,1,'2022-06-28 23:07:49','2022-06-28 23:07:49',NULL),(73,'Royal Cheshenu chandeliers','ثريات رويال شيشينو',3,12,'Exceptional offers on new designs\r\nDiscounts from 50% to 90%\r\nDon\'t miss this opportunity, only for 10 days\r\n\r\nCheshenu is an enchanting world of colors and 2.1.0 rugs and chandeliers\r\nWe have more than five thousand three ideas, theories, assorted colors, assorted colors, assorted colors\r\n\r\nChichnu includes wonderful designs to add luxury and luxury to your home','ن أجلكم عروض استثنائية على التصاميم الجديدة\r\nخصومات من ٥٠٪؜ لغاية ٩٠٪؜\r\nلا تفوتوا الفرصة فقط لمدة ١٠ ايام\r\n\r\nچشنو عالم ساحر من الألوان و الأشكال للسجاد و الثريات\r\nلدينا أكثر من عشرة آلاف ثريات معلقة تحت سقف واحد مع مليون متر مربع سجاد فاخر و أنيق بأحجام و أشكال و ألوان متنوعة\r\n\r\n‎تضم چشنو تصاميم رائعة كافية لإضافة الترف و الفخامة لمنزلك\r\n\r\n‎‏','20220628231141.png',NULL,4500.00,3999.00,1,'2022-06-28 23:11:41','2022-06-28 23:11:41',NULL),(74,'Crystal chandelier','الثريا الكريستال',3,12,'Crown collection ensures a supreme illustration like a full-figured chandelier boasting a mastery of pure crystal pendants. \r\nThe embellished design bears a process that confers its specific illumination, further heightened by the light emitting from the bulbs and sifting through the trinkets, which are prepared in a flaring cascade shape. With its pure sparkle and graceful traditional form, the royal Chandelier hangs from a gleaming gold finish frame that amplifies the shine of its pure crystals and adds glam to light.','تضمن مجموعة Crown توضيحًا رائعًا مثل ثريا كاملة الشكل تتميز بإتقان المعلقات الكريستالية النقية.\r\nيحمل التصميم المزخرف عملية تضفي إضاءة خاصة به ، ويزيد من حدته الضوء المنبعث من المصابيح وغربلة الحلي التي يتم تحضيرها في شكل سلسلة متوهجة. تتدلى الثريا الملكية ، بتألقها النقي وشكلها التقليدي الرشيق ، من إطار ذهبي لامع يضخم لمعان بلوراتها النقية ويضفي بريقًا على الضوء.','20220628231622.png',NULL,3000.00,1999.00,1,'2022-06-28 23:16:22','2022-06-28 23:16:22',NULL),(75,'Majesty chandelier','نجفة الجلالة',3,12,'A precious legacy comes alive in this collection of Majesty chandeliers in various dimensions that reflect the traditional passion for luxury and intricate handmade techniques.','يأتي إرث ثمين على قيد الحياة في هذه المجموعة من ثريات ماجيستي بأبعاد مختلفة تعكس الشغف التقليدي بالفخامة والتقنيات اليدوية المعقدة.','20220628232334.png',NULL,8000.00,4999.00,1,'2022-06-28 23:21:57','2022-06-28 23:23:34',NULL),(76,'crystal chandeliers','ثريت الكرستال',3,14,'‎يبدأ الآن العد التنازلي للخصومات من %50 الى %90 لدى چشنو فباقي للعرض 2 يومان فقط! لا يفوتكم','Time is running out! Cheshno’s \"Mega Sale\" ends in 2 days only!\r\nThis is your last chance to save 50% to 90% on our premium carpets and chandeliers, grab it before it’s gone!','20220628235851.png',NULL,4000.00,400.00,1,'2022-06-28 23:34:46','2022-06-28 23:58:51',NULL),(77,'Mega Sale','چشنو للخصومات',3,14,'بدأ الآن العد التنازلي للخصومات من %50 الى %90 لدى چشنو فباقي للعرض 3 أيام فقط! لا يفوتكم','Time is running out! Cheshno’s \"Mega Sale\" ends in 3 days only!\r\nThis is your last chance to save 50% to 90% on our premium carpets and chandeliers, grab it before it’s gone!','20220628234932.png',NULL,7000.00,3500.00,1,'2022-06-28 23:37:28','2022-06-28 23:49:32',NULL),(78,'Until Eid al-Adha','حتى عيد الأضحى',3,14,'Until Eid al-Adha, he bought directly from the factory from Chechno, the largest carpet distributor in the world\r\n\r\nOpportunity, Fantastic Discounts, Carpets\r\n\r\nCheshenu is an enchanting world of colors and 2.1.0 sounds for carpets\r\nMore than a million square meters of luxurious and elegant carpets in various sizes, shapes and colors\r\n\r\nThe offer is valid until Eid Al-Adha','حتى عيد الأضحى اشترى من المصنع مباشرة من چشنو اكبر موزع للسجاد في العالم\r\n\r\nالفرصة خصومات خصومات خيالية السجاد؜؜؜؜؜؜ ؜؜؜؜؜؜؜؜؜؜؜\r\n\r\nچشنو عالم ساحر من الألوان و 2.1.0 صوت للصجاد\r\nأكثر من مليون متر مربع سجاد فاخر و أنيق بأحجام و أشكال و ألوان متنوعة\r\n\r\nالعرض ساري حتى عيد الاضحى','20220628235638.png',NULL,5000.00,2000.00,1,'2022-06-28 23:56:38','2022-06-28 23:56:38',NULL),(79,'Carpet sets','مجموعات السجاد',3,15,'Carpets available in all sizes and colors:\r\n\r\n1.5 x 2.5 M\r\n2 x 3 M\r\n2.3 x 3.5 M\r\n3 x 4 M\r\n3 x 5 M\r\n4 x 5 M\r\n4 x 6 M\r\n5 x 8 M\r\n6 x 10 M\r\n10 x 15 M\r\n12 X 24 M','السجاد متوفر بجميع المقاسات والألوان:\r\n\r\n1.5 × 2.5 م\r\n2 × 3 م\r\n2.3 × 3.5 م\r\n3 × 4 م\r\n3 × 5 م\r\n4 × 5 م\r\n4 × 6 م\r\n5 × 8 م\r\n6 × 10 م\r\n10 × 15 م\r\n12 × 24 م','20220629001355.png',NULL,17000.00,12999.00,1,'2022-06-29 00:13:55','2022-06-29 00:13:55',NULL),(80,'Carpet sets','مجموعات السجاد',3,15,'Innovation is in every product that we present, and our designs improve people\'s lives by helping them create incredible places with our outstanding carpets.\r\n\r\nCarpets available in all sizes and colors:\r\n\r\n1.5 x 2.5 M\r\n2 x 3 M\r\n2.3 x 3.5 M\r\n3 x 4 M\r\n3 x 5 M\r\n4 x 5 M\r\n4 x 6 M\r\n5 x 8 M\r\n6 x 10 M\r\n10 x 15 M\r\n12 X 24 M','الابتكار موجود في كل منتج نقدمه ، وتصميماتنا تعمل على تحسين حياة الناس من خلال مساعدتهم على إنشاء أماكن رائعة باستخدام سجادنا المتميز.\r\n\r\nالسجاد متوفر بجميع المقاسات والألوان:\r\n\r\n1.5 × 2.5 م\r\n2 × 3 م\r\n2.3 × 3.5 م\r\n3 × 4 م\r\n3 × 5 م\r\n4 × 5 م\r\n4 × 6 م\r\n5 × 8 م\r\n6 × 10 م\r\n10 × 15 م\r\n12 × 24 م','20220629001722.png',NULL,8900.00,6499.00,1,'2022-06-29 00:17:22','2022-06-29 00:17:22',NULL),(81,'Carpet sets','مجموعات السجاد',3,15,'A house is much more than just a place; it is connected spiritually with your emotions; design it with the best products. Select luxury, select \r\nCheshno!','المنزل هو أكثر بكثير من مجرد مكان ؛ إنه مرتبط روحانيًا بمشاعرك ؛ تصميمه بأفضل المنتجات. اختر الفخامة ، اختر\r\nشيشنو!','20220629001919.png',NULL,3400.00,2999.00,1,'2022-06-29 00:19:19','2022-06-29 00:19:19',NULL),(82,'Carpet luxury sets','أطقم سجاد فاخرة',3,15,'A house is much more than just a place; it is connected spiritually with your emotions; design it with the best products. Select luxury, select \r\nCheshno!','المنزل هو أكثر بكثير من مجرد مكان ؛ إنه مرتبط روحانيًا بمشاعرك ؛ تصميمه بأفضل المنتجات. اختر الفخامة ، اختر\r\nشيشنو!','20220629002238.png',NULL,6000.00,3999.00,1,'2022-06-29 00:22:38','2022-06-29 00:22:38',NULL),(83,'Carpet luxury sets','أطقم سجاد فاخرة',3,15,'Innovation is in every product that we present, and our designs improve people\'s lives by helping them create incredible places with our outstanding carpets.','الابتكار موجود في كل منتج نقدمه ، وتصميماتنا تعمل على تحسين حياة الناس من خلال مساعدتهم على إنشاء أماكن رائعة باستخدام سجادنا المتميز.','20220629002737.png',NULL,1900.00,999.00,1,'2022-06-29 00:27:37','2022-06-29 00:27:37',NULL),(84,'Carpet luxury sets','أطقم سجاد فاخرة',3,15,'At cheshno, each pattern tells a story; our carpets are a narration of ancient heritage designs, and our chandeliers are extraordinary art of the talented artisans.','في شيشنو ، كل نمط يروي قصة ؛ سجادنا هو سرد للتصاميم التراثية القديمة ، والثريات لدينا هي فن غير عادي للحرفيين الموهوبين.','20220629002959.png',NULL,7000.00,3999.00,1,'2022-06-29 00:29:59','2022-06-29 00:29:59',NULL),(85,'Class sets','مجموعات كلاس',3,15,'The components of an intricate design depict the idea behind the spectacular interiors. Cheshno speaks for luxury and class. .','تصور مكونات التصميم المعقد الفكرة الكامنة وراء التصميمات الداخلية المذهلة. تشيشنو يتحدث عن الفخامة والرقي. .','20220629003357.png',NULL,9000.00,6999.00,1,'2022-06-29 00:33:57','2022-06-29 00:33:57',NULL),(86,'Outlandish chandeliers','ثريات غريبة',3,11,'To create outlandish decor aesthetics, any designer requires a stunning combination of chandeliers and carpets in one place. At Cheshno, we ensure designers have adequate possibilities to illustrate a masterpiece.','لإنشاء جماليات ديكور غريبة ، يحتاج أي مصمم إلى مزيج مذهل من الثريات والسجاد في مكان واحد. في تشيسنو ، نضمن أن المصممين لديهم الإمكانيات الكافية لتوضيح تحفة فنية.','20220629003646.png',NULL,700.00,499.00,1,'2022-06-29 00:36:46','2022-06-29 00:36:46',NULL),(87,'Polar lighting','الإضاءة القطبية',3,16,'The Polar collection of modern outdoor lighting comprises high quality and stylish design in its details. The Polar would elegantly reflect light around any outdoor area, creating a chic atmosphere. The rich effects of Polar showcase the clear lighting display on both the up and down of the fixture.','تتميز مجموعة Polar للإضاءة الخارجية الحديثة بجودة عالية وتصميم أنيق في تفاصيلها. سيعكس Polar الضوء بأناقة حول أي منطقة خارجية ، مما يخلق جوًا أنيقًا. تعرض التأثيرات الغنية لـ Polar شاشة الإضاءة الواضحة على كل من الجزء العلوي والسفلي من التركيب.','20220629004744.png',NULL,200.00,149.00,1,'2022-06-29 00:47:44','2022-06-29 00:47:44',NULL),(88,'Polar lighting','الإضاءة القطبية',3,16,'Polar is specially developed to improve and guarantee to beautify all your outdoor spaces. The polar collection of outdoor lights is efficient, waterproof, and highly potent. In addition, it is developed to withstand the most challenging weather and bring a sophisticated and extravagant touch to all outdoor environments.','تم تطوير Polar خصيصًا لتحسين وضمان تجميل جميع مساحاتك الخارجية. تعتبر المجموعة القطبية من المصابيح الخارجية فعالة ومقاومة للماء وفعالة للغاية. بالإضافة إلى ذلك ، تم تطويره لتحمل أصعب الأحوال الجوية وإضفاء لمسة متطورة وفخمة على جميع البيئات الخارجية.','20220629004924.png',NULL,150.00,99.00,1,'2022-06-29 00:49:24','2022-06-29 00:52:20',NULL),(89,'Cheshno lighting','إضاءة تشيشنو',3,16,'High quality, rich and modern design, cheshno brings remarkable outdoor lighting solutions in the form of Polar and Aventador outdoor collections.','جودة عالية وتصميم غني وحديث ، تقدم cheshno حلول إضاءة خارجية رائعة في شكل مجموعات Polar و Aventador في الهواء الطلق.','20220629005502.png',NULL,300.00,190.00,1,'2022-06-29 00:55:02','2022-06-29 00:55:02',NULL),(90,'Cheshno lighting','إضاءة تشيشنو',3,16,'Modern outdoors in premium class and luxury are now achievable as Cheshno had brought innovation and class by Polar and Aventador Outdoor collections.','يمكن الآن تحقيق الأماكن الخارجية الحديثة من الدرجة الممتازة والرفاهية حيث جلبت تشيسنو الابتكار والرفاهية من خلال مجموعات Polar و Aventador Outdoor.','20220629005936.png',NULL,300.00,149.00,1,'2022-06-29 00:59:36','2022-06-29 00:59:36',NULL),(91,'COVO lighting','إضاءة  كوفو',3,16,'The elaborate details in the COVO Collection construct comforting impressions on connecting wall surfaces and walkways. Providing years of dependable performance and resistance to the elements, COVO draws attention to how it softens and diffuses the light.','التفاصيل الدقيقة في مجموعة COVO تبني انطباعات مريحة على أسطح الجدران والممرات المتصلة. من خلال توفير سنوات من الأداء الموثوق به ومقاومة العناصر ، تلفت COVO الانتباه إلى كيفية تليين الضوء ونشره.','20220629010334.png',NULL,120.00,99.00,1,'2022-06-29 01:03:34','2022-06-29 01:03:34',NULL),(92,'COVO lighting','إضاءة كوفو',3,16,'A more attractive outdoor light fitting you would adore to have. Modern and sleek and superbly made. It is a staggering light that will make a striking statement at the entry to your home.','إضاءة خارجية أكثر جاذبية ستحبها. حديثة وأنيقة ومصنوعة بشكل رائع. إنه ضوء مذهل سيصدر بيانًا مذهلاً عند مدخل منزلك.','20220629010646.png',NULL,120.00,99.00,1,'2022-06-29 01:06:46','2022-06-29 01:06:46',NULL),(93,'Special cheshno  carpet','سجادة شيشنو الخاصة',3,10,'A beautifully decorated home is a treasure to carry forward in your life; adorn it with the luxury of Cheshno carpets. At cheshno, each pattern tells a story; our carpets are a narration of ancient heritage designs.\r\n\r\nCarpets are available in all sizes and colors:\r\n\r\n1.5 x 2.5 M\r\n2 x 3 M\r\n2.3 x 3.5 M\r\n3 x 4 M\r\n3 x 5 M\r\n4 x 5 M\r\n4 x 6 M\r\n5 x 8 M\r\n6 x 10 M\r\n10 x 15 M\r\n12 X 24 M','المنزل المزين بشكل جميل هو كنز للمضي قدمًا في حياتك ؛ زينها بفخامة سجاد شيشنو. في تشيسنو ، كل نمط يروي قصة ؛ سجادنا هو سرد للتصاميم التراثية القديمة.\r\n\r\nالسجاد متوفر بجميع المقاسات والألوان:\r\n\r\n1.5 × 2.5 م\r\n2 × 3 م\r\n2.3 × 3.5 م\r\n3 × 4 م\r\n3 × 5 م\r\n4 × 5 م\r\n4 × 6 م\r\n5 × 8 م\r\n6 × 10 م\r\n10 × 15 م\r\n12 × 24 م','20220629013541.png','1656466923.png',7000.00,3999.00,1,'2022-06-29 01:35:41','2022-06-29 01:42:03',NULL);
/*!40000 ALTER TABLE `fs_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_languages`
--

DROP TABLE IF EXISTS `fs_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `short_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_languages_short_code_name_unique` (`short_code`,`name`),
  UNIQUE KEY `fs_languages_short_code_unique` (`short_code`),
  UNIQUE KEY `fs_languages_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_languages`
--

LOCK TABLES `fs_languages` WRITE;
/*!40000 ALTER TABLE `fs_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_migrations`
--

DROP TABLE IF EXISTS `fs_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_migrations`
--

LOCK TABLES `fs_migrations` WRITE;
/*!40000 ALTER TABLE `fs_migrations` DISABLE KEYS */;
INSERT INTO `fs_migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2021_11_03_125621_countries',1),(5,'2021_11_03_125622_states',1),(6,'2021_11_03_125623_cities',1),(7,'2021_11_03_125721_languages',1),(8,'2021_11_03_125722_user_types',1),(9,'2021_11_03_125741_users',1),(10,'2021_11_03_131323_influencer_stores',1),(12,'2021_11_03_131903_categories',1),(13,'2021_11_03_132524_devices',1),(14,'2021_11_03_133217_discount_types',1),(15,'2021_11_03_133432_status_types',1),(16,'2021_11_03_133522_status',1),(17,'2021_11_03_134710_promotions',1),(18,'2021_11_06_061030_file_types',1),(19,'2021_11_06_061031_files',1),(20,'2021_11_06_061032_attribute_types',1),(21,'2021_11_06_061033_items',1),(22,'2021_11_06_061034_item_files',1),(23,'2021_11_07_094427_attributes',1),(24,'2021_11_07_105256_attribute_files',1),(25,'2021_11_08_082051_payment_platforms',1),(26,'2021_11_08_082102_payment_methods',1),(27,'2021_11_08_082609_transactions',1),(28,'2021_11_08_083435_orders',1),(29,'2021_11_08_084256_order_items',1),(30,'2021_11_21_084454_create_cart_table',1),(31,'2021_11_23_133426_create_areas_table',1),(32,'2022_04_23_104725_create_categories_table',2),(33,'2022_05_01_130823_create_content_types_table',3),(34,'2021_11_03_131902_appearances',4),(35,'2022_05_04_142124_create_home_table',5),(36,'2022_05_11_094459_create_stores_table',6),(37,'2022_05_11_105906_create_store_area_table',7),(38,'2022_05_29_123513_create_attributes_table',8),(39,'2021_11_06_06103312_items',9),(40,'2022_05_16_105919_create_item_images_table',10),(41,'2022_05_30_122023_create_attribute_entries_table',11),(42,'2022_05_30_124957_create_compulsory_choices_table',11),(43,'2022_05_30_125504_create_compulsory_choice_entries_table',11),(44,'2022_05_30_130410_create_attribute_item_table',11),(45,'2022_05_31_002522_create_compulsory_choice_item_table',11),(46,'2022_05_31_003128_create_multiple_choices_table',11),(47,'2022_05_31_003328_create_multiple_choice_entries_table',11),(48,'2022_05_31_00351745_create_multiple_choice_item_table',12),(49,'2022_06_11_214606_create_orders_table',13),(50,'2022_06_11_215908_create_order_items_table',14);
/*!40000 ALTER TABLE `fs_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_multiple_choice_entries`
--

DROP TABLE IF EXISTS `fs_multiple_choice_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_multiple_choice_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `multiple_choice_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_multiple_choice_entries_multiple_choice_id_foreign` (`multiple_choice_id`),
  CONSTRAINT `fs_multiple_choice_entries_multiple_choice_id_foreign` FOREIGN KEY (`multiple_choice_id`) REFERENCES `fs_multiple_choices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_multiple_choice_entries`
--

LOCK TABLES `fs_multiple_choice_entries` WRITE;
/*!40000 ALTER TABLE `fs_multiple_choice_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_multiple_choice_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_multiple_choices`
--

DROP TABLE IF EXISTS `fs_multiple_choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_multiple_choices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_locale` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_multiple_choices`
--

LOCK TABLES `fs_multiple_choices` WRITE;
/*!40000 ALTER TABLE `fs_multiple_choices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_multiple_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_order_items`
--

DROP TABLE IF EXISTS `fs_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `unit_price` decimal(14,2) unsigned NOT NULL,
  `quantity` decimal(8,2) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_order_items_order_id_index` (`order_id`),
  KEY `fs_order_items_item_id_index` (`item_id`),
  CONSTRAINT `fs_order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `fs_items` (`id`),
  CONSTRAINT `fs_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `fs_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_order_items`
--

LOCK TABLES `fs_order_items` WRITE;
/*!40000 ALTER TABLE `fs_order_items` DISABLE KEYS */;
INSERT INTO `fs_order_items` VALUES (1,1,2,5.00,3.00,NULL,'2022-06-14 10:55:02','2022-06-14 10:55:02'),(2,1,6,5.00,3.00,NULL,'2022-06-14 10:55:02','2022-06-14 10:55:02'),(3,1,3,5.00,3.00,NULL,'2022-06-14 10:55:02','2022-06-14 10:55:02'),(4,2,2,5.00,3.00,NULL,'2022-06-14 11:09:38','2022-06-14 11:09:38'),(5,2,6,5.00,3.00,NULL,'2022-06-14 11:09:38','2022-06-14 11:09:38'),(6,2,3,5.00,3.00,NULL,'2022-06-14 11:09:38','2022-06-14 11:09:38'),(7,3,2,5.00,3.00,NULL,'2022-06-14 11:37:23','2022-06-14 11:37:23'),(8,3,6,5.00,3.00,NULL,'2022-06-14 11:37:23','2022-06-14 11:37:23'),(9,3,3,5.00,3.00,NULL,'2022-06-14 11:37:23','2022-06-14 11:37:23'),(10,4,2,5.00,3.00,NULL,'2022-06-14 11:37:35','2022-06-14 11:37:35'),(11,4,6,5.00,3.00,NULL,'2022-06-14 11:37:35','2022-06-14 11:37:35'),(12,4,3,5.00,3.00,NULL,'2022-06-14 11:37:35','2022-06-14 11:37:35'),(13,5,2,5.00,3.00,NULL,'2022-06-14 11:52:25','2022-06-14 11:52:25'),(14,5,2,5.00,3.00,NULL,'2022-06-14 11:52:25','2022-06-14 11:52:25'),(15,5,2,5.00,3.00,NULL,'2022-06-14 11:52:25','2022-06-14 11:52:25'),(16,6,2,5.00,3.00,NULL,'2022-06-14 11:52:36','2022-06-14 11:52:36'),(17,6,2,5.00,3.00,NULL,'2022-06-14 11:52:36','2022-06-14 11:52:36'),(18,6,2,5.00,3.00,NULL,'2022-06-14 11:52:36','2022-06-14 11:52:36'),(19,8,2,5.00,3.00,NULL,'2022-06-16 15:02:08','2022-06-16 15:02:08'),(20,8,2,5.00,3.00,NULL,'2022-06-16 15:02:08','2022-06-16 15:02:08'),(21,8,2,5.00,3.00,NULL,'2022-06-16 15:02:08','2022-06-16 15:02:08'),(22,24,14,289.00,14.00,NULL,'2022-06-16 17:52:55','2022-06-16 17:52:55'),(23,24,2,99.00,2.00,NULL,'2022-06-16 17:52:55','2022-06-16 17:52:55'),(24,25,14,289.00,14.00,NULL,'2022-06-16 19:33:45','2022-06-16 19:33:45'),(25,25,2,99.00,2.00,NULL,'2022-06-16 19:33:45','2022-06-16 19:33:45'),(26,26,14,289.00,14.00,NULL,'2022-06-16 20:17:49','2022-06-16 20:17:49'),(27,26,2,99.00,2.00,NULL,'2022-06-16 20:17:49','2022-06-16 20:17:49'),(28,27,14,289.00,14.00,NULL,'2022-06-16 20:18:15','2022-06-16 20:18:15'),(29,27,2,99.00,2.00,NULL,'2022-06-16 20:18:15','2022-06-16 20:18:15'),(30,28,3,55.00,3.00,NULL,'2022-06-16 22:44:04','2022-06-16 22:44:04'),(31,28,27,255.00,27.00,NULL,'2022-06-16 22:44:04','2022-06-16 22:44:04'),(32,29,2,99.00,2.00,NULL,'2022-06-17 00:10:53','2022-06-17 00:10:53'),(33,29,14,289.00,14.00,NULL,'2022-06-17 00:10:53','2022-06-17 00:10:53'),(34,30,1,69.00,1.00,NULL,'2022-06-17 00:14:26','2022-06-17 00:14:26'),(35,30,13,199.00,13.00,NULL,'2022-06-17 00:14:26','2022-06-17 00:14:26'),(36,31,29,239.00,29.00,NULL,'2022-06-17 00:20:23','2022-06-17 00:20:23'),(37,31,5,99.00,5.00,NULL,'2022-06-17 00:20:23','2022-06-17 00:20:23'),(38,32,3,55.00,3.00,NULL,'2022-06-17 00:23:49','2022-06-17 00:23:49'),(39,32,2,99.00,2.00,NULL,'2022-06-17 00:23:49','2022-06-17 00:23:49'),(40,33,14,289.00,14.00,NULL,'2022-06-17 15:10:14','2022-06-17 15:10:14'),(41,34,4,179.00,4.00,NULL,'2022-06-17 15:48:58','2022-06-17 15:48:58'),(42,35,14,289.00,14.00,NULL,'2022-06-17 16:07:28','2022-06-17 16:07:28'),(43,36,2,99.00,2.00,NULL,'2022-06-17 16:09:45','2022-06-17 16:09:45'),(44,37,21,99.00,21.00,NULL,'2022-06-17 16:13:56','2022-06-17 16:13:56'),(45,37,22,39.00,22.00,NULL,'2022-06-17 16:13:56','2022-06-17 16:13:56'),(46,38,37,259.00,37.00,NULL,'2022-06-17 16:24:33','2022-06-17 16:24:33'),(47,38,38,319.00,38.00,NULL,'2022-06-17 16:24:33','2022-06-17 16:24:33'),(48,39,2,99.00,1.00,NULL,'2022-06-18 11:59:47','2022-06-18 11:59:47'),(49,39,14,289.00,1.00,NULL,'2022-06-18 11:59:47','2022-06-18 11:59:47'),(50,40,5,99.00,1.00,NULL,'2022-06-18 12:25:06','2022-06-18 12:25:06'),(51,40,6,79.00,1.00,NULL,'2022-06-18 12:25:06','2022-06-18 12:25:06'),(52,41,4,179.00,1.00,NULL,'2022-06-18 13:16:49','2022-06-18 13:16:49'),(53,42,2,99.00,2.00,NULL,'2022-06-18 13:44:03','2022-06-18 13:44:03'),(54,42,3,55.00,4.00,NULL,'2022-06-18 13:44:03','2022-06-18 13:44:03'),(55,42,6,79.00,1.00,NULL,'2022-06-18 13:44:03','2022-06-18 13:44:03'),(56,43,2,99.00,1.00,NULL,'2022-06-18 17:04:30','2022-06-18 17:04:30'),(57,43,1,69.00,2.00,NULL,'2022-06-18 17:04:30','2022-06-18 17:04:30'),(58,44,1,69.00,1.00,NULL,'2022-06-19 12:18:59','2022-06-19 12:18:59'),(59,44,13,199.00,1.00,NULL,'2022-06-19 12:18:59','2022-06-19 12:18:59'),(60,45,2,99.00,1.00,NULL,'2022-06-20 00:17:57','2022-06-20 00:17:57'),(61,45,3,55.00,3.00,NULL,'2022-06-20 00:17:57','2022-06-20 00:17:57'),(62,45,5,99.00,1.00,NULL,'2022-06-20 00:17:57','2022-06-20 00:17:57'),(63,45,6,79.00,2.00,NULL,'2022-06-20 00:17:57','2022-06-20 00:17:57'),(64,47,2,99.00,2.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(65,47,3,55.00,1.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(66,47,4,179.00,1.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(67,48,2,99.00,2.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(68,48,3,55.00,1.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(69,48,4,179.00,1.00,NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(70,49,2,99.00,1.00,NULL,'2022-06-27 20:29:13','2022-06-27 20:29:13'),(71,49,13,199.00,1.00,NULL,'2022-06-27 20:29:13','2022-06-27 20:29:13'),(72,49,23,99.00,1.00,NULL,'2022-06-27 20:29:13','2022-06-27 20:29:13'),(73,49,1,69.00,1.00,NULL,'2022-06-27 20:29:13','2022-06-27 20:29:13'),(74,50,2,99.00,1.00,NULL,'2022-06-27 20:34:42','2022-06-27 20:34:42'),(75,50,3,55.00,1.00,NULL,'2022-06-27 20:34:42','2022-06-27 20:34:42'),(76,50,1,69.00,1.00,NULL,'2022-06-27 20:34:42','2022-06-27 20:34:42'),(77,51,1,69.00,1.00,NULL,'2022-06-27 20:38:33','2022-06-27 20:38:33'),(78,53,63,199.00,2.00,NULL,'2022-06-29 01:47:03','2022-06-29 01:47:03'),(79,53,64,99.00,1.00,NULL,'2022-06-29 01:47:03','2022-06-29 01:47:03'),(80,54,77,3500.00,1.00,NULL,'2022-06-29 04:16:48','2022-06-29 04:16:48'),(81,54,87,149.00,2.00,NULL,'2022-06-29 04:16:48','2022-06-29 04:16:48'),(82,57,93,3999.00,1.00,NULL,'2022-06-29 22:19:30','2022-06-29 22:19:30'),(83,88,63,199.00,2.00,NULL,'2022-07-04 17:23:24','2022-07-04 17:23:24'),(84,88,79,12999.00,2.00,NULL,'2022-07-04 17:23:24','2022-07-04 17:23:24'),(85,89,2,5.00,3.00,NULL,'2022-07-04 17:37:04','2022-07-04 17:37:04'),(86,89,2,5.00,3.00,NULL,'2022-07-04 17:37:04','2022-07-04 17:37:04'),(87,89,2,5.00,3.00,NULL,'2022-07-04 17:37:04','2022-07-04 17:37:04'),(88,91,2,5.00,3.00,NULL,'2022-07-05 18:53:39','2022-07-05 18:53:39'),(89,91,2,5.00,3.00,NULL,'2022-07-05 18:53:39','2022-07-05 18:53:39'),(90,91,2,5.00,3.00,NULL,'2022-07-05 18:53:39','2022-07-05 18:53:39'),(91,92,2,5.00,3.00,NULL,'2022-07-05 18:55:07','2022-07-05 18:55:07'),(92,92,2,5.00,3.00,NULL,'2022-07-05 18:55:07','2022-07-05 18:55:07'),(93,92,2,5.00,3.00,NULL,'2022-07-05 18:55:07','2022-07-05 18:55:07'),(94,122,63,199.00,1.00,NULL,'2022-07-05 20:59:02','2022-07-05 20:59:02'),(95,123,79,12999.00,1.00,NULL,'2022-07-05 21:02:47','2022-07-05 21:02:47'),(96,124,63,199.00,3.00,NULL,'2022-07-06 23:17:05','2022-07-06 23:17:05'),(97,124,64,99.00,2.00,NULL,'2022-07-06 23:17:05','2022-07-06 23:17:05'),(98,125,63,199.00,2.00,NULL,'2022-07-12 19:00:56','2022-07-12 19:00:56'),(99,126,63,199.00,2.00,NULL,'2022-07-13 11:48:17','2022-07-13 11:48:17'),(100,126,79,12999.00,1.00,NULL,'2022-07-13 11:48:17','2022-07-13 11:48:17'),(101,127,79,12999.00,2.00,NULL,'2022-07-14 09:03:40','2022-07-14 09:03:40'),(102,128,57,6499.00,1.00,NULL,'2022-07-14 09:06:54','2022-07-14 09:06:54'),(103,128,56,2888.00,1.00,NULL,'2022-07-14 09:06:54','2022-07-14 09:06:54'),(104,129,63,199.00,1.00,NULL,'2022-07-14 13:11:37','2022-07-14 13:11:37'),(105,130,71,2499.00,1.00,NULL,'2022-07-14 14:16:01','2022-07-14 14:16:01'),(106,131,71,2499.00,1.00,NULL,'2022-07-14 14:35:05','2022-07-14 14:35:05'),(107,131,72,6999.00,1.00,NULL,'2022-07-14 14:35:05','2022-07-14 14:35:05'),(108,132,79,12999.00,1.00,NULL,'2022-07-14 16:18:02','2022-07-14 16:18:02'),(109,133,79,12999.00,1.00,NULL,'2022-07-14 16:19:04','2022-07-14 16:19:04'),(110,133,87,149.00,1.00,NULL,'2022-07-14 16:19:04','2022-07-14 16:19:04'),(111,134,72,6999.00,1.00,NULL,'2022-07-14 16:54:45','2022-07-14 16:54:45'),(112,135,79,12999.00,1.00,NULL,'2022-07-16 16:42:09','2022-07-16 16:42:09'),(113,136,71,2499.00,1.00,NULL,'2022-07-16 19:47:14','2022-07-16 19:47:14'),(114,136,73,3999.00,1.00,NULL,'2022-07-16 19:47:14','2022-07-16 19:47:14'),(115,136,85,6999.00,1.00,NULL,'2022-07-16 19:47:14','2022-07-16 19:47:14'),(116,137,57,6499.00,3.00,NULL,'2022-07-17 14:06:10','2022-07-17 14:06:10'),(117,137,56,2888.00,1.00,NULL,'2022-07-17 14:06:10','2022-07-17 14:06:10'),(118,138,74,1999.00,2.00,NULL,'2022-07-17 15:48:08','2022-07-17 15:48:08'),(119,138,75,4999.00,1.00,NULL,'2022-07-17 15:48:08','2022-07-17 15:48:08'),(120,138,87,149.00,1.00,NULL,'2022-07-17 15:48:08','2022-07-17 15:48:08'),(121,139,79,12999.00,1.00,NULL,'2022-07-20 07:20:14','2022-07-20 07:20:14'),(122,139,56,2888.00,1.00,NULL,'2022-07-20 07:20:14','2022-07-20 07:20:14'),(123,140,71,2499.00,1.00,NULL,'2022-07-27 09:47:25','2022-07-27 09:47:25'),(124,141,79,12999.00,4.00,NULL,'2022-07-30 12:12:37','2022-07-30 12:12:37'),(125,142,71,2499.00,1.00,NULL,'2022-07-31 15:46:15','2022-07-31 15:46:15'),(126,142,72,6999.00,1.00,NULL,'2022-07-31 15:46:15','2022-07-31 15:46:15'),(127,142,79,12999.00,1.00,NULL,'2022-07-31 15:46:15','2022-07-31 15:46:15'),(128,142,87,149.00,1.00,NULL,'2022-07-31 15:46:15','2022-07-31 15:46:15'),(129,143,87,149.00,1.00,NULL,'2022-08-02 19:33:43','2022-08-02 19:33:43'),(130,143,90,149.00,1.00,NULL,'2022-08-02 19:33:43','2022-08-02 19:33:43'),(131,144,79,12999.00,1.00,NULL,'2022-08-11 22:11:37','2022-08-11 22:11:37');
/*!40000 ALTER TABLE `fs_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_orders`
--

DROP TABLE IF EXISTS `fs_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(14,2) unsigned NOT NULL,
  `tax` decimal(14,2) unsigned NOT NULL,
  `delivery_fee` decimal(14,2) unsigned NOT NULL,
  `total_amount` decimal(14,2) unsigned NOT NULL,
  `recived` tinyint(1) NOT NULL DEFAULT '0',
  `in_process` tinyint(1) NOT NULL DEFAULT '0',
  `in_delivery` tinyint(1) NOT NULL DEFAULT '0',
  `deliverd` tinyint(1) NOT NULL DEFAULT '0',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_n` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_n` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_n` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appartment_n` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_orders`
--

LOCK TABLES `fs_orders` WRITE;
/*!40000 ALTER TABLE `fs_orders` DISABLE KEYS */;
INSERT INTO `fs_orders` VALUES (1,1.00,1.00,1.00,1.00,0,0,0,0,'','','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 10:55:02','2022-06-14 10:55:02'),(2,1.00,1.00,1.00,1.00,0,0,0,0,'','','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 11:09:38','2022-06-14 11:09:38'),(3,100.95,5.60,10.60,115.66,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 11:37:23','2022-06-14 11:37:23'),(4,100.95,5.60,10.60,115.66,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 11:37:35','2022-06-14 11:37:35'),(5,100.95,5.60,10.60,115.66,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 11:52:25','2022-06-14 11:52:25'),(6,100.95,5.60,10.60,115.66,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-14 11:52:36','2022-06-14 11:52:36'),(8,100.95,5.60,10.60,115.66,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss',NULL,NULL,'2022-06-16 15:02:08','2022-06-16 15:02:08'),(24,388.00,19.40,8.00,696.40,0,0,0,0,'dubai','329th Road','329th Road','329th Road','329th Road','329th Road','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd',NULL,NULL,'2022-06-16 17:52:55','2022-06-16 17:52:55'),(25,388.00,19.40,8.00,696.40,1,0,0,0,'dubai','329th Road','329th Road','329th Road','329th Road','329th Road','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-16 19:33:45','2022-06-16 19:39:45'),(26,388.00,19.40,8.00,696.40,0,0,0,0,'dubai','Al Barsha','329th Road','157','2','1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-16 20:17:49','2022-06-16 20:17:49'),(27,388.00,19.40,8.00,696.40,0,0,0,0,'dubai','Al Barsha','329th Road','157','2','1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','note test',NULL,'2022-06-16 20:18:15','2022-06-16 20:18:15'),(28,365.00,18.25,8.00,493.25,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 2','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-16 22:44:04','2022-06-16 22:44:04'),(29,388.00,19.40,8.00,506.40,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 2','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-17 00:10:53','2022-06-17 00:10:53'),(30,268.00,13.40,8.00,350.40,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 2','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-17 00:14:26','2022-06-17 00:14:26'),(31,338.00,16.90,8.00,593.90,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 2','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-17 00:20:23','2022-06-17 00:20:23'),(32,253.00,12.65,8.00,320.65,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 2','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dn9jn5Rkc7c:APA91bH0EdoqNplKdvhnKRYIUZa75qrIND9z2a1nd28cThot7rZH7Xs2CAOm7mHSZpGCLMtJr1YfSXDoriJnzUHB_P4rWWZjbQpKH0KWFzQu_tE33UAO74ZbSJfzjRyc-RJYCVwcnMHd','no_note',NULL,'2022-06-17 00:23:49','2022-06-17 00:23:49'),(33,289.00,14.45,8.00,303.45,1,1,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 15:10:14','2022-06-17 15:14:32'),(34,179.00,8.95,8.00,187.95,1,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 15:48:58','2022-06-17 15:53:34'),(35,289.00,14.45,8.00,303.45,1,1,1,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 16:07:28','2022-06-17 22:44:24'),(36,198.00,9.90,8.00,207.90,1,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 16:09:45','2022-06-17 16:10:11'),(37,237.00,11.85,8.00,446.85,1,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 16:13:56','2022-06-17 16:14:33'),(38,578.00,28.90,8.00,865.90,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-17 16:24:33','2022-06-17 16:24:33'),(39,388.00,19.40,8.00,506.40,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-18 11:59:47','2022-06-18 12:16:03'),(40,178.00,8.90,8.00,285.90,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-18 12:25:06','2022-06-18 12:52:22'),(41,179.00,8.95,8.00,187.95,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-18 13:16:49','2022-06-18 13:41:19'),(42,497.00,24.85,8.00,1137.85,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-18 13:44:03','2022-06-18 17:01:51'),(43,237.00,11.85,8.00,347.85,1,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 5','Apartment.N 4','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','dYZ-MUsNg90:APA91bHetLAYnBp2vLHI36pxaMEBTbZJZgxudo9KZ__At6eDfd-J9ujwr_LfNblM0TAT1JJkQwL4Qjmi8187AB3uJNI6fmQP38cExDTFDB7ZdsGCeKZPmLENx6qa7WqIXt5fc5W_OnVA','no_note',NULL,'2022-06-18 17:04:30','2022-06-18 17:05:18'),(44,268.00,13.40,8.00,350.40,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0000000','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-06-19 12:18:59','2022-06-19 12:18:59'),(45,521.00,26.05,8.00,1273.05,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-06-20 00:17:57','2022-06-20 00:17:57'),(47,432.00,21.60,8.00,904.60,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','999','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(48,432.00,21.60,8.00,904.60,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','999','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-06-27 05:56:14','2022-06-27 05:56:14'),(49,466.00,23.30,8.00,1283.30,1,1,1,1,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','999','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-06-27 20:29:13','2022-06-27 20:32:19'),(50,223.00,11.15,8.00,487.15,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no note',NULL,'2022-06-27 20:34:42','2022-06-27 20:35:22'),(51,69.00,3.45,8.00,72.45,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','12','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-06-27 20:38:33','2022-06-27 20:38:33'),(53,497.00,24.85,8.00,919.85,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-06-29 01:47:03','2022-06-29 01:48:16'),(54,3798.00,189.90,8.00,7487.90,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','0555393773','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-06-29 04:16:48','2022-06-29 04:16:48'),(57,3999.00,199.95,8.00,4198.95,1,1,1,0,'dubai','Jordan','Street.N Abdullahebn makhramah','Building.N 12','Floor.N 2','Apartment.N 1','00962791809111','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','e_a1nizCSdk:APA91bElYC5-oObu_ZhYVO0t7Qmto70QbYQWoJF0y2_rFlDkXkqOC2r1VIgyT8KKCeNhlQ3UnAZRw7gCpC1DCdCU-FNrEfxJTPAzmTIKUVBSYseoO87IV3u2tv6oJ0IF7T6FtjCFjbmV','no_note',NULL,'2022-06-29 22:19:30','2022-06-29 22:22:07'),(88,26396.00,1319.80,8.00,28113.80,1,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402466','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-07-04 17:23:24','2022-07-04 17:24:47'),(89,100.95,5.60,10.60,111.00,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss','this is customer note',NULL,'2022-07-04 17:37:04','2022-07-04 17:37:04'),(91,100.95,5.60,10.60,111.00,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss','this is customer note',NULL,'2022-07-05 18:53:39','2022-07-05 18:53:39'),(92,100.95,5.60,0.00,111.00,0,0,0,0,'Abu dhabi','Al-mashref','1','1','1','1','2222222','link','android','ssssssss','this is customer note',NULL,'2022-07-05 18:55:07','2022-07-05 18:55:07'),(122,199.00,9.95,0.00,208.95,0,0,0,0,'Um Durman','Amesbury','g',NULL,NULL,NULL,NULL,'link','iOS','cZsl7e0jU0WbqFr3ZwwHfV:APA91bFKYP8l622FUOV_gLA4cDy1yo7eKH4GaQRVDu8JV-chPiMQb47um4bAzWnap-OKF_Ls2jTWosBBpI571UckjDF0x_ROxwBAgrgU2MP_71t2f2rjNlxfdy3qTrluUlzNNpZ1Df-p',NULL,NULL,'2022-07-05 20:59:02','2022-07-05 20:59:02'),(123,12999.00,649.95,0.00,13648.95,0,0,0,0,'Um Durman','Amesbury','g',NULL,NULL,NULL,'005814648322','link','iOS','cZsl7e0jU0WbqFr3ZwwHfV:APA91bFKYP8l622FUOV_gLA4cDy1yo7eKH4GaQRVDu8JV-chPiMQb47um4bAzWnap-OKF_Ls2jTWosBBpI571UckjDF0x_ROxwBAgrgU2MP_71t2f2rjNlxfdy3qTrluUlzNNpZ1Df-p','Hhh',NULL,'2022-07-05 21:02:47','2022-07-05 21:02:47'),(124,795.00,39.75,0.00,834.75,1,1,1,1,'Um Durman','Amesbury','g',NULL,NULL,NULL,'0581464832','link','iOS','cZsl7e0jU0WbqFr3ZwwHfV:APA91bFKYP8l622FUOV_gLA4cDy1yo7eKH4GaQRVDu8JV-chPiMQb47um4bAzWnap-OKF_Ls2jTWosBBpI571UckjDF0x_ROxwBAgrgU2MP_71t2f2rjNlxfdy3qTrluUlzNNpZ1Df-p','Ggg',NULL,'2022-07-06 23:17:05','2022-07-08 15:18:31'),(125,398.00,19.90,8.00,417.90,1,1,1,1,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0000','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-07-12 19:00:56','2022-07-13 13:11:52'),(126,13397.00,669.85,8.00,14464.85,1,1,0,0,'dubai','Empty','Street.N aa','Building.N 55','Floor.N 1','Apartment.N 1','677655','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','dH6KFljgDSA:APA91bF_1Ecf3ny2x14jyHg5UbMRslpyFNMQS1RJSoYhsgifwcp0dWwIQith9ClZf_uQ_mUc564xIxKNoSW4JWpc1npZT27-LcAOO6LgtC98iNFDXo5HIBY2it7WmYcoGho-SftRvx-o','no_note',NULL,'2022-07-13 11:48:17','2022-07-13 11:49:20'),(127,25998.00,1299.90,8.00,27297.90,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','0555393773','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-07-14 09:03:40','2022-07-14 09:03:40'),(128,9387.00,469.35,8.00,16355.35,0,0,0,0,'dubai','Empty','Street.N Empty','Building.N Empty','Floor.N 1','Apartment.N 1','0796230378','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','eYG6kw7ua7Q:APA91bGNWHoWuuRBITPseAMAgqhiiZnLgtcEHaEesa8X7Op5SAkYYIK8iUoFLOJZjCoZ3mgGykbxt2rJszaO3XEBp07-v2B2y3al_Q8RvaBDpFa_eumc58OXxBi00rdDvV-l-pZblMDf','no_note',NULL,'2022-07-14 09:06:54','2022-07-14 09:06:54'),(129,199.00,9.95,0.00,208.95,1,1,0,0,'Um Durman','Amesbury','g',NULL,NULL,NULL,'0581464832','link','iOS','cZsl7e0jU0WbqFr3ZwwHfV:APA91bFKYP8l622FUOV_gLA4cDy1yo7eKH4GaQRVDu8JV-chPiMQb47um4bAzWnap-OKF_Ls2jTWosBBpI571UckjDF0x_ROxwBAgrgU2MP_71t2f2rjNlxfdy3qTrluUlzNNpZ1Df-p','Bzbznzjs',NULL,'2022-07-14 13:11:37','2022-07-14 13:14:18'),(130,2499.00,124.95,8.00,2623.95,1,1,1,0,'dubai','Empty','Street.N Empty','Building.N Empty','Floor.N 1','Apartment.N 11','555555','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','eIC4wtsRZ7U:APA91bGqINT0ZVaXNDDtgjh9PZNYteCz8ZWnpTGR9CNhP8v6nnS56R7AplzGOKKPjIr7VCtW9wfA8tcUP53tRjA6ekYo48CQ-8emXuiwRpJyHtZMtA3nFw6r7NGcT9nAWZxtHWQnBIei','fgg',NULL,'2022-07-14 14:16:01','2022-07-14 14:19:32'),(131,9498.00,474.90,0.00,9972.90,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555393773','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-14 14:35:05','2022-07-14 14:35:05'),(132,12999.00,649.95,0.00,13648.95,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555393773','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-14 16:18:02','2022-07-14 16:18:02'),(133,13148.00,657.40,8.00,26804.40,0,0,0,0,'dubai','Dubai','Street.N 1','Building.N Empty','Floor.N 1','Apartment.N 1','5555','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fy6ytN9QoJ4:APA91bEMpG1CeJy_ZVga7pagnC_6BKiQhlf1leNc8Jhq_YJDAG2lzdeyGtNfKkQGE7oGsQGCCT86xb_itZZxxpTiKpaxRSo1dhV70E5hLLHGMZxgzNGPZb2wrpKFM4R8CeGLQkuR-V2i','no_note',NULL,'2022-07-14 16:19:04','2022-07-14 16:19:04'),(134,6999.00,349.95,0.00,7348.95,0,0,0,0,'Um Durman','Amesbury','g',NULL,NULL,NULL,'055555555','link','iOS','cZsl7e0jU0WbqFr3ZwwHfV:APA91bFKYP8l622FUOV_gLA4cDy1yo7eKH4GaQRVDu8JV-chPiMQb47um4bAzWnap-OKF_Ls2jTWosBBpI571UckjDF0x_ROxwBAgrgU2MP_71t2f2rjNlxfdy3qTrluUlzNNpZ1Df-p','Fff',NULL,'2022-07-14 16:54:45','2022-07-14 16:54:45'),(135,12999.00,649.95,0.00,13648.95,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555393773','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-16 16:42:09','2022-07-16 16:42:09'),(136,13497.00,674.85,0.00,14171.85,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555393773','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-16 19:47:14','2022-07-16 19:47:14'),(137,22385.00,1119.25,8.00,43001.25,1,1,0,0,'dubai','Amman','Street.N 55','Building.N 32','Floor.N 9','Apartment.N 2','0790551571','http://maps.google.com/maps?q=loc:25.276987,55.296249','android','fBNjTBjaR-k:APA91bHb-qT1gKN0aVig2iob9odRlZr41RbopbE2jSvxKERQuxSo79S5ztxnlazg74SQVPrn1IDw0DYJMJG6MFrD_XHeKNsBg48YXulRTuUbzPLQrnEo7o_wyX2dpUdy8Pzg6F9Qr5c4','no_note',NULL,'2022-07-17 14:06:10','2022-07-17 14:06:49'),(138,9146.00,457.30,0.00,9603.30,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555393773','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-17 15:48:08','2022-07-17 15:48:08'),(139,15887.00,794.35,0.00,16681.35,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'05553937','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-20 07:20:14','2022-07-20 07:20:14'),(140,2499.00,124.95,0.00,2623.95,0,0,0,0,'13a Street 1','Dubai','13a Street','13',NULL,NULL,'05553555','link','iOS','eF5AeRk5M0XfvIv04NJgFq:APA91bEgGOTSgVpWyMK6NV73IqCRD2X4tpfqtdxlwxD24GpYLm2DbNO_Qj_RwpUZ6KTk0C-E2pamVDt9bVviA8xuCWrjviKTjqopTlQGYEyWGdEXHxznvoTdt7zyIcYC8rQwBBW1DkWl',NULL,NULL,'2022-07-27 09:47:25','2022-07-27 09:47:25'),(141,51996.00,2599.80,8.00,54595.80,1,1,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-07-30 12:12:37','2022-07-30 12:15:05'),(142,22646.00,1132.30,0.00,23778.30,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'055555','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-07-31 15:46:15','2022-07-31 15:46:15'),(143,298.00,14.90,0.00,312.90,0,0,0,0,'Al Ayayyiz','Al Ayayyiz',NULL,NULL,NULL,NULL,'0555555','link','iOS','edtAmeYj4UMhl2eR2VPWFe:APA91bGQoM65bqb-YJHxSQJQG570Up2u3deQOL8S9TiowqtuIVeo2kGj7wQycyPc254iGfOhnXf_RNQARBQcrNhOcPshXnQTm-V5HyrJA0gpk_FpR7jbaAfP4ww5hOE2VbZ2zSNjGsg-',NULL,NULL,'2022-08-02 19:33:43','2022-08-02 19:33:43'),(144,12999.00,649.95,8.00,13648.95,0,0,0,0,'dubai','Al Barsha','Street.N 329th Road','Building.N 157','Floor.N 1','Apartment.N 1','0582402431','http://maps.google.com/maps?q=loc:25.0877971,55.2133611','android','ffzn0v8L2ho:APA91bH1OAKiRntX02kcA63FwLY38AcSGRmk_H6h18VJ-V7s97oNYyDCOYlZy8gLnB97BLo2b3BdsmA6Za_x3rrlseZit1nKsYs57puQ4q-DsKtnTm-U9nRUF20O2cUvtj3aTJtyYfiw','no_note',NULL,'2022-08-11 22:11:37','2022-08-11 22:11:37');
/*!40000 ALTER TABLE `fs_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_password_resets`
--

DROP TABLE IF EXISTS `fs_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `fs_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_password_resets`
--

LOCK TABLES `fs_password_resets` WRITE;
/*!40000 ALTER TABLE `fs_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_payment_methods`
--

DROP TABLE IF EXISTS `fs_payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_payment_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_payment_methods_mode_unique` (`mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_payment_methods`
--

LOCK TABLES `fs_payment_methods` WRITE;
/*!40000 ALTER TABLE `fs_payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_payment_platforms`
--

DROP TABLE IF EXISTS `fs_payment_platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_payment_platforms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_payment_platforms_platform_unique` (`platform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_payment_platforms`
--

LOCK TABLES `fs_payment_platforms` WRITE;
/*!40000 ALTER TABLE `fs_payment_platforms` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_payment_platforms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_personal_access_tokens`
--

DROP TABLE IF EXISTS `fs_personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_personal_access_tokens_token_unique` (`token`),
  KEY `fs_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_personal_access_tokens`
--

LOCK TABLES `fs_personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `fs_personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_promotions`
--

DROP TABLE IF EXISTS `fs_promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` int unsigned DEFAULT NULL,
  `discount_type_id` bigint unsigned NOT NULL,
  `discount_value` int unsigned NOT NULL,
  `status` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_promotions_promo_code_unique` (`promo_code`),
  KEY `fs_promotions_discount_type_id_foreign` (`discount_type_id`),
  KEY `fs_promotions_status_foreign` (`status`),
  CONSTRAINT `fs_promotions_discount_type_id_foreign` FOREIGN KEY (`discount_type_id`) REFERENCES `fs_discount_types` (`id`),
  CONSTRAINT `fs_promotions_status_foreign` FOREIGN KEY (`status`) REFERENCES `fs_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_promotions`
--

LOCK TABLES `fs_promotions` WRITE;
/*!40000 ALTER TABLE `fs_promotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_status`
--

DROP TABLE IF EXISTS `fs_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_type_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_status_name_status_type_id_unique` (`name`,`status_type_id`),
  KEY `fs_status_status_type_id_foreign` (`status_type_id`),
  CONSTRAINT `fs_status_status_type_id_foreign` FOREIGN KEY (`status_type_id`) REFERENCES `fs_status_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_status`
--

LOCK TABLES `fs_status` WRITE;
/*!40000 ALTER TABLE `fs_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_status_types`
--

DROP TABLE IF EXISTS `fs_status_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_status_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_status_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_status_types`
--

LOCK TABLES `fs_status_types` WRITE;
/*!40000 ALTER TABLE `fs_status_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_status_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_stores`
--

DROP TABLE IF EXISTS `fs_stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci,
  `name_locale` text COLLATE utf8mb4_unicode_ci,
  `slogan` text COLLATE utf8mb4_unicode_ci,
  `slogan_locale` text COLLATE utf8mb4_unicode_ci,
  `location_text` text COLLATE utf8mb4_unicode_ci,
  `location_text_locale` text COLLATE utf8mb4_unicode_ci,
  `phone_number` text COLLATE utf8mb4_unicode_ci,
  `delivery_time_range` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `cover_image` text COLLATE utf8mb4_unicode_ci,
  `google_map_link` text COLLATE utf8mb4_unicode_ci,
  `is_open` tinyint(1) DEFAULT NULL,
  `allow_add_hot_price` tinyint(1) DEFAULT NULL,
  `area_id` mediumint unsigned NOT NULL COMMENT 'this is area_id  ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fs_stores_area_id_foreign` (`area_id`),
  CONSTRAINT `fs_stores_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `fs_areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_stores`
--

LOCK TABLES `fs_stores` WRITE;
/*!40000 ALTER TABLE `fs_stores` DISABLE KEYS */;
INSERT INTO `fs_stores` VALUES (1,'Megaplex','ميغا بليكس','Join Now','انضم الان','dubai/al barsha 2','دبي/ البرشاء','582402431','40 mint','20220604225018.png','20220604225018.jpeg','https://www.google.com/maps/@25.0875254,55.2148743,15z',1,1,1,'2022-06-03 15:55:41','2022-06-04 22:50:18',NULL),(2,'Chocalala','شيشنو','Where living, Design, and art thrive in magnificent themes','Where living, Design, and art thrive in magnificent themes','Dubai, UAE','Dubai, UAE','0582402431','2 days','20220628203458.png','20220628203458.png','https://www.google.com/maps/place/CHESHNO/@24.9856464,55.1100226,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f0dc38b090b97:0x7fafc7be877e4b6d!8m2!3d24.9856464!4d55.1100226?hl=en-AE',0,1,1,'2022-06-28 20:34:58','2022-06-28 20:36:37',NULL),(3,'Cheshno','شيشنو','Where living, Design, and art thrive in magnificent themes','Where living, Design, and art thrive in magnificent themes','Dubai, UAE','Dubai, UAE','0582402431','2 days','20220628214404.png','20220628214404.png','https://www.google.com/maps/place/CHESHNO/@24.9856464,55.1100226,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f0dc38b090b97:0x7fafc7be877e4b6d!8m2!3d24.9856464!4d55.1100226?hl=en-AE',1,1,1,'2022-06-28 20:35:33','2022-06-28 21:44:04',NULL);
/*!40000 ALTER TABLE `fs_stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_transactions`
--

DROP TABLE IF EXISTS `fs_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform_id` bigint unsigned NOT NULL,
  `method_id` bigint unsigned NOT NULL,
  `amount` decimal(8,2) unsigned NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_transactions_platform_id_method_id_transaction_id_unique` (`platform_id`,`method_id`,`transaction_id`),
  KEY `fs_transactions_method_id_foreign` (`method_id`),
  CONSTRAINT `fs_transactions_method_id_foreign` FOREIGN KEY (`method_id`) REFERENCES `fs_payment_methods` (`id`),
  CONSTRAINT `fs_transactions_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `fs_payment_platforms` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_transactions`
--

LOCK TABLES `fs_transactions` WRITE;
/*!40000 ALTER TABLE `fs_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_user_types`
--

DROP TABLE IF EXISTS `fs_user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_user_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_user_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_user_types`
--

LOCK TABLES `fs_user_types` WRITE;
/*!40000 ALTER TABLE `fs_user_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fs_users`
--

DROP TABLE IF EXISTS `fs_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fs_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` bigint unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fs_users_email_unique` (`email`),
  UNIQUE KEY `fs_users_token_unique` (`token`),
  KEY `fs_users_user_type_id_foreign` (`user_type_id`),
  CONSTRAINT `fs_users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `fs_user_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fs_users`
--

LOCK TABLES `fs_users` WRITE;
/*!40000 ALTER TABLE `fs_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `fs_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-17 16:13:33
