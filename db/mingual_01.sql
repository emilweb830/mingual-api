-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2016 at 06:00 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mingual`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id_country`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'YU', 'Yugoslavia'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id_lang` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `iso_code` char(2) NOT NULL,
  `language_code` char(5) DEFAULT NULL,
  `active` tinyint(2) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id_lang`, `name`, `iso_code`, `language_code`, `active`) VALUES
(1, 'Arabic', 'ar', 'ar', 1),
(2, 'English', 'en', 'en-us', 1),
(3, 'French', 'fr', 'fr', 1),
(4, 'German', 'de', 'de', 1),
(5, 'Hindi', 'hi', 'hi', 1),
(6, 'Italian', 'it', 'it', 1),
(7, 'Japanese', 'ja', 'ja', 1),
(8, 'Mandarin', 'zh', 'zh', 1),
(9, 'Portuguese', 'pt', 'pt', 1),
(10, 'Russian', 'ru', 'ru', 1),
(11, 'Spanish', 'es', 'es', 1),
(12, 'Albanian', 'sq', 'sq', 1),
(13, 'Amharic', 'am', 'am', 1),
(14, 'Azerbaijani', 'az', 'az', 1),
(15, 'Belarusian', 'be', 'be', 1),
(16, 'Bengali', 'bn', 'bn', 1),
(17, 'Bosnian', 'bs', 'bs', 1),
(18, 'Cantonese', 'zh', 'zh', 1),
(19, 'Catalan', 'ca', 'ca', 1),
(20, 'Czech', 'cs', 'cs', 1),
(21, 'Dutch', 'nl', 'nl', 1),
(22, 'Farsi', 'fa', 'fa', 1),
(23, 'Finnish', 'fi', 'fi', 1),
(24, 'Greek', 'el', 'el', 1),
(25, 'Haitian', 'ht', 'ht', 1),
(26, 'Hebrew', 'he', 'he', 1),
(27, 'Hungarian', 'hu', 'hu', 1),
(28, 'Kazakh', 'kk', 'kk', 1),
(29, 'Khmer', 'km', 'km', 1),
(30, 'Korean', 'ko', 'ko', 1),
(31, 'Kurdish', 'ku', 'ku', 1),
(32, 'Kyrgyz', 'ky', 'ky', 1),
(33, 'Macedonian', 'mk', 'mk', 1),
(34, 'Malaysian', 'ms', 'ms', 1),
(35, 'Indonesian', 'id', 'id', 1),
(36, 'Moldovan', 'mo', 'mo', 1),
(37, 'Nahuatl', 'na', 'nah', 1),
(38, 'Nepali', 'ne', 'ne', 1),
(39, 'Norwegian', 'nb', 'nb', 1),
(40, 'Pashto', 'ps', 'ps', 1),
(41, 'Polish', 'pl', 'pl', 1),
(42, 'Punjabi', 'pa', 'pa', 1),
(43, 'Quechua', 'qu', 'qu', 1),
(44, 'Romanian', 'ro', 'ro', 1),
(45, 'Serbian', 'sr', 'sr', 1),
(46, 'Slovak', 'sk', 'sk', 1),
(47, 'Slovenian', 'sl', 'sl', 1),
(48, 'Somali', 'so', 'so', 1),
(49, 'Swedish', 'sv', 'sv', 1),
(50, 'Tagalog', 'tl', 'tl', 1),
(51, 'Tajik', 'tg', 'tg', 1),
(52, 'Tamil', 'ta', 'ta', 1),
(53, 'Thai', 'th', 'th', 1),
(54, 'Turkish', 'tr', 'tr', 1),
(55, 'Turkmen', 'tk', 'tk', 1),
(56, 'Ukrainain', 'uk', 'uk', 1),
(57, 'Urdu', 'ur', 'ur', 1),
(58, 'Uzbek', 'uz', 'uz', 1),
(59, 'Vietnamese', 'vi', 'vi', 1),
(60, 'Wolof', 'wo', 'wo', 1),
(61, 'Zulu', 'zu', 'zu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `minguals`
--

CREATE TABLE `minguals` (
  `id` int(255) unsigned NOT NULL,
  `id_partner1` int(255) unsigned NOT NULL,
  `id_partner2` int(255) unsigned NOT NULL,
  `mingual_status1` int(2) unsigned NOT NULL COMMENT 'flag of partner1',
  `mingual_status2` int(2) NOT NULL,
  `status` int(2) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(255) unsigned NOT NULL,
  `id_user` int(255) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id_report` int(255) unsigned NOT NULL,
  `id_user` int(255) unsigned NOT NULL,
  `report_type` varchar(32) CHARACTER SET utf8 NOT NULL,
  `report_user` int(255) unsigned NOT NULL,
  `comment` blob NOT NULL,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(255) unsigned NOT NULL,
  `id_user` int(255) unsigned NOT NULL,
  `new_partner` int(2) NOT NULL,
  `new_message` int(2) NOT NULL,
  `vibration` int(2) NOT NULL,
  `alert` int(2) NOT NULL,
  `show_me` int(2) NOT NULL,
  `id_teach_lang` int(10) unsigned NOT NULL,
  `id_learn_lang` int(10) unsigned NOT NULL,
  `sch_radius` int(5) NOT NULL,
  `sch_city` varchar(64) CHARACTER SET utf8 NOT NULL,
  `sch_gender` varchar(2) NOT NULL,
  `sch_age_low` int(8) unsigned NOT NULL,
  `sch_age_high` int(8) unsigned NOT NULL,
  `sch_type` varchar(2) NOT NULL COMMENT 'l: local, g: global',
  `sch_local_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sch_g_lng` varchar(16) NOT NULL,
  `sch_g_lat` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(255) unsigned NOT NULL,
  `facebook_id` varchar(32) NOT NULL,
  `latitude` varchar(32) NOT NULL,
  `longitude` varchar(32) NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(2) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `age` int(4) NOT NULL,
  `id_country` int(11) unsigned NOT NULL,
  `hometown` varchar(255) CHARACTER SET utf8 NOT NULL,
  `about_me` text CHARACTER SET utf8 NOT NULL,
  `experience` text CHARACTER SET utf8 NOT NULL,
  `token` varchar(64) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_lang`);

--
-- Indexes for table `minguals`
--
ALTER TABLE `minguals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `facebook_id` (`facebook_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id_lang` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `minguals`
--
ALTER TABLE `minguals`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
