<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="warning-flash-admin" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah Karyawan -->
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Karyawan</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $jumlah_karyawan ?> Limit <?= $status_paket['JumlahKaryawan']; ?><br><br>
                                <?php if ($jumlah_karyawan >= $status_paket['JumlahKaryawan']) { ?>
                                    <span class="badge rounded-pill bg-danger text-white">Kuota Karyawan Penuh</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Barang -->
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card border-left-success shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?> Limit <?= $status_paket['JumlahBarang']; ?><br><br>
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

        <!-- Status Paket -->
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card border-left-info shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Status Paket</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <?php if ($status_paket['IdPaket'] == 1) { ?>
                                    <span class="badge rounded-pill bg-primary text-white"><?= $status_paket['Nama']; ?></span><br><br>
                                    <span class="h6 text-xs text-gray-900">Aktif Hingga : ∞</span>
                                <?php } elseif ($status_paket['IdPaket'] == 2) { ?>
                                    <span class="badge rounded-pill bg-success text-white"><?= $status_paket['Nama']; ?></span><br><br>
                                    <span class="h6 text-xs text-gray-900">Aktif Hingga : <?php if ($aktif_paket == NULL) { ?>-<?php } else { ?>
                                        <?= tgl_indo($aktif_paket['AkhirAktif']); ?></span>
                                <?php } ?>
                            <?php } elseif ($status_paket['IdPaket'] == 3) { ?>
                                <span class="badge rounded-pill bg-warning text-white"><?= $status_paket['Nama']; ?></span><br><br>
                                <span class="h6 text-xs text-gray-900">Aktif Hingga : <?php if ($aktif_paket == NULL) { ?>-<?php } else { ?>
                                    <?= tgl_indo($aktif_paket['AkhirAktif']); ?></span>
                            <?php } ?>
                        <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shield-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Jumlah Barang Masuk-->
        <div class="col-xl-6 col-md-6 mb-2">
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
        <div class="col-xl-6 col-md-6 mb-2">
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
    <div class="row mb-2">

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