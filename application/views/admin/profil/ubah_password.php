<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="warning-flash-admin" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>
    <div class="error-flash-admin" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/ubah_password'); ?>" method="POST">
                        <div class="form-group">
                            <label for="PasswordLama">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwordlama" name="PasswordLama">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-light">
                                        <a href="#" class="text-gray-700" id="show-pass1">
                                            <i class="fas fa-eye" id="icon1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('PasswordLama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="PasswordBaru">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwordbaru" name="PasswordBaru">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-light">
                                        <a href="#" class="text-gray-700" id="show-pass2">
                                            <i class="fas fa-eye" id="icon2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('PasswordBaru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="KonfirmasiPassword">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="konfirmasipassword" name="KonfirmasiPassword">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-light">
                                        <a href="#" class="text-gray-700" id="show-pass3">
                                            <i class="fas fa-eye" id="icon3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('KonfirmasiPassword', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('admin/profil'); ?>" class="btn btn-success btn-md btn-icon-split mb-2">
                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                <span class="text text-white">Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-warning btn-md btn-icon-split mb-2">
                                <span class="icon text-white"><i class="fas fa-save"></i></span>
                                <span class="text text-white">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->