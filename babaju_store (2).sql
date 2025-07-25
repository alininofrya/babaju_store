-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 05:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `babaju_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Aksesoris'),
(1, 'Pria'),
(2, 'Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `shipping_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_order` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `order_items`
--
DELIMITER $$
CREATE TRIGGER `after_order_item_insert` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    -- Kurangi stok produk
    UPDATE products
SET stock_quantity = stock_quantity - NEW.quantity
WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `category_id`, `stock_quantity`, `created_at`, `updated_at`) VALUES
(1, 'Kemeja Batik Pria', 'Kemeja batik lengan panjang motif modern, cocok untuk acara formal dan kasual.', 250000.00, 'Kemeja Batik Modern.jpeg', 1, 12, '2025-07-23 16:46:03', '2025-07-24 07:40:55'),
(2, 'Mini Dress Two-in-One Kemeja dan Korset', 'Kombinasi atasan kemeja lengan panjang berwarna putih bersih yang dijahit menyatu dengan bawahan mini dress atau bustier dress berwarna cokelat gelap (atau warna solid lainnya). Bagian badan dress didesain seperti korset yang membentuk siluet pinggang. Bagian rok bawahnya memiliki potongan asimetris yang unik, lebih pendek di satu sisi atau dengan detail lipatan/potongan tidak rata.', 600000.00, 'dress.jpg', 2, 3, '2025-07-23 16:46:03', '2025-07-24 07:46:37'),
(3, 'Jaket Denim Pria', 'Jaket denim klasik dengan kancing depan penuh, dua saku dada dengan flap kancing, dan dua saku samping di bagian bawah.', 320000.00, 'jaket_denim.jpg', 1, 30, '2025-07-23 16:46:03', '2025-07-24 07:49:04'),
(4, 'Kemeja Oversized Linen', 'Kemeja dengan potongan longgar dan bahan linen yang ringan, memberikan kesan kasual, nyaman, dan sejuk. Ideal untuk cuaca tropis dan gaya santai, bisa dipakai sebagai outer atau kemeja tunggal.', 200000.00, 'OversizedShirt.jpeg', 1, 10, '2025-07-23 17:02:53', '2025-07-24 07:35:18'),
(7, 'Batik Modern Wanita ', '--', 340000.00, 'BatikPink.jpeg', 2, 13, '2025-07-24 07:27:35', '2025-07-24 07:27:35'),
(8, 'Cat-Eye Sunglasses', 'kacamata', 150000.00, 'CatEye Sunglasses.jpeg', 3, 3, '2025-07-24 07:35:50', '2025-07-24 07:35:50'),
(9, 'Jaket Windbreaker', 'jaket ringan yang dirancang khusus untuk melindungi pemakainya dari angin dingin dan seringkali juga dari gerimis atau hujan ringan. Bahan utamanya adalah kain sintetis tipis seperti nilon atau polyester yang memiliki kemampuan windproof (anti angin) dan kadang water-resistant (tahan air).', 300000.00, 'Jaket Windbreaker.jpeg', 1, 6, '2025-07-24 07:51:07', '2025-07-24 07:51:07'),
(10, 'Celana Chino', 'Celana chino dengan panjang sedikit di atas mata kaki, memberikan kesan stylish dan memperlihatkan sepatu Anda. Nyaman dipakai dan serbaguna untuk berbagai acara.', 200000.00, 'Celana Chino.jpeg', 1, 6, '2025-07-24 07:52:17', '2025-07-24 07:52:17'),
(11, 'Outerwear Kimono Modern', 'Outerwear Kimono Modern adalah pilihan sempurna bagi Anda yang mencari busana lapisan luar yang stylish, nyaman, dan serbaguna. Terinspirasi dari siluet kimono tradisional Jepang, outerwear ini dirancang ulang dengan sentuhan modern yang cocok untuk gaya sehari-hari hingga semi-formal.\r\n\r\nDibuat dari bahan ringan dan jatuh seperti rayon, katun premium, linen blend, atau crepe, Kimono Outerwear kami menawarkan kenyamanan maksimal di iklim tropis Pekanbaru. Potongannya yang longgar (flowy) dan tanpa kancing atau resleting memberikan kesan effortless chic dan keleluasaan bergerak.', 200000.00, 'Outerwear Kimono Modern.jpeg', 2, 9, '2025-07-24 07:53:52', '2025-07-25 10:00:24'),
(12, 'Celana Wide-Leg Denim', 'Celana Wide-Leg Denim adalah must-have item yang memadukan kenyamanan celana longgar dengan gaya abadi denim. Didesain dengan potongan lebar yang jatuh lurus dari paha hingga mata kaki, celana ini memberikan siluet modern yang effortless dan cocok untuk berbagai bentuk tubuh.\r\n\r\nTerbuat dari bahan denim berkualitas tinggi (seringkali 100% katun atau campuran katun dengan sedikit spandex untuk kenyamanan ekstra), celana ini menawarkan daya tahan khas denim namun tetap lembut dan nyaman dipakai sepanjang hari. Bagian pinggang tinggi (high-waist) tidak hanya membantu membentuk siluet pinggang, tetapi juga memberikan efek kaki yang lebih jenjang, menjadikan Anda terlihat lebih proporsional.', 150000.00, 'Celana WideDenim.jpeg', 2, 6, '2025-07-24 07:56:34', '2025-07-24 07:56:34'),
(13, 'Topi', 'topi uniqlo', 20000.00, 'Uniqlo Cotton Twill Cap.jpeg', 3, 50, '2025-07-25 11:29:18', '2025-07-25 11:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@babaju.com', '$2y$10$8ymtmnft.sV09KGU14habO6u2SXGyQ87O4YXvUVjVGMG1UoRT.fxG', 'admin', '2025-07-23 16:56:46'),
(2, 'user', 'user1@babaju.com', '$2y$10$RpnV.8cLUhRfCllKLvH5pu3Mbs6gFXQo7ZPvEMFqzjFm01WBnLhBS', 'user', '2025-07-23 16:56:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
