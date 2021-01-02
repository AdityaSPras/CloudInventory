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
                    <?php if ($detail_barang_keluar == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_barang_keluar as $data) : ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mb-0"><b>Tanggal Keluar</b>
                                            <br><?= tgl_indo($data->TanggalKeluar) ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Nama Barang</b>
                                            <br><?php if ($data->NamaBarang == '') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">Barang Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaBarang ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Gambar Barang</b>
                                            <br><?php if ($data->Gambar == '') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">Gambar Telah Terhapus!</span>
                                            <?php else : ?>
                                                <img src="<?= base_url('assets/img/items/') . $data->Gambar ?>" alt="" width="200px">
                                            <?php endif; ?>
                                        </p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Harga Satuan</b>
                                            <br><?= rupiah($data->HargaKeluar) ?><?php if ($data->NamaSatuan == '') : ?>
                                            <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                        </p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Jumlah Keluar</b>
                                            <br><?= $data->JumlahKeluar ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?> <?= $data->NamaSatuan ?><?php endif; ?>
                                        </p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Total Harga</b>
                                            <br><?= rupiah($data->TotalKeluar) ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Oleh</b>
                                            <br><?php if ($data->NamaLengkap == '') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">User Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaLengkap ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <a href="<?= base_url('admin/barang_keluar'); ?>" class="btn btn-success btn-md btn-icon-split">
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