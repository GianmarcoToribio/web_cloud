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

// Filtrado de categorías, excluyendo 'Pe' (Personalizado)
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$sql = ($categoria && $categoria != 'Pe') ? "SELECT * FROM articulo_faq WHERE Categoria LIKE '{$categoria}%'" : "SELECT * FROM articulo_faq";
$result = mysqli_query($conexion, $sql);
$contador = 1;

?>

<link rel="stylesheet" href="cssCliente/styleMenu_crear_ticket.css">

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
            <li><a href="">Crear Ticket</a></li>
            <li><a href="Menu_historial_ticket.php">Historial de Tickets </a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </nav>
    <main>
    <div class="faq-card">
            <h2>Registrar Ticket</h2>
            <form id="ticketForm" method="POST">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Pl">Planes</option>
                    <option value="Pa">Financiero</option>
                    <option value="Eq">Equipo</option>
                    <option value="In">Internet</option>
                </select>

                <label for="prioridad">Nivel de Prioridad:</label>
                <select id="prioridad" name="prioridad" required>
                    <option value="">Seleccione una prioridad</option>
                    <option value="N">Normal</option>
                    <option value="E">Elevado</option>
                    <option value="U">Urgente</option>
                </select>

                <button type="submit" class="btn-submit">Enviar Pregunta</button>
            </form>
            <div id="ticket-msg"></div>
        </div>
    </main>
</div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Incluye jQuery para manejar AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#ticketForm').submit(function(event) {
                event.preventDefault();  // Evitar la recarga de la página

                // Validar que se haya seleccionado una categoría
                var categoria = $('#categoria').val();
                var descripcion = $('#descripcion').val().trim();
                var prioridad = $('#prioridad').val();

                if (!categoria || !descripcion || !prioridad) {
                    $('#ticket-msg').html('<div class="alert alert-danger">Por favor, completa todos los campos.</div>');
                    return;
                }

                $.ajax({
                    url: 'registrar_ticket.php',  // El archivo PHP donde se procesará
                    type: 'POST',
                    data: $(this).serialize(),  // Enviar los datos del formulario
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $('#ticket-msg').html('<div class="alert alert-success">Ticket registrado con éxito.</div>');
                            $('#ticketForm')[0].reset(); // Limpiar el formulario
                            setTimeout(function(){
                                $('#ticket-msg').html('');  // Limpiar el mensaje
                            }, 2000);
                        } else {
                            $('#ticket-msg').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        $('#ticket-msg').html('<div class="alert alert-danger">Ocurrió un error. Por favor, intenta nuevamente.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
