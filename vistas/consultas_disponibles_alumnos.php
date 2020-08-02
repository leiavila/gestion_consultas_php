<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UTN - Módulo gestión consultas</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="\..\estilos.css" type="text/css">
</head>

<body>
    <?php include("componentes/navbar_alumno.php") ?>

    <?php include("../bd/conexion.php") ?>
    <!-- Main content -->
    <div class="main-content" id="panel">

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">

                    <div style="padding: 16px" class="col-lg-6 col-7">
                        <h2 class="text-white">Listado de consultas</h6>
                    </div>
                    <p style="color:white">En este apartado encontrarás los horarios de consultas disponibles.<br>
                        Se puede filtrar por profesor y por materia. Una vez que envíes la solicitud recordá revisar tu casilla de correo.</p>

                </div>
            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Filtros</h3>
                </div>
                <div class="card-body">
                    <form class="filter" id="filterform" action="" method="POST ">
                        <div class="row">


                            <div class="col-12 col-sm-12 col-lg-3 p-2">
                                Fecha
                                <input type="text" class="form-control" id="fecha" name="fecha">
                            </div>

                            <div class="col-12 col-sm-12 col-lg-3 p-2">Materia

                                <?php
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();
                                $resultado = $conexion->prepare('SELECT * FROM materia;');
                                $resultado->execute();
                                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                                if ($resultado->rowCount() > 0) {
                                    echo ' <select class="form-control" >';
                                    echo '<option> </option>';
                                    foreach ($data as $fila) {
                                        echo ' <option>' . $fila["nombre_materia"] . '</option>';
                                    }
                                    echo ' </select>';
                                } else {
                                    echo 'No hay materias.';
                                }
                                ?>

                            </div>
                            <div class="col-12 col-sm-12 col-lg-3 p-2">Profesor
                                <?php
                                $resultado = $conexion->prepare('SELECT * FROM profesor;');
                                $resultado->execute();
                                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                                if ($resultado->rowCount() > 0) {
                                    echo ' <select class="form-control">';
                                    echo '<option> </option>';
                                    foreach ($data as $fila) {
                                        echo ' <option>' . $fila["nombre_profesor"] . '</option>';
                                    }
                                    echo ' </select>';
                                } else {
                                    echo 'No hay profesores.';
                                }
                                ?>
                            </div>

                            <div class="col-12 col-sm-12 col-lg-3 p-2">
                                <br>
                                <button type="button" class="btn btn-outline-primary" name="buscar" onclick="search();">Buscar</button>
                                <button type="button" class="btn btn-outline-danger" onclick="clearFilters();">Borrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-white">
                                    <tr>
                                        <th scope="col">Materia</th>
                                        <th scope="col">Profesor</th>
                                        <th scope="col">Día</th>
                                        <th scope="col">Inicio - Fin</th>
                                        <th scope="col">Anotarme</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php

                                    $resultado = $conexion->prepare('SELECT * FROM consultas_horario ch inner join materia m on m.idmateria = ch.idmateria inner join profesor p on p.idprofesor = ch.idprofesor');
                                    $resultado->execute();
                                    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                                    if ($resultado->rowCount() > 0) {

                                        echo ' <form class="form" action="" id="accionBoton" method="POST">';
                                        foreach ($data as $fila) {
                                            echo '<tr>';
                                            echo '<td><b>' . $fila["nombre_materia"] . '</b></td>';
                                            echo '<td>' . $fila["nombre_profesor"] . '</td>';
                                            echo '<td>' . $fila["dia"] . '</td>';
                                            echo '<td>' . $fila["hora_ini"] . ' - ' . $fila["hora_fin"] . '</td>';
                                            echo ' <td> <input type="submit" id="aceptar' . $fila["idconsultas_horario"] . '1" name="aceptar' . $fila["idconsultas_horario"] . '1" data-accion=1 data-fila=' . $fila["idconsultas_horario"] . ' class="btn btn-outline-primary btn-sm" value="ANOTARME" />  </td>';
                                            echo '</tr>';
                                        }
                                        echo '</form>';
                                    } else {
                                        echo '<th colspan=5>No hay consultas para los filtros ingresados.</th>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../assets/js/argon.js?v=1.2.0"></script>
  

    <script>
        function clearFilters() {
            document.getElementById('filterform').reset();
        }
    </script>


    <script>
        function search() {
            alert("HOLA PABLOOOOO");
        }
    </script>

</body>

</html>