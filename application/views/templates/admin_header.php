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

    <!-- Datepicker 3 -->
    <link href="<?= base_url('assets'); ?>/datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <!-- Select Chosen -->
    <link href="<?= base_url('assets'); ?>/chosen/dist/css/component-chosen.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
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
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Halaman Utama</span></a>
                </li>

                <!-- Data Master -->
                <?php if ($title == 'Karyawan' or $title == 'Tambah Karyawan' or $title == 'Tambah Karyawan' or $title == 'Detail Karyawan' or $title == 'Kategori Barang' or $title == 'Tambah Kategori Barang' or $title == 'Detail Kategori Barang' or $title == 'Satuan Barang' or $title == 'Tambah Satuan Barang' or $title == 'Detail Satuan Barang' or $title == 'Supplier Barang' or $title == 'Tambah Supplier Barang' or $title == 'Detail Supplier Barang' or $title == 'Barang' or $title == 'Tambah Barang' or $title == 'Detail Barang') : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#DataMaster" aria-expanded="true" aria-controls="DataMaster">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="DataMaster" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Master</h6>
                            <a class="collapse-item" href="<?= base_url('admin/karyawan'); ?>"><b>Karyawan</b></a>
                            <a class="collapse-item" href="<?= base_url('admin/kategori'); ?>"><b>Kategori Barang</b></a>
                            <a class="collapse-item" href="<?= base_url('admin/satuan'); ?>"><b>Satuan Barang</b></a>
                            <a class="collapse-item" href="<?= base_url('admin/supplier'); ?>"><b>Supplier Barang</b></a>
                            <a class="collapse-item" href="<?= base_url('admin/barang'); ?>"><b>Barang</b></a>
                        </div>
                    </div>
                    </li>

                    <!-- Barang Masuk -->
                    <?php if ($title == 'Barang Masuk' or $title == 'Tambah Barang Masuk' or $title == 'Detail Barang Masuk') : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url('admin/barang_masuk'); ?>">
                            <i class="fas fa-fw fa-truck-loading"></i>
                            <span>Barang Masuk</span></a>
                        </li>

                        <!-- Barang Keluar -->
                        <?php if ($title == 'Barang Keluar' or $title == 'Tambah Barang Keluar' or $title == 'Detail Barang Keluar') : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a class="nav-link" href="<?= base_url('admin/barang_keluar'); ?>">
                                <i class="fas fa-fw fa-box-open"></i>
                                <span>Barang Keluar</span></a>
                            </li>

                            <!-- Laporan -->
                            <?php if ($title == 'Laporan Barang' or $title == 'Laporan Barang Masuk' or $title == 'Laporan Barang Keluar') : ?>
                                <li class="nav-item active">
                                <?php else : ?>
                                <li class="nav-item">
                                <?php endif; ?>
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#Laporan" aria-expanded="true" aria-controls="Laporan">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    <span>Laporan</span>
                                </a>
                                <div id="Laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <h6 class="collapse-header">Laporan</h6>
                                        <a class="collapse-item" href="<?= base_url('admin/laporan_barang'); ?>"><b>Laporan Barang</b></a>
                                        <a class="collapse-item" href="<?= base_url('admin/laporan_barang_masuk'); ?>"><b>Laporan Barang Masuk</b></a>
                                        <a class="collapse-item" href="<?= base_url('admin/laporan_barang_keluar'); ?>"><b>Laporan Barang Keluar</b></a>
                                    </div>
                                </div>
                                </li>

                                <!-- Status Paket -->
                                <?php if ($title == 'Status Paket') : ?>
                                    <li class="nav-item active">
                                    <?php else : ?>
                                    <li class="nav-item">
                                    <?php endif; ?>
                                    <a class="nav-link" href="<?= base_url('admin/status_paket'); ?>">
                                        <i class="fas fa-fw fa-shield-alt"></i>
                                        <span>Status Paket</span></a>
                                    </li>

                                    <!-- Kritik & Saran -->
                                    <?php if ($title == 'Kritik & Saran') : ?>
                                        <li class="nav-item active">
                                        <?php else : ?>
                                        <li class="nav-item">
                                        <?php endif; ?>
                                        <a class="nav-link" href="<?= base_url('admin/kritik_saran'); ?>">
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
                                <a class="dropdown-item" href="<?= base_url('admin/profil'); ?>">
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