-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Lut 2023, 21:29
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `library`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(150) NOT NULL,
  `home` varchar(5) NOT NULL,
  `number` varchar(5) DEFAULT NULL,
  `postal_code` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `address`
--

INSERT INTO `address` (`id`, `street`, `home`, `number`, `postal_code`, `city`, `country`) VALUES
(1, 'Wojska Polskiego', '12', '3', '75-957', 'Koszalin', 'Polska'),
(2, 'Zwycięstwa', '168', '15', '75-996', 'Koszalin', 'Polska'),
(3, 'Mickiewicza', '60', '14', '71-547', 'Szczecin', 'Polska'),
(5, 'Grabieżcy', '15', '3', '74-658', 'Szczecin', 'Polska'),
(6, 'Andrzeja Struga', '5', '', '75-456', 'Koszalin', 'Polska'),
(7, 'Mickiewicza', '70', '15', '70-658', 'Szczecin', 'Polska'),
(8, 'Wyspiańskiego', '20', '7', '75-258', 'Koszalin', 'Polska'),
(9, 'Andrzeja Struga', '25B', '2A', '70-582', 'Szczecin', 'Polska'),
(10, 'Bagienna', '12', '2', '32-122', 'Honolulu', 'Polska'),
(11, 'Grunwaldzka', '12', '5', '70-554', 'Szczecin', 'Polska'),
(12, 'Giżycka', '7', '20', '73-154', 'Mierzym', 'Polska'),
(13, 'Teofila Starzyńskiego', '256A', '', '70-506', 'Szczecin', 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(4, 'SuperAdmin', 'MjTE8sYyX_KnKw8t0GbliYRTeasdIF2W', '$2y$13$chRLz7ayBYDDveDMP0P8h.9oetb4KAlw5yX65XH94VFo/k2e5nvF.', NULL, 'test@example.com', 9, 1676896486, 1676896486, 'wkc5vWfK-3fCyYV7uUhiU0rrsKJlrN_6_1676896486');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autors`
--

CREATE TABLE `autors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `autors`
--

INSERT INTO `autors` (`id`, `name`, `surname`, `country`) VALUES
(1, 'Weronika', 'Marczak', 'Polska'),
(2, 'B.A.', 'Paris', 'Wielka Brytania'),
(5, 'Jennifer L.', 'Armentrout', 'Wielka Brytania'),
(6, 'Anita', 'Głowinska', 'Polska'),
(18, 'Stephen', 'King', 'Wielka Brytania'),
(19, 'Soren', 'Sveistrup', 'Niemcy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publ_year` year(4) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(300) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `title`, `autor_id`, `category_id`, `publ_year`, `description`, `img`, `quantity`) VALUES
(2, 'Królewna. Rodzina Monet. Tom 2. Część 1', 1, 1, 2023, 'Nieważne, jakiej wagi ciężarki podniesiesz na siłowni lub jak często zapłaczesz w samotności. Siła to coś więcej, to determinacja, a ty, moja królewno, determinację masz we krwi. Jesteś Monet.\r\n\r\nWydawałoby się, że życie młodej i poukładanej Hailie nareszcie będzie prostsze.\r\n\r\nNastolatka powoli oswaja się z nową sytuacją i przyzwyczaja do pięciu starszych i bogatych braci. Coraz odważniej walczy o swoje i korzysta z przywilejów związanych z przynależnością do rodziny Monet.\r\n\r\nRodzinne wakacje w Tajlandii są zapowiedzią nowego, lepszego rozdziału w życiu dziewczyny. Idylla nie trwa jednak długo. Na rajskiej wyspie czeka na Hailie obcy i podejrzanie wyglądający mężczyzna. Kim jest ten tajemniczy człowiek? Dlaczego tak zabiega o jej względy? I jaki jest prawdziwy cel tej egzotycznej podróży?\r\n\r\nDrugi tom bestsellerowej serii, którą pokochały tysiące czytelniczek i czytelników na całym świecie!\r\n\r\nPowyższy opis pochodzi od wydawcy. ', 'rodzinamonet-królewna.jpg', 0),
(4, 'Krew i popiół. Tom 1', 5, 3, 2022, 'Pierwszy tom cyklu \"Z krwi i popiołu\". Niezwykła powieść z gatunku new adult dla wszystkich miłośników fantasy.\r\n\r\nPorzucone przez bogów i budzące strach w śmiertelnikach, upadłe królestwo znowu powstaje, by przemocą i zemstą odebrać to, co uznaje za swoją własność. A kiedy cień przeklętych zbliża się coraz bardziej, zaciera się granica między tym, co zakazane, a tym, co słuszne. Poppy może nie tylko zostać uznana za niegodną przez bogów, ale również stracić serce, a nawet życie, kiedy przesiąknięte krwią więzy spajające jej świat zaczną się strzępić.\r\n\r\n\"Jennifer L. Armentrout stworzyła świat fantasy, który wciągnie was bez reszty i kompletnie zawróci wam w głowach.\"\r\nElena, the Bibliotheque Bio\r\n\r\n\"Fantastyczny świat pisany z najdrobniejszymi szczegółami, bohaterowie z krwi i kości!\"\r\nBookBesties\r\n\r\n\"Już od pierwszego zdania Jennifer L. Armentrout zawładnęła moimi emocjami.\"\r\nBrigid Kemmerer, autorka bestsellerów z listy The New York Timesa\r\n\r\n\"Akcja, przygoda, seks i napięcie! Krew i popiół ma w sobie to wszystko i znacznie więcej. Główna bohaterka od pierwszej chwili stała się moją ulubienicą. Uwaga: ta książka uzależnia!\"\r\nTijan, autorka bestsellerów z listy The New York Timesa\r\n\r\n\"Krew i popiół to genialna powieść fantasy, która zawładnie waszą wyobraźnią. Jennifer L. Armentrout znowu wspięła się na wyżyny.\"\r\nAmanda@Stuck In YA Books\r\n\r\nPowyższy opis pochodzi od wydawcy. ', 'krewipopiol1.jpg', 5),
(5, 'Kicia i Nunuś. Na nocniku', 6, 5, 2016, 'Nunuś, młodszy brat Kici Koci, uczy się korzystać z nocnika. Na początku nie jest to łatwe, ale Kicia Kocia wpada na znakomity pomysł…\r\nKsiążeczki o Nunusiu drukowane na twardych, kartonowych stronach przeznaczone są dla najmłodszych czytelników dopiero rozpoczynających swoje przygody z literaturą.\r\n\r\n\r\nPowyższy opis pochodzi od wydawcy.', 'kiciainunus.jpg', 0),
(32, 'Outsider', 18, 4, 2020, 'Outsider\r\n\r\nStephen King jest uznanym pisarzem, jednym z najlepszych twórców kryminałów naszych czasów. Z jego szczególnie owocnego okresu twórczości pochodzi kryminał pod tytułem „Outsider”. O czym jest ta książka?\r\n\r\nU Kinga nic nie jest tak oczywiste, jakim się wydaje\r\n\r\nBestialska zbrodnia, której ofiarą staje się jedenastoletni chłopiec, mobilizuje służby mundurowe Flint City do natychmiastowego działania. Policja szybko aresztuje podejrzanego, trenera Terry’ego Maitlanda, na którego wskazują dowody. Sprawa wydaje się oczywista, pomimo że podejrzany o zabicie i zmasakrowanie ciała dziecka ma alibi. Ten wstęp do „Outsidera” z pewnością sprawi, że będziesz chciał dowiedzieć się, co stanie się z Terrym i kto naprawdę popełnił zbrodnię? Czy winny ostatecznie zostanie ukarany?\r\n\r\nWciągająca, niepokojąca opowieść\r\n\r\nJak to bywa u Kinga, intryga w książce „Outsider” wciąga czytelnika od pierwszych stron. Odkrywaj poszlaki razem z detektywem Ralphem Andersonem. Poczuj napięcie, jakie narasta w książce wraz z odkrywaniem kolejnych szczegółów przerażającej zbrodni. Czy rzeczywiście dotychczas szanowany obywatel i sympatyczny mężczyzna, Terry Maitland, ma drugie oblicze – bezwzględnego mordercy? Odpowiedź Cię zaskoczy. Przekonaj się, jak Stephen King rozwiązał akcję książki „Outsider”.\r\n\r\n\r\nPowyższy opis pochodzi od wydawcy.', 'outsider.jpg', 11),
(33, 'Billy Summers', 18, 4, 2021, 'Najnowsza książka mistrza gatunku.\r\n\r\nBilly Summers jest najlepszy w swoim fachu. Eliminuje ludzi, ale tylko tych naprawdę złych. Był snajperem w Iraku, więc zna się na rzeczy i zawsze strzela celnie. Tym razem przyjmuje ostatnie zlecenie. Czas w końcu na zasłużoną emeryturę.  \r\nNiestety, coś idzie nie tak… A nawet wszystko.\r\n\r\nPowyższy opis pochodzi od wydawcy.', 'billysummers.jpg', 8),
(34, 'Dylemat', 2, 2, 2020, 'Dylemat\r\n\r\nNa co dzień podejmujesz wiele decyzji – tych mniej znaczących, ale też poważnych, które mogą rzutować na życie Twoje i innych. Przed takimi wyborami stanie także bohaterka książki „Dylemat” autorstwa B.A. Paris. Na co ostatecznie się zdecyduje?\r\n\r\nTytułowy „Dylemat” – czego dotyczy?\r\n\r\nBohaterką thrillera B.A. Paris jest Livia – dojrzała kobieta, która od lat ma u boku wspaniałego męża, Adama. Zakochała się w nim jako nastolatka i wbrew woli rodziców nawiązała głęboką relację. Para ma dwójkę dzieci. Po kilku latach wspólnego życia z Adamem Livia próbowała odnowić kontakt ze swoimi rodzicami, ale nie udało jej się to. Mimo odcięcia od swoich korzeni, jakoś ułożyła sobie życie.\r\n\r\nUrodziny Livii\r\n\r\nLivia niebawem skończy 40 lat i szykuje się do hucznego świętowania. W tym przełomowym czasie podejmuje ona ostatnią próbę pogodzenia się z rodzicami. Wysyła zaproszenie i liczy na to, że jej matka i ojciec dotrą na urodziny. Niestety, na przyjęciu nie będzie Marnie, córki Livii i Adama. W tym fakcie kobieta upatruje szansę na to, by wyznać mężowi dawno skrywaną prawdę. Co to będzie? Czy życie bohaterów wywróci się do góry nogami?\r\n\r\nJaką niespodziankę ma dla Livii jej mąż? Zanim prezent zostanie wręczony mężczyzna dokona szokującego odkrycia. Czy opowie o nim żonie? Oboje staną przed ważnymi dylematami. Zobacz, co stanie się na urodzinach Livii.', 'dylemat.jpg', -39),
(35, 'Kasztanowy Ludzik', 19, 2, 2021, 'Jeżeli znalazłeś kasztanowego ludzika, to znaczy, że jest już za późno...\r\n\r\nKsiążka, która zainspirowała twórców serialu „Kasztanowy ludzik” Netflixa.\r\n\r\nPsychopata terroryzuje Kopenhagę - krwawo morduje swe ofiary, a na miejscach zbrodni pozostawia ręcznie zrobione kasztanowe ludziki. Policja szybko odkrywa, że ślady w tajemniczy sposób prowadzą do dziewczynki, która została uznana za martwą – chodzi o porwaną rok wcześniej córkę minister spraw społecznych. Do jej zabicia przyznał się pewien mężczyzna, a sprawę uznano za wyjaśnioną. Tragiczny zbieg okoliczności czy też te dwie sprawy faktycznie łączy coś mrocznego? Kim jest tajemniczy morderca?\r\n\r\nBy ocalić niewinnych, detektywi muszą połączyć siły i toczyć walkę z czasem. Ponieważ szaleniec ma misję, która jeszcze się nie skończyła... Nikt nie jest bezpieczny!\r\n\r\n\"Scenarzysta \"The Killing\" debiutuje powieściowym thrillerem i jest to debiut doskonały! Mam wszystko, za czym tęskniłem: perfekcyjnie skonstruowaną mroczną historię kryminalną mocno osadzoną w realiach społeczno-politycznych, wyrazistych bohaterów, nieoczywiste wybory i niepokój, który zostaje z nami po zakończeniu lektury. Mistrzostwo\".\r\n\r\nMarcin Meller\r\n\r\n\"Książka pełna adrenaliny, będziesz spijać każde słowo! Pokochałem ten thriller!\"\r\n\r\nA.J. Finn, autor \"Kobiety w oknie\"\r\n\r\nPowyższy opis pochodzi od wydawcy.', 'kasztanowy ludzik.jpg', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `reader_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `return_date` datetime NOT NULL,
  `returned` tinyint(1) NOT NULL,
  `returned_date` datetime DEFAULT NULL,
  `extend_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `borrow`
--

INSERT INTO `borrow` (`id`, `date_time`, `reader_id`, `book_id`, `return_date`, `returned`, `returned_date`, `extend_quantity`) VALUES
(1, '2023-01-31 12:12:02', 3, 33, '2023-01-17 00:00:00', 1, '2023-02-01 08:30:16', 0),
(2, '2023-01-31 11:26:21', 4, 34, '2023-03-03 08:52:50', 1, '2023-02-01 16:12:43', 0),
(3, '2023-01-31 12:27:51', 5, 35, '2023-01-23 18:12:56', 1, '2023-02-01 18:24:13', 0),
(4, '2023-01-31 12:11:31', 3, 32, '2023-10-13 00:00:00', 1, '2023-02-01 16:50:27', 0),
(5, '2023-01-31 09:52:15', 5, 33, '2023-07-01 00:00:00', 1, '2023-02-03 15:46:58', 0),
(6, '2023-02-01 15:30:52', 5, 4, '2023-09-29 15:30:52', 1, '2023-02-01 17:50:03', 0),
(7, '2023-02-01 15:36:49', 7, 2, '2023-03-03 15:36:49', 1, '2023-02-01 15:48:51', 0),
(8, '2023-02-01 15:44:01', 3, 2, '2023-03-03 15:44:01', 1, '2023-02-01 15:47:44', 0),
(9, '2023-02-01 15:49:03', 3, 2, '2023-02-06 00:00:00', 1, '2023-02-03 14:40:48', 0),
(10, '2023-02-01 15:49:18', 5, 2, '2023-01-24 15:49:18', 1, '2023-02-01 15:51:21', 0),
(11, '2023-02-01 15:49:30', 3, 2, '2023-01-05 15:49:30', 1, '2023-02-01 15:51:00', 0),
(12, '2023-02-01 16:05:14', 7, 33, '2023-05-02 00:00:00', 1, '2023-02-03 15:46:57', 0),
(13, '2023-02-01 17:20:54', 3, 2, '2023-02-01 00:00:00', 1, '2023-02-03 14:41:02', 2),
(14, '2023-02-01 18:18:15', 4, 34, '2023-01-23 00:00:00', 1, '2023-02-02 12:33:52', 0),
(15, '2023-02-01 18:20:32', 3, 34, '2023-02-01 00:00:00', 1, '2023-02-02 12:54:26', 0),
(16, '2023-02-02 09:55:58', 8, 2, '2023-02-01 00:00:00', 1, '2023-02-02 12:33:50', 0),
(17, '2023-02-02 10:34:57', 4, 33, '2023-02-08 23:59:00', 1, '2023-02-03 15:47:05', 2),
(18, '2023-02-02 12:25:03', 3, 35, '2023-01-08 00:00:00', 1, '2023-02-02 12:34:05', 0),
(19, '2023-02-02 12:25:13', 3, 34, '2023-02-01 23:59:00', 1, '2023-02-03 17:23:37', 2),
(20, '2023-02-02 12:25:26', 3, 4, '2023-02-01 00:00:00', 1, '2023-02-02 12:54:11', 0),
(21, '2023-02-02 12:53:13', 10, 33, '2023-03-04 00:00:00', 1, '2023-02-03 12:00:18', 0),
(22, '2023-02-02 13:10:10', 10, 34, '2023-02-09 00:00:00', 1, '2023-02-03 12:00:40', 1),
(23, '2023-02-02 13:15:32', 7, 33, '2023-03-04 00:00:00', 1, '2023-02-03 11:34:24', 2),
(24, '2023-02-02 15:39:11', 12, 33, '2023-02-19 00:00:00', 1, '2023-02-02 15:40:05', 0),
(25, '2023-02-03 11:17:12', 3, 33, '2023-03-05 00:00:00', 1, '2023-02-03 11:19:20', 0),
(26, '2023-02-03 11:17:19', 3, 35, '2023-03-05 00:00:00', 1, '2023-02-03 15:46:56', 0),
(27, '2023-02-03 11:19:05', 5, 4, '2023-03-05 00:00:00', 1, '2023-02-03 15:47:01', 0),
(28, '2023-02-03 11:34:33', 7, 33, '2023-02-18 00:00:00', 1, '2023-02-03 15:47:02', 0),
(29, '2023-02-03 12:01:09', 3, 33, '2023-03-05 00:00:00', 1, '2023-02-03 15:47:00', 0),
(30, '2023-02-03 12:01:52', 4, 2, '2023-02-08 00:00:00', 1, '2023-02-03 12:02:54', 2),
(31, '2023-02-03 15:15:25', 3, 4, '2023-02-05 23:59:00', 1, '2023-02-03 15:46:50', 1),
(32, '2023-02-03 15:19:23', 3, 35, '2023-02-05 00:00:00', 1, '2023-02-03 15:47:03', 0),
(33, '2023-02-03 15:47:19', 3, 2, '2023-02-05 23:59:00', 0, NULL, 0),
(34, '2023-02-03 15:47:29', 3, 4, '2023-02-06 23:59:00', 1, '2023-02-03 17:23:16', 0),
(35, '2023-02-03 15:47:49', 4, 32, '2023-03-05 23:59:00', 1, '2023-02-06 16:27:47', 0),
(36, '2023-02-03 15:47:57', 7, 33, '2023-02-19 23:59:00', 1, '2023-02-18 12:57:56', 2),
(37, '2023-02-03 17:14:21', 8, 34, '2023-02-18 23:59:00', 1, '2023-02-15 13:52:35', 0),
(38, '2023-02-15 11:14:14', 5, 33, '2023-02-22 23:59:00', 1, '2023-02-15 18:20:05', 2),
(39, '2023-02-15 11:40:30', 8, 35, '2023-03-12 23:59:00', 0, NULL, 1),
(40, '2023-02-16 13:21:09', 8, 35, '2023-02-26 23:59:00', 1, '2023-02-17 19:10:22', 0),
(41, '2023-02-17 18:36:43', 4, 34, '2023-02-28 23:59:00', 0, NULL, 1),
(42, '2023-02-17 19:09:53', 7, 33, '2023-02-24 23:59:00', 1, '2023-02-18 12:57:46', 1),
(43, '2023-02-18 12:58:57', 7, 32, '2023-03-20 23:59:00', 1, '2023-02-18 12:59:27', 0),
(44, '2023-02-18 13:00:57', 7, 35, '2023-02-19 23:59:00', 1, '2023-02-20 08:39:08', 0),
(45, '2023-02-19 08:26:13', 13, 32, '2023-02-19 23:59:00', 1, '2023-02-20 02:32:39', 0),
(46, '2023-02-20 02:29:39', 9, 32, '2023-03-22 23:59:00', 1, '2023-02-20 02:30:07', 0),
(47, '2023-02-20 02:41:45', 14, 33, '2023-03-22 23:59:00', 0, NULL, 0),
(48, '2023-02-20 02:42:41', 13, 2, '2023-03-02 23:59:00', 0, NULL, 2),
(49, '2023-02-20 08:36:59', 11, 33, '2023-03-27 23:59:00', 0, NULL, 1),
(50, '2023-02-20 14:28:53', 11, 4, '2023-02-25 23:59:00', 0, NULL, 0),
(51, '2023-02-20 14:31:03', 11, 35, '2023-03-07 23:59:00', 0, NULL, 0),
(52, '2023-02-20 14:31:37', 11, 2, '2023-03-22 23:59:00', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Dla młodzieży'),
(2, 'Kryminał, Sensacja, Thriller'),
(3, 'Fantastyka'),
(4, 'Horror'),
(5, 'Dla dzieci');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afganistan'),
(2, 'Albania'),
(3, 'Algieria'),
(4, 'Andora'),
(5, 'Angola'),
(6, 'Antigua i Barbuda'),
(7, 'Arabia Saudyjska'),
(8, 'Argentyna'),
(9, 'Armenia'),
(10, 'Australia'),
(11, 'Austria'),
(12, 'Azerbejdżan'),
(13, 'Bahamy'),
(14, 'Bahrajn'),
(15, 'Bangladesz'),
(16, 'Barbados'),
(17, 'Belgia'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Białoruś'),
(22, 'Boliwia'),
(23, 'Bośnia i Hercegowina'),
(24, 'Botswana'),
(25, 'Brazylia'),
(26, 'Brunei'),
(27, 'Bułgaria'),
(28, 'Burkina Faso'),
(29, 'Burundi'),
(30, 'Chile'),
(31, 'Chiny'),
(32, 'Chorwacja'),
(33, 'Cypr'),
(34, 'Czad'),
(35, 'Czarnogóra'),
(36, 'Czechy'),
(37, 'Dania'),
(38, 'Demokratyczna Republika Konga'),
(39, 'Dominika'),
(40, 'Dominikana'),
(41, 'Dżibuti'),
(42, 'Egipt'),
(43, 'Ekwador'),
(44, 'Erytrea'),
(45, 'Estonia'),
(46, 'Eswatini'),
(47, 'Etiopia'),
(48, 'Fidżi'),
(49, 'Filipiny'),
(50, 'Finlandia'),
(51, 'Francja'),
(52, 'Gabon'),
(53, 'Gambia'),
(54, 'Ghana'),
(55, 'Grecja'),
(56, 'Grenada'),
(57, 'Gruzja'),
(58, 'Gujana'),
(59, 'Gwatemala'),
(60, 'Gwinea'),
(61, 'Gwinea Bissau'),
(62, 'Gwinea Równikowa'),
(63, 'Haiti'),
(64, 'Hiszpania'),
(65, 'Holandia'),
(66, 'Honduras'),
(67, 'Indie'),
(68, 'Indonezja'),
(69, 'Irak'),
(70, 'Iran'),
(71, 'Irlandia'),
(72, 'Islandia'),
(73, 'Izrael'),
(74, 'Jamajka'),
(75, 'Japonia'),
(76, 'Jemen'),
(77, 'Jordania'),
(78, 'Kambodża'),
(79, 'Kamerun'),
(80, 'Kanada'),
(81, 'Katar'),
(82, 'Kazachstan'),
(83, 'Kenia'),
(84, 'Kirgistan'),
(85, 'Kiribati'),
(86, 'Kolumbia'),
(87, 'Komory'),
(88, 'Kongo'),
(89, 'Korea Południowa'),
(90, 'Korea Północna'),
(91, 'Kostaryka'),
(92, 'Kuba'),
(93, 'Kuwejt'),
(94, 'Laos'),
(95, 'Lesotho'),
(96, 'Liban'),
(97, 'Liberia'),
(98, 'Libia'),
(99, 'Liechtenstein'),
(100, 'Litwa'),
(101, 'Luksemburg'),
(102, 'Łotwa'),
(103, 'Macedonia Północna'),
(104, 'Madagaskar'),
(105, 'Malawi'),
(106, 'Malediwy'),
(107, 'Malezja'),
(108, 'Mali'),
(109, 'Malta'),
(110, 'Maroko'),
(111, 'Mauretania'),
(112, 'Mauritius'),
(113, 'Meksyk'),
(114, 'Mikronezja'),
(115, 'Mjanma'),
(116, 'Mołdawia'),
(117, 'Monako'),
(118, 'Mongolia'),
(119, 'Mozambik'),
(120, 'Namibia'),
(121, 'Nauru'),
(122, 'Nepal'),
(123, 'Niemcy'),
(124, 'Niger'),
(125, 'Nigeria'),
(126, 'Nikaragua'),
(127, 'Norwegia'),
(128, 'Nowa Zelandia'),
(129, 'Oman'),
(130, 'Pakistan'),
(131, 'Palau'),
(132, 'Panama'),
(133, 'Papua-Nowa Gwinea'),
(134, 'Paragwaj'),
(135, 'Peru'),
(136, 'Polska'),
(137, 'Południowa Afryka'),
(138, 'Portugalia'),
(139, 'Republika Środkowoafrykańska'),
(140, 'Republika Zielonego Przylądka'),
(141, 'Rosja'),
(142, 'Rumunia'),
(143, 'Rwanda'),
(144, 'Saint Kitts i Nevis'),
(145, 'Saint Lucia'),
(146, 'Saint Vincent i Grenadyny'),
(147, 'Salwador'),
(148, 'Samoa'),
(149, 'San Marino'),
(150, 'Senegal'),
(151, 'Serbia'),
(152, 'Seszele'),
(153, 'Sierra Leone'),
(154, 'Singapur'),
(155, 'Słowacja'),
(156, 'Słowenia'),
(157, 'Somalia'),
(158, 'Sri Lanka'),
(159, 'Stany Zjednoczone'),
(160, 'Sudan'),
(161, 'Sudan Południowy'),
(162, 'Surinam'),
(163, 'Syria'),
(164, 'Szwajcaria'),
(165, 'Szwecja'),
(166, 'Tadżykistan'),
(167, 'Tajlandia'),
(168, 'Tanzania'),
(169, 'Timor Wschodni'),
(170, 'Togo'),
(171, 'Tonga'),
(172, 'Trynidad i Tobago'),
(173, 'Tunezja'),
(174, 'Turcja'),
(175, 'Turkmenistan'),
(176, 'Tuvalu'),
(177, 'Uganda'),
(178, 'Ukraina'),
(179, 'Urugwaj'),
(180, 'Uzbekistan'),
(181, 'Vanuatu'),
(182, 'Watykan'),
(183, 'Wenezuela'),
(184, 'Węgry'),
(185, 'Wielka Brytania'),
(186, 'Wietnam'),
(187, 'Włochy'),
(188, 'Wybrzeże Kości Słoniowej'),
(189, 'Wyspy Marshalla'),
(190, 'Wyspy Salomona'),
(191, 'Wyspy Świętego Tomasza i Książęca'),
(192, 'Zambia'),
(193, 'Zimbabwe'),
(194, 'Zjednoczone Emiraty Arabskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `days`
--

CREATE TABLE `days` (
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1672765418),
('m130524_201442_init', 1672765424),
('m190124_110200_add_verification_token_column_to_user_table', 1672765424);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `priceperday` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `prices`
--

INSERT INTO `prices` (`id`, `priceperday`) VALUES
(1, 0.5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reader`
--

CREATE TABLE `reader` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `address_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `PESEL` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `reader`
--

INSERT INTO `reader` (`id`, `name`, `surname`, `address_id`, `birth_date`, `PESEL`, `email`, `tel_number`) VALUES
(3, 'Monika', 'Grabiec', 1, '2001-01-02', '11452287457', 'mongrab1@wp.pl', '445874552'),
(4, 'Paweł', 'Robik', 2, '1998-04-10', '98695822457', 'pawel.robik@wp.pl', '111558476'),
(5, 'Wiktoria', 'Parel', 3, '1993-04-15', '14588695236', 'wikpar@wp.pl', '145236587'),
(7, 'Patryk', 'Fifi', 5, '2000-12-01', '96061147588', 'patik@poczta.fm', '154785478'),
(8, 'Zuzanna', 'Borsuk', 6, '1996-06-11', '96061147584', 'zuzia.borsuk@gmail.com', '154785412'),
(9, 'Wojtek', 'Gruszka', 7, '1999-12-15', '99121544835', 'panwojtek@gmail.com', '145825475'),
(10, 'Julia', 'Bożyk', 8, '2001-09-15', '01294852367', 'juliabozyk@poczta.fm', '445998754'),
(11, 'Alicja', 'Wawarska', 9, '2005-01-27', '05012744968', 'wwwala@wp.pl', '154785236'),
(12, 'Patryk', 'Bartoszewski', 10, '1997-07-11', '00233123521', 'nattuasc@wp.pl', '512332123'),
(13, 'Zuzanna', 'Ptak', 11, '2000-01-10', '00541255874', 'ptakzuzanna@gmail.com', '154778556'),
(14, 'Pola', 'Rabka', 12, '2000-01-10', '14558745896', 'polarabka@wp.pl', '154785485'),
(15, 'Właściciel', 'Biblioteki', 13, '1990-01-01', '90010100548', 'biblioteka@ksiazki.com', '159753648');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `price` float NOT NULL,
  `returned_date` datetime NOT NULL,
  `extended` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `returns`
--

INSERT INTO `returns` (`id`, `borrow_id`, `days`, `price`, `returned_date`, `extended`) VALUES
(2, 1, 15, 7.5, '2023-02-01 08:30:16', 0),
(3, 2, 21, 10.5, '2023-02-01 08:52:50', 1),
(4, 8, 0, 0, '2023-02-01 15:47:44', 0),
(5, 7, 0, 0, '2023-02-01 15:48:51', 0),
(6, 9, 1, 0.5, '2023-02-01 15:50:44', 1),
(7, 11, 27, 13.5, '2023-02-01 15:51:00', 0),
(8, 10, 8, 4, '2023-02-01 15:51:21', 0),
(9, 2, 0, 0, '2023-02-01 16:12:43', 0),
(10, 4, 0, 0, '2023-02-01 16:50:27', 0),
(11, 6, 0, 0, '2023-02-01 17:50:03', 0),
(12, 3, 8, 4, '2023-02-01 18:11:40', 1),
(13, 3, 2, 1, '2023-02-01 18:12:56', 1),
(14, 9, 24, 12, '2023-02-01 18:24:00', 1),
(15, 3, 9, 4.5, '2023-02-01 18:24:13', 0),
(16, 13, 0, 0, '2023-02-02 10:37:00', 1),
(17, 17, 9, 4.5, '2023-02-02 12:33:47', 1),
(18, 16, 1, 0.5, '2023-02-02 12:33:50', 0),
(19, 14, 10, 5, '2023-02-02 12:33:52', 0),
(20, 19, 3, 1.5, '2023-02-02 12:34:03', 1),
(21, 18, 25, 12.5, '2023-02-02 12:34:05', 0),
(22, 20, 1, 0.5, '2023-02-02 12:54:11', 0),
(23, 15, 1, 0.5, '2023-02-02 12:54:26', 0),
(24, 24, 0, 0, '2023-02-02 15:40:05', 0),
(25, 17, 2, 1, '2023-02-02 15:40:38', 1),
(26, 25, 0, 0, '2023-02-03 11:19:20', 0),
(27, 23, 0, 0, '2023-02-03 11:34:24', 0),
(28, 21, 0, 0, '2023-02-03 12:00:18', 0),
(29, 22, 0, 0, '2023-02-03 12:00:40', 0),
(30, 30, 0, 0, '2023-02-03 12:02:54', 0),
(31, 9, 0, 0, '2023-02-03 14:40:48', 0),
(32, 13, 2, 1, '2023-02-03 14:41:02', 0),
(33, 19, 2, 1, '2023-02-03 14:56:12', 1),
(34, 31, 0, 0, '2023-02-03 15:46:50', 0),
(35, 26, 0, 0, '2023-02-03 15:46:56', 0),
(36, 12, 0, 0, '2023-02-03 15:46:57', 0),
(37, 5, 0, 0, '2023-02-03 15:46:58', 0),
(38, 29, 0, 0, '2023-02-03 15:47:00', 0),
(39, 27, 0, 0, '2023-02-03 15:47:01', 0),
(40, 28, 0, 0, '2023-02-03 15:47:02', 0),
(41, 32, 0, 0, '2023-02-03 15:47:03', 0),
(42, 17, 0, 0, '2023-02-03 15:47:05', 0),
(43, 34, 0, 0, '2023-02-03 17:23:16', 0),
(44, 19, 2, 1, '2023-02-03 17:23:37', 0),
(45, 35, 0, 0, '2023-02-06 16:27:47', 0),
(46, 37, 0, 0, '2023-02-15 13:52:35', 0),
(47, 36, 10, 5, '2023-02-15 15:17:40', 1),
(48, 38, 0, 0, '2023-02-15 18:20:05', 0),
(49, 40, 0, 0, '2023-02-17 19:10:22', 0),
(50, 42, 0, 0, '2023-02-18 12:57:46', 0),
(51, 36, 0, 0, '2023-02-18 12:57:56', 0),
(52, 43, 0, 0, '2023-02-18 12:59:27', 0),
(53, 46, 0, 0, '2023-02-20 02:30:07', 0),
(54, 45, 1, 0.5, '2023-02-20 02:32:39', 0),
(55, 44, 1, 0.5, '2023-02-20 08:39:08', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `admin`) VALUES
(1, '13', '6bFjpJOOAz_BB6nO3MgHE_QugvUOBrvI', '$2y$13$7ZZlixntVHp9ATc4klbGKuhLZ3cqY6ey7eNa768GFZGenVsl0eic.', NULL, 'ptakzuzanna@gmail.com', 10, 1676835830, 1676835830, 'eSkGOfNTiWh_guMg6pCu1gLG2ttMshkb_1676835830', NULL),
(2, '12', '75HF__x1ozOTTxQC5pQ_vsntlViMKHpr', '$2y$13$NR0/1XbC8Q96EeWpGl1q2uXKei5Y6WH2wvu5mPvmTtp0YRL9G1fgG', NULL, 'nattuasc@wp.pl', 10, 1676842242, 1676859739, 'WYj9gb34GGnyoR0M27O_eJi1tDZWMDfk_1676842242', NULL),
(3, '11', 'TRwNNlEA2n3eKTa-6A41vs94CFpmy9Zb', '$2y$13$TWBF8mWr4bU1g1lNp56mjOx2k1MbuGpMvM1dZ4t/NumPRn4NCrTEy', NULL, 'wwwala@wp.pl', 10, 1676881763, 1676881763, 'IhBIwDQ59NAl4_Vt8CaOIfXSCGZGx4KG_1676881763', NULL),
(4, '3', 'WYAbZmNdt0W32d8sAGQebOe-OX1xAAMI', '$2y$13$KiSCpg9Dqmz11akSR/ij1OwykZulFOAmiJhe7KRxRMmdjQweCIfwW', NULL, 'mongrab1@wp.pl', 9, 1676882897, 1676882897, 'bPTuJoKITpAj8yng5dbt9UA6qXxEJFhr_1676882897', NULL),
(6, '15', 'N76JZNwhdO29rwGtwF2i7HqkVd6WavDZ', '$2y$13$.9YXj8cDQxXA/OnbevHytueuyP4KZLw6qufvDU3xIX0CyNidEJOji', NULL, 'biblioteka@ksiazki.com', 10, 1676897512, 1676897512, 'YxfToxRFrwz5q-toplZ4iwKTMBzAN0aT_1676897512', 1),
(7, '7', 'T7kZjLlbn5-CoO-gvsvlvC7D9Fj5PvxU', '$2y$13$zK1MRAv7dZErTpzE2b6JGeQkdsqOBJk8M0/poIffa6pWglL/pETO6', NULL, 'patik@poczta.fm', 10, 1676897988, 1676897988, 'hXd-9ZEyJ7SqdShUC-OuvZtT9yCxhtri_1676897988', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indeksy dla tabeli `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reader_id` (`reader_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indeksy dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrow_id` (`borrow_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `autors`
--
ALTER TABLE `autors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT dla tabeli `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT dla tabeli `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `reader`
--
ALTER TABLE `reader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ograniczenia dla tabeli `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`reader_id`) REFERENCES `reader` (`id`),
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Ograniczenia dla tabeli `reader`
--
ALTER TABLE `reader`
  ADD CONSTRAINT `reader_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Ograniczenia dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`borrow_id`) REFERENCES `borrow` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
