-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 08:34 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deepend`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `seller_user_id` int(11) NOT NULL,
  `cover_letter` text COLLATE utf8_bin NOT NULL,
  `samples` text COLLATE utf8_bin NOT NULL,
  `bid_status` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'pending',
  `bid_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `job_id`, `seller_user_id`, `cover_letter`, `samples`, `bid_status`, `bid_amount`) VALUES
(1, 1, 2, 'perfect in logo designing. I\'ll design a perfect logo for your business', 'logo.png|sample.png', 'pending', 300),
(2, 1, 4, 'for over a decade I have designed professional logos for high end businesses.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'logo1.png|logo2.png', 'pending', 500),
(3, 1, 7, 'for over a decade I have designed professional logos for high end businesses.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'logo1.png|logo2.png', 'pending', 500),
(4, 2, 8, 'My reputation in designing professional buildings precedes me. I mainly deal with high end businesses.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'architectural.png|architectural.png', 'pending', 500),
(5, 2, 9, 'I have tremedous reputation in designing buldings  for high end businesses.Your work is a piece of cake and with the specialized budget I can be done in a day or so. just talk to me and provide the details of the job.', 'architectural1.png|arcitectural2.png', 'pending', 1000),
(6, 3, 12, 'If you need clean content that\'s 100% unique, that\'s me. I\'m a professional content writer with reputable skills in SEO.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'architectural.png|architectural.png', 'pending', 150),
(7, 3, 13, 'I have tremedous reputation writing copys that sell a brand. My experience is in copywriting and blog content writing.Your work is a piece of cake and with the specialized budget I can be done in a day or so. just talk to me and provide the details of the job.', 'architectural1.png|arcitectural2.png', 'pending', 200),
(8, 4, 2, 'If you greatly designed and highly functional website, that\'s 100% unique, that\'s me. I\'m a professional web developer with reputable skills in python and node js.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'website.png|website.png', 'pending', 800),
(9, 4, 4, 'I have tremedous reputation in developing dynamic websites that sell a brand. My experience is in python django and php.Your work is a piece of cake and with the specialized budget I can be done in a day or so. just talk to me and provide the details of the job.', 'website1.png|website2.png', 'pending', 600),
(10, 5, 7, 'my life revolves around wordpress. I\'m a professional web developer with reputable skills in both designing and editing plugins.Your work is a piece of cake and with the specialized budget I can be done in few hours. just talk to me and provide the details of the job.', 'website.png|website.png', 'pending', 800),
(13, 6, 12, 'I have tremedous reputation in designing frontends and developing backends. My experience is in all essentila plugins.Your work is a piece of cake and with the specialized budget I can be done in a day or so. just talk to me and provide the details of the job.', 'website1.png|website2.png', 'pending', 900);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `skills` text COLLATE utf8_bin NOT NULL,
  `parent_categories` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `skills`, `parent_categories`) VALUES
(1, 'logo design', 'exprerience with the whole logo design process', 'logo design|adobe illustrator', 'design'),
(2, 'design', 'able to design anything', 'logo design|web design|3d modelling', ''),
(3, 'web development', 'building website', 'web development|logo design|javascript|python', ''),
(4, 'architectural', 'create architectural designs and buildings', 'house drawing|3d modelling', ''),
(5, 'writing', 'able to write clean content', 'article writing|office suite', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `seller_user_id` int(11) NOT NULL,
  `employment_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `employments`
--

INSERT INTO `employments` (`id`, `job_id`, `seller_user_id`, `employment_amount`) VALUES
(1, 1, 8, 200),
(2, 2, 2, 500);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `buyer_user_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `category` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `skills` text COLLATE utf8_bin NOT NULL,
  `job_status` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'bidding',
  `created_on` bigint(20) NOT NULL,
  `budget` int(11) NOT NULL,
  `bids` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `buyer_user_id`, `title`, `category`, `description`, `skills`, `job_status`, `created_on`, `budget`, `bids`) VALUES
(1, 3, 'I need a logo Designer for my startup company ASAP', 'design', 'My partners and I are starting a startup company offering file compression services.  The company name is pied piper. we have created the website and built the whole company empire already. The problem is that we can\'t seem to agree on a trademark logo hence we need a second opinion: a third party designer.If you can manage the task in 24 hours, send us your proposal and we\'ll get back to you shortly. We are set to launch tomorrow midnight so you better hurry. All the best And thanks.', 'logo design|web design| adobe illustrator| adobe photoshop', 'active', 1592606119, 200, 4),
(2, 5, 'we need someone to draw a residential apartments', 'architectural', 'We have a project in Borneo consisting of shopping mall, hotel, apartments, cinema and shop-houses.We are looking for someone to draw a 3d perspective image for our facade with landscape for our sales booklet and model making.Attached: Master plan', '3d modelling|house drawing', 'active', 1591606119, 500, 2),
(3, 6, 'copywriter needed for website content', 'writing', 'Throughout the next few months, starting as soon as next week,  I am going to be working with a handful of clients that are looking to update the copy of their website.\r\n\r\nNext steps:\r\nIf you are interested, please submit a proposal including a sample of your writing for this industry.\r\n\r\nIf you meet the following requirements:\r\n1. You are a freelancer I can outsource to or whitelabel your services to complete some of these projects.\r\n2. Dependable.\r\n3. On time with deadlines', 'article writing|office suite', 'bidding', 1586495891, 500, 2),
(4, 10, 'wordpress experts needed for a woocommerce website', 'web development', 'We need highly experienced developers who have experience with\r\nWordPress\r\nWooCommerce\r\nDokan Multivendor\r\nto complete our existing ecommerce website which is under development.\r\nProject has lot of work available now and more ongoing monthly work will also be available.\r\nYou must have experience with development of different API which is required in an ecommerce website.\r\nYou must be able to develop and customise a plugin.\r\nOur target is to use minimum or no plugins.\r\nFront end, back end, responsive experience is must.\r\nLong term work available for experienced developers.\r\n', 'web design|web development|javascript', 'bidding', 1586500076, 1000, 2),
(5, 11, 'wordpress experts needed for a woocommerce website', 'web design', 'We need highly experienced developers \r\nto complete our existing ecommerce website which is under development.\r\nProject has lot of work available now and more ongoing monthly work will also be available.\r\nYou must have experience with development of different API which is required in an ecommerce website.\r\nYou must be able to develop and customise a plugin.\r\nOur target is to use minimum or no plugins.\r\nFront end, back end, responsive experience is must.\r\nLong term work available for experienced developers.\r\n', 'web design|web development|javascript', 'bidding', 1586500276, 800, 2),
(6, 10, 'full stack developer needed for a web application', 'web development', 'A mobile & online platform that will better the teaching and learning experience between driving instructors & students.\r\n\r\nWe are looking for a full platform that is web-based allowing us to service our clients and their customers.\r\n', 'web design|web development|javascript', 'bidding', 1586501055, 1200, 2);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `portfolio_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `images` text COLLATE utf8_bin NOT NULL DEFAULT 'deepend-landing.png',
  `documents` text COLLATE utf8_bin NOT NULL,
  `videos` text COLLATE utf8_bin NOT NULL,
  `portfolio_description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `portfolio_title`, `profile_id`, `user_id`, `images`, `documents`, `videos`, `portfolio_description`) VALUES
(1, 'Zuuri online-shop website', 1, 2, 'portfolio1.png|portfolio2.png|fitivate-screenshot.png', '', '|gym.mp4|Yoga_-_27087.mp4', '<p>An online shop determined to give variety of choices to all genders and all seasons. It was developed using wordpress content management system.</p><p>An online shop determined to give variety of choices to all genders and all seasons. It was developed using wordpress content management system. An online shop determined to give variety of choices to all genders and all seasons. It was developed using wordpress content management system.</p><p>An online shop determined to give variety of choices to all genders and all seasons. It was developed using wordpress content management system.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `profile_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` int(6) NOT NULL,
  `profile_description` text COLLATE utf8_bin NOT NULL,
  `portfolio_id` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profile_title`, `user_id`, `profile_description`, `portfolio_id`) VALUES
(1, 'general', 2, '<p>\"Evans has a keen eye for perfection. I love his ability to ask relevant questions and follow instructions keenly. He is resourceful in his research and takes time to verify each fact. Above all, Honesty is his God-given superpower. \"</p><p>Hello,</p><p>My name is Evans Munene.</p><p>I know it\'s easy to give promises and be done with this overview, but I choose to give you my solemn vow of doing everything within my power to deliver the best work.</p><p>My employers and previous clients have talked about my dedication to my work, timely deliveries, and content uniqueness. However, My plea is that you give me a chance to give you a glimpse of what they experienced and hence give yourself an opportunity to be the ultimate judge and confirm their claims.</p><p>Personally I would describe writing as a combination of:</p><p>1. Good grammar skills - That ensures content is correctly written and easy to read. 2. Content that is actionable and factual - Which is achieved through adequate research, corrects facts and verified statistics.</p><p>3. Ability to reach the target audience - This is achieved through marketing and SEO optimization -which ensure content reaches the audience- and excellent writing skills -which ensures readers are glued to your content and potential customers turn to recurrent customers-.</p><p>In a nutshell, I understand what is required of a writer and my goal is to always deliver a masterpiece.</p><p>Besides content writing, I have expertise in SEO which I attribute to years of learning web development and understanding website architecture and what search engines look for. My experience in using WordPress and its tools such as the Yoast SEO plugin to write and edit my content has also played its part.</p><p>I\'m accustomed to numerous fields which include technology and health among others.</p><p>if you want to see your business flourish, look no more and h Hire me now. I\'m always available.</p>', '1'),
(3, 'writing', 2, '<p>Hello,</p><p>My name is Evans Munene.</p><p>I know it\'s easy to give promises and be done with this overview, but I choose to give you my solemn vow of doing everything within my power to deliver the best work.</p><p>My employers and previous clients have talked about my dedication to my work, timely deliveries, and content uniqueness. However, My plea is that you give me a chance to give you a glimpse of what they experienced and hence give yourself an opportunity to be the ultimate judge and confirm their claims.</p><p>Personally I would describe writing as a combination of:</p><p>1. Good grammar skills - That ensures content is correctly written and easy to read. 2. Content that is actionable and factual - Which is achieved through adequate research, corrects facts and verified statistics.</p><p>3. Ability to reach the target audience - This is achieved through marketing and SEO optimization -which ensure content reaches the audience- and excellent writing skills -which ensures readers are glued to your content and potential customers turn to recurrent customers-.</p><p>In a nutshell, I understand what is required of a writer and my goal is to always deliver a masterpiece.</p><p>Besides content writing, I have expertise in SEO which I attribute to years of learning web development and understanding website architecture and what search engines look for. My experience in using WordPress and its tools such as the Yoast SEO plugin to write and edit my content has also played its part.</p><p>I\'m accustomed to numerous fields which include technology and health among others.</p><p>if you want to see your business flourish, look no more and h Hire me now. I\'m always available.</p>', ''),
(4, 'development', 2, '<p>development</p>', ''),
(5, 'designing', 2, '<p>designing</p>', ''),
(6, 'General', 3, '<p>hello</p>', ''),
(7, 'architect', 3, '<p>architect</p>', ''),
(8, 'engineer', 3, '<p>engineer</p>', ''),
(9, 'data', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `reviewed_user_id` int(11) NOT NULL,
  `reviewer_user_id` int(11) NOT NULL,
  `textual_review` text COLLATE utf8_bin DEFAULT NULL,
  `star_review` int(6) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `description`) VALUES
(1, 'article writing', 'excellent with words.writes small content within a certain theme '),
(2, 'javascript', 'proficient in javascript programming language'),
(3, 'python', 'proficeint in python programming language'),
(4, 'web design', 'create designs for web pages'),
(5, 'web development', 'writes codes for websites'),
(6, 'logo design', 'can design logos'),
(7, 'office suite', 'able to use all microsoft office applications'),
(8, 'adobe illustrator', 'can use adobe\'s illustration software'),
(9, 'adobe photoshop', 'able to manipulate images using adobe\'s photoshop sofware'),
(10, '3d modelling', 'can create 3 dimensional modelling'),
(11, 'house drawing', 'can draw architectural drawings house ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `account_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'buyer',
  `account_status` varchar(50) COLLATE utf8_bin DEFAULT 'active',
  `created_on` bigint(20) NOT NULL,
  `telephone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `review` int(6) DEFAULT 0,
  `location` varchar(50) COLLATE utf8_bin NOT NULL,
  `languages` varchar(50) COLLATE utf8_bin NOT NULL,
  `expertise_level` varchar(50) COLLATE utf8_bin NOT NULL,
  `image` varchar(100) COLLATE utf8_bin DEFAULT 'person.png',
  `gender` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `expenditure_or_earnings` int(11) DEFAULT 0,
  `user_description` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `account_type`, `account_status`, `created_on`, `telephone`, `review`, `location`, `languages`, `expertise_level`, `image`, `gender`, `expenditure_or_earnings`, `user_description`) VALUES
(1, 'Evans', 'Munene', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'evansmwenda006@gmail.com', 'admin', 'active', 1585893377, '254759666898', NULL, 'Nairobi|kenya', 'english|kiswahili', 'Expert', '1.jpg', 'male', 1000, NULL),
(2, 'jane', 'doe', '$2y$10$8ZiIyeNrO1Fr/TwtAKbN9OV6OeFvourMXv2SLtjwAXjsp8K58M0OK', 'janedoe@gmail.com', 'seller', 'active', 1585893377, '254723570570', 4, 'Nairobi|kenya', 'english|kiswahili', 'Expert', '2.jpg', 'female', 2000, 'skilled architect'),
(3, 'john', 'doe', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'johndoe@gmail.com', 'buyer', 'active', 1585893377, '254718867339', 4, 'Nairobi | kenya', 'english|kiswahili', 'Expert', '3.jpg', 'male', 3000, NULL),
(4, 'charles', 'darwin', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'charlesdarwin@gmail.com', 'seller', 'active', 1585894182, '(555) 555-1234', 3, 'newyork |usa', 'english', 'expert', '4.jpg', 'male', 4000, 'Experienced Designer'),
(5, 'james', 'bond', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'jamesbond@gmail.com', 'buyer', 'active', 1585894182, '(555) 555-1224', 4, 'california | usa', 'english', 'expert', '5.jpg', 'male', 5000, NULL),
(6, 'luke', 'cage', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'lukecage@gmail.com', 'buyer', 'active', 1585894192, '(555) 555-1254', 3, 'beijing |china', 'english|chinese', 'intermediate', '6.jpg', 'male', 6000, NULL),
(7, 'marsh', 'mellow', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'marshmellow@gmail.com', 'seller', 'active', 1585894189, '(555) 555-2234', 5, 'texas |usa', 'english', 'expert', '7.jpg', 'male', 7000, 'Technical Software engineer'),
(8, 'kelvin', 'black', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'kelvinblack@gmail.com', 'seller', 'active', 1585894282, '(555) 555-1234', 5, 'canada |uk', 'english', 'expert', '8.jpg', 'male', 8000, 'Creative Designer'),
(9, 'donald', 'trump', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'donaldtrump@gmail.com', 'seller', 'active', 1585894371, '(555) 555-1274', 5, 'newyork |usa', 'english', 'expert', '9.jpg', 'male', 9000, 'Reliable Virtuall assistant'),
(10, 'jesicca', 'jones', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'jesiccajonesd@gmail.com', 'buyer', 'active', 1585894371, '(555) 555-1294', 5, 'california | usa', 'english', 'expert', '10.jpg', 'female', 10000, NULL),
(11, 'lilian', 'akech', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'lilianakech@gmail.com', 'buyer', 'active', 1585894371, '(555) 555-1254', 4, 'beijing | china', 'english|chinese', 'intermediate', '11.jpg', 'female', 11000, NULL),
(13, 'sona', 'noa', '$2y$10$VQBQQG69oR5OafPMKu3HuuMJn6Qpt6hOkAI3offfdapVd8i7hkFIG', 'sonanoa@gmail.com', 'seller', 'active', 1585894371, '(555) 555-1334', 5, 'canada |uk', 'english', 'expert', '13.jpg', 'female', 13000, 'Creative Writer');

-- --------------------------------------------------------

--
-- Table structure for table `website_content`
--

CREATE TABLE `website_content` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `category` varchar(50) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `featured_files` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `website_content`
--

INSERT INTO `website_content` (`id`, `title`, `category`, `content`, `featured_files`) VALUES
(1, 'logo', 'logo', 'logo', 'deepend-logo.png'),
(2, 'heading-1', 'call to action', 'we go deep', NULL),
(3, 'heading-2', 'call to action', 'we provide a platform you can depend on', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_content`
--
ALTER TABLE `website_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `website_content`
--
ALTER TABLE `website_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
