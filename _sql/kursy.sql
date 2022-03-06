-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 18 Lut 2022, 01:16
-- Wersja serwera: 8.0.27
-- Wersja PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kursy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

DROP TABLE IF EXISTS `klienci`;
CREATE TABLE IF NOT EXISTS `klienci` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `imie` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `login`, `haslo`, `status`, `imie`, `nazwisko`, `telefon`, `email`, `data_dodania`) VALUES
(1, 'myszon.kowalski', '8cb2237d0679ca88db6464eac60da96345513964', 1, 'Myszon', 'Kowalski', '601500500', 'myszon.kowalski@speco.pl', '2021-12-18 06:58:25'),
(2, 'zyraf.nowak', '0e372a21ddf54ea3399f8cb930b834749c6a0d6d', 1, 'Żyraf', 'Nowak', '801500500', 'zyraf.nowak@speco.pl', '2021-12-18 06:59:40'),
(3, 'darina.abacka', '61b4d1ce34d93f613a01612c4dcca4425b731d60', 1, 'Darina', 'Abacka', '501700800', 'darina.abacka@speco.pl', '2021-12-18 07:02:30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

DROP TABLE IF EXISTS `koszyk`;
CREATE TABLE IF NOT EXISTS `koszyk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identyfikator` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `id_kursu` int NOT NULL,
  `ilosc` int NOT NULL,
  `data_dodania` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identyfikator` (`identyfikator`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id`, `identyfikator`, `id_kursu`, `ilosc`, `data_dodania`) VALUES
(2, 'f4m4cj9e724u7cujga6ook6564', 16, 9, '2022-02-18 02:00:09'),
(5, '2i5e5ia89lncaijomt8s6s45ot', 5, 1, '2022-02-18 02:12:15'),
(7, '1vl7u90aj0fvgb5aea8q02apkj', 2, 3, '2022-02-18 02:12:53'),
(8, '1vl7u90aj0fvgb5aea8q02apkj', 4, 1, '2022-02-18 02:12:57'),
(9, 'bm7891dpa6f1kfsnuov34c6opf', 2, 1, '2022-02-18 02:13:02'),
(10, 'bm7891dpa6f1kfsnuov34c6opf', 1, 3, '2022-02-18 02:13:04'),
(11, 'bm7891dpa6f1kfsnuov34c6opf', 16, 2, '2022-02-18 02:13:07'),
(12, 'bm7891dpa6f1kfsnuov34c6opf', 5, 1, '2022-02-18 02:13:51');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursy`
--

DROP TABLE IF EXISTS `kursy`;
CREATE TABLE IF NOT EXISTS `kursy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL,
  `kod_kursu` varchar(8) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `cena_netto` float(8,2) NOT NULL DEFAULT '0.00',
  `cena_brutto` float(8,2) NOT NULL DEFAULT '0.00',
  `data_rozpoczecia` date NOT NULL,
  `nazwa` varchar(128) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` datetime NOT NULL,
  `zdjecie` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `id_uzytkownika_dodajacego` int NOT NULL,
  `data_modyfikacji` datetime DEFAULT NULL,
  `id_uzytkownika_modyfikujacego` int DEFAULT NULL,
  `slowa_kluczowe` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kursy`
--

