<?php
    //conexion php
    include "../modelo/coneccion.php";
    $conexion = conectar();

    //toma de datos
    $sql = "SELECT * FROM estudiantes;";
    $query = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($query);

    // Inicia la sesión después de que se haya completado toda la lógica previa
    session_start();

    if(isset($_SESSION["user"])){
        
    }else{
        header("location: login.php");
        exit(); 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Parte Diario</title>

    <!--ToastR-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="../vista/source/estilos/styles.css">

    <!-- Mala práctica: se corrige luego -->
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

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <a class="navbar-brand" href="#">
                <span class="logo-text">DCB</span>
            </a>
        </div>
        <a class="right-aligned-link btn btn-info" type="button" href="index.php">Registrar Novedad</a>
        <div class="text">
            <?php 
                ob_start(); // Inicia el búfer de salida

                $welcome_message = "<a>¡Bienvenido/a ".$_SESSION["user"]."!</a>";

                if(isset($_POST["cerrar"])){
                    session_destroy();
                    ob_clean(); // Limpia el búfer de salida

                    header("Location: login.php");
                    exit;
                }
            ?>
            <?php echo $welcome_message; ?>
        </div>
    </div>
    <!-- End Navbar -->


    <div class="text-center mt-4 text-secondary pt-4">
        <h2>Registro Personal Policial</h2>
        <p>Sistema de Parte Diario</p>
    </div>


    <section>


        <div class="px-4 m-5">

            <div class="border card border-secondary p-4 m-8 text-align-center align-items-center" id="contenedor">
                <h3 class="text-center text-primary"></h3>

                <form method="POST" action="../controlador/controladorRegistroPersonal.php" enctype="multipart/form-data">
                    <div id="form-formulario">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Cédula</label>
                            <div class="col-sm-9">

                                <input type="text" maxlength="10" name="cedula" id="cedula"
                                    onkeypress="return controlLetras(event)" class="form-control"
                                    style="max-width: 200px" placeholder="Ingrese la cédula" required>

                                <!-- oculto -->
                                <input type="button" onclick="buscaTres(this,'buscaPersonalms')" id="Buscar"
                                    value="Buscar" class="btn btn-primary" hidden>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="white-space: nowrap;">Nombres</label>
                            <div class="col-sm-9">
                                <input type="text" name="namefull" id="nombres"
                                    onkeypress="return controlNumeros(event)" class="form-control"
                                    style="max-width: 400px" placeholder="Apellidos y Nombres" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Estado</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="situacion" value="Activo"
                                        checked>
                                    <label class="form-check-label">Activo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="situacion" value="Pasivo">
                                    <label class="form-check-label">Pasivo</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Unidad</label>
                            <div class="col-sm-9">
                                <input type="text" name="unidad" id="unidad" 
                                    class="form-control" style="max-width: 300px" placeholder="Ingrese su Unidad">
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <?php
                                ?>
                                <input type="submit" onclick="registro()" class="btn btn-info" id="guardar"
                                    name="guardar" value="Registrar">
                                <input type="reset" class="btn btn-secondary" id="limpiar" name="limpiar"
                                    value="Limpiar">

               
                            </div>
                        </div>
                    </div>
                </form>
            </div>


    </section>

    <div class="text-right m-5">
        <!--Cerrar sesión-->
        <?php
    ob_start();

    if(isset($_POST["cerrar"])){
        session_destroy();
        ob_clean(); // Limpiar el búfer de salida

        header("Location: login.php");
        exit;
    }
?>

        <form method="POST" action="index.php">
            <input type="submit" class="btn-info" id="cerrar" name="cerrar" value="Cerrar Sesion">
        </form>


    </div>





    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    <!--DataTables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tb').DataTable();
            $('#tblApi').DataTable();
        });
    </script>

    <script src="../vista/source/js/funciones.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</body>

</html>