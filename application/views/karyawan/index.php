<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah Barang -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?> Dari <?= $status_paket['JumlahBarang']; ?><br><br>
                                <?php if ($jumlah_barang >= $status_paket['JumlahBarang']) { ?>
                                    <span class="badge rounded-pill bg-danger text-white">Kuota Barang Penuh</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Barang Masuk -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barang Masuk (<?= tgl_indo($hari_ini) ?>)</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <?php if ($jumlah_barang_masuk == '') { ?>
                                    <span class="h6 badge rounded-pill bg-warning text-white">Belum Ada Barang Masuk</span>
                                <?php } else { ?>
                                    <span><?= $jumlah_barang_masuk ?> Barang</span><br>
                                    <span class="badge bg-warning text-white">Total : <?= rupiah($total_pengeluaran) ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-loading fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Barang Keluar -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Barang Keluar (<?= tgl_indo($hari_ini) ?>)</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <?php if ($jumlah_barang_keluar == '') { ?>
                                    <span class="h6 badge rounded-pill bg-danger text-white">Belum Ada Barang Keluar</span>
                                <?php } else { ?>
                                    <span><?= $jumlah_barang_keluar ?> Barang</span><br>
                                    <span class="badge bg-danger text-white">Total : <?= rupiah($total_pemasukan) ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 card shadow">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">SELAMAT DATANG</h5>
            </div>
            <div class="card-body py-4">
                <h6 class="text-center"><b>SISTEM INFORMASI CLOUD INVENTORY</b>
                    <p>Anda Telah Login Sebagai <b><?= $user['NamaLengkap']; ?></b></p>
                    <p><b><?= $user['Level']; ?> (<?= $profil['NamaPerusahaan']; ?>)</b></p>
                </h6>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->