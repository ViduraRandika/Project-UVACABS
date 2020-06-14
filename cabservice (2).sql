-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 06:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cabservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminNic` varchar(20) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminContactNo` int(15) NOT NULL,
  `adminEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminNic`, `adminName`, `adminContactNo`, `adminEmail`) VALUES
('963021283v', 'Vicenta', 110, 'elroy72@example.org');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingId` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `vehicleType` varchar(255) NOT NULL,
  `tourTime` time NOT NULL,
  `tourDate` varchar(15) NOT NULL,
  `vehicleNo` varchar(20) NOT NULL,
  `customerNic` varchar(15) NOT NULL,
  `driverNic` varchar(15) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingId`, `origin`, `destination`, `vehicleType`, `tourTime`, `tourDate`, `vehicleNo`, `customerNic`, `driverNic`, `status`) VALUES
('40094', 'East', 'Piperbury', 'Van(Ac)', '03:50:08', '2020-03-22 02:0', '28245', '423456782', '323456784', 'completed'),
('40201', 'South', 'Port Austenland', 'Car', '03:36:52', '2019-10-28 13:1', '29053', '423456786', '323456782', 'notcompleted'),
('43692', 'East', 'Dangeloburgh', 'Van(Non Ac)', '05:53:32', '2020-02-04 05:2', '26777', '423456785', '323456780', 'notcompleted'),
('46207', 'Port', 'East Blaise', 'Van(Non Ac)', '07:45:11', '2019-11-11 16:3', '29845', '423456789', '323456787', 'cancelled'),
('48860', 'Lake', 'Bellside', 'Van(Non Ac)', '18:33:04', '2019-07-28 14:5', '30107', '423456780', '323456780', 'completed'),
('50147', 'New', 'New Ikeshire', 'Van(Non Ac)', '11:02:36', '2019-08-24 16:3', '26734', '423456782', '323456780', 'completed'),
('50742', 'West', 'Lake Yesseniaview', 'Van(Ac)', '21:22:45', '2019-11-01 12:1', '26930', '423456787', '323456784', 'notcompleted'),
('50908', 'South', 'Deshaunside', 'Van(Non Ac)', '14:02:50', '2019-06-03 10:2', '30486', '423456782', '323456784', 'notcompleted'),
('52889', 'New', 'New Darrion', 'Van(Ac)', '10:58:23', '2020-01-26 11:0', '39729', '423456787', '323456784', 'notcompleted'),
('55736', 'New', 'Rennerton', 'Van(Non Ac)', '13:56:25', '2019-06-09 11:5', '30631', '423456783', '323456785', 'notcompleted'),
('56757', 'Lake', 'Danehaven', 'Van(Ac)', '15:31:15', '2020-04-10 00:5', '29664', '423456788', '323456785', 'notcompleted'),
('59040', 'West', 'South Willowview', 'Van(Ac)', '02:29:11', '2020-03-10 17:5', '30647', '423456784', '323456787', 'notcompleted'),
('59871', 'West', 'North Aida', 'Van(Ac)', '23:02:20', '2019-12-19 13:5', '26914', '423456786', '323456782', 'notcompleted'),
('60441', 'South', 'Lake Doviefort', 'Van(Non Ac)', '09:36:52', '2019-10-25 01:5', '28786', '423456780', '323456780', 'notcompleted'),
('60953', 'New', 'Fritschside', 'Van(Ac)', '02:22:47', '2019-08-04 11:4', '30131', '423456781', '323456782', 'cancelled'),
('61267', 'North', 'New Freeda', 'Van(Ac)', '16:37:58', '2019-06-11 17:2', '28140', '423456781', '323456782', 'cancelled'),
('61638', 'West', 'Huelborough', 'Van(Non Ac)', '03:52:53', '2020-01-26 14:4', '26451', '423456783', '323456785', 'notcompleted'),
('62182', 'South', 'Oscarfurt', 'Van(Non Ac)', '15:22:22', '2019-05-08 23:2', '28786', '423456784', '323456787', 'notcompleted'),
('63017', 'North', 'Ornfurt', 'Van(Non Ac)', '08:31:03', '2019-10-22 10:4', '25734', '423456780', '323456780', 'notcompleted'),
('64103', 'New', 'Port Jerrymouth', 'Van(Ac)', '19:47:05', '2019-10-05 09:0', '27530', '423456789', '323456787', 'notcompleted'),
('64763', 'East', 'South Maymiemouth', 'Van(Ac)', '16:22:53', '2019-09-03 08:0', '27241', '423456788', '323456785', 'notcompleted'),
('65249', 'New', 'Dickinsonland', 'Van(Ac)', '00:00:48', '2019-12-26 21:5', '26288', '423456781', '323456782', 'cancelled'),
('65407', 'New', 'Lake Elijahport', 'Van(Non Ac)', '10:52:58', '2019-06-28 11:5', '26734', '423456784', '323456787', 'notcompleted'),
('66678', 'New', 'New Oran', 'Van(Ac)', '23:53:13', '2020-02-28 03:5', '', '423456783', '', 'pending'),
('68558', 'East', 'Rodriguezborough', 'Car', '00:20:24', '2020-01-23 05:5', '28933', '423456785', '323456780', 'notcompleted');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashierNic` varchar(20) NOT NULL,
  `cashierName` varchar(255) NOT NULL,
  `cashierAddress` varchar(255) NOT NULL,
  `cashierContactNo` int(15) NOT NULL,
  `cashierEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashierNic`, `cashierName`, `cashierAddress`, `cashierContactNo`, `cashierEmail`) VALUES
('223456782', 'Arnold', '261 Natalia Curve\nEldonstad, KY 11258', 79, 'gkohler@example.net'),
('223456783', 'Tess', '093 Bartoletti Isle Apt. 425\nNew Mercedes, IN 03007-5005', 0, 'zhodkiewicz@example.net'),
('223456786', 'Maegan', '039 Imelda Mountain Suite 422\nRebecastad, IA 38697', 1, 'emmett66@example.org'),
('223456788', 'Tristin', '531 Stamm Ways Suite 180\nEast Charity, NV 78280', 0, 'ekertzmann@example.com'),
('223456789', 'Electa', '2239 Hettinger Harbors Suite 634\nFriesenstad, AR 50057-5873', 1, 'price.santiago@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `cashierviewonlinepayment`
--

CREATE TABLE `cashierviewonlinepayment` (
  `cashierNic` varchar(20) NOT NULL,
  `paymentId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashierviewonlinepayment`
--

INSERT INTO `cashierviewonlinepayment` (`cashierNic`, `paymentId`) VALUES
('223456782', '39049'),
('223456783', '39545'),
('223456786', '39639'),
('223456788', '40524'),
('223456789', '40661'),
('223456782', '40668'),
('223456783', '40676'),
('223456786', '41598'),
('223456788', '41703'),
('223456789', '42322'),
('', ''),
('', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '42322'),
('223456782', '48879');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerNic` varchar(20) NOT NULL,
  `customerFname` varchar(255) NOT NULL,
  `customerLname` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `customerContactNo` int(15) NOT NULL,
  `customerRegDate` varchar(255) NOT NULL,
  `points` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerNic`, `customerFname`, `customerLname`, `customerAddress`, `customerEmail`, `customerContactNo`, `customerRegDate`, `points`) VALUES
('423456780', 'Kristofer', 'Trantow', '08086 Gia Stravenue\nNew Matt, WI 83822', 'vidurarandika96@gmail.com', 929, '2019-12-13 11:08:37', 433),
('423456781', 'Francis', 'Hermiston', '685 Dortha Ville Apt. 791\nEast Lavinialand, WA 19601-7522', 'vidurarandika.uwu.96@gmail.com', 0, '2020-03-08 02:46:22', 4000),
('423456782', 'Lysanne', 'Yost', '16106 Rodrigo Circle Apt. 502\nCasperbury, OK 13258', 'vidurarandika96@yahoo.com', 543, '2020-03-03 07:48:22', 105),
('423456783', 'Nick', 'Pollich', '06419 Georgette Vista\nSouth Beatriceberg, OR 65301', 'vidurarandika96@gmail.com', 0, '2020-04-01 18:07:16', 52),
('423456784', 'Ricardo', 'Gerhold', '89018 Bulah Isle\nAlfredahaven, MT 46328-3490', 'vidurarandika96@gmail.com', 1, '2019-07-24 05:08:29', 217),
('423456785', 'Joana', 'Grant', '967 Cody Causeway Apt. 608\nKayleeville, IN 33873-3985', 'vidurarandika.uwu.96@gmail.com', 539759, '2019-08-07 22:13:04', 115),
('423456786', 'Marion', 'Kuhn', '661 Ludwig Drive\nSouth Eltachester, ID 74365', 'vidurarandika.uwu.96@gmail.com', 1, '2019-09-26 22:52:54', 392),
('423456787', 'Zula', 'Prohaska', '27818 Isadore Causeway\nLincolnmouth, IA 97698-7184', 'vidurarandika96@yahoo.com', 67, '2019-05-13 12:09:12', 81),
('423456788', 'Jaycee', 'Kirlin', '45172 Powlowski Brook Apt. 683\nO\'Konbury, NE 79848', 'vidurarandika96@yahoo.com', 1, '2020-03-19 04:14:26', 257),
('423456789', 'Rosamond', 'Klocko', '56681 Beatrice Centers Suite 498\nLake Dianna, AL 55585', 'vidurarandika.uwu.96@gmail.com', 0, '2019-05-15 11:20:15', 481);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverNic` varchar(20) NOT NULL,
  `driverFname` varchar(255) NOT NULL,
  `driverLname` varchar(255) NOT NULL,
  `driverAddress` varchar(255) NOT NULL,
  `driverEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverNic`, `driverFname`, `driverLname`, `driverAddress`, `driverEmail`) VALUES
