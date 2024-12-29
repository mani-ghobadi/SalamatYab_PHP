-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2024 at 04:28 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salamat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `may` int NOT NULL,
  `Weight` int NOT NULL,
  `Age` int NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `Bmi` float NOT NULL,
  `Blooddia` float NOT NULL,
  `Bloodsis` float NOT NULL,
  `Blood` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SugarTst` float NOT NULL,
  `Sugar` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Name`, `Email`, `Phone`, `Password`, `Gender`, `may`, `Weight`, `Age`, `ID`, `Bmi`, `Blooddia`, `Bloodsis`, `Blood`, `SugarTst`, `Sugar`) VALUES
('مریم غلام نژاد', 'maryam@gmail.com', '09363452418', '123456', 'mal', 140, 80, 38, 3, 400, 0, 0, '', 0, ''),
('حسن احمد پور', 'hasan@gmail.com', '09457653854', '1385', 'mal', 170, 110, 55, 4, 561.983, 80, 0, 'normal', 80, 'norma'),
('فاطمه محمد زاده', 'hasan@gmail.com', '09457833854', '1234567', 'fem', 135, 100, 45, 5, 34.626, 0, 0, '', 0, ''),
('هانیه کریمی', 'hanie@gmail.com', '09105764507', '1234', 'fem', 220, 120, 31, 6, 33.0491, 0, 0, '', 0, ''),
('کوروش میرزایی', 'mghm@gmail.com', '09100685155', '123456', 'mal', 175, 100, 28, 7, 26.595, 0, 80, 'down', 0, ''),
('المیرا شفیعی', 'Mdl@gmail.com', '09115674567', '45678910', 'mal', 120, 120, 35, 9, 378, 0, 0, '', 0, ''),
('مریم مالکی', 'maryam@gmail.com', '09362509053', '12345', 'fem', 155, 74, 43, 14, 25, 0, 80, 'down', 0, ''),
('مانی قبادی', 'manishabake@gmail.com', '09191652749', '12345', 'mal', 180, 90, 40, 13, 24.6914, 0, 0, '', 140, 'up'),
('کامران سهیلی', 'so@gmail.com', '09117654781', '1234', 'mal', 125, 50, 18, 18, 32, 40, 0, 'down', 120, 'up');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
