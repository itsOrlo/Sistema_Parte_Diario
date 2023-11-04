<?php

    //coneccion
    include_once "../modelo/coneccion.php";
    $conexion = conectar();

    sleep(3);
                //recibir datos
                $namefull = $_POST['namefull'];
                $cedula = $_POST['cedula'];
                $situacion = $_POST['situacion'];
                $unidad = $_POST['unidad'];
                $novedad = $_POST['novedad'];

                //insertar datos
                $sql = "INSERT INTO estudiantes (idEstudiantes, nombre, cedula, situacion, unidad, novedad) 
                VALUES (default, '$namefull', '$cedula', '$situacion', '$unidad', '$novedad');";

                //consulta exe
                $query = mysqli_query($conexion, $sql);

                if($query){
                    header("location: ../vista/index.php");             
                }else{


                
                }
            
        
    

?>