('323456780', 'Randal', 'Cruickshank', '9151 Sporer Junctions\nPort Ayanamouth, SC 39472', 'uvacabs0@gmail.com'),
('323456782', 'Walker', 'Welch', '148 Maggio Ports\nNorth Josiane, DC 41523-1906', 'uvacabs0@gmail.com'),
('323456784', 'Melissa', 'Feest', '250 Vandervort Greens\nNorth Adrainbury, ND 74921-0580', 'uvacabs0@gmail.com'),
('323456785', 'Erik', 'Rice', '08064 Solon Roads\nSantoston, WA 91254', 'uvacabs0@gmail.com'),
('323456787', 'Alivia', 'Bins', '986 Brakus Rapid\nBirdieside, WA 10865-9595', 'uvacabs0@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `drivercontactno`
--

CREATE TABLE `drivercontactno` (
  `driverNic` varchar(20) NOT NULL,
  `driverContactNo` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivercontactno`
--

INSERT INTO `drivercontactno` (`driverNic`, `driverContactNo`) VALUES
('323456780', 112568322),
('323456782', 112568320),
('323456784', 112568327),
('323456785', 112568322),
('323456787', 112568328);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `nic`, `password`, `user_type`) VALUES
(1, '423456780', '4da49c16db42ca04538d629ef0533fe8', 'removed'),
(2, '423456781', '4da49c16db42ca04538d629ef0533fe8', 'removed'),
(3, '423456782', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(4, '423456783', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(5, '423456784', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(6, '423456785', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(7, '423456786', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(8, '423456787', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(9, '423456788', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(10, '423456789', '4da49c16db42ca04538d629ef0533fe8', 'user'),
(11, '223456782', '2522c912e778e2e12df9e53b87855ebc', 'cashier'),
(12, '223456783', '2522c912e778e2e12df9e53b87855ebc', 'cashier'),
(13, '223456786', '2522c912e778e2e12df9e53b87855ebc', 'cashier'),
(14, '223456788', '2522c912e778e2e12df9e53b87855ebc', 'cashier'),
(15, '223456789', '2522c912e778e2e12df9e53b87855ebc', 'cashier'),
(16, '323456780', '7680e0b897ea24203f7dd72fcc551715', 'driver'),
(17, '323456782', '7680e0b897ea24203f7dd72fcc551715', 'driver'),
(18, '323456784', '7680e0b897ea24203f7dd72fcc551715', 'driver'),
(19, '323456785', '7680e0b897ea24203f7dd72fcc551715', 'driver'),
(20, '323456787', '7680e0b897ea24203f7dd72fcc551715', 'driver'),
(22, '963021283v', 'a66abb5684c45962d887564f08346e8d', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `onlinepayment`
--

CREATE TABLE `onlinepayment` (
  `paymentId` varchar(255) NOT NULL,
  `payDate` date NOT NULL,
  `charges` float NOT NULL,
  `expiryDate` date NOT NULL,
  `nameOnCard` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `cardNo` double NOT NULL,
  `bookingId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `onlinepayment`
--

INSERT INTO `onlinepayment` (`paymentId`, `payDate`, `charges`, `expiryDate`, `nameOnCard`, `paymentType`, `billingAddress`, `cardNo`, `bookingId`) VALUES
('39049', '1980-01-20', 1874, '1986-10-23', 'Rafaela Kuhn', 'advanced', '78513 Hodkiewicz Loaf\nLake Jerrymouth, OR 36516-8742', 4929142795853, '59040'),
('39545', '1997-04-21', 3339, '2019-03-10', 'Ms. Mabel Feest', 'advanced', '6220 O\'Connell Heights Suite 544\nJoaquinside, PA 01164', 4.916880435249598e15, '64103'),
('39639', '2002-05-21', 3042, '1992-09-16', 'Dr. Olaf Huels', 'full', '024 Harber Avenue Apt. 975\nEast Lorenza, GA 87928', 4485190441650, '61267'),
('40524', '1988-03-29', 1782, '1981-09-04', 'Leonardo Bruen', 'advanced', '7565 Madeline Station\nEast Mable, WV 87969-4597', 4.539025358239429e15, '50908'),
('40661', '1977-06-17', 2506, '1976-12-18', 'Jaleel Blick', 'advanced', '6291 Lamont Pike Apt. 029\nBrannonmouth, WV 59429', 4556495168257, '59871'),
('40668', '1994-03-20', 3225, '2001-07-13', 'Marilou Hyatt', 'full', '1259 Emily Road\nPaucekstad, MS 94198', 4.485178607282302e15, '60953'),
('40676', '1993-10-20', 1232, '1989-05-05', 'Maryse Will', 'full', '17326 Powlowski Brooks Suite 394\nTessport, NM 12721', 5.412330222461353e15, '61638'),
('41598', '1983-04-13', 2187, '2004-03-04', 'Miss Leda Sawayn IV', 'advanced', '506 Rachelle Bridge\nRandallbury, NH 92440', 4716955866329, '55736'),
('41703', '1997-10-11', 3378, '1970-11-22', 'Anne Douglas', 'advanced', '56988 Maverick Mount\nNorth Easterberg, SC 49416', 5.431461915684439e15, '68558'),
('42322', '1985-10-04', 2917, '1986-03-27', 'Jillian Ebert', 'advanced', '48531 Jules Cape Apt. 048\nWest Luismouth, NV 46364-4853', 5.426832058135415e15, '52889'),
('42605', '1975-01-05', 1605, '1988-03-03', 'Hilda Heathcote V', 'full', '405 Moen Crest Apt. 844\nMarianeton, MN 64570-8037', 5.429616696474349e15, '56757'),
('42850', '1995-10-27', 2933, '2003-03-23', 'Miss Suzanne Hahn I', 'full', '7719 Fae Mountain\nLake Mariannastad, NJ 54493', 377788788225065, '46207'),
('43527', '1996-06-08', 1932, '1988-10-13', 'Prof. Mikayla Konopelski DDS', 'advanced', '80777 Carroll View\nLefflerborough, RI 40203-7784', 4.916809585609378e15, '65249'),
('43601', '2016-11-13', 2232, '2006-04-01', 'Liam Bogan', 'advanced', '88823 Saul Club Apt. 031\nLamontfurt, MO 50484-6538', 5.119425263465367e15, '65407'),
('44075', '2006-09-18', 2709, '2018-08-03', 'Myrl Dare', 'advanced', '15914 Floy Shoal\nWest Darianaburgh, IN 69085', 4.55665976666291e15, '50147'),
('44482', '2015-12-07', 2188, '2008-11-11', 'Myrtie Hahn', 'advanced', '510 Mayer Highway Apt. 798\nFaheyfort, ID 89367', 4485857334360, '43692'),
('44578', '1974-03-21', 2789, '1987-11-30', 'Marisol Marks', 'full', '8140 Torey Avenue Apt. 487\nSchmidtport, OK 03126', 4916102502270, '66678'),
('44840', '1992-01-08', 1997, '1975-12-17', 'Ms. Jennyfer Konopelski DVM', 'full', '396 Pascale Route Suite 122\nDavistown, MO 45355', 4134245337266, '40201'),
('45493', '1980-03-04', 2185, '2010-07-31', 'Eliane Franecki', 'full', '736 Stiedemann Divide\nPort Abagail, PA 75189', 4556926623300, '50742'),
('45828', '2006-04-20', 2089, '1973-05-29', 'Amiya Leannon DDS', 'advanced', '038 Dietrich River Apt. 575\nEast Christiana, IA 47985', 6.011398869787148e15, '40094'),
('47135', '1979-06-26', 1266, '2019-09-26', 'Mr. Floyd Pfannerstill', 'full', '512 Waters Heights\nNorth Adolphton, ND 87669-1774', 4616199745709, '48860'),
('47678', '1983-11-01', 3418, '1994-12-11', 'Colin Wiza', 'advanced', '904 Alize Ville Apt. 608\nStiedemannmouth, SD 04386-6257', 5.445742953334685e15, '64763'),
('48117', '2003-02-02', 2983, '1998-06-02', 'Kristian Hauck', 'advanced', '1811 Dicki Mountain Suite 448\nTimmymouth, MO 39155-0294', 4.532736744112379e15, '62182'),
('48341', '2013-08-31', 1233, '1993-08-03', 'Prof. Ross Lindgren', 'advanced', '8789 Leonora Alley Apt. 698\nWest Novabury, MN 29670', 5.52325772231389e15, '63017'),
('48879', '2006-06-06', 3037, '1972-06-24', 'Melisa Ruecker', 'advanced', '6545 Luettgen Extension\nLubowitzburgh, CA 43157', 5.177551003869853e15, '60441');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleNo` varchar(255) NOT NULL,
  `vehicleType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleNo`, `vehicleType`) VALUES
('25734', 'Van(Ac)'),
('26288', 'Car'),
('26375', 'Car'),
('26451', 'Car'),
('26734', 'Van(Non Ac)'),
('26777', 'Van(Non Ac)'),
('26914', 'Van(Ac)'),
('26930', 'Car'),
('27241', 'Van(Ac)'),
('27530', 'Van(Ac)'),
('27652', 'Van(Ac)'),
('28140', 'Van(Non Ac)'),
('28245', 'Van(Ac)'),
('28636', 'Car'),
('28786', 'Van(Non Ac)'),
('28933', 'Car'),
('29053', 'Van(Ac)'),
('29651', 'Van(Ac)'),
('29664', 'Van(Non Ac)'),
('29845', 'Van(Non Ac)'),
('30107', 'Van(Ac)'),
('30131', 'Van(Non Ac)'),
('30486', 'Van(Non Ac)'),
('30631', 'Van(Non Ac)'),
('30647', 'Car'),
('31009', 'Van(Ac)'),
('31189', 'Van(Ac)'),
('31205', 'Van(Non Ac)'),
('31656', 'Van(Ac)'),
('31953', 'Car'),
('32048', 'Van(Non Ac)'),
('32076', 'Van(Non Ac)'),
('32125', 'Van(Non Ac)'),
('32646', 'Van(Non Ac)'),
('32659', 'Van(Non Ac)'),
('32692', 'Car'),
('33090', 'Van(Non Ac)'),
('33194', 'Car'),
('33312', 'Van(Ac)'),
('33371', 'Van(Non Ac)'),
('33671', 'Van(Non Ac)'),
('33770', 'Van(Ac)'),
('33887', 'Car'),
('33913', 'Van(Ac)'),
('34224', 'Car'),
('34314', 'Van(Ac)'),
('34623', 'Van(Non Ac)'),
('35501', 'Car'),
('35592', 'Car'),
('36349', 'Van(Non Ac)'),
('36637', 'Van(Ac)'),
('36725', 'Van(Non Ac)'),
('36744', 'Car'),
('36777', 'Van(Ac)'),
('36905', 'Car'),
('37227', 'Car'),
('37514', 'Van(Non Ac)'),
('37893', 'Car'),
('37941', 'Van(Non Ac)'),
('37972', 'Van(Non Ac)'),
('38205', 'Van(Non Ac)'),
('38333', 'Car'),
('38570', 'Van(Ac)'),
('38895', 'Van(Non Ac)'),
('38920', 'Car'),
('39117', 'Van(Non Ac)'),
('39706', 'Car'),
('39729', 'Van(Ac)'),
('39860', 'Van(Non Ac)'),
('39989', 'Van(Non Ac)'),
('40029', 'Car'),
('40117', 'Van(Ac)'),
('40186', 'Van(Non Ac)'),
('40635', 'Van(Ac)'),
('40780', 'Van(Non Ac)'),
('41150', 'Car'),
('41312', 'Van(Non Ac)'),
('41324', 'Van(Non Ac)'),
('41488', 'Van(Non Ac)'),
('41510', 'Car'),
('41780', 'Van(Non Ac)'),
('42053', 'Car'),
('42057', 'Car'),
('42206', 'Van(Ac)'),
('42611', 'Van(Ac)'),
('42957', 'Van(Ac)'),
('43136', 'Car'),
('43241', 'Car'),
('43306', 'Van(Ac)'),
('43324', 'Van(Non Ac)'),
('43360', 'Van(Ac)'),
('43392', 'Car'),
('43620', 'Van(Ac)'),
('44389', 'Van(Ac)'),
('44403', 'Car'),
('44598', 'Car'),
('44648', 'Van(Non Ac)'),
('44842', 'Car'),
('45050', 'Car'),
('45312', 'Van(Non Ac)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminNic`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashierNic`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerNic`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverNic`);

--
-- Indexes for table `drivercontactno`
--
ALTER TABLE `drivercontactno`
  ADD PRIMARY KEY (`driverNic`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlinepayment`
--
ALTER TABLE `onlinepayment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD UNIQUE KEY `vehicleNo` (`vehicleNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
