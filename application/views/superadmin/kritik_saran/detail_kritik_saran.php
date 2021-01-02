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
                    <?php if ($detail_kritik_saran == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_kritik_saran as $data) : ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 text-left">
                                        <p class="mb-0"><b>Tanggal</b>
                                            <br><?= tgl_indo(date('Y-m-d', $data->Tanggal)); ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Nama Pengguna</b>
                                            <br><?= $data->Level ?> (<?php if ($data->NamaPerusahaan == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Perusahaan Telah Dihapus</span>
                                        <?php else : ?>
                                            <?= $data->NamaPerusahaan ?>
                                            <?php endif; ?>)<br>
                                            <?php if ($data->NamaLengkap == '') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">User Telah Dihapus</span>
                                            <?php else : ?>
                                                <?= $data->NamaLengkap ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Pesan</b>
                                            <br><?= $data->Pesan ?></p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <a href="<?= base_url('superadmin/kritik_saran'); ?>" class="btn btn-success btn-md btn-icon-split">
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