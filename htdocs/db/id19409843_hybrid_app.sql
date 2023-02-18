-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 02:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `Platform` varchar(250) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `Position`, `Name`, `Platform`, `picture`) VALUES
(1, 'President', 'Sean Ian Palacio', 'Boto niyo po ako please', 'https://static.wikia.nocookie.net/marveldatabase/images/6/67'),
(2, '', '', '', 'https://marvel.fandom.com/wiki/Stephen_Strange_%28Earth-1999'),
(3, '123123', '3123', '123123', '6305aa6f7b1347.13039928.jpg'),
(4, '12313', '123123', '123123', '6305aa7a50c202.13633248.jpg'),
(5, '12313', '23123', '123123', '6305aa9d8e38c8.85766319.jpg'),
(6, '123123', '3123', '21312', 'img/6305b95c08cb73.41990601.jpg'),
(7, 'sean', 'sean', 'uuiasduiadsjkdhjsdfhjsdfhjfkljhfklsjdfhskadf\r\neqweqwe\r\nqweqwe\r\nqweqweqwe', 'img/6305b9d005f307.72428054.png'),
(8, 'President', 'jonathan jimenez', 'kumburuhusss di magiging bobo jan', 'img/63060e36b90d83.08647320.png');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `LRN` decimal(12,0) NOT NULL,
  `NAME` varchar(32) CHARACTER SET utf8 NOT NULL,
  `Sex` varchar(1) CHARACTER SET utf8 NOT NULL,
  `BIRTH DATE` varchar(10) CHARACTER SET utf8 NOT NULL,
  `AGE as of October 31st` int(2) NOT NULL,
  `Religious Affilication` varchar(12) CHARACTER SET utf8 NOT NULL,
  `House #/ Street/ Sitio/ Purok` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Barangay` varchar(19) CHARACTER SET utf8 NOT NULL,
  `Municipality/ City` varchar(21) CHARACTER SET utf8 NOT NULL,
  `Province` varchar(19) CHARACTER SET utf8 NOT NULL,
  `Father's_Name` varchar(27) CHARACTER SET utf8 NOT NULL,
  `Mother's Maiden Name (Last Name, First Name, Middle Name)` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Relationship` varchar(8) CHARACTER SET utf8 NOT NULL,
  `Contact Number of Parent or Guardian` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Learning Modality` varchar(15) CHARACTER SET utf8 NOT NULL,
  `REMARKS` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`LRN`, `NAME`, `Sex`, `BIRTH DATE`, `AGE as of October 31st`, `Religious Affilication`, `House #/ Street/ Sitio/ Purok`, `Barangay`, `Municipality/ City`, `Province`, `Father's_Name`, `Mother's Maiden Name (Last Name, First Name, Middle Name)`, `Relationship`, `Contact Number of Parent or Guardian`, `Learning Modality`, `REMARKS`) VALUES
