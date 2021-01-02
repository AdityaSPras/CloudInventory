<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-8 my-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-2">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-sm">
                            <div class="p-5">
                                <div class="text-center">

                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="h5 text-gray-900 mb-0"><b>Ubah Password Anda</b></div>
                                </div>
                                <hr>
                                <form class="user" method="POST" action="<?= base_url('auth/gantipassword'); ?>">
                                    <div class=" form-group">
                                        <input type="password" class="form-control form-control-user text-center" id="password1" name="Password1" placeholder="Masukkan Password Baru">
                                        <?= form_error('Password1', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class=" form-group">
                                        <input type="password" class="form-control form-control-user text-center" id="password2" name="Password2" placeholder="Masukkan Konfirmasi Password">
                                        <?= form_error('Password2', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Ganti Password</button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>