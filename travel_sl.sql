-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2025 at 07:55 AM
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
-- Database: `travel_sl`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL,
  `status` enum('active','inactive','pending') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `excerpt`, `thumbnail`, `content`, `submitted_by`, `status`, `created_at`, `updated_at`) VALUES
(19, 'Hiking to Ella Rock', 'A must-do hike offering stunning views of tea estates and mountain valleys.', '6870d65211e14_polina-kocheva-7olhiroe8g8-unsplash.jpg', 'Hiking to Ella Rock is a breathtaking adventure that rewards you with panoramic views of lush tea plantations, rolling hills, and distant waterfalls. \r\nThe trail starts near Ella railway station and winds through peaceful countryside, local vegetable gardens, and hidden viewpoints. \r\nWhile the climb is moderately challenging, the sunrise at the summit is well worth the effort. \r\n\r\nThis is a perfect experience for nature lovers and photographers seeking a unique Sri Lankan adventure beyond the usual tourist spots.', 11, 'pending', '2025-07-11 09:16:02', '2025-07-11 16:39:08'),
(20, 'Temple of the Tooth Story', 'Discover the sacred legend behind Kandy’s most revered temple.', '6870d6c24b92c_chathura-anuradha-subasinghe-isdvqf04MDk-unsplash.jpg', 'The Temple of the Tooth Relic in Kandy holds Sri Lanka’s most treasured Buddhist relic—a tooth of the Buddha himself. \r\nPilgrims from across the world gather to pay their respects, especially during the grand Esala Perahera festival. \r\nBeyond spiritual significance, the temple complex boasts stunning architecture, golden roofs, and a serene lakeside setting. \r\nWalking its sacred halls offers visitors a deep connection to the island’s spiritual heart and a glimpse into centuries-old traditions that continue today.', 11, 'active', '2025-07-11 09:17:54', '2025-07-11 09:37:49'),
(21, 'A Culinary Journey in Lanka', 'Spice up your trip with authentic Sri Lankan food experiences.', '6870d74868534_zoshua-colah-9iMvxXPtFCU-unsplash.jpg', 'Sri Lanka’s cuisine is a delightful mix of bold spices, tropical flavors, and colorful dishes. \r\nFrom creamy coconut milk curries to fiery sambols and crispy hoppers, each meal is an adventure.\r\n Join a local cooking class in Kandy, visit bustling markets in Colombo, or savor street food at a seaside stall in Galle. \r\nSharing meals with locals reveals stories, traditions, and warm hospitality at every table. \r\nLet your taste buds explore the island as deeply as your feet .', 11, 'active', '2025-07-11 09:20:08', '2025-07-11 15:03:27'),
(22, 'Wildlife Safari Secrets', 'Tips to enjoy unforgettable wildlife encounters in Sri Lanka’s national parks.', '6870d7c470415_hector-john-periquin-pRxm8cc953U-unsplash.jpg', 'Sri Lanka’s national parks are some of the best places in Asia to see wildlife up close. \r\nYala is famous for leopards, while Udawalawe promises large elephant herds. \r\nMinneriya hosts the “Gathering,” where hundreds of elephants meet by the water. Knowledgeable guides make your safari safe and memorable, helping you spot rare birds, sloth bears, and more. \r\nRespectful, eco-friendly travel is vital to protect these animals and ensure future generations can enjoy their beauty in the wild.', 11, 'active', '2025-07-11 09:22:12', '2025-07-11 09:37:54'),
(23, 'Romantic Getaways in Lanka', 'The most enchanting spots for couples looking to escape together.', '6870d85c57085_nathan-dumlao-w5hhoYM_JsU-unsplash.jpg', 'From candlelit dinners on secluded beaches to sunrise tea garden walks, Sri Lanka offers many romantic experiences for couples.\r\n Enjoy luxury boutique hotels in Galle, share a spa day in the hills of Nuwara Eliya, or sail together on a private catamaran at sunset. \r\nWhether you’re on a honeymoon or simply rekindling your connection, Sri Lanka’s natural beauty and warm hospitality create unforgettable intimate moments you’ll cherish forever.', 11, 'active', '2025-07-11 09:24:44', '2025-07-11 09:37:37'),
(24, 'Tea Trails and Tastings', 'Explore Sri Lanka’s lush tea country and its charming colonial heritage.', '6870dae476c96_train-from-kandy-to-the-tea-country-kandy-sri-lanka-1024x575.jpg.avif', 'Sri Lanka’s hill country is a dreamy patchwork of emerald tea estates, misty mountains, and quaint old-world bungalows.\r\nVisiting a working tea factory lets you follow the journey from leaf to cup and learn about the island’s proud tea-making traditions.\r\nEnjoy scenic walks through plantations in Nuwara Eliya and Ella, guided tastings, and authentic high tea experiences.\r\nThese moments transport you to another era while showcasing why Sri Lanka’s Ceylon tea remains world-famous.', 11, 'active', '2025-07-11 09:35:32', '2025-07-11 09:37:43'),
(25, 'East Coast Snorkeling Guide', 'Discover the colorful underwater world along Sri Lanka’s east coast.', '6870dc86f2f47_bridger-bowcutt-3Xrgr7EoY6w-unsplash.jpg', 'The east coast’s warm, clear waters reveal vibrant coral gardens and diverse marine life, making it a paradise for snorkelers.\r\nTrincomalee’s Pigeon Island is a must-visit, where sea turtles, reef sharks, and tropical fish await. \r\nNilaveli and Passikudah offer quieter shores perfect for relaxed underwater adventures. \r\nLocal guides ensure safety and share insights about marine conservation. \r\nAdd these snorkeling spots to your itinerary and dive into a colorful world few travelers get to experience.', 11, 'active', '2025-07-11 09:42:30', '2025-07-11 09:49:20'),
(26, 'Ancient Cities of Sri Lanka', 'Step back in time exploring Sri Lanka’s UNESCO World Heritage cities.', '6870dcd70d320_isuru-ranasinha-Dt1NksEP_yY-unsplash.jpg', 'Sri Lanka’s ancient cities, like Anuradhapura and Polonnaruwa, tell powerful stories of kings, kingdoms, and Buddhism’s spread across the island. \r\nMarvel at massive stupas, intricately carved statues, and sacred Bodhi trees that have stood for centuries. \r\nWalking among these ruins feels like stepping into a living history book. \r\nExperienced guides bring legends to life, making each site not just a photo stop but a chance to truly understand Sri Lanka’s spiritual and cultural foundation.', 11, 'active', '2025-07-11 09:43:51', '2025-07-11 09:49:06'),
(27, 'Surfing for Beginners', 'Your guide to learning to surf safely on Sri Lanka’s friendliest waves.', '6870dde9c21cc_lisa-van-vliet-8-0bFmokwmU-unsplash.jpg', 'Sri Lanka is a dream destination for beginner surfers thanks to its gentle waves and warm waters.\r\nBeaches like Weligama and Hikkaduwa are perfect places to take your first lesson or improve your skills. Local instructors are friendly and experienced, offering safe, fun learning environments for all ages. \r\nAfter a session, unwind with fresh coconuts and beachside seafood. \r\nSurfing here isn’t just a sport—it’s a joyful way to connect with the ocean and the laid-back island lifestyle.', 11, 'active', '2025-07-11 09:48:25', '2025-07-11 09:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `num_adults` int(11) DEFAULT 1,
  `num_children` int(11) DEFAULT 0,
  `start_date` date NOT NULL,
  `alt_date` date DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `passport_number` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `hotel_category` enum('3-star','4-star','5-star') DEFAULT '3-star',
  `meal_plan` enum('Breakfast only','Half board','Full board') DEFAULT 'Breakfast only',
  `room_type` enum('Single','Double','Triple') DEFAULT 'Double',
  `pkgz` varchar(20) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_relation` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(50) DEFAULT NULL,
  `emergency_contact_email` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Partially Paid','Failed') DEFAULT 'Pending',
  `amount_paid` decimal(10,2) DEFAULT 0.00,
  `booking_status` enum('Pending','Confirmed','Cancelled','Completed') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `package_id`, `num_adults`, `num_children`, `start_date`, `alt_date`, `full_name`, `email`, `contact_number`, `nationality`, `passport_number`, `date_of_birth`, `gender`, `hotel_category`, `meal_plan`, `room_type`, `pkgz`, `special_requests`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_phone`, `emergency_contact_email`, `payment_method`, `payment_status`, `amount_paid`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, 1, 35, 2, 1, '2025-07-10', '2025-07-12', 'janindu gaurinda', 'admin@gmail.com', '0702106938', 'sri lanka', '3444445456566', '2025-07-07', 'Male', '5-star', 'Full board', 'Double', '', '', 'janindu', 'mom', '222222222', 'admin@gmail.com', NULL, 'Pending', 0.00, 'Pending', '2025-07-10 19:30:29', '2025-07-10 19:30:29'),
