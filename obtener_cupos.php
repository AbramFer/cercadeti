<?php 
	include_once 'conexion/aut_config.inc.php';
    $conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");

    session_name($usuarios_sesion);
    session_start();

    if ($_GET['opcion']=="1") {
		$sql = "SELECT * FROM estaciones";
		$query = mysqli_query($conexion, $sql);

		$row3 = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$nombre = $row["nombre"];
			$total = $row["cupos"];
			$id_estaciones = $row["id_estaciones"];
			$cupos_vol = $row["cupos_vol"];

			$sql_qr = "SELECT COUNT(i.id_ie) AS total FROM inscripcion_estaciones AS i WHERE i.id_estaciones=$id_estaciones AND i.id_voluntario=$_SESSION[sesion_id_usuario]";
			$qr = mysqli_query($conexion,$sql_qr);
			$rw21 = mysqli_fetch_assoc($qr);
			$total = $cupos_vol - $rw21["total"];

			$sql2 = "SELECT COUNT(id_estaciones) as ocupados FROM inscripcion_estaciones WHERE id_estaciones=$id_estaciones";
			$query2 = mysqli_query($conexion, $sql2);
			$row2 = mysqli_fetch_assoc($query2);
			$ocupados = $row2["ocupados"];

			$disponible = $total - $ocupados;

			$row3[] = $total;
		}

		echo json_encode($row3);
			//echo "<label>".$row3."</label></br>";

    } else if ($_GET['opcion']=="2") {
    	$buscar = $_GET['variable'];
		$sql = "SELECT * FROM estaciones WHERE id_estaciones=$buscar";
		$query = mysqli_query($conexion, $sql);
		$row = mysqli_fetch_assoc($query);
		$total = $row["cupos"];

		$sql2 = "SELECT COUNT(id_estaciones) as ocupados FROM inscripcion_estaciones WHERE id_estaciones=$buscar";
		$query2 = mysqli_query($conexion, $sql2);
		$row2 = mysqli_fetch_assoc($query2);
		$ocupados = $row2["ocupados"];

		$disponible = $total - $ocupados;
		echo $disponible;
    }

?>
