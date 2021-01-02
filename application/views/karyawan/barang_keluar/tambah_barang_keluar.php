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
                    <form action="<?= base_url('karyawan/tambah_barang_keluar'); ?>" method="POST" id="formBarangKeluar">
                        <div class="form-group">
                            <label>Tanggal Keluar</label>
                            <input class="form-control" name="TanggalKeluar" type="date">
                            <?= form_error('TanggalKeluar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <?php if ($jumlah_barang > 0) : ?>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="IdBarang" class="form-control" id="getBarang">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach ($data_barang as $data) : ?>
                                        <option value="<?= encrypt_url($data->IdBarang) ?>"><?= $data->NamaBarang ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('IdBarang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="hidden" name="IdBarang">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Barang!)</i></span>
                                    <a href="<?= base_url() ?>admin/barang" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input class="form-control" name="HargaKeluar" type="number" id="harga" readonly>
                            <?= form_error('HargaKeluar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class=" form-group">
                            <label>Jumlah Keluar</label>
                            <input class="form-control" name="JumlahKeluar" type="number">
                            <?= form_error('JumlahKeluar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('karyawan/barang_keluar'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
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

<script src="<?= base_url('assets'); ?>/jquery/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#getBarang").change(function() {
            var sts = this.value;
            var url = '<?php echo site_url('karyawan/getBarang'); ?>/' + sts;
            $.ajax({
                url: url,
                data: $('#formBarangKeluar').serialize(),
                type: 'POST',
            }).done(function(data) {
                var obj = JSON.parse(data);
                console.log(obj);
                $('#harga').val(obj.HargaJual);
            });
        });
    });
</script>