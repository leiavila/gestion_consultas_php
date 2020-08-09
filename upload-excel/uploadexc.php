<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestor de consultas UTN</title>
    <link rel="stylesheet" href="\bootstrap/css/bootstrap.min.css">
</head>

<body>

    <?php include("../vistas/componentes/sidebar.php") ?>
    <div class="main-content" id="panel">
        <?php include("../vistas/componentes/navbar.php") ?>

        <div class="header bg-primary pb-6 container-fluid">
            <div style="padding: 16px" class="col-lg-6 col-7">
                <h2 class="text-white">Carga de horas</h6>
            </div>
        </div>

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3>Listado de consultas pendientes de aprobación</h3>
                        </div>

                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="?" method="post" enctype="multipart/form-data">
                                            <label>Seleccione el archivo a subir</label>
                                            <p><input class="form-control" placeholder="Seleccione el archivo a subir" type="file" name="file" /> </p>
                                            <p><input type="submit" name="upload" class="btn btn-primary btn-block" value="ACTUALIZAR HORAS DE CONSULTA" /> </p>
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

    <?php
    require '../vendor/autoload.php';
    require '../bd/conexion.php';

    if (isset($_POST['upload'])) {
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = ".." . $file_name;
        move_uploaded_file($file_tem_loc, $file_store);
        $objeto = new Conexion();

        $conexion = $objeto->Conectar();
        $array_consultas = array();

        //Variable con el nombre del archivo
        $nombreArchivo = "../upload-excel/" . $file_name;
        // Cargo la hoja de cálculo
        $objPHPExcel = PhpOffice\PhpSpreadsheet\IOFactory::load($nombreArchivo);

        //Asigno la hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        //Obtengo el numero de filas del archivo
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();



        for ($i = 2; $i <= $numRows; $i++) {

            $legajo = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $materia = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $inicioHora = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $inicioMin = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $finHora = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $finMin = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $dia = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();

            $sql = "create temporary table if not exists TMP_consultas (legajo int , 
												cod_materia varchar(45), 
                                                dia varchar(45), 
                                                hora_inicio varchar(45), 
                                                min_inicio varchar(45),
                                                min_fin varchar(45),
                                                hora_fin varchar(45)) ;
INSERT INTO TMP_consultas (legajo, id_materia,dia, hora_inicio, min_inicio, hora_fin, min_fin) VALUES('$legajo','$materia','$dia', '$inicioHora', '$inicioMin', '$finHora', '$finMin');

start transaction;
insert into consultas_horario (id_profesor,id_materia,diaSemana, horarioConsultaInicio, HorarioconsultaFin, estadoConsulta, fecha_carga)
select  p.id_profesor, m.id_materia, c.hora_fin+':'+c.min_inicio, c.hora_inicio+':'+c.min_fin, 'Aceptada', current_date()
from TMP_consultas c 
join profesor p 
		on c.legajo=p.legajo
join materia m 
		on m.matriculaMateria=c.cod_materia;
commit;
";

            $resultado = $conexion->prepare($sql);
            $resultado->execute();
        }
    }


    // borro las variables porque si no cuando volves a entrar no se limpian
    $vars = array_keys(get_defined_vars());
    foreach ($vars as $var) {
        unset(${"$var"});
    }


    ?>

</body>

</html>