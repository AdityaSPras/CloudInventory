<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
            <?php if ($jumlah_barang >= $status_paket['JumlahBarang']) { ?>
                <div class="col-sm-12 text-center">
                    <span class="badge rounded-pill bg-danger text-white">Kuota Barang Sudah Penuh!</span>
                </div>
                <div class="col-sm-12 mt-2">
                    <a href="<?= base_url('admin/management_barang'); ?>" class="btn btn-sm btn-success btn-icon-split">
                        <span class="text text-white">Data Management</span>
                        <span class="icon text-white-50">
                            <i class="fas fa-clipboard-list"></i>
                        </span>
                    </a>
                </div>
            <?php } else { ?>
                <div class="col-sm-12 mt-2">
                    <a href="<?= base_url('admin/tambah_barang'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                        <span class="text text-white">Tambah <?= $title; ?></span>
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="30%" class="text-center">Nama Barang</th>
                                <th width="15%" class="text-center">Gambar Barang</th>
                                <th width="20%" class="text-center">Stok</th>
                                <th width="15%" class="text-center">Harga Jual</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_barang as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaBarang ?></td>
                                    <td class="text-center"><img src="<?= base_url('assets/img/items/') . $data->Gambar ?>" alt="" width="60px"></td>
                                    <td class="text-center">
                                        <?php
                                        $BarangMasuk        = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
                                        $BarangKeluar       = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();
                                        $JumlahBarangMasuk  = $BarangMasuk->row();
                                        $JumlahBarangKeluar = $BarangKeluar->row();
                                        $TotalStok          = intval($data->Stok) + (intval($JumlahBarangMasuk->JumlahMasuk) - intval($JumlahBarangKeluar->JumlahKeluar));
                                        ?>

                                        <?php if ($TotalStok == 0) { ?>
                                            <span class="badge rounded-pill bg-danger text-white">Stok Habis</span>
                                        <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                                            <span><?= $TotalStok ?> <?= $data->NamaSatuan ?></span>
                                        <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                                            <span class="badge rounded-pill bg-warning text-white">Stok Hampir Habis</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/detail_barang/" . encrypt_url($data->IdBarang) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="<?= base_url("admin/ubah_barang/" . encrypt_url($data->IdBarang) . "") ?>" class="btn btn-circle btn-warning btn-sm mb-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" onclick="hapus_barang('<?= encrypt_url($data->IdBarang) ?>')" id="hapus_barang" class="btn btn-circle btn-danger btn-sm mb-1">
                                            <i class="fas fa-trash"></i>
                                        </a>
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