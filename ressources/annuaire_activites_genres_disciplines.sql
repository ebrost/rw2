-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 11 Décembre 2012 à 12:09
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `baseric`
--

-- --------------------------------------------------------

--
-- Structure de la table `annuaire_activites_genres_disciplines`
--

CREATE TABLE IF NOT EXISTS `annuaire_activites_genres_disciplines` (
  `activite_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `genre_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `discipline_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  KEY `genre` (`genre_id`),
  KEY `discipline` (`discipline_id`),
  KEY `activite` (`activite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `annuaire_activites_genres_disciplines`
--

INSERT INTO `annuaire_activites_genres_disciplines` (`activite_id`, `genre_id`, `discipline_id`) VALUES
('01', '61', ''),
('01', '62', ''),
('01', '63', ''),
('2001', '610116', ''),
('2001', '610104', ''),
('2001', '610115', ''),
('2002', '610102', ''),
('2002', '6101', ''),
('2002', '610101', ''),
('01', '610106', ''),
('01', '610108', ''),
('01', '610109', ''),
('01', '610111', ''),
('01', '610110', ''),
('01', '610112', ''),
('01', '610113', ''),
('01', '610114', ''),
('01', '6102', ''),
('01', '610201', ''),
('01', '610202', ''),
('01', '610203', ''),
('01', '610204', ''),
('01', '610206', ''),
('01', '610207', ''),
('01', '610208', ''),
('01', '610209', ''),
('01', '610210', ''),
('01', '610211', ''),
('01', '610212', ''),
('01', '610213', ''),
('01', '610214', ''),
('01', '610215', ''),
('01', '6103', ''),
('01', '610301', ''),
('01', '610302', ''),
('01', '610303', ''),
('01', '6104', ''),
('01', '610401', ''),
('01', '610402', ''),
('01', '610403', ''),
('01', '610216', ''),
('01', '6201', ''),
('01', '6202', ''),
('01', '6203', ''),
('01', '6204', ''),
('01', '6205', ''),
('01', '620501', ''),
('01', '620502', ''),
('01', '620503', ''),
('01', '620504', ''),
('01', '620506', ''),
('01', '620507', ''),
('01', '620508', ''),
('01', '620509', ''),
('01', '620510', ''),
('01', '6206', ''),
('01', '6207', ''),
('01', '6208', ''),
('01', '6301', ''),
('01', '6302', ''),
('01', '6303', ''),
('01', '6304', ''),
('01', '6305', ''),
('01', '6306', ''),
('01', '6307', ''),
('010102', '6302', ''),
('010102', '66', ''),
('010103', '6201', ''),
('010103', '6202', ''),
('010103', '6203', ''),
('010103', '6204', ''),
('010103', '66', ''),
('010105', '6301', ''),
('010105', '66', ''),
('010106', '6103', ''),
('010106', '610301', ''),
('010106', '610302', ''),
('010106', '610303', ''),
('010106', '610304', ''),
('010108', '6101', ''),
('010108', '610116', ''),
('010108', '610104', ''),
('010108', '610115', ''),
('010108', '610102', ''),
('010108', '610101', ''),
('010108', '610106', ''),
('010108', '610108', ''),
('010108', '610109', ''),
('010108', '610111', ''),
('010108', '610110', ''),
('010108', '610112', ''),
('010108', '610113', ''),
('010108', '610114', ''),
('02', '61', ''),
('02', '62', ''),
('02', '63', ''),
('02', '610116', ''),
('02', '610104', ''),
('02', '610115', ''),
('02', '610102', ''),
('02', '6101', ''),
('02', '610101', ''),
('02', '610106', ''),
('02', '610108', ''),
('02', '610109', ''),
('02', '610111', ''),
('02', '610110', ''),
('02', '610112', ''),
('02', '610113', ''),
('02', '610114', ''),
('02', '6102', ''),
('02', '610201', ''),
('02', '610202', ''),
('02', '610203', ''),
('02', '610204', ''),
('02', '610206', ''),
('02', '610207', ''),
('02', '610208', ''),
('02', '610209', ''),
('02', '610210', ''),
('02', '610211', ''),
('02', '610212', ''),
('02', '610213', ''),
('02', '610214', ''),
('02', '610215', ''),
('02', '6103', ''),
('02', '610301', ''),
('02', '610302', ''),
('02', '610303', ''),
('02', '6104', ''),
('02', '610401', ''),
('02', '610402', ''),
('02', '610403', ''),
('02', '610216', ''),
('02', '6201', ''),
('02', '6202', ''),
('02', '6203', ''),
('02', '6204', ''),
('02', '6205', ''),
('02', '620501', ''),
('02', '620502', ''),
('02', '620503', ''),
('02', '620504', ''),
('02', '620506', ''),
('02', '620507', ''),
('02', '620508', ''),
('02', '620509', ''),
('02', '620510', ''),
('02', '6206', ''),
('02', '6207', ''),
('02', '6208', ''),
('02', '6301', ''),
('02', '6302', ''),
('02', '6303', ''),
('02', '6304', ''),
('02', '6305', ''),
('02', '6306', ''),
('02', '6307', ''),
('0201', '61', ''),
('0201', '610116', ''),
('0201', '610104', ''),
('0201', '610115', ''),
('0201', '610102', ''),
('0201', '6101', ''),
('0201', '610101', ''),
('0201', '610106', ''),
('0201', '610108', ''),
('0201', '610109', ''),
('0201', '610111', ''),
('0201', '610110', ''),
('0201', '610112', ''),
('0201', '610113', ''),
('0201', '610114', ''),
('0201', '6102', ''),
('0201', '610201', ''),
('0201', '610202', ''),
('0201', '610203', ''),
('0201', '610204', ''),
('0201', '610206', ''),
('0201', '610207', ''),
('0201', '610208', ''),
('0201', '610209', ''),
('0201', '610210', ''),
('0201', '610211', ''),
('0201', '610212', ''),
('0201', '610213', ''),
('0201', '610214', ''),
('0201', '610215', ''),
('0201', '6103', ''),
('0201', '610301', ''),
('0201', '610302', ''),
('0201', '610303', ''),
('0201', '6104', ''),
('0201', '610401', ''),
('0201', '610402', ''),
('0201', '610403', ''),
('0201', '610216', ''),
('0202', '61', ''),
('0202', '610116', ''),
('0202', '610104', ''),
('0202', '610115', ''),
('0202', '610102', ''),
('0202', '6101', ''),
('0202', '610101', ''),
('0202', '610106', ''),
('0202', '610108', ''),
('0202', '610109', ''),
('0202', '610111', ''),
('0202', '610110', ''),
('0202', '610112', ''),
('0202', '610113', ''),
('0202', '610114', ''),
('0202', '6102', ''),
('0202', '610201', ''),
('0202', '610202', ''),
('0202', '610203', ''),
('0202', '610204', ''),
('0202', '610206', ''),
('0202', '610207', ''),
('0202', '610208', ''),
('0202', '610209', ''),
('0202', '610210', ''),
('0202', '610211', ''),
('0202', '610212', ''),
('0202', '610213', ''),
('0202', '610214', ''),
('0202', '610215', ''),
('0202', '6103', ''),
('0202', '610301', ''),
('0202', '610302', ''),
('0202', '610303', ''),
('0202', '6104', ''),
('0202', '610401', ''),
('0202', '610402', ''),
('0202', '610403', ''),
('0202', '610216', ''),
('03', '61', ''),
('03', '62', ''),
('03', '6301', ''),
('03', '6302', ''),
('0302', '61', ''),
('0302', '6301', ''),
('0302', '610116', ''),
('0302', '610104', ''),
('0302', '610115', ''),
('0302', '610102', ''),
('0302', '6101', ''),
('0302', '610101', ''),
('0302', '610106', ''),
('0302', '610108', ''),
('0302', '610109', ''),
('0302', '610111', ''),
('0302', '610110', ''),
('0302', '610112', ''),
('0302', '610113', ''),
('0302', '610114', ''),
('0302', '6102', ''),
('0302', '610201', ''),
('0302', '610202', ''),
('0302', '610203', ''),
('0302', '610204', ''),
('0302', '610206', ''),
('0302', '610207', ''),
('0302', '610208', ''),
('0302', '610209', ''),
('0302', '610210', ''),
('0302', '610211', ''),
('0302', '610212', ''),
('0302', '610213', ''),
('0302', '610214', ''),
('0302', '610215', ''),
('0302', '6103', ''),
('0302', '610301', ''),
('0302', '610302', ''),
('0302', '610303', ''),
('0302', '6104', ''),
('0302', '610401', ''),
('0302', '610402', ''),
('0302', '610403', ''),
('0302', '610216', ''),
('0303', '6101', ''),
('0303', '610116', ''),
('0303', '610104', ''),
('0303', '610115', ''),
('0303', '610102', ''),
('0303', '610101', ''),
('0303', '610106', ''),
('0303', '610108', ''),
('0303', '610109', ''),
('0303', '610111', ''),
('0303', '610110', ''),
('0303', '610112', ''),
('0303', '610113', ''),
('0303', '610114', ''),
('0304', '63', ''),
('0304', '61', ''),
('0304', '62', ''),
('0304', '610116', ''),
('0304', '610104', ''),
('0304', '610115', ''),
('0304', '610102', ''),
('0304', '6101', ''),
('0304', '610101', ''),
('0304', '610106', ''),
('0304', '610108', ''),
('0304', '610109', ''),
('0304', '610111', ''),
('0304', '610110', ''),
('0304', '610112', ''),
('0304', '610113', ''),
('0304', '610114', ''),
('0304', '6102', ''),
('0304', '610201', ''),
('0304', '610202', ''),
('0304', '610203', ''),
('0304', '610204', ''),
('0304', '610206', ''),
('0304', '610207', ''),
('0304', '610208', ''),
('0304', '610209', ''),
('0304', '610210', ''),
('0304', '610211', ''),
('0304', '610212', ''),
('0304', '610213', ''),
('0304', '610214', ''),
('0304', '610215', ''),
('0304', '6103', ''),
('0304', '610301', ''),
('0304', '610302', ''),
('0304', '610303', ''),
('0304', '6104', ''),
('0304', '610401', ''),
('0304', '610402', ''),
('0304', '610403', ''),
('0304', '610216', ''),
('0304', '6201', ''),
('0304', '6202', ''),
('0304', '6203', ''),
('0304', '6204', ''),
('0304', '6205', ''),
('0304', '620501', ''),
('0304', '620502', ''),
('0304', '620503', ''),
('0304', '620504', ''),
('0304', '620506', ''),
('0304', '620507', ''),
('0304', '620508', ''),
('0304', '620509', ''),
('0304', '620510', ''),
('0304', '6206', ''),
('0304', '6207', ''),
('0304', '6208', ''),
('0304', '6301', ''),
('0304', '6302', ''),
('0304', '6303', ''),
('0304', '6304', ''),
('0304', '6305', ''),
('0304', '6306', ''),
('0304', '6307', ''),
('0305', '62', ''),
('0305', '6201', ''),
('0305', '6202', ''),
('0305', '6203', ''),
('04', '61', ''),
('04', '62', ''),
('0401', '63', ''),
('0401', '62', ''),
('0401', '61', ''),
('0402', '61', ''),
('0403', '62', ''),
('05', '61', ''),
('05', '62', ''),
('05', '63', ''),
('04', '61', '8331'),
('04', '61', '8312'),
('04', '61', '8316'),
('04', '62', '8404'),
('04', '62', '8407'),
('04', '62', '8403'),
('0401', '61', '8323'),
('0401', '61', '83'),
('0401', '61', '8301'),
('0401', '61', '8302'),
('0401', '61', '8303'),
('0401', '61', '8304'),
('0401', '61', '8305'),
('0401', '61', '8306'),
('0401', '61', '8307'),
('0401', '61', '8308'),
('0401', '61', '8309'),
('0401', '61', '8311'),
('0401', '61', '8312'),
('0401', '61', '8313'),
('0401', '61', '8314'),
('0401', '61', '8315'),
('0401', '61', '8316'),
('0401', '61', '8318'),
('0401', '61', '8319'),
('0401', '61', '8320'),
('0401', '61', '8321'),
('0401', '61', '8322'),
('0401', '61', '8324'),
('0401', '61', '8325'),
('0401', '61', '8326'),
('0401', '61', '8327'),
('0401', '61', '8328'),
('0401', '61', '8329'),
('0401', '61', '8330'),
('0401', '61', '8331'),
('0401', '61', '8332'),
('0401', '61', '8333'),
('0401', '61', '8334'),
('0401', '61', '8335'),
('0401', '61', '8336'),
('0401', '61', '8337'),
('0401', '61', '8338'),
('0401', '61', '8339'),
('0401', '61', '8340'),
('0401', '61', '8341'),
('0401', '61', '8343'),
('0401', '61', '8344'),
('0401', '61', '8345'),
('0401', '61', '8346'),
('0401', '61', '8347'),
('0401', '61', '8348'),
('0401', '61', '8349'),
('0401', '61', '8350'),
('0401', '62', '84'),
('0401', '62', '8401'),
('0401', '62', '8402'),
('0401', '62', '8403'),
('0401', '62', '8404'),
('0401', '62', '8405'),
('0401', '62', '8406'),
('0401', '63', '8601'),
('0401', '62', '8408'),
('0401', '62', '8409'),
('0401', '62', '8410'),
('0401', '63', '86'),
('0401', '62', '8412'),
('0401', '63', '8602'),
('0401', '63', '85'),
('0401', '63', '8501'),
('0401', '63', '8502'),
('0401', '63', '8503'),
('0401', '63', '8506'),
('0401', '63', '8507'),
('0402', '61', '83'),
('0402', '61', '8301'),
('0402', '61', '8302'),
('0402', '61', '8303'),
('0402', '61', '8304'),
('0402', '61', '8305'),
('0402', '61', '8306'),
('0402', '61', '8307'),
('0402', '61', '8308'),
('0402', '61', '8309'),
('0402', '61', '8311'),
('0402', '61', '8312'),
('0402', '61', '8313'),
('0402', '61', '8314'),
('0402', '61', '8315'),
('0402', '61', '8316'),
('0402', '61', '8318'),
('0402', '61', '8319'),
('0402', '61', '8320'),
('0402', '61', '8321'),
('0402', '61', '8322'),
('0402', '61', '8323'),
('0402', '61', '8324'),
('0402', '61', '8325'),
('0402', '61', '8326'),
('0402', '61', '8327'),
('0402', '61', '8328'),
('0402', '61', '8329'),
('0402', '61', '8330'),
('0402', '61', '8331'),
('0402', '61', '8332'),
('0402', '61', '8333'),
('0402', '61', '8334'),
('0402', '61', '8335'),
('0402', '61', '8336'),
('0402', '61', '8337'),
('0402', '61', '8338'),
('0402', '61', '8339'),
('0402', '61', '8340'),
('0402', '61', '8341'),
('0402', '61', '8343'),
('0402', '61', '8344'),
('0402', '61', '8345'),
('0402', '61', '8346'),
('0402', '61', '8347'),
('0402', '61', '8348'),
('0402', '61', '8349'),
('0402', '61', '8350'),
('0403', '62', '84'),
('0403', '62', '8401'),
('0403', '62', '8402'),
('0403', '62', '8403'),
('0403', '62', '8404'),
('0403', '62', '8405'),
('0403', '62', '8406'),
('0403', '62', '8407'),
('0403', '62', '8408'),
('0403', '62', '8409'),
('0403', '62', '8410'),
('0403', '62', '8411'),
('0403', '62', '8412');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
