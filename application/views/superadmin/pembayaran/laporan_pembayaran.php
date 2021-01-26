    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12 mb-4" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="col-sm-12 mt-2">
                    <form action=" <?= base_url() ?>superadmin/cetak_pembayaran" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <div class="form-group">
                                    <select name="IdPerusahaan" class="form-control">
                                        <option value="">-- Pilih Perusahaan --</option>
                                        <?php foreach ($daftar_perusahaan as $data) : ?>
                                            <option value="<?= $data->IdPerusahaan ?>"><?= $data->NamaPerusahaan ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm mb-2">
                                <button type="reset" class="btn btn-md btn-secondary btn-icon-split">
                                    <span class="text text-white">Reset</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-undo"></i>
                                    </span>
                                </button>
                            </div>

                            <div class="col-sm mb-2 text-right">
                                <button type="submit" class="btn btn-danger btn-icon-split">
                                    <span class="text text-white">Cetak PDF</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-file-pdf"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Perusahaan</th>
                                    <th class="text-center">Jenis Pembayaran</th>
                                    <th class="text-center">Tanggal Pembayaran</th>
                                    <th class="text-center">Nama Paket</th>
                                    <th class="text-center">Lama Berlangganan</th>
                                    <th class="text-center">Harga Bulanan</th>
                                    <th class="text-center">Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($daftar_pembayaran as $data) { ?>
                                    <tr>
                                        <th class="text-center"><?= $no++ ?>.</th>
                                        <td class="text-center"><?= $data->NamaPerusahaan ?></td>
                                        <td class="text-center"><?= $data->TipePembayaran ?></td>
                                        <td class="text-center"><?= tgl_indo($data->TanggalPembayaran) ?></td>
                                        <td class="text-center"><?= $data->Nama ?></td>
                                        <td class="text-center"><?= $data->SubBayar ?> Bulan</td>
                                        <td class="text-center"><?= rupiah($data->HargaBulanan) ?></td>
                                        <td class="text-center"><?= rupiah($data->TotalBayar) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->