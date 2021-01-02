<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="error-flash-admin" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <!-- Page Heading -->
    <div class="col-sm-12">
        <div class="card shadow mb-1">
            <div class="card-header py-3">
                <h4 class="font-weight-bold text-primary text-center"><?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
        </div>
    </div>

    <div class="d-sm-flex justify-content-between mb-0">

        <div class="col-sm-8 mb-4">
            <?= form_open_multipart('admin/tambah_barang'); ?>
            <div class="card shadow mb-4">
                <div class="card-body py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Form Barang</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input class="form-control" name="NamaBarang" type="text">
                            <?= form_error('NamaBarang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Stok Awal Barang</label>
                            <input class="form-control" name="Stok" type="number">
                            <?= form_error('Stok', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Stok Minimum Barang</label>
                            <input class="form-control" name="StokMinimum" type="number">
                            <?= form_error('StokMinimum', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Harga Jual Satuan</label>
                            <input class="form-control" name="HargaJual" type="number">
                            <?= form_error('HargaJual', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <?php if ($jumlah_kategori > 0) : ?>
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <select name="IdKategori" class="form-control">
                                    <option value="">-- Pilih Kategori Barang --</option>
                                    <?php foreach ($data_kategori as $data) : ?>
                                        <option value="<?= encrypt_url($data->IdKategori) ?>"><?= $data->NamaKategori ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('IdKategori', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <input type="hidden" name="IdKategori">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Kategori Barang!)</i></span>
                                    <a href="<?= base_url() ?>admin/kategori" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($jumlah_satuan > 0) : ?>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <select name="IdSatuan" class="form-control">
                                    <option value="">-- Pilih Satuan Barang --</option>
                                    <?php foreach ($data_satuan as $data) : ?>
                                        <option value="<?= encrypt_url($data->IdSatuan) ?>"><?= $data->NamaSatuan ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('IdSatuan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <input type="hidden" name="IdSatuan">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Satuan Barang!)</i></span>
                                    <a href="<?= base_url() ?>admin/satuan" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card shadow mb-1">
                <div class="card-body py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Gambar</h6>
                </div>
                <div class="card-body">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Format Gambar:
                            <div class="text-white-45 small">.png .jpeg .jpg<br>(Maks. 2MB)</div>
                        </div>
                    </div>
                    <div class="text-center mb-4 mt-4">
                        <img src="<?= base_url() ?>assets/img/items/items_default.png" id="outputImg" width="200" maxheight="300">
                    </div>
                    <span class="text-danger text-xs">*Kosongkan Jika Tidak Ingin Menambah Gambar Barang!</span>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Gambar" id="GetFile" onchange="VerifyFileNameAndFileSize()" accept=".png,.jpeg,.jpg">
                            <label class="custom-file-label" for="Gambar">Pilih Gambar</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Awal Tombol -->
    <div class="col-sm-12 text-center mt-2 mb-2">
        <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/barang'); ?>">
            <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
            <span class="text text-white">Kembali</span>
        </a>
        <button type="submit" class="btn btn-warning btn-md btn-icon-split mb-1">
            <span class="icon text-white"><i class="fas fa-save"></i></span>
            <span class="text text-white">Simpan</span>
        </button>
    </div>
    <!-- Akhir Tombol -->

    </form>
    <!-- Akhir Form -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->