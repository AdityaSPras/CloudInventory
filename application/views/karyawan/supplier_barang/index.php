<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-karyawan" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="<?= base_url('karyawan/tambah_supplier'); ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                                <th width="5%" class="text-center">No</th>
                                <th width="25%" class="text-center">Nama Supplier</th>
                                <th width="20%" class="text-center">Nomor Telepon</th>
                                <th width="30%" class="text-center">Alamat</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_supplier as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaSupplier ?></td>
                                    <td class="text-center">
                                        <?php if ($data->NomorTeleponSupplier == '') : ?>
                                            <i> (Kosong) </i>
                                        <?php else : ?>
                                            <?= $data->NomorTeleponSupplier ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= $data->AlamatSupplier ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url("karyawan/detail_supplier/" . encrypt_url($data->IdSupplier) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#ubahSupplier<?= encrypt_url($data->IdSupplier) ?>" class="btn btn-circle btn-warning btn-sm mb-1">
                                            <i class="fas fa-pen"></i>
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

<!-- Awal Modal Ubah Supplier Barang -->
<?php $no = 0;
foreach ($daftar_supplier as $data) : $no++; ?>
    <div class="modal fade" id="ubahSupplier<?= encrypt_url($data->IdSupplier) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>karyawan/ubah_supplier" name="formKaryawanUbahSupplier" method="POST" onsubmit="return validasiKaryawanUbahSupplier()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Supplier Barang</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Supplier Barang</label>
                            <input type="hidden" name="IdSupplier" class="form-control" value="<?= encrypt_url($data->IdSupplier) ?>">
                            <input type="text" name="NamaSupplier" id="NamaSupplier" class="form-control" value="<?= $data->NamaSupplier ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Supplier</label>
                            <textarea class="form-control" name="AlamatSupplier" id="AlamatSupplier" rows="3"><?= $data->AlamatSupplier ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon Supplier</label>
                            <input type="tel" name="NomorTeleponSupplier" class="form-control" value="<?= $data->NomorTeleponSupplier ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Supplier</label>
                            <input type="email" name="EmailSupplier" class="form-control" value="<?= $data->EmailSupplier ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="Keterangan" rows="3"><?= $data->Keterangan ?></textarea>
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
<!-- Akhir Modal Ubah Supplier Barang -->