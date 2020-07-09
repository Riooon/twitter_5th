-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 09, 2020 at 01:32 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `follow_id` int(11) NOT NULL,
  `is_followed` int(11) NOT NULL,
  `followed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`follow_id`, `is_followed`, `followed_by`) VALUES
(29, 138, 139),
(32, 138, 140),
(37, 138, 141),
(49, 138, 142),
(57, 138, 143),
(66, 138, 144),
(80, 138, 148),
(81, 138, 149),
(22, 139, 138),
(39, 139, 141),
(50, 139, 142),
(23, 140, 138),
(38, 140, 141),
(51, 140, 142),
(59, 140, 143),
(68, 140, 144),
(75, 140, 146),
(24, 141, 138),
(33, 141, 140),
(52, 141, 142),
(60, 141, 143),
(69, 141, 144),
(74, 141, 145),
(76, 141, 147),
(79, 141, 148),
(84, 141, 150),
(25, 142, 138),
(28, 142, 139),
(31, 142, 140),
(36, 142, 141),
(58, 142, 143),
(67, 142, 144),
(77, 142, 147),
(85, 142, 150),
(26, 143, 138),
(34, 143, 140),
(41, 143, 141),
(53, 143, 142),
(70, 143, 144),
(73, 143, 145),
(78, 143, 147),
(82, 143, 149),
(86, 143, 150),
(27, 144, 138),
(35, 144, 140),
(42, 144, 141),
(54, 144, 142),
(62, 144, 143),
(83, 144, 149),
(43, 145, 141),
(55, 145, 142),
(63, 145, 143),
(87, 145, 150),
(44, 146, 141),
(71, 146, 144),
(45, 147, 141),
(46, 148, 141),
(47, 149, 141),
(64, 149, 143),
(48, 150, 141),
(56, 150, 142),
(65, 150, 143),
(72, 150, 145);

-- --------------------------------------------------------

--
-- Table structure for table `like_list`
--

CREATE TABLE `like_list` (
  `like_id` int(11) NOT NULL,
  `tweet_num` int(11) NOT NULL,
  `tweeted_by` int(11) NOT NULL,
  `liked_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `like_list`
--

