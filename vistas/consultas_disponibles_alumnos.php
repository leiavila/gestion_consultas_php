<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UTN - Módulo gestión consultas</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- <link rel="stylesheet" href="\..\estilos.css" type="text/css"> -->
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
                    <form class="filter" id="buscar" action="" method="GET">
                        <div class="row">

                            <div class="col-12 col-sm-12 col-lg-3 p-2">Materia

                                <?php
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();
                                $resultado = $conexion->prepare('SELECT * FROM materia;');
                                $resultado->execute();
                                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                                if ($resultado->rowCount() > 0) {
                                    echo ' <select name="materia"  class="form-control" >';
                                    echo '<option value=-1> </option>';
                                    foreach ($data as $fila) {
                                        echo ' <option value="' . $fila["idmateria"] . '">' . $fila["nombre_materia"] . '</option>';
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
                                    echo ' <select name="profesor" class="form-control">';
                                    echo '<option value=-1> </option>';
                                    foreach ($data as $fila) {
                                        echo ' <option value="' . $fila["idprofesor"] . '">' . $fila["nombre_profesor"] . '</option>';
                                    }
                                    echo ' </select>';
                                } else {
                                    echo 'No hay profesores.';
                                }
                                ?>
                            </div>

                            <div class="col-12 col-sm-12 col-lg-3 p-2">
                                <br>
                                <input value="Buscar" type="submit" class="btn btn-outline-primary" id="buscar" name="buscar">
                                <input value="Borrar" type="button" class="btn btn-outline-danger" onclick="clearFilters();">
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            
                                    <?php
                                    if(isset($_GET['buscar'])) {
                                        echo '<table class="table align-items-center table-flush">';
                                        echo '<thead class="thead-white">';
                                        echo '<tr>';
                                         echo '<th scope="col">Materia</th>';
                                         echo '<th scope="col">Fecha</th>';
                                         echo '<th scope="col">Profesor</th>';
                                         echo '<th scope="col">Día</th>';
                                         echo '<th scope="col">Inicio - Fin</th>';
                                         echo '<th scope="col">Anotarme</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody class="list">';

                                        $resultado = $conexion->prepare('CALL filtro_consultas(' . $_GET['materia'] . ', ' . $_GET['profesor'] . ')');
                                        $resultado->execute();
                                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                                        if ($resultado->rowCount() > 0) {

                                            echo ' <form class="form" action="" id="accionBoton" method="POST">';
                                            foreach ($data as $fila) {
                                                echo '<tr>';
                                                echo '<td><b>' . $fila["nombre_materia"] . '</b></td>';
                                                echo '<td>' . $fila["fecha"] . '</td>';
                                                echo '<td>' . $fila["nombre_profesor"] . '</td>';
                                                echo '<td>' . $fila["dia"] . '</td>';
                                                echo '<td>' . $fila["hora_ini"] . '</td>';
                                                echo ' <td> <input type="submit" 
                                                            id="aceptar' . $fila["fecha"] . $fila["hora_ini"] . $fila["idconsultas_horario"] . '" 
                                                            name="aceptar' . $fila["fecha"] . $fila["hora_ini"] . $fila["idconsultas_horario"] . '" 
                                                            data-fecha=' . $fila["fecha"] . ' 
                                                            data-idconsultas_horario=' . $fila["idconsultas_horario"] . ' 
                                                            class="btn btn-outline-primary btn-sm" value="ANOTARME" />  
                                                        </td>';
                                                echo '</tr>';
                                            }
                                            echo '</form>';
                                        } else {
                                            echo '<th colspan=6>No hay consultas para los filtros ingresados.</th>';
                                            }
                                            echo '</tbody>';
                                           echo '</table>';
                                    }
                                    ?>

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
            document.getElementById('buscar').reset();
            document.location.href = "consultas_disponibles_alumnos.php";
        }
        $('#accionBoton').submit(function(e){
            e.preventDefault();
            var idconsultas_horario = document.activeElement.dataset.idconsultas_horario;
            var fecha = document.activeElement.dataset.fecha;        
            $.ajax({
                url:"../controller/inscribir_consulta.php",
                type:"POST",
                datatype: "text",
                data: {idconsultas_horario:idconsultas_horario, fecha:fecha}, 
                success:function(data){
                    if(data == 0){
                        Swal.fire({
                            type:'error',
                            title:'Error en la base de datos.',
                        });
                    } else{
                    /*  HAY QUE HACER QUE ENVIE MAIL AL ALUMNO      
                        $.ajax({
                            type: "POST",
                            url: "../controller/enviar_mail.php",
                            data: {fila:fila, accion:accion}, 
                            async: true,
                            success: function (data) {
                                alert(data)
                                
                            }
                        }); */
                        window.location.href = "consultas_disponibles_alumnos.php";
                    }
                }    
            });
        });
    </script>

</body>

</html>