<?php 
	include 'conexion/aut_config.inc.php';

	if (isset($_GET['out'])) {
		session_name($usuarios_sesion);
	    session_start();
	    session_unset();
	    session_destroy();
	    die(header ("Location:  index.php?error_login=7"));
	    exit;
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Página oficial del cerca de ti de la Misión Venezolana de Portuguesa (MVP)" />
    <meta name="keywords" content="SISTEMA MVP, MVP, cercadeti MVP" />
    <meta name="author" content="Abraham Fernandez" />
	<title>Gestión Cerca de ti MPV</title>

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
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="componentes_originales/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="componentes_originales/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<!-- /.login-logo -->
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="#" class="h1"><b>CDT</b>system</a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Inicio de sesión</p>

			<form action="index2.php" method="POST">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Usuario" name="user" autocomplete="off" style="text-transform: uppercase;">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" placeholder="Contraseña" name="pass">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						
									<?php 
										// Mostrar error de Autentificaci�n.
										include ("mensajes_error.php");
										if (isset($_GET['error_login'])){
												$error=$_GET['error_login']; ?>
											<div class="alert alert-danger alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<?php 
															echo $error_login_ms[$error];
													?>
											</div>
										<?php } ?>
					</div>
							</div>
				<div class="row">
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Iniciar</button>
					</div>
					<!-- /.col -->
				</div>

			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="componentes_originales/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="componentes_originales/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="componentes_originales/dist/js/adminlte.min.js"></script>

<!-- FontAwenson -->
<script src="componentes_originales/plugins/fontawesome-free/js/all.min.js"></script>
<script src="componentes_originales/plugins/fontawesome-free/js/brands.min.js"></script>
<script src="componentes_originales/plugins/fontawesome-free/js/fontawesome.min.js"></script>
<script src="componentes_originales/plugins/fontawesome-free/js/solid.min.js"></script>
<script src="https://kit.fontawesome.com/4a9579d087.js" crossorigin="anonymous"></script>
</body>
</html>
