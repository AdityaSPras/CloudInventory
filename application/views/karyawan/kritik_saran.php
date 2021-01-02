<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Awal Pesan -->
    <div class="row">
        <div class="col-md-12 text-center">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <!-- Akhir Pesan -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('karyawan/kritik_saran'); ?>" method="POST">
                        <div class="form-group">
                            <label for="Pesan">Pesan:</label>
                            <textarea class="form-control" id="pesan" name="Pesan" rows="6"></textarea>
                            <?= form_error('Pesan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <button type="reset" class="btn btn-warning btn-md btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-eraser"></i></span>
                                <span class="text text-white">Reset</span>
                            </button>
                            <button type="submit" class="btn btn-success btn-md btn-icon-split">
                                <span class="icon text-white"><i class="fas fa-save"></i></span>
                                <span class="text text-white">Kirim</span>
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