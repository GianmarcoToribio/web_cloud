<?php
session_start();
include 'php/conexion_be.php';  // Ajusta esta ruta según la ubicación de tu archivo de conexión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo 'No autorizado';
    exit();
}

// Recibe y sanitiza los datos del formulario
$categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$prioridad = mysqli_real_escape_string($conexion, $_POST['prioridad']);

// Validar que los campos no estén vacíos
if (empty($categoria) || empty($descripcion) || empty($prioridad)) {
    echo 'Por favor, completa todos los campos.';
    exit();
}

// Obtener el ID del cliente desde la sesión
$cliente_email = $_SESSION['usuario'];

// Obtener el ID del cliente basado en el email
$query_cliente = "SELECT id_cliente FROM cliente WHERE Email_C = ?";
$stmt_cliente = mysqli_prepare($conexion, $query_cliente);
mysqli_stmt_bind_param($stmt_cliente, "s", $cliente_email);
mysqli_stmt_execute($stmt_cliente);
$result_cliente = mysqli_stmt_get_result($stmt_cliente);
if ($row_cliente = mysqli_fetch_assoc($result_cliente)) {
    $cliente_id = $row_cliente['id_cliente'];
} else {
    echo 'Cliente no encontrado.';
    exit();
}

// Determina el rol del moderador según la categoría
$rol_moderador = '';
switch ($categoria) {
    case 'Pl':
        $rol_moderador = 'Moderador de Planes';
        break;
    case 'Pa':
        $rol_moderador = 'Moderador Financiero';
        break;
    case 'Eq':
        $rol_moderador = 'Moderador Tecnico';
        break;
    case 'In':
        $rol_moderador = 'Moderador Tecnico';
        break;
    default:
        echo 'Categoría inválida.';
        exit();
}

// Consulta para buscar un moderador disponible con el rol adecuado
$query_moderador = "
    SELECT m.id_moderador 
    FROM moderador m
    JOIN roles r ON m.id_Rol = r.id_Rol
    WHERE r.Descripcion = ? 
    AND m.id_moderador NOT IN (
        SELECT id_moderador FROM ticket WHERE Estado = 'A' AND Categoria = ?
    )
    LIMIT 1";

$stmt_moderador = mysqli_prepare($conexion, $query_moderador);
mysqli_stmt_bind_param($stmt_moderador, "ss", $rol_moderador, $categoria);  // $rol_moderador es el rol y $categoria es la categoría del ticket
mysqli_stmt_execute($stmt_moderador);
$result_moderador = mysqli_stmt_get_result($stmt_moderador);

if ($row_moderador = mysqli_fetch_assoc($result_moderador)) {
    $id_moderador = $row_moderador['id_moderador'];
} else {
    // Si no hay moderadores libres, asignar al primer moderador con el rol correspondiente
    $query_moderador_fallback = "
        SELECT m.id_moderador 
        FROM moderador m
        JOIN roles r ON m.id_Rol = r.id_Rol
        WHERE r.Descripcion = ?
        LIMIT 1";
    $stmt_moderador_fallback = mysqli_prepare($conexion, $query_moderador_fallback);
    mysqli_stmt_bind_param($stmt_moderador_fallback, "s", $rol_moderador);
    mysqli_stmt_execute($stmt_moderador_fallback);
    $result_moderador_fallback = mysqli_stmt_get_result($stmt_moderador_fallback);
    if ($row_moderador_fallback = mysqli_fetch_assoc($result_moderador_fallback)) {
        $id_moderador = $row_moderador_fallback['id_moderador'];
    } else {
        echo 'No hay moderadores disponibles.';
        exit();
    }
}

// Registrar el ticket en la base de datos
$query_insert_ticket = "
    INSERT INTO ticket (id_cliente, id_moderador, Categoria, Descripcion, Solucion, Nivel_Prioridad, Fecha_Creacion, Estado) 
    VALUES (?, ?, ?, ?, ?, ?, NOW(), 'A')";
    $solucion = '';
$stmt_insert = mysqli_prepare($conexion, $query_insert_ticket);
mysqli_stmt_bind_param($stmt_insert, "iissss", $cliente_id, $id_moderador, $categoria, $descripcion, $solucion, $prioridad);

if (mysqli_stmt_execute($stmt_insert)) {
    echo 'success';
} else {
    echo 'Error al registrar el ticket: ' . mysqli_error($conexion);
}

mysqli_close($conexion);
?>