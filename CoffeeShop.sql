-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2023 at 04:14 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_deleted`) VALUES
(4, 'Cà phê', 0),
(5, 'Máy móc', 0),
(6, 'Dụng cụ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `commented_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `product_id`, `user_id`, `commented_date`, `is_deleted`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 3, 28, '2023-10-22 16:26:44', 0),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 4, 28, '2023-10-23 12:01:16', 0),
(6, 'San pham that tuyet', 3, 28, '2023-10-24 21:56:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL,
  `sale` double NOT NULL DEFAULT '0',
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `special` int NOT NULL,
  `view` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `sale`, `image`, `entry_date`, `description`, `special`, `view`, `category_id`) VALUES
(3, 'Cà phê Arabica 250g', 250000, 10, 'arabica.png', '2023-10-11 20:11:26', 'Cà phê Arabica tinh khiết được trồng và chăm sóc tận tâm trên những thửa đất phủ đầy cỏ xanh tươi mát, nằm ẩn mình trong vùng nông thôn hữu cơ của chúng tôi. Những hạt cà phê Arabica này được lựa chọn tỉ mỉ, đảm bảo chất lượng và hương vị tốt nhất.\r\n\r\nChúng tôi tự hào giới thiệu một cốc cà phê độc đáo, thăng hoa vị ngon với hương thơm nồng nàn và vị đắng đặc trưng của Arabica. Sự tinh khiết của sản phẩm là kết quả của quy trình chế biến cẩn thận và đội ngũ nông dân tận tâm của chúng tôi. Đây không chỉ là một cốc cà phê, mà còn là một hành trình khám phá vị ngon và tận hưởng sự thư giãn trong từng ngụm.\r\n\r\nHãy đắm chìm trong thế giới hương vị độc đáo và hãy để cà phê Arabica tinh khiết từ chúng tôi đồng hành cùng bạn mỗi sáng. Một kỳ nghỉ đẳng cấp và trải nghiệm cà phê không giống ai đang chờ bạn.', 0, 542, 4),
(4, 'Máy pha cà phê đơn giản', 1000000, 0, 'coffee-maker.png', '2023-10-11 20:11:26', 'Máy pha cà phê cho người yêu cà phê tại nhà\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 1, 82, 5),
(5, 'Bộ ấm đun nước và pha cà phê', 1500000, 0, 'kettle-coffee.png', '2023-10-11 20:11:26', 'Bộ sản phẩm đa năng cho cà phê sáng tạo\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 1, 97, 5),
(6, 'Cà Phê Rang Xay Nguyên Chất Flavor', 150000, 0, 'milk-coffee.png', '2023-10-11 20:11:26', 'Tây Nguyên Soul là đơn vị sản xuất & cung cấp cà phê chất lượng cao từ vùng đất Tây Nguyên. Mang đến trải nghiệm đáng giá về cà phê Việt Nam. Sản phẩm cà phê rang xay của Tây Nguyên Soul có nguồn gốc từ vùng trồng cà phê nổi tiếng chất lượng là Huyện CưM’Gar – Đăk Lăk và Cầu Đất – Lâm Đồng.\r\n\r\nCà Phê Rang Xay Nguyên Chất Flavor là dòng cà phê rang 100% cà phê Arabica mức rang vừa (medium). Vị ít đắng, hương thơm như trái cây và mật ong hòa quyện, clean (trong, sạch), hậu dịu, ngọt nhẹ tự nhiên. ', 0, 151, 4),
(11, 'Coc nhua giu nhiet', 10000, 10, 'coffee-cup.png', '2023-10-19 22:31:03', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur perspiciatis sed soluta natus rem dolorem temporibus quaerat, alias perferendis pariatur impedit similique. Laborum eligendi corporis minus beatae accusamus minima odit!', 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `is_deleted`, `image`, `email`, `is_admin`) VALUES
(28, 'Nguyen Van C1', '123456788', 1, 'person_2.jpg', 'cnv@gmail.com', 1),
(32, 'Nguyen Van G', '12345678', 0, 'person_1.jpg', 'gnv@gmail.com', 0),
(34, 'Nguyen Van I', '12345678', 1, 'person_3.jpg', 'inv@gmail.com', 0),
(35, 'Nguyen Van J', '12345678', 0, 'person_4.jpg', 'jnv@gmail.com', 0),
(55, 'Nguyen Van A', '12345678', 0, 'person_4.jpg', 'anv@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_product_id` (`product_id`),
  ADD KEY `comment_customer_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
