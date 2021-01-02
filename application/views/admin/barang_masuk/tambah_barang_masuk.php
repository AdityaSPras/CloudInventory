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
                    <form action="<?= base_url('admin/tambah_barang_masuk'); ?>" method="POST" id="formBarangMasuk">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input class="form-control" name="TanggalMasuk" type="date">
                            <?= form_error('TanggalMasuk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <?php if ($jumlah_barang > 0) : ?>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="IdBarang" class="form-control chosen" id="getBarang">
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
                        <?php if ($jumlah_supplier > 0) : ?>
                            <div class="form-group">
                                <label>Supplier Barang</label>
                                <select name="IdSupplier" class="form-control chosen">
                                    <option value="">-- Pilih Supplier Barang --</option>
                                    <?php foreach ($data_supplier as $data) : ?>
                                        <option value="<?= encrypt_url($data->IdSupplier) ?>"><?= $data->NamaSupplier ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('IdSupplier', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label>Supplier Barang</label>
                                <input type="hidden" name="IdSupplier">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Supplier Barang!)</i></span>
                                    <a href="<?= base_url() ?>admin/supplier" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Total Harga Masuk</label>
                            <input class="form-control" name="HargaMasuk" type="number">
                            <?= form_error('HargaMasuk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Masuk Satuan</label>
                            <input class="form-control" name="JumlahMasuk" type="number">
                            <?= form_error('JumlahMasuk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('admin/barang_masuk'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
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
<script src="<?= base_url('assets'); ?>/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets'); ?>/chosen/chosen.jquery.min.js"></script>