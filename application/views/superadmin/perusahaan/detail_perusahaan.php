<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <?php if ($detail_perusahaan == NULL) : ?>
                        <?= redirect('error'); ?>
                    <?php else : ?>
                        <?php foreach ($detail_perusahaan as $data) : ?>
                            <div class="row text-xl-left">
                                <div class="col-sm-4 p-3 m-auto">
                                    <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/company/') . $data->Logo ?>" class="rounded m-auto">
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
                                                <th>Nama Pemilik</th>
                                                <th>:</th>
                                                <td><?= $data->NamaPemilik ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <th>:</th>
                                                <td><?= $data->AlamatPerusahaan ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Telepon</th>
                                                <th>:</th>
                                                <td><?= $data->NomorTeleponPerusahaan ?></td>
                                            </tr>
                                            <tr>
                                                <th>Fax</th>
                                                <th>:</th>
                                                <td>
                                                    <?php if ($data->Fax == '') : ?>
                                                        <i> (Kosong) </i>
                                                    <?php else : ?>
                                                        <?= $data->Fax ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email Perusahaan</th>
                                                <th>:</th>
                                                <td><?= $data->EmailPerusahaan ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Admin</th>
                                                <th>:</th>
                                                <td><?= $data->NamaLengkap ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email Admin</th>
                                                <th>:</th>
                                                <td><?= $data->Email ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Admin</th>
                                                <th>:</th>
                                                <td>
                                                    <?php if ($data->Status == 'Aktif') : ?>
                                                        <span class="badge rounded-pill bg-success text-white">Aktif</span>
                                                    <?php else : ?>
                                                        <span class="badge rounded-pill bg-danger text-white">Tidak Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Paket Perusahaan</th>
                                                <th>:</th>
                                                <td><?= $data->Nama ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <a href="<?= base_url('superadmin/perusahaan'); ?>" class="btn btn-success btn-md btn-icon-split">
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