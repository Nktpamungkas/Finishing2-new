<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="adminlte/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link href="adminlte/img/logo.png" rel="icon">
    <link href="adminlte/img/logo.png" rel="apple-touch-icon">
    
</head>
<body class="sidebar-mini layout-fixed sidebar-closed sidebar-collapse">
<div class="wrapper">

    <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="adminlte/dist/img/logo.png" alt="indotaichen" height="60" width="60">
    </div> -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="http://10.0.0.10/laporan/" class="brand-link">
        <img src="adminlte/dist/img/logo.png" alt="Laporan Dept" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LAPORAN DEPT</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">PPC</li>
                    <li class="nav-item">
                        <a href="ppc_filter.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>PPC - Memo Penting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ppc_filter_order_perminggu.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>PPC - LAPORAN ORDER</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">FINISHING</li>
                    <li class="nav-item">
                        <a href="fin_filter.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>FIN - Laporan Harian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="fin_filter_cetaklebel.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>FIN - Cetak Label</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">BRUSHING</li>
                    <li class="nav-item">
                        <a href="brs_filter.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>BRS - Laporan Harian</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">PRINTING</li>
                    <li class="nav-item">
                        <a href="prt_filter.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>PRT - Laporan Harian</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">DYEING</li>
                    <li class="nav-item">
                        <a href="dye_filter.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>DYE - Laporan Harian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dye_filter_cckwarna.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>DYE - Laporan Cocok Warna</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>