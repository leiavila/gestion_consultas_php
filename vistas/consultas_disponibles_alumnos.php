<!DOCTYPE html>
<html>

<head>

  <link rel="shortcut icon" href="#" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UTN - Módulo gestión consultas</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vistas/listado_consultas.css">
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


    <!-- Page content -->
    <div class="container-fluid mt--6">

    <div class="card">
        <div class="card-header border-0">
        <h3 class="mb-0">Filtros</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    Fecha
                    <input type="text" class="form-control">
                </div>
                
                <div class="col">Materia
                <select class="form-control">
  <option>Default select</option>
</select>
                </div>
                <div class="col">Profesor
                <input type="text" class="form-control">

                </div>
                <div class="col">
                    <br>
                <button type="button" class="btn btn-outline-primary">Buscar</button>
                <button type="button" class="btn btn-outline-danger">Borrar</button>
                </div>
            </div>
        </div>
    </div>


      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <!-- <div class="card-header border-0">
              <h3 class="mb-0">Listado de consultas pendientes de aprobación</h3>
            </div> -->
            <!-- Light table -->
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
                            <input type="submit" id="aceptar' . $fila["id"] . '1" name="aceptar' . $fila["id"] . '1" data-accion=1 data-fila=' . $fila["id"] . ' class="btn btn-outline-primary btn-sm" value="ANOTARME" />
                           
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
            <!-- <div class="card-footer py-4">
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
            </div> -->
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
  <script src="../codigo.js"></script>

</body>

</html>