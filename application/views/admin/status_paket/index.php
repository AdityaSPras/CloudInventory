<!-- Begin Page Content -->
<div class="container-fluid">
    <div align="center">
        <div class="col-sm-10" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-center"><?= $title ?></h5>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <p><img src="<?= base_url('assets/img/company/') . $perusahaan['Logo']; ?>" alt="Logo Perusahaan" width="150px"></p>
                                <p class="mb-0"><b>Paket Yang Digunakan Saat Ini</b>
                                    <br><?php if ($status_paket['IdPaket'] == 1) { ?>
                                        <span><?= $status_paket['Nama']; ?></span>
                                    <?php } elseif ($status_paket['IdPaket'] == 2) { ?>
                                        <span><?= $status_paket['Nama']; ?></span>
                                    <?php } elseif ($status_paket['IdPaket'] == 3) { ?>
                                        <span><?= $status_paket['Nama']; ?></span>
                                    <?php } ?>
                                </p>
                                <hr class="mt-0">
                                <p class="mb-0"><b>Batas Kuota Karyawan</b>
                                    <br><?= $status_paket['JumlahKaryawan']; ?> Data
                                </p>
                                <hr class="mt-0">
                                <p class="mb-0"><b>Batas Kuota Barang</b>
                                    <br><?= $status_paket['JumlahBarang']; ?> Data
                                </p>
                                <hr class="mt-0">
                                <p class="mb-0"><b>Biaya Bulanan</b>
                                    <br><?= rupiah($status_paket['Harga']); ?>
                                </p>
                                <hr class="mt-0">
                                <p class="mb-0"><b>Masa Berlaku Paket</b>
                                    <br><?php if ($status_paket['IdPaket'] == 1) { ?>
                                        <span>∞</span>
                                    <?php } elseif ($status_paket['IdPaket'] == 2) { ?>
                                        <?php if ($aktif_paket == NULL) { ?>
                                            <span>-</span>
                                        <?php } else { ?>
                                            <span><?= tgl_indo($aktif_paket['AkhirAktif']); ?></span>
                                        <?php } ?>
                                    <?php } elseif ($status_paket['IdPaket'] == 3) { ?>
                                        <?php if ($aktif_paket == NULL) { ?>
                                            <span>-</span>
                                        <?php } else { ?>
                                            <span><?= tgl_indo($aktif_paket['AkhirAktif']); ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </p>
                                <hr class="mt-0">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <a href="<?= base_url('admin/ubah_paket'); ?>" class="btn btn-danger btn-md mb-2">
                            <span class="text text-white">Ubah Paket</span>
                        </a>
                        <?php if ($status_paket['IdPaket'] == 1) { ?>
                        <?php } else { ?>
                            <a href="<?= base_url('admin/perpanjang_paket'); ?>" class="btn btn-warning btn-md mb-2">
                                <span class="text text-white">Perpanjang Paket</span>
                            </a>
                        <?php } ?>
                        <a href="<?= base_url('admin/riwayat_pembayaran'); ?>" class="btn btn-info btn-md mb-2">
                            <span class="text text-white">Pembayaran Paket</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->