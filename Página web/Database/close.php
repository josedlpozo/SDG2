<?php

/*LOGIN*/

session_start();

unset($_SESSION["usuario_online"]);


$url="http://www.octopus3p.com/base_datos/login.html";
echo "<SCRIPT>window.location='$url';</SCRIPT>"; 





?>