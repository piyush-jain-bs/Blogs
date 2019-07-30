-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2019 at 01:45 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainingProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `uid` int(15) NOT NULL,
  `bid` int(15) NOT NULL,
  `title` varchar(35) NOT NULL,
  `s_desc` varchar(40) NOT NULL,
  `image` text NOT NULL,
  `category` varchar(35) NOT NULL,
  `l_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`uid`, `bid`, `title`, `s_desc`, `image`, `category`, `l_desc`) VALUES
(1, 3, 'piyush', 'asdas', 'asdasdasd', 'Toy', 'asdad'),
(68, 4, 'piyush jain', 'asdasdasdasd asdadsa', 'checking', 'Self_Business', 'hello i am piyush jain'),
(66, 5, 'Jain12', 'adadsa', 'checking', 'Business', 'asdsadsada'),
(66, 7, 'sdsdfsdf', 'sdfsdfsdf', 'checking', 'Business', 'sdfsdfs'),
(66, 9, 'retertert', 'dfgfdg', 'checking', 'Self_Business', 'dfgdfgfdgfdg'),
(66, 10, 'errtreter', 'cvbcvb', 'checking', 'Business', 'cvbcvbdgerg'),
(66, 11, 'grtert', 'bcvbvcb', 'checking', 'Business', 'cnvbnvbn'),
(66, 12, 'erwre', 'cvbcvbc', 'checking', 'Business', 'cvbcvbcvb'),
(66, 13, 'erwrwrwer', 'cvbvcbvcb', 'checking', 'Business', 'nvbnretrete asd sad ad sdas d  sa d sad sadsad as dsadas dasd\r\nas\r\nd\r\nasd\r\nas\r\ndas\r\nd\r\n ad asd  as d as d as d as dsad'),
(66, 14, 'piyush jain12', 'Hello', 'checking', 'Business', 'Hi'),
(70, 22, 'Hello piyush', 'hi', 'checking', 'Business', 'Hello '),
(70, 23, 'hskfjh', 'hi', 'checking', 'Business', 'hello'),
(70, 24, 'sddfsfds', 'sfsdfsd', 'checking', 'Business', 'sfsdf'),
(92, 25, 'rehreh', 'ergreh', 'checking', 'Business', 'rgreherh');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `emailTitle` varchar(40) NOT NULL,
  `subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`fname`, `lname`, `email`, `emailTitle`, `subject`) VALUES
('aasdasd', 'dsfdsdfsd', 'sdfsdfsdsdfsdf@gmail.com', 'sfdfsdsdfsdf@gmail.com', 'asdddddddddddddd asdasd'),
('asdasdasd', 'asdasdasd', 'asdasdas@gmail.com', 'rootroasdasdot@gmail.com', 'asddddddddddddd sadas dsa'),
('asdasdasdsadasd', 'asdasdasdasdasd', 'asdasdas@gmail.comasda', 'rootroasdasdot@gmail.comasd', 'asddddddddddddd sadas dsa'),
('asad', 'asdasd', '', '', 'asdasdasd'),
('asdasd', 'iuyuiyioyoi', 'piyush.jain1238@gmail.com', 'rootroasdasdot@gmail.com', 'dddddddd'),
('sdaas', 'sdfsdf', 'piyush.jain@gmail.com', 'sfdfsdsdfsdf@gmail.com', 'dfgfdgfdgfdg'),
('dsdsd', 'dsfdsdfsd', 'piyush123456@gmail.com', 'sfdfsdsdfsdf@gmail.com', 'sdfsad'),
('asdasd', 'iuyuiyioyoi', 'hfdbsf', 'fdbsfdb', 'fdfsbf');

-- --------------------------------------------------------

--
-- Table structure for table `signup_user`
--

