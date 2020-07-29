<?php 
session_start();

include_once 'conexion.php';
try {
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepcion de datos enviados mediante POST dsd ajax 
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clave encriptada y almacenada en la BD

$resultado = $conexion->prepare('SELECT usuario FROM usuarios WHERE usuario = ? AND password = ?');
$resultado->execute([$usuario, $pass]);
$_SESSION["s_usuario"] = null;
$data = $resultado->fetch(PDO::FETCH_OBJ);

if ( $resultado->rowCount() == 1 ) {
    $_SESSION["s_usuario"] = $data->usuario;
}

print json_encode($data);
$conexion=null;

} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
 
}
?>

