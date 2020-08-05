
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestor de consultas UTN</title>
    <link rel="stylesheet" href="..\estilos.css" type="text/css">
</head>

<body>

    <?php include("../vistas/componentes/sidebar.php") ?>
    <div class="main-content" id="panel">
        <?php include("../vistas/componentes/navbar.php") ?>

        <!-- Header -->
        <div class="header bg-primary pb-6 container-fluid">
            <div style="padding: 16px" class="col-lg-6 col-7">
                <h2 class="text-white">Carga de horas</h6>
            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3>Listado de consultas pendientes de aprobación</h3>
                        </div>

                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                 
                                    <form action = "?" method="post" enctype="multipart/form-data">
                                    <label>Seleccione el archivo a subir</label>
                                    <p><input  class="form-control" placeholder="Seleccione el archivo a subir" type="file"  name="file"/> </p>
                                    <p><input type="submit" name="upload" class="btn btn-primary btn-block" value="ACTUALIZAR HORAS DE CONSULTA"/> </p>
                                    </form>

                     
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>


</body>



</html>


<?php
require '../vendor/autoload.php';
require '../bd/conexion.php';

if(isset($_POST['upload'])){
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $file_store = "../upload-excel/".$file_name;
    move_uploaded_file($file_tem_loc, $file_store);
    echo "<script> alert('tengo que ponerle el sweetalert2 pero tengo sueño :('); </script>"; 
    $objeto = new Conexion();

$conexion = $objeto->Conectar();

$array_consultas = array();

//Variable con el nombre del archivo
$nombreArchivo = "../upload-excel/".$file_name;
// Cargo la hoja de cálculo
$objPHPExcel = PhpOffice\PhpSpreadsheet\IOFactory::load($nombreArchivo);

//Asigno la hoja de calculo activa
$objPHPExcel->setActiveSheetIndex(0);
//Obtengo el numero de filas del archivo
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


for ($i = 2; $i <= $numRows; $i++) {

    $id = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
    $legajo = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
    $materia = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
    $inicio = $objPHPExcel->getActiveSheet()->getCell('D' . (string)$i)->getCalculatedValue();
    $fin = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
    $diasemana = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

    array_push($array_consultas, $id, $legajo, $materia, $inicio, $fin, $diasemana);
    // echo "<tr>";
    // echo "<td>".$id."</td>";
    // echo "<td>". $legajo."</td>";
    // echo "<td>".$materia."</td>";
    // echo "<td>".$inicio."</td>";
    // echo "<td>".$fin."</td>";
    // echo "<td>".$diasemana."</td>";
    // echo "</tr>";
    // echo '<td><tr>'$id'</tr>  <tr>''</tr>  <tr>''</tr>  <tr>''</tr> </td>';

    $sql = "INSERT INTO consultas (idconsultas, legajo_profesor, id_materia, hora_inicio, hora_fin) VALUES('$id','$legajo','$materia', '$inicio', '$fin')";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    
}
}




echo '<table>';

?>
