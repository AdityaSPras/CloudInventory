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
            <div class="col-sm-12 mt-2">
                <a href="<?= base_url('admin/tambah_barang_keluar'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="text text-white">Tambah <?= $title; ?></span>
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah Keluar</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Tanggal Keluar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_barang_keluar as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center">
                                        <?php if ($data->NamaBarang == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Barang Telah Terhapus!</span>
                                        <?php else : ?>
                                            <?= $data->NamaBarang ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaKeluar) ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->NamaSatuan == '') : ?>
                                            <span class="badge badge-warning"> <i class="fa fa-minus"></i> <?= $data->JumlahKeluar ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-warning"> <i class="fa fa-minus"></i> <?= $data->JumlahKeluar ?> <?= $data->NamaSatuan ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= rupiah($data->TotalKeluar) ?></td>
                                    <td class="text-center"><?= tgl_indo($data->TanggalKeluar) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/detail_barang_keluar/" . encrypt_url($data->IdBarangKeluar) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#ubahBarangKeluar<?= encrypt_url($data->IdBarangKeluar) ?>" class="btn btn-circle btn-warning btn-sm mb-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" onclick="hapus_barang_keluar('<?= encrypt_url($data->IdBarangKeluar) ?>')" id="hapus_barang_keluar" class="btn btn-circle btn-danger btn-sm mb-1">
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

<!-- Awal Modal Ubah Barang Keluar -->
<?php $no = 0;
foreach ($daftar_barang_keluar as $data) : $no++; ?>
    <div class="modal fade" id="ubahBarangKeluar<?= encrypt_url($data->IdBarangKeluar) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>admin/ubah_barang_keluar" name="formAdminUbahBarangKeluar" method="POST" onsubmit="return validasiAdminUbahBarangKeluar()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Barang Keluar</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Keluar</label>
                            <input type="hidden" name="IdBarangKeluar" class="form-control" value="<?= encrypt_url($data->IdBarangKeluar) ?>">
                            <input class="form-control" name="TanggalKeluar" type="date" value="<?= $data->TanggalKeluar ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="IdBarang" type="hidden" value="<?= encrypt_url($data->IdBarang) ?>">
                            <input class="form-control" type="text" value="<?= ($data->NamaBarang) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input class="form-control" name="HargaKeluar" type="number" value="<?= $data->HargaKeluar ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Keluar</label>
                            <input class="form-control" name="JumlahKeluar" type="number" value="<?= $data->JumlahKeluar ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text text-white">Simpan</span>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon-split" data-dismiss="modal">
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="text text-white">Batal</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endforeach; ?>
<!-- Akhir Modal Ubah Barang Keluar -->