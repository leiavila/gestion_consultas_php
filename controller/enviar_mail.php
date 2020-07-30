<?php
include_once 'conexion.php';
try {
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

// Recepcion de datos enviados mediante POST dsd ajax 
$fila = (isset($_POST['fila'])) ? $_POST['fila'] : '';
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : '';

$resultado = $conexion->prepare('
    SELECT a.correo, a.nombre, ch.dia, ch.hora_ini, ch.hora_fin, m.nombre_materia, p.nombre_profesor, t.fecha
    FROM consultas c 
    INNER JOIN alumnos a on a.idalumno = c.idalumno 
    INNER JOIN consultas_horario ch on ch.idconsultas=c.idconsultas
    INNER JOIN materia m on m.idmateria=ch.idmateria
    INNER JOIN profesor p on p.idprofesor=ch.idprofesor
    INNER JOIN tiempos t on t.idtiempo = c.idtiempo
    WHERE c.idconsultas = ?
');
$retorno = $resultado->execute([$fila]);
$data = $resultado->fetch(PDO::FETCH_OBJ);
if ( $resultado->rowCount() == 1 ) {
$destinatario = $data->correo;
$asunto = "Estado de consulta";
$cuerpo = '
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
      <h1 style="font-weight:400;font-size:55px;text-align:center">UTN Facultad Regional Rosario<br>
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS2-ETqV0Ssqn4CHUvui3Gb0UnFp4KVxwDTgw&usqp=CAU" alt="Logo utn"></h1>
      
      <p style="font-size:25px;text-align:center">Hola <b>' . $data->nombre . '!</b>. Mediante este mail notificamos que se ' . $accion==1? "CONFIRMO": "RECHAZO" .  ' tu consulta para la materia ' . $data->nombre_materia . ' para el dia' . $data->dia . ' ' . $data->fecha . ' entre las '. $data->hora_ini . ' y las '. $data->hora_fin . ' con '. $data->nombre_profesor . '.</p>
      
  </body>
</html>
';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859- 1\r\n";
$headers .= "From: Contacto UTN <contacto@gestionconsultasutn.ddns.net>\r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
}

$conexion=null;

} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
 
}
