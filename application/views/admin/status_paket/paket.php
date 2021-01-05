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
                    <form action="<?= base_url('admin/ubah_paket'); ?>" method="POST">
                        <div class="form-group">
                            <label>Pilih Paket</label>
                            <select name="IdPaket" class="form-control">
                                <?php foreach ($data_paket as $data) : ?>
                                    <option value="<?= encrypt_url($data->IdPaket) ?>"><?= $data->Nama ?> | <?= $data->JumlahBarang ?> Barang | <?= $data->JumlahKaryawan ?> Karyawan | <?= rupiah($data->Harga) ?>/Bulan</option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('IdPaket', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Lama Berlangganan (Bulan)</label>
                            <input class="form-control" name="SubBayar" type="number" min="1" max="12">
                            <?= form_error('SubBayar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('admin/status_paket'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
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