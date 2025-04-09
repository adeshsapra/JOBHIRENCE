-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 03:56 AM
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
-- Database: `jobhierance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile_img`, `created_at`, `updated_at`, `email_verified_at`, `remember_token`) VALUES
(1, 'hariyani akshaybhai', 'akshay@gmail.com', '$2y$12$uDdQ3W9CYbJZigvD1FDKW.r2Ki5tuixIGrXWhMHQNHr8r0KVEC7Zi', '1740369994_1.jpg', '2025-02-19 21:12:23', '2025-02-23 22:36:34', NULL, 'ppvmVJet9UoWWZMBD76YD8IZpBhDEtIWFggKOgQpXtylmnzKsT6pupCSlqL6');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `c_industry` varchar(255) NOT NULL,
  `c_size` varchar(255) NOT NULL,
  `c_established_year` year(4) NOT NULL,
  `c_type` varchar(255) NOT NULL,
  `c_city` varchar(255) NOT NULL,
  `c_country` varchar(255) NOT NULL,
  `c_postal_code` varchar(255) NOT NULL,
  `c_website` varchar(255) DEFAULT NULL,
  `c_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `c_name`, `c_email`, `c_password`, `c_industry`, `c_size`, `c_established_year`, `c_type`, `c_city`, `c_country`, `c_postal_code`, `c_website`, `c_address`, `created_at`, `updated_at`) VALUES
(1, 'ak developerr', 'akshay@gmail.com', '$2y$12$YWTUHDUB9g9hcn864nxqXOoP7D2yoJuNxgucudX7nOGzzMQJRxE7e', 'it & development', '1-10', '2021', 'Private', 'amreli', 'india', '4004334', NULL, 'lathi road, amreli, gujrat', '2025-02-02 21:39:35', '2025-02-10 21:57:20'),
(2, 'Doyle-Sanford', 'sanford.ellie@barrows.com', '$2y$12$kH701hWkDL2xiMgt9SxU.ul4eZGBBbuH1FurPggRbs0fDD8ghtOdO', 'sunt', '51-200', '2006', 'Government', 'Keelingview', 'French Polynesia', '24520-3045', 'https://wolff.info/est-ea-aut-numquam-magnam-esse-sapiente.html', '422 Bonita Key Apt. 776\nHaneton, IA 90899-2748', '2025-02-27 21:13:46', '2025-02-27 21:13:46'),
(3, 'Koss-Dickinson', 'kstokes@trantow.org', '$2y$12$/8wGV7B6j2Cc4nvHIzzOROs1ufzi9f7bcJVAXrqZFWHsD1MX9lURS', 'aut', '201-500', '2006', 'Public', 'Jastville', 'Micronesia', '20052', 'http://abbott.com/', '4984 Wintheiser Mountains Apt. 053\nJohnsfort, UT 86779-7515', '2025-02-27 21:13:46', '2025-02-27 21:13:46'),
(4, 'Weimann, Walter and Rolfson', 'ispencer@hand.com', '$2y$12$s0IOsj5zz2egTquTTenhAO8ZUPGpLRcoBSe/oyPmvhtMrYR2YndB2', 'molestiae', '501-1000', '2018', 'Public', 'Lake Havenchester', 'Brazil', '81314-7106', 'http://www.dooley.net/alias-dignissimos-aut-aperiam-voluptas', '347 Jaskolski Glen\nHillaryland, WV 66347-4142', '2025-02-27 21:13:46', '2025-02-27 21:13:46'),
(5, 'Prosacco, Lubowitz and Gutmann', 'vgerhold@ernser.org', '$2y$12$Fg/hdSKKo13.PM/VuBsSne5Bz.jsYW3GaXi6bgMImp.TGtd9QzLTy', 'autem', '501-1000', '2013', 'Government', 'Austinmouth', 'Albania', '66628-1430', 'http://marquardt.com/eligendi-aut-vitae-hic-sit-nihil-ipsum-culpa-itaque', '1591 Maritza Street\nWisokyburgh, KY 10464-0736', '2025-02-27 21:13:46', '2025-02-27 21:13:46'),
(6, 'McCullough, Langosh and Harber', 'stiedemann.maxwell@price.com', '$2y$12$2MYpTXCVjDp/x9WnpwlqT.AW5vDvWWBcxbDtE3iUv6gNunTagGl6.', 'rerum', '51-200', '2010', 'Government', 'West Marjoryside', 'Lesotho', '22557', 'http://www.zulauf.biz/dolores-consequatur-quia-pariatur-maiores-veniam-expedita.html', '456 Frederik Burgs Suite 789\nAdanstad, PA 12941', '2025-02-27 21:13:47', '2025-02-27 21:13:47'),
(7, 'Erdman Ltd', 'qcrooks@roberts.net', '$2y$12$oLCdL.wacR1Ltwmj.ykQge8b1F7EggWXrKI2yo/EVMHHTgaZ8nJZS', 'doloribus', '201-500', '2020', 'Public', 'Rylanport', 'Morocco', '48750', 'https://wyman.net/unde-qui-id-ut-eum-quia-aut.html', '1404 Kassulke Greens\nSchmidtborough, TN 79919', '2025-02-27 21:13:47', '2025-02-27 21:13:47'),
(8, 'Gusikowski Ltd', 'considine.katheryn@wisoky.com', '$2y$12$OKllsjdXJH3C1xt0wasJ0euTwmt.shpbofEJ6CLDRNFCeNo3occMG', 'voluptatem', '501-1000', '1974', 'Government', 'Lake Zander', 'Iraq', '23879-0102', 'http://www.cruickshank.com/doloribus-dicta-id-quis-sed-eligendi-harum-architecto-amet.html', '15191 Schaefer Squares Suite 547\nLake Noebury, OR 59214-5230', '2025-02-27 21:13:47', '2025-02-27 21:13:47'),
(9, 'Hill, Ryan and Dickinson', 'deja84@hudson.com', '$2y$12$oo11X2ramHL2bApEhylFJOprA7EfYpAfiC1KtZz2tpXU8.fXpu6Ky', 'voluptatem', '1-10', '2001', 'Public', 'Windlerchester', 'Cambodia', '25887', 'http://www.dooley.com/dolorum-quae-voluptatem-asperiores-sunt-aut-qui', '8887 Boyer Lights\nLake Darryl, NH 27299-5648', '2025-02-27 21:13:47', '2025-02-27 21:13:47'),
(10, 'Hyatt-Hyatt', 'brigitte.dicki@king.net', '$2y$12$JH29ikz5eY.zkN8l6cTIGukf66.ZrHkVHrmhrYpJaerUJYFh.yEWe', 'aspernatur', '201-500', '2009', 'Private', 'East Lyric', 'Moldova', '29499-2508', 'http://leuschke.com/rerum-numquam-eos-voluptate.html', '81945 Naomie Creek\nAdelastad, MS 36620-5432', '2025-02-27 21:13:48', '2025-02-27 21:13:48'),
(11, 'Gottlieb, Bosco and Rolfson', 'wisoky.aryanna@will.net', '$2y$12$yZdbATmxRWTR3rUoZQAJsuGR7qil96TKvSXXwh9wmZde69YQ/KSQS', 'reprehenderit', '201-500', '2008', 'Public', 'Opalbury', 'Nepal', '27248-6215', 'http://lindgren.net/et-voluptas-sit-voluptate-deleniti-et', '7761 Adelle Junctions\nEast Jermainestad, UT 72310-3448', '2025-02-27 21:13:48', '2025-02-27 21:13:48'),
(12, 'Mills, Hamill and Keebler', 'anissa65@moen.com', '$2y$12$1C9q76VNWcKHabfPfuIWn.lAiuwy0wvGZagg9pomjuFTF6HV9i6WO', 'consequatur', '11-50', '2011', 'Public', 'Lake Lurashire', 'Montserrat', '54027-6616', 'http://braun.com/eaque-inventore-distinctio-nobis-aspernatur-quasi-et-quia', '7182 Kole Bypass Apt. 554\nNorth Nash, MO 60828-8059', '2025-02-27 21:13:48', '2025-02-27 21:13:48'),
(13, 'Nikolaus PLC', 'larissa.lehner@koepp.info', '$2y$12$zSEYx/OH5p.tWB1MMQSCsebQjXZDkvi10Iu0nsmfnanOyBT21CUKy', 'quia', '51-200', '1997', 'Government', 'Lake Nelle', 'Slovenia', '68711-1837', 'https://parisian.org/sint-possimus-delectus-sint-eos.html', '767 Delphine Highway\nPort Gerry, NJ 07469-5876', '2025-02-27 21:13:48', '2025-02-27 21:13:48'),
(14, 'Ebert, Senger and Balistreri', 'sheila30@russel.biz', '$2y$12$rLqq90mIR76ntUcWS2RLnuRhYFUBUmxPI7Htp3p8ouiCtDHi/8zUe', 'quo', '1001+', '1973', 'Government', 'New Raeganberg', 'Hong Kong', '75207', 'http://www.douglas.com/quisquam-repellendus-quis-similique-nihil-eveniet-earum-sint', '188 Leann Union\nAverybury, TN 94447-6634', '2025-02-27 21:13:49', '2025-02-27 21:13:49'),
(15, 'Buckridge-Hauck', 'cartwright.nikolas@hickle.info', '$2y$12$ZRit9OOBfauQJYL7QYg8hOk2LWJHHBPLCNRo4En/HBqVsQQbx7NSS', 'id', '1-10', '2008', 'Public', 'Selmerville', 'Pakistan', '79209-1725', 'http://www.kerluke.com/cum-in-quo-odio-velit.html', '52288 Mayert Port\nLake Hertatown, SD 21573-9591', '2025-02-27 21:13:49', '2025-02-27 21:13:49'),
(16, 'Stiedemann, Dickens and Schiller', 'awilkinson@leuschke.net', '$2y$12$lh5LF80GP1WPvv8kv7xmoeqqQ7hEYHmumei2pTdDvkpbms2rAz3T2', 'dolorum', '1-10', '2016', 'Government', 'Geraldshire', 'Cocos (Keeling) Islands', '95745-2355', 'http://murphy.com/facere-quos-modi-quia', '977 Westley Manors\nEast Rossiebury, WI 73032-4773', '2025-02-27 21:13:49', '2025-02-27 21:13:49'),
(17, 'Rath-Lindgren', 'dominic.powlowski@hettinger.com', '$2y$12$oYeFXPnP30BBo.PvXp3f6OkZCYzdnETzXqol4ZVFUlHRWgYTHzreq', 'porro', '1-10', '1974', 'Public', 'Reynoldsfort', 'Serbia', '18213-5934', 'http://www.haag.net/omnis-velit-nihil-iure-assumenda', '32430 Dejah Cliffs\nPort Louisa, OK 78371', '2025-02-27 21:13:50', '2025-02-27 21:13:50'),
(18, 'Daugherty LLC', 'arnoldo.toy@feeney.com', '$2y$12$B.oM9EV56ghocwRaWUYGmuJkNldRJe2FanLJsKZcpvjg.p/OoN47W', 'veritatis', '11-50', '2024', 'Private', 'New Elisaburgh', 'Brazil', '96071-6979', 'http://www.cartwright.com/ullam-ad-qui-explicabo-eos-earum-dicta', '1097 Stephen Courts\nNorth Savannah, WA 53498', '2025-02-27 21:13:50', '2025-02-27 21:13:50'),
(19, 'Hilpert-Batz', 'steve38@little.info', '$2y$12$DP96TyY9c0BC/x2a1O4l1uhXUsTaMrTxj7dvwUxDn.lKB69BZqMj6', 'officia', '501-1000', '1998', 'Private', 'West Candida', 'Andorra', '33919-1956', 'http://www.cummings.com/molestiae-dolores-sunt-et-hic-est-eum-quisquam', '7423 Annette Park Apt. 537\nCoryborough, AR 79904-5253', '2025-02-27 21:13:50', '2025-02-27 21:13:50'),
(20, 'Conn-Orn', 'mhettinger@cartwright.com', '$2y$12$tUHRmtegTf3U2oUX/NFATeVmA.ylabIZa243hBRfYPr9NXOyQtG3m', 'sapiente', '1-10', '1981', 'Private', 'Keyonburgh', 'Malaysia', '43395-5809', 'http://www.schultz.biz/odit-sunt-nemo-ab.html', '9638 Pauline Stravenue\nLake Colten, VT 93098', '2025-02-27 21:13:50', '2025-02-27 21:13:50'),
(21, 'Grady-Jacobs', 'hessel.ava@collier.org', '$2y$12$ABWPEMDtANa0cL3isTTPJ.sEjtgu5rcvpWi6df7.gGD4KcAWDghN2', 'odio', '1-10', '1987', 'Government', 'Willburgh', 'United Kingdom', '41110-4471', 'http://www.grady.com/iusto-doloribus-praesentium-fugiat-reiciendis-sit-animi-explicabo.html', '30489 Madyson Underpass Suite 284\nTanyafurt, KY 48010-3520', '2025-02-27 21:13:51', '2025-02-27 21:13:51'),
(22, 'Dickens and Sons', 'pyost@rippin.com', '$2y$12$T7hbqmmlq8P0Q5Fh6K6SK.K0ty9UiKc9ojr2WfAn8sow6pMwS7Peq', 'numquam', '501-1000', '2011', 'Government', 'South Gilbertfort', 'Netherlands Antilles', '09898-8599', 'http://www.erdman.com/provident-corporis-velit-quo-fugiat-odio', '6508 Heidenreich Villages Suite 426\nGoldnershire, IA 38749-0863', '2025-02-27 21:13:51', '2025-02-27 21:13:51'),
(23, 'Hill Inc', 'madisen84@labadie.com', '$2y$12$xxMgXd/f9F5MNQZ1dgTWFeB9E5kX3/xc8KzY/VY7Sz.6QN0tzcVju', 'illo', '1-10', '2006', 'Private', 'Funkfurt', 'Anguilla', '20361-9103', 'http://glover.com/hic-atque-beatae-iure-error', '815 Mraz Cape Apt. 034\nCristfort, IA 48626', '2025-02-27 21:13:51', '2025-02-27 21:13:51'),
(24, 'Herman, Hagenes and Lehner', 'pink.schoen@stehr.com', '$2y$12$7qbf4Ot71ICsIGnd4E.dzO5GTebzjY3P7/L.m7YcEbNydsUco/Stm', 'eum', '11-50', '2009', 'Government', 'Murphyland', 'Libyan Arab Jamahiriya', '86087-8491', 'http://www.nikolaus.org/rerum-fuga-corrupti-nobis-impedit-et-voluptatem-dolorem-ut', '6175 Tyrique Fall\nAdelaborough, MS 22157-0350', '2025-02-27 21:13:51', '2025-02-27 21:13:51'),
(25, 'Altenwerth-Ernser', 'mark.quigley@stiedemann.com', '$2y$12$1xoQl.GAtibCo4Ok0gJOCOP43RPA1Dak7GhNoq3h5bj0kuzLVol.q', 'nobis', '51-200', '1974', 'Government', 'Rogermouth', 'Eritrea', '11495-7983', 'http://www.willms.net/', '691 Agustin Cliff\nBrettchester, MD 23766', '2025-02-27 21:13:52', '2025-02-27 21:13:52'),
(26, 'Gibson and Sons', 'max53@dach.org', '$2y$12$fb157JucgY2KIJN/OUenuOTglYH9/Ost.5L/xVAwZXyG2Sy1zsj/C', 'illum', '1-10', '1984', 'Government', 'Linwoodside', 'Barbados', '38635', 'http://cole.com/labore-ipsam-consequatur-blanditiis-quas-ipsum-assumenda.html', '1698 Russel Groves Apt. 414\nJamarshire, HI 12404', '2025-02-27 21:13:52', '2025-02-27 21:13:52'),
(27, 'Barrows-Daniel', 'pfeffer.cathryn@pouros.org', '$2y$12$R.SCy9WahCUZZDL0sjE31eYBSfkmU0vJOtnOnyUA7Th87sm.wjswy', 'rerum', '1-10', '1980', 'Public', 'West Brettville', 'Hong Kong', '93091', 'http://mosciski.com/reprehenderit-assumenda-est-hic-labore.html', '7367 Kirlin Court Suite 308\nImaniland, VT 91656', '2025-02-27 21:13:52', '2025-02-27 21:13:52'),
(28, 'Collier-Padberg', 'perry.stracke@bartoletti.biz', '$2y$12$E.nb7tkyuSVki6us8tNPgeVpImXWDpOS5BRO.Igqj0m3FZ7hXMGjq', 'voluptates', '501-1000', '1983', 'Private', 'Mullerville', 'Congo', '95460', 'https://www.daugherty.com/velit-molestiae-laudantium-aliquam-et-enim-alias', '287 Gulgowski Lights\nNew Prince, KY 52987-5866', '2025-02-27 21:13:52', '2025-02-27 21:13:52'),
(29, 'Denesik, Hahn and Koss', 'uboyer@quigley.org', '$2y$12$QbpU2Q2MJr28D4j8ZjYZKe4qEhdXmOEyBNJXJ8UZctbOueR2weAi2', 'exercitationem', '501-1000', '1992', 'Public', 'South Brucechester', 'Belarus', '68740-1369', 'http://nitzsche.com/', '64646 Allie Light\nLeonehaven, NY 64549-2274', '2025-02-27 21:13:53', '2025-02-27 21:13:53'),
(30, 'Herman, McGlynn and Greenfelder', 'douglas.katrine@white.com', '$2y$12$3zrrcsmjjM/b1BavfQxAD.GRTH2hNtFf4t9y9aoba0ISbMEgOBpNu', 'aut', '1001+', '2010', 'Private', 'Caterinachester', 'Saint Martin', '39458', 'http://wilkinson.com/', '120 Federico Ranch Apt. 084\nSouth Aubree, OK 98138-3858', '2025-02-27 21:13:53', '2025-02-27 21:13:53'),
(31, 'Kerluke-Stark', 'erdman.marcelino@von.com', '$2y$12$mNM43pCGwts7nxD9dJxAculHt53ZR2jZfetzWNCXzEujRjVCbtUNa', 'debitis', '501-1000', '1983', 'Public', 'Bednarview', 'Micronesia', '61663-8995', 'http://www.willms.org/incidunt-similique-consequatur-rerum-hic-dignissimos-et.html', '81291 Feest Station\nBernardhaven, LA 61927', '2025-02-27 21:13:53', '2025-02-27 21:13:53'),
(32, 'Rempel, Gottlieb and Dare', 'elody34@torphy.com', '$2y$12$oFaiDMVyMO2XyoI4XNmeROslCBpsmI/F4Tpho2yCUngdnKZVY/36u', 'quam', '501-1000', '2015', 'Public', 'East Coreneport', 'Japan', '31988-5943', 'http://www.ortiz.com/inventore-ipsum-rem-quia-facilis-dolorum-id-explicabo.html', '484 Hamill Dale\nMarkshaven, MI 77634-3250', '2025-02-27 21:13:53', '2025-02-27 21:13:53'),
(33, 'Kihn, Ziemann and McCullough', 'ondricka.lennie@baumbach.com', '$2y$12$dcB4cmtnjFpnCdD1FbqgA.Z2gMzq7bfIIQdJX1tfBWxj4dzZ/Jkby', 'odio', '501-1000', '1985', 'Public', 'Ephraimburgh', 'Fiji', '38417-3658', 'http://www.mosciski.com/', '778 Kassulke Fords\nWest Timmothy, VA 87505-3933', '2025-02-27 21:13:54', '2025-02-27 21:13:54'),
(34, 'Denesik, Robel and Morissette', 'bergnaum.joaquin@lebsack.com', '$2y$12$GRUi0hZ0aBhP9sZvSHltSOX2H5RXD2eeiqwozgqSV96HowVkn2.gq', 'non', '11-50', '2009', 'Private', 'Runtebury', 'Brazil', '87358', 'https://glover.com/est-porro-accusantium-ut-aliquam-est-aspernatur-consequatur.html', '429 Priscilla Curve\nKoelpinbury, MO 33680-9251', '2025-02-27 21:13:54', '2025-02-27 21:13:54'),
(35, 'Moen, Yost and Pollich', 'jkautzer@stanton.com', '$2y$12$Oy.VmHGCxO5hV0aMpMwd3OiNIYCt9JRKIAnEG6Do9kpK0jDHxlxQ2', 'voluptas', '1001+', '1978', 'Government', 'South Conradfurt', 'Sudan', '61140', 'http://www.hills.com/recusandae-velit-harum-libero-ut-eum-in-laborum.html', '7904 Bradly Fork Apt. 101\nBrownmouth, KY 47347', '2025-02-27 21:13:54', '2025-02-27 21:13:54'),
(36, 'Borer, Glover and Kerluke', 'doyle.megane@okeefe.com', '$2y$12$fd8hSgzbBe68UuzrxgVSDe5IlqCS7QB3AllwwD2RrtgfSE3v0kbWK', 'laboriosam', '51-200', '2006', 'Public', 'South Collinstad', 'Kyrgyz Republic', '89767', 'http://www.osinski.com/alias-vel-tenetur-natus-cum', '78663 Marvin Cliffs\nSouth Mittie, ID 30219', '2025-02-27 21:13:54', '2025-02-27 21:13:54'),
(37, 'Reinger, Little and Goodwin', 'ibecker@lind.com', '$2y$12$HQocuk2btjUlQLOpUbbu3uGfrvN8Aq1jSNptkwUGnrieIirs6YOtK', 'est', '1-10', '1996', 'Government', 'Pascaletown', 'Seychelles', '66109-3433', 'http://www.kshlerin.com/', '617 Dibbert Route\nNorth Rudolph, IN 82096-8378', '2025-02-27 21:13:55', '2025-02-27 21:13:55'),
(38, 'Reynolds LLC', 'dianna22@graham.com', '$2y$12$DQ.ORiRZtNGOjnPKRJTxYuvcSUdqeJ5jwSsPmOEbz57noqG5P/qFi', 'rerum', '1-10', '2017', 'Government', 'Denesikbury', 'Finland', '82430-9300', 'http://www.shanahan.com/labore-facilis-esse-itaque-pariatur-veniam-quasi', '83452 Gene Fort\nFilibertofurt, KY 34703-2418', '2025-02-27 21:13:55', '2025-02-27 21:13:55'),
(39, 'Cormier, Dickinson and Rath', 'cgoyette@cremin.info', '$2y$12$CLYGO/9raLXCR70MOZe63u7RYDqj.zJYZ6UNSUMFtA9fVCxGAC4W.', 'iure', '11-50', '1979', 'Government', 'Kirstinchester', 'Bermuda', '38279-3370', 'http://goyette.com/et-illo-aut-placeat-explicabo-sit.html', '1810 Kieran Brooks Suite 020\nNew Quintenberg, WY 21966', '2025-02-27 21:13:55', '2025-02-27 21:13:55'),
(40, 'Brakus-Schaden', 'strosin.nicholaus@bauch.com', '$2y$12$C5t0qn6szwWHf8wfa6h4gOkbx.Jry9yVVpHu9KQHXA1x3p/hd6N6y', 'quia', '201-500', '1972', 'Private', 'Alfburgh', 'Germany', '65478', 'http://www.schimmel.org/tempore-ipsum-similique-placeat-aperiam.html', '424 Noah Knolls Suite 337\nWest Claudine, AR 90256-8960', '2025-02-27 21:13:55', '2025-02-27 21:13:55'),
(41, 'Goldner LLC', 'nondricka@lind.org', '$2y$12$I0vmOapnrfSfcme4bc/RzeKePXN7PjzZjhzNE4e4VMOosYPhigwc.', 'consequatur', '1-10', '2000', 'Public', 'Christiansenland', 'Tunisia', '94604', 'http://www.dietrich.net/sequi-iste-consequuntur-est-optio-a-labore-totam.html', '91964 Treutel Brooks Suite 427\nWest Rachel, LA 71572-7679', '2025-02-27 21:13:56', '2025-02-27 21:13:56'),
(42, 'Halvorson PLC', 'winfield99@gleichner.com', '$2y$12$2u9fwQGVgrSEW6lKobSB3e7V71w90PCLVnM8t/BsVMHTGjDHsto46', 'non', '51-200', '2022', 'Government', 'South Ashton', 'El Salvador', '47943-1600', 'https://littel.net/tempore-enim-est-impedit-omnis-incidunt-in-et.html', '82107 Elvera Ports Apt. 338\nSchultzside, FL 99219-3119', '2025-02-27 21:13:56', '2025-02-27 21:13:56'),
(43, 'Prohaska-Leffler', 'lina35@heaney.biz', '$2y$12$feFnd1s/g32gZJJGXQfTfeo8UZK4KDH2DheEFUwkG9s9UP3AIckxa', 'qui', '51-200', '1993', 'Private', 'Fayport', 'Czech Republic', '63735', 'https://stiedemann.com/repellat-pariatur-sunt-rerum-quidem.html', '89542 Loyal Turnpike Apt. 428\nGreenfelderhaven, IA 03607-2234', '2025-02-27 21:13:56', '2025-02-27 21:13:56'),
(44, 'Beahan, McLaughlin and Hirthe', 'valentine26@abbott.net', '$2y$12$xKqy6VhVThFMvvoGiiegruAZecuO.tCJ77Ofprkfly/6Z3WgGztoS', 'ad', '11-50', '1987', 'Public', 'Heavenland', 'Vietnam', '97058-8758', 'https://weber.com/placeat-natus-illo-id-rem-deleniti-dolor.html', '967 Kessler Hollow Apt. 882\nLake Jamal, OR 75610', '2025-02-27 21:13:56', '2025-02-27 21:13:56'),
(45, 'Halvorson LLC', 'jessy.marvin@sauer.biz', '$2y$12$3MDk4nqfWKlOhyiyOx4SJ.x8s74s0EaEcbadnjkh9VyX/Lg.TaVUy', 'id', '501-1000', '1984', 'Government', 'West Jeff', 'Dominica', '84426', 'https://keeling.com/odit-et-illo-omnis-nulla-totam-qui.html', '8193 Rogelio Mill\nNolanstad, WA 15069', '2025-02-27 21:13:57', '2025-02-27 21:13:57'),
(46, 'Douglas and Sons', 'ldicki@gleichner.org', '$2y$12$4wP9LZPiBtOCyB9LREDKSuH.CvRfkJRmzaI4hZL96Flu31.KMaQFu', 'dolores', '11-50', '1988', 'Government', 'South Piperland', 'Saudi Arabia', '48052-4213', 'http://www.roberts.com/facilis-qui-numquam-ex', '1418 Satterfield Prairie\nSawaynville, WY 73254', '2025-02-27 21:13:57', '2025-02-27 21:13:57'),
(47, 'Nicolas PLC', 'bmurazik@cronin.com', '$2y$12$M.AZ5.0FQX3hrQTrs0gi6.nL1Aiw1iGPkke09ns1N5bbMue0SGlYG', 'aliquid', '501-1000', '1976', 'Private', 'South Penelopestad', 'Sri Lanka', '07525-3974', 'http://raynor.info/amet-aut-explicabo-accusamus-commodi-autem', '180 Brakus Squares Suite 783\nDemondton, HI 07948-7752', '2025-02-27 21:13:57', '2025-02-27 21:13:57'),
(48, 'Turcotte, Von and Quitzon', 'predovic.haven@barrows.com', '$2y$12$iltHI.Ozkva2KWsgGoAl6eHpilr.VBhWy3xNu2fPEYYvunZcOobnm', 'dolor', '501-1000', '1995', 'Public', 'Annalisefurt', 'Saint Barthelemy', '88399', 'http://leuschke.com/et-voluptatem-enim-quas-amet-accusamus-quibusdam', '84405 Dibbert Forest\nLaruemouth, MI 30337', '2025-02-27 21:13:57', '2025-02-27 21:13:57'),
(49, 'Shields-Klein', 'hills.nathaniel@leuschke.com', '$2y$12$f0ZrwXAR2Th.uj0tzZ8BzORBvHEQ3lxANbXbnwnnIc2LRuRME/ICm', 'autem', '51-200', '2024', 'Government', 'Cartwrightfurt', 'Korea', '96744-2705', 'http://www.kemmer.net/', '93064 Glenda Knoll\nNorth Kennedy, KS 06835-4497', '2025-02-27 21:13:58', '2025-02-27 21:13:58'),
(50, 'Larson, Ledner and Mueller', 'konopelski.clement@cormier.com', '$2y$12$4NfL7M7lwMQ4YWTfm301p.I0Ja/AszWNnR/YT0nUG3oIRg/J0/lxu', 'et', '11-50', '2024', 'Government', 'Violettemouth', 'Azerbaijan', '83292-9702', 'https://graham.com/exercitationem-dolor-ut-expedita-praesentium-at-qui-sit.html', '255 Jules Green Apt. 339\nKriston, OR 78061-1979', '2025-02-27 21:13:58', '2025-02-27 21:13:58'),
(51, 'Strosin, Bogisich and Murphy', 'berneice.zemlak@kreiger.com', '$2y$12$H9DAa4ELztrLTdc4js/SauedQaxIV7cyFpg86KLVDABcnwV.przsO', 'excepturi', '51-200', '2016', 'Public', 'Brayanland', 'Norfolk Island', '05797-7562', 'http://labadie.com/recusandae-sint-eum-atque-est', '254 Maggio Pines\nCarrollmouth, HI 56542', '2025-02-27 21:13:58', '2025-02-27 21:13:58'),
(52, 'Marvin-Mills', 'farrell.zoila@botsford.org', '$2y$12$fEo4L1B6i2wC/ZfL79Yb9.xM0YvEdKbzjDY6h1X825aMVYZsrWeXO', 'saepe', '11-50', '1982', 'Public', 'New Arely', 'Burundi', '99253-7515', 'http://gusikowski.com/', '7614 Jessika Brooks Apt. 842\nNorth Walker, PA 18172', '2025-02-27 21:13:59', '2025-02-27 21:13:59'),
(53, 'Pfeffer and Sons', 'maryjane.nader@stanton.com', '$2y$12$tM5SOlU3HwfJOEBPiRkj6On18HYPKE6C599PU/AjwptGB0BXgtOX6', 'eum', '51-200', '2008', 'Private', 'Ressieville', 'Comoros', '42210-6253', 'http://price.com/', '46982 Dicki Isle Suite 889\nWeberside, NY 52068', '2025-02-27 21:13:59', '2025-02-27 21:13:59'),
(54, 'Rutherford-Wintheiser', 'xzavier40@cummings.com', '$2y$12$iqfs.632cqXKAKTg2Wspu.XBxyfTA7EmAFKFMkAGu003s1r9Fj3TS', 'neque', '201-500', '1983', 'Private', 'Rosannaborough', 'Zimbabwe', '44731', 'https://www.goyette.com/voluptatibus-ipsa-laborum-cum-consequatur-et-sunt-inventore-occaecati', '68383 Hannah Streets Suite 225\nSouth Vicente, SD 52665-0951', '2025-02-27 21:13:59', '2025-02-27 21:13:59'),
(55, 'Will-Hagenes', 'schumm.rhoda@marks.com', '$2y$12$zlGMU82X6bF4xwwP9KSpn.x1elWD52eX0JYyC.GP.poPBrBrnlsFq', 'nostrum', '1-10', '2002', 'Government', 'West Claire', 'French Polynesia', '18042', 'http://www.rolfson.com/quibusdam-ea-molestiae-cupiditate-nesciunt-natus-ratione-autem', '787 Jamal Fork Apt. 296\nCelestineport, GA 02220-0285', '2025-02-27 21:13:59', '2025-02-27 21:13:59'),
(56, 'Goldner-Casper', 'ratke.maximillian@greenfelder.biz', '$2y$12$FZIo2Z4SM2uAo/4CwJghqOLPMcDei/IYJiYowHkoNw27YySqANjh.', 'modi', '501-1000', '1997', 'Private', 'South Edgarhaven', 'Zambia', '89733', 'http://glover.info/dolor-similique-impedit-exercitationem-quisquam', '113 Becker Landing Apt. 233\nSwiftstad, IL 79574-1450', '2025-02-27 21:14:00', '2025-02-27 21:14:00'),
(57, 'Schowalter, Sauer and Moore', 'mstamm@okeefe.biz', '$2y$12$DRGu9eR5TPjzj7ePehh/Xe0W8txbd0QEdNyHcQMIAHfkuRDPAmvGy', 'vel', '11-50', '1999', 'Government', 'East Kelly', 'United States Virgin Islands', '14798-8124', 'http://leffler.com/sed-eos-qui-aliquid-eum-qui-temporibus-qui', '679 Mohr Fork\nLake Maynardland, RI 22848', '2025-02-27 21:14:00', '2025-02-27 21:14:00'),
(58, 'Parisian, Nader and Durgan', 'zlegros@herman.com', '$2y$12$5HSc6ED0GYAqSVhWU7Ik3OZz9DqmZZgNaQkBNz7s66Qg/mx8MQScK', 'eum', '201-500', '1974', 'Private', 'Doloreshaven', 'United States Virgin Islands', '29321', 'https://thiel.org/vero-sunt-amet-illo-rem-voluptatem-saepe.html', '9660 Mitchell Fort\nNew Selenafort, PA 22227-2254', '2025-02-27 21:14:00', '2025-02-27 21:14:00'),
(59, 'Murazik-Ward', 'boyer.ludwig@hirthe.com', '$2y$12$1Bva8bQrK1guTR1oYJPnlOJsU0PeP9E3Xc3F5g7IwZ70bIpEe.ueu', 'quia', '51-200', '2024', 'Public', 'Concepcionchester', 'Mozambique', '48596', 'http://murray.com/', '164 Breitenberg Spring Apt. 097\nWest Kyleburgh, LA 02782-0979', '2025-02-27 21:14:00', '2025-02-27 21:14:00'),
(60, 'Larkin-McClure', 'nella.wehner@schneider.net', '$2y$12$g8GMM7dd2EwHXqDdFXZoL.3fKE/SETZbHVGLLqtkcetx4Fusf4tzO', 'error', '201-500', '1995', 'Private', 'East Nicolasland', 'Wallis and Futuna', '12629-9381', 'http://www.hill.com/', '538 Fabiola Prairie Suite 693\nNew Mariam, NV 51659', '2025-02-27 21:14:01', '2025-02-27 21:14:01'),
(61, 'Mante, Rice and Gerlach', 'felicity35@lehner.com', '$2y$12$2TFY5CEa.vn3qmf4tkxCdeMgspTZvEDIKwtKuGA8AP1WgKbM4Jda2', 'quos', '1-10', '2005', 'Public', 'Adonisberg', 'Russian Federation', '16180', 'http://www.harber.com/', '140 Baumbach Lodge Suite 350\nLake Germanton, KS 22842', '2025-02-27 21:14:01', '2025-02-27 21:14:01'),
(62, 'Cassin-Konopelski', 'deonte.lueilwitz@bins.com', '$2y$12$0It2MvycWLrt3/3zouTipeQ.BD651L0jBsYtFvIxe6YnxUU01Nnga', 'reiciendis', '51-200', '1988', 'Government', 'North Serenaview', 'China', '21724', 'http://fadel.net/nemo-itaque-voluptatem-architecto', '1606 Malachi Lane\nWilliamsonbury, VA 92273-8525', '2025-02-27 21:14:01', '2025-02-27 21:14:01'),
(63, 'Price Group', 'brandyn.grimes@hayes.com', '$2y$12$GbAF6lGQmaNi8i8BTgbkMOJ3wHR.pD9PxZHIyPSYVC9uMkczIpvRu', 'fugit', '1001+', '2000', 'Private', 'Naderland', 'Tunisia', '86747', 'http://kautzer.com/', '6965 Paucek Streets\nGutkowskifort, OR 51766-4848', '2025-02-27 21:14:01', '2025-02-27 21:14:01'),
(64, 'Connelly-Strosin', 'hermann.demarco@swaniawski.info', '$2y$12$aVIlDeT.QcENa5u0oXfABu1qMdMPEaT8QZqc5AbmgWCHf7b2w3FCy', 'error', '1001+', '2016', 'Private', 'Lake Rogerston', 'Benin', '42107-9758', 'http://www.ward.com/tempora-et-voluptatum-commodi-et-repellendus', '825 Hipolito Shoal\nLuettgenburgh, WA 67245', '2025-02-27 21:14:02', '2025-02-27 21:14:02'),
(65, 'Veum, Ankunding and Tromp', 'gbogan@hahn.com', '$2y$12$aHzQxzq3ZY3RxZTr/GjuoeepjUm78mwZh9r0EQQLo0WdH01J6iX/W', 'esse', '201-500', '2010', 'Private', 'Lake Brianne', 'Vanuatu', '77622-0816', 'https://stark.org/explicabo-magnam-ratione-quasi-qui-unde-est.html', '90941 Greyson Fall Apt. 996\nJacobsland, TX 72009', '2025-02-27 21:14:02', '2025-02-27 21:14:02'),
(66, 'Lind-Hermiston', 'carol84@wilkinson.com', '$2y$12$Rryg1kaHvv3kYY.06kDbTuhwg76dgYh9blGPaw7gwsI1zxMbvm6Fe', 'molestiae', '1-10', '1994', 'Private', 'Gersonland', 'Andorra', '05575-5899', 'http://baumbach.info/et-sit-praesentium-voluptas-et-iure-sunt.html', '237 Hillary Alley Suite 415\nThoramouth, MT 50039-3067', '2025-02-27 21:14:02', '2025-02-27 21:14:02'),
(67, 'Rogahn LLC', 'nsmitham@carter.info', '$2y$12$IXWcdq0G/MPAbUAPaIC.FePEq3sG.fTtT5qnY6gueXPq/klTwK37a', 'assumenda', '11-50', '2014', 'Private', 'South Madelinebury', 'Gambia', '39823', 'http://osinski.com/ut-non-ab-impedit-est-necessitatibus', '23239 Royce Run Suite 775\nTimmyhaven, GA 32283-9398', '2025-02-27 21:14:02', '2025-02-27 21:14:02'),
(68, 'Olson-Nienow', 'brannon18@simonis.org', '$2y$12$jDpwg40wrk4kFwSyINjJa.Ulyp5wBJRF4YLn5wzQ0o9kzx1Fk4DYe', 'voluptatem', '201-500', '1994', 'Private', 'Makaylatown', 'Ethiopia', '57271-6062', 'https://skiles.com/numquam-minima-asperiores-dicta.html', '144 Pfannerstill Village Apt. 650\nSmithamport, TN 67964', '2025-02-27 21:14:03', '2025-02-27 21:14:03'),
(69, 'Mitchell Inc', 'russell.sauer@oconner.biz', '$2y$12$APiY8pJB3.CVrSwIber5te89SmdMzN.Q34vgIdWv3nWO0kQJG/6X.', 'quia', '201-500', '2019', 'Government', 'Chaimshire', 'Guadeloupe', '89971-0432', 'http://borer.org/', '3195 Bartoletti Parks Apt. 825\nBlandaview, OH 06559', '2025-02-27 21:14:03', '2025-02-27 21:14:03'),
(70, 'Schroeder-Luettgen', 'qcorkery@hessel.com', '$2y$12$uYVd7Dinjt36I04Sbp7dJ.uVqZuubtezYsafvXdKovQv4Nzj0H7sG', 'atque', '1001+', '1988', 'Public', 'North Willaland', 'Afghanistan', '45779-9587', 'https://www.lehner.net/dicta-dolorem-ut-expedita-vero-non-ab-ipsa', '55268 Roberts Ramp Suite 175\nEast Patricia, WY 98614-7172', '2025-02-27 21:14:03', '2025-02-27 21:14:03'),
(71, 'Ward-Hahn', 'bkovacek@rippin.com', '$2y$12$hNPEjEkihR7mr/3gC5iXTO/Yq5cyiixsWXS4Ul6LzjxaizPg9V/7O', 'sit', '1001+', '2016', 'Private', 'Mariastad', 'Germany', '80329-7665', 'https://www.abernathy.org/ea-repellat-dolor-temporibus-laudantium-sunt-ut', '31858 Lindgren Lane\nLarsonbury, AZ 99184', '2025-02-27 21:14:03', '2025-02-27 21:14:03'),
(72, 'Jacobs PLC', 'mohamed.mante@vonrueden.com', '$2y$12$IuGWhALem5MVhWrYU1bhP.mTpJYgmjFJ2VOXer4f3kOWRIHylXuNC', 'repellat', '11-50', '1996', 'Public', 'Ethylmouth', 'Burkina Faso', '14281-3300', 'http://www.heaney.com/', '7141 Lang Locks Apt. 618\nSchowalterfort, IN 87171', '2025-02-27 21:14:04', '2025-02-27 21:14:04'),
(73, 'Waters, Dach and Dooley', 'elliott.huel@waters.com', '$2y$12$C74cukVKjyBjQ0mxDCYWGOtC5fBALlKpL0ofMVxfLyukUqEzM3x.a', 'recusandae', '201-500', '1984', 'Public', 'Tremayneside', 'Netherlands', '31543-0453', 'http://douglas.com/', '475 Melody Ways Suite 005\nAlenebury, VA 28062', '2025-02-27 21:14:04', '2025-02-27 21:14:04'),
(74, 'Mann, Robel and Jenkins', 'vbarton@ohara.biz', '$2y$12$.tSC/Yv/fjZaFvz.HZfaL.T0T7FNGHrlHfp.R19Je0LmA1dD7ih8S', 'nesciunt', '201-500', '2000', 'Public', 'Aliyatown', 'Saint Pierre and Miquelon', '60332', 'http://ohara.com/modi-perferendis-ipsam-neque-consequatur-voluptates-fuga.html', '23680 Cecil Points Apt. 877\nLake Jodiemouth, LA 02807-5242', '2025-02-27 21:14:04', '2025-02-27 21:14:04'),
(75, 'Runte Inc', 'levi.doyle@hansen.com', '$2y$12$IbKvPT0fOj3k1kZy3XRsQecx1zq1D3uGoOigI/WfwCrbbne1fyrsa', 'dolores', '51-200', '2000', 'Private', 'Runolfsdottirside', 'Iraq', '09975-9311', 'https://abbott.net/nesciunt-quo-est-quas-exercitationem-veniam-id.html', '497 McDermott Islands\nPort Katrinaborough, IA 92807', '2025-02-27 21:14:04', '2025-02-27 21:14:04'),
(76, 'Runolfsson-Cartwright', 'joey80@hahn.org', '$2y$12$kGDOkxuptow8nXaQrKq0TuhWl063nL/GMMfQGNy6eJynJDKM7O3Ye', 'autem', '501-1000', '2019', 'Government', 'West Asaburgh', 'Germany', '73781', 'http://www.schmitt.com/maxime-quibusdam-vel-illum-reprehenderit-ut-id-cupiditate', '2888 Langworth Path Apt. 832\nWest Yasminview, VT 55467', '2025-02-27 21:14:05', '2025-02-27 21:14:05'),
(77, 'Thompson-Torphy', 'oma.bergstrom@cormier.info', '$2y$12$N8P8VrDapIWw0jP.4Th5AOBJel.3w5hSBcDCQlren9hd5uBp8iTRu', 'magnam', '201-500', '1974', 'Government', 'East Hunter', 'Rwanda', '58742-4656', 'http://marvin.info/qui-omnis-amet-est-velit-veritatis', '2921 Zola Courts Apt. 769\nNorth Alvina, NC 82764', '2025-02-27 21:14:05', '2025-02-27 21:14:05'),
(78, 'Nolan LLC', 'eugene.reichel@oreilly.com', '$2y$12$jIfn8CSu6ZejrEn9602PsOdnVD6DTDEhK6hwaSRnZmEvwihgrOoa6', 'alias', '1001+', '2020', 'Public', 'West Mallory', 'Maldives', '15507', 'http://bashirian.com/', '8295 Fred Curve Apt. 519\nNew Heber, TN 95473', '2025-02-27 21:14:05', '2025-02-27 21:14:05'),
(79, 'Hessel Group', 'langosh.valentine@hermiston.com', '$2y$12$96rBxkI8pDJlsB77hUG0Ge5um2Sz/Lqq1N5UbscYWbg9qd/AyNUp.', 'optio', '11-50', '1990', 'Private', 'Ansleymouth', 'Eritrea', '75975', 'https://schinner.com/minus-qui-aut-reprehenderit-at.html', '585 Dorthy Manor Suite 995\nBuckridgeshire, NE 94253-0307', '2025-02-27 21:14:05', '2025-02-27 21:14:05'),
(80, 'Graham-Maggio', 'alfonzo.stanton@gleichner.com', '$2y$12$NeCNmItO3HHzil.hLKXdPOK09esj3uP02CUV6JrLNgcAL3BrzmtNa', 'nam', '11-50', '2017', 'Private', 'North Kristyton', 'United States Virgin Islands', '60082', 'https://walter.com/earum-hic-iste-voluptatem-fugiat-voluptas.html', '2497 Leonie Prairie\nHowellshire, GA 32037-6890', '2025-02-27 21:14:06', '2025-02-27 21:14:06'),
(81, 'Waelchi, Frami and Hintz', 'brown.janie@stanton.biz', '$2y$12$7nlXQ93VGQVaJvfTKVRXZeS29qShA7B.gW9KzCEoTuS9NpCLrpnqy', 'illo', '201-500', '1977', 'Government', 'East Estelton', 'Togo', '11452-6210', 'https://crooks.com/sed-ut-facere-rem.html', '7519 Kovacek Land Suite 218\nEast Archville, AR 78809', '2025-02-27 21:14:06', '2025-02-27 21:14:06'),
(82, 'Block-Waters', 'winnifred13@turcotte.com', '$2y$12$1QuAyRztJVVo3T1xbATPgedBoknJb3b5crOpVoEy/488Iqowc/K/W', 'cumque', '1-10', '2009', 'Public', 'Kendallborough', 'Lebanon', '74317-9338', 'http://www.champlin.com/', '42811 Dickens Loaf\nSouth Ludwigburgh, WY 91355', '2025-02-27 21:14:06', '2025-02-27 21:14:06'),
(83, 'Leffler, Mosciski and Hagenes', 'nikolas.adams@green.biz', '$2y$12$DUASi126IMT1Mxmrfr5cW.av2kgGoVeK7385EDr/jyBHm7NrnGHVa', 'et', '51-200', '1986', 'Government', 'Emmaleeborough', 'Ukraine', '85470', 'http://www.halvorson.com/', '54745 Orlando Center Apt. 291\nKulasshire, KS 06919-0859', '2025-02-27 21:14:06', '2025-02-27 21:14:06'),
(84, 'Koelpin, Funk and Schiller', 'unique15@dibbert.com', '$2y$12$xfcIIojQklpOYV.q1xQsr.3CalRI9J0YsXXcMwZ7eGMAzf.5gRAda', 'autem', '1001+', '1972', 'Private', 'Oraborough', 'Montserrat', '71511', 'http://oreilly.com/eos-harum-et-suscipit-iusto.html', '670 Marquardt Cliff Suite 959\nDachtown, ID 15983', '2025-02-27 21:14:07', '2025-02-27 21:14:07'),
(85, 'Gislason, Pfeffer and Prohaska', 'claire20@lindgren.com', '$2y$12$rNIJ/prZFgLHIIFkLAjoNOF9Ft7Kp1RQhmcRBhIDnAW7pP31.O88y', 'quia', '501-1000', '1991', 'Private', 'East Nathanael', 'Cook Islands', '20213-8888', 'http://www.casper.biz/voluptatem-sit-sit-sit-fugiat-adipisci-doloribus-voluptatem', '7195 Lamar Trail Suite 642\nSouth Isadore, IL 56501-3250', '2025-02-27 21:14:07', '2025-02-27 21:14:07'),
(86, 'O\'Reilly-DuBuque', 'npowlowski@mohr.com', '$2y$12$Qo082S0GOpdwcIL6tBcu3e5a/NDIm.8PC5LvtooxBos6/EKGsoFpi', 'laboriosam', '51-200', '2009', 'Public', 'Damianmouth', 'Bangladesh', '59095', 'http://goldner.com/perspiciatis-repellendus-eius-quaerat-asperiores-ut-consequuntur-voluptatibus-facere.html', '55216 Alene Pike Apt. 054\nEast Hellenberg, CA 72334-9580', '2025-02-27 21:14:07', '2025-02-27 21:14:07'),
(87, 'Walter-Volkman', 'shagenes@heaney.com', '$2y$12$dn3x4QekjGlawVW7gYU7I.gdAxOIpsDiRvueuCgKfBbrgTEccoN9e', 'a', '201-500', '1993', 'Government', 'Port Lane', 'Rwanda', '93416', 'https://www.wiegand.com/placeat-hic-vel-ex-tenetur-dolor', '7637 Mavis Road Apt. 507\nFritschchester, HI 46148', '2025-02-27 21:14:07', '2025-02-27 21:14:07'),
(88, 'Nolan LLC', 'bailey.larue@bechtelar.com', '$2y$12$yzJmHCREEuisoHyu6Ms0ruOOX/wZ3ENxvldhWsyARCCdYlfc75hUO', 'dolorum', '11-50', '2001', 'Government', 'New Rhiannon', 'Portugal', '19504-2770', 'http://lynch.com/pariatur-sed-rem-illum-aliquam-eos-iusto-ut', '33828 Predovic Shores\nSouth Darbyshire, NC 97054-4994', '2025-02-27 21:14:08', '2025-02-27 21:14:08'),
(89, 'Kuhic, Muller and Weissnat', 'flossie23@jenkins.com', '$2y$12$hRpIvpyMSqyIN3QPr3MycOA1YKT4JlD7OaoqkIHlDzkjoJUqofE.a', 'tempore', '1001+', '2012', 'Private', 'Sanfordhaven', 'Libyan Arab Jamahiriya', '60705', 'http://www.torp.org/eos-enim-fugiat-fugiat-non-officiis', '73744 Kelli Falls\nNorth Franciscostad, NE 34009-2324', '2025-02-27 21:14:08', '2025-02-27 21:14:08'),
(90, 'Nicolas, Marks and Wiegand', 'madelynn.langosh@corkery.com', '$2y$12$dd7Vs1mt8YnXa4lOh9JbCu3J7hVy2rjy1L42aRirHgs5inni6r26u', 'illum', '501-1000', '2020', 'Government', 'East Derickborough', 'Solomon Islands', '42367-9180', 'http://www.windler.info/sed-corporis-quisquam-tenetur-et-placeat', '40179 Marquardt Tunnel\nPort Lowell, MO 39756-6909', '2025-02-27 21:14:08', '2025-02-27 21:14:08'),
(91, 'Jacobs, Beahan and Mertz', 'hegmann.sonia@crist.com', '$2y$12$eeejncns86anzba4aet.8OuU9o0F8rGfCo0EfX2g814q3v9dTu.o6', 'doloremque', '11-50', '2024', 'Public', 'Gulgowskifurt', 'Chad', '39285', 'http://kertzmann.biz/omnis-velit-est-qui-sunt-minus-quis-enim', '163 Hilpert Expressway\nMaudebury, NJ 00355-6650', '2025-02-27 21:14:09', '2025-02-27 21:14:09'),
(92, 'Gusikowski, Bailey and Harber', 'kiarra11@huels.com', '$2y$12$.xm8CG28J10hDUMo9/Efhe/ac0r1VD2yy655WMhckhvXEQLB4W6gC', 'ut', '1-10', '1991', 'Private', 'Corwinchester', 'Congo', '73457-1292', 'http://www.stehr.com/', '89282 Lewis Row\nPort Malvinafurt, GA 07302-7215', '2025-02-27 21:14:09', '2025-02-27 21:14:09'),
(93, 'Johns-Daugherty', 'wilderman.zechariah@dickens.org', '$2y$12$9Y/0JisJx4khSDqCUIxicORtUm5B8nDt.6DBsaFQNFrPvraEEUB4u', 'sunt', '51-200', '2001', 'Public', 'New Laverna', 'Martinique', '40929-0120', 'http://www.rempel.biz/non-eveniet-quia-nulla-quisquam', '21148 Sipes Square\nSouth Angiemouth, RI 19706-2448', '2025-02-27 21:14:09', '2025-02-27 21:14:09'),
(94, 'Osinski, Stamm and Legros', 'holly89@abshire.org', '$2y$12$hVvZftEU.iXzws2wPAAmzu3AFTUzfS9nXBuIoyVJW186Dp1oLBZIW', 'officiis', '1001+', '1985', 'Government', 'Lake Diamond', 'Montserrat', '25420', 'http://www.huels.com/placeat-omnis-minima-voluptas-vel-deleniti', '96897 Soledad Islands Apt. 609\nDarrenport, ND 13719', '2025-02-27 21:14:09', '2025-02-27 21:14:09'),
(95, 'McDermott, Borer and Stamm', 'tcorwin@sipes.info', '$2y$12$1xmCzQWuRqjUV52x3ks/a.4MfmZgSN6s9ra5s5rd8qTLkzvA3pQ7C', 'quidem', '1001+', '2021', 'Government', 'New Luluport', 'Sao Tome and Principe', '02198-7509', 'http://www.christiansen.com/est-ea-temporibus-quaerat-nisi-unde-quisquam', '5713 Estevan Views\nNorth Clare, PA 79511-7893', '2025-02-27 21:14:10', '2025-02-27 21:14:10'),
(96, 'Halvorson PLC', 'reagan.connelly@padberg.biz', '$2y$12$iSCxWuyFEBg8Uh/ArPvJIu5XNFX99GNB0UaIsttxf32MwWpxuWHBO', 'impedit', '51-200', '2019', 'Government', 'South Kennedy', 'Mauritania', '08979-4332', 'https://www.williamson.info/rerum-recusandae-distinctio-aliquam-aut-doloremque-sint', '2780 Alvah Villages\nSouth Joseland, MI 93735-8957', '2025-02-27 21:14:10', '2025-02-27 21:14:10'),
(97, 'Baumbach, Mitchell and Mraz', 'cary.hessel@mann.com', '$2y$12$0H2I7MblXqzJ2m0xNenpW.E5SDTUnv3La.Lu.d714bymGytn.vz.2', 'tenetur', '201-500', '1997', 'Private', 'Carmeloburgh', 'France', '80312-2554', 'https://mcglynn.com/vel-possimus-consequatur-aspernatur-officiis-et-aliquam.html', '454 Ezekiel Forest Apt. 639\nMayermouth, IL 28686-4053', '2025-02-27 21:14:10', '2025-02-27 21:14:10'),
(98, 'Kirlin, Thiel and Bergnaum', 'quigley.isadore@koelpin.info', '$2y$12$z8jjVFLRV4pUg.PnEzPQcevJ/JBw3EBGp8BEz6jJYVrwdKu8rxf0K', 'in', '201-500', '1995', 'Private', 'New Stefanie', 'Cambodia', '40987', 'http://lehner.com/quia-quos-quaerat-a-iste-et-eaque.html', '39458 Isidro Prairie\nNorth Brown, WY 07488-3059', '2025-02-27 21:14:10', '2025-02-27 21:14:10'),
(99, 'Gutkowski-Schamberger', 'wullrich@runte.com', '$2y$12$8IU9avaRZLHQYuNpldAPUOaRLf51Ir6dB9gapzNKrCXvdEMLiMf9S', 'quo', '1-10', '2010', 'Private', 'Dorismouth', 'Macedonia', '83893', 'http://wuckert.com/unde-autem-exercitationem-dolor.html', '576 Nicolas Ferry\nFeeneyview, GA 27642', '2025-02-27 21:14:11', '2025-02-27 21:14:11'),
(100, 'Price, Wiza and Brakus', 'smraz@hessel.org', '$2y$12$DIxjl4MpHxxNLXgw8nz2Ner4GecC6okSYyavUfHdAhfl4/xixwIze', 'vel', '51-200', '1986', 'Private', 'Lebsackborough', 'Montenegro', '86644-9210', 'http://bernier.biz/asperiores-illo-dolor-nemo-provident-modi-qui.html', '74120 Marianna Spur Apt. 381\nRunolfsdottirside, OH 57774', '2025-02-27 21:14:11', '2025-02-27 21:14:11'),
(101, 'Boyer-Ward', 'mertie.connelly@reynolds.net', '$2y$12$KNSCoVVAMELNuZ7qYWHIzuz1tmUi.syNFNKWbdIwYC/dgBP/cocn.', 'rerum', '201-500', '2010', 'Private', 'Cathrineside', 'Belize', '50113', 'http://www.dubuque.biz/quos-placeat-rerum-omnis', '545 Parker Ridge Suite 226\nNorth Brendan, KY 83730', '2025-02-27 21:14:11', '2025-02-27 21:14:11'),
(102, 'nilesh bhai', 'nileshsir@gmail.com', '$2y$12$uDdQ3W9CYbJZigvD1FDKW.r2Ki5tuixIGrXWhMHQNHr8r0KVEC7Zi', 'it & development', '11-50', '2022', 'private', 'amreli', 'india', '4004334', NULL, 'herghehergh', '2025-02-27 22:01:49', '2025-02-27 22:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `cover_img` varchar(255) DEFAULT NULL,
  `market_type` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `headquarters` varchar(255) DEFAULT NULL,
  `is_slider` tinyint(1) NOT NULL DEFAULT 0,
  `contact_email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `follower` bigint(20) UNSIGNED DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_id`, `profile_img`, `cover_img`, `market_type`, `about`, `headquarters`, `is_slider`, `contact_email`, `phone`, `follower`, `facebook`, `twitter`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 1, '1738901538_67a58822b2790.jpg', '1738901544_infosys.jpg', 'B2C', 'efggegegr', 'rajula', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-06 22:41:25', '2025-02-10 21:57:20'),
(2, 1, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Quibusdam cupiditate voluptates velit sint. Voluptas sit adipisci nisi impedit. Voluptas corporis in ipsa quis et occaecati.', NULL, 0, 'egreenholt@fay.com', '+13864062526', 6256, 'https://facebook.com/dominique.paucek', 'https://twitter.com/haley.betsy', 'https://linkedin.com/in/collins.rowan', 'https://instagram.com/demetris.aufderhar', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(3, 80, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Sint odio ut deleniti sint. Iste doloremque ex doloremque mollitia reiciendis molestiae. Et distinctio alias nam et. Ut molestiae provident explicabo ut voluptatibus sit.', NULL, 0, 'dax.predovic@parker.com', '(608) 787-4621', 6967, 'https://facebook.com/feeney.rhiannon', 'https://twitter.com/carter.gottlieb', 'https://linkedin.com/in/vlubowitz', 'https://instagram.com/aubree21', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(4, 12, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Ab minima fugit repellendus ut nemo dolorum iure. Debitis exercitationem repellat et et. At qui possimus eum inventore dolores labore. Dolorum optio enim aut voluptas et voluptatem adipisci.', NULL, 0, 'jrobel@schneider.biz', '785-865-0724', 413, 'https://facebook.com/ward.paige', 'https://twitter.com/lonnie54', 'https://linkedin.com/in/davonte44', 'https://instagram.com/cleve.nader', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(5, 18, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Expedita commodi temporibus exercitationem autem commodi reprehenderit fugiat. Quam ea itaque laudantium qui doloribus saepe quidem. Consectetur amet et qui sint officia est. Amet earum id ratione dolor necessitatibus quia.', NULL, 0, 'rbogisich@prohaska.com', '478-701-4553', 6416, 'https://facebook.com/klocko.samantha', 'https://twitter.com/welch.domenica', 'https://linkedin.com/in/zcrooks', 'https://instagram.com/yleffler', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(6, 16, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Vero mollitia dolores repellendus officia animi. Pariatur itaque et doloribus molestiae deleniti. Accusantium qui enim aut omnis. Est esse est non sint pariatur animi velit.', NULL, 0, 'oyundt@grant.com', '+1-248-780-9435', 4156, 'https://facebook.com/bednar.david', 'https://twitter.com/leann38', 'https://linkedin.com/in/ahirthe', 'https://instagram.com/tbosco', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(7, 88, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Veniam aperiam excepturi aut placeat et possimus nulla quibusdam. Reiciendis dolor est quod autem. Architecto necessitatibus adipisci quam tempore odio dolores. Magnam consequatur possimus cumque facilis quo.', NULL, 0, 'kerluke.jacky@feil.com', '+1 (928) 495-2667', 5937, 'https://facebook.com/iwaters', 'https://twitter.com/wolf.jennie', 'https://linkedin.com/in/tremblay.delaney', 'https://instagram.com/skiles.pansy', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(8, 34, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Perspiciatis quas repellat ea similique. Iure ad et omnis corporis animi consequatur. Consequatur labore dolore molestiae quasi deleniti nobis. Laborum maiores minus veritatis eligendi eum eum. Consequatur pariatur accusamus aperiam culpa quas impedit.', NULL, 0, 'ggreenholt@braun.biz', '505-657-4609', 6251, 'https://facebook.com/marlen98', 'https://twitter.com/rempel.orie', 'https://linkedin.com/in/iernser', 'https://instagram.com/victoria83', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(9, 51, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Sapiente quos consequatur saepe sunt consequuntur ratione minima. Dolore quas aut occaecati earum fuga. Iste suscipit nisi et ex consequuntur aperiam rem.', NULL, 0, 'jakob11@upton.biz', '681-317-5358', 4672, 'https://facebook.com/hattie87', 'https://twitter.com/bryon.leuschke', 'https://linkedin.com/in/ugaylord', 'https://instagram.com/dickens.nettie', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(10, 71, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Pariatur repellendus non voluptas optio ullam voluptas. Explicabo ut voluptatem dolore aut qui praesentium mollitia. Dolorum autem recusandae quos voluptatum vel perspiciatis.', NULL, 0, 'joan.hegmann@muller.org', '+17865880536', 9136, 'https://facebook.com/monroe64', 'https://twitter.com/renner.lincoln', 'https://linkedin.com/in/qprosacco', 'https://instagram.com/mafalda43', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(11, 47, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Aut omnis voluptatem qui. Doloribus et alias et.', NULL, 0, 'lawson.ziemann@schiller.com', '360.819.5076', 5341, 'https://facebook.com/josefina.von', 'https://twitter.com/homenick.candelario', 'https://linkedin.com/in/laron.kessler', 'https://instagram.com/wuckert.margarita', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(12, 59, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Exercitationem maxime ullam sed consectetur facere et consequatur. Est a ad corporis vitae quae ullam repudiandae. Laborum itaque voluptatem porro quas sapiente sint. Temporibus explicabo officiis optio inventore nesciunt ut.', NULL, 0, 'reymundo67@halvorson.com', '+16024316570', 2638, 'https://facebook.com/feil.kathleen', 'https://twitter.com/lawson82', 'https://linkedin.com/in/hermiston.lavinia', 'https://instagram.com/schinner.nicolette', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(13, 63, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Nostrum eius labore temporibus impedit labore. Qui labore temporibus officia sed qui explicabo. A consectetur in quo ad minima rerum vitae. Rem doloribus aliquam inventore unde et molestiae facilis sit.', NULL, 0, 'serenity.dare@smith.com', '845.894.1023', 7800, 'https://facebook.com/anabelle.hartmann', 'https://twitter.com/cletus21', 'https://linkedin.com/in/tboyle', 'https://instagram.com/carlotta.homenick', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(14, 68, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Molestiae amet eum sequi vitae aut dolor asperiores. Tempore id non aperiam aut voluptatem et excepturi. Vero omnis sit qui vel quasi et.', NULL, 0, 'considine.favian@haag.info', '+1-920-740-3724', 6938, 'https://facebook.com/therese37', 'https://twitter.com/haag.veda', 'https://linkedin.com/in/allan61', 'https://instagram.com/hermina06', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(15, 10, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Qui neque eos amet at in. Nisi vel quia minima impedit. Est quo nesciunt qui itaque omnis incidunt sed sed.', NULL, 0, 'howell.ethel@king.com', '(281) 257-6097', 8122, 'https://facebook.com/hagenes.paxton', 'https://twitter.com/elouise69', 'https://linkedin.com/in/ecollier', 'https://instagram.com/jadon37', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(16, 81, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Qui distinctio dolorum aspernatur repudiandae. Voluptatem earum occaecati culpa hic. Reprehenderit aliquid quis quis ducimus autem tempora consequatur. Sint maxime iusto qui iure quas.', NULL, 0, 'ujacobi@kuhn.com', '+18435447077', 663, 'https://facebook.com/xjerde', 'https://twitter.com/hickle.elvie', 'https://linkedin.com/in/gulgowski.precious', 'https://instagram.com/baumbach.bret', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(17, 66, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Ut excepturi asperiores quam. Culpa laborum aliquid quae. Error voluptates aut recusandae tempore eos quam. Ipsa qui eaque corporis omnis.', NULL, 0, 'leuschke.paris@corwin.com', '480-895-5997', 848, 'https://facebook.com/werner.will', 'https://twitter.com/isaias55', 'https://linkedin.com/in/theresa.tremblay', 'https://instagram.com/graciela.purdy', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(18, 15, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Ipsum aut exercitationem harum voluptas quos. Consequuntur facilis ipsum est laborum temporibus aut. Quos quos repudiandae minus. Laborum iure et totam sed. Vitae provident perferendis temporibus voluptas.', NULL, 0, 'treutel.brandyn@klocko.org', '832.543.6706', 6612, 'https://facebook.com/elisa87', 'https://twitter.com/ernser.myrtle', 'https://linkedin.com/in/cassandre73', 'https://instagram.com/garret.thiel', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(19, 97, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Deleniti quia consequuntur et sed sed ex reiciendis. Esse odit quia voluptas non. Officiis et a eius totam et. Ipsa atque mollitia similique eveniet ut pariatur illum.', NULL, 0, 'juliana97@weimann.com', '+1.918.912.8443', 1911, 'https://facebook.com/haag.kaelyn', 'https://twitter.com/lcrona', 'https://linkedin.com/in/bode.diego', 'https://instagram.com/hill.celestino', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(20, 39, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Deleniti aliquid molestiae nihil dignissimos. Rerum nesciunt expedita rem molestiae odio. Pariatur voluptatibus aliquam nobis eum ducimus asperiores dolor provident. Est sit laboriosam excepturi deleniti tenetur ipsa aliquam.', NULL, 0, 'alyce.dach@friesen.com', '+1-386-347-9081', 5764, 'https://facebook.com/wisoky.enola', 'https://twitter.com/karina58', 'https://linkedin.com/in/yundt.tate', 'https://instagram.com/kling.august', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(21, 85, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Minus saepe ea et explicabo quisquam dolorem. Distinctio natus laboriosam voluptatem beatae. Quidem voluptas vitae quos.', NULL, 0, 'wgleason@rodriguez.biz', '920.934.6752', 7883, 'https://facebook.com/bstoltenberg', 'https://twitter.com/reinger.ford', 'https://linkedin.com/in/chase.watsica', 'https://instagram.com/gottlieb.alexandro', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(22, 8, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Esse veritatis perspiciatis aspernatur laudantium non ut autem. Assumenda id iusto repellendus qui. Eius voluptas error amet dignissimos. Ipsa nisi odit accusantium maiores qui rerum.', NULL, 0, 'frederick.lemke@fadel.com', '+1.404.231.2321', 4089, 'https://facebook.com/oleffler', 'https://twitter.com/wintheiser.camille', 'https://linkedin.com/in/zschumm', 'https://instagram.com/kuhlman.mara', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(23, 9, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Nihil qui ut possimus et consequatur aliquam. Facilis quis vitae accusantium omnis. Vitae architecto et quasi ipsa quia.', NULL, 0, 'connelly.estell@mertz.biz', '856-409-8682', 9261, 'https://facebook.com/queenie.kautzer', 'https://twitter.com/altenwerth.emelie', 'https://linkedin.com/in/carolyn33', 'https://instagram.com/pgrant', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(24, 62, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Eos adipisci sunt ea temporibus dolorum voluptatem aliquam natus. Quae laboriosam saepe voluptatem eveniet quisquam commodi vel. Ab et inventore nostrum aliquam non doloribus amet.', NULL, 0, 'doyle.blanca@konopelski.com', '+1-283-991-2554', 255, 'https://facebook.com/cremin.damon', 'https://twitter.com/bradtke.weldon', 'https://linkedin.com/in/wilmer29', 'https://instagram.com/ahahn', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(25, 38, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Quia expedita ex recusandae commodi magni magni et velit. Quam a adipisci impedit sed optio. Eligendi necessitatibus quo omnis neque pariatur doloribus.', NULL, 0, 'griffin76@jacobs.biz', '1-424-427-0336', 1002, 'https://facebook.com/turcotte.sim', 'https://twitter.com/ernestina02', 'https://linkedin.com/in/wilford06', 'https://instagram.com/lorna18', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(26, 17, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Facere tenetur quis corrupti deserunt odit et ducimus. Voluptatem voluptatem sunt dolor nihil qui ullam quo in. Velit saepe adipisci molestias est ducimus sequi. Quam assumenda ea odio repellendus.', NULL, 0, 'justice.skiles@block.com', '1-769-691-7197', 9031, 'https://facebook.com/ffarrell', 'https://twitter.com/kub.lucinda', 'https://linkedin.com/in/rebeca.koepp', 'https://instagram.com/uward', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(27, 30, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Non rerum vero qui rerum unde. Quo et sunt molestiae nobis dignissimos earum molestiae. Ab eligendi eum provident quisquam voluptatem.', NULL, 0, 'kayleigh.okeefe@leffler.com', '+1 (628) 489-3102', 4121, 'https://facebook.com/skyla.monahan', 'https://twitter.com/khoppe', 'https://linkedin.com/in/ipfannerstill', 'https://instagram.com/kathlyn.cassin', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(28, 36, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Veritatis consequatur numquam mollitia ducimus facilis consectetur hic. Vel maxime autem aut. Optio quaerat sunt repudiandae quaerat error numquam perspiciatis.', NULL, 0, 'cjohnston@spinka.info', '(480) 631-3108', 8182, 'https://facebook.com/veum.jordy', 'https://twitter.com/altenwerth.ashleigh', 'https://linkedin.com/in/caleigh.gerlach', 'https://instagram.com/rtorphy', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(29, 73, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Accusantium ut aut aut illo enim ut est. Fugit voluptatem consequatur illo blanditiis maxime nihil. Vero voluptatum vitae est debitis eum a et. Porro placeat inventore facilis quisquam.', NULL, 0, 'marcos55@olson.info', '931.576.2037', 5131, 'https://facebook.com/hillary.ferry', 'https://twitter.com/amaya.boehm', 'https://linkedin.com/in/beatty.corrine', 'https://instagram.com/kaylah.johnson', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(30, 32, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Sit nam nemo voluptas veniam tempora. Optio omnis est distinctio dignissimos beatae. Iure sed ut nemo voluptate sequi voluptates iure labore. Quia vel minus nihil consequatur.', NULL, 0, 'pfeil@kemmer.net', '+16507312951', 4126, 'https://facebook.com/yjakubowski', 'https://twitter.com/jones.lilian', 'https://linkedin.com/in/kenneth96', 'https://instagram.com/llarkin', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(31, 31, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Enim minima mollitia delectus. Omnis magni officia nostrum et possimus quasi illum. Fugit est voluptatem ratione.', NULL, 0, 'leuschke.linwood@runolfsdottir.biz', '+13855821855', 4011, 'https://facebook.com/dean.reynolds', 'https://twitter.com/hlowe', 'https://linkedin.com/in/felicity80', 'https://instagram.com/haleigh.gottlieb', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(32, 78, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Suscipit aut itaque voluptatibus aut. Aut omnis qui cupiditate eaque natus voluptatem rerum. Quia corporis porro quo officia. Exercitationem inventore quis iusto praesentium.', NULL, 0, 'glover.keagan@greenholt.net', '1-515-526-6395', 8824, 'https://facebook.com/ekuhn', 'https://twitter.com/ckunze', 'https://linkedin.com/in/jany10', 'https://instagram.com/towne.sunny', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(33, 52, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Est in sit maiores at enim debitis ut. Veniam dolore assumenda dolore consequuntur.', NULL, 0, 'klittel@abbott.biz', '+1-575-979-6428', 5362, 'https://facebook.com/rubye.schneider', 'https://twitter.com/awolff', 'https://linkedin.com/in/marco.ebert', 'https://instagram.com/xwaters', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(34, 61, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Similique qui non quo nesciunt optio aut eaque error. Ut earum aut consequatur et. Porro ipsa ut modi occaecati et sit. Ipsam odio temporibus laboriosam dolores velit.', NULL, 0, 'brown.ella@jerde.info', '(580) 723-1145', 8549, 'https://facebook.com/christopher.okon', 'https://twitter.com/schimmel.jackeline', 'https://linkedin.com/in/lea30', 'https://instagram.com/adrienne.hegmann', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(35, 89, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Cumque corporis molestiae ad facilis repellat vitae et. Placeat dolorum odio sint voluptas autem dolore architecto nam. Et nulla nulla dignissimos suscipit occaecati dolore architecto.', NULL, 0, 'lee07@ullrich.com', '1-313-815-8897', 8837, 'https://facebook.com/skuvalis', 'https://twitter.com/heather92', 'https://linkedin.com/in/miller18', 'https://instagram.com/cora.pouros', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(36, 65, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Fuga amet aut laboriosam quae exercitationem. Qui voluptas quisquam adipisci ipsa mollitia necessitatibus qui officiis. Voluptatem aut et in itaque veritatis nostrum nulla. Quia et voluptatem reprehenderit laborum totam ut ut.', NULL, 0, 'sheldon29@tromp.info', '+19073026034', 7875, 'https://facebook.com/pablo.windler', 'https://twitter.com/loma.satterfield', 'https://linkedin.com/in/tfriesen', 'https://instagram.com/adams.augusta', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(37, 91, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Labore explicabo rerum cum natus ea quos. Praesentium et voluptatem mollitia quia eius enim. Quis sit non sunt minus omnis deserunt. Suscipit nam nesciunt sint et labore odit eum praesentium.', NULL, 0, 'ubernhard@toy.info', '+1-612-235-8308', 3565, 'https://facebook.com/dritchie', 'https://twitter.com/blanda.genesis', 'https://linkedin.com/in/wjacobi', 'https://instagram.com/marisa87', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(38, 64, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Ex aut esse nisi voluptatem impedit. Facere nemo explicabo laborum assumenda.', NULL, 0, 'cremin.roman@mitchell.org', '1-520-889-7600', 3292, 'https://facebook.com/robbie53', 'https://twitter.com/joelle90', 'https://linkedin.com/in/malinda75', 'https://instagram.com/ansley71', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(39, 21, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Consequatur quibusdam esse ut modi. Modi accusantium qui voluptatem quasi nesciunt aut. Voluptate officiis voluptas repudiandae dolor nemo laboriosam. Sit impedit repudiandae non sunt.', NULL, 0, 'frederick95@schowalter.info', '820-229-5474', 7481, 'https://facebook.com/rhirthe', 'https://twitter.com/simone97', 'https://linkedin.com/in/zemlak.edmond', 'https://instagram.com/fziemann', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(40, 49, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Alias voluptatem non quia eius enim esse. Blanditiis aperiam dolorem blanditiis perspiciatis dolore. Expedita ad sit fugit tempore.', NULL, 0, 'swiza@feil.biz', '+1-669-452-8701', 8885, 'https://facebook.com/renee26', 'https://twitter.com/uriel.beier', 'https://linkedin.com/in/osborne.langosh', 'https://instagram.com/edd29', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(41, 94, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Enim ad voluptate porro dignissimos aut minima quos. Ut rerum officia vero magnam. Excepturi nisi sit ipsum iusto sint nulla. In sit corrupti non aliquam nulla.', NULL, 0, 'kayli.lynch@ward.com', '959-509-4387', 7798, 'https://facebook.com/emilie.kub', 'https://twitter.com/okuneva.weston', 'https://linkedin.com/in/kailey.okeefe', 'https://instagram.com/christy22', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(42, 37, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Est numquam qui et distinctio. Enim temporibus enim at minus sint commodi aliquid. Earum omnis error rerum minus fugit in.', NULL, 0, 'ismael.toy@kassulke.com', '870-584-9223', 5878, 'https://facebook.com/gregorio.renner', 'https://twitter.com/adeline.wisoky', 'https://linkedin.com/in/hyatt.nicholaus', 'https://instagram.com/kertzmann.elenor', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(43, 4, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Reiciendis nihil vero exercitationem sint ea. Sit quae sunt assumenda sit enim dicta quia eum. Non sint vero aperiam ut mollitia commodi voluptatem. Debitis dolorem iusto sit ut soluta.', NULL, 0, 'richmond.feil@rath.com', '1-425-204-2619', 5088, 'https://facebook.com/daija78', 'https://twitter.com/graynor', 'https://linkedin.com/in/ward68', 'https://instagram.com/eryn02', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(44, 45, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Saepe dolores ut sunt optio nesciunt voluptas occaecati. Quo et placeat ipsum accusamus explicabo. Vel vitae eligendi quasi sunt vel. Voluptatum eveniet beatae vitae qui necessitatibus.', NULL, 0, 'cassin.whitney@hudson.org', '+12832147524', 8883, 'https://facebook.com/keely.okeefe', 'https://twitter.com/buck12', 'https://linkedin.com/in/wbeatty', 'https://instagram.com/lesch.german', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(45, 35, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Unde fugit occaecati vel nihil delectus itaque soluta et. Quo beatae ut et eligendi alias. Itaque sint quaerat perferendis id architecto. Error sunt molestias officiis.', NULL, 0, 'rice.kristy@mcglynn.com', '+1-351-567-6263', 1866, 'https://facebook.com/ibergstrom', 'https://twitter.com/delia.mayert', 'https://linkedin.com/in/lynn10', 'https://instagram.com/zoie44', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(46, 76, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Sed itaque in esse perferendis aut rerum dolore. Ut illum rerum omnis est eos. Id veritatis veniam natus cumque dolore. Sed aliquid sunt accusamus animi culpa. Qui ipsa dolores corporis nulla ea accusamus.', NULL, 0, 'meichmann@lemke.org', '+13362618140', 8886, 'https://facebook.com/mcclure.amari', 'https://twitter.com/ckshlerin', 'https://linkedin.com/in/donnelly.daisy', 'https://instagram.com/llakin', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(47, 92, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Nihil modi eos provident asperiores error est. Non minima voluptates tempore fugiat corporis debitis. Sit sit nostrum qui fugiat aut cupiditate.', NULL, 0, 'thill@kiehn.com', '(484) 850-0161', 4431, 'https://facebook.com/xfeest', 'https://twitter.com/vschuster', 'https://linkedin.com/in/considine.eli', 'https://instagram.com/alexandra.buckridge', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(48, 50, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Molestiae ducimus amet autem minus nemo. Ad sequi quibusdam consequatur distinctio. Voluptatem est ab a reiciendis asperiores voluptatum qui.', NULL, 0, 'deontae59@herman.net', '+1-712-316-8054', 1260, 'https://facebook.com/harold.barrows', 'https://twitter.com/tabernathy', 'https://linkedin.com/in/lucius56', 'https://instagram.com/kasey58', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(49, 3, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Excepturi qui voluptatem ea non ea. Facilis hic in tempora harum vitae quo. Et illo quia est dicta quis repellat voluptates et.', NULL, 0, 'allene53@goyette.com', '(909) 266-3834', 8988, 'https://facebook.com/ymcglynn', 'https://twitter.com/gibson.sebastian', 'https://linkedin.com/in/martin.turcotte', 'https://instagram.com/kristy.schuster', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(50, 79, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Odio vitae dolore debitis perferendis qui vel ducimus. Est magni possimus nesciunt et voluptas consectetur velit. Omnis similique debitis doloremque perspiciatis et reiciendis.', NULL, 0, 'baumbach.viva@walker.org', '580-252-3796', 199, 'https://facebook.com/dangelo61', 'https://twitter.com/genevieve.franecki', 'https://linkedin.com/in/howell.rosetta', 'https://instagram.com/abernathy.van', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(51, 13, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Molestiae autem odio esse tempora et. Vitae totam vero quis vitae cum. Ut dolor quidem architecto. Asperiores quisquam voluptatibus non suscipit sed hic fugiat.', NULL, 0, 'genoveva49@beahan.com', '1-934-663-2065', 8201, 'https://facebook.com/nwitting', 'https://twitter.com/johns.alvera', 'https://linkedin.com/in/fhoppe', 'https://instagram.com/armani50', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(52, 46, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Aut libero et dolores quidem. Sint ea accusamus distinctio iste. Aut doloremque consectetur earum sed.', NULL, 0, 'moen.ivory@littel.com', '1-978-217-4436', 6032, 'https://facebook.com/kaylin.kilback', 'https://twitter.com/bbernhard', 'https://linkedin.com/in/thompson.monty', 'https://instagram.com/mkuvalis', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(53, 75, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Error assumenda rerum placeat atque nostrum. Labore fuga omnis minus reprehenderit ducimus quibusdam sed vel. Quos vel vel doloribus sapiente.', NULL, 0, 'okeefe.rocio@walker.com', '432.668.3730', 3873, 'https://facebook.com/enola15', 'https://twitter.com/muller.victor', 'https://linkedin.com/in/bcrona', 'https://instagram.com/branson.lind', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(54, 43, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Reiciendis sint eaque qui. Debitis in sint illum cum dicta. Perferendis magnam nesciunt est cumque facilis. Et voluptatem dolorem quasi maxime tempora est.', NULL, 0, 'satterfield.brad@herzog.net', '248-949-6155', 3380, 'https://facebook.com/earl.ratke', 'https://twitter.com/justen74', 'https://linkedin.com/in/smitham.jaime', 'https://instagram.com/vicky94', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(55, 90, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'In maxime quisquam laboriosam aut eaque officia. Voluptatem laborum omnis doloribus sit officia fuga. Cupiditate quis recusandae modi commodi laudantium.', NULL, 0, 'margaret87@reinger.biz', '503.218.3821', 8038, 'https://facebook.com/bridgette.corkery', 'https://twitter.com/vivienne.auer', 'https://linkedin.com/in/graham.kendrick', 'https://instagram.com/elroy93', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(56, 23, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Rerum nihil molestias est soluta suscipit non sint. Qui voluptatem itaque ut possimus blanditiis officia voluptatem. Nihil eos sapiente nemo ea.', NULL, 0, 'king.sterling@stiedemann.net', '+1 (847) 903-3511', 9371, 'https://facebook.com/bahringer.seamus', 'https://twitter.com/shuels', 'https://linkedin.com/in/finn99', 'https://instagram.com/gerson.hills', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(57, 25, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Ab ullam nostrum deserunt in doloribus id voluptatibus. Veritatis debitis odio amet deserunt ea hic deserunt sed. Odio molestiae excepturi et quo. Corporis nihil qui id odit sequi est.', NULL, 0, 'flatley.marley@nader.info', '(617) 631-7251', 2633, 'https://facebook.com/adolphus82', 'https://twitter.com/schumm.columbus', 'https://linkedin.com/in/kub.tavares', 'https://instagram.com/deron65', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(58, 53, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Assumenda dolore dolorem quo alias expedita dolores dicta. Quo pariatur ut aut impedit laborum dolorem autem. Facere similique vel saepe occaecati. Et dolorem iste quo a sit vel.', NULL, 0, 'padberg.tommie@walker.com', '+1 (878) 399-7371', 2462, 'https://facebook.com/kiel.gibson', 'https://twitter.com/wilfredo.kerluke', 'https://linkedin.com/in/missouri.smith', 'https://instagram.com/jerad.mckenzie', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(59, 26, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Aperiam quis et ut sed sapiente. Recusandae reprehenderit quas sunt quia tempora et. Ad rem adipisci iusto eaque accusamus voluptatem. Ea fugit iste voluptate explicabo distinctio suscipit.', NULL, 0, 'stracke.justus@jones.biz', '231.533.5038', 1078, 'https://facebook.com/dillan.botsford', 'https://twitter.com/pwalter', 'https://linkedin.com/in/shanahan.daphne', 'https://instagram.com/hilda.barton', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(60, 101, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Expedita at nam harum sit laboriosam. Voluptatem sit ad ab dolorum.', NULL, 0, 'shana16@connelly.net', '323-560-4698', 668, 'https://facebook.com/ullrich.bertrand', 'https://twitter.com/ebernier', 'https://linkedin.com/in/prosacco.kathryne', 'https://instagram.com/orn.rodger', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(61, 20, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Aut vel voluptatum in veniam quia doloribus. Hic ratione laboriosam ipsam et ea quia. Debitis odio et consequatur dolorum facere ab. Et atque quo ut placeat.', NULL, 0, 'dwight24@armstrong.com', '+1-205-534-9195', 7435, 'https://facebook.com/wlehner', 'https://twitter.com/emil.berge', 'https://linkedin.com/in/schultz.noel', 'https://instagram.com/dejon90', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(62, 72, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'In cupiditate quo qui eum voluptas. Fuga qui inventore quas omnis voluptatem ea. Ut soluta quos accusamus quia quia laboriosam et ut. Laborum et ullam praesentium.', NULL, 0, 'furman.leffler@ryan.biz', '1-351-753-3171', 4819, 'https://facebook.com/wade.deckow', 'https://twitter.com/jammie94', 'https://linkedin.com/in/candelario.ankunding', 'https://instagram.com/kuhn.randal', '2025-02-27 21:15:35', '2025-02-27 21:15:35'),
(63, 57, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Repellendus maiores reprehenderit aut culpa sunt illo. Et magnam nihil porro. Minima voluptatibus consequatur laborum aut reiciendis.', NULL, 0, 'sylvester.ullrich@leannon.com', '(463) 319-1414', 8703, 'https://facebook.com/elouise.feeney', 'https://twitter.com/brittany.nolan', 'https://linkedin.com/in/vilma.halvorson', 'https://instagram.com/kutch.alda', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(64, 60, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Vitae debitis illum ut reiciendis sunt quia. Rerum aspernatur veritatis quaerat fugit optio aut. Necessitatibus sit ut voluptatem tempore. Iusto quis omnis accusantium saepe quos repellat error mollitia.', NULL, 0, 'alyson27@rutherford.com', '+15057666556', 3495, 'https://facebook.com/heathcote.ressie', 'https://twitter.com/stroman.marge', 'https://linkedin.com/in/deonte34', 'https://instagram.com/izemlak', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(65, 83, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Facilis recusandae est natus id et aut. Nulla sapiente deleniti et non repellendus eos. Deserunt odio velit et et sint dolorem ea. Qui consectetur tenetur voluptates facere ut sunt unde et.', NULL, 0, 'lucy18@veum.com', '916-871-1401', 8231, 'https://facebook.com/haylee72', 'https://twitter.com/mlind', 'https://linkedin.com/in/mario.terry', 'https://instagram.com/schroeder.houston', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(66, 41, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Minus neque vel sit. Quo sunt cum vel ducimus vero neque dolor. Laborum accusamus exercitationem recusandae. Ut adipisci velit tempora dolore. Nostrum et necessitatibus dicta et.', NULL, 0, 'baumbach.eudora@bosco.info', '1-445-795-0065', 8620, 'https://facebook.com/alden44', 'https://twitter.com/keegan.steuber', 'https://linkedin.com/in/elmer06', 'https://instagram.com/lkoss', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(67, 86, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Enim quaerat voluptatem eligendi quo impedit. Rerum minus quo nisi quam. Sunt eos accusamus aut maiores molestiae autem dolorem culpa.', NULL, 0, 'reece12@crooks.com', '+12349602308', 9983, 'https://facebook.com/itzel.gulgowski', 'https://twitter.com/florence22', 'https://linkedin.com/in/qlindgren', 'https://instagram.com/fharber', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(68, 67, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Maiores in iure sunt neque. Consequatur eaque necessitatibus reprehenderit qui veniam eveniet assumenda. A error quis perferendis quibusdam minus.', NULL, 0, 'ashlynn84@jaskolski.com', '+1-763-573-2785', 2592, 'https://facebook.com/gabriel31', 'https://twitter.com/pabbott', 'https://linkedin.com/in/tharber', 'https://instagram.com/grant.jadon', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(69, 77, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Ut rerum culpa ipsum. Nostrum ut quis magnam quo aliquam et numquam. Voluptatem repellat aliquid quas libero vitae quia fugiat.', NULL, 0, 'mbeier@hamill.com', '+1.540.414.0261', 7607, 'https://facebook.com/annabell55', 'https://twitter.com/reynold74', 'https://linkedin.com/in/jadyn86', 'https://instagram.com/hudson.alec', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(70, 33, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Odit optio earum quam eos quaerat cumque. Vero non magni voluptates numquam cum. Aut quis ipsum magnam enim.', NULL, 0, 'rosina39@schiller.com', '930.910.8166', 4052, 'https://facebook.com/rutherford.jake', 'https://twitter.com/lindsay95', 'https://linkedin.com/in/vita27', 'https://instagram.com/grimes.jo', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(71, 28, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Nesciunt occaecati aut magnam dolores tempora. Recusandae et ut nihil ratione quo mollitia. Est corrupti tenetur voluptas doloribus quas consequuntur et.', NULL, 0, 'yhand@ortiz.com', '(909) 867-4492', 9362, 'https://facebook.com/xwilderman', 'https://twitter.com/ronaldo60', 'https://linkedin.com/in/price.reba', 'https://instagram.com/elsie.pfeffer', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(72, 27, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Dolorem dolor beatae molestiae reiciendis autem consequuntur est. Fuga sequi sapiente non dolor aspernatur incidunt accusantium. Est optio architecto dignissimos. Deserunt et tempora nihil.', NULL, 0, 'mprohaska@tremblay.com', '701.358.9545', 2395, 'https://facebook.com/bauch.austen', 'https://twitter.com/asteuber', 'https://linkedin.com/in/alisha.stehr', 'https://instagram.com/champlin.weston', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(73, 24, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Voluptates sit sunt quisquam aut iste quisquam. Aut ut corporis porro.', NULL, 0, 'damore.guy@walter.com', '1-339-354-3297', 9116, 'https://facebook.com/ewilkinson', 'https://twitter.com/ijacobson', 'https://linkedin.com/in/ndaugherty', 'https://instagram.com/berta.stiedemann', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(74, 48, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Tempora qui ea culpa. Qui et officiis aperiam voluptatibus voluptatem deleniti. Unde itaque eveniet et eius soluta est vitae.', NULL, 0, 'nikko.schimmel@hagenes.org', '936.238.9589', 1708, 'https://facebook.com/hegmann.corine', 'https://twitter.com/moen.luz', 'https://linkedin.com/in/emohr', 'https://instagram.com/jannie56', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(75, 22, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Saepe et voluptate iure eligendi voluptatibus qui. Eum vero natus fuga libero exercitationem iure accusantium consequatur. Vel recusandae sunt nostrum et.', NULL, 0, 'allie11@welch.com', '(520) 230-6244', 3314, 'https://facebook.com/pkautzer', 'https://twitter.com/ebony.mayer', 'https://linkedin.com/in/fhickle', 'https://instagram.com/greg78', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(76, 70, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Dolores omnis alias laborum assumenda. Sed esse fugiat modi accusamus suscipit. Inventore facilis corporis nostrum ut. Reprehenderit aliquam expedita illum eveniet eum sit quo.', NULL, 0, 'ukrajcik@ortiz.com', '(318) 414-8788', 4390, 'https://facebook.com/lenore16', 'https://twitter.com/webster.wisoky', 'https://linkedin.com/in/jaime.quitzon', 'https://instagram.com/uabshire', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(77, 7, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Expedita molestiae vel dolores veritatis neque explicabo magnam. Non voluptates enim impedit dignissimos. Et quisquam qui nam id incidunt dolorum. Non ut quam odit quam sit voluptatem.', NULL, 0, 'salma.stracke@dicki.com', '(276) 351-1830', 1998, 'https://facebook.com/konopelski.lillian', 'https://twitter.com/christelle09', 'https://linkedin.com/in/mueller.arden', 'https://instagram.com/swalter', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(78, 98, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Perspiciatis ex ad accusantium sit. Ipsa mollitia et quibusdam sed vero maxime. Ducimus dolorem porro quibusdam unde.', NULL, 0, 'chad.wyman@schowalter.com', '650.468.0039', 1531, 'https://facebook.com/nblock', 'https://twitter.com/catherine00', 'https://linkedin.com/in/ekuvalis', 'https://instagram.com/tschowalter', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(79, 56, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Culpa atque et beatae ut ut. Tenetur alias soluta omnis fugit. Temporibus eveniet nobis debitis et.', NULL, 0, 'nellie.dare@fisher.info', '915-903-1400', 2057, 'https://facebook.com/aliya.spencer', 'https://twitter.com/doyle.alexane', 'https://linkedin.com/in/orn.turner', 'https://instagram.com/xkautzer', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(80, 96, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Non culpa nostrum veritatis sit consequatur non vero. Recusandae consequatur sit aperiam. Quos consectetur ratione placeat doloremque.', NULL, 0, 'kertzmann.clifford@boehm.biz', '+1-551-742-7634', 8187, 'https://facebook.com/brannon71', 'https://twitter.com/rpollich', 'https://linkedin.com/in/eleanora.wunsch', 'https://instagram.com/kroob', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(81, 69, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Ipsa ad consequatur reiciendis enim nostrum tempora. Facilis quo magni consequatur nihil repellat nihil. Quos distinctio sint modi rerum.', NULL, 0, 'spencer.jay@muller.org', '(360) 573-5854', 3269, 'https://facebook.com/turcotte.willow', 'https://twitter.com/anya76', 'https://linkedin.com/in/wbaumbach', 'https://instagram.com/nbashirian', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(82, 2, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Quasi eum nisi officia in quasi nostrum. Rem sequi repudiandae sint excepturi sint ab sapiente. Exercitationem ullam corporis occaecati deserunt et numquam. Et enim consectetur asperiores qui enim.', NULL, 0, 'ruthe.schimmel@wilkinson.net', '+14232401093', 4550, 'https://facebook.com/einar.mosciski', 'https://twitter.com/asipes', 'https://linkedin.com/in/tanya68', 'https://instagram.com/glen.wiegand', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(83, 55, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Animi nostrum rerum consequatur saepe repellat similique quo. Autem tempora culpa voluptate et rerum odit quibusdam itaque. Tempora eius totam voluptatem cumque deserunt et in quae. Et eos repellendus et voluptate sequi sunt.', NULL, 0, 'kwehner@turner.com', '458-323-6129', 8006, 'https://facebook.com/bailee.kuvalis', 'https://twitter.com/craig75', 'https://linkedin.com/in/torp.samara', 'https://instagram.com/zlangosh', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(84, 87, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Minima est dolores ipsa consectetur reprehenderit. Et temporibus asperiores dolor ullam quia sint. Itaque ut officia quia.', NULL, 0, 'grant.jessica@schneider.net', '1-347-248-3409', 3267, 'https://facebook.com/hlangworth', 'https://twitter.com/hazle.dicki', 'https://linkedin.com/in/reid.fisher', 'https://instagram.com/lexi.prohaska', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(85, 14, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Ipsum doloribus eveniet deleniti fugiat velit. Nesciunt neque ipsum ducimus eligendi voluptatem et ut. Iusto ab ipsum labore aut. Eos nostrum velit iste corrupti. Aut voluptas accusamus reprehenderit rerum.', NULL, 0, 'abbott.gerald@boehm.com', '+1-858-426-5731', 5758, 'https://facebook.com/laisha.lowe', 'https://twitter.com/keenan57', 'https://linkedin.com/in/dolly.feeney', 'https://instagram.com/mariane30', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(86, 100, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Rem eaque ratione quas aliquid. Aut dolor debitis et asperiores ab ducimus. Temporibus dolorem quidem non hic nihil laboriosam. Mollitia ratione quas magni velit sapiente placeat.', NULL, 0, 'billie.ruecker@ferry.com', '424.354.4205', 4338, 'https://facebook.com/marquardt.garrett', 'https://twitter.com/garth.hilpert', 'https://linkedin.com/in/kelvin.wiza', 'https://instagram.com/koelpin.hilma', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(87, 19, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Autem qui eos saepe laborum officiis consequatur consequatur. Cum accusamus repellendus id est. Exercitationem perspiciatis voluptatibus accusamus eaque tempore.', NULL, 0, 'vonrueden.jett@ryan.com', '+1.620.860.8091', 4749, 'https://facebook.com/delmer.donnelly', 'https://twitter.com/herzog.conrad', 'https://linkedin.com/in/cristal48', 'https://instagram.com/hstrosin', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(88, 6, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Non dolores voluptas aut qui molestiae nemo. Quia et dolores et at molestiae deleniti non. Nemo saepe non aut reprehenderit eaque. Et vitae voluptas ullam neque. Deserunt ipsam soluta deleniti rerum.', NULL, 0, 'randall03@orn.net', '364.449.9410', 4503, 'https://facebook.com/jessie38', 'https://twitter.com/oscar.schaefer', 'https://linkedin.com/in/pietro.wehner', 'https://instagram.com/bruen.emerson', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(89, 40, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Iusto inventore explicabo necessitatibus alias repellendus. Sunt magni iure magnam et animi in. Ut amet dolor dicta ipsa ratione saepe. Saepe et ducimus ut eos.', NULL, 0, 'rfay@lindgren.com', '352.619.1489', 277, 'https://facebook.com/damion.jenkins', 'https://twitter.com/valtenwerth', 'https://linkedin.com/in/kelsie48', 'https://instagram.com/henriette.robel', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(90, 95, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Voluptatem quo qui quis nisi. Et atque dignissimos voluptates incidunt enim impedit. Consequuntur delectus ab totam dolorem non et sint numquam. Ad et hic ut cumque placeat.', NULL, 0, 'edison66@pfannerstill.biz', '+1-951-688-6720', 7362, 'https://facebook.com/thad.kessler', 'https://twitter.com/kaelyn.dach', 'https://linkedin.com/in/kuvalis.simeon', 'https://instagram.com/witting.constance', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(91, 29, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Omnis dolorum sunt fuga iusto sint labore nemo. Reiciendis tempora vel et autem mollitia. Repudiandae molestiae explicabo perferendis veritatis aliquam quis blanditiis. Expedita et est ut voluptas praesentium.', NULL, 0, 'davon14@deckow.biz', '+1-781-845-3947', 350, 'https://facebook.com/sincere86', 'https://twitter.com/rogers.fisher', 'https://linkedin.com/in/tiara.kerluke', 'https://instagram.com/legros.sydni', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(92, 84, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Est sit cupiditate perferendis exercitationem consequatur dolores qui. Doloremque sequi est sequi aut et aut. Dolorem laborum minus velit debitis sit dolor odio.', NULL, 0, 'emerson.aufderhar@marvin.com', '+18317014998', 558, 'https://facebook.com/earl80', 'https://twitter.com/smitham.monica', 'https://linkedin.com/in/farrell.amelia', 'https://instagram.com/ora.cummings', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(93, 44, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Et non quia excepturi quas. Consequatur quos qui est ut qui totam. Enim quia non explicabo perferendis. Aut dignissimos itaque qui hic.', NULL, 0, 'braun.kelly@auer.net', '+19347060477', 3637, 'https://facebook.com/runolfsdottir.jaeden', 'https://twitter.com/brennan44', 'https://linkedin.com/in/nicolas14', 'https://instagram.com/pouros.myrtis', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(94, 74, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Delectus nesciunt doloremque ullam sed aut. Aut quae sit perspiciatis. Id et unde quas occaecati. Possimus eaque consequatur corrupti.', NULL, 0, 'schumm.rosalinda@olson.com', '(754) 891-1630', 2185, 'https://facebook.com/jaquelin21', 'https://twitter.com/aswift', 'https://linkedin.com/in/stoltenberg.evangeline', 'https://instagram.com/dwisoky', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(95, 5, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Quasi reprehenderit commodi tempora. Enim sit qui molestiae quasi et repudiandae. Sunt et est nobis earum.', NULL, 0, 'theaney@mayer.com', '+1 (847) 602-4753', 6568, 'https://facebook.com/prohaska.newton', 'https://twitter.com/carter.ephraim', 'https://linkedin.com/in/sauer.cydney', 'https://instagram.com/rebeca12', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(96, 93, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Saepe tenetur labore minima omnis ut in et consequatur. Dolorum velit in dicta est quae exercitationem. Est non dolor minus nulla impedit totam.', NULL, 0, 'winston.schmitt@veum.net', '224.599.5152', 2428, 'https://facebook.com/jacobs.jazmyn', 'https://twitter.com/reichert.alan', 'https://linkedin.com/in/gillian38', 'https://instagram.com/andreane64', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(97, 42, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Labore rem dolor eos quo. Doloribus et non voluptatem. Aut ut qui earum id. Facere placeat eum ut cupiditate.', NULL, 0, 'thiel.alford@schuppe.org', '1-912-655-7538', 1690, 'https://facebook.com/shaylee.hilpert', 'https://twitter.com/zieme.henri', 'https://linkedin.com/in/glowe', 'https://instagram.com/rhintz', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(98, 82, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Qui vero delectus est omnis asperiores doloribus numquam rem. Fugit autem nostrum explicabo ut architecto. Hic non totam harum quos.', NULL, 0, 'ziemann.clay@willms.com', '+1.860.278.2057', 7702, 'https://facebook.com/isadore.schroeder', 'https://twitter.com/gus.welch', 'https://linkedin.com/in/americo.lowe', 'https://instagram.com/nader.bill', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(99, 11, 'uploads/company_profile/', 'uploads/company_cover/', 'B2C', 'Aut quo distinctio ut aut magni amet. Eveniet velit illo ipsam voluptas. Velit rerum dolores delectus voluptas ut praesentium. Sit non consequatur rerum consectetur magnam inventore maxime dignissimos.', NULL, 0, 'jocelyn.little@romaguera.com', '+1-501-404-9388', 2097, 'https://facebook.com/hilma22', 'https://twitter.com/kayden18', 'https://linkedin.com/in/hilma.bergnaum', 'https://instagram.com/anita23', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(100, 99, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'At dolorem iste ea quisquam sunt sed aut. Ullam esse molestiae id quasi quis nemo enim. Aperiam est velit ea eaque magnam dolores ipsa voluptas.', NULL, 0, 'pstrosin@rippin.com', '520.216.8748', 6168, 'https://facebook.com/fnitzsche', 'https://twitter.com/frieda.reynolds', 'https://linkedin.com/in/kertzmann.santiago', 'https://instagram.com/effertz.tre', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(101, 54, 'uploads/company_profile/', 'uploads/company_cover/', 'Both', 'Ut fuga aut nemo dolorum voluptate nulla. Consequatur est quas id enim vel tenetur iusto eius. Aliquam deleniti consequuntur consequatur tempore adipisci ut adipisci molestiae.', NULL, 0, 'lwolff@langosh.com', '+1-312-320-7698', 8460, 'https://facebook.com/audrey.vandervort', 'https://twitter.com/nlegros', 'https://linkedin.com/in/xturcotte', 'https://instagram.com/easter.white', '2025-02-27 21:15:36', '2025-02-27 21:15:36'),
(102, 58, 'uploads/company_profile/', 'uploads/company_cover/', 'B2B', 'Repellat provident illo necessitatibus dolorum dolorum molestiae fuga numquam. Dolore cupiditate provident ut itaque ipsa sequi sint error. Sit numquam in quia odit.', NULL, 0, 'rusty.trantow@nitzsche.com', '559.688.8298', 5190, 'https://facebook.com/gutmann.michelle', 'https://twitter.com/bfadel', 'https://linkedin.com/in/hsmitham', 'https://instagram.com/gpagac', '2025-02-27 21:15:36', '2025-02-27 21:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `company_followers`
--

CREATE TABLE `company_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_ratings`
--

CREATE TABLE `company_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_ratings`
--

INSERT INTO `company_ratings` (`id`, `user_id`, `company_id`, `rating`, `feedback`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 'fsdfsdfsdfsdfsdf', '2025-02-23 22:42:27', '2025-02-23 22:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `feedback` text DEFAULT NULL,
  `is_feedback` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `rating`, `feedback`, `is_feedback`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'This Is Best Platform For Job Finding.', 1, '2025-02-23 22:39:29', '2025-02-23 22:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `job_category_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vacancy` int(11) NOT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `responsibility` text DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `experience` varchar(255) NOT NULL,
  `required_skills` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `company_industry` varchar(255) NOT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isFeatured` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `job_category_id`, `job_type_id`, `user_id`, `company_id`, `vacancy`, `salary`, `location`, `description`, `responsibility`, `qualifications`, `benefits`, `experience`, `required_skills`, `keywords`, `company_name`, `company_location`, `company_industry`, `company_website`, `status`, `created_at`, `updated_at`, `isFeatured`) VALUES
