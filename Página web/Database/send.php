
<?php

        $temp = $_POST['temp'];
        $htierra = $_POST['htierra'];
        $haire = $_POST['haire'];
        $rocio = $_POST['rocio'];
        $gradosbruj = $_POST['gradosbruj'];
        $acx = $_POST['acx'];
        $acy = $_POST['acy'];
        $acz = $_POST['acz'];
        $user = $_POST['user'];
        
require_once 'funciones_bd.php';
	$db = new funciones_BD();
       // mysql query
		$temp = (int)$temp;
		$htierra = (int)$htierra;
		$haire = (int)$haire;
		$rocio = (int)$rocio;
		$gradosbruj = (int)$gradosbruj;
		$acx = (int)$acx;
		$acy = (int)$acy;
		$acz = (int)$acz;

		if($db->insert_data($temp,$htierra,$haire,$rocio,$gradosbruj,$acx,$acy,$acz,$user)){
			$resultado["error"] = false;

		}else{
			$resultado["error"] = true;
		}

		/*if($db->login($temp,$htierra)){

	//$resultado[]=array("logstatus"=>"0");
	$resultado["error"] = true;
	}else{
	//$resultado[]=array("logstatus"=>"1");
	$resultado["error"] = false;
	}*/


        
       // echo json response
    echo json_encode($resultado);



?>