INSERT INTO `kursy` (`id`, `status`, `kod_kursu`, `cena_netto`, `cena_brutto`, `data_rozpoczecia`, `nazwa`, `opis`, `data_dodania`, `zdjecie`, `id_uzytkownika_dodajacego`, `data_modyfikacji`, `id_uzytkownika_modyfikujacego`, `slowa_kluczowe`) VALUES
(1, 3, 'WSS', 100.00, 123.00, '0000-00-00', 'Wprowadzenie do Spring Security', 'Celem warsztatu jest wprowadzenie do Spring Security w projektach opartych na Spring Boot. Zostaną omówione podstawowe mechanizmy wraz z kluczowymi interfejsami i klasami. Podczas warsztatu uczestnicy zapoznają się z różnymi aspektami zabezpieczania aplikacji zaczynając od klasycznych formularzy logowania, kończąc na zabezpieczaniu REST API.', '2021-12-18 07:08:49', NULL, 1, '2022-02-12 10:11:41', NULL, 'java spring security'),
(2, 0, 'SBAWS', 200.00, 246.00, '2021-12-29', 'Spring Boot w chmurze AWS', 'W trakcie warsztatu:\r\n- skupimy się na tworzeniu aplikacji przy użyciu Spring Boota oraz projektu Spring Cloud AWS,\r\n- zostaną przedstawione podstawowe usługi w środowisku AWS oraz ich użycie z poziomu dostępnego SDK,\r\n- dodatkowo zapoznamy się z koncepcją serverless i funkcją Lambda, którą połączymy następnie z naszą Springową aplikacją,\r\n- na koniec wykorzystamy usługi do konteneryzacji, aby uruchomić naszą aplikację w chmurze AWS.', '2021-12-18 07:11:04', NULL, 1, '2021-12-18 07:11:04', NULL, 'java spring boot aws chmura cloud'),
(3, 0, 'WDR', 100.00, 123.00, '0000-00-00', 'Wprowadzenie do programowania w R na przykładzie działań z WORDA', 'Demo na Akademii Programowania. Super Warsztat jest idealny dla osób pracujących w Excelu z dużymi zbiorami danych, wykonywujących dużo powtarzalnych operacji na danych. Warsztat dla chcących szybko poznać R, na przykładzie podstawowych operacji w Excelu. Szczególnie polecam szkolenie osobom, które chcą rozpocząć karierę w Data Science, pracującym w marketingu czy księgowości, zajmujących się raportowanie. R pozwoli ci uprościć i zautomatyzować pracę.\r\n\r\nExcel jest najpopularniejszym programem do obróbki i analizy danych w polskich firmach. W excelu rzeczy łatwe robi się łatwo, a skomplikowane trudno. W R możemy wykonać każdą operację znaną z excela, zautomatyzować ją.\r\n\r\nWiem jak trudno zacząć uczyć się czegoś nowego, szczególnie kiedy na pierwszy rzut oka wygląda na coś bardzo nieprzyjaznego. Dlatego chcę ułatwić ci start i w ciągu kilku godzin przekazać moją wiedzę niezbędną do rozpoczęcia efektywnej pracy w R.\r\n\r\nW czasie warsztatu będziemy pracować na przykładowych danych marketingowych, e-commercowych i finansowych.\r\n\r\nR zmieniło moje możliwości oraz aspirację. Mam nadzieje że na ciebie też wpłynie pozytywnie.\r\n\r\nDołącz do szkolenia i rozwijaj się.\r\n\r\n', '2021-12-18 07:12:34', NULL, 1, '2021-12-18 07:12:34', NULL, 'jira testy'),
(4, 1, 'JIRATEST', 200.00, 246.00, '0000-00-00', 'Organizacja i zarządzanie testami z wykorzystaniem narzędzia JIRA + Dodatki', 'Na warsztatach nauczysz się jak efektywnie wykorzystać narzędzie JIRĘ z punktu widzenia testera oprogramowania oraz poznasz najlepsze sposoby na organizację testów oraz w jaki sposób tworzyć Plany Testów oraz scenariusze testowe.', '2021-12-18 07:13:26', NULL, 1, '2021-12-18 07:13:26', NULL, ''),
(5, 1, 'POSTMAN', 100.00, 123.00, '2022-01-28', 'API Testing with Postman2', 'Na kursie poznasz na czym polega nowoczesne testowanie API - zrozumiesz jak działa protokół HTTP, jakie typu Webserwisów wyróżniamy, a także w jaki sposób korzystać z narzędzia Postman, tak aby Twoja praca była efektywna i wygodna.', '2021-12-18 07:14:41', NULL, 1, '2021-12-18 07:14:41', NULL, ''),
(16, 4, 'AP5', 0.00, 0.00, '0000-00-00', 'Nowy', 'problem z siecią', '2022-02-12 10:15:24', NULL, 0, NULL, NULL, ''),
(17, 2, 'test', 3000.00, 3690.00, '0000-00-00', 'Sprawdzam', 'wpis testowy', '2022-02-12 11:28:22', NULL, 0, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

DROP TABLE IF EXISTS `uzytkownicy`;
CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `imie` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `status`, `imie`, `nazwisko`, `telefon`, `email`, `data_dodania`) VALUES
(1, 'michal', '8cf47125b71f1f2a1c813aa98fb43ba5c2a48723', 1, 'Michał', 'Zalewski', '601500500', 'm.zalewski@capitalservice.pl', '2021-12-18 07:06:44'),
(2, 'pawel', '2969dab5c6902e81c3cef07503f417f696349310', 1, 'Paweł', 'Piędziak', '601500500', 'p.piedziak@capitalservice.pl', '2021-12-18 08:08:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

DROP TABLE IF EXISTS `zamowienia`;
CREATE TABLE IF NOT EXISTS `zamowienia` (
  `id` int NOT NULL,
  `id_klienta` int NOT NULL,
  `data_dodania` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_szczegoly`
--

DROP TABLE IF EXISTS `zamowienia_szczegoly`;
CREATE TABLE IF NOT EXISTS `zamowienia_szczegoly` (
  `id` int NOT NULL,
  `id_zamowienia` int NOT NULL,
  `id_kursu` int NOT NULL,
  `cena_netto` float(8,2) NOT NULL,
  `cena_brutto` float(8,2) NOT NULL,
  `ilosc` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
