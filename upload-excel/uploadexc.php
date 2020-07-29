<?php
require '../vendor/autoload.php';
require '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$array_consultas = array();

use PhpOffice\PhpSpreadsheet\Spreadsheet;

//Variable con el nombre del archivo
$nombreArchivo = '../upload-excel/excel_value.xlsx';
// Cargo la hoja de cálculo
$objPHPExcel = PhpOffice\PhpSpreadsheet\IOFactory::load($nombreArchivo);

//Asigno la hoja de calculo activa
$objPHPExcel->setActiveSheetIndex(0);
//Obtengo el numero de filas del archivo
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

// echo '<table border=1><tr><td>idconsultas</td><td>legajo</td><td>materia</td><td>inicio</td><td>fin</td><td>Dia de la semana</td></tr>';

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

echo '<table>';

?>

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
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Seleccione el archivo a subir</label>
                                            <input type="email" id="input-email" class="form-control" placeholder="Seleccione el archivo a subir">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block">ACTUALIZAR HORAS DE CONSULTA</button>
                            <hr class="my-4" />
                            <!-- Address -->

                            <h3> Las horas actualizadas fueron las siguientes </h3>

                            <p>Hay que armar una tablita con el valor de de $array_consultas, el insert a la BD la está haciendo</p>

                            <?php

                                // foreach($array_consultas as $key => $value)
                                // {
                                // echo $key. $value; '<BR>';
                                // }

                               
                                print_r(array_values($array_consultas));
                                ?>
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