DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` ( 
  `Id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `StudentId` int(11) NOT NULL, 
  `Totalunits` int(11) NOT NULL, 
  `Tuitionfee` decimal(10,2) NOT NULL, 
  `Registrationfee` decimal(10,2) NOT NULL, 
  `Libraryfee` decimal(10,2) NOT NULL, 
  `MedicalDentalfee` decimal(10,2) NOT NULL, 
  `Guidancefee` decimal(10,2) NOT NULL, 
  `Labfee` decimal(10,2) NOT NULL, 
  `Internetfee` decimal(10,2) NOT NULL, 
  `Studentorgfee` decimal(10,2) NOT NULL, 
  `Schoolpubfee` decimal(10,2) NOT NULL, 
  `SchoolIdfee` decimal(10,2) NOT NULL, 
  `Athleticfee` decimal(10,2) NOT NULL, 
  `Studentactfee` decimal(10,2) NOT NULL, 
  `Insurancefee` decimal(10,2) NOT NULL, 
  `Culturalfee` decimal(10,2) NOT NULL, 
  `PRISAA` decimal(10,2) NOT NULL, 
  `Securityfee` decimal(10,2) NOT NULL, 
  `Energyfee` decimal(10,2) NOT NULL, 
  `Handbookfee` decimal(10,2) NOT NULL, 
  `Crimlabfee` decimal(10,2) NOT NULL, 
  `Totalamount` decimal(10,2) NOT NULL, 
  `Paymentmethod` varchar(50) NOT NULL, 
  `Status` varchar(50) DEFAULT 'Paid', 
  `Timepaid` timestamp NOT NULL DEFAULT current_timestamp()
);

