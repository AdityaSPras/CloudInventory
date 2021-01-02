<!-- Begin Page Content -->
<div class="container-fluid">
    <div align="center">
        <div class="col-sm-8 mb-4" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-center"><?= $title ?></h5>
                </div>
                <div class="card-body">
                    <?php if ($detail_barang == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_barang as $data) : ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mb-0"><b>Nama Barang</b>
                                            <br><?= $data->NamaBarang ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Gambar Barang</b>
                                            <br><img src="<?= base_url('assets/img/items/') . $data->Gambar ?>" alt="" width="200px"></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Kategori Barang</b>
                                            <br><?php if ($data->NamaKategori == '') : ?>
                                                <span class="badge rounded-pill bg-danger text-white">Kategori Barang Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaKategori ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Harga Barang</b>
                                            <br><?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                                            <?php else : ?>/<?= $data->NamaSatuan ?>
                                        <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Stok Barang</b>
                                            <br><?php
                                                $data1 = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
                                                $data2 = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();


                                                $bm = $data1->row();
                                                $bk = $data2->row();
                                                $total_stok = intval($data->Stok) + (intval($bm->JumlahMasuk) - intval($bk->JumlahKeluar));
                                                ?>
                                            <?= $total_stok ?>
                                            <?php if ($data->NamaSatuan == '') : ?>
                                            <?php else : ?>
                                                <?= $data->NamaSatuan ?>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                        <p class="mb-0"><b>Status Stok Barang</b>
                                            <br><?php if ($total_stok <= $data->StokMinimum) : ?>
                                                <span class="badge rounded-pill bg-danger text-white">Hampir Habis!</span>
                                            <?php else : ?>
                                                <span class="badge rounded-pill bg-success text-white">Normal</span>
                                            <?php endif; ?></p>
                                        <hr class="mt-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <a href="<?= base_url('karyawan/barang'); ?>" class="btn btn-success btn-md btn-icon-split">
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