<?php

//fijo el tipo de contenido
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//get
$varMetodo = $_SERVER['REQUEST_METHOD'];
//echo $varMetodo;

//conexion php
include "../modelo/coneccion.php";
$conexion = conectar();

switch ($varMetodo) {
    case 'GET':

        if (isset($_GET['isEstudiante'])) {
            $id = $_GET['isEstudiante'];
            //echo $id;
            //consultar y mostrar datos del estudiante sql
            $sql = "SELECT * FROM tblestudiantes WHERE isEstudiante = $id";
            $query = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($query);
            $numFilas = mysqli_num_rows($query);
           // echo ("Filas:" . $numFilas);
          // echo json_encode($row);
           //llenar vector con datos del estudiante
            $est = array(
                'isEstudiante' => $row['isEstudiante'],
                'nombre' => $row['nombre'],
                'cedula' => $row['cedula'],
                'genero' => $row['genero'],
                'edad' => $row['edad'],
                'img' => $row['img']
            );
            //transformar a json
            echo json_encode($est);

           
            break;
        } else {
            //consultar y mostrar datos del estudiante sql
            $sql = "SELECT * FROM tblestudiantes ";
            $query = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($query);
            //contar filas
            $numFilas = mysqli_num_rows($query);
            //echo ("Filas:" . $numFilas);
            if ($numFilas > 0) {
                //crear vector
                $vectorEst = array();
                //llenar vector
                while ($fila = mysqli_fetch_array($query)) {
                    extract($fila);
                    $est = array(
                        'isEstudiante' => $fila['isEstudiante'],
                        'nombre' => $fila['nombre'],
                        'cedula' => $fila['cedula'],
                        'genero' => $fila['genero'],
                        'edad' => $fila['edad'],
                        'img' => $fila['img']
                    );
                    array_push($vectorEst, $est);
                }
                //transformar a json
                echo json_encode($vectorEst);
            }
        }
        break;
    case 'POST':
        //insertar datos del estudiante
        break;
    case 'PUT':
        //actualizar datos del estudiante
        break;
    case 'DELETE':
        //eliminar datos del estudiante
        break;
    default:
        //metodo no soportado
        echo "Metodo no soportado";
        break;
}
