-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2025 at 12:43 PM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `villageonweb_admin_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `phone`, `address`, `pincode`, `city`, `state`) VALUES
(3, 'rajaisudhir4@gmail.com', 'ed751d903fc13f47c0104ed4f6fee916c39f7e67', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` char(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pno` varchar(15) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `pno`, `subject`, `message`, `date`) VALUES
(1, 'Amandaothelpc', 'amandaExpife3@gmail.com', '89543832475', 'Tonightâ€™s perfect for something exciting, donâ€™t you think?  âœ¨', 'Can you guess what Iâ€™m craving right now?  -  https://rb.gy/es66fc?joindy', '2025-01-18'),
(2, 'Amandastuddyb', 'amandaDentguepc@gmail.com', '89178539551', 'Iâ€™m in the mood to exploreâ€¦ just you and me  âœ¨ â¤ï¸ â¤ï¸', 'Letâ€™s make tonight unforgettableâ€¦ your place or mine?   -  https://rb.gy/es66fc?lady', '2025-01-30'),
(3, 'Amandabrudge1', 'amandaNuardyb@gmail.com', '88456954416', 'My thoughts are wild, and theyâ€™re all about youâ€¦  âœ¨', 'Iâ€™m in the mood for something sweet and spicyâ€¦ you?  -  https://rb.gy/es66fc?Intedo', '2025-01-30'),
(4, 'NoahNab', 'ibucezevuda439@gmail.com', '89858328938', 'Hallo  i wrote about     prices', 'HÃ¦, Ã©g vildi vita verÃ° Ã¾itt.', '2025-01-30'),
(5, 'Amandaalodayb', 'amandaChokBouh1@gmail.com', '87777716613', 'Canâ€™t stop imagining you next to me tonightâ€¦  â¤ï¸ âœ¨ âœ¨', 'Iâ€™ve been waiting to feel your touchâ€¦ ready? -  https://rb.gy/es66fc?Bero', '2025-02-01'),
(6, 'AmandaAPPETS3', 'amandaloonouffb@gmail.com', '89162395672', 'What if tonight we let go of all boundaries?  âœ¨ âœ¨ âœ¨', 'Just thinking about you gives me chillsâ€¦ come closer  -  https://rb.gy/es66fc?ored', '2025-02-03'),
(7, 'Amandakizhoity1', 'amandaliabuddy1@gmail.com', '85344439613', 'My thoughts are wild, and theyâ€™re all about youâ€¦  âœ¨', 'Iâ€™m in the mood for something sweet and spicyâ€¦ you?  -  https://rb.gy/es66fc?Obenug', '2025-02-08'),
(8, 'Raymondtot', 'raymondDrague@gmail.com', '85863137747', '', 'Good day! villageonweb.in \r\n \r\n \r\n  \r\n \r\n \r\n \r\nThe cost of sending one million messages is $59. \r\n \r\nThis letter is automatically generated. \r\n \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nSkype  live:contactform_18 \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693 \r\nWe only use chat for communication.', '2025-02-10'),
(9, 'Nicholas Doby', 'dobyfinancial@sendnow.win', '88616353172', 'Re: Explore Funding Opportunities', 'Greetings, Mr./Ms. \r\n \r\nIâ€™m Nicholas Doby from an investment consultancy. We connect clients globally with low or no-interest loans to help achieve your goals. Whether for personal or business/project funding, we collaborate with reputable investors to turn your proposals into reality. Share your business plan and executive summary with us at: contact@dobyfinancial.com to explore funding options. \r\n \r\nSincerely, \r\nNicholas Doby \r\nSenior Financial Consultant \r\nhttps://dobyfinancial.com', '2025-02-10'),
(10, '', 'qenlhxtu@do-not-respond.me', 'Hello', 'TestUser', 'mjkawba DHD HaB eIEk', '2025-02-11'),
(11, '', 'rlriflds@do-not-respond.me', 'TestUser', 'John', 'cOhZhCWZ GqlCk ODEd lRAEUFKk', '2025-02-12'),
(12, '', 'grubhwfb@do-not-respond.me', 'John', 'TestUser', 'NMk CUcsY Xsb rqjDiU RdmaBSK', '2025-02-12'),
(13, '', 'aebdazdw@do-not-respond.me', 'John', 'John', 'RukA vuR wrbrt hsEsU', '2025-02-13'),
(14, '', 'kfseftew@do-not-respond.me', 'TestUser', 'Hello', 'GtOmXyU vlIJC gowiiK pxSY', '2025-02-14'),
(15, '', 'gcvgklhz@do-not-respond.me', 'MyName', 'MyName', 'rCTF NgGhz FvgMxN GjQn vFj BsUUBaTu FemTz', '2025-02-15'),
(16, '', 'bcwvhzvf@do-not-respond.me', 'Hello', 'Alice', 'YkSb jbCSBR VpufxQq', '2025-02-15'),
(17, '', 'ubfqrkul@do-not-respond.me', 'John', 'John', 'Hrb iRM dYDajj VJXi ptftdjA oVN', '2025-02-15'),
(18, 'Yasuhiro Yamada', 'rohtopharmaceutical@via.tokyo.jp', '82824958794', 'Re: Remote Job Opportunity with ROHTO Pharmaceutical', 'Greetings, Mr./Ms. \r\n \r\nWith all due respect. We are looking for a Spokesperson/Financial Coordinator for ROHTO Pharmaceutical Co., Ltd. based in the USA, Canada, or Europe. This part-time role offers a minimum $5k salary and requires only a few minutes of your time daily. It will not create any conflicts if you work with other companies. If interested, please contact apply@rohtopharmaceutical.com \r\n \r\nBest regards, \r\nYasuhiro Yamada \r\nSenior Executive Officer \r\nhttps://rohtopharmaceutical.com/', '2025-02-16'),
(19, 'kaEageste', 'laviniastrutynski@gmail.com', '82928876678', 'Unlock Bitcoin Cash. $8252 Ready Now2 ', 'Unlock Bitcoin Cash. $8252 Ready Now  - https://t.me/+HkY2o13tXmtjY2My?Hotte74jeK', '2025-02-17'),
(20, '', 'lkiergwt@do-not-respond.me', 'Alice', 'Alice', 'qiDblj LcAEydlu GiMTbr', '2025-02-18'),
(21, '', 'imdnqhdn@do-not-respond.me', 'MyName', 'TestUser', 'XxYqcqY EcGCsoGs WEfofp WABE qlt VuO', '2025-02-18'),
(22, '', 'aobdfhrq@do-not-respond.me', 'Alice', 'John', 'QuMwSk JCQYca qyzGF NUHgG QEeRRFP', '2025-02-18'),
(23, '', 'wswkeaou@do-not-respond.me', 'Hello', 'John', 'AJyQINdr GGWRKh eVI yzEm', '2025-02-19'),
(24, 'MiaNab', 'ebojajuje04@gmail.com', '83484219474', 'Hi  i am writing about your   price', 'Ola, querÃ­a saber o seu prezo.', '2025-02-19'),
(25, '', 'kknwgxuw@do-not-respond.me', 'Hello', 'TestUser', 'LZSTN OEmJc ZnqG TYdQJFxt', '2025-02-19'),
(26, '', 'cdvpnqec@do-not-respond.me', 'MyName', 'MyName', 'iVkxj osjhpsy omEp yWuG', '2025-02-19'),
(27, '', 'kdyefxzm@do-not-respond.me', 'Hello', 'Alice', 'viFQ nRjAB uYq', '2025-02-19'),
(28, '', 'oqaulsrg@do-not-respond.me', 'MyName', 'MyName', 'Yju JpClN mKOIoNI kaUFJbIA Otb ccl', '2025-02-20'),
(29, '', 'jjlxznox@do-not-respond.me', 'MyName', 'John', 'JMukmGSY ScPEgaix EVfX juNpu hFi HpSY', '2025-02-20'),
(30, 'AmandaOraniric1', 'amandaAffone2@gmail.com', '87954739244', 'Iâ€™m in the mood to exploreâ€¦ just you and me  â¤ï¸ âœ¨ âœ¨', 'Iâ€™ve been waiting to feel your touchâ€¦ ready? -  https://rb.gy/es66fc?suelaype', '2025-02-20'),
(31, 'AmandaOraniric2', 'amandaAffone3@gmail.com', '87264226476', 'Canâ€™t stop imagining you next to me tonightâ€¦  âœ¨ âœ¨ âœ¨', 'Iâ€™ve been waiting to feel your touchâ€¦ ready? -  https://rb.gy/es66fc?suelaype', '2025-02-20'),
(32, '', 'ykkctzoy@do-not-respond.me', 'MyName', 'John', 'CjaZTU QUdQCMml aWsmgSgE', '2025-02-20'),
(33, '', 'prbnwfbk@do-not-respond.me', 'TestUser', 'John', 'oMVwuHUm lqwnSJnL rHzaMo', '2025-02-21'),
(34, '', 'qkoprofe@do-not-respond.me', 'TestUser', 'MyName', 'yFg tBYWJ EMD vfP bpYtRw fXeRb LPegG', '2025-02-21'),
(35, 'AmandaApoche2', 'amandaSpoolob@gmail.com', '85252225671', 'Canâ€™t stop imagining you next to me tonightâ€¦  â¤ï¸ â¤ï¸ âœ¨', 'Letâ€™s make tonight unforgettableâ€¦ your place or mine?   -  https://rb.gy/es66fc?JuraPali', '2025-02-21'),
(36, '', 'pltehjqs@do-not-respond.me', 'TestUser', 'Alice', 'GnnmHq TRo fFuGHu', '2025-02-21'),
(37, '', 'ufiaagoz@do-not-respond.me', 'John', 'MyName', 'xUdXM VWDSv ZZXfsy dNJrsxX', '2025-02-22'),
(38, '', 'xmfzcjqv@do-not-respond.me', 'Alice', 'Alice', 'dgGDK jyYOJpK LRZxiY', '2025-02-23'),
(39, 'Amandabrudgea', 'amandaNuardy3@gmail.com', '87643757211', 'I want to feel the heat between us tonight  âœ¨', 'Iâ€™m in the mood for something sweet and spicyâ€¦ you?  -  https://rb.gy/es66fc?Intedo', '2025-02-23'),
(40, '', 'bhtiljrv@do-not-respond.me', 'TestUser', 'Hello', 'hJpyAm pRIsfoba vsVeqDvz wqZm tlOdp JsHvS', '2025-02-25'),
(41, 'Amandakizhoityb', 'amandaliabuddy2@gmail.com', '88821733217', 'My thoughts are wild, and theyâ€™re all about youâ€¦  â¤ï¸', 'Letâ€™s see how far we can take this tonight  -  https://rb.gy/es66fc?Obenug', '2025-02-26'),
(42, 'Jennifer Newman', 'jennifer@grandeurgreencrew.com', '7048101127', 'Re: Your Janitorial Quote', 'We are local and wanted to say thank you for your contribution to our community. If it might be helpful to you, we are offering a complimentary cleaning quote and site visit for you. \r\n\r\nWould you like an updated professional cleaning quote?\r\n\r\nRegards,\r\n\r\nJennifer Newman\r\nSales Representative\r\nGrandeur Green Crew\r\njennifer@grandeurgreencrew.com\r\n\r\nRespond with stop to optout.', '2025-02-27'),
(43, 'Jennifer Newman', 'jennifer@grandeurgreencrew.com', '7048101127', 'Re: Your Janitorial Quote', 'We are local and wanted to say thank you for your contribution to our community. If it might be helpful to you, we are offering a complimentary cleaning quote and site visit for you. \r\n\r\nWould you like an updated professional cleaning quote?\r\n\r\nRegards,\r\n\r\nJennifer Newman\r\nSales Representative\r\nGrandeur Green Crew\r\njennifer@grandeurgreencrew.com\r\n\r\nRespond with stop to optout.', '2025-02-27'),
(44, 'AmandaOraniricc', 'amandaAffonec@gmail.com', '87192266334', 'New message for you!  â¤ï¸ â¤ï¸ âœ¨', 'I saw you and couldnâ€™t resist writing! \r\nmessage me there!  --->  https://rb.gy/44z0k7?suelaype', '2025-02-28'),
(45, 'AmandaOraniricc', 'amandaAffone3@gmail.com', '84446495299', 'Looking for me?  â¤ï¸ âœ¨ â¤ï¸', 'I think we could get along! Letâ€™s talk? \r\nmessage me there!  --->  https://rb.gy/44z0k7?suelaype', '2025-02-28'),
(46, 'Amandastuddyc', 'amandaDentguep1@gmail.com', '81625362554', 'Hi there!  âœ¨ âœ¨ âœ¨', 'I think we could get along! Letâ€™s talk? \r\nmessage me there!  --->  https://rb.gy/44z0k7?lady', '2025-02-28'),
(47, 'Mike Joseph Johansson\r\n', 'info@professionalseocleanup.com', '82213424489', 'Improve your website`s ranks totally free', 'Hi there, \r\n \r\nWhile checking your villageonweb.in for its ranks, I have noticed that \r\nthere are some toxic links pointing towards it. \r\n \r\nGrab your free clean up and improve ranks in no time \r\nhttps://www.professionalseocleanup.com/ \r\n \r\nAsk us how we do it: \r\nhttps://www.professionalseocleanup.com/whatsapp/ \r\n \r\nRegards \r\nMike Joseph Johansson\r\n \r\nPhone: +1 (855) 221-7591', '2025-03-01'),
(48, 'Amandabrudgeb', 'amandaNuardy2@gmail.com', '83856397825', ' New message for you! ', ' You seem interesting! Wanna chat?  \r\n \r\nMessage me there! ---> https://rb.gy/44z0k7?Intedo', '2025-03-01'),
(49, 'OliviaNab', 'ebojajuje04@gmail.com', '89553684388', 'Hello  i writing about     prices', 'Hai, saya ingin tahu harga Anda.', '2025-03-02'),
(50, 'AmandaApoche1', 'amandaSpooloc@gmail.com', '88369111742', ' Looking for me? ', ' I saw you and couldnâ€™t resist writing!  \r\n \r\nMessage me there! ---> https://rb.gy/44z0k7?JuraPali', '2025-03-03'),
(51, 'Amandaothelpc', 'amandaExpife1@gmail.com', '81655386477', ' Hi there! ', ' Iâ€™m waiting for your message! Come say hi!  \r\n \r\nMessage me there! ---> https://rb.gy/44z0k7?joindy', '2025-03-03'),
(52, 'Amandastuddya', 'amandaDentguepb@gmail.com', '81334918383', ' Looking for me? ', ' I think we could get along! Letâ€™s talk?  \r\n \r\nMessage me there! ---> https://rb.gy/44z0k7?lady', '2025-03-03'),
(53, '', 'ohfqabor@do-not-respond.me', 'Alice', 'Alice', 'KlfIWE VXMFlnj mcCQuDB DscwO VFJ NPrXCAs', '2025-03-04'),
(54, '', 'dtempgbs@do-not-respond.me', 'Hello', 'Hello', 'dcGn bgdGc UENWf Udrj', '2025-03-04'),
(55, '', 'yatnzjbv@do-not-respond.me', 'MyName', 'Alice', 'ikN mojtvOt JMYA', '2025-03-04'),
(56, '', 'ucaodkrh@do-not-respond.me', 'Alice', 'Hello', 'fZtbNBjy mGVFdLrl zpHwd fbb', '2025-03-05'),
(57, 'Amandakizhoity3', 'amandaliabuddy1@gmail.com', '88247998477', ' New message for you! ', ' \"I want to know what makes you tick. Letâ€™s chat on https://rb.gy/44z0k7?Obenug !\"  ', '2025-03-05'),
(58, '', 'jcmdomwa@do-not-respond.me', 'MyName', 'Hello', 'FabrKvLK LDF aEy DcDet YHWhJFp', '2025-03-06'),
(59, '', 'nyjzursn@do-not-respond.me', 'TestUser', 'MyName', 'idiFF oyprH BUP kyFj', '2025-03-06'),
(60, '', 'owgvrfaa@do-not-respond.me', 'Hello', 'TestUser', 'rSk nQCT yFtNIh OIp lDjoE JdNd', '2025-03-09'),
(61, '', 'apmlpnps@do-not-respond.me', 'Alice', 'TestUser', 'YFCQr wEIz pYCfArX Wuj', '2025-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` int(11) NOT NULL,
  `village_name` varchar(255) NOT NULL,
  `db_host` varchar(255) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `db_user` varchar(255) NOT NULL,
  `db_pass` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `village_name`, `db_host`, `db_name`, `db_user`, `db_pass`, `admin_email`, `admin_pass`) VALUES
(5, 'ajarpura', 'localhost', 'villageonweb_ajarpura', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'ajarpura@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(6, 'ardi', 'localhost', 'villageonweb_ardi', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'ardi@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(7, 'asodar', 'localhost', 'villageonweb_asodar', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'asodar@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(8, 'boriya', 'localhost', 'villageonweb_boriya', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'boriya@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(9, 'chikhodara', 'localhost', 'villageonweb_chikhodara', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'chikhodara@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(10, 'gana', 'localhost', 'villageonweb_gana', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'gana@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(11, 'jol', 'localhost', 'villageonweb_jol', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'jol@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(12, 'mogar', 'localhost', 'villageonweb_mogar', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'mogar@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(13, 'morad', 'localhost', 'villageonweb_morad', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'morad@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(14, 'napad', 'localhost', 'villageonweb_napad', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'napad@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(16, 'porda', 'localhost', 'villageonweb_porda', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'porda@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(17, 'ramnagar', 'localhost', 'villageonweb_ramnagar', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'ramnagar@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(18, 'ravipura', 'localhost', 'villageonweb_ravipura', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'ravipura@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(19, 'rudel', 'localhost', 'villageonweb_rudel', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'rudel@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(20, 'vadod', 'localhost', 'villageonweb_vadod', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'vadod@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(21, 'vaghasi', 'localhost', 'villageonweb_vaghasi', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'vaghasi@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(22, 'vatadara', 'localhost', 'villageonweb_vatadara', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'vatadara@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(23, 'vishnoli', 'localhost', 'villageonweb_vishnoli', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'vishnoli@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(25, 'adas', 'localhost', 'villageonweb_adas', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'adas@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b'),
(26, 'navli', 'localhost', 'villageonweb_navli', 'villageonweb_root', 'V!wrJq(Q%nZ=', 'navli@villageonweb.in', '6992d6cfe9394cdf7aa682c6db48a07d783a049b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
