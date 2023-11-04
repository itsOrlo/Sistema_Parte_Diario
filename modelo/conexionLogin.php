<?php

function conectarLogin(){
        
    $this->servidor="localhost";
            $this->usuario="root";
            $this->password="";
            $this->bd="plataformas";
            $this->conexion="";
    
    /*
    1
    $host = "localhost";
    $user = "id19952370_root";
    $pass = "*Ija%L6$6i}Atq#2";
    
    $db = "id19952370_alumnos";
    */

    /*
    $host = "localhost";
    $user = "id19952370_root2";
    $pass = "}~J6=ORjUlD0s@H-";
    
    $db = "id19952370_alumnos2";
    */

    $conexion = mysqli_connect($host, $user, $pass);

    mysqli_select_db($conexion, $db);
     
    return $conexion;

}

?>