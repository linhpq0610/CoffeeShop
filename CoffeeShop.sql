-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2023 at 12:38 PM
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
-- Database: `du_an_mau_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(4, 'Cà phê'),
(5, 'Máy móc'),
(6, 'Dụng cụ');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `product_id`, `customer_id`, `comment_date`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 3, 28, '2023-10-22 16:26:44'),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 4, 28, '2023-10-23 12:01:16'),
(3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, quis perspiciatis? Ullam minus illum quia aut blanditiis velit a, unde sed, laudantium suscipit ipsum sequi ad error officia ipsa beatae?', 3, 54, '2023-10-24 15:10:47'),
(6, 'San pham that tuyet', 3, 28, '2023-10-24 21:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `password`, `active`, `image`, `email`, `role`) VALUES
(28, 'Nguyen Van C1', '12345678', 1, 'person_2.jpg', 'cnv@gmail.com', 1),
(32, 'Nguyen Van G', '12345678', 0, 'person_1.jpg', 'gnv@gmail.com', 0),
(34, 'Nguyen Van I', '12345678', 0, 'person_3.jpg', 'inv@gmail.com', 0),
(35, 'Nguyen Van J', '12345678', 0, 'person_4.jpg', 'jnv@gmail.com', 0),
(54, 'Linh', '123456789', 0, 'person_2.jpg', 'linhpqpc05353@fpt.edu.vn', 0),
(55, 'Nguyen Van A', '12345678', 0, 'person_4.jpg', 'anv@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL,
  `sale` double NOT NULL DEFAULT '0',
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text COLLATE utf8mb4_general_ci,
  `special` int NOT NULL,
  `view` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `sale`, `image`, `entry_date`, `description`, `special`, `view`, `category_id`) VALUES
(3, 'Cà phê Arabica 250g', 250000, 10, 'arabica.png', '2023-10-11 20:11:26', 'Cà phê Arabica tinh khiết được trồng và chăm sóc tận tâm trên những thửa đất phủ đầy cỏ xanh tươi mát, nằm ẩn mình trong vùng nông thôn hữu cơ của chúng tôi. Những hạt cà phê Arabica này được lựa chọn tỉ mỉ, đảm bảo chất lượng và hương vị tốt nhất.\r\n\r\nChúng tôi tự hào giới thiệu một cốc cà phê độc đáo, thăng hoa vị ngon với hương thơm nồng nàn và vị đắng đặc trưng của Arabica. Sự tinh khiết của sản phẩm là kết quả của quy trình chế biến cẩn thận và đội ngũ nông dân tận tâm của chúng tôi. Đây không chỉ là một cốc cà phê, mà còn là một hành trình khám phá vị ngon và tận hưởng sự thư giãn trong từng ngụm.\r\n\r\nHãy đắm chìm trong thế giới hương vị độc đáo và hãy để cà phê Arabica tinh khiết từ chúng tôi đồng hành cùng bạn mỗi sáng. Một kỳ nghỉ đẳng cấp và trải nghiệm cà phê không giống ai đang chờ bạn.', 0, 535, 4),
(4, 'Máy pha cà phê đơn giản', 1000000, 0, 'coffee-maker.png', '2023-10-11 20:11:26', 'Máy pha cà phê cho người yêu cà phê tại nhà\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 1, 82, 5),
(5, 'Bộ ấm đun nước và pha cà phê', 1500000, 0, 'kettle-coffee.png', '2023-10-11 20:11:26', 'Bộ sản phẩm đa năng cho cà phê sáng tạo\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus omnis nesciunt adipisci vel voluptatem libero laborum, modi aperiam et corporis earum perspiciatis officiis placeat itaque. Fuga amet repellat itaque eaque!', 1, 97, 5),
(6, 'Cà Phê Rang Xay Nguyên Chất Flavor', 150000, 0, 'milk-coffee.png', '2023-10-11 20:11:26', 'Tây Nguyên Soul là đơn vị sản xuất & cung cấp cà phê chất lượng cao từ vùng đất Tây Nguyên. Mang đến trải nghiệm đáng giá về cà phê Việt Nam. Sản phẩm cà phê rang xay của Tây Nguyên Soul có nguồn gốc từ vùng trồng cà phê nổi tiếng chất lượng là Huyện CưM’Gar – Đăk Lăk và Cầu Đất – Lâm Đồng.\r\n\r\nCà Phê Rang Xay Nguyên Chất Flavor là dòng cà phê rang 100% cà phê Arabica mức rang vừa (medium). Vị ít đắng, hương thơm như trái cây và mật ong hòa quyện, clean (trong, sạch), hậu dịu, ngọt nhẹ tự nhiên. ', 0, 151, 4),
(11, 'Coc nhua giu nhiet', 10000, 10, 'coffee-cup.png', '2023-10-19 22:31:03', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur perspiciatis sed soluta natus rem dolorem temporibus quaerat, alias perferendis pariatur impedit similique. Laborum eligendi corporis minus beatae accusamus minima odit!', 1, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_product_id` (`product_id`),
  ADD KEY `comment_customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `comment_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
