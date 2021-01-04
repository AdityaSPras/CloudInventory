<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
            <?php if ($jumlah_karyawan >= $status_paket['JumlahKaryawan']) { ?>
                <div class="col-sm-12 text-center">
                    <span class="badge rounded-pill bg-danger text-white">Kuota Karyawan Sudah Penuh!</span>
                </div>
            <?php } else { ?>
                <div class="col-sm-12 mt-2">
                    <a href="<?= base_url('admin/tambah_karyawan'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                        <span class="text text-white">Tambah <?= $title; ?></span>
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </div>
            <?php } ?>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="30%" class="text-center">Nama Karyawan</th>
                                <th width="15%" class="text-center">Foto</th>
                                <th width="20%" class="text-center">Nomor Handphone</th>
                                <th width="15%" class="text-center">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_karyawan as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaLengkap ?></td>
                                    <td class="text-center"><img src="<?= base_url('assets/img/users/') . $data->Foto ?>" alt="" width="55px"></td>
                                    <td class="text-center">
                                        <?php if ($data->NomorTelepon == '') : ?>
                                            <i> (Kosong) </i>
                                        <?php else : ?>
                                            <?= $data->NomorTelepon ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->Status == 'Aktif') { ?>
                                            <span class="badge rounded-pill bg-success text-white"><?= $data->Status ?></span>
                                        <?php } elseif ($data->Status == 'Tidak Aktif') { ?>
                                            <span class="badge rounded-pill bg-danger text-white"><?= $data->Status ?></span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("admin/detail_karyawan/" . encrypt_url($data->IdUser) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="<?= base_url("admin/ubah_karyawan/" . encrypt_url($data->IdUser) . "") ?>" class="btn btn-circle btn-warning btn-sm mb-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" onclick="hapus_karyawan('<?= encrypt_url($data->IdUser) ?>')" id="hapus_karyawan" class="btn btn-circle btn-danger btn-sm mb-1">
                                            <i class="fas fa-trash"></i>
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