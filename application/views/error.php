<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>403 Forbidden</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/Icon.png">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets'); ?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets'); ?>/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid mt-5 py-5">

        <!-- 403 Error Text -->
        <div class="text-center">
            <div class="error mx-auto mt-5" data-text="403">403</div>
            <p class="text-gray-700 mb-2 mt-2">ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI</p>
            <p class="text mt-5">
                <?php if ($this->session->userdata('Level') == "Super Admin") : ?>
                    <span><a class="small" href="<?= base_url('superadmin'); ?>">Kembali Ke Halaman Dashboard</a></span>
                <?php elseif ($this->session->userdata('Level') == "Admin") : ?>
                    <span><a class="small" href="<?= base_url('admin'); ?>">Kembali Ke Halaman Dashboard</a></span>
                <?php elseif ($this->session->userdata('Level') == "Karyawan") : ?>
                    <span><a class="small" href="<?= base_url('karyawan'); ?>">Kembali Ke Halaman Dashboard</a></span>
                <?php else : ?>
                    <span><a class="small" href="<?= base_url('home'); ?>">Kembali Ke Halaman Home</a></span>
                <?php endif; ?>
            </p>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/sbadmin2/js/sb-admin-2.min.js"></script>

</body>

</html>