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

// Consulta para obtener el nombre y el rol del moderador
$sql = "SELECT Nombre, id_moderador, id_rol FROM moderador WHERE Email_M = '$moderador'";
$resultnombre = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultnombre);
$nombre_moderador = $row['Nombre']; // Asignar el nombre directamente
$id_moderador = $row['id_moderador']; // Obtener el id del moderador
$id_rol = $row['id_rol']; // Obtener el rol del moderador

// Manejo del formulario al enviarlo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conexion, $_POST['faqTitle']);
    $solucion = mysqli_real_escape_string($conexion, $_POST['faqSolution']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['faqCategory']);

    $categoriaSiglas = [
        "Planes" => "Pl",
        "Financiero" => "Pa",
        "Equipo" => "Eq",
        "Internet" => "In"
    ];
    // Obtener la sigla correspondiente
    $siglaCategoria = $categoriaSiglas[$categoria];
    $sql_insert = "INSERT INTO articulo_faq (Titulo, Contenido, Categoria, id_moderador) VALUES ('$titulo', '$solucion', '$siglaCategoria', '$id_moderador')";

    if (mysqli_query($conexion, $sql_insert)) {
        echo '
        <script>
            alert("Pregunta FAQ registrada exitosamente.");
            window.location = "Menu_Preguntas_FAQ.php"; // Redirigir a la misma página para ver el nuevo registro
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
            <li><a href="Menu_MisReportes.php">Mis reportes</a></li>
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
    <main>
        <div class="faq-card">
            <h2>Registrar Pregunta FAQ</h2>
            <form id="faqForm" method="POST" action="">
                <label for="faqTitle">Título de FAQ:</label>
                <input type="text" id="faqTitle" name="faqTitle" required>

                <label for="faqSolution">Solución:</label>
                <textarea id="faqSolution" name="faqSolution" required></textarea>

                <label for="faqCategory">Categoría:</label>
                <select id="faqCategory" name="faqCategory" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Planes">Planes</option>
                    <option value="Financiero">Financiero</option>
                    <option value="Equipo">Equipo</option>
                    <option value="Internet">Internet</option>
                </select>

                <button type="submit" class="btn-submit">Enviar Pregunta</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
