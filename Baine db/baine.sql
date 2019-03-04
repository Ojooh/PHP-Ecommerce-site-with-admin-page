-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2019 at 05:31 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baine`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(2, 'K-Wears'),
(3, 'Oxford'),
(4, 'Clarks'),
(5, 'Bvlgari'),
(6, 'Levis'),
(9, 'Polo'),
(10, 'Nike'),
(11, 'Apple'),
(12, 'Hp'),
(13, 'Addidas'),
(14, 'Puma'),
(15, 'Misisipii'),
(17, 'dell'),
(22, 'Herschel'),
(23, 'SAMSUNG'),
(24, 'Baine');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expired_date`, `paid`, `shipped`) VALUES
(40, '[{\"id\":\"39\",\"size\":\"Extra Extra-Large\",\"quantity\":\"2\"}]', '2019-03-23 14:58:25', 1, 0),
(41, '[{\"id\":\"38\",\"size\":\"N/A\",\"quantity\":\"1\"},{\"id\":\"30\",\"size\":\"45\",\"quantity\":\"1\"},{\"id\":\"1\",\"size\":\"16GB\",\"quantity\":\"1\"},{\"id\":\"31\",\"size\":\"Small S\",\"quantity\":\"1\"}]', '2019-03-29 14:01:37', 1, 0),
(42, '[{\"id\":\"31\",\"size\":\"Large L\",\"quantity\":\"1\"},{\"id\":\"34\",\"size\":\"N/A\",\"quantity\":\"1\"},{\"id\":\"29\",\"size\":\"N/A\",\"quantity\":\"1\"}]', '2019-03-31 11:30:54', 1, 0),
(45, '[{\"id\":\"33\",\"size\":\"Medium M\",\"quantity\":\"1\"},{\"id\":\"1\",\"size\":\"16GB\",\"quantity\":\"1\"}]', '2019-04-03 17:15:07', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`, `image`) VALUES
(1, 'Men', 0, '/Baine/Images/cat-banner/banner-02.jpg'),
(2, 'Women', 0, '/Baine/images/cat-banner/banner-01.jpg'),
(4, 'Shirts', 1, ''),
(5, 'Pants', 1, ''),
(6, 'Shoes', 1, ''),
(7, 'Jackets', 1, ''),
(8, 'Shirts', 2, ''),
(9, 'Wig', 2, ''),
(10, 'Accessories', 2, ''),
(18, 'Accessories', 1, ''),
(21, 'Trousers', 2, ''),
(26, 'Bags', 2, ''),
(30, 'Electronics', 0, '/Baine/images/cat-banner/banner-06.jpg'),
(31, 'Laptop', 30, ''),
(33, 'WristWatch', 1, ''),
(34, 'WristWatch', 32, ''),
(35, 'Acessories', 30, ''),
(36, 'Children : Boys', 0, '/Baine/images/cat-banner/banner-10.jpg'),
(37, 'Shirts', 36, ''),
(38, 'Shoes', 36, ''),
(39, 'Caps', 36, ''),
(40, 'Children : Girls', 0, '/Baine/images/cat-banner/banner-11.png'),
(41, 'Shirts', 40, ''),
(42, 'Shoes', 40, ''),
(43, 'Caps', 40, ''),
(44, 'Ipod', 30, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `parent`, `image`, `name`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Ipod Touch (Blue)', '60000.00', '20000.00', 11, '44', '30', '/Baine/images/products/01230e7d7b039aad5efe8f45e9757985.png', '1', 'this is an instagram based ipod', 0, '16GB:3:2,32GB:7:2,64GB:8:2,128GB:3:2,500GB :0:2', 0),
(2, 'Classic trench coat', '12000.00', '8000.00', 6, '10', '2', '/Baine/images/products/0b905e7ec8be8aae3b44f0aedba68288.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 1, 'Small S:4:2,Medium M:6:2,Large L:8:2', 0),
(3, 'Vintage Classic Watch', '6000.00', '5000.00', 5, '18', '1', '/Baine/images/products/e07bcfe4f0deb35fc774917101a75896.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'N/A:5', 1),
(4, 'Front Pocket Jumper', '15000.00', '10000.00', 2, '8', '2', '/Baine/images/products/0dbd3dcfeeb5d4858c2d533c8650321b.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 1, 'Medium M4:4:2,Large:6:2', 0),
(29, 'Vintage Inspired Classic Watch', '12000.00', '11000.00', 5, '33', '1', '/Baine/images/products/f68e621c77049aa8ef77f313a3d836ff.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 1, 'N/A:5:2', 0),
(30, 'Converse All star HiPlimsolls', '8000.00', '6000.00', 13, '6', '1', '/Baine/images/products/f87f5cd43c366efe3b7d287dc3bef9d1.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, '41:4:2,44:4:2,45:5:2,46:5:2,47:8:2', 0),
(31, 'LightWeight Jacket', '8000.00', '10000.00', 13, '7', '1', '/Baine/images/products/990e2aa1a88a77949778ac5d0fbf7126.jpg,/Baine/images/products/001a6fc1ec5eef367f22ba79858b55d3.jpg,/Baine/images/products/f00286ffefaf4935b78b5cc52c6bbb0b.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 1, 'Small S:3:2,Medium M:5:2,Large L :6:2,Extra-Large XL:4:2', 0),
(32, 'Pretty Little Thing', '3000.00', '5000.00', 22, '8', '2', '/Baine/images/products/25765d2e8ca780ab35f3a7bb2546527b.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'Small S:5:2,Large L :6:2', 0),
(33, 'Square Neck Back', '5000.00', '6000.00', 14, '8', '2', '/Baine/images/products/d9cc302b56b213055272c6e9b87554f6.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'Medium M :4:2,Large L :6:2', 0),
(34, 'Herschel Belt', '1500.00', '2000.00', 22, '18', '1', '/Baine/images/products/7e2b993cf96997b2d97b09c2dc12f569.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'N/A:4:2', 0),
(35, 'White T-shirt', '3500.00', '3000.00', 22, '8', '2', '/Baine/images/products/01e90f87a869a710f623cbac2a64c009.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'Small s:2:2,Medium M:5:2,Large L :4:2', 0),
(36, 'Blue Checked Shirt', '4500.00', '4000.00', 22, '4', '1', '/Baine/images/products/181afe185131b33500c61845953fd46a.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'Medium M :8:2,Large L :5:2,Extra-Large XL :4:2', 0),
(37, 'Formal T-shirt', '2500.00', '2000.00', 6, '4', '1', '/Baine/images/products/4d25c06b87852f31a16d4b5c80f0db57.jpg', '1', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'Large L :4:2,Extra-Large XL:5:2', 0),
(38, 'Mini Silver Mesh Watch', '6000.00', '45000.00', 6, '33', '1', '/Baine/images/products/7b9dc37b0a1b3123c8bfc264c3393907.jpg', '19', 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.', 0, 'N/A:6:2', 0),
(39, 'Pieces Metallic Printed', '5000.00', '0.00', 24, '8', '2', '/Baine/images/products/8db10cee5e92e85e0b0ed5cbb59e8bbd.jpg', '1', 'Something nice and tingly to the eye just right for every girl to display her inner woman, dashed with a twinkle of bright stars shine your light for all too see', 0, 'Small S :6:2,Medium M :4:2,Large L :5:2,Extra-Large XL:8:2,Extra Extra-Large:2:2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `rating`, `review`) VALUES
(1, 'Ariana Grande', 'ariana@gmail.com', 5, 'Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos'),
(2, 'opeyemi', 'ope@gmail.com', 1, 'With an intuitive power setting that automatically increases as needed, this model gave us better quality smoothies than blenders twice its price.'),
(29, 'david', 'ije@gmail.com', 2, 'I answered this about a year and a half ago, and I realized this will probably make the page lag, so don&#039;t do this!\r\nIf you want the attribute to update as the value of the variable changes, try putting the above JavaScript after do{variableold=variable} while(variable!==variableold) inside a forever loop (while(1)).'),
(37, 'david', 'ojeride@gmail.com', 4, 'the shirt is really nice and fitting qquality make i must add'),
(37, 'ope@gmail.com', 'ope@gmail.com', 2, 'I did not really like the shirt'),
(39, 'Opeyemi Ifang', 'ope@gmail.com', 4, 'not so bad once you get the hang of it quite very simple');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `states` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `states`, `parent`) VALUES
(2, 'Abia state', 0),
(3, 'Aba North LGA \r\n', 2),
(4, 'Edo state', 0),
(5, 'Aba South LGA', 2),
(6, 'Adamawa State', 0),
(7, 'Akwa Ibom State', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) NOT NULL,
  `cart_id` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(175) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(175) NOT NULL,
  `lga` varchar(175) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `city`, `state`, `lga`, `total`, `tax`, `sub_total`, `description`, `txn_type`, `txn_date`) VALUES
(15, '', 40, 'Uloko Gloria', 'bolu@gmail.com', 'No. 16 Asokoro District Opposite World Bank.', 'Abuja', 'Abia state', 'Aba North LGA', '10000.00', '1150.00', '11150.00', '1 item from Baine Stores.', '', '2019-02-21 14:58:56'),
(16, '', 41, 'Uloko Gloria', 'bolu@gmail.com', 'No. 16 Asokoro District Opposite World Bank.', 'Abuja', 'Abia state', 'Aba North LGA', '82000.00', '1150.00', '83150.00', '4 items from Baine Stores.', '', '2019-02-27 14:02:59'),
(17, '', 42, 'Mr. Fox Bright', 'bolu@gmail.com', '1 Aguiyi Ironsi St, Maitama 900001 off Agunyi ironsi street opposite MTN shop', 'Abuja', 'Abia state', 'Aba South LGA', '21500.00', '1150.00', '22650.00', '3 items from Baine Stores.', '', '2019-03-01 11:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `directions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `name`, `email`, `number`, `password`, `city`, `state`, `lga`, `address`, `directions`, `receiver`) VALUES
(1, 'Ife ifeanyi', 'ife@gmail.com', '+2348034567210', '$2y$10$D84zS0SDAGhuVsC2e8rGg.OzNnS1NWi6NaHuZklG0/AtJd0fjzQim', 'WUEIII', 'AJEHH', 'AGHE', 'PLOT 567 CRESCENT', 'AFTER ROUND ABOUT', 'IFANG JAMEY'),
(7, 'Bolu watife', 'bolu@gmail.com', '07080603000', '$2y$10$bpZitvoixhgKR4NXFosCxO5eYxNyfG3NrtErCSVphguaD/B/frK1y', 'Abuja', '2', '5', '1 Aguiyi Ironsi St, Maitama 900001', 'off Agunyi ironsi street opposite MTN shop', 'Mr. Fox Bright'),
(8, 'Opeyemi Ifang', 'ope@gmail.com', '08056734445', '$2y$10$tdnUjJyxe/AqM0JP4mYlsOAYKYMuiiYJLmWDEU7ajwjtjsolt375O', 'serig', '2', '3', 'sdfg bhytr gkkk', 'Hot dot or not hot dog classifier. If you are a fan of the Silicon Valley TV series, definitely try to build this kind of classifier. Check out this video. The guy in the video built a somewhat similar classifier by using the Google Cloud service.', 'Mr. Fox Bright'),
(9, 'Daniel ojo', 'afediran@gmail.com', '$number', '$2y$10$HjaQw2CalbKgk199wJ3DjeqawNWM/x3jieBtpfThJAJ9lHVpde5kq', '$city', '$state', '$lga', '$address', '$directions', '$receiver');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `Occupation`, `password`, `join_date`, `last_login`, `permissions`, `number`, `images`) VALUES
(1, 'Abimbola Matt-ojo', 'amattojo@gmail.com', 'UI Designer', '$2y$10$UF/S1H1hCSRp1YR9xS2SuezxmcPezEuHLQgiz3iJ7y9rsBcjPG8P.', '2018-12-23 00:39:33', '2019-01-22 22:16:23', 'editor', '+2348037022716', '/Baine/admin2/img/profile_pic/bg-1.jpg'),
(2, 'Matt-Ojo David', 'davidmatthew708@gmail.com', 'Web Developer', '$2y$10$c4Ja01oOtEPxaVzm.ekjpuofkyr33dauUEmPurXyoO6ScHt5wSEqG', '2018-08-06 23:01:35', '2019-03-04 10:48:26', 'admin,editor', '+2347042956783', '/Baine/admin2/img/profile_pic/bg-1.jpg'),
(11, 'Deborah Emmanual', 'debby4life@yahoo.com', 'Art Director', '$2y$10$xPckjb4PrXLr3QJoUvrGe.NwcEblhXvF5uhuj7Aq1gI0aufsAiCVy', '2019-01-08 15:06:13', '2019-01-08 15:06:34', 'admin,editor', '+2348034567218', '/Baine/admin2/img/profile_pic/d9970c8b45dae11614d175745efffbbb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `number`, `password`, `facebook`, `instagram`) VALUES
(1, 'Emeka David', 'emeka@gmail.com', '+234837022716', '$2y$10$JmFIM.T7Jzx.SWfwi.yHRuR8tEeHVuZr7mwPB1C40/W3drNV7J8Yi', 'facebook/emeka.com', 'emekainstagram.com'),
(5, 'Esther Davis', 'esther904@gmail.com', '08033231216', '$2y$10$XcEawE0PSetZAzJl4VqYBeYo4caMEt5ht7cTes72jcNokO4y.50Qe', 'www.facebook/davis.com', 'www.instagram/davis.com'),
(19, 'AgozieFavour', 'fagozie43@gmail.com', '27800176567', '$2y$10$cbAvgrWDHJriXcfp/ZJttOLq6ynCGTHMABfBrgU3re8u3a5WH2g/e', 'Favour Agozie', 'favor_gozie'),
(29, 'AbimbolaMatthew', 'amatttojo@yahoo.com', '08056734445', '$2y$10$JJrU8CILvFkrHdVeX1u8tOhLh8D6kwxJrYL7ND94gr05uwmnyUAH2', 'abimbola.mattojo', 'abimbolamattojo');

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `id` int(11) NOT NULL,
  `items` text NOT NULL,
  `expired_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wish`
--

INSERT INTO `wish` (`id`, `items`, `expired_date`) VALUES
(14, '[{\"id\":\"33\",\"size\":\"Medium M :4,Large L :6\"},{\"id\":\"34\",\"size\":\"N/A:5\"},{\"id\":\"30\",\"size\":\"44:4,45:6,50:8\"},{\"id\":\"29\",\"size\":\"N/A:6\"}]', '2019-02-21 22:20:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
