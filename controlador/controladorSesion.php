<?php

  //coneccion
  include "../modelo/coneccion.php";
  $conexion = conectar();

  //recibir datos post
  $nombreImg = $_FILES['foto']['name'];
  $tamImg = $_FILES['foto']['size'];
  $tmp_name = $_FILES['foto']['tmp_name'];
  $tipoImg = $_FILES['foto']['type'];
  $error = $_FILES['foto']['error'];

  if($error === 0){
      if($tamImg>125000000){
          echo "<script> alert('El tamaño de la imagen es muy grande'); </script>";
          header("Location: ../vista/index.php");
      }else{
          $img_extension = pathinfo($nombreImg, PATHINFO_EXTENSION);
          $img_extension_lc = strtolower($img_extension);

          $imgPermitida = array('jpg', 'jpeg', 'png', 'gif', 'webp');

          if(in_array($img_extension, $imgPermitida)){
              $nombreNuevaImg = uniqid("IMG-", true).'.'.$img_extension_lc;
              $img_subida = '../imgs/'.$nombreNuevaImg;
              move_uploaded_file($tmp_name, $img_subida);

              //recibir datos
              $namefull = $_POST['namefull'];
              $cedula = $_POST['cedula'];
              $genero = $_POST['sexo'];
              $edad = $_POST['edad'];

              //insertar datos
              $sql = "INSERT INTO estudiantes (idEstudiantes, nombre, cedula, genero, edad, img) 
              VALUES (NULL, '$namefull', '$cedula', '$genero', '$edad', '$nombreNuevaImg');";

              //consulta exe
              $query = mysqli_query($conexion, $sql);

              if($query){
                  echo "script> alert('Datos guardados con exito'); </script>";
                  header("location: ../vista/index.php");
              }else{
              
              }
          }
      }
  }


?>