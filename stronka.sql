-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 24, 2024 at 09:47 AM
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
-- Database: `stronka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'żółwie'),
(4, 1, 'żywe'),
(13, 1, 'jaja'),
(14, 0, 'karma'),
(17, 4, 'samce'),
(18, 4, 'samice'),
(20, 1, 'lol');

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
(1, 'strona domowa', '<h2>Witaj na naszej stronie poświęconej pasji hodowli żółwi wodnych. Razem z nami odkryjesz fascynujący świat tych uroczych stworzeń i dowiesz się, jak możemy pomóc ci zacząć swoją przygodę z hodowlą żółwi.</h2>\r\n<img src=\"img/01.jpg\">\r\n<p class=\"podpis\"> żółw Bartek </p>\r\n<form method=\"POST\" NAME=\"background\">\r\n    <input type=\"button\" value = \"plytko\" onclick=\"changeBackground(\'01\')\">\r\n    <input type=\"button\" value = \"zielono\" onclick=\"changeBackground(\'02\')\">\r\n    <input type=\"button\" value = \"niebiesko\" onclick=\"changeBackground(\'03\')\">\r\n    <input type=\"button\" value = \"ryby\" onclick=\"changeBackground(\'04\')\">\r\n</form>', 1),
(2, 'o nas', '<h2><b>Historia</b></h2>\r\n<p>Nasza hodowla żółwi wodnych to historia pasji i oddania. Zaczęła się wiele lat temu, kiedy to pierwszy żółw wodny wkroczył do naszego życia. Od tego momentu nasza fascynacja tymi niesamowitymi stworzeniami rosła wraz z każdym dniem.</p>\r\n<p>Naszą misją jest nie tylko hodowla żółwi, ale również edukacja i popularyzacja wiedzy na temat tych fascynujących zwierząt. Wierzymy, że dzięki temu możemy przyczynić się do ochrony ich naturalnych siedlisk i zachęcić innych do troski o ten wyjątkowy gatunek.</p>\r\n<p>Nasze doświadczenie w hodowli żółwi wodnych jest wynikiem ciężkiej pracy, zaangażowania i stałego dążenia do doskonałości. Dbamy o każdy detal, zapewniając naszym podopiecznym najlepsze warunki życia, zdrową dietę i opiekę weterynaryjną.</p>\r\n<p>Jesteśmy dumni z tego, co osiągnęliśmy dotychczas, ale wiemy, że nasza podróż hodowlana wciąż trwa. Nasza rodzina powiększa się z każdym żółwiem, który do nas trafia, i z dumą dzielimy się tą pasją z innymi miłośnikami zwierząt.</p>\r\n<p>Dziękujemy, że odwiedzasz naszą stronę i jesteśmy przekonani, że razem możemy odkryć fascynujący świat żółwi wodnych i przyczynić się do ich ochrony.</p>', 1),
(3, 'podopieczne', '<h2><b>Nasze Podopieczne</b></h2>\r\n<p>Nasi podopieczni to serce i dusza naszej hodowli żółwi wodnych. W naszym akwarium i oczkach wodnych gościmy różnorodność gatunków żółwi wodnych, każdy z nich o unikalnych cechach i uroku. Chcemy podzielić się z tobą naszą pasją i wiedzą na temat tych fascynujących stworzeń.</p>\r\n<h3>Żółwie Strumieniowe</h3>\r\n<p>Nasza hodowla specjalizuje się w żółwiach strumieniowych. To urocze stworzenia, które zachwycają swoją barwną skorupą i spokojnym charakterem. Dostarczamy im idealne warunki do rozwoju i zapewniamy opiekę na najwyższym poziomie.</p>\r\n<img src=\"img/02.jpg\">\r\n<p class=\"podpis\"> żółwica Aneta </p>\r\n<h3>Żółwie Błotne</h3>\r\n<p>Żółwie błotne to fascynujące zwierzęta, które żyją w bagnach i wilgotnych siedliskach. U nas mają odpowiednie warunki do wspinania się i eksplorowania, a także zdrową dietę.</p>\r\n<img src=\"img/03.jpg\">\r\n<p class=\"podpis\"> żółw Radosław </p>\r\n<h3>Żółwie Mapowe</h3>\r\n<p>Te żółwie charakteryzują się wyjątkowym wzorem na skorupie, który przypomina mapę. Są to piękne i ciekawe stworzenia, którym zapewniamy odpowiednie warunki do rozwoju.</p>\r\n<img src=\"img/04.jpg\">\r\n<p class=\"podpis\"> żółw Adam </p>\r\n<h3>Żółwie Żółtolice</h3>\r\n<p>Żółwie żółtolice to gatunek wyróżniający się charakterystyczną żółtą skorupą, która nadaje im unikalny wygląd. Są one znane z ich spokojnego temperamentu i zdolności do życia w różnorodnych środowiskach wodnych. Nasza hodowla dba o stworzenie dla nich odpowiednich warunków, aby mogły rosnąć zdrowo i szczęśliwie.</p>\r\n<img src=\"img/05.jpg\">\r\n<p class=\"podpis\"> żółwie Marek i Mariola </p>\r\n<h3>Żółwie Żwirowe</h3>\r\n<p>Żółwie żwirowe to gatunek, który żyje w płytkich i żwirowych rzekach oraz strumieniach. Ich zdolność do maskowania się w środowisku oraz umiejętność przemieszczania się na suchym lądzie czynią je fascynującymi stworzeniami. Nasza hodowla zapewnia im dostęp do odpowiednich siedlisk i karmienie, aby zadbać o ich zdrowie i dobrostan.</p>\r\n<img src=\"img/06.jpg\">\r\n<p class=\"podpis\"> żółwica Martyna </p>', 1),
(4, 'pielęgnacja', '<h2>Jak Zadbać o Żółwie Wodne</h2>\r\n<p> Hodowla żółwi wodnych to pasjonujące wyzwanie, które wymaga odpowiedniej wiedzy i troski. W naszej hodowli priorytetem jest zapewnienie naszym podopiecznym najlepszych warunków życia i opieki. Oto kilka kluczowych kwestii, które warto wziąć pod uwagę, aby zapewnić zdrowie i dobrostan żółwi wodnych: </p>\r\n<h3>1. Warunki Akwariowe:</h3>\r\n<ul>\r\n    <li>Akwarium lub oczko wodne powinno być odpowiednio przystosowane do potrzeb żółwi. Upewnij się, że zapewniłeś odpowiednią ilość miejsca, filtry, grzałki i oświetlenie.</li>\r\n    <li>Dno akwarium powinno być z odpowiednim podłożem, na przykład żwirowym lub piaskowym.</li>\r\n    <li>Zapewniaj ukryte miejsca i elementy dekoracyjne, gdzie żółwie mogą schować się lub eksplorować.</li>\r\n</ul>\r\n<h3>2. Temperatura Wody:</h3>\r\n<ul>\r\n    <li>Żółwie wodne wymagają odpowiedniej temperatury wody. Upewnij się, że temperatura jest utrzymana w odpowiednim zakresie dla danego gatunku.</li>\r\n    <li>Warto zainwestować w termometr do monitorowania temperatury w akwarium.</li>\r\n    <li>Dostosowuj temperaturę wody zgodnie z sezonami i potrzebami żółwi.</li>\r\n</ul>\r\n<h3>3. Karmienie:</h3>\r\n<ul>\r\n    <li>Dieta żółwi wodnych powinna być zróżnicowana. Oferuj różne rodzaje pożywienia, takie jak pellety, ryby, owady i rośliny wodne.</li>\r\n    <li>Pamiętaj, aby karmić żółwie zgodnie z ich potrzebami, unikając nadmiernego podawania pokarmu.</li>\r\n    <li>Monitoruj ich apetyt i dostosowuj ilość karmienia w zależności od aktywności żółwi.</li>\r\n</ul>\r\n<h3>4. Czystość Wody:</h3>\r\n<ul>\r\n    <li>Regularnie kontroluj i utrzymuj czystość wody w akwarium. Wykorzystuj filtry i przeprowadzaj częste zmiany wody.</li>\r\n    <li>Monitoruj poziomy amoniaku, azotynów i innych substancji, aby zapewnić dobre warunki dla żółwi.</li>\r\n    <li>Oczyszczaj i konserwuj filtry regularnie.</li>\r\n</ul>\r\n<h3>5. Siedlisko Lądowe:</h3>\r\n<ul>\r\n    <li>Żółwie wodne potrzebują dostępu do siedliska lądowego, gdzie mogą wypoczywać i opalać się. Zapewnij im suchy i ciepły punkt, np. podgrzewany kamień lub platformę.</li>\r\n    <li>Upewnij się, że dostęp do siedliska lądowego jest łatwo dostępny z wody, aby żółwie mogły swobodnie przemieszczać się.</li>\r\n</ul>\r\n<h3>6. Weterynarz:</h3>\r\n<ul>\r\n    <li>Regularnie odwiedzaj weterynarza specjalizującego się w zwierzętach wodnych. Profesjonalna opieka zdrowotna jest kluczowa dla długotrwałego dobrego stanu zdrowia twoich żółwi.</li>\r\n    <li>Planuj rutynowe kontrole weterynaryjne i szczepienia, jeśli są zalecane dla danego gatunku.</li>\r\n</ul>\r\n<h3>7. Edukacja:</h3>\r\n<ul>\r\n    <li>Edukuj się na temat specyfiki gatunku żółwi, które hodujesz. Wiedza o ich zachowaniach, środowiskach naturalnych i potrzebach jest niezwykle ważna.</li>\r\n    <li>Udostępniaj informacje i edukuj innych, aby zwiększyć świadomość na temat ochrony i zachowania żółwi wodnych.</li>\r\n</ul>\r\n<h3>8. Zachowanie Naturalne:</h3>\r\n<ul>\r\n    <li>Stosuj się do zasad ochrony przyrody. Nie wypuszczaj żółwi do środowiska naturalnego bez konsultacji z lokalnymi władzami.</li>\r\n    <li>Wspieraj projekty ochrony i badania nad zachowaniem żółwi w ich naturalnych siedliskach.</li>\r\n</ul>\r\n<p>Dbając o te aspekty, możesz zapewnić zdrowie i dobrostan swoim żółwiom wodnym. Hodowla żółwi to nie tylko pasja, ale również odpowiedzialność wobec tych fascynujących stworzeń.</p>', 1),
(5, 'sukcesy', '<h2>Nasze Sukcesy</h2>\r\n<p>W naszej hodowli żółwi wodnych nieustannie dążymy do podnoszenia standardów hodowli i zaangażowania się w różne inicjatywy związane z ochroną tych fascynujących stworzeń. Chcemy podzielić się z tobą naszymi sukcesami, wydarzeniami oraz osiągnięciami w świecie hodowli i ochrony żółwi.</p>\r\n<h3>Nowe Przybytki</h3>\r\n<p>Regularnie witamy nowe żółwie w naszej hodowli. To dla nas zawsze wyjątkowe chwile, kiedy możemy powitać kolejne osobniki do naszej rodziny. Obserwuj naszą galerię zdjęć, aby zobaczyć naszych najnowszych podopiecznych i poznać ich historie.</p>\r\n<img src=\"img/07.jpg\">\r\n<p class=\"podpis\"> nasze nowoprzybyłe żółwiki </p>\r\n<h3>Sukcesy Hodowlane</h3>\r\n<p>Nasze wysiłki w dziedzinie hodowli przynoszą owoce. Chlubimy się licznymi sukcesami hodowlanymi, w tym udanymi lęgami i rosnącą populacją żółwi w naszej hodowli. Zobacz zdjęcia młodych żółwi, które urodziły się w naszym akwarium.</p>\r\n<img src=\"img/08.jpg\">\r\n<p class=\"podpis\"> jaja żółwi w inkubatorze </p>', 1),
(6, 'galeria', '<h2>Galeria</h2>\r\n<img src=\"img/01.jpg\">\r\n<p class=\"podpis\"> żółw Bartek </p>\r\n<img src=\"img/02.jpg\">\r\n<p class=\"podpis\"> żółwica Aneta </p>\r\n<img src=\"img/03.jpg\">\r\n<p class=\"podpis\"> żółw Radosław </p>\r\n<img src=\"img/04.jpg\">\r\n<p class=\"podpis\"> żółw Adam </p>\r\n<img src=\"img/05.jpg\">\r\n<p class=\"podpis\"> żółwie Marek i Mariola </p>\r\n<img src=\"img/06.jpg\">\r\n<p class=\"podpis\"> żółwica Martyna </p>\r\n<img src=\"img/07.jpg\">\r\n<p class=\"podpis\"> nasze nowoprzybyłe żółwiki </p>\r\n<img src=\"img/08.jpg\">\r\n<p class=\"podpis\"> jaja żółwi w inkubatorze </p>\r\n<img src=\"img/09.jpg\">\r\n<p class=\"podpis\"> żółwie w grze Minecraft </p>\r\n<img src=\"img/10.jpg\">\r\n<p class=\"podpis\"> żółw w bajce Gdzie jest Nemo </p>\r\n<img src=\"img/11.jpg\">\r\n<p class=\"podpis\"> żółw słonowodny w grze Sons of the Forest </p>\r\n<img src=\"img/12.jpg\">\r\n<p class=\"podpis\"> kociak udający żółwia </p>\r\n<img src=\"img/13.jpg\">\r\n<p class=\"podpis\"> hybryda żółwia z kotem(?) </p>\r\n<img src=\"img/14.jpg\">\r\n<p class=\"podpis\"> kicia przytulająca żółwika </p>\r\n<img src=\"img/15.jpg\">\r\n<p class=\"podpis\"> kot używający żółwia jako środek transportu </p>', 1),
(7, 'kontakt', '<div class=\"contact-form\">\r\n<h2>Kontakt</h2>\r\n<p>Skontaktuj się z nami, wypełniając poniższy formularz:</p>\r\n<form action=\"mailto:luckiewiczlukasz@gmail.com\" method=\"post\" enctype=\"text/plain\">\r\n    Imię:<br><input type=\"text\" name=\"imie\"><br>\r\n    Email:<br><input type=\"email\" name=\"email\"><br>\r\n    Wiadomość:<br><textarea name=\"wiadomosc\" rows=\"4\" cols=\"50\"></textarea><br>\r\n    <input type=\"submit\" value=\"Wyślij\">\r\n</form>', 1),
(19, 'fajna podstrona', 'fajna zawartość', 1),
(21, 'filmiki', '<iframe\r\nsrc=\"https://www.youtube.com/embed/xk9rsfXtmOI\">\r\n</iframe>\r\n<p class=\"podpis\"> filmik na yt o żółwiach </p>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` longtext NOT NULL,
  `data_utworzenia` date NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` date NOT NULL DEFAULT current_timestamp(),
  `data_wygasniecia` date NOT NULL,
  `cena_netto` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `kategoria` int(11) NOT NULL,
  `gabaryt` decimal(10,2) NOT NULL,
  `zdj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nazwa`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `vat`, `ilosc`, `status`, `kategoria`, `gabaryt`, `zdj`) VALUES
(1, 'żółw błotny', 'żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny żółw błotny ', '2024-01-23', '2024-01-23', '2024-05-01', 10.99, 2.00, 15, 1, 1, 50.68, 'https://www.terrarium.pl/uploads/monthly_03_2013/ccs-3-0-94987400-1364691093.jpg'),
(2, '235', '2345', '2024-01-23', '2100-12-31', '2024-01-23', 2345.00, 3425.00, 2345, 1, 2345, 345.00, 'https://scontent-fra3-2.xx.fbcdn.net/v/t39.30808-1/396099802_4366683310224405_5869658680529809336_n.jpg?stp=dst-jpg_p200x200&_nc_cat=111&ccb=1-7&_nc_sid=5740b7&_nc_ohc=UpDwlncC5pYAX8fm-Y3&_nc_ht=scontent-fra3-2.xx&oh=00_AfDfqQxIXSQNE-SDrTpTfQAvxSwx2vNhQCX7y014tG6yxQ&oe=65B5197D'),
(3, 'kuba baranowski', 'baranowski', '2024-01-23', '2024-01-23', '2024-01-23', 0.00, 0.01, 1, 1, 1, 100.01, 'https://scontent-fra3-2.xx.fbcdn.net/v/t39.30808-1/396099802_4366683310224405_5869658680529809336_n.jpg?stp=dst-jpg_p200x200&_nc_cat=111&ccb=1-7&_nc_sid=5740b7&_nc_ohc=UpDwlncC5pYAX8fm-Y3&_nc_ht=scontent-fra3-2.xx&oh=00_AfDfqQxIXSQNE-SDrTpTfQAvxSwx2vNhQCX7y014tG6yxQ&oe=65B5197D');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
