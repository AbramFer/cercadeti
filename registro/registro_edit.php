<?php 

	$pag=$_SERVER['PHP_SELF'];
    $type = $_GET['type'];
    $pag = $pag."?type=".$type."&id_miembro=".$_GET['id_miembro'];

    if (isset($_GET['id_miembro'])) {
    	$id_miembro = $_GET['id_miembro'];

    	$gett = "SELECT * FROM miembros WHERE id_miembro=$id_miembro";
    	$query = mysqli_query($conexion, $gett);
    	$row = mysqli_fetch_assoc($query);

    	$row_fecha_nacimiento = $row['fecha_nacimiento'];
		$row_fn = explode("-", $row_fecha_nacimiento);
		$row_fecha_nacimiento = $row_fn[2]."-".$row_fn[1]."-".$row_fn[0]; 
		$row_sexo = $row['sexo'];
		$row_telefono = $row['telefono'];
		$row_peso = $row['peso'];
		$row_estatura = $row['estatura'];
		$row_direccion = strtoupper($row['direccion']);
		$row_codigo = $row['codigo'];
		$row_nombres = strtoupper($row['nombres']);
		$row_apellidos = strtoupper($row['apellidos']);
		$row_cedula = $row['cedula'];

    }

    if (isset($_POST["enviar"])) {
    	$id_miembro = $_GET["id_miembro"];
		$cedula = $_POST['cedula'];
		$nombres = strtoupper($_POST['nombres']);
		$apellidos = strtoupper($_POST['apellidos']);


		$fecha_nacimiento = $_POST['fecha_nacimiento'];
		$fn = explode("-", $fecha_nacimiento);
		$fecha_nacimiento = $fn[2]."-".$fn[1]."-".$fn[0]; 
		$sexo = $_POST['sexo'];
		$telefono = $_POST['telefono'];
		$peso = $_POST['peso'];
		$estatura = $_POST['estatura'];
		$direccion = strtoupper($_POST['direccion']);

		
		$sql = "UPDATE miembros SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', fecha_nacimiento='$fecha_nacimiento', sexo='$sexo', telefono='$telefono', peso='$peso', estatura='$estatura', direccion='$direccion' WHERE id_miembro=$id_miembro";
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
						<h1>Personas</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?type=">Home</a></li>
							<li class="breadcrumb-item active">Editar datos</li>
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
										Datos actualizados correctamente.
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center">
								<div class="card-body col-md-6">
									<div class="alert alert-warning">
										<h5><i class="icon fas fa-check"></i> Código de: <?php echo $nombres." ".$apellidos ?> <b><?php echo $row_codigo ?></b></h5>
										
									</div>
								</div>
							</div>

							<div class="card-footer">
								<a class="btn btn-primary" href="?type=registro_add">Agregar otra persona</a>
							</div>
							<!-- /.card-body -->
						</div>
						<?php } else { ?>

						<!-- general form elements -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Editar datos de la persona</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form action="<?php echo $pag; ?>" method="POST" id="formulario_registro">
								<div class="card-body">
									
									<!-- Primera fila -->
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label for="cedula">Cédula <i class="text-danger">*</i></label>
												<input onkeypress="return check(event)" tabindex="1" autofocus autocomplete="off" type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese cédula" required value="<?php echo $row_cedula ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombres">Nombres <i class="text-danger">*</i></label>
												<input tabindex="2" autofocus autocomplete="off" type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombre" required style="text-transform: uppercase;" value="<?php echo $row_nombres ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="apellidos">Apellidos <i class="text-danger">*</i></label>
												<input tabindex="3" autocomplete="off" type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese apellidos del miembro" required style="text-transform: uppercase;" value="<?php echo $row_apellidos ?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Fecha de nacimiento <i class="text-danger">*</i></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input tabindex="4" autocomplete="off" type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask value="<?php echo $row_fecha_nacimiento ?>">
													</div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="sexo">Sexo</label>
												<select tabindex="5" class='selectpicker show-tick form-control' id="sexo" name="sexo" fake="<?php echo $row_sexo ?>">
													<option value="">Seleccione una opción</option>
													<option value="M">Masculino</option>
													<option value="F">Femenino</option>
												</select>
											</div>
										</div>
									</div>
									<!-- fin de la primera fila -->

									<!-- segunda fila -->
									<div class="row">
										
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="telefono">Teléfono</label>
												<input tabindex="6" autocomplete="off" type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" data-inputmask='"mask": "(9999) 999-9999"' data-mask value="<?php echo $row_telefono ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="peso">Peso</label>
												<input onkeypress="solo_numeros();" tabindex="8" autocomplete="off" type="text" class="form-control" id="peso" name="peso" placeholder="Ingrese su peso en Kg" value="<?php echo $row_peso ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="estatura">Estatura</label>
												<input tabindex="9" autocomplete="off" type="text" class="form-control" id="estatura" name="estatura" placeholder="Ingrese su estatura en CM" value="<?php echo $row_estatura ?>" onkeypress="solo_numeros();">
											</div>
										</div>
									</div>
									<!-- fin de la segunda fila -->

									<!-- tercera fila -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="direccion">Dirección</label>
												<input tabindex="10" autocomplete="off" type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección" style="text-transform: uppercase;" value="<?php echo $row_direccion ?>">
											</div>
										</div>
									</div>
									<!-- fin de la tercera fila -->
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
		$('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
		$('[data-mask]').inputmask();

		$('#formulario_registro').validate({
			rules: {
				nombres: {
					required: true,
					minlength: 3
				},
				apellidos: {
					required: true,
					minlength: 3
				},
				fecha_nacimiento: {
					required: true,
				},
				peso: {
					maxlength: 3
				},
				estatura: {
					maxlength: 3
				}
			},
			messages: {
				nombres: {
					required: "Este campo es obligatorio",
					minlength: "Este campo debe contener más de 3 caracteres"
				},
				apellidos: {
					required: "Este campo es obligatorio",
					minlength: "Este campo debe contener más de 3 caracteres"
				},
				fecha_nacimiento: {
					required: "Este campo es obligatorio"
				},
				direccion: {
					minlength: "Este campo debe contener más de 3 caracteres"
				},
				peso: {
					maxlength: "Este campo debe contener máximo 3 caracteres"
				},
				estatura: {
					maxlength: "Este campo debe contener máximo 3 caracteres"
				}
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