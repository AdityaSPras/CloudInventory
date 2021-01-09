<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/perpanjang_paket'); ?>" method="POST">
                        <input name="IdPaket" type="hidden" value="<?= $status_paket['IdPaket']; ?>">
                        <input name="HargaBulanan" type="hidden" value="<?= $status_paket['Harga']; ?>">
                        <div class="form-group">
                            <label>Paket Saat Ini</label>
                            <input class="form-control" type="text" value="<?= $status_paket["Nama"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Biaya Perpanjang (Per Bulan)</label>
                            <input class="form-control" type="text" value="<?= $status_paket["Harga"] - 5000; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Lama Perpanjang Paket (Bulan)</label>
                            <select class="form-control" name="SubBayar">
                                <option value="">-- Pilih Perpanjang Paket --</option>
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
                                <span class="text text-white">Perpanjang Sekarang</span>
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