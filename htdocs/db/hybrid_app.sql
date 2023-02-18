-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 01:00 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hybrid_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `CtrlNum` int(250) NOT NULL,
  `qr_code` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `usertype` varchar(250) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`CtrlNum`, `qr_code`, `username`, `password`, `fullname`, `usertype`) VALUES
(5, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=3123', '1231', '123123', '3123', 'admin'),
(6, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=jerymie Inbina', 'inbina@gmail.com', '123456', 'jerymie Inbina', 'admin'),
(7, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=eqweqe', 'qweqwe', 'qweqwe', 'eqweqe', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(250) NOT NULL,
  `Position` varchar(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Platform` text NOT NULL,
  `picture` text NOT NULL,
  `LRN` decimal(12,0) NOT NULL,
  `grade` int(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `pdf` longtext NOT NULL,
  `confirm` int(250) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(250) NOT NULL,
  `user_id` decimal(12,0) NOT NULL,
  `name` varchar(250) NOT NULL,
  `action` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `name`, `action`, `date`) VALUES
(40, '101759070024', 'MAGPALI,JESSIE RIVERA', 'Submitted COC', '2022-10-31 17:03:24'),
(41, '101759070024', 'MAGPALI,JESSIE RIVERA', 'Login', '2022-10-31 17:05:03'),
(42, '101759070024', 'MAGPALI,JESSIE RIVERA', 'Submitted COC', '2022-10-31 17:05:50'),
(43, '101759070024', 'MAGPALI,JESSIE RIVERA', 'Submitted COC', '2022-10-31 17:12:16'),
(44, '101759070024', 'MAGPALI,JESSIE RIVERA', 'Submitted COC', '2022-10-31 19:41:36'),
(45, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Login', '2022-11-01 00:11:13'),
(46, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Login', '2022-11-01 00:43:54'),
(47, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Login', '2022-11-01 02:15:25'),
(48, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Logged in', '2022-11-01 14:04:41'),
(49, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Change Password Successfully', '2022-11-01 14:04:58'),
(50, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Logged in', '2022-11-01 14:05:21'),
(51, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Submitted COC', '2022-11-01 14:16:39'),
(52, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'Submit Votes', '2022-11-01 14:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `CtrlNum` int(250) NOT NULL,
  `qr_code` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `usertype` varchar(250) NOT NULL,
  `LRN` decimal(12,0) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `grade` int(250) NOT NULL,
  `section` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position` varchar(250) NOT NULL,
  `max_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`, `max_vote`) VALUES
(45, 'President', 1),
(49, 'Secretary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `LRN` varchar(12) DEFAULT NULL,
  `NAME` varchar(37) DEFAULT NULL,
  `SEX` varchar(3) DEFAULT NULL,
  `GRADE` varchar(5) DEFAULT NULL,
  `SECTION` varchar(10) DEFAULT NULL,
  `AGE` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`LRN`, `NAME`, `SEX`, `GRADE`, `SECTION`, `AGE`) VALUES
('LRN', 'NAME', 'SEX', 'GRADE', 'SECTION', 'AGE'),
('101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'M', '7', 'Sampaguita', '13'),
('101763080002', 'AGMATA,KHENJEE MARZAN', 'M', '7', 'Sampaguita', '13'),
('101765090002', 'ALMARIO,JOHN ALLEN ALVARADO', 'M', '7', 'Sampaguita', '13'),
('101759080009', 'ANCHETA,FRANCIS MANUEL', 'M', '7', 'Sampaguita', '13'),
('101765090024', 'ETRATA,JEFFERSON GANITUEN', 'M', '7', 'Sampaguita', '12'),
('101765090026', 'FADERAN,CHARLES DAN -', 'M', '7', 'Sampaguita', '13'),
('101759070024', 'MAGPALI,JESSIE RIVERA', 'M', '7', 'Sampaguita', '13'),
('136409090136', 'MARZAN,REY MARC GRAYCOCHEA', 'M', '7', 'Gumamela', '12'),
('101765050059', 'ROMERO,JOMAR LALATA', 'M', '7', 'Gumamela', '13'),
('101759090036', 'SAN DIEGO,JOSHUA EMBUEDO', 'M', '7', 'Gumamela', '13'),
('101759090037', 'TADENA,JENO REY ESCORIDO', 'M', '7', 'Gumamela', '13'),
('101765090055', 'VERGARA,JOHN ANGELO REDILA', 'M', '7', 'Gumamela', '12'),
('101765090056', 'VICTORIANO,LOUIE JAY VITALES', 'M', '7', 'Gumamela', '13'),
('101765090058', 'VILLAR,JEFFREY SAN JOSE', 'M', '7', 'Gumamela', '13'),
('101763090011', 'BOLLOSO,JHOANNA MARIE BUENAVISTA', 'F', '8', 'Mango', '14'),
('101953060069', 'BRAVANTE,MARICRIS null -', 'F', '8', 'Mango', '13'),
('101765090009', 'BUGAOAN,ERIKA AGBANLOG', 'F', '8', 'Mango', '14'),
('101765090012', 'CABANILLA,THEAMARIE KYLA DULAY', 'F', '8', 'Mango', '14'),
('101759120048', 'CAMARAO,ROSEMARIE CHAVEZ', 'F', '8', 'Mango', '14'),
('101759090012', 'CASTADA,JOANNA MAE ISIDRO', 'F', '8', 'Mango', '13'),
('300346110021', 'CAUYAO,JESSICA SALVATIERA', 'F', '8', 'Mango', '14'),
('101765090019', 'DULAY,DAISY ANGEL ASPRIN', 'F', '8', 'Lemon', '14'),
('101759090019', 'DULAY,ELOISA MAE CAMARAO', 'F', '8', 'Lemon', '14'),
('101765090022', 'ESQUEJO,JELIENOR FERNANDEZ', 'F', '8', 'Lemon', '13'),
('101776090049', 'GAITOS,STEPHANIE ANGEL CABANTING', 'F', '8', 'Lemon', '14'),
('101759090026', 'GANIT,JOY SUPNET', 'F', '8', 'Lemon', '14'),
('101722090006', 'GUITANG,FELICITY DELOS SANTOS', 'F', '8', 'Lemon', '14'),
('101765090032', 'HIDALGO,JENNIFER LOU BELMONTE', 'F', '9', 'Bonofacio', '15'),
('136401120236', 'LAUDENCIA,ROWENA FAITH DABALOS', 'F', '9', 'Bonofacio', '15'),
('101765060034', 'LAURETA,ANGELICA BERMUDEZ', 'F', '9', 'Bonofacio', '15'),
('101722090009', 'LEONES,TRIXIE REGLOS', 'F', '9', 'Bonofacio', '14'),
('101763090018', 'LLAMERA,JESSELYN JACOB', 'F', '9', 'Bonofacio', '15'),
('136753090828', 'RABORAR,KHAREN GERVACIO', 'F', '9', 'Bonofacio', '15'),
('101722090016', 'REPOYO,MELODY PATALIN', 'F', '9', 'Bonofacio', '15'),
('135617090111', 'SACULLES,ELOISA JANE PERNIA', 'F', '9', 'Rizal', '15'),
('101765090046', 'SACULLES,JIENSEL MINA', 'F', '9', 'Rizal', '15'),
('101765090048', 'SEGUNDO,DIANA DULAY', 'F', '9', 'Rizal', '15'),
('101765090051', 'SORIANO,JD ABENOJA', 'F', '9', 'Rizal', '14'),
('101765.', 'VIERNES,PRINCESS ALCAPARLAS', 'F', '9', 'Rizal', '15'),
('101765678256', 'ABELLA, KIMVERLIE, ADRIATICO', 'F', '9', 'Rizal', '14'),
('101765284398', 'ACERON, CHARITY, MENDEZ', 'F', '9', 'Rizal', '15'),
('101765954836', 'ARCE, JANRIC, PATIGDAS', 'M', '10', 'Diamond', '16'),
('101765652846', 'BACURIN, SHOBIELYN,BAKUNAWA', 'F', '10', 'Diamond', '16'),
('101765102846', 'BALAIS, APRIL JOY, RAMIREZ', 'F', '10', 'Diamond', '16'),
('101765842093', 'BALATUCAN, SHAMMEL, ANDAL', 'F', '10', 'Diamond', '15'),
('101765102146', 'BEDANIA, JOHN PAUL, DIOSO', 'M', '10', 'Diamond', '16'),
('101765057908', 'CALIPUS, DZCELYN. AUSTRIA', 'F', '10', 'Diamond', '16'),
('101765057908', 'CALO, JHONMAREN, CAMUTA', 'M', '10', 'Diamond', '16'),
('101765017452', 'DANAO, SEAN LOUISM, DAQUIADO', 'M', '10', 'Sapphire', '15'),
('101765027344', 'EBOŇA, ANNALYN, LISTANA', 'F', '10', 'Sapphire', '16'),
('101765890789', 'FORTUNADO, LIBE', 'M', '10', 'Sapphire', '16'),
('101765098900', 'FRANCISCO, JOHN REI, SOLIS', 'M', '10', 'Sapphire', '16'),
('101765978699', 'GLEE, BHEE JAY DELOS, MARTERIZ', 'M', '10', 'Sapphire', '15'),
('101765098779', 'HUBILLA, JHYRELL KYLE, OBIDOS', 'M', '10', 'Sapphire', '16'),
('101765123123', 'JAMORAGAN, SAMANTHA NICOLE, LOBERIA', 'F', '11', 'GAS', '17'),
('101765231462', 'MACAHILIG, NICOLE, ERNESTO', 'F', '11', 'GAS', '17'),
('101765925381', 'MENDOZA, FRANCHESKA DOMINIQUE, DELEON', 'F', '11', 'GAS', '17'),
('101765192231', 'NAVAL, VINCENT PAUL, LAZARO', 'M', '11', 'GAS', '17'),
('101765567282', 'NOLASCO, JEANELLE ERICA, PINERA', 'F', '11', 'GAS', '16'),
('101765102442', 'OCAMPO, MARC PHILIP, BESIN', 'M', '11', 'GAS', '17'),
('101765124128', 'PAGLIAWAN, LAARNI JOY, VERGARA', 'F', '11', 'GAS', '17'),
('101765836123', 'PEROY, JEROME, CABANTAC', 'M', '11', 'TVL', '17'),
('101765112178', 'POLICARPIO, ROCHELLE CLARISE, MENDOZA', 'F', '11', 'TVL', '17'),
('101765856782', 'QUIMBA, FUENTES, RAPIZ', 'M', '11', 'TVL', '17'),
('101765927756', 'RAZAL, MARK JOSHUA JUNN, AGAPITO', 'M', '11', 'TVL', '16'),
('101765789411', 'REFORZADO, KLARE REI, DELA PEÑA', 'F', '11', 'TVL', '17'),
('101765227709', 'SARAGOZA, POLA, BORROMEO', 'F', '11', 'TVL', '17'),
('101765775501', 'SARMIENTO, CHRISHEL', 'F', '11', 'TVL', '17'),
('101765991623', 'SEPAL, ALYSSA, LANDICHO', 'F', '11', 'HUMSS', '17'),
('101765909128', 'TOLEDO, NEOMY, ELSBETH', 'F', '11', 'HUMSS', '17'),
('101765378266', 'TAN, MICHELLE, PANAGA', 'F', '11', 'HUMSS', '17'),
('101765557821', 'TORRIFIEL, JECILYN, ERANDIO', 'F', '11', 'HUMSS', '17'),
('101765974216', 'UNANCIA, GILLIAN MARIE, PADIOS', 'F', '11', 'HUMSS', '16'),
('101765215690', 'UMPAOCO, BERNADETH, BONEO', 'F', '11', 'HUMSS', '17'),
('101765739065', 'UNYA, ELLA CRISHEL, NILO', 'F', '12', 'GAS', '18'),
('101765901741', 'VALBAR, REINALYN, NAVOTA', 'F', '12', 'GAS', '18'),
('101765056275', 'VICTORIANO, AUDREY JOY, BORRETA', 'F', '12', 'GAS', '18'),
('101765676522', 'VILVAR, CLINTON, JAZARENO', 'M', '12', 'GAS', '17'),
('101765096733', 'YAP, JOVY MAE, REFORZADO', 'F', '12', 'GAS', '18'),
('101765410985', 'ZATO, ERIN, DELVALLE', 'F', '12', 'GAS', '18'),
('101765842675', 'CABILI, MACHAEL BARON', 'M', '12', 'GAS', '18'),
('101765426531', 'CHAVIZ, SHERWIN, CABALLOS', 'M', '12', 'TVL', '18'),
('101765752106', 'FAME, JOLEN, ALCANTARA', 'M', '12', 'TVL', '18'),
('101765000524', 'MARTINEZ, ALVIN, PERAN', 'M', '12', 'TVL', '18'),
('101765982300', 'NAVARRO, JOHN PAUL, OLQUINO', 'M', '12', 'TVL', '18'),
('101765045210', 'ROXAS, ROMEL, SAMSON', 'M', '12', 'TVL', '18'),
('101765726100', 'TISOY, ANGELO, TURIANO', 'M', '12', 'TVL', '17'),
('101765336520', 'CAMPOS, JOANNA, JABID', 'F', '12', 'HUMSS', '18'),
('101765961005', 'GABISAN, KAYE MARIE, MACAMAY', 'F', '12', 'HUMSS', '18'),
('101765225440', 'JAVIER, JEMMA MAE ROXAS', 'F', '12', 'HUMSS', '18'),
('101765775506', 'TRAGO, FRANCESS GABISAN', 'F', '12', 'HUMSS', '17'),
('101765770031', 'SABIT, JENREN LANYICHIE', 'F', '12', 'HUMSS', '18'),
('101765440311', 'MAMOYONG, DANIELA MAE ESTEBAN', 'F', '12', 'HUMSS', '18'),
('101765663009', 'MAMALINTA, MARY ANN PINLAC', 'F', '12', 'HUMSS', '18');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `CtrlNum` int(11) NOT NULL,
  `qr_code` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user',
  `LRN` decimal(12,0) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `grade` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`CtrlNum`, `qr_code`, `username`, `password`, `usertype`, `LRN`, `fullname`, `grade`, `section`, `gender`, `Date`) VALUES
(98, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101759090004&ABELLERA,PHILIP JR LUMISOD', 'abellera@gmail.com', '$2y$10$wAU8G6ANPPt9sPYwuJ.thOgZ9N5bQHHoFAxWWocmYtLjz4C41uWVi', 'user', '101759090004', 'ABELLERA,PHILIP JR LUMISOD', '7', 'Sampaguita', 'M', '2022-11-01'),
(102, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101765090024&ETRATA,JEFFERSON GANITUEN', 'etrata@gmail.com', '$2y$10$3SmbC4qn0r26DlPS.V7cguAVYH9t1dmlj5d7svYWiKQB7QePr3MSS', 'user', '101765090024', 'ETRATA,JEFFERSON GANITUEN', '7', 'Sampaguita', 'M', '2022-11-01'),
(103, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101759080009&ANCHETA,FRANCIS MANUEL', 'ancheta@gmail.com', '$2y$10$9aB2c/G2QvVMV1N4rc2H..s9spykWjv7gKYjfHWYBPWlIMdwYs0H2', 'user', '101759080009', 'ANCHETA,FRANCIS MANUEL', '7', 'Sampaguita', 'M', '2022-11-01'),
(104, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101763080002&AGMATA,KHENJEE MARZAN', 'agmata@gmail.com', '$2y$10$eaBpL4b9aQFVHcl4VkrjSOpzPQIbqa/XfzXCZoG52QJhpGH91Iu3K', 'user', '101763080002', 'AGMATA,KHENJEE MARZAN', '7', 'Sampaguita', 'M', '2022-11-01'),
(105, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101765090002&ALMARIO,JOHN ALLEN ALVARADO', 'almario@gmail.com', '$2y$10$RyBLlnM68x8mVHZYO8UkZ.VT65QxBoLtMtLzeyyW7tBUzOnincdOa', 'user', '101765090002', 'ALMARIO,JOHN ALLEN ALVARADO', '7', 'Sampaguita', 'M', '2022-11-01'),
(106, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101765090019&DULAY,DAISY ANGEL ASPRIN', 'dulay@gmail.com', '$2y$10$ZpII6hrN9mQ/m0sk7BhEEOmhTxAPsu97fWhUBqwetxBcBQ3zlPs3G', 'user', '101765090019', 'DULAY,DAISY ANGEL ASPRIN', '8', 'Lemon', 'F', '2022-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `id` int(11) NOT NULL,
  `LRN` decimal(12,0) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Grade` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voted`
--

INSERT INTO `voted` (`id`, `LRN`, `Name`, `Grade`) VALUES
(18, '101759090004', 'ABELLERA,PHILIP JR LUMISOD', 7);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_lrn` decimal(12,0) NOT NULL,
  `candidate_lrn` decimal(12,0) NOT NULL,
  `Grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_lrn`, `candidate_lrn`, `Grade`) VALUES
(47, '101759090004', '101759090004', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`CtrlNum`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`CtrlNum`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`CtrlNum`);

--
-- Indexes for table `voted`
--
ALTER TABLE `voted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `CtrlNum` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `CtrlNum` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `CtrlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `voted`
--
ALTER TABLE `voted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
