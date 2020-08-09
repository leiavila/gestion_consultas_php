<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UTN - Módulo gestión consultas</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- <link rel="stylesheet" href="\gestion_consultas_php\estilos.css" type="text/css"> -->
</head>

<body>

  <?php include("componentes/sidebar.php") ?>
  <?php include("../bd/conexion.php") ?>

  <div class="main-content" id="panel">
    <?php include("componentes/navbar.php") ?>
  
    <?php $title = "Cancelación de consultas"; include("componentes/header.php") ?>


    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">

            <div class="card-header border-0">
              <h3 class="mb-0">Cancelación de consultas</h3>
            </div>

            <div class="card-body">
            <form>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Seleccione tipo de cancelación</label>
                        <select name="type" class="form-control">
                                <option value=1>Día</option>
                                <option value=2>Semana</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <!-- aca tendria que poder seleccionarse segun lo de arriba yo lo dejo en semana pero tendria que ser week o date-->
                        <label class="form-control-label" for="input-first-name">Seleccione Dia/semana</label>
                        <input type="week" id="start" name="calendar"
                        value="2018-07-22"
                        min="2018-01-01" max="2018-12-31" class="form-control">
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Horas de consulta a cancelar</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            16:10 - 17:00 - Entornos gráficos
                          </label>
                        </div>
              


                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                          <label class="form-check-label" for="defaultCheck2">
                          18:00 - 19:00 - Simulación
                          </label>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
       
                
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Motivo de la cancelación</label>
                    <textarea rows="4" class="form-control" required></textarea>
                  </div>
                </div>

                <div class="pl-lg-12">
                <p><input type="submit" class="btn btn-primary btn-block" value="CANCELAR CONSULTA" /> </p>

                </div>
              </form>
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
</body>

</html>