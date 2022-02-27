-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2022 at 04:00 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elderlyhomesclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_email` varchar(100) NOT NULL,
  `login_pw` varchar(100) DEFAULT NULL,
  `login_position` varchar(50) DEFAULT 'user',
  PRIMARY KEY (`login_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_email`, `login_pw`, `login_position`) VALUES
('annie@gmail.com', 'asdfasdf', 'user'),
('bbyan@gmail.com', 'bbyan123', 'user'),
('charles@gmail.com', 'asdfasdf', 'user'),
('chuah@gmail.com', 'chuah123', 'staff'),
('david@gmail.com', 'asdfasdf', 'user'),
('hongwei@gmail.com', 'hongwei123', 'staff'),
('james@gmail.com', 'asdfasdf', 'user'),
('jason@gmail.com', 'jason123', 'user'),
('john@gmail.com', 'asdfasdf', 'user'),
('joseph@gmail.com', 'asdfasdf', 'user'),
('junming@gmail.com', 'junming123', 'staff'),
('kudoshi@gmail.com', 'kudoshi123', 'user'),
('madara@gmail.com', 'asdfasdf', 'user'),
('michaelchong@gmail.com', 'michael123', 'user'),
('micheall@gmail.com', 'asdfasdf', 'user'),
('richard@gmail.com', 'asdfasdf', 'user'),
('robert@gmail.com', 'asdfasdf', 'user'),
('senju@gmail.com', 'asdfasdf', 'user'),
('tanchanyong@gmail.com', 'carlton123', 'user'),
('thomas@gmail.com', 'asdfasdf', 'user'),
('userchuah@gmail.com', 'chuah123', 'user'),
('userhongwei@gmail.com', 'hongwei123', 'user'),
('userjunming@gmail.com', 'junming123', 'user'),
('william@gmail.com', 'asdfasdf', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

DROP TABLE IF EXISTS `shelter`;
CREATE TABLE IF NOT EXISTS `shelter` (
  `shelter_id` int NOT NULL AUTO_INCREMENT,
  `shelter_name` varchar(100) NOT NULL,
  `shelter_description` text NOT NULL,
  `shelter_thumbnail` text NOT NULL,
  `shelter_street` varchar(255) NOT NULL,
  `shelter_postcode` int NOT NULL,
  `shelter_city` varchar(100) NOT NULL,
  `shelter_state` varchar(50) NOT NULL,
  `shelter_email` varchar(100) NOT NULL,
  `shelter_contact` varchar(12) NOT NULL,
  `amount_of_space` int NOT NULL,
  `occupied_space` int DEFAULT NULL,
  `simage_1` text NOT NULL,
  `simage_2` text,
  `simage_3` text,
  `simage_4` text,
  `staff_id` int NOT NULL,
  PRIMARY KEY (`shelter_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`shelter_id`, `shelter_name`, `shelter_description`, `shelter_thumbnail`, `shelter_street`, `shelter_postcode`, `shelter_city`, `shelter_state`, `shelter_email`, `shelter_contact`, `amount_of_space`, `occupied_space`, `simage_1`, `simage_2`, `simage_3`, `simage_4`, `staff_id`) VALUES
