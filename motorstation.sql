
CREATE TABLE `bnr_mst` (
  `bnrm_id` int(15) NOT NULL,
  `bnrm_name` varchar(250) NOT NULL,
  `bnrm_desc` text,
  `bnrm_imgnm` varchar(250) DEFAULT NULL,
  `bnrm_lnk` varchar(250) DEFAULT NULL,
  `bnrm_prty` int(15) DEFAULT NULL,
  `bnrm_sts` char(1) DEFAULT NULL,
  `bnrm_crtdon` datetime DEFAULT NULL,
  `bnrm_crtdby` varchar(250) DEFAULT NULL,
  `bnrm_mdfdon` datetime DEFAULT NULL,
  `bnrm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bnr_mst`
--

INSERT INTO `bnr_mst` (`bnrm_id`, `bnrm_name`, `bnrm_desc`, `bnrm_imgnm`, `bnrm_lnk`, `bnrm_prty`, `bnrm_sts`, `bnrm_crtdon`, `bnrm_crtdby`, `bnrm_mdfdon`, `bnrm_mdfdby`) VALUES
(2, 'Banner 2', '', 'simg57bedd1dbf33a.jpg', 'http://google.com', 5, 'a', '2015-09-29 06:33:15', 'admin', '2016-12-30 11:02:38', 'admin'),
(1, 'Banner1', '', 'simg57bedeb552c1a.jpg', '1', 3, 'a', '2015-09-29 04:46:30', 'admin', '2016-08-25 06:04:05', 'admin'),
(3, 'Banner 3', '', 'simg57bedef78c9ed.jpg', '', 4, 'a', '2016-08-25 06:05:11', 'admin', '2016-09-01 12:24:51', 'admin'),
(5, 'Banner 4', '', 'simg57c28e1ba9576.jpg', '', 2, 'a', '2016-08-28 01:09:15', 'admin', '2016-09-01 12:25:21', 'admin'),
(6, 'Banner 5', '', 'simg57c28e329f359.jpg', '', 1, 'a', '2016-08-28 01:09:38', 'admin', '2016-09-01 12:25:11', 'admin'),
(7, 'Motor6', '', 'simg57c7c958addd2.png', '', 5, 'i', '2016-09-01 12:23:20', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brnd_mst`
--

CREATE TABLE `brnd_mst` (
  `brndm_id` int(15) NOT NULL,
  `brndm_name` varchar(250) NOT NULL COMMENT 'Name of the brand',
  `brndm_desc` text,
  `brndm_img` varchar(250) DEFAULT NULL,
  `brndm_zmimg` varchar(250) DEFAULT NULL,
  `brndm_seotitle` varchar(250) DEFAULT NULL,
  `brndm_seodesc` text,
  `brndm_seokywrd` text,
  `brndm_seohonetitle` varchar(250) DEFAULT NULL,
  `brndm_seohonedesc` text,
  `brndm_seohtwotitle` varchar(250) DEFAULT NULL,
  `brndm_seohtwodesc` text,
  `brndm_sts` char(1) NOT NULL COMMENT 'Status of the brand',
  `brndm_prty` int(15) NOT NULL COMMENT 'Priority of the brand',
  `brndm_crtdon` date DEFAULT NULL COMMENT 'Date on which the brand is created',
  `brndm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is created',
  `brndm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the brand is modified',
  `brndm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brnd_mst`
--

INSERT INTO `brnd_mst` (`brndm_id`, `brndm_name`, `brndm_desc`, `brndm_img`, `brndm_zmimg`, `brndm_seotitle`, `brndm_seodesc`, `brndm_seokywrd`, `brndm_seohonetitle`, `brndm_seohonedesc`, `brndm_seohtwotitle`, `brndm_seohtwodesc`, `brndm_sts`, `brndm_prty`, `brndm_crtdon`, `brndm_crtdby`, `brndm_mdfdon`, `brndm_mdfdby`) VALUES
(6, 'APOLLO', '', 'brndimg563dfd6763fc7.png', '', '', '', '', '', '', '', '', 'a', 7, '2015-11-05', '', '2015-11-07', ''),
(8, 'BRIDGESTONE', '', 'brndimg563dfd7867e36.png', '', '', '', '', '', '', '', '', 'a', 5, '2015-11-05', '', '2015-11-07', ''),
(2, 'CEAT', '', 'brndimg563e04412f3bf.jpg', 'zmimg563e04412f60a.jpg', '', '', '', '', '', '', '', 'a', 2, '2015-09-30', '', '2015-11-07', ''),
(10, 'CHINATYRE', '', 'brndimg563dfd9142ba8.png', '', '', '', '', '', '', '', '', 'a', 4, '2015-11-05', '', '2015-11-07', ''),
(7, 'GOODYEAR', '', 'brndimg563dfda1ef492.png', '', '', '', '', '', '', '', '', 'a', 6, '2015-11-05', '', '2015-11-07', ''),
(5, 'JK TYRE', '', 'brndimg563dfdb31cddf.png', '', '', '', '', '', '', '', '', 'a', 8, '2015-11-05', '', '2015-11-07', ''),
(4, 'MICHELIN', '', 'brndimg563b6cac694b8.png', '', '', '', '', '', '', '', '', 'a', 9, '2015-11-05', '', NULL, NULL),
(1, 'MRF', '', 'brndimg563dfdca039e2.png', 'zmimg563dfdca03c82.png', '', '', '', '', '', '', '', 'a', 1, '2015-09-30', '', '2015-11-07', ''),
(9, 'PIRELLI', '', 'brndimg563dfddf72616.png', '', '', '', '', '', '', '', '', 'a', 4, '2015-11-05', '', '2015-11-07', ''),
(3, 'YOKOHAMA', '', 'brndimg563dfdf98acd9.png', '', '', '', '', '', '', '', '', 'a', 10, '2015-11-05', '', '2015-11-07', '');

-- --------------------------------------------------------

--
-- Table structure for table `cntnt_mst`
--

CREATE TABLE `cntnt_mst` (
  `cntntm_id` int(15) NOT NULL,
  `cntntm_name` varchar(250) NOT NULL,
  `cntntm_iso` varchar(250) DEFAULT NULL,
  `cntntm_prty` int(15) DEFAULT NULL,
  `cntntm_sts` char(1) DEFAULT NULL,
  `cntntm_crtdon` datetime DEFAULT NULL,
  `cntntm_crtdby` varchar(250) DEFAULT NULL,
  `cntntm_mdfdon` datetime DEFAULT NULL,
  `cntntm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cntnt_mst`
--

INSERT INTO `cntnt_mst` (`cntntm_id`, `cntntm_name`, `cntntm_iso`, `cntntm_prty`, `cntntm_sts`, `cntntm_crtdon`, `cntntm_crtdby`, `cntntm_mdfdon`, `cntntm_mdfdby`) VALUES
(1, 'Africa', 'AF', 1, 'a', '2014-03-01 07:27:55', 'admin', '2014-06-06 11:16:57', 'admin'),
(2, 'Antarctica', 'AN', 2, 'a', '2014-03-01 07:28:15', 'admin', '2014-04-10 10:00:18', 'admin'),
(3, 'Asia', 'AS', 3, 'a', '2014-03-01 07:28:21', 'admin', '2014-03-03 08:51:15', 'admin'),
(4, 'Australia', 'OC', 4, 'a', '2014-03-01 07:28:27', 'admin', '2014-03-03 08:50:29', 'admin'),
(5, 'Europe', 'EU', 6, 'a', '2014-03-01 07:28:34', 'admin', '2014-03-03 08:50:41', 'admin'),
(6, 'North America', 'NA', 6, 'a', '2014-03-01 07:28:42', 'admin', '2014-03-03 08:50:51', 'admin'),
(7, 'South America', 'SA', 7, 'a', '2014-03-01 07:28:48', 'admin', '2014-03-05 05:27:38', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cntry_mst`
--

CREATE TABLE `cntry_mst` (
  `cntrym_id` int(15) NOT NULL,
  `cntrym_name` varchar(250) NOT NULL COMMENT 'Name of the country',
  `cntrym_isothr` varchar(250) NOT NULL,
  `cntrym_isotwo` varchar(250) NOT NULL,
  `cntrym_cntntm_id` int(15) NOT NULL,
  `cntrym_isonum` varchar(250) NOT NULL,
  `cntrym_sts` char(1) DEFAULT NULL COMMENT 'Status of the country',
  `cntrym_prty` int(15) DEFAULT NULL COMMENT 'Priority of the country',
  `cntrym_crtdon` date DEFAULT NULL COMMENT 'Date on which the country is created',
  `cntrym_crtdby` varchar(250) DEFAULT NULL COMMENT 'By Whom the country is created',
  `cntrym_mdfdon` date DEFAULT NULL COMMENT 'Date on which the country is modified',
  `cntrym_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the country is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cntry_mst`
--

INSERT INTO `cntry_mst` (`cntrym_id`, `cntrym_name`, `cntrym_isothr`, `cntrym_isotwo`, `cntrym_cntntm_id`, `cntrym_isonum`, `cntrym_sts`, `cntrym_prty`, `cntrym_crtdon`, `cntrym_crtdby`, `cntrym_mdfdon`, `cntrym_mdfdby`) VALUES
(8, 'Afghanistan', 'AFG', 'AF', 3, '004', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(11, 'Aland Islands', 'ALA', 'AX', 5, '248', 'a', NULL, '2012-03-27', 'admin', NULL, NULL),
(12, 'Albania', 'ALB', 'AL', 5, '008', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(56, 'Algeria', 'DZA', 'DZ', 1, '012', 'a', 1, '2014-02-11', 'admin', '2014-06-06', 'admin'),
(17, 'American Samoa', 'ASM', 'AS', 4, '016', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(13, 'Andorra', 'AND', 'AD', 5, '020', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(9, 'Angola', 'AGO', 'AO', 1, '024', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(10, 'Anguilla', 'AIA', 'AI', 6, '660', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(18, 'Antarctica', 'ATA', 'AQ', 2, '010', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(20, 'Antigua and Barbuda', 'ATG', 'AG', 6, '028', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(15, 'Argentina', 'ARG', 'AR', 7, '032', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(16, 'Armenia', 'ARM', 'AM', 4, '051', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(7, 'Aruba', 'ABW', 'AW', 6, '533', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(21, 'Australia', 'AUS', 'AU', 4, '036', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(22, 'Austria', 'AUT', 'AT', 5, '040', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(23, 'Azerbaijan', 'AZE', 'AZ', 3, '031', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(57, 'Azores', '', 'PT', 5, '', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(31, 'Bahamas', 'BHS', 'BS', 6, '044', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(30, 'Bahrain', 'BHR', 'BH', 3, '048', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', 'admin'),
(28, 'Bangladesh', 'BGD', 'BD', 3, '050', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(38, 'Barbados', 'BRB', 'BB', 6, '052', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(59, 'Barbuda', 'ATG', 'AG', 6, '1 268', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(34, 'Belarus', 'BLR', 'BY', 5, '112', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(25, 'Belgium', 'BEL', 'BE', 5, '056', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(35, 'Belize', 'BLZ', 'BZ', 6, '084', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(26, 'Benin', 'BEN', 'BJ', 1, '204', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(36, 'Bermuda', 'BMU', 'BM', 6, '060', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(40, 'Bhutan', 'BTN', 'BT', 3, '064', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(60, 'Bolivia', 'BOL', 'BO', 7, '068', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(32, 'Bosnia and Herzegovina', 'BIH', 'BA', 5, '070', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(42, 'Botswana', 'BWA', 'BW', 4, '072', 'a', NULL, '2012-03-27', 'admin', '2014-02-11', 'admin'),
(41, 'BOUVET Island', 'BVT', 'BV', 5, '074', 'a', NULL, '2012-03-27', 'admin', NULL, NULL),
(37, 'Brazil', 'BRA', 'BR', 7, '076', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(39, 'Brunei Darussalam', 'BRM', 'BN', 3, '096', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(29, 'Bulgaria', 'BGR', 'BG', 5, '100', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(27, 'Burkina Faso', 'BFA', 'BF', 1, '854', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(24, 'Burundi', 'BDI', 'BI', 1, '108', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(61, 'Cambodia', 'KHM', 'KH', 3, '116', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(49, 'Cameroon', 'CMR', 'CM', 1, '120', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(44, 'Canada', 'CAN', 'CA', 6, '124', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(62, 'Canary Islands', 'IC', '', 5, '', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(54, 'Cape Verde', 'CPV', 'CV', 1, '132', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(64, 'Cayman Island', 'CYM', 'KY', 6, '136', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(43, 'Central African Republic', 'CAF', 'CF', 1, '14', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(63, 'Chad', 'TCD', 'TD', 1, '148', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(47, 'Chile', 'CHL', 'CL', 7, '152', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(48, 'China', 'CHN', 'CN', 3, '156', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(65, 'Christmas Island', 'CXR', 'CX', 3, '162', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(45, 'Cocos (Keeling) Islands', 'CCK', 'CC', 3, '166', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', 'admin'),
(52, 'Colombia', 'COL', 'CO', 7, '170', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(53, 'Comoros', 'COM', 'KM', 1, '174', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(50, 'Congo', 'COG', 'CG', 1, '178', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(51, 'Cook Islands', 'COK', 'CK', 4, '184', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', 'admin'),
(66, 'Costa Rica', 'CRI', 'CR', 6, '188', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(67, 'Croatia (local name: Hrvatska)', 'HRV', 'HR', 5, '191', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(68, 'Cuba', 'CUB', 'CU', 6, '192', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(69, 'Cyprus', 'CYP', 'CY', 5, '196', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(70, 'Czech Republic', 'CZE', 'CZ', 5, '203', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(71, 'Dem Republic of Congo', 'COG', 'CG', 1, '242', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(72, 'Denmark', 'DNK', 'DK', 5, '208', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(73, 'Djibouti', 'DJI', 'DJ', 1, '262', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(74, 'Dominica', 'DMA', 'DM', 6, '212', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(75, 'Dominican Republic', 'DOM', 'DO', 6, '214', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(76, 'Ecuador', 'ECU', 'EC', 7, '218', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(77, 'Egypt', 'EGY', 'EG', 1, '818', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(78, 'EL Salvador', 'SLV', 'SV', 6, '222', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(79, 'Equatorial Guinea', 'GNQ', 'GQ', 1, '226', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(80, 'Eritrea', 'ERI', 'ER', 1, '232', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(81, 'Estonia', 'EST', 'EE', 5, '233', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(82, 'Ethiopia', 'ETH', 'ET', 1, '231', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(83, 'Faroe Islands', 'FRO', 'FO', 7, '234', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(84, 'Fiji', 'FJI', 'FJ', 6, '242', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(85, 'Finland', 'FIN', 'FI', 5, '246', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(86, 'France', 'FRA', 'FR', 5, '250', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(87, 'French Guiana', 'GUF', 'GF', 7, '254', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(88, 'French Polynesia', 'PYF', 'PF', 6, '258', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(19, 'French Southern Territories', 'ATF', 'TF', 5, '260', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(89, 'Gabon', 'GAB', 'GA', 1, '266', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(90, 'Gambia', 'GMB', 'GM', 1, '270', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(91, 'Georgia', 'GEO', 'GE', 5, '268', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(92, 'Germany', 'DEU', 'DE', 5, '276', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(93, 'Ghana', 'GHA', 'GH', 1, '288', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(94, 'Gibraltar', 'GIB', 'GI', 5, '292', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(95, 'Greece', 'GRC', 'GR', 5, '300', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(96, 'GreenLand', 'GRL', 'GL', 6, '304', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(97, 'Grenada', 'GRD', 'GD', 6, '308', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(98, 'Guadeloupe', 'GLP', 'GP', 6, '312', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(99, 'Guam', 'GUM', 'GU', 3, '316', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(100, 'Guatemala', 'GTM', 'GT', 6, '320', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(101, 'Guinea', 'GIN', 'GN', 1, '324', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(102, 'Guinea-Bissau', 'GNB', 'GW', 1, '624', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(103, 'Guyana', 'GUY', 'GY', 7, '328', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(104, 'Haiti', 'HTI', 'HT', 6, '332', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(105, 'Honduras', 'HND', 'HN', 6, '340', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(106, 'Hong Kong', 'HKG', 'HK', 3, '344', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(107, 'Hungary', 'HUN', 'HU', 5, '348', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(108, 'Iceland', 'ISL', 'IS', 5, '352', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(2, 'India', 'IND', 'IN', 3, '356', 'a', 1, '2011-08-26', 'admin', '2014-06-02', 'admin'),
(109, 'Indonesia', 'IDN', 'ID', 3, '360', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(110, 'Iran', 'IRN', 'IR', 3, '364', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(111, 'Iraq', 'IRQ', 'IQ', 3, '368', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(112, 'Ireland', 'IRL', 'IE', 5, '372', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(113, 'Isle of man', 'IMN', 'IM', 5, '833', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(114, 'Israel', 'ISR', 'IL', 3, '376', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(115, 'Italy', 'ITA', 'IT', 5, '380', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(116, 'Ivory coast', 'CIV', '', 1, '', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(117, 'Jamaica', 'JAM', 'JM', 6, '388', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(118, 'Japan(Documents)', 'JPN', 'JP', 3, '392', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(119, 'Japan(Dutiables)', 'JPN', 'JP', 3, '392', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(120, 'Japan(Excluding Okinawa)', 'JPN', 'JP', 3, '392', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(121, 'Jordan', 'JOR', 'JO', 3, '400', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(122, 'Kazakhstan', 'KAZ', 'KZ', 3, '398', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(123, 'Kenya', 'KEN', 'KE', 1, '404', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(124, 'Kiribati', 'KIR', 'KI', 6, '296', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(125, 'Korea South', 'KOR', 'KR', 3, '82', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(126, 'Kuwait', 'KWT', 'KW', 3, '414', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(127, 'Kyrgyzstan', 'KGZ', 'KG', 3, '417', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(128, 'Laos', 'LAO', 'LA', 3, '418', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(129, 'Latvia', 'LVA', 'LV', 5, '428', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(130, 'Lebanon', 'LBN', 'LB', 3, '422', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(131, 'Lesotho', 'LSO', 'LS', 1, '426', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(132, 'Liberia', 'LBR', 'LR', 1, '430', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(133, 'Libya', 'LBY', 'LY', 3, '434', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(134, 'Liechtenstein', 'LIE', 'LI', 5, '438', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(135, 'Lithuania', 'LTU', 'LT', 5, '440', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(136, 'Luxembourg', 'LUX', 'LU', 5, '442', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(137, 'Macau', 'MAC', 'MO', 3, '446', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(138, 'Macedonia', 'MAD', 'MK', 5, '807', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(139, 'Madagascar', 'MDG', 'MG', 1, '450', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(140, 'Madeira Island', 'PRT', 'PT', 5, '351', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(141, 'Malawi', 'MWI', 'MW', 1, '454', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(55, 'Malaysia', 'MYS', 'MY', 3, '458', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(142, 'Maldives', 'MDV', 'MV', 3, '462', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(143, 'Mali', 'MLI', 'ML', 1, '466', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(144, 'Malta (Excluding Gozo &amp; Comino Island)', 'MLT', 'MT', 5, '356', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(145, 'Malta Island (Gozo &amp; Comino)', 'MLT', 'MT', 5, '356', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(146, 'Martinique', 'MTQ', 'MQ', 6, '474', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(147, 'Mauritania', 'MRT', 'MR', 1, '478', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(148, 'Mauritius', 'MUS', 'MU', 1, '480', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(149, 'Mexico', 'MEX', 'MX', 6, '484', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(150, 'Moldova', 'MDA', 'MD', 5, '498', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(151, 'Monaco', 'MCO', 'MC', 5, '492', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(152, 'Mongolia', 'MNG', 'MN', 3, '496', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(153, 'Montenegro', 'MNE', 'ME', 5, '499', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(154, 'Montserrat', 'MSR', 'MS', 6, '500', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(155, 'Morocco', 'MAR', 'MA', 1, '504', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(156, 'Mozambique', 'MOZ', 'MZ', 1, '508', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(157, 'Myanmar', 'MMR', 'MM', 3, '95', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(158, 'Nambia', 'NAM', 'NA', 1, '516', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(159, 'Nauru', 'NRU', 'NR', 4, '520', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(160, 'Nepal', 'NPL', 'NP', 3, '524', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(161, 'Netherlands', 'NLD', 'NL', 5, '528', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(162, 'Netherlands Antilles', 'ANT', 'AN', 7, '599', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(163, 'New Caledonia', 'NCL', 'NC', 4, '540', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(164, 'New Zealand', 'NZL', 'NZ', 4, '554', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(165, 'Nicaragua', 'NIC', 'NI', 6, '558', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(166, 'Niger', 'NER', 'NE', 1, '562', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(167, 'Nigeria', 'NGA', 'NG', 1, '566', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(168, 'Northern Ireland', 'IRL', 'IE', 5, '353', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(169, 'Northern Mariana Islands', 'MNP', 'MP', 4, '580', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(170, 'Norway', 'NOR', 'NO', 5, '578', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(171, 'Oman', 'OMN', 'OM', 3, '512', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(172, 'Pakistan', 'PAK', 'PK', 3, '586', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(173, 'Palau', 'PLW', 'PW', 4, '585', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(174, 'palestine', 'PSE', 'PS', 3, '275', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(175, 'Panama', 'PAN', 'PA', 6, '591', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(176, 'Papua New Guinea', 'PNG', 'PG', 4, '598', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(177, 'Paraguay', 'PRY', 'PY', 7, '600', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(178, 'Peru', 'PER', 'PE', 7, '604', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(179, 'Philippines', 'PHL', 'PH', 3, '608', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(180, 'Pitcairn Island', 'PCN', 'PN', 4, '612', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(181, 'Poland', 'POL', 'PL', 5, '616', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(182, 'Portugal', 'PRT', 'PT', 5, '620', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(183, 'Puerto Rico', 'PRI', 'PR', 6, '630', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(184, 'Qatar', 'QAT', 'QA', 3, '634', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(186, 'RÃƒÆ’Ã‚Â©union Island', 'REU', 'RE', 1, '638', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(185, 'Republic Of Serbia', 'SRB', 'RS', 5, '688', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(187, 'Romania', 'ROU', 'RO', 5, '642', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(188, 'Russia', 'RUS', 'RU', 4, '643', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(189, 'Rwanda', 'RWA', 'RW', 1, '646', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(190, 'Samoa', 'WSM', 'WS', 4, '882', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(191, 'San Marino', 'SMR', 'SM', 5, '674', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(192, 'Saudi Arabia', 'SAU', 'SA', 3, '682', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(193, 'Senegal', 'SEN', 'SN', 1, '686', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(194, 'Seychelles', 'SYC', 'SC', 1, '690', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(195, 'Sierra Leone', 'SLE', 'SL', 1, '694', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(196, 'Singapore', 'SGP', 'SG', 3, '702', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(197, 'Slovakia', 'SVK', 'SK', 5, '703', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(198, 'Slovenia', 'SVN', 'SI', 5, '705', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(199, 'Solomon Islands', 'SLB', 'SB', 4, '090', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(200, 'Somalia', 'SOM', 'SO', 1, '706', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(201, 'South Africa', 'ZAF', 'ZA', 1, '710', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(202, 'South Sudan', 'SSD', 'SS', 1, '728', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', 'admin'),
(203, 'Spain', 'ESP', 'ES', 5, '724', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(204, 'Sri Lanka', 'LKA', 'LK', 3, '144', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(206, 'ST Kitts and Nevis', 'KNA', 'KN', 6, '1 869', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(207, 'ST Lucia', 'LCA', 'LC', 6, '1 758', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(205, 'ST Vincent and Grenadine', 'VCT', 'VC', 6, '1 784', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(208, 'Sudan', 'SDN', 'SD', 1, '729', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(210, 'Swaziland', 'SWZ', 'SZ', 1, '748', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(209, 'Sweden', 'SWE', 'SE', 5, '752', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(46, 'Switzerland', 'CHE', 'CH', 5, '756', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(211, 'Syria', 'SYR', 'SY', 3, '760', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(212, 'Taiwan', 'TWN', 'TW', 3, '158', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(213, 'Tajikistan', 'TJK', 'TJ', 3, '762', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(214, 'Tanzania', 'TZA', 'TZ', 1, '834', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(215, 'Thailand', 'THA', 'TH', 3, '764', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(216, 'Togo', 'TGO', 'TG', 1, '768', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(217, 'Tonga', 'TON', 'TO', 4, '776', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(218, 'Trinidad and Tobago', 'TTO', 'TT', 6, '780', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(219, 'Tunisia', 'TUN', 'TN', 1, '788', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(220, 'Turkey', 'TUR', 'TR', 3, '792', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(221, 'Turkmenistan', 'TKM', 'TM', 3, '795', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(222, 'Turks and Caicos Islands', 'TCA', 'TC', 6, '796', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(223, 'Tuvalu', 'TUV', 'TV', 4, '798', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(224, 'Uganda', 'UGA', 'UG', 1, '800', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(225, 'Ukraine', 'UKR', 'UA', 5, '804', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(14, 'United Arab Emirates', 'ARE', 'AE', 3, '784', 'a', NULL, '2012-03-27', 'admin', '2014-03-03', ''),
(226, 'United Kingdom', 'GBR', 'GB', 5, '826', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(3, 'United States', 'USA', 'US', 6, '840', 'a', NULL, '2011-08-26', 'admin', '2014-03-03', ''),
(227, 'Uruguay', 'URY', 'UY', 7, '858', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(228, 'Uzbekistan', 'UZB', 'UZ', 3, '860', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(229, 'Vanuatu', 'VUT', 'VU', 7, '548', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(230, 'Vatican City', 'VAT', 'VA', 5, '39', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(231, 'Venezuela', 'VEN', 'VE', 4, '58', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(232, 'Viet Nam', 'VNM', 'VN', 3, '704', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(233, 'Virgin Islands, British', 'VGB', 'VG', 6, '092', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(234, 'Virgin Islands, U.S.', 'VIR', 'VI', 6, '850', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(235, 'Wallis and Futuna Island', 'WLF', 'WF', 4, '876', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(236, 'Yemen', 'YEM', 'YE', 3, '887', 'a', NULL, '2014-02-11', 'admin', NULL, NULL),
(237, 'Zambia', 'ZMB', 'ZM', 1, '894', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', ''),
(238, 'Zimbabwe', 'ZWE', 'ZW', 1, '716', 'a', NULL, '2014-02-11', 'admin', '2014-03-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `cnty_mst`
--

CREATE TABLE `cnty_mst` (
  `cntym_id` int(15) NOT NULL,
  `cntym_name` varchar(250) NOT NULL COMMENT 'Name of the county',
  `cntym_cntrym_id` int(15) NOT NULL COMMENT 'Refer cntry_mst > cntrym_id',
  `cntym_iso` varchar(250) NOT NULL,
  `cntym_sts` char(1) DEFAULT NULL COMMENT 'Status of the county',
  `cntym_prty` int(15) DEFAULT NULL COMMENT 'Priority of the county',
  `cntym_crtdon` date DEFAULT NULL COMMENT 'Date on which the county is created',
  `cntym_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the county is created',
  `cntym_mdfdon` date DEFAULT NULL COMMENT 'Date on which the county is modified',
  `cntym_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the county is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cnty_mst`
--

INSERT INTO `cnty_mst` (`cntym_id`, `cntym_name`, `cntym_cntrym_id`, `cntym_iso`, `cntym_sts`, `cntym_prty`, `cntym_crtdon`, `cntym_crtdby`, `cntym_mdfdon`, `cntym_mdfdby`) VALUES
(37, '', 0, '', 'u', NULL, '2016-07-26', 'cmkyadau@gmail.com', NULL, NULL),
(1, 'Andaman and Nicobar Island', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(2, 'Andhra Pradesh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(3, 'Arunachal Pradesh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(4, 'Assam', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(5, 'Bihar', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(6, 'Chandigarh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(7, 'Chhattisgarh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(8, 'Dadra and Nagar Haveli', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(9, 'Daman and Diu', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(10, 'Delhi', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(11, 'Goa', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(12, 'Gujarat', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(13, 'Haryana', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(14, 'Himachal Pradesh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(15, 'Jammu and Kashmir', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(16, 'Jharkhand', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(17, 'Karnataka', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(18, 'Kerala', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(19, 'Lakshadweep', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(20, 'Madhya Pradesh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(21, 'Maharashtra', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(22, 'Manipur', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(23, 'Meghalaya', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(24, 'Mizoram', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(25, 'Nagaland', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(26, 'Odisha', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(27, 'Puducherry', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(28, 'Punjab', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(29, 'Rajasthan', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(30, 'Sikkim', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(31, 'Tamil Nadu', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(32, 'Telangana', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(33, 'Tripura', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(34, 'Uttar Pradesh', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(35, 'Uttarakhand', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(36, 'West Bengal', 2, '', 'a', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crtord_dtl`
--

CREATE TABLE `crtord_dtl` (
  `crtordd_id` int(15) NOT NULL COMMENT 'Auto increment id for each order detail',
  `crtordd_sesid` varchar(250) DEFAULT NULL COMMENT 'Session id of the order',
  `crtordd_prodm_id` int(15) NOT NULL COMMENT 'Product id refers prod_mst -> prodm_id',
  `crtordd_prc` double(10,2) DEFAULT NULL COMMENT 'Price of the product',
  `crtordd_qty` int(15) DEFAULT NULL COMMENT 'Quanity of the product',
  `crtordd_sts` char(1) DEFAULT NULL COMMENT 'Status of the product',
  `crtordd_crtordm_id` int(15) NOT NULL COMMENT 'order id of the order refers crtord_mst -> crtordm_id ',
  `crtordd_crtdon` datetime DEFAULT NULL COMMENT 'Date on which the record is created',
  `crtordd_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the order is created',
  `crtordd_mdfdon` datetime DEFAULT NULL COMMENT 'Date on which the order is modified ',
  `crtordd_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the order is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crtord_dtl`
--

INSERT INTO `crtord_dtl` (`crtordd_id`, `crtordd_sesid`, `crtordd_prodm_id`, `crtordd_prc`, `crtordd_qty`, `crtordd_sts`, `crtordd_crtordm_id`, `crtordd_crtdon`, `crtordd_crtdby`, `crtordd_mdfdon`, `crtordd_mdfdby`) VALUES
(17, NULL, 2, 0.00, 1, 'a', 14, '2016-08-22 01:37:01', NULL, NULL, NULL),
(18, NULL, 2, 0.00, 1, 'a', 15, '2016-08-22 01:50:33', NULL, NULL, NULL),
(19, '57cb381023f70fbc4699302a37edc985', 2, 0.00, 1, 'a', 16, '2016-08-22 01:52:55', 'cmkyadau@gmail.com', NULL, NULL),
(20, 'ace8bffdb09c87a74c822575aa65515b', 2, 0.00, 1, 'a', 17, '2016-08-22 02:00:30', 'cmkyadau@gmail.com', NULL, NULL),
(21, 'ace8bffdb09c87a74c822575aa65515b', 1, 0.00, 1, 'a', 18, '2016-08-22 02:01:30', 'cmkyadau@gmail.com', NULL, NULL),
(22, 'ace8bffdb09c87a74c822575aa65515b', 1, 0.00, 1, 'a', 19, '2016-08-22 02:03:13', 'cmkyadau@gmail.com', NULL, NULL),
(23, '430378521bca85a785b02e9546b53198', 2, 0.00, 1, 'a', 20, '2016-08-22 02:36:17', 'cmkyadau@gmail.com', NULL, NULL),
(24, 'ea6a8a89b17efadcac07224576e52594', 2, 0.00, 1, 'a', 21, '2016-08-23 09:45:45', 'cmkyadau@gmail.com', NULL, NULL),
(25, 'ea6a8a89b17efadcac07224576e52594', 2, 0.00, 1, 'a', 22, '2016-08-23 09:48:11', 'cmkyadau@gmail.com', NULL, NULL),
(26, 'bcda25b306e8ace56fb48848fd5cb560', 2, 0.00, 1, 'a', 23, '2016-08-23 09:49:52', 'cmkyadau@gmail.com', NULL, NULL),
(27, 'bcda25b306e8ace56fb48848fd5cb560', 1, 0.00, 1, 'a', 24, '2016-08-23 09:51:02', 'cmkyadau@gmail.com', NULL, NULL),
(28, 'bcda25b306e8ace56fb48848fd5cb560', 1, 0.00, 1, 'a', 25, '2016-08-23 09:53:37', 'cmkyadau@gmail.com', NULL, NULL),
(29, 'bcda25b306e8ace56fb48848fd5cb560', 2, 0.00, 1, 'a', 26, '2016-08-23 09:54:31', 'cmkyadau@gmail.com', NULL, NULL),
(30, 'd1008d979074e52a374498a078f9929b', 2, 0.00, 1, 'a', 27, '2016-08-23 07:19:18', 'cmkyadau@gmail.com', NULL, NULL),
(31, 'f4e6ce1055be428a5496dea096bd3329', 13, 0.00, 1, 'a', 28, '2016-08-25 03:06:02', 'cmkyadau@gmail.com', NULL, NULL),
(32, '587d1a4d54db39a216794a048157edda', 7, 0.00, 1, 'a', 29, '2016-08-25 03:19:31', 'cmkyadau@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crtord_mst`
--

CREATE TABLE `crtord_mst` (
  `crtordm_id` int(15) NOT NULL,
  `crtordm_name` varchar(250) NOT NULL,
  `crtordm_adrs` text,
  `crtordm_ctym_id` varchar(250) DEFAULT NULL,
  `crtordm_cntry` varchar(250) DEFAULT NULL,
  `crtordm_phno` varchar(250) NOT NULL,
  `crtordm_email` varchar(250) NOT NULL,
  `crtordm_cmpnynm` varchar(250) DEFAULT NULL,
  `crtordm_dsgn` varchar(250) DEFAULT NULL,
  `crtordm_fxno` varchar(250) DEFAULT NULL,
  `crtordm_zpcode` varchar(250) DEFAULT NULL,
  `crtordm_orgqtn` varchar(250) DEFAULT NULL,
  `crtordm_qry` text,
  `crtordm_amt` double(10,2) DEFAULT NULL,
  `crtordm_qty` int(15) DEFAULT NULL,
  `crtordm_sts` char(1) DEFAULT NULL,
  `crtordm_cartsts` char(1) DEFAULT 'a',
  `crtordm_prty` int(15) DEFAULT NULL,
  `crtordm_crtdon` datetime DEFAULT NULL,
  `crtordm_crtdby` varchar(250) DEFAULT NULL,
  `crtordm_mdfdon` datetime DEFAULT NULL,
  `crtordm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crtord_mst`
--

INSERT INTO `crtord_mst` (`crtordm_id`, `crtordm_name`, `crtordm_adrs`, `crtordm_ctym_id`, `crtordm_cntry`, `crtordm_phno`, `crtordm_email`, `crtordm_cmpnynm`, `crtordm_dsgn`, `crtordm_fxno`, `crtordm_zpcode`, `crtordm_orgqtn`, `crtordm_qry`, `crtordm_amt`, `crtordm_qty`, `crtordm_sts`, `crtordm_cartsts`, `crtordm_prty`, `crtordm_crtdon`, `crtordm_crtdby`, `crtordm_mdfdon`, `crtordm_mdfdby`) VALUES
(14, '123', 'Hyd', '4', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 01:37:01', 'cmkyadau@gmail.com', NULL, NULL),
(15, '123', 'Hyd', '270', NULL, '7396419196', 'cmkyadau@gmail.com', '', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 01:50:33', 'cmkyadau@gmail.com', NULL, NULL),
(16, '123', 'Hyd', '18', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 01:52:55', 'cmkyadau@gmail.com', NULL, NULL),
(17, '123', 'Hyd', '17', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 02:00:30', 'cmkyadau@gmail.com', NULL, NULL),
(18, '123', 'Hyd', '11', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 02:01:30', 'cmkyadau@gmail.com', NULL, NULL),
(19, 'Mallikarjuna', 'Hyderabad', '11', NULL, '7396419196', 'cmkyadau@gmail.com', 'Adroit', 'Php Developer', '12345', '516289', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 02:03:13', 'cmkyadau@gmail.com', NULL, NULL),
(20, 'ABC', 'Hyd', '127', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, '1', NULL, NULL, 'a', 'd', 1, '2016-08-22 02:36:17', 'cmkyadau@gmail.com', NULL, NULL),
(21, 'Mallikarjuna', 'test', '6', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '516289', NULL, 'AFDASD', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:45:45', 'cmkyadau@gmail.com', NULL, NULL),
(22, 'Mallikarjuna', 'dsfsafsd', '5', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, 'sdfsaf', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:48:11', 'cmkyadau@gmail.com', NULL, NULL),
(23, 'Mallikarjuna', 'test', '188', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, 'asdfdsaf', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:49:52', 'cmkyadau@gmail.com', NULL, NULL),
(24, 'Mallikarjuna', 'dafsfsaf', '140', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, 'dsfafsd', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:51:02', 'cmkyadau@gmail.com', NULL, NULL),
(25, '123', 'dsafs', '246', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, 'asfdsaf', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:53:37', 'cmkyadau@gmail.com', NULL, NULL),
(26, 'Mallikarjuna', 'sdfsaf', '128', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '123', NULL, 'sdfsaf', NULL, NULL, 'a', 'd', 1, '2016-08-23 09:54:31', 'cmkyadau@gmail.com', NULL, NULL),
(27, 'Mallikarjuna', 'ABCD', '5', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '516289', NULL, 'test', NULL, NULL, 'a', 'd', 1, '2016-08-23 07:19:18', 'cmkyadau@gmail.com', NULL, NULL),
(28, 'Mallikarjuna', 'test', '19', NULL, '7396419196', 'cmkyadau@gmail.com', '141414', 'Php Developer', '123123', '516289', NULL, 'test', NULL, NULL, 'a', 'd', 1, '2016-08-25 03:06:02', 'cmkyadau@gmail.com', NULL, NULL),
(29, 'Mallikarjuna', 'ABCD', '6', NULL, '7396419196', 'cmkyadau@gmail.com', 'Adroit', 'Php Developer', '123123', '516289', NULL, 'test', NULL, NULL, 'a', 'd', 1, '2016-08-25 03:19:31', 'cmkyadau@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cty_mst`
--

CREATE TABLE `cty_mst` (
  `ctym_id` int(15) NOT NULL,
  `ctym_name` varchar(250) NOT NULL COMMENT 'Name of the city',
  `ctym_cntym_id` int(15) NOT NULL COMMENT 'Refer cnty_mst -> cntym_id',
  `ctym_iso` varchar(250) NOT NULL,
  `ctym_sts` char(1) DEFAULT NULL COMMENT 'Status of the county',
  `ctym_prty` int(15) DEFAULT NULL COMMENT 'Priority of the county',
  `ctym_crtdon` date DEFAULT NULL COMMENT 'Date on which the county is created',
  `ctym_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the county is created',
  `ctym_mdfdon` date DEFAULT NULL COMMENT 'Date on which the county is modified',
  `ctym_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the county is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cty_mst`
--

INSERT INTO `cty_mst` (`ctym_id`, `ctym_name`, `ctym_cntym_id`, `ctym_iso`, `ctym_sts`, `ctym_prty`, `ctym_crtdon`, `ctym_crtdby`, `ctym_mdfdon`, `ctym_mdfdby`) VALUES
(547, 'Adilabad', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(565, 'Agra', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(141, 'Ahmedabad', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(348, 'Ahmednagar', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(403, 'Aizawl', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(478, 'Ajmer', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(349, 'Akola', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(283, 'Alappuzha', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(566, 'Aligarh', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(298, 'Alirajpur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(567, 'Allahabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(640, 'Almora', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(479, 'Alwar', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(174, 'Ambala', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(568, 'Ambedkar Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(584, 'Amethi (Chatrapati Sahuji Mahraj Nagar)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(350, 'Amravati', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(142, 'Amreli', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(456, 'Amritsar', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(604, 'Amroha (J.P. Nagar)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(143, 'Anand', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(4, 'Anantapur', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(207, 'Anantnag', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(422, 'Angul', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(17, 'Anjaw', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(299, 'Anuppur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(61, 'Araria', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(144, 'Aravalli', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(515, 'Ariyalur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(62, 'Arwal', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(300, 'Ashoknagar', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(569, 'Auraiya', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(63, 'Aurangabad', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(351, 'Aurangabad', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(570, 'Azamgarh', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(253, 'Bagalkot', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(641, 'Bageshwar', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(571, 'Baghpat', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(572, 'Bahraich', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(34, 'Baksa', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(301, 'Balaghat', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(423, 'Balangir', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(424, 'Balasore', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(573, 'Ballia', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(100, 'Balod', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(101, 'Baloda Bazar', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(102, 'Balrampur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(574, 'Balrampur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(145, 'Banaskantha (Palanpur)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(575, 'Banda', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(208, 'Bandipora', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(254, 'Bangalore Rural', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(255, 'Bangalore Urban', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(64, 'Banka', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(653, 'Bankura', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(480, 'Banswara', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(576, 'Barabanki', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(209, 'Baramulla', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(481, 'Baran', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(577, 'Bareilly', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(425, 'Bargarh', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(482, 'Barmer', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(457, 'Barnala', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(35, 'Barpeta', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(302, 'Barwani', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(103, 'Bastar', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(578, 'Basti', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(458, 'Bathinda', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(352, 'Beed', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(65, 'Begusarai', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(256, 'Belgaum', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(257, 'Bellary', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(104, 'Bemetara', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(303, 'Betul', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(426, 'Bhadrak', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(66, 'Bhagalpur', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(353, 'Bhandara', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(483, 'Bharatpur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(146, 'Bharuch', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(147, 'Bhavnagar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(484, 'Bhilwara', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(304, 'Bhind', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(175, 'Bhiwani', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(67, 'Bhojpur', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(305, 'Bhopal', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(258, 'Bidar', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(105, 'Bijapur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(259, 'Bijapur', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(580, 'Bijnor', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(485, 'Bikaner', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(106, 'Bilaspur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(195, 'Bilaspur', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(654, 'Birbhum', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(383, 'Bishnupur', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(229, 'Bokaro', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(36, 'Bongaigaon', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(148, 'Botad', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(427, 'Boudh', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(581, 'Budaun', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(210, 'Budgam', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(582, 'Bulandshahr', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(354, 'Buldhana', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(486, 'Bundi', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(655, 'Burdwan (Bardhaman)', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(306, 'Burhanpur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(68, 'Buxar', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(37, 'Cachar', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(130, 'Central Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(260, 'Chamarajanagar', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(196, 'Chamba', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(642, 'Chamoli', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(643, 'Champawat', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(404, 'Champhai', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(583, 'Chandauli', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(384, 'Chandel', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(99, 'Chandigarh', 6, '', 'a', NULL, NULL, NULL, NULL, NULL),
(355, 'Chandrapur', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(18, 'Changlang', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(230, 'Chatra', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(516, 'Chennai', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(307, 'Chhatarpur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(308, 'Chhindwara', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(149, 'Chhota Udepur', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(261, 'Chickmagalur', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(262, 'Chikballapur', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(38, 'Chirang', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(263, 'Chitradurga', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(585, 'Chitrakoot', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(5, 'Chittoor', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(487, 'Chittorgarh', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(385, 'Churachandpur', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(488, 'Churu', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(517, 'Coimbatore', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(656, 'Cooch Behar', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(518, 'Cuddalore', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(6, 'Cuddapah', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(428, 'Cuttack', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(127, 'Dadra & Nagar Haveli', 8, '', 'a', NULL, NULL, NULL, NULL, NULL),
(150, 'Dahod', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(657, 'Dakshin Dinajpur (South Dinajpur)', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(264, 'Dakshina Kannada', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(128, 'Daman', 9, '', 'a', NULL, NULL, NULL, NULL, NULL),
(309, 'Damoh', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(151, 'Dangs (Ahwa)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(107, 'Dantewada (South Bastar)', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(69, 'Darbhanga', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(658, 'Darjeeling', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(39, 'Darrang', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(310, 'Datia', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(489, 'Dausa', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(265, 'Davangere', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(644, 'Dehradun', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(429, 'Deogarh', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(231, 'Deoghar', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(586, 'Deoria', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(152, 'Devbhoomi Dwarka', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(311, 'Dewas', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(557, 'Dhalai', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(108, 'Dhamtari', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(232, 'Dhanbad', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(312, 'Dhar', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(519, 'Dharmapuri', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(266, 'Dharwad', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(40, 'Dhemaji', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(430, 'Dhenkanal', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(490, 'Dholpur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(41, 'Dhubri', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(356, 'Dhule', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(19, 'Dibang Valley', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(42, 'Dibrugarh', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(43, 'Dima Hasao', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(411, 'Dimapur', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(520, 'Dindigul', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(313, 'Dindori', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(129, 'Diu', 9, '', 'a', NULL, NULL, NULL, NULL, NULL),
(211, 'Doda', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(233, 'Dumka', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(491, 'Dungarpur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(109, 'Durg', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(70, 'East Champaran (Motihari)', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(131, 'East Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(392, 'East Garo Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(7, 'East Godavari', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(393, 'East Jaintia Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(20, 'East Kameng', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(394, 'East Khasi Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(21, 'East Siang', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(511, 'East Sikkim', 30, '', 'a', NULL, NULL, NULL, NULL, NULL),
(234, 'East Singhbhum', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(284, 'Ernakulam', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(521, 'Erode', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(587, 'Etah', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(588, 'Etawah', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(589, 'Faizabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(176, 'Faridabad', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(459, 'Faridkot', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(590, 'Farrukhabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(177, 'Fatehabad', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(460, 'Fatehgarh Sahib', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(591, 'Fatehpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(461, 'Fazilka', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(462, 'Ferozepur', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(592, 'Firozabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(267, 'Gadag', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(357, 'Gadchiroli', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(431, 'Gajapati', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(212, 'Ganderbal', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(153, 'Gandhinagar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(432, 'Ganjam', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(235, 'Garhwa', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(110, 'Gariaband', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(593, 'Gautam Buddha Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(71, 'Gaya', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(594, 'Ghaziabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(595, 'Ghazipur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(154, 'Gir Somnath', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(236, 'Giridih', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(44, 'Goalpara', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(237, 'Godda', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(45, 'Golaghat', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(558, 'Gomati', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(596, 'Gonda', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(358, 'Gondia', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(72, 'Gopalganj', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(597, 'Gorakhpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(268, 'Gulbarga', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(238, 'Gumla', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(314, 'Guna', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(8, 'Guntur', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(463, 'Gurdaspur', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(178, 'Gurgaon', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(315, 'Gwalior', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(46, 'Hailakandi', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(197, 'Hamirpur', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(598, 'Hamirpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(492, 'Hanumangarh', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(623, 'Hapur (Panchsheel Nagar)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(316, 'Harda', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(599, 'Hardoi', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(645, 'Haridwar', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(269, 'Hassan', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(600, 'Hathras', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(270, 'Haveri', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(239, 'Hazaribag', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(359, 'Hingoli', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(179, 'Hisar', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(659, 'Hooghly', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(317, 'Hoshangabad', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(464, 'Hoshiarpur', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(660, 'Howrah', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(548, 'Hyderabad', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(285, 'Idukki', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(386, 'Imphal East', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(387, 'Imphal West', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(318, 'Indore', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(319, 'Jabalpur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(433, 'Jagatsinghapur', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(493, 'Jaipur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(494, 'Jaisalmer', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(434, 'Jajpur', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(465, 'Jalandhar', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(601, 'Jalaun', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(360, 'Jalgaon', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(361, 'Jalna', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(495, 'Jalore', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(661, 'Jalpaiguri', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(213, 'Jammu', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(155, 'Jamnagar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(240, 'Jamtara', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(73, 'Jamui', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(111, 'Janjgir-Champa', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(112, 'Jashpur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(602, 'Jaunpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(74, 'Jehanabad', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(320, 'Jhabua', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(180, 'Jhajjar', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(496, 'Jhalawar', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(603, 'Jhansi', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(435, 'Jharsuguda', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(497, 'Jhunjhunu', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(181, 'Jind', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(498, 'Jodhpur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(47, 'Jorhat', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(156, 'Junagadh', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(113, 'Kabirdham (Kawardha)', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(157, 'Kachchh', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(75, 'Kaimur (Bhabua)', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(182, 'Kaithal', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(436, 'Kalahandi', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(49, 'Kamrup', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(48, 'Kamrup Metropolitan', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(522, 'Kanchipuram', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(437, 'Kandhamal', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(198, 'Kangra', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(114, 'Kanker (North Bastar)', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(605, 'Kannauj', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(286, 'Kannur', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(606, 'Kanpur Dehat', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(607, 'Kanpur Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(608, 'Kanshiram Nagar (Kasganj)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(523, 'Kanyakumari', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(466, 'Kapurthala', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(452, 'Karaikal', 27, '', 'a', NULL, NULL, NULL, NULL, NULL),
(499, 'Karauli', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(50, 'Karbi Anglong', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(214, 'Kargil', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(51, 'Karimganj', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(549, 'Karimnagar', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(183, 'Karnal', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(524, 'Karur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(287, 'Kasaragod', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(215, 'Kathua', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(76, 'Katihar', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(321, 'Katni', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(609, 'Kaushambi', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(438, 'Kendrapara', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(439, 'Kendujhar (Keonjhar)', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(77, 'Khagaria', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(550, 'Khammam', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(322, 'Khandwa', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(323, 'Khargone', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(158, 'Kheda (Nadiad)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(440, 'Khordha', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(559, 'Khowai', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(241, 'Khunti', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(199, 'Kinnaur', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(412, 'Kiphire', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(78, 'Kishanganj', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(216, 'Kishtwar', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(271, 'Kodagu', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(242, 'Koderma', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(413, 'Kohima', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(52, 'Kokrajhar', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(272, 'Kolar', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(405, 'Kolasib', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(362, 'Kolhapur', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(662, 'Kolkata', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(288, 'Kollam', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(115, 'Kondagaon', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(273, 'Koppal', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(441, 'Koraput', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(116, 'Korba', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(117, 'Korea (Koriya)', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(500, 'Kota', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(289, 'Kottayam', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(290, 'Kozhikode', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(9, 'Krishna', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(525, 'Krishnagiri', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(217, 'Kulgam', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(200, 'Kullu', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(218, 'Kupwara', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(10, 'Kurnool', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(184, 'Kurukshetra', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(22, 'Kurung Kumey', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(610, 'Kushinagar (Padrauna)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(201, 'Lahaul & Spiti', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(53, 'Lakhimpur', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(611, 'Lakhimpur - Kheri', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(79, 'Lakhisarai', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(297, 'Lakshadweep', 19, '', 'a', NULL, NULL, NULL, NULL, NULL),
(612, 'Lalitpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(243, 'Latehar', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(363, 'Latur', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(406, 'Lawngtlai', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(219, 'Leh', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(244, 'Lohardaga', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(23, 'Lohit', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(24, 'Longding', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(414, 'Longleng', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(25, 'Lower Dibang Valley', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(26, 'Lower Subansiri', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(613, 'Lucknow', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(467, 'Ludhiana', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(407, 'Lunglei', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(80, 'Madhepura', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(81, 'Madhubani', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(526, 'Madurai', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(551, 'Mahabubnagar', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(614, 'Maharajganj', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(118, 'Mahasamund', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(453, 'Mahe', 27, '', 'a', NULL, NULL, NULL, NULL, NULL),
(185, 'Mahendragarh', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(159, 'Mahisagar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(615, 'Mahoba', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(616, 'Mainpuri', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(291, 'Malappuram', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(663, 'Malda', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(442, 'Malkangiri', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(408, 'Mamit', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(202, 'Mandi', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(324, 'Mandla', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(325, 'Mandsaur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(274, 'Mandya', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(468, 'Mansa', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(617, 'Mathura', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(618, 'Mau', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(443, 'Mayurbhanj', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(552, 'Medak', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(619, 'Meerut', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(160, 'Mehsana', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(186, 'Mewat', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(620, 'Mirzapur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(469, 'Moga', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(415, 'Mokokchung', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(416, 'Mon', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(621, 'Moradabad', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(161, 'Morbi', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(326, 'Morena', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(54, 'Morigaon', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(470, 'Muktsar', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(364, 'Mumbai City', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(365, 'Mumbai Suburban', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(119, 'Mungeli', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(82, 'Munger (Monghyr)', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(664, 'Murshidabad', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(622, 'Muzaffarnagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(83, 'Muzaffarpur', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(275, 'Mysore', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(444, 'Nabarangpur', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(665, 'Nadia', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(55, 'Nagaon', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(527, 'Nagapattinam', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(501, 'Nagaur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(366, 'Nagpur', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(646, 'Nainital', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(84, 'Nalanda', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(56, 'Nalbari', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(553, 'Nalgonda', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(528, 'Namakkal', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(367, 'Nanded', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(368, 'Nandurbar', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(120, 'Narayanpur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(162, 'Narmada (Rajpipla)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(327, 'Narsinghpur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(369, 'Nashik', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(163, 'Navsari', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(85, 'Nawada', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(471, 'Nawanshahr', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(445, 'Nayagarh', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(328, 'Neemuch', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(11, 'Nellore', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(132, 'New Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(1, 'Nicobar', 1, '', 'a', NULL, NULL, NULL, NULL, NULL),
(529, 'Nilgiris', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(554, 'Nizamabad', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(666, 'North 24 Parganas', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(2, 'North and Middle Andaman', 1, '', 'a', NULL, NULL, NULL, NULL, NULL),
(133, 'North Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(134, 'North East Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(395, 'North Garo Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(139, 'North Goa', 11, '', 'a', NULL, NULL, NULL, NULL, NULL),
(512, 'North Sikkim', 30, '', 'a', NULL, NULL, NULL, NULL, NULL),
(560, 'North Tripura', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(135, 'North West Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(446, 'Nuapada', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(370, 'Osmanabad', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(245, 'Pakur', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(292, 'Palakkad', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(246, 'Palamu', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(502, 'Pali', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(187, 'Palwal', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(188, 'Panchkula', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(164, 'Panchmahal (Godhra)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(189, 'Panipat', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(329, 'Panna', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(27, 'Papum Pare', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(371, 'Parbhani', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(667, 'Paschim Medinipur (West Medinipur)', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(165, 'Patan', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(293, 'Pathanamthitta', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(472, 'Pathankot', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(473, 'Patiala', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(86, 'Patna', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(647, 'Pauri Garhwal', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(530, 'Perambalur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(417, 'Peren', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(418, 'Phek', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(624, 'Pilibhit', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(648, 'Pithoragarh', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(454, 'Pondicherry', 27, '', 'a', NULL, NULL, NULL, NULL, NULL),
(220, 'Poonch', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(166, 'Porbandar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(12, 'Prakasam', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(503, 'Pratapgarh', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(626, 'Pratapgarh', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(531, 'Pudukkottai', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(221, 'Pulwama', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(372, 'Pune', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(668, 'Purba Medinipur (East Medinipur)', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(447, 'Puri', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(87, 'Purnia (Purnea)', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(669, 'Purulia', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(627, 'RaeBareli', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(276, 'Raichur', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(373, 'Raigad', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(121, 'Raigarh', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(122, 'Raipur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(330, 'Raisen', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(331, 'Rajgarh', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(167, 'Rajkot', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(123, 'Rajnandgaon', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(222, 'Rajouri', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(504, 'Rajsamand', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(532, 'Ramanathapuram', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(223, 'Ramban', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(247, 'Ramgarh', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(277, 'Ramnagara', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(628, 'Rampur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(248, 'Ranchi', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(555, 'Rangareddy', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(332, 'Ratlam', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(374, 'Ratnagiri', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(448, 'Rayagada', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(224, 'Reasi', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(333, 'Rewa', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(190, 'Rewari', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(396, 'Ri Bhoi', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(191, 'Rohtak', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(88, 'Rohtas', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(649, 'Rudraprayag', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(474, 'Rupnagar', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(168, 'Sabarkantha (Himmatnagar)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(334, 'Sagar', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(629, 'Saharanpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(89, 'Saharsa', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(249, 'Sahibganj', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(409, 'Saiha', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(533, 'Salem', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(90, 'Samastipur', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(225, 'Samba', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(449, 'Sambalpur', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(579, 'Sambhal (Bhim Nagar)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(375, 'Sangli', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(475, 'Sangrur', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(630, 'Sant Kabir Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(631, 'Sant Ravidas Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(91, 'Saran', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(476, 'SAS Nagar (Mohali)', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(376, 'Satara', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(335, 'Satna', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(505, 'Sawai Madhopur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(336, 'Sehore', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(388, 'Senapati', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(337, 'Seoni', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(561, 'Sepahijala', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(250, 'Seraikela-Kharsawan', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(410, 'Serchhip', 24, '', 'a', NULL, NULL, NULL, NULL, NULL),
(338, 'Shahdol', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(632, 'Shahjahanpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(339, 'Shajapur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(625, 'Shamali (Prabuddh Nagar)', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(92, 'Sheikhpura', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(93, 'Sheohar', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(340, 'Sheopur', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(203, 'Shimla', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(278, 'Shimoga', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(341, 'Shivpuri', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(226, 'Shopian', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(633, 'Shravasti', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(634, 'Siddharth Nagar', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(342, 'Sidhi', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(506, 'Sikar', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(251, 'Simdega', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(377, 'Sindhudurg', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(343, 'Singrauli', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(204, 'Sirmaur (Sirmour)', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(507, 'Sirohi', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(192, 'Sirsa', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(94, 'Sitamarhi', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(635, 'Sitapur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(534, 'Sivaganga', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(57, 'Sivasagar', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(95, 'Siwan', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(205, 'Solan', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(378, 'Solapur', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(636, 'Sonbhadra', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(450, 'Sonepur', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(193, 'Sonipat', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(58, 'Sonitpur', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(670, 'South 24 Parganas', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(3, 'South Andaman', 1, '', 'a', NULL, NULL, NULL, NULL, NULL),
(136, 'South Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(397, 'South Garo Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(140, 'South Goa', 11, '', 'a', NULL, NULL, NULL, NULL, NULL),
(513, 'South Sikkim', 30, '', 'a', NULL, NULL, NULL, NULL, NULL),
(562, 'South Tripura', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(137, 'South West Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(398, 'South West Garo Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(399, 'South West Khasi Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(508, 'Sri Ganganagar', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(13, 'Srikakulam', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(227, 'Srinagar', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(124, 'Sukma', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(637, 'Sultanpur', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(451, 'Sundargarh', 26, '', 'a', NULL, NULL, NULL, NULL, NULL),
(96, 'Supaul', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(125, 'Surajpur', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(169, 'Surat', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(170, 'Surendranagar', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(126, 'Surguja', 7, '', 'a', NULL, NULL, NULL, NULL, NULL),
(389, 'Tamenglong', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(171, 'Tapi (Vyara)', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(477, 'Tarn Taran', 28, '', 'a', NULL, NULL, NULL, NULL, NULL),
(28, 'Tawang', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(650, 'Tehri Garhwal', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(379, 'Thane', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(535, 'Thanjavur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(536, 'Theni', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(294, 'Thiruvananthapuram', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(537, 'Thoothukudi (Tuticorin)', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(390, 'Thoubal', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(295, 'Thrissur', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(344, 'Tikamgarh', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(59, 'Tinsukia', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(29, 'Tirap', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(538, 'Tiruchirappalli', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(539, 'Tirunelveli', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(540, 'Tiruppur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(541, 'Tiruvallur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(542, 'Tiruvannamalai', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(543, 'Tiruvarur', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(509, 'Tonk', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(419, 'Tuensang', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(279, 'Tumkur', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(510, 'Udaipur', 29, '', 'a', NULL, NULL, NULL, NULL, NULL),
(60, 'Udalguri', 4, '', 'a', NULL, NULL, NULL, NULL, NULL),
(651, 'Udham Singh Nagar', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(228, 'Udhampur', 15, '', 'a', NULL, NULL, NULL, NULL, NULL),
(280, 'Udupi', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(345, 'Ujjain', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(391, 'Ukhrul', 22, '', 'a', NULL, NULL, NULL, NULL, NULL),
(346, 'Umaria', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(206, 'Una', 14, '', 'a', NULL, NULL, NULL, NULL, NULL),
(563, 'Unakoti', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(638, 'Unnao', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(30, 'Upper Siang', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(31, 'Upper Subansiri', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(671, 'Uttar Dinajpur (North Dinajpur)', 36, '', 'a', NULL, NULL, NULL, NULL, NULL),
(281, 'Uttara Kannada (Karwar)', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(652, 'Uttarkashi', 35, '', 'a', NULL, NULL, NULL, NULL, NULL),
(172, 'Vadodara', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(97, 'Vaishali', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(173, 'Valsad', 12, '', 'a', NULL, NULL, NULL, NULL, NULL),
(639, 'Varanasi', 34, '', 'a', NULL, NULL, NULL, NULL, NULL),
(544, 'Vellore', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(347, 'Vidisha', 20, '', 'a', NULL, NULL, NULL, NULL, NULL),
(545, 'Viluppuram', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(546, 'Virudhunagar', 31, '', 'a', NULL, NULL, NULL, NULL, NULL),
(14, 'Visakhapatnam', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(15, 'Vizianagaram', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(556, 'Warangal', 32, '', 'a', NULL, NULL, NULL, NULL, NULL),
(380, 'Wardha', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(381, 'Washim', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(296, 'Wayanad', 18, '', 'a', NULL, NULL, NULL, NULL, NULL),
(98, 'West Champaran', 5, '', 'a', NULL, NULL, NULL, NULL, NULL),
(138, 'West Delhi', 10, '', 'a', NULL, NULL, NULL, NULL, NULL),
(400, 'West Garo Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(16, 'West Godavari', 2, '', 'a', NULL, NULL, NULL, NULL, NULL),
(401, 'West Jaintia Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(32, 'West Kameng', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(402, 'West Khasi Hills', 23, '', 'a', NULL, NULL, NULL, NULL, NULL),
(33, 'West Siang', 3, '', 'a', NULL, NULL, NULL, NULL, NULL),
(514, 'West Sikkim', 30, '', 'a', NULL, NULL, NULL, NULL, NULL),
(252, 'West Singhbhum', 16, '', 'a', NULL, NULL, NULL, NULL, NULL),
(564, 'West Tripura', 33, '', 'a', NULL, NULL, NULL, NULL, NULL),
(420, 'Wokha', 25, '', 'a', NULL, NULL, NULL, NULL, NULL),
(282, 'Yadgir', 17, '', 'a', NULL, NULL, NULL, NULL, NULL),
(194, 'Yamunanagar', 13, '', 'a', NULL, NULL, NULL, NULL, NULL),
(455, 'Yanam', 27, '', 'a', NULL, NULL, NULL, NULL, NULL),
(382, 'Yavatmal', 21, '', 'a', NULL, NULL, NULL, NULL, NULL),
(421, 'Zunheboto', 25, '', 'a', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fdbck_mst`
--

CREATE TABLE `fdbck_mst` (
  `fdbckm_id` int(15) NOT NULL,
  `fdbckm_emailid` varchar(250) NOT NULL,
  `fdbckm_name` varchar(250) DEFAULT NULL,
  `fdbckm_phno` varchar(250) DEFAULT NULL,
  `fdbckm_addr` text,
  `fdbckm_sizem_id` int(15) DEFAULT NULL,
  `fdbckm_prodscatm_id` int(15) DEFAULT NULL,
  `fdbckm_brndm_id` int(15) DEFAULT NULL,
  `fdbckm_trpstn` char(1) DEFAULT NULL,
  `fdbckm_trtyp` char(1) DEFAULT NULL,
  `fdbckm_prty` int(15) DEFAULT NULL,
  `fdbckm_sts` char(1) DEFAULT NULL,
  `fdbckm_crtdon` datetime DEFAULT NULL,
  `fdbckm_crtdby` varchar(250) DEFAULT NULL,
  `fdbckm_mdfdon` datetime DEFAULT NULL,
  `fdbckm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fdbck_mst`
--

INSERT INTO `fdbck_mst` (`fdbckm_id`, `fdbckm_emailid`, `fdbckm_name`, `fdbckm_phno`, `fdbckm_addr`, `fdbckm_sizem_id`, `fdbckm_prodscatm_id`, `fdbckm_brndm_id`, `fdbckm_trpstn`, `fdbckm_trtyp`, `fdbckm_prty`, `fdbckm_sts`, `fdbckm_crtdon`, `fdbckm_crtdby`, `fdbckm_mdfdon`, `fdbckm_mdfdby`) VALUES
(1, 'ravikumar@adroitinfoactive.net', 'Ravi', '9290448184', '5-9-30', 1, 1, 2, '1', '1', NULL, NULL, '2015-09-30 03:58:50', 'ravikumar@adroitinfoactive.net', NULL, NULL),
(2, 'ravikumar@adroitinfoactive.net', 'Ravi', '9290448184', '5-9-30', 1, 1, 2, '1', '1', NULL, NULL, '2015-09-30 05:21:53', 'ravikumar@adroitinfoactive.net', NULL, NULL),
(3, 'mktg@adroitinfoactive.net', 'venkatesh', '8885315151', 'test', 1, 1, 2, '1', '1', NULL, NULL, '2015-10-05 10:40:48', 'mktg@adroitinfoactive.net', NULL, NULL),
(4, 'mktg@adroitinfoactive.net', 'Venkatesh', '8885315151', 'test', 1, 1, 2, '1', '1', NULL, NULL, '2015-10-05 10:42:03', 'mktg@adroitinfoactive.net', NULL, NULL),
(5, 'cmkyadau@gmail.com', 'ABC', '7396419196', 'Desc', 1, 208, 3, '1', '1', NULL, NULL, '2015-11-07 12:05:20', 'cmkyadau@gmail.com', NULL, NULL),
(6, 'mktg@adroitinfoactive.net', 'Venkatesh', '97804790787', 'Hyd', 2, 260, 3, '1', '1', NULL, NULL, '2015-11-07 12:18:14', 'mktg@adroitinfoactive.net', NULL, NULL),
(11, 'jonnagurakalavenkatesh@gmail.com', 'Venkatesh Jonnagurakala', '9704790787', 'hyderabad', 75, 208, 3, '1', '1', NULL, NULL, '2015-11-08 09:46:37', 'jonnagurakalavenkatesh@gmail.com', NULL, NULL),
(8, 'jonnagurakalavenkatesh@gmail.com', 'Venkatesh Jonnagurakala', '9704790787', 'hyderabad', 64, 50, 10, '1', '1', NULL, NULL, '2015-11-07 06:51:01', 'jonnagurakalavenkatesh@gmail.com', NULL, NULL),
(9, 'best_vkr@yahoo.co.in', 'Vijay', '9885170457', 'Require above tyre', 22, 40, 1, '2', '2', NULL, NULL, '2015-11-07 02:15:36', 'best_vkr@yahoo.co.in', NULL, NULL),
(10, 'jonnagurakalavenkatesh@gmail.com', 'Venkatesh Jonnagurakala', '9704790787', 'hyderabad', 3, 79, 6, '1', '1', NULL, NULL, '2015-11-08 09:23:55', 'jonnagurakalavenkatesh@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gnrlenqry_mst`
--

CREATE TABLE `gnrlenqry_mst` (
  `gnrlenqrym_id` int(15) NOT NULL,
  `gnrlenqrym_emailid` varchar(250) DEFAULT NULL,
  `gnrlenqrym_name` varchar(250) DEFAULT NULL,
  `gnrlenqrym_phno` varchar(250) DEFAULT NULL,
  `gnrlenqrym_vchl` varchar(250) DEFAULT NULL,
  `gnrlenqrym_typ` char(1) DEFAULT NULL,
  `gnrlenqrym_srvs` varchar(250) DEFAULT NULL,
  `gnrlenqrym_addr` text,
  `gnrlenqrym_prty` int(15) DEFAULT NULL,
  `gnrlenqrym_sts` char(1) DEFAULT NULL,
  `gnrlenqrym_crtdon` datetime DEFAULT NULL,
  `gnrlenqrym_crtdby` varchar(250) DEFAULT NULL,
  `gnrlenqrym_mdfdon` datetime DEFAULT NULL,
  `gnrlenqrym_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gnrlenqry_mst`
--

INSERT INTO `gnrlenqry_mst` (`gnrlenqrym_id`, `gnrlenqrym_emailid`, `gnrlenqrym_name`, `gnrlenqrym_phno`, `gnrlenqrym_vchl`, `gnrlenqrym_typ`, `gnrlenqrym_srvs`, `gnrlenqrym_addr`, `gnrlenqrym_prty`, `gnrlenqrym_sts`, `gnrlenqrym_crtdon`, `gnrlenqrym_crtdby`, `gnrlenqrym_mdfdon`, `gnrlenqrym_mdfdby`) VALUES
(1, 'sarori123@gmail.com', 'Alsarori', '9052094632', 'Lancer', 'n', '0,1', NULL, 1, 'a', '2016-10-02 01:15:16', 'Alsarori', NULL, NULL),
(2, 'motog4mymomdadgift@gmail.com', 'MAHESH RATHI', '9014011332', 'Wagonar', 'y', '0,1,2,3,4', NULL, 1, 'a', '2016-10-28 03:40:42', 'MAHESH RATHI', NULL, NULL),
(3, 'jayanthkumarkandi@gmail.com', 'jayanth', '9177676488', 'Hyundai I20', 'y', '0,1', NULL, 1, 'a', '2017-03-16 08:51:16', 'jayanth', NULL, NULL),
(4, 'riyan5030@gmail.com', 'Syed Ali', '9100998380', 'Swift dzire', 'n', '0,1', NULL, 1, 'a', '2017-08-20 09:25:23', 'Syed Ali', NULL, NULL),
(5, 'uzardn@ufbgbz.com', 'tbojmoln', 'pSkehWHddfnpxXmi', 'foxHTzLfutHZjtFXBEc', 'n', '0', NULL, 1, 'a', '2017-08-26 06:38:33', 'tbojmoln', NULL, NULL),
(6, 'mlacev@ggqytn.com', 'dxgiflvm', 'BCdzSsOyYusUfPwxRNn', 'YGsafpmDg', 'y', '0', NULL, 1, 'a', '2017-09-05 02:46:09', 'dxgiflvm', NULL, NULL),
(7, '', 'Vamshi', '7893411188', 'Yamaha fz v 2.0', 'y', '0', NULL, 1, 'a', '2017-09-07 02:48:19', 'Vamshi', NULL, NULL),
(8, '', 'Chandrakanth Gadde', '9848885550', 'AP37CY2565', 'n', '3', NULL, 1, 'a', '2017-11-27 03:22:18', 'Chandrakanth Gadde', NULL, NULL),
(9, 'udayrao21@gmail.com', 'Uday Surve Rao', '9848868015', 'Ts07FM2464', 'n', '0,2,3', NULL, 1, 'a', '2018-02-03 10:17:40', 'Uday Surve Rao', NULL, NULL),
(10, 'Vijaykhobragade2011@gmail.com', 'Vijay', '9423409301', 'Indigo', 'n', '0', NULL, 1, 'a', '2018-02-28 01:29:52', 'Vijay', NULL, NULL),
(11, '', 'vijay', '9885051506', 'honda city', 'y', '0,1,2,3,4', NULL, 1, 'a', '2018-03-09 12:12:03', 'vijay', NULL, NULL),
(12, 'naveendavu999@gmail.com', 'NAVEEN DAVU', '9963777166', 'Renault Fluence', 'n', '3', NULL, 1, 'a', '2018-05-03 06:23:13', 'NAVEEN DAVU', NULL, NULL),
(13, 'satyaanirudh007@gmail.com', 'anirudhsatya', '8919275340', 'Hyundai accent', 'n', '0,1,2,3,4', NULL, 1, 'a', '2018-07-20 08:43:30', 'anirudhsatya', NULL, NULL),
(14, 'gak8924@gmail.com', 'Satish', '9705149070', 'Maruti Swift', 'y', '0,1', NULL, 1, 'a', '2018-07-27 11:33:11', 'Satish', NULL, NULL),
(15, 'chandruv874@gmail.com', 'Chandru', '8220783539', 'Royal Enfield classic 350', 'n', '1', NULL, 1, 'a', '2018-08-22 05:47:28', 'Chandru', NULL, NULL),
(16, 'udayrao21@gmail.com', 'uday', '9848868015', 'Volkswagen ameo', 'n', '2', NULL, 1, 'a', '2019-01-08 11:48:50', 'uday', NULL, NULL),
(17, 'Shaiksohail039@gmail.com', 'Shaiksohail', '6301101505', '0111', 'y', '0', NULL, 1, 'a', '2019-01-24 09:12:35', 'Shaiksohail', NULL, NULL),
(18, 'ahmadiqbal6685@gmail.com', 'Ahmad iqbal', '03054157093', 'Toyota dalla 6685 modal 86', 'y', '0', NULL, 1, 'a', '2019-02-05 01:22:57', 'Ahmad iqbal', NULL, NULL),
(19, 'ahmadiqbal6685@gmail.com', 'Ahmad iqbal', '03054157093', 'Toyta dalla modal 86 number 6685', 'n', '3', NULL, 1, 'a', '2019-02-05 01:24:34', 'Ahmad iqbal', NULL, NULL),
(20, 'ahmadiqbal6685@gmail.com', 'Ahmad iqbal', '03054157093', 'Toyta dalla modal 86 number Lot 6685', 'y', '0', NULL, 1, 'a', '2019-02-05 01:37:15', 'Ahmad iqbal', NULL, NULL),
(21, 'ahmadiqbal6685@gmail.com', 'Ahmad iqbal', '03054157093', 'Toyta dalla modal 86 number Lot 6685', 'y', '0', NULL, 1, 'a', '2019-02-05 01:37:40', 'Ahmad iqbal', NULL, NULL),
(22, 'himabindu@adroitinfoactive.net', 'bindu', '9177581608', 'Test', 'y', '0', NULL, 1, 'a', '2019-03-25 07:01:12', 'bindu', NULL, NULL),
(23, 'himabindu@adroitinfoactive.net', 'bindu', '9177581608', 'Test', 'y', '0', NULL, 1, 'a', '2019-03-25 07:01:12', 'bindu', NULL, NULL),
(24, 'bindubadigeru@gmail.com', 'bindu', '9177581608', 'Testing', 'y', '0', NULL, 1, 'a', '2019-03-25 07:03:43', 'bindu', NULL, NULL),
(25, 'jjnayak44@gmail.com', 'Jatoth Jemla Chandar', '9640473116', 'Tata indica ev2 cr4', 'y', '1', NULL, 1, 'a', '2019-05-12 08:35:39', 'Jatoth Jemla Chandar', NULL, NULL),
(26, 'jjnayak44@gmail.com', 'Jatoth Jemla Chandar', '9640473116', 'Tata indica ev2 cr4', 'y', '1', NULL, 1, 'a', '2019-05-12 08:35:40', 'Jatoth Jemla Chandar', NULL, NULL),
(27, 'vamsikrishnauppalapati@gmail.com', 'Vamsi krishna', '9059985988', 'Vitara brezza ZDI+', 'y', '0,1', NULL, 1, 'a', '2019-05-26 10:34:34', 'Vamsi krishna', NULL, NULL),
(28, 'vksbilife16@gmail.com', 'Krishna', '9700945988', 'Vitara brezza', 'y', '4', NULL, 1, 'a', '2019-05-26 10:35:30', 'Krishna', NULL, NULL),
(29, 'bibhu.hyd@gmail.com', 'Bibhu', '9717187439', 'Figo', 'n', '2', NULL, 1, 'a', '2019-07-30 01:13:29', 'Bibhu', NULL, NULL),
(30, '', 'Mohammad imran', '9686847861', 'Chevrolet spark', 'n', '4', NULL, 1, 'a', '2019-08-19 08:40:50', 'Mohammad imran', NULL, NULL),
(31, '', 'Nagaraj', '8464805869', 'Creta', '', '0', NULL, 1, 'a', '2019-09-09 08:53:39', 'Nagaraj', NULL, NULL),
(32, '', 'Nagaraj', '8464805869', 'Creta', '', '0', NULL, 1, 'a', '2019-09-09 08:53:41', 'Nagaraj', NULL, NULL),
(33, '', 'Nagaraj', '8464805869', 'Creta', 'y', '0', NULL, 1, 'a', '2019-09-13 11:51:05', 'Nagaraj', NULL, NULL),
(34, '', 'Venkatesh', '9989964811', 'Bmw', 'y', '0', NULL, 1, 'a', '2019-09-13 11:53:24', 'Venkatesh', NULL, NULL),
(35, '', 'Madhuker reddy', '96666244521', 'Creta', 'y', '0,1,4', NULL, 1, 'a', '2019-09-13 04:46:06', 'Madhuker reddy', NULL, NULL),
(36, 'parwatesameer@gmail.com', 'Sameer', '', 'Hyundai i-20 Active', 'n', '2,3', NULL, 1, 'a', '2020-07-16 01:06:22', 'Sameer', NULL, NULL),
(37, 'Dinakar074@gmail.com', 'Dinakar Reddy', '8555989092', 'VW polo', 'y', '0', NULL, 1, 'a', '2020-07-26 06:37:29', 'Dinakar Reddy', NULL, NULL),
(38, 'bajajdeepesh77@gmail.com', 'SHRI BAJAJ TYRES', '8886523235', 'Swift', 'y', '0,3,4', NULL, 1, 'a', '2020-08-22 08:25:49', 'SHRI BAJAJ TYRES', NULL, NULL),
(39, 'searchfame@gmail.com', 'Vinay', '7799456717', 'Hyundai Xcent', 'n', '2', NULL, 1, 'a', '2021-01-07 07:05:16', 'Vinay', NULL, NULL),
(40, 'sashandra.34@gmail.com', 'Satish', '6303476537', 'Grand i10 sportz(o)', 'y', '0', NULL, 1, 'a', '2021-10-03 02:14:37', 'Satish', NULL, NULL),
(41, 'harinchakravarthi.n@gmail.com', 'Harin Chakravarthi', '9701403350', 'Ford Aspire', 'y', '0', NULL, 1, 'a', '2021-12-04 04:17:11', 'Harin Chakravarthi', NULL, NULL),
(42, 'urooj_qadeer@yahoo.com', 'Mohammed AbdulQadeer', '8790230784', 'TS09FD7755', 'y', '0,1,4', NULL, 1, 'a', '2022-04-27 04:15:23', 'Mohammed AbdulQadeer', NULL, NULL),
(43, 'diachimar1982@mail.ru', 'yezhdsctsvc 61267191964795 61267191964795 bifugui1989 yezhdsctsvc login https://calmoand.ru/profiles chare', 'diachimar1982@mail.ru', 'yezhdsctsvc 61267191964795 61267191964795 bifugui1989 yezhdsctsvc login https://calmoand.ru/profiles chare', '', '0', NULL, 1, 'a', '2022-08-25 12:13:18', 'yezhdsctsvc 61267191964795 61267191964795 bifugui1989 yezhdsctsvc login https://calmoand.ru/profiles chare', NULL, NULL),
(44, 'satishvkatta@gmail.com', 'Satish Katta', '9885820742', 'Eco sport', 'y', '0', NULL, 1, 'a', '2022-09-22 05:13:48', 'Satish Katta', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lgntrck_mst`
--

CREATE TABLE `lgntrck_mst` (
  `lgntrckm_id` int(15) NOT NULL,
  `lgntrckm_sesid` varchar(250) NOT NULL,
  `lgntrckm_ipadrs` varchar(250) DEFAULT NULL,
  `lgntrckm_lgnm_id` int(15) NOT NULL,
  `lgntrckm_crtdon` datetime DEFAULT NULL,
  `lgntrckm_crtdby` varchar(250) DEFAULT NULL,
  `lgntrckm_mdfdon` datetime DEFAULT NULL,
  `lgntrckm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgntrck_mst`
--

INSERT INTO `lgntrck_mst` (`lgntrckm_id`, `lgntrckm_sesid`, `lgntrckm_ipadrs`, `lgntrckm_lgnm_id`, `lgntrckm_crtdon`, `lgntrckm_crtdby`, `lgntrckm_mdfdon`, `lgntrckm_mdfdby`) VALUES
(1, '4a7onspl816e4e5iamqgqbu8l4', '127.0.0.1', 1, '2015-09-29 03:40:18', 'admin', NULL, NULL),
(2, 'fa4ac46a9132e1bf7bc505382f10a8a2', '192.168.100.53', 1, '2015-09-29 10:16:11', 'admin', NULL, NULL),
(3, 'fa4ac46a9132e1bf7bc505382f10a8a2', '192.168.100.53', 1, '2015-09-29 12:14:27', 'admin', NULL, NULL),
(4, 'fa4ac46a9132e1bf7bc505382f10a8a2', '192.168.100.53', 1, '2015-09-29 04:34:16', 'admin', NULL, NULL),
(5, '3f59ea6d0eec843d8de0ed60c5803dde', '192.168.100.56', 1, '2015-09-29 06:28:39', 'admin', NULL, NULL),
(6, '0171cd9baccf06d4c8659e13d111acfd', '183.83.69.55', 1, '2015-09-29 08:19:51', 'admin', '2015-09-29 08:20:02', 'admin'),
(7, '0171cd9baccf06d4c8659e13d111acfd', '183.83.69.55', 1, '2015-09-29 08:20:26', 'admin', '2015-09-29 08:20:31', 'admin'),
(8, 'bb867bbe2506bed6e92bc34987d48888', '183.83.69.55', 1, '2015-09-29 10:59:19', 'admin', NULL, NULL),
(9, 'c207f9b142d04eaf17668554fbc16ad8', '183.83.69.55', 1, '2015-09-30 01:37:25', 'admin', NULL, NULL),
(10, '151cda619d40767d3c1f6d8164ed3e8a', '183.83.69.55', 1, '2015-09-30 03:43:51', 'admin', NULL, NULL),
(11, '4be285bbaf63e1349fefde3fffff10d6', '183.83.69.55', 1, '2015-09-30 03:45:57', 'admin', NULL, NULL),
(12, '4be285bbaf63e1349fefde3fffff10d6', '183.83.69.55', 1, '2015-09-30 03:46:01', 'admin', NULL, NULL),
(13, '6ec09e0f746a562dee7b1ac11bd791fc', '183.83.69.55', 1, '2015-09-30 03:48:28', 'admin', '2015-09-30 03:55:07', 'admin'),
(14, 'a45f62796f7442d410fc78abb3871246', '183.83.69.55', 1, '2015-09-30 07:59:50', 'admin', '2015-09-30 08:00:05', 'admin'),
(15, 'a45f62796f7442d410fc78abb3871246', '183.83.69.55', 1, '2015-09-30 08:00:15', 'admin', '2015-09-30 08:21:15', 'admin'),
(16, '05b80b862d68706d14c0248d0ac74062', '183.83.69.55', 1, '2015-09-30 10:24:25', 'admin', '2015-09-30 10:51:33', 'admin'),
(17, 'e0130f56416f152f8dc248573507928e', '183.83.69.55', 1, '2015-09-30 10:34:16', 'admin', NULL, NULL),
(18, '871f625286d5ea7467cbb002706d52d0', '183.83.64.136', 1, '2015-09-30 10:56:07', 'admin', NULL, NULL),
(19, '05b80b862d68706d14c0248d0ac74062', '183.83.69.55', 1, '2015-09-30 11:00:58', 'admin', '2015-09-30 11:01:21', 'admin'),
(20, '05b80b862d68706d14c0248d0ac74062', '183.83.69.55', 1, '2015-10-01 12:16:06', 'admin', '2015-10-01 12:16:59', 'admin'),
(21, '01aa7d91870ec28175dd5f1b52163674', '183.83.75.55', 1, '2015-10-05 10:39:08', 'admin', NULL, NULL),
(22, '01aa7d91870ec28175dd5f1b52163674', '183.83.75.55', 1, '2015-10-05 10:44:16', 'admin', NULL, NULL),
(23, 'c088978c97b269c76a5685998b5ca372', '183.83.91.224', 1, '2015-10-12 05:04:39', 'admin', NULL, NULL),
(24, 'd04cae1ab149f3ce086fb7659dfa3570', '183.83.93.29', 1, '2015-10-19 01:21:18', 'admin', NULL, NULL),
(25, 'd664de950577842e355e1d7fb120adc1', '14.96.6.108', 1, '2015-11-05 04:52:49', 'admin', NULL, NULL),
(26, 'd664de950577842e355e1d7fb120adc1', '14.99.221.173', 1, '2015-11-05 05:00:29', 'admin', NULL, NULL),
(27, '111da4e2db7a4749ea992d711f3d25d0', '183.83.128.95', 1, '2015-11-05 06:00:19', 'admin', '2015-11-05 08:02:53', 'admin'),
(28, 'e69c0257ba50ce5583a0ced2fabd5e5d', '183.83.92.247', 1, '2015-11-06 06:46:17', 'admin', NULL, NULL),
(29, 'cd6b2c5a480242f2a5cd1a18f290c059', '183.83.92.247', 1, '2015-11-06 11:07:11', 'admin', '2015-11-06 11:18:45', 'admin'),
(30, 'bcd1fbb00828b47adf44c4ea8fec6d7a', '183.83.92.247', 1, '2015-11-07 12:04:00', 'admin', NULL, NULL),
(31, '78abba09736db1e98b3790ddb1a9664e', '183.83.92.247', 1, '2015-11-07 12:14:23', 'admin', NULL, NULL),
(32, '1c0e15b25e5bf2b702b4333c4aa3cbb2', '183.83.128.95', 1, '2015-11-07 02:05:50', 'admin', '2015-11-07 03:04:04', 'admin'),
(33, '1c0e15b25e5bf2b702b4333c4aa3cbb2', '183.83.128.95', 1, '2015-11-07 03:08:46', 'admin', NULL, NULL),
(34, '840c3b68e810b5db2e3e44d91b7a012a', '183.83.128.95', 1, '2015-11-07 03:21:20', 'admin', NULL, NULL),
(35, '840c3b68e810b5db2e3e44d91b7a012a', '183.83.128.95', 1, '2015-11-07 03:39:10', 'admin', NULL, NULL),
(36, '9799e12eac3c3c457c89bed075f5dafe', '183.83.128.95', 1, '2015-11-07 05:14:42', 'admin', NULL, NULL),
(37, 'a7cb6791fd4a6ffdbb0a3f442e08b12e', '183.83.92.247', 1, '2015-11-07 06:21:53', 'admin', NULL, NULL),
(38, '0f601306194b66abf1dd31c4d8b37a42', '183.83.92.247', 1, '2015-11-07 06:29:00', 'admin', NULL, NULL),
(39, '0f601306194b66abf1dd31c4d8b37a42', '183.83.92.247', 1, '2015-11-07 07:00:31', 'admin', NULL, NULL),
(40, '6c6441a36e6ba53fde030ab9c2b48912', '183.83.67.126', 1, '2015-11-08 09:18:39', 'admin', '2015-11-08 09:19:35', 'admin'),
(41, '6c6441a36e6ba53fde030ab9c2b48912', '183.83.67.126', 1, '2015-11-08 09:24:53', 'admin', NULL, NULL),
(42, '6c6441a36e6ba53fde030ab9c2b48912', '183.83.67.126', 1, '2015-11-08 09:25:21', 'admin', '2015-11-08 09:25:27', 'admin'),
(43, '6c6441a36e6ba53fde030ab9c2b48912', '183.83.67.126', 1, '2015-11-08 09:39:45', 'admin', NULL, NULL),
(44, '5945d42bb54adb952190c06c62c94340', '183.83.128.95', 1, '2015-11-09 03:08:53', 'admin', '2015-11-09 04:49:43', 'admin'),
(45, 'mlo29pkdrtorf8stq5kfdl5k36', '::1', 1, '2016-08-22 06:25:28', 'admin', NULL, NULL),
(46, '61poiapvmmr8km4psfi8fi1fa4', '192.168.100.144', 1, '2016-08-23 09:56:35', 'admin', NULL, NULL),
(47, 'pih7cir0mnkqnmhkv6pq8mjfl6', '::1', 1, '2016-08-23 01:23:07', 'admin', NULL, NULL),
(48, '5e107ba9e6e92c807dd7aeb721a53311', '183.83.70.1', 1, '2016-08-23 06:07:40', 'admin', '2016-08-23 06:09:32', 'admin'),
(49, 'a9513a8ced0b74ec4b370cc8374fc0e1', '183.83.70.1', 1, '2016-08-23 06:11:39', 'admin', NULL, NULL),
(50, 'a9513a8ced0b74ec4b370cc8374fc0e1', '183.83.70.1', 1, '2016-08-23 06:54:23', 'admin', NULL, NULL),
(51, '5671bddc2dfbef212c7d90b2ab89c2f2', '183.83.70.1', 1, '2016-08-23 07:20:45', 'admin', NULL, NULL),
(52, '5671bddc2dfbef212c7d90b2ab89c2f2', '183.83.70.1', 1, '2016-08-23 07:25:31', 'admin', NULL, NULL),
(53, 'a97cbcbda85b4b7bade8b5327ed94521', '183.83.70.1', 1, '2016-08-23 07:30:03', 'admin', NULL, NULL),
(54, '2a7c7fce21deb9138486a1d65ba8459e', '183.83.70.1', 1, '2016-08-24 04:55:54', 'admin', NULL, NULL),
(55, 'f25dbd70d85313dc0dc78a34c606a415', '14.96.45.3', 1, '2016-08-25 01:40:51', 'admin', NULL, NULL),
(56, 'f25dbd70d85313dc0dc78a34c606a415', '14.96.45.3', 1, '2016-08-25 01:47:15', 'admin', '2016-08-25 02:45:25', 'admin'),
(57, 'f25dbd70d85313dc0dc78a34c606a415', '14.96.60.65', 1, '2016-08-25 02:47:02', 'admin', NULL, NULL),
(58, 'f25dbd70d85313dc0dc78a34c606a415', '14.96.60.65', 1, '2016-08-25 02:50:55', 'admin', '2016-08-25 02:54:02', 'admin'),
(59, '1be90e4ed0192077d49bfa3bffde5951', '183.83.128.95', 1, '2016-08-25 03:01:13', 'admin', NULL, NULL),
(60, '8d7aefa84d3fc1e828ccc919cf3f40d5', '183.83.70.1', 1, '2016-08-25 05:55:22', 'admin', NULL, NULL),
(61, '989dcd84269eace142cc20b85dc4d41b', '183.82.66.177', 1, '2016-08-28 01:01:53', 'admin', NULL, NULL),
(62, '5b3f167238713b6d4b4a61c9fdc49c20', '183.82.66.177', 1, '2016-08-28 01:23:17', 'admin', '2016-08-28 03:52:17', 'admin'),
(63, 'a0225dfb36b27ee685ae7fa4e4e2ea6b', '183.82.76.169', 1, '2016-09-01 12:22:05', 'admin', '2016-09-01 12:25:25', 'admin'),
(64, '82be8f5370ffef3e8031e95162306e43', '49.205.64.204', 1, '2016-09-06 12:28:32', 'admin', '2016-09-06 12:36:02', 'admin'),
(65, '82be8f5370ffef3e8031e95162306e43', '49.205.64.204', 1, '2016-09-06 12:37:27', 'admin', '2016-09-06 12:38:21', 'admin'),
(66, 'fcf5b61bfb9c232b965e20783460f4e9', '49.205.64.204', 1, '2016-12-30 11:00:47', 'admin', NULL, NULL),
(67, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-26 10:45:39', 'admin', NULL, NULL),
(68, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-26 11:57:48', 'admin', NULL, NULL),
(69, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-26 12:06:30', 'admin', NULL, NULL),
(70, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-27 04:56:23', 'admin', NULL, NULL),
(71, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-27 10:32:55', 'admin', NULL, NULL),
(72, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-29 04:50:47', 'admin', NULL, NULL),
(73, 'q1q5a58lqmqglmhgln42n2eb4i', '127.0.0.1', 1, '2023-05-29 04:52:01', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lgn_mst`
--

CREATE TABLE `lgn_mst` (
  `lgnm_id` int(15) NOT NULL,
  `lgnm_uid` varchar(250) NOT NULL,
  `lgnm_pwd` varchar(250) DEFAULT NULL,
  `lgnm_typ` char(1) DEFAULT NULL,
  `lgnm_sts` char(1) DEFAULT NULL,
  `lgnm_crtdon` datetime DEFAULT NULL,
  `lgnm_crtdby` varchar(250) DEFAULT NULL,
  `lgnm_mdfdon` datetime DEFAULT NULL,
  `lgnm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgn_mst`
--

INSERT INTO `lgn_mst` (`lgnm_id`, `lgnm_uid`, `lgnm_pwd`, `lgnm_typ`, `lgnm_sts`, `lgnm_crtdon`, `lgnm_crtdby`, `lgnm_mdfdon`, `lgnm_mdfdby`) VALUES
(1, 'admin', '225273e3d26ed061801ac9b0a5ca2dfc', 'a', 'a', NULL, NULL, '2015-09-30 08:00:05', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prodcat_mst`
--

CREATE TABLE `prodcat_mst` (
  `prodcatm_id` int(15) NOT NULL,
  `prodcatm_name` varchar(250) NOT NULL COMMENT 'Unique name for each category',
  `prodcatm_desc` text,
  `prodcatm_frmdt` date DEFAULT NULL,
  `prodcatm_todt` date DEFAULT NULL,
  `prodcatm_smlimg` varchar(250) DEFAULT NULL,
  `prodcatm_bnrimg` varchar(250) DEFAULT NULL,
  `prodcatm_seotitle` varchar(250) DEFAULT NULL,
  `prodcatm_seodesc` text,
  `prodcatm_seokywrd` tinytext,
  `prodcatm_seohonettl` varchar(250) DEFAULT NULL,
  `prodcatm_seohonedesc` text,
  `prodcatm_seohtwottl` varchar(250) DEFAULT NULL,
  `prodcatm_seohtwodesc` text,
  `prodcatm_taxm_id` int(15) DEFAULT NULL,
  `prodcatm_dlvrtyp` char(1) DEFAULT NULL,
  `prodcatm_sts` char(1) NOT NULL COMMENT 'Status of each category',
  `prodcatm_prty` int(15) DEFAULT NULL COMMENT 'Priority of each categories',
  `prodcatm_hmprty` int(15) DEFAULT NULL,
  `prodcatm_crtdon` date DEFAULT NULL COMMENT 'Date on which the category is created',
  `prodcatm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is created',
  `prodcatm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the category is modified',
  `prodcatm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the category is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodcat_mst`
--

INSERT INTO `prodcat_mst` (`prodcatm_id`, `prodcatm_name`, `prodcatm_desc`, `prodcatm_frmdt`, `prodcatm_todt`, `prodcatm_smlimg`, `prodcatm_bnrimg`, `prodcatm_seotitle`, `prodcatm_seodesc`, `prodcatm_seokywrd`, `prodcatm_seohonettl`, `prodcatm_seohonedesc`, `prodcatm_seohtwottl`, `prodcatm_seohtwodesc`, `prodcatm_taxm_id`, `prodcatm_dlvrtyp`, `prodcatm_sts`, `prodcatm_prty`, `prodcatm_hmprty`, `prodcatm_crtdon`, `prodcatm_crtdby`, `prodcatm_mdfdon`, `prodcatm_mdfdby`) VALUES
(33, 'ASHOK LEYLAND', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 45, NULL, '2015-11-05', 'admin', NULL, NULL),
(12, 'AUDI', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 25, NULL, '2015-11-05', 'admin', NULL, NULL),
(1, 'BAJAJ', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 1, 1, '2015-09-30', 'admin', NULL, NULL),
(15, 'BENZ MERCEDES', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '', 'a', 22, NULL, '2015-11-05', 'admin', '2015-11-05', 'admin'),
(13, 'BMW', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 24, NULL, '2015-11-05', 'admin', NULL, NULL),
(18, 'CHEVROLET', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 20, NULL, '2015-11-05', 'admin', NULL, NULL),
(14, 'DAEWOO', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 23, NULL, '2015-11-05', 'admin', NULL, NULL),
(34, 'EICHER', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 44, NULL, '2015-11-05', 'admin', NULL, NULL),
(16, 'FIAT', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 21, NULL, '2015-11-05', 'admin', NULL, NULL),
(35, 'FORCE', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 43, NULL, '2015-11-05', 'admin', NULL, NULL),
(17, 'FORD', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 21, NULL, '2015-11-05', 'admin', NULL, NULL),
(4, 'HERO', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 9, NULL, '2015-11-05', 'admin', NULL, NULL),
(20, 'HINDUSTAN MOTORS', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '', 'a', 18, NULL, '2015-11-05', 'admin', '2015-11-05', 'admin'),
(2, 'HONDA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 2, 2, '2015-09-30', 'admin', NULL, NULL),
(22, 'HYUNDAI', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 16, NULL, '2015-11-05', 'admin', NULL, NULL),
(37, 'ISUZU', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 40, NULL, '2015-11-05', 'admin', NULL, NULL),
(6, 'KINETIC', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 8, NULL, '2015-11-05', 'admin', NULL, NULL),
(23, 'LAND ROVER', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 15, NULL, '2015-11-05', 'admin', NULL, NULL),
(7, 'LML', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 7, NULL, '2015-11-05', 'admin', NULL, NULL),
(8, 'MAHINDRA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 6, NULL, '2015-11-05', 'admin', NULL, NULL),
(3, 'MARUTI', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, '', 'a', 10, NULL, '2015-11-05', 'admin', '2015-11-05', 'admin'),
(21, 'MITSUBISHI', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 17, NULL, '2015-11-05', 'admin', NULL, NULL),
(25, 'NISSAN', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 13, NULL, '2015-11-05', 'admin', NULL, NULL),
(19, 'OPEL', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 19, NULL, '2015-11-05', 'admin', NULL, NULL),
(26, 'PORSCHE', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 12, NULL, '2015-11-05', 'admin', NULL, NULL),
(24, 'RENAULT', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 14, NULL, '2015-11-05', 'admin', NULL, NULL),
(27, 'REVA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 11, NULL, '2015-11-05', 'admin', NULL, NULL),
(9, 'ROYAL ENFIELD', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 5, NULL, '2015-11-05', 'admin', NULL, NULL),
(28, 'SKODA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 50, NULL, '2015-11-05', 'admin', NULL, NULL),
(10, 'SUZUKI', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 4, NULL, '2015-11-05', 'admin', NULL, NULL),
(36, 'SWARAJ MAZDA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 41, NULL, '2015-11-05', 'admin', NULL, NULL),
(29, 'TATA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 49, NULL, '2015-11-05', 'admin', NULL, NULL),
(30, 'TOYOTA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 48, NULL, '2015-11-05', 'admin', NULL, NULL),
(11, 'TVS', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 3, NULL, '2015-11-05', 'admin', NULL, NULL),
(31, 'VOLKSWAGEN', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 47, NULL, '2015-11-05', 'admin', NULL, NULL),
(32, 'VOLVO', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 46, NULL, '2015-11-05', 'admin', NULL, NULL),
(5, 'YAMAHA', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, 'a', 8, NULL, '2015-11-05', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodimg_dtl`
--

CREATE TABLE `prodimg_dtl` (
  `prodimgd_id` int(15) NOT NULL,
  `prodimgd_prodm_id` int(15) NOT NULL COMMENT 'Product Id',
  `prodimgd_title` varchar(250) DEFAULT NULL,
  `prodimgd_desc` varchar(250) DEFAULT NULL,
  `prodimgd_simg` varchar(250) NOT NULL,
  `prodimgd_bimg` varchar(250) DEFAULT NULL,
  `prodimgd_lnk` varchar(250) DEFAULT NULL,
  `prodimgd_prty` int(15) DEFAULT NULL,
  `prodimgd_sts` char(1) DEFAULT NULL,
  `prodimgd_crtdon` date DEFAULT NULL,
  `prodimgd_crtdby` varchar(250) DEFAULT NULL,
  `prodimgd_mdfdon` date DEFAULT NULL,
  `prodimgd_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodimg_dtl`
--

INSERT INTO `prodimg_dtl` (`prodimgd_id`, `prodimgd_prodm_id`, `prodimgd_title`, `prodimgd_desc`, `prodimgd_simg`, `prodimgd_bimg`, `prodimgd_lnk`, `prodimgd_prty`, `prodimgd_sts`, `prodimgd_crtdon`, `prodimgd_crtdby`, `prodimgd_mdfdon`, `prodimgd_mdfdby`) VALUES
(9, 7, '1-AMAZER XL', NULL, 'simg57bea92276127.jpg', 'bimg57bea922761c2.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(10, 8, '1-ALNAC 4G', NULL, 'simg57bea9a4715c2.png', 'bimg57bea9a471640.png', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(11, 9, '1-AMAZER 3G MAXX', NULL, 'simg57beaa326eec1.png', 'bimg57beaa326ef66.png', '', 1, 'a', '2016-08-25', 'admin', '2016-08-25', 'admin'),
(12, 10, '1-AMAZER 4G LIFE', NULL, 'simg57beaa743c5a0.jpg', 'bimg57beaa743c67a.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(13, 11, '1-B250', NULL, 'simg57beabb47e27a.jpg', 'bimg57beabb47e313.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(14, 12, '1-B290', NULL, 'simg57beabd817443.jpg', 'bimg57beabd8174ab.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(15, 13, '1-EP150', NULL, 'simg57beac1e302ee.png', 'bimg57beac1e3038d.png', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(16, 14, '1-B390', NULL, 'simg57beac529673b.jpg', 'bimg57beac52967d6.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(17, 15, '1-EARTH 1', NULL, 'simg57bead556da4b.jpg', 'bimg57bead556dae0.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(18, 16, '1-GEOLANDER', NULL, 'simg57bead7b42345.jpg', 'bimg57bead7b423dd.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(19, 17, '1-GEOLANDER SUV', NULL, 'simg57beadb0287de.jpg', 'bimg57beadb0288a0.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(20, 18, '1-ZVTS', NULL, 'simg57beaee799f20.jpg', 'bimg57beaee799fce.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(21, 19, '1-ZLX', NULL, 'simg57beaf08f3cd4.jpg', 'bimg57beaf08f3d34.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(22, 20, '1-ZV2K', NULL, 'simg57beaf37c1d30.png', 'bimg57beaf37c1dae.png', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(23, 21, '1-ZVTV', NULL, 'simg57beaf5fd059d.jpg', 'bimg57beaf5fd062f.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(24, 22, '1-WANDERER', NULL, 'simg57beaf8328a9f.jpg', 'bimg57beaf8328b6c.jpg', '	', 1, 'a', '2016-08-25', 'admin', NULL, NULL),
(25, 27, '1-new 5', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', NULL, NULL),
(26, 28, '1-code 5', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', NULL, NULL),
(27, 29, '1-new3', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', NULL, NULL),
(28, 33, '1-code1', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', '2023-05-27', 'admin'),
(29, 30, '1-code 1', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', '2023-05-29', 'admin'),
(30, 34, '1-code1', NULL, '', '', '', 1, 'a', '2023-05-27', 'admin', '2023-05-29', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prodscat_mst`
--

CREATE TABLE `prodscat_mst` (
  `prodscatm_id` int(15) NOT NULL,
  `prodscatm_name` varchar(250) NOT NULL COMMENT 'Name of the product main category 2',
  `prodscatm_desc` text,
  `prodscatm_prodcatm_id` int(15) NOT NULL,
  `prodscatm_szchrtimg` varchar(250) DEFAULT NULL,
  `prodscatm_icnimg` varchar(250) DEFAULT NULL,
  `prodscatm_hmpg` char(1) DEFAULT NULL COMMENT 'yes - y or no - no',
  `prodscatm_pstn` char(1) DEFAULT NULL COMMENT 'Top - t or bottom - b',
  `prodscatm_frmdt` date DEFAULT NULL,
  `prodscatm_todt` date DEFAULT NULL,
  `prodscatm_sts` char(1) DEFAULT NULL COMMENT 'Status of the product main category 2',
  `prodscatm_prty` int(15) DEFAULT NULL COMMENT 'Priority of the product main category 2',
  `prodscatm_seotitle` varchar(250) DEFAULT NULL,
  `prodscatm_seodesc` text,
  `prodscatm_seokywrd` text,
  `prodscatm_seohonettl` varchar(250) DEFAULT NULL,
  `prodscatm_seohonedesc` text,
  `prodscatm_seohtwottl` varchar(250) DEFAULT NULL,
  `prodscatm_seohtwodesc` text,
  `prodscatm_crtdon` datetime DEFAULT NULL COMMENT 'Date on which product main category 2 is created',
  `prodscatm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the product main category2 is created',
  `prodscatm_mdfdon` datetime DEFAULT NULL COMMENT 'Date on which the product main category 2 is modified',
  `prodscatm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'BY whom the product main category 2 is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodscat_mst`
--

INSERT INTO `prodscat_mst` (`prodscatm_id`, `prodscatm_name`, `prodscatm_desc`, `prodscatm_prodcatm_id`, `prodscatm_szchrtimg`, `prodscatm_icnimg`, `prodscatm_hmpg`, `prodscatm_pstn`, `prodscatm_frmdt`, `prodscatm_todt`, `prodscatm_sts`, `prodscatm_prty`, `prodscatm_seotitle`, `prodscatm_seodesc`, `prodscatm_seokywrd`, `prodscatm_seohonettl`, `prodscatm_seohonedesc`, `prodscatm_seohtwottl`, `prodscatm_seohtwodesc`, `prodscatm_crtdon`, `prodscatm_crtdby`, `prodscatm_mdfdon`, `prodscatm_mdfdby`) VALUES
(180, '1000', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 07:18:14', 'admin', NULL, NULL),
(219, '1109', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 07:29:24', 'admin', NULL, NULL),
(217, '207', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 07:28:55', 'admin', NULL, NULL),
(104, '250', '', 15, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:56:58', 'admin', NULL, NULL),
(218, '407', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 07:29:04', 'admin', NULL, NULL),
(105, '500', '', 15, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:57:07', 'admin', NULL, NULL),
(179, '800', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 07:17:59', 'admin', NULL, NULL),
(181, 'A STAR', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 07:18:26', 'admin', NULL, NULL),
(81, 'A4', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:49:29', 'admin', NULL, NULL),
(82, 'A6', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:49:38', 'admin', NULL, NULL),
(83, 'A7', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 06:49:48', 'admin', NULL, NULL),
(84, 'A8', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 06:50:01', 'admin', NULL, NULL),
(145, 'ACCENT', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 30, '', '', '', '', '', '', '', '2015-11-05 07:08:44', 'admin', NULL, NULL),
(67, 'ACCESS', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 06:44:17', 'admin', NULL, NULL),
(138, 'ACCORD', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:06:47', 'admin', NULL, NULL),
(220, 'ACE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 07:29:37', 'admin', NULL, NULL),
(28, 'ACHIEVER', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 99, '', '', '', '', '', '', '', '2015-11-05 06:27:36', 'admin', NULL, NULL),
(42, 'ACTIVA', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 06:32:38', 'admin', NULL, NULL),
(160, 'ALFA', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 07:12:42', 'admin', NULL, NULL),
(182, 'ALTO', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 07:18:40', 'admin', NULL, NULL),
(183, 'ALTO K10', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 07:18:49', 'admin', NULL, NULL),
(141, 'AMAZE', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:07:20', 'admin', NULL, NULL),
(131, 'AMBASSADOR', '', 20, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:04:06', 'admin', NULL, NULL),
(208, 'AMBIENTE', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 07:25:58', 'admin', NULL, NULL),
(29, 'AMBITION', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 98, '', '', '', '', '', '', '', '2015-11-05 06:27:48', 'admin', NULL, NULL),
(75, 'APACHE', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 06:46:19', 'admin', NULL, NULL),
(221, 'ARIA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 07:29:49', 'admin', NULL, NULL),
(12, 'AVENGER', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 492, '', '', '', '', '', '', '', '2015-11-05 06:21:26', 'admin', NULL, NULL),
(122, 'AVEO', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:00:56', 'admin', NULL, NULL),
(43, 'AVIATOR', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 06:33:05', 'admin', NULL, NULL),
(184, 'BALENO', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 07:19:01', 'admin', NULL, NULL),
(123, 'BEAT', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:01:11', 'admin', NULL, NULL),
(252, 'BEETLE', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:39:32', 'admin', NULL, NULL),
(161, 'BOLERO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 07:13:05', 'admin', NULL, NULL),
(13, 'BOXER', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 490, '', '', '', '', '', '', '', '2015-11-05 06:21:36', 'admin', NULL, NULL),
(139, 'BRIO', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:06:58', 'admin', NULL, NULL),
(66, 'BULLET', '', 9, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 100, '', '', '', '', '', '', '', '2015-11-05 06:43:54', 'admin', NULL, NULL),
(260, 'BUS', '', 32, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:41:31', 'admin', NULL, NULL),
(263, 'BUS', '', 33, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 07:42:13', 'admin', NULL, NULL),
(266, 'BUS', '', 34, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:43:57', 'admin', NULL, NULL),
(274, 'BUS', '', 37, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:46:30', 'admin', NULL, NULL),
(106, 'C CLASS', '', 15, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 06:57:19', 'admin', NULL, NULL),
(14, 'CALIBER', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 489, '', '', '', '', '', '', '', '2015-11-05 06:21:56', 'admin', NULL, NULL),
(242, 'CAMRY', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 07:37:32', 'admin', NULL, NULL),
(124, 'CAPTIVA', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:01:23', 'admin', NULL, NULL),
(202, 'CARRERA', '', 26, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:23:40', 'admin', NULL, NULL),
(204, 'CAYENNE', '', 26, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:24:16', 'admin', NULL, NULL),
(46, 'CB SHINE', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 06:33:57', 'admin', NULL, NULL),
(47, 'CB TWISTER', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-05 06:34:10', 'admin', NULL, NULL),
(48, 'CB UNICORN', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 06:34:38', 'admin', NULL, NULL),
(49, 'CB1000R', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 06:34:59', 'admin', NULL, NULL),
(51, 'CBR 1000RR', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-05 06:35:42', 'admin', NULL, NULL),
(50, 'CBR 250R', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 06:35:28', 'admin', NULL, NULL),
(30, 'CBZ', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 97, '', '', '', '', '', '', '', '2015-11-05 06:28:12', 'admin', NULL, NULL),
(32, 'CD DAWN', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 95, '', '', '', '', '', '', '', '2015-11-05 06:28:46', 'admin', NULL, NULL),
(31, 'CD-100', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 96, '', '', '', '', '', '', '', '2015-11-05 06:28:28', 'admin', NULL, NULL),
(133, 'CEDIA', '', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:05:13', 'admin', NULL, NULL),
(162, 'CHAMPION', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 07:13:21', 'admin', NULL, NULL),
(4, 'CHETAK', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 500, '', '', '', '', '', '', '', '2015-11-05 06:19:25', 'admin', NULL, NULL),
(189, 'CIAZ', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-05 07:20:04', 'admin', NULL, NULL),
(100, 'CIELO', '', 14, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:54:55', 'admin', NULL, NULL),
(140, 'CITY', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:07:10', 'admin', NULL, NULL),
(222, 'CITYRIDE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-05 07:30:01', 'admin', NULL, NULL),
(142, 'CIVIC', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:07:34', 'admin', NULL, NULL),
(209, 'COMBI', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 07:26:23', 'admin', NULL, NULL),
(163, 'COMMANDER', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 07:13:48', 'admin', NULL, NULL),
(132, 'CONTESSA', '', 20, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:04:57', 'admin', NULL, NULL),
(243, 'COROLLA', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 07:37:42', 'admin', NULL, NULL),
(129, 'CORSA', '', 19, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:02:28', 'admin', NULL, NULL),
(143, 'CR-V', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-05 07:07:47', 'admin', NULL, NULL),
(52, 'CRUX', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 06:36:09', 'admin', NULL, NULL),
(125, 'CRUZE', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:01:33', 'admin', NULL, NULL),
(15, 'CT-100', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 488, '', '', '', '', '', '', '', '2015-11-05 06:22:14', 'admin', NULL, NULL),
(33, 'DAWN', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 94, '', '', '', '', '', '', '', '2015-11-05 06:29:17', 'admin', NULL, NULL),
(268, 'DCM', '', 34, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:44:22', 'admin', NULL, NULL),
(44, 'DIO', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 06:33:19', 'admin', NULL, NULL),
(16, 'DISCOVER', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 488, '', '', '', '', '', '', '', '2015-11-05 06:22:44', 'admin', NULL, NULL),
(265, 'DOST', '', 33, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-05 07:43:14', 'admin', NULL, NULL),
(63, 'DURO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:42:49', 'admin', NULL, NULL),
(275, 'DUSTER', '', 24, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:58:01', 'admin', NULL, NULL),
(107, 'E CLASS', '', 15, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 06:57:32', 'admin', NULL, NULL),
(185, 'EECO', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-05 07:19:17', 'admin', NULL, NULL),
(146, 'ELANTRA', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 29, '', '', '', '', '', '', '', '2015-11-05 07:09:00', 'admin', NULL, NULL),
(210, 'ELEGANCE', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-05 07:27:26', 'admin', NULL, NULL),
(17, 'ELIMINATOR', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 487, '', '', '', '', '', '', '', '2015-11-05 06:23:13', 'admin', NULL, NULL),
(116, 'ENDEAVOR', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:59:47', 'admin', NULL, NULL),
(53, 'ENTICER', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 06:36:20', 'admin', NULL, NULL),
(147, 'EON', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 28, '', '', '', '', '', '', '', '2015-11-05 07:09:17', 'admin', NULL, NULL),
(187, 'ERTIGA', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 41, '', '', '', '', '', '', '', '2015-11-05 07:19:37', 'admin', NULL, NULL),
(117, 'ESCORT', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:59:57', 'admin', NULL, NULL),
(223, 'ESTATE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 07:30:11', 'admin', NULL, NULL),
(186, 'ESTEEM', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 07:19:27', 'admin', NULL, NULL),
(45, 'ETERNO', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 06:33:31', 'admin', NULL, NULL),
(244, 'ETIOS', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-05 07:37:53', 'admin', NULL, NULL),
(245, 'ETIOS LIVA', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-05 07:38:06', 'admin', NULL, NULL),
(211, 'FABIA', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-05 07:27:39', 'admin', NULL, NULL),
(54, 'FAZER', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 06:36:45', 'admin', NULL, NULL),
(76, 'FIERO', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-05 06:46:39', 'admin', NULL, NULL),
(119, 'FIGO', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:00:17', 'admin', NULL, NULL),
(77, 'FLAME', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-05 06:46:57', 'admin', NULL, NULL),
(157, 'FLUIDIC VERNA', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-05 07:11:46', 'admin', NULL, NULL),
(246, 'FORTUNER', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-05 07:38:17', 'admin', NULL, NULL),
(158, 'FREELANDER', '', 23, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:12:04', 'admin', NULL, NULL),
(118, 'FUSION', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:00:07', 'admin', NULL, NULL),
(55, 'FZ', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 06:36:54', 'admin', NULL, NULL),
(148, 'GETZ', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 27, '', '', '', '', '', '', '', '2015-11-05 07:09:30', 'admin', NULL, NULL),
(56, 'GLADIATOR', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 06:37:20', 'admin', NULL, NULL),
(34, 'GLAMOUR', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 93, '', '', '', '', '', '', '', '2015-11-05 06:30:14', 'admin', NULL, NULL),
(188, 'GRAND VITARA', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 07:19:49', 'admin', NULL, NULL),
(112, 'GRANDE PUNTO', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-05 06:58:45', 'admin', NULL, NULL),
(205, 'GT3 RS', '', 26, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:24:30', 'admin', NULL, NULL),
(190, 'GYPSY', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-05 07:20:15', 'admin', NULL, NULL),
(68, 'HAYABUSA', '', 10, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 06:44:34', 'admin', NULL, NULL),
(61, 'HONDA', '', 6, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:42:04', 'admin', NULL, NULL),
(35, 'HUNK', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 92, '', '', '', '', '', '', '', '2015-11-05 06:30:27', 'admin', NULL, NULL),
(207, 'i', '', 27, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:25:05', 'admin', NULL, NULL),
(149, 'i10', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 25, '', '', '', '', '', '', '', '2015-11-05 07:09:45', 'admin', NULL, NULL),
(150, 'i20', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 24, '', '', '', '', '', '', '', '2015-11-05 07:10:01', 'admin', NULL, NULL),
(120, 'IKON', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:00:27', 'admin', NULL, NULL),
(224, 'INDICA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 07:30:23', 'admin', NULL, NULL),
(225, 'INDICA VISTA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-05 07:30:36', 'admin', NULL, NULL),
(226, 'INDIGO', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 07:30:56', 'admin', NULL, NULL),
(227, 'INDIGO MANZA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 41, '', '', '', '', '', '', '', '2015-11-05 07:31:05', 'admin', NULL, NULL),
(228, 'INDIGO MARINA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 07:31:15', 'admin', NULL, NULL),
(247, 'INNOVA', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-05 07:38:30', 'admin', NULL, NULL),
(144, 'JAZZ', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 4, '', '', '', '', '', '', '', '2015-11-05 07:08:04', 'admin', NULL, NULL),
(253, 'JETTA', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:39:40', 'admin', NULL, NULL),
(36, 'JOY', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 91, '', '', '', '', '', '', '', '2015-11-05 06:30:39', 'admin', NULL, NULL),
(276, 'Jv', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 23, '', '', '', '', '', '', '', '2015-11-07 03:10:30', 'admin', NULL, NULL),
(37, 'KARIZMA', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 90, '', '', '', '', '', '', '', '2015-11-05 06:30:53', 'admin', NULL, NULL),
(38, 'KARIZMA ZMR', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 89, '', '', '', '', '', '', '', '2015-11-05 06:31:06', 'admin', NULL, NULL),
(5, 'KRISTAL', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 499, '', '', '', '', '', '', '', '2015-11-05 06:19:42', 'admin', NULL, NULL),
(134, 'LANCER', '', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:05:45', 'admin', NULL, NULL),
(248, 'LAND CRUISER', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-05 07:38:46', 'admin', NULL, NULL),
(212, 'LAURA', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-05 07:27:49', 'admin', NULL, NULL),
(6, 'LEGEND', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 498, '', '', '', '', '', '', '', '2015-11-05 06:20:00', 'admin', NULL, NULL),
(57, 'LIBERO', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 06:37:31', 'admin', NULL, NULL),
(109, 'LINEA', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 06:58:06', 'admin', NULL, NULL),
(164, 'LOADKING', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 07:14:13', 'admin', NULL, NULL),
(178, 'LOGAN', '', 24, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:17:45', 'admin', NULL, NULL),
(60, 'LUNA', '', 6, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:41:12', 'admin', NULL, NULL),
(229, 'MAGIC', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 07:31:43', 'admin', NULL, NULL),
(165, 'MARSHAL', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 07:14:27', 'admin', NULL, NULL),
(101, 'MATIZ', '', 14, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:55:04', 'admin', NULL, NULL),
(166, 'MAXI TRUCK', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 07:14:49', 'admin', NULL, NULL),
(167, 'MAXX PICK UP', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 07:15:03', 'admin', NULL, NULL),
(168, 'MAXXIMO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 41, '', '', '', '', '', '', '', '2015-11-05 07:15:16', 'admin', NULL, NULL),
(198, 'MICRA', '', 25, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:22:37', 'admin', NULL, NULL),
(269, 'MINIDOR', '', 35, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:44:55', 'admin', NULL, NULL),
(121, 'MONDEO', '', 17, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:00:42', 'admin', NULL, NULL),
(135, 'MONTERO', '', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:05:59', 'admin', NULL, NULL),
(230, 'NANO', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-05 07:31:59', 'admin', NULL, NULL),
(102, 'NEXIA', '', 14, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 06:55:15', 'admin', NULL, NULL),
(103, 'NUBIRA', '', 14, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 06:55:29', 'admin', NULL, NULL),
(191, 'OMNI', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-05 07:20:32', 'admin', NULL, NULL),
(126, 'OPTRA', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:01:48', 'admin', NULL, NULL),
(136, 'OUTLANDER', '', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:06:15', 'admin', NULL, NULL),
(137, 'PAJERO', '', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:06:26', 'admin', NULL, NULL),
(110, 'PALIO', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 06:58:20', 'admin', NULL, NULL),
(254, 'PASSAT', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:39:49', 'admin', NULL, NULL),
(39, 'PASSION', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 88, '', '', '', '', '', '', '', '2015-11-05 06:31:26', 'admin', NULL, NULL),
(111, 'PETRA', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-05 06:58:30', 'admin', NULL, NULL),
(255, 'PHAETON', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:40:05', 'admin', NULL, NULL),
(18, 'PLATINA', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 486, '', '', '', '', '', '', '', '2015-11-05 06:23:25', 'admin', NULL, NULL),
(27, 'PLEASURE', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 100, '', '', '', '', '', '', '', '2015-11-05 06:27:19', 'admin', NULL, NULL),
(256, 'POLO', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:40:15', 'admin', NULL, NULL),
(249, 'PRADO', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 13, '', '', '', '', '', '', '', '2015-11-05 07:38:56', 'admin', NULL, NULL),
(250, 'PRIUS', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 11, '', '', '', '', '', '', '', '2015-11-05 07:39:09', 'admin', NULL, NULL),
(19, 'PULSAR 135', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 485, '', '', '', '', '', '', '', '2015-11-05 06:23:54', 'admin', NULL, NULL),
(20, 'PULSAR 150', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 484, '', '', '', '', '', '', '', '2015-11-05 06:25:06', 'admin', NULL, NULL),
(21, 'PULSAR 180', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 483, '', '', '', '', '', '', '', '2015-11-05 06:25:17', 'admin', NULL, NULL),
(22, 'PULSAR 200', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 482, '', '', '', '', '', '', '', '2015-11-05 06:25:36', 'admin', NULL, NULL),
(23, 'PULSAR 220', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 481, '', '', '', '', '', '', '', '2015-11-05 06:25:50', 'admin', NULL, NULL),
(113, 'PUNTO', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-05 06:58:57', 'admin', NULL, NULL),
(85, 'Q3', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 06:50:17', 'admin', NULL, NULL),
(86, 'Q5', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-05 06:50:26', 'admin', NULL, NULL),
(87, 'Q7', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 4, '', '', '', '', '', '', '', '2015-11-05 06:50:36', 'admin', NULL, NULL),
(251, 'QUALIS', '', 30, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:39:20', 'admin', NULL, NULL),
(89, 'R8', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 2, '', '', '', '', '', '', '', '2015-11-05 06:51:02', 'admin', NULL, NULL),
(159, 'RANGE ROVER', '', 23, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:12:17', 'admin', NULL, NULL),
(213, 'RAPID', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-05 07:28:05', 'admin', NULL, NULL),
(214, 'RIDER', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 13, '', '', '', '', '', '', '', '2015-11-05 07:28:18', 'admin', NULL, NULL),
(192, 'RITZ', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 37, '', '', '', '', '', '', '', '2015-11-05 07:20:42', 'admin', NULL, NULL),
(64, 'RODEO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 06:43:01', 'admin', NULL, NULL),
(88, 'RS', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 3, '', '', '', '', '', '', '', '2015-11-05 06:50:50', 'admin', NULL, NULL),
(58, 'RTZ', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-05 06:37:53', 'admin', NULL, NULL),
(59, 'RX 100/125/135', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-05 06:38:25', 'admin', NULL, NULL),
(108, 'S CLASS', '', 15, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 06:57:45', 'admin', NULL, NULL),
(261, 'S80', '', 32, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:41:40', 'admin', NULL, NULL),
(231, 'SAFARI', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-05 07:32:18', 'admin', NULL, NULL),
(232, 'SAFARI DICOR', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 37, '', '', '', '', '', '', '', '2015-11-05 07:32:32', 'admin', NULL, NULL),
(7, 'SAFFIRE', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 497, '', '', '', '', '', '', '', '2015-11-05 06:20:16', 'admin', NULL, NULL),
(151, 'SANTRO', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 23, '', '', '', '', '', '', '', '2015-11-05 07:10:16', 'admin', NULL, NULL),
(70, 'SCOOTY', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-05 06:45:13', 'admin', NULL, NULL),
(71, 'SCOOTY PEP', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-05 06:45:23', 'admin', NULL, NULL),
(169, 'SCORPIO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 07:15:30', 'admin', NULL, NULL),
(91, 'SERIES 3', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-05 06:51:39', 'admin', NULL, NULL),
(92, 'SERIES 5', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 06:51:50', 'admin', NULL, NULL),
(93, 'SERIES 6', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-05 06:52:02', 'admin', NULL, NULL),
(94, 'SERIES 7', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-05 06:52:22', 'admin', '2015-11-05 06:54:31', 'admin'),
(95, 'SERIES M', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-05 06:53:09', 'admin', NULL, NULL),
(96, 'SERIES X1', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-05 06:53:32', 'admin', NULL, NULL),
(114, 'SIENA', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-05 06:59:13', 'admin', NULL, NULL),
(233, 'SIERRA', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 35, '', '', '', '', '', '', '', '2015-11-05 07:34:11', 'admin', NULL, NULL),
(152, 'SONATA', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 22, '', '', '', '', '', '', '', '2015-11-05 07:10:34', 'admin', NULL, NULL),
(234, 'SPACIO', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 34, '', '', '', '', '', '', '', '2015-11-05 07:35:24', 'admin', NULL, NULL),
(127, 'SPARK', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-05 07:02:01', 'admin', NULL, NULL),
(72, 'SPECTRA', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-05 06:45:36', 'admin', NULL, NULL),
(8, 'SPIRIT', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 496, '', '', '', '', '', '', '', '2015-11-05 06:20:29', 'admin', NULL, NULL),
(40, 'SPLENDOR', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 87, '', '', '', '', '', '', '', '2015-11-05 06:31:39', 'admin', NULL, NULL),
(65, 'STALLIO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 06:43:16', 'admin', NULL, NULL),
(80, 'STAR', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-05 06:47:50', 'admin', NULL, NULL),
(78, 'STARCITY', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-05 06:47:21', 'admin', NULL, NULL),
(73, 'STREAK', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-05 06:45:48', 'admin', NULL, NULL),
(41, 'STREET', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 86, '', '', '', '', '', '', '', '2015-11-05 06:31:50', 'admin', NULL, NULL),
(9, 'STRIDE', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 495, '', '', '', '', '', '', '', '2015-11-05 06:20:42', 'admin', NULL, NULL),
(235, 'SUMO', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 32, '', '', '', '', '', '', '', '2015-11-05 07:35:37', 'admin', NULL, NULL),
(236, 'SUMO GRANDE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 30, '', '', '', '', '', '', '', '2015-11-05 07:35:50', 'admin', NULL, NULL),
(10, 'SUNNY', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 494, '', '', '', '', '', '', '', '2015-11-05 06:20:55', 'admin', NULL, NULL),
(199, 'SUNNY', '', 25, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:22:47', 'admin', NULL, NULL),
(237, 'SUPER ACE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 29, '', '', '', '', '', '', '', '2015-11-05 07:36:03', 'admin', NULL, NULL),
(215, 'SUPERB', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 12, '', '', '', '', '', '', '', '2015-11-05 07:28:28', 'admin', NULL, NULL),
(193, 'SWIFT', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 35, '', '', '', '', '', '', '', '2015-11-05 07:20:56', 'admin', NULL, NULL),
(194, 'SX4', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 34, '', '', '', '', '', '', '', '2015-11-05 07:21:08', 'admin', NULL, NULL),
(128, 'TAVERA', '', 18, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 4, '', '', '', '', '', '', '', '2015-11-05 07:02:13', 'admin', NULL, NULL),
(200, 'TEANA', '', 25, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:22:58', 'admin', NULL, NULL),
(153, 'TERACAN', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 21, '', '', '', '', '', '', '', '2015-11-05 07:10:49', 'admin', NULL, NULL),
(170, 'THAR', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-05 07:15:47', 'admin', NULL, NULL),
(26, 'THREE WHEELER', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 478, '', '', '', '', '', '', '', '2015-11-05 06:26:58', 'admin', NULL, NULL),
(154, 'TORANADO', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 07:11:07', 'admin', NULL, NULL),
(257, 'TOURAEG', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:40:34', 'admin', NULL, NULL),
(171, 'TOURISTER', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-05 07:16:11', 'admin', NULL, NULL),
(270, 'TRAVELLER', '', 35, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:45:04', 'admin', NULL, NULL),
(271, 'TRAX', '', 35, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-05 07:45:14', 'admin', NULL, NULL),
(238, 'TRUCK', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 28, '', '', '', '', '', '', '', '2015-11-05 07:36:20', 'admin', NULL, NULL),
(259, 'TRUCK', '', 32, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:41:22', 'admin', NULL, NULL),
(264, 'TRUCK', '', 33, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-05 07:42:52', 'admin', NULL, NULL),
(267, 'TRUCK', '', 34, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:44:05', 'admin', NULL, NULL),
(272, 'TRUCK', '', 35, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-05 07:45:27', 'admin', NULL, NULL),
(273, 'TRUCK', '', 36, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 07:46:12', 'admin', NULL, NULL),
(90, 'TT', '', 12, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 1, '', '', '', '', '', '', '', '2015-11-05 06:51:11', 'admin', NULL, NULL),
(206, 'TURBO', '', 26, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-05 07:24:43', 'admin', NULL, NULL),
(203, 'TURBO CABRIOLET', '', 26, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:24:01', 'admin', NULL, NULL),
(155, 'TUSCAN', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-05 07:11:23', 'admin', NULL, NULL),
(176, 'TUV300', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 33, '', '', '', '', '', '', '', '2015-11-05 07:17:13', 'admin', NULL, NULL),
(115, 'UNO', '', 16, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-05 06:59:22', 'admin', NULL, NULL),
(172, 'UTILITY', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 37, '', '', '', '', '', '', '', '2015-11-05 07:16:25', 'admin', NULL, NULL),
(130, 'VECTRA', '', 19, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-05 07:02:40', 'admin', NULL, NULL),
(258, 'VENTO', '', 31, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-05 07:40:47', 'admin', NULL, NULL),
(239, 'VENTURE', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 27, '', '', '', '', '', '', '', '2015-11-05 07:36:37', 'admin', NULL, NULL),
(173, 'VERITO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 36, '', '', '', '', '', '', '', '2015-11-05 07:16:38', 'admin', NULL, NULL),
(156, 'VERNA', '', 22, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-05 07:11:33', 'admin', NULL, NULL),
(195, 'VERSA', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 33, '', '', '', '', '', '', '', '2015-11-05 07:21:21', 'admin', NULL, NULL),
(62, 'VESPA', '', 7, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:42:33', 'admin', NULL, NULL),
(79, 'VICTOR', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-05 06:47:35', 'admin', NULL, NULL),
(174, 'VOYAGER', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 35, '', '', '', '', '', '', '', '2015-11-05 07:16:48', 'admin', NULL, NULL),
(196, 'WAGON R', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 32, '', '', '', '', '', '', '', '2015-11-05 07:21:32', 'admin', NULL, NULL),
(11, 'WAVE', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 493, '', '', '', '', '', '', '', '2015-11-05 06:21:09', 'admin', NULL, NULL),
(74, 'WEGO', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-05 06:45:58', 'admin', NULL, NULL),
(24, 'WIND', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 480, '', '', '', '', '', '', '', '2015-11-05 06:26:17', 'admin', NULL, NULL),
(240, 'WINGER', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 25, '', '', '', '', '', '', '', '2015-11-05 07:36:47', 'admin', NULL, NULL),
(201, 'X-TRAIL', '', 25, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:23:15', 'admin', NULL, NULL),
(97, 'X3', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 13, '', '', '', '', '', '', '', '2015-11-05 06:53:42', 'admin', NULL, NULL),
(98, 'X5', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 12, '', '', '', '', '', '', '', '2015-11-05 06:53:56', 'admin', NULL, NULL),
(99, 'X6', '', 13, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-05 06:54:06', 'admin', NULL, NULL),
(262, 'X60', '', 32, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-05 07:41:48', 'admin', NULL, NULL),
(25, 'XCD', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 479, '', '', '', '', '', '', '', '2015-11-05 06:26:27', 'admin', NULL, NULL),
(241, 'XENON', '', 29, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 24, '', '', '', '', '', '', '', '2015-11-05 07:37:02', 'admin', NULL, NULL),
(69, 'XL-SUPER', '', 11, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-05 06:44:57', 'admin', NULL, NULL),
(175, 'XUV500', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 34, '', '', '', '', '', '', '', '2015-11-05 07:17:02', 'admin', NULL, NULL),
(177, 'XYLO', '', 8, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 32, '', '', '', '', '', '', '', '2015-11-05 07:17:30', 'admin', NULL, NULL),
(216, 'YETI', '', 28, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 11, '', '', '', '', '', '', '', '2015-11-05 07:28:36', 'admin', NULL, NULL),
(197, 'ZEN', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 30, '', '', '', '', '', '', '', '2015-11-05 07:22:03', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prod_mst`
--

CREATE TABLE `prod_mst` (
  `prodm_id` int(15) NOT NULL,
  `prodm_code` varchar(250) NOT NULL,
  `prodm_name` varchar(250) NOT NULL,
  `prodm_descone` longtext,
  `prodm_desctwo` longtext,
  `prodm_mrp` double(10,2) DEFAULT NULL COMMENT 'Maximum Retail Price',
  `prodm_op` double(10,2) DEFAULT NULL COMMENT 'Offer Price',
  `prodm_wt` double(10,2) DEFAULT NULL,
  `prodm_vehtypm_id` int(15) NOT NULL,
  `prodm_brndm_id` int(15) NOT NULL,
  `prodm_catthrm_id` int(15) DEFAULT NULL,
  `prodm_typ` char(1) NOT NULL COMMENT 'Product type G - General Or R - Restricted',
  `prodm_seotitle` varchar(250) DEFAULT NULL,
  `prodm_seodesc` text,
  `prodm_seokywrd` tinytext,
  `prodm_seohonetitle` varchar(250) DEFAULT NULL,
  `prodm_seohonedesc` text,
  `prodm_seohtwotitle` varchar(250) DEFAULT NULL,
  `prodm_seohtwodesc` text,
  `prodm_prty` int(15) NOT NULL,
  `prodm_sts` char(1) NOT NULL,
  `prodm_crtdon` datetime DEFAULT NULL,
  `prodm_crtdby` varchar(250) DEFAULT NULL,
  `prodm_mdfdon` datetime DEFAULT NULL,
  `prodm_mdfdby` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_mst`
--

INSERT INTO `prod_mst` (`prodm_id`, `prodm_code`, `prodm_name`, `prodm_descone`, `prodm_desctwo`, `prodm_mrp`, `prodm_op`, `prodm_wt`, `prodm_vehtypm_id`, `prodm_brndm_id`, `prodm_catthrm_id`, `prodm_typ`, `prodm_seotitle`, `prodm_seodesc`, `prodm_seokywrd`, `prodm_seohonetitle`, `prodm_seohonedesc`, `prodm_seohtwotitle`, `prodm_seohtwodesc`, `prodm_prty`, `prodm_sts`, `prodm_crtdon`, `prodm_crtdby`, `prodm_mdfdon`, `prodm_mdfdby`) VALUES
(8, 'ALNAC 4G', 'ALNAC 4G', '', '', NULL, NULL, NULL, 0, 6, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2016-08-25 02:17:40', 'admin', NULL, NULL),
(9, 'AMAZER 3G MAXX', 'AMAZER 3G', '', '', NULL, NULL, NULL, 0, 6, NULL, '1', '', '', '', '', '', '', '', 3, 'a', '2016-08-25 02:18:29', 'admin', '2016-08-25 02:20:02', 'admin'),
(10, 'AMAZER 4G LIFE', 'AMAZER 4G LIFE', '', '', NULL, NULL, NULL, 0, 6, NULL, '1', '', '', '', '', '', '', '', 4, 'a', '2016-08-25 02:21:07', 'admin', NULL, NULL),
(7, 'AMAZER XL', 'AMAZER XL', '', '', NULL, NULL, NULL, 0, 6, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2016-08-25 02:15:30', 'admin', NULL, NULL),
(11, 'B250', 'B250', '', '', NULL, NULL, NULL, 0, 8, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2016-08-25 02:26:28', 'admin', NULL, NULL),
(12, 'B290', 'B290', '', '', NULL, NULL, NULL, 0, 8, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2016-08-25 02:27:03', 'admin', NULL, NULL),
(14, 'B390', 'B390', '', '', NULL, NULL, NULL, 0, 8, NULL, '1', '', '', '', '', '', '', '', 4, 'a', '2016-08-25 02:29:06', 'admin', NULL, NULL),
(15, 'EARTH 1', 'EARTH 1', '', '', NULL, NULL, NULL, 0, 3, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2016-08-25 02:33:25', 'admin', NULL, NULL),
(13, 'EP150', 'EP150', '', '', NULL, NULL, NULL, 0, 8, NULL, '1', '', '', '', '', '', '', '', 3, 'a', '2016-08-25 02:28:14', 'admin', NULL, NULL),
(16, 'GEOLANDER', 'GEOLANDER', '', '', NULL, NULL, NULL, 0, 3, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2016-08-25 02:34:03', 'admin', NULL, NULL),
(17, 'GEOLANDER SUV', 'GEOLANDER SUV', '', '', NULL, NULL, NULL, 0, 3, NULL, '1', '', '', '', '', '', '', '', 3, 'a', '2016-08-25 02:34:55', 'admin', NULL, NULL),
(22, 'WANDERER', 'WANDERER', '', '', NULL, NULL, NULL, 0, 1, NULL, '1', '', '', '', '', '', '', '', 5, 'a', '2016-08-25 02:42:43', 'admin', NULL, NULL),
(19, 'ZLX', 'ZLX', '', '', NULL, NULL, NULL, 0, 1, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2016-08-25 02:40:40', 'admin', NULL, NULL),
(20, 'ZV2K', 'ZV2K', '', '', NULL, NULL, NULL, 0, 1, NULL, '1', '', '', '', '', '', '', '', 3, 'a', '2016-08-25 02:41:27', 'admin', NULL, NULL),
(18, 'ZVTS', 'ZVTS', '', '', NULL, NULL, NULL, 0, 1, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2016-08-25 02:40:06', 'admin', NULL, NULL),
(21, 'ZVTV', 'ZVTV', '', '', NULL, NULL, NULL, 0, 1, NULL, '1', '', '', '', '', '', '', '', 4, 'a', '2016-08-25 02:42:07', 'admin', NULL, NULL),
(28, 'code 5', 'test5', '', '', NULL, NULL, NULL, 0, 7, NULL, '1', '', '', '', '', '', '', '', 5, 'a', '2023-05-27 06:27:19', 'admin', '2023-05-27 07:04:36', 'admin'),
(29, 'new3', 'new2', '', '', NULL, NULL, NULL, 0, 8, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2023-05-27 06:47:15', 'admin', '2023-05-27 07:06:02', 'admin'),
(30, 'code 1', 'name 1', '', '', NULL, NULL, NULL, 3, 6, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2023-05-27 07:06:48', 'admin', '2023-05-29 05:47:46', 'admin'),
(31, 'code 2', 'name2', '', '', NULL, NULL, NULL, 4, 8, NULL, '1', '', '', '', '', '', '', '', 2, 'a', '2023-05-27 07:07:18', 'admin', NULL, NULL),
(32, 'code 4', 'name 4', '', '', NULL, NULL, NULL, 5, 2, NULL, '1', '', '', '', '', '', '', '', 4, 'a', '2023-05-27 07:07:43', 'admin', NULL, NULL),
(33, 'code5', 'name 5', '', '', NULL, NULL, NULL, 1, 3, NULL, '1', '', '', '', '', '', '', '', 10, 'a', '2023-05-27 07:10:03', 'admin', '2023-05-27 07:20:11', 'admin'),
(34, 'code4', 'name 4', '', '', NULL, NULL, NULL, 3, 8, NULL, '1', '', '', '', '', '', '', '', 1, 'a', '2023-05-27 07:21:01', 'admin', '2023-05-29 05:49:25', 'admin'),
(35, 'code6', 'name6', '', '', NULL, NULL, NULL, 1, 6, NULL, '1', '', '', '', '', '', '', '', 6, 'a', '2023-05-29 05:35:04', 'admin', NULL, NULL),
(36, 'code2', 'name2', '', '', NULL, NULL, NULL, 3, 6, NULL, '1', '', '', '', '', '', '', '', 4, 'a', '2023-05-29 05:41:05', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size_mst`
--

CREATE TABLE `size_mst` (
  `sizem_id` int(15) NOT NULL,
  `sizem_name` varchar(250) NOT NULL COMMENT 'Name of the product main category 2',
  `sizem_desc` text,
  `sizem_trtypm_id` int(15) NOT NULL,
  `sizem_szchrtimg` varchar(250) DEFAULT NULL,
  `sizem_icnimg` varchar(250) DEFAULT NULL,
  `sizem_hmpg` char(1) DEFAULT NULL COMMENT 'yes - y or no - no',
  `sizem_pstn` char(1) DEFAULT NULL COMMENT 'Top - t or bottom - b',
  `sizem_frmdt` date DEFAULT NULL,
  `sizem_todt` date DEFAULT NULL,
  `sizem_sts` char(1) DEFAULT NULL COMMENT 'Status of the product main category 2',
  `sizem_prty` int(15) DEFAULT NULL COMMENT 'Priority of the product main category 2',
  `sizem_seotitle` varchar(250) DEFAULT NULL,
  `sizem_seodesc` text,
  `sizem_seokywrd` text,
  `sizem_seohonettl` varchar(250) DEFAULT NULL,
  `sizem_seohonedesc` text,
  `sizem_seohtwottl` varchar(250) DEFAULT NULL,
  `sizem_seohtwodesc` text,
  `sizem_crtdon` datetime DEFAULT NULL COMMENT 'Date on which product main category 2 is created',
  `sizem_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the product main category2 is created',
  `sizem_mdfdon` datetime DEFAULT NULL COMMENT 'Date on which the product main category 2 is modified',
  `sizem_mdfdby` varchar(250) DEFAULT NULL COMMENT 'BY whom the product main category 2 is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size_mst`
--

INSERT INTO `size_mst` (`sizem_id`, `sizem_name`, `sizem_desc`, `sizem_trtypm_id`, `sizem_szchrtimg`, `sizem_icnimg`, `sizem_hmpg`, `sizem_pstn`, `sizem_frmdt`, `sizem_todt`, `sizem_sts`, `sizem_prty`, `sizem_seotitle`, `sizem_seodesc`, `sizem_seokywrd`, `sizem_seohonettl`, `sizem_seohonedesc`, `sizem_seohtwottl`, `sizem_seohtwodesc`, `sizem_crtdon`, `sizem_crtdby`, `sizem_mdfdon`, `sizem_mdfdby`) VALUES
(36, '100/80-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 34, '', '', '', '', '', '', '', '2015-11-07 02:23:06', 'admin', NULL, NULL),
(16, '100/80-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-07 02:16:06', 'admin', NULL, NULL),
(54, '100/90-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 52, '', '', '', '', '', '', '', '2015-11-07 02:31:39', 'admin', NULL, NULL),
(35, '100/90-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 33, '', '', '', '', '', '', '', '2015-11-07 02:22:52', 'admin', NULL, NULL),
(15, '100/90-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 13, '', '', '', '', '', '', '', '2015-11-07 02:15:34', 'admin', NULL, NULL),
(4, '100/90-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 2, '', '', '', '', '', '', '', '2015-11-07 02:09:53', 'admin', NULL, NULL),
(34, '110/70-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 32, '', '', '', '', '', '', '', '2015-11-07 02:22:37', 'admin', NULL, NULL),
(33, '110/80-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 31, '', '', '', '', '', '', '', '2015-11-07 02:22:22', 'admin', NULL, NULL),
(14, '110/80-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 12, '', '', '', '', '', '', '', '2015-11-07 02:15:00', 'admin', NULL, NULL),
(45, '110/90-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-07 02:26:15', 'admin', NULL, NULL),
(32, '110/90-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 30, '', '', '', '', '', '', '', '2015-11-07 02:22:08', 'admin', NULL, NULL),
(13, '110/90-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 11, '', '', '', '', '', '', '', '2015-11-07 02:14:36', 'admin', NULL, NULL),
(52, '120/70-12', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-07 02:31:02', 'admin', NULL, NULL),
(31, '120/70ZR-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 29, '', '', '', '', '', '', '', '2015-11-07 02:21:46', 'admin', NULL, NULL),
(44, '120/80-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-07 02:26:02', 'admin', NULL, NULL),
(30, '120/80-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 28, '', '', '', '', '', '', '', '2015-11-07 02:21:28', 'admin', NULL, NULL),
(12, '120/80-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-07 02:14:25', 'admin', NULL, NULL),
(3, '120/80-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 1, '', '', '', '', '', '', '', '2015-11-07 02:09:42', 'admin', NULL, NULL),
(51, '130/70-12', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-07 02:30:43', 'admin', NULL, NULL),
(11, '130/70-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-07 02:13:49', 'admin', NULL, NULL),
(29, '130/70R-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 27, '', '', '', '', '', '', '', '2015-11-07 02:21:13', 'admin', NULL, NULL),
(10, '130/80-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-07 02:12:53', 'admin', NULL, NULL),
(49, '130/90-15', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-07 02:27:10', 'admin', NULL, NULL),
(28, '140/60R-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 26, '', '', '', '', '', '', '', '2015-11-07 02:20:34', 'admin', NULL, NULL),
(27, '140/70R-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 25, '', '', '', '', '', '', '', '2015-11-07 02:20:14', 'admin', NULL, NULL),
(50, '150/70-13', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-07 02:27:23', 'admin', NULL, NULL),
(48, '150/80-15', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-07 02:26:56', 'admin', NULL, NULL),
(26, '180/55ZR-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 24, '', '', '', '', '', '', '', '2015-11-07 02:19:46', 'admin', NULL, NULL),
(159, '185/85R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 93, '', '', '', '', '', '', '', '2015-11-09 04:02:12', 'admin', NULL, NULL),
(25, '190/50ZR-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 23, '', '', '', '', '', '', '', '2015-11-07 02:19:25', 'admin', NULL, NULL),
(24, '190/55ZR-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 22, '', '', '', '', '', '', '', '2015-11-07 02:19:08', 'admin', NULL, NULL),
(158, '195/55R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 92, '', '', '', '', '', '', '', '2015-11-09 04:01:58', 'admin', NULL, NULL),
(157, '195/75R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 91, '', '', '', '', '', '', '', '2015-11-09 04:01:45', 'admin', NULL, NULL),
(66, '2.25-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 65, '', '', '', '', '', '', '', '2015-11-07 02:35:54', 'admin', NULL, NULL),
(63, '2.25-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 62, '', '', '', '', '', '', '', '2015-11-07 02:34:57', 'admin', NULL, NULL),
(65, '2.50-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 64, '', '', '', '', '', '', '', '2015-11-07 02:35:42', 'admin', NULL, NULL),
(62, '2.50-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 61, '', '', '', '', '', '', '', '2015-11-07 02:34:38', 'admin', NULL, NULL),
(23, '2.50-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 21, '', '', '', '', '', '', '', '2015-11-07 02:18:38', 'admin', NULL, NULL),
(60, '2.75-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 58, '', '', '', '', '', '', '', '2015-11-07 02:33:10', 'admin', NULL, NULL),
(64, '2.75-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 63, '', '', '', '', '', '', '', '2015-11-07 02:35:16', 'admin', NULL, NULL),
(43, '2.75-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 41, '', '', '', '', '', '', '', '2015-11-07 02:25:47', 'admin', NULL, NULL),
(22, '2.75-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-07 02:18:16', 'admin', '2015-11-07 02:27:42', 'admin'),
(156, '205/55R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 90, '', '', '', '', '', '', '', '2015-11-09 04:01:18', 'admin', NULL, NULL),
(155, '205/60R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 89, '', '', '', '', '', '', '', '2015-11-09 03:59:54', 'admin', NULL, NULL),
(168, '205/65R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 102, '', '', '', '', '', '', '', '2015-11-09 04:06:43', 'admin', NULL, NULL),
(154, '205/65R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 88, '', '', '', '', '', '', '', '2015-11-09 03:59:42', 'admin', NULL, NULL),
(167, '205/70R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 101, '', '', '', '', '', '', '', '2015-11-09 04:06:30', 'admin', NULL, NULL),
(166, '205/75R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 100, '', '', '', '', '', '', '', '2015-11-09 04:06:16', 'admin', NULL, NULL),
(153, '215/50R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 87, '', '', '', '', '', '', '', '2015-11-09 03:59:28', 'admin', NULL, NULL),
(152, '215/55R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 86, '', '', '', '', '', '', '', '2015-11-09 03:59:12', 'admin', NULL, NULL),
(135, '215/55R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 69, '', '', '', '', '', '', '', '2015-11-09 03:52:46', 'admin', NULL, NULL),
(151, '215/60R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 85, '', '', '', '', '', '', '', '2015-11-09 03:58:58', 'admin', NULL, NULL),
(134, '215/60R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 68, '', '', '', '', '', '', '', '2015-11-09 03:52:34', 'admin', NULL, NULL),
(150, '215/65R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 84, '', '', '', '', '', '', '', '2015-11-09 03:58:41', 'admin', NULL, NULL),
(133, '215/65R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 67, '', '', '', '', '', '', '', '2015-11-09 03:52:22', 'admin', NULL, NULL),
(149, '215/70R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 83, '', '', '', '', '', '', '', '2015-11-09 03:58:29', 'admin', NULL, NULL),
(165, '215/70R15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 99, '', '', '', '', '', '', '', '2015-11-09 04:05:40', 'admin', NULL, NULL),
(164, '215/75R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 98, '', '', '', '', '', '', '', '2015-11-09 04:05:18', 'admin', NULL, NULL),
(148, '215/75R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 82, '', '', '', '', '', '', '', '2015-11-09 03:58:17', 'admin', NULL, NULL),
(132, '215/75R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 66, '', '', '', '', '', '', '', '2015-11-09 03:52:04', 'admin', NULL, NULL),
(163, '215R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 97, '', '', '', '', '', '', '', '2015-11-09 04:04:34', 'admin', NULL, NULL),
(118, '225/40R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 52, '', '', '', '', '', '', '', '2015-11-09 03:42:16', 'admin', NULL, NULL),
(131, '225/45R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 65, '', '', '', '', '', '', '', '2015-11-09 03:51:50', 'admin', NULL, NULL),
(147, '225/50R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 81, '', '', '', '', '', '', '', '2015-11-09 03:58:03', 'admin', NULL, NULL),
(130, '225/50R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 64, '', '', '', '', '', '', '', '2015-11-09 03:51:38', 'admin', NULL, NULL),
(146, '225/55R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 80, '', '', '', '', '', '', '', '2015-11-09 03:57:03', 'admin', NULL, NULL),
(129, '225/55R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 63, '', '', '', '', '', '', '', '2015-11-09 03:51:23', 'admin', NULL, NULL),
(128, '225/60R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 62, '', '', '', '', '', '', '', '2015-11-09 03:51:10', 'admin', NULL, NULL),
(127, '225/65R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 61, '', '', '', '', '', '', '', '2015-11-09 03:50:59', 'admin', NULL, NULL),
(145, '225/70R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 79, '', '', '', '', '', '', '', '2015-11-09 03:56:50', 'admin', NULL, NULL),
(97, '235/35R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 31, '', '', '', '', '', '', '', '2015-11-09 03:28:04', 'admin', NULL, NULL),
(96, '235/35ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 30, '', '', '', '', '', '', '', '2015-11-09 03:27:46', 'admin', NULL, NULL),
(117, '235/40R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 51, '', '', '', '', '', '', '', '2015-11-09 03:41:48', 'admin', NULL, NULL),
(116, '235/40ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 50, '', '', '', '', '', '', '', '2015-11-09 03:41:37', 'admin', NULL, NULL),
(126, '235/45R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 60, '', '', '', '', '', '', '', '2015-11-09 03:50:45', 'admin', NULL, NULL),
(125, '235/55R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 59, '', '', '', '', '', '', '', '2015-11-09 03:50:28', 'admin', NULL, NULL),
(115, '235/55R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 49, '', '', '', '', '', '', '', '2015-11-09 03:40:40', 'admin', NULL, NULL),
(144, '235/60R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 78, '', '', '', '', '', '', '', '2015-11-09 03:56:37', 'admin', NULL, NULL),
(124, '235/60R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 58, '', '', '', '', '', '', '', '2015-11-09 03:50:11', 'admin', NULL, NULL),
(114, '235/60R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 48, '', '', '', '', '', '', '', '2015-11-09 03:40:25', 'admin', NULL, NULL),
(123, '235/65R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 57, '', '', '', '', '', '', '', '2015-11-09 03:44:05', 'admin', NULL, NULL),
(143, '235/70R16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 77, '', '', '', '', '', '', '', '2015-11-09 03:56:24', 'admin', NULL, NULL),
(162, '235/75R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 96, '', '', '', '', '', '', '', '2015-11-09 04:03:56', 'admin', NULL, NULL),
(9, '240/40R-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-07 02:12:38', 'admin', NULL, NULL),
(113, '245/35ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 47, '', '', '', '', '', '', '', '2015-11-09 03:40:13', 'admin', NULL, NULL),
(122, '245/40R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 56, '', '', '', '', '', '', '', '2015-11-09 03:43:39', 'admin', NULL, NULL),
(112, '245/40R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 46, '', '', '', '', '', '', '', '2015-11-09 03:39:02', 'admin', NULL, NULL),
(95, '245/40R19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 29, '', '', '', '', '', '', '', '2015-11-09 03:27:28', 'admin', NULL, NULL),
(111, '245/40ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-09 03:38:49', 'admin', NULL, NULL),
(121, '245/45R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 55, '', '', '', '', '', '', '', '2015-11-09 03:43:27', 'admin', NULL, NULL),
(110, '245/45R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-09 03:38:24', 'admin', NULL, NULL),
(94, '245/45R19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 28, '', '', '', '', '', '', '', '2015-11-09 03:27:04', 'admin', NULL, NULL),
(109, '245/50R18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 43, '', '', '', '', '', '', '', '2015-11-09 03:38:11', 'admin', NULL, NULL),
(142, '245/70R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 76, '', '', '', '', '', '', '', '2015-11-09 03:56:12', 'admin', NULL, NULL),
(141, '245/75R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 75, '', '', '', '', '', '', '', '2015-11-09 03:56:00', 'admin', NULL, NULL),
(108, '255/35R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 42, '', '', '', '', '', '', '', '2015-11-09 03:37:49', 'admin', NULL, NULL),
(93, '255/35R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 27, '', '', '', '', '', '', '', '2015-11-09 03:26:49', 'admin', NULL, NULL),
(75, '255/35R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 9, '', '', '', '', '', '', '', '2015-11-07 05:53:15', 'admin', NULL, NULL),
(92, '255/40R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 26, '', '', '', '', '', '', '', '2015-11-09 03:26:36', 'admin', NULL, NULL),
(91, '255/40ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 25, '', '', '', '', '', '', '', '2015-11-09 03:24:18', 'admin', NULL, NULL),
(107, '255/45-R18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 41, '', '', '', '', '', '', '', '2015-11-09 03:36:28', 'admin', NULL, NULL),
(120, '255/45R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 54, '', '', '', '', '', '', '', '2015-11-09 03:42:48', 'admin', NULL, NULL),
(90, '255/45R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 24, '', '', '', '', '', '', '', '2015-11-09 03:24:00', 'admin', NULL, NULL),
(140, '255/50R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 74, '', '', '', '', '', '', '', '2015-11-09 03:55:45', 'admin', NULL, NULL),
(106, '255/50R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-09 03:36:09', 'admin', NULL, NULL),
(89, '255/50R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 23, '', '', '', '', '', '', '', '2015-11-09 03:23:38', 'admin', NULL, NULL),
(68, '255/50R-21', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 2, '', '', '', '', '', '', '', '2015-11-07 05:34:32', 'admin', NULL, NULL),
(105, '255/55R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-09 03:34:56', 'admin', NULL, NULL),
(139, '255/75R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 73, '', '', '', '', '', '', '', '2015-11-09 03:54:48', 'admin', NULL, NULL),
(104, '265/35R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-09 03:34:42', 'admin', NULL, NULL),
(88, '265/35R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 22, '', '', '', '', '', '', '', '2015-11-09 03:23:25', 'admin', NULL, NULL),
(103, '265/40ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 37, '', '', '', '', '', '', '', '2015-11-09 03:34:29', 'admin', NULL, NULL),
(87, '265/40ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 21, '', '', '', '', '', '', '', '2015-11-09 03:23:09', 'admin', NULL, NULL),
(74, '265/45R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 8, '', '', '', '', '', '', '', '2015-11-07 05:53:01', 'admin', NULL, NULL),
(119, '265/65R-17', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 53, '', '', '', '', '', '', '', '2015-11-09 03:42:30', 'admin', NULL, NULL),
(161, '265/70R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 95, '', '', '', '', '', '', '', '2015-11-09 04:03:43', 'admin', NULL, NULL),
(138, '265/70R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 72, '', '', '', '', '', '', '', '2015-11-09 03:53:25', 'admin', NULL, NULL),
(86, '275/35R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 20, '', '', '', '', '', '', '', '2015-11-09 03:22:55', 'admin', NULL, NULL),
(73, '275/35R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 7, '', '', '', '', '', '', '', '2015-11-07 05:52:44', 'admin', NULL, NULL),
(85, '275/40R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-09 03:22:38', 'admin', NULL, NULL),
(71, '275/40R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-07 05:36:39', 'admin', NULL, NULL),
(84, '275/40ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-09 03:22:22', 'admin', NULL, NULL),
(102, '275/45R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 36, '', '', '', '', '', '', '', '2015-11-09 03:34:01', 'admin', NULL, NULL),
(70, '275/45R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 4, '', '', '', '', '', '', '', '2015-11-07 05:36:15', 'admin', NULL, NULL),
(83, '275/50R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-09 03:22:03', 'admin', NULL, NULL),
(72, '275/50R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-07 05:51:49', 'admin', NULL, NULL),
(82, '275/55R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-09 03:21:49', 'admin', NULL, NULL),
(81, '285/30R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-09 03:21:36', 'admin', NULL, NULL),
(101, '285/35R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 35, '', '', '', '', '', '', '', '2015-11-09 03:33:47', 'admin', NULL, NULL),
(67, '285/45R-21', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 1, '', '', '', '', '', '', '', '2015-11-07 05:33:35', 'admin', NULL, NULL),
(80, '285/45ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 14, '', '', '', '', '', '', '', '2015-11-09 03:21:18', 'admin', NULL, NULL),
(100, '285/60R-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 34, '', '', '', '', '', '', '', '2015-11-09 03:33:17', 'admin', NULL, NULL),
(79, '295/30R-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 13, '', '', '', '', '', '', '', '2015-11-09 03:21:01', 'admin', NULL, NULL),
(78, '295/30ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 12, '', '', '', '', '', '', '', '2015-11-09 03:11:31', 'admin', NULL, NULL),
(99, '295/35ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 33, '', '', '', '', '', '', '', '2015-11-09 03:32:38', 'admin', NULL, NULL),
(77, '295/35ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 11, '', '', '', '', '', '', '', '2015-11-09 03:11:14', 'admin', NULL, NULL),
(59, '3.00-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 57, '', '', '', '', '', '', '', '2015-11-07 02:32:56', 'admin', NULL, NULL),
(47, '3.00-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 45, '', '', '', '', '', '', '', '2015-11-07 02:26:43', 'admin', NULL, NULL),
(42, '3.00-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 40, '', '', '', '', '', '', '', '2015-11-07 02:25:27', 'admin', NULL, NULL),
(8, '3.00-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 6, '', '', '', '', '', '', '', '2015-11-07 02:11:39', 'admin', NULL, NULL),
(21, '3.00/18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 19, '', '', '', '', '', '', '', '2015-11-07 02:18:04', 'admin', NULL, NULL),
(46, '3.25-16', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 44, '', '', '', '', '', '', '', '2015-11-07 02:26:30', 'admin', NULL, NULL),
(20, '3.25-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 18, '', '', '', '', '', '', '', '2015-11-07 02:17:43', 'admin', NULL, NULL),
(7, '3.25-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 5, '', '', '', '', '', '', '', '2015-11-07 02:11:27', 'admin', NULL, NULL),
(58, '3.50-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 56, '', '', '', '', '', '', '', '2015-11-07 02:32:43', 'admin', NULL, NULL),
(19, '3.50-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 17, '', '', '', '', '', '', '', '2015-11-07 02:17:23', 'admin', NULL, NULL),
(6, '3.50-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 4, '', '', '', '', '', '', '', '2015-11-07 02:10:16', 'admin', NULL, NULL),
(61, '3.50-8', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 59, '', '', '', '', '', '', '', '2015-11-07 02:33:32', 'admin', NULL, NULL),
(76, '305/30ZR-19', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 10, '', '', '', '', '', '', '', '2015-11-07 05:54:38', 'admin', NULL, NULL),
(69, '315/35R-20', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 3, '', '', '', '', '', '', '', '2015-11-07 05:34:52', 'admin', NULL, NULL),
(98, '335/30ZR-18', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 32, '', '', '', '', '', '', '', '2015-11-09 03:30:57', 'admin', NULL, NULL),
(160, '7.00R-15', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 94, '', '', '', '', '', '', '', '2015-11-09 04:02:30', 'admin', NULL, NULL),
(137, '7.00R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 71, '', '', '', '', '', '', '', '2015-11-09 03:53:12', 'admin', NULL, NULL),
(136, '7.50R-16', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 70, '', '', '', '', '', '', '', '2015-11-09 03:52:59', 'admin', NULL, NULL),
(41, '70/100-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 39, '', '', '', '', '', '', '', '2015-11-07 02:25:09', 'admin', NULL, NULL),
(37, '80/100-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 35, '', '', '', '', '', '', '', '2015-11-07 02:23:19', 'admin', NULL, NULL),
(18, '80/100-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 16, '', '', '', '', '', '', '', '2015-11-07 02:17:10', 'admin', NULL, NULL),
(40, '80/90-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 38, '', '', '', '', '', '', '', '2015-11-07 02:24:53', 'admin', NULL, NULL),
(55, '90/100-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 53, '', '', '', '', '', '', '', '2015-11-07 02:31:53', 'admin', NULL, NULL),
(57, '90/80-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 55, '', '', '', '', '', '', '', '2015-11-07 02:32:27', 'admin', NULL, NULL),
(39, '90/80-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 37, '', '', '', '', '', '', '', '2015-11-07 02:24:03', 'admin', NULL, NULL),
(56, '90/90-10', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 54, '', '', '', '', '', '', '', '2015-11-07 02:32:12', 'admin', NULL, NULL),
(53, '90/90-12', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 51, '', '', '', '', '', '', '', '2015-11-07 02:31:22', 'admin', NULL, NULL),
(38, '90/90-17', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 36, '', '', '', '', '', '', '', '2015-11-07 02:23:37', 'admin', NULL, NULL),
(17, '90/90-18', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 15, '', '', '', '', '', '', '', '2015-11-07 02:16:29', 'admin', NULL, NULL),
(5, '90/90-19', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 3, '', '', '', '', '', '', '', '2015-11-07 02:10:05', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trtyp_mst`
--

CREATE TABLE `trtyp_mst` (
  `trtypm_id` int(15) NOT NULL COMMENT 'unique auto increment id for trtyp record',
  `trtypm_name` varchar(250) NOT NULL COMMENT 'unique name for trtyp record',
  `trtypm_desc` varchar(250) NOT NULL,
  `trtypm_prty` int(3) DEFAULT NULL COMMENT 'priority of trtyp record',
  `trtypm_sts` char(1) DEFAULT NULL COMMENT 'status of trtyp record (a - active, i - inactive)',
  `trtypm_crtdon` date DEFAULT NULL COMMENT 'date of creation of trtyp record',
  `trtypm_crtdby` varchar(250) DEFAULT NULL COMMENT 'name by whom trtyp record is created',
  `trtypm_mdfdon` date DEFAULT NULL COMMENT 'date of modification of trtyp record',
  `trtypm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'name by whom trtyp record is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trtyp_mst`
--

INSERT INTO `trtyp_mst` (`trtypm_id`, `trtypm_name`, `trtypm_desc`, `trtypm_prty`, `trtypm_sts`, `trtypm_crtdon`, `trtypm_crtdby`, `trtypm_mdfdon`, `trtypm_mdfdby`) VALUES
(5, 'Buses/Trucks', '', 5, 'a', '2015-11-05', '', NULL, NULL),
(2, 'Four Wheeler', '', 2, 'a', '2015-09-30', '', '2015-11-05', ''),
(4, 'Light Commercial Vehicle', '', 3, 'a', '2015-11-05', '', NULL, NULL),
(3, 'Three Wheeler', '', 1, 'a', '2015-09-30', '', '2015-11-05', ''),
(1, 'Two Wheeler', '', 4, 'a', '2015-09-30', '', '2015-11-05', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehtyp_mst`
--

CREATE TABLE `vehtyp_mst` (
  `vehtypm_id` int(15) NOT NULL,
  `vehtypm_name` varchar(250) NOT NULL COMMENT 'Name of the brand',
  `vehtypm_desc` text,
  `vehtypm_img` varchar(250) DEFAULT NULL,
  `vehtypm_zmimg` varchar(250) DEFAULT NULL,
  `vehtypm_seotitle` varchar(250) DEFAULT NULL,
  `vehtypm_seodesc` text,
  `vehtypm_seokywrd` text,
  `vehtypm_seohonetitle` varchar(250) DEFAULT NULL,
  `vehtypm_seohonedesc` text,
  `vehtypm_seohtwotitle` varchar(250) DEFAULT NULL,
  `vehtypm_seohtwodesc` text,
  `vehtypm_sts` char(1) NOT NULL COMMENT 'Status of the brand',
  `vehtypm_prty` int(15) NOT NULL COMMENT 'Priority of the brand',
  `vehtypm_crtdon` date DEFAULT NULL COMMENT 'Date on which the brand is created',
  `vehtypm_crtdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is created',
  `vehtypm_mdfdon` date DEFAULT NULL COMMENT 'Date on which the brand is modified',
  `vehtypm_mdfdby` varchar(250) DEFAULT NULL COMMENT 'By whom the brand is modified'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehtyp_mst`
--

INSERT INTO `vehtyp_mst` (`vehtypm_id`, `vehtypm_name`, `vehtypm_desc`, `vehtypm_img`, `vehtypm_zmimg`, `vehtypm_seotitle`, `vehtypm_seodesc`, `vehtypm_seokywrd`, `vehtypm_seohonetitle`, `vehtypm_seohonedesc`, `vehtypm_seohtwotitle`, `vehtypm_seohtwodesc`, `vehtypm_sts`, `vehtypm_prty`, `vehtypm_crtdon`, `vehtypm_crtdby`, `vehtypm_mdfdon`, `vehtypm_mdfdby`) VALUES
(1, 'new5', '', '', '', '', '', '', '', '', '', '', 'a', 5, '2023-05-26', '', '2023-05-27', ''),
(3, 'new1', '', '', '', '', '', '', '', '', '', '', 'a', 2, '2023-05-26', '', '2023-05-27', ''),
(4, 'new2', '', '', '', '', '', '', '', '', '', '', 'a', 3, '2023-05-26', '', '2023-05-27', ''),
(5, 'new4', '', '', '', '', '', '', '', '', '', '', 'a', 4, '2023-05-26', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cntnt_cntry_cnty_cty_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_cntnt_cntry_cnty_cty_mst` (
`cntntm_id` int(15)
,`cntntm_name` varchar(250)
,`cntntm_iso` varchar(250)
,`cntntm_prty` int(15)
,`cntntm_sts` char(1)
,`cntntm_crtdon` datetime
,`cntntm_crtdby` varchar(250)
,`cntntm_mdfdon` datetime
,`cntntm_mdfdby` varchar(250)
,`cntrym_id` int(15)
,`cntrym_name` varchar(250)
,`cntrym_isothr` varchar(250)
,`cntrym_isotwo` varchar(250)
,`cntrym_cntntm_id` int(15)
,`cntrym_isonum` varchar(250)
,`cntrym_sts` char(1)
,`cntrym_prty` int(15)
,`cntrym_crtdon` date
,`cntrym_crtdby` varchar(250)
,`cntrym_mdfdon` date
,`cntrym_mdfdby` varchar(250)
,`cntym_id` int(15)
,`cntym_name` varchar(250)
,`cntym_cntrym_id` int(15)
,`cntym_iso` varchar(250)
,`cntym_sts` char(1)
,`cntym_prty` int(15)
,`cntym_crtdon` date
,`cntym_crtdby` varchar(250)
,`cntym_mdfdon` date
,`cntym_mdfdby` varchar(250)
,`ctym_id` int(15)
,`ctym_name` varchar(250)
,`ctym_cntym_id` int(15)
,`ctym_iso` varchar(250)
,`ctym_sts` char(1)
,`ctym_prty` int(15)
,`ctym_crtdon` date
,`ctym_crtdby` varchar(250)
,`ctym_mdfdon` date
,`ctym_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cntry_cntnt_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_cntry_cntnt_mst` (
`cntrym_id` int(15)
,`cntrym_name` varchar(250)
,`cntrym_isothr` varchar(250)
,`cntrym_isotwo` varchar(250)
,`cntrym_cntntm_id` int(15)
,`cntrym_isonum` varchar(250)
,`cntrym_sts` char(1)
,`cntrym_prty` int(15)
,`cntrym_crtdon` date
,`cntrym_crtdby` varchar(250)
,`cntrym_mdfdon` date
,`cntrym_mdfdby` varchar(250)
,`cntntm_id` int(15)
,`cntntm_name` varchar(250)
,`cntntm_iso` varchar(250)
,`cntntm_prty` int(15)
,`cntntm_sts` char(1)
,`cntntm_crtdon` datetime
,`cntntm_crtdby` varchar(250)
,`cntntm_mdfdon` datetime
,`cntntm_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cntry_cnty_cty_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_cntry_cnty_cty_mst` (
`ctym_id` int(15)
,`ctym_name` varchar(250)
,`ctym_cntym_id` int(15)
,`ctym_iso` varchar(250)
,`ctym_sts` char(1)
,`ctym_prty` int(15)
,`ctym_crtdon` date
,`ctym_crtdby` varchar(250)
,`ctym_mdfdon` date
,`ctym_mdfdby` varchar(250)
,`cntym_id` int(15)
,`cntym_name` varchar(250)
,`cntym_cntrym_id` int(15)
,`cntym_iso` varchar(250)
,`cntym_sts` char(1)
,`cntym_prty` int(15)
,`cntym_crtdon` date
,`cntym_crtdby` varchar(250)
,`cntym_mdfdon` date
,`cntym_mdfdby` varchar(250)
,`cntrym_id` int(15)
,`cntrym_name` varchar(250)
,`cntrym_isothr` varchar(250)
,`cntrym_isotwo` varchar(250)
,`cntrym_cntntm_id` int(15)
,`cntrym_isonum` varchar(250)
,`cntrym_sts` char(1)
,`cntrym_prty` int(15)
,`cntrym_crtdon` date
,`cntrym_crtdby` varchar(250)
,`cntrym_mdfdon` date
,`cntrym_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cntry_cnty_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_cntry_cnty_mst` (
`cntym_id` int(15)
,`cntym_name` varchar(250)
,`cntym_cntrym_id` int(15)
,`cntym_iso` varchar(250)
,`cntym_sts` char(1)
,`cntym_prty` int(15)
,`cntym_crtdon` date
,`cntym_crtdby` varchar(250)
,`cntym_mdfdon` date
,`cntym_mdfdby` varchar(250)
,`cntrym_id` int(15)
,`cntrym_name` varchar(250)
,`cntrym_isothr` varchar(250)
,`cntrym_isotwo` varchar(250)
,`cntrym_cntntm_id` int(15)
,`cntrym_isonum` varchar(250)
,`cntrym_sts` char(1)
,`cntrym_prty` int(15)
,`cntrym_crtdon` date
,`cntrym_crtdby` varchar(250)
,`cntrym_mdfdon` date
,`cntrym_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cnty_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_cnty_mst` (
`cntym_id` int(15)
,`cntym_name` varchar(250)
,`cntym_cntrym_id` int(15)
,`cntym_iso` varchar(250)
,`cntym_sts` char(1)
,`cntym_prty` int(15)
,`cntym_crtdon` date
,`cntym_crtdby` varchar(250)
,`cntym_mdfdon` date
,`cntym_mdfdby` varchar(250)
,`cntrym_id` int(15)
,`cntrym_name` varchar(250)
,`cntrym_isothr` varchar(250)
,`cntrym_isotwo` varchar(250)
,`cntrym_cntntm_id` int(15)
,`cntrym_isonum` varchar(250)
,`cntrym_sts` char(1)
,`cntrym_prty` int(15)
,`cntrym_crtdon` date
,`cntrym_crtdby` varchar(250)
,`cntrym_mdfdon` date
,`cntrym_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_fdbck_all`
-- (See below for the actual view)
--
CREATE TABLE `vw_fdbck_all` (
`fdbckm_id` int(15)
,`fdbckm_emailid` varchar(250)
,`fdbckm_name` varchar(250)
,`fdbckm_phno` varchar(250)
,`fdbckm_addr` text
,`fdbckm_sizem_id` int(15)
,`fdbckm_prodscatm_id` int(15)
,`fdbckm_brndm_id` int(15)
,`fdbckm_trpstn` char(1)
,`fdbckm_trtyp` char(1)
,`fdbckm_prty` int(15)
,`fdbckm_sts` char(1)
,`fdbckm_crtdon` datetime
,`fdbckm_crtdby` varchar(250)
,`fdbckm_mdfdon` datetime
,`fdbckm_mdfdby` varchar(250)
,`trtypm_id` int(15)
,`trtypm_name` varchar(250)
,`trtypm_desc` varchar(250)
,`trtypm_prty` int(3)
,`trtypm_sts` char(1)
,`trtypm_crtdon` date
,`trtypm_crtdby` varchar(250)
,`trtypm_mdfdon` date
,`trtypm_mdfdby` varchar(250)
,`sizem_id` int(15)
,`sizem_name` varchar(250)
,`sizem_desc` text
,`sizem_trtypm_id` int(15)
,`sizem_szchrtimg` varchar(250)
,`sizem_icnimg` varchar(250)
,`sizem_hmpg` char(1)
,`sizem_pstn` char(1)
,`sizem_frmdt` date
,`sizem_todt` date
,`sizem_sts` char(1)
,`sizem_prty` int(15)
,`sizem_seotitle` varchar(250)
,`sizem_seodesc` text
,`sizem_seokywrd` text
,`sizem_seohonettl` varchar(250)
,`sizem_seohonedesc` text
,`sizem_seohtwottl` varchar(250)
,`sizem_seohtwodesc` text
,`sizem_crtdon` datetime
,`sizem_crtdby` varchar(250)
,`sizem_mdfdon` datetime
,`sizem_mdfdby` varchar(250)
,`prodcatm_id` int(15)
,`prodcatm_name` varchar(250)
,`prodcatm_desc` text
,`prodcatm_frmdt` date
,`prodcatm_todt` date
,`prodcatm_smlimg` varchar(250)
,`prodcatm_bnrimg` varchar(250)
,`prodcatm_seotitle` varchar(250)
,`prodcatm_seodesc` text
,`prodcatm_seokywrd` tinytext
,`prodcatm_seohonettl` varchar(250)
,`prodcatm_seohonedesc` text
,`prodcatm_seohtwottl` varchar(250)
,`prodcatm_seohtwodesc` text
,`prodcatm_taxm_id` int(15)
,`prodcatm_dlvrtyp` char(1)
,`prodcatm_sts` char(1)
,`prodcatm_prty` int(15)
,`prodcatm_hmprty` int(15)
,`prodcatm_crtdon` date
,`prodcatm_crtdby` varchar(250)
,`prodcatm_mdfdon` date
,`prodcatm_mdfdby` varchar(250)
,`prodscatm_id` int(15)
,`prodscatm_name` varchar(250)
,`prodscatm_desc` text
,`prodscatm_prodcatm_id` int(15)
,`prodscatm_szchrtimg` varchar(250)
,`prodscatm_icnimg` varchar(250)
,`prodscatm_hmpg` char(1)
,`prodscatm_pstn` char(1)
,`prodscatm_frmdt` date
,`prodscatm_todt` date
,`prodscatm_sts` char(1)
,`prodscatm_prty` int(15)
,`prodscatm_seotitle` varchar(250)
,`prodscatm_seodesc` text
,`prodscatm_seokywrd` text
,`prodscatm_seohonettl` varchar(250)
,`prodscatm_seohonedesc` text
,`prodscatm_seohtwottl` varchar(250)
,`prodscatm_seohtwodesc` text
,`prodscatm_crtdon` datetime
,`prodscatm_crtdby` varchar(250)
,`prodscatm_mdfdon` datetime
,`prodscatm_mdfdby` varchar(250)
,`brndm_id` int(15)
,`brndm_name` varchar(250)
,`brndm_desc` text
,`brndm_img` varchar(250)
,`brndm_zmimg` varchar(250)
,`brndm_seotitle` varchar(250)
,`brndm_seodesc` text
,`brndm_seokywrd` text
,`brndm_seohonetitle` varchar(250)
,`brndm_seohonedesc` text
,`brndm_seohtwotitle` varchar(250)
,`brndm_seohtwodesc` text
,`brndm_sts` char(1)
,`brndm_prty` int(15)
,`brndm_crtdon` date
,`brndm_crtdby` varchar(250)
,`brndm_mdfdon` date
,`brndm_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_prodcat_prodscat_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_prodcat_prodscat_mst` (
`prodcatm_id` int(15)
,`prodcatm_name` varchar(250)
,`prodcatm_desc` text
,`prodcatm_frmdt` date
,`prodcatm_todt` date
,`prodcatm_smlimg` varchar(250)
,`prodcatm_bnrimg` varchar(250)
,`prodcatm_seotitle` varchar(250)
,`prodcatm_seodesc` text
,`prodcatm_seokywrd` tinytext
,`prodcatm_seohonettl` varchar(250)
,`prodcatm_seohonedesc` text
,`prodcatm_seohtwottl` varchar(250)
,`prodcatm_seohtwodesc` text
,`prodcatm_taxm_id` int(15)
,`prodcatm_dlvrtyp` char(1)
,`prodcatm_sts` char(1)
,`prodcatm_prty` int(15)
,`prodcatm_hmprty` int(15)
,`prodcatm_crtdon` date
,`prodcatm_crtdby` varchar(250)
,`prodcatm_mdfdon` date
,`prodcatm_mdfdby` varchar(250)
,`prodscatm_id` int(15)
,`prodscatm_name` varchar(250)
,`prodscatm_desc` text
,`prodscatm_prodcatm_id` int(15)
,`prodscatm_szchrtimg` varchar(250)
,`prodscatm_icnimg` varchar(250)
,`prodscatm_hmpg` char(1)
,`prodscatm_pstn` char(1)
,`prodscatm_frmdt` date
,`prodscatm_todt` date
,`prodscatm_sts` char(1)
,`prodscatm_prty` int(15)
,`prodscatm_seotitle` varchar(250)
,`prodscatm_seodesc` text
,`prodscatm_seokywrd` text
,`prodscatm_seohonettl` varchar(250)
,`prodscatm_seohonedesc` text
,`prodscatm_seohtwottl` varchar(250)
,`prodscatm_seohtwodesc` text
,`prodscatm_crtdon` datetime
,`prodscatm_crtdby` varchar(250)
,`prodscatm_mdfdon` datetime
,`prodscatm_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_prod_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_prod_mst` (
`prodm_id` int(15)
,`prodm_code` varchar(250)
,`prodm_name` varchar(250)
,`prodm_descone` longtext
,`prodm_desctwo` longtext
,`prodm_mrp` double(10,2)
,`prodm_op` double(10,2)
,`prodm_wt` double(10,2)
,`prodm_vehtypm_id` int(15)
,`prodm_brndm_id` int(15)
,`prodm_catthrm_id` int(15)
,`prodm_typ` char(1)
,`prodm_seotitle` varchar(250)
,`prodm_seodesc` text
,`prodm_seokywrd` tinytext
,`prodm_seohonetitle` varchar(250)
,`prodm_seohonedesc` text
,`prodm_seohtwotitle` varchar(250)
,`prodm_seohtwodesc` text
,`prodm_prty` int(15)
,`prodm_sts` char(1)
,`prodm_crtdon` datetime
,`prodm_crtdby` varchar(250)
,`prodm_mdfdon` datetime
,`prodm_mdfdby` varchar(250)
,`brndm_id` int(15)
,`vehtypm_name` varchar(250)
,`brndm_name` varchar(250)
,`brndm_desc` text
,`brndm_img` varchar(250)
,`brndm_zmimg` varchar(250)
,`brndm_seotitle` varchar(250)
,`brndm_seodesc` text
,`brndm_seokywrd` text
,`brndm_seohonetitle` varchar(250)
,`brndm_seohonedesc` text
,`brndm_seohtwotitle` varchar(250)
,`brndm_seohtwodesc` text
,`brndm_sts` char(1)
,`brndm_prty` int(15)
,`brndm_crtdon` date
,`brndm_crtdby` varchar(250)
,`brndm_mdfdon` date
,`brndm_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_trtyp_size_mst`
-- (See below for the actual view)
--
CREATE TABLE `vw_trtyp_size_mst` (
`trtypm_id` int(15)
,`trtypm_name` varchar(250)
,`trtypm_desc` varchar(250)
,`trtypm_prty` int(3)
,`trtypm_sts` char(1)
,`trtypm_crtdon` date
,`trtypm_crtdby` varchar(250)
,`trtypm_mdfdon` date
,`trtypm_mdfdby` varchar(250)
,`sizem_id` int(15)
,`sizem_name` varchar(250)
,`sizem_desc` text
,`sizem_trtypm_id` int(15)
,`sizem_szchrtimg` varchar(250)
,`sizem_icnimg` varchar(250)
,`sizem_hmpg` char(1)
,`sizem_pstn` char(1)
,`sizem_frmdt` date
,`sizem_todt` date
,`sizem_sts` char(1)
,`sizem_prty` int(15)
,`sizem_seotitle` varchar(250)
,`sizem_seodesc` text
,`sizem_seokywrd` text
,`sizem_seohonettl` varchar(250)
,`sizem_seohonedesc` text
,`sizem_seohtwottl` varchar(250)
,`sizem_seohtwodesc` text
,`sizem_crtdon` datetime
,`sizem_crtdby` varchar(250)
,`sizem_mdfdon` datetime
,`sizem_mdfdby` varchar(250)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_cntnt_cntry_cnty_cty_mst`
--
DROP TABLE IF EXISTS `vw_cntnt_cntry_cnty_cty_mst`;

CREATE  VIEW `vw_cntnt_cntry_cnty_cty_mst`  AS  (select `cntnt_mst`.`cntntm_id` AS `cntntm_id`,`cntnt_mst`.`cntntm_name` AS `cntntm_name`,`cntnt_mst`.`cntntm_iso` AS `cntntm_iso`,`cntnt_mst`.`cntntm_prty` AS `cntntm_prty`,`cntnt_mst`.`cntntm_sts` AS `cntntm_sts`,`cntnt_mst`.`cntntm_crtdon` AS `cntntm_crtdon`,`cntnt_mst`.`cntntm_crtdby` AS `cntntm_crtdby`,`cntnt_mst`.`cntntm_mdfdon` AS `cntntm_mdfdon`,`cntnt_mst`.`cntntm_mdfdby` AS `cntntm_mdfdby`,`cntry_mst`.`cntrym_id` AS `cntrym_id`,`cntry_mst`.`cntrym_name` AS `cntrym_name`,`cntry_mst`.`cntrym_isothr` AS `cntrym_isothr`,`cntry_mst`.`cntrym_isotwo` AS `cntrym_isotwo`,`cntry_mst`.`cntrym_cntntm_id` AS `cntrym_cntntm_id`,`cntry_mst`.`cntrym_isonum` AS `cntrym_isonum`,`cntry_mst`.`cntrym_sts` AS `cntrym_sts`,`cntry_mst`.`cntrym_prty` AS `cntrym_prty`,`cntry_mst`.`cntrym_crtdon` AS `cntrym_crtdon`,`cntry_mst`.`cntrym_crtdby` AS `cntrym_crtdby`,`cntry_mst`.`cntrym_mdfdon` AS `cntrym_mdfdon`,`cntry_mst`.`cntrym_mdfdby` AS `cntrym_mdfdby`,`cnty_mst`.`cntym_id` AS `cntym_id`,`cnty_mst`.`cntym_name` AS `cntym_name`,`cnty_mst`.`cntym_cntrym_id` AS `cntym_cntrym_id`,`cnty_mst`.`cntym_iso` AS `cntym_iso`,`cnty_mst`.`cntym_sts` AS `cntym_sts`,`cnty_mst`.`cntym_prty` AS `cntym_prty`,`cnty_mst`.`cntym_crtdon` AS `cntym_crtdon`,`cnty_mst`.`cntym_crtdby` AS `cntym_crtdby`,`cnty_mst`.`cntym_mdfdon` AS `cntym_mdfdon`,`cnty_mst`.`cntym_mdfdby` AS `cntym_mdfdby`,`cty_mst`.`ctym_id` AS `ctym_id`,`cty_mst`.`ctym_name` AS `ctym_name`,`cty_mst`.`ctym_cntym_id` AS `ctym_cntym_id`,`cty_mst`.`ctym_iso` AS `ctym_iso`,`cty_mst`.`ctym_sts` AS `ctym_sts`,`cty_mst`.`ctym_prty` AS `ctym_prty`,`cty_mst`.`ctym_crtdon` AS `ctym_crtdon`,`cty_mst`.`ctym_crtdby` AS `ctym_crtdby`,`cty_mst`.`ctym_mdfdon` AS `ctym_mdfdon`,`cty_mst`.`ctym_mdfdby` AS `ctym_mdfdby` from (((`cntnt_mst` join `cntry_mst` on((`cntry_mst`.`cntrym_cntntm_id` = `cntnt_mst`.`cntntm_id`))) left join `cnty_mst` on((`cnty_mst`.`cntym_cntrym_id` = `cntry_mst`.`cntrym_id`))) left join `cty_mst` on((`cty_mst`.`ctym_cntym_id` = `cnty_mst`.`cntym_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cntry_cntnt_mst`
--
DROP TABLE IF EXISTS `vw_cntry_cntnt_mst`;

CREATE  VIEW `vw_cntry_cntnt_mst`  AS  (select `cntry_mst`.`cntrym_id` AS `cntrym_id`,`cntry_mst`.`cntrym_name` AS `cntrym_name`,`cntry_mst`.`cntrym_isothr` AS `cntrym_isothr`,`cntry_mst`.`cntrym_isotwo` AS `cntrym_isotwo`,`cntry_mst`.`cntrym_cntntm_id` AS `cntrym_cntntm_id`,`cntry_mst`.`cntrym_isonum` AS `cntrym_isonum`,`cntry_mst`.`cntrym_sts` AS `cntrym_sts`,`cntry_mst`.`cntrym_prty` AS `cntrym_prty`,`cntry_mst`.`cntrym_crtdon` AS `cntrym_crtdon`,`cntry_mst`.`cntrym_crtdby` AS `cntrym_crtdby`,`cntry_mst`.`cntrym_mdfdon` AS `cntrym_mdfdon`,`cntry_mst`.`cntrym_mdfdby` AS `cntrym_mdfdby`,`cntnt_mst`.`cntntm_id` AS `cntntm_id`,`cntnt_mst`.`cntntm_name` AS `cntntm_name`,`cntnt_mst`.`cntntm_iso` AS `cntntm_iso`,`cntnt_mst`.`cntntm_prty` AS `cntntm_prty`,`cntnt_mst`.`cntntm_sts` AS `cntntm_sts`,`cntnt_mst`.`cntntm_crtdon` AS `cntntm_crtdon`,`cntnt_mst`.`cntntm_crtdby` AS `cntntm_crtdby`,`cntnt_mst`.`cntntm_mdfdon` AS `cntntm_mdfdon`,`cntnt_mst`.`cntntm_mdfdby` AS `cntntm_mdfdby` from (`cntry_mst` join `cntnt_mst` on((`cntry_mst`.`cntrym_cntntm_id` = `cntnt_mst`.`cntntm_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cntry_cnty_cty_mst`
--
DROP TABLE IF EXISTS `vw_cntry_cnty_cty_mst`;

CREATE  VIEW `vw_cntry_cnty_cty_mst`  AS  (select `cty_mst`.`ctym_id` AS `ctym_id`,`cty_mst`.`ctym_name` AS `ctym_name`,`cty_mst`.`ctym_cntym_id` AS `ctym_cntym_id`,`cty_mst`.`ctym_iso` AS `ctym_iso`,`cty_mst`.`ctym_sts` AS `ctym_sts`,`cty_mst`.`ctym_prty` AS `ctym_prty`,`cty_mst`.`ctym_crtdon` AS `ctym_crtdon`,`cty_mst`.`ctym_crtdby` AS `ctym_crtdby`,`cty_mst`.`ctym_mdfdon` AS `ctym_mdfdon`,`cty_mst`.`ctym_mdfdby` AS `ctym_mdfdby`,`cnty_mst`.`cntym_id` AS `cntym_id`,`cnty_mst`.`cntym_name` AS `cntym_name`,`cnty_mst`.`cntym_cntrym_id` AS `cntym_cntrym_id`,`cnty_mst`.`cntym_iso` AS `cntym_iso`,`cnty_mst`.`cntym_sts` AS `cntym_sts`,`cnty_mst`.`cntym_prty` AS `cntym_prty`,`cnty_mst`.`cntym_crtdon` AS `cntym_crtdon`,`cnty_mst`.`cntym_crtdby` AS `cntym_crtdby`,`cnty_mst`.`cntym_mdfdon` AS `cntym_mdfdon`,`cnty_mst`.`cntym_mdfdby` AS `cntym_mdfdby`,`cntry_mst`.`cntrym_id` AS `cntrym_id`,`cntry_mst`.`cntrym_name` AS `cntrym_name`,`cntry_mst`.`cntrym_isothr` AS `cntrym_isothr`,`cntry_mst`.`cntrym_isotwo` AS `cntrym_isotwo`,`cntry_mst`.`cntrym_cntntm_id` AS `cntrym_cntntm_id`,`cntry_mst`.`cntrym_isonum` AS `cntrym_isonum`,`cntry_mst`.`cntrym_sts` AS `cntrym_sts`,`cntry_mst`.`cntrym_prty` AS `cntrym_prty`,`cntry_mst`.`cntrym_crtdon` AS `cntrym_crtdon`,`cntry_mst`.`cntrym_crtdby` AS `cntrym_crtdby`,`cntry_mst`.`cntrym_mdfdon` AS `cntrym_mdfdon`,`cntry_mst`.`cntrym_mdfdby` AS `cntrym_mdfdby` from (`cty_mst` join (`cnty_mst` join `cntry_mst` on((`cnty_mst`.`cntym_cntrym_id` = `cntry_mst`.`cntrym_id`))) on((`cty_mst`.`ctym_cntym_id` = `cnty_mst`.`cntym_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cntry_cnty_mst`
--
DROP TABLE IF EXISTS `vw_cntry_cnty_mst`;

CREATE  VIEW `vw_cntry_cnty_mst`  AS  (select `cnty_mst`.`cntym_id` AS `cntym_id`,`cnty_mst`.`cntym_name` AS `cntym_name`,`cnty_mst`.`cntym_cntrym_id` AS `cntym_cntrym_id`,`cnty_mst`.`cntym_iso` AS `cntym_iso`,`cnty_mst`.`cntym_sts` AS `cntym_sts`,`cnty_mst`.`cntym_prty` AS `cntym_prty`,`cnty_mst`.`cntym_crtdon` AS `cntym_crtdon`,`cnty_mst`.`cntym_crtdby` AS `cntym_crtdby`,`cnty_mst`.`cntym_mdfdon` AS `cntym_mdfdon`,`cnty_mst`.`cntym_mdfdby` AS `cntym_mdfdby`,`cntry_mst`.`cntrym_id` AS `cntrym_id`,`cntry_mst`.`cntrym_name` AS `cntrym_name`,`cntry_mst`.`cntrym_isothr` AS `cntrym_isothr`,`cntry_mst`.`cntrym_isotwo` AS `cntrym_isotwo`,`cntry_mst`.`cntrym_cntntm_id` AS `cntrym_cntntm_id`,`cntry_mst`.`cntrym_isonum` AS `cntrym_isonum`,`cntry_mst`.`cntrym_sts` AS `cntrym_sts`,`cntry_mst`.`cntrym_prty` AS `cntrym_prty`,`cntry_mst`.`cntrym_crtdon` AS `cntrym_crtdon`,`cntry_mst`.`cntrym_crtdby` AS `cntrym_crtdby`,`cntry_mst`.`cntrym_mdfdon` AS `cntrym_mdfdon`,`cntry_mst`.`cntrym_mdfdby` AS `cntrym_mdfdby` from (`cnty_mst` join `cntry_mst` on((`cnty_mst`.`cntym_cntrym_id` = `cntry_mst`.`cntrym_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cnty_mst`
--
DROP TABLE IF EXISTS `vw_cnty_mst`;

CREATE  VIEW `vw_cnty_mst`  AS  (select `cnty_mst`.`cntym_id` AS `cntym_id`,`cnty_mst`.`cntym_name` AS `cntym_name`,`cnty_mst`.`cntym_cntrym_id` AS `cntym_cntrym_id`,`cnty_mst`.`cntym_iso` AS `cntym_iso`,`cnty_mst`.`cntym_sts` AS `cntym_sts`,`cnty_mst`.`cntym_prty` AS `cntym_prty`,`cnty_mst`.`cntym_crtdon` AS `cntym_crtdon`,`cnty_mst`.`cntym_crtdby` AS `cntym_crtdby`,`cnty_mst`.`cntym_mdfdon` AS `cntym_mdfdon`,`cnty_mst`.`cntym_mdfdby` AS `cntym_mdfdby`,`cntry_mst`.`cntrym_id` AS `cntrym_id`,`cntry_mst`.`cntrym_name` AS `cntrym_name`,`cntry_mst`.`cntrym_isothr` AS `cntrym_isothr`,`cntry_mst`.`cntrym_isotwo` AS `cntrym_isotwo`,`cntry_mst`.`cntrym_cntntm_id` AS `cntrym_cntntm_id`,`cntry_mst`.`cntrym_isonum` AS `cntrym_isonum`,`cntry_mst`.`cntrym_sts` AS `cntrym_sts`,`cntry_mst`.`cntrym_prty` AS `cntrym_prty`,`cntry_mst`.`cntrym_crtdon` AS `cntrym_crtdon`,`cntry_mst`.`cntrym_crtdby` AS `cntrym_crtdby`,`cntry_mst`.`cntrym_mdfdon` AS `cntrym_mdfdon`,`cntry_mst`.`cntrym_mdfdby` AS `cntrym_mdfdby` from (`cnty_mst` join `cntry_mst` on((`cnty_mst`.`cntym_cntrym_id` = `cntry_mst`.`cntrym_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_fdbck_all`
--
DROP TABLE IF EXISTS `vw_fdbck_all`;

CREATE  VIEW `vw_fdbck_all`  AS  (select `fdbck_mst`.`fdbckm_id` AS `fdbckm_id`,`fdbck_mst`.`fdbckm_emailid` AS `fdbckm_emailid`,`fdbck_mst`.`fdbckm_name` AS `fdbckm_name`,`fdbck_mst`.`fdbckm_phno` AS `fdbckm_phno`,`fdbck_mst`.`fdbckm_addr` AS `fdbckm_addr`,`fdbck_mst`.`fdbckm_sizem_id` AS `fdbckm_sizem_id`,`fdbck_mst`.`fdbckm_prodscatm_id` AS `fdbckm_prodscatm_id`,`fdbck_mst`.`fdbckm_brndm_id` AS `fdbckm_brndm_id`,`fdbck_mst`.`fdbckm_trpstn` AS `fdbckm_trpstn`,`fdbck_mst`.`fdbckm_trtyp` AS `fdbckm_trtyp`,`fdbck_mst`.`fdbckm_prty` AS `fdbckm_prty`,`fdbck_mst`.`fdbckm_sts` AS `fdbckm_sts`,`fdbck_mst`.`fdbckm_crtdon` AS `fdbckm_crtdon`,`fdbck_mst`.`fdbckm_crtdby` AS `fdbckm_crtdby`,`fdbck_mst`.`fdbckm_mdfdon` AS `fdbckm_mdfdon`,`fdbck_mst`.`fdbckm_mdfdby` AS `fdbckm_mdfdby`,`vw_trtyp_size_mst`.`trtypm_id` AS `trtypm_id`,`vw_trtyp_size_mst`.`trtypm_name` AS `trtypm_name`,`vw_trtyp_size_mst`.`trtypm_desc` AS `trtypm_desc`,`vw_trtyp_size_mst`.`trtypm_prty` AS `trtypm_prty`,`vw_trtyp_size_mst`.`trtypm_sts` AS `trtypm_sts`,`vw_trtyp_size_mst`.`trtypm_crtdon` AS `trtypm_crtdon`,`vw_trtyp_size_mst`.`trtypm_crtdby` AS `trtypm_crtdby`,`vw_trtyp_size_mst`.`trtypm_mdfdon` AS `trtypm_mdfdon`,`vw_trtyp_size_mst`.`trtypm_mdfdby` AS `trtypm_mdfdby`,`vw_trtyp_size_mst`.`sizem_id` AS `sizem_id`,`vw_trtyp_size_mst`.`sizem_name` AS `sizem_name`,`vw_trtyp_size_mst`.`sizem_desc` AS `sizem_desc`,`vw_trtyp_size_mst`.`sizem_trtypm_id` AS `sizem_trtypm_id`,`vw_trtyp_size_mst`.`sizem_szchrtimg` AS `sizem_szchrtimg`,`vw_trtyp_size_mst`.`sizem_icnimg` AS `sizem_icnimg`,`vw_trtyp_size_mst`.`sizem_hmpg` AS `sizem_hmpg`,`vw_trtyp_size_mst`.`sizem_pstn` AS `sizem_pstn`,`vw_trtyp_size_mst`.`sizem_frmdt` AS `sizem_frmdt`,`vw_trtyp_size_mst`.`sizem_todt` AS `sizem_todt`,`vw_trtyp_size_mst`.`sizem_sts` AS `sizem_sts`,`vw_trtyp_size_mst`.`sizem_prty` AS `sizem_prty`,`vw_trtyp_size_mst`.`sizem_seotitle` AS `sizem_seotitle`,`vw_trtyp_size_mst`.`sizem_seodesc` AS `sizem_seodesc`,`vw_trtyp_size_mst`.`sizem_seokywrd` AS `sizem_seokywrd`,`vw_trtyp_size_mst`.`sizem_seohonettl` AS `sizem_seohonettl`,`vw_trtyp_size_mst`.`sizem_seohonedesc` AS `sizem_seohonedesc`,`vw_trtyp_size_mst`.`sizem_seohtwottl` AS `sizem_seohtwottl`,`vw_trtyp_size_mst`.`sizem_seohtwodesc` AS `sizem_seohtwodesc`,`vw_trtyp_size_mst`.`sizem_crtdon` AS `sizem_crtdon`,`vw_trtyp_size_mst`.`sizem_crtdby` AS `sizem_crtdby`,`vw_trtyp_size_mst`.`sizem_mdfdon` AS `sizem_mdfdon`,`vw_trtyp_size_mst`.`sizem_mdfdby` AS `sizem_mdfdby`,`vw_prodcat_prodscat_mst`.`prodcatm_id` AS `prodcatm_id`,`vw_prodcat_prodscat_mst`.`prodcatm_name` AS `prodcatm_name`,`vw_prodcat_prodscat_mst`.`prodcatm_desc` AS `prodcatm_desc`,`vw_prodcat_prodscat_mst`.`prodcatm_frmdt` AS `prodcatm_frmdt`,`vw_prodcat_prodscat_mst`.`prodcatm_todt` AS `prodcatm_todt`,`vw_prodcat_prodscat_mst`.`prodcatm_smlimg` AS `prodcatm_smlimg`,`vw_prodcat_prodscat_mst`.`prodcatm_bnrimg` AS `prodcatm_bnrimg`,`vw_prodcat_prodscat_mst`.`prodcatm_seotitle` AS `prodcatm_seotitle`,`vw_prodcat_prodscat_mst`.`prodcatm_seodesc` AS `prodcatm_seodesc`,`vw_prodcat_prodscat_mst`.`prodcatm_seokywrd` AS `prodcatm_seokywrd`,`vw_prodcat_prodscat_mst`.`prodcatm_seohonettl` AS `prodcatm_seohonettl`,`vw_prodcat_prodscat_mst`.`prodcatm_seohonedesc` AS `prodcatm_seohonedesc`,`vw_prodcat_prodscat_mst`.`prodcatm_seohtwottl` AS `prodcatm_seohtwottl`,`vw_prodcat_prodscat_mst`.`prodcatm_seohtwodesc` AS `prodcatm_seohtwodesc`,`vw_prodcat_prodscat_mst`.`prodcatm_taxm_id` AS `prodcatm_taxm_id`,`vw_prodcat_prodscat_mst`.`prodcatm_dlvrtyp` AS `prodcatm_dlvrtyp`,`vw_prodcat_prodscat_mst`.`prodcatm_sts` AS `prodcatm_sts`,`vw_prodcat_prodscat_mst`.`prodcatm_prty` AS `prodcatm_prty`,`vw_prodcat_prodscat_mst`.`prodcatm_hmprty` AS `prodcatm_hmprty`,`vw_prodcat_prodscat_mst`.`prodcatm_crtdon` AS `prodcatm_crtdon`,`vw_prodcat_prodscat_mst`.`prodcatm_crtdby` AS `prodcatm_crtdby`,`vw_prodcat_prodscat_mst`.`prodcatm_mdfdon` AS `prodcatm_mdfdon`,`vw_prodcat_prodscat_mst`.`prodcatm_mdfdby` AS `prodcatm_mdfdby`,`vw_prodcat_prodscat_mst`.`prodscatm_id` AS `prodscatm_id`,`vw_prodcat_prodscat_mst`.`prodscatm_name` AS `prodscatm_name`,`vw_prodcat_prodscat_mst`.`prodscatm_desc` AS `prodscatm_desc`,`vw_prodcat_prodscat_mst`.`prodscatm_prodcatm_id` AS `prodscatm_prodcatm_id`,`vw_prodcat_prodscat_mst`.`prodscatm_szchrtimg` AS `prodscatm_szchrtimg`,`vw_prodcat_prodscat_mst`.`prodscatm_icnimg` AS `prodscatm_icnimg`,`vw_prodcat_prodscat_mst`.`prodscatm_hmpg` AS `prodscatm_hmpg`,`vw_prodcat_prodscat_mst`.`prodscatm_pstn` AS `prodscatm_pstn`,`vw_prodcat_prodscat_mst`.`prodscatm_frmdt` AS `prodscatm_frmdt`,`vw_prodcat_prodscat_mst`.`prodscatm_todt` AS `prodscatm_todt`,`vw_prodcat_prodscat_mst`.`prodscatm_sts` AS `prodscatm_sts`,`vw_prodcat_prodscat_mst`.`prodscatm_prty` AS `prodscatm_prty`,`vw_prodcat_prodscat_mst`.`prodscatm_seotitle` AS `prodscatm_seotitle`,`vw_prodcat_prodscat_mst`.`prodscatm_seodesc` AS `prodscatm_seodesc`,`vw_prodcat_prodscat_mst`.`prodscatm_seokywrd` AS `prodscatm_seokywrd`,`vw_prodcat_prodscat_mst`.`prodscatm_seohonettl` AS `prodscatm_seohonettl`,`vw_prodcat_prodscat_mst`.`prodscatm_seohonedesc` AS `prodscatm_seohonedesc`,`vw_prodcat_prodscat_mst`.`prodscatm_seohtwottl` AS `prodscatm_seohtwottl`,`vw_prodcat_prodscat_mst`.`prodscatm_seohtwodesc` AS `prodscatm_seohtwodesc`,`vw_prodcat_prodscat_mst`.`prodscatm_crtdon` AS `prodscatm_crtdon`,`vw_prodcat_prodscat_mst`.`prodscatm_crtdby` AS `prodscatm_crtdby`,`vw_prodcat_prodscat_mst`.`prodscatm_mdfdon` AS `prodscatm_mdfdon`,`vw_prodcat_prodscat_mst`.`prodscatm_mdfdby` AS `prodscatm_mdfdby`,`brnd_mst`.`brndm_id` AS `brndm_id`,`brnd_mst`.`brndm_name` AS `brndm_name`,`brnd_mst`.`brndm_desc` AS `brndm_desc`,`brnd_mst`.`brndm_img` AS `brndm_img`,`brnd_mst`.`brndm_zmimg` AS `brndm_zmimg`,`brnd_mst`.`brndm_seotitle` AS `brndm_seotitle`,`brnd_mst`.`brndm_seodesc` AS `brndm_seodesc`,`brnd_mst`.`brndm_seokywrd` AS `brndm_seokywrd`,`brnd_mst`.`brndm_seohonetitle` AS `brndm_seohonetitle`,`brnd_mst`.`brndm_seohonedesc` AS `brndm_seohonedesc`,`brnd_mst`.`brndm_seohtwotitle` AS `brndm_seohtwotitle`,`brnd_mst`.`brndm_seohtwodesc` AS `brndm_seohtwodesc`,`brnd_mst`.`brndm_sts` AS `brndm_sts`,`brnd_mst`.`brndm_prty` AS `brndm_prty`,`brnd_mst`.`brndm_crtdon` AS `brndm_crtdon`,`brnd_mst`.`brndm_crtdby` AS `brndm_crtdby`,`brnd_mst`.`brndm_mdfdon` AS `brndm_mdfdon`,`brnd_mst`.`brndm_mdfdby` AS `brndm_mdfdby` from (((`fdbck_mst` join `vw_trtyp_size_mst` on((`fdbck_mst`.`fdbckm_sizem_id` = `vw_trtyp_size_mst`.`sizem_id`))) join `vw_prodcat_prodscat_mst` on((`fdbck_mst`.`fdbckm_prodscatm_id` = `vw_prodcat_prodscat_mst`.`prodscatm_id`))) join `brnd_mst` on((`fdbck_mst`.`fdbckm_brndm_id` = `brnd_mst`.`brndm_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_prodcat_prodscat_mst`
--
DROP TABLE IF EXISTS `vw_prodcat_prodscat_mst`;

CREATE  VIEW `vw_prodcat_prodscat_mst`  AS  (select `prodcat_mst`.`prodcatm_id` AS `prodcatm_id`,`prodcat_mst`.`prodcatm_name` AS `prodcatm_name`,`prodcat_mst`.`prodcatm_desc` AS `prodcatm_desc`,`prodcat_mst`.`prodcatm_frmdt` AS `prodcatm_frmdt`,`prodcat_mst`.`prodcatm_todt` AS `prodcatm_todt`,`prodcat_mst`.`prodcatm_smlimg` AS `prodcatm_smlimg`,`prodcat_mst`.`prodcatm_bnrimg` AS `prodcatm_bnrimg`,`prodcat_mst`.`prodcatm_seotitle` AS `prodcatm_seotitle`,`prodcat_mst`.`prodcatm_seodesc` AS `prodcatm_seodesc`,`prodcat_mst`.`prodcatm_seokywrd` AS `prodcatm_seokywrd`,`prodcat_mst`.`prodcatm_seohonettl` AS `prodcatm_seohonettl`,`prodcat_mst`.`prodcatm_seohonedesc` AS `prodcatm_seohonedesc`,`prodcat_mst`.`prodcatm_seohtwottl` AS `prodcatm_seohtwottl`,`prodcat_mst`.`prodcatm_seohtwodesc` AS `prodcatm_seohtwodesc`,`prodcat_mst`.`prodcatm_taxm_id` AS `prodcatm_taxm_id`,`prodcat_mst`.`prodcatm_dlvrtyp` AS `prodcatm_dlvrtyp`,`prodcat_mst`.`prodcatm_sts` AS `prodcatm_sts`,`prodcat_mst`.`prodcatm_prty` AS `prodcatm_prty`,`prodcat_mst`.`prodcatm_hmprty` AS `prodcatm_hmprty`,`prodcat_mst`.`prodcatm_crtdon` AS `prodcatm_crtdon`,`prodcat_mst`.`prodcatm_crtdby` AS `prodcatm_crtdby`,`prodcat_mst`.`prodcatm_mdfdon` AS `prodcatm_mdfdon`,`prodcat_mst`.`prodcatm_mdfdby` AS `prodcatm_mdfdby`,`prodscat_mst`.`prodscatm_id` AS `prodscatm_id`,`prodscat_mst`.`prodscatm_name` AS `prodscatm_name`,`prodscat_mst`.`prodscatm_desc` AS `prodscatm_desc`,`prodscat_mst`.`prodscatm_prodcatm_id` AS `prodscatm_prodcatm_id`,`prodscat_mst`.`prodscatm_szchrtimg` AS `prodscatm_szchrtimg`,`prodscat_mst`.`prodscatm_icnimg` AS `prodscatm_icnimg`,`prodscat_mst`.`prodscatm_hmpg` AS `prodscatm_hmpg`,`prodscat_mst`.`prodscatm_pstn` AS `prodscatm_pstn`,`prodscat_mst`.`prodscatm_frmdt` AS `prodscatm_frmdt`,`prodscat_mst`.`prodscatm_todt` AS `prodscatm_todt`,`prodscat_mst`.`prodscatm_sts` AS `prodscatm_sts`,`prodscat_mst`.`prodscatm_prty` AS `prodscatm_prty`,`prodscat_mst`.`prodscatm_seotitle` AS `prodscatm_seotitle`,`prodscat_mst`.`prodscatm_seodesc` AS `prodscatm_seodesc`,`prodscat_mst`.`prodscatm_seokywrd` AS `prodscatm_seokywrd`,`prodscat_mst`.`prodscatm_seohonettl` AS `prodscatm_seohonettl`,`prodscat_mst`.`prodscatm_seohonedesc` AS `prodscatm_seohonedesc`,`prodscat_mst`.`prodscatm_seohtwottl` AS `prodscatm_seohtwottl`,`prodscat_mst`.`prodscatm_seohtwodesc` AS `prodscatm_seohtwodesc`,`prodscat_mst`.`prodscatm_crtdon` AS `prodscatm_crtdon`,`prodscat_mst`.`prodscatm_crtdby` AS `prodscatm_crtdby`,`prodscat_mst`.`prodscatm_mdfdon` AS `prodscatm_mdfdon`,`prodscat_mst`.`prodscatm_mdfdby` AS `prodscatm_mdfdby` from (`prodcat_mst` join `prodscat_mst` on((`prodcat_mst`.`prodcatm_id` = `prodscat_mst`.`prodscatm_prodcatm_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_prod_mst`
--
DROP TABLE IF EXISTS `vw_prod_mst`;

CREATE  VIEW `vw_prod_mst`  AS  (select `prod_mst`.`prodm_id` AS `prodm_id`,`prod_mst`.`prodm_code` AS `prodm_code`,`prod_mst`.`prodm_name` AS `prodm_name`,`prod_mst`.`prodm_descone` AS `prodm_descone`,`prod_mst`.`prodm_desctwo` AS `prodm_desctwo`,`prod_mst`.`prodm_mrp` AS `prodm_mrp`,`prod_mst`.`prodm_op` AS `prodm_op`,`prod_mst`.`prodm_wt` AS `prodm_wt`,`prod_mst`.`prodm_vehtypm_id` AS `prodm_vehtypm_id`,`prod_mst`.`prodm_brndm_id` AS `prodm_brndm_id`,`prod_mst`.`prodm_catthrm_id` AS `prodm_catthrm_id`,`prod_mst`.`prodm_typ` AS `prodm_typ`,`prod_mst`.`prodm_seotitle` AS `prodm_seotitle`,`prod_mst`.`prodm_seodesc` AS `prodm_seodesc`,`prod_mst`.`prodm_seokywrd` AS `prodm_seokywrd`,`prod_mst`.`prodm_seohonetitle` AS `prodm_seohonetitle`,`prod_mst`.`prodm_seohonedesc` AS `prodm_seohonedesc`,`prod_mst`.`prodm_seohtwotitle` AS `prodm_seohtwotitle`,`prod_mst`.`prodm_seohtwodesc` AS `prodm_seohtwodesc`,`prod_mst`.`prodm_prty` AS `prodm_prty`,`prod_mst`.`prodm_sts` AS `prodm_sts`,`prod_mst`.`prodm_crtdon` AS `prodm_crtdon`,`prod_mst`.`prodm_crtdby` AS `prodm_crtdby`,`prod_mst`.`prodm_mdfdon` AS `prodm_mdfdon`,`prod_mst`.`prodm_mdfdby` AS `prodm_mdfdby`,`brnd_mst`.`brndm_id` AS `brndm_id`,`vehtyp_mst`.`vehtypm_name` AS `vehtypm_name`,`brnd_mst`.`brndm_name` AS `brndm_name`,`brnd_mst`.`brndm_desc` AS `brndm_desc`,`brnd_mst`.`brndm_img` AS `brndm_img`,`brnd_mst`.`brndm_zmimg` AS `brndm_zmimg`,`brnd_mst`.`brndm_seotitle` AS `brndm_seotitle`,`brnd_mst`.`brndm_seodesc` AS `brndm_seodesc`,`brnd_mst`.`brndm_seokywrd` AS `brndm_seokywrd`,`brnd_mst`.`brndm_seohonetitle` AS `brndm_seohonetitle`,`brnd_mst`.`brndm_seohonedesc` AS `brndm_seohonedesc`,`brnd_mst`.`brndm_seohtwotitle` AS `brndm_seohtwotitle`,`brnd_mst`.`brndm_seohtwodesc` AS `brndm_seohtwodesc`,`brnd_mst`.`brndm_sts` AS `brndm_sts`,`brnd_mst`.`brndm_prty` AS `brndm_prty`,`brnd_mst`.`brndm_crtdon` AS `brndm_crtdon`,`brnd_mst`.`brndm_crtdby` AS `brndm_crtdby`,`brnd_mst`.`brndm_mdfdon` AS `brndm_mdfdon`,`brnd_mst`.`brndm_mdfdby` AS `brndm_mdfdby` from ((`prod_mst` join `brnd_mst` on((`prod_mst`.`prodm_brndm_id` = `brnd_mst`.`brndm_id`))) join `vehtyp_mst` on((`prod_mst`.`prodm_vehtypm_id` = `vehtyp_mst`.`vehtypm_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_trtyp_size_mst`
--
DROP TABLE IF EXISTS `vw_trtyp_size_mst`;

CREATE  VIEW `vw_trtyp_size_mst`  AS  (select `trtyp_mst`.`trtypm_id` AS `trtypm_id`,`trtyp_mst`.`trtypm_name` AS `trtypm_name`,`trtyp_mst`.`trtypm_desc` AS `trtypm_desc`,`trtyp_mst`.`trtypm_prty` AS `trtypm_prty`,`trtyp_mst`.`trtypm_sts` AS `trtypm_sts`,`trtyp_mst`.`trtypm_crtdon` AS `trtypm_crtdon`,`trtyp_mst`.`trtypm_crtdby` AS `trtypm_crtdby`,`trtyp_mst`.`trtypm_mdfdon` AS `trtypm_mdfdon`,`trtyp_mst`.`trtypm_mdfdby` AS `trtypm_mdfdby`,`size_mst`.`sizem_id` AS `sizem_id`,`size_mst`.`sizem_name` AS `sizem_name`,`size_mst`.`sizem_desc` AS `sizem_desc`,`size_mst`.`sizem_trtypm_id` AS `sizem_trtypm_id`,`size_mst`.`sizem_szchrtimg` AS `sizem_szchrtimg`,`size_mst`.`sizem_icnimg` AS `sizem_icnimg`,`size_mst`.`sizem_hmpg` AS `sizem_hmpg`,`size_mst`.`sizem_pstn` AS `sizem_pstn`,`size_mst`.`sizem_frmdt` AS `sizem_frmdt`,`size_mst`.`sizem_todt` AS `sizem_todt`,`size_mst`.`sizem_sts` AS `sizem_sts`,`size_mst`.`sizem_prty` AS `sizem_prty`,`size_mst`.`sizem_seotitle` AS `sizem_seotitle`,`size_mst`.`sizem_seodesc` AS `sizem_seodesc`,`size_mst`.`sizem_seokywrd` AS `sizem_seokywrd`,`size_mst`.`sizem_seohonettl` AS `sizem_seohonettl`,`size_mst`.`sizem_seohonedesc` AS `sizem_seohonedesc`,`size_mst`.`sizem_seohtwottl` AS `sizem_seohtwottl`,`size_mst`.`sizem_seohtwodesc` AS `sizem_seohtwodesc`,`size_mst`.`sizem_crtdon` AS `sizem_crtdon`,`size_mst`.`sizem_crtdby` AS `sizem_crtdby`,`size_mst`.`sizem_mdfdon` AS `sizem_mdfdon`,`size_mst`.`sizem_mdfdby` AS `sizem_mdfdby` from (`trtyp_mst` join `size_mst` on((`size_mst`.`sizem_trtypm_id` = `trtyp_mst`.`trtypm_id`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bnr_mst`
--
ALTER TABLE `bnr_mst`
  ADD PRIMARY KEY (`bnrm_name`),
  ADD KEY `bnrm_id` (`bnrm_id`);

--
-- Indexes for table `brnd_mst`
--
ALTER TABLE `brnd_mst`
  ADD PRIMARY KEY (`brndm_name`),
  ADD KEY `brndm_id` (`brndm_id`);

--
-- Indexes for table `cntnt_mst`
--
ALTER TABLE `cntnt_mst`
  ADD PRIMARY KEY (`cntntm_name`),
  ADD UNIQUE KEY `cntntm_id` (`cntntm_id`);

--
-- Indexes for table `cntry_mst`
--
ALTER TABLE `cntry_mst`
  ADD PRIMARY KEY (`cntrym_name`,`cntrym_cntntm_id`),
  ADD KEY `cntrym_id` (`cntrym_id`);

--
-- Indexes for table `cnty_mst`
--
ALTER TABLE `cnty_mst`
  ADD PRIMARY KEY (`cntym_name`,`cntym_cntrym_id`),
  ADD KEY `cntym_id` (`cntym_id`),
  ADD KEY `FK_cnty_mst` (`cntym_cntrym_id`);

--
-- Indexes for table `crtord_dtl`
--
ALTER TABLE `crtord_dtl`
  ADD PRIMARY KEY (`crtordd_id`,`crtordd_prodm_id`);

--
-- Indexes for table `crtord_mst`
--
ALTER TABLE `crtord_mst`
  ADD PRIMARY KEY (`crtordm_id`);

--
-- Indexes for table `cty_mst`
--
ALTER TABLE `cty_mst`
  ADD PRIMARY KEY (`ctym_name`,`ctym_cntym_id`),
  ADD KEY `FK_cty_mst` (`ctym_cntym_id`),
  ADD KEY `ctym_id` (`ctym_id`);

--
-- Indexes for table `fdbck_mst`
--
ALTER TABLE `fdbck_mst`
  ADD KEY `fdbckm_id` (`fdbckm_id`);

--
-- Indexes for table `gnrlenqry_mst`
--
ALTER TABLE `gnrlenqry_mst`
  ADD KEY `gnrlenqrym_id` (`gnrlenqrym_id`);

--
-- Indexes for table `lgntrck_mst`
--
ALTER TABLE `lgntrck_mst`
  ADD PRIMARY KEY (`lgntrckm_id`),
  ADD KEY `FK_lgntrck_mst` (`lgntrckm_lgnm_id`);

--
-- Indexes for table `lgn_mst`
--
ALTER TABLE `lgn_mst`
  ADD PRIMARY KEY (`lgnm_uid`),
  ADD UNIQUE KEY `lgnm_id` (`lgnm_id`);

--
-- Indexes for table `prodcat_mst`
--
ALTER TABLE `prodcat_mst`
  ADD PRIMARY KEY (`prodcatm_name`),
  ADD KEY `prodcatm_id` (`prodcatm_id`);

--
-- Indexes for table `prodimg_dtl`
--
ALTER TABLE `prodimg_dtl`
  ADD PRIMARY KEY (`prodimgd_prodm_id`,`prodimgd_simg`),
  ADD KEY `prodm_id` (`prodimgd_id`);

--
-- Indexes for table `prodscat_mst`
--
ALTER TABLE `prodscat_mst`
  ADD PRIMARY KEY (`prodscatm_name`,`prodscatm_prodcatm_id`),
  ADD KEY `prodmncatm2_id` (`prodscatm_id`),
  ADD KEY `FK_prodscat_mst` (`prodscatm_prodcatm_id`);

--
-- Indexes for table `prod_mst`
--
ALTER TABLE `prod_mst`
  ADD PRIMARY KEY (`prodm_code`),
  ADD KEY `prodm_id` (`prodm_id`),
  ADD KEY `FK_prod_cattwo_mst` (`prodm_brndm_id`),
  ADD KEY `FK_prod_thr_mst` (`prodm_catthrm_id`);

--
-- Indexes for table `size_mst`
--
ALTER TABLE `size_mst`
  ADD PRIMARY KEY (`sizem_name`,`sizem_trtypm_id`),
  ADD KEY `sizem_trtypm_id` (`sizem_id`),
  ADD KEY `FK_size_mst` (`sizem_trtypm_id`);

--
-- Indexes for table `trtyp_mst`
--
ALTER TABLE `trtyp_mst`
  ADD PRIMARY KEY (`trtypm_name`),
  ADD UNIQUE KEY `trtypm_id` (`trtypm_id`);

--
-- Indexes for table `vehtyp_mst`
--
ALTER TABLE `vehtyp_mst`
  ADD PRIMARY KEY (`vehtypm_name`),
  ADD KEY `vehtypm_id` (`vehtypm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bnr_mst`
--
ALTER TABLE `bnr_mst`
  MODIFY `bnrm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brnd_mst`
--
ALTER TABLE `brnd_mst`
  MODIFY `brndm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cntnt_mst`
--
ALTER TABLE `cntnt_mst`
  MODIFY `cntntm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cntry_mst`
--
ALTER TABLE `cntry_mst`
  MODIFY `cntrym_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `cnty_mst`
--
ALTER TABLE `cnty_mst`
  MODIFY `cntym_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `crtord_dtl`
--
ALTER TABLE `crtord_dtl`
  MODIFY `crtordd_id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment id for each order detail', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `crtord_mst`
--
ALTER TABLE `crtord_mst`
  MODIFY `crtordm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cty_mst`
--
ALTER TABLE `cty_mst`
  MODIFY `ctym_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;

--
-- AUTO_INCREMENT for table `fdbck_mst`
--
ALTER TABLE `fdbck_mst`
  MODIFY `fdbckm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gnrlenqry_mst`
--
ALTER TABLE `gnrlenqry_mst`
  MODIFY `gnrlenqrym_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `lgntrck_mst`
--
ALTER TABLE `lgntrck_mst`
  MODIFY `lgntrckm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `lgn_mst`
--
ALTER TABLE `lgn_mst`
  MODIFY `lgnm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodcat_mst`
--
ALTER TABLE `prodcat_mst`
  MODIFY `prodcatm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `prodimg_dtl`
--
ALTER TABLE `prodimg_dtl`
  MODIFY `prodimgd_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `prodscat_mst`
--
ALTER TABLE `prodscat_mst`
  MODIFY `prodscatm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `prod_mst`
--
ALTER TABLE `prod_mst`
  MODIFY `prodm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `size_mst`
--
ALTER TABLE `size_mst`
  MODIFY `sizem_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `trtyp_mst`
--
ALTER TABLE `trtyp_mst`
  MODIFY `trtypm_id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'unique auto increment id for trtyp record', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehtyp_mst`
--
ALTER TABLE `vehtyp_mst`
  MODIFY `vehtypm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