CREATE TABLE `signup_user` (
  `uid` int(15) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(35) NOT NULL,
  `mobNo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup_user`
--

INSERT INTO `signup_user` (`uid`, `firstName`, `lastName`, `userName`, `email`, `password`, `mobNo`) VALUES
(1, 'piyush', 'jain', 'Avenger', 'piyush@gmail.com', 'piyush12345', '8005637370'),
(2, 'piyush12', 'jain', 'Avenger', 'piysush@gmail.com', 'piyush12345', '8005637370'),
(3, 'asdasd', 'iuyuiyioyoi', 'SDSA', 'piyush.j11ain@gmail.com', 'pIYUSH12', '9005656784'),
(4, 'asdasd', 'iuyuiyioyoi', 'root', 'piyush.jain@gmail.com', 'pIYUSH1234', '9005656784'),
(6, 'asdasd', 'iuyuiyioyoi', 'SDSA', 'piyush.23j11ain@gmail.com', 'pIYUSH12', '9005656789'),
(9, 'asdad', 'njkh', 'root', 'rootroasdot@gmail.com', 'bigstepA12', '9005656744'),
(11, 'asdasd', 'sasa', 'rootasdas', 'piyush.asdajain@gmail.com', 'bigstepA12', '9005656784'),
(14, 'asdasd', 'sasa', 'rootasdas', 'piyush.assdssajain@gmail.com', 'asasdA112', '9005656784'),
(20, 'adas', 'as', 'asdasd', 'rootrosssot@gmail.com', 'Asadsd2343', '9005656744'),
(22, 'adas', 'asdas', 'root', 'rosssssotroot@gmail.com', 'bigsteA213p', '9005656789'),
(24, 'asdasd', 'jlk', 'root', 'rootrasdasdasdoot@gmail.com', 'bigstepA24334', '9005656744'),
(25, 'adas', 'asdas', 'root', 'rootasdasd@gmail.com', 'asA213bigstep', '9005656744'),
(27, 'asdasd', 'iuyuiyioyoi', 'rootasdasd', 'rootroadsasdot@gmail.com', 'bigstepA23234', '9005656784'),
(28, 'asdasd', 'sasa', 'rootas', 'piyush.1234jain@gmail.com', 'bigstepA21231', '9005656789'),
(31, 'adas', 'asdas', 'roots', 'piyush.jainqweqe@gmail.com', 'A234234bigstep', '9005656789'),
(32, 'adas', 'sa', 'asd', 'roaasdad@gmail.com', 'asdasdA23424', '9005656744'),
(34, 'sdaas', 'asdasd', 'root', 'piyusssssh.jain@gmail.com', 'bigstepA324234', '9005656784'),
(37, 'asdad', 'as', 'root', 'sdasrootroot@gmail.com', 'bigstepA233', '9005656789'),
(40, 'asdad', 'sasa', 'root', 'rootrosdasot@gmail.com', 'bigstepasasdA2132', '9005656784'),
(46, 'adas', 'iuyuiyioyoi', 'rootasd', 'piyush.jasdasin@gmail.com', 'bigstepA213123', '9005656744'),
(47, 'piyush', 'njkh', 'root', 'rosadasdotroot@gmail.com', 'bigstepA12321', '9005656744'),
(48, 'asdad', 'sasa', 'root', 'rootroasdassot@gmail.com', 'bigstepA1321', '9005656784'),
(49, 'ssdfsdfs', 'sdfsdf', 'rootsfsdf', 'rootrosdfsdfot@gmail.com', 'bigstepA23231', '9005656784'),
(51, 'asdasd', 'erwerwerw', 'root', 'rootrowewe23ot@gmail.com', 'AA234234bigstep', '9005656744'),
(53, 'asdad', 'as', 'root', 'rootrooasdasdt@gmail.com', 'bigstepA323213', '9005656789'),
(54, 'asasdasd', 'sdfsdf', 'sdfsdfs', 'rootrsdfsdfoot@gmail.com', 'sdfsdfA234', '9005656789'),
(56, 'asdasd', 'njkh', 'root', 'sdfsdfsdf@gmail.com', 'bigstepA2111323', '9005656784'),
(58, 'sdaas', 'wewerw', 'rootsdfsd', 'rootrosdfsdfsot@gmail.com', 'bigstepA32442', '9005656784'),
(60, 'piyush', 'sdfsdf', 'root', 'ssdddfsdfsdf@gmail.com', 'bigstepA321321', '9005656789'),
(61, 'ssdfsdfs', 'iuyuiyioyoi', 'root', 'rootrasdasdoot@gmail.com', 'bigstepaasdA323', '9005656744'),
(63, 'asdasdffffffffffff', 'asdas', 'rootasasda', 'piyush.jssssssssssssssain@gmail.com', 'bigstepasdaA243234', '9005656789'),
(64, 'piyushasda', 'njkh', 'rootasdasd', 'rootrasdaasddddddddddsdoot@gmail.com', 'bigstepAA123234', '9005656784'),
(65, 'piyushasda', 'asdadsad', 'rootasdasd', 'rootrasdasdaoot@gmail.com', 'bigstepasdasA43234', '9005656744'),
(66, 'piyush', 'jain', 'Rock Pj', 'piyush123456@gmail.com', 'Piyush12345', '8005636303'),
(67, 'asdasdsa', 'asdasda', 'asdassad', 'asdasdsssas@gmail.comasda', 'sadasdA324234', '9005656784'),
(68, 'sfdsdfs', 'sfdsdf', 'sdfsdf', 'sdfssadasddfsdf@gmail.com', 'Piyush12345', '9005656784'),
(69, 'dsdsd', 'sdfsdf', 'sdfsf', '', 'sdfsdfA234', '8798798883'),
(70, 'hello', 'Jain', 'Avenger', 'piyush.jain1238@gmail.com', '67ebccbe7ce51beb81b33d88f53fdaab', '8009067675'),
(71, 'asdasd', 'sdfsdf', 'sdfsdf', 'piyush.jaisdsn@gmail.com', 'ef516fa796b781d327004030c81393ab', '9005656784'),
(72, 'piyush', 'sasa', 'asdasd', 'piyush1234ddd56@gmail.com', '3cecc4f63fe5a31c15a00c35e7c9a7ce', '9424395142'),
(76, 'piyush', 'asdas', 'sdfsf', 'piyushssssss.jain@gmail.com', '8572eed38f62a4c8ac957cd0331f082e', '8798798883'),
(85, 'asdasd', 'iuyuiyioyoi', 'sdfsf', 'rootroodddfdt@gmail.com', '18545c48d78735aa21552f0539cf32d9', '9005656744'),
(88, 'asdasd', 'asdas', 'asdad', 'piyushssssfg123456@gmail.com', '18545c48d78735aa21552f0539cf32d9', '9424395144'),
(90, 'adas', 'sdfsdf', 'sdfsdf', 'piyush3333333333.jain@gmail.com', '18545c48d78735aa21552f0539cf32d9', '9005656789'),
(92, 'asdasddweaf', 'fdgrfhhhfghtkuikjh', 'root', 'pi@gmail.com', 'a883bde368145d717b99c70594fd6069', '8009067678'),
(93, 'asdasd', 'iuyuiyioyoi', 'root', 'wwewer', '18545c48d78735aa21552f0539cf32d9', '9424395142'),
(94, 'sdfgdfg', 'dfgfdg', 'dfgfdg', 'wwewer454', 'dc7ee38396e953a4fc2577b5dde97fe7', '9005656744'),
(95, 'sdfgdfg', 'dfgfdg', 'dfgfdg', 'wweweree', '18545c48d78735aa21552f0539cf32d9', '9005656744'),
(96, 'sdfgdfg', 'dfgfdg', 'dfgfdg', 'wwewerddd@g', '18545c48d78735aa21552f0539cf32d9', '9005656744'),
(97, 'sddfdf', 'sdfsdf', 'sdfsdf', 'wwewer334', '18545c48d78735aa21552f0539cf32d9', '9005656789'),
(98, 'sddfdf', 'sdfsdf', 'sdfsdf', 'wwewer567', '18545c48d78735aa21552f0539cf32d9', '9005656789'),
(99, 'asdasd', 'iuyuiyioyoi', 'sdfsdf', 'wwewer34', '18545c48d78735aa21552f0539cf32d9', '9005656784'),
(100, 'asdasd', 'iuyuiyioyoi', 'sdfsdf', 'piyush', '18545c48d78735aa21552f0539cf32d9', '9005656784'),
(101, 'asdasd', 'iuyuiyioyoi', 'asdasd', 'piyushjain1234@gmail.com', '18545c48d78735aa21552f0539cf32d9', '9005656784'),
(102, 'asdasd', 'iuyuiyioyoi', 'sdfsdf', 'piyush1234eee56@gmail.com', 'c983d071bd4bda32ff24c2234d4fc9a4', '9424395142'),
(103, 'adasa', 'sdfsdf', 'root', 'rooteeeeee@gmail.com', '3840b054e6b7ef12b0fac6440bed1c9e', '9005656789'),
(104, 'asdasd', 'iuyuiyioyoi', 'root', 'roddddot@gmail.com', 'ca95a920b71edd5fa759bd1630cee724', '9087143331'),
(105, 'hdhg', 'hhjkhk', 'jkksyuiyi', 'jkkshfhs@hfh.kl', '767ff9ac14bfa338917e761f7624a3d5', '8009067678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `signup_user`
--
ALTER TABLE `signup_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `bid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `signup_user`
--
ALTER TABLE `signup_user`
  MODIFY `uid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
