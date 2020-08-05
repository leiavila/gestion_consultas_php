<?php 
session_start();

include_once '../bd/conexion.php';
try {
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepcion de datos enviados mediante POST dsd ajax 
$idconsultas_horario = (isset($_POST['idconsultas_horario'])) ? $_POST['idconsultas_horario'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$idalumno = 1; # Hay que sacar de algun lado este dato. No seria el mail?
$resultado = $conexion->prepare(' 
INSERT INTO consultas(idtiempo, idalumno, estado, idconsultas_horario, fecha) 
VALUES( NULL, ?, ?, ?, ?)
');
$retorno = $resultado->execute([$idalumno, 'Pendiente', $idconsultas_horario, $fecha]);

print $retorno;
$conexion=null;

} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
 
}
?>

