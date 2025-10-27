-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 05:58 PM
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
-- Database: `sancturia_wildlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `animal_name` varchar(100) NOT NULL,
  `animal_type` varchar(50) DEFAULT NULL,
  `sanctuary_name` varchar(200) DEFAULT NULL,
  `adoption_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `donor_name` varchar(100) NOT NULL,
  `donor_email` varchar(150) NOT NULL,
  `donor_phone` varchar(15) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sanctuary_name` varchar(200) DEFAULT NULL,
  `recurring_type` enum('none','monthly','yearly') DEFAULT 'none',
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('pending','completed','failed') DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `user_id`, `donor_name`, `donor_email`, `donor_phone`, `amount`, `sanctuary_name`, `recurring_type`, `donation_date`, `payment_status`) VALUES
(1, 1, 'UserDiscord', 'discordggssv@gmail.com', '7906321188', 100.00, 'General Fund', 'none', '2025-10-23 14:46:23', 'completed'),
(2, 1, 'UserDiscord', 'discordggssv@gmail.com', '7906321188', 1001.00, 'General Fund', 'monthly', '2025-10-23 14:54:15', 'completed'),
(4, 1, 'UserDiscord', 'discordggssv@gmail.com', '7906321188', 500.00, 'General Fund', 'yearly', '2025-10-27 14:59:46', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `sanctuaries`
--

CREATE TABLE `sanctuaries` (
  `sanctuary_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanctuaries`
--

INSERT INTO `sanctuaries` (`sanctuary_id`, `name`, `location`, `description`, `image_path`, `website_url`, `created_at`) VALUES
(1, 'Ranthambore National Park', 'Rajasthan', 'Famous for Bengal tigers and diverse wildlife. Do Visit Once', '/Assets_TBU/Animal Images/img1.jpg', 'https://www.ranthamborenationalpark.com/', '2025-10-23 07:29:56'),
(2, 'Kaziranga National Park', 'Assam', 'Home to the Indian one-horned rhinoceros. Amazing Experience', '/Assets_TBU/Animal Images/img2.jpeg', 'https://www.kaziranganationalpark-india.com/', '2025-10-23 07:29:56'),
(3, 'Jim Corbett National Park', 'Uttarakhand', 'First national park in India known for its diverse fauna.', '/Assets_TBU/Animal Images/img3.jpg', 'http://www.corbettnationalpark.in', '2025-10-23 07:29:56'),
(4, 'Sundarban National Park', 'West Bengal', 'Unique mangrove ecosystem and royal Bengal tigers.', '/Assets_TBU/Animal Images/img4.jpg', 'https://www.sunderbans-national-park.com/', '2025-10-23 07:29:56'),
(5, 'Bandhavgarh National Park', 'Madhya Pradesh', 'Known for large populations of tigers and wildlife safaris.', '/Assets_TBU/Animal Images/img5.jpg', 'http://www.bandhavgarhnationalpark.in', '2025-10-23 07:29:56'),
(6, 'Gir National Park', 'Gujarat', 'Famous for Asiatic lions and diverse flora.', '/Assets_TBU/Animal Images/img6.jpg', 'http://www.girnationalpark.in', '2025-10-23 07:29:56'),
(7, 'Periyar Wildlife Sanctuary', 'Kerala', 'Home to elephants tigers and beautiful landscapes.', '/Assets_TBU/Animal Images/img7.jpg', 'http://www.periyartigerreserve.org', '2025-10-23 07:29:56'),
(8, 'Manas National Park', 'Assam', 'Rich biodiversity and home to endangered species.', '/Assets_TBU/Animal Images/img8.jpg', 'https://whc.unesco.org/en/list/338/', '2025-10-23 07:29:56'),
(9, 'Keoladeo National Park', 'Rajasthan', 'Famous for birdwatching and diverse habitats.', '/Assets_TBU/Animal Images/img9.jpg', 'https://www.tourism.rajasthan.gov.in/keoladeo-ghana-national-park.html', '2025-10-23 07:29:56'),
(10, 'Nagarhole National Park', 'Karnataka', 'Known for its rich wildlife including elephants and tigers.', '/Assets_TBU/Animal Images/img10.jpg', 'https://www.nagaraholetigerreserve.com/en/', '2025-10-23 07:29:56'),
(11, 'Tadoba Andhari Tiger Reserve', 'Maharashtra', 'One of the largest tiger reserves in India.', '/Assets_TBU/Animal Images/img11.jpg', 'https://tadobatigerreserve.in/', '2025-10-23 07:29:56'),
(12, 'Sariska Tiger Reserve', 'Rajasthan', 'Known for its tigers and rich wildlife diversity.', '/Assets_TBU/Animal Images/img12.jpg', 'https://www.sariskaonline.com/', '2025-10-23 07:29:56'),
(13, 'Panna National Park', 'Madhya Pradesh', 'Home to diverse wildlife including leopards and tigers.', '/Assets_TBU/Animal Images/img13.jpeg', 'http://www.pannanationalpark.com/', '2025-10-23 07:29:56'),
(14, 'Satpura National Park', 'Madhya Pradesh', 'Famous for its hilly terrain and wildlife diversity.', '/Assets_TBU/Animal Images/img14.jpg', 'https://www.mptourism.com/', '2025-10-23 07:29:56'),
(15, 'Kanha National Park', 'Madhya Pradesh', 'Known for its vast meadows and tiger population.', '/Assets_TBU/Animal Images/img15.jpg', 'http://www.kanhanationalpark.com/', '2025-10-23 07:29:56'),
(16, 'Pench National Park', 'Madhya Pradesh', 'Home to diverse wildlife and scenic landscapes.', '/Assets_TBU/Animal Images/img16.jpeg', 'http://www.penchnationalpark.com/', '2025-10-23 07:29:56'),
(17, 'Mudumalai Wildlife Sanctuary', 'Tamil Nadu', 'Famous for its elephants and rich biodiversity.', '/Assets_TBU/Animal Images/img17.jpg', 'https://www.mudumalai.org/', '2025-10-23 07:29:56'),
(18, 'Bhitar Kanika Wildlife Sanctuary', 'Odisha', 'Unique estuarine ecosystem with rich wildlife.', '/Assets_TBU/Animal Images/img18.jpeg', 'https://odishatourism.gov.in/', '2025-10-23 07:29:56'),
(19, 'Chinnar Wildlife Sanctuary', 'Kerala', 'Home to endangered species like the Nilgiri Tahr.', '/Assets_TBU/Animal Images/img19.jpeg', 'https://www.keralatourism.org/', '2025-10-23 07:29:56'),
(20, 'Bhadra Wildlife Sanctuary', 'Karnataka', 'Rich in biodiversity and famous for its wildlife.', '/Assets_TBU/Animal Images/img20.jpeg', 'https://www.karnataka.com/', '2025-10-23 07:29:56'),
(21, 'Valley of Flowers National Park', 'Uttarakhand', 'Famous for its stunning alpine flowers and biodiversity.', '/Assets_TBU/Animal Images/img21.jpg', 'https://valleyofflowers.info/', '2025-10-23 07:29:56'),
(22, 'Eravikulam National Park', 'Kerala', 'Home to the Nilgiri Tahr and rich biodiversity.', '/Assets_TBU/Animal Images/img22.jpeg', 'https://www.keralatourism.org/', '2025-10-23 07:29:56'),
(23, 'Rajaji National Park', 'Uttarakhand', 'Known for its rich flora and fauna especially elephants.', '/Assets_TBU/Animal Images/img23.jpg', 'http://www.rajajinationalpark.in/', '2025-10-23 07:29:56'),
(24, 'Mukurthi National Park', 'Tamil Nadu', 'Home to diverse wildlife and beautiful landscapes.', '/Assets_TBU/Animal Images/img24.jpeg', 'https://www.tamilnadutourism.com/', '2025-10-23 07:29:56'),
(25, 'Anamalai Tiger Reserve', 'Tamil Nadu', 'Famous for its tigers and rich flora.', '/Assets_TBU/Animal Images/img25.jpg', 'https://www.tamilnadutourism.com/', '2025-10-23 07:29:56'),
(26, 'Desert National Park', 'Rajasthan', 'Unique desert ecosystem with diverse wildlife.', '/Assets_TBU/Animal Images/img26.jpeg', 'https://www.tourism.rajasthan.gov.in/', '2025-10-23 07:29:56'),
(27, 'Hemis National Park', 'Ladakh', 'Famous for its rugged terrain and unique wildlife.', '/Assets_TBU/Animal Images/img27.jpeg', 'https://www.leh-ladakh-india.com/', '2025-10-23 07:29:56'),
(28, 'Dandeli Wildlife Sanctuary', 'Karnataka', 'Home to rich biodiversity and adventure activities.', '/Assets_TBU/Animal Images/img28.jpeg', 'https://www.karnataka.com/', '2025-10-23 07:29:56'),
(29, 'Simlipal National Park', 'Odisha', 'Known for its stunning landscapes and wildlife.', '/Assets_TBU/Animal Images/img29.jpeg', 'https://odishatourism.gov.in/', '2025-10-23 07:29:56'),
(30, 'Palamau Tiger Reserve', 'Jharkhand', 'Home to tigers and diverse wildlife.', '/Assets_TBU/Animal Images/img30.jpeg', 'https://www.jharkhandtourism.gov.in/', '2025-10-23 07:29:56'),
(31, 'Buxa Tiger Reserve', 'West Bengal', 'Famous for its rich biodiversity and scenic beauty.', '/Assets_TBU/Animal Images/img31.jpeg', 'https://www.wbtourismgov.in/', '2025-10-23 07:29:56'),
(32, 'Mouling National Park', 'Arunachal Pradesh', 'Known for its diverse flora and fauna.', '/Assets_TBU/Animal Images/img32.jpg', 'https://www.arunachaltourism.com/', '2025-10-23 07:29:56'),
(33, 'Sundha Mata Wildlife Sanctuary', 'Rajasthan', 'Home to diverse wildlife in a picturesque setting.', '/Assets_TBU/Animal Images/img33.jpg', 'https://www.tourism.rajasthan.gov.in/', '2025-10-23 07:29:56'),
(34, 'Bannerghatta National Park', 'Karnataka', 'Famous for its wildlife and picturesque landscapes.', '/Assets_TBU/Animal Images/img34.jpg', 'https://www.karnataka.com/', '2025-10-23 07:29:56'),
(35, 'Simbalbara National Park', 'Himachal Pradesh', 'Known for its rich biodiversity in the Himalayas.', '/Assets_TBU/Animal Images/img35.jpg', 'https://himachaltourism.gov.in/', '2025-10-23 07:29:56'),
(36, 'Betla National Park', 'Jharkhand', 'Home to diverse wildlife and beautiful landscapes.', '/Assets_TBU/Animal Images/img36.jpg', 'https://www.jharkhandtourism.gov.in/', '2025-10-23 07:29:56'),
(37, 'Mukundra Hills National Park', 'Rajasthan', 'Famous for its rich biodiversity and scenic beauty.', '/Assets_TBU/Animal Images/img37.jpg', 'https://www.tourism.rajasthan.gov.in/', '2025-10-23 07:29:56'),
(38, 'Great Himalayan National Park', 'Himachal Pradesh', 'Home to unique Himalayan wildlife and flora.', '/Assets_TBU/Animal Images/img38.jpeg', 'https://greathimalayannationalpark.gov.in/', '2025-10-23 07:29:56'),
(39, 'Neora Valley National Park', 'West Bengal', 'Known for its rich biodiversity and scenic landscapes.', '/Assets_TBU/Animal Images/img39.jpg', 'https://www.wbtourismgov.in/', '2025-10-23 07:29:56'),
(40, 'Dudhwa National Park', 'Uttar Pradesh', 'Famous for its diverse wildlife and scenic landscapes.', '/Assets_TBU/Animal Images/img40.jpg', 'http://www.dudhwanationalpark.in/', '2025-10-23 07:29:56'),
(41, 'Nameri National Park', 'Assam', 'Home to one-horned rhinoceroses and rich flora.', '/Assets_TBU/Animal Images/img41.jpg', 'https://www.assamtourism.org/', '2025-10-23 07:29:56'),
(42, 'Murlen National Park', 'Mizoram', 'Known for its unique wildlife and beautiful landscapes.', '/Assets_TBU/Animal Images/img42.jpg', 'https://tourism.mizoram.gov.in/', '2025-10-23 07:29:56'),
(43, 'Ranganathittu Bird Sanctuary', 'Karnataka', 'Famous for its rich birdlife and scenic beauty.', '/Assets_TBU/Animal Images/img43.jpg', 'https://www.karnataka.com/', '2025-10-23 07:29:56'),
(44, 'Cotigao Wildlife Sanctuary', 'Goa', 'Home to diverse wildlife and beautiful beaches.', '/Assets_TBU/Animal Images/img44.jpg', 'https://www.goa-tourism.com/', '2025-10-23 07:29:56'),
(45, 'Kuno Wildlife Sanctuary', 'Madhya Pradesh', 'Known for its rich biodiversity and wildlife.', '/Assets_TBU/Animal Images/img45.jpg', 'https://www.mptourism.com/', '2025-10-23 07:29:56'),
(46, 'Jaldapara National Park', 'West Bengal', 'Famous for its diverse wildlife and river ecosystems.', '/Assets_TBU/Animal Images/img46.jpg', 'https://www.wbtourismgov.in/', '2025-10-23 07:29:56'),
(47, 'Khangchendzonga National Park', 'Sikkim', 'Home to the Khangchendzonga range and unique wildlife.', '/Assets_TBU/Animal Images/img47.jpg', 'https://www.sikkimtourism.gov.in/', '2025-10-23 07:29:56'),
(48, 'Orang National Park', 'Assam', 'Famous for its one-horned rhinoceros and rich biodiversity.', '/Assets_TBU/Animal Images/img48.jpg', 'https://www.assamtourism.org/', '2025-10-23 07:29:56'),
(49, 'Pobitora Wildlife Sanctuary', 'Assam', 'Home to diverse wildlife and beautiful wetlands.', '/Assets_TBU/Animal Images/img49.jpg', 'https://www.assamtourism.org/', '2025-10-23 07:29:56'),
(50, 'Dibru Saikhowa National Park', 'Assam', 'Known for its unique ecosystems and rich biodiversity.', '/Assets_TBU/Animal Images/img50.jpg', 'https://www.assamtourism.org/', '2025-10-23 07:29:56'),
(51, 'Chilika Wildlife Sanctuary', 'Odisha', 'Asia\'s largest brackish water lagoon famous for migratory birds and rich aquatic life.', '/Assets_TBU/Animal Images/img51.jpg', 'https://www.chilika.com/', '2025-10-23 07:29:56'),
(52, 'Nal Sarovar Bird Sanctuary', 'Gujarat', 'A wetland known for its winter migratory birds especially flamingos and pelicans.', '/Assets_TBU/Animal Images/img52.jpg', 'https://www.gujarattourism.com/central-zone/ahmedabad/nalsarovar-bird-sanctuary.html', '2025-10-23 07:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_data` text DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `donation_total` decimal(10,2) DEFAULT 0.00,
  `adoptions_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `donation_total`, `adoptions_count`, `created_at`, `last_login`) VALUES
(1, 'User', 'discordggssv@gmail.com', '$2y$10$d.Z97dAlsGPS98AnRw2j2eSGiLHDxulDWOzmBJ7nuOkvR.DVdwn8q', 1601.00, 0, '2025-10-23 07:57:00', '2025-10-27 15:02:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_donation_date` (`donation_date`);

--
-- Indexes for table `sanctuaries`
--
ALTER TABLE `sanctuaries`
  ADD PRIMARY KEY (`sanctuary_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idx_name` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_last_activity` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sanctuaries`
--
ALTER TABLE `sanctuaries`
  MODIFY `sanctuary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
