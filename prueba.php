<?php

require "conexion/aut_config.inc.php";

session_name($usuarios_sesion);
session_start();

$conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");


if ($_SESSION['sesion_nivel']!=1) {
	$rango = explode("-", $_SESSION['sesion_rango']);

	$length = 4; 
	$min_rango = substr(str_repeat(0, $length).$rango[0], - $length);
	$max_rango = substr(str_repeat(0, $length).$rango[1], - $length);

	$s_cod = "SELECT codigo FROM miembros WHERE codigo BETWEEN 'A".$min_rango."' AND 'A".$max_rango."'";
	$q_cod = mysqli_query($conexion, $s_cod);

	$testArray = array();
	while ($row = mysqli_fetch_assoc($q_cod)) {
		$codigo = substr($row["codigo"], -4);

		$testArray [] = ltrim($codigo,"0");

	}
	$arrayRange = range(1,100);
	$missingValues = array_diff($arrayRange,$testArray);
	$a = json_encode($missingValues);



	//print_r($missingValues);

	if ($missingValues!=null) {
    	$missingValues = array_values($missingValues);
		echo $missingValues[0];

	} else {
		echo "te quedaste uelio";
	}

	/////////////////////////////
	//print_r($missingValues); //
	/////////////////////////////

	//echo $a;

}





 ?>