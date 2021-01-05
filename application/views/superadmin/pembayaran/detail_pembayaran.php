<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <?php foreach ($detail_pembayaran as $data) : ?>
                        <div class="row text-xl-left">
                            <div class="col-sm-4 p-3 m-auto">
                                <?php if ($data->BuktiPembayaran == '') : ?>
                                    <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/payments/default_payment.PNG') ?>" class="rounded m-auto">
                                <?php else : ?>
                                    <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/payments/') . $data->BuktiPembayaran ?>" class="rounded m-auto">
                                <?php endif; ?>
                            </div>
                            <div class="mt-sm-1 col-sm-8 offset-sm-0">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                        <tr>
                                            <th width="25%">Nama Perusahaan</th>
                                            <th width="5%">:</th>
                                            <td width="70%"><?= $data->NamaPerusahaan ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Admin</th>
                                            <th>:</th>
                                            <td><?= $data->NamaLengkap ?></td>
                                        </tr>
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
                                            <th>Total Bayar</th>
                                            <th>:</th>
                                            <td><?= rupiah($data->TotalBayar) ?></td>
                                        </tr>
                                        <?php if ($data->BuktiPembayaran == '') : ?>
                                        <?php else : ?>
                                            <tr>
                                                <th>Tanggal Pembayaran</th>
                                                <th>:</th>
                                                <td><?= tgl_indo($data->TanggalPembayaran) ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <a href="<?= base_url('superadmin/daftar_pembayaran'); ?>" class="btn btn-success btn-md btn-icon-split mb-2">
                                            <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                            <span class="text text-white">Kembali</span>
                                        </a>
                                        <?php if ($data->StatusPembayaran == "Pending") : ?>
                                            <a href="<?= base_url("superadmin/konfirmasi_pembayaran/" . $data->IdPembayaran . "/" . $data->IdPerusahaan . "/" . $data->IdPaket . "/" . $data->IdUser); ?>" class="btn btn-danger btn-md btn-icon-split mb-2">
                                                <span class="icon text-white"><i class="fas fa-check-circle"></i></span>
                                                <span class="text text-white">Konfirmasi</span>
                                            </a>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->