<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gestor de consultas UTN</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="\bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="\gestion_consultas_php\estilos.css" type="text/css">
</head>

<body>

 <?php include("componentes/sidebar.php") ?>

  <div class="main-content" id="panel">

     <?php include("componentes/navbar.php") ?>

<br>
<br>
<br>
<br>
  
    <div class="container-fluid mt--6">
      <div class="row">
        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3>Editar perfil</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Dirección de correo</label>
                        <input type="email" id="input-email" class="form-control" placeholder="Ingrese su email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nombre</label>
                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Apellido</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                      </div>
                    </div>
                  </div>
                </div>
       
                
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Observaciones</label>
                    <textarea rows="4" class="form-control" placeholder="Ingrese observaciones"></textarea>
                  </div>
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
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>