INSERT INTO `like_list` (`like_id`, `tweet_num`, `tweeted_by`, `liked_by`) VALUES
(50, 325, 140, 138),
(51, 323, 140, 138),
(52, 321, 140, 138),
(53, 318, 141, 138),
(54, 316, 141, 138),
(55, 314, 141, 138),
(56, 312, 141, 138),
(57, 309, 142, 138),
(58, 305, 142, 138),
(59, 303, 143, 138),
(60, 301, 143, 138),
(61, 299, 143, 138),
(62, 297, 144, 138),
(63, 295, 144, 138),
(64, 294, 144, 138),
(65, 338, 138, 139),
(66, 337, 138, 139),
(67, 336, 138, 139),
(68, 335, 138, 139),
(69, 334, 138, 139),
(70, 333, 138, 139),
(71, 332, 138, 139),
(72, 331, 138, 139),
(73, 296, 144, 140),
(74, 294, 144, 140),
(75, 297, 144, 140),
(76, 295, 144, 140),
(77, 293, 144, 140),
(78, 303, 143, 140),
(79, 302, 143, 140),
(80, 301, 143, 140),
(81, 300, 143, 140),
(82, 299, 143, 140),
(83, 298, 143, 140),
(84, 318, 141, 140),
(85, 317, 141, 140),
(86, 316, 141, 140),
(87, 315, 141, 140),
(88, 314, 141, 140),
(89, 313, 141, 140),
(90, 312, 141, 140),
(91, 311, 141, 140),
(92, 338, 138, 140),
(93, 337, 138, 140),
(94, 336, 138, 140),
(95, 335, 138, 140),
(96, 334, 138, 140),
(97, 333, 138, 140),
(98, 332, 138, 140),
(99, 331, 138, 140),
(100, 310, 142, 140),
(101, 309, 142, 140),
(102, 308, 142, 140),
(103, 307, 142, 140),
(104, 306, 142, 140),
(105, 305, 142, 140),
(106, 304, 142, 140),
(107, 310, 142, 141),
(108, 309, 142, 141),
(109, 308, 142, 141),
(110, 307, 142, 141),
(111, 306, 142, 141),
(112, 305, 142, 141),
(113, 304, 142, 141),
(114, 338, 138, 141),
(115, 337, 138, 141),
(116, 336, 138, 141),
(117, 335, 138, 141),
(118, 334, 138, 141),
(119, 333, 138, 141),
(120, 332, 138, 141),
(121, 331, 138, 141),
(122, 325, 140, 141),
(123, 324, 140, 141),
(124, 323, 140, 141),
(125, 322, 140, 141),
(126, 321, 140, 141),
(127, 320, 140, 141),
(128, 319, 140, 141),
(129, 330, 139, 141),
(130, 329, 139, 141),
(131, 328, 139, 141),
(132, 327, 139, 141),
(133, 326, 139, 141),
(134, 303, 143, 141),
(135, 302, 143, 141),
(136, 301, 143, 141),
(137, 300, 143, 141),
(138, 299, 143, 141),
(139, 298, 143, 141),
(140, 297, 144, 141),
(141, 296, 144, 141),
(142, 295, 144, 141),
(143, 294, 144, 141),
(144, 293, 144, 141),
(145, 292, 145, 141),
(146, 291, 145, 141),
(147, 290, 145, 141),
(148, 289, 146, 141),
(149, 288, 146, 141),
(150, 287, 147, 141),
(151, 286, 147, 141),
(152, 285, 148, 141),
(153, 284, 148, 141),
(154, 283, 149, 141),
(155, 282, 149, 141),
(156, 281, 150, 141),
(157, 280, 150, 141),
(158, 281, 150, 142),
(159, 280, 150, 142),
(160, 292, 145, 142),
(161, 291, 145, 142),
(162, 290, 145, 142),
(163, 297, 144, 142),
(164, 296, 144, 142),
(165, 294, 144, 142),
(166, 303, 143, 142),
(167, 302, 143, 142),
(168, 301, 143, 142),
(169, 300, 143, 142),
(170, 299, 143, 142),
(171, 340, 141, 142),
(172, 339, 141, 142),
(173, 317, 141, 142),
(174, 316, 141, 142),
(175, 315, 141, 142),
(176, 314, 141, 142),
(177, 325, 140, 142),
(178, 324, 140, 142),
(179, 323, 140, 142),
(180, 322, 140, 142),
(181, 321, 140, 142),
(182, 320, 140, 142),
(183, 319, 140, 142),
(184, 330, 139, 142),
(185, 329, 139, 142),
(186, 328, 139, 142),
(187, 327, 139, 142),
(188, 326, 139, 142),
(189, 338, 138, 142),
(190, 337, 138, 142),
(191, 336, 138, 142),
(192, 335, 138, 142),
(193, 334, 138, 142),
(194, 333, 138, 142),
(195, 332, 138, 142),
(196, 331, 138, 142),
(197, 289, 146, 144),
(198, 288, 146, 144),
(199, 303, 143, 144),
(200, 302, 143, 144),
(201, 301, 143, 144),
(202, 300, 143, 144),
(203, 299, 143, 144),
(204, 298, 143, 144),
(205, 340, 141, 144),
(206, 339, 141, 144),
(207, 318, 141, 144),
(208, 317, 141, 144),
(209, 316, 141, 144),
(210, 315, 141, 144),
(211, 314, 141, 144),
(212, 313, 141, 144),
(213, 312, 141, 144),
(214, 311, 141, 144),
(215, 325, 140, 144),
(216, 324, 140, 144),
(217, 323, 140, 144),
(218, 322, 140, 144),
(219, 321, 140, 144),
(220, 320, 140, 144),
(221, 319, 140, 144),
(222, 338, 138, 144),
(223, 337, 138, 144),
(224, 336, 138, 144),
(225, 335, 138, 144),
(226, 334, 138, 144),
(227, 333, 138, 144),
(228, 332, 138, 144),
(229, 331, 138, 144),
(230, 303, 143, 145),
(231, 302, 143, 145),
(232, 301, 143, 145),
(233, 300, 143, 145),
(234, 299, 143, 145),
(235, 298, 143, 145),
(236, 341, 142, 145),
(237, 310, 142, 145),
(238, 309, 142, 145),
(239, 308, 142, 145),
(240, 307, 142, 145),
(241, 306, 142, 145),
(242, 340, 141, 145),
(243, 339, 141, 145),
(244, 318, 141, 145),
(245, 317, 141, 145),
(246, 316, 141, 145),
(247, 315, 141, 145),
(248, 314, 141, 145),
(249, 312, 141, 145),
(250, 313, 141, 145),
(251, 311, 141, 145),
(252, 325, 140, 146),
(253, 324, 140, 146),
(254, 323, 140, 146),
(255, 322, 140, 146),
(256, 321, 140, 146),
(257, 320, 140, 146),
(258, 319, 140, 146),
(259, 340, 141, 147),
(260, 339, 141, 147),
(261, 318, 141, 147),
(262, 317, 141, 147),
(263, 316, 141, 147),
(264, 315, 141, 147),
(265, 314, 141, 147),
(266, 313, 141, 147),
(267, 312, 141, 147),
(268, 311, 141, 147),
(269, 337, 138, 148),
(270, 340, 141, 148),
(271, 339, 141, 148),
(272, 318, 141, 148),
(273, 317, 141, 148),
(274, 316, 141, 148),
(275, 315, 141, 148),
(276, 314, 141, 148),
(277, 313, 141, 148),
(278, 312, 141, 148),
(279, 311, 141, 148),
(280, 303, 143, 149),
(281, 302, 143, 149),
(282, 301, 143, 149),
(283, 300, 143, 149),
(284, 299, 143, 149),
(285, 298, 143, 149),
(286, 344, 144, 149),
(287, 343, 144, 149),
(288, 342, 144, 149),
(289, 297, 144, 149),
(290, 296, 144, 149),
(291, 295, 144, 149),
(292, 294, 144, 149),
(293, 338, 138, 149),
(294, 337, 138, 149),
(295, 336, 138, 149),
(296, 335, 138, 149),
(297, 334, 138, 149),
(298, 333, 138, 149),
(299, 332, 138, 149),
(300, 331, 138, 149),
(301, 292, 145, 150),
(302, 291, 145, 150),
(303, 290, 145, 150),
(304, 303, 143, 150),
(305, 302, 143, 150),
(306, 301, 143, 150),
(307, 299, 143, 150),
(308, 298, 143, 150),
(309, 300, 143, 150),
(310, 341, 142, 150),
(311, 310, 142, 150),
(312, 309, 142, 150),
(313, 308, 142, 150),
(314, 307, 142, 150),
(315, 306, 142, 150),
(316, 305, 142, 150),
(317, 304, 142, 150),
(318, 340, 141, 150),
(319, 339, 141, 150),
(320, 318, 141, 150),
(321, 317, 141, 150),
(322, 316, 141, 150),
(323, 315, 141, 150),
(324, 314, 141, 150),
(325, 313, 141, 150),
(326, 312, 141, 150),
(327, 311, 141, 150),
(328, 344, 144, 138),
(329, 343, 144, 138),
(330, 342, 144, 138),
(331, 296, 144, 138),
(332, 293, 144, 138),
(333, 302, 143, 138),
(334, 300, 143, 138),
(335, 298, 143, 138),
(336, 341, 142, 138),
(337, 310, 142, 138),
(338, 308, 142, 138),
(339, 307, 142, 138),
(340, 306, 142, 138),
(341, 304, 142, 138),
(342, 340, 141, 138),
(343, 339, 141, 138),
(344, 317, 141, 138),
(345, 315, 141, 138),
(346, 313, 141, 138),
(347, 311, 141, 138),
(348, 324, 140, 138),
(349, 322, 140, 138),
(350, 320, 140, 138),
(351, 319, 140, 138),
(352, 330, 139, 138),
(353, 329, 139, 138),
(354, 328, 139, 138),
(355, 327, 139, 138),
(356, 326, 139, 138);

