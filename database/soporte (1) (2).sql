-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 19:00:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_faq`
--

CREATE TABLE `articulo_faq` (
  `id_FAQ` int(11) NOT NULL,
  `id_moderador` int(11) DEFAULT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Contenido` text NOT NULL,
  `Categoria` enum('Pl','Pa','Eq','In','O') DEFAULT NULL,
  `Fecha_Publicacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo_faq`
--

INSERT INTO `articulo_faq` (`id_FAQ`, `id_moderador`, `Titulo`, `Contenido`, `Categoria`, `Fecha_Publicacion`) VALUES
(1, 1, '¿Por qué mi internet es lento?', 'Puede que el internet esté lento porque hay muchas personas usando la red al mismo tiempo o porque tu router está un poco lejos de donde estás conectado. A veces, solo con apagar el router y encenderlo de nuevo puede mejorar. Si sigues teniendo problemas, podemos ayudarte a revisarlo en la sección de \"CONSULTAS PERSONALIZADAS\".', 'In', '2024-09-08 00:00:00'),
(2, 1, '¿Cómo puedo cambiar mi contraseña de Wi-Fi?', ' Cambiar la contraseña del Wi-Fi es más fácil de lo que parece. Necesitas entrar en una página web especial con los datos de tu router. Desde ahí, podrás escribir una nueva contraseña. Si no sabes cómo hacerlo, podemos guiarte paso a paso para asegurarte de que tu red esté segura.', 'In', '2024-09-08 16:20:28'),
(3, 2, '¿Por qué mi módem no enciende?', 'Si tu módem no enciende, lo primero que debes hacer es verificar que esté bien conectado a la corriente eléctrica. Revisa si el enchufe funciona probando con otro dispositivo. Si aún así no enciende, puede ser un problema con el cable o el propio módem, en ese caso te recomendamos contactarnos para asistencia.', 'Eq', '2024-09-08 16:24:57'),
(4, 3, 'Mi módem está muy caliente, ¿es normal?', ' Los módems pueden calentarse si han estado encendidos durante mucho tiempo, pero si está muy caliente al tacto, podría haber un problema. Asegúrate de que el módem tenga suficiente ventilación y no esté cubierto por objetos. Si sigue calentándose demasiado, apágalo y contáctanos para verificar que todo esté en orden.', 'Eq', '2024-09-08 16:25:29'),
(5, 2, '¿Puedo mejorar la señal Wi-Fi en mi casa?', 'Sí, para que tu Wi-Fi llegue mejor a todos lados, es buena idea poner el router en un lugar central y despejado. También hay aparatos llamados extensores que ayudan a que la señal llegue más lejos. Si necesitas ayuda para mejorar la señal en tu casa, te podemos asesorar.', 'Eq', '2024-09-08 16:41:52'),
(6, 2, '¿Cómo elijo el mejor plan de internet para mí?', 'Para elegir el plan adecuado, debes considerar cuántas personas usarán el internet y para qué lo usarán. Si solo lo usarás para navegar y redes sociales, un plan básico es suficiente. Si verás videos en HD o hay varios dispositivos conectados, un plan con más velocidad será mejor.', 'Pl', '2024-09-16 08:00:00'),
(7, 1, '¿Puedo cambiar mi plan de internet después de contratarlo?', '¡Claro! Puedes cambiar de plan cuando quieras. Solo contáctanos y te ayudaremos a ajustar tu plan según tus necesidades.', 'Pl', '2024-09-16 08:05:00'),
(8, 1, '¿Por qué mi factura es diferente cada mes?', 'Puede ser debido a cargos adicionales como llamadas, alquiler de equipos, o si cambiaste de plan. Te recomendamos revisar el desglose de la factura para entender los detalles.', 'Pa', '2024-09-16 08:10:00'),
(9, 2, '¿Qué pasa si no pago mi factura a tiempo?', 'Si no pagas a tiempo, tu servicio puede ser suspendido. Te sugerimos pagar antes de la fecha de vencimiento para evitar inconvenientes.', 'Pa', '2024-09-16 08:15:00'),
(10, 3, '¿El precio de mi plan cambiará después de un tiempo?', 'No, el precio se mantendrá igual durante el período acordado al momento de contratar. Si hay cambios en el futuro, te lo notificaremos con anticipación.', 'Pl', '2024-09-16 08:20:00'),
(11, 1, '¿Puedo añadir servicios extra a mi plan actual?', '¡Sí! Ofrecemos servicios adicionales como más velocidad o canales de TV. Puedes añadirlos en cualquier momento, solo llámanos y te ayudaremos.', 'Pl', '2024-09-16 08:25:00'),
(12, 1, '¿Hay cargos por cambiar de plan?', 'No hay cargos por cambiar de plan, pero ten en cuenta que el nuevo plan se reflejará en tu próxima factura.', 'Pl', '2024-09-16 08:30:00'),
(13, 3, '¿Cuál es la duración mínima del contrato?', 'La mayoría de nuestros planes tienen un contrato mínimo de 12 meses, pero tenemos opciones sin contrato. ¡Contáctanos para más detalles!', 'Pl', '2024-09-16 08:35:00'),
(14, 2, '¿Cómo sé cuánta velocidad de internet tengo?', 'Puedes revisar la velocidad de tu plan en tu contrato o llamándonos. También puedes hacer una prueba de velocidad con herramientas online.', 'In', '2024-09-16 08:40:00'),
(15, 1, '¿Puedo suspender temporalmente mi plan de internet?', 'Sí, puedes suspenderlo por un tiempo. Contáctanos para saber más sobre cómo hacerlo y por cuánto tiempo.', 'Pl', '2024-09-16 08:45:00'),
(16, 3, '¿Por qué mi Wi-Fi se desconecta automáticamente de mis dispositivos?', 'Esto puede suceder por configuraciones de ahorro de energía en tus dispositivos o interferencias en la señal Wi-Fi. Intenta desactivar las opciones de ahorro de batería y reiniciar tu módem.', 'In', '2024-09-16 08:50:00'),
(17, 3, '¿Cómo reinicio mi módem?', 'Busca el botón de encendido en la parte trasera del módem. Apágalo, espera unos 10 segundos y vuelve a encenderlo. Esto suele solucionar muchos problemas de conexión.', 'Eq', '2024-09-16 08:55:00'),
(18, 1, '¿Por qué no tengo señal de Wi-Fi en todas las habitaciones?', 'Las paredes y la distancia pueden interferir con la señal. Puedes mejorar la cobertura moviendo el módem a un lugar central o usando un extensor de señal.', 'In', '2024-09-16 09:00:00'),
(19, 3, '¿Qué hago si mi internet se desconecta constantemente?', 'Revisa los cables del módem, asegúrate de que estén bien conectados. Si sigue fallando, reinicia el módem. Si el problema persiste, contáctanos para asistencia técnica.', 'In', '2024-09-16 09:05:00'),
(20, 2, '¿Qué es el ping y cómo afecta mi internet?', 'El ping mide el tiempo que tarda en llegar la información de tu dispositivo a internet y viceversa. Un ping alto puede hacer que el internet se sienta lento, especialmente al jugar o hacer videollamadas.', 'In', '2024-09-16 09:10:00'),
(21, 3, '¿Cómo puedo mejorar la velocidad de mi Wi-Fi?', 'Coloca el módem en un lugar central y sin obstáculos. También intenta cambiar el canal de la señal Wi-Fi desde la configuración del módem.', 'In', '2024-09-16 09:15:00'),
(22, 3, '¿Por qué mi internet se pone lento en las noches?', 'A veces, durante las noches hay más personas conectadas, lo que puede afectar la velocidad. Esto es algo temporal y se soluciona al reducir el uso de dispositivos.', 'In', '2024-09-16 09:20:00'),
(23, 2, '¿Puedo usar mi internet durante un corte de energía?', 'No, porque el módem necesita electricidad para funcionar. Sin embargo, si tienes un respaldo de energía (UPS), puedes mantener el módem encendido por un tiempo limitado.', 'In', '2024-09-16 09:25:00'),
(24, 1, '¿Por qué mi internet funciona pero no puedo navegar?', 'Puede ser un problema con el navegador o la página que intentas visitar. Intenta abrir otra página o reinicia tu navegador.', 'In', '2024-09-16 09:30:00'),
(25, 3, '¿Cómo conecto mi nuevo módem?', 'Conecta el cable de internet al puerto del módem. Luego, conecta el módem a la electricidad y espera a que las luces indiquen que está listo. Sigue las instrucciones del manual para configurar la red Wi-Fi.', 'Eq', '2024-09-16 09:35:00'),
(26, 3, '¿Para qué sirve el botón de reset en el módem?', 'Este botón restaura la configuración de fábrica del módem. Úsalo solo si es necesario, porque perderás cualquier configuración personalizada.', 'Eq', '2024-09-16 09:40:00'),
(27, 1, '¿Puedo usar un módem diferente al que me dieron?', 'Sí, pero debe ser compatible con nuestro servicio. Te recomendamos consultarnos antes de usar un módem distinto.', 'Eq', '2024-09-16 09:45:00'),
(28, 2, '¿Cómo puedo pagar mi factura de internet?', 'Puedes pagar tu factura a través de nuestra página web, en bancos autorizados o utilizando aplicaciones móviles de pago. También ofrecemos débito automático para tu comodidad.', 'Pa', '2024-09-16 12:20:51'),
(29, 1, '¿Por qué las luces del módem están parpadeando?', 'Las luces indican actividad. Si parpadean constantemente, tu internet está funcionando. Si alguna luz no está encendida, podría haber un problema.', 'Eq', '2024-09-16 09:55:00'),
(30, 1, '¿Cómo cambio la contraseña de mi Wi-Fi?', 'Ingresa a la configuración del módem desde tu navegador. Busca la sección de Wi-Fi o red inalámbrica y cambia la contraseña. Guarda los cambios y reinicia el módem.', 'Eq', '2024-09-16 10:00:00'),
(31, 2, '¿Mi módem necesita una actualización?', 'A veces sí. Nosotros nos encargamos de las actualizaciones, pero puedes revisar la configuración del módem para ver si hay actualizaciones disponibles.', 'Eq', '2024-09-16 10:05:00'),
(32, 2, '¿Qué significa cada luz del módem?', 'Cada luz indica un aspecto de la conexión (energía, internet, Wi-Fi). Revisa el manual del módem o contáctanos para más detalles.', 'Eq', '2024-09-16 10:10:00'),
(33, 3, '¿Qué hago si las luces del módem están apagadas?', 'Revisa si el módem está correctamente conectado a la electricidad. Si sigue sin funcionar, contáctanos para asistencia.', 'Eq', '2024-09-16 10:15:00'),
(34, 1, '¿Puedo conectar mi consola de videojuegos al módem?', 'Sí, puedes conectar tu consola por cable o Wi-Fi. Si prefieres menos interferencias, usa un cable de red para una mejor conexión.', 'Eq', '2024-09-16 10:20:00'),
(35, 3, '¿Por qué algunas aplicaciones consumen más datos que otras?', 'Las aplicaciones que reproducen videos en alta definición, descargan archivos grandes o realizan actualizaciones automáticas consumen más datos. Ajusta la configuración de las aplicaciones para limitar su uso de datos.', 'In', '2024-09-16 10:25:00'),
(36, 3, '¿Debo estar presente durante la instalación?', 'Sí, es importante que alguien esté en casa para indicar al técnico dónde se instalará el módem y para recibir indicaciones.', 'Eq', '2024-09-16 10:30:00'),
(37, 3, '¿Dónde es el mejor lugar para instalar el módem?', 'En un lugar central, lejos de obstáculos y paredes gruesas. Esto ayuda a que la señal Wi-Fi se distribuya mejor por toda la casa.', 'Eq', '2024-09-16 10:35:00'),
(38, 2, '¿Qué hago si el técnico no llegó a la hora acordada?', 'Te pedimos paciencia. A veces los técnicos se retrasan por instalaciones anteriores. Si el retraso es significativo, contáctanos y reprogramaremos la visita.', 'In', '2024-09-16 10:40:00'),
(39, 3, '¿Mi conexión a internet puede verse afectada por el clima?', 'Sí, en algunos casos, condiciones climáticas extremas como tormentas eléctricas pueden afectar la señal, especialmente si tu conexión depende de antenas o cables expuestos al exterior.', 'In', '2024-09-16 10:45:00'),
(40, 1, '¿Cómo puedo cambiar el lugar del módem después de la instalación?', 'Puedes moverlo tú mismo si es fácil. Solo debes desconectar los cables y conectarlos nuevamente en la nueva ubicación. Asegúrate de que haya una toma eléctrica cerca.', 'Eq', '2024-09-16 10:50:00'),
(41, 2, '¿Por qué mi internet es rápido en un dispositivo pero lento en otro?', 'Esto puede deberse a las capacidades de cada dispositivo, la distancia al router o posibles interferencias. También puede ser que el dispositivo con internet lento tenga problemas de software o virus.', 'In', '2024-09-16 10:55:00'),
(42, 2, '¿Puedo instalar internet en más de una habitación?', 'Sí, podemos instalar extensores de señal Wi-Fi o realizar una instalación especial para conectar varias habitaciones. Consulta con nosotros para conocer las opciones.', 'In', '2024-09-16 11:00:00'),
(43, 3, '¿Puedo usar mi propio cable de red para la instalación?', 'Claro, pero te recomendamos usar los cables que proporcionamos, ya que están diseñados para optimizar tu conexión.', 'Eq', '2024-09-16 11:05:00'),
(44, 3, '¿El técnico me enseñará a usar el internet después de la instalación?', 'Sí, el técnico te dará una breve explicación de cómo conectar tus dispositivos y cambiar la configuración básica, como la contraseña del Wi-Fi.', 'In', '2024-09-16 11:10:00'),
(45, 3, '¿Puedo pagar mi factura con tarjeta de crédito?', '¡Claro! Aceptamos pagos con tarjetas de crédito y débito. Puedes hacerlo a través de nuestra plataforma en línea o en nuestros centros de atención.', 'Pa', '2024-09-16 12:31:05'),
(46, 1, '¿Por qué se me está cobrando una tarifa adicional en mi factura?', 'Las tarifas adicionales pueden ser por servicios extras, cargos por mora o cambios de plan. Revisa el desglose de tu factura o contáctanos para más información.', 'Pa', '2024-09-16 12:41:36'),
(47, 2, '¿Puedo adelantar el pago de mis próximas facturas?', 'Sí, puedes realizar pagos adelantados. Esto se reflejará como un saldo a favor y se aplicará a tus futuras facturas automáticamente.', 'Pa', '2024-09-16 12:52:39'),
(48, 1, '¿Cómo obtengo un comprobante de pago?', 'Una vez realizado el pago, puedes descargar tu comprobante desde nuestra página web o solicitarlo en nuestros centros de atención al cliente.', 'Pa', '2024-09-16 13:02:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_Cliente` int(11) NOT NULL,
  `Id_plan` int(11) DEFAULT NULL,
  `Id_equipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `Email_C` varchar(40) NOT NULL CHECK (`Email_C` like '%_@__%.__%'),
  `Clave_C` varchar(18) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Telefono` char(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_Cliente`, `Id_plan`, `Id_equipo`, `Nombre`, `Apellidos`, `Email_C`, `Clave_C`, `Direccion`, `Telefono`) VALUES
(1, 2, 2, 'Michaella', 'Pollins', 'mpollins0@gmail.com', '/tQ!U|M_yU!l^+a|kQ', '5462 Sloan Plaza', '933236094'),
(2, 1, 3, 'Deanne', 'Ordish', 'dordish1@gmail.com', 'e=bkD]R*ttVQsh_kgd', '8231 Daystar Lane', '969975244'),
(3, 1, 4, 'Wainwright', 'Dumblton', 'wdumblton2@gmail.com', '?%rF|!vWcqk^JhbIDl', '4553 Bartelt Center', '924801980'),
(4, 1, 1, 'Drusilla', 'Jekel', 'djekel3@gmail.com', 'mwn)C%poPthpPtA9oj', '72968 Huxley Pass', '949087182'),
(5, 2, 3, 'Junina', 'Howard', 'jhoward4@gmail.com', '2]8KnG]Ag@H^7wlqjR', '3 Harper Avenue', '917186699'),
(6, 2, 2, 'Padget', 'Tillerton', 'ptillerton5@gmail.com', 'wv+),2MEkNXv?To{q1', '22921 Victoria Trail', '955080098'),
(7, 1, 4, 'Coreen', 'McLenaghan', 'cmclenaghan6@gmail.com', 'hb)*YwZX|m@V!B&]qt', '7122 Northview Point', '985352352'),
(8, 1, 1, 'Giustina', 'Bignall', 'gbignall7@gmail.com', 'i~*g)czB.e)O#@|d0E', '525 Montana Center', '908645463'),
(9, 3, 2, 'Kerianne', 'McDermott', 'kmcdermott8@gmail.com', ';9WAl!94I%QnGE=[Ud', '181 Forest Run Junction', '973795602'),
(10, 2, 4, 'Burg', 'McFall', 'bmcfall9@gmail.com', '4u>KWnqC?7x/BZG~CV', '3 Waywood Court', '901876609');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_cliente`
--

CREATE TABLE `comentarios_cliente` (
  `id_Comentario` int(11) NOT NULL,
  `id_Cliente` int(11) DEFAULT NULL,
  `id_Ticket` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_Equipo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_Equipo`, `Nombre`, `Descripcion`) VALUES
(1, 'asdas', 'asdas'),
(2, 'asd', 'asdasd'),
(3, 'asd', 'asd'),
(4, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clientes`
--

CREATE TABLE `historial_clientes` (
  `id_Historial` int(11) NOT NULL,
  `id_Cliente` int(11) DEFAULT NULL,
  `Id_ticket` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE `moderador` (
  `id_Moderador` int(11) NOT NULL,
  `id_Rol` int(11) DEFAULT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Email_M` varchar(40) NOT NULL,
  `Clave_M` varchar(18) NOT NULL,
  `Direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `moderador`
--

INSERT INTO `moderador` (`id_Moderador`, `id_Rol`, `Nombre`, `Email_M`, `Clave_M`, `Direccion`) VALUES
(1, 1, 'Gianfranco', 'gianwin@win.pe', 'auZ:2A#rpK,B;GJ82g', 'collique tercera zona Los pinos'),
(2, 1, 'Joseph', 'yochewin@win.pe', 'apZ:QA#rpK,B;GJ8Eg', 'psj los clabeles mz g 7'),
(3, 2, 'Ugo', 'ugowin@win.pe', 'asddkjkW$k.12jU8E1', 'psj las rozas mz h lote 4'),
(4, 3, 'Fernando', 'fernandowin@win.pe', 'j7&f@Pz2gQw4!dS8xT', 'Callao bellavista mz h lt 2'),
(5, 4, 'Gianmarco', 'toribiowin@win.pe', 'R3*eQ!pA6$wZ8^fL2&', 'Av. Universitaria 5580, Los Olivos 15304');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_Plan` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_Plan`, `Descripcion`, `Precio`) VALUES
(1, '200 mb', 99.00),
(2, '400 mb', 99.00),
(3, '600 mb', 109.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_Reporte` int(11) NOT NULL,
  `id_Moderador` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `TipoReporte` varchar(20) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_Rol` int(11) NOT NULL,
  `Descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_Rol`, `Descripcion`) VALUES
(1, 'Moderador Global'),
(2, 'Moderador Tecnico'),
(3, 'Moderador de Planes'),
(4, 'Moderador Financiero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_Ticket` int(11) NOT NULL,
  `id_Cliente` int(11) DEFAULT NULL,
  `id_moderador` int(11) NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  `Fecha_Resolucion` date DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL CHECK (`Estado` in ('A','C','P')),
  `Descripcion` text NOT NULL,
  `Solucion` text DEFAULT NULL,
  `Nivel_Prioridad` enum('N','E','U') DEFAULT NULL,
  `Categoria` enum('Pl','Pa','Eq','In') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_Ticket`, `id_Cliente`, `id_moderador`, `Fecha_Creacion`, `Fecha_Resolucion`, `Estado`, `Descripcion`, `Solucion`, `Nivel_Prioridad`, `Categoria`) VALUES
(9, 1, 4, '2024-10-08', NULL, 'A', 'Quiero cambiar de plan', '', 'E', 'Pl'),
(10, 1, 4, '2024-10-08', NULL, 'A', 'asd', '', 'N', 'Pl'),
(11, 5, 5, '2024-10-17', NULL, 'A', 'No me sale la cuota para pagar', '', 'E', 'Pa'),
(12, 1, 5, '2024-10-17', NULL, 'A', 'No puedo pagar', '', 'E', 'Pa'),
(13, 1, 5, '2024-10-17', NULL, 'A', 'Digame sitios para pagar', '', 'N', 'Pa'),
(14, 1, 5, '2024-10-17', NULL, 'A', 'Si añado a un amigo como cliente win, puedo recibir algun descuento en mi pago?', '', 'N', 'Pa'),
(15, 1, 5, '2024-10-17', NULL, 'A', 'Puedo pagar en un sola cuota anual?', '', 'N', 'Pa'),
(16, 1, 5, '2024-10-17', NULL, 'A', 'asd', '', 'N', 'Pa'),
(17, 1, 5, '2024-10-17', NULL, 'A', 'asd', '', 'N', 'Pa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo_faq`
--
ALTER TABLE `articulo_faq`
  ADD PRIMARY KEY (`id_FAQ`),
  ADD KEY `fk_id_moderador` (`id_moderador`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_Cliente`) USING BTREE,
  ADD KEY `Plan_cliente` (`Id_plan`),
  ADD KEY `FK_cliente_equipo` (`Id_equipo`);

--
-- Indices de la tabla `comentarios_cliente`
--
ALTER TABLE `comentarios_cliente`
  ADD PRIMARY KEY (`id_Comentario`),
  ADD KEY `id_Cliente` (`id_Cliente`),
  ADD KEY `id_Ticket` (`id_Ticket`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_Equipo`);

--
-- Indices de la tabla `historial_clientes`
--
ALTER TABLE `historial_clientes`
  ADD PRIMARY KEY (`id_Historial`),
  ADD KEY `id_Cliente` (`id_Cliente`),
  ADD KEY `historial_clientes_ibfk_2` (`Id_ticket`);

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`id_Moderador`),
  ADD KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_Plan`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_Reporte`),
  ADD KEY `id_Moderador` (`id_Moderador`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_Ticket`),
  ADD KEY `id_Cliente` (`id_Cliente`),
  ADD KEY `ticket_ibfk_2` (`id_moderador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo_faq`
--
ALTER TABLE `articulo_faq`
  MODIFY `id_FAQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_Equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `id_Moderador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_Ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo_faq`
--
ALTER TABLE `articulo_faq`
  ADD CONSTRAINT `fk_id_moderador` FOREIGN KEY (`id_moderador`) REFERENCES `moderador` (`id_Moderador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_cliente_equipo` FOREIGN KEY (`Id_equipo`) REFERENCES `equipos` (`id_Equipo`),
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Id_plan`) REFERENCES `planes` (`id_Plan`);

--
-- Filtros para la tabla `comentarios_cliente`
--
ALTER TABLE `comentarios_cliente`
  ADD CONSTRAINT `comentarios_cliente_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`),
  ADD CONSTRAINT `comentarios_cliente_ibfk_2` FOREIGN KEY (`id_Ticket`) REFERENCES `ticket` (`id_Ticket`);

--
-- Filtros para la tabla `historial_clientes`
--
ALTER TABLE `historial_clientes`
  ADD CONSTRAINT `historial_clientes_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`),
  ADD CONSTRAINT `historial_clientes_ibfk_2` FOREIGN KEY (`Id_ticket`) REFERENCES `ticket` (`id_Ticket`);

--
-- Filtros para la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD CONSTRAINT `moderador_ibfk_2` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_Moderador`) REFERENCES `moderador` (`id_Moderador`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_moderador`) REFERENCES `moderador` (`id_Moderador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
