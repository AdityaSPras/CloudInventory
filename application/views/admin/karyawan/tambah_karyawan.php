<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="success-flash-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

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

        <div class="col-sm-8 mb-4">
            <?= form_open_multipart('admin/tambah_karyawan'); ?>
            <div class="card shadow mb-4">
                <div class="card-body py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Form Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Karyawan:</label>
                            <input type="text" class="form-control" id="namalengkap" name="NamaLengkap" value="<?= set_value('NamaLengkap'); ?>">
                            <?= form_error('NamaLengkap', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <select class="form-control" id="jeniskelamin" name="JenisKelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('JenisKelamin', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Handphone:</label>
                            <input type="tel" class="form-control" id="namatelepon" name="NomorTelepon" value="<?= set_value('NomorTelepon'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat:</label>
                            <textarea class="form-control" id="alamat" name="Alamat" rows="5"><?= set_value('Alamat'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="email" name="Email" value="<?= set_value('Email'); ?>">
                            <?= form_error('Email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="Password">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="Password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-light">
                                        <a href="#" class="text-gray-700" id="show-pass4">
                                            <i class="fas fa-eye" id="icon4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('Password', '<small class="text-danger">', '</small>'); ?>
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
                        <img src="<?= base_url() ?>assets/img/users/user_default.png" id="outputImg" width="200" maxheight="300">
                    </div>
                    <span class="text-danger text-xs">*Kosongkan Jika Tidak Ingin Menambah Foto Karyawan!</span>
                    <div class="form-group">
                        <div class="custom-file">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->