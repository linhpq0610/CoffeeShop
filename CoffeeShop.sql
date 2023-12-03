-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2023 at 02:40 PM
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
(4, 'Cà phê', 1),
(5, 'Máy móc', 1),
(6, 'Dụng cụ', 1),
(11, 'Chưa phân loại', 0),
(12, 'cf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `commented_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `commented_date`, `product_id`, `user_id`, `is_deleted`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', '2023-10-22 16:26:44', 3, 28, 0),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', '2023-10-23 12:01:16', 4, 28, 0),
(6, 'San pham that tuyet', '2023-10-24 21:56:46', 3, 28, 1),
(10, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae nobis atque fugiat consectetur ullam quia ad placeat inventore, impedit est odio dolorem laboriosam illo harum consequatur dolorum, vitae id architecto!', '2023-11-06 16:21:36', 3, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `total` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_purchased` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `created_at`, `updated_at`, `is_purchased`, `is_deleted`, `user_id`) VALUES
(1, 500000, '2023-11-28 08:49:42', '2023-11-28 14:06:41', 1, 0, 28),
(2, 400000, '2023-11-28 08:49:53', '2023-11-28 08:49:53', 0, 0, 28);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `price`, `quantity`, `created_at`, `updated_at`, `order_id`, `product_id`) VALUES
(1, 250000, 2, '2023-11-28 08:50:18', '2023-11-28 08:50:18', 1, 3),
(2, 250000, 1, '2023-11-28 08:51:51', '2023-11-28 08:51:51', 2, 3),
(3, 150000, 1, '2023-11-28 08:52:04', '2023-11-28 08:52:04', 2, 6);

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
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `view` int NOT NULL DEFAULT '0',
  `entered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `sale`, `image`, `description`, `view`, `entered_date`, `is_deleted`, `category_id`) VALUES
(3, 'Cà phê Arabica 250g', 250000, 10, 'arabica.png', 'Cà phê Arabica tinh khiết được trồng và chăm sóc tận tâm trên những thửa đất phủ đầy cỏ xanh tươi mát, nằm ẩn mình trong vùng nông thôn hữu cơ của chúng tôi. Những hạt cà phê Arabica này được lựa chọn tỉ mỉ, đảm bảo chất lượng và hương vị tốt nhất.\r\n\r\nChúng tôi tự hào giới thiệu một cốc cà phê độc đáo, thăng hoa vị ngon với hương thơm nồng nàn và vị đắng đặc trưng của Arabica. Sự tinh khiết của sản phẩm là kết quả của quy trình chế biến cẩn thận và đội ngũ nông dân tận tâm của chúng tôi. Đây không chỉ là một cốc cà phê, mà còn là một hành trình khám phá vị ngon và tận hưởng sự thư giãn trong từng ngụm.\r\n\r\nHãy đắm chìm trong thế giới hương vị độc đáo và hãy để cà phê Arabica tinh khiết từ chúng tôi đồng hành cùng bạn mỗi sáng. Một kỳ nghỉ đẳng cấp và trải nghiệm cà phê không giống ai đang chờ bạn.', 561, '2023-10-11 20:11:26', 0, 11),
(4, 'Máy pha cà phê đơn giản', 1000000, 0, 'coffee-maker.png', 'Máy pha cà phê cho người yêu cà phê tại nhà\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 82, '2023-10-11 20:11:26', 0, 11),
(5, 'Bộ ấm đun nước và pha cà phê', 1500000, 0, 'kettle-coffee.png', 'Bộ sản phẩm đa năng cho cà phê sáng tạo\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 100, '2023-10-11 20:11:26', 0, 11),
(6, 'Cà Phê Rang Xay Nguyên Chất Flavor', 150000, 0, 'milk-coffee.png', 'Tây Nguyên Soul là đơn vị sản xuất & cung cấp cà phê chất lượng cao từ vùng đất Tây Nguyên. Mang đến trải nghiệm đáng giá về cà phê Việt Nam. Sản phẩm cà phê rang xay của Tây Nguyên Soul có nguồn gốc từ vùng trồng cà phê nổi tiếng chất lượng là Huyện CưM’Gar – Đăk Lăk và Cầu Đất – Lâm Đồng.\r\n\r\nCà Phê Rang Xay Nguyên Chất Flavor là dòng cà phê rang 100% cà phê Arabica mức rang vừa (medium). Vị ít đắng, hương thơm như trái cây và mật ong hòa quyện, clean (trong, sạch), hậu dịu, ngọt nhẹ tự nhiên. ', 156, '2023-10-11 20:11:26', 0, 11),
(11, 'Coc nhua giu nhiet', 10000, 10, 'coffee-cup.png', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur perspiciatis sed soluta natus rem dolorem temporibus quaerat, alias perferendis pariatur impedit similique. Laborum eligendi corporis minus beatae accusamus minima odit!', 2, '2023-10-19 22:31:03', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `image`, `email`, `is_admin`, `is_deleted`) VALUES
(28, 'Nguyen Van C1', '$2y$10$ei9rcCBexFY.Knx73Lwzvu1fbCAtkPFkKR5xB4ERvpqj0Z2.w3zEy', 'person_2.jpg', 'cnv@gmail.com', 1, 0),
(32, 'Nguyen Van G', '$2y$10$a/rriuXtmZncUlLLva/Qx.B2tnsPGHeG1KdBdYtRdpLWHUWOzEbFe', 'person_1.jpg', 'gnv@gmail.com', 0, 0),
(34, 'Nguyen Van I', '$2y$10$stN9ZRoa5B0sKcMA9oMnnu3w4I9wYzAgOmrhuG9AtxLp45ha2/Tom', 'person_3.jpg', 'inv@gmail.com', 0, 1),
(35, 'Nguyen Van J', '$2y$10$T3ZujVduMUKG/OvXv1JNZuk9POXzSajOn57pPb9wr1V7A/k8cmUg6', 'person_4.jpg', 'jnv@gmail.com', 0, 0),
(55, 'Nguyen Van A', '$2y$10$/uHFjqcwbH57JsMDj4b.gO1izEH0aIAHKk2giBDtlxuIXfyaOLOki', 'person_4.jpg', 'anv@gmail.com', 0, 0),
(59, 'Nguyen Van B', '$2y$10$kDTUDUuTc/pqtHFtmtX8JOlmLKslAztiCZGEHtjXIJKwXMD69zwsS', 'person_2.jpg', 'bnv@gmail.com', 0, 1),
(66, 'Nguyen Van D', '$2y$10$DfLANadHSYW6HvwCn5VebOOkVg0/b8VKIttOiWpaVAmDXRSIwjjgm', 'default-user-image.webp', 'dnv@gmail.com', 0, 1),
(67, 'Nguyen Van F', '$2y$10$DsGRm.dBv81vWlYJdIv7SOYhOVRtSXl3K3Gllp0m/Ilr2G5NQE6ba', 'default-user-image.webp', 'fnv@gmail.com', 0, 0),
(69, 'Nguyen Van H', '$2y$10$zB4QyusjGNkRMcys1YscDO1ujhdooaUAmL3SIm3YEymkbwGUEIc/S', 'person_2.jpg', 'hnv@gmail.com', 0, 0),
(71, 'Nguyen Van K', '$2y$10$GHUhmdIkDmxeNw/HJ7d0cuQIMThzzK6..jKiKRwEGEDfBJt3xmhOW', 'default-user-image.webp', 'knv@gmail.com', 0, 0),
(82, 'Pham Quang Linh', '$2y$10$4shOxmwO3.JJpTmsRGZ26uYXry9tMgIowYjfhYIWNOp5SRCIvEtuu', 'default-user-image.webp', 'phamquanglinh060221@gmail.com', 1, 0);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_users_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_product_id` (`product_id`),
  ADD KEY `order_detail_order_id` (`order_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
