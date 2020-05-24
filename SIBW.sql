-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: May 24, 2020 at 05:50 PM
-- Server version: 8.0.19
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIBW`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComen` int NOT NULL,
  `idEven` int NOT NULL,
  `autor` varchar(120) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` text NOT NULL,
  `editado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComen`, `idEven`, `autor`, `fecha`, `contenido`, `editado`) VALUES
(1, 1, 'Pedro Martínez de la Rosa', '2020-03-25', 'Máquina', 1),
(2, 1, 'Sebastian Vettel', '2020-03-25', 'Grazzie ragazzi', 1),
(3, 2, 'Romain Grosjean', '2020-03-25', 'Venga Carlitos que lo estás haciendo bastante bien', 0),
(4, 2, 'Jesús Perez', '2020-03-25', 'Este año a pesar del Coronavirus te quiero ver fuerte eh', 0),
(5, 2, 'Fernando Alonso', '2020-03-25', 'Grande!!', 0),
(6, 3, 'Kamui Kobayashi', '2020-03-25', 'Eres un campeón eh', 0),
(7, 3, 'Nico Rosberg', '2020-03-25', 'A ver cuándo te invitas a India y nos tomamos algo', 0),
(8, 4, 'John Cena', '2020-03-25', 'No puedo ni verte de lo rápido que vas... Cuídate', 0),
(9, 4, 'Greta Thungberg', '2020-03-25', 'Yes!!', 0),
(10, 4, 'Juan Carlos de Borbón', '2020-03-25', 'Bien chico bieeen', 0),
(11, 5, 'Josh Verstappen', '2020-03-25', 'Qué orgulloso', 0),
(12, 5, 'Kimi Raikkonen', '2020-03-25', 'Para cuando unas cervezas', 0),
(13, 6, 'Sebastien Buemi', '2020-03-25', 'Vente que he hecho aquí unos croissants que chillas', 0),
(14, 6, 'Luis de Guindos', '2020-03-25', 'Shino veeeen', 0),
(15, 7, 'Will Buxton', '2020-03-25', 'Go Shoey!', 0),
(16, 7, 'Mika Hakkinen', '2020-03-25', 'Vaya fiera el australiano', 0),
(17, 8, 'Serio Pérez', '2020-03-25', 'Eres mi ídolo', 0),
(18, 8, 'Juan Pablo Montoya', '2020-03-25', 'Sin duda el mejor de todos los tiempos', 0),
(19, 8, 'Nico Hulkenberg', '2020-03-25', '¿Por dónde andas ahora?', 0),
(20, 9, 'Charles Leclerc', '2020-03-25', 'Eterno', 0),
(21, 9, 'Adrian Sutil', '2020-03-25', 'Siempre entre nosotros, genio', 0),
(22, 1, 'Raúl Cepeda', '2020-03-25', 'Sigue así', 0),
(23, 3, 'Robert Kubica', '2020-03-25', 'Eres grande!! A ver cuándo nos vemos otra vez', 0),
(24, 5, 'Lucas di Grassi', '2020-03-25', 'A por todas en 2020!', 0),
(25, 6, 'Christian Klien', '2020-03-25', 'Hace tiempo que no nos vemos, puede estar bien', 0),
(35, 1, 'oke', '2020-05-14', 'oke', 0);

-- --------------------------------------------------------

--
-- Table structure for table `etiquetas`
--

CREATE TABLE `etiquetas` (
  `idEtiqueta` int NOT NULL,
  `idEvento` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `etiquetas`
--

INSERT INTO `etiquetas` (`idEtiqueta`, `idEvento`, `nombre`) VALUES
(1, 1, 'rápido'),
(2, 1, 'tenaz'),
(3, 1, 'ágil'),
(4, 16, 'Oke'),
(5, 16, ' si'),
(6, 16, ' mancia'),
(7, 16, ' calva'),
(8, 16, ' manguita'),
(9, 16, ' calva'),
(10, 16, ' calva'),
(11, 16, ' calva'),
(12, 17, 'a'),
(13, 17, 'skeka'),
(14, 17, 'edamklñe'),
(15, 17, 's ka '),
(16, 17, 'e'),
(17, 17, 'qowe'),
(18, 18, 'aaaa'),
(35, 19, 'si'),
(36, 19, ' si'),
(37, 19, ' si'),
(38, 19, ' si'),
(39, 19, ' si'),
(40, 19, ' no'),
(41, 19, ' no'),
(42, 19, ' no'),
(43, 22, 'Oke'),
(44, 22, ' si'),
(45, 22, ' si'),
(46, 22, ' si'),
(47, 22, ' si'),
(48, 22, ' si'),
(49, 23, 'okke'),
(50, 23, ' opke'),
(51, 23, ' oke'),
(52, 23, ' oke'),
(53, 23, ' oke oke oke'),
(54, 23, ' oke'),
(55, 24, 'ada'),
(56, 25, 'adasd'),
(57, 24, 'asdasd'),
(58, 27, 'adasd'),
(59, 2, 'carlos');

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `publicado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `lugar`, `fecha`, `imagen`, `descripcion`, `publicado`) VALUES
(1, 'Fernando Alonso', 'Oviedo, Asturias', '2020-03-19', 'alo.jpg', 'Piloto español de gran talento con 2 campeonatos en su mochila. Ha participado en otras disciplinas como son el Mundial de Resistencia, la IndyCar o el Dakar.', 1),
(2, 'Carlos Sainz Jr', 'Madrid, España', '2020-03-22', 'sai.jpg', 'Carlos Sainz Jr es una jóven promesa actualmente corriendo para McLaren', 1),
(3, 'Narain Karthikeyan', 'Coimbatore, India', '2020-03-20', 'kar.jpeg', 'Uno de los más celebres pilotos de la Fórmula 1. Su última aparición fue con la escuderia Force India.', 1),
(4, 'Lewis Hamilton', 'Stevenage, Reino Unido', '2020-03-20', 'ham.jpg', 'Piloto de gran talento que tiene actualmente 6 títulos mundiales. ¿Será capaz de igualar o superar a Michael Schumacher?', 1),
(5, 'Max Verstappen', 'Hasselt, Bélgica', '2020-03-20', 'ver.jpeg', 'Una de las jóvenes promesas de la Fórmula 1 actual que apunta alto desde que estaba en Toro Rosso. En su primera carrera de debut con Red Bull, la escudería padre de Toro Rosso, ganó su primer Gran Premio en el Circuit de Catalunya.', 1),
(6, 'Takuma Sato', 'Tokio, Japón', '2020-03-20', 'sat.jpg', 'Piloto japonés actualmente corriendo en IndyCar.', 1),
(7, 'Daniel Ricciardo', 'Perth, Australia', '2020-03-20', 'ric.jpg', 'Un piloto de gran valor en la parrilla actual de la F1 que por desgracia aún no ha conseguido grandes cosas en la competición.', 1),
(8, 'Pastor Maldonado', 'Maracay, Venezuela', '2020-03-20', 'mal.jpg', 'Quizás uno de los pilotos más infravalorados durante su paso por la competición.', 1),
(9, 'Jules Bianchi', 'Niza, Francia', '2020-03-20', 'bia.jpg', 'Un piloto que habría sido sin duda uno de los más grandes en la Fórmula 1.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventosPublicados`
--

CREATE TABLE `eventosPublicados` (
  `idEvento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventosPublicados`
--

INSERT INTO `eventosPublicados` (`idEvento`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

CREATE TABLE `galeria` (
  `id` int NOT NULL,
  `idEvento` int NOT NULL,
  `src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeria`
--

INSERT INTO `galeria` (`id`, `idEvento`, `src`) VALUES
(1, 1, 'alo.jpg'),
(2, 1, 'otraalonso.jpg'),
(3, 1, 'dakar.jpg'),
(4, 1, 'alonso.jpg'),
(12, 4, 'hamiltonuno.jpg'),
(14, 4, 'ham.jpg'),
(15, 5, 'ver.jpeg'),
(17, 5, 'max-verstappen-8-1600x1200.jpg'),
(18, 2, 'sai.jpg'),
(19, 2, 'sainzferrari.jpg'),
(20, 3, 'kar.jpeg'),
(21, 3, 'narain.jpg'),
(22, 3, 'narain2.jpg'),
(23, 6, 'sat.jpg'),
(24, 6, 'sato.jpg'),
(25, 6, 'sato2.jpg'),
(26, 7, 'ric.jpg'),
(27, 7, 'ricciardo.jpg'),
(28, 7, 'ricciardo2.jpg'),
(29, 8, 'mal.jpg'),
(30, 8, 'maldonado.jpg'),
(31, 8, 'maldonado2.jpg'),
(32, 9, 'bia.jpg'),
(33, 9, 'bianchi.jpg'),
(34, 9, 'bianchi2.jpg'),
(35, 23, 'Captura de pantalla de 2020-05-13 13-56-11.png'),
(36, 24, 'Captura de pantalla de 2020-05-13 13-56-11.png'),
(37, 25, 'Captura de pantalla de 2020-05-13 13-56-11.png'),
(38, 24, 'Captura de pantalla de 2020-05-13 13-56-11.png'),
(39, 27, 'Captura de pantalla de 2020-05-13 13-56-11.png');

-- --------------------------------------------------------

--
-- Table structure for table `palabras`
--

CREATE TABLE `palabras` (
  `id` int NOT NULL,
  `palabra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `palabras`
--

INSERT INTO `palabras` (`id`, `palabra`) VALUES
(11, 'cerdo'),
(12, 'perro'),
(13, 'gato'),
(14, 'tobillo'),
(15, 'retrete'),
(16, 'aguacate'),
(17, 'Hamilton'),
(18, 'calvo'),
(19, 'enano'),
(20, 'koala');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `moderador` tinyint(1) NOT NULL,
  `gestor` tinyint(1) NOT NULL,
  `super` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `password`, `moderador`, `gestor`, `super`) VALUES
(1, 'Fran', '$2y$10$UP.eHioO.Fp/0OEXlsspQuyvNC.vyYyBm78Hs2rRIlQSIDasEow12', 1, 1, 1),
(3, 'pepe', '$2y$10$Nj7a2E4eG4Mh9X5Jw7Uo4.YLI2HfDohP1A6gfceK.LomjSEou4UWK', 1, 0, 0),
(4, 'john', '$2y$10$Xh3yYxjh55TUE.3740v.XOf2H.5HQFQ49zDtldYKv1GUbzn8vwE52', 1, 1, 0),
(5, 'gestor', '$2y$10$MqCggsEgx0MdTpPesTD7JO9Y7xEbqyZT6qH8c4wHLkLOFZB4Eh1KO', 1, 1, 0),
(6, 'oke', '$2y$10$DXWqaERyXFpunvsC1BO.euSUX/Bp832LmjAWdyzdEp9OvoRSg24ym', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComen`);

--
-- Indexes for table `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`idEtiqueta`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventosPublicados`
--
ALTER TABLE `eventosPublicados`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `idEtiqueta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `eventosPublicados`
--
ALTER TABLE `eventosPublicados`
  MODIFY `idEvento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `palabras`
--
ALTER TABLE `palabras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
