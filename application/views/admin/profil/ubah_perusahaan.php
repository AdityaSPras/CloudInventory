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
            <?= form_open_multipart('admin/ubah_perusahaan'); ?>
            <div class="card shadow mb-4">
                <div class="card-body py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Data Perusahaan</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input class="form-control" id="namaperusahaan" name="NamaPerusahaan" type="text" value="<?= $perusahaan['NamaPerusahaan']; ?>">
                            <?= form_error('NamaPerusahaan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemilik Perusahaan</label>
                            <input class="form-control" id="namapemilik" name="NamaPemilik" type="text" value="<?= $perusahaan['NamaPemilik']; ?>">
                            <?= form_error('NamaPemilik', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" id="emailperusahaan" name="EmailPerusahaan" type="text" value="<?= $perusahaan['EmailPerusahaan']; ?>">
                            <?= form_error('EmailPerusahaan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat Perusahaan</label>
                            <textarea class="form-control" id="alamatperusahaan" name="AlamatPerusahaan" rows="3"><?= $perusahaan['AlamatPerusahaan']; ?></textarea>
                            <?= form_error('AlamatPerusahaan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon Perusahaan</label>
                            <input class="form-control" id="nomorteleponperusahaan" name="NomorTeleponPerusahaan" type="tel" value="<?= $perusahaan['NomorTeleponPerusahaan']; ?>">
                            <?= form_error('NomorTeleponPerusahaan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Fax Perusahaan</label>
                            <input class="form-control" id="fax" name="Fax" type="tel" value="<?= $perusahaan['Fax']; ?>">
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
                    <h6 class="m-0 font-weight-bold text-primary text-center">Logo</h6>
                </div>
                <div class="card-body">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Format Logo:
                            <div class="text-white-45 small">.png .jpeg .jpg<br>(Maks. 2MB)</div>
                        </div>
                    </div>
                    <div class="text-center mb-4 mt-4">
                        <img src="<?= base_url('assets/img/company/') . $perusahaan['Logo']; ?>" id="outputImg" width="200" maxheight="300">
                    </div>
                    <span class="text-danger">*Kosongkan Jika Tidak Ingin Merubah!</span>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Logo" id="GetFile" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg">
                            <label class="custom-file-label" for="foto">Pilih Logo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Kolom Foto -->

    </div>

    <!-- Awal Tombol -->
    <div class="col-sm-12 text-center mt-2 mb-2">
        <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/perusahaan'); ?>">
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