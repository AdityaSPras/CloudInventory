<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/ubah_paket'); ?>" method="POST" id="formUbahPaket">
                        <div class=" d-sm-flex justify-content-between mb-0">
                            <div class="col-sm-6">
                                <div class="card shadow mb-4">
                                    <div class="card header py-1">
                                        <h5 class="text-center font-weight-bold m-0 text-primary"><?= $paket_dua['Nama']; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-sm" cellspacing="0">
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Jumlah Barang</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_dua['JumlahBarang']; ?> Barang</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Jumlah Karyawan</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_dua['JumlahKaryawan']; ?> Karyawan</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Keterangan</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_dua['Keterangan']; ?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Harga</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= rupiah($paket_dua['Harga']); ?>/Bulan</small>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card shadow mb-4">
                                    <div class="card header py-1">
                                        <h5 class="text-center font-weight-bold m-0 text-primary"><?= $paket_tiga['Nama']; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-sm" cellspacing="0" width="100%">
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Jumlah Barang</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_tiga['JumlahBarang']; ?> Barang</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Jumlah Karyawan</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_tiga['JumlahKaryawan']; ?> Karyawan</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Keterangan</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= $paket_tiga['Keterangan']; ?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">Harga</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold">:</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-dark font-weight-bold"><?= rupiah($paket_tiga['Harga']); ?>/Bulan</small>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pilih Paket</label>
                            <select name="IdPaket" class="form-control" id="getPaket">
                                <option value="">-- Pilih Paket --</option>
                                <?php foreach ($data_paket as $data) : ?>
                                    <option value="<?= encrypt_url($data->IdPaket) ?>"><?= $data->Nama ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('IdPaket', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Harga Bulanan</label>
                            <input class="form-control" name="HargaBulanan" type="number" id="harga" readonly>
                        </div>
                        <div class="form-group">
                            <label>Lama Berlangganan (Bulan)</label>
                            <select class="form-control" name="SubBayar">
                                <option value="">-- Pilih Lama Berlangganan --</option>
                                <option value='1'>1 Bulan</option>
                                <option value='2'>2 Bulan</option>
                                <option value='3'>3 Bulan</option>
                                <option value='4'>4 Bulan</option>
                                <option value='5'>5 Bulan</option>
                                <option value='6'>6 Bulan</option>
                                <option value='7'>7 Bulan</option>
                                <option value='8'>8 Bulan</option>
                                <option value='9'>9 Bulan</option>
                                <option value='10'>10 Bulan</option>
                                <option value='11'>11 Bulan</option>
                                <option value='12'>12 Bulan</option>
                            </select>
                            <?= form_error('SubBayar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('admin/status_paket'); ?>" class="btn btn-warning btn-md btn-icon-split mb-2">
                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                <span class="text text-white">Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-success btn-md btn-icon-split mb-2">
                                <span class="icon text-white"><i class="fas fa-shopping-cart"></i></span>
                                <span class="text text-white">Beli Sekarang</span>
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
        $("#getPaket").change(function() {
            var sts = this.value;
            var url = '<?php echo site_url('admin/getPaket'); ?>/' + sts;
            $.ajax({
                url: url,
                data: $('#formUbahPaket').serialize(),
                type: 'POST',
            }).done(function(data) {
                var obj = JSON.parse(data);
                console.log(obj);
                $('#harga').val(obj.Harga);
            });
        });
    });
</script>