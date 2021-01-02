<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('karyawan/tambah_satuan'); ?>" method="POST">
                        <div class="form-group">
                            <label>Nama Satuan Barang:</label>
                            <input type="text" class="form-control" id="namasatuan" name="NamaSatuan">
                            <?= form_error('NamaSatuan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Keterangan:</label>
                            <textarea class="form-control" id="keterangan" name="Keterangan" rows="5"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('karyawan/satuan'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
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