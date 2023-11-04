<?php

    //conexion
    include "../modelo/coneccion.php";
    $conexion = conectar();

    //tomar id
    $id = $_POST['id'];
    
    //tomar datos post
    $namefull = $_POST['namefull'];
    $cedula = $_POST['cedula'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];

    //actualizar
    $sql = "UPDATE estudiantes SET nombre = '$namefull', cedula = '$cedula', genero = '$sexo', edad = '$edad' WHERE idEstudiantes= $id;";

    

    $query = mysqli_query($conexion, $sql);





    if($query){
        header("location: ../vista/index.php");
    }else {
        echo "<script>alert('Error al actualizar');</script>";
    }
?>