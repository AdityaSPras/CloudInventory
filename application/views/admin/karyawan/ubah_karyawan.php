<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="error-flash-admin" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <!-- Page Heading -->
    <div class="col-sm-12">
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h4 class="font-weight-bold text-primary text-center"><?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
        </div>
    </div>

    <div class="d-sm-flex justify-content-between mb-0">
        <?php if ($ubah_karyawan == NULL) : ?>
            <?= redirect('error'); ?>
        <?php else : ?>
            <?php foreach ($ubah_karyawan as $data) : ?>
                <div class="col-sm-8 mb-4">
                    <form action="<?= base_url() ?>admin/proses_ubah_karyawan" name="formAdminUbahKaryawan" method="POST" enctype="multipart/form-data" onsubmit="return validasiAdminUbahKaryawan()">
                        <div class="card shadow mb-4">
                            <div class="card-body py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Form Karyawan</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Karyawan:</label>
                                        <input class="form-control" name="IdUser" type="hidden" value="<?= encrypt_url($data->IdUser) ?>">
                                        <input class="form-control" name="NamaLengkap" type="text" value="<?= $data->NamaLengkap ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="JenisKelamin" class="form-control">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-Laki" <?php if ($data->JenisKelamin == "Laki-Laki") : ?> selected <?php endif; ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?php if ($data->JenisKelamin == "Perempuan") : ?> selected <?php endif; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Handphone:</label>
                                        <input type="tel" class="form-control" name="NomorTelepon" value="<?= $data->NomorTelepon ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea class="form-control" name="Alamat" rows="5"><?= $data->Alamat ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" name="Email" value="<?= $data->Email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Status Karyawan:</label>
                                        <select name="Status" class="form-control">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Aktif" <?php if ($data->Status == "Aktif") : ?> selected <?php endif; ?>>Aktif</option>
                                            <option value="Tidak Aktif" <?php if ($data->Status == "Tidak Aktif") : ?> selected <?php endif; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Password">Ubah Password:</label>
                                        <div class="input-group">
                                            <input name="PasswordLama" type="hidden" value="<?= $data->Password ?>">
                                            <input type="password" class="form-control" id="passwordbaru" name="PasswordBaru">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-light">
                                                    <a href="#" class="text-gray-700" id="show-pass5">
                                                        <i class="fas fa-eye" id="icon5"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                </div>

                <div class="col-sm-4">
                    <div class="card shadow mb-1">
                        <div class="card-body py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Foto</h6>
                        </div>
                        <div class="card-body">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Format Foto:
                                    <div class="text-white-45 small">.png .jpeg .jpg<br>(Maks. 2MB)</div>
                                </div>
                            </div>
                            <div class="text-center mb-4 mt-4">
                                <img src="<?= base_url() ?>assets/img/users/<?= $data->Foto ?>" id="outputImg" width="200" maxheight="300">
                            </div>
                            <span class="text-danger text-xs">*Kosongkan Jika Tidak Ingin Menambah Foto Karyawan!</span>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="hidden" name="FotoLama" value="<?= $data->Foto ?>">
                                    <input type="file" class="custom-file-input" name="Foto" id="GetFile" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg">
                                    <label class="custom-file-label" for="Foto">Pilih Foto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>

    <!-- Awal Tombol -->
    <div class="col-sm-12 text-center mt-2 mb-2">
        <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/karyawan'); ?>">
            <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
            <span class="text text-white">Kembali</span>
        </a>
        <button type="submit" class="btn btn-warning btn-md btn-icon-split mb-1">
            <span class="icon text-white"><i class="fas fa-save"></i></span>
            <span class="text text-white">Simpan</span>
        </button>
    </div>
    <!-- Akhir Tombol -->

    </form>
    <!-- Akhir Form -->
<?php endforeach; ?>
<?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->