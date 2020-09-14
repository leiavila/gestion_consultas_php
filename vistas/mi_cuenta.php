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

 <?php

 include("componentes/sidebar.php") ?>

  <div class="main-content" id="panel">

     <?php include("componentes/navbar.php") ?>
     <?php include("../bd/conexion.php");
  $objeto = new Conexion();
  $conexion = $objeto->Conectar(); ?>

<br>
<br>
<br>
<br>

<?php 

$resultado = $conexion->prepare('SELECT * FROM profesor WHERE idprofesor = ?;');
$resultado->execute([$_SESSION["s_profesor"]]);
$data = $resultado->fetch(PDO::FETCH_ASSOC);

?>
  
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
              <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <h6 class="heading-small text-muted mb-4">Informacion Usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Dirección de correo</label>
                        <input name="correo" type="email" id="input-email" class="form-control" placeholder="Ingrese su email" value="<?php echo $data["correo"] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nombre</label>
                        <input name="nombre" type="text" id="input-first-name" class="form-control" placeholder="Nombre" value="<?php echo explode(", ", $data["nombre_profesor"])[1] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Apellido</label>
                        <input name="apellido" type="text" id="input-last-name" class="form-control" placeholder="Apellido" value="<?php echo explode(", ", $data["nombre_profesor"])[0] ?>">
                      </div>
                    </div>
                  </div>
                </div>
       
                
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Observaciones</label>
                    <textarea name="observaciones" rows="4" class="form-control" placeholder="Ingrese observaciones"><?php echo $data["observaciones"] ?></textarea>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="form-group">
                  <input value="Guardar" type="submit" class="btn btn-outline-primary" id="guardar" name="guardar">
                  </div>
                </div>
                <?php 
                    if(isset($_POST['guardar']) ) {
                      $nombre_profesor = $_POST['apellido'] . ", " . $_POST['nombre'];
                      $resultado = $conexion->prepare("
                      START TRANSACTION;
                          UPDATE profesor p 
                          SET p.nombre_profesor = ?, p.observaciones = ?, p.correo = ? 
                          WHERE p.idprofesor = ?;
                      COMMIT;");
                      $retorno = $resultado->execute([$nombre_profesor, $_POST['observaciones'], $_POST['correo'], $_SESSION['s_profesor']]);
                      if ($retorno) {
                        
                        echo '<div class="correcto">Datos guardados correctamente.</div>';

                      }
                    }
                ?>
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