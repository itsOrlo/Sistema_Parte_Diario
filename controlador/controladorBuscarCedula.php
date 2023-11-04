<?php

// coneccion
include_once "../modelo/coneccion.php";
$conexion = conectar();

if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    $valores = array();
    $valores['existe'] = "0";

    // Realizar la consulta a la base de datos
    $resultados = mysqli_query($conexion, "SELECT * FROM tblpersonal WHERE cedula = '$cedula'");
    while ($numero = mysqli_fetch_array($resultados)) {
        $valores['existe'] = "1";
        $valores['nombres'] = $numero['nombres'];
        $valores['unidad'] = $numero['unidad'];
        $valores['estado'] = $numero['estado'];
    }
    // imprimir el resultado como JSON
    echo json_encode($valores);
}
?>