(14, 'Attia Care Centre', 'Attia Nursing Care is a home for fulltime assisted living residents, offering medically skilled care in a respectful and self sustaining community. The residence is uplifting in themselves, but it is a combination of all factors  surroundings, services, care, and people  that sets them apart. Attia Nursing Cares person centred care model ensures that each resident is treated as an individual and their confidence promoted. No matter how beautiful the setting, never forget that Attia Nursing Care is a team of people caring for other people. They organize themselves around the individual needs and wishes of EACH resident. ', '90ca2d_be940ac018f44092bd06a7682175249c_mv2.png', '13, Jalan Attia 2', 55910, 'Cheras', 'KualaLumpur', 'AttiaCareCentre@gmail.com', '0122112223', 250, 5, '90ca2d_54af4dc02aed45b8b50455aabae37382_mv2.png', '90ca2d_24962148b3434b09843b39de12726c08_mv2.png', '90ca2d_f14f4e1b56354c91b8b113da728d334a_mv2.png', '90ca2d_fd8c6f0b04f04bd9901686fcc219b68c_mv2.png', 3),
(15, 'Graceland Home', 'Graceland Home is the most peaceful and mature residential area. It offers a relaxed, safe and welcoming place to live graced with fresh air and natural breeze. The home is limited to 11 twin  triple sharing bedroom residences. They also provide specialized care for Dementia Patients. It is very comfortable and warm for the elderly. This nursing home is of great quality and is considered one of the best facilities', '90ca2d_735b4037e25a4f8696acbfe7a9c8b4d2_mv2.png', '23, Jalan Grace 10', 23383, 'Balik Pulau', 'Penang', 'graceland@gmail.com', '0122112583', 500, 5, '90ca2d_8f86da9444274dc5930bab3bdaebd662_mv2.png', '90ca2d_aadd61bdcb8247dab4bb9cf2593dcf61_mv2.png', '90ca2d_c4115a6857ba4db8a2e087cd80fc5910_mv2.png', '90ca2d_f35ad26b1a184061a1bfc26ebb03be0e_mv2.png', 3),
(16, 'Lecadia', 'Lecadia PrimaCare Centre provides longterm accommodation and nursing care for the aged, senior citizens, geriatrics and in particular for those with chronic illness or disabilities. Our Nursing Home specializes in nursing care provided by qualified Staff Nurses (SRNs) and complimented by welltrained assistants.', 'bedroom-facility.jpg', '271, Jalan Lecadia 2, Taman Lecadia', 51243, 'Muar', 'Johor', 'Lecadia@gmail.com', '0182238758', 360, NULL, 'mahjong.jpg', 'physio-room.jpg', 'room1.jpg', 'tv.jpg', 3),
(18, 'My Aged Care', 'This nursing home offers sincere and compassionate care in an environment thats safe and secure. At My Aged Care, they understand the importance of fostering a family atmosphere. At the same time, they respect their residents need for solitude as well as independence.  This nursing home offer triple sharing rooms, twin sharing rooms as well as single rooms in a hotellike setting with a team of dedicated nurses and caregivers to attend to our residents. Equipped with well verse management and high standards, this nursing delivers only the best nursing care for the elderly. It is worth the price you are paying for the kind of treatment your loved ones are getting.', 'MAC-1-Pond-Grotto.png', '13, Jalan My Aged Care 1', 55210, 'Subang Jaya', 'Selangor', 'AttiaCareCentre@gmail.com', '0126112223', 213, NULL, 'nursing-home-pj-my-manor-dining-area.jpeg', 'nursing-home-pj-my-manor-garden-seating.jpeg', 'nursing-home-pj-my-manor-shared-room.jpeg', 'nursing-home-pj-my-manor-tv-are.jpeg', 3),
(19, 'ST Mary Nursing Home', 'This nursing home offers sincere and compassionate care in an environment thats safe and secure. At My Aged Care, they understand the importance of fostering a family atmosphere. At the same time, they respect their residents need for solitude as well as independence.  This nursing home offer triple sharing rooms, twin sharing rooms as well as single rooms in a hotellike setting with a team of dedicated nurses and caregivers to attend to our residents. Equipped with well verse management and high standards, this nursing delivers only the best nursing care for the elderly. It is worth the price you are paying for the kind of treatment your loved ones are getting.', '90ca2d_7a9de6ea001c41919a2ae3d551347dbd_mv2.png', '21, ST Mary Nursing Home 23', 52910, 'Alor Gajah', 'Melaka', 'STNursing@gmail.com', '0122432223', 450, NULL, '90ca2d_7a9de6ea001c41919a2ae3d551347dbd_mv2.png', '90ca2d_d9dfc8b3f146421eb01675f88b1de287_mv2 - Copy.png', '90ca2d_d32a87ccd43c4430b68c94167ed3eb4f_mv2 - Copy.png', '90ca2d_e17a7f55ba9046028374e3a32989223d_mv2.png', 3),
(20, 'Summer Breeze', 'Summer Breeze Cottage Caring Home is a nursing home ideal for seniors who are mobile and semimobile and are looking for a luxurious assisted living facility. They offer both daycare and shortterm care. The nursing home is a newly renovated, modern, upscale home with trained, inhouse staff to attend to our residents constantly.  Providing a safe, caring, 247 monitored, and mentally stimulating place for our seniors is the one thing that they achieved in doing. The home is built on a sprawling 12,000 sq. ft. property, has open concept living spaces, and a sizable backyard. The needs of the residents are always put forward and they try their best in fulfilling all their needs.', '90ca2d_a17c7e27078345718ed23c3ce87b5f24_mv2.png', '37, Jalan Summer Breeze 23', 52910, 'Seremban', 'NegeriSembilan', 'SummerBreeze@gmail.com', '0122321223', 325, NULL, '90ca2d_4d4d2c69828f44af804449486efb0117_mv2.png', '90ca2d_6a4b104b171c4c06bd8f1ae100427a6a_mv2.png', '90ca2d_6ccb3e7cf80d4ceb9dd6932abbe13dfc_mv2.png', '90ca2d_73dc2f71bdf546ac8e5d6fd45dfc6457_mv2.png', 3),
(21, 'The Senior Care', 'The Senior Care centre provide a warm and nurturing environment for the elderly to stay at. It is also near to a hospital which is very convenient in case of medical emergencies. Having great surroundings and a beautiful living space ensure that the elderly will have peace of mind and a comfortable time staying at the nursing home.', '90ca2d_e114a557a7eb442f9c1b4a8217d570b3_mv2.png', '28, The Senior Care 5, taman Senior Care', 33849, 'Taiping', 'Perak', 'TheSeniorCare@gmail.com', '0122321223', 580, NULL, '90ca2d_503e7010de1f487cbf0ca7b6d5449d70_mv2.png', '90ca2d_48502c26cde84a98844e85d8609f427f_mv2.png', '90ca2d_ab4f5cfeafa541348fb511126fe0db30_mv2.png', '90ca2d_bfeacbb81fe747fcb4232212e4c64293_mv2.png', 3),
(23, 'MintyGreen', 'This nursing home  provides a healthy and safe surrounding filled with nature and a sense of calmness. Sending your loved ones here will provide safe and sound care for which you wont have to worry.  The abundance of nature surrounding the nursing home is a form of therapeutic treatment for the elderly as it provides them with the calmness of nature making the worries of the elderly go away. On top of having very well trained nurses and caregivers, the nursing home itself is very friendly and supportive of the elderly in making them feel at home. They are also very popular among the residents.', '90ca2d_4d4d2c69828f44af804449486efb0117_mv2.png', '27, Jalan MintyGreen 23', 21382, 'Subang Jaya', 'Selangor', 'MintyGreen@gmail.com', '0127474342', 213, NULL, '90ca2d_4d4d2c69828f44af804449486efb0117_mv2.png', '90ca2d_6a4b104b171c4c06bd8f1ae100427a6a_mv2.png', '90ca2d_6ccb3e7cf80d4ceb9dd6932abbe13dfc_mv2.png', '90ca2d_73dc2f71bdf546ac8e5d6fd45dfc6457_mv2.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shelterbooking`
--

DROP TABLE IF EXISTS `shelterbooking`;
CREATE TABLE IF NOT EXISTS `shelterbooking` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `user_id` int NOT NULL,
  `shelter_id` int NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`,`shelter_id`),
  KEY `shelter_id` (`shelter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shelterbooking`
--

INSERT INTO `shelterbooking` (`booking_id`, `start_date`, `user_id`, `shelter_id`) VALUES
(32, '2022-01-20', 108, 14),
(34, '2022-01-22', 117, 14),
(35, '2022-01-22', 118, 14),
(36, '2022-01-22', 119, 14),
(37, '2022-01-22', 120, 14),
(39, '2022-01-22', 121, 15),
(40, '2022-01-22', 122, 15),
(41, '2022-01-22', 123, 15),
(42, '2022-01-22', 124, 15),
(43, '2022-01-22', 125, 15);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `staff_fname` varchar(100) NOT NULL,
  `staff_lname` varchar(100) NOT NULL,
  `staff_age` int NOT NULL,
  `staff_contact` varchar(12) NOT NULL,
  `staff_gender` varchar(6) NOT NULL,
  `staff_pp` text,
  `login_email` varchar(100) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `login_email` (`login_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_age`, `staff_contact`, `staff_gender`, `staff_pp`, `login_email`) VALUES
(1, 'Ngan', 'Jun Ming', 20, '0173217962', 'male', 'ngan.jpg', 'junming@gmail.com'),
(2, 'Chan', 'Hong Wei', 20, '0123728392', 'male', NULL, 'hongwei@gmail.com'),
(3, 'chuah', 'quang yuuee', 20, '0173829201', 'male', 'chuah.jfif', 'chuah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_dob` varchar(50) NOT NULL,
  `user_gender` varchar(6) NOT NULL,
  `contact_num` varchar(12) DEFAULT NULL,
  `emer_name` varchar(100) NOT NULL,
  `emer_rel` varchar(100) NOT NULL,
  `emer_cont` varchar(12) NOT NULL,
  `user_pp` text,
  `verification_status` varchar(20) NOT NULL DEFAULT 'unverified',
  `verification_ic` text,
  `OTP` int DEFAULT NULL,
  `secretquestion` varchar(255) DEFAULT NULL,
  `secretanswer` varchar(100) DEFAULT NULL,
  `login_email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `login_email` (`login_email`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_dob`, `user_gender`, `contact_num`, `emer_name`, `emer_rel`, `emer_cont`, `user_pp`, `verification_status`, `verification_ic`, `OTP`, `secretquestion`, `secretanswer`, `login_email`) VALUES
