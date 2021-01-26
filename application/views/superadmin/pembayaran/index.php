<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-super-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="<?= base_url('superadmin/laporan_pembayaran'); ?>" class="btn btn-sm btn-success btn-icon-split">
                    <span class="text text-white">Laporan <?= $title; ?></span>
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Perusahaan</th>
                                <th class="text-center">Nama Paket</th>
                                <th class="text-center">Lama Berlangganan</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Pembayaran</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_pembayaran as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaPerusahaan ?></td>
                                    <td class="text-center"><?= $data->Nama ?></td>
                                    <td class="text-center"><?= $data->SubBayar ?> Bulan</td>
                                    <td class="text-center"><?= rupiah($data->TotalBayar) ?></td>
                                    <td class="text-center">
                                        <?php if ($data->TipePembayaran == 'Baru') { ?>
                                            <span class="badge rounded-pill bg-primary text-white">Baru</span>
                                        <?php } elseif ($data->TipePembayaran == 'Perpanjang') { ?>
                                            <span class="badge rounded-pill bg-info text-white">Perpanjang</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->BuktiPembayaran == 'default_payment.PNG') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Belum Dibayar</span>
                                        <?php else : ?>
                                            <span class="badge rounded-pill bg-success text-white">Sudah Dibayar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->BuktiPembayaran == 'default_payment.PNG') : ?>
                                            <?php if (time() - $data->TanggalTransaksi < (60 * 60 * 24)) { ?>
                                                <small><i>(Belum Dibayar)</i></small>
                                            <?php } else { ?>
                                                <span class="badge rounded-pill bg-danger text-white">Expired</span>
                                            <?php } ?>
                                        <?php else : ?>
                                            <?php if ($data->StatusPembayaran == 'Pending') { ?>
                                                <span class="badge rounded-pill bg-warning text-white">Belum Dikonfirmasi</span>
                                            <?php } elseif ($data->StatusPembayaran == 'Diterima') { ?>
                                                <span class="badge rounded-pill bg-success text-white">Sudah Dikonfirmasi</span>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("superadmin/detail_pembayaran/" . encrypt_url($data->IdPembayaran) . "") ?>" class="btn btn-info btn-sm mb-1">Detail</a>
                                        <?php if (time() - $data->TanggalTransaksi > (60 * 60 * 24) && $data->BuktiPembayaran == 'default_payment.PNG') { ?>
                                            <a href="#" onclick="hapus_pembayaran('<?= encrypt_url($data->IdPembayaran) ?>')" id="hapus_pembayaran" class="btn btn-danger btn-sm mb-1">Hapus</a>
                                        <?php } else { ?>
                                        <?php } ?>
                                        <?php if ($data->BuktiPembayaran == 'default_payment.PNG') : ?>
                                        <?php else : ?>
                                            <?php if ($data->StatusPembayaran == 'Diterima') : ?>
                                            <?php else : ?>
                                                <a href="<?= base_url("superadmin/konfirmasi_pembayaran/" . $data->IdPembayaran . "/" . $data->IdPerusahaan . "/" . $data->IdPaket . "/" . $data->IdUser); ?>" class="btn btn-danger btn-sm mb-1">Konfirmasi</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
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