<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content Personas atendidas -->
	<section class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Personas atendidas</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active"><a href="#">Home</a></li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		<div class="container-fluid">

		<!-- Small boxes (Stat box) -->
		<!-- Main row -->
			<div class="row">
				<div class="col-lg-4 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3 id="hombres">0</h3>
							<p>Hombres</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-person"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-4 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3 id="mujeres">0</h3>
							<p>Mujeres</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-person-dress"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-4 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3 id="total">0</h3>
							<p>Total</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-user"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->
			</div>
	
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

	<!-- Main content  Cupos disponibles--> 
	<section class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Cupos disponibles por estación</h1>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		<div class="container-fluid">

		<!-- Small boxes (Stat box) -->
		<!-- Main row -->
			<div class="row">
				<div class="col-lg-2 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3 id="medicina">0</h3>
							<p>Medicina General</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-1 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3 id="masajes">0</h3>
							<p>Masajes</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-2 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3 id="vacunacion">0</h3>
							<p>Vacunación</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-2 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3 id="asesoria">0</h3>
							<p>Asesoria legal</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-1 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3 id="psicologia">0</h3>
							<p>Psicología</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-2 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3 id="megaropero">0</h3>
							<p>Mega ropero</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->				

				<div class="col-lg-1 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3 id="peluqueria">0</h3>
							<p>Peluqueria</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-1 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3 id="barberia">0</h3>
							<p>Barberia</p>
						</div>
						<div class="icon">
							<i class="fa-solid fa-flag"></i>
						</div>
					</div>
				</div>
				<!-- ./col -->				
			</div>
	
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->




<script>

	window.setInterval(function () {
        update();
    }, 1000);

    function update() {
        updateatencion("#hombres", "m");
        updateatencion("#mujeres", "f");
        updateatencion("#total", "total");
		updatecupos("#medicina", 1);
		updatecupos("#masajes", 2);
		updatecupos("#vacunacion", 3);
		updatecupos("#asesoria", 4);
		updatecupos("#psicologia", 5);
		updatecupos("#megaropero", 6);
		updatecupos("#peluqueria", 7);
		updatecupos("#barberia", 8);
    }

    function updateatencion(elemento, buscar) {
        jQuery.get(
            'obtener_personas.php?variable='+buscar,
            function (data) {
                $(elemento).text(data);
            }
        );
    }

    function updatecupos(elemento, buscar) {
        jQuery.get(
            'obtener_cupos.php?opcion=2&variable='+buscar,
            function (data) {
                $(elemento).text(data);
            }
        );
    }

</script>