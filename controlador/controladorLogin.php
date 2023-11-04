<?php
session_start();
include_once "../modelo/coneccion.php";
$conexion = conectar();
    
if(isset($_REQUEST["iniciar"])){
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = mysqli_real_escape_string($conexion, $_POST['pass']);
    
    $sql = "SELECT * FROM tbllogin WHERE user = '".$usuario."' AND pass = '".$pass."'";
    $query = mysqli_query($conexion, $sql);
    if($query){
        $row = mysqli_fetch_array($query);
        
        if($row && $row['user'] == $usuario && $row['pass'] == $pass && $row['rol'] == 'administrador'){
            $_SESSION['user'] = $usuario;
            header("location: ../vista/Listado.php");
            exit();
        } elseif ($row && $row['user'] == $usuario && $row['pass'] == $pass && $row['rol'] == 'secretaria') {
            $_SESSION['user'] = $usuario;
            header("location: ../vista/index.php");
            exit();
        } else {
            header("location: ../vista/login.php");
            exit();
        }
    } else {
        // Manejo de errores de consulta
        // Aquí puedes redirigir o mostrar un mensaje de error apropiado
    }
}
?>
