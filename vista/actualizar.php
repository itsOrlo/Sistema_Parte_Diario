<?php
    //conexion php
    include "../modelo/coneccion.php";
    $conexion = conectar();

    //capturar id
    $id = $_GET['id'];

    //toma de dato del id
    $sql = "SELECT * FROM estudiantes WHERE idEstudiantes = $id;";

    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="../vista/source/estilos/styles.css">
    <!--IconWeb-->
    <link rel="stylesheet" href="../vista/source/icons/course-certificate.png">
</head>

<body>
    <div class="text-center mt-4 text-secondary" id="contenedor">
        <h2>Actualizar</h2>
    </div>
    <div class="container mt-5 card border-primary p-5 rounded" style="width:400px;">
        <h3 class="text-center p-2 text-primary">Estudiante</h3>
        <form action="../controlador/controladorActualizar.php" method="POST">
            <input  name="id" value="<?php echo $row['idEstudiantes'] ?>" hidden>

            <input type="text" class="form-control mb-3 mt-3" name='namefull' placeholder="ingrese el nombre"
                value="<?php echo $row['nombre'] ?>">
            <input type="number" class="form-control mb-3" name='cedula' placeholder="ingrese la cedula"
                value="<?php echo $row['cedula'] ?>">
            <input type="text" class="form-control mb-3" name='sexo' placeholder="ingrese el sexo"
                value="<?php echo $row['genero'] ?>" max-length="1">
            <input type="number" class="form-control mb-3" name='edad' placeholder="ingrese la edad"
                value="<?php echo $row['edad'] ?>">

            <div style="margin-left:100px;">
                <input type="submit" class="btn btn-primary mt-3 mb-2" value="Actualizar"><br>
            </div>
            <a href="../vista/index.php" class="btn btn-warning mt-3">Volver</a>

        </form>
    </div>
</body>

</html>