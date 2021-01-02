<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-2">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">

                                    <div class="user-flash-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
                                    <div class="user-flash-warning" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>
                                    <div class="user-flash-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

                                    <div class="h4 text-gray-900 mb-0"><b>CLOUD INVENTORY</b>
                                        <p></p>
                                        <p><img src="<?= base_url('assets'); ?>/img/Icon.png" width="125px" height="100px"></p>
                                    </div>
                                </div>
                                <hr>
                                <form class="user" method="POST" action="<?= base_url('auth/login'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user text-center" id="email" name="Email" placeholder="Masukkan Email" value="<?= set_value('Email'); ?>">
                                        <?= form_error('Email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class=" form-group">
                                        <input type="password" class="form-control form-control-user text-center" id="password" name="Password" placeholder="Masukkan Password">
                                        <?= form_error('Password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/lupapassword'); ?>">Lupa Password?</a><br>
                                    <a class="small" href="<?= base_url('auth/registration'); ?>">Belum Punya Akun, Daftar Sekarang!</a><br>
                                    <a class="small" href="<?= base_url('home'); ?>">Kembali Ke Halaman Depan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>