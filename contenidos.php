<?php 
	
	//$_SESSION['usu_nivel_usuario'] = 0;

	switch ($type) {
		default:
			include("dashboard/valida_dashboard.php");
		break;

		case 'registro_add':
			include('registro/registro_add.php');
		break;

		case 'registro_edit':
			include('registro/registro_edit.php');
		break;

		case 'registro_view':
			include('registro/registro_view.php');
		break;

		case 'registro_search':
			include('registro/registro_search.php');
		break;


		case 'estaciones_view':
			include('estaciones/estaciones_view.php');
		break;

		case 'estaciones_add':
			include('estaciones/estaciones_add.php');
		break;

		case 'estaciones_edit':
			include('estaciones/estaciones_edit.php');
		break;


	}

 ?>