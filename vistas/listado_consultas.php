<!DOCTYPE html>
<html>

<head>

  <link rel="shortcut icon" href="#" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UTN - Módulo gestión consultas</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vistas/listado_consultas.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

  <!-- Argon CSS -->
  <link rel="stylesheet" href="\gestion_consultas_php\estilos.css" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <?php include("componentes/sidebar.php") ?>
  <?php include("../bd/conexion.php") ?>
  <!-- Main content -->
  <div class="main-content" id="panel">

    <!-- NavBar -->
    <?php include("componentes/navbar.php") ?>


    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">

          <div style="padding: 16px" class="col-lg-6 col-7">
            <h2 class="text-white">Listado de consultas</h6>
          </div>

        </div>
      </div>
    </div>


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Listado de consultas pendientes de aprobación</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Materia</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Inicio - Fin</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Acción</th>
                  
                  </tr>
                </thead>
                <tbody class="list">
                <?php
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                  $resultado = $conexion->prepare('SELECT * FROM consultas_pendientes_aprobacion;');
                  $resultado->execute();
                  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                  if ($resultado->rowCount() > 0) {
                    echo ' <form class="form" action="" id="accionBoton" method="POST">';
                    foreach($data as $fila) {
                      echo '<tr>';
                        echo '<td><b>' . $fila["nombre_materia"] . '</b></td>';
                        echo '<td>' . $fila["fecha"] . '</td>';
                        echo '<td>' . $fila["hora_ini_fin"] . '</td>';
                        echo '<td>' . $fila["nombre"] . '</td>';
                        echo '
                        <td>
                            <input type="submit" id="aceptar' . $fila["id"] . '1" name="aceptar' . $fila["id"] . '1" data-accion=1 data-fila=' . $fila["id"] . ' class="btn btn-success btn-sm" value="ACEPTAR" />
                            <input type="submit" id="aceptar' . $fila["id"] . '2" name="rechazar' . $fila["id"] . '2" data-accion=2 data-fila=' . $fila["id"] . ' class="btn btn-danger btn-sm" value="RECHAZAR" />
                        </td>';
                      echo '</tr>';
                    }
                    echo '</form>';
                  } else {
                    echo '<th colspan=5>No hay consultas pendientes de aprobación.</th>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Siguiente</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    

    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
  <script src="../codigo.js"></script>

</body>

</html>