(2, 'Office Machine and Cash Servicer', 2, 2, 1, NULL, 6, NULL, 'Lake Serena', 'Consequatur dolorem et molestiae qui est. Pariatur minima at esse velit id accusantium. Delectus similique voluptates cupiditate iste recusandae. Maiores totam omnis commodi amet facere id at.\n\nSunt repellendus iste quae consectetur illum exercitationem. Ipsa alias sapiente architecto aperiam repellendus. Voluptas in temporibus consequuntur quia eaque repellendus enim. Quia nihil rerum quam sit.\n\nVoluptas dolorem unde eos ea voluptatem adipisci qui. Ab perspiciatis nihil incidunt. Eveniet ratione illo cumque expedita mollitia eum architecto.', 'Aspernatur qui doloremque maiores est. Error facilis aut modi ducimus voluptatibus voluptatem rerum. Similique dolores qui est id. In repudiandae eaque accusantium voluptatem.\n\nTenetur cum quibusdam velit assumenda officia illum. At qui dignissimos voluptas quia id qui impedit. Explicabo quis repellendus excepturi sint qui architecto id dicta. Praesentium a voluptas dolorem est quia praesentium.', 'Non et omnis quis ut vitae. Et eaque sed modi cumque nobis cumque dicta odit. Iusto ducimus atque aperiam. Autem sequi nisi est velit.\n\nQuidem recusandae est incidunt placeat veritatis earum voluptatum. Ducimus officia aut assumenda et illum cumque. Maxime consequatur quo quae qui ut magni.', NULL, '7', NULL, NULL, 'Douglas, Barton and Ebert', '137 Arturo Road Apt. 834\nPort Jenifermouth, RI 79822-6298', 'Prosacco-Yost', 'http://www.schowalter.com/asperiores-temporibus-animi-dolor-quo-provident', 1, '2025-01-31 23:29:51', '2025-01-31 23:29:51', 1),
(3, 'Office Clerk', 3, 3, 1, NULL, 1, NULL, 'West Timmothy', 'Perferendis ipsa eligendi eum cupiditate et veniam. Modi omnis minima quas voluptas. Non rem ipsum mollitia animi qui est sit. Tenetur magnam et quaerat maxime voluptates nam.\n\nEveniet eum officiis accusantium et facere voluptatem. Sed fuga voluptatibus ipsam aut quae fugiat. Nisi minima eos quia enim et in est.\n\nQui error eos sapiente explicabo maxime. Laudantium qui vel quod et in. Vel dolor odit maiores. Voluptas commodi tempore labore pariatur porro autem quo laborum. Perferendis ipsa in voluptatem nisi veniam in molestiae.', 'Sunt doloremque dolore qui eligendi. Eveniet consequatur dignissimos odio.\n\nEaque numquam qui nemo repellendus ut quas similique. Molestiae repellendus tenetur qui quas molestiae dignissimos. Quis rerum temporibus ipsum libero perferendis.', 'Animi et doloremque libero velit omnis saepe. Quia consequatur molestiae consectetur facilis facilis minima. Velit perspiciatis fuga voluptatem.\n\nRerum molestias expedita sed labore. Autem fugit cupiditate non saepe perspiciatis nam recusandae.', NULL, '6', NULL, NULL, 'Padberg, Aufderhar and Rau', '59207 Greenfelder Throughway\nLadariusmouth, PA 96413', 'Kuphal and Sons', 'http://www.glover.com/dolores-illum-est-ipsam-rem.html', 1, '2025-01-31 23:29:51', '2025-01-31 23:29:51', 0),
(4, 'Sound Engineering Technician', 2, 1, 1, NULL, 4, NULL, 'West Alphonsoville', 'Dignissimos magnam asperiores iure ab. Quos illum officia laboriosam repudiandae aperiam neque nobis et. Ut voluptas expedita dolorem nihil.\n\nQuia harum dolor sed ullam deleniti. Vel qui itaque vel. Maiores at similique minus alias nihil quis.\n\nNihil consequatur rerum adipisci voluptatibus. Nulla vitae sint sit at et. Odio assumenda dolor et ducimus. Et facere vero ut fugit quam.', 'Facere omnis repellendus explicabo sit doloremque iusto. Cum esse assumenda maiores sit. Est dicta illum dolores id. Debitis vitae quidem odio explicabo quidem iure.\n\nDolorem vitae quam aut maiores iusto qui. Eligendi voluptatem tempore quae autem adipisci ipsa aut vero. Atque voluptas pariatur et mollitia in est. Molestias consectetur excepturi aliquam dolor.', 'Ullam vel laborum praesentium fugit laudantium. Ea aut qui qui repellendus. Expedita voluptates sint qui alias et nihil.\n\nMolestiae asperiores voluptate asperiores unde. Qui qui et nam dolor. Atque ducimus repellat quod et culpa ipsam.', NULL, '3', NULL, NULL, 'Lueilwitz Group', '341 John Stravenue Suite 472\nSouth Hortense, NE 19465-2270', 'Crooks Inc', 'http://schowalter.com/', 1, '2025-01-31 23:29:51', '2025-01-31 23:29:51', 0),
(5, 'Letterpress Setters Operator', 1, 4, 1, NULL, 4, NULL, 'Whitechester', 'Qui vel accusamus nulla et. Voluptatem et aut sint aut. Accusantium qui eos dolor deserunt maxime.\n\nBlanditiis unde nam amet quisquam voluptatem. Molestiae vitae sequi voluptatem consequuntur accusamus ad. Rem totam nesciunt autem architecto.\n\nVero nostrum voluptatem beatae. Nulla voluptatem eum debitis. Eligendi consectetur qui quia voluptatem. Nam quaerat explicabo occaecati.', 'Maiores voluptas provident corporis fugiat aliquam. Distinctio accusamus sit dolorem nemo. Id officiis facilis vitae possimus et saepe.\n\nRecusandae aliquid dolores velit nam. Necessitatibus blanditiis iure neque aperiam blanditiis. Nobis qui ipsum harum mollitia expedita. Voluptatem atque voluptas doloribus dolores aut molestias et.', 'Aperiam qui consectetur repellat tempore magni. Sint reiciendis laboriosam eos sit. Delectus rem dolores ut dolor cupiditate velit ipsam. Aut rerum sed voluptatibus voluptatem aspernatur aliquid.\n\nEt doloribus nobis eum possimus. Nesciunt libero odit voluptatibus adipisci et. Eum praesentium alias facilis asperiores est. Sit et et ut possimus molestias et excepturi voluptatem.', NULL, '9', NULL, NULL, 'Satterfield, Nitzsche and Cronin', '6475 Victor Courts Suite 193\nWest Krystel, DE 25690', 'Hermiston Inc', 'http://mante.com/rem-recusandae-tenetur-amet-enim-deleniti', 1, '2025-01-31 23:29:51', '2025-01-31 23:29:51', 0),
(6, 'Forestry Conservation Science Teacher', 2, 1, 1, NULL, 3, NULL, 'North Kentonview', 'Ut officia deserunt consequatur provident ab. Nam temporibus odio sint dolores quas blanditiis beatae. Voluptas nostrum ea et aut repudiandae vero. Fugit labore est ut et et.\n\nMinus dolor laboriosam dolorum consequatur pariatur sit nostrum veniam. Dignissimos possimus qui consequatur voluptas quasi numquam tempore. Error quos sunt nobis quasi.\n\nRatione molestiae dolorem excepturi voluptas non enim. Soluta minima vitae tempora. Et non magni vel.', 'Molestias provident consequuntur odit praesentium praesentium impedit libero dolore. Quis consectetur dolore dolorem exercitationem. Maxime placeat minus delectus veritatis explicabo. Voluptatem ut rerum quis totam.\n\nSed sunt nostrum voluptatibus. Voluptatem facere similique id excepturi. Harum impedit rerum et temporibus vero nemo aut beatae.', 'Explicabo quia ut nam expedita. Voluptatum assumenda non non esse. Ipsum rem sunt natus ullam omnis voluptatibus laborum. Sunt accusantium in autem ut quod neque qui.\n\nMinima error recusandae dolor. Rerum enim dicta unde omnis. Commodi occaecati incidunt et accusantium. Qui suscipit quae cumque.', NULL, '6', NULL, NULL, 'Steuber Group', '64659 Charley Drive\nNorth Napoleonmouth, CA 83526', 'Kilback, Bechtelar and Ryan', 'http://bosco.net/', 1, '2025-01-31 23:29:51', '2025-01-31 23:29:51', 0),
(7, 'Private Sector Executive', 4, 1, 2, NULL, 7, NULL, 'Kundemouth', 'Et quibusdam facilis enim. Alias deserunt voluptas consectetur accusamus tempora est tempore voluptas. Non inventore animi repudiandae occaecati.\n\nFugit nihil autem et mollitia. A ipsam est est fuga aperiam. Sed odio velit nihil quaerat enim.\n\nSit error repudiandae id omnis consequatur recusandae. Aperiam rerum eum aut maxime quam voluptatum.', 'Qui dicta officia in velit. Aut sequi sed dignissimos tenetur distinctio architecto dolores.\n\nAperiam consequatur rerum non nulla fugit. Quo dolor fugit aut fugiat.', 'Pariatur nam nesciunt repellat voluptates esse quasi. Dicta quis libero sed libero sed sed omnis.\n\nVel corrupti quod nihil voluptas. Ut exercitationem et tempora ipsum nihil. Voluptates temporibus aspernatur molestias incidunt. Repudiandae ea facilis quae officiis.', NULL, '10', NULL, NULL, 'Kuhn-Brekke', '6610 Frederique Trail Suite 339\nEast Josefinastad, ME 81154', 'Kuhn-Turner', 'http://yundt.com/quisquam-enim-et-quasi-saepe-et-rerum-ducimus', 1, '2025-01-31 23:31:17', '2025-01-31 23:31:17', 1),
(8, 'Composer', 3, 2, 2, NULL, 7, NULL, 'Port Rosalee', 'Minima placeat necessitatibus id eos ut magnam delectus. Omnis voluptatem et reprehenderit. Officiis est consequuntur illum qui perspiciatis. Illum culpa aut molestias quia dignissimos.\n\nDolores ipsum minus voluptatibus numquam eum aut ut. Animi vel eum aliquam iste. Reprehenderit minus excepturi est. Aut voluptates perferendis quis quos.\n\nProvident quidem voluptatem vel sed exercitationem. Deserunt voluptatem architecto autem facilis ipsum aliquid aut unde. Fuga possimus reiciendis beatae voluptatem dignissimos aut. Maiores eaque excepturi quidem minima quidem odit eligendi. Occaecati tenetur in dolores.', 'Consequatur deleniti autem rerum officia. Quis at nulla et ratione. Aliquam rerum libero rerum reprehenderit dolore hic.\n\nVoluptas quibusdam voluptas minus aut. Molestiae commodi voluptas doloribus at incidunt provident quia. Odio et quos sed ducimus temporibus officia.', 'A quam cupiditate dolorem architecto dicta expedita. Enim perspiciatis commodi sed sint distinctio ut in. Doloribus cupiditate qui dolorem praesentium architecto et repellat non.\n\nSed aut atque quia cum aut. Non quidem ut mollitia reiciendis consequatur consequatur quaerat. Quam dolores illo iure qui deleniti. Qui illo aut qui.', NULL, '8', NULL, NULL, 'Runolfsdottir, Lakin and Thompson', '3557 Hadley Track\nSanfordville, DE 73797-3148', 'McCullough Ltd', 'http://kautzer.biz/', 1, '2025-01-31 23:31:17', '2025-01-31 23:31:17', 0),
(9, 'Materials Inspector', 2, 1, 2, NULL, 1, NULL, 'New Markusburgh', 'Sunt quasi exercitationem quo rerum deserunt quos. Esse voluptas blanditiis labore eaque omnis quasi. Quam natus possimus tenetur quae voluptatibus. Laudantium harum in ut id sed.\n\nVoluptatem nam doloremque non assumenda. Eaque porro natus quia voluptate omnis nesciunt omnis. Unde cumque dolorem commodi nihil. Est enim animi aut id deserunt aut culpa.\n\nEt eos ipsam non sunt voluptate. Perferendis in asperiores quam eveniet voluptatem et ipsum enim. Sint quos qui eaque beatae qui. Quidem laudantium neque et nihil quo.', 'Et accusamus cupiditate id cum error ratione provident. Id temporibus accusamus aut magni pariatur occaecati laudantium.\n\nModi est qui autem deleniti voluptas mollitia. Sunt accusantium quaerat exercitationem tempore. Et repellendus ut repellat vero molestiae quam saepe.', 'Assumenda est sit nihil voluptatem culpa non. Inventore quam enim veniam veniam amet. Sunt quasi laborum iste quasi.\n\nMaxime ipsum rerum magnam ut est totam ducimus. Ut illum molestias eos quo modi ut. Et animi modi rerum reiciendis aut culpa et.', NULL, '2', NULL, NULL, 'Ortiz-Abernathy', '554 Cronin Garden Apt. 292\nAlbaton, NY 30792-7982', 'Thiel-Reinger', 'http://schumm.org/rerum-a-voluptatibus-provident-natus-et', 1, '2025-01-31 23:31:17', '2025-01-31 23:31:17', 1),
(10, 'Coroner', 5, 5, 2, NULL, 6, NULL, 'South Pearline', 'Eum sit consequatur dolore. Magni modi deleniti repudiandae consequatur tempore. Cupiditate incidunt itaque ducimus et possimus.\n\nBlanditiis ut delectus suscipit voluptatibus. Aut repellat ut nobis ut tempore in exercitationem. Est neque quo minus omnis doloribus consectetur consequuntur.\n\nSunt a omnis excepturi est. Velit architecto velit fugit sed. Ut sed qui quod consectetur. Pariatur consequatur saepe dolor neque eum ea culpa.', 'Minus sit sequi adipisci. Aut non nemo dolorum architecto et quis quam et. In omnis et officia.\n\nQui cumque eum eum facilis accusantium omnis. Vel est debitis earum enim nostrum nesciunt quas consequatur. Delectus ut doloribus at cumque animi molestiae beatae.', 'Voluptatem atque excepturi quis et accusantium. Et enim omnis sapiente quidem quasi. Enim provident officia vitae id eum placeat ut quibusdam. Fuga ab molestias corporis id saepe temporibus.\n\nCommodi sunt molestiae et. Et voluptatum illo sequi fugiat aperiam nam sint. Velit culpa sed dolor nihil non sapiente. Minus et et officiis aliquid non voluptas eos itaque. Velit rerum harum sunt beatae.', NULL, '5', NULL, NULL, 'Ernser Ltd', '190 Greenfelder Lane\nBeerstad, CO 34301-1980', 'Pollich-Rippin', 'http://bins.biz/ad-possimus-vitae-ad-voluptatibus-pariatur', 1, '2025-01-31 23:31:17', '2025-01-31 23:31:17', 0),
(11, 'Camera Repairer', 5, 5, 2, NULL, 1, NULL, 'Anabelleshire', 'Officia ad tenetur voluptatem rerum. Consequatur placeat itaque dolor accusamus nam quidem. Iusto repellendus asperiores fugit ad.\n\nPerspiciatis eveniet accusantium vel quas voluptatibus ipsum in minus. Deleniti voluptas cumque ipsum nam. Temporibus quisquam nisi et quia quo.\n\nNumquam quidem ea consequatur porro accusamus culpa. Delectus fugit perspiciatis qui voluptatem. Sapiente culpa dolorem cupiditate minus distinctio omnis doloribus. A vero et et velit optio omnis.', 'Ipsam suscipit ullam consequatur vel et. Provident minus voluptatem voluptatem magni ab voluptatem. In id placeat eos qui distinctio quis sequi. Et aut et assumenda sunt aut doloremque voluptatem. Ipsa ipsam et ducimus et fugit.\n\nEst cum rerum aut nobis totam qui qui. Earum quis error ad blanditiis consectetur ea sed repudiandae. Accusamus eos facere explicabo odit nam suscipit. Provident consequuntur sequi et velit.', 'Vitae iusto et rem. Quis doloremque omnis beatae officiis unde perspiciatis aut. Et architecto quo occaecati quo earum quae sunt. Magnam voluptate aut minus qui ea est praesentium.\n\nEum ut aliquam sapiente dignissimos quo iusto cupiditate. Iure in quos deleniti minima earum ut placeat. Explicabo veritatis veritatis numquam sequi. Repellendus minima libero doloremque consequuntur.', NULL, '10', NULL, NULL, 'Pagac PLC', '929 Jerde Isle Apt. 108\nEast Georgianna, SD 60796', 'Stracke, Rice and Medhurst', 'http://www.simonis.org/repudiandae-vitae-sint-est-quibusdam-blanditiis-harum', 1, '2025-01-31 23:31:17', '2025-01-31 23:31:17', 0),
(12, 'Node.js Developer', 1, 1, 1, NULL, 1, '4 lac', 'Surart', 'We are seeking a talented PHP Developer to create dynamic and user-friendly applications. The role involves backend API integrations, database management, and contributing to a collaborative development environment.', 'Design and maintain efficient web applications.\r\nCollaborate with frontend teams for seamless integration.\r\nImplement and maintain secure coding practices.', 'Design and maintain efficient web applications.\r\nOptimize database queries and performance.', 'Design and maintain efficient web applications.\r\nOptimize database queries and performance.\r\nCollaborate with frontend teams for seamless integration.\r\nImplement and maintain secure coding practices.\r\nStay updated with industry trends and tools.', '2-years', NULL, 'Node.js', 'Ak Developer', 'Surat', 'It Development', 'http://ak.com', 1, '2025-01-31 23:47:12', '2025-01-31 23:47:12', 0),
(13, 'Web Developer', 1, 1, 4, NULL, 4, '4 lac', 'Surart', 'Best jobs for you.', '', '', '', '', 'Html, css', '', 'Ak Developer', 'Surat', '', '', 1, '2025-02-02 22:12:22', '2025-02-02 22:12:22', 0),
(14, 'Ux/Ui Design Developer', 1, 1, NULL, 1, 2, '4 lac', 'Surat', 'This is best opportunities for you.', '', '', '', '2-years', 'Html, css, javascript, figma', 'Ux/Ui, Design', 'Ak Developer', 'Surat', 'It Development', '1', 1, '2025-02-03 21:53:14', '2025-02-03 22:42:28', 0),
(15, 'Node Js Developer', 1, 5, NULL, 1, 3, '4 lac', 'Sfgsfdgsg', 'Sdgsdgsdgsdgsg', '', '', '', '', 'Ggsdfgsdgsdg', '', 'Ak Developer', 'Surat', '', '', 1, '2025-02-04 21:56:25', '2025-02-04 22:00:40', 0),
(16, 'Flutter Developer', 1, 5, NULL, 1, 4, '2 lac', 'Asfgsdfgsg', 'Ryertertert', '', '', '', '', 'Eeytyerye', '', 'Ertertert', 'Ertertertert', '', '', 1, '2025-02-04 21:56:49', '2025-02-04 22:00:10', 0),
(17, 'Digital Marketing', 3, 1, NULL, 1, 5, '3 lac', 'Surart', 'Dfgdfgdfg', '', '', '', '', 'Dhdfgdfg', '', 'Dfgdfgdfg', 'Dfggdfgdfg', '', '', 1, '2025-02-04 21:57:12', '2025-02-04 21:59:56', 0),
(18, 'Sales Markter', 4, 2, NULL, 1, 5, NULL, 'Dfgdfgdgdfgdfg', 'Fgdfgdfgdg', '', '', '', '', 'Dfdfgdfdfgdfgd', '', 'Dfgdfdd', 'Dfgdfgdg', '', '', 1, '2025-02-04 21:57:31', '2025-02-04 21:59:38', 0),
(19, 'Web Developer', 1, 2, NULL, 1, 5, NULL, 'Fbdfgdfgdfg', 'Dfgdfgdf', '', '', '', '', 'Dfgdfgfgdfgdfg', '', 'Dfgdfgdfg', 'Dfgdfgdfg', '', '', 1, '2025-02-04 21:57:46', '2025-02-04 21:59:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `poster_type` varchar(255) DEFAULT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`id`, `job_id`, `user_id`, `employer_id`, `company_id`, `poster_type`, `applied_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, 4, 1, NULL, NULL, '2025-02-02 22:13:56', 'pending', '2025-02-02 22:13:56', '2025-02-02 22:13:56'),
(2, 13, 1, 4, NULL, NULL, '2025-02-02 22:16:27', 'pending', '2025-02-02 22:16:27', '2025-02-02 22:16:27'),
(3, 19, 1, 1, NULL, NULL, '2025-02-05 04:16:34', 'accepted', '2025-02-04 22:01:36', '2025-02-04 22:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'It & Development', 1, '2025-01-31 23:26:52', '2025-01-31 23:26:52'),
(2, 'Engineering', 1, '2025-01-31 23:26:52', '2025-01-31 23:26:52'),
(3, 'Marketing', 1, '2025-01-31 23:26:52', '2025-01-31 23:26:52'),
(4, 'Sales', 1, '2025-01-31 23:26:52', '2025-01-31 23:26:52'),
(5, 'Design & Creative', 1, '2025-01-31 23:26:52', '2025-01-31 23:26:52'),
(6, 'Healthcare & Medical', 1, '2025-01-31 23:39:06', '2025-01-31 23:39:06'),
(7, 'Education', 1, '2025-01-31 23:39:06', '2025-01-31 23:39:06'),
(8, 'Finance', 1, '2025-01-31 23:39:06', '2025-01-31 23:39:06'),
(9, 'earum', 1, '2025-02-12 21:22:28', '2025-02-12 21:22:28'),
(10, 'incidunt', 1, '2025-02-12 21:22:29', '2025-02-12 21:22:29'),
(11, 'eos', 1, '2025-02-12 21:22:29', '2025-02-12 21:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `job_experience`
--

CREATE TABLE `job_experience` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `experience` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_saved`
--

CREATE TABLE `job_saved` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `type_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 1, '2025-01-31 23:27:07', '2025-01-31 23:27:07'),
(2, 'Part Time', 1, '2025-01-31 23:27:07', '2025-01-31 23:27:07'),
(3, 'Internship', 1, '2025-01-31 23:27:07', '2025-01-31 23:27:07'),
(4, 'Remote', 1, '2025-01-31 23:27:07', '2025-01-31 23:27:07'),
(5, 'Freelancer', 1, '2025-01-31 23:27:07', '2025-01-31 23:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_01_21_093325_create_user_details_table', 1),
(3, '2025_01_22_064757_create_job_categories_table', 1),
(4, '2025_01_22_064810_create_job_types_table', 1),
(5, '2025_01_22_064835_create_jobs_table', 1),
(6, '2025_01_22_095708_alter_jobs_table', 1),
(7, '2025_01_22_154808_create_password_resets_table', 1),
(8, '2025_01_23_131112_alter_jobs_table', 1),
(13, '2025_01_25_142721_create_job_application_table', 2),
(14, '2025_01_26_082512_create_job_saved_table', 2),
(15, '2025_01_28_164800_create_feedbacks_table', 2),
(16, '2025_01_28_173039_add_is_feedback_to_feedbacks_table', 2),
(17, '2025_02_01_181149_create_companies_table', 2),
(18, '2025_02_02_153521_alter_jobs_table', 2),
(19, '2025_02_02_182628_make_user_id_nullable_in_jobs_table', 2),
(20, '2025_02_04_135339_add_status_to_job_application_table', 3),
(21, '2025_02_05_145447_create_company_details_table', 4),
(22, '2025_02_11_025041_add_headquarters_and_is_slider_to_company_details_table', 5),
(23, '2025_02_17_031244_create_company_followers_table', 6),
(24, '2025_02_17_035618_create_company_followers_table', 7),
(25, '2025_02_17_170643_create_company_ratings_table', 8),
(26, '2025_02_17_193025_create_admins_table', 8),
(27, '2025_02_17_201106_update_admins_table', 8),
(28, '2025_02_23_100729_create_job_experience_table', 9),
(29, '2025_02_23_180901_add_profile_img_to_admins_table', 9),
(30, '2025_02_25_144939_add_google_id_to_users_table', 10),
(31, '2025_02_25_182039_update_users_table_password_nullable', 10),
(32, '2025_02_26_154252_add_github_id_to_users_table', 10),
(33, '2025_03_02_143347_add_poster_type_to_job_applications', 11),
(34, '2025_03_02_143733_add_company_id_to_job_application', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `otp`, `created_at`) VALUES
(2, 'pv.thummar@gmail.com', '403133', '2025-02-02 22:09:39'),
(3, 'malaviya@gmail.com', '184930', '2025-02-11 21:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `github_id` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `email`, `email_verified_at`, `password`, `google_id`, `github_id`, `mobile_number`, `designation`, `bio`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hariyani Akshay', 'akshay007@gmail.com', NULL, '$2y$12$HGqlumBi3Dwv5lFsksAY6O.1ZPqUnS3.CLSNSUctOpRlpGYTZ/PUy', NULL, NULL, '7575252866', 'Full Stack Developer', 'I Am Professional Full Stack Web Developer.', 'profile_image/1-1738385353.jpeg', NULL, '2025-01-31 23:18:07', '2025-01-31 23:18:07'),
(2, 'Prince Dodiya', 'prince@gmail.com', NULL, '$2y$12$kNTt7O2kNwnhsMpYlSE6d.zaYHvx1z0mg6W3f4iLcbNNR.sRTt4eS', NULL, NULL, '9925268365', 'Web Designer', 'I Good Experince In Web Designing.', 'profile_image/2-1738386107.webp', NULL, '2025-01-31 23:30:50', '2025-01-31 23:30:50'),
(3, 'adesh spara', 'adeshsapra07@gmail.com', NULL, '$2y$12$rUMLwSMCnC8wtsvaJ56/xuuKq3iq7iTLsiMnBF1G7y/LQvyXR0TtS', NULL, NULL, '9724564357', NULL, NULL, NULL, NULL, '2025-01-31 23:34:02', '2025-01-31 23:35:26'),
(4, 'paras sir', 'pv.thummar@gmail.com', NULL, '$2y$12$7mlyL1WK49abyCUnlI.tFOkJk1CN00zP3Nf1zWBcZ24FtQ70RDdxC', NULL, NULL, '9727438954', NULL, NULL, NULL, NULL, '2025-02-02 22:08:13', '2025-02-02 22:08:13'),
(10, 'adesh', 'itsadesh17@gmail.com', NULL, '$2y$12$ym5JxOukOkWsI6BJuE4AK.ZaSQUS5yFl5OEmyiSShRlSbpd8og5s.', '109446849631041125142', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLNItTJVTX8YcewNQlpIcN6UtiZIuxUOlluBh9VhOckI2cr8g=s96-c', NULL, '2025-02-27 21:58:32', '2025-02-27 21:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `graduation_year` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `degree`, `university`, `graduation_year`, `city`, `state`, `skills`, `resume`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bechelor Of Computer Application', 'Kamani Science Collage', 2025, 'Amreli', 'Gujrat', 'Html, Css, Javascript, Php, Laravel Framework', 'jobHierance/resumes/1-1738385459.pdf', '2025-01-31 23:20:32', '2025-01-31 23:23:14'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2-1738386176.pdf', '2025-01-31 23:32:56', '2025-01-31 23:32:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_c_email_unique` (`c_email`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_details_company_id_foreign` (`company_id`);

--
-- Indexes for table `company_followers`
--
ALTER TABLE `company_followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_followers_user_id_company_id_unique` (`user_id`,`company_id`),
  ADD KEY `company_followers_company_id_foreign` (`company_id`);

--
-- Indexes for table `company_ratings`
--
ALTER TABLE `company_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_ratings_user_id_company_id_unique` (`user_id`,`company_id`),
  ADD KEY `company_ratings_company_id_foreign` (`company_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_job_category_id_foreign` (`job_category_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`),
  ADD KEY `jobs_company_id_foreign` (`company_id`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_application_job_id_foreign` (`job_id`),
  ADD KEY `job_application_user_id_foreign` (`user_id`),
  ADD KEY `job_application_employer_id_foreign` (`employer_id`),
  ADD KEY `job_application_company_id_foreign` (`company_id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_experience`
--
ALTER TABLE `job_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_saved`
--
ALTER TABLE `job_saved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_saved_job_id_foreign` (`job_id`),
  ADD KEY `job_saved_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_number_unique` (`mobile_number`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `company_followers`
--
ALTER TABLE `company_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_ratings`
--
ALTER TABLE `company_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_experience`
--
ALTER TABLE `job_experience`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_saved`
--
ALTER TABLE `job_saved`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `company_details_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_followers`
--
ALTER TABLE `company_followers`
  ADD CONSTRAINT `company_followers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_ratings`
--
ALTER TABLE `company_ratings`
  ADD CONSTRAINT `company_ratings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_job_category_id_foreign` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_application_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_application_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_application_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_saved`
--
ALTER TABLE `job_saved`
  ADD CONSTRAINT `job_saved_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_saved_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
