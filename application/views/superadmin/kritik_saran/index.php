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
                                <th width="40%" class="text-center">Pesan</th>
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
                                        <?= $data->Pesan ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->Balasan == '') : ?>
                                            <a href="#" data-toggle="modal" data-target="#balasKritikSaran<?= encrypt_url($data->IdKritikSaran) ?>" class="btn btn-circle btn-primary btn-sm mb-1">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                        <?php else : ?>
                                        <?php endif; ?>
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

<!-- Awal Modal Balasan Kritik & Saran -->
<?php $no = 0;
foreach ($kritik_saran as $data) : $no++; ?>
    <div class="modal fade" id="balasKritikSaran<?= encrypt_url($data->IdKritikSaran) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?= base_url() ?>superadmin/balas_kritik_saran" name="formSuperadminBalasan" method="POST" onsubmit="return validasiSuperadminBalasan()">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Balasan Kritik & Saran</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Isi Balasan</label>
                            <input type="hidden" name="IdKritikSaran" class="form-control" value="<?= encrypt_url($data->IdKritikSaran) ?>">
                            <textarea class="form-control" name="Balasan" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <span class="text text-white">Kirim</span>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon-split" data-dismiss="modal">
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="text text-white">Batal</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endforeach; ?>
<!-- Akhir Modal Balasan Kritik & Saran -->