<?php

ob_start();

    // Configura la zona horaria y la configuración regional
    date_default_timezone_set('America/Guayaquil');
    setlocale(LC_TIME, 'es_EC');

    //conexion php
    include "../modelo/coneccion.php";
    $conexion = conectar();

    //toma de datos
    $sql = "SELECT * FROM estudiantes WHERE novedad <> 'PRESENTE';";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Personal</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    




    <!--CSS-->
    <link rel="stylesheet" href="../vista/source/estilos/styles.css">
    <!--IconWeb-->
    <link rel="stylesheet" href="../vista/source/icons/course-certificate.png">

    


    <style>
    /* Estilos CSS para el navbar */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    
    .navbar {
      background-color: #015B7E;
      overflow: hidden;
    }
    
    .navbar a {
      float: left;
      color: #fff;
      text-align: right;
      padding: 8px 16px;
      text-decoration: none;
      font-size: 16px;
    }
    
    .navbar a:hover {
      background-color: #ddd;
      color: #333;
    }
    
    .navbar .logo {
      float: left;
    }
    
    .navbar .logo img {
      height: 50px;
      width: 160px;
    }
    
    .navbar .text {
      float: right;
      color: #fff;
      padding: 14px 16px;
      font-size: 18px;
    }
  </style>
</head>

<body>
<?php
                
                include "../controlador/controladorLogin.php";

                if(isset($_SESSION["user"])){
                    
                }else{
                    header("location: login.php");
                }
                
            ?>

<div class="navbar">
    <div class="logo">
            <a class="navbar-brand" href="#">
                <span class="logo-text">DCB</span>
            </a>
        </div>
    <div class="text">
    <?php 
    

    $welcome_message = "<a>¡Bienvenido/a ".$_SESSION["user"]."!</a>";

    if(isset($_POST["cerrar"])){
        session_destroy();

        header("Location: login.php");
        exit;
    }
?>
            <?php echo $welcome_message; ?>
    </div>
  </div>
    <div class="text-center mt-4 text-secondary pt-4 pb-4">
        <h2>Listado Personal del día <?php echo date('d/m/Y'); ?></h2>
        <p>Sistema de Parte Diario</p>
    </div>
    <section>

        <!--VISTA DEL PERSONAL-->

    <div class="container pt-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tb">
            <thead>
                <tr>
                <th id="cedula">Cedula</th>
                            <th id="nombre">Nombre</th>
                            <th id="unidad">Unidad</th>
                            <th id="situacion">Estado</th>
                            <th id="novedad">Novedad</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Restablecer el puntero del conjunto de resultados al inicio
                mysqli_data_seek($query, 0);
                while($row = mysqli_fetch_array($query)): ?>
                <tr>
                <td>
                                <?php echo $row['cedula'] ?>
                            </td>
                            <td>
                                <?php echo $row['nombre'] ?>
                            </td>
                            <td>
                                <?php echo $row['unidad'] ?>
                            </td>
                            <td>
                                <?php echo $row['situacion'] ?>
                            </td>
                            <td>
                                <?php echo $row['novedad'] ?>
                            </td>
                    
                    <td>
                        <a href="../controlador/controladorEliminar.php?id=<?php echo $row['idEstudiantes']?>">
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </a>
                    </td>
                    <td>
                        <a href="actualizar.php?id=<?php echo $row['idEstudiantes']?>">
                            <button type="button" class="btn btn-warning">Editar</button>
                        </a>
                    </td>
                    <td>
        <button onclick="copyToClipboard('<?php echo $row['cedula'] ?>')" class="btn btn-primary">Copiar</button>
    </td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

        </article>
    </section>
           
    <div class="text-right m-5">
            <!--Cerrar sesión-->
            <?php

    if(isset($_POST["cerrar"])){
        session_destroy();
        ob_end_flush();

        header("Location: login.php");
        exit;
    }
?>

        <form method="POST" action="index.php">
            <input type="submit" class="btn-info" id="cerrar" name="cerrar" value="Cerrar Sesion">
        </form>
        </div>
    



   
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!--DataTables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tb').DataTable();
        $('#tblApi').DataTable();
    });
    </script>

<script src="../vista/source/js/funciones.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</body>

</html>