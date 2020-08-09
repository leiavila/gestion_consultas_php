<?php
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$resultado1 = $conexion->prepare("/*
consultas pendientes
*/
select count(*)
from consultas c 
join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
join profesor p 
      on c.idprofesor=p.idprofesor
join materia m 
      on m.matriculaMateria=c.cod_materia
where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
and c.estado ='Pendiente';");
switch ($cardnum) {
    case 1:
        $classcss = "bg-gradient-red";
        $title = "Consultas Pendientes";
        $letter = "P";
        $sql = "/*
              consultas pendientes
            */
            select count(*)
            from consultas c 
            join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
            join profesor p 
                    on c.idprofesor=p.idprofesor
            join materia m 
                    on m.matriculaMateria=c.cod_materia
            where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
            and c.estado ='Pendiente';
            ";

        break;
    case 2:
        $classcss = "bg-gradient-orange";
        $title = "Consultas para hoy";
        $letter = "H";
        $sql = "
            /*
                        consultas para hoy
            */
            select count(*)
            from consultas c 
            join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
            join profesor p 
                    on ch.idprofesor=p.idprofesor
            join tiempo t 
                    on t.idtiempo=c.idtiempo
            where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
            and t.fecha=current_date();
            ";

        break;
    case 3:
        $classcss = "bg-gradient-green";
        $title = "Consultas canceladas";
        $letter = "C";
        $sql = "
        /*
                    consultas Canceladas
        */
        select count(*)
        from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        join profesor p 
                on c.idprofesor=p.idprofesor
        join materia m 
                on m.matriculaMateria=c.cod_materia
        where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
        and c.estado ='Cancelada';
        commit;
        ";
        break;
    case 4: 
        $classcss = "bg-gradient-info";
        $title = "CONSULTAS ACEPTADAS";
        $letter = "A";
        $sql = "
        /*
                    consultas ACEPTADAS
        */
        select count(*)
        from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        join profesor p 
                on c.idprofesor=p.idprofesor
        join materia m 
                on m.matriculaMateria=c.cod_materia
        where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
        and nombre_materia= case when '$materia' is null then nombre_materia else '$materia' end
        and upper(c.estado) ='ACEPTADA';
        commit;
        ";
    case 5:
        $classcss = "bg-gradient-info";
        $title = "Alumnos Promedio";
        $letter = "AP";
        $sql = "
        /*
                    alumnos promedios 
        */;
        create temporary table if not exists Tmp (idconsultas_horario int, idtiempo int , cant_alumnos int);
        insert into Tmp
        select c.idconsultas_horario, c.idtiempo ,count(idalumno) cant_alumnos
        from consultas c 
        join consultas_horario ch on c.idconsultas_horario=ch.idconsultas_horario
        join profesor p 
                on ch.idprofesor=p.idprofesor
        where nombre_profesor=case when '$profesor' is null then nombre_profesor else '$profesor' end
        group by c.idconsultas_horario, c.idtiempo ;
        select avg(cant_alumnos)
        from Tmp;
        ";
        break;
  } 
?>

<div class="col-xl-3 col-md-6">
    <div class="card card-stats">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $title ?></h5>
                    <span class="h2 font-weight-bold mb-0">7</span>
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


