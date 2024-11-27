<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "root", "soporte");
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['ticket_id']) && isset($_POST['solucion'])) {
    $ticket_id = $_POST['ticket_id'];
    $solucion = mysqli_real_escape_string($conexion, $_POST['solucion']);
    $fecha_resolucion = date('Y-m-d H:i:s');

    $sql = "UPDATE ticket 
            SET Solucion = '$solucion', Fecha_Resolucion = '$fecha_resolucion', Estado = 'C'
            WHERE id_Ticket = '$ticket_id'";

    if (mysqli_query($conexion, $sql)) {
        echo "success";
    } else {
        echo "Error al actualizar el ticket: " . mysqli_error($conexion);
    }
}
?>