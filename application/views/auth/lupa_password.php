<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="user-flash-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
        <div class="user-flash-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>


        <div class="col-lg-8 my-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-2">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-sm">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="h5 text-gray-900 mb-0"><b>Lupa Password Anda?</b></div>
                                </div>
                                <hr>
                                <form class="user" method="POST" action="<?= base_url('auth/lupapassword'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user text-center" id="email" name="Email" placeholder="Masukkan Email" value="<?= set_value('Email'); ?>">
                                        <?= form_error('Email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/login'); ?>">Kembali Ke Halaman Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>