<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-super-admin" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="40%" class="text-center">Nama Pengguna</th>
                                <th width="40%" class="text-center">Nama Perusahaan</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kritik_saran as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center">
                                        <?php if ($data->NamaLengkap == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">User Telah Dihapus</span>
                                        <?php else : ?>
                                            <?= $data->NamaLengkap ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->NamaPerusahaan == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Perusahaan Telah Dihapus</span>
                                        <?php else : ?>
                                            <?= $data->NamaPerusahaan ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("superadmin/detail_kritik_saran/" . encrypt_url($data->IdKritikSaran) . "") ?>" class="btn btn-circle btn-info btn-sm mb-1">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="#" onclick="hapus_kritik_saran('<?= encrypt_url($data->IdKritikSaran) ?>')" id="hapus_kritik_saran" class="btn btn-circle btn-danger btn-sm mb-1">
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