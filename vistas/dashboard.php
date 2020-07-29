<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gestor de consultas UTN</title>
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="..\estilos.css" type="text/css">



  <!-- Argon CSS -->
  <!-- TODO ver esto si lo podemos sacar -->
  <link rel="stylesheet" href="..\assets\css\argon.css?v=1.2.0" type="text/css">

</head>

<body>

  <!-- Use any element to open the sidenav -->

  <!-- Sidenav -->
  <?php include("componentes/sidebar.php") ?>
  <?php include("../bd/conexion.php") ?>


  <!-- Main content -->
  <div class="main-content" id="panel">

    <!-- NavBar -->
    <?php include("componentes/navbar.php") ?>

    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">



        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Consultas Pendientes</h5>
                    <span class="h2 font-weight-bold mb-0">7</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      P
                    </div>
                  </div>
                </div>
                <!-- <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Consultas para hoy</h5>
                    <span class="h2 font-weight-bold mb-0">6</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      C
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Consultas canceladas</h5>
                    <span class="h2 font-weight-bold mb-0">9</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      C
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Consultas de la semana</h5>
                    <span class="h2 font-weight-bold mb-0">25</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      J
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Próximas consultas</h3>
                </div>
                <div class="col text-right">
                  <a href="listado_consultas.php" class="btn btn-sm btn-primary">Ver más</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">

              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Materia</th>
                    <th scope="col">Fecha </th>
                    <th scope="col">Hora inicio - fin</th>
                    <th scope="col">Cantidad de alumnos</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                  $resultado = $conexion->prepare('SELECT * FROM proximas_consultas;');
                  $resultado->execute();
                  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

                  if ($resultado->rowCount() > 0) {
                    foreach($data as $fila) {
                      echo '<td><b>' . $fila["nombre_materia"] . '</b></td>';
                      echo '<td>' . $fila["fecha"] . '</td>';
                      echo '<td>' . $fila["hora_ini_fin"] . '</td>';
                      echo '<td>' . $fila["cantidad_alumnos"] . '</td>';
                    }
                  } else {
                    echo '<th colspan=4>No hay próximas consultas</th>';
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
  <!-- Argon Scripts -->
  <!-- Core -->




  <script src="../codigo.js"></script>
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>


  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>