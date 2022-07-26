<?php 

	if ($_SESSION['sesion_nivel']!=1) {
		$rango = explode("-", $_SESSION['sesion_rango']);

		$length = 4; 
		$min_rango = substr(str_repeat(0, $length).$rango[0], - $length); 
		$max_rango = substr(str_repeat(0, $length).$rango[1], - $length); 

		$sql = "SELECT * FROM miembros WHERE codigo BETWEEN 'A".$min_rango."' AND 'A".$max_rango."' ORDER BY codigo ASC";
	} else {
		$sql = "SELECT * FROM miembros ORDER BY codigo ASC";
		$extra = true;
	}
		$query = mysqli_query($conexion, $sql);

?>

<title>Listado de personas</title>
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
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Listado</li>
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
								<h3 class="card-title">Listado de personas</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Código</th>
											<th>Cédula</th>
											<th>Nombres y apellidos</th>
											<th>Edad</th>
											<th>Sexo</th>
											<th>Télefono</th>
											<th>Peso</th>
											<th>Estatura</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$fila = 0;
										$num = 1;
										while($row = mysqli_fetch_assoc($query)) {
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
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $codigo; ?></td>
											<td><?php echo $cedula; ?></td>
											<td><?php echo $nombre;  ?> </td>
											<td><?php echo $edad." Años";  ?> </td>
											<td><?php echo se($sexo);  ?> </td>
											<td><?php echo $telefono;  ?> </td>
											<td><?php echo $peso." kg";  ?> </td>
											<td><?php echo $estatura." cm";  ?> </td>
											<td class="text-center">
												<a class="btn btn-info btn-sm" href="?type=registro_edit&id_miembro=<?php echo $row['id_miembro'] ?>">
												  <i class="fas fa-pencil-alt"></i>
												</a>
												<a class="btn btn-danger btn-sm" href="#" onclick="eliminar(<?php echo $row["id_miembro"] ?>, <?php echo $fila ?>)">
													<i class="fas fa-trash"></i>
												</a>
												<?php if ($extra): ?>
												<a class="btn btn-warning btn-sm" href="?type=registro_estaciones_extra&id_miembro=<?php echo $row['id_miembro'] ?>">
													<i class="fas fa-plus"></i>
												</a>
												<?php endif ?>
											</td>
										</tr>
										<?php 
										$fila++;
										$num++;
										}
										?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
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

	

<script>
	$("#example1").DataTable({
		"responsive": true,
		"lengthChange": false,
		"autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
		"language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado - Lo sentimos",
            "info": "Mostrando _PAGE_ de _PAGES_ páginas",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "search":"Busqueda:", 
            "paginate": {
                "first":      "Primera",
                "last":       "Ultima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
       	}
	}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		
	function eliminar(id_miembro, fila) {
		Swal.fire({
			title: '¿Seguro qué deseas eliminar este registro?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Sí',
			denyButtonText: `No`,
		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				$.ajax({
			        url: "registro/registro_delete.php?id_miembro="+id_miembro,
			        type: 'GET',
			        data: '',
			        success: function(data) {
			        	var data2 = data.trim();
			    		//console.log(data2);
			            if (data2=="eliminado") {
			            	var table = $('#example1').DataTable();
							table.row(fila).remove().draw();

							Swal.fire({
								title: 'Eliminado correctamente!', 
								text: '',
								icon: 'success',
								timer: 2000
							});
							location.reload();
			            } else {
			            	var Toast = Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000
							});
							Toast.fire({
								icon: 'error',
								title: 'Este correo ya esta en uso.'
							});
			            }
			        } //FIN DEL SUCCES AJAX
			    }); //FIN AJAX
			} else if (result.isDenied) {
				Swal.fire('No se realizo ninguna acción', '', 'info')
			}
		})
	}


</script>