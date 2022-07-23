<?php 

	if (isset($_POST['enviar'])) {
		$codigo = $_POST['codigo'];

		$SQL = "SELECT * FROM miembros WHERE miembros.codigo='$codigo'";
        $result = mysqli_query($conexion, $SQL);

        $num = mysqli_num_rows($result);

        if($num>0){
            $row = mysqli_fetch_assoc($result);

        	$id = $row["id_miembro"];
        	$codigo = $row["codigo"];
        	$cedula = $row["cedula"];
        	$nombre = $row["nombres"]. " " .$row["apellidos"];
			$fecha_nacimiento = $row["fecha_nacimiento"];
			$sexo = $row["sexo"];
			$telefono = $row["telefono"];
			$peso = $row["peso"];
			$estatura = $row["estatura"];
			$edad = CalculaEdad2($fecha_nacimiento);
            
            $error = "bien";
        } else {
            $error = "mal";
        }

	}

	$pag=$_SERVER['PHP_SELF'];
    $type = $_GET['type'];
    $pag = $pag."?type=".$type;
?>

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Buscar persona</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?type=">Home</a></li>
							<li class="breadcrumb-item active">Buscar persona</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Código Persona</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<form method="POST" action="<?php echo $pag; ?>" id="formulario_miembros">
									<div class="row col-md-6 offset-md-4">
										<div class="col-md-6">
											<div class="form-group">
												<label>Código</label>
												<input autocomplete="off" type="text" class="form-control" placeholder="Ingrese código a consultar" name="codigo" id="codigo" required>
											</div>
										</div>
									</div>
									<div class="col-md-1 offset-md-5">
										<div class="col-md-1">
			                                <div class="form-group">
			                                    <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
			                                </div>
										</div>
                        			</div>
				                </form>
							</div>
							<!-- /.card-body -->



						</div>
						<!-- /.card -->

						<?php 
							if (isset($_POST["enviar"]) && $error=="bien") { ?>
						<!-- si se encuentra -->
						<div class="card card-success">
							<div class="card-header">
								<h3 class="card-title">Código persona (Paso 2/2)</h3>
							</div>
							<!-- /.card-header -->

							<div class="card-body">
								<form action="<?php echo $pag; ?>" method="POST" id="formulario_miembros_2">
			                        <table id="tabla" class="table table-striped table-bordered">
			                            <thead>
			                                <tr role="row">
												<th>ID</th>
												<th>Código</th>
												<th>Cédula</th>
												<th>Nombres y apellidos</th>
												<th>Edad</th>
												<th>Sexo</th>
												<th>Télefono</th>
												<th>Peso</th>
												<th>Estatura</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr>
			                                    <td><?php echo $id; ?></td>
			                                    <td><?php echo $codigo; ?></td>
			                                    <td><?php echo $cedula; ?></td>
												<td><?php echo $nombre;  ?> </td>
												<td><?php echo $edad." Años";  ?> </td>
												<td><?php echo se($sexo);  ?> </td>
												<td><?php echo $telefono;  ?> </td>
												<td><?php echo $peso." kg";  ?> </td>
												<td><?php echo $estatura." cm";  ?> </td>
			                                </tr>
			                            </tbody>
			                        </table>
                    			</form>
							</div>
							<!-- /.card-body -->
						</div>
						<?php 
							} else if (isset($_POST["enviar"]) && $error=="mal") { ?>

						<div class="card card-danger">
							<div class="card-header">
								<h3 class="card-title">Código persona (Paso 2/2)</h3>
							</div>
							<!-- /.card-header -->

							<div class="card-body">
								<div class="alert alert-danger alert-dismissible">
									<h5><i class="icon fas fa-check"></i> Ocurrio un problema!</h5>
									Persona no encontrada, dirijase a la mesa de registro.
								</div>
							</div>
							<!-- /.card-body -->
						</div>

						<?php 
							} 
						?>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->


	<!-- jquery-validation -->
<script src="componentes_originales/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="componentes_originales/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
	$.validator.setDefaults({
		
	});
	$('#formulario_miembros').validate({
		rules: {
			nacionalidad: {
				required: true
			},
			cedula: {
				required: true,
				minlength: 6
			},
		},
		messages: {
			nacionalidad: {
				required: "Seleccione una nacionalidad",
			},
			cedula: {
				required: "Ingrese la cedula de identidad",
				minlength: "La cedula debe contener más de 5 caracteres"
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

	$('#formulario_miembros_2').validate({
		rules: {
			tipo_miembro: {
				required: true
			}
		},
		messages: {
			tipo_miembro: {
				required: "Seleccione un tipo de miembro",
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
	

</script>
