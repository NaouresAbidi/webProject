-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2024 at 06:24 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdev_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `ID_U` int(11) NOT NULL,
  `ID_EV` int(11) NOT NULL,
  `NB_TICKETS` int(11) NOT NULL,
  `PAY_METHOD` varchar(20) NOT NULL,
  `TOTAL_PRICE` float NOT NULL,
  `CR_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_U`,`ID_EV`),
  KEY `fk_ev_b` (`ID_EV`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`ID_U`, `ID_EV`, `NB_TICKETS`, `PAY_METHOD`, `TOTAL_PRICE`, `CR_DATE`) VALUES
(4, 15, 3, 'paypal', 336.22, '2024-05-19 22:00:00'),
(32, 16, 9, 'visa', 559, '2024-05-19 22:00:00'),
(32, 17, 8, 'mastercard', 66, '2024-05-19 22:00:00'),
(32, 13, 2, 'paypal', 556, '2024-05-19 22:00:00'),
(32, 14, 6, 'mastercard', 44.77, '2024-05-19 22:00:00'),
(31, 22, 2, 'paypal', 52.5, '2024-05-21 05:48:42'),
(4, 11, 1, 'bank transfer', 21, '2024-05-21 08:01:56'),
(4, 22, 1, 'bank transfer', 26.25, '2024-05-21 17:23:16'),
(4, 16, 1, 'mastercard', 21, '2024-05-21 17:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `ID_EV` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ORG` int(11) NOT NULL,
  `NAME_EV` varchar(100) NOT NULL,
  `DATE_EV` date NOT NULL,
  `T_START` time NOT NULL,
  `T_END` time NOT NULL,
  `LOC` varchar(100) NOT NULL,
  `DESC_EV` varchar(1000) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BANNER` varchar(200) DEFAULT 'Uploads/event-default.jpg',
  `TAGS_EV` varchar(200) NOT NULL,
  `NB_PLACES` int(11) NOT NULL,
  PRIMARY KEY (`ID_EV`),
  KEY `fk_org_ev` (`ID_ORG`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID_EV`, `ID_ORG`, `NAME_EV`, `DATE_EV`, `T_START`, `T_END`, `LOC`, `DESC_EV`, `PRICE`, `BANNER`, `TAGS_EV`, `NB_PLACES`) VALUES
