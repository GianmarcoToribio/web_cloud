<?php
session_start();
include 'conexion_be.php';  // Conectar a la base de datos

// Recibe y sanitiza los datos del formulario
$correo = mysqli_real_escape_string($conexion, $_POST['correologin']);
$contra = mysqli_real_escape_string($conexion, $_POST['contralogin']);

// Verificar si los campos están vacíos
if (empty($correo) || empty($contra)) {
    echo 'Rellene ambos campos';  // Mensaje si alguno de los campos está vacío
} else {
    // Consulta para verificar si el correo pertenece a un cliente
    $query_cliente = "SELECT * FROM cliente WHERE Email_C = ? AND Clave_C = ?";
    $stmt_cliente = mysqli_prepare($conexion, $query_cliente);
    mysqli_stmt_bind_param($stmt_cliente, "ss", $correo, $contra);
    mysqli_stmt_execute($stmt_cliente);
    $result_cliente = mysqli_stmt_get_result($stmt_cliente);

    // Consulta para verificar si el correo pertenece a un moderador
    $query_moderador = "SELECT * FROM moderador WHERE Email_M = ? AND Clave_M = ?";
    $stmt_moderador = mysqli_prepare($conexion, $query_moderador);
    mysqli_stmt_bind_param($stmt_moderador, "ss", $correo, $contra);
    mysqli_stmt_execute($stmt_moderador);
    $result_moderador = mysqli_stmt_get_result($stmt_moderador);

    if (mysqli_num_rows($result_cliente) > 0) {
        // Es un cliente
        $_SESSION['usuario'] = $correo;
        echo 'success_cliente';
    } elseif (mysqli_num_rows($result_moderador) > 0) {
        // Es un moderador
        $_SESSION['moderador'] = $correo;
        echo 'success_moderador';
    } else {
        // Ninguno de los dos
        echo 'Usuario o contraseña no existe';
    }
}
?>
