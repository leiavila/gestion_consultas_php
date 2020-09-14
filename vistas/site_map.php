<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UTN - Módulo gestión consultas</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="../estilos.css" type="text/css">
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }


    ?>

    <?php include("componentes/navbar_alumno.php") ?>


    <div class="main-content" id="panel">
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">

                    <div style="padding: 16px" class="col-lg-6 col-7">
                        <h2 class="text-white">Mapa del sitio</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="card">
                <div class="card-body">
                    <ol>
                        <li href=""><b>Listado de clases de consultas</b></li>
                        <li><a href="../login.html"><b>Ingreso al sistema</b></a></li>
                        <li><b>Area Profesores</b></li>
                        <ul>

                            <li><a href="dashboard.php">Menú principal</a></li>
                            <li><a href="listado_consultas.php">Listado de clases</a></li>
                            <?php
                            if (count($_SESSION) > 0) {
                                if ($_SESSION["s_profesor"] && $_SESSION["s_profesor"] == 1) {
                                    echo  ' <li ><a href="cancelacion_consultas.php">Cancelacion de consultas</a></li>';
                                    echo  ' <li ><a href="mi_cuenta.php">Perfil</a></li>';
                                } else {
                                    echo  ' <li ><a href="../login.html">Cancelacion de consultas</a></li>';
                                    echo  ' <li ><a href="../login.html">Perfil</a></li>';
                                }
                            } else {
                                echo  ' <li ><a href="../login.html">Cancelacion de consultas</a></li>';
                                echo  ' <li ><a href="../login.html">Perfil</a></li>';
                            }

                            ?>


                            <li><a href="faq.php">FAQ</a></li>
                        </ul>

                        <li><b>Area Admin</b></li>
                        <ul>
                            <li><a href="dashboard.php">Menú principal</a></li>
                            <li><a href="listado_consultas.php">Listado de clases</a></li>
                            <?php
                            if (count($_SESSION) > 0) {
                                if ($_SESSION["s_profesor"] == 1) {
                                    echo  '<li ><a href="../login.html">Carga de horas</a></li>';
                                } else {
                                    echo  '<li ><a href="../upload-excel/uploadexc.php">Carga de horas</a></li>';
                                }
                            } else {
                                echo  '<li ><a href="../upload-excel/uploadexc.php">Carga de horas</a></li>';
                            }

                            ?>

                            <li><a href="faq.php">FAQ</a></li>

                        </ul>



                    </ol>
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


    <?php include("componentes/footer.php") ?>

</body>


</html>