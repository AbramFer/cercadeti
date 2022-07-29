<?php 

	include 'conexion/aut_config.inc.php';
	$conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");
	session_name($usuarios_sesion);
    session_start();


    $file_json = "LISTADO/";



 ?>