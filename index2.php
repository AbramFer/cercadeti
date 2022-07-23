<?php 

	require "conexion/aut_verifica.inc.php";
	require "conexion/aut_config.inc.php";

    $conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db");
    $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    //header('Content-type: text/html; charset=UTF-8');
    //
    //$nivel_acceso = 10;
    //
    include_once 'funciones_generales.php';

	$type="";
    if (isset($_GET["type"])) {
        $type=$_GET["type"];
    }

    if ($type){
        if($type=="out"){
            // le damos un mobre a la sesión (por si quisieramos identificarla)
            // iniciamos sesiones
        } else {

        }
    }
    error_reporting(E_ALL^E_NOTICE);


 ?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Página oficial del cerca de ti de la Misión Venezolana de Portuguesa (MVP)" />
    <meta name="keywords" content="SISTEMA MVP, MVP, cercadeti MVP" />
    <meta name="author" content="Abraham Fernandez" />
	<title>Gestión Cerca de ti MPV</title>
    
    <link rel="shortcut icon" href="componentes_mios/banco_imagenes/pp.jpg" />
	
	<link rel="apple-touch-icon" sizes="57x57" href="componentes_mios/bancodeimagenes/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="componentes_mios/bancodeimagenes/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="componentes_mios/bancodeimagenes/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="componentes_mios/bancodeimagenes/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="componentes_mios/bancodeimagenes/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="componentes_mios/bancodeimagenes/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="componentes_mios/bancodeimagenes/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="componentes_mios/bancodeimagenes/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="componentes_mios/bancodeimagenes/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="componentes_mios/bancodeimagenes/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="componentes_mios/bancodeimagenes/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="componentes_mios/bancodeimagenes/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="componentes_mios/bancodeimagenes/favicon/favicon-16x16.png">
	<link rel="manifest" href="componentes_mios/bancodeimagenes/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="componentes_mios/bancodeimagenes/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="componentes_originales/plugins/fontawesome-free/css/all.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="componentes_originales/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="componentes_originales/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<!-- <link rel="stylesheet" href="componentes_originales/plugins/jqvmap/jqvmap.min.css"> -->
	<!-- Theme style -->
	<link rel="stylesheet" href="componentes_originales/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="componentes_originales/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="componentes_originales/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="componentes_originales/plugins/summernote/summernote-bs4.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="componentes_originales/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="componentes_originales/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="componentes_originales/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="componentes_originales/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="componentes_originales/plugins/toastr/toastr.min.css">
	<!-- fullCalendar -->
	<link rel="stylesheet" href="componentes_originales/plugins/fullcalendar/main.css">

	<!-- jQuery -->
	<script src="componentes_originales/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="componentes_originales/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="componentes_originales/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="componentes_originales/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="componentes_originales/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<!-- <script src="componentes_originales/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="componentes_originales/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
	<!-- jQuery Knob Chart -->
	<script src="componentes_originales/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="componentes_originales/plugins/moment/moment.min.js"></script>
	<script src="componentes_originales/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="componentes_originales/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="componentes_originales/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="componentes_originales/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="componentes_originales/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- <script src="componentes_originales/dist/js/demo.js"></script> -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!-- <script src="componentes_originales/dist/js/pages/dashboard.js"></script> -->

	<!-- DataTables  & Plugins -->
	<script src="componentes_originales/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="componentes_originales/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="componentes_originales/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="componentes_originales/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="componentes_originales/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="componentes_originales/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="componentes_originales/plugins/jszip/jszip.min.js"></script>
	<script src="componentes_originales/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="componentes_originales/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="componentes_originales/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="componentes_originales/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="componentes_originales/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

	<!-- bs-custom-file-input -->
	<script src="componentes_originales/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<!-- jquery-validation -->
	<script src="componentes_originales/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="componentes_originales/plugins/jquery-validation/additional-methods.min.js"></script>

	<!-- InputMask -->
	<script src="componentes_originales/plugins/inputmask/jquery.inputmask.min.js"></script>

	<!-- Selects automaticos -->
	<script src="componentes_mios/select_auto.js"></script>

	<!-- SweetAlert2 -->
	<script src="componentes_originales/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Toastr -->
	<script src="componentes_originales/plugins/toastr/toastr.min.js"></script>
	<!-- Bootstrap Switch -->
	<script src="componentes_originales/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

	<!-- fullCalendar 2.2.5 -->
	<script src="componentes_originales/plugins/fullcalendar/main.js"></script>
	<script src="componentes_originales/plugins/fullcalendar/locales-all.js"></script>

	<!-- FontAwenson -->
	<script src="componentes_originales/plugins/fontawesome-free/js/all.min.js"></script>
	<script src="componentes_originales/plugins/fontawesome-free/js/brands.min.js"></script>
	<script src="componentes_originales/plugins/fontawesome-free/js/fontawesome.min.js"></script>
	<script src="componentes_originales/plugins/fontawesome-free/js/solid.min.js"></script>
	<script src="https://kit.fontawesome.com/4a9579d087.js" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	<div class="wrapper">

		<!-- Preloader -->
		<!-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="componentes_originales/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div> -->

	 

		<?php 

		include_once("menu/valida_menu.php");

		include_once("contenidos.php");

		include_once("footer.php");

		?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->


	
</body>
</html>
