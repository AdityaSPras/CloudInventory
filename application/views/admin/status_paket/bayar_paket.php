    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="error-flash-admin" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

        <!-- Page Heading -->
        <div class="col-sm-12">
            <div class="card shadow mb-1">
                <div class="card-header py-3">
                    <h4 class="font-weight-bold text-primary text-center"><?= $title; ?></h4>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
            </div>
        </div>

        <div class="d-sm-flex justify-content-between mb-0">
            <?php if ($bayar_paket == NULL) : ?>
                <?= redirect('error'); ?>
            <?php else : ?>
                <?php foreach ($bayar_paket as $data) : ?>
                    <?php if ($data->TanggalPembayaran != '') : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <div class="col-sm-8 mb-4">
                            <form action="<?= base_url() ?>admin/proses_bayar_paket" name="formAdminBayarPaket" method="POST" enctype="multipart/form-data" onsubmit="return validasiAdminBayarPaket()">
                                <div class="card shadow mb-4">
                                    <div class="card-body py-3">
                                        <h6 class="m-0 font-weight-bold text-primary text-center">Form Transfer</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Nama Bank</label>
                                                <input class="form-control" name="IdPembayaran" type="hidden" value="<?= encrypt_url($data->IdPembayaran) ?>">
                                                <input class="form-control" name="NamaBank" type="text" value="<?= $data->NamaBank ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input class="form-control" name="NomorRekening" type="number" value="<?= $data->NomorRekening ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pemilik Rekening</label>
                                                <input class="form-control" name="NamaPemilikRekening" type="text" value="<?= $data->NamaPemilikRekening ?>">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card shadow mb-1">
                                <div class="card-body py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Bukti Pembayaran</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Format Bukti Pembayaran:
                                            <div class="text-white-45 small">.png .jpeg .jpg<br>(Maks. 2MB)</div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-4 mt-4">
                                        <img src="" id="outputImg" width="200" maxheight="300">
                                    </div>
                                    <span class="text-danger text-xs">*Bukti Pembayaran Harus Jelas!</span>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="hidden" name="Struk" value="<?= $data->BuktiPembayaran ?>">
                                            <input type="file" class="custom-file-input" name="BuktiPembayaran" id="GetFile" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg">
                                            <label class="custom-file-label" for="BuktiPembayaran">Pilih Gambar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        </div>

        <!-- Awal Tombol -->
        <div class="col-sm-12 text-center mt-2 mb-2">
            <a class="btn btn-warning btn-md btn-icon-split mb-1" href="<?= base_url('admin/riwayat_pembayaran'); ?>">
                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                <span class="text text-white">Kembali</span>
            </a>
            <button type="submit" class="btn btn-success btn-md btn-icon-split mb-1">
                <span class="icon text-white"><i class="fas fa-check-circle"></i></span>
                <span class="text text-white">Kirim Pembayaran</span>
            </button>
        </div>
        <!-- Akhir Tombol -->

        </form>
        <!-- Akhir Form -->
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->