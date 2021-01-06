    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12 mb-4" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center">Riwayat <?= $title; ?></h4>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                            <thead>
                                <?php if ($riwayat_pembayaran == NULL) : ?>
                                    <h6 class="text-center m-0 font-weight-bold text-danger mt-5 mb-5">BELUM ADA TRANSAKSI PEMBAYARAN PAKET!</h6>
                                    <div class="col-sm-12 text-center mt-5">
                                        <a href="<?= base_url('admin/status_paket'); ?>" class="btn btn-success btn-md btn-icon-split">
                                            <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                            <span class="text text-white">Kembali</span>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Paket</th>
                                        <th class="text-center">Lama Berlangganan</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Tipe Pembayaran</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                    foreach ($riwayat_pembayaran as $data) { ?>
                                    <tr>
                                        <th class="text-center"><?= $no++ ?>.</th>
                                        <td class="text-center"><?= $data->Nama ?></td>
                                        <td class="text-center"><?= $data->SubBayar ?> Bulan</td>
                                        <td class="text-center"><?= rupiah($data->TotalBayar) ?></td>
                                        <td class="text-center">
                                            <?php if ($data->TipePembayaran == 'Baru') { ?>
                                                <span class="badge rounded-pill bg-primary text-white">Pembelian Baru</span>
                                            <?php } elseif ($data->TipePembayaran == 'Perpanjang') { ?>
                                                <span class="badge rounded-pill bg-info text-white">Perpanjang Paket</span>
                                            <?php } ?>
                                        </td>
                                        <?php if ($data->BuktiPembayaran == 'default_payment.PNG') { ?>
                                            <td class="btn-danger text-center btn-sm">Menunggu Pembayaran</td>
                                        <?php } else { ?>
                                            <?php if ($data->StatusPembayaran == 'Pending') { ?>
                                                <td class="btn-warning text-center btn-sm">Diproses</td>
                                            <?php } else { ?>
                                                <td class="btn-success text-center btn-sm">Berhasil</td>
                                            <?php } ?>
                                        <?php } ?>
                                        <td class="text-center">
                                            <?php if ($data->BuktiPembayaran == 'default_payment.PNG') { ?>
                                            <?php } else { ?>
                                                <a href="#" class="btn btn-info btn-sm mb-1">Detail</a>
                                            <?php } ?>
                                            <?php if ($data->BuktiPembayaran == 'default_payment.PNG') { ?>
                                                <a href="#" class="btn btn-warning btn-sm mb-1">Bayar Sekarang</a>
                                            <?php } else { ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php endif; ?>
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