INSERT INTO `payments` (`Id`,`StudentId`,`Totalunits`,`Tuitionfee`,`Registrationfee`,`Libraryfee`,`MedicalDentalfee`,`Guidancefee`,`Labfee`,`Internetfee`,`Studentorgfee`,`Schoolpubfee`,`SchoolIdfee`,`Athleticfee`,`Studentactfee`,`Insurancefee`,`Culturalfee`,`PRISAA`,`Securityfee`,`Energyfee`,`Handbookfee`,`Crimlabfee`,`Totalamount`,`Paymentmethod`,`Status`,`Timepaid`) VALUES 
(12,54,30,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'Credit / Debit Card','Paid','2026-10-17 15:29:20'), 
(13,49,28,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 15:33:51'), 
(15,46,28,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 15:44:28'), 
(16,54,28,0.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 16:16:26'), 
(17,54,28,0.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 16:18:03'), 
(18,54,28,0.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 16:18:09'), 
(19,46,28,0.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,400.00,200.00,400.00,200.00,0.00,'GCash / Online Wallet','Paid','2026-10-17 16:18:42'), 
(21,46,28,400.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,'Cash / Over-the-Counter','Paid','2026-10-17 16:51:24'), 
(22,46,28,400.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,'Cash / Over-the-Counter','Paid','2026-10-17 16:56:02'), 
(23,46,28,400.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,'Cash / Over-the-Counter','Paid','2026-10-17 17:02:11'), 
(24,46,28,400.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,'Cash / Over-the-Counter','Paid','2026-10-17 17:03:17'), 
(25,46,28,400.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,200.00,'Cash / Over-the-Counter','Paid','2026-10-17 17:08:01'), 
(27,54,8,3600.00,450.00,400.00,200.00,150.00,750.00,830.00,150.00,120.00,130.00,170.00,850.00,110.00,120.00,200.00,120.00,850.00,200.00,500.00,9900.00,'Cash / Over-the-Counter','Paid','2026-10-17 17:50:36');

DROP TABLE IF EXISTS `receipts`;

CREATE TABLE `receipts` (
  `ReceiptId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `OrNumber` varchar(50) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `IssuedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ReceiptId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `receipts` */

insert  into `receipts`(`ReceiptId`,`StudentId`,`OrNumber`,`TotalAmount`,`IssuedDate`) values 
(7,1,'1',9000.00,'2026-10-16 00:05:12');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `StudentId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `StudentType` varchar(100) NOT NULL,
  `Iotstudent` varchar(100) NOT NULL,
  `Semester` varchar(100) NOT NULL,
  `SchoolYear` varchar(100) NOT NULL,
  `Summer` varchar(100) NOT NULL,
  `Sex` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Middlename` varchar(100) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Yearlevel` varchar(50) NOT NULL,
  `SAddress` varchar(255) NOT NULL,
  `SNumber` varchar(11) NOT NULL,
  `SEmail` varchar(100) NOT NULL,
  `PFullname` varchar(100) NOT NULL,
  `PAddress` varchar(100) NOT NULL,
  `PNumber` varchar(11) NOT NULL,
  `PEmail` varchar(100) NOT NULL,
  `TimeEnrolled` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `SEmail` (`SEmail`),
  KEY `UserId` (`UserId`)
);
/*Data for the table `students` */

insert  into `students`(`StudentId`,`UserId`,`StudentType`,`Iotstudent`,`Semester`,`SchoolYear`,`Summer`,`Sex`,`Lastname`,`Firstname`,`Middlename`,`Course`,`Yearlevel`,`SAddress`,`SNumber`,`SEmail`,`PFullname`,`PAddress`,`PNumber`,`PEmail`,`TimeEnrolled`) values 
(37,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Asssdsdsd','Ads','Vbers','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','ashlyndulay31@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','ashlyndulay31@gmail.com','2026-10-16 23:34:29'),
(40,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Asdsdsds','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasds@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','ashlyndulay31@gmail.com','2026-10-17 00:46:10'),
(42,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Balagot','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssa@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','sasdssdsada@gmail.com','2026-10-17 01:17:40'),
(46,3,'Regular','Transferee','1st Semester','2025-2026','No','Male','Balagot','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssdsada@gmail.com','Yang','San Manuel Norte, Agoo, La Union','09304422941','mysteriousesvdsdsdb952@gmail.com','2026-10-17 08:36:59'),
(47,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Balagot','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssdsadsasa@gmail.com','Yangsd','San Manuel Norte, Agoo, La Union','09304412941','mysteriousesvdsdsdb952@gmail.com','2026-10-17 08:39:21'),
(49,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Balagot','Elykha','Esdsds','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssdsadsasafdsfd@gmail.com','Yng','San Manuel Norte, Agoo, La Union','09304422941','mysteriousesvdsdsdb952@gmail.com','2026-10-17 08:39:42'),
(52,3,'Regular','Old Student','1st Semester','2025-2026','No','Male','Balagot','Elykha','Easds','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssdsadsasafdsdsadsdfd@gmail.com','Fdsdsd','San Manuel Norte, Agoo, La Union','09304422941','mysteriousesvdsdsdb952@gmail.com','2026-10-17 08:47:58'),
(53,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Balagot','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','sdasdssdsadsasafdsdsadsdzxzxzsdsdsdsdsdxzxzxzxzxzfd@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','mysteriousesvdsdsdb952@gmail.com','2026-10-17 13:27:35'),
(54,7,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','Balagot','Elykha','Middle','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09632688562','bulogkupal@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','gamerplayer3729@gmail.com','2026-10-17 14:32:07'),
(55,3,'Regular','Incoming Freshman','1st Semester','2025-2026','No','Male','ASsdsad','Elykha','SCIE','BSIT','1st Year','San Manuel Norte, Agoo, La Union','09304422941','mysteriousesvb952@gmail.com','Elykha Balagot','San Manuel Norte, Agoo, La Union','09304422941','gamerplayer3729@gmail.com','2026-10-17 17:51:12');

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course` varchar(50) NOT NULL,
  `Yearlevel` varchar(50) NOT NULL,
  `Semester` varchar(50) NOT NULL,
  `CourseCode` varchar(20) NOT NULL,
  `DescriTitle` varchar(100) NOT NULL,
  `Units` int(11) NOT NULL,
  `Time` varchar(50) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Room` varchar(15) NOT NULL,
  `Instructor` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `subjects` */

insert  into `subjects`(`Id`,`Course`,`Yearlevel`,`Semester`,`CourseCode`,`DescriTitle`,`Units`,`Time`,`Day`,`Room`,`Instructor`) values 
(1,'BSIT','1st Year','1st Semester','IT101','Introduction to Computing',3,'8:00 AM - 10:30 AM','Mon/Wed','101','Byron Rivera'),
(2,'BSIT','1st Year','1st Semester','IT102','Computer Programming 1',3,'10:00 AM - 12:30 PM','Tue/Thu','101','Lexter Pogi Garcia'),
(3,'BSIT','1st Year','2nd Semester','IT103','Computer Programming 2',3,'10:00 AM - 12:30 PM','Mon/Wed','102','Lexter Pogi Garcia'),
(4,'BSIT','1st Year','2nd Semester','IT104','Discrete Mathematics',3,'1:00 PM - 3:00 PM','Tue/Thu','102','Susan Boado'),
(5,'BSIT','2nd Year','1st Semester','IT201','Fundamentals and Database System',3,'10:30 AM - 1:00 PM','Mon/Wed','101','Rowena Aquino'),
(6,'BSIT','2nd Year','1st Semester','IT202','Object Oriented Programming',3,'7:30 AM - 10:00 AM','Tue/Thu','101','Jeffrey Cabutotan'),
(7,'BSIT','2nd Year','2nd Semester','IT203','Introduction to Platform Technologies',3,'7:30 AM - 10:00 AM','Mon/Wed','102','Aprilyn Serdeniola'),
(8,'BSIT','2nd Year','2nd Semester','IT204','Multimedia',3,'1:00 AM - 3:30 AM','Tue/Thu','102','Mark Aldrin Delos Reyes'),
(9,'BSIT','3rd Year','1st Semester','IT109','Networking',3,'7:30 AM - 12:00 PM','Fri','201','Lexter Garcia'),
(10,'BSIT','3rd Year','1st Semester','ITE5','Web App Development',3,'1:00 PM - 3:30 PM','Mon/Wed','201','Lexter Pogi Garcia'),
(11,'BSIT','3rd Year','2nd Semester','IT108','Information Assurance and Security',3,'3:30 PM - 5:30 PM','Mon/Wed','202','Aprilyn Serdeniola'),
(12,'BSIT','3rd Year','2nd Semester','EC103','Life and Works of Rizal',3,'12:30 AM - 3:30 PM','Fri','202','John Geneta'),
(13,'BSIT','4th Year','1st Semester','IT113','Capstone 2',3,'1:00 PM - 3:30 PM','Tue/Thu','201','Byron Rivera'),
(14,'BSIT','4th Year','1st Semester','IT122','Technopreneurship',3,'8:00 AM - 10:30 AM','Mon/Wed','201','Nagie Apilado'),
(15,'BSIT','4th Year','2nd Semester','IT123','Data Mining',3,'8:00 AM - 10:30 AM','Mon/Wed','202','Lexter Garcia'),
(16,'BSIT','4th Year','2nd Semester','IT114','System Administration and Maintenance',3,'8:00 AM - 10:30 AM','Tue/Thu','202','Rowena Aquino'),
(17,'BSCE','1st Year','1st Semester','CE101','Engineering',3,'8:00 AM - 10:30 AM','Mon/Wed','301','Juan Rivera'),
(18,'BSCE','1st Year','1st Semester','CE102','Engineering',3,'10:00 AM - 12:30 PM','Tue/Thu','301','Miguel Garcia'),
(19,'BSCE','1st Year','2nd Semester','CE103','Engineering',3,'10:00 AM - 12:30 PM','Mon/Wed','302','Miguel Garcia'),
(20,'BSCE','1st Year','2nd Semester','CE104','Engineering',3,'1:00 PM - 3:00 PM','Tue/Thu','302','Sushi Boado'),
(21,'BSCE','2nd Year','1st Semester','CE201','Engineering',3,'10:30 AM - 1:00 PM','Mon/Wed','301','Noynoy Aquino'),
(22,'BSCE','2nd Year','1st Semester','CE202','Engineering',3,'7:30 AM - 10:00 AM','Tue/Thu','301','Jeffrey Langan'),
(23,'BSCE','2nd Year','2nd Semester','CE203','Engineering',3,'7:30 AM - 10:00 AM','Mon/Wed','302','May Santiago'),
(24,'BSCE','2nd Year','2nd Semester','CE204','Engineering',3,'1:00 AM - 3:30 AM','Tue/Thu','302','Mark Heras'),
(25,'BSCE','3rd Year','1st Semester','CE301','Engineering',3,'7:30 AM - 12:00 PM','Fri','401','Miguel Garcia'),
(26,'BSCE','3rd Year','1st Semester','CE302','Engineering',3,'1:00 PM - 3:30 PM','Mon/Wed','401','Miguel Garcia'),
(27,'BSCE','3rd Year','2nd Semester','CE303','Engineering',3,'3:30 PM - 5:30 PM','Mon/Wed','402','May Santiago'),
(28,'BSCE','3rd Year','2nd Semester','CE304','Engineering',3,'12:30 AM - 3:30 PM','Fri','402','John Lloyd Cruz'),
(29,'BSCE','4th Year','1st Semester','CE401','Engineering',3,'1:00 PM - 3:30 PM','Tue/Thu','401','Juan Rivera'),
(30,'BSCE','4th Year','1st Semester','CE402','Engineering',3,'8:00 AM - 10:30 AM','Mon/Wed','401','Ai Ai Delas Alas'),
(31,'BSCE','4th Year','2nd Semester','CE403','Engineering',3,'8:00 AM - 10:30 AM','Mon/Wed','402','Miguel Garcia'),
(32,'BSCE','4th Year','2nd Semester','CE404','Engineering',3,'8:00 AM - 10:30 AM','Tue/Thu','402','Noynoy Aquino'),
(33,'BSCrim','1st Year','1st Semester','Crim101','Criminology',3,'8:00 AM - 10:30 AM','Mon/Wed','303','Jane De Leon'),
(34,'BSCrim','1st Year','1st Semester','Crim102','Criminology',3,'10:00 AM - 12:30 PM','Tue/Thu','303','Belle Mariano'),
(35,'BSCrim','1st Year','2nd Semester','Crim103','Criminology',3,'10:00 AM - 12:30 PM','Mon/Wed','304','Belle Mariano'),
(36,'BSCrim','1st Year','2nd Semester','Crim104','Criminology',3,'1:00 PM - 3:00 PM','Tue/Thu','304','Susan Roces'),
(37,'BSCrim','2nd Year','1st Semester','Crim201','Criminology',3,'10:30 AM - 1:00 PM','Mon/Wed','303','Vice Ganda'),
(38,'BSCrim','2nd Year','1st Semester','Crim202','Criminology',3,'7:30 AM - 10:00 AM','Tue/Thu','303','Petite Ilagan'),
(39,'BSCrim','2nd Year','2nd Semester','Crim203','Criminology',3,'7:30 AM - 10:00 AM','Mon/Wed','304','Miles Morales'),
(40,'BSCrim','2nd Year','2nd Semester','Crim204','Criminology',3,'1:00 AM - 3:30 AM','Tue/Thu','304','Mika Salamanca'),
(41,'BSCrim','3rd Year','1st Semester','Crim301','Criminology',3,'7:30 AM - 12:00 PM','Fri','403','Coco Martin'),
(42,'BSCrim','3rd Year','1st Semester','Crim302','Criminology',3,'1:00 PM - 3:30 PM','Mon/Wed','403','Fernando Poe'),
(43,'BSCrim','3rd Year','2nd Semester','Crim303','Criminology',3,'3:30 PM - 5:30 PM','Mon/Wed','404','Juan Dela Cruz'),
(44,'BSCrim','3rd Year','2nd Semester','Crim304','Criminology',3,'12:30 AM - 3:30 PM','Fri','404','Tanggol Marasigan'),
(45,'BSCrim','4th Year','1st Semester','Crim401','Criminology',3,'1:00 PM - 3:30 PM','Tue/Thu','403','Daniel Padilat'),
(46,'BSCrim','4th Year','1st Semester','Crim402','Criminology',3,'8:00 AM - 10:30 AM','Mon/Wed','403','Richard Gutierrez'),
(47,'BSCrim','4th Year','2nd Semester','Crim403','Criminology',3,'8:00 AM - 10:30 AM','Mon/Wed','404','Baron Gaizler'),
(48,'BSCrim','4th Year','2nd Semester','Crim404','Criminology',3,'8:00 AM - 10:30 AM','Tue/Thu','404','Toni Fowler'),
(49,'BSBA','1st Year','1st Semester','BA101','Business',3,'8:00 AM - 10:30 AM','Mon/Wed','103','Juan Rivera'),
(50,'BSBA','1st Year','1st Semester','BA102','Business',3,'10:00 AM - 12:30 PM','Tue/Thu','103','Miguel Garcia'),
(51,'BSBA','1st Year','2nd Semester','BA103','Business',3,'10:00 AM - 12:30 PM','Mon/Wed','104','Miguel Garcia'),
(52,'BSBA','1st Year','2nd Semester','BA104','Business',3,'1:00 PM - 3:00 PM','Tue/Thu','104','Sushi Boado'),
(53,'BSBA','2nd Year','1st Semester','BA201','Business',3,'10:30 AM - 1:00 PM','Mon/Wed','103','Noynoy Aquino'),
(54,'BSBA','2nd Year','1st Semester','BA202','Business',3,'7:30 AM - 10:00 AM','Tue/Thu','103','Jeffrey Langan'),
(55,'BSBA','2nd Year','2nd Semester','BA203','Business',3,'7:30 AM - 10:00 AM','Mon/Wed','104','May Santiago'),
(56,'BSBA','2nd Year','2nd Semester','BA204','Business',3,'1:00 AM - 3:30 AM','Tue/Thu','104','Mark Heras'),
(57,'BSBA','3rd Year','1st Semester','BA301','Business',3,'7:30 AM - 12:00 PM','Fri','203','Miguel Garcia'),
(58,'BSBA','3rd Year','1st Semester','BA302','Business',3,'1:00 PM - 3:30 PM','Mon/Wed','203','Miguel Garcia'),
(59,'BSBA','3rd Year','2nd Semester','BA303','Business',3,'3:30 PM - 5:30 PM','Mon/Wed','204','May Santiago'),
(60,'BSBA','3rd Year','2nd Semester','BA304','Business',3,'12:30 AM - 3:30 PM','Fri','204','John Lloyd Cruz'),
(61,'BSBA','4th Year','1st Semester','BA401','Business',3,'1:00 PM - 3:30 PM','Tue/Thu','203','Juan Rivera'),
(62,'BSBA','4th Year','1st Semester','BA402','Business',3,'8:00 AM - 10:30 AM','Mon/Wed','203','Ai Ai Delas Alas'),
(63,'BSBA','4th Year','2nd Semester','BA403','Business',3,'8:00 AM - 10:30 AM','Mon/Wed','204','Miguel Garcia'),
(64,'BSBA','4th Year','2nd Semester','BA404','Business',3,'8:00 AM - 10:30 AM','Tue/Thu','204','Noynoy Aquino'),
(65,'BSA','1st Year','1st Semester','A101','Administration',3,'8:00 AM - 10:30 AM','Mon/Wed','A301','Juan Rivera'),
(66,'BSA','1st Year','1st Semester','A102','Administration',3,'10:00 AM - 12:30 PM','Tue/Thu','A301','Miguel Garcia'),
(67,'BSA','1st Year','2nd Semester','A103','Administration',3,'10:00 AM - 12:30 PM','Mon/Wed','A302','Miguel Garcia'),
(68,'BSA','1st Year','2nd Semester','A104','Administration',3,'1:00 PM - 3:00 PM','Tue/Thu','A302','Sushi Boado'),
(69,'BSA','2nd Year','1st Semester','A201','Administration',3,'10:30 AM - 1:00 PM','Mon/Wed','A301','Noynoy Aquino'),
(70,'BSA','2nd Year','1st Semester','A202','Administration',3,'7:30 AM - 10:00 AM','Tue/Thu','A301','Jeffrey Langan'),
(71,'BSA','2nd Year','2nd Semester','A203','Administration',3,'7:30 AM - 10:00 AM','Mon/Wed','A302','May Santiago'),
(72,'BSA','2nd Year','2nd Semester','A204','Administration',3,'1:00 AM - 3:30 AM','Tue/Thu','A302','Mark Heras'),
(73,'BSA','3rd Year','1st Semester','A301','Administration',3,'7:30 AM - 12:00 PM','Fri','A401','Miguel Garcia'),
(74,'BSA','3rd Year','1st Semester','A302','Administration',3,'1:00 PM - 3:30 PM','Mon/Wed','A401','Miguel Garcia'),
(75,'BSA','3rd Year','2nd Semester','A303','Administration',3,'3:30 PM - 5:30 PM','Mon/Wed','A402','May Santiago'),
(76,'BSA','3rd Year','2nd Semester','A304','Administration',3,'12:30 AM - 3:30 PM','Fri','A402','John Lloyd Cruz'),
(77,'BSA','4th Year','1st Semester','A401','Administration',3,'1:00 PM - 3:30 PM','Tue/Thu','A401','Juan Rivera'),
(78,'BSA','4th Year','1st Semester','A402','Administration',3,'8:00 AM - 10:30 AM','Mon/Wed','A401','Ai Ai Delas Alas'),
(79,'BSA','4th Year','2nd Semester','A403','Administration',3,'8:00 AM - 10:30 AM','Mon/Wed','A402','Miguel Garcia'),
(80,'BSA','4th Year','2nd Semester','A404','Administration',3,'8:00 AM - 10:30 AM','Tue/Thu','A402','Noynoy Aquino'),
(81,'BSE','1st Year','1st Semester','SE101','Secondary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','B301','Juan Rivera'),
(82,'BSE','1st Year','1st Semester','SE102','Secondary Education',3,'10:00 AM - 12:30 PM','Tue/Thu','B301','Miguel Garcia'),
(83,'BSE','1st Year','2nd Semester','SE103','Secondary Education',3,'10:00 AM - 12:30 PM','Mon/Wed','B302','Miguel Garcia'),
(84,'BSE','1st Year','2nd Semester','SE104','Secondary Education',3,'1:00 PM - 3:00 PM','Tue/Thu','B302','Sushi Boado'),
(85,'BSE','2nd Year','1st Semester','SE101','Secondary Education',3,'10:30 AM - 1:00 PM','Mon/Wed','B301','Noynoy Aquino'),
(86,'BSE','2nd Year','1st Semester','SE102','Secondary Education',3,'7:30 AM - 10:00 AM','Tue/Thu','B301','Jeffrey Langan'),
(87,'BSE','2nd Year','2nd Semester','SE103','Secondary Education',3,'7:30 AM - 10:00 AM','Mon/Wed','B302','May Santiago'),
(88,'BSE','2nd Year','2nd Semester','SE104','Secondary Education',3,'1:00 AM - 3:30 AM','Tue/Thu','B302','Mark Heras'),
(89,'BSE','3rd Year','1st Semester','SE101','Secondary Education',3,'7:30 AM - 12:00 PM','Fri','B401','Miguel Garcia'),
(90,'BSE','3rd Year','1st Semester','SE102','Secondary Education',3,'1:00 PM - 3:30 PM','Mon/Wed','B401','Miguel Garcia'),
(91,'BSE','3rd Year','2nd Semester','SE103','Secondary Education',3,'3:30 PM - 5:30 PM','Mon/Wed','B402','May Santiago'),
(92,'BSE','3rd Year','2nd Semester','SE104','Secondary Education',3,'12:30 AM - 3:30 PM','Fri','B402','John Lloyd Cruz'),
(93,'BSE','4th Year','1st Semester','SE101','Secondary Education',3,'1:00 PM - 3:30 PM','Tue/Thu','B401','Juan Rivera'),
(94,'BSE','4th Year','1st Semester','SE102','Secondary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','B401','Ai Ai Delas Alas'),
(95,'BSE','4th Year','2nd Semester','SE103','Secondary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','B402','Miguel Garcia'),
(96,'BSE','4th Year','2nd Semester','SE104','Secondary Education',3,'8:00 AM - 10:30 AM','Tue/Thu','B402','Noynoy Aquino'),
(97,'BEE','1st Year','1st Semester','EE101','Elementary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','C301','Juan Rivera'),
(98,'BEE','1st Year','1st Semester','EE102','Elementary Education',3,'10:00 AM - 12:30 PM','Tue/Thu','C301','Miguel Garcia'),
(99,'BEE','1st Year','2nd Semester','EE103','Elementary Education',3,'10:00 AM - 12:30 PM','Mon/Wed','C302','Miguel Garcia'),
(100,'BEE','1st Year','2nd Semester','EE104','Elementary Education',3,'1:00 PM - 3:00 PM','Tue/Thu','C302','Sushi Boado'),
(101,'BEE','2nd Year','1st Semester','EE101','Elementary Education',3,'10:30 AM - 1:00 PM','Mon/Wed','C301','Noynoy Aquino'),
(102,'BEE','2nd Year','1st Semester','EE102','Elementary Education',3,'7:30 AM - 10:00 AM','Tue/Thu','C301','Jeffrey Langan'),
(103,'BEE','2nd Year','2nd Semester','EE103','Elementary Education',3,'7:30 AM - 10:00 AM','Mon/Wed','C302','May Santiago'),
(104,'BEE','2nd Year','2nd Semester','EE104','Elementary Education',3,'1:00 AM - 3:30 AM','Tue/Thu','C302','Mark Heras'),
(105,'BEE','3rd Year','1st Semester','EE101','Elementary Education',3,'7:30 AM - 12:00 PM','Fri','C401','Miguel Garcia'),
(106,'BEE','3rd Year','1st Semester','EE102','Elementary Education',3,'1:00 PM - 3:30 PM','Mon/Wed','C401','Miguel Garcia'),
(107,'BEE','3rd Year','2nd Semester','EE103','Elementary Education',3,'3:30 PM - 5:30 PM','Mon/Wed','C402','May Santiago'),
(108,'BEE','3rd Year','2nd Semester','EE104','Elementary Education',3,'12:30 AM - 3:30 PM','Fri','C402','John Lloyd Cruz'),
(109,'BEE','4th Year','1st Semester','EE101','Elementary Education',3,'1:00 PM - 3:30 PM','Tue/Thu','C401','Juan Rivera'),
(110,'BEE','4th Year','1st Semester','EE102','Elementary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','C401','Ai Ai Delas Alas'),
(111,'BEE','4th Year','2nd Semester','EE103','Elementary Education',3,'8:00 AM - 10:30 AM','Mon/Wed','C402','Miguel Garcia'),
(112,'BEE','4th Year','2nd Semester','EE104','Elementary Education',3,'8:00 AM - 10:30 AM','Tue/Thu','C402','Noynoy Aquino'),
(115,'BEE','1st Year','1st Semester','EE104','MAPEH',2,'8:00 AM - 10:30 AM','Mon/Wed','101','Noynoy Aquino'),
(116,'BSIT','1st Year','1st Semester','EE104','MAPEH',2,'8:00 AM - 10:30 AM','Mon/Wed','101','Noynoy Aquino');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Student','Admin') DEFAULT 'Student',
  `TimeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`Id`,`Fullname`,`Email`,`Password`,`Role`,`TimeCreated`) values 
(3,'System Administrator','admin@portal.com','$2y$10$LfoMk31DaxNEPX7pvGUsY.BrifSEXsfi9AYuKLEN.GYKVbPhHPtOy','Admin','2026-10-13 23:54:11'),
(4,'Grejen Hipolito','gamerplayer3729@gmail.com','$2y$10$n1Rh89Z39bQJfX3Wm7lwUOeXfTbJJbg3MtjV4DCAU4eTng1UIkDh2','Student','2026-10-13 23:55:42'),
(6,'Grejen Hipolito','mysteriousesvb952@gmail.com','$2y$10$iDSJY5OUBZOnm8LSDs1taO1yYRNqU4iRpK4W5djbSLhGls3YbjA1O','Student','2026-10-14 00:02:56'),
(7,'Bulog Kupal','bulogkupal@gmail.com','$2y$10$puZWvU6RZFZgnb7F0.JPiuLvpyElyR5wbjjdqYmwz5ySvULhwgigm','Student','2026-10-14 12:19:20'),
(8,'Grejen Hipolito','grejen@gmail.com','$2y$10$Z/71ydKSaTSxw67Z30M30evsKC1FxzsWiQGWUAEJ2b9Q.EWaVDTVi','Student','2026-10-14 12:54:30'),
(9,'Elykha Balagot','elyvb@gmail.com','$2y$10$rVFX4YdRUllr.0IHaTgkBe3QjQAeSmxM9jv5TCINhF27.iHj6tFH.','Student','2026-10-14 20:14:46'),
(10,'Hash','hash@gmail.com','$2y$10$qkxTpkC8utLDPHetrv4ES.VjlKoMNqheOcE4T9K7VGsyLUhBOzN.W','Student','2026-10-14 20:59:18'),
(11,'Grejen Hipolito','frfr@gmail.com','$2y$10$12LjWso/hAFFkCJYphPgM.MzTv18CmIgbDoBjf3f2LG5r0E3WYTo2','Student','2026-10-14 21:15:19'),
(12,'Balagot','balagot@gmail.com','$2y$10$YqaCkOyN1YY8yj5nWHXTgOtnFdBz3juTPwAJO6QGPTPSudc3SgRDO','Student','2026-10-14 21:49:19'),
(13,'Grejen Hipolito','dsdasds','$2y$10$YBCMUof8sGKbfygAajk0xeDsjDeS5WyTdq532Z/9cOxh0xgpvSl0S','Student','2026-10-14 21:51:31'),
(14,'Grejen Hipolito','mysteriousesvb952','$2y$10$Y34ybUseqKTdOMmidFZWo.2X0FjYyxkOaIBNasbYd5VTqhNxwdWYa','Student','2026-10-14 21:59:35'),
(19,'Grejen Hipolito','ssagdsadsa@gmail.com','$2y$10$Ko3rZl95Sgv/4stQve.Tcu2GfailKkp9SVMF0hiVn35DEfvrNj8je','Student','2026-10-14 22:07:37'),
(20,'Grejen Hipolito','mysteriousesvb9521@gmail.com','$2y$10$R9vOmttp2jsw6TdfiMBSDOdy2Fh8yMMB0fcFG3tNbSelW3KDC7THi','Student','2026-10-14 22:08:08');
