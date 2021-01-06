<?php if ($pembayaran_terakhir == NULL || $pembayaran_terakhir["BuktiPembayaran"] != "default_payment.PNG") : ?>
    <?= redirect('error'); ?>
<?php else : ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div align="center">
            <div class="col-sm-8" id="container">

                <div class="success-flash-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary text-center"><?= $title ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr class="mt-0">
                                    <h6 class="text-center mb-4">Segera Lakukan Pembayaran Untuk Pembelian Paket <b><?= $pembayaran_terakhir["Nama"]; ?></b> Senilai <b><?= rupiah($pembayaran_terakhir["TotalBayar"]); ?></b> Ke Rekening:</h6>
                                    <h6 class="text-center mb-3"><b>BANK CENTRAL ASIA (BCA)</b><br>1230338374343<br>a/n : Cloud Inventory</h6>
                                    <h6 class="text-center mb-3"><b>BANK MANDIRI</b><br>355543543543<br>a/n : Cloud Inventory</h6>
                                    <h6 class="text-center"><b>BANK RAKYAT INDONESIA (BRI)</b><br>343243242343<br>a/n : Cloud Inventory</h6>
                                    <hr class="mt-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <a href="<?= base_url('admin/status_paket'); ?>" class="btn btn-warning btn-md btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                <span class="text text-white">Kembali</span>
                            </a>
                            <a href="#" class="btn btn-success btn-md btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-arrow-circle-up"></i></span>
                                <span class="text text-white">Bayar Sekarang</span>
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
<?php endif; ?>