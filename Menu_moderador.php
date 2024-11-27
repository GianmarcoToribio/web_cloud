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

// Obtener el nombre y el rol del moderador
$sql = "SELECT Nombre, id_rol FROM moderador WHERE Email_M = '$moderador'";
$resultnombre = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($resultnombre);
$nombre_moderador = $row['Nombre'];
$id_rol = $row['id_rol']; // Obtener el rol del moderador

// Verificar si se ha solicitado delegar el ticket
if (isset($_POST['delegar_ticket_id'])) {
    $ticket_id = $_POST['delegar_ticket_id'];

    // Encontrar un moderador con id_Rol = 1
    $query = "SELECT id_moderador FROM moderador WHERE id_Rol = 1 LIMIT 1";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_moderador = $row['id_moderador'];

        // Actualizar el ticket con el nuevo id_moderador
        $update_query = "UPDATE ticket SET id_moderador = ? WHERE id_Ticket = ?";
        $stmt = mysqli_prepare($conexion, $update_query);
        mysqli_stmt_bind_param($stmt, "ii", $id_moderador, $ticket_id);
        mysqli_stmt_execute($stmt);

        echo '<script>alert("Ticket delegado exitosamente."); window.location.href="Menu_moderador.php";</script>';
    } else {
        echo '<script>alert("No se encontró un moderador con id_Rol = 1."); window.location.href="Menu_moderador.php";</script>';
    }
}

// Mostrar tickets asignados al moderador
$sql_ticket = "
    SELECT t.id_Ticket, t.Descripcion, t.Estado, t.Fecha_Creacion, c.Nombre AS Cliente, t.Nivel_Prioridad, t.Categoria
    FROM ticket t
    JOIN cliente c ON t.id_Cliente = c.id_cliente
    WHERE t.id_moderador = (SELECT id_moderador FROM moderador WHERE Email_M = '$moderador')
    AND t.Estado = 'A' -- Solo mostrar tickets con estado 'A'
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
    <main class="col-md-10">
        <h2>Lista de Tickets</h2>
        <div class="ticket-container">
            <?php while ($ticket = mysqli_fetch_assoc($result_ticket)): ?>
                <div class="col-md-6 mb-4">
                    <div class="ticket-card card mx-auto"> 
                        <div class="card-body" style="border: 2px solid var(--primary-orange);"> 
                            <h5 class="card-title">Ticket de: <?php echo htmlspecialchars($ticket['Cliente']); ?></h5>
                            <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($ticket['Descripcion']); ?></p>
                            <p class="card-text"><strong>Estado:</strong> <?php echo htmlspecialchars($ticket['Estado']); ?></p>
                            <p class="card-text"><strong>Fecha de Creación:</strong> <?php echo htmlspecialchars($ticket['Fecha_Creacion']); ?></p>
                            <p class="card-text"><strong>Nivel de Prioridad:</strong> <?php echo htmlspecialchars($ticket['Nivel_Prioridad']); ?></p>
                            <p class="card-text"><strong>Categoría:</strong> <?php echo htmlspecialchars($ticket['Categoria']); ?></p>
                            
                            <!-- Botón "Agregar Solución" -->
                            <button onclick="mostrarSolucionForm(<?php echo $ticket['id_Ticket']; ?>)" class="btn btn-agregar-solucion">Agregar Solución</button>
                            
                            <br>
                            <br>

                            <!-- Botón "Delegar Consulta" solo para moderadores con id_rol distinto de 1 -->
                            <?php if ($id_rol != 1): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="delegar_ticket_id" value="<?php echo $ticket['id_Ticket']; ?>">
                                    <button type="submit" class="btn btn-agregar-solucion">Delegar Consulta</button>
                                </form>
                            <?php endif; ?>


                            <!-- Formulario de solución (oculto inicialmente) -->
                            <div id="solucion-form-<?php echo $ticket['id_Ticket']; ?>" style="display:none; margin-top: 10px;">
                                <textarea id="solucion-text-<?php echo $ticket['id_Ticket']; ?>" class="form-control" rows="3" placeholder="Escribe la solución aquí"></textarea>
                                <button onclick="registrarRespuesta(<?php echo $ticket['id_Ticket']; ?>)" class="btn-enviar-solucion mt-2">Registrar Respuesta</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</div>
<script>
    function mostrarSolucionForm(ticketId) {
        var form = document.getElementById("solucion-form-" + ticketId);
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block"; // Mostrar el formulario
        } else {
            form.style.display = "none"; // Ocultar el formulario
        }
    }

    function registrarRespuesta(ticketId) {
        var solucion = document.getElementById("solucion-text-" + ticketId).value;
        if (solucion === "") {
            alert("Por favor, ingresa una solución.");
            return;
        }

        // Enviar los datos al servidor con AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "registrar_respuesta.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Respuesta registrada con éxito.");
                document.getElementById("solucion-form-" + ticketId).style.display = "none";
                location.reload(); // Recargar la página para reflejar el cambio en el estado
            }
        };
        xhr.send("ticket_id=" + ticketId + "&solucion=" + encodeURIComponent(solucion));
    }
</script>
</body>
</html>
