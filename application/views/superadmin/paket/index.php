<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-super-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Limit Barang</th>
                                <th class="text-center">Limit Karyawan</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_paket as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data['Nama']; ?></td>
                                    <td class="text-center"><?= $data['JumlahBarang']; ?></td>
                                    <td class="text-center"><?= $data['JumlahKaryawan']; ?></td>
                                    <td class="text-center"><?= $data['Keterangan']; ?></td>
                                    <td class="text-center"><?= rupiah($data['Harga']) ?>/Bulan</td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal" data-target="#ubahPaket<?= $data['IdPaket']; ?>" class="btn btn-circle btn-warning btn-sm">
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

<!-- Awal Modal Ubah Paket -->
<?php $no = 0;
foreach ($daftar_paket as $data) : $no++; ?>
    <div class="modal fade" id="ubahPaket<?= $data['IdPaket']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>superadmin/ubah_paket" name="formUbahPaket" method="POST" onsubmit="return validateFormUbahPaket()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Paket</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="hidden" name="IdPaket" class="form-control" value="<?= encrypt_url($data['IdPaket']) ?>">
                            <input type="text" name="Nama" id="Nama" class="form-control" value="<?= $data['Nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Limit Barang</label>
                            <input type="number" name="JumlahBarang" id="JumlahBarang" class="form-control" value="<?= $data['JumlahBarang']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Limit Karyawan</label>
                            <input type="number" name="JumlahKaryawan" id="JumlahKaryawan" class="form-control" value="<?= $data['JumlahKaryawan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="Keterangan" id="Keterangan" class="form-control" value="<?= $data['Keterangan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga Paket</label>
                            <input type="number" name="Harga" id="Harga" class="form-control" value="<?= $data['Harga']; ?>">
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
<!-- Akhir Modal Ubah Paket -->