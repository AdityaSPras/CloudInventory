<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <?php if ($jumlah_karyawan < $status_paket['JumlahKaryawan']) : ?>
            <?= redirect('error'); ?>
        <?php else : ?>
            <form action=" <?= base_url() ?>admin/ubah_daftar_karyawan" method="POST">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                        <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <span class="text-danger text-xs">* Centang Data Karyawan Yang Ingin Ditampilkan Pada Daftar Karyawan</span><br>
                                <span class="text-danger text-xs">* Maksimal Data Yang Dapat Ditampilkan Adalah <b>(<?= $status_paket['JumlahKaryawan']; ?> Karyawan)</b></span>
                            </div>

                            <div class="col-sm mb-2 text-right">
                                <a class="btn btn-success btn-md btn-icon-split mb-1" href="<?= base_url('admin/karyawan'); ?>">
                                    <span class="icon text-white"><i class="fas fa-arrow-left"></i></span>
                                    <span class="text text-white">Kembali</span>
                                </a>
                                <button type="submit" class="btn btn-primary btn-md btn-icon-split mb-1">
                                    <span class="icon text-white"><i class="fas fa-save"></i></span>
                                    <span class="text text-white">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Karyawan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tampilkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($daftar_karyawan as $data) { ?>
                                        <tr>
                                            <th class="text-center"><?= $no++ ?>.</th>
                                            <td class="text-center"><?= $data->NamaLengkap ?></td>
                                            <td class="text-center">
                                                <?php if ($data->Status == 'Aktif') { ?>
                                                    <span class="badge rounded-pill bg-success text-white"><?= $data->Status ?></span>
                                                <?php } elseif ($data->Status == 'Tidak Aktif') { ?>
                                                    <span class="badge rounded-pill bg-danger text-white"><?= $data->Status ?></span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="StatusDataUser[]" type="checkbox" <?= ($data->StatusDataUser == 'Aktif' ? 'checked' : '') ?> value="<?= encrypt_url($data->IdUser) ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->