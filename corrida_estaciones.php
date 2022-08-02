<?php

	include 'conexion/aut_config.inc.php';
	$conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");
	session_name($usuarios_sesion);
    session_start();

	$id_vol = $_SESSION['sesion_id_usuario'];

	$people_json = file_get_contents('LISTADO/listados_estaciones.json');

	$decoded_json = json_decode($people_json, true);

	$names = $decoded_json['donacion_sangre'];
	$id_estacion = 1;

	/*foreach($names as $name) {
	    $codigo = $name["id"];


	    $sql = "SELECT * FROM miembros WHERE codigo='$codigo'";
	    $query = mysqli_query($conexion, $sql);
	    $row = mysqli_fetch_assoc($query);
	    $id_miembro = $row["id_miembro"];

	    $update = "INSERT INTO inscripcion_estaciones VALUES (NULL, '$id_estacion', '$id_miembro', $id_vol)";
		//mysqli_query($conexion, $update);


	    //echo $codigo." -> ".$id_miembro."</br>";
	}*/




	$sql_m = "SELECT * FROM miembros";
	$query_m = mysqli_query($conexion, $sql_m);
    while($row_m = mysqli_fetch_assoc($query_m)){
    	$id_miembro = $row_m["id_miembro"];

	    $update = "INSERT INTO inscripcion_estaciones VALUES (NULL, '$id_estacion', '$id_miembro', $id_vol)";
		//mysqli_query($conexion, $update);
    }


?>