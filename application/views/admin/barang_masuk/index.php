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
                <a href="<?= base_url('admin/tambah_barang_masuk'); ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">Nama Barang</th>
                                <th class="text-center" width="15%">Supplier</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Jumlah Masuk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Tanggal Masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_barang_masuk as $data) { ?>
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
                                        <?php if ($data->NamaSupplier == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Supplier Telah Terhapus!</span>
                                        <?php else : ?>
                                            <?= $data->NamaSupplier ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaMasuk) ?></td>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->NamaSatuan == '') : ?>
                                            <span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $data->JumlahMasuk ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $data->JumlahMasuk ?> <?= $data->NamaSatuan ?></span>
                                        <?php endif; ?>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaMasuk / $data->JumlahMasuk) ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= tgl_indo($data->TanggalMasuk) ?> </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/detail_barang_masuk/" . encrypt_url($data->IdBarangMasuk) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#ubahBarangMasuk<?= encrypt_url($data->IdBarangMasuk) ?>" class="btn btn-circle btn-warning btn-sm mb-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" onclick="hapus_barang_masuk('<?= encrypt_url($data->IdBarangMasuk) ?>')" id="hapus_barang_masuk" class="btn btn-circle btn-danger btn-sm mb-1">
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

<!-- Awal Modal Ubah Barang Masuk -->
<?php $no = 0;
foreach ($daftar_barang_masuk as $data) : $no++; ?>
    <div class="modal fade" id="ubahBarangMasuk<?= encrypt_url($data->IdBarangMasuk) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>admin/ubah_barang_masuk" name="formAdminUbahBarangMasuk" method="POST" onsubmit="return validasiAdminUbahBarangMasuk()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Barang Masuk</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="hidden" name="IdBarangMasuk" class="form-control" value="<?= encrypt_url($data->IdBarangMasuk) ?>">
                            <input class="form-control" name="TanggalMasuk" type="date" value="<?= $data->TanggalMasuk ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="IdBarang" type="hidden" value="<?= encrypt_url($data->IdBarang) ?>">
                            <input class="form-control" type="text" value="<?= ($data->NamaBarang) ?>" readonly>
                        </div>
                        <?php if ($jumlah_supplier > 0) : ?>
                            <div class="form-group">
                                <label>Supplier Barang</label>
                                <select name="IdSupplier" class="form-control">
                                    <option value="">-- Pilih Supplier Barang --</option>
                                    <?php foreach ($data_supplier as $supplier) : ?>

                                        <?php if (encrypt_url($data->IdSupplier) == encrypt_url($supplier->IdSupplier)) : ?>
                                            <option value="<?= encrypt_url($supplier->IdSupplier) ?>" selected><?= $supplier->NamaSupplier ?></option>
                                        <?php else : ?>
                                            <option value="<?= encrypt_url($supplier->IdSupplier) ?>"><?= $supplier->NamaSupplier ?></option>
                                        <?php endif; ?>

                                    <?php endforeach ?>
                                </select>
                            </div>
                        <?php else : ?>
                            <div class="form-group"><label>Supplier Barang</label>
                                <input type="hidden" name="IdSupplier">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>Belum Ada Data Supplier Barang!</i></span>
                                    <a href="<?= base_url() ?>admin/supplier" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Total Harga Masuk</label>
                            <input class="form-control" name="HargaMasuk" type="number" value="<?= $data->HargaMasuk ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Masuk Satuan</label>
                            <input class="form-control" name="JumlahMasuk" type="number" value="<?= $data->JumlahMasuk ?>">
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
<!-- Akhir Modal Ubah Barang Masuk -->