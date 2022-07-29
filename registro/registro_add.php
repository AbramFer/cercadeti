<?php 
echo "rangooooooooooooooooooooooooo ".$_SESSION['sesion_rango'];

	if (!cupos($conexion)) {
		echo "<script>alert('Te has quedado sin cupos');
			location.href='index2.php';
		</script>";
	}

	$pag=$_SERVER['PHP_SELF'];
    $type = $_GET['type'];
    $pag = $pag."?type=".$type;

    if (isset($_POST["enviar"])) {
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

		$sql = "INSERT INTO miembros VALUES (NULL, NULL, '$cedula', '$nombres', '$apellidos', '$fecha_nacimiento', '$sexo', '$telefono', '$peso', '$estatura', '$direccion')";
		$qr = mysqli_query($conexion, $sql);
		//1062
		//echo mysqli_errno($conexion);
		if ($qr) {
			$error = "bien";

			$id = mysqli_insert_id($conexion);


			if ($_SESSION['sesion_nivel']<3) {
				$rango = explode("-", $_SESSION['sesion_rango']);

				$length = 4; 
				$min_rango = substr(str_repeat(0, $length).$rango[0], - $length);
				$max_rango = substr(str_repeat(0, $length).$rango[1], - $length);

				$s_cod = "SELECT codigo FROM miembros WHERE codigo BETWEEN 'A".$min_rango."' AND 'A".$max_rango."'";
				$q_cod = mysqli_query($conexion, $s_cod);

				$testArray = array();
				while ($row = mysqli_fetch_assoc($q_cod)) {
					$codigo = substr($row["codigo"], -4);

					$testArray [] = ltrim($codigo,"0");

				}
				$arrayRange = range($rango[0],$rango[1]);
				$missingValues = array_diff($arrayRange,$testArray);
				if ($missingValues!=null) {
			    	$missingValues = array_values($missingValues);
					$number = $missingValues[0];
					
					$length = 4; 
					$string = substr(str_repeat(0, $length).$number, - $length); 

					$update = "UPDATE miembros SET codigo='A".$string."' WHERE id_miembro=$id";
					mysqli_query($conexion, $update);

					$longitud = count($_POST['estaciones']);
					//id del voluntario
					$id_vol = $_SESSION['sesion_id_usuario'];
		            //Recorro todos los elementos
		            for($i=0; $i<$longitud; $i++){
		                $id_estacion = $_POST['estaciones'][$i];

		                $sql_name = "SELECT nombre FROM estaciones WHERE id_estaciones=$id_estacion";
		                $query_name = mysqli_query($conexion, $sql_name);
		                $row_name = mysqli_fetch_assoc($query_name);
		                $name_estacion = $row_name["nombre"];
		                $estaciones_asignadas = $estaciones_asignadas." - ".$name_estacion." <br>";

		                $update = "INSERT INTO inscripcion_estaciones VALUES (NULL, '$id_estacion', '$id', $id_vol)";
						mysqli_query($conexion, $update);
		            }
				}

			}
		} else {
			$error = "mal";
		}

    }




    function cupos($conexion){
    	/*if ($_SESSION['sesion_nivel']<3) {
			$rango = explode("-", $_SESSION['sesion_rango']);

			$length = 4; 
			$min_rango = substr(str_repeat(0, $length).$rango[0], - $length);
			$max_rango = substr(str_repeat(0, $length).$rango[1], - $length);

			$s_cod = "SELECT codigo FROM miembros WHERE codigo BETWEEN 'A".$min_rango."' AND 'A".$max_rango."'";
			$q_cod = mysqli_query($conexion, $s_cod);

			$testArray = array();
			while ($row = mysqli_fetch_assoc($q_cod)) {
				$codigo = substr($row["codigo"], -4);

				$testArray [] = ltrim($codigo,"0");

			}
			$arrayRange = range($rango[0],$rango[1]);
			$missingValues = array_diff($arrayRange,$testArray);
			if ($missingValues!=null) {
		    	return true;
			} else {
				return false;
			}
		} else {
			return true;
		}*/

		return true;
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
										Persona agregada correctamente.
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center">
								<div class="card-body col-md-6">
									<div class="alert alert-warning">
										<h5><i class="icon fas fa-check"></i> Código de: <?php echo $nombres." ".$apellidos ?> <b><?php echo "A".$string ?></b></h5>

										<h3>Estaciones inscritas: </br> <?php echo $estaciones_asignadas ?></h3>
										
									</div>
								</div>
							</div>

							<div class="card-footer">
								<a class="btn btn-primary" href="?type=registro_add">Agregar otra persona</a>
							</div>
							<!-- /.card-body -->
						</div>
						<?php } else if (isset($_POST['enviar']) && $error=="mal") { ?>
							<!-- se agrega -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Resultado</h3>
							</div>
							<!-- /.card-header -->
							<div class="row justify-content-md-center">
								<div class="card-body col-md-6">
									<div class="alert alert-danger">
										<h5><i class="icon fas fa-check"></i> Error!</h5>
										Persona no agregada, posible duplicado de cédula
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
								<h3 class="card-title">Agregar datos de la persona</h3>
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
												<input onkeypress="return check(event)" tabindex="1" autofocus autocomplete="off" type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese cédula" required >
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombres">Nombres <i class="text-danger">*</i></label>
												<input tabindex="2" autofocus autocomplete="off" type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombre" required style="text-transform: uppercase;">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="apellidos">Apellidos <i class="text-danger">*</i></label>
												<input tabindex="3" autocomplete="off" type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese apellidos del miembro" required style="text-transform: uppercase;">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Fecha de nacimiento <i class="text-danger">*</i></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input tabindex="4" autocomplete="off" type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
													</div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="sexo">Sexo</label>
												<select tabindex="5" class='selectpicker show-tick form-control' id="sexo" name="sexo">
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
												<input tabindex="6" autocomplete="off" type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="peso">Peso</label>
												<input onkeypress="solo_numeros();" tabindex="8" autocomplete="off" type="text" class="form-control" id="peso" name="peso" placeholder="Ingrese su peso en Kg">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="estatura">Estatura</label>
												<input onkeypress="solo_numeros();" tabindex="9" autocomplete="off" type="text" class="form-control" id="estatura" name="estatura" placeholder="Ingrese su estatura en CM">
											</div>
										</div>
									</div>
									<!-- fin de la segunda fila -->

									<!-- tercera fila -->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="direccion">Dirección</label>
												<input tabindex="10" autocomplete="off" type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección" style="text-transform: uppercase;">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="estaciones">Seleccion las estaciones:</label>
												<?php 
												$tabindex = 11;
                                            	$sql_alterna = mysqli_query($conexion, "SELECT * FROM estaciones");
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
									<!-- fin de la tercera fila -->
								</div>
								<!-- /.card-body -->

								<div class="card-footer">
									<button tabindex="<?php echo $tabindex ?>" type="submit" class="btn btn-primary" name="enviar">Guardar</button>
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
                /*if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }*/

                /*if(event.keyCode == 116) {
                    event.preventDefault();
                    return false;
                }*/
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
	            		}
		                $(element).html(obj[i]);
	            	}
	            }
	        );
	    }
	</script>
