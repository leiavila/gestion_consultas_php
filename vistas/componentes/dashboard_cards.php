
<?php

// Saco nombre de usuario
$nombre_usuario = $_SESSION['s_usuario'];
//echo $nombre_usuario;

switch ($cardnum) {
    case 1:
        $classcss = "bg-gradient-red";
        $title = "Consultas Pendientes";
        $letter = "P";

        // ERROR
        $sql = "select count(*) 
                from consultas c  
                join consultas_horario ch 
                    on c.idconsultas_horario=ch.idconsultas_horario 
                left join usuarios u 
                    on ch.idprofesor=u.idprofesor and u.usuario= ?
        where ch.idprofesor= case when ? ='admin' then ch.idprofesor else u.idprofesor end 
        and upper(c.estado) like '%PENDIENTE%';   
       ";
            $resultado = $conexion->prepare($sql);
            $resultado->execute([$nombre_usuario, $nombre_usuario]);
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado->rowCount() == 0) {
                echo '<label class="text-white">ERROR</label>';
            }

        break;
    case 2:
        $classcss = "bg-gradient-orange";
        $title = "Consultas para hoy";
        $letter = "H";
        $sql = " select count(*) from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        join profesor p on ch.idprofesor=p.idprofesor
        left join usuarios u 
            on ch.idprofesor=u.idprofesor and u.usuario=?
        where ch.idprofesor= case when ? ='admin' then ch.idprofesor else u.idprofesor end 
        and c.fecha=current_date();
        ";
        $resultado = $conexion->prepare($sql);
        $resultado->execute([$nombre_usuario, $nombre_usuario]);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado->rowCount() == 0) {
            echo '<label class="text-white">ERROR</label>';
        }
        break;

    case 3:
        $classcss = "bg-gradient-green";
        $title = "Consultas canceladas";
        $letter = "C";
        $sql = "
        select count(*)
        from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        left join usuarios u 
            on ch.idprofesor=u.idprofesor and u.usuario= ?
        where ch.idprofesor= case when ? ='admin' then ch.idprofesor else u.idprofesor end 
        and upper(c.estado) like 'CANCELADA';
        commit;
        ";

        // ERROR
        $resultado = $conexion->prepare($sql);
        $resultado->execute([$nombre_usuario, $nombre_usuario]);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado->rowCount() == 0) {
            echo '<label class="text-white">ERROR</label>';
        }
        break;
    case 4: 
        $classcss = "bg-gradient-info";
        $title = "CONSULTAS ACEPTADAS";
        $letter = "A";
        

        // ERROR

        $sql = "
        select count(*)
        from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        left join usuarios u 
            on ch.idprofesor=u.idprofesor and u.usuario= ?
        where ch.idprofesor= case when ? ='admin' then ch.idprofesor else u.idprofesor end 
        and upper(c.estado) like '%ACEPTADA%';
        ";

        $resultado = $conexion->prepare($sql);
        $resultado->execute([$nombre_usuario, $nombre_usuario]);
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
       
        if ($resultado->rowCount() == 0) {
            echo '<label class="text-white">ERROR</label>';
        }
    break;
    // case 5:
    //     $classcss = "bg-gradient-info";
    //     $title = "Alumnos Promedio";
    //     $letter = "AP";
    //     $sql = "
    //     /*
    //                 alumnos promedios 
    //     */;
    //     create temporary table if not exists Tmp (idconsultas_horario int, idtiempo int , cant_alumnos int);
    //     insert into Tmp
    //     select c.idconsultas_horario, c.idtiempo ,count(idalumno) cant_alumnos
    //     from consultas c 
    //     join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
    //     join profesor p 
    //             on ch.idprofesor=p.idprofesor
    //     where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
    //     group by c.idconsultas_horario, c.idtiempo ;
    //     select avg(cant_alumnos)
    //     from Tmp;
    //     ";
    //     break;
  } 
?>

<div class="col-xl-3 col-md-6">
    <div class="card card-stats">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $title ?></h5>
                    <span class="h2 font-weight-bold mb-0"><?php 
                    foreach ($data as $fila) {
                        echo $fila['count(*)'];
                    }
                    ?>
                
                </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape text-white rounded-circle shadow <?php echo $classcss ?>">
                    <?php echo $letter ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


