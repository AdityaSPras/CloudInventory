<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <?php if ($jumlah_barang < $status_paket['JumlahBarang']) : ?>
            <?= redirect('error'); ?>
        <?php else : ?>
            <form action="<?= base_url() ?>admin/ubah_daftar_barang" method="POST" enctype="multipart/form-data">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                        <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <span class="text-danger text-xs">* Centang Data Barang Yang Ingin Ditampilkan Pada Daftar Barang</span><br>
                                <span class="text-danger text-xs">* Maksimal Data Yang Dapat Ditampilkan Adalah <b>(<?= $status_paket['JumlahBarang']; ?> Barang)</b></span>
                            </div>

                            <div class="col-sm mb-2 text-right">
                                <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/barang'); ?>">
                                    <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                    <span class="text text-white">Kembali</span>
                                </a>
                                <button type="submit" class="btn btn-primary btn-md btn-icon-split mb-1">
                                    <span class="icon text-white"><i class="fas fa-save"></i></span>
                                    <span class="text text-white">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Stok Barang</th>
                                        <th class="text-center">Tampilkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_barang as $data) { ?>
                                        <tr>
                                            <th class="text-center"><?= $no++ ?>.</th>
                                            <td class="text-center"><?= $data->NamaBarang ?></td>
                                            <td class="text-center">
                                                <?php
                                                $BarangMasuk        = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
                                                $BarangKeluar       = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();
                                                $JumlahBarangMasuk  = $BarangMasuk->row();
                                                $JumlahBarangKeluar = $BarangKeluar->row();
                                                $TotalStok          = intval($data->Stok) + (intval($JumlahBarangMasuk->JumlahMasuk) - intval($JumlahBarangKeluar->JumlahKeluar));
                                                ?>

                                                <?php if ($TotalStok == 0) { ?>
                                                    <span class="text-danger"><?= $TotalStok ?></span><br>
                                                <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                                                    <span class="text-success"><?= $TotalStok ?></span>
                                                <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                                                    <span class="text-warning"><?= $TotalStok ?></span><br>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="StatusData[]" type="checkbox" <?= ($data->StatusData == 'Aktif' ? 'checked' : '') ?> value="<?= encrypt_url($data->IdBarang) ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->