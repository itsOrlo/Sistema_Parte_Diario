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

                //insertar datos
                $sql = "INSERT INTO tblpersonal (idPersonal, nombres, cedula, estado, unidad) 
                VALUES (default, '$namefull', '$cedula', '$situacion', '$unidad');";

                //consulta exe
                $query = mysqli_query($conexion, $sql);

                if($query){
                    header("location: ../vista/registrarPersonal.php");             
                }else{


                
                }
            
        
    

?>