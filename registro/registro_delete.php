<?php 

	require "../conexion/aut_config.inc.php";

    $conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");

    $id_miembro = $_GET['id_miembro'];

    $sql = "DELETE FROM miembros WHERE id_miembro=$id_miembro";
    $sql2 = "DELETE FROM inscripcion_estaciones WHERE id_miembro=$id_miembro";
    $query = mysqli_query($conexion, $sql);
    $query2 = mysqli_query($conexion, $sql2);
    if ($query) {
    	echo "eliminado";
    } else {
    	echo mysqli_error($conexion);
    }

 ?>