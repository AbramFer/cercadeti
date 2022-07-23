<?php 

	$pag=$_SERVER['PHP_SELF'];
    $type = $_GET['type'];
    $pag = $pag."?type=".$type;

    if (isset($_POST["enviar"])) {
		$nombre = $_POST['nombre'];
		$cupos = $_POST['cupos'];
		$cantidad_x_voluntario = $cupos / 10;

		$sql = "INSERT INTO estaciones VALUES (NULL, '$nombre', '$cupos','$cantidad_x_voluntario')";
		$qr = mysqli_query($conexion, $sql);
		if ($qr) {
			$error = "bien";
		} else {
			$error = "mal";
		}
    }

 ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Estaciones</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?type=">Home</a></li>
							<li class="breadcrumb-item active">Ingresar datos</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">

						<?php if (isset($_POST['enviar']) && $error=="bien") { ?>
							<!-- se agrega -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Resultado</h3>
							</div>
							<!-- /.card-header -->
							<div class="row justify-content-md-center">
								<div class="card-body col-md-6">
									<div class="alert alert-success">
										<h5><i class="icon fas fa-check"></i> Genial!</h5>
										Estación agregada correctamente.
									</div>
								</div>
							</div>
							<div class="card-footer">
								<a class="btn btn-primary" href="?type=estaciones_add">Agregar otra estación</a>
							</div>
							<!-- /.card-body -->
						</div>
						<?php } else { ?>

						<!-- general form elements -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Agregar datos de la estación</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form action="<?php echo $pag; ?>" method="POST" id="formulario_registro">
								<div class="card-body">
									<!-- segunda fila -->
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombre">Nombre de la estación</label>
												<input tabindex="1" autocomplete="off" type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre de la estación">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="cupos">Cupos disponibles</label>
												<input tabindex="2" autocomplete="off" type="text" class="form-control" id="cupos" name="cupos" placeholder="Ingrese cantidad de cupos">
											</div>
										</div>
									</div>
									<!-- fin de la segunda fila -->
								</div>
								<!-- /.card-body -->

								<div class="card-footer">
									<button tabindex="10" type="submit" class="btn btn-primary" name="enviar">Guardar</button>
								</div>
							</form>
						</div>
						<!-- /.card -->

						<?php } ?>

					</div>
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->


	<script>
		
		$('#formulario_registro').validate({
			rules: {
				nombre: {
					required: true,
					minlength: 3
				},
				cupos: {
					required: true,
					maxlength: 4
				},
			},
			messages: {
				nombre: {
					required: "Este campo es obligatorio",
					minlength: "Este campo debe contener más de 3 caracteres"
				},
				cupos: {
					required: "Este campo es obligatorio",
					maxlength: "Este campo debe contener un máximo de 4 caracteres"
				},
			},
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
				$(element).addClass('is-valid');
			}
		});

		$(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }

                if(event.keyCode == 116) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        function solo_numeros() {
			if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
		}

		function check(e) {
		    tecla = (document.all) ? e.keyCode : e.which;

		    //Tecla de retroceso para borrar, siempre la permite
		    if (tecla == 8) {
		        return true;
		    }

		    // Patrón de entrada, en este caso solo acepta numeros y letras
		    patron = /[0-9-]/;
		    tecla_final = String.fromCharCode(tecla);
		    return patron.test(tecla_final);
		}
	</script>
