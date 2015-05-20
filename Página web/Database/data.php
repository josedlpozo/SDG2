<?php

session_start();


require_once 'funciones_bd.php';
$db = new funciones_BD();

$usuario = $_SESSION["usuario_online"];


$result = mysql_query("SELECT fecha, temp FROM ". $_SESSION["usuario_online"]);

$rows = array();
while($r = mysql_fetch_array($result)) {
    $row[0] = $r[0];
    $row[1] = $r[1];
    array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);

mysql_close($con);
?>