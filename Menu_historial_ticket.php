<?php
session_start();  // Iniciar la sesión

// Verificar si existe una sesión de usuario activa
if (!isset($_SESSION['usuario'])) {
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

// Obtener el email del usuario desde la sesión
$usuario = $_SESSION['usuario'];

// Consulta para obtener el nombre del cliente usando el campo correcto (Email_C)
$sql = "SELECT Nombre FROM cliente WHERE Email_C = '$usuario'";
$resultnombre = mysqli_query($conexion, $sql);

$row = mysqli_fetch_assoc($resultnombre);
$nombre_cliente = $row['Nombre']; // Asignar el nombre directamente

$usuario = $_SESSION['usuario'];

$sql = "SELECT Nombre FROM cliente WHERE Email_C = '$usuario'";
$resultnombre = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultnombre);
$nombre_usuario = $row['Nombre'];

$categoriaSiglas = [
    "Pl" =>"Planes",
    "Pa" =>"Financiero",
    "Eq" =>"Equipo",
    "In" =>"Internet",
];


$sql_ticket = "
    SELECT t.Descripcion,t.Solucion, t.Estado, t.Fecha_Creacion, t.Fecha_Resolucion, c.Nombre AS Cliente, t.Nivel_Prioridad, t.Categoria
    FROM ticket t
    JOIN cliente c ON t.id_Cliente = c.id_cliente
    WHERE c.Email_C = '$usuario'
    AND t.Estado = 'C' -- Solo mostrar tickets con estado 'C'
";


$result_ticket = mysqli_query($conexion, $sql_ticket);


?>

<link rel="stylesheet" href="cssCliente/styleMenu_historialticket.css">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Soporte Técnico de WIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<header>
    <img class="img" src="images/win2.png" alt="">
    <div class="welcome">Bienvenido,  <?php echo htmlspecialchars($nombre_cliente); ?></div>
</header>
<div class="container">
    <nav>
        <ul>
        <li><a href="Menu_Cliente.php">Mis Preguntas Faq</a></li>
            <li><a href="Menu_crear_ticket.php">Crear Ticket</a></li>
            <li><a href="">Historial de Tickets </a></li>
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
                            <h5 class="card-title">Ticket Resuelto </h5>
                            <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($ticket['Descripcion']); ?></p>
                            <p class="card-text"><strong>Solucion:</strong> <?php echo htmlspecialchars($ticket['Solucion']); ?></p>
                            
                            <p class="card-text"><strong>Estado:</strong> <?php echo htmlspecialchars($ticket['Estado']); ?></p>
                            <p class="card-text"><strong>Fecha de Creación:</strong> <?php echo htmlspecialchars($ticket['Fecha_Creacion']); ?></p>
                            <p class="card-text"><strong>Fecha de Resolucion:</strong> <?php echo htmlspecialchars($ticket['Fecha_Resolucion']); ?></p>
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
    
</div>

</body>
</html>