(11, 31, 'Exposition of Abstract Contemporary Art', '2024-09-15', '19:00:00', '22:00:00', 'The Kram Exhibition Palace', 'Lorem ipsum dolor sit amet consectetur. Blandit in est quam aliquet viverra facilisis. Vulputate dictum morbi in id blandit eu eu elit turpis. Mattis morbi risus auctor non mattis posuere diam imperdiet. ', 20, 'Uploads/Banner - Abstract Art.jpg', 'Art', 100),
(15, 31, 'Sahara Rhythms Concert', '2024-08-02', '09:00:00', '12:00:00', 'Tozeur Oasis, Tozeur', 'A unique concert set in the stunning Tozeur Oasis, showcasing traditional Tunisian music blended with modern rhythms. The event will feature local musicians and dancers.', 40, 'Uploads/Banner - Abstract Art Small.png', 'Concert|Music', 100),
(16, 31, 'Tunisian Food Festival', '2024-04-03', '09:00:00', '14:00:00', 'Parc du Belvédère, Tunis', 'A three-day celebration of Tunisian cuisine featuring food stalls, cooking demonstrations, and tasting sessions. Visitors can enjoy traditional dishes like couscous, brik, and harissa, as well as modern interpretations of classic recipes.', 20, 'Uploads/street_food.jpg', 'Food|Festival', 10),
(17, 31, 'Laico Tech Summit', '2024-05-30', '10:00:00', '15:00:00', 'Laico Hotel, Tunis', 'A premier event bringing together tech enthusiasts, entrepreneurs, and industry leaders to discuss the latest trends in technology, including AI, blockchain, and cybersecurity. The summit features keynote speeches, panel discussions, and networking opportunities.', 200, 'Uploads/event-default.jpg', 'Tech', 5),
(13, 31, 'Tunis Jazz Festival', '2024-06-04', '17:00:00', '20:00:00', 'Municipal Theatre of Tunis, Tunis', 'Enjoy an evening of soulful jazz performances by renowned local and international artists. The festival promises an eclectic mix of traditional and contemporary jazz.', 30, 'Uploads/Jazz_Festival.png', 'Festival|Music', 55),
(14, 1, 'Beach Volleyball Championship', '2024-05-30', '09:00:00', '17:00:00', 'La Marsa Beach, La Marsa', 'Watch top teams compete in the exciting Beach Volleyball Championship. Enjoy a day of sports, sun, and sea at La Marsa Beach.', 12, 'Uploads/Beach_Volleyball.jpg', 'Sport', 30),
(18, 31, 'Amazigh Cultural Festival', '2024-09-13', '14:00:00', '19:00:00', 'Matmata, Gabès', 'Celebrate the rich heritage of the Amazigh people with traditional music, dance, crafts, and storytelling. Experience authentic Amazigh cuisine and participate in cultural workshops.', 10, 'Uploads/event-default.jpg', 'Festival|Ethnic', 10),
(19, 31, 'Amazigh Cultural Festival', '2024-09-13', '14:00:00', '19:00:00', 'Matmata, Gabès', 'Celebrate the rich heritage of the Amazigh people with traditional music, dance, crafts, and storytelling. Experience authentic Amazigh cuisine and participate in cultural workshops.', 10, 'Uploads/event-default.jpg', 'Festival|Ethnic', 10),
(20, 31, 'Amazigh Cultural Festival', '2024-09-13', '14:00:00', '19:00:00', 'Matmata, Gabès', 'Celebrate the rich heritage of the Amazigh people with traditional music, dance, crafts, and storytelling. Experience authentic Amazigh cuisine and participate in cultural workshops.', 10, 'Uploads/event-default.jpg', 'Festival|Ethnic', 10),
(21, 31, 'North Africa Startup Summit', '2024-10-23', '09:00:00', '18:00:00', 'Kram Exhibition Center, Tunis', 'Tunisia\'s largest technology exhibition, showcasing the latest in tech innovation, from AI and robotics to consumer electronics. Attend keynote speeches, panel discussions, and hands-on workshops with industry leaders.', 100, 'Uploads/event-default.jpg', 'Tech|Exposition', 20),
(22, 31, 'Carthage Sculpture Expo', '2024-03-06', '11:00:00', '16:00:00', 'Carthage Archaeological Site, Carthage', 'A week-long exhibition of stunning sculptures by renowned and emerging Tunisian artists, set against the backdrop of ancient Carthage. Guided tours and artist talks are part of the event.', 25, 'Uploads/event-default.jpg', 'Exposition|Art', 12),
(23, 31, 'Sahara Desert Rally', '2024-09-18', '00:00:00', '00:00:00', 'Starting in Douz and ending in Ksar Ghilane', 'An exhilarating multi-day off-road rally through the Tunisian Sahara, featuring cars, bikes, and quads. Spectators can enjoy various vantage points and participate in related festivities at each checkpoint.', 300, 'Uploads/event-default.jpg', 'Sport', 20),
(24, 31, 'Electronic Nights', '2024-03-11', '20:00:00', '23:00:00', 'Acropolium of Carthage, Tunis', 'A night event dedicated to electronic music, featuring performances by top local and international DJs, immersive light shows, and a unique historic venue.', 60, 'Uploads/event-default.jpg', 'Music|Concert', 50),
(25, 31, 'test name', '2024-09-15', '19:00:00', '22:00:00', 'locT', 'Lorem ipsum dolor sit amet consectetur...', 20, 'uploads/event-default.jpg', '', 100),
(26, 31, 'test name', '2024-09-15', '19:00:00', '22:00:00', 'locT', 'Lorem ipsum dolor sit amet consectetur...', 20, 'uploads/event-default.jpg', '', 100),
(27, 31, 'test name', '2024-09-15', '19:00:00', '22:00:00', 'locT', 'Lorem ipsum dolor sit amet consectetur...', 20, 'uploads/event-default.jpg', '', 100),
(28, 31, 'test name', '2024-09-15', '19:00:00', '22:00:00', 'locT', 'Lorem ipsum dolor sit amet consectetur...', 20, 'uploads/Jazz_Festival.png', '', 100);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `dateT` varchar(50) NOT NULL,
  `tempsT` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `nom`, `dateT`, `tempsT`, `prix`) VALUES
