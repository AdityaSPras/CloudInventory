<!-- Begin Page Content -->
<div class="container-fluid">
    <div align="center">
        <div class="col-sm-8" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-center"><?= $title ?></h5>
                </div>
                <div class="card-body">
                    <?php if ($detail_karyawan == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_karyawan as $data) : ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <p class="mb-0"><b>Nama Karyawan</b>
                                            <br><?= $data->NamaLengkap ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Foto Karyawan</b>
                                            <br><img src="<?= base_url('assets/img/users/') . $data->Foto ?>" alt="" width="150px"></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Alamat Karyawan</b>
                                            <br><?php if ($data->Alamat == '') : ?>
                                                <i>(Kosong)</i>
                                            <?php else : ?>
                                                <?= $data->Alamat ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Jenis Kelamin</b>
                                            <br><?= $data->JenisKelamin ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Nomor Telepon Karyawan</b>
                                            <br><?php if ($data->NomorTelepon == '') : ?>
                                                <i>(Kosong)</i>
                                            <?php else : ?>
                                                <?= $data->NomorTelepon ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Email Karyawan</b>
                                            <br><?= $data->Email ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Status</b>
                                            <br><?php if ($data->Status == 'Aktif') : ?>
                                                <span class="badge rounded-pill bg-success text-white">AKTIF</span>
                                            <?php elseif ($data->Status == 'Tidak Aktif') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">TIDAK AKTIF</span>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Tanggal Dibuat</b>
                                            <br> <?= tgl_indo(date('Y-m-d', $data->TanggalDibuat)); ?></p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <a href="<?= base_url('admin/karyawan'); ?>" class="btn btn-success btn-md btn-icon-split">
                                    <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                    <span class="text text-white">Kembali</span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->