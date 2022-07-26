    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="componentes_originales/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">CDTsystem</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="componentes_mios/bancodeimagenes/user.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $_SESSION['sesion_nombre']; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="?type=" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="?type=registro_add" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Registrar persona
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="?type=registro_view" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Listado de personas
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="?type=registro_search" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>Buscar persona</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="?type=estaciones_view" class="nav-link">
                            <i class="nav-icon fas fa-flag"></i>
                            <p>Estaciones de atención</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-pdf"></i>
                            <p>Listado PDF</p>
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="reportes/reporte_todos_excel.php" target="_blank" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Todos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reportes/reporte_estaciones_excel.php" target="_blank" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Estaciones</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="reportes/reporte_cruz_roja.php" target="_blank" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Listado cruz roja</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                    <li class="nav-item">
                        <a href="index.php?out=true" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Cerrar sesión
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

<?php 
/*if ($nivel_acceso <= $_SESSION['usu_nivel_usuario']){
    header ("Location: $redir?error_login=5");
    exit;
}*/
?>
