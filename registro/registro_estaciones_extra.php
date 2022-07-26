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
		$longitud = count($_POST['estaciones']);
		//id del voluntario
		$id_vol = $_SESSION['sesion_id_usuario'];
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++){
            $id_estacion = $_POST['estaciones'][$i];
            $update = "INSERT INTO inscripcion_estaciones VALUES (NULL, '$id_estacion', '$id_miembro', $id_vol)";
			$qr = mysqli_query($conexion, $update);
        }
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
												<input disabled onkeypress="return check(event)" tabindex="1" autofocus autocomplete="off" type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese cédula" required value="<?php echo $row_cedula ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombres">Nombres <i class="text-danger">*</i></label>
												<input disabled tabindex="2" autofocus autocomplete="off" type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombre" required style="text-transform: uppercase;" value="<?php echo $row_nombres ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="apellidos">Apellidos <i class="text-danger">*</i></label>
												<input disabled tabindex="3" autocomplete="off" type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese apellidos del miembro" required style="text-transform: uppercase;" value="<?php echo $row_apellidos ?>">
											</div>
										</div>
									</div>
									<!-- fin de la primera fila -->

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="estaciones">Seleccion las estaciones:</label>
												<?php 
												$tabindex = 4;
                                            	$sql_alterna = mysqli_query($conexion, "SELECT * FROM estaciones WHERE estaciones.id_estaciones NOT IN (SELECT inscripcion_estaciones.id_estaciones FROM inscripcion_estaciones WHERE inscripcion_estaciones.id_estaciones=estaciones.id_estaciones AND inscripcion_estaciones.id_miembro=$id_miembro)");
                                        		while ($row_alterna = mysqli_fetch_assoc($sql_alterna)) { ?>
												<div class="checkbox">
		                                            <label>
		                                                <input <?php if ($row_alterna['id_estaciones']==1) echo "checked='true'";  ?>  tabindex="<?php echo $tabindex ?>" id="estaciones_<?php echo $row_alterna['id_estaciones'] ?>" type="checkbox" name="estaciones[]" value="<?php echo $row_alterna['id_estaciones'] ?>"> <?php echo $row_alterna['nombre'] ?>
		                                            </label> - <label id="cup_<?php echo $row_alterna['id_estaciones'] ?>"></label>
		                                        </div>
				                                    <?php 
				                                    $tabindex++;
		                                		} ?>
		                            		</div>
										</div>

									</div>

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

		window.setInterval(function () {
	        update();
	    }, 1000);

	    function update() {
	        updatecupos();
	    }

	    function updatecupos() {
	        jQuery.get(
	            'obtener_cupos.php?opcion=1',
	            function (data) {
	            	//console.log(data);
	            	const obj = JSON.parse(data);

	            	for (var i = 0; i < obj.length; i++) {
	            		var aux = i + 1;
	            		var element = "#cup_"+aux;
	            		var element2 = "#estaciones_"+aux;
	            		if (obj[i]<1) {

	            			// document.getElementById(element).disabled = true;
	            			$(element2).attr('disabled', true);
	            			$(element2).prop('disabled', true);
	            		} else {
	            			$(element2).attr('disabled', false);
	            			$(element2).prop('disabled', false);
	            		}
		                $(element).html(obj[i]);
	            	}
	            }
	        );
	    }
	</script>