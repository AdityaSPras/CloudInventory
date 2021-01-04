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
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Nama Paket</th>
                                <th class="text-center">Lama Berlangganan</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($riwayat_pembayaran as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= tgl_indo($data->TanggalPembayaran) ?></td>
                                    <td class="text-center"><?= $data->Nama ?></td>
                                    <td class="text-center"><?= $data->SubBayar ?> Bulan</td>
                                    <td class="text-center"><?= rupiah($data->TotalBayar) ?></td>
                                    <?php if ($data->StatusPembayaran == 'Pending') { ?>
                                        <td class="btn-warning text-center btn-sm">Diproses</td>
                                    <?php } elseif ($data->StatusPembayaran == 'Diterima') { ?>
                                        <td class="btn-success text-center btn-sm">Berhasil</td>
                                    <?php } elseif ($data->StatusPembayaran == 'Ditolak') { ?>
                                        <td class="btn-danger text-center btn-sm">Ditolak</td>
                                    <?php } ?>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/riwayat_pembayaran/" . encrypt_url($data->IdPembayaran) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
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