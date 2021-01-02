<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

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
                                <th width="25%" class="text-center">Nama Perusahaan</th>
                                <th width="25%" class="text-center">Nama Admin</th>
                                <th width="20%" class="text-center">Email Admin</th>
                                <th width="15%" class="text-center">Paket</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($perusahaan as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= $data->NamaPerusahaan ?></td>
                                    <td class="text-center"><?= $data->NamaLengkap ?></td>
                                    <td class="text-center"><?= $data->Email ?></td>
                                    <?php if ($data->Nama == 'Gratis') { ?>
                                        <td class="btn-primary text-center btn-sm">Gratis</td>
                                    <?php } elseif ($data->Nama == 'Premium') { ?>
                                        <td class="btn-success text-center btn-sm">Premium</td>
                                    <?php } elseif ($data->Nama == 'Enterprise') { ?>
                                        <td class="btn-warning text-center btn-sm">Enterprise</td>
                                    <?php } ?>
                                    <td class="text-center">
                                        <a href="<?= base_url("superadmin/detail_perusahaan/" . encrypt_url($data->IdPerusahaan) . "") ?>" class="btn btn-circle btn-info btn-sm">
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