<?php 

	$sql = "SELECT * FROM estaciones ORDER BY id_estaciones ASC";
	$query = mysqli_query($conexion, $sql);

	function cupos_disponible($id, $conexion){
		$sql = "SELECT * FROM inscripcion_estaciones WHERE id_estaciones=$id";
		$query = mysqli_query($conexion, $sql);
		return mysqli_num_rows($query);
	}

?>

<title>Listado de estaciones</title>
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
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Estaciones</li>
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
								<h3 class="card-title">Listado de estaciones</h3>
								<div class="card-tools">
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-133" aria-expanded="false">
										<i class="fas fa-bars"></i> Menú
										</button>
										<div class="dropdown-menu" role="menu" style="">
											<a href="?type=estaciones_add" class="dropdown-item">Agregar una estación</a>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Estaciones</th>
											<th>Cupos</th>
											<th>Cupos disponibles</th>
											<th>Cupos por voluntario</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$fila = 0;
										$num = 1;
										while($row = mysqli_fetch_assoc($query)) {
											$id = $row["id_estaciones"];
											$nombre = $row["nombre"];
											$cupos = $row["cupos"];
											$cupos_vol = $row["cupos_vol"];
											$total_ocupados = cupos_disponible($id, $conexion);
											$total_restante = $cupos - $total_ocupados;
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $nombre; ?></td>
											<td><?php echo $cupos; ?></td>
											<td><?php echo $total_restante; ?></td>
											<td><?php echo $cupos_vol; ?></td>
											<td class="text-center">
												<a class="btn btn-info btn-sm" href="?type=estaciones_edit&id_estaciones=<?php echo $id ?>">
												  <i class="fas fa-pencil-alt"></i>
												</a>
												<a class="btn btn-danger btn-sm" href="#" onclick="eliminar(<?php echo $id ?>, <?php echo $fila ?>)">
													<i class="fas fa-trash"></i>
												</a>
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