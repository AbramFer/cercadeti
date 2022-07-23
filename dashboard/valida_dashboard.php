<?php 
//NIVELES

switch ($_SESSION['sesion_nivel']){
	case 1:
		include("administrador.php");
	break;
	case 2:
		include("voluntario.php");
	break;
}
?>