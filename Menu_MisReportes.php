<?php
session_start();  // Iniciar la sesión

// Verificar si existe una sesión de usuario activa
if (!isset($_SESSION['moderador'])) {
    echo '
    <script>
        alert("Por favor debes iniciar sesión");
        window.location = "index.php";
    </script>
    ';
    exit();
}

// Evitar el cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: 0");
header("Pragma: no-cache");

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "root", "soporte");
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$moderador = $_SESSION['moderador'];

// Consulta corregida para obtener Nombre e id_rol
$sql = "SELECT Nombre, id_rol FROM moderador WHERE Email_M = '$moderador'";
$resultnombre = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultnombre);
$nombre_moderador = $row['Nombre'];
$id_rol = $row['id_rol']; // Ahora esta línea funcionará correctamente

$categoriaSiglas = [
    "Pl" =>"Planes",
    "Pa" =>"Financiero",
    "Eq" =>"Equipo",
    "In" =>"Internet",
];

$sql_ticket = "
    SELECT t.id_Ticket, t.Descripcion, t.Estado, t.Fecha_Creacion, t.Fecha_Resolucion, c.Nombre AS Cliente, t.Nivel_Prioridad, t.Categoria
    FROM ticket t
    JOIN cliente c ON t.id_Cliente = c.id_cliente
    WHERE t.id_moderador = (SELECT id_moderador FROM moderador WHERE Email_M = '$moderador')
    AND t.Estado = 'C' -- Solo mostrar tickets con estado 'C'
";
$result_ticket = mysqli_query($conexion, $sql_ticket);

?>

<link rel="stylesheet" href="css/stylemoderador.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Moderador</title>
</head>
<body>
<header>
    <img class="img" src="images/win2.png" alt="">
    <div class="welcome">Bienvenido,  <?php echo htmlspecialchars($nombre_moderador); ?></div>
</header>
<div class="container">
    <nav>
        <ul>
            <li><a href="Menu_moderador.php">Mis tickets</a></li>
            <li><a href="">Mis reportes</a></li>
            <li><a href="Menu_Preguntas_FAQ.php">Registrar preguntas FAQ</a></li>
            <?php
            // Verificar si el moderador es Moderador Global (id_rol = 1)
            if ($id_rol == 1) {
                echo '<li><a href="Menu_Registrar_Moderador.php">Registrar Moderador</a></li>';
            }
            ?>
        </ul>
        <div class="logout">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </nav>
    <main class="col-md-10">
        <h2>Lista de Tickets</h2>
        <div class="ticket-container">
            <?php while ($ticket = mysqli_fetch_assoc($result_ticket)): ?>
                <div class="col-md-6 mb-4"> <!-- Cambiado a col-md-6 -->
                <div class="ticket-card card mx-auto"> 
                        <div class="card-body" style="border: 2px solid var(--primary-orange);"> 
                            <h5 class="card-title">Ticket Resuelto de: <?php echo htmlspecialchars($ticket['Cliente']); ?></h5>
                            <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($ticket['Descripcion']); ?></p>
                            <p class="card-text"><strong>Estado:</strong> <?php echo htmlspecialchars($ticket['Estado']); ?></p>
                            <p class="card-text"><strong>Fecha de Creación:</strong> <?php echo htmlspecialchars($ticket['Fecha_Creacion']); ?></p>
                            <p class="card-text"><strong>Fecha de Resolución:</strong> <?php echo htmlspecialchars($ticket['Fecha_Resolucion']); ?></p>
                            <p class="card-text"><strong>Nivel de Prioridad:</strong> <?php echo htmlspecialchars($ticket['Nivel_Prioridad']); ?></p>

                            <p class="card-text"><strong>Categoría:</strong> 
                            <?php 
                                // Obtener la categoría completa a partir de las siglas
                                $sigla_categoria = $ticket['Categoria'];
                                echo htmlspecialchars($categoriaSiglas[$sigla_categoria] ?? $sigla_categoria);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</div>
</body>
</html>
