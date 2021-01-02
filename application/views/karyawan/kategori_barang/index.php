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
                <a href="<?= base_url('karyawan/tambah_kategori'); ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                                <th width="25%" class="text-center">Nama Kategori</th>
                                <th width="50%" class="text-center">Keterangan</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_kategori as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaKategori ?></td>
                                    <td class="text-center">
                                        <?php if ($data->Keterangan == '') : ?>
                                            <i> (Kosong) </i>
                                        <?php else : ?>
                                            <?= $data->Keterangan ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal" data-target="#ubahKategori<?= encrypt_url($data->IdKategori) ?>" class="btn btn-circle btn-warning btn-sm">
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

<!-- Awal Modal Ubah Kategori Barang -->
<?php $no = 0;
foreach ($daftar_kategori as $data) : $no++; ?>
    <div class="modal fade" id="ubahKategori<?= encrypt_url($data->IdKategori) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>karyawan/ubah_kategori" name="formKaryawanUbahKategori" method="POST" onsubmit="return validasiKaryawanUbahKategori()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Kategori Barang</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori Barang</label>
                            <input type="hidden" name="IdKategori" class="form-control" value="<?= encrypt_url($data->IdKategori) ?>">
                            <input type="text" name="NamaKategori" id="NamaKategori" class="form-control" value="<?= $data->NamaKategori ?>">
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
<!-- Akhir Modal Ubah Kategori Barang -->