(106, 'User Ngan', 'Jun Ming', '2002-06-27', 'male', NULL, 'Friend', 'friend', '0128382733', NULL, 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'friend', 'userjunming@gmail.com'),
(107, 'User Chan ', 'Hong Wei', '2002-02-07', 'male', NULL, 'friend', 'friend', '0121383827', NULL, 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'friend', 'userhongwei@gmail.com'),
(108, 'user chuah', 'quang yuuee', '2002-12-23', 'male', '', 'friend', 'friend', '0128273723', 'chuah.jfif', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'friend', 'userchuah@gmail.com'),
(111, 'tan', 'carlton', '2002-03-31', 'male', '01238321273', 'hong wei', 'friend', '01238327273', 'carlton.png', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'hong wei', 'tanchanyong@gmail.com'),
(112, 'jason', 'tan', '2001-03-31', 'male', '', 'Jibson', 'family', '0123328236', 'carlton.png', 'verified', 'cross-it.jpg', NULL, 'What is your first job?', 'doctor', 'jason@gmail.com'),
(113, 'Michael', 'Chong', '2002-02-05', 'male', '', 'Jibby', 'friend', '0127372323', 'skittle.jfif', 'pending', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'handsome ming', 'michaelchong@gmail.com'),
(114, 'BB', 'Yan', '2002-02-06', 'male', '', 'michael chong', 'colleague', '0127237323', 'beluga.jpg', 'pending', 'cross-it.jpg', NULL, 'What is the favourite place that you love the most?', 'kuala lumpur', 'bbyan@gmail.com'),
(115, 'kudo', 'shi', '2002-07-07', 'male', '', 'Jason', 'colleague', '01237328375', 'kudoface.png', 'pending', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'jason', 'kudoshi@gmail.com'),
(116, 'James', 'Robert', '2002-04-10', 'male', '', 'Robert', 'friend', '01928387478', 'Color Hunt Palette 42657.png', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'Robert', 'james@gmail.com'),
(117, 'Robert', 'Gueh', '2002-03-02', 'male', '', 'James', 'friend', '0123984838', 'g4i20c8gjyw11.jpg', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'James', 'robert@gmail.com'),
(118, 'John', 'Toh', '2002-04-04', 'male', '', 'Micheal', 'friend', '01947847444', '508760.jpg', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'Micheal', 'john@gmail.com'),
(119, 'Micheal', 'Goh', '2002-02-02', 'male', NULL, 'John', 'friend', '0193784747', NULL, 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'John', 'micheall@gmail.com'),
(120, 'William', 'Tan', '2000-02-09', 'male', '', 'david', 'friend', '019238484444', 'artem-kniaz-n-K0G3ymYgc-unsplash.jpg', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'David', 'william@gmail.com'),
(121, 'David', 'Jeng', '2000-01-01', 'male', NULL, 'william', 'friend', '0192828282', NULL, 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'david', 'david@gmail.com'),
(122, 'Richard', 'no', '2002-01-14', 'male', '', 'Richard', 'family', '0129392833', '123851555_2431926107114420_2501764955147299021_n.png', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'Richard', 'richard@gmail.com'),
(123, 'Joseph', 'Gua', '2002-01-07', 'male', '', 'hongwei', 'family', '01293838383', 'chihiro045.jpg', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'i got no friend', 'joseph@gmail.com'),
(124, 'Thomas', 'dutdut', '2002-01-08', 'male', '', 'no', 'family', '01161964363', 'download.jfif', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'i got no friend as well', 'thomas@gmail.com'),
(125, 'Charles', 'Tee', '2002-01-04', 'male', '', 'mona', 'family', '01293128383', 'thumb_15ef.jpg', 'verified', 'cross-it.jpg', NULL, 'What is the name of your best friend from childhood?', 'Lim shang jin', 'charles@gmail.com'),
(126, 'Annie', 'Gueh', '2000-01-20', 'female', NULL, 'beer', 'family', '01293823838', NULL, 'unverified', NULL, NULL, 'What is the name of your best friend from childhood?', 'no', 'annie@gmail.com'),
(127, 'Madara', 'Uchiha', '1900-01-06', 'male', '', 'Hashirama', 'colleague', '0192383873', '2021-12-18T19_46_39.png', 'unverified', NULL, NULL, 'What is the name of your best friend from childhood?', 'Hashirama', 'madara@gmail.com'),
(128, 'Hashirama', 'Senju', '1900-02-02', 'male', '', 'Madara', 'colleague', '0123938383', '2021-12-09T18_05_04.png', 'unverified', NULL, NULL, 'What is the name of your best friend from childhood?', 'Madara', 'senju@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shelter`
--
ALTER TABLE `shelter`
  ADD CONSTRAINT `shelter_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `shelterbooking`
--
ALTER TABLE `shelterbooking`
  ADD CONSTRAINT `shelterbooking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `shelterbooking_ibfk_2` FOREIGN KEY (`shelter_id`) REFERENCES `shelter` (`shelter_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`login_email`) REFERENCES `login` (`login_email`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`login_email`) REFERENCES `login` (`login_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
