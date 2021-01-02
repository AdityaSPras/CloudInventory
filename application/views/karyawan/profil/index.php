<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="success-flash-karyawan" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                </div>
                <div class="card-body p-4">
                    <div class="row text-xl-left">
                        <div class="col-sm-4 p-3 m-auto">
                            <img style="max-width: 200px; min-width: 200px; display: block;" src="<?= base_url('assets/img/users/') . $user['Foto']; ?>" class="rounded m-auto">
                        </div>
                        <div class="mt-sm-1 col-sm-8 offset-sm-0">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <th width="25%">Nama</th>
                                        <th width="5%">:</th>
                                        <td width="70%"><?= $user['NamaLengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <td><?= $user['Email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <th>:</th>
                                        <td>
                                            <?php if ($user['JenisKelamin'] == '') : ?>
                                                <i> (Kosong) </i>
                                            <?php else : ?>
                                                <?= $user['JenisKelamin']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <th>:</th>
                                        <td>
                                            <?php if ($user['NomorTelepon'] == '') : ?>
                                                <i> (Kosong) </i>
                                            <?php else : ?>
                                                <?= $user['NomorTelepon']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th>:</th>
                                        <td>
                                            <?php if ($user['Alamat'] == '') : ?>
                                                <i> (Kosong) </i>
                                            <?php else : ?>
                                                <?= $user['Alamat']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>:</th>
                                        <td><?= $user['Level']; ?> (<?= $profil['NamaPerusahaan']; ?>)</td>
                                    </tr>
                                    <tr>
                                        <th>Terdaftar</th>
                                        <th>:</th>
                                        <td><?= tgl_indo(date('Y-m-d', $user['TanggalDibuat'])); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 text-center mt-4">
                                    <a class="btn btn-secondary btn-icon-split mb-2 btn-md" href="<?= base_url('karyawan/ubah_profil'); ?>">
                                        <span class="icon text-white"><i class="fas fa-user"></i></span>
                                        <span class="text text-white">Ubah Profil</span>
                                    </a>
                                    <a class="btn btn-warning btn-icon-split mb-2 btn-md" href="<?= base_url('karyawan/ubah_password'); ?>">
                                        <span class="icon text-white"><i class="fas fa-key"></i></span>
                                        <span class="text text-white">Ubah Password</span>
                                    </a>
                                    <a class="btn btn-info btn-icon-split mb-2 btn-md" href="<?= base_url('karyawan/perusahaan'); ?>">
                                        <span class="icon text-white"><i class="fas fa-building"></i></span>
                                        <span class="text text-white">Profil Perusahaan</span>
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