<?php
    $conexion = mysqli_connect("localhost", "root", "root", "soporte");
    
    if(!$conexion){
        die("Error de conexión: " . mysqli_connect_error());
    }
?>
