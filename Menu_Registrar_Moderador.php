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
    exit();  // Terminar la ejecución del script
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: 0");
header("Pragma: no-cache");

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "root", "soporte");
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el email del moderador desde la sesión
$moderador = $_SESSION['moderador'];

// Consulta para obtener el nombre del moderador
$sql = "SELECT Nombre,id_moderador FROM moderador WHERE Email_M = '$moderador'";
$resultnombre = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultnombre);
$nombre_moderador = $row['Nombre']; // Asignar el nombre directamente
$id_moderador = $row['id_moderador']; // Obtener el id del moderador

// Manejo del formulario al enviarlo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_rol = mysqli_real_escape_string($conexion, $_POST['id_rol']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);

    // Reemplaza moderadores por el nombre correcto de la tabla
    $sql_insert = "INSERT INTO moderador (id_rol, nombre, email_M, clave_M, direccion)
    VALUES ('$id_rol', '$nombre', '$email', '$clave', '$direccion')";


    if (mysqli_query($conexion, $sql_insert)) {
        echo '
        <script>
            alert("Moderador registrado exitosamente.");
            window.location = "Menu_moderador.php"; // Redirigir al menú del moderador
        </script>
        ';
    } else {
        echo "Error: " . $sql_insert . "<br>" . mysqli_error($conexion);
    }
}
?>

<link rel="stylesheet" href="css/stylefaqmoderador.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Moderador</title>
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
            <li><a href="Menu_MisReportes.php">Mis reportes</a></li>
            <li><a href="Menu_Preguntas_FAQ.php">Registrar preguntas FAQ</a></li>
            <li><a href="Menu_Registrar_Moderador.php">Registrar Moderador</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </nav>
    <main>
        <div class="faq-card">
            <h2>Registrar Moderador</h2>
            <form id="moderadorForm" method="POST" action="">
                <label for="id_rol">ID Rol:</label>
                <input type="text" id="id_rol" name="id_rol" required>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>

                <button type="submit" class="btn-submit">Registrar Moderador</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
