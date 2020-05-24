-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Mar 26, 2020 at 11:38 AM
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
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComen`, `idEven`, `autor`, `fecha`, `contenido`) VALUES
(1, 1, 'Pedro Martínez de la Rosa', '2020-03-25', '¡Una máquina! Sigue así crack'),
(2, 1, 'Sebastian Vettel', '2020-03-25', 'Grande laboro!'),
(3, 2, 'Romain Grosjean', '2020-03-25', 'Venga Carlitos que lo estás haciendo bastante bien'),
(4, 2, 'Jesús Perez', '2020-03-25', 'Este año a pesar del Coronavirus te quiero ver fuerte eh'),
(5, 2, 'Fernando Alonso', '2020-03-25', 'Grande!!'),
(6, 3, 'Kamui Kobayashi', '2020-03-25', 'Eres un campeón eh'),
(7, 3, 'Nico Rosberg', '2020-03-25', 'A ver cuándo te invitas a India y nos tomamos algo'),
(8, 4, 'John Cena', '2020-03-25', 'No puedo ni verte de lo rápido que vas... Cuídate'),
(9, 4, 'Greta Thungberg', '2020-03-25', 'Yes!!'),
(10, 4, 'Juan Carlos de Borbón', '2020-03-25', 'Bien chico bieeen'),
(11, 5, 'Josh Verstappen', '2020-03-25', 'Qué orgulloso'),
(12, 5, 'Kimi Raikkonen', '2020-03-25', 'Para cuando unas cervezas'),
(13, 6, 'Sebastien Buemi', '2020-03-25', 'Vente que he hecho aquí unos croissants que chillas'),
(14, 6, 'Luis de Guindos', '2020-03-25', 'Shino veeeen'),
(15, 7, 'Will Buxton', '2020-03-25', 'Go Shoey!'),
(16, 7, 'Mika Hakkinen', '2020-03-25', 'Vaya fiera el australiano'),
(17, 8, 'Serio Pérez', '2020-03-25', 'Eres mi ídolo'),
(18, 8, 'Juan Pablo Montoya', '2020-03-25', 'Sin duda el mejor de todos los tiempos'),
(19, 8, 'Nico Hulkenberg', '2020-03-25', '¿Por dónde andas ahora?'),
(20, 9, 'Charles Leclerc', '2020-03-25', 'Eterno'),
(21, 9, 'Adrian Sutil', '2020-03-25', 'Siempre entre nosotros, genio'),
(22, 1, 'Raúl Cepeda', '2020-03-25', 'Sigue así'),
(23, 3, 'Robert Kubica', '2020-03-25', 'Eres grande!! A ver cuándo nos vemos otra vez'),
(24, 5, 'Lucas di Grassi', '2020-03-25', 'A por todas en 2020!'),
(25, 6, 'Christian Klien', '2020-03-25', 'Hace tiempo que no nos vemos, puede estar bien'),
(26, 7, 'Kurk', '2020-03-25', 'Sin duda mi piloto favorito, un ídolo!'),
(27, 9, 'Nico Rosberg', '2020-03-25', 'Ojalá no te hubieses ido');

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
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `lugar`, `fecha`, `imagen`, `descripcion`) VALUES
(1, 'Fernando Alonso', 'Oviedo, España', '2020-03-19', '/img/alo.jpg', 'Fernando Alonso es un piloto español de automovilismo de velocidad. Ha ganado dos veces el Campeonato Mundial de Pilotos de Fórmula 1 en 2005 y 2006.'),
(2, 'Carlos Sainz Jr', 'Madrid, España', '2020-03-22', '/img/sai.jpg', 'Carlos Sainz Jr es una jóven promesa actualmente corriendo para McLaren'),
(3, 'Narain Karthikeyan', 'Coimbatore, India', '2020-03-20', '/img/kar.jpeg', 'Uno de los más celebres pilotos de la Fórmula 1. Su última aparición fue con la escuderia Force India.'),
(4, 'Lewis Hamilton', 'Stevenage, Reino Unido', '2020-03-20', '/img/ham.jpg', 'El piloto imparable hasta ahora. Lleva 6 títulos mundiales, a poco de igualar a Michael Schumacher.'),
(5, 'Max Verstappen', 'Hasselt, Bélgica', '2020-03-20', '/img/ver.jpeg', 'Uno de los pilotos revelación de los últimos tiempos. Aún estamos esperando para ver su potencial.'),
(6, 'Takuma Sato', 'Tokio, Japón', '2020-03-20', '/img/sat.jpg', 'Piloto japonés actualmente corriendo en IndyCar.'),
(7, 'Daniel Ricciardo', 'Perth, Australia', '2020-03-20', '/img/ric.jpg', 'Un piloto de gran valor en la parrilla actual de la F1 que por desgracia aún no ha conseguido grandes cosas en la competición.'),
(8, 'Pastor Maldonado', 'Maracay, Venezuela', '2020-03-20', '/img/mal.jpg', 'Quizás uno de los pilotos más infravalorados durante su paso por la competición.'),
(9, 'Jules Bianchi', 'Niza, Francia', '2020-03-20', '/img/bia.jpg', 'Un piloto que habría sido sin duda uno de los más grandes en la Fórmula 1.');

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

CREATE TABLE `galeria` (
  `id` int NOT NULL,
  `src` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeria`
--

INSERT INTO `galeria` (`id`, `src`) VALUES
(1, 'alo'),
(2, 'otraalonso'),
(3, 'dakar'),
(4, 'alonso');

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
-- Table structure for table `palabras censuradas`
--

CREATE TABLE `palabras censuradas` (
  `id` int NOT NULL,
  `palabra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `palabras censuradas`
--

INSERT INTO `palabras censuradas` (`id`, `palabra`) VALUES
(1, 'cerdo'),
(2, 'perro'),
(3, 'gato'),
(4, 'tobillo'),
(5, 'retrete'),
(6, 'aguacate'),
(7, 'Hamilton'),
(8, 'calvo'),
(9, 'enano'),
(10, 'koala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComen`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `palabras censuradas`
--
ALTER TABLE `palabras censuradas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `palabras`
--
ALTER TABLE `palabras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `palabras censuradas`
--
ALTER TABLE `palabras censuradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