(1, 'Chaima', '10/15', '20:00', 5),
(2, 'Exposition', 'test', 'test', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_U` int(11) NOT NULL AUTO_INCREMENT,
  `FIRSTNAME_U` varchar(50) NOT NULL,
  `LASTNAME_U` varchar(50) NOT NULL,
  `TEL_U` int(8) NOT NULL,
  `EMAIL_U` varchar(100) NOT NULL,
  `PASS_U` varchar(100) NOT NULL,
  `BIRTHDAY` date DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `PFP_U` varchar(200) DEFAULT 'Uploads/Blank profile picture.png',
  `USER_TYPE` varchar(250) DEFAULT NULL,
  `Status` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID_U`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_U`, `FIRSTNAME_U`, `LASTNAME_U`, `TEL_U`, `EMAIL_U`, `PASS_U`, `BIRTHDAY`, `ADDRESS`, `PFP_U`, `USER_TYPE`, `Status`) VALUES
(3, 'nawres', 'ayadi', 20669778, 'nawressayadi1@gmail.com', '$2y$10$xvdK2yqFhT/SUf3hBtRU8eL..O.YcpT8ZpPJYChcmLv8SLAO8Nw.m', NULL, NULL, 'Uploads/Blank profile picture.png', 'organizer', 'verified'),
(4, 'noura', 'ayadii', 11148669, 'nourmohamed1@gmail.com', '$2y$10$nVaNr3f1.CVR.sAbyF9IZOBZXNW42ClfFD8Tar.E96HycesshhpuG', '2002-05-22', '', 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(5, 'adem', 'zaier', 5589964, 'ademzaier1@hotmail.com', '$2y$10$EXl/UJMelW4LKivJ6gE4Y.6weNYvjABcekHChSexs1oJHJk6U81Vm', NULL, NULL, 'Uploads/Blank profile picture.png', 'organizer', 'verified'),
(6, 'como', 'estas', 669988759, 'comoestas1@gmail.ca', '$2y$10$8bngYnsTUX5YG.ZHKIp1T.xCTUMQRCjcDfQgH2L/CTBkMgpipGYoG', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(7, 'jodi', 'joda', 88796645, 'jodijoda@hotmail.ca', '$2y$10$02qPfKW2KxdyFbfn5jxKieC3yUlbaqB3BFRI7rJkRhu35sirAKnGy', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(8, 'hola', 'como', 2147483647, 'holacomo1122@hotmail.ca', '$2y$10$WZDoZrSwwuY5UNEA3sJ6r./HPqpYaC6f3p.4ISu1uqpjHvG3n0zgS', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(9, 'zaineb', 'khdhiri', 55668899, 'zainebkhdhiri@hotmail.ca', '$2y$10$56sfYrlVKI1OC03zhVJ/cuUCySIz12qXUnUf/PnpSIhn0AI19DPvS', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(11, 'hgshfdgfqsdg', 'sdgqdwh', 88966565, 'nawnaw0@hotmail.ca', '$2y$10$AdsA7n1fTwPLfnZtMJszrOAdax/24j8qbZKdwaGJrtTQ3FNe0ld/i', NULL, NULL, 'Uploads/Blank profile picture.png', 'organizer', 'verified'),
(12, 'uu', 'ii', 23, 'a@b.c', '$2y$10$EpxH/5dxFeLqhbIQJpuf/ew5LKDPabqMdY30mKfNbJ5Wy6uu0Fek6', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(13, 'naw', 'aaa', 123123, 'aaaa@b.com', '$2y$10$OT5uG7aRzFYG4GNYOMMwyO7agG.h5rj.ss1FFEmwB5lVcgVusIM4a', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(14, 'adam', 'fuuuuu', 223366995, 'a88@f.ca', '$2y$10$0QlWcd0nlDABVTpEDcDMHef9H3PSMjwMyId4.3CX6iSqa/2z6rz4C', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(15, 'e', 'o', 11, 'eo@a.p', '$2y$10$I91y72sdIP3GUEKhzxUafehAfoU4hTobbxcJrP2dqRxz44ows09Ja', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(16, 'a', 'a', 5588996, 'a.a@b.c', '$2y$10$J9cNEc/bYcyVet8JgrizROSHvK6WJnAEGVHDws4977gNi1iJXSzDe', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(17, 'am', 'a', 5588996, 'a.am@b.c', '$2y$10$IJq4m3wO25ALjm5xLx2eD.zcok23G0ufAO.t.JdLytrbDZKDsrEpW', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(18, 'am', 'a', 5588996, 'a.amb@b.c', '$2y$10$y1XK29j2a3eWXz8UOOggkeWWYdOGdo1Ko4FrJACVOmovTo0d4z0Fu', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(19, 'am', 'a', 5588996, 'a.abb@b.c', '$2y$10$v0Z5EOYubWvLk/LZ8mlcauAnqejKYOwf5jQrmps7/a0xSv.6eZIoa', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(20, 'am', 'a', 5588996, 'a.abbaa@b.c', '$2y$10$PKpuuwYOXL.zd/DIWjfuEe2b7zPg6cDqSIUSyIsv70uMGooQ3XxFa', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(21, 'am', 'a', 5588996, 'a.abbazza@b.c', '$2y$10$gCMHGRIDP.8pwznKryqTeOsu4a8IE2P.2VTDJBCfLtvq8C9zrHfRy', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(22, 'am', 'a', 5588996, 'a.abbazzzza@b.c', '$2y$10$18lK7WQ2qQgv.QfIFW9HYOgo.B6mHY91e6S1eN1ZPoMnVwn8sdHhy', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(23, 'am', 'a', 5588996, 'a.abbazzzzaa@b.c', '$2y$10$v5VYF8SWj44xdWHM2YDVTuNiKT8R7Zmh2XRR4VzskVw8dv5NCPf02', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(24, 'am', 'a', 5588996, 'a.abbazzaa@b.c', '$2y$10$DCZDGm0yUNgVER.EHOc42O35vyPya.LpsVyLwWbnv2Jso8omwFGsG', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(25, 'am', 'a', 5588996, 'a.abbazazaa@b.c', '$2y$10$a4epIS43wT8iBAL1wkAmsOv1tGrM9399cOHD6jcji3iAHNtnCKWoy', NULL, NULL, 'Uploads/Blank profile picture.png', 'simpleUser', NULL),
(28, 'Organizer 1', 'orga', 123123123, 'nawressabidi2@gmail.com', '$2y$10$9AE5TRp.683syBSfXv/hJ.qiCmkZViCkPjzQdAy0WXVcdl475TIpO', NULL, NULL, 'Uploads/Blank profile picture.png', 'organizer', 'verified'),
(27, 'Site', 'Admin', 23123330, 'nawressabidi3@gmail.com', '$2y$10$iERVHM/izVTNROiqPqFKBOX/lJZJqonNcUbqFZI6.ybbuPC4.8K7S', NULL, NULL, 'Uploads/Blank profile picture.png', 'admin', NULL),
(30, 'organizer 2', 'orga', 2147483647, 'organizer.2@hotmail.ca', '$2y$10$QbvzYfTHsDYXzbqKN3AOLeA8wxgSDltjBh3ez308.k0xUPm4GK/Gm', NULL, NULL, 'Uploads/Blank profile picture.png', 'organizer', ''),
(31, 'Chaima', 'Jerbi', 54741254, 'chaima.jerbi2@gmail.com', '$2y$10$2rSaL6fe6aSOhlNTfDXOi.vHaQ648OQiIrewNplqK8WJRtR7EEFBS', NULL, NULL, 'Uploads/pfpcat.jpg', 'organizer', 'verified');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
