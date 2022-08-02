-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220719.04fabfdc7e
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 11:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplengkainan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `date`) VALUES
(1, 'admin', '$2y$10$mI/hpZ59vGgjs/lPTQWLJu.I82O93AEJ3gwFycAjuibOjAGi9dcTm', 'admin123@gmail.com', '2021-02-26 16:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `r_id`, `name`, `about`, `price`, `img`) VALUES
(23, 8, 'Beef Ontama Bukkake Udon', 'Beef Ontama Bukkake Udon has thick udon noodles, flavorful beef stock, and strips of beef.', 220, 'beef_udon.jpg'),
(24, 8, 'Teriyaki Chicken and Beef Yakiniku Bowl', 'A savory and sweet teriyaki mix of tender chicken and beef yakiniku served with egg and kimchi.', 225, 'yakiniku_chickenbeef.jpg'),
(25, 8, 'Katsu Curry Rice', 'Crispy pork katsu topped with flavorful curry on a bed of hot rice.', 275, 'katsu_curry.png'),
(26, 9, 'Crispy Pork Kawali', 'Our specialty crispy pork kawali, Manam style. Serves 2-3 pax.', 425, 'pork_kawali.jpg'),
(27, 9, 'Lamb Adobo', 'Tasty lamb adobo with a handful of garlic. Serves 2-3 pax.', 635, 'lamb_adobo.jpg'),
(29, 9, 'House Crispy Sisig', 'Manam\'s special crispy sisig. Topped with fried garlic chips. Serves 2-3 pax.', 335, 'crispy_sisig.jpg'),
(30, 10, 'Bak Chor Mee', 'The ground pork used in this minced pork noodles stir fry  is cooked in a blend of hoisin sauce and sichuan  peppercorns.', 185, 'bakchormee.png'),
(31, 10, 'Hokkien Mee', 'The famous prawn noodle. A platter of glossy yellow and white noodles,  orange shrimp, white squid rings, and green Chinese chives  steeped in a sauce made of seafood broth.', 175, 'kl-hokkien-mee.jpg'),
(32, 10, 'Sweet and Sour Pork', 'A stir-fried authentic meal from China composed with succulent  pork tenderloin, bell peppers, onions, and pineapple.', 150, 'sweetnpork.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `r_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `o_hr` varchar(255) NOT NULL,
  `c_hr` varchar(255) NOT NULL,
  `o_days` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`r_id`, `c_id`, `name`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `img`) VALUES
(8, 8, 'Marugame Udon', 'marugameudonPH@gmail.com', '68366', 'https://marugameudon.ph', '10am', '9pm', 'mon-sat', 'SM North EDSA 2nd Floor', 'MarugameUdon.png'),
(9, 9, 'Manam', 'manam@gmail.com', '12345678', 'https://manam.ph', '11am', '9pm', 'mon-sat', 'Ayala Malls by the Bay Ground Floor', 'manam.png'),
(10, 4, 'Toa Payoh Hawker', 'toapayoh@gmail.com', '87654321', 'https://hawkertoapayoh.ph', '9am', '9pm', 'mon-fri', 'BGC', 'toa_payoh.png');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`) VALUES
(4, 'Chinese'),
(8, 'Japanese'),
(9, 'Filipino');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `activation_code` varchar(30) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `activation_code`, `active_status`) VALUES
(34, 'taylor', 'Paul Taylor', 'Swift', 'paulty@gmail.com', '0912345678', '$2y$10$lfhMkQGtcybp5It/H1I0YOMY7gRAbwbnsd0kJFiLnn86v4mTbtJKy', 'B 12 L 25 Bernardo Carpio, Brgy. Kawayan, Q.C.', NULL, 1),
(38, 'Cleir09', 'AC', 'Restua', 'yanna.ac09@gmail.com', '09399504990', '$2y$10$GE/bH/GmdUac1zugfMbMZ.AFGFYO/W4ZDPw9TzkcJyRjeSBPr/.C2', 'Block 79 Lot 20 Barangay Greater Lagro, Q.C.', 'lsatEd5xeLRT2Iom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `success-date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`o_id`, `u_id`, `d_id`, `d_name`, `quantity`, `price`, `status`, `date`, `success-date`, `r_id`) VALUES
(34, 34, 24, 'Teriyaki Chicken and Beef Yakiniku Bowl', 1, 225, 'in process', '2022-07-20 19:47:26', '2022-07-20 17:47:52', 8),
(35, 34, 23, 'Beef Ontama Bukkake Udon', 1, 220, 'in process', '2022-07-20 19:47:26', '2022-07-20 17:47:49', 8),
(36, 34, 29, 'House Crispy Sisig', 1, 335, 'closed', '2022-07-20 19:48:07', '2022-07-20 17:48:17', 9),
(37, 38, 30, 'Bak Chor Mee', 1, 185, 'in process', '2022-07-21 10:04:25', '2022-07-21 08:04:40', 10),
(38, 38, 32, 'Sweet and Sour Pork', 1, 150, 'in process', '2022-07-21 10:04:25', '2022-07-21 08:05:10', 10),
(39, 38, 23, 'Beef Ontama Bukkake Udon', 1, 220, NULL, '2022-07-21 10:05:33', '2022-07-21 02:05:33', 8),
(40, 38, 27, 'Lamb Adobo', 1, 635, 'rejected', '2022-07-21 10:05:59', '2022-07-21 08:06:11', 9),
(41, 38, 27, 'Lamb Adobo', 1, 635, 'closed', '2022-07-21 10:06:29', '2022-07-21 08:06:38', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
