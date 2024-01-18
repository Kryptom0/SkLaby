-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 19, 2024 at 12:53 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_data`
--

CREATE TABLE `category_data` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_data`
--

INSERT INTO `category_data` (`id`, `matka`, `nazwa`) VALUES
(39, 0, 'Elektronikaa'),
(40, 39, 'laptopy'),
(41, 39, 'Komputery'),
(42, 39, 'Konsole'),
(44, 0, 'Motoryzacja'),
(45, 0, 'Sport i turystyka'),
(46, 44, 'Cześci samochodowe'),
(47, 44, 'Gadzety motoryzacyjne'),
(48, 44, 'Opony i felgi'),
(49, 45, 'Rowery i akcesoria'),
(50, 45, 'Narty'),
(53, 0, 'Dzieckooo'),
(58, 44, 'Chemia samochodowa'),
(60, 39, 'Telefony');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Strona Główna', '    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n\r\n    <h1>Najwyższe budynki na świecie</h1>\r\n    <h2>Podstrony</h2>\r\n    <h2><i>Podstawowe informacje</i></h2>\r\n    \r\n    <p>Jakie są najwyższe budynki na świecie? Choć pytanie może wydawać proste, to takie nie jest. Warto wyjaśnić, czym w ogóle jest budynek?</p>\r\n    \r\n    <p>Budynek to rodzaj budowli lub jej część, w zakresie której wydzielono poprzez przegrody budowlane, takie jak ściany zewnętrzne i dach lub stropodach,\r\n    przestrzeń użytkowaną przez człowieka w rozmaity sposób. Przestrzeń ta może być wewnętrznie dzielona poprzez elementy budynku takie jak ściany stropy. \r\n    Właśnie dlatego, na liście najwyższych budynków świata nie znajdziemy wież i masztów. Są one budowlami, ale nie budynkami.</p>\r\n    \r\n    <p>Wysokie budynki bywają nazywane wieżowcami. Przyjęło się, że za wieżowce uznajemy budynki o wysokości przekraczającej 150 metrów. \r\n    Takie niepisane zasady obowiązują w USA, choć należy zaznaczyć, że w zależności od regionu świata, definicja może się różnić. \r\n    Wieżowce o wysokości przekraczającej 300 metrów bywają nazywane superwysokimi.</p>\r\n    \r\n    <p>Ten ranking jest oparty o wysokości do szczytu architektonicznego.</p>\r\n    \r\n    <p>Wysokość do szczytu architektonicznego — obejmuje iglicę, lecz nie są uwzględniane anteny, oznakowania, maszty flagowe oraz\r\n    inne wyposażenie funkcjonalno-techniczne. To właśnie ta miara jest najpowszechniej stosowana na świecie.</p>\r\n\r\n    <div class=\"centered-images\">\r\n        <img src=\"img/ab.png\" alt=\"Obraz 1\">\r\n    </div>\r\n	<div class=\"centered-images\">\r\n        <img src=\"img/x_zdj2.jpg\" alt=\"Obraz 2\">\r\n    </div>\r\n<div id=\"animacjaTestowa1\" class=\"test-block\">Kliknij, a sie powiększe</div>\r\n    <script>\r\n\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\",\r\n                opacity: 0.4,\r\n                fontSize: \"3em\",\r\n                borderWidth: \"10px\"\r\n            }, 1500);\r\n        });\r\n\r\n    </script>\r\n', 1),
(2, 'Ranking', '    <style>\r\n        body {\r\n            color: black;\r\n            text-align: center;\r\n        }\r\n        table, th, td {\r\n            border: 1px solid black;\r\n        }\r\n        h1 {\r\n            color: black;\r\n            margin: 20px 0;\r\n        }\r\n        h2 {\r\n            font-size: 24px;\r\n            margin: 10px 0;\r\n        }\r\n        p {\r\n            font-size: 18px;\r\n            margin: 10px 0;\r\n        }\r\n    </style>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n	<h2><b>Ranking</b></h2>\r\n    <h2>Najwyższe budynki na świecie (wysokość do szczytu architektonicznego):</h2>\r\n    <p>1. Burdż Chalifa – 828 m - Dubaj</p>\r\n    <p>2. Shanghai Tower – 623 m - Szanghaj</p>\r\n    <p>3. Abradż al-Bajt – 601 m - Mekka</p>\r\n    <p>4. Ping An Finance Center – 599,1 m - Shenzhen</p>\r\n    <p>5. Lotte World Tower – 554,5 m - Seul</p>\r\n    <p>6. One World Trade Center – 541,3 m - Nowy Jork</p>\r\n    <p>7. Guangzhou CTF Finance Centre – 530 m - Guangzhou</p>\r\n    <p>8. Tianjin CTF Finance Centre – 530 m - Tiencin</p>\r\n    <p>9. China Zun – 527,7 m - Pekin</p>\r\n    <p>10. Taipei 101 – 508 m - Tajpej</p>\r\n\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">Najedź kursorem, a sie powiększe</div>\r\n<script>\r\n$(\"#animacjaTestowa2\").on({\r\n    \'mouseover\' : function() {\r\n        $(this).animate({\r\n            width: 300\r\n        }, 800);\r\n    },\r\n    \'mouseout\' : function() {\r\n        $(this).animate({\r\n            width: 200\r\n        }, 800);\r\n    }\r\n});\r\n</script>\r\n</html>\r\n', 1),
(3, 'Galeria', '\r\n    <style>\r\n        h1 {\r\n            color: black;\r\n        }\r\n        .image-container {\r\n            display: flex;\r\n            flex-wrap: wrap;\r\n            justify-content: center;\r\n        }\r\n        .image-container div {\r\n            margin: 10px;\r\n        }\r\n    </style>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n    <h1>Galeria</h1>\r\n    <h2>Podstrony</h2>\r\n    <table style=\"width:100%\">\r\n    </table>\r\n    <h2><span>Budynki</span></h2>\r\n\r\n    <div class=\"image-container\">\r\n        <div>\r\n            <img src=\"img/Burj_Khalifa.jpg\" alt=\"Burdż Chalifa\" width=\"200\" height=\"200\">\r\n            <p>1. Burdż Chalifa</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/shanghai_tower.jpg\" alt=\"Shanghai Tower\" width=\"200\" height=\"200\">\r\n            <p>2. Shanghai Tower</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/Abradż al-Bajt.jpg\" alt=\"Abradż al-Bajt\" width=\"200\" height=\"200\">\r\n            <p>3. Abradż al-Bajt</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/Ping_An_Finance_Center.jpg\" alt=\"Ping An Finance Center\" width=\"200\" height=\"200\">\r\n            <p>4. Ping An Finance Center</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/Lotte_World_Tower.jpg\" alt=\"Lotte World Tower\" width=\"200\" height=\"200\">\r\n            <p>5. Lotte World Tower</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/OneWorldTradeCenter.jpg\" alt=\"One World Trade Center\" width=\"200\" height=\"200\">\r\n            <p>6. One World Trade Center</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/GuangzhouCTFFinanceCentre.jpg\" alt=\"Guangzhou CTF Finance Centre\" width=\"200\" height=\"200\">\r\n            <p>7. Guangzhou CTF Finance Centre</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/TianjinCTFinanceCentre.jpg\" alt=\"Tianjin CTF Finance Centre\" width=\"200\" height=\"200\">\r\n            <p>8. Tianjin CTF Finance Centre</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/ChinaZun.jpg\" alt=\"China Zun\" width=\"200\" height=\"200\">\r\n            <p>9. China Zun</p>\r\n        </div>\r\n        <div>\r\n            <img src=\"img/Taipei101.jpg\" alt=\"Taipei 101\" width=\"200\" height=\"200\">\r\n            <p>10. Taipei 101</p>\r\n        </div>\r\n    </div>\r\n</html>\r\n', 1),
(4, 'Informacje', '    <style>\r\n        body {\r\n            color: black;\r\n            text-align: center;\r\n        }\r\n        table, th, td {\r\n            border: 1px solid black;\r\n        }\r\n        h1 {\r\n            color: black;\r\n            margin: 20px 0;\r\n        }\r\n        h2 {\r\n            font-size: 24px;\r\n            margin: 10px 0;\r\n        }\r\n        p {\r\n            font-size: 18px;\r\n            margin: 10px 0;\r\n            text-align: justify;\r\n        }\r\n    </style>\r\n</head>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n    <h1>Informacje</h1>\r\n\r\n    <h2>Podstrony</h2>\r\n    <table style=\"width:100%\">\r\n    </table>\r\n\r\n    <h2><u class=\"spelling-error\">Informacje</u></h2>\r\n    <p> Pierwsze miejsce w zestawieniu przypadło dubajskiemu Burdżowi Chalifa. \r\n    Wieżowiec mierzy 828 metrów. Nic więc dziwnego, że koszt budowy wyniósł aż 1,5 mld USD.\r\n	20 maja 2008 roku budynek ten stał się najwyższą lądową konstrukcją budowlaną, jaką kiedykolwiek zbudował człowiek. \r\n	Co ciekawe, miano to odebrał polskiemu masztowi radiowemu. Chodzi oczywiście, o mierzący 646 metrów maszt w Konstantynowie.\r\n	Maszt uległ zniszczeniu w 1991 roku.</p>\r\n    \r\n    <p>Na drugim miejscu znalazł się mierzący 623 metry wieżowiec Shanghai Tower. Został ukończony w 2015 roku.\r\n	Pełni rolę hotelu oraz biurowca. Podium z wynikiem 601 metrów zamyka Makkah Royal Clock Tower. To olbrzymi \r\n	postmodernistyczny kompleks hotelowy, który został ukończony w 2011 roku. Liczy 120 kondygnacji i 1 500 000 m² \r\n	powierzchni użytkowej. Jest nie tylko trzecim najwyższym budynkiem świata, ale sam posiada kilka rekordów. \r\n	To najwyższy hotel świata, posiada największy zegar wieżowy świata, a także sam jest największym budynkiem pod \r\n	względem powierzchni. Kompleks znajduje się w Mekce.</p>\r\n    \r\n    <p>Czwarte miejsce zajął Ping An Finance Center. To olbrzymi, mierzący 599,1 metrów biurowiec położony w Shenzen w Chinach. \r\n	Pierwszą piątkę zamyka Lotte World Tower z imponującymi 554,5 metrami wysokości. Wieżowiec znajduje się w stolicy \r\n	Korei Południowej — Seulu. Dopiero na szóstej pozycji znajduje się przedstawiciel Stanów Zjednoczonych.\r\n	Jest nim mierzący 541,3 metrów wieżowiec One World Trade Center. Został zbudowany w Nowym Jorku w miejscu, gdzie wcześniej stały dwie słynne wieże.</p>\r\n\r\n    <p>Siódme, ósme i dziewiąte miejsce przypadły Chinom. Są to kolejno: Guangzhou CTF Finance Centre (530 metrów),\r\n	Tianjin CTF Finance Centre (530 metrów) oraz CITIC Tower (527,7 metrów). Wieżowce powstały kolejno w 2016, 2019 oraz 2018 roku.\r\n	Dzięki temu Chiny posiadają w pierwszej dziesiątce najwyższych budynków świata aż pięciu przedstawicieli. \r\n	Pierwszą dziesiątkę zamyka Taipei 101. Mierzy 508 metrów wysokości. Wieżowiec został zbudowany na Tajwanie w 2004 roku i przez cztery lata był najwyższym budynkiem świata.\r\n	Swój tytuł oddał wieżowcowi z Dubaju.</p>\r\n\r\n<div id=\"animacjaTestowa3\" class=\"test-block\">Kliknij, abym urósł</div>\r\n<script>\r\n$(\"#animacjaTestowa3\").on(\"click\",function(){\r\n    if (!$(this).is(\":animated\")) {\r\n        $(this).animate({\r\n            width: \"+=\" + 50,\r\n            height: \"+=\" + 10,\r\n            opacity: \"-=\" + 0.1,\r\n            duraction: 3000\r\n        });\r\n    }\r\n});\r\n</script>\r\n</html>\r\n', 1),
(5, 'Kontakt', '\r\n    <style>\r\n        h1 {\r\n            color: black;\r\n        }\r\n        .contact-container {\r\n            display: flex;\r\n            justify-content: center;\r\n        }\r\n        .contact-form {\r\n            background-color: #f9f9f9;\r\n            padding: 20px;\r\n            border: 1px solid #333;\r\n            border-radius: 5px;\r\n            max-width: 400px;\r\n        }\r\n        label {\r\n            display: block;\r\n            margin-bottom: 10px;\r\n        }\r\n        input[type=\"text\"], input[type=\"email\"], textarea {\r\n            width: 100%;\r\n            padding: 10px;\r\n            margin-bottom: 10px;\r\n            border: 1px solid #ccc;\r\n            border-radius: 5px;\r\n        }\r\n        input[type=\"submit\"] {\r\n            background-color: #333;\r\n            color: white;\r\n            padding: 10px 20px;\r\n            border: none;\r\n            border-radius: 5px;\r\n            cursor: pointer;\r\n        }\r\n        input[type=\"submit\"]:hover {\r\n            background-color: #555;\r\n        }\r\n    </style>\r\n</head>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n    <h1>Kontakt</h1>\r\n    <h2>Podstrony</h2>\r\n    </table>\r\n    <h2>Formularz Kontaktowy</h2>\r\n    <div class=\"contact-container\">\r\n        <form class=\"contact-form\">\r\n            <label for=\"name\">Imię:</label>\r\n            <input type=\"text\" id=\"name\" name=\"name\" required>\r\n\r\n            <label for=\"email\">Adres e-mail:</label>\r\n            <input type=\"email\" id=\"email\" name=\"email\" required>\r\n\r\n            <label for=\"message\">Wiadomość:</label>\r\n            <textarea id=\"message\" name=\"message\" rows=\"4\" required></textarea>\r\n\r\n            <button type=\"submit\">Wyślij wiadomość</button>\r\n        </form>\r\n    </div>\r\n</html>\r\n', 1),
(6, 'Filmy', '\r\n</head>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <FORM METHOD=\"POST\" NAME=\"background\">\r\n        <INPUT TYPE=\"button\" VALUE=\"szary\" ONCLICK=\"changeBackground(\'#E4EDF7\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czarny\" ONCLICK=\"changeBackground(\'#515254\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"niebieski\" ONCLICK=\"changeBackground(\'#0F4BC2\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"zielony\" ONCLICK=\"changeBackground(\'#32EB47\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"żółty\" ONCLICK=\"changeBackground(\'#D6FA46\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"czerwony\" ONCLICK=\"changeBackground(\'#D40823\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"fioletowy\" ONCLICK=\"changeBackground(\'#E827DE\')\">\r\n        <INPUT TYPE=\"button\" VALUE=\"miętowy\" ONCLICK=\"changeBackground(\'#6FE8B6\')\">\r\n    </FORM>\r\n    <h1>Filmy</h1>\r\n    <h2>Podstrony</h2>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ebD_Szbxnq4?si=RcXNPa3HyB-Xof-s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/r9omqwqHNiE?si=sstYd4nfzcnfCaSN\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/cZp8d0r4bjA?si=xU0yT-uvHfzAh4h6\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">Najedź kursorem, a sie powiększe</div>\r\n<script>\r\n$(\"#animacjaTestowa2\").on({\r\n    \'mouseover\' : function() {\r\n        $(this).animate({\r\n            width: 300\r\n        }, 800);\r\n    },\r\n    \'mouseout\' : function() {\r\n        $(this).animate({\r\n            width: 200\r\n        }, 800);\r\n    }\r\n});\r\n\r\n</script>\r\n</html>\r\n', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category_data`
--
ALTER TABLE `category_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_data`
--
ALTER TABLE `category_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
