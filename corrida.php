<?php 

	include 'conexion/aut_config.inc.php';
	$conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");
	session_name($usuarios_sesion);
    session_start();

	$sql_miembros = "SELECT * FROM miembros WHERE codigo IS NULL";
	$query_miembros = mysqli_query($conexion, $sql_miembros);
	$i = 0;
	
	while ($row_miembros = mysqli_fetch_assoc($query_miembros)) {
		//echo $row_miembros["nombres"]."</br>";
		$id = $row_miembros["id_miembro"];

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
		$arrayRange = range($rango[0],$rango[1]);
		$missingValues = array_diff($arrayRange,$testArray);

		if ($missingValues!=null) {
	    	$missingValues = array_values($missingValues);

	    	//print_r($missingValues);
			$number = $missingValues[0];

			
			$length = 4; 
			$string = substr(str_repeat(0, $length).$number, - $length); 

			$update = "UPDATE miembros SET codigo='A".$string."' WHERE id_miembro=$id";
			mysqli_query($conexion, $update);

		}
	}






 ?>