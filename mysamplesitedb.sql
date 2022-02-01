-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 01 Φεβ 2022 στις 18:30:21
-- Έκδοση διακομιστή: 5.6.17
-- Έκδοση PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `mysamplesitedb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `user_id` int(10) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_semester` int(10) DEFAULT NULL,
  `ects` int(10) DEFAULT NULL,
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`course_id`),
  KEY `id_foititi` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Άδειασμα δεδομένων του πίνακα `courses`
--

INSERT INTO `courses` (`user_id`, `title`, `type`, `description`, `course_semester`, `ects`, `course_id`) VALUES
(52, 'Δίκτυα', 'Elective', '', 3, 5, 4),
(52, 'Ηλεκτρονική διακυβέρνηση', 'Elective', '', 3, 5, 5),
(52, 'Μεθοδολογία Έρευνας &σχεδιασμός μεταπτυχιακής εργασίας', 'Required', '', 1, 5, 6),
(64, 'Στρατηγική Διοίκηση Οργανισμών &Ψηφιακή Καινοτομία', 'Required', '', 1, 5, 7),
(65, 'Τεχνολογίες Προγραμματισμού & εφαρμογές στην Διοίκηση', 'Required', '', 1, 5, 8),
(66, 'Ψηφιακό μάρκετινγκ &social media', 'Required', '', 2, 5, 9),
(67, 'Δικτυακή και Ψηφιακή οικονομία', 'Required', '', 2, 5, 10),
(68, 'Συμπεριφορά Ψηφιακού καταναλωτή', 'Required', '', 2, 5, 11),
(69, 'Μεταπτυχιακή Διπλωματική Εργασία', 'Required', '', 3, 5, 12),
(83, 'Ψηφιακή διακυβέρνηση & διαλειτουργικότητα', 'Required', '', 3, 5, 13);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `enrollments`
--

