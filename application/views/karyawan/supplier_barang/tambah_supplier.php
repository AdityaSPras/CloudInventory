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
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('karyawan/tambah_supplier'); ?>" method="POST">
                        <div class="form-group">
                            <label>Nama Supplier:</label>
                            <input type="text" class="form-control" id="namasupplier" name="NamaSupplier" value="<?= set_value('NamaSupplier'); ?>">
                            <?= form_error('NamaSupplier', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat Supplier:</label>
                            <textarea class="form-control" id="alamatsupplier" name="AlamatSupplier" rows="3"><?= set_value('AlamatSupplier'); ?></textarea>
                            <?= form_error('AlamatSupplier', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon Supplier:</label>
                            <input type="text" class="form-control" id="nomorteleponsupplier" name="NomorTeleponSupplier" value="<?= set_value('NomorTeleponSupplier'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Supplier:</label>
                            <input type="text" class="form-control" id="emailsupplier" name="EmailSupplier" value="<?= set_value('EmailSupplier'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan Supplier:</label>
                            <textarea class="form-control" id="keterangan" name="Keterangan" rows="2"><?= set_value('Keterangan'); ?></textarea>
                            <?= form_error('Keterangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('karyawan/supplier'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                <span class="text text-white">Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-success btn-md btn-icon-split mb-2">
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