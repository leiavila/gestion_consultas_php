<?php 
session_start();

include_once '../bd/conexion.php';
try {
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepcion de datos enviados mediante POST dsd ajax 
// Aca me traigo desde la consulta de carga alumno 
$idconsultas_horario = (isset($_POST['idconsultas_horario'])) ? $_POST['idconsultas_horario'] : '';
$idtiempo = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$legajo =(isset($_POST['Legajo'])) ? $_POST['Legajo'] : '' ;
$Nombre =(isset($_POST['Nombre'])) ? $_POST['Nombre'] : '' ;
$Apellido =(isset($_POST['Apellido'])) ? $_POST['Apellido'] : '' ;
$correo =(isset($_POST['Correo'])) ? $_POST['Correo'] : '' ; # Hay que sacar de algun lado este dato. No seria el mail?
$resultado = $conexion->prepare(' 
start transaction;

insert into alumno(legajo, nombre, correo)
select j.legajo, j.nombre, j.correo from (select '$Legajo' legajo, upper(concat('$Nombre',' ','$Apellido' ))nombre, '$correo' correo) j
left join alumno a on j.legajo=a.legajo
where a.legajo is null;

update  alumno a
join  (select '$Legajo' legajo, upper(concat('$Nombre',' ','$Apellido' ))nombre, '$correo' correo) j on j.legajo=a.legajo
set a.nombre= j.nombre, 
a.correo= j.correo;

insert into consultas(idtiempo, idalumno, estado, idconsultas_horario, fecha)
select '$idtiempo', idalumno, "Pendiente", '$idconsultas_horario', getdate()
from alumno a 
Where a.legajo='$Legajo';
 
Commit;

');
$retorno = $resultado->execute([$idalumno, 'Pendiente', $idconsultas_horario, $fecha]);

print $retorno;
$conexion=null;

} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
 
}
?>