CREATE TABLE IF NOT EXISTS `enrollments` (
  `user_id` int(10) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `grade` int(10) DEFAULT NULL,
  `enrollment_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`enrollment_id`),
  KEY `id_mathimatos` (`course_id`),
  KEY `id_xristi` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `enrollments`
--

INSERT INTO `enrollments` (`user_id`, `course_id`, `state`, `grade`, `enrollment_id`) VALUES
(88, 4, '0', 6, 13),
(88, 13, '0', 0, 14),
(88, 12, '0', 7, 15),
(88, 5, '0', 0, 16),
(88, 7, '0', 8, 17),
(88, 8, '0', 9, 18),
(89, 5, '0', 6, 19),
(89, 13, '0', 6, 20),
(89, 12, '0', 9, 21),
(89, 9, '0', 8, 22),
(89, 6, '0', 9, 23),
(88, 6, '0', 7, 24),
(88, 9, '0', 7, 25),
(88, 10, '0', 7, 26),
(88, 11, '0', 8, 27),
(91, 6, '0', 7, 28),
(90, 6, '0', 8, 29),
(90, 7, '0', 7, 30),
(90, 8, '0', 9, 31),
(90, 9, '0', 8, 32),
(90, 10, '0', 6, 33),
(90, 11, '1', 4, 34),
(91, 7, '0', 8, 35),
(91, 8, '0', 7, 36),
(93, 6, '0', 7, 37),
(93, 7, '1', 4, 38),
(93, 8, '0', 8, 39),
(94, 6, '0', 6, 40),
(94, 7, '0', 9, 41),
(94, 8, '0', 7, 42),
(94, 9, '0', 7, 43),
(95, 6, '0', 9, 44),
(95, 7, '0', 7, 45),
(95, 8, '0', 7, 46),
(96, 6, '0', 4, 47),
(96, 7, '0', 6, 48),
(97, 6, '0', 8, 49),
(97, 7, '0', 6, 50),
(97, 8, '0', 7, 51),
(97, 9, '0', 7, 52),
(97, 10, '1', 4, 53),
(98, 6, '0', 6, 54),
(98, 7, '0', 8, 55),
(98, 8, '0', 7, 56),
(98, 9, '0', 6, 57),
(98, 10, '0', 5, 58),
(98, 11, '0', 8, 59),
(98, 12, '0', 8, 60),
(98, 13, '0', 8, 61),
(98, 4, '0', 7, 62),
(99, 6, '0', 5, 63),
(99, 7, '0', 7, 64),
(99, 8, '0', 7, 65),
(99, 9, '0', 6, 66),
(99, 10, '1', 4, 67),
(99, 11, '0', 6, 68),
(99, 12, '0', 7, 69),
(99, 13, '0', 7, 70),
(99, 5, '0', 8, 71),
(100, 6, '0', 9, 72),
(100, 7, '0', 8, 73),
(100, 8, '0', 8, 74),
(100, 9, '0', 8, 75),
(100, 10, '0', 7, 76),
(100, 11, '0', 7, 77),
(89, 7, '0', 8, 78),
(89, 8, '0', 8, 79),
(89, 10, '0', 7, 80),
(89, 11, '0', 9, 81);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `user_id` int(10) DEFAULT NULL,
  `sem_no` int(10) DEFAULT NULL,
  `sem_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sem_id`),
  KEY `id_xristi_foititi` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `semester`
--

INSERT INTO `semester` (`user_id`, `sem_no`, `sem_id`) VALUES
(104, 3, 0),
(88, 3, 38),
(89, 3, 39),
(90, 2, 40),
(91, 1, 41),
(93, 1, 43),
(94, 2, 44),
(95, 1, 45),
(96, 1, 46),
(97, 2, 47),
(98, 3, 48),
(99, 3, 49),
(100, 2, 50);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `reg_num` int(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`name`, `surname`, `email`, `password`, `role`, `phone`, `address`, `birthdate`, `reg_date`, `reg_num`, `user_id`) VALUES
('George', 'Papas', 'qwerty@mps.gr', '12345678', 'Administration', 0, '', '0000-00-00', '0000-00-00', 0, 1),
('John', 'Doe', 'std000@ac.eap.gr', '12345678', 'Professor', 2147483647, 'Γούναρη 5', '1980-01-05', '0000-00-00', 0, 52),
('Helen', 'Jackson', 'std111@ac.eap.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 55),
('Bill', 'Johnson', 'bb@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 61),
('Jim', 'Evans', 'dhmpap@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 64),
('Gus', 'Giotis', 'giot@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 65),
('Peter', 'Peters', 'petr@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 66),
('Nick', 'Nickolson', 'nik@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 67),
('Hilda', 'Cane', 'elen@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 68),
('Anna', 'Anderson', 'anna@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 69),
('Christine', 'Geller', 'xr@mps.gr', '12345678', 'Professor', 0, '', '0000-00-00', '0000-00-00', 0, 83),
('Sofia', 'Kyriazi', 'std107956@ac.eap.gr', '12345678', 'Student', 2147483647, 'Πόντου 38', '1985-05-29', '0000-00-00', 0, 88),
('Lin', 'Gates', 'std333@ac.eap.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 89),
('Steven', 'Kings', 'pet@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 90),
('Constantine', 'Peters', 'konp@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 91),
('Georgia', 'Trump', 'std123@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 93),
('Paul', 'Peterson', 'std444@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 94),
('Phoibe', 'Manson', 'std456@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 95),
('Criss', 'Anders', 'std789@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 96),
('Andrew', 'Lester', 'std147@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 97),
('George', 'Perry', 'std258@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 98),
('Metthew', 'Blanc', 'std369@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 99),
('Maria', 'Carter', 'std159@mps.gr', '12345678', 'Student', 0, '', '0000-00-00', '0000-00-00', 0, 100),
('So', 'Ki', 'mymail@mail.com', '12345678', 'Student', NULL, NULL, NULL, NULL, NULL, 104),
('Ag', 'Ma', 'agma@mail.com', '12345678', 'Student', NULL, NULL, NULL, NULL, NULL, 105);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
