<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <div class="row text-xl-left">
                        <div class="col-sm-4 p-3 m-auto">
                            <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/company/') . $perusahaan['Logo']; ?>" class="rounded m-auto">
                        </div>
                        <div class="mt-sm-1 col-sm-8 offset-sm-0">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <th width="25%">Nama Perusahaan</th>
                                        <th width="5%">:</th>
                                        <td width="70%"><?= $perusahaan['NamaPerusahaan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pemilik Perusahaan</th>
                                        <th>:</th>
                                        <td><?= $perusahaan['NamaPemilik']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <td><?= $perusahaan['AlamatPerusahaan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <td><?= $perusahaan['EmailPerusahaan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <th>:</th>
                                        <td><?= $perusahaan['NomorTeleponPerusahaan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <th>:</th>
                                        <td><?= $perusahaan['Fax']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 text-right mt-4">
                                    <a href="<?= base_url('karyawan/profil'); ?>" class="btn btn-success btn-md btn-icon-split">
                                        <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                        <span class="text text-white">Kembali</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->