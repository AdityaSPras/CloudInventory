<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <?php if ($detail_pembayaran == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_pembayaran as $data) : ?>
                            <div class="row text-xl-left">
                                <div class="col-sm-4 p-3 m-auto">
                                    <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/payments/') . $data->BuktiPembayaran ?>" class="rounded m-auto">
                                </div>
                                <div class="mt-sm-1 col-sm-8 offset-sm-0">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            <tr>
                                                <th>Pembelian Paket</th>
                                                <th>:</th>
                                                <td><?= $data->Nama ?></td>
                                            </tr>
                                            <tr>
                                                <th>Lama Berlangganan</th>
                                                <th>:</th>
                                                <td><?= $data->SubBayar ?> Bulan</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Bank</th>
                                                <th>:</th>
                                                <td><?= $data->NamaBank ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Rekening</th>
                                                <th>:</th>
                                                <td><?= $data->NomorRekening ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Atas Nama</th>
                                                <th>:</th>
                                                <td><?= $data->NamaPemilikRekening ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pembayaran</th>
                                                <th>:</th>
                                                <td><?= tgl_indo($data->TanggalPembayaran) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total Bayar</th>
                                                <th>:</th>
                                                <td><?= rupiah($data->TotalBayar) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tipe Pembayaran</th>
                                                <th>:</th>
                                                <td>
                                                    <?php if ($data->TipePembayaran == 'Baru') { ?>
                                                        <span class="badge rounded-pill bg-primary text-white">Pembelian Paket Baru</span>
                                                    <?php } elseif ($data->TipePembayaran == 'Perpanjang') { ?>
                                                        <span class="badge rounded-pill bg-info text-white">Perpanjang Paket</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php if ($data->StatusPembayaran == 'Pending') { ?>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>:</th>
                                                    <td><span class="badge rounded-pill bg-warning text-white">Pembayaran Sedang Diproses</span></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <th>Masa Aktif Paket</th>
                                                    <th>:</th>
                                                    <td><?= tgl_indo($data->AwalAktif) ?> - <?= tgl_indo($data->AkhirAktif) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <a href="<?= base_url('admin/riwayat_pembayaran'); ?>" class="btn btn-success btn-md btn-icon-split mb-2">
                                                <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                                <span class="text text-white">Kembali</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->