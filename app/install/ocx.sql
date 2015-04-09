-- --------------------------------------------------------

--
-- Database: `ocx`
--

-- --------------------------------------------------------

SET SQL_MODE = '';

-- --------------------------------------------------------

--
-- Table structure for table `ocx_address`
--

DROP TABLE IF EXISTS `ocx_address`;
CREATE TABLE IF NOT EXISTS `ocx_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_attribute`
--

DROP TABLE IF EXISTS `ocx_attribute`;
CREATE TABLE IF NOT EXISTS `ocx_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ocx_attribute`
--

INSERT INTO `ocx_attribute` VALUES
(1, 6, 1),
(2, 6, 5),
(3, 6, 3),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3),
(7, 3, 4),
(8, 3, 5),
(9, 3, 6),
(10, 3, 7),
(11, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_attribute_description`
--

DROP TABLE IF EXISTS `ocx_attribute_description`;
CREATE TABLE IF NOT EXISTS `ocx_attribute_description` (
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`attribute_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_attribute_description`
--

INSERT INTO `ocx_attribute_description` VALUES
(1, 1, 'Description'),
(2, 1, 'No. of Cores'),
(3, 1, 'Clockspeed'),
(4, 1, 'test 1'),
(5, 1, 'test 2'),
(6, 1, 'test 3'),
(7, 1, 'test 4'),
(8, 1, 'test 5'),
(9, 1, 'test 6'),
(10, 1, 'test 7'),
(11, 1, 'test 8');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_attribute_group`
--

DROP TABLE IF EXISTS `ocx_attribute_group`;
CREATE TABLE IF NOT EXISTS `ocx_attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ocx_attribute_group`
--

INSERT INTO `ocx_attribute_group` VALUES
(3, 2),
(4, 1),
(5, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_attribute_group_description`
--

DROP TABLE IF EXISTS `ocx_attribute_group_description`;
CREATE TABLE IF NOT EXISTS `ocx_attribute_group_description` (
  `attribute_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`attribute_group_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_attribute_group_description`
--

INSERT INTO `ocx_attribute_group_description` VALUES
(3, 1, 'Memory'),
(4, 1, 'Technical'),
(5, 1, 'Motherboard'),
(6, 1, 'Processor');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_banner`
--

DROP TABLE IF EXISTS `ocx_banner`;
CREATE TABLE IF NOT EXISTS `ocx_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ocx_banner`
--

INSERT INTO `ocx_banner` VALUES
(6, 'HP Products', 1),
(7, 'Samsung Tab', 1),
(8, 'Manufacturers', 1),
(9, 'Homepage', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_banner_image`
--

DROP TABLE IF EXISTS `ocx_banner_image`;
CREATE TABLE IF NOT EXISTS `ocx_banner_image` (
  `banner_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`banner_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=95 ;

--
-- Dumping data for table `ocx_banner_image`
--

INSERT INTO `ocx_banner_image` VALUES
(84, 6, 'hewlett-packard', 'data/demo/hp_banner.jpg'),
(85, 8, 'sony', 'data/demo/sony_logo.jpg'),
(86, 8, 'palm', 'data/demo/palm_logo.jpg'),
(87, 8, 'apple', 'data/demo/apple_logo.jpg'),
(88, 8, 'canon', 'data/demo/canon_logo.jpg'),
(89, 8, 'htc', 'data/demo/htc_logo.jpg'),
(90, 8, 'hewlett-packard', 'data/demo/hp_logo.jpg'),
(91, 7, 'http://ocx.local/tablets?product_id=49', 'data/demo/samsung_banner.jpg'),
(92, 9, 'apple', 'data/banner/1.jpg'),
(93, 9, 'samsung', 'data/banner/2.jpg'),
(94, 9, 'hewlett-packard', 'data/banner/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_banner_image_description`
--

DROP TABLE IF EXISTS `ocx_banner_image_description`;
CREATE TABLE IF NOT EXISTS `ocx_banner_image_description` (
  `banner_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`banner_image_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_banner_image_description`
--

INSERT INTO `ocx_banner_image_description` VALUES
(84, 1, 6, 'HP Banner'),
(85, 1, 8, 'Sony'),
(86, 1, 8, 'Palm'),
(87, 1, 8, 'Apple'),
(88, 1, 8, 'Canon'),
(89, 1, 8, 'HTC'),
(90, 1, 8, 'Hewlett-Packard'),
(91, 1, 7, 'Samsung Tab 10.1'),
(92, 1, 9, 'Hatch Premium Fly Reels'),
(93, 1, 9, 'Yeti Containers'),
(94, 1, 9, 'Louisiana Salt Water Series');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_category`
--

DROP TABLE IF EXISTS `ocx_blog_category`;
CREATE TABLE IF NOT EXISTS `ocx_blog_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ocx_blog_category`
--

INSERT INTO `ocx_blog_category` VALUES
(1, '', 0, 0, 0, 0, 1, '2014-08-20 04:58:59', '2014-08-24 15:59:01'),
(2, 'data/blog/category/landscape-a.jpg', 1, 0, 0, 0, 1, '2014-08-22 17:04:52', '2014-09-27 21:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_category_description`
--

DROP TABLE IF EXISTS `ocx_blog_category_description`;
CREATE TABLE IF NOT EXISTS `ocx_blog_category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_blog_category_description`
--

INSERT INTO `ocx_blog_category_description` VALUES
(1, 1, 'General', '&lt;p&gt;This is the general category for all things general.&lt;/p&gt;', '																																								', '																																								'),
(2, 1, 'Latest Product News', '&lt;p&gt;\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n&lt;/p&gt;', '																																																																																', '																																																																																');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_category_to_layout`
--

DROP TABLE IF EXISTS `ocx_blog_category_to_layout`;
CREATE TABLE IF NOT EXISTS `ocx_blog_category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_category_to_store`
--

DROP TABLE IF EXISTS `ocx_blog_category_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_blog_category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_blog_category_to_store`
--

INSERT INTO `ocx_blog_category_to_store` VALUES
(1, 0),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_comment`
--

DROP TABLE IF EXISTS `ocx_blog_comment`;
CREATE TABLE IF NOT EXISTS `ocx_blog_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ocx_blog_comment`
--

INSERT INTO `ocx_blog_comment` VALUES
(1, 1, 0, 'Ralph P', 'vkronlein@icloud.com', 'http://ocx.io', '&lt;p&gt;Great article on Lorem Ipsum, thanks.&lt;/p&gt;', 4, 1, '2014-10-02 09:16:24', '0000-00-00 00:00:00'),
(2, 1, 0, 'Steve J', 'vince.kronlein@gmail.com', 'http://google.com', 'Cheerio mate, good show.  Loved it.', 5, 1, '2014-08-23 19:54:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post`
--

DROP TABLE IF EXISTS `ocx_blog_post`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `visibility` tinyint(3) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewed` int(5) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_blog_post`
--

INSERT INTO `ocx_blog_post` VALUES
(1, 'data/blog/post/landscape-b.jpg', 1, '2014-08-19', 1, 1, 1, '2014-08-20 06:34:50', '2014-10-02 09:14:57', 214);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_description`
--

DROP TABLE IF EXISTS `ocx_blog_post_description`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_description` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`post_id`,`language_id`),
  KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_blog_post_description`
--

INSERT INTO `ocx_blog_post_description` VALUES
(1, 1, 'Lorem Ipsum Test Post', '&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Lorem ipsum dolor sit amet,&lt;/span&gt; consectetur adipiscing elit. Phasellus feugiat dui a odio facilisis porta commodo ut ligula. Nullam ligula urna, blandit vel justo eu, tristique tempor nisl. Nam ornare auctor enim vel venenatis. Duis et elit augue. Nulla auctor nunc et ultrices lobortis. Donec ultricies, metus quis convallis tincidunt, nisl nibh molestie tortor, et accumsan turpis nulla rhoncus libero. Donec hendrerit enim ut lectus condimentum malesuada.&lt;/p&gt;\r\n&lt;p&gt;Quisque vel augue semper, euismod turpis sed, suscipit odio. Morbi venenatis neque a tristique sodales. Suspendisse sed tempor mauris, eu blandit nulla. Vivamus quis enim et nibh ultrices pellentesque. In nec dapibus orci. Nam vel augue at nunc convallis adipiscing eget quis libero. Cras semper odio congue, varius diam a, rutrum dolor.&lt;/p&gt;\r\n&lt;p&gt;Pellentesque sed tincidunt velit, pellentesque luctus tellus. Duis vulputate lacus eu metus consectetur pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce pulvinar quam non magna aliquet, a tincidunt diam lobortis. Vestibulum quam quam, commodo commodo ornare at, sodales ac elit. Pellentesque convallis pellentesque ante at facilisis. Duis ut porta mauris. Vestibulum suscipit elit vitae urna hendrerit, fermentum placerat justo tristique. Quisque eget odio nunc. Morbi interdum sed mi sit amet suscipit. Nullam nec lacinia dolor, vel dapibus nulla. Aenean sed congue nisi, id dictum diam. Phasellus ac metus non ligula interdum hendrerit eget vitae nisi.&lt;/p&gt;\r\n&lt;p&gt;In posuere molestie imperdiet. Nunc auctor sagittis risus, ullamcorper elementum dui ullamcorper eget. Donec quis diam porttitor, fringilla purus nec, viverra tellus. In sit amet pulvinar risus, sed porttitor lectus. Proin nunc metus, porta id viverra nec, aliquet in lorem. Quisque faucibus lorem vitae nulla adipiscing, in aliquet lorem cursus. Pellentesque id suscipit justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis non ante quis vehicula.&lt;/p&gt;\r\n&lt;p&gt;Sed at metus ipsum. Integer odio leo, volutpat eu sagittis sed, sodales vel dui. Vestibulum nec tellus orci. Etiam hendrerit at arcu vel interdum. Praesent quis nulla adipiscing, convallis est in, pulvinar quam. Curabitur at massa pulvinar eros rhoncus molestie vitae eget purus. Curabitur ullamcorper dictum tortor, in blandit urna gravida et. Nulla a nisl ligula. Vestibulum lobortis rutrum luctus. Phasellus mattis, turpis at dignissim fringilla, quam quam egestas nisl, vel viverra sem diam gravida purus. In eget erat rutrum, pulvinar lectus porta, aliquam lorem. Sed lorem purus, sodales id pellentesque id, volutpat a tellus. Nam aliquam ullamcorper odio sed egestas. Donec vel dictum odio.&lt;/p&gt;', 'Test Meta Description', 'lorem, ipsum', 'lorem, ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_image`
--

DROP TABLE IF EXISTS `ocx_blog_post_image`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_image` (
  `post_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`post_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_related`
--

DROP TABLE IF EXISTS `ocx_blog_post_related`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_related` (
  `post_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_to_category`
--

DROP TABLE IF EXISTS `ocx_blog_post_to_category`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_to_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_blog_post_to_category`
--

INSERT INTO `ocx_blog_post_to_category` VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_to_layout`
--

DROP TABLE IF EXISTS `ocx_blog_post_to_layout`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_to_layout` (
  `post_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_blog_post_to_store`
--

DROP TABLE IF EXISTS `ocx_blog_post_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_blog_post_to_store` (
  `post_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_blog_post_to_store`
--

INSERT INTO `ocx_blog_post_to_store` VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category`
--

DROP TABLE IF EXISTS `ocx_category`;
CREATE TABLE IF NOT EXISTS `ocx_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `ocx_category`
--

INSERT INTO `ocx_category` VALUES
(17, '', 0, 1, 1, 4, 1, '2009-01-03 21:08:57', '2014-06-28 01:02:28'),
(18, 'data/demo/hp_2.jpg', 0, 1, 0, 2, 1, '2009-01-05 21:49:15', '2014-06-28 01:06:55'),
(20, 'data/demo/compaq_presario.jpg', 0, 1, 1, 1, 1, '2009-01-05 21:49:43', '2014-09-16 06:49:47'),
(24, '', 0, 1, 1, 5, 1, '2009-01-20 02:36:26', '2014-06-28 01:02:39'),
(25, '', 0, 1, 1, 3, 1, '2009-01-31 01:04:25', '2014-06-28 01:00:35'),
(26, '', 20, 0, 0, 1, 1, '2009-01-31 01:55:14', '2014-06-28 01:07:06'),
(27, '', 20, 0, 0, 2, 1, '2009-01-31 01:55:34', '2014-06-28 01:07:17'),
(28, '', 25, 0, 0, 1, 1, '2009-02-02 13:11:12', '2014-06-28 01:01:09'),
(29, '', 25, 0, 0, 1, 1, '2009-02-02 13:11:37', '2014-06-28 01:00:57'),
(30, '', 25, 0, 0, 1, 1, '2009-02-02 13:11:59', '2014-06-28 01:08:08'),
(31, '', 25, 0, 0, 1, 1, '2009-02-03 14:17:24', '2014-06-28 01:07:52'),
(32, '', 25, 0, 0, 1, 1, '2009-02-03 14:17:34', '2014-06-28 01:07:41'),
(33, '', 0, 1, 1, 6, 1, '2009-02-03 14:17:55', '2014-09-12 22:25:57'),
(34, 'data/demo/ipod_touch_4.jpg', 0, 1, 4, 7, 1, '2009-02-03 14:18:11', '2014-06-28 01:06:06'),
(35, '', 28, 0, 0, 0, 1, '2010-09-17 10:06:48', '2014-06-28 01:01:31'),
(36, '', 28, 0, 0, 0, 1, '2010-09-17 10:07:13', '2014-06-28 01:01:44'),
(37, '', 34, 0, 0, 0, 1, '2010-09-18 14:03:39', '2014-06-28 01:03:32'),
(38, '', 34, 0, 0, 0, 1, '2010-09-18 14:03:51', '2014-06-28 01:03:41'),
(39, '', 34, 0, 0, 0, 1, '2010-09-18 14:04:17', '2014-06-28 01:03:20'),
(40, '', 34, 0, 0, 0, 1, '2010-09-18 14:05:36', '2014-06-28 01:03:12'),
(41, '', 34, 0, 0, 0, 1, '2010-09-18 14:05:49', '2014-06-28 01:03:03'),
(42, '', 34, 0, 0, 0, 1, '2010-09-18 14:06:34', '2014-06-28 01:02:49'),
(43, '', 34, 0, 0, 0, 1, '2010-09-18 14:06:49', '2014-06-28 01:05:54'),
(44, '', 34, 0, 0, 0, 1, '2010-09-21 15:39:21', '2014-06-28 01:05:44'),
(45, '', 18, 0, 0, 0, 1, '2010-09-24 18:29:16', '2014-06-28 01:06:20'),
(46, '', 18, 0, 0, 0, 1, '2010-09-24 18:29:31', '2014-06-28 01:06:35'),
(47, '', 34, 0, 0, 0, 1, '2010-11-07 11:13:16', '2014-06-28 01:05:36'),
(48, '', 34, 0, 0, 0, 1, '2010-11-07 11:13:33', '2014-06-28 01:05:29'),
(49, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:04', '2014-06-28 01:05:14'),
(50, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:23', '2014-06-28 01:05:05'),
(51, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:38', '2014-06-28 01:04:59'),
(52, '', 34, 0, 0, 0, 1, '2010-11-07 11:16:09', '2014-06-28 01:04:51'),
(53, '', 34, 0, 0, 0, 1, '2010-11-07 11:28:53', '2014-06-28 01:04:30'),
(54, '', 34, 0, 0, 0, 1, '2010-11-07 11:29:16', '2014-06-28 01:04:12'),
(55, '', 34, 0, 0, 0, 1, '2010-11-08 10:31:32', '2014-06-28 01:03:56'),
(56, '', 34, 0, 0, 0, 1, '2010-11-08 10:31:50', '2014-06-28 01:03:48'),
(57, '', 0, 1, 1, 3, 1, '2011-04-26 08:53:16', '2014-06-28 01:02:19'),
(58, '', 52, 0, 0, 0, 1, '2011-05-08 13:44:16', '2014-06-28 01:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category_description`
--

DROP TABLE IF EXISTS `ocx_category_description`;
CREATE TABLE IF NOT EXISTS `ocx_category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_category_description`
--

INSERT INTO `ocx_category_description` VALUES
(17, 1, 'Software', '', '', ''),
(18, 1, 'Laptops &amp; Notebooks', '&lt;p&gt;Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.&lt;/p&gt;\r\n', '', ''),
(20, 1, 'Desktops', '&lt;p&gt;Example of category description text&lt;/p&gt;\r\n', 'Example of category description', ''),
(24, 1, 'Phones &amp; PDAs', '', '', ''),
(25, 1, 'Components', '', '', ''),
(26, 1, 'PC', '', '', ''),
(27, 1, 'Mac', '', '', ''),
(28, 1, 'Monitors', '', '', ''),
(29, 1, 'Mice and Trackballs', '', '', ''),
(30, 1, 'Printers', '', '', ''),
(31, 1, 'Scanners', '', '', ''),
(32, 1, 'Web Cameras', '', '', ''),
(33, 1, 'Cameras', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', ''),
(34, 1, 'MP3 Players', '&lt;p&gt;Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.&lt;/p&gt;\r\n', '', ''),
(35, 1, 'test 1', '', '', ''),
(36, 1, 'test 2', '', '', ''),
(37, 1, 'test 5', '', '', ''),
(38, 1, 'test 4', '', '', ''),
(39, 1, 'test 6', '', '', ''),
(40, 1, 'test 7', '', '', ''),
(41, 1, 'test 8', '', '', ''),
(42, 1, 'test 9', '', '', ''),
(43, 1, 'test 11', '', '', ''),
(44, 1, 'test 12', '', '', ''),
(45, 1, 'Windows', '', '', ''),
(46, 1, 'Macs', '', '', ''),
(47, 1, 'test 15', '', '', ''),
(48, 1, 'test 16', '', '', ''),
(49, 1, 'test 17', '', '', ''),
(50, 1, 'test 18', '', '', ''),
(51, 1, 'test 19', '', '', ''),
(52, 1, 'test 20', '', '', ''),
(53, 1, 'test 21', '', '', ''),
(54, 1, 'test 22', '', '', ''),
(55, 1, 'test 23', '', '', ''),
(56, 1, 'test 24', '', '', ''),
(57, 1, 'Tablets', '', '', ''),
(58, 1, 'test 25', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category_filter`
--

DROP TABLE IF EXISTS `ocx_category_filter`;
CREATE TABLE IF NOT EXISTS `ocx_category_filter` (
  `category_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category_path`
--

DROP TABLE IF EXISTS `ocx_category_path`;
CREATE TABLE IF NOT EXISTS `ocx_category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_category_path`
--

INSERT INTO `ocx_category_path` VALUES
(17, 17, 0),
(18, 18, 0),
(20, 20, 0),
(24, 24, 0),
(25, 25, 0),
(26, 20, 0),
(26, 26, 1),
(27, 20, 0),
(27, 27, 1),
(28, 25, 0),
(28, 28, 1),
(29, 25, 0),
(29, 29, 1),
(30, 25, 0),
(30, 30, 1),
(31, 25, 0),
(31, 31, 1),
(32, 25, 0),
(32, 32, 1),
(33, 33, 0),
(34, 34, 0),
(35, 25, 0),
(35, 28, 1),
(35, 35, 2),
(36, 25, 0),
(36, 28, 1),
(36, 36, 2),
(37, 34, 0),
(37, 37, 1),
(38, 34, 0),
(38, 38, 1),
(39, 34, 0),
(39, 39, 1),
(40, 34, 0),
(40, 40, 1),
(41, 34, 0),
(41, 41, 1),
(42, 34, 0),
(42, 42, 1),
(43, 34, 0),
(43, 43, 1),
(44, 34, 0),
(44, 44, 1),
(45, 18, 0),
(45, 45, 1),
(46, 18, 0),
(46, 46, 1),
(47, 34, 0),
(47, 47, 1),
(48, 34, 0),
(48, 48, 1),
(49, 34, 0),
(49, 49, 1),
(50, 34, 0),
(50, 50, 1),
(51, 34, 0),
(51, 51, 1),
(52, 34, 0),
(52, 52, 1),
(53, 34, 0),
(53, 53, 1),
(54, 34, 0),
(54, 54, 1),
(55, 34, 0),
(55, 55, 1),
(56, 34, 0),
(56, 56, 1),
(57, 57, 0),
(58, 34, 0),
(58, 52, 1),
(58, 58, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category_to_layout`
--

DROP TABLE IF EXISTS `ocx_category_to_layout`;
CREATE TABLE IF NOT EXISTS `ocx_category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_category_to_store`
--

DROP TABLE IF EXISTS `ocx_category_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_category_to_store`
--

INSERT INTO `ocx_category_to_store` VALUES
(17, 0),
(18, 0),
(20, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(38, 0),
(39, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(45, 0),
(46, 0),
(47, 0),
(48, 0),
(49, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 0),
(54, 0),
(55, 0),
(56, 0),
(57, 0),
(58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_country`
--

DROP TABLE IF EXISTS `ocx_country`;
CREATE TABLE IF NOT EXISTS `ocx_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `iso_code_2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `iso_code_3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `address_format` text COLLATE utf8_unicode_ci NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=252 ;

--
-- Dumping data for table `ocx_country`
--

INSERT INTO `ocx_country` VALUES
(3, 'Algeria', 'DZ', 'DZA', '', 0, 0),
(4, 'American Samoa', 'AS', 'ASM', '', 0, 0),
(5, 'Andorra', 'AD', 'AND', '', 0, 0),
(6, 'Angola', 'AO', 'AGO', '', 0, 0),
(7, 'Anguilla', 'AI', 'AIA', '', 0, 0),
(8, 'Antarctica', 'AQ', 'ATA', '', 0, 0),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 0),
(10, 'Argentina', 'AR', 'ARG', '', 0, 0),
(11, 'Armenia', 'AM', 'ARM', '', 0, 0),
(12, 'Aruba', 'AW', 'ABW', '', 0, 0),
(13, 'Australia', 'AU', 'AUS', '', 0, 0),
(14, 'Austria', 'AT', 'AUT', '', 0, 0),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 0, 0),
(16, 'Bahamas', 'BS', 'BHS', '', 0, 0),
(17, 'Bahrain', 'BH', 'BHR', '', 0, 0),
(18, 'Bangladesh', 'BD', 'BGD', '', 0, 0),
(19, 'Barbados', 'BB', 'BRB', '', 0, 0),
(21, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 0),
(22, 'Belize', 'BZ', 'BLZ', '', 0, 0),
(23, 'Benin', 'BJ', 'BEN', '', 0, 0),
(24, 'Bermuda', 'BM', 'BMU', '', 0, 0),
(25, 'Bhutan', 'BT', 'BTN', '', 0, 0),
(26, 'Bolivia', 'BO', 'BOL', '', 0, 0),
(28, 'Botswana', 'BW', 'BWA', '', 0, 0),
(29, 'Bouvet Island', 'BV', 'BVT', '', 0, 0),
(30, 'Brazil', 'BR', 'BRA', '', 0, 0),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 0),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 0),
(34, 'Burkina Faso', 'BF', 'BFA', '', 0, 0),
(35, 'Burundi', 'BI', 'BDI', '', 0, 0),
(36, 'Cambodia', 'KH', 'KHM', '', 0, 0),
(37, 'Cameroon', 'CM', 'CMR', '', 0, 0),
(38, 'Canada', 'CA', 'CAN', '', 1, 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 0, 0),
(40, 'Cayman Islands', 'KY', 'CYM', '', 0, 0),
(41, 'Central African Republic', 'CF', 'CAF', '', 0, 0),
(42, 'Chad', 'TD', 'TCD', '', 0, 0),
(43, 'Chile', 'CL', 'CHL', '', 0, 0),
(44, 'China', 'CN', 'CHN', '', 0, 0),
(45, 'Christmas Island', 'CX', 'CXR', '', 0, 0),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 0),
(47, 'Colombia', 'CO', 'COL', '', 0, 0),
(48, 'Comoros', 'KM', 'COM', '', 0, 0),
(50, 'Cook Islands', 'CK', 'COK', '', 0, 0),
(51, 'Costa Rica', 'CR', 'CRI', '', 0, 0),
(56, 'Czech Republic', 'CZ', 'CZE', '', 0, 0),
(57, 'Denmark', 'DK', 'DNK', '', 0, 0),
(58, 'Djibouti', 'DJ', 'DJI', '', 0, 0),
(59, 'Dominica', 'DM', 'DMA', '', 0, 0),
(60, 'Dominican Republic', 'DO', 'DOM', '', 0, 0),
(61, 'East Timor', 'TL', 'TLS', '', 0, 0),
(62, 'Ecuador', 'EC', 'ECU', '', 0, 0),
(63, 'Egypt', 'EG', 'EGY', '', 0, 0),
(64, 'El Salvador', 'SV', 'SLV', '', 0, 0),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 0),
(67, 'Estonia', 'EE', 'EST', '', 0, 0),
(68, 'Ethiopia', 'ET', 'ETH', '', 0, 0),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 0),
(70, 'Faroe Islands', 'FO', 'FRO', '', 0, 0),
(71, 'Fiji', 'FJ', 'FJI', '', 0, 0),
(72, 'Finland', 'FI', 'FIN', '', 0, 0),
(74, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0),
(75, 'French Guiana', 'GF', 'GUF', '', 0, 0),
(76, 'French Polynesia', 'PF', 'PYF', '', 0, 0),
(77, 'French Southern Territories', 'TF', 'ATF', '', 0, 0),
(78, 'Gabon', 'GA', 'GAB', '', 0, 0),
(79, 'Gambia', 'GM', 'GMB', '', 0, 0),
(80, 'Georgia', 'GE', 'GEO', '', 0, 0),
(81, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0),
(82, 'Ghana', 'GH', 'GHA', '', 0, 0),
(83, 'Gibraltar', 'GI', 'GIB', '', 0, 0),
(84, 'Greece', 'GR', 'GRC', '', 0, 0),
(85, 'Greenland', 'GL', 'GRL', '', 0, 0),
(86, 'Grenada', 'GD', 'GRD', '', 0, 0),
(87, 'Guadeloupe', 'GP', 'GLP', '', 0, 0),
(88, 'Guam', 'GU', 'GUM', '', 0, 0),
(89, 'Guatemala', 'GT', 'GTM', '', 0, 0),
(90, 'Guinea', 'GN', 'GIN', '', 0, 0),
(91, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 0),
(92, 'Guyana', 'GY', 'GUY', '', 0, 0),
(93, 'Haiti', 'HT', 'HTI', '', 0, 0),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 0),
(95, 'Honduras', 'HN', 'HND', '', 0, 0),
(96, 'Hong Kong', 'HK', 'HKG', '', 0, 0),
(97, 'Hungary', 'HU', 'HUN', '', 0, 0),
(98, 'Iceland', 'IS', 'ISL', '', 0, 0),
(99, 'India', 'IN', 'IND', '', 0, 0),
(100, 'Indonesia', 'ID', 'IDN', '', 0, 0),
(103, 'Ireland', 'IE', 'IRL', '', 0, 0),
(104, 'Israel', 'IL', 'ISR', '', 0, 0),
(105, 'Italy', 'IT', 'ITA', '', 0, 0),
(106, 'Jamaica', 'JM', 'JAM', '', 0, 0),
(107, 'Japan', 'JP', 'JPN', '', 0, 0),
(108, 'Jordan', 'JO', 'JOR', '', 0, 0),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 0),
(110, 'Kenya', 'KE', 'KEN', '', 0, 0),
(111, 'Kiribati', 'KI', 'KIR', '', 0, 0),
(113, 'Korea, Republic of', 'KR', 'KOR', '', 0, 0),
(114, 'Kuwait', 'KW', 'KWT', '', 0, 0),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 0),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', '', 0, 0),
(117, 'Latvia', 'LV', 'LVA', '', 0, 0),
(119, 'Lesotho', 'LS', 'LSO', '', 0, 0),
(122, 'Liechtenstein', 'LI', 'LIE', '', 0, 0),
(123, 'Lithuania', 'LT', 'LTU', '', 0, 0),
(124, 'Luxembourg', 'LU', 'LUX', '', 0, 0),
(125, 'Macau', 'MO', 'MAC', '', 0, 0),
(127, 'Madagascar', 'MG', 'MDG', '', 0, 0),
(128, 'Malawi', 'MW', 'MWI', '', 0, 0),
(129, 'Malaysia', 'MY', 'MYS', '', 0, 0),
(130, 'Maldives', 'MV', 'MDV', '', 0, 0),
(131, 'Mali', 'ML', 'MLI', '', 0, 0),
(132, 'Malta', 'MT', 'MLT', '', 0, 0),
(133, 'Marshall Islands', 'MH', 'MHL', '', 0, 0),
(134, 'Martinique', 'MQ', 'MTQ', '', 0, 0),
(135, 'Mauritania', 'MR', 'MRT', '', 0, 0),
(136, 'Mauritius', 'MU', 'MUS', '', 0, 0),
(137, 'Mayotte', 'YT', 'MYT', '', 0, 0),
(138, 'Mexico', 'MX', 'MEX', '', 0, 0),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 0),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 0),
(141, 'Monaco', 'MC', 'MCO', '', 0, 0),
(142, 'Mongolia', 'MN', 'MNG', '', 0, 0),
(143, 'Montserrat', 'MS', 'MSR', '', 0, 0),
(144, 'Morocco', 'MA', 'MAR', '', 0, 0),
(145, 'Mozambique', 'MZ', 'MOZ', '', 0, 0),
(147, 'Namibia', 'NA', 'NAM', '', 0, 0),
(148, 'Nauru', 'NR', 'NRU', '', 0, 0),
(149, 'Nepal', 'NP', 'NPL', '', 0, 0),
(150, 'Netherlands', 'NL', 'NLD', '', 0, 0),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 0),
(152, 'New Caledonia', 'NC', 'NCL', '', 0, 0),
(153, 'New Zealand', 'NZ', 'NZL', '', 0, 0),
(154, 'Nicaragua', 'NI', 'NIC', '', 0, 0),
(155, 'Niger', 'NE', 'NER', '', 0, 0),
(156, 'Nigeria', 'NG', 'NGA', '', 0, 0),
(157, 'Niue', 'NU', 'NIU', '', 0, 0),
(158, 'Norfolk Island', 'NF', 'NFK', '', 0, 0),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 0),
(160, 'Norway', 'NO', 'NOR', '', 0, 0),
(161, 'Oman', 'OM', 'OMN', '', 0, 0),
(162, 'Pakistan', 'PK', 'PAK', '', 0, 0),
(163, 'Palau', 'PW', 'PLW', '', 0, 0),
(164, 'Panama', 'PA', 'PAN', '', 0, 0),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 0, 0),
(166, 'Paraguay', 'PY', 'PRY', '', 0, 0),
(167, 'Peru', 'PE', 'PER', '', 0, 0),
(168, 'Philippines', 'PH', 'PHL', '', 0, 0),
(169, 'Pitcairn', 'PN', 'PCN', '', 0, 0),
(170, 'Poland', 'PL', 'POL', '', 0, 0),
(171, 'Portugal', 'PT', 'PRT', '', 0, 0),
(172, 'Puerto Rico', 'PR', 'PRI', '', 0, 0),
(173, 'Qatar', 'QA', 'QAT', '', 0, 0),
(174, 'Reunion', 'RE', 'REU', '', 0, 0),
(175, 'Romania', 'RO', 'ROM', '', 0, 0),
(176, 'Russian Federation', 'RU', 'RUS', '', 0, 0),
(177, 'Rwanda', 'RW', 'RWA', '', 0, 0),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 0),
(179, 'Saint Lucia', 'LC', 'LCA', '', 0, 0),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 0),
(181, 'Samoa', 'WS', 'WSM', '', 0, 0),
(182, 'San Marino', 'SM', 'SMR', '', 0, 0),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 0),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 0, 0),
(185, 'Senegal', 'SN', 'SEN', '', 0, 0),
(186, 'Seychelles', 'SC', 'SYC', '', 0, 0),
(187, 'Sierra Leone', 'SL', 'SLE', '', 0, 0),
(188, 'Singapore', 'SG', 'SGP', '', 0, 0),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 0),
(191, 'Solomon Islands', 'SB', 'SLB', '', 0, 0),
(193, 'South Africa', 'ZA', 'ZAF', '', 0, 0),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 0),
(195, 'Spain', 'ES', 'ESP', '', 0, 0),
(197, 'St. Helena', 'SH', 'SHN', '', 0, 0),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 0),
(200, 'Suriname', 'SR', 'SUR', '', 0, 0),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 0),
(202, 'Swaziland', 'SZ', 'SWZ', '', 0, 0),
(203, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0),
(204, 'Switzerland', 'CH', 'CHE', '', 0, 0),
(206, 'Taiwan', 'TW', 'TWN', '', 0, 0),
(207, 'Tajikistan', 'TJ', 'TJK', '', 0, 0),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 0),
(209, 'Thailand', 'TH', 'THA', '', 0, 0),
(210, 'Togo', 'TG', 'TGO', '', 0, 0),
(211, 'Tokelau', 'TK', 'TKL', '', 0, 0),
(212, 'Tonga', 'TO', 'TON', '', 0, 0),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 0),
(214, 'Tunisia', 'TN', 'TUN', '', 0, 0),
(215, 'Turkey', 'TR', 'TUR', '', 0, 0),
(216, 'Turkmenistan', 'TM', 'TKM', '', 0, 0),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 0),
(218, 'Tuvalu', 'TV', 'TUV', '', 0, 0),
(219, 'Uganda', 'UG', 'UGA', '', 0, 0),
(220, 'Ukraine', 'UA', 'UKR', '', 0, 0),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 0, 0),
(222, 'United Kingdom', 'GB', 'GBR', '', 1, 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 1, 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 0),
(225, 'Uruguay', 'UY', 'URY', '', 0, 0),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 0, 0),
(227, 'Vanuatu', 'VU', 'VUT', '', 0, 0),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 0),
(229, 'Venezuela', 'VE', 'VEN', '', 0, 0),
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 0),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 0),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 0),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 0),
(234, 'Western Sahara', 'EH', 'ESH', '', 0, 0),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 0),
(238, 'Zambia', 'ZM', 'ZMB', '', 0, 0),
(240, 'Jersey', 'JE', 'JEY', '', 1, 0),
(241, 'Guernsey', 'GG', 'GGY', '', 1, 0),
(242, 'Montenegro', 'ME', 'MNE', '', 0, 0),
(244, 'Aaland Islands', 'AX', 'ALA', '', 0, 0),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 0),
(246, 'Curacao', 'CW', 'CUW', '', 0, 0),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 0),
(248, 'South Sudan', 'SS', 'SSD', '', 0, 0),
(249, 'St. Barthelemy', 'BL', 'BLM', '', 0, 0),
(250, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 0),
(251, 'Canary Islands', 'IC', 'ICA', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_coupon`
--

DROP TABLE IF EXISTS `ocx_coupon`;
CREATE TABLE IF NOT EXISTS `ocx_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `discount` decimal(15,4) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ocx_coupon`
--

INSERT INTO `ocx_coupon` VALUES
(4, '-10% Discount', '2222', 'P', '10.0000', 0, 0, '0.0000', '2011-01-01', '2012-01-01', 10, '10', 1, '2009-01-27 13:55:03'),
(5, 'Free Shipping', '3333', 'P', '0.0000', 0, 1, '100.0000', '2009-03-01', '2009-08-31', 10, '10', 1, '2009-03-14 21:13:53'),
(6, '-10.00 Discount', '1111', 'F', '10.0000', 0, 0, '10.0000', '1970-11-01', '2020-11-01', 100000, '10000', 1, '2009-03-14 21:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_coupon_category`
--

DROP TABLE IF EXISTS `ocx_coupon_category`;
CREATE TABLE IF NOT EXISTS `ocx_coupon_category` (
  `coupon_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_coupon_history`
--

DROP TABLE IF EXISTS `ocx_coupon_history`;
CREATE TABLE IF NOT EXISTS `ocx_coupon_history` (
  `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`coupon_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_coupon_product`
--

DROP TABLE IF EXISTS `ocx_coupon_product`;
CREATE TABLE IF NOT EXISTS `ocx_coupon_product` (
  `coupon_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_currency`
--

DROP TABLE IF EXISTS `ocx_currency`;
CREATE TABLE IF NOT EXISTS `ocx_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `decimal_place` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `value` float(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ocx_currency`
--

INSERT INTO `ocx_currency` VALUES
(1, 'Pound Sterling', 'GBP', '£', '', '2', 0.61979997, 1, '2014-10-02 17:43:44'),
(2, 'US Dollar', 'USD', '$', '', '2', 1.00000000, 1, '2014-10-02 18:17:36'),
(3, 'Euro', 'EUR', '', '€', '2', 0.78990000, 1, '2014-10-02 17:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer`
--

DROP TABLE IF EXISTS `ocx_customer`;
CREATE TABLE IF NOT EXISTS `ocx_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `user_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `cart` text COLLATE utf8_unicode_ci,
  `wishlist` text COLLATE utf8_unicode_ci,
  `newsletter` tinyint(1) NOT NULL,
  `address_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `is_affiliate` tinyint(1) NOT NULL DEFAULT '0',
  `company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(4,2) NOT NULL DEFAULT '0.00',
  `tax_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `cheque` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch_number` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_swift_code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_number` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_id`,`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_ban_ip`
--

DROP TABLE IF EXISTS `ocx_customer_ban_ip`;
CREATE TABLE IF NOT EXISTS `ocx_customer_ban_ip` (
  `customer_ban_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_ban_ip_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_commission`
--

DROP TABLE IF EXISTS `ocx_customer_commission`;
CREATE TABLE IF NOT EXISTS `ocx_customer_commission` (
  `customer_commission_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_commission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_credit`
--

DROP TABLE IF EXISTS `ocx_customer_credit`;
CREATE TABLE IF NOT EXISTS `ocx_customer_credit` (
  `customer_credit_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_credit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_field`
--

DROP TABLE IF EXISTS `ocx_customer_field`;
CREATE TABLE IF NOT EXISTS `ocx_customer_field` (
  `customer_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `custom_field_value_id` int(11) NOT NULL,
  `name` int(128) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`customer_id`,`custom_field_id`,`custom_field_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_group`
--

DROP TABLE IF EXISTS `ocx_customer_group`;
CREATE TABLE IF NOT EXISTS `ocx_customer_group` (
  `customer_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval` int(1) NOT NULL,
  `company_id_display` int(1) NOT NULL,
  `company_id_required` int(1) NOT NULL,
  `tax_id_display` int(1) NOT NULL,
  `tax_id_required` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`customer_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_customer_group`
--

INSERT INTO `ocx_customer_group` VALUES
(1, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_group_description`
--

DROP TABLE IF EXISTS `ocx_customer_group_description`;
CREATE TABLE IF NOT EXISTS `ocx_customer_group_description` (
  `customer_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_group_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_customer_group_description`
--

INSERT INTO `ocx_customer_group_description` VALUES
(1, 1, 'Default', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_history`
--

DROP TABLE IF EXISTS `ocx_customer_history`;
CREATE TABLE IF NOT EXISTS `ocx_customer_history` (
  `customer_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_inbox`
--

DROP TABLE IF EXISTS `ocx_customer_inbox`;
CREATE TABLE IF NOT EXISTS `ocx_customer_inbox` (
  `notification_id` int(13) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `subject` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_ip`
--

DROP TABLE IF EXISTS `ocx_customer_ip`;
CREATE TABLE IF NOT EXISTS `ocx_customer_ip` (
  `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_ip_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_notification`
--

DROP TABLE IF EXISTS `ocx_customer_notification`;
CREATE TABLE IF NOT EXISTS `ocx_customer_notification` (
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_online`
--

DROP TABLE IF EXISTS `ocx_customer_online`;
CREATE TABLE IF NOT EXISTS `ocx_customer_online` (
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `referer` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_customer_reward`
--

DROP TABLE IF EXISTS `ocx_customer_reward`;
CREATE TABLE IF NOT EXISTS `ocx_customer_reward` (
  `customer_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `points` int(8) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_reward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_custom_field`
--

DROP TABLE IF EXISTS `ocx_custom_field`;
CREATE TABLE IF NOT EXISTS `ocx_custom_field` (
  `custom_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  `location` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_custom_field_description`
--

DROP TABLE IF EXISTS `ocx_custom_field_description`;
CREATE TABLE IF NOT EXISTS `ocx_custom_field_description` (
  `custom_field_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`custom_field_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_custom_field_to_customer_group`
--

DROP TABLE IF EXISTS `ocx_custom_field_to_customer_group`;
CREATE TABLE IF NOT EXISTS `ocx_custom_field_to_customer_group` (
  `custom_field_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_custom_field_value`
--

DROP TABLE IF EXISTS `ocx_custom_field_value`;
CREATE TABLE IF NOT EXISTS `ocx_custom_field_value` (
  `custom_field_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_custom_field_value_description`
--

DROP TABLE IF EXISTS `ocx_custom_field_value_description`;
CREATE TABLE IF NOT EXISTS `ocx_custom_field_value_description` (
  `custom_field_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`custom_field_value_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_download`
--

DROP TABLE IF EXISTS `ocx_download`;
CREATE TABLE IF NOT EXISTS `ocx_download` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mask` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `remaining` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_download_description`
--

DROP TABLE IF EXISTS `ocx_download_description`;
CREATE TABLE IF NOT EXISTS `ocx_download_description` (
  `download_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`download_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_email`
--

DROP TABLE IF EXISTS `ocx_email`;
CREATE TABLE IF NOT EXISTS `ocx_email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_slug` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `configurable` tinyint(1) NOT NULL DEFAULT '0',
  `config_description` text COLLATE utf8_unicode_ci NOT NULL,
  `recipient` tinyint(1) NOT NULL DEFAULT '1',
  `is_system` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ocx_email`
--

INSERT INTO `ocx_email` (`email_id`, `email_slug`, `configurable`, `config_description`, `recipient`, `is_system`) VALUES
(1, 'admin_forgotten_email', 0, '', 3, 1),
(2, 'admin_people_contact', 1, 'Customer Newsletter', 1, 1),
(3, 'admin_event_add', 1, 'Administrator Adds You to an Event', 1, 1),
(4, 'admin_event_waitlist', 1, 'Administrator Adds You to an Event Waitlist ', 1, 1),
(5, 'admin_affiliate_add_transaction', 1, 'Administrator Adds a Commission to Your Affiliate Account', 2, 1),
(6, 'admin_affiliate_approve', 0, '', 2, 1),
(7, 'admin_customer_approve', 0, '', 1, 1),
(8, 'admin_customer_add_transaction', 1, 'Administrator Adds a Store Credit to Your Customer Account', 1, 1),
(9, 'admin_customer_add_reward', 1, 'Administrator Adds Reward Points to Your Customer Account', 1, 1),
(10, 'admin_order_add_history', 1, 'Administrator Updates Your Active Orders', 1, 1),
(11, 'admin_return_add_history', 1, 'Administrator Updates Your Active Returns', 1, 1),
(12, 'admin_giftcard_order_send', 0, '', 1, 1),
(13, 'admin_giftcard_no_order_send', 0, '', 1, 1),
(14, 'public_waitlist_join', 1, 'You Join an Event Waitlist', 1, 1),
(15, 'public_customer_order_confirm', 1, 'You Place an Order', 1, 1),
(16, 'public_admin_order_confirm', 0, '', 3, 1),
(17, 'public_customer_order_update', 0, '', 1, 1),
(18, 'public_customer_forgotten', 0, '', 1, 1),
(19, 'public_affiliate_forgotten', 0, '', 2, 1),
(20, 'public_contact_admin', 0, '', 3, 1),
(21, 'public_contact_customer', 0, '', 1, 1),
(22, 'public_register_customer', 0, '', 1, 1),
(23, 'public_register_admin', 0, '', 3, 1),
(24, 'public_affiliate_register', 0, '', 2, 1),
(25, 'public_affiliate_admin', 0, '', 3, 1),
(26, 'public_giftcard_confirm', 0, '', 1, 1),
(27, 'email_wrapper', 0, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_email_content`
--

DROP TABLE IF EXISTS `ocx_email_content`;
CREATE TABLE IF NOT EXISTS `ocx_email_content` (
  `email_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `subject` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_email_content`
--

INSERT INTO `ocx_email_content` (`email_id`, `language_id`, `subject`, `text`, `html`) VALUES
(1, 1, 'Forgotten Admin Email', 'xxx', 'xxx'),
(2, 1, 'N/A', 'xxx', 'xxx'),
(3, 1, 'You''ve Been Added to an Event', 'xxx', 'xxx'),
(4, 1, 'You''ve Been Added to the Waitlist', 'xxx', 'xxx'),
(5, 1, 'You''ve Earned a Commission', 'xxx', 'xxx'),
(6, 1, 'Your Affiliate Account Has Been Approved', 'xxx', 'xxx'),
(7, 1, 'Your Customer Account Has Been Approved', 'xxx', 'xxx'),
(8, 1, 'Your Account Has Been Credited', 'xxx', 'xxx'),
(9, 1, 'You''ve Earned Reward Points', 'xxx', 'xxx'),
(10, 1, 'Your Order Has Been Updated', 'xxx', 'xxx'),
(11, 1, 'Your Return Has Been Updated', 'xxx', 'xxx'),
(12, 1, 'You''ve Received a Gift Certificate', 'xxx', 'xxx'),
(13, 1, 'You''ve Received a Gift Certificate', 'xxx', 'xxx'),
(14, 1, 'You''ve Been Added to the Waitlist', 'xxx', 'xxx'),
(15, 1, 'Your Order Details', 'xxx', 'xxx'),
(16, 1, 'An Order Has Been Placed', 'xxx', 'xxx'),
(17, 1, 'Your Order Has Been Updated', 'xxx', 'xxx'),
(18, 1, 'Customer Password Reset', 'Hi !fname!,\r\n\r\nYou, or someone claiming to be you has requested a new password for your customer account at !store_name!.\r\n\r\nYour temporary password is:\r\n\r\n!password!\r\n\r\nPlease ensure you log in and change this password to a permanent one that''s specific to you.', '\r\n\r\n\r\n\r\n&lt;p class=&quot;p1&quot;&gt;&lt;span class=&quot;s1&quot;&gt;Hi !fname!,&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;You, or someone claiming to be you has requested a new password for your customer account at !store_name!.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;Your temporary password is:&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;!password!&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;Please ensure you log in and change this password to a permanent one that''s specific to you.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p2&quot;&gt;&lt;span class=&quot;s1&quot;&gt;&lt;/span&gt;&lt;/p&gt;'),
(19, 1, 'Affiliate Password Reset', 'Hi !fname!,\r\n\r\nYou, or someone claiming to be you has requested a new password for your affiliate account at !store_name!.\r\n\r\nYour temporary password is:\r\n\r\n!password!\r\n\r\nPlease ensure you log in and change this password to a permanent one that''s specific to you.', '&lt;p class=&quot;p1&quot;&gt;&lt;span class=&quot;s1&quot;&gt;Hi !fname!,&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;You, or someone claiming to be you has requested a new password for your affiliate account at !store_name!.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;Your temporary password is:&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;!password!&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;p1&quot;&gt;&lt;span style=&quot;line-height: 1.428571429;&quot;&gt;Please ensure you log in and change this password to a permanent one that''s specific to you.&lt;/span&gt;&lt;/p&gt;'),
(20, 1, 'A Contact Request Has Been Sent', 'xxx', 'xxx'),
(21, 1, 'Your Contact Request Has Been Received', 'xxx', 'xxx'),
(22, 1, 'Your New Customer Account', 'xxx', 'xxx'),
(23, 1, 'New Customer Account Created', 'xxx', 'xxx'),
(24, 1, 'Your Affiliate Account Has Been Created', 'xxx', 'xxx'),
(25, 1, 'New Affiliate Registered', 'xxx', 'xxx'),
(26, 1, 'Your Gift Certificate', 'xxx', 'xxx'),
(27, 1, 'N/A', '===========================================\r\n!store_name!\r\n===========================================\r\n\r\n!content!\r\n\r\nThanks.\r\n\r\n!store_name! Administration\r\n\r\n==========================\r\n!store_name!\r\n!store_url!\r\n\r\n!store_address!\r\n!store_phone!\r\n-----------------------------------\r\nYou are receiving this because:\r\n1.) You''re a member of !store_name! (!store_url!) or\r\n2.) You subscribed via our website (!store_url!)\r\n\r\nWant to be removed? No problem, click here:\r\n!store_url!/contact\r\nand let us know you''d like to close your account.\r\n-----------------------------------\r\nhttp://twitter.com/TwitterHandle\r\nhttp://www.facebook.com/FacebookPage', '&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot;&gt;\r\n&lt;title&gt;\r\n&lt;/title&gt;\r\n&lt;style type=&quot;text/css&quot;&gt;\r\n .ReadMsgBody {\r\n  width: 100%;\r\n  background-color: #ffffff;\r\n  }\r\n .ExternalClass {\r\n  width: 100%;\r\n  background-color: #ffffff;\r\n  }\r\n body {\r\n  width: 100%;\r\n  background-color: #E9E8DD;\r\n  margin:0;\r\n padding:0; -webkit-font-smoothing: antialiased;\r\n font-family: Helvetica, Arial, sans-serif;\r\n  }\r\n table {\r\n border-collapse: collapse;\r\n  }\r\n .boxed {\r\n  border-collapse: separate;\r\n  -webkit-border-radius: 3px;\r\n -moz-border-radius: 3px;\r\n  border-radius: 3px;\r\n border: 1px solid #CDCBC0;\r\n  -webkit-box-shadaw: 0 1px 2px rgba(0, 0, 0, .15);\r\n -moz-box-shadaw: 0 1px 2px rgba(0, 0, 0, .15);\r\n  box-shadow: 0 1px 2px rgba(0, 0, 0, .15);\r\n }\r\n @media only screen and (max-width: 640px) {\r\n body[yahoo] .deviceWidth {\r\n  width:440px!important;\r\n  padding:0;\r\n  } \r\n  body[yahoo] .center {\r\n text-align: center!important;\r\n }  \r\n }\r\n @media only screen and (max-width: 479px) {\r\n body[yahoo] .deviceWidth {\r\n  width:280px!important;\r\n  padding:0;\r\n  } \r\n  body[yahoo] .center {\r\n text-align: center!important;\r\n }  \r\n }\r\n&lt;/style&gt;\r\n\r\n\r\n&lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; align=&quot;center&quot;&gt;\r\n &lt;tbody&gt;\r\n   &lt;tr&gt;\r\n      &lt;td width=&quot;100%&quot; valign=&quot;top&quot; bgcolor=&quot;#E9E8DD&quot; style=&quot;padding-top:20px&quot;&gt;\r\n       &lt;table width=&quot;580&quot; class=&quot;deviceWidth boxed&quot; border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; align=&quot;center&quot; bgcolor=&quot;#E9E8DD&quot;&gt;\r\n         &lt;tbody&gt;\r\n           &lt;tr&gt;\r\n              &lt;td valign=&quot;top&quot; align=&quot;center&quot; style=&quot;padding:10px&quot; bgcolor=&quot;#ffffff&quot;&gt;\r\n               &lt;a href=&quot;!store_url!&quot;&gt;\r\n                  &lt;img class=&quot;deviceWidth&quot; src=&quot;!store_url!/image/data/email/logo.png&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;display: block;&quot;&gt;\r\n               &lt;/a&gt;\r\n\r\n              &lt;/td&gt;\r\n           &lt;/tr&gt;\r\n           &lt;tr&gt;\r\n              &lt;td style=&quot;font-size: 13px; color: #212425; font-weight: normal; text-align: left; font-family: Helvetica, Arial, sans-serif; line-height: 18px; vertical-align: top; padding:10px 8px 10px 8px&quot; bgcolor=&quot;#ffffff&quot;&gt;\r\n               !content!\r\n             &lt;/td&gt;\r\n           &lt;/tr&gt;\r\n           &lt;tr&gt;\r\n              &lt;td valign=&quot;top&quot; style=&quot;padding:0;height:28px;&quot; height=&quot;28&quot; bgcolor=&quot;#ffffff&quot;&gt;\r\n              &lt;/td&gt;\r\n           &lt;/tr&gt;\r\n\r\n         &lt;/tbody&gt;\r\n        &lt;/table&gt;\r\n        &lt;div style=&quot;height:20px&quot;&gt;\r\n         &amp;nbsp;\r\n        &lt;/div&gt;\r\n        &lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; align=&quot;center&quot;&gt;\r\n          &lt;tbody&gt;\r\n           &lt;tr&gt;\r\n              &lt;td bgcolor=&quot;#363636&quot; style=&quot;padding:30px 0&quot;&gt;\r\n               &lt;table width=&quot;580&quot; border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; align=&quot;center&quot; class=&quot;deviceWidth&quot;&gt;\r\n                 &lt;tbody&gt;\r\n                   &lt;tr&gt;\r\n                      &lt;td&gt;\r\n\r\n                        &lt;table width=&quot;45%&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; border=&quot;0&quot; align=&quot;left&quot; class=&quot;deviceWidth&quot;&gt;\r\n                         &lt;tbody&gt;\r\n                           &lt;tr&gt;\r\n                              &lt;td valign=&quot;top&quot; style=&quot;font-size: 11px; color: #f1f1f1; color:#999; font-family: Arial, sans-serif; padding-bottom:20px&quot; class=&quot;center&quot;&gt;\r\n                               You are receiving this email because\r\n                                &lt;br&gt;\r\n                                1.) You''re a member of !store_name! or\r\n                               &lt;br&gt;\r\n                                2.) You subscribed via \r\n                               &lt;a href=&quot;!store_url!&quot; style=&quot;color:#999;text-decoration:underline;&quot;&gt;\r\n                                  our website\r\n                               &lt;/a&gt;\r\n                                &lt;br&gt;\r\n                                &lt;br&gt;\r\n                                &lt;br&gt;\r\n                                Want to be removed? No problem, \r\n                                &lt;a href=&quot;!store_url!/contact&quot; style=&quot;color:#999;text-decoration:underline;&quot;&gt;\r\n                                  click here\r\n                                &lt;/a&gt;\r\n                                and let us know you''d like to close your account.\r\n                              &lt;/td&gt;\r\n                           &lt;/tr&gt;\r\n                         &lt;/tbody&gt;\r\n                        &lt;/table&gt;\r\n                        &lt;table width=&quot;40%&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; border=&quot;0&quot; align=&quot;right&quot; class=&quot;deviceWidth&quot;&gt;\r\n                          &lt;tbody&gt;\r\n                           &lt;tr&gt;\r\n                              &lt;td valign=&quot;top&quot; style=&quot;font-size: 11px; color: #f1f1f1; font-weight: normal; font-family: Helvetica, Arial, sans-serif; vertical-align: top; text-align:right&quot; class=&quot;center&quot;&gt;\r\n\r\n                               &lt;a href=&quot;https://twitter.com/TwitterHandle&quot;&gt;\r\n                                  &lt;img src=&quot;!store_url!/image/data/email/footer_twitter.gif&quot; width=&quot;42&quot; height=&quot;42&quot; alt=&quot;Twitter&quot; title=&quot;Twitter&quot; border=&quot;0&quot;&gt;\r\n                               &lt;/a&gt;\r\n                                &lt;a href=&quot;http://www.facebook.com/FacebookPage&quot;&gt;\r\n                                 &lt;img src=&quot;!store_url!/image/data/email/footer_fb.gif&quot; width=&quot;42&quot; height=&quot;42&quot; alt=&quot;Facebook&quot; title=&quot;Facebook&quot; border=&quot;0&quot;&gt;\r\n                                &lt;/a&gt;\r\n                                &lt;br&gt;\r\n                                &lt;span style=&quot;color: #848484; font-weight: bold; font-size:14px&quot;&gt;\r\n                                  !store_name!\r\n                                &lt;/span&gt;\r\n                               &lt;br&gt;\r\n                                &lt;span style=&quot;color: #848484; font-weight: normal;&quot;&gt;\r\n                                 !store_address!\r\n                                 !store_phone!\r\n                               &lt;/span&gt;\r\n                               &lt;br&gt;\r\n                              &lt;/td&gt;\r\n                           &lt;/tr&gt;\r\n                         &lt;/tbody&gt;\r\n                        &lt;/table&gt;\r\n                      &lt;/td&gt;\r\n                   &lt;/tr&gt;\r\n                 &lt;/tbody&gt;\r\n                &lt;/table&gt;\r\n              &lt;/td&gt;\r\n           &lt;/tr&gt;\r\n         &lt;/tbody&gt;\r\n        &lt;/table&gt;\r\n      &lt;/td&gt;\r\n   &lt;/tr&gt;\r\n &lt;/tbody&gt;\r\n&lt;/table&gt;\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_event`
--

DROP TABLE IF EXISTS `ocx_event`;
CREATE TABLE IF NOT EXISTS `ocx_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `event` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `handlers` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`event_id`,`event`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `ocx_event`
--

INSERT INTO `ocx_event` VALUES
(34, 0, 'admin_edit_product', 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_event_manager`
--

DROP TABLE IF EXISTS `ocx_event_manager`;
CREATE TABLE IF NOT EXISTS `ocx_event_manager` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `visibility` int(3) NOT NULL DEFAULT '1',
  `event_length` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `event_days` text COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `seats` int(11) NOT NULL DEFAULT 0,
  `filled` int(11) NOT NULL DEFAULT 0,
  `presenter_tab` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `roster` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `presenter_id` int(11) NOT NULL DEFAULT 0,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `refundable` tinyint(1) NOT NULL DEFAULT 0,
  `date_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_event_wait_list`
--

DROP TABLE IF EXISTS `ocx_event_wait_list`;
CREATE TABLE IF NOT EXISTS `ocx_event_wait_list` (
  `event_wait_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`event_wait_list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_filter`
--

DROP TABLE IF EXISTS `ocx_filter`;
CREATE TABLE IF NOT EXISTS `ocx_filter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_filter_description`
--

DROP TABLE IF EXISTS `ocx_filter_description`;
CREATE TABLE IF NOT EXISTS `ocx_filter_description` (
  `filter_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `filter_group_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`filter_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_filter_group`
--

DROP TABLE IF EXISTS `ocx_filter_group`;
CREATE TABLE IF NOT EXISTS `ocx_filter_group` (
  `filter_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_filter_group_description`
--

DROP TABLE IF EXISTS `ocx_filter_group_description`;
CREATE TABLE IF NOT EXISTS `ocx_filter_group_description` (
  `filter_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`filter_group_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_geo_zone`
--

DROP TABLE IF EXISTS `ocx_geo_zone`;
CREATE TABLE IF NOT EXISTS `ocx_geo_zone` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ocx_geo_zone`
--

INSERT INTO `ocx_geo_zone` VALUES
(5, 'AZ Shipping', 'Arizona Shipping Zone', '0000-00-00 00:00:00', '2014-06-28 00:35:35'),
(6, 'AZ Sales Tax', 'Arizona Sales Tax Zone', '0000-00-00 00:00:00', '2014-06-28 00:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_hook`
--

DROP TABLE IF EXISTS `ocx_hook`;
CREATE TABLE IF NOT EXISTS `ocx_hook` (
  `hook_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `hook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `handlers` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hook_id`,`hook`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `ocx_hook`
--

INSERT INTO `ocx_hook` VALUES
(31, 0, 'admin_controller', 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_language`
--

DROP TABLE IF EXISTS `ocx_language`;
CREATE TABLE IF NOT EXISTS `ocx_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_language`
--

INSERT INTO `ocx_language` VALUES
(1, 'English', 'en', 'en_US.UTF-8,en_US,en-gb,english', 'gb.png', 'english', 'english', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_layout`
--

DROP TABLE IF EXISTS `ocx_layout`;
CREATE TABLE IF NOT EXISTS `ocx_layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ocx_layout`
--

INSERT INTO `ocx_layout` VALUES
(1, 'Default'),
(2, 'Shop Home'),
(3, 'Shop Product'),
(4, 'Shop Category'),
(5, 'Shop Manufacturer'),
(6, 'Account'),
(7, 'Checkout'),
(8, 'Contact'),
(9, 'Sitemap'),
(10, 'Affiliate'),
(11, 'Content Page'),
(12, 'Shop Search'),
(13, 'Error 404'),
(14, 'Content Home'),
(15, 'Content Category'),
(16, 'Content Post'),
(17, 'Content Search'),
(18, 'Register');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_layout_route`
--

DROP TABLE IF EXISTS `ocx_layout_route`;
CREATE TABLE IF NOT EXISTS `ocx_layout_route` (
  `layout_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`layout_route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ocx_layout_route`
--

INSERT INTO `ocx_layout_route` VALUES
(1, 2, 0, 'shop/home'),
(2, 13, 0, 'error/notfound'),
(3, 6, 0, 'account/'),
(4, 10, 0, 'affiliate/'),
(5, 7, 0, 'checkout/'),
(6, 8, 0, 'content/contact'),
(7, 15, 0, 'content/category'),
(8, 14, 0, 'content/home'),
(9, 11, 0, 'content/page'),
(10, 16, 0, 'content/post'),
(11, 17, 0, 'content/search'),
(12, 4, 0, 'catalog/category'),
(13, 5, 0, 'catalog/manufacturer'),
(14, 3, 0, 'catalog/product'),
(15, 12, 0, 'catalog/search'),
(16, 9, 0, 'content/sitemap'),
(17, 18, 0, 'account/register');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_length_class`
--

DROP TABLE IF EXISTS `ocx_length_class`;
CREATE TABLE IF NOT EXISTS `ocx_length_class` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL,
  PRIMARY KEY (`length_class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ocx_length_class`
--

INSERT INTO `ocx_length_class` VALUES
(1, '1.00000000'),
(2, '10.00000000'),
(3, '0.39370000');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_length_class_description`
--

DROP TABLE IF EXISTS `ocx_length_class_description`;
CREATE TABLE IF NOT EXISTS `ocx_length_class_description` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`length_class_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ocx_length_class_description`
--

INSERT INTO `ocx_length_class_description` VALUES
(1, 1, 'Centimeter', 'cm'),
(2, 1, 'Millimeter', 'mm'),
(3, 1, 'Inch', 'in');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_manufacturer`
--

DROP TABLE IF EXISTS `ocx_manufacturer`;
CREATE TABLE IF NOT EXISTS `ocx_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ocx_manufacturer`
--

INSERT INTO `ocx_manufacturer` VALUES
(5, 'HTC', 'data/demo/htc_logo.jpg', 0),
(6, 'Palm', 'data/demo/palm_logo.jpg', 0),
(7, 'Hewlett-Packard', 'data/demo/hp_logo.jpg', 0),
(8, 'Apple', 'data/demo/apple_logo.jpg', 0),
(9, 'Canon', 'data/demo/canon_logo.jpg', 0),
(10, 'Sony', 'data/demo/sony_logo.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_manufacturer_to_store`
--

DROP TABLE IF EXISTS `ocx_manufacturer_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_manufacturer_to_store` (
  `manufacturer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_manufacturer_to_store`
--

INSERT INTO `ocx_manufacturer_to_store` VALUES
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_menu`
--

DROP TABLE IF EXISTS `ocx_menu`;
CREATE TABLE IF NOT EXISTS `ocx_menu` (
  `menu_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`menu_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ocx_menu`
--

INSERT INTO `ocx_menu` VALUES
(3, 'Blog Header Menu', 'content_category', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 1),
(4, 'Blog Header Pages', 'page', 'a:6:{i:0;s:1:"4";i:1;s:1:"8";i:2;s:1:"6";i:3;s:1:"3";i:4;s:1:"7";i:5;s:1:"5";}', 1),
(5, 'Info', 'page', 'a:4:{i:0;s:1:"4";i:1;s:1:"6";i:2;s:1:"3";i:3;s:1:"5";}', 1),
(7, 'Customer Service', 'custom', 'a:3:{i:0;a:2:{s:4:"href";s:15:"content/contact";s:4:"name";s:10:"Contact Us";}i:1;a:2:{s:4:"href";s:22:"account/returns/insert";s:4:"name";s:7:"Returns";}i:2;a:2:{s:4:"href";s:15:"content/sitemap";s:4:"name";s:7:"Sitemap";}}', 1),
(8, 'Extras', 'custom', 'a:4:{i:0;a:2:{s:4:"href";s:20:"catalog/manufacturer";s:4:"name";s:6:"Brands";}i:1;a:2:{s:4:"href";s:15:"account/voucher";s:4:"name";s:17:"Gift Certificates";}i:2;a:2:{s:4:"href";s:17:"affiliate/account";s:4:"name";s:10:"Affiliates";}i:3;a:2:{s:4:"href";s:15:"catalog/special";s:4:"name";s:8:"Specials";}}', 1),
(10, 'Posts', 'post', 'a:1:{i:0;s:1:"1";}', 1),
(13, 'Account', 'custom', 'a:4:{i:0;a:2:{s:4:"href";s:17:"account/dashboard";s:4:"name";s:9:"Dashboard";}i:1;a:2:{s:4:"href";s:13:"account/order";s:4:"name";s:13:"Order History";}i:2;a:2:{s:4:"href";s:16:"account/wishlist";s:4:"name";s:8:"Wishlist";}i:3;a:2:{s:4:"href";s:18:"account/newsletter";s:4:"name";s:10:"Newsletter";}}', 1),
(14, 'Blog Categories', 'content_category', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 1),
(15, 'Product Categories', 'product_category', 'a:37:{i:0;s:2:"33";i:1;s:2:"25";i:2;s:2:"29";i:3;s:2:"28";i:4;s:2:"35";i:5;s:2:"36";i:6;s:2:"30";i:7;s:2:"31";i:8;s:2:"32";i:9;s:2:"20";i:10;s:2:"27";i:11;s:2:"26";i:12;s:2:"18";i:13;s:2:"46";i:14;s:2:"45";i:15;s:2:"34";i:16;s:2:"43";i:17;s:2:"44";i:18;s:2:"47";i:19;s:2:"48";i:20;s:2:"49";i:21;s:2:"50";i:22;s:2:"51";i:23;s:2:"52";i:24;s:2:"58";i:25;s:2:"53";i:26;s:2:"54";i:27;s:2:"55";i:28;s:2:"56";i:29;s:2:"38";i:30;s:2:"37";i:31;s:2:"39";i:32;s:2:"40";i:33;s:2:"41";i:34;s:2:"42";i:35;s:2:"24";i:36;s:2:"57";}', 1),
(16, 'Our Friends', 'custom', 'a:4:{i:0;a:2:{s:4:"href";s:21:"http://www.google.com";s:4:"name";s:6:"Google";}i:1;a:2:{s:4:"href";s:23:"http://www.facebook.com";s:4:"name";s:8:"Facebook";}i:2;a:2:{s:4:"href";s:18:"http://twitter.com";s:4:"name";s:7:"Twitter";}i:3;a:2:{s:4:"href";s:20:"http://instagram.com";s:4:"name";s:9:"Instagram";}}', 1),
(17, 'Shop Header', 'product_category', 'a:37:{i:0;s:2:"33";i:1;s:2:"25";i:2;s:2:"29";i:3;s:2:"28";i:4;s:2:"35";i:5;s:2:"36";i:6;s:2:"30";i:7;s:2:"31";i:8;s:2:"32";i:9;s:2:"20";i:10;s:2:"27";i:11;s:2:"26";i:12;s:2:"18";i:13;s:2:"46";i:14;s:2:"45";i:15;s:2:"34";i:16;s:2:"43";i:17;s:2:"44";i:18;s:2:"47";i:19;s:2:"48";i:20;s:2:"49";i:21;s:2:"50";i:22;s:2:"51";i:23;s:2:"52";i:24;s:2:"58";i:25;s:2:"53";i:26;s:2:"54";i:27;s:2:"55";i:28;s:2:"56";i:29;s:2:"38";i:30;s:2:"37";i:31;s:2:"39";i:32;s:2:"40";i:33;s:2:"41";i:34;s:2:"42";i:35;s:2:"24";i:36;s:2:"57";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_module`
--

DROP TABLE IF EXISTS `ocx_module`;
CREATE TABLE IF NOT EXISTS `ocx_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=531 ;

--
-- Dumping data for table `ocx_module`
--

INSERT INTO `ocx_module` VALUES
(22, 'total', 'shipping'),
(23, 'payment', 'cod'),
(58, 'total', 'tax'),
(59, 'total', 'total'),
(387, 'shipping', 'flat'),
(390, 'total', 'credit'),
(393, 'total', 'reward'),
(398, 'total', 'giftcard'),
(408, 'widget', 'account'),
(410, 'widget', 'banner'),
(411, 'widget', 'affiliate'),
(413, 'widget', 'category'),
(419, 'widget', 'slideshow'),
(426, 'widget', 'carousel'),
(427, 'widget', 'featured'),
(429, 'widget', 'masonry'),
(430, 'widget', 'page'),
(436, 'total', 'subtotal'),
(438, 'total', 'coupon'),
(522, 'widget', 'postwall'),
(523, 'widget', 'blogsearch'),
(524, 'widget', 'blogcategory'),
(525, 'widget', 'blogfeatured'),
(526, 'widget', 'bloghottopics'),
(527, 'widget', 'bloglatest'),
(528, 'widget', 'sidebarmenu'),
(529, 'widget', 'headermenu'),
(530, 'widget', 'footerblocks');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_notification_queue`
--

DROP TABLE IF EXISTS `ocx_notification_queue`;
CREATE TABLE IF NOT EXISTS `ocx_notification_queue` (
  `queue_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(66) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`queue_id`,`email`,`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_option`
--

DROP TABLE IF EXISTS `ocx_option`;
CREATE TABLE IF NOT EXISTS `ocx_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ocx_option`
--

INSERT INTO `ocx_option` VALUES
(1, 'radio', 2),
(2, 'checkbox', 3),
(4, 'text', 4),
(5, 'select', 1),
(6, 'textarea', 5),
(7, 'file', 6),
(8, 'date', 7),
(9, 'time', 8),
(10, 'datetime', 9),
(11, 'select', 1),
(12, 'date', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_option_description`
--

DROP TABLE IF EXISTS `ocx_option_description`;
CREATE TABLE IF NOT EXISTS `ocx_option_description` (
  `option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`option_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_option_description`
--

INSERT INTO `ocx_option_description` VALUES
(1, 1, 'Radio'),
(2, 1, 'Checkbox'),
(4, 1, 'Text'),
(5, 1, 'Select'),
(6, 1, 'Textarea'),
(7, 1, 'File'),
(8, 1, 'Date'),
(9, 1, 'Time'),
(10, 1, 'Date &amp; Time'),
(11, 1, 'Size'),
(12, 1, 'Delivery Date');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_option_value`
--

DROP TABLE IF EXISTS `ocx_option_value`;
CREATE TABLE IF NOT EXISTS `ocx_option_value` (
  `option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `ocx_option_value`
--

INSERT INTO `ocx_option_value` VALUES
(23, 2, '', 1),
(24, 2, '', 2),
(31, 1, '', 2),
(32, 1, '', 1),
(39, 5, '', 1),
(40, 5, '', 2),
(41, 5, '', 3),
(42, 5, '', 4),
(43, 1, '', 3),
(44, 2, '', 3),
(45, 2, '', 4),
(46, 11, '', 1),
(47, 11, '', 2),
(48, 11, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_option_value_description`
--

DROP TABLE IF EXISTS `ocx_option_value_description`;
CREATE TABLE IF NOT EXISTS `ocx_option_value_description` (
  `option_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`option_value_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_option_value_description`
--

INSERT INTO `ocx_option_value_description` VALUES
(23, 1, 2, 'Checkbox 1'),
(24, 1, 2, 'Checkbox 2'),
(31, 1, 1, 'Medium'),
(32, 1, 1, 'Small'),
(39, 1, 5, 'Red'),
(40, 1, 5, 'Blue'),
(41, 1, 5, 'Green'),
(42, 1, 5, 'Yellow'),
(43, 1, 1, 'Large'),
(44, 1, 2, 'Checkbox 3'),
(45, 1, 2, 'Checkbox 4'),
(46, 1, 11, 'Small'),
(47, 1, 11, 'Medium'),
(48, 1, 11, 'Large');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order`
--

DROP TABLE IF EXISTS `ocx_order`;
CREATE TABLE IF NOT EXISTS `ocx_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `invoice_prefix` varchar(26) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `store_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_company_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_tax_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `payment_address_1` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_address_2` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_city` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `payment_country` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_zone_id` int(11) NOT NULL,
  `payment_address_format` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `payment_code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address_1` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address_2` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_city` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_country` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_zone_id` int(11) NOT NULL,
  `shipping_address_format` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_method` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `order_status_id` int(11) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `commission` decimal(15,4) NOT NULL,
  `language_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `currency_value` decimal(15,8) NOT NULL DEFAULT '1.00000000',
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `forwarded_ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accept_language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_download`
--

DROP TABLE IF EXISTS `ocx_order_download`;
CREATE TABLE IF NOT EXISTS `ocx_order_download` (
  `order_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mask` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `remaining` int(3) NOT NULL,
  PRIMARY KEY (`order_download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_field`
--

DROP TABLE IF EXISTS `ocx_order_field`;
CREATE TABLE IF NOT EXISTS `ocx_order_field` (
  `order_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `custom_field_value_id` int(11) NOT NULL,
  `name` int(128) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`order_id`,`custom_field_id`,`custom_field_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_fraud`
--

DROP TABLE IF EXISTS `ocx_order_fraud`;
CREATE TABLE IF NOT EXISTS `ocx_order_fraud` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `country_match` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `high_risk_country` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `distance` int(11) NOT NULL,
  `ip_region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_latitude` decimal(10,6) NOT NULL,
  `ip_longitude` decimal(10,6) NOT NULL,
  `ip_isp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_asnum` int(11) NOT NULL,
  `ip_user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_country_confidence` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ip_region_confidence` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ip_city_confidence` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ip_postal_confidence` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ip_postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ip_accuracy_radius` int(11) NOT NULL,
  `ip_net_speed_cell` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_metro_code` int(3) NOT NULL,
  `ip_area_code` int(3) NOT NULL,
  `ip_time_zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_region_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_continent_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ip_corporate_proxy` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `anonymous_proxy` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `proxy_score` int(3) NOT NULL,
  `is_trans_proxy` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `free_mail` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `carder_email` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `high_risk_username` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `high_risk_password` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `bin_match` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bin_country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `bin_name_match` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `bin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bin_phone_match` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `bin_phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone_in_billing_location` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ship_forward` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `city_postal_match` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ship_city_postal_match` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `score` decimal(10,5) NOT NULL,
  `explanation` text COLLATE utf8_unicode_ci NOT NULL,
  `risk_score` decimal(10,5) NOT NULL,
  `queries_remaining` int(11) NOT NULL,
  `maxmind_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `error` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_history`
--

DROP TABLE IF EXISTS `ocx_order_history`;
CREATE TABLE IF NOT EXISTS `ocx_order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(5) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_option`
--

DROP TABLE IF EXISTS `ocx_order_option`;
CREATE TABLE IF NOT EXISTS `ocx_order_option` (
  `order_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_product`
--

DROP TABLE IF EXISTS `ocx_order_product`;
CREATE TABLE IF NOT EXISTS `ocx_order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `reward` int(8) NOT NULL,
  PRIMARY KEY (`order_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_recurring`
--

DROP TABLE IF EXISTS `ocx_order_recurring`;
CREATE TABLE IF NOT EXISTS `ocx_order_recurring` (
  `order_recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `profile_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recurring_frequency` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `recurring_cycle` smallint(6) NOT NULL,
  `recurring_duration` smallint(6) NOT NULL,
  `recurring_price` decimal(10,4) NOT NULL,
  `trial` tinyint(1) NOT NULL,
  `trial_frequency` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `trial_cycle` smallint(6) NOT NULL,
  `trial_duration` smallint(6) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `profile_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_recurring_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_recurring_transaction`
--

DROP TABLE IF EXISTS `ocx_order_recurring_transaction`;
CREATE TABLE IF NOT EXISTS `ocx_order_recurring_transaction` (
  `order_recurring_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_recurring_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_recurring_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_status`
--

DROP TABLE IF EXISTS `ocx_order_status`;
CREATE TABLE IF NOT EXISTS `ocx_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_status_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ocx_order_status`
--

INSERT INTO `ocx_order_status` VALUES
(1, 1, 'Pending'),
(2, 1, 'Processing'),
(3, 1, 'Shipped'),
(5, 1, 'Complete'),
(7, 1, 'Canceled'),
(8, 1, 'Denied'),
(9, 1, 'Canceled Reversal'),
(10, 1, 'Failed'),
(11, 1, 'Refunded'),
(12, 1, 'Reversed'),
(13, 1, 'Chargeback'),
(14, 1, 'Expired'),
(15, 1, 'Processed'),
(16, 1, 'Voided');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_total`
--

DROP TABLE IF EXISTS `ocx_order_total`;
CREATE TABLE IF NOT EXISTS `ocx_order_total` (
  `order_total_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`order_total_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_order_giftcard`
--

DROP TABLE IF EXISTS `ocx_order_giftcard`;
CREATE TABLE IF NOT EXISTS `ocx_order_giftcard` (
  `order_giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `giftcard_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `to_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `to_email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `giftcard_theme_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  PRIMARY KEY (`order_giftcard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_page`
--

DROP TABLE IF EXISTS `ocx_page`;
CREATE TABLE IF NOT EXISTS `ocx_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `bottom` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `visibility` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ocx_page`
--

INSERT INTO `ocx_page` VALUES
(3, 1, 3, 1, 1),
(4, 1, 1, 1, 1),
(5, 1, 4, 1, 1),
(6, 1, 2, 1, 1),
(7, 0, 0, 1, 1),
(8, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_page_description`
--

DROP TABLE IF EXISTS `ocx_page_description`;
CREATE TABLE IF NOT EXISTS `ocx_page_description` (
  `page_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`page_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_page_description`
--

INSERT INTO `ocx_page_description` VALUES
(3, 1, 'Privacy Policy', '&lt;p&gt;Privacy Policy&lt;/p&gt;\r\n', '', ''),
(4, 1, 'About Us', '&lt;p&gt;\r\n  \r\n    About Us\r\n  \r\n&lt;/p&gt;', '', ''),
(5, 1, 'Terms &amp; Conditions', '&lt;p&gt;Terms &amp;amp; Conditions&lt;/p&gt;\r\n', '', ''),
(6, 1, 'Delivery Information', '&lt;p&gt;Delivery Information&lt;/p&gt;\r\n', '', ''),
(7, 1, 'Return Policy', '&lt;p&gt;Your return policy here.&lt;/p&gt;\r\n', '', ''),
(8, 1, 'Affiliate Terms', '&lt;p&gt;Affiliate terms go here.&lt;/p&gt;\r\n', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_page_to_layout`
--

DROP TABLE IF EXISTS `ocx_page_to_layout`;
CREATE TABLE IF NOT EXISTS `ocx_page_to_layout` (
  `page_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_page_to_store`
--

DROP TABLE IF EXISTS `ocx_page_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_page_to_store` (
  `page_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_page_to_store`
--

INSERT INTO `ocx_page_to_store` VALUES
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_poll`
--

DROP TABLE IF EXISTS `ocx_poll`;
CREATE TABLE IF NOT EXISTS `ocx_poll` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1',
  `total` int(13) NOT NULL DEFAULT '0',
  `image` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`poll_id`),
  KEY `total` (`total`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_poll_answer`
--

DROP TABLE IF EXISTS `ocx_poll_answer`;
CREATE TABLE IF NOT EXISTS `ocx_poll_answer` (
  `answer_id` int(13) NOT NULL AUTO_INCREMENT,
  `poll_id` int(13) NOT NULL DEFAULT '0',
  `votes` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_poll_answer_description`
--

DROP TABLE IF EXISTS `ocx_poll_answer_description`;
CREATE TABLE IF NOT EXISTS `ocx_poll_answer_description` (
  `description_id` int(13) NOT NULL AUTO_INCREMENT,
  `answer_id` int(13) NOT NULL,
  `language_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`description_id`),
  KEY `answer_id` (`answer_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_poll_question`
--

DROP TABLE IF EXISTS `ocx_poll_question`;
CREATE TABLE IF NOT EXISTS `ocx_poll_question` (
  `question_id` int(13) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `poll_id` int(13) NOT NULL,
  `question` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_poll_voted`
--

DROP TABLE IF EXISTS `ocx_poll_voted`;
CREATE TABLE IF NOT EXISTS `ocx_poll_voted` (
  `voted_id` int(13) NOT NULL AUTO_INCREMENT,
  `poll_id` int(13) NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`voted_id`),
  KEY `poll_id` (`poll_id`,`hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_presenter`
--

DROP TABLE IF EXISTS `ocx_presenter`;
CREATE TABLE IF NOT EXISTS `ocx_presenter` (
  `presenter_id` int(11) NOT NULL AUTO_INCREMENT,
  `presenter_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bio` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`presenter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product`
--

DROP TABLE IF EXISTS `ocx_product`;
CREATE TABLE IF NOT EXISTS `ocx_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `model` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `upc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `ean` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `jan` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `mpn` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `visibility` int(3) NOT NULL DEFAULT '1',
  `quantity` int(4) NOT NULL,
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `shipping` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `points` int(8) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `weight` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `weight_class_id` int(11) NOT NULL,
  `length` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `width` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `height` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `length_class_id` int(11) NOT NULL,
  `subtract` tinyint(1) NOT NULL DEFAULT '1',
  `minimum` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewed` int(5) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `ocx_product`
--

INSERT INTO `ocx_product` VALUES
(28, 0, 'Product 1', '', '', '', '', '', '', '', 1, 939, 7, 'data/demo/htc_touch_hd_1.jpg', 5, 1, '100.0000', 200, 9, '2009-02-03', '0000-00-00 00:00:00', '146.40000000', 2, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, '2009-02-03 16:06:50', '2014-08-17 00:05:03', 0, 0),
(29, 0, 'Product 2', '', '', '', '', '', '', '', 1, 999, 6, 'data/demo/palm_treo_pro_1.jpg', 6, 1, '279.9900', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '133.00000000', 2, '0.00000000', '0.00000000', '0.00000000', 3, 1, 1, 0, 1, '2009-02-03 16:42:17', '2014-07-06 22:42:53', 0, 0),
(30, 0, 'Product 3', '', '', '', '', '', '', '', 1, 7, 6, 'data/demo/canon_eos_5d_1.jpg', 9, 1, '100.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, '2009-02-03 16:59:00', '2014-09-28 23:59:28', 0, 0),
(31, 0, 'Product 4', '', '', '', '', '', '', '', 1, 1000, 6, 'data/demo/nikon_d300_1.jpg', 0, 1, '80.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 3, 1, 1, 0, 1, '2009-02-03 17:00:10', '2014-07-06 22:42:45', 0, 0),
(32, 0, 'Product 5', '', '', '', '', '', '', '', 1, 999, 6, 'data/demo/ipod_touch_1.jpg', 8, 1, '100.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, '2009-02-03 17:07:26', '2014-07-06 22:41:48', 0, 0),
(33, 0, 'Product 6', '', '', '', '', '', '', '', 1, 1000, 6, 'data/demo/samsung_syncmaster_941bw.jpg', 0, 1, '200.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 17:08:31', '2014-07-06 22:43:42', 0, 0),
(34, 0, 'Product 7', '', '', '', '', '', '', '', 1, 1000, 6, 'data/demo/ipod_shuffle_1.jpg', 8, 1, '100.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 18:07:54', '2014-07-06 22:41:19', 0, 0),
(36, 0, 'Product 9', '', '', '', '', '', '', '', 1, 994, 6, 'data/demo/ipod_nano_1.jpg', 8, 0, '100.0000', 100, 9, '2009-02-03', '0000-00-00 00:00:00', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 18:09:19', '2014-07-06 22:41:02', 0, 0),
(40, 0, 'product 11', '', '', '', '', '', '', '', 1, 970, 5, 'data/demo/iphone_1.jpg', 8, 1, '101.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '10.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, '2009-02-03 21:07:12', '2014-07-06 22:39:10', 0, 0),
(41, 0, 'Product 14', '', '', '', '', '', '', '', 1, 977, 5, 'data/demo/imac_1.jpg', 8, 1, '100.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, '2009-02-03 21:07:26', '2014-07-06 22:33:49', 0, 0),
(42, 0, 'Product 15', '', '', '', '', '', '', '', 1, 990, 5, 'data/demo/apple_cinema_30.jpg', 8, 1, '100.0000', 400, 9, '2009-02-04', '0000-00-00 00:00:00', '12.50000000', 1, '1.00000000', '2.00000000', '3.00000000', 1, 1, 2, 0, 1, '2009-02-03 21:07:37', '2014-09-29 00:02:18', 0, 0),
(43, 0, 'Product 16', '', '', '', '', '', '', '', 1, 929, 5, 'data/demo/macbook_1.jpg', 8, 0, '500.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 21:07:49', '2014-07-06 22:42:11', 0, 0),
(44, 0, 'Product 17', '', '', '', '', '', '', '', 1, 1000, 5, 'data/demo/macbook_air_1.jpg', 8, 1, '1000.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 21:08:00', '2014-07-06 21:38:48', 0, 0),
(45, 0, 'Product 18', '', '', '', '', '', '', '', 1, 998, 5, 'data/demo/macbook_pro_1.jpg', 8, 1, '2000.0000', 0, 0, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 21:08:17', '2014-07-06 22:42:36', 0, 0),
(46, 0, 'Product 19', '', '', '', '', '', '', '', 1, 1000, 5, 'data/demo/sony_vaio_1.jpg', 10, 1, '1000.0000', 0, 9, '2009-02-03', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-03 21:08:29', '2014-07-06 22:43:58', 0, 0),
(47, 0, 'Product 21', '', '', '', '', '', '', '', 1, 1000, 5, 'data/demo/hp_1.jpg', 7, 1, '100.0000', 400, 9, '2009-02-03', '0000-00-00 00:00:00', '1.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 0, 1, 0, 1, '2009-02-03 21:08:40', '2014-07-06 22:30:26', 0, 0),
(48, 0, 'product 20', 'test 1', '', '', '', '', '', 'test 2', 1, 995, 5, 'data/demo/ipod_classic_1.jpg', 8, 1, '100.0000', 0, 9, '2009-02-08', '0000-00-00 00:00:00', '1.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, '2009-02-08 17:21:51', '2014-07-06 22:40:44', 0, 0),
(49, 0, 'SAM1', '', '', '', '', '', '', '', 1, 0, 8, 'data/demo/samsung_tab_1.jpg', 0, 1, '199.9900', 0, 9, '2011-04-25', '0000-00-00 00:00:00', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 1, 1, '2011-04-26 08:57:34', '2014-07-06 22:43:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_attribute`
--

DROP TABLE IF EXISTS `ocx_product_attribute`;
CREATE TABLE IF NOT EXISTS `ocx_product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`,`attribute_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_product_attribute`
--

INSERT INTO `ocx_product_attribute` VALUES
(42, 3, 1, '100mhz'),
(43, 2, 1, '1'),
(43, 4, 1, '8gb'),
(47, 2, 1, '4'),
(47, 4, 1, '16GB');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_description`
--

DROP TABLE IF EXISTS `ocx_product_description`;
CREATE TABLE IF NOT EXISTS `ocx_product_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_product_description`
--

INSERT INTO `ocx_product_description` VALUES
(28, 1, 'HTC Touch HD', '&lt;p&gt;HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8&quot; WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Processor Qualcomm® MSM 7201A™ 528 MHz&lt;/li&gt;\r\n	&lt;li&gt;Windows Mobile® 6.1 Professional Operating System&lt;/li&gt;\r\n	&lt;li&gt;Memory: 512 MB ROM, 288 MB RAM&lt;/li&gt;\r\n	&lt;li&gt;Dimensions: 115 mm x 62.8 mm x 12 mm / 146.4 grams&lt;/li&gt;\r\n	&lt;li&gt;3.8-inch TFT-LCD flat touch-sensitive screen with 480 x 800 WVGA resolution&lt;/li&gt;\r\n	&lt;li&gt;HSDPA/WCDMA: Europe/Asia: 900/2100 MHz; Up to 2 Mbps up-link and 7.2 Mbps down-link speeds&lt;/li&gt;\r\n	&lt;li&gt;Quad-band GSM/GPRS/EDGE: Europe/Asia: 850/900/1800/1900 MHz (Band frequency, HSUPA availability, and data speed are operator dependent.)&lt;/li&gt;\r\n	&lt;li&gt;Device Control via HTC TouchFLO™ 3D &amp; Touch-sensitive front panel buttons&lt;/li&gt;\r\n	&lt;li&gt;GPS and A-GPS ready&lt;/li&gt;\r\n	&lt;li&gt;Bluetooth® 2.0 with Enhanced Data Rate and A2DP for wireless stereo headsets&lt;/li&gt;\r\n	&lt;li&gt;Wi-Fi®: IEEE 802.11 b/g&lt;/li&gt;\r\n	&lt;li&gt;HTC ExtUSB™ (11-pin mini-USB 2.0)&lt;/li&gt;\r\n	&lt;li&gt;5 megapixel color camera with auto focus&lt;/li&gt;\r\n	&lt;li&gt;VGA CMOS color camera&lt;/li&gt;\r\n	&lt;li&gt;Built-in 3.5 mm audio jack, microphone, speaker, and FM radio&lt;/li&gt;\r\n	&lt;li&gt;Ring tone formats: AAC, AAC+, eAAC+, AMR-NB, AMR-WB, QCP, MP3, WMA, WAV&lt;/li&gt;\r\n	&lt;li&gt;40 polyphonic and standard MIDI format 0 and 1 (SMF)/SP MIDI&lt;/li&gt;\r\n	&lt;li&gt;Rechargeable Lithium-ion or Lithium-ion polymer 1350 mAh battery&lt;/li&gt;\r\n	&lt;li&gt;Expansion Slot: microSD™ memory card (SD 2.0 compatible)&lt;/li&gt;\r\n	&lt;li&gt;AC Adapter Voltage range/frequency: 100 ~ 240V AC, 50/60 Hz DC output: 5V and 1A&lt;/li&gt;\r\n	&lt;li&gt;Special Features: FM Radio, G-Sensor&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '', '', ''),
(29, 1, 'Palm Treo Pro', '&lt;p&gt;Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to business and personal email, stay on top of appointments and contacts, and use Wi-Fi or GPS when you’re out and about. Then watch a video on YouTube, catch up with news and sports on the web, or listen to a few songs. Balance your work and play the way you like it, with the Palm Treo Pro.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Windows Mobile® 6.1 Professional Edition&lt;/li&gt;\r\n	&lt;li&gt;Qualcomm® MSM7201 400MHz Processor&lt;/li&gt;\r\n	&lt;li&gt;320x320 transflective colour TFT touchscreen&lt;/li&gt;\r\n	&lt;li&gt;HSDPA/UMTS/EDGE/GPRS/GSM radio&lt;/li&gt;\r\n	&lt;li&gt;Tri-band UMTS — 850MHz, 1900MHz, 2100MHz&lt;/li&gt;\r\n	&lt;li&gt;Quad-band GSM — 850/900/1800/1900&lt;/li&gt;\r\n	&lt;li&gt;802.11b/g with WPA, WPA2, and 801.1x authentication&lt;/li&gt;\r\n	&lt;li&gt;Built-in GPS&lt;/li&gt;\r\n	&lt;li&gt;Bluetooth Version: 2.0 + Enhanced Data Rate&lt;/li&gt;\r\n	&lt;li&gt;256MB storage (100MB user available), 128MB RAM&lt;/li&gt;\r\n	&lt;li&gt;2.0 megapixel camera, up to 8x digital zoom and video capture&lt;/li&gt;\r\n	&lt;li&gt;Removable, rechargeable 1500mAh lithium-ion battery&lt;/li&gt;\r\n	&lt;li&gt;Up to 5.0 hours talk time and up to 250 hours standby&lt;/li&gt;\r\n	&lt;li&gt;MicroSDHC card expansion (up to 32GB supported)&lt;/li&gt;\r\n	&lt;li&gt;MicroUSB 2.0 for synchronization and charging&lt;/li&gt;\r\n	&lt;li&gt;3.5mm stereo headset jack&lt;/li&gt;\r\n	&lt;li&gt;60mm (W) x 114mm (L) x 13.5mm (D) / 133g&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '', '', ''),
(30, 1, 'Canon EOS 5D', '&lt;p&gt;Canon''s press material for the EOS 5D states that it ''defines (a) new D-SLR category'', while we''re not typically too concerned with marketing talk this particular statement is clearly pretty accurate. The EOS 5D is unlike any previous digital SLR in that it combines a full-frame (35 mm sized) high resolution sensor (12.8 megapixels) with a relatively compact body (slightly larger than the EOS 20D, although in your hand it feels noticeably ''chunkier''). The EOS 5D is aimed to slot in between the EOS 20D and the EOS-1D professional digital SLR''s, an important difference when compared to the latter is that the EOS 5D doesn''t have any environmental seals. While Canon don''t specifically refer to the EOS 5D as a ''professional'' digital SLR it will have obvious appeal to professionals who want a high quality digital SLR in a body lighter than the EOS-1D. It will also no doubt appeal to current EOS 20D owners (although lets hope they''ve not bought too many EF-S lenses...) äë&lt;/p&gt;\r\n', '', '', ''),
(31, 1, 'Nikon D300', '&lt;p&gt;Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines brand new technologies with advanced features inherited from Nikon''s newly announced D3 professional digital SLR camera to offer serious photographers remarkable performance combined with agility.&lt;br /&gt;\r\n&lt;br /&gt;\r\nSimilar to the D3, the D300 features Nikon''s exclusive EXPEED Image Processing System that is central to driving the speed and processing power needed for many of the camera''s new features. The D300 features a new 51-point autofocus system with Nikon''s 3D Focus Tracking feature and two new LiveView shooting modes that allow users to frame a photograph using the camera''s high-resolution LCD monitor. The D300 shares a similar Scene Recognition System as is found in the D3; it promises to greatly enhance the accuracy of autofocus, autoexposure, and auto white balance by recognizing the subject or scene being photographed and applying this information to the calculations for the three functions.&lt;br /&gt;\r\n&lt;br /&gt;\r\nThe D300 reacts with lightning speed, powering up in a mere 0.13 seconds and shooting with an imperceptible 45-millisecond shutter release lag time. The D300 is capable of shooting at a rapid six frames per second and can go as fast as eight frames per second when using the optional MB-D10 multi-power battery pack. In continuous bursts, the D300 can shoot up to 100 shots at full 12.3-megapixel resolution. (NORMAL-LARGE image setting, using a SanDisk Extreme IV 1GB CompactFlash card.)&lt;br /&gt;\r\n&lt;br /&gt;\r\nThe D300 incorporates a range of innovative technologies and features that will significantly improve the accuracy, control, and performance photographers can get from their equipment. Its new Scene Recognition System advances the use of Nikon''s acclaimed 1,005-segment sensor to recognize colors and light patterns that help the camera determine the subject and the type of scene being photographed before a picture is taken. This information is used to improve the accuracy of autofocus, autoexposure, and auto white balance functions in the D300. For example, the camera can track moving subjects better and by identifying them, it can also automatically select focus points faster and with greater accuracy. It can also analyze highlights and more accurately determine exposure, as well as infer light sources to deliver more accurate white balance detection.&lt;/p&gt;\r\n&lt;!-- cpt_container_end --&gt;', '', '', ''),
(32, 1, 'iPod Touch', '&lt;p&gt;&lt;strong&gt;Revolutionary multi-touch interface.&lt;/strong&gt;&lt;br /&gt;\r\niPod touch features the same multi-touch screen technology as iPhone. Pinch to zoom in on a photo. Scroll through your songs and videos with a flick. Flip through your library by album artwork with Cover Flow.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Gorgeous 3.5-inch widescreen display.&lt;/strong&gt;&lt;br /&gt;\r\nWatch your movies, TV shows, and photos come alive with bright, vivid color on the 320-by-480-pixel display.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Music downloads straight from iTunes.&lt;/strong&gt;&lt;br /&gt;\r\nShop the iTunes Wi-Fi Music Store from anywhere with Wi-Fi.1 Browse or search to find the music youre looking for, preview it, and buy it with just a tap.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Surf the web with Wi-Fi.&lt;/strong&gt;&lt;br /&gt;\r\nBrowse the web using Safari and watch YouTube videos on the first iPod with Wi-Fi built in&lt;br /&gt;\r\n &lt;/p&gt;\r\n', '', '', ''),
(33, 1, 'Samsung SyncMaster 941BW', '&lt;p&gt;Imagine the advantages of going big without slowing down. The big 19&quot; 941BW monitor combines wide aspect ratio with fast pixel response time, for bigger images, more room to work and crisp motion. In addition, the exclusive MagicBright 2, MagicColor and MagicTune technologies help deliver the ideal image in every situation, while sleek, narrow bezels and adjustable stands deliver style just the way you want it. With the Samsung 941BW widescreen analog/digital LCD monitor, it''s not hard to imagine.&lt;/p&gt;\r\n', '', '', ''),
(34, 1, 'iPod Shuffle', '&lt;p&gt;&lt;strong&gt;Born to be worn.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Clip on the worlds most wearable music player and take up to 240 songs with you anywhere. Choose from five colors including four new hues to make your musical fashion statement.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Random meets rhythm.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;With iTunes autofill, iPod shuffle can deliver a new musical experience every time you sync. For more randomness, you can shuffle songs during playback with the slide of a switch.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Everything is easy.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Charge and sync with the included USB dock. Operate the iPod shuffle controls with one hand. Enjoy up to 12 hours straight of skip-free music playback.&lt;/p&gt;\r\n', '', '', ''),
(36, 1, 'iPod Nano', '&lt;p&gt;&lt;strong&gt;Video in your pocket.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Its the small iPod with one very big idea: video. The worlds most popular music player now lets you enjoy movies, TV shows, and more on a two-inch display thats 65% brighter than before.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Experience a whole new way to browse and view your music and video.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleek and colorful.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;With an anodized aluminum and polished stainless steel enclosure and a choice of five colors, iPod nano is dressed to impress.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;iTunes.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Available as a free download, iTunes makes it easy to browse and buy millions of songs, movies, TV shows, audiobooks, and games and download free podcasts all at the iTunes Store. And you can import your own music, manage your whole media library, and sync your iPod or iPhone with ease.&lt;/p&gt;\r\n', '', '', ''),
(40, 1, 'iPhone', '&lt;p&gt;iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a name or number in your address book, a favorites list, or a call log. It also automatically syncs all your contacts from a PC, Mac, or Internet service. And it lets you select and listen to voicemail messages in whatever order you want just like email.&lt;/p&gt;\r\n', '', '', ''),
(41, 1, 'iMac', '&lt;p&gt;Just when you thought iMac had everything, now there´s even more. More powerful Intel Core 2 Duo processors. And more memory standard. Combine this with Mac OS X Leopard and iLife ´08, and it´s more all-in-one than ever. iMac packs amazing performance into a stunningly slim space.&lt;/p&gt;\r\n', '', '', ''),
(42, 1, 'Apple Cinema 30&quot;', '&lt;p&gt;The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed specifically for the creative professional, this display provides more space for easier access to all the tools and palettes needed to edit, format and composite your work. Combine this display with a Mac Pro, MacBook Pro, or PowerMac G5 and there''s no limit to what you can achieve.&lt;br&gt;\r\n&lt;br&gt;\r\nThe Cinema HD features an active-matrix liquid crystal display that produces flicker-free images that deliver twice the brightness, twice the sharpness and twice the contrast ratio of a typical CRT display. Unlike other flat panels, it''s designed with a pure digital interface to deliver distortion-free images that never need adjusting. With over 4 million digital pixels, the display is uniquely suited for scientific and technical applications such as visualizing molecular structures or analyzing geological data.&lt;br&gt;\r\n&lt;br&gt;\r\nOffering accurate, brilliant color performance, the Cinema HD delivers up to 16.7 million colors across a wide gamut allowing you to see subtle nuances between colors from soft pastels to rich jewel tones. A wide viewing angle ensures uniform color from edge to edge. Apple''s ColorSync technology allows you to create custom profiles to maintain consistent color onscreen and in print. The result: You can confidently use this display in all your color-critical applications.&lt;br&gt;\r\n&lt;br&gt;\r\nHoused in a new aluminum design, the display has a very thin bezel that enhances visual accuracy. Each display features two FireWire 400 ports and two USB 2.0 ports, making attachment of desktop peripherals, such as iSight, iPod, digital and still cameras, hard drives, printers and scanners, even more accessible and convenient. Taking advantage of the much thinner and lighter footprint of an LCD, the new displays support the VESA (Video Electronics Standards Association) mounting interface standard. Customers with the optional Cinema Display VESA Mount Adapter kit gain the flexibility to mount their display in locations most appropriate for their work environment.&lt;br&gt;\r\n&lt;br&gt;\r\nThe Cinema HD features a single cable design with elegant breakout for the USB 2.0, FireWire 400 and a pure digital connection using the industry standard Digital Video Interface (DVI) interface. The DVI connection allows for a direct pure-digital connection.&lt;/p&gt;\r\n\r\n&lt;h3&gt;Features:&lt;/h3&gt;\r\n\r\n&lt;p&gt;Unrivaled display performance&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;30-inch (viewable) active-matrix liquid crystal display provides breathtaking image quality and vivid, richly saturated color.&lt;/li&gt;\r\n	&lt;li&gt;Support for 2560-by-1600 pixel resolution for display of high definition still and video imagery.&lt;/li&gt;\r\n	&lt;li&gt;Wide-format design for simultaneous display of two full pages of text and graphics.&lt;/li&gt;\r\n	&lt;li&gt;Industry standard DVI connector for direct attachment to Mac- and Windows-based desktops and notebooks&lt;/li&gt;\r\n	&lt;li&gt;Incredibly wide (170 degree) horizontal and vertical viewing angle for maximum visibility and color performance.&lt;/li&gt;\r\n	&lt;li&gt;Lightning-fast pixel response for full-motion digital video playback.&lt;/li&gt;\r\n	&lt;li&gt;Support for 16.7 million saturated colors, for use in all graphics-intensive applications.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Simple setup and operation&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Single cable with elegant breakout for connection to DVI, USB and FireWire ports&lt;/li&gt;\r\n	&lt;li&gt;Built-in two-port USB 2.0 hub for easy connection of desktop peripheral devices.&lt;/li&gt;\r\n	&lt;li&gt;Two FireWire 400 ports to support iSight and other desktop peripherals&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Sleek, elegant design&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Huge virtual workspace, very small footprint.&lt;/li&gt;\r\n	&lt;li&gt;Narrow Bezel design to minimize visual impact of using dual displays&lt;/li&gt;\r\n	&lt;li&gt;Unique hinge design for effortless adjustment&lt;/li&gt;\r\n	&lt;li&gt;Support for VESA mounting solutions (Apple Cinema Display VESA Mount Adapter sold separately)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;h3&gt;Technical specifications&lt;/h3&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Screen size (diagonal viewable image size)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Apple Cinema HD Display: 30 inches (29.7-inch viewable)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Screen type&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Thin film transistor (TFT) active-matrix liquid crystal display (AMLCD)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Resolutions&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;2560 x 1600 pixels (optimum resolution)&lt;/li&gt;\r\n	&lt;li&gt;2048 x 1280&lt;/li&gt;\r\n	&lt;li&gt;1920 x 1200&lt;/li&gt;\r\n	&lt;li&gt;1280 x 800&lt;/li&gt;\r\n	&lt;li&gt;1024 x 640&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Display colors (maximum)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;16.7 million&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Viewing angle (typical)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;170° horizontal; 170° vertical&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Brightness (typical)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;30-inch Cinema HD Display: 400 cd/m2&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Contrast ratio (typical)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;700:1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Response time (typical)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;16 ms&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Pixel pitch&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;30-inch Cinema HD Display: 0.250 mm&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Screen treatment&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Antiglare hardcoat&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;User controls (hardware and software)&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Display Power,&lt;/li&gt;\r\n	&lt;li&gt;System sleep, wake&lt;/li&gt;\r\n	&lt;li&gt;Brightness&lt;/li&gt;\r\n	&lt;li&gt;Monitor tilt&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Connectors and cables&lt;/strong&gt;&lt;br&gt;\r\nCable&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;DVI (Digital Visual Interface)&lt;/li&gt;\r\n	&lt;li&gt;FireWire 400&lt;/li&gt;\r\n	&lt;li&gt;USB 2.0&lt;/li&gt;\r\n	&lt;li&gt;DC power (24 V)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Connectors&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Two-port, self-powered USB 2.0 hub&lt;/li&gt;\r\n	&lt;li&gt;Two FireWire 400 ports&lt;/li&gt;\r\n	&lt;li&gt;Kensington security port&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;VESA mount adapter&lt;/strong&gt;&lt;br&gt;\r\nRequires optional Cinema Display VESA Mount Adapter (M9649G/A)&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Compatible with VESA FDMI (MIS-D, 100, C) compliant mounting solutions&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Electrical requirements&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Input voltage: 100-240 VAC 50-60Hz&lt;/li&gt;\r\n	&lt;li&gt;Maximum power when operating: 150W&lt;/li&gt;\r\n	&lt;li&gt;Energy saver mode: 3W or less&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Environmental requirements&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Operating temperature: 50° to 95° F (10° to 35° C)&lt;/li&gt;\r\n	&lt;li&gt;Storage temperature: -40° to 116° F (-40° to 47° C)&lt;/li&gt;\r\n	&lt;li&gt;Operating humidity: 20% to 80% noncondensing&lt;/li&gt;\r\n	&lt;li&gt;Maximum operating altitude: 10,000 feet&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Agency approvals&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;FCC Part 15 Class B&lt;/li&gt;\r\n	&lt;li&gt;EN55022 Class B&lt;/li&gt;\r\n	&lt;li&gt;EN55024&lt;/li&gt;\r\n	&lt;li&gt;VCCI Class B&lt;/li&gt;\r\n	&lt;li&gt;AS/NZS 3548 Class B&lt;/li&gt;\r\n	&lt;li&gt;CNS 13438 Class B&lt;/li&gt;\r\n	&lt;li&gt;ICES-003 Class B&lt;/li&gt;\r\n	&lt;li&gt;ISO 13406 part 2&lt;/li&gt;\r\n	&lt;li&gt;MPR II&lt;/li&gt;\r\n	&lt;li&gt;IEC 60950&lt;/li&gt;\r\n	&lt;li&gt;UL 60950&lt;/li&gt;\r\n	&lt;li&gt;CSA 60950&lt;/li&gt;\r\n	&lt;li&gt;EN60950&lt;/li&gt;\r\n	&lt;li&gt;ENERGY STAR&lt;/li&gt;\r\n	&lt;li&gt;TCO ''03&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Size and weight&lt;/strong&gt;&lt;br&gt;\r\n30-inch Apple Cinema HD Display&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Height: 21.3 inches (54.3 cm)&lt;/li&gt;\r\n	&lt;li&gt;Width: 27.2 inches (68.8 cm)&lt;/li&gt;\r\n	&lt;li&gt;Depth: 8.46 inches (21.5 cm)&lt;/li&gt;\r\n	&lt;li&gt;Weight: 27.5 pounds (12.5 kg)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;System Requirements&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Mac Pro, all graphic options&lt;/li&gt;\r\n	&lt;li&gt;MacBook Pro&lt;/li&gt;\r\n	&lt;li&gt;Power Mac G5 (PCI-X) with ATI Radeon 9650 or better or NVIDIA GeForce 6800 GT DDL or better&lt;/li&gt;\r\n	&lt;li&gt;Power Mac G5 (PCI Express), all graphics options&lt;/li&gt;\r\n	&lt;li&gt;PowerBook G4 with dual-link DVI support&lt;/li&gt;\r\n	&lt;li&gt;Windows PC and graphics card that supports DVI ports with dual-link digital bandwidth and VESA DDC standard for plug-and-play setup&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '', '', ''),
(43, 1, 'MacBook', '&lt;p&gt;&lt;strong&gt;Intel Core 2 Duo processor&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, the new MacBook is the fastest ever.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;1GB memory, larger hard drives&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;The new MacBook now comes with 1GB of memory standard and larger hard drives for the entire line perfect for running more of your favorite applications and storing growing media collections.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleek, 1.08-inch-thin design&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;MacBook makes it easy to hit the road thanks to its tough polycarbonate case, built-in wireless technologies, and innovative MagSafe Power Adapter that releases automatically if someone accidentally trips on the cord.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Built-in iSight camera&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Right out of the box, you can have a video chat with friends or family,2 record a video at your desk, or take fun pictures with Photo Booth&lt;/p&gt;\r\n', '', '', ''),
(44, 1, 'MacBook Air', '&lt;p&gt;MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don’t lose inches and pounds overnight. It’s the result of rethinking conventions. Of multiple wireless innovations. And of breakthrough design. With MacBook Air, mobile computing suddenly has a new standard.&lt;/p&gt;\r\n', '', '', ''),
(45, 1, 'MacBook Pro', '&lt;p&gt;&lt;strong&gt;Latest Intel mobile architecture&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Powered by the most advanced mobile processors from Intel, the new Core 2 Duo MacBook Pro is over 50% faster than the original Core Duo MacBook Pro and now supports up to 4GB of RAM.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Leading-edge graphics&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;The NVIDIA GeForce 8600M GT delivers exceptional graphics processing power. For the ultimate creative canvas, you can even configure the 17-inch model with a 1920-by-1200 resolution display.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Designed for life on the road&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Innovations such as a magnetic power connection and an illuminated keyboard with ambient light sensor put the MacBook Pro in a class by itself.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Connect. Create. Communicate.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Quickly set up a video conference with the built-in iSight camera. Control presentations and media from up to 30 feet away with the included Apple Remote. Connect to high-bandwidth peripherals with FireWire 800 and DVI.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Next-generation wireless&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Featuring 802.11n wireless technology, the MacBook Pro delivers up to five times the performance and up to twice the range of previous-generation technologies.&lt;/p&gt;\r\n&lt;!-- cpt_container_end --&gt;', '', '', ''),
(46, 1, 'Sony VAIO', '&lt;p&gt;Unprecedented power. The next generation of processing technology has arrived. Built into the newest VAIO notebooks lies Intel''s latest, most powerful innovation yet: Intel® Centrino® 2 processor technology. Boasting incredible speed, expanded wireless connectivity, enhanced multimedia support and greater energy efficiency, all the high-performance essentials are seamlessly combined into a single chip.&lt;/p&gt;\r\n', '', '', ''),
(47, 1, 'HP LP3065', '&lt;p&gt;Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a huge wide-aspect screen while letting you work as comfortably as possible - you might even forget you''re at the office&lt;/p&gt;\r\n', '', '', ''),
(48, 1, 'iPod Classic', '&lt;p&gt;&lt;strong&gt;More room to move.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Experience a whole new way to browse and view your music and video.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleeker design.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Beautiful, durable, and sleeker than ever, iPod classic now features an anodized aluminum and polished stainless steel enclosure with rounded edges.&lt;/p&gt;\r\n&lt;!-- cpt_container_end --&gt;', '', '', ''),
(49, 1, 'Samsung Galaxy Tab 10.1', '&lt;p&gt;Samsung Galaxy Tab 10.1, is the world’s thinnest tablet, measuring 8.6 mm thickness, running with Android 3.0 Honeycomb OS on a 1GHz dual-core Tegra 2 processor, similar to its younger brother Samsung Galaxy Tab 8.9.&lt;/p&gt;\r\n\r\n&lt;p&gt;Samsung Galaxy Tab 10.1 gives pure Android 3.0 experience, adding its new TouchWiz UX or TouchWiz 4.0 – includes a live panel, which lets you to customize with different content, such as your pictures, bookmarks, and social feeds, sporting a 10.1 inches WXGA capacitive touch screen with 1280 x 800 pixels of resolution, equipped with 3 megapixel rear camera with LED flash and a 2 megapixel front camera, HSPA+ connectivity up to 21Mbps, 720p HD video recording capability, 1080p HD playback, DLNA support, Bluetooth 2.1, USB 2.0, gyroscope, Wi-Fi 802.11 a/b/g/n, micro-SD slot, 3.5mm headphone jack, and SIM slot, including the Samsung Stick – a Bluetooth microphone that can be carried in a pocket like a pen and sound dock with powered subwoofer.&lt;/p&gt;\r\n\r\n&lt;p&gt;Samsung Galaxy Tab 10.1 will come in 16GB / 32GB / 64GB verities and pre-loaded with Social Hub, Reader’s Hub, Music Hub and Samsung Mini Apps Tray – which gives you access to more commonly used apps to help ease multitasking and it is capable of Adobe Flash Player 10.2, powered by 6860mAh battery that gives you 10hours of video-playback time.&amp;nbsp;äö&lt;/p&gt;\r\n', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_discount`
--

DROP TABLE IF EXISTS `ocx_product_discount`;
CREATE TABLE IF NOT EXISTS `ocx_product_discount` (
  `product_discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=561 ;

--
-- Dumping data for table `ocx_product_discount`
--

INSERT INTO `ocx_product_discount` VALUES
(558, 42, 1, 10, 1, '88.0000', '0000-00-00', '0000-00-00'),
(559, 42, 1, 20, 1, '77.0000', '0000-00-00', '0000-00-00'),
(560, 42, 1, 30, 1, '66.0000', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_filter`
--

DROP TABLE IF EXISTS `ocx_product_filter`;
CREATE TABLE IF NOT EXISTS `ocx_product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_image`
--

DROP TABLE IF EXISTS `ocx_product_image`;
CREATE TABLE IF NOT EXISTS `ocx_product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`product_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2668 ;

--
-- Dumping data for table `ocx_product_image`
--

INSERT INTO `ocx_product_image` VALUES
(2418, 44, 'data/demo/macbook_air_2.jpg', 0),
(2419, 44, 'data/demo/macbook_air_3.jpg', 0),
(2420, 44, 'data/demo/macbook_air_4.jpg', 0),
(2428, 47, 'data/demo/hp_2.jpg', 0),
(2429, 47, 'data/demo/hp_3.jpg', 0),
(2432, 41, 'data/demo/imac_2.jpg', 0),
(2433, 41, 'data/demo/imac_3.jpg', 0),
(2434, 40, 'data/demo/iphone_2.jpg', 0),
(2435, 40, 'data/demo/iphone_3.jpg', 0),
(2436, 40, 'data/demo/iphone_4.jpg', 0),
(2437, 40, 'data/demo/iphone_5.jpg', 0),
(2438, 40, 'data/demo/iphone_6.jpg', 0),
(2439, 48, 'data/demo/ipod_classic_2.jpg', 0),
(2440, 48, 'data/demo/ipod_classic_3.jpg', 0),
(2441, 48, 'data/demo/ipod_classic_4.jpg', 0),
(2442, 36, 'data/demo/ipod_nano_2.jpg', 0),
(2443, 36, 'data/demo/ipod_nano_3.jpg', 0),
(2444, 36, 'data/demo/ipod_nano_4.jpg', 0),
(2445, 36, 'data/demo/ipod_nano_5.jpg', 0),
(2446, 34, 'data/demo/ipod_shuffle_2.jpg', 0),
(2447, 34, 'data/demo/ipod_shuffle_3.jpg', 0),
(2448, 34, 'data/demo/ipod_shuffle_4.jpg', 0),
(2449, 34, 'data/demo/ipod_shuffle_5.jpg', 0),
(2450, 32, 'data/demo/ipod_touch_2.jpg', 0),
(2451, 32, 'data/demo/ipod_touch_3.jpg', 0),
(2452, 32, 'data/demo/ipod_touch_4.jpg', 0),
(2453, 32, 'data/demo/ipod_touch_5.jpg', 0),
(2454, 32, 'data/demo/ipod_touch_6.jpg', 0),
(2455, 32, 'data/demo/ipod_touch_7.jpg', 0),
(2456, 43, 'data/demo/macbook_2.jpg', 0),
(2457, 43, 'data/demo/macbook_3.jpg', 0),
(2458, 43, 'data/demo/macbook_4.jpg', 0),
(2459, 43, 'data/demo/macbook_5.jpg', 0),
(2460, 45, 'data/demo/macbook_pro_2.jpg', 0),
(2461, 45, 'data/demo/macbook_pro_3.jpg', 0),
(2462, 45, 'data/demo/macbook_pro_4.jpg', 0),
(2463, 31, 'data/demo/nikon_d300_2.jpg', 0),
(2464, 31, 'data/demo/nikon_d300_3.jpg', 0),
(2465, 31, 'data/demo/nikon_d300_4.jpg', 0),
(2466, 31, 'data/demo/nikon_d300_5.jpg', 0),
(2467, 29, 'data/demo/palm_treo_pro_2.jpg', 0),
(2468, 29, 'data/demo/palm_treo_pro_3.jpg', 0),
(2469, 49, 'data/demo/samsung_tab_2.jpg', 0),
(2470, 49, 'data/demo/samsung_tab_3.jpg', 0),
(2471, 49, 'data/demo/samsung_tab_4.jpg', 0),
(2472, 49, 'data/demo/samsung_tab_5.jpg', 0),
(2473, 49, 'data/demo/samsung_tab_6.jpg', 0),
(2474, 49, 'data/demo/samsung_tab_7.jpg', 0),
(2475, 46, 'data/demo/sony_vaio_2.jpg', 0),
(2476, 46, 'data/demo/sony_vaio_3.jpg', 0),
(2477, 46, 'data/demo/sony_vaio_4.jpg', 0),
(2478, 46, 'data/demo/sony_vaio_5.jpg', 0),
(2584, 28, 'data/demo/htc_touch_hd_2.jpg', 0),
(2585, 28, 'data/demo/htc_touch_hd_3.jpg', 0),
(2661, 30, 'data/demo/canon_eos_5d_2.jpg', 0),
(2662, 30, 'data/demo/canon_eos_5d_3.jpg', 0),
(2663, 42, 'data/demo/canon_eos_5d_1.jpg', 0),
(2664, 42, 'data/demo/canon_eos_5d_2.jpg', 0),
(2665, 42, 'data/demo/canon_logo.jpg', 0),
(2666, 42, 'data/demo/compaq_presario.jpg', 0),
(2667, 42, 'data/demo/hp_1.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_option`
--

DROP TABLE IF EXISTS `ocx_product_option`;
CREATE TABLE IF NOT EXISTS `ocx_product_option` (
  `product_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value` text COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=227 ;

--
-- Dumping data for table `ocx_product_option`
--

INSERT INTO `ocx_product_option` VALUES
(208, 42, 4, 'test', 1),
(209, 42, 6, '', 1),
(217, 42, 5, '', 1),
(218, 42, 1, '', 1),
(219, 42, 8, '2011-02-20', 1),
(220, 42, 10, '2011-02-20 22:25', 1),
(221, 42, 9, '22:25', 1),
(222, 42, 7, '', 1),
(223, 42, 2, '', 1),
(225, 47, 12, '2011-04-22', 1),
(226, 30, 5, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_option_value`
--

DROP TABLE IF EXISTS `ocx_product_option_value`;
CREATE TABLE IF NOT EXISTS `ocx_product_option_value` (
  `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(8) NOT NULL,
  `points_prefix` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `weight` decimal(15,8) NOT NULL,
  `weight_prefix` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_option_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ocx_product_option_value`
--

INSERT INTO `ocx_product_option_value` VALUES
(1, 217, 42, 5, 41, 100, 0, '1.0000', '+', 0, '+', '1.00000000', '+'),
(2, 217, 42, 5, 42, 200, 1, '2.0000', '+', 0, '+', '2.00000000', '+'),
(3, 217, 42, 5, 40, 300, 0, '3.0000', '+', 0, '+', '3.00000000', '+'),
(4, 217, 42, 5, 39, 92, 1, '4.0000', '+', 0, '+', '4.00000000', '+'),
(5, 218, 42, 1, 32, 96, 1, '10.0000', '+', 1, '+', '10.00000000', '+'),
(6, 218, 42, 1, 31, 146, 1, '20.0000', '+', 2, '-', '20.00000000', '+'),
(7, 218, 42, 1, 43, 300, 1, '30.0000', '+', 3, '+', '30.00000000', '+'),
(8, 223, 42, 2, 23, 48, 1, '10.0000', '+', 0, '+', '10.00000000', '+'),
(9, 223, 42, 2, 24, 194, 1, '20.0000', '+', 0, '+', '20.00000000', '+'),
(10, 223, 42, 2, 44, 2696, 1, '30.0000', '+', 0, '+', '30.00000000', '+'),
(11, 223, 42, 2, 45, 3998, 1, '40.0000', '+', 0, '+', '40.00000000', '+'),
(15, 226, 30, 5, 39, 2, 1, '0.0000', '+', 0, '+', '0.00000000', '+'),
(16, 226, 30, 5, 40, 5, 1, '0.0000', '+', 0, '+', '0.00000000', '+');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_profile`
--

DROP TABLE IF EXISTS `ocx_product_profile`;
CREATE TABLE IF NOT EXISTS `ocx_product_profile` (
  `product_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`profile_id`,`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_recurring`
--

DROP TABLE IF EXISTS `ocx_product_recurring`;
CREATE TABLE IF NOT EXISTS `ocx_product_recurring` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_related`
--

DROP TABLE IF EXISTS `ocx_product_related`;
CREATE TABLE IF NOT EXISTS `ocx_product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_product_related`
--

INSERT INTO `ocx_product_related` VALUES
(40, 42),
(41, 42),
(42, 40),
(42, 41);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_reward`
--

DROP TABLE IF EXISTS `ocx_product_reward`;
CREATE TABLE IF NOT EXISTS `ocx_product_reward` (
  `product_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `points` int(8) NOT NULL,
  PRIMARY KEY (`product_reward_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=622 ;

--
-- Dumping data for table `ocx_product_reward`
--

INSERT INTO `ocx_product_reward` VALUES
(565, 44, 1, 700),
(568, 47, 1, 300),
(570, 41, 1, 0),
(571, 40, 1, 0),
(572, 48, 1, 0),
(573, 36, 1, 0),
(574, 34, 1, 0),
(575, 32, 1, 0),
(576, 43, 1, 600),
(577, 45, 1, 800),
(578, 31, 1, 0),
(579, 29, 1, 0),
(580, 49, 1, 1000),
(581, 33, 1, 0),
(582, 46, 1, 0),
(604, 28, 1, 400),
(620, 30, 1, 200),
(621, 42, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_special`
--

DROP TABLE IF EXISTS `ocx_product_special`;
CREATE TABLE IF NOT EXISTS `ocx_product_special` (
  `product_special_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_special_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=486 ;

--
-- Dumping data for table `ocx_product_special`
--

INSERT INTO `ocx_product_special` VALUES
(483, 30, 1, 1, '80.0000', '0000-00-00', '0000-00-00'),
(484, 30, 1, 2, '90.0000', '0000-00-00', '0000-00-00'),
(485, 42, 1, 1, '90.0000', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_to_category`
--

DROP TABLE IF EXISTS `ocx_product_to_category`;
CREATE TABLE IF NOT EXISTS `ocx_product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_product_to_category`
--

INSERT INTO `ocx_product_to_category` VALUES
(28, 24),
(29, 24),
(30, 33),
(31, 33),
(32, 34),
(32, 38),
(33, 25),
(33, 28),
(34, 34),
(34, 49),
(36, 34),
(36, 43),
(40, 24),
(41, 20),
(41, 27),
(42, 25),
(42, 28),
(43, 18),
(43, 46),
(44, 18),
(44, 46),
(45, 18),
(45, 46),
(46, 18),
(46, 45),
(47, 18),
(47, 45),
(48, 34),
(48, 52),
(48, 58),
(49, 57);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_to_download`
--

DROP TABLE IF EXISTS `ocx_product_to_download`;
CREATE TABLE IF NOT EXISTS `ocx_product_to_download` (
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_to_layout`
--

DROP TABLE IF EXISTS `ocx_product_to_layout`;
CREATE TABLE IF NOT EXISTS `ocx_product_to_layout` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_product_to_store`
--

DROP TABLE IF EXISTS `ocx_product_to_store`;
CREATE TABLE IF NOT EXISTS `ocx_product_to_store` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_product_to_store`
--

INSERT INTO `ocx_product_to_store` VALUES
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(36, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(45, 0),
(46, 0),
(47, 0),
(48, 0),
(49, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_profile`
--

DROP TABLE IF EXISTS `ocx_profile`;
CREATE TABLE IF NOT EXISTS `ocx_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `price` decimal(10,4) NOT NULL,
  `frequency` enum('day','week','semi_month','month','year') COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(10) NOT NULL,
  `cycle` int(10) NOT NULL,
  `trial_status` tinyint(4) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `trial_frequency` enum('day','week','semi_month','month','year') COLLATE utf8_unicode_ci NOT NULL,
  `trial_duration` int(10) NOT NULL,
  `trial_cycle` int(10) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_profile_description`
--

DROP TABLE IF EXISTS `ocx_profile_description`;
CREATE TABLE IF NOT EXISTS `ocx_profile_description` (
  `profile_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`profile_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_recurring`
--

DROP TABLE IF EXISTS `ocx_recurring`;
CREATE TABLE IF NOT EXISTS `ocx_recurring` (
  `recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,4) NOT NULL,
  `frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `cycle` int(10) unsigned NOT NULL,
  `trial_status` tinyint(4) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `trial_frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `trial_duration` int(10) unsigned NOT NULL,
  `trial_cycle` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`recurring_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_recurring_description`
--

DROP TABLE IF EXISTS `ocx_recurring_description`;
CREATE TABLE IF NOT EXISTS `ocx_recurring_description` (
  `recurring_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`recurring_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_return`
--

DROP TABLE IF EXISTS `ocx_return`;
CREATE TABLE IF NOT EXISTS `ocx_return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(4) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `date_ordered` date NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_return_action`
--

DROP TABLE IF EXISTS `ocx_return_action`;
CREATE TABLE IF NOT EXISTS `ocx_return_action` (
  `return_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`return_action_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ocx_return_action`
--

INSERT INTO `ocx_return_action` VALUES
(1, 1, 'Refunded'),
(2, 1, 'Credit Issued'),
(3, 1, 'Replacement Sent');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_return_history`
--

DROP TABLE IF EXISTS `ocx_return_history`;
CREATE TABLE IF NOT EXISTS `ocx_return_history` (
  `return_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`return_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_return_reason`
--

DROP TABLE IF EXISTS `ocx_return_reason`;
CREATE TABLE IF NOT EXISTS `ocx_return_reason` (
  `return_reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`return_reason_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ocx_return_reason`
--

INSERT INTO `ocx_return_reason` VALUES
(1, 1, 'Dead On Arrival'),
(2, 1, 'Received Wrong Item'),
(3, 1, 'Order Error'),
(4, 1, 'Faulty, please supply details'),
(5, 1, 'Other, please supply details');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_return_status`
--

DROP TABLE IF EXISTS `ocx_return_status`;
CREATE TABLE IF NOT EXISTS `ocx_return_status` (
  `return_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`return_status_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ocx_return_status`
--

INSERT INTO `ocx_return_status` VALUES
(1, 1, 'Pending'),
(2, 1, 'Awaiting Products'),
(3, 1, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_review`
--

DROP TABLE IF EXISTS `ocx_review`;
CREATE TABLE IF NOT EXISTS `ocx_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`review_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_review`
--

INSERT INTO `ocx_review` VALUES
(1, 47, 0, 'jjones', 'Great product, couldn''t live without this laptop.', 4, 1, '2014-10-02 09:15:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_route`
--

DROP TABLE IF EXISTS `ocx_route`;
CREATE TABLE IF NOT EXISTS `ocx_route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`route_id`,`route`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=966 ;

--
-- Dumping data for table `ocx_route`
--

INSERT INTO `ocx_route` VALUES
(775, 'content/page', 'page_id:6', 'delivery-information'),
(778, 'content/page', 'page_id:5', 'terms-and-conditions'),
(785, 'content/page', 'page_id:3', 'privacy-policy'),
(789, 'catalog/manufacturer/info', 'manufacturer_id:8', 'apple'),
(790, 'catalog/manufacturer/info', 'manufacturer_id:9', 'canon'),
(791, 'catalog/manufacturer/info', 'manufacturer_id:7', 'hewlett-packard'),
(792, 'catalog/manufacturer/info', 'manufacturer_id:5', 'htc'),
(793, 'catalog/manufacturer/info', 'manufacturer_id:6', 'palm'),
(794, 'catalog/manufacturer/info', 'manufacturer_id:10', 'sony'),
(819, 'catalog/category', 'category_id:25', 'components'),
(820, 'catalog/category', 'category_id:29', 'mice-and-trackballs'),
(821, 'catalog/category', 'category_id:28', 'monitors'),
(822, 'catalog/category', 'category_id:35', 'test-1'),
(823, 'catalog/category', 'category_id:36', 'test-2'),
(825, 'catalog/category', 'category_id:57', 'tablets'),
(826, 'catalog/category', 'category_id:17', 'software'),
(827, 'catalog/category', 'category_id:24', 'phones-and-pdas'),
(828, 'catalog/category', 'category_id:42', 'test-9'),
(829, 'catalog/category', 'category_id:41', 'test-8'),
(830, 'catalog/category', 'category_id:40', 'test-7'),
(831, 'catalog/category', 'category_id:39', 'test-6'),
(832, 'catalog/category', 'category_id:37', 'test-5'),
(833, 'catalog/category', 'category_id:38', 'test-4'),
(834, 'catalog/category', 'category_id:56', 'test-24'),
(835, 'catalog/category', 'category_id:55', 'test-23'),
(836, 'catalog/category', 'category_id:54', 'test-22'),
(837, 'catalog/category', 'category_id:53', 'test-21'),
(838, 'catalog/category', 'category_id:58', 'test-25'),
(840, 'catalog/category', 'category_id:52', 'test-20'),
(841, 'catalog/category', 'category_id:51', 'test-19'),
(842, 'catalog/category', 'category_id:50', 'test-18'),
(843, 'catalog/category', 'category_id:49', 'test-17'),
(844, 'catalog/category', 'category_id:48', 'test-16'),
(845, 'catalog/category', 'category_id:47', 'test-15'),
(846, 'catalog/category', 'category_id:44', 'test-12'),
(847, 'catalog/category', 'category_id:43', 'test-11'),
(848, 'catalog/category', 'category_id:34', 'mp3-players'),
(849, 'catalog/category', 'category_id:45', 'windows'),
(850, 'catalog/category', 'category_id:46', 'macs'),
(851, 'catalog/category', 'category_id:18', 'laptops-and-notebooks'),
(852, 'catalog/category', 'category_id:26', 'pc'),
(853, 'catalog/category', 'category_id:27', 'mac'),
(855, 'catalog/category', 'category_id:32', 'web-cameras'),
(856, 'catalog/category', 'category_id:31', 'scanners'),
(857, 'catalog/category', 'category_id:30', 'printers'),
(863, 'content/page', 'page_id:7', 'return-policy'),
(864, 'content/page', 'page_id:8', 'affiliate-terms'),
(882, 'catalog/product', 'product_id:44', 'macbook-air'),
(885, 'catalog/product', 'product_id:47', 'hp-lp3065'),
(887, 'catalog/product', 'product_id:41', 'imac'),
(888, 'catalog/product', 'product_id:40', 'iphone'),
(889, 'catalog/product', 'product_id:48', 'ipod-classic'),
(890, 'catalog/product', 'product_id:36', 'ipod-nano'),
(891, 'catalog/product', 'product_id:34', 'ipod-shuffle'),
(892, 'catalog/product', 'product_id:32', 'ipod-touch'),
(893, 'catalog/product', 'product_id:43', 'macbook'),
(894, 'catalog/product', 'product_id:45', 'macbook-pro'),
(895, 'catalog/product', 'product_id:31', 'nikon-d300'),
(896, 'catalog/product', 'product_id:29', 'palm-treo-pro'),
(897, 'catalog/product', 'product_id:49', 'samsung-galaxy-tab-10-1'),
(898, 'catalog/product', 'product_id:33', 'samsung-syncmaster-941bw'),
(899, 'catalog/product', 'product_id:46', 'sony-vaio'),
(902, 'content/page', 'page_id:4', 'about-us'),
(924, 'catalog/product', 'product_id:28', 'htc-touch-hd'),
(940, 'content/category', 'blog_category_id:1', 'general'),
(947, 'catalog/category', 'category_id:33', 'cameras'),
(949, 'catalog/category', 'category_id:20', 'desktops'),
(952, 'content/category', 'blog_category_id:2', 'latest-product-news'),
(963, 'catalog/product', 'product_id:30', 'canon-eos-5d'),
(964, 'catalog/product', 'product_id:42', 'apple-cinema-30-inch'),
(965, 'content/post', 'post_id:1', 'lorem-ipsum-test-post');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_setting`
--

DROP TABLE IF EXISTS `ocx_setting`;
CREATE TABLE IF NOT EXISTS `ocx_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `group` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10161 ;

--
-- Dumping data for table `ocx_setting`
--

INSERT INTO `ocx_setting` VALUES
(1, 0, 'shipping', 'shipping_sort_order', '3', 0),
(4, 0, 'tax', 'tax_status', '1', 0),
(7, 0, 'tax', 'tax_sort_order', '5', 0),
(14, 0, 'shipping', 'shipping_status', '1', 0),
(15, 0, 'shipping', 'shipping_estimator', '1', 0),
(34, 0, 'flat', 'flat_sort_order', '1', 0),
(35, 0, 'flat', 'flat_status', '1', 0),
(36, 0, 'flat', 'flat_geo_zone_id', '0', 0),
(37, 0, 'flat', 'flat_tax_class_id', '9', 0),
(41, 0, 'flat', 'flat_cost', '5.00', 0),
(53, 0, 'reward', 'reward_sort_order', '2', 0),
(54, 0, 'reward', 'reward_status', '1', 0),
(3743, 0, 'free_checkout', 'free_checkout_order_status_id', '1', 0),
(3744, 0, 'free_checkout', 'free_checkout_status', '0', 0),
(3745, 0, 'free_checkout', 'free_checkout_sort_order', '1', 0),
(3746, 0, 'cod', 'cod_total', '0.01', 0),
(3747, 0, 'cod', 'cod_order_status_id', '2', 0),
(3748, 0, 'cod', 'cod_geo_zone_id', '0', 0),
(3749, 0, 'cod', 'cod_status', '1', 0),
(3750, 0, 'cod', 'cod_sort_order', '5', 0),
(3868, 0, 'sub_total', 'sub_total_status', '1', 0),
(3869, 0, 'sub_total', 'sub_total_sort_order', '1', 0),
(3872, 0, 'subtotal', 'subtotal_status', '1', 0),
(3873, 0, 'subtotal', 'subtotal_sort_order', '1', 0),
(3999, 0, 'coupon', 'coupon_status', '1', 0),
(4000, 0, 'coupon', 'coupon_sort_order', '4', 0),
(4001, 0, 'credit', 'credit_status', '1', 0),
(4002, 0, 'credit', 'credit_sort_order', '6', 0),
(4003, 0, 'giftcard', 'giftcard_status', '1', 0),
(4004, 0, 'giftcard', 'giftcard_sort_order', '7', 0),
(4005, 0, 'total', 'total_status', '1', 0),
(4006, 0, 'total', 'total_sort_order', '8', 0),
(4012, 0, 'blog_category', 'blog_category_widget', 'a:1:{i:0;a:4:{s:9:"layout_id";s:1:"6";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(4019, 0, 'blog_featured', 'post', '', 0),
(4020, 0, 'blog_featured', 'blog_featured_post', '', 0),
(4288, 0, 'postwall_widget', 'postwall_widget', 'a:1:{i:0;a:10:{s:5:"limit";s:2:"12";s:4:"span";s:1:"4";s:6:"height";s:0:"";s:9:"post_type";s:6:"latest";s:11:"description";s:1:"1";s:6:"button";s:1:"1";s:9:"layout_id";s:2:"14";s:8:"position";s:11:"content_top";s:6:"status";s:1:"0";s:10:"sort_order";s:1:"1";}}', 1),
(9738, 0, 'account', 'account_widget', 'a:1:{i:0;a:4:{s:9:"layout_id";s:1:"6";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9739, 0, 'affiliate', 'affiliate_widget', 'a:1:{i:0;a:4:{s:9:"layout_id";s:2:"10";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9740, 0, 'banner', 'banner_widget', 'a:1:{i:0;a:7:{s:9:"banner_id";s:1:"6";s:5:"width";s:3:"267";s:6:"height";s:3:"267";s:9:"layout_id";s:1:"3";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}}', 1),
(9741, 0, 'blogcategory', 'blogcategory_widget', 'a:4:{i:0;a:4:{s:9:"layout_id";s:2:"15";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:1;a:4:{s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:2;a:4:{s:9:"layout_id";s:2:"16";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:3;a:4:{s:9:"layout_id";s:2:"17";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}}', 1),
(9742, 0, 'blogfeatured', 'post', '', 0),
(9743, 0, 'blogfeatured', 'blogfeatured_post', '1', 0),
(9744, 0, 'blogfeatured', 'blogfeatured_widget', 'a:4:{i:0;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"15";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}i:1;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}i:2;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"16";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}i:3;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"17";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}}', 1),
(9745, 0, 'bloghottopics', 'bloghottopics_widget', 'a:4:{i:0;a:5:{s:5:"limit";s:1:"5";s:9:"layout_id";s:2:"15";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}i:1;a:5:{s:5:"limit";s:1:"5";s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}i:2;a:5:{s:5:"limit";s:1:"5";s:9:"layout_id";s:2:"16";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}i:3;a:5:{s:5:"limit";s:1:"5";s:9:"layout_id";s:2:"17";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}}', 1),
(9746, 0, 'bloglatest', 'bloglatest_widget', 'a:4:{i:0;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"15";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"5";}i:1;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"5";}i:2;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"16";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"5";}i:3;a:7:{s:5:"limit";s:1:"5";s:11:"image_width";s:2:"40";s:12:"image_height";s:2:"30";s:9:"layout_id";s:2:"17";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"5";}}', 1),
(9747, 0, 'blogsearch', 'blogsearch_widget', 'a:4:{i:0;a:4:{s:9:"layout_id";s:2:"15";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:1;a:4:{s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:2;a:4:{s:9:"layout_id";s:2:"16";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:3;a:4:{s:9:"layout_id";s:2:"17";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9748, 0, 'carousel', 'carousel_widget', 'a:2:{i:0;a:9:{s:9:"banner_id";s:1:"8";s:5:"limit";s:1:"5";s:6:"scroll";s:1:"2";s:5:"width";s:2:"80";s:6:"height";s:2:"80";s:9:"layout_id";s:1:"2";s:8:"position";s:10:"pre_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:1;a:9:{s:9:"banner_id";s:1:"8";s:5:"limit";s:1:"5";s:6:"scroll";s:1:"3";s:5:"width";s:2:"80";s:6:"height";s:2:"80";s:9:"layout_id";s:2:"14";s:8:"position";s:10:"pre_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9749, 0, 'category', 'category_widget', 'a:4:{i:0;a:4:{s:9:"layout_id";s:1:"4";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:1;a:4:{s:9:"layout_id";s:1:"5";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:2;a:4:{s:9:"layout_id";s:1:"3";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:3;a:4:{s:9:"layout_id";s:2:"12";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9750, 0, 'featured', 'product', '', 0),
(9751, 0, 'featured', 'featured_product', '43,40,42,49,46,47,28', 0),
(9752, 0, 'featured', 'featured_widget', 'a:1:{i:0;a:7:{s:5:"limit";s:1:"6";s:11:"image_width";s:3:"191";s:12:"image_height";s:3:"180";s:9:"layout_id";s:1:"2";s:8:"position";s:14:"content_bottom";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9754, 0, 'masonry_widget', 'masonry_widget', 'a:1:{i:0;a:10:{s:5:"limit";s:2:"12";s:4:"span";s:1:"2";s:6:"height";s:0:"";s:12:"product_type";s:6:"latest";s:11:"description";s:1:"1";s:6:"button";s:1:"1";s:9:"layout_id";s:1:"2";s:8:"position";s:11:"content_top";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}}', 1),
(9755, 0, 'page', 'page_widget', 'a:1:{i:0;a:4:{s:9:"layout_id";s:2:"11";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9771, 0, 'headermenu', 'headermenu_widget', 'a:3:{i:0;a:5:{s:7:"menu_id";s:2:"17";s:9:"layout_id";s:1:"1";s:8:"position";s:11:"shop_header";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:1;a:5:{s:7:"menu_id";s:1:"4";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_header";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:2;a:5:{s:7:"menu_id";s:1:"3";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_header";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}}', 1),
(9785, 0, 'sidebarmenu', 'sidebarmenu_widget', 'a:3:{i:0;a:5:{s:7:"menu_id";s:2:"14";s:9:"layout_id";s:1:"3";s:8:"position";s:11:"column_left";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:1;a:5:{s:7:"menu_id";s:2:"15";s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}i:2;a:5:{s:7:"menu_id";s:2:"16";s:9:"layout_id";s:2:"14";s:8:"position";s:12:"column_right";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}}', 1),
(9786, 0, 'footerblocks', 'footerblocks_widget', 'a:8:{i:0;a:5:{s:7:"menu_id";s:1:"5";s:9:"layout_id";s:1:"1";s:8:"position";s:11:"shop_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:1;a:5:{s:7:"menu_id";s:1:"7";s:9:"layout_id";s:1:"1";s:8:"position";s:11:"shop_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:2;a:5:{s:7:"menu_id";s:1:"8";s:9:"layout_id";s:1:"1";s:8:"position";s:11:"shop_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}i:3;a:5:{s:7:"menu_id";s:2:"13";s:9:"layout_id";s:1:"1";s:8:"position";s:11:"shop_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}i:4;a:5:{s:7:"menu_id";s:2:"10";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:5;a:5:{s:7:"menu_id";s:1:"8";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"2";}i:6;a:5:{s:7:"menu_id";s:1:"5";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"3";}i:7;a:5:{s:7:"menu_id";s:2:"16";s:9:"layout_id";s:1:"1";s:8:"position";s:14:"content_footer";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"4";}}', 1),
(9790, 0, 'slideshow', 'slideshow_widget', 'a:2:{i:0;a:7:{s:9:"banner_id";s:1:"9";s:5:"width";s:4:"1170";s:6:"height";s:3:"340";s:9:"layout_id";s:1:"2";s:8:"position";s:11:"post_header";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}i:1;a:7:{s:9:"banner_id";s:1:"9";s:5:"width";s:4:"1170";s:6:"height";s:3:"340";s:9:"layout_id";s:2:"14";s:8:"position";s:11:"post_header";s:6:"status";s:1:"1";s:10:"sort_order";s:1:"1";}}', 1),
(9813, 0, 'blog', 'blog_name', 'Oculus Blog', 0),
(9814, 0, 'blog', 'blog_title', 'Oculus Blog', 0),
(9815, 0, 'blog', 'blog_meta_description', '', 0),
(9816, 0, 'blog', 'blog_email', 'blog@ocx.io', 0),
(9817, 0, 'blog', 'blog_limit', '20', 0),
(9818, 0, 'blog', 'blog_posted_by', 'username', 0),
(9819, 0, 'blog', 'blog_comment_status', '1', 0),
(9820, 0, 'blog', 'blog_comment_require_approve', '1', 0),
(9821, 0, 'blog', 'blog_admin_group_id', '1', 0),
(9822, 0, 'blog', 'blog_author_group_id', '1', 0),
(9823, 0, 'blog', 'blog_logo', '', 0),
(9824, 0, 'blog', 'blog_icon', '', 0),
(9825, 0, 'blog', 'blog_image_thumb_width', '200', 0),
(9826, 0, 'blog', 'blog_image_thumb_height', '200', 0),
(9827, 0, 'blog', 'blog_image_popup_width', '600', 0),
(9828, 0, 'blog', 'blog_image_popup_height', '600', 0),
(9829, 0, 'blog', 'blog_image_post_width', '900', 0),
(9830, 0, 'blog', 'blog_image_post_height', '300', 0),
(9831, 0, 'blog', 'blog_image_additional_width', '130', 0),
(9832, 0, 'blog', 'blog_image_additional_height', '130', 0),
(9833, 0, 'blog', 'blog_image_related_width', '200', 0),
(9834, 0, 'blog', 'blog_image_related_height', '200', 0),
(10048, 0, 'config', 'config_name', 'Your Store', 0),
(10049, 0, 'config', 'config_owner', 'Your Name', 0),
(10050, 0, 'config', 'config_address', '77 Massachusetts Ave,\r\nCambridge, MA 02139', 0),
(10051, 0, 'config', 'config_email', 'email@yoursite.com', 0),
(10052, 0, 'config', 'config_telephone', '123456789', 0),
(10053, 0, 'config', 'config_site_style', 'shop', 0),
(10054, 0, 'config', 'config_title', 'Your Store', 0),
(10055, 0, 'config', 'config_meta_description', 'My Store', 0),
(10056, 0, 'config', 'config_theme', 'ghost', 0),
(10057, 0, 'config', 'config_admin_theme', 'bs3', 0),
(10058, 0, 'config', 'config_layout_id', '2', 0),
(10059, 0, 'config', 'config_country_id', '223', 0),
(10060, 0, 'config', 'config_zone_id', '', 0),
(10061, 0, 'config', 'config_language', 'en', 0),
(10062, 0, 'config', 'config_admin_language', 'en', 0),
(10063, 0, 'config', 'config_currency', 'USD', 0),
(10064, 0, 'config', 'config_currency_auto', '1', 0),
(10065, 0, 'config', 'config_length_class_id', '3', 0),
(10066, 0, 'config', 'config_weight_class_id', '5', 0),
(10067, 0, 'config', 'config_catalog_limit', '16', 0),
(10068, 0, 'config', 'config_admin_limit', '10', 0),
(10069, 0, 'config', 'config_product_count', '0', 0),
(10070, 0, 'config', 'config_review_status', '1', 0),
(10071, 0, 'config', 'config_download', '0', 0),
(10072, 0, 'config', 'config_giftcard_min', '1', 0),
(10073, 0, 'config', 'config_giftcard_max', '1000', 0),
(10074, 0, 'config', 'config_tax', '0', 0),
(10075, 0, 'config', 'config_vat', '0', 0),
(10076, 0, 'config', 'config_tax_default', '', 0),
(10077, 0, 'config', 'config_tax_customer', 'shipping', 0),
(10078, 0, 'config', 'config_customer_online', '0', 0),
(10079, 0, 'config', 'config_customer_group_id', '1', 0),
(10080, 0, 'config', 'config_customer_group_display', 'a:1:{i:0;s:1:"1";}', 1),
(10081, 0, 'config', 'config_customer_price', '0', 0),
(10082, 0, 'config', 'config_account_id', '3', 0),
(10083, 0, 'config', 'config_cart_weight', '1', 0),
(10084, 0, 'config', 'config_guest_checkout', '1', 0),
(10085, 0, 'config', 'config_checkout_id', '5', 0),
(10086, 0, 'config', 'config_order_edit', '100', 0),
(10087, 0, 'config', 'config_invoice_prefix', 'INV-2013-00', 0),
(10088, 0, 'config', 'config_order_status_id', '2', 0),
(10089, 0, 'config', 'config_complete_status_id', '5', 0),
(10090, 0, 'config', 'config_stock_display', '1', 0),
(10091, 0, 'config', 'config_stock_warning', '0', 0),
(10092, 0, 'config', 'config_stock_checkout', '0', 0),
(10093, 0, 'config', 'config_stock_status_id', '5', 0),
(10094, 0, 'config', 'config_affiliate_terms', '8', 0),
(10095, 0, 'config', 'config_commission', '10', 0),
(10096, 0, 'config', 'config_return_id', '7', 0),
(10097, 0, 'config', 'config_return_status_id', '2', 0),
(10098, 0, 'config', 'config_logo', 'data/logo.png', 0),
(10099, 0, 'config', 'config_icon', 'data/favicon.png', 0),
(10100, 0, 'config', 'config_image_category_width', '180', 0),
(10101, 0, 'config', 'config_image_category_height', '180', 0),
(10102, 0, 'config', 'config_image_thumb_width', '451', 0),
(10103, 0, 'config', 'config_image_thumb_height', '451', 0),
(10104, 0, 'config', 'config_image_popup_width', '600', 0),
(10105, 0, 'config', 'config_image_popup_height', '600', 0),
(10106, 0, 'config', 'config_image_product_width', '213', 0),
(10107, 0, 'config', 'config_image_product_height', '213', 0),
(10108, 0, 'config', 'config_image_additional_width', '88', 0),
(10109, 0, 'config', 'config_image_additional_height', '88', 0),
(10110, 0, 'config', 'config_image_related_width', '180', 0),
(10111, 0, 'config', 'config_image_related_height', '180', 0),
(10112, 0, 'config', 'config_image_compare_width', '140', 0),
(10113, 0, 'config', 'config_image_compare_height', '140', 0),
(10114, 0, 'config', 'config_image_wishlist_width', '70', 0),
(10115, 0, 'config', 'config_image_wishlist_height', '70', 0),
(10116, 0, 'config', 'config_image_cart_width', '60', 0),
(10117, 0, 'config', 'config_image_cart_height', '60', 0),
(10118, 0, 'config', 'config_ftp_host', '', 0),
(10119, 0, 'config', 'config_ftp_port', '', 0),
(10120, 0, 'config', 'config_ftp_username', '', 0),
(10121, 0, 'config', 'config_ftp_password', '', 0),
(10122, 0, 'config', 'config_ftp_root', '', 0),
(10123, 0, 'config', 'config_ftp_status', '0', 0),
(10124, 0, 'config', 'config_mail_protocol', 'mail', 0),
(10125, 0, 'config', 'config_mail_parameter', '', 0),
(10126, 0, 'config', 'config_smtp_host', '', 0),
(10127, 0, 'config', 'config_smtp_username', '', 0),
(10128, 0, 'config', 'config_smtp_password', '', 0),
(10129, 0, 'config', 'config_smtp_port', '25', 0),
(10130, 0, 'config', 'config_smtp_timeout', '5', 0),
(10131, 0, 'config', 'config_alert_mail', '0', 0),
(10132, 0, 'config', 'config_account_mail', '0', 0),
(10133, 0, 'config', 'config_alert_emails', '', 0),
(10134, 0, 'config', 'config_fraud_detection', '0', 0),
(10135, 0, 'config', 'config_fraud_key', '', 0),
(10136, 0, 'config', 'config_fraud_score', '', 0),
(10137, 0, 'config', 'config_fraud_status_id', '7', 0),
(10138, 0, 'config', 'config_secure', '0', 0),
(10139, 0, 'config', 'config_shared', '0', 0),
(10140, 0, 'config', 'config_top_level', '0', 0),
(10141, 0, 'config', 'config_ucfirst', '0', 0),
(10142, 0, 'config', 'config_robots', 'abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai''hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg', 0),
(10143, 0, 'config', 'config_file_extension_allowed', 'txt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc\r\nrtf\r\nxls\r\nppt\r\nodt\r\nods', 0),
(10144, 0, 'config', 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/jpeg\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/vnd.microsoft.icon\r\nimage/tiff\r\nimage/tiff\r\nimage/svg+xml\r\nimage/svg+xml\r\napplication/zip\r\napplication/x-rar-compressed\r\napplication/x-msdownload\r\napplication/vnd.ms-cab-compressed\r\naudio/mpeg\r\nvideo/quicktime\r\nvideo/quicktime\r\napplication/pdf\r\nimage/vnd.adobe.photoshop\r\napplication/postscript\r\napplication/postscript\r\napplication/postscript\r\napplication/msword\r\napplication/rtf\r\napplication/vnd.ms-excel\r\napplication/vnd.ms-powerpoint\r\napplication/vnd.oasis.opendocument.text\r\napplication/vnd.oasis.opendocument.spreadsheet', 0),
(10145, 0, 'config', 'config_maintenance', '0', 0),
(10146, 0, 'config', 'config_password', '1', 0),
(10147, 0, 'config', 'config_encryption', 'da918f5c5bb2618540b6f15c0f26de0c', 0),
(10148, 0, 'config', 'config_compression', '0', 0),
(10149, 0, 'config', 'config_error_display', '1', 0),
(10150, 0, 'config', 'config_error_log', '1', 0),
(10151, 0, 'config', 'config_error_filename', 'error.txt', 0),
(10152, 0, 'config', 'config_google_analytics', '', 0),
(10153, 0, 'config', 'config_cache_type_id', 'file', 0),
(10154, 0, 'config', 'config_default_visibility', '1', 0),
(10155, 0, 'config', 'config_free_customer', '1', 0),
(10156, 0, 'config', 'config_top_customer', '1', 0),
(10157, 0, 'config', 'config_mail_twitter', 'TwitterHandle', 0),
(10158, 0, 'config', 'config_mail_facebook', 'FacebookPage', 0),
(10159, 0, 'config', 'config_cache_status', '0', 0),
(10160, 0, 'config', 'config_affiliate_allowed', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_stock_status`
--

DROP TABLE IF EXISTS `ocx_stock_status`;
CREATE TABLE IF NOT EXISTS `ocx_stock_status` (
  `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`stock_status_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ocx_stock_status`
--

INSERT INTO `ocx_stock_status` VALUES
(5, 1, 'Out Of Stock'),
(6, 1, '2 - 3 Days'),
(7, 1, 'In Stock'),
(8, 1, 'Pre-Order');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_store`
--

DROP TABLE IF EXISTS `ocx_store`;
CREATE TABLE IF NOT EXISTS `ocx_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ssl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_tax_class`
--

DROP TABLE IF EXISTS `ocx_tax_class`;
CREATE TABLE IF NOT EXISTS `ocx_tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tax_class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ocx_tax_class`
--

INSERT INTO `ocx_tax_class` VALUES
(9, 'Taxable Goods', 'products requiring sales tax', '2009-01-06 23:21:53', '2014-06-28 00:37:14'),
(10, 'Downloadable Products', 'Downloadable', '2011-09-21 22:19:39', '2014-06-28 00:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_tax_rate`
--

DROP TABLE IF EXISTS `ocx_tax_rate`;
CREATE TABLE IF NOT EXISTS `ocx_tax_rate` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `ocx_tax_rate`
--

INSERT INTO `ocx_tax_rate` VALUES
(88, 6, 'AZ Sales Tax', '8.1000', 'P', '2014-06-28 00:36:45', '2014-09-08 00:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_tax_rate_to_customer_group`
--

DROP TABLE IF EXISTS `ocx_tax_rate_to_customer_group`;
CREATE TABLE IF NOT EXISTS `ocx_tax_rate_to_customer_group` (
  `tax_rate_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`tax_rate_id`,`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_tax_rate_to_customer_group`
--

INSERT INTO `ocx_tax_rate_to_customer_group` VALUES
(88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_tax_rule`
--

DROP TABLE IF EXISTS `ocx_tax_rule`;
CREATE TABLE IF NOT EXISTS `ocx_tax_rule` (
  `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tax_rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=130 ;

--
-- Dumping data for table `ocx_tax_rule`
--

INSERT INTO `ocx_tax_rule` VALUES
(129, 9, 88, 'shipping', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_user`
--

DROP TABLE IF EXISTS `ocx_user`;
CREATE TABLE IF NOT EXISTS `ocx_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_access` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_user`
--

INSERT INTO `ocx_user` VALUES
(1, 1, 'admin', '4362c63b295d63cb1dd413bd5cbb3db22b788783', 'b53d923ad', 'Admin', 'User', 'admin@yoursite.com', '', '127.0.0.1', 1, '2014-09-30 18:42:38', '2014-10-02 08:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_user_group`
--

DROP TABLE IF EXISTS `ocx_user_group`;
CREATE TABLE IF NOT EXISTS `ocx_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ocx_user_group`
--

INSERT INTO `ocx_user_group` VALUES
(1, 'Top Administrator', 'a:2:{s:6:"access";a:133:{i:0;s:17:"catalog/attribute";i:1;s:22:"catalog/attributegroup";i:2;s:16:"catalog/category";i:3;s:16:"catalog/download";i:4;s:14:"catalog/filter";i:5;s:20:"catalog/manufacturer";i:6;s:14:"catalog/option";i:7;s:15:"catalog/product";i:8;s:15:"catalog/profile";i:9;s:14:"catalog/review";i:10;s:10:"common/css";i:11;s:18:"common/filemanager";i:12;s:17:"common/javascript";i:13;s:11:"common/menu";i:14;s:16:"content/category";i:15;s:15:"content/comment";i:16;s:12:"content/page";i:17;s:12:"content/post";i:18;s:15:"content/setting";i:19;s:13:"design/banner";i:20;s:18:"design/customfield";i:21;s:13:"design/layout";i:22;s:15:"feed/googlebase";i:23;s:18:"feed/googlesitemap";i:24;s:20:"localization/country";i:25;s:21:"localization/currency";i:26;s:20:"localization/geozone";i:27;s:21:"localization/language";i:28;s:24:"localization/lengthclass";i:29;s:24:"localization/orderstatus";i:30;s:25:"localization/returnaction";i:31;s:25:"localization/returnreason";i:32;s:25:"localization/returnstatus";i:33;s:24:"localization/stockstatus";i:34;s:21:"localization/taxclass";i:35;s:20:"localization/taxrate";i:36;s:24:"localization/weightclass";i:37;s:17:"localization/zone";i:38;s:11:"module/feed";i:39;s:11:"module/menu";i:40;s:14:"module/payment";i:41;s:13:"module/plugin";i:42;s:15:"module/shipping";i:43;s:12:"module/total";i:44;s:13:"module/widget";i:45;s:20:"payment/authorizenet";i:46;s:20:"payment/banktransfer";i:47;s:13:"payment/check";i:48;s:11:"payment/cod";i:49;s:20:"payment/freecheckout";i:50;s:20:"payment/moneybookers";i:51;s:21:"payment/payflowiframe";i:52;s:21:"payment/paypalexpress";i:53;s:17:"payment/paypalpro";i:54;s:22:"payment/paypalstandard";i:55;s:17:"payment/proiframe";i:56;s:13:"payment/propf";i:57;s:13:"payment/prouk";i:58;s:19:"payment/twocheckout";i:59;s:16:"people/affiliate";i:60;s:14:"people/contact";i:61;s:15:"people/customer";i:62;s:20:"people/customerbanip";i:63;s:20:"people/customergroup";i:64;s:11:"people/user";i:65;s:21:"people/userpermission";i:66;s:26:"report/affiliatecommission";i:67;s:21:"report/customercredit";i:68;s:21:"report/customeronline";i:69;s:20:"report/customerorder";i:70;s:21:"report/customerreward";i:71;s:23:"report/productpurchased";i:72;s:20:"report/productviewed";i:73;s:17:"report/salecoupon";i:74;s:16:"report/saleorder";i:75;s:17:"report/salereturn";i:76;s:19:"report/saleshipping";i:77;s:14:"report/saletax";i:78;s:11:"sale/coupon";i:79;s:10:"sale/order";i:80;s:14:"sale/recurring";i:81;s:12:"sale/returns";i:82;s:12:"sale/voucher";i:83;s:17:"sale/vouchertheme";i:84;s:15:"setting/setting";i:85;s:13:"setting/store";i:86;s:14:"shipping/fedex";i:87;s:13:"shipping/flat";i:88;s:13:"shipping/free";i:89;s:13:"shipping/item";i:90;s:15:"shipping/pickup";i:91;s:12:"shipping/ups";i:92;s:13:"shipping/usps";i:93;s:15:"shipping/weight";i:94;s:11:"tool/backup";i:95;s:13:"tool/errorlog";i:96;s:9:"tool/test";i:97;s:12:"total/coupon";i:98;s:12:"total/credit";i:99;s:14:"total/handling";i:100;s:17:"total/loworderfee";i:101;s:12:"total/reward";i:102;s:14:"total/shipping";i:103;s:14:"total/subtotal";i:104;s:9:"total/tax";i:105;s:11:"total/total";i:106;s:13:"total/voucher";i:107;s:14:"widget/account";i:108;s:16:"widget/affiliate";i:109;s:13:"widget/banner";i:110;s:17:"widget/bestseller";i:111;s:19:"widget/blogcategory";i:112;s:19:"widget/blogfeatured";i:113;s:20:"widget/bloghottopics";i:114;s:17:"widget/bloglatest";i:115;s:17:"widget/blogsearch";i:116;s:15:"widget/carousel";i:117;s:15:"widget/category";i:118;s:15:"widget/featured";i:119;s:19:"widget/footerblocks";i:120;s:17:"widget/headermenu";i:121;s:13:"widget/latest";i:122;s:14:"widget/masonry";i:123;s:11:"widget/page";i:124;s:15:"widget/postwall";i:125;s:18:"widget/sidebarmenu";i:126;s:16:"widget/slideshow";i:127;s:14:"widget/special";i:128;s:14:"widget/welcome";i:129;s:14:"plugin/example";i:130;s:10:"plugin/git";i:131;s:19:"widget/footerblocks";i:132;s:13:"shipping/free";}s:6:"modify";a:133:{i:0;s:17:"catalog/attribute";i:1;s:22:"catalog/attributegroup";i:2;s:16:"catalog/category";i:3;s:16:"catalog/download";i:4;s:14:"catalog/filter";i:5;s:20:"catalog/manufacturer";i:6;s:14:"catalog/option";i:7;s:15:"catalog/product";i:8;s:15:"catalog/profile";i:9;s:14:"catalog/review";i:10;s:10:"common/css";i:11;s:18:"common/filemanager";i:12;s:17:"common/javascript";i:13;s:11:"common/menu";i:14;s:16:"content/category";i:15;s:15:"content/comment";i:16;s:12:"content/page";i:17;s:12:"content/post";i:18;s:15:"content/setting";i:19;s:13:"design/banner";i:20;s:18:"design/customfield";i:21;s:13:"design/layout";i:22;s:15:"feed/googlebase";i:23;s:18:"feed/googlesitemap";i:24;s:20:"localization/country";i:25;s:21:"localization/currency";i:26;s:20:"localization/geozone";i:27;s:21:"localization/language";i:28;s:24:"localization/lengthclass";i:29;s:24:"localization/orderstatus";i:30;s:25:"localization/returnaction";i:31;s:25:"localization/returnreason";i:32;s:25:"localization/returnstatus";i:33;s:24:"localization/stockstatus";i:34;s:21:"localization/taxclass";i:35;s:20:"localization/taxrate";i:36;s:24:"localization/weightclass";i:37;s:17:"localization/zone";i:38;s:11:"module/feed";i:39;s:11:"module/menu";i:40;s:14:"module/payment";i:41;s:13:"module/plugin";i:42;s:15:"module/shipping";i:43;s:12:"module/total";i:44;s:13:"module/widget";i:45;s:20:"payment/authorizenet";i:46;s:20:"payment/banktransfer";i:47;s:13:"payment/check";i:48;s:11:"payment/cod";i:49;s:20:"payment/freecheckout";i:50;s:20:"payment/moneybookers";i:51;s:21:"payment/payflowiframe";i:52;s:21:"payment/paypalexpress";i:53;s:17:"payment/paypalpro";i:54;s:22:"payment/paypalstandard";i:55;s:17:"payment/proiframe";i:56;s:13:"payment/propf";i:57;s:13:"payment/prouk";i:58;s:19:"payment/twocheckout";i:59;s:16:"people/affiliate";i:60;s:14:"people/contact";i:61;s:15:"people/customer";i:62;s:20:"people/customerbanip";i:63;s:20:"people/customergroup";i:64;s:11:"people/user";i:65;s:21:"people/userpermission";i:66;s:26:"report/affiliatecommission";i:67;s:21:"report/customercredit";i:68;s:21:"report/customeronline";i:69;s:20:"report/customerorder";i:70;s:21:"report/customerreward";i:71;s:23:"report/productpurchased";i:72;s:20:"report/productviewed";i:73;s:17:"report/salecoupon";i:74;s:16:"report/saleorder";i:75;s:17:"report/salereturn";i:76;s:19:"report/saleshipping";i:77;s:14:"report/saletax";i:78;s:11:"sale/coupon";i:79;s:10:"sale/order";i:80;s:14:"sale/recurring";i:81;s:12:"sale/returns";i:82;s:12:"sale/voucher";i:83;s:17:"sale/vouchertheme";i:84;s:15:"setting/setting";i:85;s:13:"setting/store";i:86;s:14:"shipping/fedex";i:87;s:13:"shipping/flat";i:88;s:13:"shipping/free";i:89;s:13:"shipping/item";i:90;s:15:"shipping/pickup";i:91;s:12:"shipping/ups";i:92;s:13:"shipping/usps";i:93;s:15:"shipping/weight";i:94;s:11:"tool/backup";i:95;s:13:"tool/errorlog";i:96;s:9:"tool/test";i:97;s:12:"total/coupon";i:98;s:12:"total/credit";i:99;s:14:"total/handling";i:100;s:17:"total/loworderfee";i:101;s:12:"total/reward";i:102;s:14:"total/shipping";i:103;s:14:"total/subtotal";i:104;s:9:"total/tax";i:105;s:11:"total/total";i:106;s:13:"total/voucher";i:107;s:14:"widget/account";i:108;s:16:"widget/affiliate";i:109;s:13:"widget/banner";i:110;s:17:"widget/bestseller";i:111;s:19:"widget/blogcategory";i:112;s:19:"widget/blogfeatured";i:113;s:20:"widget/bloghottopics";i:114;s:17:"widget/bloglatest";i:115;s:17:"widget/blogsearch";i:116;s:15:"widget/carousel";i:117;s:15:"widget/category";i:118;s:15:"widget/featured";i:119;s:19:"widget/footerblocks";i:120;s:17:"widget/headermenu";i:121;s:13:"widget/latest";i:122;s:14:"widget/masonry";i:123;s:11:"widget/page";i:124;s:15:"widget/postwall";i:125;s:18:"widget/sidebarmenu";i:126;s:16:"widget/slideshow";i:127;s:14:"widget/special";i:128;s:14:"widget/welcome";i:129;s:14:"plugin/example";i:130;s:10:"plugin/git";i:131;s:19:"widget/footerblocks";i:132;s:13:"shipping/free";}}');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_giftcard`
--

DROP TABLE IF EXISTS `ocx_giftcard`;
CREATE TABLE IF NOT EXISTS `ocx_giftcard` (
  `giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `to_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `to_email` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `giftcard_theme_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`giftcard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_giftcard_history`
--

DROP TABLE IF EXISTS `ocx_giftcard_history`;
CREATE TABLE IF NOT EXISTS `ocx_giftcard_history` (
  `giftcard_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `giftcard_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`giftcard_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ocx_giftcard_theme`
--

DROP TABLE IF EXISTS `ocx_giftcard_theme`;
CREATE TABLE IF NOT EXISTS `ocx_giftcard_theme` (
  `giftcard_theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`giftcard_theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ocx_giftcard_theme`
--

INSERT INTO `ocx_giftcard_theme` VALUES
(6, 'data/demo/apple_logo.jpg'),
(7, 'data/demo/gift-giftcard-birthday.jpg'),
(8, 'data/demo/canon_eos_5d_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_giftcard_theme_description`
--

DROP TABLE IF EXISTS `ocx_giftcard_theme_description`;
CREATE TABLE IF NOT EXISTS `ocx_giftcard_theme_description` (
  `giftcard_theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`giftcard_theme_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocx_giftcard_theme_description`
--

INSERT INTO `ocx_giftcard_theme_description` VALUES
(6, 1, 'Christmas'),
(7, 1, 'Birthday'),
(8, 1, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_weight_class`
--

DROP TABLE IF EXISTS `ocx_weight_class`;
CREATE TABLE IF NOT EXISTS `ocx_weight_class` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  PRIMARY KEY (`weight_class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ocx_weight_class`
--

INSERT INTO `ocx_weight_class` VALUES
(1, '1.00000000'),
(2, '1000.00000000'),
(5, '2.20460000'),
(6, '35.27400000');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_weight_class_description`
--

DROP TABLE IF EXISTS `ocx_weight_class_description`;
CREATE TABLE IF NOT EXISTS `ocx_weight_class_description` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`weight_class_id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ocx_weight_class_description`
--

INSERT INTO `ocx_weight_class_description` VALUES
(1, 1, 'Kilogram', 'kg'),
(2, 1, 'Gram', 'g'),
(5, 1, 'Pound ', 'lb'),
(6, 1, 'Ounce', 'oz');

-- --------------------------------------------------------

--
-- Table structure for table `ocx_zone`
--

DROP TABLE IF EXISTS `ocx_zone`;
CREATE TABLE IF NOT EXISTS `ocx_zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4033 ;

--
-- Dumping data for table `ocx_zone`
--

INSERT INTO `ocx_zone` VALUES
(69, 3, 'Adrar', 'ADR', 0),
(70, 3, 'Ain Defla', 'ADE', 0),
(71, 3, 'Ain Temouchent', 'ATE', 0),
(72, 3, 'Alger', 'ALG', 0),
(73, 3, 'Annaba', 'ANN', 0),
(74, 3, 'Batna', 'BAT', 0),
(75, 3, 'Bechar', 'BEC', 0),
(76, 3, 'Bejaia', 'BEJ', 0),
(77, 3, 'Biskra', 'BIS', 0),
(78, 3, 'Blida', 'BLI', 0),
(79, 3, 'Bordj Bou Arreridj', 'BBA', 0),
(80, 3, 'Bouira', 'BOA', 0),
(81, 3, 'Boumerdes', 'BMD', 0),
(82, 3, 'Chlef', 'CHL', 0),
(83, 3, 'Constantine', 'CON', 0),
(84, 3, 'Djelfa', 'DJE', 0),
(85, 3, 'El Bayadh', 'EBA', 0),
(86, 3, 'El Oued', 'EOU', 0),
(87, 3, 'El Tarf', 'ETA', 0),
(88, 3, 'Ghardaia', 'GHA', 0),
(89, 3, 'Guelma', 'GUE', 0),
(90, 3, 'Illizi', 'ILL', 0),
(91, 3, 'Jijel', 'JIJ', 0),
(92, 3, 'Khenchela', 'KHE', 0),
(93, 3, 'Laghouat', 'LAG', 0),
(94, 3, 'Muaskar', 'MUA', 0),
(95, 3, 'Medea', 'MED', 0),
(96, 3, 'Mila', 'MIL', 0),
(97, 3, 'Mostaganem', 'MOS', 0),
(98, 3, 'M''Sila', 'MSI', 0),
(99, 3, 'Naama', 'NAA', 0),
(100, 3, 'Oran', 'ORA', 0),
(101, 3, 'Ouargla', 'OUA', 0),
(102, 3, 'Oum el-Bouaghi', 'OEB', 0),
(103, 3, 'Relizane', 'REL', 0),
(104, 3, 'Saida', 'SAI', 0),
(105, 3, 'Setif', 'SET', 0),
(106, 3, 'Sidi Bel Abbes', 'SBA', 0),
(107, 3, 'Skikda', 'SKI', 0),
(108, 3, 'Souk Ahras', 'SAH', 0),
(109, 3, 'Tamanghasset', 'TAM', 0),
(110, 3, 'Tebessa', 'TEB', 0),
(111, 3, 'Tiaret', 'TIA', 0),
(112, 3, 'Tindouf', 'TIN', 0),
(113, 3, 'Tipaza', 'TIP', 0),
(114, 3, 'Tissemsilt', 'TIS', 0),
(115, 3, 'Tizi Ouzou', 'TOU', 0),
(116, 3, 'Tlemcen', 'TLE', 0),
(117, 4, 'Eastern', 'E', 0),
(118, 4, 'Manu''a', 'M', 0),
(119, 4, 'Rose Island', 'R', 0),
(120, 4, 'Swains Island', 'S', 0),
(121, 4, 'Western', 'W', 0),
(122, 5, 'Andorra la Vella', 'ALV', 0),
(123, 5, 'Canillo', 'CAN', 0),
(124, 5, 'Encamp', 'ENC', 0),
(125, 5, 'Escaldes-Engordany', 'ESE', 0),
(126, 5, 'La Massana', 'LMA', 0),
(127, 5, 'Ordino', 'ORD', 0),
(128, 5, 'Sant Julia de Loria', 'SJL', 0),
(129, 6, 'Bengo', 'BGO', 0),
(130, 6, 'Benguela', 'BGU', 0),
(131, 6, 'Bie', 'BIE', 0),
(132, 6, 'Cabinda', 'CAB', 0),
(133, 6, 'Cuando-Cubango', 'CCU', 0),
(134, 6, 'Cuanza Norte', 'CNO', 0),
(135, 6, 'Cuanza Sul', 'CUS', 0),
(136, 6, 'Cunene', 'CNN', 0),
(137, 6, 'Huambo', 'HUA', 0),
(138, 6, 'Huila', 'HUI', 0),
(139, 6, 'Luanda', 'LUA', 0),
(140, 6, 'Lunda Norte', 'LNO', 0),
(141, 6, 'Lunda Sul', 'LSU', 0),
(142, 6, 'Malange', 'MAL', 0),
(143, 6, 'Moxico', 'MOX', 0),
(144, 6, 'Namibe', 'NAM', 0),
(145, 6, 'Uige', 'UIG', 0),
(146, 6, 'Zaire', 'ZAI', 0),
(147, 9, 'Saint George', 'ASG', 0),
(148, 9, 'Saint John', 'ASJ', 0),
(149, 9, 'Saint Mary', 'ASM', 0),
(150, 9, 'Saint Paul', 'ASL', 0),
(151, 9, 'Saint Peter', 'ASR', 0),
(152, 9, 'Saint Philip', 'ASH', 0),
(153, 9, 'Barbuda', 'BAR', 0),
(154, 9, 'Redonda', 'RED', 0),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', 0),
(156, 10, 'Buenos Aires', 'BA', 0),
(157, 10, 'Catamarca', 'CA', 0),
(158, 10, 'Chaco', 'CH', 0),
(159, 10, 'Chubut', 'CU', 0),
(160, 10, 'Cordoba', 'CO', 0),
(161, 10, 'Corrientes', 'CR', 0),
(162, 10, 'Distrito Federal', 'DF', 0),
(163, 10, 'Entre Rios', 'ER', 0),
(164, 10, 'Formosa', 'FO', 0),
(165, 10, 'Jujuy', 'JU', 0),
(166, 10, 'La Pampa', 'LP', 0),
(167, 10, 'La Rioja', 'LR', 0),
(168, 10, 'Mendoza', 'ME', 0),
(169, 10, 'Misiones', 'MI', 0),
(170, 10, 'Neuquen', 'NE', 0),
(171, 10, 'Rio Negro', 'RN', 0),
(172, 10, 'Salta', 'SA', 0),
(173, 10, 'San Juan', 'SJ', 0),
(174, 10, 'San Luis', 'SL', 0),
(175, 10, 'Santa Cruz', 'SC', 0),
(176, 10, 'Santa Fe', 'SF', 0),
(177, 10, 'Santiago del Estero', 'SD', 0),
(178, 10, 'Tierra del Fuego', 'TF', 0),
(179, 10, 'Tucuman', 'TU', 0),
(180, 11, 'Aragatsotn', 'AGT', 0),
(181, 11, 'Ararat', 'ARR', 0),
(182, 11, 'Armavir', 'ARM', 0),
(183, 11, 'Geghark''unik''', 'GEG', 0),
(184, 11, 'Kotayk''', 'KOT', 0),
(185, 11, 'Lorri', 'LOR', 0),
(186, 11, 'Shirak', 'SHI', 0),
(187, 11, 'Syunik''', 'SYU', 0),
(188, 11, 'Tavush', 'TAV', 0),
(189, 11, 'Vayots'' Dzor', 'VAY', 0),
(190, 11, 'Yerevan', 'YER', 0),
(191, 13, 'Australian Capital Territory', 'ACT', 0),
(192, 13, 'New South Wales', 'NSW', 0),
(193, 13, 'Northern Territory', 'NT', 0),
(194, 13, 'Queensland', 'QLD', 0),
(195, 13, 'South Australia', 'SA', 0),
(196, 13, 'Tasmania', 'TAS', 0),
(197, 13, 'Victoria', 'VIC', 0),
(198, 13, 'Western Australia', 'WA', 0),
(199, 14, 'Burgenland', 'BUR', 0),
(200, 14, 'Kärnten', 'KAR', 0),
(201, 14, 'Nieder&ouml;sterreich', 'NOS', 0),
(202, 14, 'Ober&ouml;sterreich', 'OOS', 0),
(203, 14, 'Salzburg', 'SAL', 0),
(204, 14, 'Steiermark', 'STE', 0),
(205, 14, 'Tirol', 'TIR', 0),
(206, 14, 'Vorarlberg', 'VOR', 0),
(207, 14, 'Wien', 'WIE', 0),
(208, 15, 'Ali Bayramli', 'AB', 0),
(209, 15, 'Abseron', 'ABS', 0),
(210, 15, 'AgcabAdi', 'AGC', 0),
(211, 15, 'Agdam', 'AGM', 0),
(212, 15, 'Agdas', 'AGS', 0),
(213, 15, 'Agstafa', 'AGA', 0),
(214, 15, 'Agsu', 'AGU', 0),
(215, 15, 'Astara', 'AST', 0),
(216, 15, 'Baki', 'BA', 0),
(217, 15, 'BabAk', 'BAB', 0),
(218, 15, 'BalakAn', 'BAL', 0),
(219, 15, 'BArdA', 'BAR', 0),
(220, 15, 'Beylaqan', 'BEY', 0),
(221, 15, 'Bilasuvar', 'BIL', 0),
(222, 15, 'Cabrayil', 'CAB', 0),
(223, 15, 'Calilabab', 'CAL', 0),
(224, 15, 'Culfa', 'CUL', 0),
(225, 15, 'Daskasan', 'DAS', 0),
(226, 15, 'Davaci', 'DAV', 0),
(227, 15, 'Fuzuli', 'FUZ', 0),
(228, 15, 'Ganca', 'GA', 0),
(229, 15, 'Gadabay', 'GAD', 0),
(230, 15, 'Goranboy', 'GOR', 0),
(231, 15, 'Goycay', 'GOY', 0),
(232, 15, 'Haciqabul', 'HAC', 0),
(233, 15, 'Imisli', 'IMI', 0),
(234, 15, 'Ismayilli', 'ISM', 0),
(235, 15, 'Kalbacar', 'KAL', 0),
(236, 15, 'Kurdamir', 'KUR', 0),
(237, 15, 'Lankaran', 'LA', 0),
(238, 15, 'Lacin', 'LAC', 0),
(239, 15, 'Lankaran', 'LAN', 0),
(240, 15, 'Lerik', 'LER', 0),
(241, 15, 'Masalli', 'MAS', 0),
(242, 15, 'Mingacevir', 'MI', 0),
(243, 15, 'Naftalan', 'NA', 0),
(244, 15, 'Neftcala', 'NEF', 0),
(245, 15, 'Oguz', 'OGU', 0),
(246, 15, 'Ordubad', 'ORD', 0),
(247, 15, 'Qabala', 'QAB', 0),
(248, 15, 'Qax', 'QAX', 0),
(249, 15, 'Qazax', 'QAZ', 0),
(250, 15, 'Qobustan', 'QOB', 0),
(251, 15, 'Quba', 'QBA', 0),
(252, 15, 'Qubadli', 'QBI', 0),
(253, 15, 'Qusar', 'QUS', 0),
(254, 15, 'Saki', 'SA', 0),
(255, 15, 'Saatli', 'SAT', 0),
(256, 15, 'Sabirabad', 'SAB', 0),
(257, 15, 'Sadarak', 'SAD', 0),
(258, 15, 'Sahbuz', 'SAH', 0),
(259, 15, 'Saki', 'SAK', 0),
(260, 15, 'Salyan', 'SAL', 0),
(261, 15, 'Sumqayit', 'SM', 0),
(262, 15, 'Samaxi', 'SMI', 0),
(263, 15, 'Samkir', 'SKR', 0),
(264, 15, 'Samux', 'SMX', 0),
(265, 15, 'Sarur', 'SAR', 0),
(266, 15, 'Siyazan', 'SIY', 0),
(267, 15, 'Susa', 'SS', 0),
(268, 15, 'Susa', 'SUS', 0),
(269, 15, 'Tartar', 'TAR', 0),
(270, 15, 'Tovuz', 'TOV', 0),
(271, 15, 'Ucar', 'UCA', 0),
(272, 15, 'Xankandi', 'XA', 0),
(273, 15, 'Xacmaz', 'XAC', 0),
(274, 15, 'Xanlar', 'XAN', 0),
(275, 15, 'Xizi', 'XIZ', 0),
(276, 15, 'Xocali', 'XCI', 0),
(277, 15, 'Xocavand', 'XVD', 0),
(278, 15, 'Yardimli', 'YAR', 0),
(279, 15, 'Yevlax', 'YEV', 0),
(280, 15, 'Zangilan', 'ZAN', 0),
(281, 15, 'Zaqatala', 'ZAQ', 0),
(282, 15, 'Zardab', 'ZAR', 0),
(283, 15, 'Naxcivan', 'NX', 0),
(284, 16, 'Acklins', 'ACK', 0),
(285, 16, 'Berry Islands', 'BER', 0),
(286, 16, 'Bimini', 'BIM', 0),
(287, 16, 'Black Point', 'BLK', 0),
(288, 16, 'Cat Island', 'CAT', 0),
(289, 16, 'Central Abaco', 'CAB', 0),
(290, 16, 'Central Andros', 'CAN', 0),
(291, 16, 'Central Eleuthera', 'CEL', 0),
(292, 16, 'City of Freeport', 'FRE', 0),
(293, 16, 'Crooked Island', 'CRO', 0),
(294, 16, 'East Grand Bahama', 'EGB', 0),
(295, 16, 'Exuma', 'EXU', 0),
(296, 16, 'Grand Cay', 'GRD', 0),
(297, 16, 'Harbour Island', 'HAR', 0),
(298, 16, 'Hope Town', 'HOP', 0),
(299, 16, 'Inagua', 'INA', 0),
(300, 16, 'Long Island', 'LNG', 0),
(301, 16, 'Mangrove Cay', 'MAN', 0),
(302, 16, 'Mayaguana', 'MAY', 0),
(303, 16, 'Moore''s Island', 'MOO', 0),
(304, 16, 'North Abaco', 'NAB', 0),
(305, 16, 'North Andros', 'NAN', 0),
(306, 16, 'North Eleuthera', 'NEL', 0),
(307, 16, 'Ragged Island', 'RAG', 0),
(308, 16, 'Rum Cay', 'RUM', 0),
(309, 16, 'San Salvador', 'SAL', 0),
(310, 16, 'South Abaco', 'SAB', 0),
(311, 16, 'South Andros', 'SAN', 0),
(312, 16, 'South Eleuthera', 'SEL', 0),
(313, 16, 'Spanish Wells', 'SWE', 0),
(314, 16, 'West Grand Bahama', 'WGB', 0),
(315, 17, 'Capital', 'CAP', 0),
(316, 17, 'Central', 'CEN', 0),
(317, 17, 'Muharraq', 'MUH', 0),
(318, 17, 'Northern', 'NOR', 0),
(319, 17, 'Southern', 'SOU', 0),
(320, 18, 'Barisal', 'BAR', 0),
(321, 18, 'Chittagong', 'CHI', 0),
(322, 18, 'Dhaka', 'DHA', 0),
(323, 18, 'Khulna', 'KHU', 0),
(324, 18, 'Rajshahi', 'RAJ', 0),
(325, 18, 'Sylhet', 'SYL', 0),
(326, 19, 'Christ Church', 'CC', 0),
(327, 19, 'Saint Andrew', 'AND', 0),
(328, 19, 'Saint George', 'GEO', 0),
(329, 19, 'Saint James', 'JAM', 0),
(330, 19, 'Saint John', 'JOH', 0),
(331, 19, 'Saint Joseph', 'JOS', 0),
(332, 19, 'Saint Lucy', 'LUC', 0),
(333, 19, 'Saint Michael', 'MIC', 0),
(334, 19, 'Saint Peter', 'PET', 0),
(335, 19, 'Saint Philip', 'PHI', 0),
(336, 19, 'Saint Thomas', 'THO', 0),
(344, 21, 'Antwerpen', 'VAN', 0),
(345, 21, 'Brabant Wallon', 'WBR', 0),
(346, 21, 'Hainaut', 'WHT', 0),
(347, 21, 'Liège', 'WLG', 0),
(348, 21, 'Limburg', 'VLI', 0),
(349, 21, 'Luxembourg', 'WLX', 0),
(350, 21, 'Namur', 'WNA', 0),
(351, 21, 'Oost-Vlaanderen', 'VOV', 0),
(352, 21, 'Vlaams Brabant', 'VBR', 0),
(353, 21, 'West-Vlaanderen', 'VWV', 0),
(354, 22, 'Belize', 'BZ', 0),
(355, 22, 'Cayo', 'CY', 0),
(356, 22, 'Corozal', 'CR', 0),
(357, 22, 'Orange Walk', 'OW', 0),
(358, 22, 'Stann Creek', 'SC', 0),
(359, 22, 'Toledo', 'TO', 0),
(360, 23, 'Alibori', 'AL', 0),
(361, 23, 'Atakora', 'AK', 0),
(362, 23, 'Atlantique', 'AQ', 0),
(363, 23, 'Borgou', 'BO', 0),
(364, 23, 'Collines', 'CO', 0),
(365, 23, 'Donga', 'DO', 0),
(366, 23, 'Kouffo', 'KO', 0),
(367, 23, 'Littoral', 'LI', 0),
(368, 23, 'Mono', 'MO', 0),
(369, 23, 'Oueme', 'OU', 0),
(370, 23, 'Plateau', 'PL', 0),
(371, 23, 'Zou', 'ZO', 0),
(372, 24, 'Devonshire', 'DS', 0),
(373, 24, 'Hamilton City', 'HC', 0),
(374, 24, 'Hamilton', 'HA', 0),
(375, 24, 'Paget', 'PG', 0),
(376, 24, 'Pembroke', 'PB', 0),
(377, 24, 'Saint George City', 'GC', 0),
(378, 24, 'Saint George''s', 'SG', 0),
(379, 24, 'Sandys', 'SA', 0),
(380, 24, 'Smith''s', 'SM', 0),
(381, 24, 'Southampton', 'SH', 0),
(382, 24, 'Warwick', 'WA', 0),
(383, 25, 'Bumthang', 'BUM', 0),
(384, 25, 'Chukha', 'CHU', 0),
(385, 25, 'Dagana', 'DAG', 0),
(386, 25, 'Gasa', 'GAS', 0),
(387, 25, 'Haa', 'HAA', 0),
(388, 25, 'Lhuntse', 'LHU', 0),
(389, 25, 'Mongar', 'MON', 0),
(390, 25, 'Paro', 'PAR', 0),
(391, 25, 'Pemagatshel', 'PEM', 0),
(392, 25, 'Punakha', 'PUN', 0),
(393, 25, 'Samdrup Jongkhar', 'SJO', 0),
(394, 25, 'Samtse', 'SAT', 0),
(395, 25, 'Sarpang', 'SAR', 0),
(396, 25, 'Thimphu', 'THI', 0),
(397, 25, 'Trashigang', 'TRG', 0),
(398, 25, 'Trashiyangste', 'TRY', 0),
(399, 25, 'Trongsa', 'TRO', 0),
(400, 25, 'Tsirang', 'TSI', 0),
(401, 25, 'Wangdue Phodrang', 'WPH', 0),
(402, 25, 'Zhemgang', 'ZHE', 0),
(403, 26, 'Beni', 'BEN', 0),
(404, 26, 'Chuquisaca', 'CHU', 0),
(405, 26, 'Cochabamba', 'COC', 0),
(406, 26, 'La Paz', 'LPZ', 0),
(407, 26, 'Oruro', 'ORU', 0),
(408, 26, 'Pando', 'PAN', 0),
(409, 26, 'Potosi', 'POT', 0),
(410, 26, 'Santa Cruz', 'SCZ', 0),
(411, 26, 'Tarija', 'TAR', 0),
(430, 28, 'Central', 'CE', 0),
(431, 28, 'Ghanzi', 'GH', 0),
(432, 28, 'Kgalagadi', 'KD', 0),
(433, 28, 'Kgatleng', 'KT', 0),
(434, 28, 'Kweneng', 'KW', 0),
(435, 28, 'Ngamiland', 'NG', 0),
(436, 28, 'North East', 'NE', 0),
(437, 28, 'North West', 'NW', 0),
(438, 28, 'South East', 'SE', 0),
(439, 28, 'Southern', 'SO', 0),
(440, 30, 'Acre', 'AC', 0),
(441, 30, 'Alagoas', 'AL', 0),
(442, 30, 'Amapá', 'AP', 0),
(443, 30, 'Amazonas', 'AM', 0),
(444, 30, 'Bahia', 'BA', 0),
(445, 30, 'Ceará', 'CE', 0),
(446, 30, 'Distrito Federal', 'DF', 0),
(447, 30, 'Espírito Santo', 'ES', 0),
(448, 30, 'Goiás', 'GO', 0),
(449, 30, 'Maranhão', 'MA', 0),
(450, 30, 'Mato Grosso', 'MT', 0),
(451, 30, 'Mato Grosso do Sul', 'MS', 0),
(452, 30, 'Minas Gerais', 'MG', 0),
(453, 30, 'Pará', 'PA', 0),
(454, 30, 'Paraíba', 'PB', 0),
(455, 30, 'Paraná', 'PR', 0),
(456, 30, 'Pernambuco', 'PE', 0),
(457, 30, 'Piauí', 'PI', 0),
(458, 30, 'Rio de Janeiro', 'RJ', 0),
(459, 30, 'Rio Grande do Norte', 'RN', 0),
(460, 30, 'Rio Grande do Sul', 'RS', 0),
(461, 30, 'Rondônia', 'RO', 0),
(462, 30, 'Roraima', 'RR', 0),
(463, 30, 'Santa Catarina', 'SC', 0),
(464, 30, 'São Paulo', 'SP', 0),
(465, 30, 'Sergipe', 'SE', 0),
(466, 30, 'Tocantins', 'TO', 0),
(467, 31, 'Peros Banhos', 'PB', 0),
(468, 31, 'Salomon Islands', 'SI', 0),
(469, 31, 'Nelsons Island', 'NI', 0),
(470, 31, 'Three Brothers', 'TB', 0),
(471, 31, 'Eagle Islands', 'EA', 0),
(472, 31, 'Danger Island', 'DI', 0),
(473, 31, 'Egmont Islands', 'EG', 0),
(474, 31, 'Diego Garcia', 'DG', 0),
(475, 32, 'Belait', 'BEL', 0),
(476, 32, 'Brunei and Muara', 'BRM', 0),
(477, 32, 'Temburong', 'TEM', 0),
(478, 32, 'Tutong', 'TUT', 0),
(506, 34, 'Bale', 'BAL', 0),
(507, 34, 'Bam', 'BAM', 0),
(508, 34, 'Banwa', 'BAN', 0),
(509, 34, 'Bazega', 'BAZ', 0),
(510, 34, 'Bougouriba', 'BOR', 0),
(511, 34, 'Boulgou', 'BLG', 0),
(512, 34, 'Boulkiemde', 'BOK', 0),
(513, 34, 'Comoe', 'COM', 0),
(514, 34, 'Ganzourgou', 'GAN', 0),
(515, 34, 'Gnagna', 'GNA', 0),
(516, 34, 'Gourma', 'GOU', 0),
(517, 34, 'Houet', 'HOU', 0),
(518, 34, 'Ioba', 'IOA', 0),
(519, 34, 'Kadiogo', 'KAD', 0),
(520, 34, 'Kenedougou', 'KEN', 0),
(521, 34, 'Komondjari', 'KOD', 0),
(522, 34, 'Kompienga', 'KOP', 0),
(523, 34, 'Kossi', 'KOS', 0),
(524, 34, 'Koulpelogo', 'KOL', 0),
(525, 34, 'Kouritenga', 'KOT', 0),
(526, 34, 'Kourweogo', 'KOW', 0),
(527, 34, 'Leraba', 'LER', 0),
(528, 34, 'Loroum', 'LOR', 0),
(529, 34, 'Mouhoun', 'MOU', 0),
(530, 34, 'Nahouri', 'NAH', 0),
(531, 34, 'Namentenga', 'NAM', 0),
(532, 34, 'Nayala', 'NAY', 0),
(533, 34, 'Noumbiel', 'NOU', 0),
(534, 34, 'Oubritenga', 'OUB', 0),
(535, 34, 'Oudalan', 'OUD', 0),
(536, 34, 'Passore', 'PAS', 0),
(537, 34, 'Poni', 'PON', 0),
(538, 34, 'Sanguie', 'SAG', 0),
(539, 34, 'Sanmatenga', 'SAM', 0),
(540, 34, 'Seno', 'SEN', 0),
(541, 34, 'Sissili', 'SIS', 0),
(542, 34, 'Soum', 'SOM', 0),
(543, 34, 'Sourou', 'SOR', 0),
(544, 34, 'Tapoa', 'TAP', 0),
(545, 34, 'Tuy', 'TUY', 0),
(546, 34, 'Yagha', 'YAG', 0),
(547, 34, 'Yatenga', 'YAT', 0),
(548, 34, 'Ziro', 'ZIR', 0),
(549, 34, 'Zondoma', 'ZOD', 0),
(550, 34, 'Zoundweogo', 'ZOW', 0),
(551, 35, 'Bubanza', 'BB', 0),
(552, 35, 'Bujumbura', 'BJ', 0),
(553, 35, 'Bururi', 'BR', 0),
(554, 35, 'Cankuzo', 'CA', 0),
(555, 35, 'Cibitoke', 'CI', 0),
(556, 35, 'Gitega', 'GI', 0),
(557, 35, 'Karuzi', 'KR', 0),
(558, 35, 'Kayanza', 'KY', 0),
(559, 35, 'Kirundo', 'KI', 0),
(560, 35, 'Makamba', 'MA', 0),
(561, 35, 'Muramvya', 'MU', 0),
(562, 35, 'Muyinga', 'MY', 0),
(563, 35, 'Mwaro', 'MW', 0),
(564, 35, 'Ngozi', 'NG', 0),
(565, 35, 'Rutana', 'RT', 0),
(566, 35, 'Ruyigi', 'RY', 0),
(567, 36, 'Phnom Penh', 'PP', 0),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', 0),
(569, 36, 'Pailin', 'PA', 0),
(570, 36, 'Keb', 'KB', 0),
(571, 36, 'Banteay Meanchey', 'BM', 0),
(572, 36, 'Battambang', 'BA', 0),
(573, 36, 'Kampong Cham', 'KM', 0),
(574, 36, 'Kampong Chhnang', 'KN', 0),
(575, 36, 'Kampong Speu', 'KU', 0),
(576, 36, 'Kampong Som', 'KO', 0),
(577, 36, 'Kampong Thom', 'KT', 0),
(578, 36, 'Kampot', 'KP', 0),
(579, 36, 'Kandal', 'KL', 0),
(580, 36, 'Kaoh Kong', 'KK', 0),
(581, 36, 'Kratie', 'KR', 0),
(582, 36, 'Mondul Kiri', 'MK', 0),
(583, 36, 'Oddar Meancheay', 'OM', 0),
(584, 36, 'Pursat', 'PU', 0),
(585, 36, 'Preah Vihear', 'PR', 0),
(586, 36, 'Prey Veng', 'PG', 0),
(587, 36, 'Ratanak Kiri', 'RK', 0),
(588, 36, 'Siemreap', 'SI', 0),
(589, 36, 'Stung Treng', 'ST', 0),
(590, 36, 'Svay Rieng', 'SR', 0),
(591, 36, 'Takeo', 'TK', 0),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', 0),
(593, 37, 'Centre', 'CEN', 0),
(594, 37, 'East (Est)', 'EST', 0),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', 0),
(596, 37, 'Littoral', 'LIT', 0),
(597, 37, 'North (Nord)', 'NOR', 0),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', 0),
(599, 37, 'West (Ouest)', 'OUE', 0),
(600, 37, 'South (Sud)', 'SUD', 0),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', 0),
(602, 38, 'Alberta', 'AB', 1),
(603, 38, 'British Columbia', 'BC', 1),
(604, 38, 'Manitoba', 'MB', 1),
(605, 38, 'New Brunswick', 'NB', 1),
(606, 38, 'Newfoundland and Labrador', 'NL', 1),
(607, 38, 'Northwest Territories', 'NT', 1),
(608, 38, 'Nova Scotia', 'NS', 1),
(609, 38, 'Nunavut', 'NU', 1),
(610, 38, 'Ontario', 'ON', 1),
(611, 38, 'Prince Edward Island', 'PE', 1),
(612, 38, 'Qu&eacute;bec', 'QC', 1),
(613, 38, 'Saskatchewan', 'SK', 1),
(614, 38, 'Yukon Territory', 'YT', 1),
(615, 39, 'Boa Vista', 'BV', 0),
(616, 39, 'Brava', 'BR', 0),
(617, 39, 'Calheta de Sao Miguel', 'CS', 0),
(618, 39, 'Maio', 'MA', 0),
(619, 39, 'Mosteiros', 'MO', 0),
(620, 39, 'Paul', 'PA', 0),
(621, 39, 'Porto Novo', 'PN', 0),
(622, 39, 'Praia', 'PR', 0),
(623, 39, 'Ribeira Grande', 'RG', 0),
(624, 39, 'Sal', 'SL', 0),
(625, 39, 'Santa Catarina', 'CA', 0),
(626, 39, 'Santa Cruz', 'CR', 0),
(627, 39, 'Sao Domingos', 'SD', 0),
(628, 39, 'Sao Filipe', 'SF', 0),
(629, 39, 'Sao Nicolau', 'SN', 0),
(630, 39, 'Sao Vicente', 'SV', 0),
(631, 39, 'Tarrafal', 'TA', 0),
(632, 40, 'Creek', 'CR', 0),
(633, 40, 'Eastern', 'EA', 0),
(634, 40, 'Midland', 'ML', 0),
(635, 40, 'South Town', 'ST', 0),
(636, 40, 'Spot Bay', 'SP', 0),
(637, 40, 'Stake Bay', 'SK', 0),
(638, 40, 'West End', 'WD', 0),
(639, 40, 'Western', 'WN', 0),
(640, 41, 'Bamingui-Bangoran', 'BBA', 0),
(641, 41, 'Basse-Kotto', 'BKO', 0),
(642, 41, 'Haute-Kotto', 'HKO', 0),
(643, 41, 'Haut-Mbomou', 'HMB', 0),
(644, 41, 'Kemo', 'KEM', 0),
(645, 41, 'Lobaye', 'LOB', 0),
(646, 41, 'Mambere-KadeÔ', 'MKD', 0),
(647, 41, 'Mbomou', 'MBO', 0),
(648, 41, 'Nana-Mambere', 'NMM', 0),
(649, 41, 'Ombella-M''Poko', 'OMP', 0),
(650, 41, 'Ouaka', 'OUK', 0),
(651, 41, 'Ouham', 'OUH', 0),
(652, 41, 'Ouham-Pende', 'OPE', 0),
(653, 41, 'Vakaga', 'VAK', 0),
(654, 41, 'Nana-Grebizi', 'NGR', 0),
(655, 41, 'Sangha-Mbaere', 'SMB', 0),
(656, 41, 'Bangui', 'BAN', 0),
(657, 42, 'Batha', 'BA', 0),
(658, 42, 'Biltine', 'BI', 0),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', 0),
(660, 42, 'Chari-Baguirmi', 'CB', 0),
(661, 42, 'Guera', 'GU', 0),
(662, 42, 'Kanem', 'KA', 0),
(663, 42, 'Lac', 'LA', 0),
(664, 42, 'Logone Occidental', 'LC', 0),
(665, 42, 'Logone Oriental', 'LR', 0),
(666, 42, 'Mayo-Kebbi', 'MK', 0),
(667, 42, 'Moyen-Chari', 'MC', 0),
(668, 42, 'Ouaddai', 'OU', 0),
(669, 42, 'Salamat', 'SA', 0),
(670, 42, 'Tandjile', 'TA', 0),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', 0),
(672, 43, 'Antofagasta', 'AN', 0),
(673, 43, 'Araucania', 'AR', 0),
(674, 43, 'Atacama', 'AT', 0),
(675, 43, 'Bio-Bio', 'BI', 0),
(676, 43, 'Coquimbo', 'CO', 0),
(677, 43, 'Libertador General Bernardo O''Hi', 'LI', 0),
(678, 43, 'Los Lagos', 'LL', 0),
(679, 43, 'Magallanes y de la Antartica Chi', 'MA', 0),
(680, 43, 'Maule', 'ML', 0),
(681, 43, 'Region Metropolitana', 'RM', 0),
(682, 43, 'Tarapaca', 'TA', 0),
(683, 43, 'Valparaiso', 'VS', 0),
(684, 44, 'Anhui', 'AN', 0),
(685, 44, 'Beijing', 'BE', 0),
(686, 44, 'Chongqing', 'CH', 0),
(687, 44, 'Fujian', 'FU', 0),
(688, 44, 'Gansu', 'GA', 0),
(689, 44, 'Guangdong', 'GU', 0),
(690, 44, 'Guangxi', 'GX', 0),
(691, 44, 'Guizhou', 'GZ', 0),
(692, 44, 'Hainan', 'HA', 0),
(693, 44, 'Hebei', 'HB', 0),
(694, 44, 'Heilongjiang', 'HL', 0),
(695, 44, 'Henan', 'HE', 0),
(696, 44, 'Hong Kong', 'HK', 0),
(697, 44, 'Hubei', 'HU', 0),
(698, 44, 'Hunan', 'HN', 0),
(699, 44, 'Inner Mongolia', 'IM', 0),
(700, 44, 'Jiangsu', 'JI', 0),
(701, 44, 'Jiangxi', 'JX', 0),
(702, 44, 'Jilin', 'JL', 0),
(703, 44, 'Liaoning', 'LI', 0),
(704, 44, 'Macau', 'MA', 0),
(705, 44, 'Ningxia', 'NI', 0),
(706, 44, 'Shaanxi', 'SH', 0),
(707, 44, 'Shandong', 'SA', 0),
(708, 44, 'Shanghai', 'SG', 0),
(709, 44, 'Shanxi', 'SX', 0),
(710, 44, 'Sichuan', 'SI', 0),
(711, 44, 'Tianjin', 'TI', 0),
(712, 44, 'Xinjiang', 'XI', 0),
(713, 44, 'Yunnan', 'YU', 0),
(714, 44, 'Zhejiang', 'ZH', 0),
(715, 46, 'Direction Island', 'D', 0),
(716, 46, 'Home Island', 'H', 0),
(717, 46, 'Horsburgh Island', 'O', 0),
(718, 46, 'South Island', 'S', 0),
(719, 46, 'West Island', 'W', 0),
(720, 47, 'Amazonas', 'AMZ', 0),
(721, 47, 'Antioquia', 'ANT', 0),
(722, 47, 'Arauca', 'ARA', 0),
(723, 47, 'Atlantico', 'ATL', 0),
(724, 47, 'Bogota D.C.', 'BDC', 0),
(725, 47, 'Bolivar', 'BOL', 0),
(726, 47, 'Boyaca', 'BOY', 0),
(727, 47, 'Caldas', 'CAL', 0),
(728, 47, 'Caqueta', 'CAQ', 0),
(729, 47, 'Casanare', 'CAS', 0),
(730, 47, 'Cauca', 'CAU', 0),
(731, 47, 'Cesar', 'CES', 0),
(732, 47, 'Choco', 'CHO', 0),
(733, 47, 'Cordoba', 'COR', 0),
(734, 47, 'Cundinamarca', 'CAM', 0),
(735, 47, 'Guainia', 'GNA', 0),
(736, 47, 'Guajira', 'GJR', 0),
(737, 47, 'Guaviare', 'GVR', 0),
(738, 47, 'Huila', 'HUI', 0),
(739, 47, 'Magdalena', 'MAG', 0),
(740, 47, 'Meta', 'MET', 0),
(741, 47, 'Narino', 'NAR', 0),
(742, 47, 'Norte de Santander', 'NDS', 0),
(743, 47, 'Putumayo', 'PUT', 0),
(744, 47, 'Quindio', 'QUI', 0),
(745, 47, 'Risaralda', 'RIS', 0),
(746, 47, 'San Andres y Providencia', 'SAP', 0),
(747, 47, 'Santander', 'SAN', 0),
(748, 47, 'Sucre', 'SUC', 0),
(749, 47, 'Tolima', 'TOL', 0),
(750, 47, 'Valle del Cauca', 'VDC', 0),
(751, 47, 'Vaupes', 'VAU', 0),
(752, 47, 'Vichada', 'VIC', 0),
(753, 48, 'Grande Comore', 'G', 0),
(754, 48, 'Anjouan', 'A', 0),
(755, 48, 'Moheli', 'M', 0),
(767, 50, 'Pukapuka', 'PU', 0),
(768, 50, 'Rakahanga', 'RK', 0),
(769, 50, 'Manihiki', 'MK', 0),
(770, 50, 'Penrhyn', 'PE', 0),
(771, 50, 'Nassau Island', 'NI', 0),
(772, 50, 'Surwarrow', 'SU', 0),
(773, 50, 'Palmerston', 'PA', 0),
(774, 50, 'Aitutaki', 'AI', 0),
(775, 50, 'Manuae', 'MA', 0),
(776, 50, 'Takutea', 'TA', 0),
(777, 50, 'Mitiaro', 'MT', 0),
(778, 50, 'Atiu', 'AT', 0),
(779, 50, 'Mauke', 'MU', 0),
(780, 50, 'Rarotonga', 'RR', 0),
(781, 50, 'Mangaia', 'MG', 0),
(782, 51, 'Alajuela', 'AL', 0),
(783, 51, 'Cartago', 'CA', 0),
(784, 51, 'Guanacaste', 'GU', 0),
(785, 51, 'Heredia', 'HE', 0),
(786, 51, 'Limon', 'LI', 0),
(787, 51, 'Puntarenas', 'PU', 0),
(788, 51, 'San Jose', 'SJ', 0),
(889, 56, 'Ústecký', 'U', 0),
(890, 56, 'Jihočeský', 'C', 0),
(891, 56, 'Jihomoravský', 'B', 0),
(892, 56, 'Karlovarský', 'K', 0),
(893, 56, 'Královehradecký', 'H', 0),
(894, 56, 'Liberecký', 'L', 0),
(895, 56, 'Moravskoslezský', 'T', 0),
(896, 56, 'Olomoucký', 'M', 0),
(897, 56, 'Pardubický', 'E', 0),
(898, 56, 'Plzeňský', 'P', 0),
(899, 56, 'Praha', 'A', 0),
(900, 56, 'Středočeský', 'S', 0),
(901, 56, 'Vysočina', 'J', 0),
(902, 56, 'Zlínský', 'Z', 0),
(903, 57, 'Arhus', 'AR', 0),
(904, 57, 'Bornholm', 'BH', 0),
(905, 57, 'Copenhagen', 'CO', 0),
(906, 57, 'Faroe Islands', 'FO', 0),
(907, 57, 'Frederiksborg', 'FR', 0),
(908, 57, 'Fyn', 'FY', 0),
(909, 57, 'Kobenhavn', 'KO', 0),
(910, 57, 'Nordjylland', 'NO', 0),
(911, 57, 'Ribe', 'RI', 0),
(912, 57, 'Ringkobing', 'RK', 0),
(913, 57, 'Roskilde', 'RO', 0),
(914, 57, 'Sonderjylland', 'SO', 0),
(915, 57, 'Storstrom', 'ST', 0),
(916, 57, 'Vejle', 'VK', 0),
(917, 57, 'Vestj&aelig;lland', 'VJ', 0),
(918, 57, 'Viborg', 'VB', 0),
(919, 58, '''Ali Sabih', 'S', 0),
(920, 58, 'Dikhil', 'K', 0),
(921, 58, 'Djibouti', 'J', 0),
(922, 58, 'Obock', 'O', 0),
(923, 58, 'Tadjoura', 'T', 0),
(924, 59, 'Saint Andrew Parish', 'AND', 0),
(925, 59, 'Saint David Parish', 'DAV', 0),
(926, 59, 'Saint George Parish', 'GEO', 0),
(927, 59, 'Saint John Parish', 'JOH', 0),
(928, 59, 'Saint Joseph Parish', 'JOS', 0),
(929, 59, 'Saint Luke Parish', 'LUK', 0),
(930, 59, 'Saint Mark Parish', 'MAR', 0),
(931, 59, 'Saint Patrick Parish', 'PAT', 0),
(932, 59, 'Saint Paul Parish', 'PAU', 0),
(933, 59, 'Saint Peter Parish', 'PET', 0),
(934, 60, 'Distrito Nacional', 'DN', 0),
(935, 60, 'Azua', 'AZ', 0),
(936, 60, 'Baoruco', 'BC', 0),
(937, 60, 'Barahona', 'BH', 0),
(938, 60, 'Dajabon', 'DJ', 0),
(939, 60, 'Duarte', 'DU', 0),
(940, 60, 'Elias Pina', 'EL', 0),
(941, 60, 'El Seybo', 'SY', 0),
(942, 60, 'Espaillat', 'ET', 0),
(943, 60, 'Hato Mayor', 'HM', 0),
(944, 60, 'Independencia', 'IN', 0),
(945, 60, 'La Altagracia', 'AL', 0),
(946, 60, 'La Romana', 'RO', 0),
(947, 60, 'La Vega', 'VE', 0),
(948, 60, 'Maria Trinidad Sanchez', 'MT', 0),
(949, 60, 'Monsenor Nouel', 'MN', 0),
(950, 60, 'Monte Cristi', 'MC', 0),
(951, 60, 'Monte Plata', 'MP', 0),
(952, 60, 'Pedernales', 'PD', 0),
(953, 60, 'Peravia (Bani)', 'PR', 0),
(954, 60, 'Puerto Plata', 'PP', 0),
(955, 60, 'Salcedo', 'SL', 0),
(956, 60, 'Samana', 'SM', 0),
(957, 60, 'Sanchez Ramirez', 'SH', 0),
(958, 60, 'San Cristobal', 'SC', 0),
(959, 60, 'San Jose de Ocoa', 'JO', 0),
(960, 60, 'San Juan', 'SJ', 0),
(961, 60, 'San Pedro de Macoris', 'PM', 0),
(962, 60, 'Santiago', 'SA', 0),
(963, 60, 'Santiago Rodriguez', 'ST', 0),
(964, 60, 'Santo Domingo', 'SD', 0),
(965, 60, 'Valverde', 'VA', 0),
(966, 61, 'Aileu', 'AL', 0),
(967, 61, 'Ainaro', 'AN', 0),
(968, 61, 'Baucau', 'BA', 0),
(969, 61, 'Bobonaro', 'BO', 0),
(970, 61, 'Cova Lima', 'CO', 0),
(971, 61, 'Dili', 'DI', 0),
(972, 61, 'Ermera', 'ER', 0),
(973, 61, 'Lautem', 'LA', 0),
(974, 61, 'Liquica', 'LI', 0),
(975, 61, 'Manatuto', 'MT', 0),
(976, 61, 'Manufahi', 'MF', 0),
(977, 61, 'Oecussi', 'OE', 0),
(978, 61, 'Viqueque', 'VI', 0),
(979, 62, 'Azuay', 'AZU', 0),
(980, 62, 'Bolivar', 'BOL', 0),
(981, 62, 'Ca&ntilde;ar', 'CAN', 0),
(982, 62, 'Carchi', 'CAR', 0),
(983, 62, 'Chimborazo', 'CHI', 0),
(984, 62, 'Cotopaxi', 'COT', 0),
(985, 62, 'El Oro', 'EOR', 0),
(986, 62, 'Esmeraldas', 'ESM', 0),
(987, 62, 'Gal&aacute;pagos', 'GPS', 0),
(988, 62, 'Guayas', 'GUA', 0),
(989, 62, 'Imbabura', 'IMB', 0),
(990, 62, 'Loja', 'LOJ', 0),
(991, 62, 'Los Rios', 'LRO', 0),
(992, 62, 'Manab&iacute;', 'MAN', 0),
(993, 62, 'Morona Santiago', 'MSA', 0),
(994, 62, 'Napo', 'NAP', 0),
(995, 62, 'Orellana', 'ORE', 0),
(996, 62, 'Pastaza', 'PAS', 0),
(997, 62, 'Pichincha', 'PIC', 0),
(998, 62, 'Sucumb&iacute;os', 'SUC', 0),
(999, 62, 'Tungurahua', 'TUN', 0),
(1000, 62, 'Zamora Chinchipe', 'ZCH', 0),
(1001, 63, 'Ad Daqahliyah', 'DHY', 0),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', 0),
(1003, 63, 'Al Buhayrah', 'BHY', 0),
(1004, 63, 'Al Fayyum', 'FYM', 0),
(1005, 63, 'Al Gharbiyah', 'GBY', 0),
(1006, 63, 'Al Iskandariyah', 'IDR', 0),
(1007, 63, 'Al Isma''iliyah', 'IML', 0),
(1008, 63, 'Al Jizah', 'JZH', 0),
(1009, 63, 'Al Minufiyah', 'MFY', 0),
(1010, 63, 'Al Minya', 'MNY', 0),
(1011, 63, 'Al Qahirah', 'QHR', 0),
(1012, 63, 'Al Qalyubiyah', 'QLY', 0),
(1013, 63, 'Al Wadi al Jadid', 'WJD', 0),
(1014, 63, 'Ash Sharqiyah', 'SHQ', 0),
(1015, 63, 'As Suways', 'SWY', 0),
(1016, 63, 'Aswan', 'ASW', 0),
(1017, 63, 'Asyut', 'ASY', 0),
(1018, 63, 'Bani Suwayf', 'BSW', 0),
(1019, 63, 'Bur Sa''id', 'BSD', 0),
(1020, 63, 'Dumyat', 'DMY', 0),
(1021, 63, 'Janub Sina''', 'JNS', 0),
(1022, 63, 'Kafr ash Shaykh', 'KSH', 0),
(1023, 63, 'Matruh', 'MAT', 0),
(1024, 63, 'Qina', 'QIN', 0),
(1025, 63, 'Shamal Sina''', 'SHS', 0),
(1026, 63, 'Suhaj', 'SUH', 0),
(1027, 64, 'Ahuachapan', 'AH', 0),
(1028, 64, 'Cabanas', 'CA', 0),
(1029, 64, 'Chalatenango', 'CH', 0),
(1030, 64, 'Cuscatlan', 'CU', 0),
(1031, 64, 'La Libertad', 'LB', 0),
(1032, 64, 'La Paz', 'PZ', 0),
(1033, 64, 'La Union', 'UN', 0),
(1034, 64, 'Morazan', 'MO', 0),
(1035, 64, 'San Miguel', 'SM', 0),
(1036, 64, 'San Salvador', 'SS', 0),
(1037, 64, 'San Vicente', 'SV', 0),
(1038, 64, 'Santa Ana', 'SA', 0),
(1039, 64, 'Sonsonate', 'SO', 0),
(1040, 64, 'Usulutan', 'US', 0),
(1041, 65, 'Provincia Annobon', 'AN', 0),
(1042, 65, 'Provincia Bioko Norte', 'BN', 0),
(1043, 65, 'Provincia Bioko Sur', 'BS', 0),
(1044, 65, 'Provincia Centro Sur', 'CS', 0),
(1045, 65, 'Provincia Kie-Ntem', 'KN', 0),
(1046, 65, 'Provincia Litoral', 'LI', 0),
(1047, 65, 'Provincia Wele-Nzas', 'WN', 0),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', 0),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', 0),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', 0),
(1057, 67, 'Jarvamaa (Paide)', 'JA', 0),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', 0),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', 0),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', 0),
(1061, 67, 'Parnumaa (Parnu)', 'PA', 0),
(1062, 67, 'Polvamaa (Polva)', 'PO', 0),
(1063, 67, 'Raplamaa (Rapla)', 'RA', 0),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', 0),
(1065, 67, 'Tartumaa (Tartu)', 'TA', 0),
(1066, 67, 'Valgamaa (Valga)', 'VA', 0),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', 0),
(1068, 67, 'Vorumaa (Voru)', 'VO', 0),
(1069, 68, 'Afar', 'AF', 0),
(1070, 68, 'Amhara', 'AH', 0),
(1071, 68, 'Benishangul-Gumaz', 'BG', 0),
(1072, 68, 'Gambela', 'GB', 0),
(1073, 68, 'Hariai', 'HR', 0),
(1074, 68, 'Oromia', 'OR', 0),
(1075, 68, 'Somali', 'SM', 0),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', 0),
(1077, 68, 'Tigray', 'TG', 0),
(1078, 68, 'Addis Ababa', 'AA', 0),
(1079, 68, 'Dire Dawa', 'DD', 0),
(1080, 71, 'Central Division', 'C', 0),
(1081, 71, 'Northern Division', 'N', 0),
(1082, 71, 'Eastern Division', 'E', 0),
(1083, 71, 'Western Division', 'W', 0),
(1084, 71, 'Rotuma', 'R', 0),
(1085, 72, 'Ahvenanmaan Laani', 'AL', 0),
(1086, 72, 'Etela-Suomen Laani', 'ES', 0),
(1087, 72, 'Ita-Suomen Laani', 'IS', 0),
(1088, 72, 'Lansi-Suomen Laani', 'LS', 0),
(1089, 72, 'Lapin Lanani', 'LA', 0),
(1090, 72, 'Oulun Laani', 'OU', 0),
(1114, 74, 'Ain', '01', 0),
(1115, 74, 'Aisne', '02', 0),
(1116, 74, 'Allier', '03', 0),
(1117, 74, 'Alpes de Haute Provence', '04', 0),
(1118, 74, 'Hautes-Alpes', '05', 0),
(1119, 74, 'Alpes Maritimes', '06', 0),
(1120, 74, 'Ard&egrave;che', '07', 0),
(1121, 74, 'Ardennes', '08', 0),
(1122, 74, 'Ari&egrave;ge', '09', 0),
(1123, 74, 'Aube', '10', 0),
(1124, 74, 'Aude', '11', 0),
(1125, 74, 'Aveyron', '12', 0),
(1126, 74, 'Bouches du Rh&ocirc;ne', '13', 0),
(1127, 74, 'Calvados', '14', 0),
(1128, 74, 'Cantal', '15', 0),
(1129, 74, 'Charente', '16', 0),
(1130, 74, 'Charente Maritime', '17', 0),
(1131, 74, 'Cher', '18', 0),
(1132, 74, 'Corr&egrave;ze', '19', 0),
(1133, 74, 'Corse du Sud', '2A', 0),
(1134, 74, 'Haute Corse', '2B', 0),
(1135, 74, 'C&ocirc;te d&#039;or', '21', 0),
(1136, 74, 'C&ocirc;tes d&#039;Armor', '22', 0),
(1137, 74, 'Creuse', '23', 0),
(1138, 74, 'Dordogne', '24', 0),
(1139, 74, 'Doubs', '25', 0),
(1140, 74, 'Dr&ocirc;me', '26', 0),
(1141, 74, 'Eure', '27', 0),
(1142, 74, 'Eure et Loir', '28', 0),
(1143, 74, 'Finist&egrave;re', '29', 0),
(1144, 74, 'Gard', '30', 0),
(1145, 74, 'Haute Garonne', '31', 0),
(1146, 74, 'Gers', '32', 0),
(1147, 74, 'Gironde', '33', 0),
(1148, 74, 'H&eacute;rault', '34', 0),
(1149, 74, 'Ille et Vilaine', '35', 0),
(1150, 74, 'Indre', '36', 0),
(1151, 74, 'Indre et Loire', '37', 0),
(1152, 74, 'Is&eacute;re', '38', 0),
(1153, 74, 'Jura', '39', 0),
(1154, 74, 'Landes', '40', 0),
(1155, 74, 'Loir et Cher', '41', 0),
(1156, 74, 'Loire', '42', 0),
(1157, 74, 'Haute Loire', '43', 0),
(1158, 74, 'Loire Atlantique', '44', 0),
(1159, 74, 'Loiret', '45', 0),
(1160, 74, 'Lot', '46', 0),
(1161, 74, 'Lot et Garonne', '47', 0),
(1162, 74, 'Loz&egrave;re', '48', 0),
(1163, 74, 'Maine et Loire', '49', 0),
(1164, 74, 'Manche', '50', 0),
(1165, 74, 'Marne', '51', 0),
(1166, 74, 'Haute Marne', '52', 0),
(1167, 74, 'Mayenne', '53', 0),
(1168, 74, 'Meurthe et Moselle', '54', 0),
(1169, 74, 'Meuse', '55', 0),
(1170, 74, 'Morbihan', '56', 0),
(1171, 74, 'Moselle', '57', 0),
(1172, 74, 'Ni&egrave;vre', '58', 0),
(1173, 74, 'Nord', '59', 0),
(1174, 74, 'Oise', '60', 0),
(1175, 74, 'Orne', '61', 0),
(1176, 74, 'Pas de Calais', '62', 0),
(1177, 74, 'Puy de D&ocirc;me', '63', 0),
(1178, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', 0),
(1179, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', 0),
(1180, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', 0),
(1181, 74, 'Bas Rhin', '67', 0),
(1182, 74, 'Haut Rhin', '68', 0),
(1183, 74, 'Rh&ocirc;ne', '69', 0),
(1184, 74, 'Haute Sa&ocirc;ne', '70', 0),
(1185, 74, 'Sa&ocirc;ne et Loire', '71', 0),
(1186, 74, 'Sarthe', '72', 0),
(1187, 74, 'Savoie', '73', 0),
(1188, 74, 'Haute Savoie', '74', 0),
(1189, 74, 'Paris', '75', 0),
(1190, 74, 'Seine Maritime', '76', 0),
(1191, 74, 'Seine et Marne', '77', 0),
(1192, 74, 'Yvelines', '78', 0),
(1193, 74, 'Deux S&egrave;vres', '79', 0),
(1194, 74, 'Somme', '80', 0),
(1195, 74, 'Tarn', '81', 0),
(1196, 74, 'Tarn et Garonne', '82', 0),
(1197, 74, 'Var', '83', 0),
(1198, 74, 'Vaucluse', '84', 0),
(1199, 74, 'Vend&eacute;e', '85', 0),
(1200, 74, 'Vienne', '86', 0),
(1201, 74, 'Haute Vienne', '87', 0),
(1202, 74, 'Vosges', '88', 0),
(1203, 74, 'Yonne', '89', 0),
(1204, 74, 'Territoire de Belfort', '90', 0),
(1205, 74, 'Essonne', '91', 0),
(1206, 74, 'Hauts de Seine', '92', 0),
(1207, 74, 'Seine St-Denis', '93', 0),
(1208, 74, 'Val de Marne', '94', 0),
(1209, 74, 'Val d''Oise', '95', 0),
(1210, 76, 'Archipel des Marquises', 'M', 0),
(1211, 76, 'Archipel des Tuamotu', 'T', 0),
(1212, 76, 'Archipel des Tubuai', 'I', 0),
(1213, 76, 'Iles du Vent', 'V', 0),
(1214, 76, 'Iles Sous-le-Vent', 'S', 0),
(1215, 77, 'Iles Crozet', 'C', 0),
(1216, 77, 'Iles Kerguelen', 'K', 0),
(1217, 77, 'Ile Amsterdam', 'A', 0),
(1218, 77, 'Ile Saint-Paul', 'P', 0),
(1219, 77, 'Adelie Land', 'D', 0),
(1220, 78, 'Estuaire', 'ES', 0),
(1221, 78, 'Haut-Ogooue', 'HO', 0),
(1222, 78, 'Moyen-Ogooue', 'MO', 0),
(1223, 78, 'Ngounie', 'NG', 0),
(1224, 78, 'Nyanga', 'NY', 0),
(1225, 78, 'Ogooue-Ivindo', 'OI', 0),
(1226, 78, 'Ogooue-Lolo', 'OL', 0),
(1227, 78, 'Ogooue-Maritime', 'OM', 0),
(1228, 78, 'Woleu-Ntem', 'WN', 0),
(1229, 79, 'Banjul', 'BJ', 0),
(1230, 79, 'Basse', 'BS', 0),
(1231, 79, 'Brikama', 'BR', 0),
(1232, 79, 'Janjangbure', 'JA', 0),
(1233, 79, 'Kanifeng', 'KA', 0),
(1234, 79, 'Kerewan', 'KE', 0),
(1235, 79, 'Kuntaur', 'KU', 0),
(1236, 79, 'Mansakonko', 'MA', 0),
(1237, 79, 'Lower River', 'LR', 0),
(1238, 79, 'Central River', 'CR', 0),
(1239, 79, 'North Bank', 'NB', 0),
(1240, 79, 'Upper River', 'UR', 0),
(1241, 79, 'Western', 'WE', 0),
(1242, 80, 'Abkhazia', 'AB', 0),
(1243, 80, 'Ajaria', 'AJ', 0),
(1244, 80, 'Tbilisi', 'TB', 0),
(1245, 80, 'Guria', 'GU', 0),
(1246, 80, 'Imereti', 'IM', 0),
(1247, 80, 'Kakheti', 'KA', 0),
(1248, 80, 'Kvemo Kartli', 'KK', 0),
(1249, 80, 'Mtskheta-Mtianeti', 'MM', 0),
(1250, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 0),
(1251, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 0),
(1252, 80, 'Samtskhe-Javakheti', 'SJ', 0),
(1253, 80, 'Shida Kartli', 'SK', 0),
(1254, 81, 'Baden-W&uuml;rttemberg', 'BAW', 0),
(1255, 81, 'Bayern', 'BAY', 0),
(1256, 81, 'Berlin', 'BER', 0),
(1257, 81, 'Brandenburg', 'BRG', 0),
(1258, 81, 'Bremen', 'BRE', 0),
(1259, 81, 'Hamburg', 'HAM', 0),
(1260, 81, 'Hessen', 'HES', 0),
(1261, 81, 'Mecklenburg-Vorpommern', 'MEC', 0),
(1262, 81, 'Niedersachsen', 'NDS', 0),
(1263, 81, 'Nordrhein-Westfalen', 'NRW', 0),
(1264, 81, 'Rheinland-Pfalz', 'RHE', 0),
(1265, 81, 'Saarland', 'SAR', 0),
(1266, 81, 'Sachsen', 'SAS', 0),
(1267, 81, 'Sachsen-Anhalt', 'SAC', 0),
(1268, 81, 'Schleswig-Holstein', 'SCN', 0),
(1269, 81, 'Th&uuml;ringen', 'THE', 0),
(1270, 82, 'Ashanti Region', 'AS', 0),
(1271, 82, 'Brong-Ahafo Region', 'BA', 0),
(1272, 82, 'Central Region', 'CE', 0),
(1273, 82, 'Eastern Region', 'EA', 0),
(1274, 82, 'Greater Accra Region', 'GA', 0),
(1275, 82, 'Northern Region', 'NO', 0),
(1276, 82, 'Upper East Region', 'UE', 0),
(1277, 82, 'Upper West Region', 'UW', 0),
(1278, 82, 'Volta Region', 'VO', 0),
(1279, 82, 'Western Region', 'WE', 0),
(1280, 84, 'Attica', 'AT', 0),
(1281, 84, 'Central Greece', 'CN', 0),
(1282, 84, 'Central Macedonia', 'CM', 0),
(1283, 84, 'Crete', 'CR', 0),
(1284, 84, 'East Macedonia and Thrace', 'EM', 0),
(1285, 84, 'Epirus', 'EP', 0),
(1286, 84, 'Ionian Islands', 'II', 0),
(1287, 84, 'North Aegean', 'NA', 0),
(1288, 84, 'Peloponnesos', 'PP', 0),
(1289, 84, 'South Aegean', 'SA', 0),
(1290, 84, 'Thessaly', 'TH', 0),
(1291, 84, 'West Greece', 'WG', 0),
(1292, 84, 'West Macedonia', 'WM', 0),
(1293, 85, 'Avannaa', 'A', 0),
(1294, 85, 'Tunu', 'T', 0),
(1295, 85, 'Kitaa', 'K', 0),
(1296, 86, 'Saint Andrew', 'A', 0),
(1297, 86, 'Saint David', 'D', 0),
(1298, 86, 'Saint George', 'G', 0),
(1299, 86, 'Saint John', 'J', 0),
(1300, 86, 'Saint Mark', 'M', 0),
(1301, 86, 'Saint Patrick', 'P', 0),
(1302, 86, 'Carriacou', 'C', 0),
(1303, 86, 'Petit Martinique', 'Q', 0),
(1304, 89, 'Alta Verapaz', 'AV', 0),
(1305, 89, 'Baja Verapaz', 'BV', 0),
(1306, 89, 'Chimaltenango', 'CM', 0),
(1307, 89, 'Chiquimula', 'CQ', 0),
(1308, 89, 'El Peten', 'PE', 0),
(1309, 89, 'El Progreso', 'PR', 0),
(1310, 89, 'El Quiche', 'QC', 0),
(1311, 89, 'Escuintla', 'ES', 0),
(1312, 89, 'Guatemala', 'GU', 0),
(1313, 89, 'Huehuetenango', 'HU', 0),
(1314, 89, 'Izabal', 'IZ', 0),
(1315, 89, 'Jalapa', 'JA', 0),
(1316, 89, 'Jutiapa', 'JU', 0),
(1317, 89, 'Quetzaltenango', 'QZ', 0),
(1318, 89, 'Retalhuleu', 'RE', 0),
(1319, 89, 'Sacatepequez', 'ST', 0),
(1320, 89, 'San Marcos', 'SM', 0),
(1321, 89, 'Santa Rosa', 'SR', 0),
(1322, 89, 'Solola', 'SO', 0),
(1323, 89, 'Suchitepequez', 'SU', 0),
(1324, 89, 'Totonicapan', 'TO', 0),
(1325, 89, 'Zacapa', 'ZA', 0),
(1326, 90, 'Conakry', 'CNK', 0),
(1327, 90, 'Beyla', 'BYL', 0),
(1328, 90, 'Boffa', 'BFA', 0),
(1329, 90, 'Boke', 'BOK', 0),
(1330, 90, 'Coyah', 'COY', 0),
(1331, 90, 'Dabola', 'DBL', 0),
(1332, 90, 'Dalaba', 'DLB', 0),
(1333, 90, 'Dinguiraye', 'DGR', 0),
(1334, 90, 'Dubreka', 'DBR', 0),
(1335, 90, 'Faranah', 'FRN', 0),
(1336, 90, 'Forecariah', 'FRC', 0),
(1337, 90, 'Fria', 'FRI', 0),
(1338, 90, 'Gaoual', 'GAO', 0),
(1339, 90, 'Gueckedou', 'GCD', 0),
(1340, 90, 'Kankan', 'KNK', 0),
(1341, 90, 'Kerouane', 'KRN', 0),
(1342, 90, 'Kindia', 'KND', 0),
(1343, 90, 'Kissidougou', 'KSD', 0),
(1344, 90, 'Koubia', 'KBA', 0),
(1345, 90, 'Koundara', 'KDA', 0),
(1346, 90, 'Kouroussa', 'KRA', 0),
(1347, 90, 'Labe', 'LAB', 0),
(1348, 90, 'Lelouma', 'LLM', 0),
(1349, 90, 'Lola', 'LOL', 0),
(1350, 90, 'Macenta', 'MCT', 0),
(1351, 90, 'Mali', 'MAL', 0),
(1352, 90, 'Mamou', 'MAM', 0),
(1353, 90, 'Mandiana', 'MAN', 0),
(1354, 90, 'Nzerekore', 'NZR', 0),
(1355, 90, 'Pita', 'PIT', 0),
(1356, 90, 'Siguiri', 'SIG', 0),
(1357, 90, 'Telimele', 'TLM', 0),
(1358, 90, 'Tougue', 'TOG', 0),
(1359, 90, 'Yomou', 'YOM', 0),
(1360, 91, 'Bafata Region', 'BF', 0),
(1361, 91, 'Biombo Region', 'BB', 0),
(1362, 91, 'Bissau Region', 'BS', 0),
(1363, 91, 'Bolama Region', 'BL', 0),
(1364, 91, 'Cacheu Region', 'CA', 0),
(1365, 91, 'Gabu Region', 'GA', 0),
(1366, 91, 'Oio Region', 'OI', 0),
(1367, 91, 'Quinara Region', 'QU', 0),
(1368, 91, 'Tombali Region', 'TO', 0),
(1369, 92, 'Barima-Waini', 'BW', 0),
(1370, 92, 'Cuyuni-Mazaruni', 'CM', 0),
(1371, 92, 'Demerara-Mahaica', 'DM', 0),
(1372, 92, 'East Berbice-Corentyne', 'EC', 0),
(1373, 92, 'Essequibo Islands-West Demerara', 'EW', 0),
(1374, 92, 'Mahaica-Berbice', 'MB', 0),
(1375, 92, 'Pomeroon-Supenaam', 'PM', 0),
(1376, 92, 'Potaro-Siparuni', 'PI', 0),
(1377, 92, 'Upper Demerara-Berbice', 'UD', 0),
(1378, 92, 'Upper Takutu-Upper Essequibo', 'UT', 0),
(1379, 93, 'Artibonite', 'AR', 0),
(1380, 93, 'Centre', 'CE', 0),
(1381, 93, 'Grand''Anse', 'GA', 0),
(1382, 93, 'Nord', 'ND', 0),
(1383, 93, 'Nord-Est', 'NE', 0),
(1384, 93, 'Nord-Ouest', 'NO', 0),
(1385, 93, 'Ouest', 'OU', 0),
(1386, 93, 'Sud', 'SD', 0),
(1387, 93, 'Sud-Est', 'SE', 0),
(1388, 94, 'Flat Island', 'F', 0),
(1389, 94, 'McDonald Island', 'M', 0),
(1390, 94, 'Shag Island', 'S', 0),
(1391, 94, 'Heard Island', 'H', 0),
(1392, 95, 'Atlantida', 'AT', 0),
(1393, 95, 'Choluteca', 'CH', 0),
(1394, 95, 'Colon', 'CL', 0),
(1395, 95, 'Comayagua', 'CM', 0),
(1396, 95, 'Copan', 'CP', 0),
(1397, 95, 'Cortes', 'CR', 0),
(1398, 95, 'El Paraiso', 'PA', 0),
(1399, 95, 'Francisco Morazan', 'FM', 0),
(1400, 95, 'Gracias a Dios', 'GD', 0),
(1401, 95, 'Intibuca', 'IN', 0),
(1402, 95, 'Islas de la Bahia (Bay Islands)', 'IB', 0),
(1403, 95, 'La Paz', 'PZ', 0),
(1404, 95, 'Lempira', 'LE', 0),
(1405, 95, 'Ocotepeque', 'OC', 0),
(1406, 95, 'Olancho', 'OL', 0),
(1407, 95, 'Santa Barbara', 'SB', 0),
(1408, 95, 'Valle', 'VA', 0),
(1409, 95, 'Yoro', 'YO', 0),
(1410, 96, 'Central and Western Hong Kong Island', 'HCW', 0),
(1411, 96, 'Eastern Hong Kong Island', 'HEA', 0),
(1412, 96, 'Southern Hong Kong Island', 'HSO', 0),
(1413, 96, 'Wan Chai Hong Kong Island', 'HWC', 0),
(1414, 96, 'Kowloon City Kowloon', 'KKC', 0),
(1415, 96, 'Kwun Tong Kowloon', 'KKT', 0),
(1416, 96, 'Sham Shui Po Kowloon', 'KSS', 0),
(1417, 96, 'Wong Tai Sin Kowloon', 'KWT', 0),
(1418, 96, 'Yau Tsim Mong Kowloon', 'KYT', 0),
(1419, 96, 'Islands New Territories', 'NIS', 0),
(1420, 96, 'Kwai Tsing New Territories', 'NKT', 0),
(1421, 96, 'North New Territories', 'NNO', 0),
(1422, 96, 'Sai Kung New Territories', 'NSK', 0),
(1423, 96, 'Sha Tin New Territories', 'NST', 0),
(1424, 96, 'Tai Po New Territories', 'NTP', 0),
(1425, 96, 'Tsuen Wan New Territories', 'NTW', 0),
(1426, 96, 'Tuen Mun New Territories', 'NTM', 0),
(1427, 96, 'Yuen Long New Territories', 'NYL', 0),
(1428, 97, 'Bacs-Kiskun', 'BK', 0),
(1429, 97, 'Baranya', 'BA', 0),
(1430, 97, 'Bekes', 'BE', 0),
(1431, 97, 'Bekescsaba', 'BS', 0),
(1432, 97, 'Borsod-Abauj-Zemplen', 'BZ', 0),
(1433, 97, 'Budapest', 'BU', 0),
(1434, 97, 'Csongrad', 'CS', 0),
(1435, 97, 'Debrecen', 'DE', 0),
(1436, 97, 'Dunaujvaros', 'DU', 0),
(1437, 97, 'Eger', 'EG', 0),
(1438, 97, 'Fejer', 'FE', 0),
(1439, 97, 'Gyor', 'GY', 0),
(1440, 97, 'Gyor-Moson-Sopron', 'GM', 0),
(1441, 97, 'Hajdu-Bihar', 'HB', 0),
(1442, 97, 'Heves', 'HE', 0),
(1443, 97, 'Hodmezovasarhely', 'HO', 0),
(1444, 97, 'Jasz-Nagykun-Szolnok', 'JN', 0),
(1445, 97, 'Kaposvar', 'KA', 0),
(1446, 97, 'Kecskemet', 'KE', 0),
(1447, 97, 'Komarom-Esztergom', 'KO', 0),
(1448, 97, 'Miskolc', 'MI', 0),
(1449, 97, 'Nagykanizsa', 'NA', 0),
(1450, 97, 'Nograd', 'NO', 0),
(1451, 97, 'Nyiregyhaza', 'NY', 0),
(1452, 97, 'Pecs', 'PE', 0),
(1453, 97, 'Pest', 'PS', 0),
(1454, 97, 'Somogy', 'SO', 0),
(1455, 97, 'Sopron', 'SP', 0),
(1456, 97, 'Szabolcs-Szatmar-Bereg', 'SS', 0),
(1457, 97, 'Szeged', 'SZ', 0),
(1458, 97, 'Szekesfehervar', 'SE', 0),
(1459, 97, 'Szolnok', 'SL', 0),
(1460, 97, 'Szombathely', 'SM', 0),
(1461, 97, 'Tatabanya', 'TA', 0),
(1462, 97, 'Tolna', 'TO', 0),
(1463, 97, 'Vas', 'VA', 0),
(1464, 97, 'Veszprem', 'VE', 0),
(1465, 97, 'Zala', 'ZA', 0),
(1466, 97, 'Zalaegerszeg', 'ZZ', 0),
(1467, 98, 'Austurland', 'AL', 0),
(1468, 98, 'Hofuoborgarsvaeoi', 'HF', 0),
(1469, 98, 'Norourland eystra', 'NE', 0),
(1470, 98, 'Norourland vestra', 'NV', 0),
(1471, 98, 'Suourland', 'SL', 0),
(1472, 98, 'Suournes', 'SN', 0),
(1473, 98, 'Vestfiroir', 'VF', 0),
(1474, 98, 'Vesturland', 'VL', 0),
(1475, 99, 'Andaman and Nicobar Islands', 'AN', 0),
(1476, 99, 'Andhra Pradesh', 'AP', 0),
(1477, 99, 'Arunachal Pradesh', 'AR', 0),
(1478, 99, 'Assam', 'AS', 0),
(1479, 99, 'Bihar', 'BI', 0),
(1480, 99, 'Chandigarh', 'CH', 0),
(1481, 99, 'Dadra and Nagar Haveli', 'DA', 0),
(1482, 99, 'Daman and Diu', 'DM', 0),
(1483, 99, 'Delhi', 'DE', 0),
(1484, 99, 'Goa', 'GO', 0),
(1485, 99, 'Gujarat', 'GU', 0),
(1486, 99, 'Haryana', 'HA', 0),
(1487, 99, 'Himachal Pradesh', 'HP', 0),
(1488, 99, 'Jammu and Kashmir', 'JA', 0),
(1489, 99, 'Karnataka', 'KA', 0),
(1490, 99, 'Kerala', 'KE', 0),
(1491, 99, 'Lakshadweep Islands', 'LI', 0),
(1492, 99, 'Madhya Pradesh', 'MP', 0),
(1493, 99, 'Maharashtra', 'MA', 0),
(1494, 99, 'Manipur', 'MN', 0),
(1495, 99, 'Meghalaya', 'ME', 0),
(1496, 99, 'Mizoram', 'MI', 0),
(1497, 99, 'Nagaland', 'NA', 0),
(1498, 99, 'Orissa', 'OR', 0),
(1499, 99, 'Pondicherry', 'PO', 0),
(1500, 99, 'Punjab', 'PU', 0),
(1501, 99, 'Rajasthan', 'RA', 0),
(1502, 99, 'Sikkim', 'SI', 0),
(1503, 99, 'Tamil Nadu', 'TN', 0),
(1504, 99, 'Tripura', 'TR', 0),
(1505, 99, 'Uttar Pradesh', 'UP', 0),
(1506, 99, 'West Bengal', 'WB', 0),
(1507, 100, 'Aceh', 'AC', 0),
(1508, 100, 'Bali', 'BA', 0),
(1509, 100, 'Banten', 'BT', 0),
(1510, 100, 'Bengkulu', 'BE', 0),
(1511, 100, 'BoDeTaBek', 'BD', 0),
(1512, 100, 'Gorontalo', 'GO', 0),
(1513, 100, 'Jakarta Raya', 'JK', 0),
(1514, 100, 'Jambi', 'JA', 0),
(1515, 100, 'Jawa Barat', 'JB', 0),
(1516, 100, 'Jawa Tengah', 'JT', 0),
(1517, 100, 'Jawa Timur', 'JI', 0),
(1518, 100, 'Kalimantan Barat', 'KB', 0),
(1519, 100, 'Kalimantan Selatan', 'KS', 0),
(1520, 100, 'Kalimantan Tengah', 'KT', 0),
(1521, 100, 'Kalimantan Timur', 'KI', 0),
(1522, 100, 'Kepulauan Bangka Belitung', 'BB', 0),
(1523, 100, 'Lampung', 'LA', 0),
(1524, 100, 'Maluku', 'MA', 0),
(1525, 100, 'Maluku Utara', 'MU', 0),
(1526, 100, 'Nusa Tenggara Barat', 'NB', 0),
(1527, 100, 'Nusa Tenggara Timur', 'NT', 0),
(1528, 100, 'Papua', 'PA', 0),
(1529, 100, 'Riau', 'RI', 0),
(1530, 100, 'Sulawesi Selatan', 'SN', 0),
(1531, 100, 'Sulawesi Tengah', 'ST', 0),
(1532, 100, 'Sulawesi Tenggara', 'SG', 0),
(1533, 100, 'Sulawesi Utara', 'SA', 0),
(1534, 100, 'Sumatera Barat', 'SB', 0),
(1535, 100, 'Sumatera Selatan', 'SS', 0),
(1536, 100, 'Sumatera Utara', 'SU', 0),
(1537, 100, 'Yogyakarta', 'YO', 0),
(1586, 103, 'Carlow', 'CA', 0),
(1587, 103, 'Cavan', 'CV', 0),
(1588, 103, 'Clare', 'CL', 0),
(1589, 103, 'Cork', 'CO', 0),
(1590, 103, 'Donegal', 'DO', 0),
(1591, 103, 'Dublin', 'DU', 0),
(1592, 103, 'Galway', 'GA', 0),
(1593, 103, 'Kerry', 'KE', 0),
(1594, 103, 'Kildare', 'KI', 0),
(1595, 103, 'Kilkenny', 'KL', 0),
(1596, 103, 'Laois', 'LA', 0),
(1597, 103, 'Leitrim', 'LE', 0),
(1598, 103, 'Limerick', 'LI', 0),
(1599, 103, 'Longford', 'LO', 0),
(1600, 103, 'Louth', 'LU', 0),
(1601, 103, 'Mayo', 'MA', 0),
(1602, 103, 'Meath', 'ME', 0),
(1603, 103, 'Monaghan', 'MO', 0),
(1604, 103, 'Offaly', 'OF', 0),
(1605, 103, 'Roscommon', 'RO', 0),
(1606, 103, 'Sligo', 'SL', 0),
(1607, 103, 'Tipperary', 'TI', 0),
(1608, 103, 'Waterford', 'WA', 0),
(1609, 103, 'Westmeath', 'WE', 0),
(1610, 103, 'Wexford', 'WX', 0),
(1611, 103, 'Wicklow', 'WI', 0),
(1612, 104, 'Be''er Sheva', 'BS', 0),
(1613, 104, 'Bika''at Hayarden', 'BH', 0),
(1614, 104, 'Eilat and Arava', 'EA', 0),
(1615, 104, 'Galil', 'GA', 0),
(1616, 104, 'Haifa', 'HA', 0),
(1617, 104, 'Jehuda Mountains', 'JM', 0),
(1618, 104, 'Jerusalem', 'JE', 0),
(1619, 104, 'Negev', 'NE', 0),
(1620, 104, 'Semaria', 'SE', 0),
(1621, 104, 'Sharon', 'SH', 0),
(1622, 104, 'Tel Aviv (Gosh Dan)', 'TA', 0),
(1643, 106, 'Clarendon Parish', 'CLA', 0),
(1644, 106, 'Hanover Parish', 'HAN', 0),
(1645, 106, 'Kingston Parish', 'KIN', 0),
(1646, 106, 'Manchester Parish', 'MAN', 0),
(1647, 106, 'Portland Parish', 'POR', 0),
(1648, 106, 'Saint Andrew Parish', 'AND', 0),
(1649, 106, 'Saint Ann Parish', 'ANN', 0),
(1650, 106, 'Saint Catherine Parish', 'CAT', 0),
(1651, 106, 'Saint Elizabeth Parish', 'ELI', 0),
(1652, 106, 'Saint James Parish', 'JAM', 0),
(1653, 106, 'Saint Mary Parish', 'MAR', 0),
(1654, 106, 'Saint Thomas Parish', 'THO', 0),
(1655, 106, 'Trelawny Parish', 'TRL', 0),
(1656, 106, 'Westmoreland Parish', 'WML', 0),
(1657, 107, 'Aichi', 'AI', 0),
(1658, 107, 'Akita', 'AK', 0),
(1659, 107, 'Aomori', 'AO', 0),
(1660, 107, 'Chiba', 'CH', 0),
(1661, 107, 'Ehime', 'EH', 0),
(1662, 107, 'Fukui', 'FK', 0),
(1663, 107, 'Fukuoka', 'FU', 0),
(1664, 107, 'Fukushima', 'FS', 0),
(1665, 107, 'Gifu', 'GI', 0),
(1666, 107, 'Gumma', 'GU', 0),
(1667, 107, 'Hiroshima', 'HI', 0),
(1668, 107, 'Hokkaido', 'HO', 0),
(1669, 107, 'Hyogo', 'HY', 0),
(1670, 107, 'Ibaraki', 'IB', 0),
(1671, 107, 'Ishikawa', 'IS', 0),
(1672, 107, 'Iwate', 'IW', 0),
(1673, 107, 'Kagawa', 'KA', 0),
(1674, 107, 'Kagoshima', 'KG', 0),
(1675, 107, 'Kanagawa', 'KN', 0),
(1676, 107, 'Kochi', 'KO', 0),
(1677, 107, 'Kumamoto', 'KU', 0),
(1678, 107, 'Kyoto', 'KY', 0),
(1679, 107, 'Mie', 'MI', 0),
(1680, 107, 'Miyagi', 'MY', 0),
(1681, 107, 'Miyazaki', 'MZ', 0),
(1682, 107, 'Nagano', 'NA', 0),
(1683, 107, 'Nagasaki', 'NG', 0),
(1684, 107, 'Nara', 'NR', 0),
(1685, 107, 'Niigata', 'NI', 0),
(1686, 107, 'Oita', 'OI', 0),
(1687, 107, 'Okayama', 'OK', 0),
(1688, 107, 'Okinawa', 'ON', 0),
(1689, 107, 'Osaka', 'OS', 0),
(1690, 107, 'Saga', 'SA', 0),
(1691, 107, 'Saitama', 'SI', 0),
(1692, 107, 'Shiga', 'SH', 0),
(1693, 107, 'Shimane', 'SM', 0),
(1694, 107, 'Shizuoka', 'SZ', 0),
(1695, 107, 'Tochigi', 'TO', 0),
(1696, 107, 'Tokushima', 'TS', 0),
(1697, 107, 'Tokyo', 'TK', 0),
(1698, 107, 'Tottori', 'TT', 0),
(1699, 107, 'Toyama', 'TY', 0),
(1700, 107, 'Wakayama', 'WA', 0),
(1701, 107, 'Yamagata', 'YA', 0),
(1702, 107, 'Yamaguchi', 'YM', 0),
(1703, 107, 'Yamanashi', 'YN', 0),
(1704, 108, '''Amman', 'AM', 0),
(1705, 108, 'Ajlun', 'AJ', 0),
(1706, 108, 'Al ''Aqabah', 'AA', 0),
(1707, 108, 'Al Balqa''', 'AB', 0),
(1708, 108, 'Al Karak', 'AK', 0),
(1709, 108, 'Al Mafraq', 'AL', 0),
(1710, 108, 'At Tafilah', 'AT', 0),
(1711, 108, 'Az Zarqa''', 'AZ', 0),
(1712, 108, 'Irbid', 'IR', 0),
(1713, 108, 'Jarash', 'JA', 0),
(1714, 108, 'Ma''an', 'MA', 0),
(1715, 108, 'Madaba', 'MD', 0),
(1716, 109, 'Almaty', 'AL', 0),
(1717, 109, 'Almaty City', 'AC', 0),
(1718, 109, 'Aqmola', 'AM', 0),
(1719, 109, 'Aqtobe', 'AQ', 0),
(1720, 109, 'Astana City', 'AS', 0),
(1721, 109, 'Atyrau', 'AT', 0),
(1722, 109, 'Batys Qazaqstan', 'BA', 0),
(1723, 109, 'Bayqongyr City', 'BY', 0),
(1724, 109, 'Mangghystau', 'MA', 0),
(1725, 109, 'Ongtustik Qazaqstan', 'ON', 0),
(1726, 109, 'Pavlodar', 'PA', 0),
(1727, 109, 'Qaraghandy', 'QA', 0),
(1728, 109, 'Qostanay', 'QO', 0),
(1729, 109, 'Qyzylorda', 'QY', 0),
(1730, 109, 'Shyghys Qazaqstan', 'SH', 0),
(1731, 109, 'Soltustik Qazaqstan', 'SO', 0),
(1732, 109, 'Zhambyl', 'ZH', 0),
(1733, 110, 'Central', 'CE', 0),
(1734, 110, 'Coast', 'CO', 0),
(1735, 110, 'Eastern', 'EA', 0),
(1736, 110, 'Nairobi Area', 'NA', 0),
(1737, 110, 'North Eastern', 'NE', 0),
(1738, 110, 'Nyanza', 'NY', 0),
(1739, 110, 'Rift Valley', 'RV', 0),
(1740, 110, 'Western', 'WE', 0),
(1741, 111, 'Abaiang', 'AG', 0),
(1742, 111, 'Abemama', 'AM', 0),
(1743, 111, 'Aranuka', 'AK', 0),
(1744, 111, 'Arorae', 'AO', 0),
(1745, 111, 'Banaba', 'BA', 0),
(1746, 111, 'Beru', 'BE', 0),
(1747, 111, 'Butaritari', 'bT', 0),
(1748, 111, 'Kanton', 'KA', 0),
(1749, 111, 'Kiritimati', 'KR', 0),
(1750, 111, 'Kuria', 'KU', 0),
(1751, 111, 'Maiana', 'MI', 0),
(1752, 111, 'Makin', 'MN', 0),
(1753, 111, 'Marakei', 'ME', 0),
(1754, 111, 'Nikunau', 'NI', 0),
(1755, 111, 'Nonouti', 'NO', 0),
(1756, 111, 'Onotoa', 'ON', 0),
(1757, 111, 'Tabiteuea', 'TT', 0),
(1758, 111, 'Tabuaeran', 'TR', 0),
(1759, 111, 'Tamana', 'TM', 0),
(1760, 111, 'Tarawa', 'TW', 0),
(1761, 111, 'Teraina', 'TE', 0),
(1773, 113, 'Ch''ungch''ong-bukto', 'CO', 0),
(1774, 113, 'Ch''ungch''ong-namdo', 'CH', 0),
(1775, 113, 'Cheju-do', 'CD', 0),
(1776, 113, 'Cholla-bukto', 'CB', 0),
(1777, 113, 'Cholla-namdo', 'CN', 0),
(1778, 113, 'Inch''on-gwangyoksi', 'IG', 0),
(1779, 113, 'Kangwon-do', 'KA', 0),
(1780, 113, 'Kwangju-gwangyoksi', 'KG', 0),
(1781, 113, 'Kyonggi-do', 'KD', 0),
(1782, 113, 'Kyongsang-bukto', 'KB', 0),
(1783, 113, 'Kyongsang-namdo', 'KN', 0),
(1784, 113, 'Pusan-gwangyoksi', 'PG', 0),
(1785, 113, 'Soul-t''ukpyolsi', 'SO', 0),
(1786, 113, 'Taegu-gwangyoksi', 'TA', 0),
(1787, 113, 'Taejon-gwangyoksi', 'TG', 0),
(1788, 114, 'Al ''Asimah', 'AL', 0),
(1789, 114, 'Al Ahmadi', 'AA', 0),
(1790, 114, 'Al Farwaniyah', 'AF', 0),
(1791, 114, 'Al Jahra''', 'AJ', 0),
(1792, 114, 'Hawalli', 'HA', 0),
(1793, 115, 'Bishkek', 'GB', 0),
(1794, 115, 'Batken', 'B', 0),
(1795, 115, 'Chu', 'C', 0),
(1796, 115, 'Jalal-Abad', 'J', 0),
(1797, 115, 'Naryn', 'N', 0),
(1798, 115, 'Osh', 'O', 0),
(1799, 115, 'Talas', 'T', 0),
(1800, 115, 'Ysyk-Kol', 'Y', 0),
(1801, 116, 'Vientiane', 'VT', 0),
(1802, 116, 'Attapu', 'AT', 0),
(1803, 116, 'Bokeo', 'BK', 0),
(1804, 116, 'Bolikhamxai', 'BL', 0),
(1805, 116, 'Champasak', 'CH', 0),
(1806, 116, 'Houaphan', 'HO', 0),
(1807, 116, 'Khammouan', 'KH', 0),
(1808, 116, 'Louang Namtha', 'LM', 0),
(1809, 116, 'Louangphabang', 'LP', 0),
(1810, 116, 'Oudomxai', 'OU', 0),
(1811, 116, 'Phongsali', 'PH', 0),
(1812, 116, 'Salavan', 'SL', 0),
(1813, 116, 'Savannakhet', 'SV', 0),
(1814, 116, 'Vientiane', 'VI', 0),
(1815, 116, 'Xaignabouli', 'XA', 0),
(1816, 116, 'Xekong', 'XE', 0),
(1817, 116, 'Xiangkhoang', 'XI', 0),
(1818, 116, 'Xaisomboun', 'XN', 0),
(1819, 117, 'Aizkraukles Rajons', 'AIZ', 0),
(1820, 117, 'Aluksnes Rajons', 'ALU', 0),
(1821, 117, 'Balvu Rajons', 'BAL', 0),
(1822, 117, 'Bauskas Rajons', 'BAU', 0),
(1823, 117, 'Cesu Rajons', 'CES', 0),
(1824, 117, 'Daugavpils Rajons', 'DGR', 0),
(1825, 117, 'Dobeles Rajons', 'DOB', 0),
(1826, 117, 'Gulbenes Rajons', 'GUL', 0),
(1827, 117, 'Jekabpils Rajons', 'JEK', 0),
(1828, 117, 'Jelgavas Rajons', 'JGR', 0),
(1829, 117, 'Kraslavas Rajons', 'KRA', 0),
(1830, 117, 'Kuldigas Rajons', 'KUL', 0),
(1831, 117, 'Liepajas Rajons', 'LPR', 0),
(1832, 117, 'Limbazu Rajons', 'LIM', 0),
(1833, 117, 'Ludzas Rajons', 'LUD', 0),
(1834, 117, 'Madonas Rajons', 'MAD', 0),
(1835, 117, 'Ogres Rajons', 'OGR', 0),
(1836, 117, 'Preilu Rajons', 'PRE', 0),
(1837, 117, 'Rezeknes Rajons', 'RZR', 0),
(1838, 117, 'Rigas Rajons', 'RGR', 0),
(1839, 117, 'Saldus Rajons', 'SAL', 0),
(1840, 117, 'Talsu Rajons', 'TAL', 0),
(1841, 117, 'Tukuma Rajons', 'TUK', 0),
(1842, 117, 'Valkas Rajons', 'VLK', 0),
(1843, 117, 'Valmieras Rajons', 'VLM', 0),
(1844, 117, 'Ventspils Rajons', 'VSR', 0),
(1845, 117, 'Daugavpils', 'DGV', 0),
(1846, 117, 'Jelgava', 'JGV', 0),
(1847, 117, 'Jurmala', 'JUR', 0),
(1848, 117, 'Liepaja', 'LPK', 0),
(1849, 117, 'Rezekne', 'RZK', 0),
(1850, 117, 'Riga', 'RGA', 0),
(1851, 117, 'Ventspils', 'VSL', 0),
(1852, 119, 'Berea', 'BE', 0),
(1853, 119, 'Butha-Buthe', 'BB', 0),
(1854, 119, 'Leribe', 'LE', 0),
(1855, 119, 'Mafeteng', 'MF', 0),
(1856, 119, 'Maseru', 'MS', 0),
(1857, 119, 'Mohale''s Hoek', 'MH', 0),
(1858, 119, 'Mokhotlong', 'MK', 0);
INSERT INTO `ocx_zone` VALUES
(1859, 119, 'Qacha''s Nek', 'QN', 0),
(1860, 119, 'Quthing', 'QT', 0),
(1861, 119, 'Thaba-Tseka', 'TT', 0),
(1900, 122, 'Vaduz', 'V', 0),
(1901, 122, 'Schaan', 'A', 0),
(1902, 122, 'Balzers', 'B', 0),
(1903, 122, 'Triesen', 'N', 0),
(1904, 122, 'Eschen', 'E', 0),
(1905, 122, 'Mauren', 'M', 0),
(1906, 122, 'Triesenberg', 'T', 0),
(1907, 122, 'Ruggell', 'R', 0),
(1908, 122, 'Gamprin', 'G', 0),
(1909, 122, 'Schellenberg', 'L', 0),
(1910, 122, 'Planken', 'P', 0),
(1911, 123, 'Alytus', 'AL', 0),
(1912, 123, 'Kaunas', 'KA', 0),
(1913, 123, 'Klaipeda', 'KL', 0),
(1914, 123, 'Marijampole', 'MA', 0),
(1915, 123, 'Panevezys', 'PA', 0),
(1916, 123, 'Siauliai', 'SI', 0),
(1917, 123, 'Taurage', 'TA', 0),
(1918, 123, 'Telsiai', 'TE', 0),
(1919, 123, 'Utena', 'UT', 0),
(1920, 123, 'Vilnius', 'VI', 0),
(1921, 124, 'Diekirch', 'DD', 0),
(1922, 124, 'Clervaux', 'DC', 0),
(1923, 124, 'Redange', 'DR', 0),
(1924, 124, 'Vianden', 'DV', 0),
(1925, 124, 'Wiltz', 'DW', 0),
(1926, 124, 'Grevenmacher', 'GG', 0),
(1927, 124, 'Echternach', 'GE', 0),
(1928, 124, 'Remich', 'GR', 0),
(1929, 124, 'Luxembourg', 'LL', 0),
(1930, 124, 'Capellen', 'LC', 0),
(1931, 124, 'Esch-sur-Alzette', 'LE', 0),
(1932, 124, 'Mersch', 'LM', 0),
(1933, 125, 'Our Lady Fatima Parish', 'OLF', 0),
(1934, 125, 'St. Anthony Parish', 'ANT', 0),
(1935, 125, 'St. Lazarus Parish', 'LAZ', 0),
(1936, 125, 'Cathedral Parish', 'CAT', 0),
(1937, 125, 'St. Lawrence Parish', 'LAW', 0),
(1938, 127, 'Antananarivo', 'AN', 0),
(1939, 127, 'Antsiranana', 'AS', 0),
(1940, 127, 'Fianarantsoa', 'FN', 0),
(1941, 127, 'Mahajanga', 'MJ', 0),
(1942, 127, 'Toamasina', 'TM', 0),
(1943, 127, 'Toliara', 'TL', 0),
(1944, 128, 'Balaka', 'BLK', 0),
(1945, 128, 'Blantyre', 'BLT', 0),
(1946, 128, 'Chikwawa', 'CKW', 0),
(1947, 128, 'Chiradzulu', 'CRD', 0),
(1948, 128, 'Chitipa', 'CTP', 0),
(1949, 128, 'Dedza', 'DDZ', 0),
(1950, 128, 'Dowa', 'DWA', 0),
(1951, 128, 'Karonga', 'KRG', 0),
(1952, 128, 'Kasungu', 'KSG', 0),
(1953, 128, 'Likoma', 'LKM', 0),
(1954, 128, 'Lilongwe', 'LLG', 0),
(1955, 128, 'Machinga', 'MCG', 0),
(1956, 128, 'Mangochi', 'MGC', 0),
(1957, 128, 'Mchinji', 'MCH', 0),
(1958, 128, 'Mulanje', 'MLJ', 0),
(1959, 128, 'Mwanza', 'MWZ', 0),
(1960, 128, 'Mzimba', 'MZM', 0),
(1961, 128, 'Ntcheu', 'NTU', 0),
(1962, 128, 'Nkhata Bay', 'NKB', 0),
(1963, 128, 'Nkhotakota', 'NKH', 0),
(1964, 128, 'Nsanje', 'NSJ', 0),
(1965, 128, 'Ntchisi', 'NTI', 0),
(1966, 128, 'Phalombe', 'PHL', 0),
(1967, 128, 'Rumphi', 'RMP', 0),
(1968, 128, 'Salima', 'SLM', 0),
(1969, 128, 'Thyolo', 'THY', 0),
(1970, 128, 'Zomba', 'ZBA', 0),
(1971, 129, 'Johor', 'JO', 0),
(1972, 129, 'Kedah', 'KE', 0),
(1973, 129, 'Kelantan', 'KL', 0),
(1974, 129, 'Labuan', 'LA', 0),
(1975, 129, 'Melaka', 'ME', 0),
(1976, 129, 'Negeri Sembilan', 'NS', 0),
(1977, 129, 'Pahang', 'PA', 0),
(1978, 129, 'Perak', 'PE', 0),
(1979, 129, 'Perlis', 'PR', 0),
(1980, 129, 'Pulau Pinang', 'PP', 0),
(1981, 129, 'Sabah', 'SA', 0),
(1982, 129, 'Sarawak', 'SR', 0),
(1983, 129, 'Selangor', 'SE', 0),
(1984, 129, 'Terengganu', 'TE', 0),
(1985, 129, 'Wilayah Persekutuan', 'WP', 0),
(1986, 130, 'Thiladhunmathi Uthuru', 'THU', 0),
(1987, 130, 'Thiladhunmathi Dhekunu', 'THD', 0),
(1988, 130, 'Miladhunmadulu Uthuru', 'MLU', 0),
(1989, 130, 'Miladhunmadulu Dhekunu', 'MLD', 0),
(1990, 130, 'Maalhosmadulu Uthuru', 'MAU', 0),
(1991, 130, 'Maalhosmadulu Dhekunu', 'MAD', 0),
(1992, 130, 'Faadhippolhu', 'FAA', 0),
(1993, 130, 'Male Atoll', 'MAA', 0),
(1994, 130, 'Ari Atoll Uthuru', 'AAU', 0),
(1995, 130, 'Ari Atoll Dheknu', 'AAD', 0),
(1996, 130, 'Felidhe Atoll', 'FEA', 0),
(1997, 130, 'Mulaku Atoll', 'MUA', 0),
(1998, 130, 'Nilandhe Atoll Uthuru', 'NAU', 0),
(1999, 130, 'Nilandhe Atoll Dhekunu', 'NAD', 0),
(2000, 130, 'Kolhumadulu', 'KLH', 0),
(2001, 130, 'Hadhdhunmathi', 'HDH', 0),
(2002, 130, 'Huvadhu Atoll Uthuru', 'HAU', 0),
(2003, 130, 'Huvadhu Atoll Dhekunu', 'HAD', 0),
(2004, 130, 'Fua Mulaku', 'FMU', 0),
(2005, 130, 'Addu', 'ADD', 0),
(2006, 131, 'Gao', 'GA', 0),
(2007, 131, 'Kayes', 'KY', 0),
(2008, 131, 'Kidal', 'KD', 0),
(2009, 131, 'Koulikoro', 'KL', 0),
(2010, 131, 'Mopti', 'MP', 0),
(2011, 131, 'Segou', 'SG', 0),
(2012, 131, 'Sikasso', 'SK', 0),
(2013, 131, 'Tombouctou', 'TB', 0),
(2014, 131, 'Bamako Capital District', 'CD', 0),
(2015, 132, 'Attard', 'ATT', 0),
(2016, 132, 'Balzan', 'BAL', 0),
(2017, 132, 'Birgu', 'BGU', 0),
(2018, 132, 'Birkirkara', 'BKK', 0),
(2019, 132, 'Birzebbuga', 'BRZ', 0),
(2020, 132, 'Bormla', 'BOR', 0),
(2021, 132, 'Dingli', 'DIN', 0),
(2022, 132, 'Fgura', 'FGU', 0),
(2023, 132, 'Floriana', 'FLO', 0),
(2024, 132, 'Gudja', 'GDJ', 0),
(2025, 132, 'Gzira', 'GZR', 0),
(2026, 132, 'Gargur', 'GRG', 0),
(2027, 132, 'Gaxaq', 'GXQ', 0),
(2028, 132, 'Hamrun', 'HMR', 0),
(2029, 132, 'Iklin', 'IKL', 0),
(2030, 132, 'Isla', 'ISL', 0),
(2031, 132, 'Kalkara', 'KLK', 0),
(2032, 132, 'Kirkop', 'KRK', 0),
(2033, 132, 'Lija', 'LIJ', 0),
(2034, 132, 'Luqa', 'LUQ', 0),
(2035, 132, 'Marsa', 'MRS', 0),
(2036, 132, 'Marsaskala', 'MKL', 0),
(2037, 132, 'Marsaxlokk', 'MXL', 0),
(2038, 132, 'Mdina', 'MDN', 0),
(2039, 132, 'Melliea', 'MEL', 0),
(2040, 132, 'Mgarr', 'MGR', 0),
(2041, 132, 'Mosta', 'MST', 0),
(2042, 132, 'Mqabba', 'MQA', 0),
(2043, 132, 'Msida', 'MSI', 0),
(2044, 132, 'Mtarfa', 'MTF', 0),
(2045, 132, 'Naxxar', 'NAX', 0),
(2046, 132, 'Paola', 'PAO', 0),
(2047, 132, 'Pembroke', 'PEM', 0),
(2048, 132, 'Pieta', 'PIE', 0),
(2049, 132, 'Qormi', 'QOR', 0),
(2050, 132, 'Qrendi', 'QRE', 0),
(2051, 132, 'Rabat', 'RAB', 0),
(2052, 132, 'Safi', 'SAF', 0),
(2053, 132, 'San Giljan', 'SGI', 0),
(2054, 132, 'Santa Lucija', 'SLU', 0),
(2055, 132, 'San Pawl il-Bahar', 'SPB', 0),
(2056, 132, 'San Gwann', 'SGW', 0),
(2057, 132, 'Santa Venera', 'SVE', 0),
(2058, 132, 'Siggiewi', 'SIG', 0),
(2059, 132, 'Sliema', 'SLM', 0),
(2060, 132, 'Swieqi', 'SWQ', 0),
(2061, 132, 'Ta Xbiex', 'TXB', 0),
(2062, 132, 'Tarxien', 'TRX', 0),
(2063, 132, 'Valletta', 'VLT', 0),
(2064, 132, 'Xgajra', 'XGJ', 0),
(2065, 132, 'Zabbar', 'ZBR', 0),
(2066, 132, 'Zebbug', 'ZBG', 0),
(2067, 132, 'Zejtun', 'ZJT', 0),
(2068, 132, 'Zurrieq', 'ZRQ', 0),
(2069, 132, 'Fontana', 'FNT', 0),
(2070, 132, 'Ghajnsielem', 'GHJ', 0),
(2071, 132, 'Gharb', 'GHR', 0),
(2072, 132, 'Ghasri', 'GHS', 0),
(2073, 132, 'Kercem', 'KRC', 0),
(2074, 132, 'Munxar', 'MUN', 0),
(2075, 132, 'Nadur', 'NAD', 0),
(2076, 132, 'Qala', 'QAL', 0),
(2077, 132, 'Victoria', 'VIC', 0),
(2078, 132, 'San Lawrenz', 'SLA', 0),
(2079, 132, 'Sannat', 'SNT', 0),
(2080, 132, 'Xagra', 'ZAG', 0),
(2081, 132, 'Xewkija', 'XEW', 0),
(2082, 132, 'Zebbug', 'ZEB', 0),
(2083, 133, 'Ailinginae', 'ALG', 0),
(2084, 133, 'Ailinglaplap', 'ALL', 0),
(2085, 133, 'Ailuk', 'ALK', 0),
(2086, 133, 'Arno', 'ARN', 0),
(2087, 133, 'Aur', 'AUR', 0),
(2088, 133, 'Bikar', 'BKR', 0),
(2089, 133, 'Bikini', 'BKN', 0),
(2090, 133, 'Bokak', 'BKK', 0),
(2091, 133, 'Ebon', 'EBN', 0),
(2092, 133, 'Enewetak', 'ENT', 0),
(2093, 133, 'Erikub', 'EKB', 0),
(2094, 133, 'Jabat', 'JBT', 0),
(2095, 133, 'Jaluit', 'JLT', 0),
(2096, 133, 'Jemo', 'JEM', 0),
(2097, 133, 'Kili', 'KIL', 0),
(2098, 133, 'Kwajalein', 'KWJ', 0),
(2099, 133, 'Lae', 'LAE', 0),
(2100, 133, 'Lib', 'LIB', 0),
(2101, 133, 'Likiep', 'LKP', 0),
(2102, 133, 'Majuro', 'MJR', 0),
(2103, 133, 'Maloelap', 'MLP', 0),
(2104, 133, 'Mejit', 'MJT', 0),
(2105, 133, 'Mili', 'MIL', 0),
(2106, 133, 'Namorik', 'NMK', 0),
(2107, 133, 'Namu', 'NAM', 0),
(2108, 133, 'Rongelap', 'RGL', 0),
(2109, 133, 'Rongrik', 'RGK', 0),
(2110, 133, 'Toke', 'TOK', 0),
(2111, 133, 'Ujae', 'UJA', 0),
(2112, 133, 'Ujelang', 'UJL', 0),
(2113, 133, 'Utirik', 'UTK', 0),
(2114, 133, 'Wotho', 'WTH', 0),
(2115, 133, 'Wotje', 'WTJ', 0),
(2116, 135, 'Adrar', 'AD', 0),
(2117, 135, 'Assaba', 'AS', 0),
(2118, 135, 'Brakna', 'BR', 0),
(2119, 135, 'Dakhlet Nouadhibou', 'DN', 0),
(2120, 135, 'Gorgol', 'GO', 0),
(2121, 135, 'Guidimaka', 'GM', 0),
(2122, 135, 'Hodh Ech Chargui', 'HC', 0),
(2123, 135, 'Hodh El Gharbi', 'HG', 0),
(2124, 135, 'Inchiri', 'IN', 0),
(2125, 135, 'Tagant', 'TA', 0),
(2126, 135, 'Tiris Zemmour', 'TZ', 0),
(2127, 135, 'Trarza', 'TR', 0),
(2128, 135, 'Nouakchott', 'NO', 0),
(2129, 136, 'Beau Bassin-Rose Hill', 'BR', 0),
(2130, 136, 'Curepipe', 'CU', 0),
(2131, 136, 'Port Louis', 'PU', 0),
(2132, 136, 'Quatre Bornes', 'QB', 0),
(2133, 136, 'Vacoas-Phoenix', 'VP', 0),
(2134, 136, 'Agalega Islands', 'AG', 0),
(2135, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', 0),
(2136, 136, 'Rodrigues', 'RO', 0),
(2137, 136, 'Black River', 'BL', 0),
(2138, 136, 'Flacq', 'FL', 0),
(2139, 136, 'Grand Port', 'GP', 0),
(2140, 136, 'Moka', 'MO', 0),
(2141, 136, 'Pamplemousses', 'PA', 0),
(2142, 136, 'Plaines Wilhems', 'PW', 0),
(2143, 136, 'Port Louis', 'PL', 0),
(2144, 136, 'Riviere du Rempart', 'RR', 0),
(2145, 136, 'Savanne', 'SA', 0),
(2146, 138, 'Baja California Norte', 'BN', 0),
(2147, 138, 'Baja California Sur', 'BS', 0),
(2148, 138, 'Campeche', 'CA', 0),
(2149, 138, 'Chiapas', 'CI', 0),
(2150, 138, 'Chihuahua', 'CH', 0),
(2151, 138, 'Coahuila de Zaragoza', 'CZ', 0),
(2152, 138, 'Colima', 'CL', 0),
(2153, 138, 'Distrito Federal', 'DF', 0),
(2154, 138, 'Durango', 'DU', 0),
(2155, 138, 'Guanajuato', 'GA', 0),
(2156, 138, 'Guerrero', 'GE', 0),
(2157, 138, 'Hidalgo', 'HI', 0),
(2158, 138, 'Jalisco', 'JA', 0),
(2159, 138, 'Mexico', 'ME', 0),
(2160, 138, 'Michoacan de Ocampo', 'MI', 0),
(2161, 138, 'Morelos', 'MO', 0),
(2162, 138, 'Nayarit', 'NA', 0),
(2163, 138, 'Nuevo Leon', 'NL', 0),
(2164, 138, 'Oaxaca', 'OA', 0),
(2165, 138, 'Puebla', 'PU', 0),
(2166, 138, 'Queretaro de Arteaga', 'QA', 0),
(2167, 138, 'Quintana Roo', 'QR', 0),
(2168, 138, 'San Luis Potosi', 'SA', 0),
(2169, 138, 'Sinaloa', 'SI', 0),
(2170, 138, 'Sonora', 'SO', 0),
(2171, 138, 'Tabasco', 'TB', 0),
(2172, 138, 'Tamaulipas', 'TM', 0),
(2173, 138, 'Tlaxcala', 'TL', 0),
(2174, 138, 'Veracruz-Llave', 'VE', 0),
(2175, 138, 'Yucatan', 'YU', 0),
(2176, 138, 'Zacatecas', 'ZA', 0),
(2177, 139, 'Chuuk', 'C', 0),
(2178, 139, 'Kosrae', 'K', 0),
(2179, 139, 'Pohnpei', 'P', 0),
(2180, 139, 'Yap', 'Y', 0),
(2181, 140, 'Gagauzia', 'GA', 0),
(2182, 140, 'Chisinau', 'CU', 0),
(2183, 140, 'Balti', 'BA', 0),
(2184, 140, 'Cahul', 'CA', 0),
(2185, 140, 'Edinet', 'ED', 0),
(2186, 140, 'Lapusna', 'LA', 0),
(2187, 140, 'Orhei', 'OR', 0),
(2188, 140, 'Soroca', 'SO', 0),
(2189, 140, 'Tighina', 'TI', 0),
(2190, 140, 'Ungheni', 'UN', 0),
(2191, 140, 'St‚nga Nistrului', 'SN', 0),
(2192, 141, 'Fontvieille', 'FV', 0),
(2193, 141, 'La Condamine', 'LC', 0),
(2194, 141, 'Monaco-Ville', 'MV', 0),
(2195, 141, 'Monte-Carlo', 'MC', 0),
(2196, 142, 'Ulanbaatar', '1', 0),
(2197, 142, 'Orhon', '035', 0),
(2198, 142, 'Darhan uul', '037', 0),
(2199, 142, 'Hentiy', '039', 0),
(2200, 142, 'Hovsgol', '041', 0),
(2201, 142, 'Hovd', '043', 0),
(2202, 142, 'Uvs', '046', 0),
(2203, 142, 'Tov', '047', 0),
(2204, 142, 'Selenge', '049', 0),
(2205, 142, 'Suhbaatar', '051', 0),
(2206, 142, 'Omnogovi', '053', 0),
(2207, 142, 'Ovorhangay', '055', 0),
(2208, 142, 'Dzavhan', '057', 0),
(2209, 142, 'DundgovL', '059', 0),
(2210, 142, 'Dornod', '061', 0),
(2211, 142, 'Dornogov', '063', 0),
(2212, 142, 'Govi-Sumber', '064', 0),
(2213, 142, 'Govi-Altay', '065', 0),
(2214, 142, 'Bulgan', '067', 0),
(2215, 142, 'Bayanhongor', '069', 0),
(2216, 142, 'Bayan-Olgiy', '071', 0),
(2217, 142, 'Arhangay', '073', 0),
(2218, 143, 'Saint Anthony', 'A', 0),
(2219, 143, 'Saint Georges', 'G', 0),
(2220, 143, 'Saint Peter', 'P', 0),
(2221, 144, 'Agadir', 'AGD', 0),
(2222, 144, 'Al Hoceima', 'HOC', 0),
(2223, 144, 'Azilal', 'AZI', 0),
(2224, 144, 'Beni Mellal', 'BME', 0),
(2225, 144, 'Ben Slimane', 'BSL', 0),
(2226, 144, 'Boulemane', 'BLM', 0),
(2227, 144, 'Casablanca', 'CBL', 0),
(2228, 144, 'Chaouen', 'CHA', 0),
(2229, 144, 'El Jadida', 'EJA', 0),
(2230, 144, 'El Kelaa des Sraghna', 'EKS', 0),
(2231, 144, 'Er Rachidia', 'ERA', 0),
(2232, 144, 'Essaouira', 'ESS', 0),
(2233, 144, 'Fes', 'FES', 0),
(2234, 144, 'Figuig', 'FIG', 0),
(2235, 144, 'Guelmim', 'GLM', 0),
(2236, 144, 'Ifrane', 'IFR', 0),
(2237, 144, 'Kenitra', 'KEN', 0),
(2238, 144, 'Khemisset', 'KHM', 0),
(2239, 144, 'Khenifra', 'KHN', 0),
(2240, 144, 'Khouribga', 'KHO', 0),
(2241, 144, 'Laayoune', 'LYN', 0),
(2242, 144, 'Larache', 'LAR', 0),
(2243, 144, 'Marrakech', 'MRK', 0),
(2244, 144, 'Meknes', 'MKN', 0),
(2245, 144, 'Nador', 'NAD', 0),
(2246, 144, 'Ouarzazate', 'ORZ', 0),
(2247, 144, 'Oujda', 'OUJ', 0),
(2248, 144, 'Rabat-Sale', 'RSA', 0),
(2249, 144, 'Safi', 'SAF', 0),
(2250, 144, 'Settat', 'SET', 0),
(2251, 144, 'Sidi Kacem', 'SKA', 0),
(2252, 144, 'Tangier', 'TGR', 0),
(2253, 144, 'Tan-Tan', 'TAN', 0),
(2254, 144, 'Taounate', 'TAO', 0),
(2255, 144, 'Taroudannt', 'TRD', 0),
(2256, 144, 'Tata', 'TAT', 0),
(2257, 144, 'Taza', 'TAZ', 0),
(2258, 144, 'Tetouan', 'TET', 0),
(2259, 144, 'Tiznit', 'TIZ', 0),
(2260, 144, 'Ad Dakhla', 'ADK', 0),
(2261, 144, 'Boujdour', 'BJD', 0),
(2262, 144, 'Es Smara', 'ESM', 0),
(2263, 145, 'Cabo Delgado', 'CD', 0),
(2264, 145, 'Gaza', 'GZ', 0),
(2265, 145, 'Inhambane', 'IN', 0),
(2266, 145, 'Manica', 'MN', 0),
(2267, 145, 'Maputo (city)', 'MC', 0),
(2268, 145, 'Maputo', 'MP', 0),
(2269, 145, 'Nampula', 'NA', 0),
(2270, 145, 'Niassa', 'NI', 0),
(2271, 145, 'Sofala', 'SO', 0),
(2272, 145, 'Tete', 'TE', 0),
(2273, 145, 'Zambezia', 'ZA', 0),
(2288, 147, 'Caprivi', 'CA', 0),
(2289, 147, 'Erongo', 'ER', 0),
(2290, 147, 'Hardap', 'HA', 0),
(2291, 147, 'Karas', 'KR', 0),
(2292, 147, 'Kavango', 'KV', 0),
(2293, 147, 'Khomas', 'KH', 0),
(2294, 147, 'Kunene', 'KU', 0),
(2295, 147, 'Ohangwena', 'OW', 0),
(2296, 147, 'Omaheke', 'OK', 0),
(2297, 147, 'Omusati', 'OT', 0),
(2298, 147, 'Oshana', 'ON', 0),
(2299, 147, 'Oshikoto', 'OO', 0),
(2300, 147, 'Otjozondjupa', 'OJ', 0),
(2301, 148, 'Aiwo', 'AO', 0),
(2302, 148, 'Anabar', 'AA', 0),
(2303, 148, 'Anetan', 'AT', 0),
(2304, 148, 'Anibare', 'AI', 0),
(2305, 148, 'Baiti', 'BA', 0),
(2306, 148, 'Boe', 'BO', 0),
(2307, 148, 'Buada', 'BU', 0),
(2308, 148, 'Denigomodu', 'DE', 0),
(2309, 148, 'Ewa', 'EW', 0),
(2310, 148, 'Ijuw', 'IJ', 0),
(2311, 148, 'Meneng', 'ME', 0),
(2312, 148, 'Nibok', 'NI', 0),
(2313, 148, 'Uaboe', 'UA', 0),
(2314, 148, 'Yaren', 'YA', 0),
(2315, 149, 'Bagmati', 'BA', 0),
(2316, 149, 'Bheri', 'BH', 0),
(2317, 149, 'Dhawalagiri', 'DH', 0),
(2318, 149, 'Gandaki', 'GA', 0),
(2319, 149, 'Janakpur', 'JA', 0),
(2320, 149, 'Karnali', 'KA', 0),
(2321, 149, 'Kosi', 'KO', 0),
(2322, 149, 'Lumbini', 'LU', 0),
(2323, 149, 'Mahakali', 'MA', 0),
(2324, 149, 'Mechi', 'ME', 0),
(2325, 149, 'Narayani', 'NA', 0),
(2326, 149, 'Rapti', 'RA', 0),
(2327, 149, 'Sagarmatha', 'SA', 0),
(2328, 149, 'Seti', 'SE', 0),
(2329, 150, 'Drenthe', 'DR', 0),
(2330, 150, 'Flevoland', 'FL', 0),
(2331, 150, 'Friesland', 'FR', 0),
(2332, 150, 'Gelderland', 'GE', 0),
(2333, 150, 'Groningen', 'GR', 0),
(2334, 150, 'Limburg', 'LI', 0),
(2335, 150, 'Noord Brabant', 'NB', 0),
(2336, 150, 'Noord Holland', 'NH', 0),
(2337, 150, 'Overijssel', 'OV', 0),
(2338, 150, 'Utrecht', 'UT', 0),
(2339, 150, 'Zeeland', 'ZE', 0),
(2340, 150, 'Zuid Holland', 'ZH', 0),
(2341, 152, 'Iles Loyaute', 'L', 0),
(2342, 152, 'Nord', 'N', 0),
(2343, 152, 'Sud', 'S', 0),
(2344, 153, 'Auckland', 'AUK', 0),
(2345, 153, 'Bay of Plenty', 'BOP', 0),
(2346, 153, 'Canterbury', 'CAN', 0),
(2347, 153, 'Coromandel', 'COR', 0),
(2348, 153, 'Gisborne', 'GIS', 0),
(2349, 153, 'Fiordland', 'FIO', 0),
(2350, 153, 'Hawke''s Bay', 'HKB', 0),
(2351, 153, 'Marlborough', 'MBH', 0),
(2352, 153, 'Manawatu-Wanganui', 'MWT', 0),
(2353, 153, 'Mt Cook-Mackenzie', 'MCM', 0),
(2354, 153, 'Nelson', 'NSN', 0),
(2355, 153, 'Northland', 'NTL', 0),
(2356, 153, 'Otago', 'OTA', 0),
(2357, 153, 'Southland', 'STL', 0),
(2358, 153, 'Taranaki', 'TKI', 0),
(2359, 153, 'Wellington', 'WGN', 0),
(2360, 153, 'Waikato', 'WKO', 0),
(2361, 153, 'Wairarapa', 'WAI', 0),
(2362, 153, 'West Coast', 'WTC', 0),
(2363, 154, 'Atlantico Norte', 'AN', 0),
(2364, 154, 'Atlantico Sur', 'AS', 0),
(2365, 154, 'Boaco', 'BO', 0),
(2366, 154, 'Carazo', 'CA', 0),
(2367, 154, 'Chinandega', 'CI', 0),
(2368, 154, 'Chontales', 'CO', 0),
(2369, 154, 'Esteli', 'ES', 0),
(2370, 154, 'Granada', 'GR', 0),
(2371, 154, 'Jinotega', 'JI', 0),
(2372, 154, 'Leon', 'LE', 0),
(2373, 154, 'Madriz', 'MD', 0),
(2374, 154, 'Managua', 'MN', 0),
(2375, 154, 'Masaya', 'MS', 0),
(2376, 154, 'Matagalpa', 'MT', 0),
(2377, 154, 'Nuevo Segovia', 'NS', 0),
(2378, 154, 'Rio San Juan', 'RS', 0),
(2379, 154, 'Rivas', 'RI', 0),
(2380, 155, 'Agadez', 'AG', 0),
(2381, 155, 'Diffa', 'DF', 0),
(2382, 155, 'Dosso', 'DS', 0),
(2383, 155, 'Maradi', 'MA', 0),
(2384, 155, 'Niamey', 'NM', 0),
(2385, 155, 'Tahoua', 'TH', 0),
(2386, 155, 'Tillaberi', 'TL', 0),
(2387, 155, 'Zinder', 'ZD', 0),
(2388, 156, 'Abia', 'AB', 0),
(2389, 156, 'Abuja Federal Capital Territory', 'CT', 0),
(2390, 156, 'Adamawa', 'AD', 0),
(2391, 156, 'Akwa Ibom', 'AK', 0),
(2392, 156, 'Anambra', 'AN', 0),
(2393, 156, 'Bauchi', 'BC', 0),
(2394, 156, 'Bayelsa', 'BY', 0),
(2395, 156, 'Benue', 'BN', 0),
(2396, 156, 'Borno', 'BO', 0),
(2397, 156, 'Cross River', 'CR', 0),
(2398, 156, 'Delta', 'DE', 0),
(2399, 156, 'Ebonyi', 'EB', 0),
(2400, 156, 'Edo', 'ED', 0),
(2401, 156, 'Ekiti', 'EK', 0),
(2402, 156, 'Enugu', 'EN', 0),
(2403, 156, 'Gombe', 'GO', 0),
(2404, 156, 'Imo', 'IM', 0),
(2405, 156, 'Jigawa', 'JI', 0),
(2406, 156, 'Kaduna', 'KD', 0),
(2407, 156, 'Kano', 'KN', 0),
(2408, 156, 'Katsina', 'KT', 0),
(2409, 156, 'Kebbi', 'KE', 0),
(2410, 156, 'Kogi', 'KO', 0),
(2411, 156, 'Kwara', 'KW', 0),
(2412, 156, 'Lagos', 'LA', 0),
(2413, 156, 'Nassarawa', 'NA', 0),
(2414, 156, 'Niger', 'NI', 0),
(2415, 156, 'Ogun', 'OG', 0),
(2416, 156, 'Ondo', 'ONG', 0),
(2417, 156, 'Osun', 'OS', 0),
(2418, 156, 'Oyo', 'OY', 0),
(2419, 156, 'Plateau', 'PL', 0),
(2420, 156, 'Rivers', 'RI', 0),
(2421, 156, 'Sokoto', 'SO', 0),
(2422, 156, 'Taraba', 'TA', 0),
(2423, 156, 'Yobe', 'YO', 0),
(2424, 156, 'Zamfara', 'ZA', 0),
(2425, 159, 'Northern Islands', 'N', 0),
(2426, 159, 'Rota', 'R', 0),
(2427, 159, 'Saipan', 'S', 0),
(2428, 159, 'Tinian', 'T', 0),
(2429, 160, 'Akershus', 'AK', 0),
(2430, 160, 'Aust-Agder', 'AA', 0),
(2431, 160, 'Buskerud', 'BU', 0),
(2432, 160, 'Finnmark', 'FM', 0),
(2433, 160, 'Hedmark', 'HM', 0),
(2434, 160, 'Hordaland', 'HL', 0),
(2435, 160, 'More og Romdal', 'MR', 0),
(2436, 160, 'Nord-Trondelag', 'NT', 0),
(2437, 160, 'Nordland', 'NL', 0),
(2438, 160, 'Ostfold', 'OF', 0),
(2439, 160, 'Oppland', 'OP', 0),
(2440, 160, 'Oslo', 'OL', 0),
(2441, 160, 'Rogaland', 'RL', 0),
(2442, 160, 'Sor-Trondelag', 'ST', 0),
(2443, 160, 'Sogn og Fjordane', 'SJ', 0),
(2444, 160, 'Svalbard', 'SV', 0),
(2445, 160, 'Telemark', 'TM', 0),
(2446, 160, 'Troms', 'TR', 0),
(2447, 160, 'Vest-Agder', 'VA', 0),
(2448, 160, 'Vestfold', 'VF', 0),
(2449, 161, 'Ad Dakhiliyah', 'DA', 0),
(2450, 161, 'Al Batinah', 'BA', 0),
(2451, 161, 'Al Wusta', 'WU', 0),
(2452, 161, 'Ash Sharqiyah', 'SH', 0),
(2453, 161, 'Az Zahirah', 'ZA', 0),
(2454, 161, 'Masqat', 'MA', 0),
(2455, 161, 'Musandam', 'MU', 0),
(2456, 161, 'Zufar', 'ZU', 0),
(2457, 162, 'Balochistan', 'B', 0),
(2458, 162, 'Federally Administered Tribal Areas', 'T', 0),
(2459, 162, 'Islamabad Capital Territory', 'I', 0),
(2460, 162, 'North-West Frontier', 'N', 0),
(2461, 162, 'Punjab', 'P', 0),
(2462, 162, 'Sindh', 'S', 0),
(2463, 163, 'Aimeliik', 'AM', 0),
(2464, 163, 'Airai', 'AR', 0),
(2465, 163, 'Angaur', 'AN', 0),
(2466, 163, 'Hatohobei', 'HA', 0),
(2467, 163, 'Kayangel', 'KA', 0),
(2468, 163, 'Koror', 'KO', 0),
(2469, 163, 'Melekeok', 'ME', 0),
(2470, 163, 'Ngaraard', 'NA', 0),
(2471, 163, 'Ngarchelong', 'NG', 0),
(2472, 163, 'Ngardmau', 'ND', 0),
(2473, 163, 'Ngatpang', 'NT', 0),
(2474, 163, 'Ngchesar', 'NC', 0),
(2475, 163, 'Ngeremlengui', 'NR', 0),
(2476, 163, 'Ngiwal', 'NW', 0),
(2477, 163, 'Peleliu', 'PE', 0),
(2478, 163, 'Sonsorol', 'SO', 0),
(2479, 164, 'Bocas del Toro', 'BT', 0),
(2480, 164, 'Chiriqui', 'CH', 0),
(2481, 164, 'Cocle', 'CC', 0),
(2482, 164, 'Colon', 'CL', 0),
(2483, 164, 'Darien', 'DA', 0),
(2484, 164, 'Herrera', 'HE', 0),
(2485, 164, 'Los Santos', 'LS', 0),
(2486, 164, 'Panama', 'PA', 0),
(2487, 164, 'San Blas', 'SB', 0),
(2488, 164, 'Veraguas', 'VG', 0),
(2489, 165, 'Bougainville', 'BV', 0),
(2490, 165, 'Central', 'CE', 0),
(2491, 165, 'Chimbu', 'CH', 0),
(2492, 165, 'Eastern Highlands', 'EH', 0),
(2493, 165, 'East New Britain', 'EB', 0),
(2494, 165, 'East Sepik', 'ES', 0),
(2495, 165, 'Enga', 'EN', 0),
(2496, 165, 'Gulf', 'GU', 0),
(2497, 165, 'Madang', 'MD', 0),
(2498, 165, 'Manus', 'MN', 0),
(2499, 165, 'Milne Bay', 'MB', 0),
(2500, 165, 'Morobe', 'MR', 0),
(2501, 165, 'National Capital', 'NC', 0),
(2502, 165, 'New Ireland', 'NI', 0),
(2503, 165, 'Northern', 'NO', 0),
(2504, 165, 'Sandaun', 'SA', 0),
(2505, 165, 'Southern Highlands', 'SH', 0),
(2506, 165, 'Western', 'WE', 0),
(2507, 165, 'Western Highlands', 'WH', 0),
(2508, 165, 'West New Britain', 'WB', 0),
(2509, 166, 'Alto Paraguay', 'AG', 0),
(2510, 166, 'Alto Parana', 'AN', 0),
(2511, 166, 'Amambay', 'AM', 0),
(2512, 166, 'Asuncion', 'AS', 0),
(2513, 166, 'Boqueron', 'BO', 0),
(2514, 166, 'Caaguazu', 'CG', 0),
(2515, 166, 'Caazapa', 'CZ', 0),
(2516, 166, 'Canindeyu', 'CN', 0),
(2517, 166, 'Central', 'CE', 0),
(2518, 166, 'Concepcion', 'CC', 0),
(2519, 166, 'Cordillera', 'CD', 0),
(2520, 166, 'Guaira', 'GU', 0),
(2521, 166, 'Itapua', 'IT', 0),
(2522, 166, 'Misiones', 'MI', 0),
(2523, 166, 'Neembucu', 'NE', 0),
(2524, 166, 'Paraguari', 'PA', 0),
(2525, 166, 'Presidente Hayes', 'PH', 0),
(2526, 166, 'San Pedro', 'SP', 0),
(2527, 167, 'Amazonas', 'AM', 0),
(2528, 167, 'Ancash', 'AN', 0),
(2529, 167, 'Apurimac', 'AP', 0),
(2530, 167, 'Arequipa', 'AR', 0),
(2531, 167, 'Ayacucho', 'AY', 0),
(2532, 167, 'Cajamarca', 'CJ', 0),
(2533, 167, 'Callao', 'CL', 0),
(2534, 167, 'Cusco', 'CU', 0),
(2535, 167, 'Huancavelica', 'HV', 0),
(2536, 167, 'Huanuco', 'HO', 0),
(2537, 167, 'Ica', 'IC', 0),
(2538, 167, 'Junin', 'JU', 0),
(2539, 167, 'La Libertad', 'LD', 0),
(2540, 167, 'Lambayeque', 'LY', 0),
(2541, 167, 'Lima', 'LI', 0),
(2542, 167, 'Loreto', 'LO', 0),
(2543, 167, 'Madre de Dios', 'MD', 0),
(2544, 167, 'Moquegua', 'MO', 0),
(2545, 167, 'Pasco', 'PA', 0),
(2546, 167, 'Piura', 'PI', 0),
(2547, 167, 'Puno', 'PU', 0),
(2548, 167, 'San Martin', 'SM', 0),
(2549, 167, 'Tacna', 'TA', 0),
(2550, 167, 'Tumbes', 'TU', 0),
(2551, 167, 'Ucayali', 'UC', 0),
(2552, 168, 'Abra', 'ABR', 0),
(2553, 168, 'Agusan del Norte', 'ANO', 0),
(2554, 168, 'Agusan del Sur', 'ASU', 0),
(2555, 168, 'Aklan', 'AKL', 0),
(2556, 168, 'Albay', 'ALB', 0),
(2557, 168, 'Antique', 'ANT', 0),
(2558, 168, 'Apayao', 'APY', 0),
(2559, 168, 'Aurora', 'AUR', 0),
(2560, 168, 'Basilan', 'BAS', 0),
(2561, 168, 'Bataan', 'BTA', 0),
(2562, 168, 'Batanes', 'BTE', 0),
(2563, 168, 'Batangas', 'BTG', 0),
(2564, 168, 'Biliran', 'BLR', 0),
(2565, 168, 'Benguet', 'BEN', 0),
(2566, 168, 'Bohol', 'BOL', 0),
(2567, 168, 'Bukidnon', 'BUK', 0),
(2568, 168, 'Bulacan', 'BUL', 0),
(2569, 168, 'Cagayan', 'CAG', 0),
(2570, 168, 'Camarines Norte', 'CNO', 0),
(2571, 168, 'Camarines Sur', 'CSU', 0),
(2572, 168, 'Camiguin', 'CAM', 0),
(2573, 168, 'Capiz', 'CAP', 0),
(2574, 168, 'Catanduanes', 'CAT', 0),
(2575, 168, 'Cavite', 'CAV', 0),
(2576, 168, 'Cebu', 'CEB', 0),
(2577, 168, 'Compostela', 'CMP', 0),
(2578, 168, 'Davao del Norte', 'DNO', 0),
(2579, 168, 'Davao del Sur', 'DSU', 0),
(2580, 168, 'Davao Oriental', 'DOR', 0),
(2581, 168, 'Eastern Samar', 'ESA', 0),
(2582, 168, 'Guimaras', 'GUI', 0),
(2583, 168, 'Ifugao', 'IFU', 0),
(2584, 168, 'Ilocos Norte', 'INO', 0),
(2585, 168, 'Ilocos Sur', 'ISU', 0),
(2586, 168, 'Iloilo', 'ILO', 0),
(2587, 168, 'Isabela', 'ISA', 0),
(2588, 168, 'Kalinga', 'KAL', 0),
(2589, 168, 'Laguna', 'LAG', 0),
(2590, 168, 'Lanao del Norte', 'LNO', 0),
(2591, 168, 'Lanao del Sur', 'LSU', 0),
(2592, 168, 'La Union', 'UNI', 0),
(2593, 168, 'Leyte', 'LEY', 0),
(2594, 168, 'Maguindanao', 'MAG', 0),
(2595, 168, 'Marinduque', 'MRN', 0),
(2596, 168, 'Masbate', 'MSB', 0),
(2597, 168, 'Mindoro Occidental', 'MIC', 0),
(2598, 168, 'Mindoro Oriental', 'MIR', 0),
(2599, 168, 'Misamis Occidental', 'MSC', 0),
(2600, 168, 'Misamis Oriental', 'MOR', 0),
(2601, 168, 'Mountain', 'MOP', 0),
(2602, 168, 'Negros Occidental', 'NOC', 0),
(2603, 168, 'Negros Oriental', 'NOR', 0),
(2604, 168, 'North Cotabato', 'NCT', 0),
(2605, 168, 'Northern Samar', 'NSM', 0),
(2606, 168, 'Nueva Ecija', 'NEC', 0),
(2607, 168, 'Nueva Vizcaya', 'NVZ', 0),
(2608, 168, 'Palawan', 'PLW', 0),
(2609, 168, 'Pampanga', 'PMP', 0),
(2610, 168, 'Pangasinan', 'PNG', 0),
(2611, 168, 'Quezon', 'QZN', 0),
(2612, 168, 'Quirino', 'QRN', 0),
(2613, 168, 'Rizal', 'RIZ', 0),
(2614, 168, 'Romblon', 'ROM', 0),
(2615, 168, 'Samar', 'SMR', 0),
(2616, 168, 'Sarangani', 'SRG', 0),
(2617, 168, 'Siquijor', 'SQJ', 0),
(2618, 168, 'Sorsogon', 'SRS', 0),
(2619, 168, 'South Cotabato', 'SCO', 0),
(2620, 168, 'Southern Leyte', 'SLE', 0),
(2621, 168, 'Sultan Kudarat', 'SKU', 0),
(2622, 168, 'Sulu', 'SLU', 0),
(2623, 168, 'Surigao del Norte', 'SNO', 0),
(2624, 168, 'Surigao del Sur', 'SSU', 0),
(2625, 168, 'Tarlac', 'TAR', 0),
(2626, 168, 'Tawi-Tawi', 'TAW', 0),
(2627, 168, 'Zambales', 'ZBL', 0),
(2628, 168, 'Zamboanga del Norte', 'ZNO', 0),
(2629, 168, 'Zamboanga del Sur', 'ZSU', 0),
(2630, 168, 'Zamboanga Sibugay', 'ZSI', 0),
(2631, 170, 'Dolnoslaskie', 'DO', 0),
(2632, 170, 'Kujawsko-Pomorskie', 'KP', 0),
(2633, 170, 'Lodzkie', 'LO', 0),
(2634, 170, 'Lubelskie', 'LL', 0),
(2635, 170, 'Lubuskie', 'LU', 0),
(2636, 170, 'Malopolskie', 'ML', 0),
(2637, 170, 'Mazowieckie', 'MZ', 0),
(2638, 170, 'Opolskie', 'OP', 0),
(2639, 170, 'Podkarpackie', 'PP', 0),
(2640, 170, 'Podlaskie', 'PL', 0),
(2641, 170, 'Pomorskie', 'PM', 0),
(2642, 170, 'Slaskie', 'SL', 0),
(2643, 170, 'Swietokrzyskie', 'SW', 0),
(2644, 170, 'Warminsko-Mazurskie', 'WM', 0),
(2645, 170, 'Wielkopolskie', 'WP', 0),
(2646, 170, 'Zachodniopomorskie', 'ZA', 0),
(2647, 198, 'Saint Pierre', 'P', 0),
(2648, 198, 'Miquelon', 'M', 0),
(2649, 171, 'A&ccedil;ores', 'AC', 0),
(2650, 171, 'Aveiro', 'AV', 0),
(2651, 171, 'Beja', 'BE', 0),
(2652, 171, 'Braga', 'BR', 0),
(2653, 171, 'Bragan&ccedil;a', 'BA', 0),
(2654, 171, 'Castelo Branco', 'CB', 0),
(2655, 171, 'Coimbra', 'CO', 0),
(2656, 171, '&Eacute;vora', 'EV', 0),
(2657, 171, 'Faro', 'FA', 0),
(2658, 171, 'Guarda', 'GU', 0),
(2659, 171, 'Leiria', 'LE', 0),
(2660, 171, 'Lisboa', 'LI', 0),
(2661, 171, 'Madeira', 'ME', 0),
(2662, 171, 'Portalegre', 'PO', 0),
(2663, 171, 'Porto', 'PR', 0),
(2664, 171, 'Santar&eacute;m', 'SA', 0),
(2665, 171, 'Set&uacute;bal', 'SE', 0),
(2666, 171, 'Viana do Castelo', 'VC', 0),
(2667, 171, 'Vila Real', 'VR', 0),
(2668, 171, 'Viseu', 'VI', 0),
(2669, 173, 'Ad Dawhah', 'DW', 0),
(2670, 173, 'Al Ghuwayriyah', 'GW', 0),
(2671, 173, 'Al Jumayliyah', 'JM', 0),
(2672, 173, 'Al Khawr', 'KR', 0),
(2673, 173, 'Al Wakrah', 'WK', 0),
(2674, 173, 'Ar Rayyan', 'RN', 0),
(2675, 173, 'Jarayan al Batinah', 'JB', 0),
(2676, 173, 'Madinat ash Shamal', 'MS', 0),
(2677, 173, 'Umm Sa''id', 'UD', 0),
(2678, 173, 'Umm Salal', 'UL', 0),
(2679, 175, 'Alba', 'AB', 0),
(2680, 175, 'Arad', 'AR', 0),
(2681, 175, 'Arges', 'AG', 0),
(2682, 175, 'Bacau', 'BC', 0),
(2683, 175, 'Bihor', 'BH', 0),
(2684, 175, 'Bistrita-Nasaud', 'BN', 0),
(2685, 175, 'Botosani', 'BT', 0),
(2686, 175, 'Brasov', 'BV', 0),
(2687, 175, 'Braila', 'BR', 0),
(2688, 175, 'Bucuresti', 'B', 0),
(2689, 175, 'Buzau', 'BZ', 0),
(2690, 175, 'Caras-Severin', 'CS', 0),
(2691, 175, 'Calarasi', 'CL', 0),
(2692, 175, 'Cluj', 'CJ', 0),
(2693, 175, 'Constanta', 'CT', 0),
(2694, 175, 'Covasna', 'CV', 0),
(2695, 175, 'Dimbovita', 'DB', 0),
(2696, 175, 'Dolj', 'DJ', 0),
(2697, 175, 'Galati', 'GL', 0),
(2698, 175, 'Giurgiu', 'GR', 0),
(2699, 175, 'Gorj', 'GJ', 0),
(2700, 175, 'Harghita', 'HR', 0),
(2701, 175, 'Hunedoara', 'HD', 0),
(2702, 175, 'Ialomita', 'IL', 0),
(2703, 175, 'Iasi', 'IS', 0),
(2704, 175, 'Ilfov', 'IF', 0),
(2705, 175, 'Maramures', 'MM', 0),
(2706, 175, 'Mehedinti', 'MH', 0),
(2707, 175, 'Mures', 'MS', 0),
(2708, 175, 'Neamt', 'NT', 0),
(2709, 175, 'Olt', 'OT', 0),
(2710, 175, 'Prahova', 'PH', 0),
(2711, 175, 'Satu-Mare', 'SM', 0),
(2712, 175, 'Salaj', 'SJ', 0),
(2713, 175, 'Sibiu', 'SB', 0),
(2714, 175, 'Suceava', 'SV', 0),
(2715, 175, 'Teleorman', 'TR', 0),
(2716, 175, 'Timis', 'TM', 0),
(2717, 175, 'Tulcea', 'TL', 0),
(2718, 175, 'Vaslui', 'VS', 0),
(2719, 175, 'Valcea', 'VL', 0),
(2720, 175, 'Vrancea', 'VN', 0),
(2721, 176, 'Abakan', 'AB', 0),
(2722, 176, 'Aginskoye', 'AG', 0),
(2723, 176, 'Anadyr', 'AN', 0),
(2724, 176, 'Arkahangelsk', 'AR', 0),
(2725, 176, 'Astrakhan', 'AS', 0),
(2726, 176, 'Barnaul', 'BA', 0),
(2727, 176, 'Belgorod', 'BE', 0),
(2728, 176, 'Birobidzhan', 'BI', 0),
(2729, 176, 'Blagoveshchensk', 'BL', 0),
(2730, 176, 'Bryansk', 'BR', 0),
(2731, 176, 'Cheboksary', 'CH', 0),
(2732, 176, 'Chelyabinsk', 'CL', 0),
(2733, 176, 'Cherkessk', 'CR', 0),
(2734, 176, 'Chita', 'CI', 0),
(2735, 176, 'Dudinka', 'DU', 0),
(2736, 176, 'Elista', 'EL', 0),
(2737, 176, 'Gomo-Altaysk', 'GO', 0),
(2738, 176, 'Gorno-Altaysk', 'GA', 0),
(2739, 176, 'Groznyy', 'GR', 0),
(2740, 176, 'Irkutsk', 'IR', 0),
(2741, 176, 'Ivanovo', 'IV', 0),
(2742, 176, 'Izhevsk', 'IZ', 0),
(2743, 176, 'Kalinigrad', 'KA', 0),
(2744, 176, 'Kaluga', 'KL', 0),
(2745, 176, 'Kasnodar', 'KS', 0),
(2746, 176, 'Kazan', 'KZ', 0),
(2747, 176, 'Kemerovo', 'KE', 0),
(2748, 176, 'Khabarovsk', 'KH', 0),
(2749, 176, 'Khanty-Mansiysk', 'KM', 0),
(2750, 176, 'Kostroma', 'KO', 0),
(2751, 176, 'Krasnodar', 'KR', 0),
(2752, 176, 'Krasnoyarsk', 'KN', 0),
(2753, 176, 'Kudymkar', 'KU', 0),
(2754, 176, 'Kurgan', 'KG', 0),
(2755, 176, 'Kursk', 'KK', 0),
(2756, 176, 'Kyzyl', 'KY', 0),
(2757, 176, 'Lipetsk', 'LI', 0),
(2758, 176, 'Magadan', 'MA', 0),
(2759, 176, 'Makhachkala', 'MK', 0),
(2760, 176, 'Maykop', 'MY', 0),
(2761, 176, 'Moscow', 'MO', 0),
(2762, 176, 'Murmansk', 'MU', 0),
(2763, 176, 'Nalchik', 'NA', 0),
(2764, 176, 'Naryan Mar', 'NR', 0),
(2765, 176, 'Nazran', 'NZ', 0),
(2766, 176, 'Nizhniy Novgorod', 'NI', 0),
(2767, 176, 'Novgorod', 'NO', 0),
(2768, 176, 'Novosibirsk', 'NV', 0),
(2769, 176, 'Omsk', 'OM', 0),
(2770, 176, 'Orel', 'OR', 0),
(2771, 176, 'Orenburg', 'OE', 0),
(2772, 176, 'Palana', 'PA', 0),
(2773, 176, 'Penza', 'PE', 0),
(2774, 176, 'Perm', 'PR', 0),
(2775, 176, 'Petropavlovsk-Kamchatskiy', 'PK', 0),
(2776, 176, 'Petrozavodsk', 'PT', 0),
(2777, 176, 'Pskov', 'PS', 0),
(2778, 176, 'Rostov-na-Donu', 'RO', 0),
(2779, 176, 'Ryazan', 'RY', 0),
(2780, 176, 'Salekhard', 'SL', 0),
(2781, 176, 'Samara', 'SA', 0),
(2782, 176, 'Saransk', 'SR', 0),
(2783, 176, 'Saratov', 'SV', 0),
(2784, 176, 'Smolensk', 'SM', 0),
(2785, 176, 'St. Petersburg', 'SP', 0),
(2786, 176, 'Stavropol', 'ST', 0),
(2787, 176, 'Syktyvkar', 'SY', 0),
(2788, 176, 'Tambov', 'TA', 0),
(2789, 176, 'Tomsk', 'TO', 0),
(2790, 176, 'Tula', 'TU', 0),
(2791, 176, 'Tura', 'TR', 0),
(2792, 176, 'Tver', 'TV', 0),
(2793, 176, 'Tyumen', 'TY', 0),
(2794, 176, 'Ufa', 'UF', 0),
(2795, 176, 'Ul''yanovsk', 'UL', 0),
(2796, 176, 'Ulan-Ude', 'UU', 0),
(2797, 176, 'Ust''-Ordynskiy', 'US', 0),
(2798, 176, 'Vladikavkaz', 'VL', 0),
(2799, 176, 'Vladimir', 'VA', 0),
(2800, 176, 'Vladivostok', 'VV', 0),
(2801, 176, 'Volgograd', 'VG', 0),
(2802, 176, 'Vologda', 'VD', 0),
(2803, 176, 'Voronezh', 'VO', 0),
(2804, 176, 'Vyatka', 'VY', 0),
(2805, 176, 'Yakutsk', 'YA', 0),
(2806, 176, 'Yaroslavl', 'YR', 0),
(2807, 176, 'Yekaterinburg', 'YE', 0),
(2808, 176, 'Yoshkar-Ola', 'YO', 0),
(2809, 177, 'Butare', 'BU', 0),
(2810, 177, 'Byumba', 'BY', 0),
(2811, 177, 'Cyangugu', 'CY', 0),
(2812, 177, 'Gikongoro', 'GK', 0),
(2813, 177, 'Gisenyi', 'GS', 0),
(2814, 177, 'Gitarama', 'GT', 0),
(2815, 177, 'Kibungo', 'KG', 0),
(2816, 177, 'Kibuye', 'KY', 0),
(2817, 177, 'Kigali Rurale', 'KR', 0),
(2818, 177, 'Kigali-ville', 'KV', 0),
(2819, 177, 'Ruhengeri', 'RU', 0),
(2820, 177, 'Umutara', 'UM', 0),
(2821, 178, 'Christ Church Nichola Town', 'CCN', 0),
(2822, 178, 'Saint Anne Sandy Point', 'SAS', 0),
(2823, 178, 'Saint George Basseterre', 'SGB', 0),
(2824, 178, 'Saint George Gingerland', 'SGG', 0),
(2825, 178, 'Saint James Windward', 'SJW', 0),
(2826, 178, 'Saint John Capesterre', 'SJC', 0),
(2827, 178, 'Saint John Figtree', 'SJF', 0),
(2828, 178, 'Saint Mary Cayon', 'SMC', 0),
(2829, 178, 'Saint Paul Capesterre', 'CAP', 0),
(2830, 178, 'Saint Paul Charlestown', 'CHA', 0),
(2831, 178, 'Saint Peter Basseterre', 'SPB', 0),
(2832, 178, 'Saint Thomas Lowland', 'STL', 0),
(2833, 178, 'Saint Thomas Middle Island', 'STM', 0),
(2834, 178, 'Trinity Palmetto Point', 'TPP', 0),
(2835, 179, 'Anse-la-Raye', 'AR', 0),
(2836, 179, 'Castries', 'CA', 0),
(2837, 179, 'Choiseul', 'CH', 0),
(2838, 179, 'Dauphin', 'DA', 0),
(2839, 179, 'Dennery', 'DE', 0),
(2840, 179, 'Gros-Islet', 'GI', 0),
(2841, 179, 'Laborie', 'LA', 0),
(2842, 179, 'Micoud', 'MI', 0),
(2843, 179, 'Praslin', 'PR', 0),
(2844, 179, 'Soufriere', 'SO', 0),
(2845, 179, 'Vieux-Fort', 'VF', 0),
(2846, 180, 'Charlotte', 'C', 0),
(2847, 180, 'Grenadines', 'R', 0),
(2848, 180, 'Saint Andrew', 'A', 0),
(2849, 180, 'Saint David', 'D', 0),
(2850, 180, 'Saint George', 'G', 0),
(2851, 180, 'Saint Patrick', 'P', 0),
(2852, 181, 'A''ana', 'AN', 0),
(2853, 181, 'Aiga-i-le-Tai', 'AI', 0),
(2854, 181, 'Atua', 'AT', 0),
(2855, 181, 'Fa''asaleleaga', 'FA', 0),
(2856, 181, 'Gaga''emauga', 'GE', 0),
(2857, 181, 'Gagaifomauga', 'GF', 0),
(2858, 181, 'Palauli', 'PA', 0),
(2859, 181, 'Satupa''itea', 'SA', 0),
(2860, 181, 'Tuamasaga', 'TU', 0),
(2861, 181, 'Va''a-o-Fonoti', 'VF', 0),
(2862, 181, 'Vaisigano', 'VS', 0),
(2863, 182, 'Acquaviva', 'AC', 0),
(2864, 182, 'Borgo Maggiore', 'BM', 0),
(2865, 182, 'Chiesanuova', 'CH', 0),
(2866, 182, 'Domagnano', 'DO', 0),
(2867, 182, 'Faetano', 'FA', 0),
(2868, 182, 'Fiorentino', 'FI', 0),
(2869, 182, 'Montegiardino', 'MO', 0),
(2870, 182, 'Citta di San Marino', 'SM', 0),
(2871, 182, 'Serravalle', 'SE', 0),
(2872, 183, 'Sao Tome', 'S', 0),
(2873, 183, 'Principe', 'P', 0),
(2874, 184, 'Al Bahah', 'BH', 0),
(2875, 184, 'Al Hudud ash Shamaliyah', 'HS', 0),
(2876, 184, 'Al Jawf', 'JF', 0),
(2877, 184, 'Al Madinah', 'MD', 0),
(2878, 184, 'Al Qasim', 'QS', 0),
(2879, 184, 'Ar Riyad', 'RD', 0),
(2880, 184, 'Ash Sharqiyah (Eastern)', 'AQ', 0),
(2881, 184, '''Asir', 'AS', 0),
(2882, 184, 'Ha''il', 'HL', 0),
(2883, 184, 'Jizan', 'JZ', 0),
(2884, 184, 'Makkah', 'ML', 0),
(2885, 184, 'Najran', 'NR', 0),
(2886, 184, 'Tabuk', 'TB', 0),
(2887, 185, 'Dakar', 'DA', 0),
(2888, 185, 'Diourbel', 'DI', 0),
(2889, 185, 'Fatick', 'FA', 0),
(2890, 185, 'Kaolack', 'KA', 0),
(2891, 185, 'Kolda', 'KO', 0),
(2892, 185, 'Louga', 'LO', 0),
(2893, 185, 'Matam', 'MA', 0),
(2894, 185, 'Saint-Louis', 'SL', 0),
(2895, 185, 'Tambacounda', 'TA', 0),
(2896, 185, 'Thies', 'TH', 0),
(2897, 185, 'Ziguinchor', 'ZI', 0),
(2898, 186, 'Anse aux Pins', 'AP', 0),
(2899, 186, 'Anse Boileau', 'AB', 0),
(2900, 186, 'Anse Etoile', 'AE', 0),
(2901, 186, 'Anse Louis', 'AL', 0),
(2902, 186, 'Anse Royale', 'AR', 0),
(2903, 186, 'Baie Lazare', 'BL', 0),
(2904, 186, 'Baie Sainte Anne', 'BS', 0),
(2905, 186, 'Beau Vallon', 'BV', 0),
(2906, 186, 'Bel Air', 'BA', 0),
(2907, 186, 'Bel Ombre', 'BO', 0),
(2908, 186, 'Cascade', 'CA', 0),
(2909, 186, 'Glacis', 'GL', 0),
(2910, 186, 'Grand'' Anse (on Mahe)', 'GM', 0),
(2911, 186, 'Grand'' Anse (on Praslin)', 'GP', 0),
(2912, 186, 'La Digue', 'DG', 0),
(2913, 186, 'La Riviere Anglaise', 'RA', 0),
(2914, 186, 'Mont Buxton', 'MB', 0),
(2915, 186, 'Mont Fleuri', 'MF', 0),
(2916, 186, 'Plaisance', 'PL', 0),
(2917, 186, 'Pointe La Rue', 'PR', 0),
(2918, 186, 'Port Glaud', 'PG', 0),
(2919, 186, 'Saint Louis', 'SL', 0),
(2920, 186, 'Takamaka', 'TA', 0),
(2921, 187, 'Eastern', 'E', 0),
(2922, 187, 'Northern', 'N', 0),
(2923, 187, 'Southern', 'S', 0),
(2924, 187, 'Western', 'W', 0),
(2925, 189, 'Banskobystrický', 'BA', 0),
(2926, 189, 'Bratislavský', 'BR', 0),
(2927, 189, 'Košický', 'KO', 0),
(2928, 189, 'Nitriansky', 'NI', 0),
(2929, 189, 'Prešovský', 'PR', 0),
(2930, 189, 'Trenčiansky', 'TC', 0),
(2931, 189, 'Trnavský', 'TV', 0),
(2932, 189, 'Žilinský', 'ZI', 0),
(2933, 191, 'Central', 'CE', 0),
(2934, 191, 'Choiseul', 'CH', 0),
(2935, 191, 'Guadalcanal', 'GC', 0),
(2936, 191, 'Honiara', 'HO', 0),
(2937, 191, 'Isabel', 'IS', 0),
(2938, 191, 'Makira', 'MK', 0),
(2939, 191, 'Malaita', 'ML', 0),
(2940, 191, 'Rennell and Bellona', 'RB', 0),
(2941, 191, 'Temotu', 'TM', 0),
(2942, 191, 'Western', 'WE', 0),
(2961, 193, 'Eastern Cape', 'EC', 0),
(2962, 193, 'Free State', 'FS', 0),
(2963, 193, 'Gauteng', 'GT', 0),
(2964, 193, 'KwaZulu-Natal', 'KN', 0),
(2965, 193, 'Limpopo', 'LP', 0),
(2966, 193, 'Mpumalanga', 'MP', 0),
(2967, 193, 'North West', 'NW', 0),
(2968, 193, 'Northern Cape', 'NC', 0),
(2969, 193, 'Western Cape', 'WC', 0),
(2970, 195, 'La Coru&ntilde;a', 'CA', 0),
(2971, 195, '&Aacute;lava', 'AL', 0),
(2972, 195, 'Albacete', 'AB', 0),
(2973, 195, 'Alicante', 'AC', 0),
(2974, 195, 'Almeria', 'AM', 0),
(2975, 195, 'Asturias', 'AS', 0),
(2976, 195, '&Aacute;vila', 'AV', 0),
(2977, 195, 'Badajoz', 'BJ', 0),
(2978, 195, 'Baleares', 'IB', 0),
(2979, 195, 'Barcelona', 'BA', 0),
(2980, 195, 'Burgos', 'BU', 0),
(2981, 195, 'C&aacute;ceres', 'CC', 0),
(2982, 195, 'C&aacute;diz', 'CZ', 0),
(2983, 195, 'Cantabria', 'CT', 0),
(2984, 195, 'Castell&oacute;n', 'CL', 0),
(2985, 195, 'Ceuta', 'CE', 0),
(2986, 195, 'Ciudad Real', 'CR', 0),
(2987, 195, 'C&oacute;rdoba', 'CD', 0),
(2988, 195, 'Cuenca', 'CU', 0),
(2989, 195, 'Girona', 'GI', 0),
(2990, 195, 'Granada', 'GD', 0),
(2991, 195, 'Guadalajara', 'GJ', 0),
(2992, 195, 'Guip&uacute;zcoa', 'GP', 0),
(2993, 195, 'Huelva', 'HL', 0),
(2994, 195, 'Huesca', 'HS', 0),
(2995, 195, 'Ja&eacute;n', 'JN', 0),
(2996, 195, 'La Rioja', 'RJ', 0),
(2997, 195, 'Las Palmas', 'PM', 0),
(2998, 195, 'Leon', 'LE', 0),
(2999, 195, 'Lleida', 'LL', 0),
(3000, 195, 'Lugo', 'LG', 0),
(3001, 195, 'Madrid', 'MD', 0),
(3002, 195, 'Malaga', 'MA', 0),
(3003, 195, 'Melilla', 'ML', 0),
(3004, 195, 'Murcia', 'MU', 0),
(3005, 195, 'Navarra', 'NV', 0),
(3006, 195, 'Ourense', 'OU', 0),
(3007, 195, 'Palencia', 'PL', 0),
(3008, 195, 'Pontevedra', 'PO', 0),
(3009, 195, 'Salamanca', 'SL', 0),
(3010, 195, 'Santa Cruz de Tenerife', 'SC', 0),
(3011, 195, 'Segovia', 'SG', 0),
(3012, 195, 'Sevilla', 'SV', 0),
(3013, 195, 'Soria', 'SO', 0),
(3014, 195, 'Tarragona', 'TA', 0),
(3015, 195, 'Teruel', 'TE', 0),
(3016, 195, 'Toledo', 'TO', 0),
(3017, 195, 'Valencia', 'VC', 0),
(3018, 195, 'Valladolid', 'VD', 0),
(3019, 195, 'Vizcaya', 'VZ', 0),
(3020, 195, 'Zamora', 'ZM', 0),
(3021, 195, 'Zaragoza', 'ZR', 0),
(3031, 197, 'Ascension', 'A', 0),
(3032, 197, 'Saint Helena', 'S', 0),
(3033, 197, 'Tristan da Cunha', 'T', 0),
(3060, 200, 'Brokopondo', 'BR', 0),
(3061, 200, 'Commewijne', 'CM', 0),
(3062, 200, 'Coronie', 'CR', 0),
(3063, 200, 'Marowijne', 'MA', 0),
(3064, 200, 'Nickerie', 'NI', 0),
(3065, 200, 'Para', 'PA', 0),
(3066, 200, 'Paramaribo', 'PM', 0),
(3067, 200, 'Saramacca', 'SA', 0),
(3068, 200, 'Sipaliwini', 'SI', 0),
(3069, 200, 'Wanica', 'WA', 0),
(3070, 202, 'Hhohho', 'H', 0),
(3071, 202, 'Lubombo', 'L', 0),
(3072, 202, 'Manzini', 'M', 0),
(3073, 202, 'Shishelweni', 'S', 0),
(3074, 203, 'Blekinge', 'K', 0),
(3075, 203, 'Dalarna', 'W', 0),
(3076, 203, 'G&auml;vleborg', 'X', 0),
(3077, 203, 'Gotland', 'I', 0),
(3078, 203, 'Halland', 'N', 0),
(3079, 203, 'J&auml;mtland', 'Z', 0),
(3080, 203, 'J&ouml;nk&ouml;ping', 'F', 0),
(3081, 203, 'Kalmar', 'H', 0),
(3082, 203, 'Kronoberg', 'G', 0),
(3083, 203, 'Norrbotten', 'BD', 0),
(3084, 203, '&Ouml;rebro', 'T', 0),
(3085, 203, '&Ouml;sterg&ouml;tland', 'E', 0),
(3086, 203, 'Sk&aring;ne', 'M', 0),
(3087, 203, 'S&ouml;dermanland', 'D', 0),
(3088, 203, 'Stockholm', 'AB', 0),
(3089, 203, 'Uppsala', 'C', 0),
(3090, 203, 'V&auml;rmland', 'S', 0),
(3091, 203, 'V&auml;sterbotten', 'AC', 0),
(3092, 203, 'V&auml;sternorrland', 'Y', 0),
(3093, 203, 'V&auml;stmanland', 'U', 0),
(3094, 203, 'V&auml;stra G&ouml;taland', 'O', 0),
(3095, 204, 'Aargau', 'AG', 0),
(3096, 204, 'Appenzell Ausserrhoden', 'AR', 0),
(3097, 204, 'Appenzell Innerrhoden', 'AI', 0),
(3098, 204, 'Basel-Stadt', 'BS', 0),
(3099, 204, 'Basel-Landschaft', 'BL', 0),
(3100, 204, 'Bern', 'BE', 0),
(3101, 204, 'Fribourg', 'FR', 0),
(3102, 204, 'Gen&egrave;ve', 'GE', 0),
(3103, 204, 'Glarus', 'GL', 0),
(3104, 204, 'Graub&uuml;nden', 'GR', 0),
(3105, 204, 'Jura', 'JU', 0),
(3106, 204, 'Luzern', 'LU', 0),
(3107, 204, 'Neuch&acirc;tel', 'NE', 0),
(3108, 204, 'Nidwald', 'NW', 0),
(3109, 204, 'Obwald', 'OW', 0),
(3110, 204, 'St. Gallen', 'SG', 0),
(3111, 204, 'Schaffhausen', 'SH', 0),
(3112, 204, 'Schwyz', 'SZ', 0),
(3113, 204, 'Solothurn', 'SO', 0),
(3114, 204, 'Thurgau', 'TG', 0),
(3115, 204, 'Ticino', 'TI', 0),
(3116, 204, 'Uri', 'UR', 0),
(3117, 204, 'Valais', 'VS', 0),
(3118, 204, 'Vaud', 'VD', 0),
(3119, 204, 'Zug', 'ZG', 0),
(3120, 204, 'Z&uuml;rich', 'ZH', 0),
(3135, 206, 'Chang-hua', 'CH', 0),
(3136, 206, 'Chia-i', 'CI', 0),
(3137, 206, 'Hsin-chu', 'HS', 0),
(3138, 206, 'Hua-lien', 'HL', 0),
(3139, 206, 'I-lan', 'IL', 0),
(3140, 206, 'Kao-hsiung county', 'KH', 0),
(3141, 206, 'Kin-men', 'KM', 0),
(3142, 206, 'Lien-chiang', 'LC', 0),
(3143, 206, 'Miao-li', 'ML', 0),
(3144, 206, 'Nan-t''ou', 'NT', 0),
(3145, 206, 'P''eng-hu', 'PH', 0),
(3146, 206, 'P''ing-tung', 'PT', 0),
(3147, 206, 'T''ai-chung', 'TG', 0),
(3148, 206, 'T''ai-nan', 'TA', 0),
(3149, 206, 'T''ai-pei county', 'TP', 0),
(3150, 206, 'T''ai-tung', 'TT', 0),
(3151, 206, 'T''ao-yuan', 'TY', 0),
(3152, 206, 'Yun-lin', 'YL', 0),
(3153, 206, 'Chia-i city', 'CC', 0),
(3154, 206, 'Chi-lung', 'CL', 0),
(3155, 206, 'Hsin-chu', 'HC', 0),
(3156, 206, 'T''ai-chung', 'TH', 0),
(3157, 206, 'T''ai-nan', 'TN', 0),
(3158, 206, 'Kao-hsiung city', 'KC', 0),
(3159, 206, 'T''ai-pei city', 'TC', 0),
(3160, 207, 'Gorno-Badakhstan', 'GB', 0),
(3161, 207, 'Khatlon', 'KT', 0),
(3162, 207, 'Sughd', 'SU', 0),
(3163, 208, 'Arusha', 'AR', 0),
(3164, 208, 'Dar es Salaam', 'DS', 0),
(3165, 208, 'Dodoma', 'DO', 0),
(3166, 208, 'Iringa', 'IR', 0),
(3167, 208, 'Kagera', 'KA', 0),
(3168, 208, 'Kigoma', 'KI', 0),
(3169, 208, 'Kilimanjaro', 'KJ', 0),
(3170, 208, 'Lindi', 'LN', 0),
(3171, 208, 'Manyara', 'MY', 0),
(3172, 208, 'Mara', 'MR', 0),
(3173, 208, 'Mbeya', 'MB', 0),
(3174, 208, 'Morogoro', 'MO', 0),
(3175, 208, 'Mtwara', 'MT', 0),
(3176, 208, 'Mwanza', 'MW', 0),
(3177, 208, 'Pemba North', 'PN', 0),
(3178, 208, 'Pemba South', 'PS', 0),
(3179, 208, 'Pwani', 'PW', 0),
(3180, 208, 'Rukwa', 'RK', 0),
(3181, 208, 'Ruvuma', 'RV', 0),
(3182, 208, 'Shinyanga', 'SH', 0),
(3183, 208, 'Singida', 'SI', 0),
(3184, 208, 'Tabora', 'TB', 0),
(3185, 208, 'Tanga', 'TN', 0),
(3186, 208, 'Zanzibar Central/South', 'ZC', 0),
(3187, 208, 'Zanzibar North', 'ZN', 0),
(3188, 208, 'Zanzibar Urban/West', 'ZU', 0),
(3189, 209, 'Amnat Charoen', 'Amnat Charoen', 0),
(3190, 209, 'Ang Thong', 'Ang Thong', 0),
(3191, 209, 'Ayutthaya', 'Ayutthaya', 0),
(3192, 209, 'Bangkok', 'Bangkok', 0),
(3193, 209, 'Buriram', 'Buriram', 0),
(3194, 209, 'Chachoengsao', 'Chachoengsao', 0),
(3195, 209, 'Chai Nat', 'Chai Nat', 0),
(3196, 209, 'Chaiyaphum', 'Chaiyaphum', 0),
(3197, 209, 'Chanthaburi', 'Chanthaburi', 0),
(3198, 209, 'Chiang Mai', 'Chiang Mai', 0),
(3199, 209, 'Chiang Rai', 'Chiang Rai', 0),
(3200, 209, 'Chon Buri', 'Chon Buri', 0),
(3201, 209, 'Chumphon', 'Chumphon', 0),
(3202, 209, 'Kalasin', 'Kalasin', 0),
(3203, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', 0),
(3204, 209, 'Kanchanaburi', 'Kanchanaburi', 0),
(3205, 209, 'Khon Kaen', 'Khon Kaen', 0),
(3206, 209, 'Krabi', 'Krabi', 0),
(3207, 209, 'Lampang', 'Lampang', 0),
(3208, 209, 'Lamphun', 'Lamphun', 0),
(3209, 209, 'Loei', 'Loei', 0),
(3210, 209, 'Lop Buri', 'Lop Buri', 0),
(3211, 209, 'Mae Hong Son', 'Mae Hong Son', 0),
(3212, 209, 'Maha Sarakham', 'Maha Sarakham', 0),
(3213, 209, 'Mukdahan', 'Mukdahan', 0),
(3214, 209, 'Nakhon Nayok', 'Nakhon Nayok', 0),
(3215, 209, 'Nakhon Pathom', 'Nakhon Pathom', 0),
(3216, 209, 'Nakhon Phanom', 'Nakhon Phanom', 0),
(3217, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', 0),
(3218, 209, 'Nakhon Sawan', 'Nakhon Sawan', 0),
(3219, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', 0),
(3220, 209, 'Nan', 'Nan', 0),
(3221, 209, 'Narathiwat', 'Narathiwat', 0),
(3222, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', 0),
(3223, 209, 'Nong Khai', 'Nong Khai', 0),
(3224, 209, 'Nonthaburi', 'Nonthaburi', 0),
(3225, 209, 'Pathum Thani', 'Pathum Thani', 0),
(3226, 209, 'Pattani', 'Pattani', 0),
(3227, 209, 'Phangnga', 'Phangnga', 0),
(3228, 209, 'Phatthalung', 'Phatthalung', 0),
(3229, 209, 'Phayao', 'Phayao', 0),
(3230, 209, 'Phetchabun', 'Phetchabun', 0),
(3231, 209, 'Phetchaburi', 'Phetchaburi', 0),
(3232, 209, 'Phichit', 'Phichit', 0),
(3233, 209, 'Phitsanulok', 'Phitsanulok', 0),
(3234, 209, 'Phrae', 'Phrae', 0),
(3235, 209, 'Phuket', 'Phuket', 0),
(3236, 209, 'Prachin Buri', 'Prachin Buri', 0),
(3237, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', 0),
(3238, 209, 'Ranong', 'Ranong', 0),
(3239, 209, 'Ratchaburi', 'Ratchaburi', 0),
(3240, 209, 'Rayong', 'Rayong', 0),
(3241, 209, 'Roi Et', 'Roi Et', 0),
(3242, 209, 'Sa Kaeo', 'Sa Kaeo', 0),
(3243, 209, 'Sakon Nakhon', 'Sakon Nakhon', 0),
(3244, 209, 'Samut Prakan', 'Samut Prakan', 0),
(3245, 209, 'Samut Sakhon', 'Samut Sakhon', 0),
(3246, 209, 'Samut Songkhram', 'Samut Songkhram', 0),
(3247, 209, 'Sara Buri', 'Sara Buri', 0),
(3248, 209, 'Satun', 'Satun', 0),
(3249, 209, 'Sing Buri', 'Sing Buri', 0),
(3250, 209, 'Sisaket', 'Sisaket', 0),
(3251, 209, 'Songkhla', 'Songkhla', 0),
(3252, 209, 'Sukhothai', 'Sukhothai', 0),
(3253, 209, 'Suphan Buri', 'Suphan Buri', 0),
(3254, 209, 'Surat Thani', 'Surat Thani', 0),
(3255, 209, 'Surin', 'Surin', 0),
(3256, 209, 'Tak', 'Tak', 0),
(3257, 209, 'Trang', 'Trang', 0),
(3258, 209, 'Trat', 'Trat', 0),
(3259, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', 0),
(3260, 209, 'Udon Thani', 'Udon Thani', 0),
(3261, 209, 'Uthai Thani', 'Uthai Thani', 0),
(3262, 209, 'Uttaradit', 'Uttaradit', 0),
(3263, 209, 'Yala', 'Yala', 0),
(3264, 209, 'Yasothon', 'Yasothon', 0),
(3265, 210, 'Kara', 'K', 0),
(3266, 210, 'Plateaux', 'P', 0),
(3267, 210, 'Savanes', 'S', 0),
(3268, 210, 'Centrale', 'C', 0),
(3269, 210, 'Maritime', 'M', 0),
(3270, 211, 'Atafu', 'A', 0),
(3271, 211, 'Fakaofo', 'F', 0),
(3272, 211, 'Nukunonu', 'N', 0),
(3273, 212, 'Ha''apai', 'H', 0),
(3274, 212, 'Tongatapu', 'T', 0),
(3275, 212, 'Vava''u', 'V', 0),
(3276, 213, 'Couva/Tabaquite/Talparo', 'CT', 0),
(3277, 213, 'Diego Martin', 'DM', 0),
(3278, 213, 'Mayaro/Rio Claro', 'MR', 0),
(3279, 213, 'Penal/Debe', 'PD', 0),
(3280, 213, 'Princes Town', 'PT', 0),
(3281, 213, 'Sangre Grande', 'SG', 0),
(3282, 213, 'San Juan/Laventille', 'SL', 0),
(3283, 213, 'Siparia', 'SI', 0),
(3284, 213, 'Tunapuna/Piarco', 'TP', 0),
(3285, 213, 'Port of Spain', 'PS', 0),
(3286, 213, 'San Fernando', 'SF', 0),
(3287, 213, 'Arima', 'AR', 0),
(3288, 213, 'Point Fortin', 'PF', 0),
(3289, 213, 'Chaguanas', 'CH', 0),
(3290, 213, 'Tobago', 'TO', 0),
(3291, 214, 'Ariana', 'AR', 0),
(3292, 214, 'Beja', 'BJ', 0),
(3293, 214, 'Ben Arous', 'BA', 0),
(3294, 214, 'Bizerte', 'BI', 0),
(3295, 214, 'Gabes', 'GB', 0),
(3296, 214, 'Gafsa', 'GF', 0),
(3297, 214, 'Jendouba', 'JE', 0),
(3298, 214, 'Kairouan', 'KR', 0),
(3299, 214, 'Kasserine', 'KS', 0),
(3300, 214, 'Kebili', 'KB', 0),
(3301, 214, 'Kef', 'KF', 0),
(3302, 214, 'Mahdia', 'MH', 0),
(3303, 214, 'Manouba', 'MN', 0),
(3304, 214, 'Medenine', 'ME', 0),
(3305, 214, 'Monastir', 'MO', 0),
(3306, 214, 'Nabeul', 'NA', 0),
(3307, 214, 'Sfax', 'SF', 0),
(3308, 214, 'Sidi', 'SD', 0),
(3309, 214, 'Siliana', 'SL', 0),
(3310, 214, 'Sousse', 'SO', 0),
(3311, 214, 'Tataouine', 'TA', 0),
(3312, 214, 'Tozeur', 'TO', 0),
(3313, 214, 'Tunis', 'TU', 0),
(3314, 214, 'Zaghouan', 'ZA', 0),
(3315, 215, 'Adana', 'ADA', 0),
(3316, 215, 'Adıyaman', 'ADI', 0),
(3317, 215, 'Afyonkarahisar', 'AFY', 0),
(3318, 215, 'Ağrı', 'AGR', 0),
(3319, 215, 'Aksaray', 'AKS', 0),
(3320, 215, 'Amasya', 'AMA', 0),
(3321, 215, 'Ankara', 'ANK', 0),
(3322, 215, 'Antalya', 'ANT', 0),
(3323, 215, 'Ardahan', 'ARD', 0),
(3324, 215, 'Artvin', 'ART', 0),
(3325, 215, 'Aydın', 'AYI', 0),
(3326, 215, 'Balıkesir', 'BAL', 0),
(3327, 215, 'Bartın', 'BAR', 0),
(3328, 215, 'Batman', 'BAT', 0),
(3329, 215, 'Bayburt', 'BAY', 0),
(3330, 215, 'Bilecik', 'BIL', 0),
(3331, 215, 'Bingöl', 'BIN', 0),
(3332, 215, 'Bitlis', 'BIT', 0),
(3333, 215, 'Bolu', 'BOL', 0),
(3334, 215, 'Burdur', 'BRD', 0),
(3335, 215, 'Bursa', 'BRS', 0),
(3336, 215, 'Çanakkale', 'CKL', 0),
(3337, 215, 'Çankırı', 'CKR', 0),
(3338, 215, 'Çorum', 'COR', 0),
(3339, 215, 'Denizli', 'DEN', 0),
(3340, 215, 'Diyarbakir', 'DIY', 0),
(3341, 215, 'Düzce', 'DUZ', 0),
(3342, 215, 'Edirne', 'EDI', 0),
(3343, 215, 'Elazığ', 'ELA', 0),
(3344, 215, 'Erzincan', 'EZC', 0),
(3345, 215, 'Erzurum', 'EZR', 0),
(3346, 215, 'Eskişehir', 'ESK', 0),
(3347, 215, 'Gaziantep', 'GAZ', 0),
(3348, 215, 'Giresun', 'GIR', 0),
(3349, 215, 'Gümüşhane', 'GMS', 0),
(3350, 215, 'Hakkari', 'HKR', 0),
(3351, 215, 'Hatay', 'HTY', 0),
(3352, 215, 'Iğdır', 'IGD', 0),
(3353, 215, 'Isparta', 'ISP', 0),
(3354, 215, 'İstanbul', 'IST', 0),
(3355, 215, 'İzmir', 'IZM', 0),
(3356, 215, 'Kahramanmaraş', 'KAH', 0),
(3357, 215, 'Karabük', 'KRB', 0),
(3358, 215, 'Karaman', 'KRM', 0),
(3359, 215, 'Kars', 'KRS', 0),
(3360, 215, 'Kastamonu', 'KAS', 0),
(3361, 215, 'Kayseri', 'KAY', 0),
(3362, 215, 'Kilis', 'KLS', 0),
(3363, 215, 'Kırıkkale', 'KRK', 0),
(3364, 215, 'Kırklareli', 'KLR', 0),
(3365, 215, 'Kırşehir', 'KRH', 0),
(3366, 215, 'Kocaeli', 'KOC', 0),
(3367, 215, 'Konya', 'KON', 0),
(3368, 215, 'Kütahya', 'KUT', 0),
(3369, 215, 'Malatya', 'MAL', 0),
(3370, 215, 'Manisa', 'MAN', 0),
(3371, 215, 'Mardin', 'MAR', 0),
(3372, 215, 'Mersin', 'MER', 0),
(3373, 215, 'Muğla', 'MUG', 0),
(3374, 215, 'Muş', 'MUS', 0),
(3375, 215, 'Nevşehir', 'NEV', 0),
(3376, 215, 'Niğde', 'NIG', 0),
(3377, 215, 'Ordu', 'ORD', 0),
(3378, 215, 'Osmaniye', 'OSM', 0),
(3379, 215, 'Rize', 'RIZ', 0),
(3380, 215, 'Sakarya', 'SAK', 0),
(3381, 215, 'Samsun', 'SAM', 0),
(3382, 215, 'Şanlıurfa', 'SAN', 0),
(3383, 215, 'Siirt', 'SII', 0),
(3384, 215, 'Sinop', 'SIN', 0),
(3385, 215, 'Şırnak', 'SIR', 0),
(3386, 215, 'Sivas', 'SIV', 0),
(3387, 215, 'Tekirdağ', 'TEL', 0),
(3388, 215, 'Tokat', 'TOK', 0),
(3389, 215, 'Trabzon', 'TRA', 0),
(3390, 215, 'Tunceli', 'TUN', 0),
(3391, 215, 'Uşak', 'USK', 0),
(3392, 215, 'Van', 'VAN', 0),
(3393, 215, 'Yalova', 'YAL', 0),
(3394, 215, 'Yozgat', 'YOZ', 0),
(3395, 215, 'Zonguldak', 'ZON', 0),
(3396, 216, 'Ahal Welayaty', 'A', 0),
(3397, 216, 'Balkan Welayaty', 'B', 0),
(3398, 216, 'Dashhowuz Welayaty', 'D', 0),
(3399, 216, 'Lebap Welayaty', 'L', 0),
(3400, 216, 'Mary Welayaty', 'M', 0),
(3401, 217, 'Ambergris Cays', 'AC', 0),
(3402, 217, 'Dellis Cay', 'DC', 0),
(3403, 217, 'French Cay', 'FC', 0),
(3404, 217, 'Little Water Cay', 'LW', 0),
(3405, 217, 'Parrot Cay', 'RC', 0),
(3406, 217, 'Pine Cay', 'PN', 0),
(3407, 217, 'Salt Cay', 'SL', 0),
(3408, 217, 'Grand Turk', 'GT', 0),
(3409, 217, 'South Caicos', 'SC', 0),
(3410, 217, 'East Caicos', 'EC', 0),
(3411, 217, 'Middle Caicos', 'MC', 0),
(3412, 217, 'North Caicos', 'NC', 0),
(3413, 217, 'Providenciales', 'PR', 0),
(3414, 217, 'West Caicos', 'WC', 0),
(3415, 218, 'Nanumanga', 'NMG', 0),
(3416, 218, 'Niulakita', 'NLK', 0),
(3417, 218, 'Niutao', 'NTO', 0),
(3418, 218, 'Funafuti', 'FUN', 0),
(3419, 218, 'Nanumea', 'NME', 0),
(3420, 218, 'Nui', 'NUI', 0),
(3421, 218, 'Nukufetau', 'NFT', 0),
(3422, 218, 'Nukulaelae', 'NLL', 0),
(3423, 218, 'Vaitupu', 'VAI', 0),
(3424, 219, 'Kalangala', 'KAL', 0),
(3425, 219, 'Kampala', 'KMP', 0),
(3426, 219, 'Kayunga', 'KAY', 0),
(3427, 219, 'Kiboga', 'KIB', 0),
(3428, 219, 'Luwero', 'LUW', 0),
(3429, 219, 'Masaka', 'MAS', 0),
(3430, 219, 'Mpigi', 'MPI', 0),
(3431, 219, 'Mubende', 'MUB', 0),
(3432, 219, 'Mukono', 'MUK', 0),
(3433, 219, 'Nakasongola', 'NKS', 0),
(3434, 219, 'Rakai', 'RAK', 0),
(3435, 219, 'Sembabule', 'SEM', 0),
(3436, 219, 'Wakiso', 'WAK', 0),
(3437, 219, 'Bugiri', 'BUG', 0),
(3438, 219, 'Busia', 'BUS', 0),
(3439, 219, 'Iganga', 'IGA', 0),
(3440, 219, 'Jinja', 'JIN', 0),
(3441, 219, 'Kaberamaido', 'KAB', 0),
(3442, 219, 'Kamuli', 'KML', 0),
(3443, 219, 'Kapchorwa', 'KPC', 0),
(3444, 219, 'Katakwi', 'KTK', 0),
(3445, 219, 'Kumi', 'KUM', 0),
(3446, 219, 'Mayuge', 'MAY', 0),
(3447, 219, 'Mbale', 'MBA', 0),
(3448, 219, 'Pallisa', 'PAL', 0),
(3449, 219, 'Sironko', 'SIR', 0),
(3450, 219, 'Soroti', 'SOR', 0),
(3451, 219, 'Tororo', 'TOR', 0),
(3452, 219, 'Adjumani', 'ADJ', 0),
(3453, 219, 'Apac', 'APC', 0),
(3454, 219, 'Arua', 'ARU', 0),
(3455, 219, 'Gulu', 'GUL', 0),
(3456, 219, 'Kitgum', 'KIT', 0),
(3457, 219, 'Kotido', 'KOT', 0),
(3458, 219, 'Lira', 'LIR', 0),
(3459, 219, 'Moroto', 'MRT', 0),
(3460, 219, 'Moyo', 'MOY', 0),
(3461, 219, 'Nakapiripirit', 'NAK', 0),
(3462, 219, 'Nebbi', 'NEB', 0),
(3463, 219, 'Pader', 'PAD', 0),
(3464, 219, 'Yumbe', 'YUM', 0),
(3465, 219, 'Bundibugyo', 'BUN', 0),
(3466, 219, 'Bushenyi', 'BSH', 0),
(3467, 219, 'Hoima', 'HOI', 0),
(3468, 219, 'Kabale', 'KBL', 0),
(3469, 219, 'Kabarole', 'KAR', 0),
(3470, 219, 'Kamwenge', 'KAM', 0),
(3471, 219, 'Kanungu', 'KAN', 0);
INSERT INTO `ocx_zone` VALUES
(3472, 219, 'Kasese', 'KAS', 0),
(3473, 219, 'Kibaale', 'KBA', 0),
(3474, 219, 'Kisoro', 'KIS', 0),
(3475, 219, 'Kyenjojo', 'KYE', 0),
(3476, 219, 'Masindi', 'MSN', 0),
(3477, 219, 'Mbarara', 'MBR', 0),
(3478, 219, 'Ntungamo', 'NTU', 0),
(3479, 219, 'Rukungiri', 'RUK', 0),
(3480, 220, 'Cherkasy', 'CK', 0),
(3481, 220, 'Chernihiv', 'CH', 0),
(3482, 220, 'Chernivtsi', 'CV', 0),
(3483, 220, 'Crimea', 'CR', 0),
(3484, 220, 'Dnipropetrovs''k', 'DN', 0),
(3485, 220, 'Donets''k', 'DO', 0),
(3486, 220, 'Ivano-Frankivs''k', 'IV', 0),
(3487, 220, 'Kharkiv Kherson', 'KL', 0),
(3488, 220, 'Khmel''nyts''kyy', 'KM', 0),
(3489, 220, 'Kirovohrad', 'KR', 0),
(3490, 220, 'Kiev', 'KV', 0),
(3491, 220, 'Kyyiv', 'KY', 0),
(3492, 220, 'Luhans''k', 'LU', 0),
(3493, 220, 'L''viv', 'LV', 0),
(3494, 220, 'Mykolayiv', 'MY', 0),
(3495, 220, 'Odesa', 'OD', 0),
(3496, 220, 'Poltava', 'PO', 0),
(3497, 220, 'Rivne', 'RI', 0),
(3498, 220, 'Sevastopol', 'SE', 0),
(3499, 220, 'Sumy', 'SU', 0),
(3500, 220, 'Ternopil''', 'TE', 0),
(3501, 220, 'Vinnytsya', 'VI', 0),
(3502, 220, 'Volyn''', 'VO', 0),
(3503, 220, 'Zakarpattya', 'ZK', 0),
(3504, 220, 'Zaporizhzhya', 'ZA', 0),
(3505, 220, 'Zhytomyr', 'ZH', 0),
(3506, 221, 'Abu Zaby', 'AZ', 0),
(3507, 221, '''Ajman', 'AJ', 0),
(3508, 221, 'Al Fujayrah', 'FU', 0),
(3509, 221, 'Ash Shariqah', 'SH', 0),
(3510, 221, 'Dubayy', 'DU', 0),
(3511, 221, 'R''as al Khaymah', 'RK', 0),
(3512, 221, 'Umm al Qaywayn', 'UQ', 0),
(3513, 222, 'Aberdeen', 'ABN', 1),
(3514, 222, 'Aberdeenshire', 'ABNS', 1),
(3515, 222, 'Anglesey', 'ANG', 1),
(3516, 222, 'Angus', 'AGS', 1),
(3517, 222, 'Argyll and Bute', 'ARY', 1),
(3518, 222, 'Bedfordshire', 'BEDS', 1),
(3519, 222, 'Berkshire', 'BERKS', 1),
(3520, 222, 'Blaenau Gwent', 'BLA', 1),
(3521, 222, 'Bridgend', 'BRI', 1),
(3522, 222, 'Bristol', 'BSTL', 1),
(3523, 222, 'Buckinghamshire', 'BUCKS', 1),
(3524, 222, 'Caerphilly', 'CAE', 1),
(3525, 222, 'Cambridgeshire', 'CAMBS', 1),
(3526, 222, 'Cardiff', 'CDF', 1),
(3527, 222, 'Carmarthenshire', 'CARM', 1),
(3528, 222, 'Ceredigion', 'CDGN', 1),
(3529, 222, 'Cheshire', 'CHES', 1),
(3530, 222, 'Clackmannanshire', 'CLACK', 1),
(3531, 222, 'Conwy', 'CON', 1),
(3532, 222, 'Cornwall', 'CORN', 1),
(3533, 222, 'Denbighshire', 'DNBG', 1),
(3534, 222, 'Derbyshire', 'DERBY', 1),
(3535, 222, 'Devon', 'DVN', 1),
(3536, 222, 'Dorset', 'DOR', 1),
(3537, 222, 'Dumfries and Galloway', 'DGL', 1),
(3538, 222, 'Dundee', 'DUND', 1),
(3539, 222, 'Durham', 'DHM', 1),
(3540, 222, 'East Ayrshire', 'ARYE', 1),
(3541, 222, 'East Dunbartonshire', 'DUNBE', 1),
(3542, 222, 'East Lothian', 'LOTE', 1),
(3543, 222, 'East Renfrewshire', 'RENE', 1),
(3544, 222, 'East Riding of Yorkshire', 'ERYS', 1),
(3545, 222, 'East Sussex', 'SXE', 1),
(3546, 222, 'Edinburgh', 'EDIN', 1),
(3547, 222, 'Essex', 'ESX', 1),
(3548, 222, 'Falkirk', 'FALK', 1),
(3549, 222, 'Fife', 'FFE', 1),
(3550, 222, 'Flintshire', 'FLINT', 1),
(3551, 222, 'Glasgow', 'GLAS', 1),
(3552, 222, 'Gloucestershire', 'GLOS', 1),
(3553, 222, 'Greater London', 'LDN', 1),
(3554, 222, 'Greater Manchester', 'MCH', 1),
(3555, 222, 'Gwynedd', 'GDD', 1),
(3556, 222, 'Hampshire', 'HANTS', 1),
(3557, 222, 'Herefordshire', 'HWR', 1),
(3558, 222, 'Hertfordshire', 'HERTS', 1),
(3559, 222, 'Highlands', 'HLD', 1),
(3560, 222, 'Inverclyde', 'IVER', 1),
(3561, 222, 'Isle of Wight', 'IOW', 1),
(3562, 222, 'Kent', 'KNT', 1),
(3563, 222, 'Lancashire', 'LANCS', 1),
(3564, 222, 'Leicestershire', 'LEICS', 1),
(3565, 222, 'Lincolnshire', 'LINCS', 1),
(3566, 222, 'Merseyside', 'MSY', 1),
(3567, 222, 'Merthyr Tydfil', 'MERT', 1),
(3568, 222, 'Midlothian', 'MLOT', 1),
(3569, 222, 'Monmouthshire', 'MMOUTH', 1),
(3570, 222, 'Moray', 'MORAY', 1),
(3571, 222, 'Neath Port Talbot', 'NPRTAL', 1),
(3572, 222, 'Newport', 'NEWPT', 1),
(3573, 222, 'Norfolk', 'NOR', 1),
(3574, 222, 'North Ayrshire', 'ARYN', 1),
(3575, 222, 'North Lanarkshire', 'LANN', 1),
(3576, 222, 'North Yorkshire', 'YSN', 1),
(3577, 222, 'Northamptonshire', 'NHM', 1),
(3578, 222, 'Northumberland', 'NLD', 1),
(3579, 222, 'Nottinghamshire', 'NOT', 1),
(3580, 222, 'Orkney Islands', 'ORK', 1),
(3581, 222, 'Oxfordshire', 'OFE', 1),
(3582, 222, 'Pembrokeshire', 'PEM', 1),
(3583, 222, 'Perth and Kinross', 'PERTH', 1),
(3584, 222, 'Powys', 'PWS', 1),
(3585, 222, 'Renfrewshire', 'REN', 1),
(3586, 222, 'Rhondda Cynon Taff', 'RHON', 1),
(3587, 222, 'Rutland', 'RUT', 1),
(3588, 222, 'Scottish Borders', 'BOR', 1),
(3589, 222, 'Shetland Islands', 'SHET', 1),
(3590, 222, 'Shropshire', 'SPE', 1),
(3591, 222, 'Somerset', 'SOM', 1),
(3592, 222, 'South Ayrshire', 'ARYS', 1),
(3593, 222, 'South Lanarkshire', 'LANS', 1),
(3594, 222, 'South Yorkshire', 'YSS', 1),
(3595, 222, 'Staffordshire', 'SFD', 1),
(3596, 222, 'Stirling', 'STIR', 1),
(3597, 222, 'Suffolk', 'SFK', 1),
(3598, 222, 'Surrey', 'SRY', 1),
(3599, 222, 'Swansea', 'SWAN', 1),
(3600, 222, 'Torfaen', 'TORF', 1),
(3601, 222, 'Tyne and Wear', 'TWR', 1),
(3602, 222, 'Vale of Glamorgan', 'VGLAM', 1),
(3603, 222, 'Warwickshire', 'WARKS', 1),
(3604, 222, 'West Dunbartonshire', 'WDUN', 1),
(3605, 222, 'West Lothian', 'WLOT', 1),
(3606, 222, 'West Midlands', 'WMD', 1),
(3607, 222, 'West Sussex', 'SXW', 1),
(3608, 222, 'West Yorkshire', 'YSW', 1),
(3609, 222, 'Western Isles', 'WIL', 1),
(3610, 222, 'Wiltshire', 'WLT', 1),
(3611, 222, 'Worcestershire', 'WORCS', 1),
(3612, 222, 'Wrexham', 'WRX', 1),
(3613, 223, 'Alabama', 'AL', 1),
(3614, 223, 'Alaska', 'AK', 1),
(3615, 223, 'American Samoa', 'AS', 1),
(3616, 223, 'Arizona', 'AZ', 1),
(3617, 223, 'Arkansas', 'AR', 1),
(3618, 223, 'Armed Forces Africa', 'AF', 1),
(3619, 223, 'Armed Forces Americas', 'AA', 1),
(3620, 223, 'Armed Forces Canada', 'AC', 1),
(3621, 223, 'Armed Forces Europe', 'AE', 1),
(3622, 223, 'Armed Forces Middle East', 'AM', 1),
(3623, 223, 'Armed Forces Pacific', 'AP', 1),
(3624, 223, 'California', 'CA', 1),
(3625, 223, 'Colorado', 'CO', 1),
(3626, 223, 'Connecticut', 'CT', 1),
(3627, 223, 'Delaware', 'DE', 1),
(3628, 223, 'District of Columbia', 'DC', 1),
(3629, 223, 'Federated States Of Micronesia', 'FM', 1),
(3630, 223, 'Florida', 'FL', 1),
(3631, 223, 'Georgia', 'GA', 1),
(3632, 223, 'Guam', 'GU', 1),
(3633, 223, 'Hawaii', 'HI', 1),
(3634, 223, 'Idaho', 'ID', 1),
(3635, 223, 'Illinois', 'IL', 1),
(3636, 223, 'Indiana', 'IN', 1),
(3637, 223, 'Iowa', 'IA', 1),
(3638, 223, 'Kansas', 'KS', 1),
(3639, 223, 'Kentucky', 'KY', 1),
(3640, 223, 'Louisiana', 'LA', 1),
(3641, 223, 'Maine', 'ME', 1),
(3642, 223, 'Marshall Islands', 'MH', 1),
(3643, 223, 'Maryland', 'MD', 1),
(3644, 223, 'Massachusetts', 'MA', 1),
(3645, 223, 'Michigan', 'MI', 1),
(3646, 223, 'Minnesota', 'MN', 1),
(3647, 223, 'Mississippi', 'MS', 1),
(3648, 223, 'Missouri', 'MO', 1),
(3649, 223, 'Montana', 'MT', 1),
(3650, 223, 'Nebraska', 'NE', 1),
(3651, 223, 'Nevada', 'NV', 1),
(3652, 223, 'New Hampshire', 'NH', 1),
(3653, 223, 'New Jersey', 'NJ', 1),
(3654, 223, 'New Mexico', 'NM', 1),
(3655, 223, 'New York', 'NY', 1),
(3656, 223, 'North Carolina', 'NC', 1),
(3657, 223, 'North Dakota', 'ND', 1),
(3658, 223, 'Northern Mariana Islands', 'MP', 1),
(3659, 223, 'Ohio', 'OH', 1),
(3660, 223, 'Oklahoma', 'OK', 1),
(3661, 223, 'Oregon', 'OR', 1),
(3662, 223, 'Palau', 'PW', 1),
(3663, 223, 'Pennsylvania', 'PA', 1),
(3664, 223, 'Puerto Rico', 'PR', 1),
(3665, 223, 'Rhode Island', 'RI', 1),
(3666, 223, 'South Carolina', 'SC', 1),
(3667, 223, 'South Dakota', 'SD', 1),
(3668, 223, 'Tennessee', 'TN', 1),
(3669, 223, 'Texas', 'TX', 1),
(3670, 223, 'Utah', 'UT', 1),
(3671, 223, 'Vermont', 'VT', 1),
(3672, 223, 'Virgin Islands', 'VI', 1),
(3673, 223, 'Virginia', 'VA', 1),
(3674, 223, 'Washington', 'WA', 1),
(3675, 223, 'West Virginia', 'WV', 1),
(3676, 223, 'Wisconsin', 'WI', 1),
(3677, 223, 'Wyoming', 'WY', 1),
(3678, 224, 'Baker Island', 'BI', 0),
(3679, 224, 'Howland Island', 'HI', 0),
(3680, 224, 'Jarvis Island', 'JI', 0),
(3681, 224, 'Johnston Atoll', 'JA', 0),
(3682, 224, 'Kingman Reef', 'KR', 0),
(3683, 224, 'Midway Atoll', 'MA', 0),
(3684, 224, 'Navassa Island', 'NI', 0),
(3685, 224, 'Palmyra Atoll', 'PA', 0),
(3686, 224, 'Wake Island', 'WI', 0),
(3687, 225, 'Artigas', 'AR', 0),
(3688, 225, 'Canelones', 'CA', 0),
(3689, 225, 'Cerro Largo', 'CL', 0),
(3690, 225, 'Colonia', 'CO', 0),
(3691, 225, 'Durazno', 'DU', 0),
(3692, 225, 'Flores', 'FS', 0),
(3693, 225, 'Florida', 'FA', 0),
(3694, 225, 'Lavalleja', 'LA', 0),
(3695, 225, 'Maldonado', 'MA', 0),
(3696, 225, 'Montevideo', 'MO', 0),
(3697, 225, 'Paysandu', 'PA', 0),
(3698, 225, 'Rio Negro', 'RN', 0),
(3699, 225, 'Rivera', 'RV', 0),
(3700, 225, 'Rocha', 'RO', 0),
(3701, 225, 'Salto', 'SL', 0),
(3702, 225, 'San Jose', 'SJ', 0),
(3703, 225, 'Soriano', 'SO', 0),
(3704, 225, 'Tacuarembo', 'TA', 0),
(3705, 225, 'Treinta y Tres', 'TT', 0),
(3706, 226, 'Andijon', 'AN', 0),
(3707, 226, 'Buxoro', 'BU', 0),
(3708, 226, 'Farg''ona', 'FA', 0),
(3709, 226, 'Jizzax', 'JI', 0),
(3710, 226, 'Namangan', 'NG', 0),
(3711, 226, 'Navoiy', 'NW', 0),
(3712, 226, 'Qashqadaryo', 'QA', 0),
(3713, 226, 'Qoraqalpog''iston Republikasi', 'QR', 0),
(3714, 226, 'Samarqand', 'SA', 0),
(3715, 226, 'Sirdaryo', 'SI', 0),
(3716, 226, 'Surxondaryo', 'SU', 0),
(3717, 226, 'Toshkent City', 'TK', 0),
(3718, 226, 'Toshkent Region', 'TO', 0),
(3719, 226, 'Xorazm', 'XO', 0),
(3720, 227, 'Malampa', 'MA', 0),
(3721, 227, 'Penama', 'PE', 0),
(3722, 227, 'Sanma', 'SA', 0),
(3723, 227, 'Shefa', 'SH', 0),
(3724, 227, 'Tafea', 'TA', 0),
(3725, 227, 'Torba', 'TO', 0),
(3726, 229, 'Amazonas', 'AM', 0),
(3727, 229, 'Anzoategui', 'AN', 0),
(3728, 229, 'Apure', 'AP', 0),
(3729, 229, 'Aragua', 'AR', 0),
(3730, 229, 'Barinas', 'BA', 0),
(3731, 229, 'Bolivar', 'BO', 0),
(3732, 229, 'Carabobo', 'CA', 0),
(3733, 229, 'Cojedes', 'CO', 0),
(3734, 229, 'Delta Amacuro', 'DA', 0),
(3735, 229, 'Dependencias Federales', 'DF', 0),
(3736, 229, 'Distrito Federal', 'DI', 0),
(3737, 229, 'Falcon', 'FA', 0),
(3738, 229, 'Guarico', 'GU', 0),
(3739, 229, 'Lara', 'LA', 0),
(3740, 229, 'Merida', 'ME', 0),
(3741, 229, 'Miranda', 'MI', 0),
(3742, 229, 'Monagas', 'MO', 0),
(3743, 229, 'Nueva Esparta', 'NE', 0),
(3744, 229, 'Portuguesa', 'PO', 0),
(3745, 229, 'Sucre', 'SU', 0),
(3746, 229, 'Tachira', 'TA', 0),
(3747, 229, 'Trujillo', 'TR', 0),
(3748, 229, 'Vargas', 'VA', 0),
(3749, 229, 'Yaracuy', 'YA', 0),
(3750, 229, 'Zulia', 'ZU', 0),
(3751, 230, 'An Giang', 'AG', 0),
(3752, 230, 'Bac Giang', 'BG', 0),
(3753, 230, 'Bac Kan', 'BK', 0),
(3754, 230, 'Bac Lieu', 'BL', 0),
(3755, 230, 'Bac Ninh', 'BC', 0),
(3756, 230, 'Ba Ria-Vung Tau', 'BR', 0),
(3757, 230, 'Ben Tre', 'BN', 0),
(3758, 230, 'Binh Dinh', 'BH', 0),
(3759, 230, 'Binh Duong', 'BU', 0),
(3760, 230, 'Binh Phuoc', 'BP', 0),
(3761, 230, 'Binh Thuan', 'BT', 0),
(3762, 230, 'Ca Mau', 'CM', 0),
(3763, 230, 'Can Tho', 'CT', 0),
(3764, 230, 'Cao Bang', 'CB', 0),
(3765, 230, 'Dak Lak', 'DL', 0),
(3766, 230, 'Dak Nong', 'DG', 0),
(3767, 230, 'Da Nang', 'DN', 0),
(3768, 230, 'Dien Bien', 'DB', 0),
(3769, 230, 'Dong Nai', 'DI', 0),
(3770, 230, 'Dong Thap', 'DT', 0),
(3771, 230, 'Gia Lai', 'GL', 0),
(3772, 230, 'Ha Giang', 'HG', 0),
(3773, 230, 'Hai Duong', 'HD', 0),
(3774, 230, 'Hai Phong', 'HP', 0),
(3775, 230, 'Ha Nam', 'HM', 0),
(3776, 230, 'Ha Noi', 'HI', 0),
(3777, 230, 'Ha Tay', 'HT', 0),
(3778, 230, 'Ha Tinh', 'HH', 0),
(3779, 230, 'Hoa Binh', 'HB', 0),
(3780, 230, 'Ho Chi Minh City', 'HC', 0),
(3781, 230, 'Hau Giang', 'HU', 0),
(3782, 230, 'Hung Yen', 'HY', 0),
(3783, 232, 'Saint Croix', 'C', 0),
(3784, 232, 'Saint John', 'J', 0),
(3785, 232, 'Saint Thomas', 'T', 0),
(3786, 233, 'Alo', 'A', 0),
(3787, 233, 'Sigave', 'S', 0),
(3788, 233, 'Wallis', 'W', 0),
(3812, 237, 'Bas-Congo', 'BC', 0),
(3813, 237, 'Bandundu', 'BN', 0),
(3814, 237, 'Equateur', 'EQ', 0),
(3815, 237, 'Katanga', 'KA', 0),
(3816, 237, 'Kasai-Oriental', 'KE', 0),
(3817, 237, 'Kinshasa', 'KN', 0),
(3818, 237, 'Kasai-Occidental', 'KW', 0),
(3819, 237, 'Maniema', 'MA', 0),
(3820, 237, 'Nord-Kivu', 'NK', 0),
(3821, 237, 'Orientale', 'OR', 0),
(3822, 237, 'Sud-Kivu', 'SK', 0),
(3823, 238, 'Central', 'CE', 0),
(3824, 238, 'Copperbelt', 'CB', 0),
(3825, 238, 'Eastern', 'EA', 0),
(3826, 238, 'Luapula', 'LP', 0),
(3827, 238, 'Lusaka', 'LK', 0),
(3828, 238, 'Northern', 'NO', 0),
(3829, 238, 'North-Western', 'NW', 0),
(3830, 238, 'Southern', 'SO', 0),
(3831, 238, 'Western', 'WE', 0),
(3842, 105, 'Agrigento', 'AG', 0),
(3843, 105, 'Alessandria', 'AL', 0),
(3844, 105, 'Ancona', 'AN', 0),
(3845, 105, 'Aosta', 'AO', 0),
(3846, 105, 'Arezzo', 'AR', 0),
(3847, 105, 'Ascoli Piceno', 'AP', 0),
(3848, 105, 'Asti', 'AT', 0),
(3849, 105, 'Avellino', 'AV', 0),
(3850, 105, 'Bari', 'BA', 0),
(3851, 105, 'Belluno', 'BL', 0),
(3852, 105, 'Benevento', 'BN', 0),
(3853, 105, 'Bergamo', 'BG', 0),
(3854, 105, 'Biella', 'BI', 0),
(3855, 105, 'Bologna', 'BO', 0),
(3856, 105, 'Bolzano', 'BZ', 0),
(3857, 105, 'Brescia', 'BS', 0),
(3858, 105, 'Brindisi', 'BR', 0),
(3859, 105, 'Cagliari', 'CA', 0),
(3860, 105, 'Caltanissetta', 'CL', 0),
(3861, 105, 'Campobasso', 'CB', 0),
(3862, 105, 'Carbonia-Iglesias', 'CI', 0),
(3863, 105, 'Caserta', 'CE', 0),
(3864, 105, 'Catania', 'CT', 0),
(3865, 105, 'Catanzaro', 'CZ', 0),
(3866, 105, 'Chieti', 'CH', 0),
(3867, 105, 'Como', 'CO', 0),
(3868, 105, 'Cosenza', 'CS', 0),
(3869, 105, 'Cremona', 'CR', 0),
(3870, 105, 'Crotone', 'KR', 0),
(3871, 105, 'Cuneo', 'CN', 0),
(3872, 105, 'Enna', 'EN', 0),
(3873, 105, 'Ferrara', 'FE', 0),
(3874, 105, 'Firenze', 'FI', 0),
(3875, 105, 'Foggia', 'FG', 0),
(3876, 105, 'Forli-Cesena', 'FC', 0),
(3877, 105, 'Frosinone', 'FR', 0),
(3878, 105, 'Genova', 'GE', 0),
(3879, 105, 'Gorizia', 'GO', 0),
(3880, 105, 'Grosseto', 'GR', 0),
(3881, 105, 'Imperia', 'IM', 0),
(3882, 105, 'Isernia', 'IS', 0),
(3883, 105, 'L&#39;Aquila', 'AQ', 0),
(3884, 105, 'La Spezia', 'SP', 0),
(3885, 105, 'Latina', 'LT', 0),
(3886, 105, 'Lecce', 'LE', 0),
(3887, 105, 'Lecco', 'LC', 0),
(3888, 105, 'Livorno', 'LI', 0),
(3889, 105, 'Lodi', 'LO', 0),
(3890, 105, 'Lucca', 'LU', 0),
(3891, 105, 'Macerata', 'MC', 0),
(3892, 105, 'Mantova', 'MN', 0),
(3893, 105, 'Massa-Carrara', 'MS', 0),
(3894, 105, 'Matera', 'MT', 0),
(3895, 105, 'Medio Campidano', 'VS', 0),
(3896, 105, 'Messina', 'ME', 0),
(3897, 105, 'Milano', 'MI', 0),
(3898, 105, 'Modena', 'MO', 0),
(3899, 105, 'Napoli', 'NA', 0),
(3900, 105, 'Novara', 'NO', 0),
(3901, 105, 'Nuoro', 'NU', 0),
(3902, 105, 'Ogliastra', 'OG', 0),
(3903, 105, 'Olbia-Tempio', 'OT', 0),
(3904, 105, 'Oristano', 'OR', 0),
(3905, 105, 'Padova', 'PD', 0),
(3906, 105, 'Palermo', 'PA', 0),
(3907, 105, 'Parma', 'PR', 0),
(3908, 105, 'Pavia', 'PV', 0),
(3909, 105, 'Perugia', 'PG', 0),
(3910, 105, 'Pesaro e Urbino', 'PU', 0),
(3911, 105, 'Pescara', 'PE', 0),
(3912, 105, 'Piacenza', 'PC', 0),
(3913, 105, 'Pisa', 'PI', 0),
(3914, 105, 'Pistoia', 'PT', 0),
(3915, 105, 'Pordenone', 'PN', 0),
(3916, 105, 'Potenza', 'PZ', 0),
(3917, 105, 'Prato', 'PO', 0),
(3918, 105, 'Ragusa', 'RG', 0),
(3919, 105, 'Ravenna', 'RA', 0),
(3920, 105, 'Reggio Calabria', 'RC', 0),
(3921, 105, 'Reggio Emilia', 'RE', 0),
(3922, 105, 'Rieti', 'RI', 0),
(3923, 105, 'Rimini', 'RN', 0),
(3924, 105, 'Roma', 'RM', 0),
(3925, 105, 'Rovigo', 'RO', 0),
(3926, 105, 'Salerno', 'SA', 0),
(3927, 105, 'Sassari', 'SS', 0),
(3928, 105, 'Savona', 'SV', 0),
(3929, 105, 'Siena', 'SI', 0),
(3930, 105, 'Siracusa', 'SR', 0),
(3931, 105, 'Sondrio', 'SO', 0),
(3932, 105, 'Taranto', 'TA', 0),
(3933, 105, 'Teramo', 'TE', 0),
(3934, 105, 'Terni', 'TR', 0),
(3935, 105, 'Torino', 'TO', 0),
(3936, 105, 'Trapani', 'TP', 0),
(3937, 105, 'Trento', 'TN', 0),
(3938, 105, 'Treviso', 'TV', 0),
(3939, 105, 'Trieste', 'TS', 0),
(3940, 105, 'Udine', 'UD', 0),
(3941, 105, 'Varese', 'VA', 0),
(3942, 105, 'Venezia', 'VE', 0),
(3943, 105, 'Verbano-Cusio-Ossola', 'VB', 0),
(3944, 105, 'Vercelli', 'VC', 0),
(3945, 105, 'Verona', 'VR', 0),
(3946, 105, 'Vibo Valentia', 'VV', 0),
(3947, 105, 'Vicenza', 'VI', 0),
(3948, 105, 'Viterbo', 'VT', 0),
(3949, 222, 'County Antrim', 'ANT', 1),
(3950, 222, 'County Armagh', 'ARM', 1),
(3951, 222, 'County Down', 'DOW', 1),
(3952, 222, 'County Fermanagh', 'FER', 1),
(3953, 222, 'County Londonderry', 'LDY', 1),
(3954, 222, 'County Tyrone', 'TYR', 1),
(3955, 222, 'Cumbria', 'CMA', 1),
(3970, 21, 'Brussels-Capital Region', 'BRU', 0),
(3971, 138, 'Aguascalientes', 'AG', 0),
(3972, 222, 'Isle of Man', 'IOM', 1),
(3973, 242, 'Andrijevica', '01', 0),
(3974, 242, 'Bar', '02', 0),
(3975, 242, 'Berane', '03', 0),
(3976, 242, 'Bijelo Polje', '04', 0),
(3977, 242, 'Budva', '05', 0),
(3978, 242, 'Cetinje', '06', 0),
(3979, 242, 'Danilovgrad', '07', 0),
(3980, 242, 'Herceg-Novi', '08', 0),
(3981, 242, 'Kolašin', '09', 0),
(3982, 242, 'Kotor', '10', 0),
(3983, 242, 'Mojkovac', '11', 0),
(3984, 242, 'Nikšić', '12', 0),
(3985, 242, 'Plav', '13', 0),
(3986, 242, 'Pljevlja', '14', 0),
(3987, 242, 'Plužine', '15', 0),
(3988, 242, 'Podgorica', '16', 0),
(3989, 242, 'Rožaje', '17', 0),
(3990, 242, 'Šavnik', '18', 0),
(3991, 242, 'Tivat', '19', 0),
(3992, 242, 'Ulcinj', '20', 0),
(3993, 242, 'Žabljak', '21', 0),
(4020, 245, 'Bonaire', 'BO', 0),
(4021, 245, 'Saba', 'SA', 0),
(4022, 245, 'Sint Eustatius', 'SE', 0),
(4023, 248, 'Central Equatoria', 'EC', 0),
(4024, 248, 'Eastern Equatoria', 'EE', 0),
(4025, 248, 'Jonglei', 'JG', 0),
(4026, 248, 'Lakes', 'LK', 0),
(4027, 248, 'Northern Bahr el-Ghazal', 'BN', 0),
(4028, 248, 'Unity', 'UY', 0),
(4029, 248, 'Upper Nile', 'NU', 0),
(4030, 248, 'Warrap', 'WR', 0),
(4031, 248, 'Western Bahr el-Ghazal', 'BW', 0),
(4032, 248, 'Western Equatoria', 'EW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocx_zone_to_geo_zone`
--

DROP TABLE IF EXISTS `ocx_zone_to_geo_zone`;
CREATE TABLE IF NOT EXISTS `ocx_zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`zone_to_geo_zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Dumping data for table `ocx_zone_to_geo_zone`
--

INSERT INTO `ocx_zone_to_geo_zone` VALUES
(66, 223, 3616, 5, '2014-06-28 00:35:35', '0000-00-00 00:00:00'),
(67, 223, 3616, 6, '2014-06-28 00:36:10', '0000-00-00 00:00:00');
