<?php
session_start();  // Iniciar la sesión

// Verificar si existe una sesión de usuario activa
if (!isset($_SESSION['usuario'])) {
    // Si no existe, redirigir al inicio de sesión
    echo '
    <script>
        alert("Por favor debes iniciar sesión");
        window.location = "index.php";
    </script>
    ';
    exit();  // Terminar la ejecución del script
}

// Evitar que el navegador almacene la página en caché
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Soporte Técnico de WIN</title>
    <link rel="stylesheet" href="css/stylebienvenido.css"> <!-- Este archivo debe estar después -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .accordion-button {
            background-color: #FFF3E5; 
            color: #FF6600; 
        }

        .accordion-button:not(.collapsed) {
            background-color:  #FFF3E5; 
            color: #FF6600; 
        }

        .accordion-body {
            background-color: #ffffff; 
        }
        .fila3 {
            padding: 20px !important;
        }

        .accordion {
            margin: 0 15px !important;
        }

        .iconos-contenedor {
            padding: 20px 0 !important;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .icono img {
            margin-bottom: 10px !important;
            width: 60px;
            height: 60px;
        }

        /* Estilos adicionales para el modal personalizado */
        .modal-content {
            border-radius: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .iconos-contenedor {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="fila1">
        <div class="texto-fila1">
            <h1>Le damos la bienvenida al Soporte técnico de WIN</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($nombre_cliente); ?></p>
        </div>
    </div>

    <div class="fila2">
        <h1 class="titulo">¿Tienes problemas o dudas con?</h1>
        <div class="iconos-contenedor">
            <a href="bienvenido.php?categoria=Pl">
                <div class="icono">
                    <img src="images/con-planes.png" alt="con-planes">
                    <p>Planes</p>
                </div>
            </a>
            <a href="bienvenido.php?categoria=Pa">
                <div class="icono">
                    <img src="images/con-pagos.png" alt="con-pagos">
                    <p>Pagos</p>
                </div>
            </a>
            <a href="bienvenido.php?categoria=Eq">
                <div class="icono">
                    <img src="images/con-equipos.png" alt="con-equipos">
                    <p>Equipos</p>
                </div>
            </a>
            <a href="bienvenido.php?categoria=In">
                <div class="icono">
                    <img src="images/con-internet.png" alt="con-internet">
                    <p>Internet</p>
                </div>
            </a>
            <!-- Nuevo botón Personalizado -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#ticketModal">
                <div class="icono">
                    <img src="images/con-personalizado.png" alt="con-personalizado">
                    <p>Personalizado</p>
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

    <!-- Modal para registrar ticket -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketModalLabel">Registrar Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ticketForm">
                        <!-- Selección de categoría -->
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select id="categoria" name="categoria" class="form-select" required>
                                <option value="">Selecciona una categoría</option>
                                <option value="Pl">Planes</option>
                                <option value="Pa">Pagos</option>
                                <option value="Eq">Equipos</option>
                                <option value="In">Internet</option>
                            </select>
                        </div>

                        <!-- Descripción del problema -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del problema</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Selección de prioridad -->
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Nivel de prioridad</label>
                            <select id="prioridad" name="prioridad" class="form-select" required>
                                <option value="">Selecciona una prioridad</option>
                                <option value="N">Normal</option>
                                <option value="E">Elevado</option>
                                <option value="U">Urgente</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Ticket</button>
                    </form>
                    <!-- Mensaje de éxito o error -->
                    <div id="ticket-msg" class="mt-3"></div>
                </div>
            </div>
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
                            $('#ticketModal').modal('hide');
                            $('#ticket-msg').html('');
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