(2, 1, 35, 2, 1, '2025-07-10', '2025-07-12', 'janindu gaurinda', 'admin@gmail.com', '0702106938', 'sri lanka', '3444445456566', '2025-07-07', 'Male', '5-star', 'Full board', 'Double', '', '', 'janindu', 'mom', '222222222', 'admin@gmail.com', NULL, 'Pending', 0.00, 'Pending', '2025-07-10 19:31:19', '2025-07-10 19:31:19'),
(3, 11, 40, 1, 1, '2025-07-11', '2025-07-15', 'janindu gaurinda', 'admin@gmail.com', '0123456987', 'sl', '000001445', '2025-07-01', 'Male', '5-star', 'Full board', 'Double', '', '', 'cccccccccccccccc', 'ccccccc', '0123456987', 'ja@gmail.com', NULL, 'Pending', 0.00, 'Pending', '2025-07-10 20:41:50', '2025-07-10 20:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `tagline` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `entered_by` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `name`, `image_path`, `tagline`, `description`, `status`, `entered_by`, `created_at`, `updated_at`) VALUES
(9, 'Sigiriya', '6870c63eebd16_sander-traa-bfdshIHD5Y4-unsplash.jpg', 'The Lion Rock Fortress\",\r\n\r\nA UNESCO World Heritage site, Sigiriya offers stunning views, ancient frescoes, and fascinating rock fortress history.', NULL, 'active', NULL, '2025-07-11 08:07:26', '2025-07-11 08:07:26'),
(10, 'Kandy', '6870c6ad4742d_florian-wehde-btc7lo_Er4Y-unsplash.jpg', '\"Cultural Capital of Sri Lanka\", Home to the sacred Temple of the Tooth Relic and vibrant traditional dance, Kandy beautifully blends spirituality and culture.', NULL, 'active', NULL, '2025-07-11 08:09:17', '2025-07-11 08:09:17'),
(11, 'Ella', '6870c70b15009_mariana-proenca-5o3ODxRQCfI-unsplash.jpg', '\"The Misty Mountain Village\", Famous for scenic train rides, Nine Arches Bridge, and breathtaking hiking trails surrounded by lush tea plantations.', NULL, 'active', NULL, '2025-07-11 08:10:51', '2025-07-11 08:10:51'),
(12, 'Mirissa', '6870c7586e5a1_oliver-frsh-guDSo1bPXDk-unsplash.jpg', '\"Whale Watching Paradise\", A laid-back beach town known for whale watching, surfing, and relaxing sunsets on its golden sands.', NULL, 'active', NULL, '2025-07-11 08:12:08', '2025-07-11 08:12:08'),
(13, 'Galle', '6870cc96ef50a_sarmat-batagov-j5X4k3SLMo8-unsplash.jpg', '\"The Dutch Fort City\", Explore the colonial-era Galle Fort, charming cobblestone streets, and oceanfront cafes filled with art and history.', NULL, 'active', NULL, '2025-07-11 08:34:30', '2025-07-11 08:34:30'),
(14, 'Nuwara Eliya', '6870cd2857713_anton-lecock-TPtaNsBOW9Q-unsplash.jpg', '\"Little England in the Hills\", Cool climate, picturesque tea estates, and colonial architecture make this mountain city a unique highland escape.', NULL, 'active', NULL, '2025-07-11 08:36:56', '2025-07-11 08:36:56'),
(15, 'Yala National Park', '6870cdae766fe_geoff-brooks-3TwThGdEUZA-unsplash.jpg', '\"Wildlife Safari Experience\",  Home to leopards, elephants, and diverse birdlife, Yala offers one of the best wildlife safaris in Asia.', NULL, 'active', NULL, '2025-07-11 08:39:10', '2025-07-11 08:39:10'),
(16, 'Trincomalee', '6870ce70d89f4_anthony-lim-ShfoRr-i3fw-unsplash.jpg', '\"East Coast Gem\", Renowned for crystal-clear beaches, diving at Pigeon Island, and historical Hindu temples overlooking the sea.', NULL, 'active', NULL, '2025-07-11 08:42:24', '2025-07-11 08:42:24'),
(17, 'Bentota', '6870ceeedfc8a_hamza-shaikh-tvy3ljEf2xw-unsplash.jpg', '\"Rivers & Relaxation\", Perfect for water sports, river safaris, and luxury beach resorts, Bentota offers a tranquil coastal retreat.', NULL, 'active', NULL, '2025-07-11 08:44:30', '2025-07-11 08:44:30'),
(18, 'Anuradhapura', '6870cfa40a70f_izuru-kannagara-UeSfcl4xreE-unsplash (1).jpg', '\"Ancient City of Kings\", One of Sri Lanka’s ancient capitals, filled with massive stupas, sacred Bo trees, and centuries-old ruins.', NULL, 'active', NULL, '2025-07-11 08:47:32', '2025-07-11 14:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `review_text` text NOT NULL,
  `statusfeedback` enum('active','inactive','pending') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `country`, `review_text`, `statusfeedback`, `created_at`, `updated_at`) VALUES
(16, 11, 'CN', '\"We had an amazing experience in Sri Lanka! The itinerary was perfectly planned, and the guide was super friendly and knowledgeable.\"', 'active', '2025-07-11 10:54:38', '2025-07-11 10:59:11'),
(17, 11, 'AT', '\"Beautiful beaches, delicious food, and very professional service. Highly recommend this agency to anyone visiting Sri Lanka!\"', 'active', '2025-07-11 10:54:52', '2025-07-11 10:59:30'),
(18, 11, 'AU', '\"Our family tour was unforgettable. The kids loved the safaris and train rides. Thank you for the excellent arrangements and personal touch!\"', 'active', '2025-07-11 10:55:05', '2025-07-11 10:59:30'),
(19, 11, 'UA', '\"Fantastic service from start to finish. We felt safe and cared for throughout. Sri Lanka is truly a gem, and this team made it even better!\"', 'active', '2025-07-11 10:55:32', '2025-07-11 10:59:30'),
(20, 11, 'IT', '\"Easy booking process, great communication, and amazing experiences. Especially loved the cultural sites and local food tours!\"', 'active', '2025-07-11 10:56:01', '2025-07-11 10:59:30'),
(21, 11, 'IN', '\"Highly professional and responsive team. We enjoyed every moment, from hill country hikes to whale watching in Mirissa!\"', 'active', '2025-07-11 10:56:14', '2025-07-11 10:59:30'),
(22, 11, 'NZ', '\"Thank you for making our honeymoon magical. The romantic dinners and private excursions were just perfect. We can’t wait to return!\"', 'active', '2025-07-11 10:56:36', '2025-07-11 10:59:30'),
(23, 11, 'AU', '\"Great value for money and excellent local insights. We discovered hidden spots and felt like true explorers. 100% recommended!\"', 'active', '2025-07-11 10:56:54', '2025-07-11 10:59:30'),
(24, 11, 'AU', '\"Great value for money and excellent local insights. We discovered hidden spots and felt like true explorers. 100% recommended!\"', 'active', '2025-07-11 10:56:55', '2025-07-11 10:59:30'),
(25, 11, 'GB', '\"The custom itinerary matched our interests exactly. The hotels and activities exceeded expectations. We appreciate your dedication!\"', 'active', '2025-07-11 10:57:33', '2025-07-11 10:59:30'),
(26, 11, 'RO', '\"Superb organization and friendly guides. Everything went smoothly, and we made wonderful memories. Will definitely book again!\"', 'active', '2025-07-11 10:58:03', '2025-07-11 10:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `description`, `file_path`, `category`, `uploaded_by`, `status`, `created_at`, `updated_at`) VALUES
(29, 'img1', 'img1', '6870f067c775b_thushal-madhushankha-Wak57_M4JKM-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:07:19', '2025-07-11 11:07:19'),
(30, 'img2', 'img2', '6870f078c6508_tharoushan-kandarajah-KtDXt7DyfVM-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:07:36', '2025-07-11 11:07:36'),
(31, 'img3', 'img3', '6870f086a7902_tomas-malik-FHAHnF9C0Sw-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:07:50', '2025-07-11 11:07:50'),
(32, 'img4', 'img4', '6870f095b2cc6_arif-rasheed-mm-D2F_XbKg-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:08:05', '2025-07-11 11:08:05'),
(33, 'img5', 'img5', '6870f0a1af28b_farhath-firous-PwHQahVJ_ag-unsplash (1).jpg', NULL, 11, 'active', '2025-07-11 11:08:17', '2025-07-11 11:08:17'),
(34, 'img6', 'img6', '6870f0add7744_malith-d-karunarathne--Pw-SAA99lw-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:08:29', '2025-07-11 11:08:29'),
(35, 'img7', 'img7', '6870f0be0a8b1_michael-wave-S7vpnuVQL3g-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:08:46', '2025-07-11 11:08:46'),
(36, 'img8', 'img8', '6870f0cc1cf57_thushal-madhushankha-2fjBiIyH4RM-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:09:00', '2025-07-11 11:09:00'),
(37, 'img9', 'img9', '6870f0ec4d752_ramith-bhasuka-jcoO6i1oDnQ-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:09:32', '2025-07-11 11:09:32'),
(38, 'img10', 'img10', '6870f100eb092_udara-karunarathna-LfUJO4whcSU-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:09:52', '2025-07-11 11:09:52'),
(39, 'img11', 'img11', '6870f111551f7_amal-prasad-ztFkvmLKTcY-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:10:09', '2025-07-11 11:10:09'),
(40, 'img12', 'img12', '6870f12154696_thushal-madhushankha-Wak57_M4JKM-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:10:25', '2025-07-11 11:10:25'),
(41, 'img13', 'img13', '6870f180c900a_stefano-alemani-f9KQYJR7fXk-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:12:00', '2025-07-11 11:12:00'),
(42, 'img14', 'img14', '6870f1b50aa56_gemmmm-BS8a67PahbM-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:12:53', '2025-07-11 11:12:53'),
(43, 'img15', 'img15', '6870f1da798d5_tharaka-jayasuriya-P_FuVh64Wus-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:13:30', '2025-07-11 11:13:30'),
(44, 'img16', 'img16', '6870f22268ddb_tharaka-jayasuriya-P_FuVh64Wus-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:14:42', '2025-07-11 11:14:42'),
(45, 'img17', 'img17', '6870f23eb0925_arif-rasheed-mm-D2F_XbKg-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:15:10', '2025-07-11 11:15:10'),
(46, 'img18', 'img18', '6870f2bbaf170_tomas-malik-NmsAYdT-0hY-unsplash.jpg', NULL, 11, 'active', '2025-07-11 11:17:15', '2025-07-11 11:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `short_description` text DEFAULT NULL,
  `details_link` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `title`, `image_path`, `duration`, `price`, `short_description`, `details_link`, `status`, `created_at`, `updated_at`) VALUES
(32, 'Cultural Triangle Discovery', '686faf43812a2_IMG (13).jpg', '5 Days / 4 Nights', '650', 'Explore ancient cities like Anuradhapura, Polonnaruwa, and Sigiriya, and immerse yourself in Sri Lanka’s rich heritage.', NULL, 'active', '2025-07-10 12:17:07', '2025-07-10 12:17:07'),
(33, 'Scenic Hill Country Escape', '686faf79f0c3d_IMG (19).jpg', '6 Days / 5 Nights', '750', 'Tea plantations, waterfalls, train rides to Ella, and cool mountain air — the best of the hill country.', NULL, 'active', '2025-07-10 12:18:01', '2025-07-10 12:18:01'),
(34, 'Classic Sri Lanka Round Tour', '686fb02f7d08a_IMG (10).jpg', '10 Days / 9 Nights', '1350', 'A full island circuit including beaches, wildlife, hill country, and heritage sites.', NULL, 'active', '2025-07-10 12:18:48', '2025-07-11 18:32:54'),
(35, 'Sri Lanka Beach Paradise', '686fafd539ff7_IMG (16).jpg', '7 Days / 6 Nights', '950', 'Relax on pristine beaches in Bentota, Mirissa, and Unawatuna — perfect for sun-seekers and surfers.', NULL, 'active', '2025-07-10 12:19:33', '2025-07-10 12:19:33'),
(36, 'Wildlife & Safari Adventure', '686fb01170bb6_IMG (24).jpg', '5 Days / 4 Nights', '800', 'Safari in Yala or Udawalawe, see elephants, leopards, and exotic birds up close.', NULL, 'active', '2025-07-10 12:20:33', '2025-07-10 12:20:33'),
(37, 'Romantic Honeymoon Getaway', '686fb06a6a338_IMG (12).jpg', '7 Days / 6 Nights', '1200', 'Private beach dinners, luxury stays, and scenic views for the perfect romantic escape.', NULL, 'active', '2025-07-10 12:22:02', '2025-07-10 12:22:02'),
(38, 'Culinary & Culture Journey', '686fb0c6427d1_zoshua-colah-3gvwRZ_Omgw-unsplash.jpg', '6 Days / 5 Nights', '890', 'Experience authentic Sri Lankan cuisine, local markets, and hands-on cooking classes.', NULL, 'active', '2025-07-10 12:23:34', '2025-07-10 12:23:34'),
(39, 'Wellness & Ayurveda Retreat', '686fb148034e2_anuruddha-lokuhapuarachchi-77vZsyvV0bg-unsplash.jpg', '8 Days / 7 Nights', '2000', 'Rejuvenate with yoga, Ayurveda treatments, and tranquil settings by the ocean or mountains.', NULL, 'active', '2025-07-10 12:25:44', '2025-07-10 12:25:44'),
(40, 'East Coast Explorer', '686fb20d6fdce_jim-plaum-IefWtcXVlZs-unsplash.jpg', '6 Days / 5 Nights', '920', 'Discover Trincomalee’s beaches, snorkeling in Pigeon Island, and eastern cultural sites.', NULL, 'active', '2025-07-10 12:29:01', '2025-07-10 12:29:01'),
(41, 'Luxury Sri Lanka Experience', '686fb36449f3f_hc-digital-N4bOFvyrXgo-unsplash.jpg', '12 Days / 11 Nights', '2500', 'Exclusive boutique hotels, private transfers, and curated premium activities for a luxury getaway.', NULL, 'active', '2025-07-10 12:34:44', '2025-07-10 12:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(600) NOT NULL,
  `user_type` enum('admin','user') DEFAULT 'user',
  `phone` varchar(15) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `user_type`, `phone`, `profile_pic`, `status`, `created_at`, `updated_at`, `remark`) VALUES
(11, 'SL Travel', 'admin@gmail.com', '$2y$10$voiqvv0R2/x0pV6oedsa9uGHU3PvY6lF6asaoVoRku0igjDy10gwe', 'admin', '0702106938', '6864c9fc83a8d_Vintage and Retro Holiday Travel Agent Logo.png', 'active', '2025-07-02 05:46:28', '2025-07-11 16:48:14', ''),
(12, 'admin2', 'admin2@gmail.com', '$2y$10$3Mnn81.yZsvt4kB8FVyYUunRk.IcNJawfo1Jya5.LfRCgixfnbcbi', 'admin', NULL, NULL, 'active', '2025-07-04 14:46:44', '2025-07-04 14:47:00', ''),
(13, 'admin3', 'admin3@gmail.com', '$2y$10$jjYP8MqIiS7QqdUUV2XEheeTw2WQmrpDZ6HIgPZtB4uSWf.I.y0Oa', 'admin', '0000000022', '686824b6624dc_verstappen.jpg', 'active', '2025-07-04 18:58:41', '2025-07-12 05:54:03', 'all users pasword are (1234567@abcABC)'),
(14, 'user1', 'user1@gmail.com', '$2y$10$tHvRgRyXyrLmXygL7FvMY.72N3foGLa6uiV/jalhSxG.bc4MTTi8i', 'user', '0702106938', '686baa660fa8e_stroll.jpg', 'active', '2025-07-07 11:06:41', '2025-07-07 13:52:21', ''),
(15, 'user2', 'user2@gmail.com', '$2y$10$wRquWADtz3FVR.oapCsvb.i6fcRnqvhuoODClHA03010Vyv6Fam4y', 'user', NULL, '686dfd882d23f_4d00b84b8356e6381e8c80499896b19e.jpg', 'active', '2025-07-09 05:10:35', '2025-07-09 05:26:32', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