-- --------------------------------------------------------

--
-- Table structure for table `retweet_list`
--

CREATE TABLE `retweet_list` (
  `retweet_id` int(11) NOT NULL,
  `tweet_num` int(11) NOT NULL,
  `tweeted_by` varchar(256) NOT NULL,
  `retweeted_by` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retweet_list`
--

INSERT INTO `retweet_list` (`retweet_id`, `tweet_num`, `tweeted_by`, `retweeted_by`) VALUES
(101, 309, '142', '138'),
(102, 304, '142', '141'),
(103, 332, '138', '141'),
(104, 337, '138', '142'),
(105, 318, '141', '144'),
(106, 315, '141', '144'),
(107, 324, '140', '144'),
(108, 325, '140', '146'),
(109, 324, '140', '146'),
(110, 323, '140', '146'),
(111, 322, '140', '146'),
(112, 321, '140', '146'),
(113, 320, '140', '146'),
(114, 319, '140', '146'),
(115, 318, '141', '147'),
(116, 337, '138', '148'),
(117, 318, '141', '148'),
(118, 317, '141', '148'),
(119, 337, '138', '149'),
(120, 303, '143', '138'),
(121, 318, '141', '138');

-- --------------------------------------------------------

--
-- Table structure for table `tweet_content`
--

CREATE TABLE `tweet_content` (
  `tweet_num` int(11) NOT NULL,
  `id` int(10) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `posted_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweet_content`
--

INSERT INTO `tweet_content` (`tweet_num`, `id`, `tweet`, `posted_by`) VALUES
(280, 150, 'My blest milk is gross?', 150),
(281, 150, 'We are back on!', 150),
(282, 149, 'I want to have kids with you', 149),
(283, 149, 'How about one more racket ball game?', 149),
(284, 148, 'The thing I\'m looking at: wow!', 148),
(285, 148, 'There\'s a statue in Minsk that reminds me of you so much', 148),
(286, 147, 'If you need an easy way to remember it, just think of a bag of crap', 147),
(287, 147, 'You are so wonderfully weird', 147),
(288, 146, 'I was wondering if you\'d like to go to a movie with me... as my lover', 146),
(289, 146, 'What\'s my last name?', 146),
(290, 145, 'We refer to you as Bobo, the sperm guy', 145),
(291, 145, 'Well, you know, you have to take a course. Otherwise, they don\'t let you do it.', 145),
(292, 145, 'Every day is lesbian lover\'s day', 145),
(293, 144, 'Here come the meat sweats', 144),
(294, 144, 'I’m Chandler! Could I be wearing any more clothes?', 144),
(295, 144, 'I’m curvy and I like it', 144),
(296, 144, 'Joey doesn’t share food!', 144),
(297, 144, 'You can’t just give up! Is that what a dinosaur would do?', 144),
(298, 143, 'I\'m always a hostess', 143),
(299, 143, 'I\'m engaged! I\'m engaged!', 143),
(300, 143, 'That\'s not even a word', 143),
(301, 143, 'Are you saying that you don\'t want to get with this?', 143),
(302, 143, 'And remember, if I\'m harsh with you it\'s only because you\'re doing it wrong', 143),
(303, 143, 'Was I cleaning in my sleep again?', 143),
(304, 142, 'I Grew Up In A House With Monica. If You Didn\'t Eat Fast, You Didn\'t Eat', 142),
(305, 142, 'I\'m The Holiday Armadillo', 142),
(306, 142, 'You-You-You... You Threw My Sandwich Away...', 142),
(307, 142, 'Pivot! Pivot! Pivot!', 142),
(308, 142, 'We were on a break!', 142),
(309, 142, 'Multiple Orgasms\r\n', 142),
(310, 142, 'whom', 142),
(311, 141, 'Something Is Wrong With The Left Phalange', 141),
(312, 141, 'Flame Boy', 141),
(313, 141, 'For God\'s Sake, Judy. Pick Up The Sock! Pick Up The Sock! Pick Up The Sock!', 141),
(314, 141, 'Ross Can!', 141),
(315, 141, 'That Is Brand-New Information!', 141),
(316, 141, 'They Don\'t Know That We Know They Know We Know.', 141),
(317, 141, 'I Don\'t Even Have A \'Pla\'', 141),
(318, 141, 'I Wish I Could, But I Don\'t Want To.', 141),
(319, 140, 'It\'s A Metaphor, Daddy!', 140),
(320, 140, 'How Do You Expect Me To Grow If You Won\'t Let Me Blow?', 140),
(321, 140, 'Who Is FICA?', 140),
(322, 140, 'Ahh salmon skill roll', 140),
(323, 140, 'my boss wants to buy my baby', 140),
(324, 140, 'No uterus No opinion', 140),
(325, 140, 'I am over YOU!', 140),
(326, 139, 'OH MY GOD', 139),
(327, 139, 'OH MY GOD', 139),
(328, 139, 'OH MY GOD', 139),
(329, 139, 'OH MY GOD', 139),
(330, 139, 'OH MY GOD', 139),
(331, 138, 'I’m Chandler; I Make Jokes When I’m Uncomfortable', 138),
(332, 138, 'Gum Would Be Perfection.', 138),
(333, 138, 'I\'m Not Great At The Advice... Can I Interest You In A Sarcastic Comment?', 138),
(334, 138, 'I’m Sorry We, We Don’t Have Your Sheep', 138),
(335, 138, 'Dear God! This Parachute Is A Knapsack!', 138),
(336, 138, 'Okay, You Have To Stop The Q-Tip When There Is Resistance.', 138),
(337, 138, 'I\'m Hopeless And Awkward And Desperate For Love!', 138),
(338, 142, 'Multiple Orgasms\r\n', 138),
(339, 142, 'I Grew Up In A House With Monica. If You Didn\'t Eat Fast, You Didn\'t Eat', 141),
(340, 138, 'Gum Would Be Perfection.', 141),
(341, 138, 'I\'m Hopeless And Awkward And Desperate For Love!', 142),
(342, 141, 'I Wish I Could, But I Don\'t Want To.', 144),
(343, 141, 'That Is Brand-New Information!', 144),
(344, 140, 'No uterus No opinion', 144),
(345, 140, 'I am over YOU!', 146),
(346, 140, 'No uterus No opinion', 146),
(347, 140, 'my boss wants to buy my baby', 146),
(348, 140, 'Ahh salmon skill roll', 146),
(349, 140, 'Who Is FICA?', 146),
(350, 140, 'How Do You Expect Me To Grow If You Won\'t Let Me Blow?', 146),
(351, 140, 'It\'s A Metaphor, Daddy!', 146),
(352, 141, 'I Wish I Could, But I Don\'t Want To.', 147),
(353, 138, 'I\'m Hopeless And Awkward And Desperate For Love!', 148),
(354, 141, 'I Wish I Could, But I Don\'t Want To.', 148),
(355, 141, 'I Don\'t Even Have A \'Pla\'', 148),
(356, 138, 'I\'m Hopeless And Awkward And Desperate For Love!', 149),
(357, 143, 'Was I cleaning in my sleep again?', 138),
(358, 141, 'I Wish I Could, But I Don\'t Want To.', 138);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_account`
--

CREATE TABLE `twitter_account` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `username` varchar(24) DEFAULT NULL,
  `name` varchar(24) DEFAULT NULL,
  `bio` text,
  `profile_picture` varchar(50) DEFAULT 'default_icon.png',
  `background_image` varchar(50) DEFAULT 'defalut_bg.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `twitter_account`
--

INSERT INTO `twitter_account` (`id`, `email`, `password`, `username`, `name`, `bio`, `profile_picture`, `background_image`) VALUES
(138, 'chandler@bing', 'wefwefef', 'chandlerbing', 'Chandler Bing', 'Could I be more Chandler Bing?', 'chandler.jpg', 'friends.jpg'),
(139, 'janice@omg', 'faoehvebwvw', 'janiceomg', 'Janice', 'OH MY GOD', 'janice.jpg', 'friends.jpg'),
(140, 'rachel@green', 'fewafvowhvbnwe', 'rachelgreen', 'Rachel Green', 'NOOOOOOOOO', 'rachel.jpg', 'friends.jpg'),
(141, 'phobe@buffee', 'fwafeegwrg', 'phobebuffee', 'Phoebe Buffay', 'MY EYES! MY EYES!', 'phoebe.jpg', 'friends.jpg'),
(142, 'ross@geller', 'fsafewohoe', 'rossgeller', 'Ross Geller', 'Unagi~', 'ross.jpg', 'friends.jpg'),
(143, 'monica@geller', 'oh;ouoln', 'monicageller', 'Monica Geller', 'I KNOW!', 'monica.jpg', 'friends.jpg'),
(144, 'joey@tribbiani', 'foewhfnewobew', 'joeytribbiani', 'Joey Tribbiani', 'How you doing?', 'joey.jpg', 'friends.jpg'),
(145, 'susan@bunch', 'owehb3o29gbd', 'susanbunch', 'Susan Bunch', 'I\'m a lovely person', 'susan.jpg', 'friends.jpg'),
(146, 'gunther@centralpark', '032yhoewvghew', 'gunthercentralpark', 'Gunther Centralpark', 'I love Rachel', 'gunther.jpg', 'friends.jpg'),
(147, 'mike@hannigan', '032yhfbio23', 'mikehannigan', 'Mike Hannigan', 'Crap Bag', 'mike.jpg', 'friends.jpg'),
(148, 'david@science', '3r3ohobv32v', 'davidscience', 'David Science', 'I\'m going to Minsk', 'david.jpg', 'friends.jpg'),
(149, 'richard@burke', '3023rhvob32f32', 'richardburke', 'Richard Burke', 'I\'m her naked friend', 'richard.jpg', 'friends.jpg'),
(150, 'carol@willick', '23f032hf203', 'carolwillick', 'Carol Willick', 'You slept with another women?', 'carol.jpg', 'friends.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`follow_id`),
  ADD UNIQUE KEY `is_followed` (`is_followed`,`followed_by`);

--
-- Indexes for table `like_list`
--
ALTER TABLE `like_list`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `retweet_list`
--
ALTER TABLE `retweet_list`
  ADD PRIMARY KEY (`retweet_id`);

--
-- Indexes for table `tweet_content`
--
ALTER TABLE `tweet_content`
  ADD PRIMARY KEY (`tweet_num`);

--
-- Indexes for table `twitter_account`
--
ALTER TABLE `twitter_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `like_list`
--
ALTER TABLE `like_list`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `retweet_list`
--
ALTER TABLE `retweet_list`
  MODIFY `retweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tweet_content`
--
ALTER TABLE `tweet_content`
  MODIFY `tweet_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `twitter_account`
--
ALTER TABLE `twitter_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
