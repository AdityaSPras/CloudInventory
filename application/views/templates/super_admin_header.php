<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> | Cloud Inventory</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/Icon.png">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets'); ?>/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Sweet Alert 2 -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('superadmin'); ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-cloud"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cloud Inventory</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Halaman Utama -->
            <?php if ($title == 'Halaman Utama') : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('superadmin'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Halaman Utama</span></a>
                </li>

                <!-- Data Master -->
                <?php if ($title == 'Paket' or $title == 'Perusahaan' or $title == 'Detail Perusahaan') : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Master</h6>
                            <a class="collapse-item" href="<?= base_url('superadmin/paket'); ?>"><b>Paket</b></a>
                            <a class="collapse-item" href="<?= base_url('superadmin/perusahaan'); ?>"><b>Perusahaan</b></a>
                        </div>
                    </div>
                    </li>

                    <!-- Pembayaran & Aktivasi -->
                    <?php if ($title == 'Pembayaran' or $title == 'Detail Pembayaran' or $title == 'Laporan Pembayaran') : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url('superadmin/daftar_pembayaran'); ?>">
                            <i class="fas fa-fw fa-receipt"></i>
                            <span>Pembayaran & Aktivasi</span></a>
                        </li>

                        <!-- Kritik & Saran -->
                        <?php if ($title == 'Kritik & Saran' or $title == 'Detail Kritik & Saran') : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a class="nav-link" href="<?= base_url('superadmin/kritik_saran'); ?>">
                                <i class="fas fa-fw fa-grin"></i>
                                <span>Kritik & Saran</span></a>
                            </li>

                            <!-- Keluar -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                                    <i class="fas fa-fw fa-sign-out-alt"></i>
                                    <span>Keluar</span></a>
                            </li>

                            <!-- Divider -->
                            <hr class="sidebar-divider d-none d-md-block">

                            <!-- Sidebar Toggler (Sidebar) -->
                            <div class="text-center d-none d-md-inline">
                                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['NamaLengkap']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/users/') . $user['Foto']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('superadmin/profil'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->