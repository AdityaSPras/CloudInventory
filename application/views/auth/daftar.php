<div class="container">

    <div class="card o-hidden border-0 shadow-sm my-3 col-sm-9 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-sm">
                    <div class="p-5">
                        <div class="text-center">
                            <div class="h4 text-gray-900"><b>Registrasi Layanan</b></div>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('auth/registration'); ?>">
                            <hr>
                            <p class="text-center text-dark">Data Perusahaan</p>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="namaperusahaan" name="NamaPerusahaan" placeholder="Masukkan Nama Perusahaan" value="<?= set_value('NamaPerusahaan'); ?>">
                                <?= form_error('NamaPerusahaan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="namapemilik" name="NamaPemilik" placeholder="Masukkan Nama Pemilik Perusahaan" value="<?= set_value('NamaPemilik'); ?>">
                                <?= form_error('NamaPemilik', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-sm" id="nomorteleponperusahaan" name="NomorTeleponPerusahaan" placeholder="Masukkan Nomor Telepon Perusahaan" value="<?= set_value('NomorTeleponPerusahaan'); ?>">
                                <?= form_error('NomorTeleponPerusahaan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="emailperusahaan" name="EmailPerusahaan" placeholder="Masukkan Email Perusahaan" value="<?= set_value('EmailPerusahaan'); ?>">
                                <?= form_error('EmailPerusahaan', '<small class="text-danger text-center">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <textarea rows="3" class="form-control form-control-sm" id="alamatperusahaan" name="AlamatPerusahaan" placeholder="Masukkan Alamat Perusahaan"><?= set_value('AlamatPerusahaan'); ?></textarea>
                                <?= form_error('AlamatPerusahaan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <hr>
                            <p class="text-center text-dark">Data Admin Perusahaan</p>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="namalengkap" name="NamaLengkap" placeholder="Masukkan Nama Admin" value="<?= set_value('NamaLengkap'); ?>">
                                <?= form_error('NamaLengkap', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="email" name="Email" placeholder="Masukkan Email Admin" value="<?= set_value('Email'); ?>">
                                <?= form_error('Email', '<small class="text-danger text-center">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-sm" id="password1" name="Password1" placeholder="Masukkan Password">
                                    <?= form_error('Password1', '<small class="text-danger text-center">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-sm" id="password2" name="Password2" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftar
                            </button><br>
                            <div class="text-center"><a class="small" href="<?= base_url('auth/login'); ?>">Sudah Punya Akun, Login!</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>