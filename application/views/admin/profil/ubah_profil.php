<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="error-flash-admin" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <!-- Page Heading -->
    <div class="col-sm-12">
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h4 class="font-weight-bold text-primary text-center"><?= $title; ?></h4>
            </div>
        </div>
    </div>

    <div class="d-sm-flex justify-content-between mb-0">

        <!-- Awal Kolom Data Pengguna -->
        <div class="col-sm-8 mb-4">
            <!-- Awal Form -->
            <?= form_open_multipart('admin/ubah_profil'); ?>
            <div class="card shadow mb-4">
                <div class="card-body py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Data Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" id="email" name="Email" type="text" value="<?= $user['Email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" id="namalengkap" name="NamaLengkap" type="text" value="<?= $user['NamaLengkap']; ?>">
                            <?= form_error('NamaLengkap', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" id="jeniskelamin" name="JenisKelamin">
                                <option value="" <?= ($user['JenisKelamin'] == '') ? 'selected' : '' ?>>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" <?= ($user['JenisKelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= ($user['JenisKelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <?= form_error('JenisKelamin', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input class="form-control" id="nomortelepon" name="NomorTelepon" type="tel" value="<?= $user['NomorTelepon']; ?>">
                            <?= form_error('NomorTelepon', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" id="alamat" name="Alamat" rows="3"><?= $user['Alamat']; ?></textarea>
                            <?= form_error('Alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <!-- Akhir Kolom Data Pengguna -->

        <!-- Awal Kolom Foto -->
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
                        <img src="<?= base_url('assets/img/users/') . $user['Foto']; ?>" id="outputImg" width="200" maxheight="300">
                    </div>
                    <span class="text-danger">*Kosongkan Jika Tidak Ingin Merubah!</span>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Foto" id="GetFile" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg">
                            <label class="custom-file-label" for="foto">Pilih Foto</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Kolom Foto -->

    </div>

    <!-- Awal Tombol -->
    <div class="col-sm-12 text-center mt-2 mb-2">
        <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/profil'); ?>">
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