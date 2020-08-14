<?php 
session_start();

include_once '../bd/conexion.php';
try {
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idconsultas_horario = (isset($_POST['idconsultas_horario'])) ? $_POST['idconsultas_horario'] : '';
/* $fecha =(isset($_POST['fecha_bloqueo'])) ? $_POST['fecha_bloqueo'] : '' ; */
$motivo =(isset($_POST['motivo'])) ? $_POST['motivo'] : '' ; # Hay que sacar de algun lado este dato. No seria el mail?
$sql = "START TRANSACTION;";
$params = array();
for ($i = 0; $i < count($idconsultas_horario); $i++) {
    $idconsultahorario = explode('/', $idconsultas_horario[$i])[0];
    $fecha_bloqueo = explode('/', $idconsultas_horario[$i])[1];
    $sql .= "INSERT INTO consultas_horarios_bloqueos(idconsultas_horario, fecha_bloqueo, motivo) values(" . $idconsultahorario. ", '" .  $fecha_bloqueo . "', ?);" ;
    array_push($params, $motivo);
}

$sql .= "COMMIT;";

$resultado = $conexion->prepare($sql);
$retorno = $resultado->execute($params);
header("Location: ../vistas/cancelacion_consultas.php?retorno=" . $retorno);

} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
 
}
?>