('101759090004', 'ABELLERA,PHILIP JR LUMISOD', 'M', '09/17/2004', 17, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'ABELLERA, PHILIP B SR', 'LUMISOD,LAYLA-MAY,M,', 'RELATIVE', '', 'Modular (print)', ''),
('101763080002', 'AGMATA,KHENJEE MARZAN', 'M', '05/02/2003', 18, 'Christianity', '', 'MANGCASUY', 'BINALONAN', 'PANGASINAN', 'AGMATA JR, MELECIO ADUCA', 'MARZAN,ROMELYN,TOMBOC,', '', '', 'Modular (print)', ''),
('101765090002', 'ALMARIO,JOHN ALLEN ALVARADO', 'M', '05/17/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'ALMARIO, JOEL ESTONILO', 'ALVARADO,ALEJANDRA,MARTIN,', 'PARENT', '', 'Modular (print)', ''),
('101759080009', 'ANCHETA,FRANCIS MANUEL', 'M', '02/11/2001', 20, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'ANCHETA, MARLON', 'MANUEL,MERLYN,,', 'PARENT', '', 'Modular (print)', ''),
('101765090024', 'ETRATA,JEFFERSON GANITUEN', 'M', '06/11/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'ETRATA, RONNIE', 'GANITUEN,MARILYN,,', 'PARENT', '', 'Modular (print)', ''),
('101765090026', 'FADERAN,CHARLES DAN -', 'M', '02/02/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'MENDAROS, RODULFO BASIAO', 'FADERAN,EVELYN,ANTONIO,', 'PARENT', '', 'Modular (print)', ''),
('101759070024', 'MAGPALI,JESSIE RIVERA', 'M', '03/27/2002', 19, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'MAGPALI, MARCELO', 'RIVERA,MEL,,', 'PARENT', '', 'Modular (print)', ''),
('136409090136', 'MARZAN,REY MARC GRAYCOCHEA', 'M', '04/30/2002', 19, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'MARZAN, REYNANTE VALDEZ', 'GRAYCOCHEA,ESTELITA,AROMIN,', 'PARENT', '', 'Modular (print)', ''),
('101765050059', 'ROMERO,JOMAR LALATA', 'M', '05/06/2000', 21, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', '', 'LALATA,MARIA,TERESA,', 'PARENT', '', 'Modular (print)', ''),
('101759090036', 'SAN DIEGO,JOSHUA EMBUEDO', 'M', '08/13/2003', 18, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'SAN DIEGO, HONORATO MAGAT', 'EMBUEDO,FELOMINA,RABORAR,', '', '', 'Modular (print)', ''),
('101759090037', 'TADENA,JENO REY ESCORIDO', 'M', '01/19/2004', 17, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'TADENA, ARNELO CORLINO', 'ESCORIDO,LYN LYN,GRACIA,', 'PARENT', '', 'Modular (print)', ''),
('101765090055', 'VERGARA,JOHN ANGELO REDILA', 'M', '01/04/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'VERGARA, ELISEO SUBOC JR', 'REDILA,IMELDA,FERNANDEZ,', 'PARENT', '', 'Modular (print)', ''),
('101765090056', 'VICTORIANO,LOUIE JAY VITALES', 'M', '06/02/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'VICTORIANO, EDWIN BASIAO', 'VITALES,JEANNETTE,RAFAN,', 'PARENT', '', 'Modular (print)', ''),
('101765090058', 'VILLAR,JEFFREY SAN JOSE', 'M', '01/07/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'VILLAR, JAYSON LOCERO', 'SAN JOSE,CRISTELITA,DELA CRUZ,', 'PARENT', '', 'Modular (print)', ''),
('101763090011', 'BOLLOSO,JHOANNA MARIE BUENAVISTA', 'F', '11/25/2003', 17, 'Christianity', '', 'MANGCASUY', 'BINALONAN', 'PANGASINAN', 'BOLLOSO, JULIUS BAUTISTA', 'BUENAVISTA,ANNA MARIE,DALIT,', 'PARENT', '', 'Modular (print)', ''),
('101953060069', 'BRAVANTE,MARICRIS null -', 'F', '03/04/2000', 21, 'Christianity', '', 'GUISET NORTE (POB.)', 'SAN MANUEL', 'PANGASINAN', 'CATALAN, JOECRIS', 'BRAVANTE,MARILOU,,', 'PARENT', '', 'Modular (print)', ''),
('101765090009', 'BUGAOAN,ERIKA AGBANLOG', 'F', '12/06/2003', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'BUGAOAN, GUILLERMO TADENA', 'AGBANLOG,MARITES,SORIANO,', 'PARENT', '', 'Modular (print)', ''),
('101765090012', 'CABANILLA,THEAMARIE KYLA DULAY', 'F', '11/12/2003', 17, 'Christianity', '', 'SANTO DOMINGO', 'SAN MANUEL', 'PANGASINAN', 'CABANILLA, TIMOTEO', 'DULAY,MARIETA,,', 'PARENT', '', 'Modular (print)', ''),
('101759120048', 'CAMARAO,ROSEMARIE CHAVEZ', 'F', '04/27/2004', 17, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'CAMARAO, ALBERTO DELA CRUZ', 'CHAVEZ,LYDIA,BRONOLA,', 'PARENT', '', 'Modular (print)', ''),
('101759090012', 'CASTADA,JOANNA MAE ISIDRO', 'F', '12/20/2003', 17, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'CASTADA, MAXIMO RETRATO', 'ISIDRO,ANA,URANZA,', 'PARENT', '', 'Modular (print)', ''),
('300346110021', 'CAUYAO,JESSICA SALVATIERA', 'F', '04/30/1998', 23, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', '', 'SALVATIERA,CORAZON,,', 'PARENT', '', 'Modular (print)', ''),
('101765090019', 'DULAY,DAISY ANGEL ASPRIN', 'F', '11/26/2003', 17, 'Christianity', '', 'SANTO DOMINGO', 'SAN MANUEL', 'PANGASINAN', 'DULAY, EDMUNDO G', 'ASPRIN,IMELDA,,', 'PARENT', '', 'Modular (print)', ''),
('101759090019', 'DULAY,ELOISA MAE CAMARAO', 'F', '09/22/2004', 17, 'Christianity', '', 'GABALDON', 'SCIENCE CITY OF MUÑOZ', 'NUEVA ECIJA', 'DULAY, ALFREDO SANTIAGO', 'CAMARAO,EDNA,DELA CRUZ,', 'PARENT', '', 'Modular (print)', ''),
('101765090022', 'ESQUEJO,JELIENOR FERNANDEZ', 'F', '04/09/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'ESQUEJO, NORIEL LABORTE', 'FERNANDEZ,JESCEL,BALTAZAR,', 'PARENT', '', 'Modular (print)', ''),
('101776090049', 'GAITOS,STEPHANIE ANGEL CABANTING', 'F', '10/25/2004', 17, 'Christianity', '', 'SUMABNIT', 'BINALONAN', 'PANGASINAN', 'GAITOS, ARNOLD SAGUN SR', 'CABANTING,MARIVIC,DESALIA,', 'PARENT', '', 'Modular (print)', ''),
('101759090026', 'GANIT,JOY SUPNET', 'F', '09/20/2004', 17, 'Christianity', '', 'CAPAS', 'BINALONAN', 'PANGASINAN', 'GANIT, ERNESTO TABLASON', 'SUPNET,MARY JANE,BERBANO,', 'PARENT', '', 'Modular (print)', ''),
('101722090006', 'GUITANG,FELICITY DELOS SANTOS', 'F', '07/29/2004', 17, 'Christianity', '', 'BOBONAN', 'ASINGAN', 'PANGASINAN', 'GUITANG, ROLANDO CALACSAN', 'DELOS SANTOS,FELICIDAD,OCHOCO,', 'PARENT', '', 'Modular (print)', ''),
('101765090032', 'HIDALGO,JENNIFER LOU BELMONTE', 'F', '07/29/2004', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'HIDALGO, JUDY LAROCO', 'BELMONTE,ANNABELLE,LATIGAY,', 'PARENT', '', 'Modular (print)', ''),
('136401120236', 'LAUDENCIA,ROWENA FAITH DABALOS', 'F', '12/16/2003', 17, 'Christianity', '', 'SANTO DOMINGO', 'SAN MANUEL', 'PANGASINAN', 'LAUDENCIA, PEDRO JR', 'DAVALOS,ROSE MARIE,,', 'PARENT', '', 'Modular (print)', ''),
('101765060034', 'LAURETA,ANGELICA BERMUDEZ', 'F', '08/12/2000', 21, 'Christianity', '', '', 'BINALONAN', 'PANGASINAN', '', 'BERMUDEZ,LIWANAG,,', 'PARENT', '', 'Modular (print)', ''),
('101722090009', 'LEONES,TRIXIE REGLOS', 'F', '12/27/2003', 17, 'Christianity', '', 'BOBONAN', 'ASINGAN', 'PANGASINAN', 'LEONES, JESUS PULIDO', 'REGLOS,PATRICIA,REPOYO,', 'PARENT', '', 'Modular (print)', ''),
('101763090018', 'LLAMERA,JESSELYN JACOB', 'F', '05/25/2003', 18, 'Christianity', '', 'MANGCASUY', 'BINALONAN', 'PANGASINAN', 'LLAMERA, JESSIE CANIETE', 'JACOB,ERLINDA,FLORES,', 'PARENT', '', 'Modular (print)', ''),
('136753090828', 'RABORAR,KHAREN GERVACIO', 'F', '06/23/2003', 18, 'Christianity', '', 'SAN ISIDRO', 'CITY OF PARAÑAQUE', 'NCR FOURTH DISTRICT', 'RABORAR, RESTITUTO SINDAYEN', 'GERVACIO,EVANGELINE,,', 'RELATIVE', '', 'Modular (print)', ''),
('101722090016', 'REPOYO,MELODY PATALIN', 'F', '04/14/2004', 17, 'Christianity', '', 'BOBONAN', 'ASINGAN', 'PANGASINAN', 'REPOYO, MILO B', 'PATALIN,MARY JEAN,,', 'PARENT', '', 'Modular (print)', ''),
('135617090111', 'SACULLES,ELOISA JANE PERNIA', 'F', '06/30/2003', 18, 'Christianity', '', 'CAMP 7', 'BAGUIO CITY', 'BENGUET', 'SACULLES, RICARDO FLORES', 'PERNIA,MONALIZA,FEDELINO,', '', '', 'Modular (print)', ''),
('101765090046', 'SACULLES,JIENSEL MINA', 'F', '08/12/2004', 17, 'Christianity', '', 'SANTO DOMINGO', 'SAN MANUEL', 'PANGASINAN', 'SACULLES, DENCIANO CABRERA', 'MINA,LEONIDA,-,', 'PARENT', '', 'Modular (print)', ''),
('101765090048', 'SEGUNDO,DIANA DULAY', 'F', '02/07/2004', 17, 'Christianity', '', 'SANTO DOMINGO', 'SAN MANUEL', 'PANGASINAN', 'SEGUNDO, DOMINADOR B', 'DULAY,DIVINA,,', 'PARENT', '', 'Modular (print)', ''),
('101765090051', 'SORIANO,JD ABENOJA', 'F', '11/02/2003', 17, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'SORIANO, DOMINGO MONCES', 'ABENOJA,JULIE ANN,ABELLERA,', 'PARENT', '', 'Modular (print)', ''),
('101765090057', 'VIERNES,PRINCESS ALCAPARLAS', 'F', '08/14/2003', 18, 'Christianity', '', 'SAN FELIPE CENTRAL', 'BINALONAN', 'PANGASINAN', 'VIERNES, VIRGILIO PAET', 'ALCAPARLAS,MILAGROSA,BIADO,', 'PARENT', '', 'Modular (print)', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `CtrlNum` int(11) NOT NULL,
  `qr_code` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user',
  `LRN` decimal(12,0) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `grade` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`CtrlNum`, `qr_code`, `username`, `password`, `usertype`, `LRN`, `fullname`, `grade`, `section`) VALUES
(59, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101759090037&TADENA,JENO REY ESCORIDO', 'tadena@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', '101759090037', 'TADENA,JENO REY ESCORIDO', '12', 'gas'),
(60, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=136409090136&MARZAN,REY MARC GRAYCOCHEA', 'marzan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', '136409090136', 'MARZAN,REY MARC GRAYCOCHEA', '11', 'humms'),
(61, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101759090004&ABELLERA,PHILIP JR LUMISOD', 'abellera@gmail.com', '101759090004', 'user', '101759090004', 'ABELLERA,PHILIP JR LUMISOD', '12', 'gas'),
(64, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101765090024&ETRATA,JEFFERSON GANITUEN', 'ETRATA@gmail.com', '101765090024', 'user', '101765090024', 'ETRATA,JEFFERSON GANITUEN', '11', 'abm'),
(67, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101759080009&ANCHETA,FRANCIS MANUEL', 'ancheta@gmail.com', '101759080009', 'user', '101759080009', 'ANCHETA,FRANCIS MANUEL', '11', 'smaw'),
(68, 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=101763080002&AGMATA,KHENJEE MARZAN', 'agmata@gmail.com', '101763080002', 'user', '101763080002', 'AGMATA,KHENJEE MARZAN', '12', 'tvl');

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
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`CtrlNum`);

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `CtrlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
