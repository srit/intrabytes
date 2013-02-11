-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Feb 2013 um 16:51
-- Server Version: 5.5.29-0ubuntu0.12.04.1
-- PHP-Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `alphabytes`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_clients`
--

CREATE TABLE IF NOT EXISTS `intrabytes_clients` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_countries`
--

CREATE TABLE IF NOT EXISTS `intrabytes_countries` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(100) NOT NULL,
`language_id` int(11) NOT NULL,
PRIMARY KEY (`id`,`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_countries`
--

INSERT INTO `intrabytes_countries` (`id`, `name`, `language_id`) VALUES
(1, 'Deutschland', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_customers`
--

CREATE TABLE IF NOT EXISTS `intrabytes_customers` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
`email` varchar(100) NOT NULL,
`company_name` varchar(100) DEFAULT NULL,
`firstname` varchar(100) DEFAULT NULL,
`lastname` varchar(100) DEFAULT NULL,
`salutation` varchar(10) DEFAULT NULL,
`phone` varchar(20) DEFAULT NULL,
`fax` varchar(20) DEFAULT NULL,
`street` varchar(100) DEFAULT NULL,
`housenumber` varchar(5) DEFAULT NULL,
`postalcode_id` varchar(5) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_customers`
--

INSERT INTO `intrabytes_customers` (`id`, `created_at`, `updated_at`, `email`, `company_name`, `firstname`, `lastname`, `salutation`, `phone`, `fax`, `street`, `housenumber`, `postalcode_id`) VALUES
(1, '2013-02-06 09:29:23', '2013-02-06 09:29:23', 'andrej.oblogin@sonatex.de', 'Sonatex GmbH', NULL, NULL, NULL, '023479250415', '023479250420', 'Castroper Hellweg', '109', '2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_customer_contact_persons`
--

CREATE TABLE IF NOT EXISTS `intrabytes_customer_contact_persons` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`email` varchar(100) NOT NULL,
`lastname` varchar(100) NOT NULL,
`firstname` varchar(100) NOT NULL,
`salutation` varchar(10) DEFAULT NULL,
`phone` varchar(20) NOT NULL,
`fax` varchar(20) DEFAULT NULL,
`street` varchar(100) DEFAULT NULL,
`housenumber` varchar(5) DEFAULT NULL,
`postalcode_id` int(11) DEFAULT NULL,
`created_at` datetime NOT NULL,
`changed_at` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_dashboard_items`
--

CREATE TABLE IF NOT EXISTS `intrabytes_dashboard_items` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`route` varchar(255) NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_dashboard_items_users`
--

CREATE TABLE IF NOT EXISTS `intrabytes_dashboard_items_users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`dashboard_item_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`order` int(5) NOT NULL,
PRIMARY KEY (`id`,`dashboard_item_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_languages`
--

CREATE TABLE IF NOT EXISTS `intrabytes_languages` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`locale` varchar(10) NOT NULL,
`language` varchar(2) NOT NULL,
`plain` varchar(200) NOT NULL,
`default` tinyint(1) NOT NULL,
`currency` varchar(3) NOT NULL,
`thousand_separator` varchar(1) NOT NULL,
`dec_point` varchar(1) NOT NULL,
`date_format` varchar(10) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_languages`
--

INSERT INTO `intrabytes_languages` (`id`, `locale`, `language`, `plain`, `default`, `currency`, `thousand_separator`, `dec_point`, `date_format`) VALUES
(1, 'de_DE', 'de', 'Deutsch', 1, 'EUR', '.', ',', 'dd.mm.yyyy');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_locales`
--

CREATE TABLE IF NOT EXISTS `intrabytes_locales` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`key` varchar(255) NOT NULL,
`group` varchar(255) NOT NULL,
`value` text NOT NULL,
`language_id` int(11) NOT NULL,
PRIMARY KEY (`id`,`language_id`),
KEY `key` (`key`),
KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Daten für Tabelle `intrabytes_locales`
--

INSERT INTO `intrabytes_locales` (`id`, `key`, `group`, `value`, `language_id`) VALUES
(1, 'logout.label', 'nav', 'Logout :name', 1),
(2, 'dashboard.label', 'nav', 'Dashboard', 1),
(3, 'settings.label', 'nav', 'Einstellungen', 1),
(4, 'dashboard.config.label', 'usernav', 'Dashboard konfigurieren', 1),
(5, 'logout.label', 'usernav', 'Logout', 1),
(6, 'login.index.title', 'users', 'Login', 1),
(7, 'password.forget.title', 'users', 'Passwort vergessen', 1),
(8, 'username.label', 'login', 'Nutzername/E-Mail', 1),
(9, 'username.label', 'forgetpassword', 'Nutzername/E-Mail', 1),
(10, 'send.label', 'forgetpassword', 'Senden', 1),
(11, 'password.label', 'login', 'Passwort', 1),
(12, 'loginbutton.label', 'login', 'Login', 1),
(13, 'forgetpassword.label', 'login', 'Passwort vergessen', 1),
(14, 'login.failed', 'messages', 'Nutzername und/oder Passwort falsch.', 1),
(15, 'login.success', 'messages', 'Sie haben sich erfolgreich eingeloggt.', 1),
(16, 'allreadyloggedin', 'messages', 'Sie sind bereits eingeloggt.', 1),
(17, 'prepare_new_password.success', 'messages', 'Weitere Informationen wurden an Ihre hinterlegte E-Mail-Adresse gesendet.', 1),
(18, 'username.required.error', 'validation', 'Der Benutzername muss ausgefüllt werden.', 1),
(19, 'password.required.error', 'validation', 'Bitte geben Sie ihr Passwort ein!', 1),
(20, 'form.invalid', 'validation', 'Das Formular konnte leider nicht verarbeitet werden.', 1),
(21, 'settings.language.label', 'nav', 'Spracheinstellungen', 1),
(22, 'settings_language.index.title', 'core', 'Spracheinstellungen', 1),
(23, 'board.index.title', 'dashboard', 'Dashboard', 1),
(24, 'settings.dashboard.title', 'users', 'Dashboard konfigurieren', 1),
(25, 'settings_language.index.id.label', 'core', '#', 1),
(26, 'settings_language.index.locale.label', 'core', 'Locale', 1),
(27, 'settings_language.index.language.label', 'core', 'Sprache', 1),
(28, 'settings_language.index.plain.label', 'core', 'Text', 1),
(29, 'settings_language.index.add.plain.label', 'core', 'Sprache', 1),
(30, 'settings_language.index.add.button.label', 'core', '<i class="icon-white  icon-plus"></i> Anlegen', 1),
(31, 'settings_language.index.actions.label', 'core', 'Aktionen', 1),
(32, 'settings_language.index.actions.edit.label', 'core', 'Bearbeiten', 1),
(33, 'settings_language.index.actions.delete.label', 'core', 'Löschen', 1),
(34, 'settings.language.edit.legend', 'core', 'Sprache :sprache bearbeiten', 1),
(35, 'settings.language.edit.locale.label', 'core', 'Locale', 1),
(36, 'settings.language.edit.language.label', 'core', 'Sprache', 1),
(37, 'settings.language.edit.plain.label', 'core', 'Text', 1),
(38, 'settings.language.edit.save.button.label', 'core', 'Speichern', 1),
(39, 'settings.language.edit.cancel.button.label', 'core', 'Abbrechen', 1),
(40, 'settings_language.index.default.label', 'core', 'Standardsprache', 1),
(41, 'book.index.title', 'cash', 'Kassenbuch Übersicht', 1),
(42, 'book.index.date.label', 'cash', 'Datum', 1),
(43, 'book.index.desc.label', 'cash', 'Verwendungszweck', 1),
(44, 'book.index.type.label', 'cash', 'Typ', 1),
(45, 'book.index.account.label', 'cash', 'Konto', 1),
(46, 'book.index.user.label', 'cash', 'Nutzer', 1),
(47, 'book.index.amount.label', 'cash', 'Betrag', 1),
(48, 'settings_language.index.count.locales.label', 'core', 'Anzahl Übersetzungen', 1),
(49, 'book.index.add.button.label', 'cash', '<i class="icon-white  icon-plus"></i> Buchung', 1),
(50, 'cashbook.label', 'nav', 'Kassenbuch', 1),
(51, 'book_add.index.title', 'cash', 'Buchung hinzufügen', 1),
(52, 'book_add.index.date.label', 'cash', 'Buchungsdatum', 1),
(53, 'book_add.index.desc.label', 'cash', 'Verwendungszweck', 1),
(54, 'book_add.index.amount.label', 'cash', 'Wert', 1),
(55, 'book_add.index.save.button.label', 'cash', 'Speichern', 1),
(56, 'book_add.index.cancel.button.label', 'cash', 'Abbruch', 1),
(57, 'book.index.carryout.label', 'cash', 'Übertrag', 1),
(58, 'book.index.sum.label', 'cash', 'Summenübertrag', 1),
(59, 'list.index.nodata', 'projects', '<p>Keine Projekte vorhanden</p>', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_migration`
--

CREATE TABLE IF NOT EXISTS `intrabytes_migration` (
`type` varchar(25) NOT NULL,
`name` varchar(50) NOT NULL,
`migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `intrabytes_migration`
--

INSERT INTO `intrabytes_migration` (`type`, `name`, `migration`) VALUES
('module', 'dashboard', '001_create_dashboards'),
('module', 'tasks', '001_createtasktable'),
('module', 'tasks', '002_addbackgroundcolor'),
('module', 'users', '001_createtables'),
('module', 'users', '002_addpasswordresetted'),
('module', 'users', '003_addnewpasswordhash'),
('module', 'users', '004_addnewpasswordhashindex'),
('module', 'users', '005_createclienttable'),
('module', 'users', '006_createprofiletable'),
('module', 'users', '007_addadminuser'),
('package', 'srit', '001_createlocalesandlanguages'),
('package', 'srit', '002_insertlocalesandlanguages'),
('package', 'srit', '003_insertlocalesandlanguages1'),
('package', 'srit', '004_insertlocalesandlanguages2'),
('package', 'srit', '005_insertlocalesandlanguages3'),
('package', 'srit', '006_insertlocalesandlanguages4'),
('package', 'srit', '007_insertlocalesandlanguages5'),
('package', 'srit', '008_insertlocalesandlanguages6'),
('package', 'srit', '009_insertlocalesandlanguages7'),
('module', 'cash', '001_createaccountstable'),
('module', 'cash', '002_addblzandnumber'),
('module', 'cash', '003_createentries'),
('package', 'srit', '010_adddefaulttolanguages'),
('module', 'cash', '004_adddescandtyp'),
('module', 'cash', '005_renametypid'),
('module', 'cash', '006_addentrytypes');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_postalcodes`
--

CREATE TABLE IF NOT EXISTS `intrabytes_postalcodes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`postalcode` varchar(5) NOT NULL,
`city` varchar(25) NOT NULL,
`country_id` int(11) NOT NULL,
PRIMARY KEY (`id`,`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `intrabytes_postalcodes`
--

INSERT INTO `intrabytes_postalcodes` (`id`, `postalcode`, `city`, `country_id`) VALUES
(1, '44809', 'Bochum', 1),
(2, '44805', 'Bochum', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_profiles`
--

CREATE TABLE IF NOT EXISTS `intrabytes_profiles` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`firstname` varchar(50) NOT NULL,
`lastname` varchar(50) NOT NULL,
`birthday` date DEFAULT NULL,
`gender` varchar(1) DEFAULT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_profiles`
--

INSERT INTO `intrabytes_profiles` (`id`, `user_id`, `firstname`, `lastname`, `birthday`, `gender`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stefan', 'Riedel', '1983-05-28', 'm', '2013-02-05 11:19:47', '2013-02-05 11:19:47');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_projects`
--

CREATE TABLE IF NOT EXISTS `intrabytes_projects` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_projects`
--

INSERT INTO `intrabytes_projects` (`id`, `name`) VALUES
(1, 'Sonatex Hauptshop');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_tasks`
--

CREATE TABLE IF NOT EXISTS `intrabytes_tasks` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`due_date` datetime NOT NULL,
`task_category_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`global` tinyint(1) NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
PRIMARY KEY (`id`,`task_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_task_categories`
--

CREATE TABLE IF NOT EXISTS `intrabytes_task_categories` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`color` varchar(7) NOT NULL DEFAULT '#333333',
`background_color` varchar(8) NOT NULL,
`client_id` int(11) NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
PRIMARY KEY (`id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intrabytes_users`
--

CREATE TABLE IF NOT EXISTS `intrabytes_users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`client_id` int(11) NOT NULL,
`username` varchar(50) NOT NULL,
`pepper` varchar(32) NOT NULL,
`password` varchar(255) NOT NULL,
`group` int(11) NOT NULL,
`email` varchar(255) NOT NULL,
`last_login` int(11) NOT NULL,
`login_hash` varchar(255) NOT NULL,
`profile_fields` text NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL,
`password_resetted` tinyint(1) NOT NULL,
`password_resetted_at` int(11) NOT NULL,
`new_password_hash` varchar(255) NOT NULL,
PRIMARY KEY (`id`,`client_id`),
KEY `new_password_hash` (`new_password_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `intrabytes_users`
--

INSERT INTO `intrabytes_users` (`id`, `client_id`, `username`, `pepper`, `password`, `group`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`, `password_resetted`, `password_resetted_at`, `new_password_hash`) VALUES
(1, 0, 'sr', '3c2a974483bf41d6b899482bdf9b0d66', '$2y$10$7b0b3a9131e69122b066ceJNeEHL4/n4n1ed5cGXeMP2NibYlWkDu', 100, 'admin@blogshocker.com', 1360163235, 'f9ce0444f6a8653c73d58824dbd84f74d121d25c', 'a:0:{}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '');
