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

// Obtiene la categoría de la URL si está presente
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Obtener el email del usuario desde la sesión
$usuario = $_SESSION['usuario'];

// Consulta para obtener el nombre del cliente usando el campo correcto (en este caso Email_C)
$sql = "SELECT Nombre FROM cliente WHERE Email_C = '$usuario'";
$resultnombre = mysqli_query($conexion, $sql);

$row = mysqli_fetch_assoc($resultnombre);
$nombre_cliente = $row['Nombre']; // Asignar el nombre directamente

// Filtrado de categorías, excluyendo 'Pe' (Personalizado)
if ($categoria && $categoria != 'Pe') {
    $sql = "SELECT * FROM articulo_faq WHERE Categoria LIKE '{$categoria}%'";
} else {
    $sql = "SELECT * FROM articulo_faq";
}
$result = mysqli_query($conexion, $sql);
$contador = 1;

?>

<link rel="stylesheet" href="cssCliente\styleMenu_Cliente.css">
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
            <li><a href="#">Mis Preguntas Faq</a></li>
            <li><a href="Menu_crear_ticket.php">Crear Ticket</a></li>
            <li><a href="Menu_historial_ticket.php">Historial de Tickets </a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </nav>
    <div class="Problemas">
    <div class="fila2">
        <h1 class="titulo">¿Tienes problemas o dudas con?</h1>
        <div class="iconos-contenedor">
            <a href="Menu_Cliente.php?categoria=Pl">
                <div class="icono">
                    <img src="images/con-planes.png" alt="con-planes">
                    <p>Planes</p>
                </div>
            </a>
            <a href="Menu_Cliente.php?categoria=Pa">
                <div class="icono">
                    <img src="images/con-pagos.png" alt="con-pagos">    
                    <p>Pagos</p>
                </div>
            </a>
            <a href="Menu_Cliente.php?categoria=Eq">
                <div class="icono">
                    <img src="images/con-equipos.png" alt="con-equipos">
                    <p>Equipos</p>
                </div>
            </a>
            <a href="Menu_Cliente.php?categoria=In">
                <div class="icono">
                    <img src="images/con-internet.png" alt="con-internet">
                    <p>Internet</p>
                </div>
            </a>
    </div>
    </div>
    <div class="fila3">
        <div class="row">
            <div class="col-md-6">
                <div class="accordion" id="faqAccordionLeft">
                    <?php 
                    $contador = 1;
                    while ($mostrar = mysqli_fetch_array($result)) { 
                        // Mostrar las FAQs en la primera columna para los elementos impares
                        if ($contador % 2 != 0) { ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $contador; ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $contador; ?>" aria-expanded="true" aria-controls="collapse<?php echo $contador; ?>">
                                        <?php echo htmlspecialchars($mostrar['Titulo']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $contador; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $contador; ?>" data-bs-parent="#faqAccordionLeft">
                                    <div class="accordion-body">
                                        <?php echo htmlspecialchars($mostrar['Contenido']); ?>
                                    </div>
                                </div>
                            </div>
                    <?php }
                        $contador++;
                    } ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="accordion" id="faqAccordionRight">
                    <?php 
                    $contador = 1;
                    mysqli_data_seek($result, 0); // Reiniciar el puntero del resultado
                    while ($mostrar = mysqli_fetch_array($result)) { 
                        // Mostrar las FAQs en la segunda columna para los elementos pares
                        if ($contador % 2 == 0) { ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $contador; ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $contador; ?>" aria-expanded="true" aria-controls="collapse<?php echo $contador; ?>">
                                        <?php echo htmlspecialchars($mostrar['Titulo']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $contador; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $contador; ?>" data-bs-parent="#faqAccordionRight">
                                    <div class="accordion-body">
                                        <?php echo htmlspecialchars($mostrar['Contenido']); ?>
                                    </div>
                                </div>
                            </div>
                    <?php }
                        $contador++;
                    } ?>
                </div>
            </div>
        </div>
    </div>

    
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Incluye jQuery para manejar AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
