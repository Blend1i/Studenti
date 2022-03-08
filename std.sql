-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2022 at 04:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user` (IN `p_user` VARCHAR(150))  SELECT * FROM users WHERE users.username=p_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `p_username` VARCHAR(100), IN `p_password` VARCHAR(100))  SELECT users.id_user FROM users WHERE users.username=p_username AND users.password=p_password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_faculty` ()  SELECT * FROM faculties$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_gender` ()  SELECT * FROM genders$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `students_select_filter` (IN `p_name` VARCHAR(150), IN `p_lastname` VARCHAR(150), IN `p_id_gender` INT(11), IN `p_id_faculty` INT(11), IN `p_academic_year` INT(11))  SELECT students.id_student,students.name,students.lastname, students.birthday,
students.academic_year,faculties.faculty,genders.gender FROM students
LEFT JOIN faculties
ON students.id_faculty=faculties.id_faculty
LEFT JOIN genders
ON students.id_gender=genders.id_gender WHERE  students.name LIKE CONCAT('%',p_name,'%') OR students.lastname LIKE CONCAT('%',p_lastname,'%') AND faculties.faculty LIKE CONCAT('%',p_id_faculty,'%') AND genders.gender LIKE CONCAT('%',p_id_gender,'%') AND students.academic_year LIKE CONCAT('%',p_academic_year,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_add` (IN `p_name` VARCHAR(150), IN `p_lastname` VARCHAR(150), IN `p_birthday` DATE, IN `p_id_gender` INT(11), IN `p_id_faculty` INT(11), IN `p_academic_year` INT(11))  INSERT INTO students(name,lastname,birthday,id_gender,id_faculty,academic_year) VALUES(p_name,p_lastname,p_birthday,p_id_gender,p_id_faculty,p_academic_year)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_delete` (IN `id_student` INT(11))  DELETE FROM students WHERE students.id_student=id_student$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_search_NameSurname` (IN `p_term` VARCHAR(150))  SELECT students.id_student,students.name,students.lastname, students.birthday,
students.academic_year,faculties.faculty,genders.gender FROM students
LEFT JOIN faculties
ON students.id_faculty=faculties.id_faculty
LEFT JOIN genders
ON students.id_gender=genders.id_gender WHERE  students.name LIKE CONCAT('%',p_term,'%') OR students.lastname LIKE CONCAT('%',p_term,'%') OR faculties.faculty LIKE CONCAT('%',p_term,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_select` ()  SELECT students.id_student,students.name,students.lastname, students.birthday,
students.academic_year,faculties.faculty,genders.gender FROM students
LEFT JOIN faculties
ON students.id_faculty=faculties.id_faculty
LEFT JOIN genders
ON students.id_gender=genders.id_gender ORDER BY students.id_student DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_selectById` (IN `p_id_student` INT(11))  SELECT students.id_student,students.name,students.lastname, students.birthday,students.id_gender,students.id_faculty,
students.academic_year,faculties.faculty,genders.gender FROM students
LEFT JOIN faculties
ON students.id_faculty=faculties.id_faculty
LEFT JOIN genders
ON students.id_gender=genders.id_gender WHERE 
students.id_student=p_id_student$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_select_term` (IN `p_term` VARCHAR(100))  SELECT students.id_student,students.name,students.lastname, students.birthday,
students.academic_year,faculties.faculty,genders.gender FROM students
LEFT JOIN faculties
ON students.id_faculty=faculties.id_faculty
LEFT JOIN genders
ON students.id_gender=genders.id_gender WHERE  students.name LIKE CONCAT('%',p_term,'%') OR students.lastname LIKE CONCAT('%',p_term,'%') OR faculties.faculty LIKE CONCAT('%',p_term,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_update` (IN `p_name` VARCHAR(150), IN `p_lastname` VARCHAR(150), IN `p_birthday` DATE, IN `p_id_gender` INT(11), IN `p_id_faculty` INT(11), IN `p_academic_year` INT(11), IN `p_id_student` INT(11))  UPDATE students SET students.name=p_name, students.lastname = p_lastname, students.birthday=p_birthday, students.id_gender=p_id_gender, students.id_faculty=p_id_faculty, students.academic_year=p_academic_year WHERE students.id_student=p_id_student$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id_faculty` int(11) NOT NULL,
  `faculty` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id_faculty`, `faculty`) VALUES
(1, 'Fakulteti i Shkencave Kompjuterike'),
(2, 'Fakulteti i Edukimit'),
(3, 'Fakulteti Juridik'),
(4, 'Fakulteti i Edukimit - Parafillor');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id_gender` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id_gender`, `gender`) VALUES
(1, 'Mashkull'),
(2, 'Femer');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_student` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `academic_year` int(11) NOT NULL,
  `id_gender` int(11) NOT NULL,
  `id_faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_student`, `name`, `lastname`, `birthday`, `academic_year`, `id_gender`, `id_faculty`) VALUES
(1, 'Blend', 'Kurti', '2000-11-10', 1, 1, 1),
(2, 'john', 'smith', '1980-01-04', 1, 1, 2),
(3, 'michael', 'wilson', '2022-03-06', 3, 1, 3),
(4, 'Elizabeth', 'Smith', '2022-03-30', 3, 2, 4),
(5, 'Lena', 'Green', '2022-03-24', 2, 2, 2),
(6, 'Aleen', 'Lee', '2022-03-17', 1, 1, 3),
(7, 'Lucy', 'White', '2022-03-19', 2, 2, 1),
(8, 'Obmar', 'Wood', '2022-03-17', 2, 1, 2),
(9, 'Helen', 'Emmert', '2022-03-06', 3, 2, 1),
(10, 'Gary', 'Cole', '2022-03-11', 2, 1, 2),
(11, 'Robert', 'Hall', '2022-03-13', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id_faculty`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `FK_Faculty` (`id_faculty`),
  ADD KEY `FK_Gender` (`id_gender`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id_faculty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_Faculty` FOREIGN KEY (`id_faculty`) REFERENCES `faculties` (`id_faculty`),
  ADD CONSTRAINT `FK_PersonOrder` FOREIGN KEY (`id_gender`) REFERENCES `genders` (`id_gender`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
