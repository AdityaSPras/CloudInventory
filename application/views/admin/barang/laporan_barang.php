<?php if ($status_paket['IdPaket'] == 1) : ?>
    <?= redirect('error'); ?>
<?php else : ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12 mb-4" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="col-sm-12 mt-2">
                    <form action=" <?= base_url() ?>admin/cetak_barang" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-sm mb-2">
                                <button type="submit" class="btn btn-danger btn-icon-split">
                                    <span class="text text-white">Cetak PDF</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-file-pdf"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Kategori Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($daftar_barang as $data) { ?>
                                    <tr>
                                        <th class="text-center"><?= $no++ ?>.</th>
                                        <td class="text-center"><?= $data->NamaBarang ?></td>
                                        <td class="text-center">
                                            <?php if ($data->NamaKategori == '') : ?>
                                                <span>Kategori Barang Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaKategori ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                                            <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            $data1 = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
                                            $data2 = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();


                                            $bm = $data1->row();
                                            $bk = $data2->row();
                                            $total_stok = intval($data->Stok) + (intval($bm->JumlahMasuk) - intval($bk->JumlahKeluar));
                                            ?>

                                            <span><?= $total_stok ?> <?= $data->NamaSatuan ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php endif; ?>