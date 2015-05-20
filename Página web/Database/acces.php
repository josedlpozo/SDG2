<?php

/*LOGIN*/

session_start();
if (!isset($_SESSION["usuario_online"])){
    $_SESSION["usuario_online"] = "";
}

$usuario = $_POST['usuario'];
$passw = $_POST['password'];


require_once 'funciones_bd.php';
$db = new funciones_BD();

	if($db->login($usuario,$passw)){

	//$resultado[]=array("logstatus"=>"0");
		$resultado["error"] = true;
		$_SESSION["usuario_online"] = false;
		$url="http://www.octopus3p.com/base_datos/login.html";
		echo "<SCRIPT>window.location='$url';</SCRIPT>"; 
	}else{
	//$resultado[]=array("logstatus"=>"1");
		$resultado["error"] = false;
		$_SESSION["usuario_online"] = $usuario;
		$url="http://www.octopus3p.com/base_datos/graficas.php";
		echo "<SCRIPT>window.location='$url';</SCRIPT>"; 
	}


								
echo json_encode($resultado);





?>
