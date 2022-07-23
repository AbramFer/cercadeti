<?php 
	include_once 'conexion/aut_config.inc.php';
    $conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");

    if ($_GET['variable']=="m") {
		$sql = "SELECT * FROM miembros WHERE sexo='m'";
    } else if ($_GET['variable']=="f") {
		$sql = "SELECT * FROM miembros WHERE sexo='f'";
    } else {
		$sql = "SELECT * FROM miembros";
    }

	$query = mysqli_query($conexion, $sql);
	$num = mysqli_num_rows($query);

	echo $num;

?>
