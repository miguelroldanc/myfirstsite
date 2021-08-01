-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 13:07:00
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sibw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `evento`, `fecha`, `usuario`, `comentario`) VALUES
(3, 1, '2020-06-02', 'jbalvin', 'Es una pena que se cancele, ya había reservado hotel'),
(4, 2, '2020-06-02', 'antonioam', 'Llevaba esperandolo mucho, apoyo a todos los afectados'),
(7, 1, '2020-06-03', 'zerjioi', 'Me parece la acción más correcta. El año que viene volveremos con más entusiasmo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `resumen` varchar(5000) DEFAULT NULL,
  `img_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `subtitulo`, `resumen`, `img_link`) VALUES
(1, 'Google I/O 2020', 'Cancelado Google I/O 2020, el gran evento anual de Google para desarrolladores, a causa del coronavi', 'Programado para los días 12-14 de mayo en Mountain View, \n            la localidad de California donde Google tiene su sede central,\n            este evento es el que la compañía elige para dar a conocer la\n            mayor parte de sus novedades (durante una presentación pública \n            que programa siempre el primer día del evento), y constituye \n            una cita imprescindible para los desarrolladores y empresas que \n            uso de las plataformas de la compañía del buscador.\n            <br>\n            En cualquier caso, de igual modo que ocurrió con el F8 de Facebook, \n            la compañía tampoco se resigna a una mera anulación de sus planes, y \n            anuncia ya que está estudiando maneras de reformular el Google I/O \n            mediante la emisión de varias presentaciones y conferencias vía \n            streaming (en el caso de Facebook declararon estar planteándose incluso \n            combinar esas emisiones con varios eventos presenciales de ámbito local).\n            <br>\n            Gracias a GENBETA por la noticia (Artículo por Maurizio Pesce).\n            <br>\n            Más información en <a href=\"https://events.google.com/io/\" target=\"_blank\">la página oficial de Google I/O</a>', 'google2020.jpg'),
(2, 'Mobile World Congress 2020', 'Ya es oficial: el Mobile World Congress de 2020 se cancela', 'No puede decirse que esta noticia pille a muchos por sorpresa, pues la cancelación del Mobile World Congress en esta edición\nde 2020 lleva varios días sobrevolando los medios especializados, y también las oficinas de los responsables de la GSMA. Sin embargo, \nya se ha hecho oficial: el Mobile World Congress 2020 ha quedado cancelado tras el comité de urgencia convocado para hoy.\n<br>\nLa constantes cancelaciones por parte de importantes participantes en la feria, desde fabricantes de teléfonos móviles del peso de LG \no Vivo hasta gigantes del sector de los teleoperadores como AT&T o Deutsche Telekom, han pesado demasiado sobre los organizadores del torno.\n Finalmente, el coronavirus de Wuhan ha ganado la partida y el evento ha quedado cancelado.\n<br>\nGracias a Xataka por la noticia (Artículo por Samuel Fernandez).\n            <br>\n            Más información en <a href=\"https://www.mwcbarcelona.com/\" target=\"_blank\">la página oficial del Mobile World Congress</a>', 'mwc.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabrotas`
--

CREATE TABLE `palabrotas` (
  `palabra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `palabrotas`
--

INSERT INTO `palabrotas` (`palabra`) VALUES
('asco'),
('basura'),
('guerra'),
('mierda'),
('tonto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preview`
--

CREATE TABLE `preview` (
  `id` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `resumen` varchar(500) NOT NULL,
  `img_preview` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preview`
--

INSERT INTO `preview` (`id`, `evento`, `titulo`, `resumen`, `img_preview`) VALUES
(1, 1, 'Google I/O 2020', 'Google ha cancelado su conferencia para desarrolladores debido al coronavirus', 'images/googleio.png'),
(2, 2, 'Mobile World Congress 2020', 'El MWC sigue vivo pero pende de un hilo, la GSMA valora suspenderlo o aplazarlo.', 'images/mwc.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'registrado' CHECK (`tipo` in ('registrado','moderador','gestor','super'))
) ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `pass`, `correo`, `nombre`, `tipo`) VALUES
('antonioam', '$2y$10$NZE2RywtScZKgBDjheexuOl5nSye801gIY1txZxxxBaMrfscsrikO', 'samba@yahoo.com', 'Antonio', 'moderador'),
('jbalvin', '$2y$10$steV9yyT4.HD/i/mHvx8MOcaFv4.Rv14jRvRtah0jfoSTdm6F2JMe', 'salsa@gmail.com', 'Jose Osorio', 'gestor'),
('miguel', '$2y$10$7tuGKQ5WsqGhAUViVsrJvOSfiZjB8I48Lh4KeXcIMuMuYyFHWCx3G', 'root@nopass.com', 'Alberto', 'super'),
('zerjioi', '$2y$10$U/NQQbxMkwUkFAP3VwdJHe7XYj5uNHc/UT1v09LYhreMSl9ZU1Gl.', 'zerjillo@mail.es', 'Sergio', 'registrado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento` (`evento`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `palabrotas`
--
ALTER TABLE `palabrotas`
  ADD PRIMARY KEY (`palabra`);

--
-- Indices de la tabla `preview`
--
ALTER TABLE `preview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento` (`evento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preview`
--
ALTER TABLE `preview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preview`
--
ALTER TABLE `preview`
  ADD CONSTRAINT `preview_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
