<?php

  $idcv = $dataCreate['id_curriculum'] ?? 0;
  // print_r(["result" =>$idcv]);
?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <span class="brand-text font-weight-light mx-3">InnovamosContigo</span>
        <!-- <a href="logout" class="text-danger">Cerrar sesión</a> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 d-flex align-items-center">
      <!-- Brand Logo -->
      <!-- <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">InnovamosContigo</span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!-- <li class="nav-header">EXAMPLES</li> -->
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/start'; ?>" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Start
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/profile' . '?idcv=' . $idcv; ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Personal information
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/works' . '?idcv=' . $idcv; ?>" class="nav-link">
                <i class="nav-icon far fa-building"></i>
                <p>
                  Work experience
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/vocations' . '?idcv=' . $idcv; ?>" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  Vocational training
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/aptitudes' . '?idcv=' . $idcv;?>" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>
                  Aptitudes
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL') . 'create/final' . '?idcv=' . $idcv   ; ?>" class="nav-link">
                <i class="nav-icon fab fa-font-awesome"></i>
                <p>
                  Final
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>