<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-karyawan" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="<?= base_url('karyawan/kirim_kritik_saran'); ?>" class="btn btn-sm btn-warning btn-icon-split">
                    <span class="text text-white">Kirim <?= $title; ?></span>
                    <span class="icon text-white-50">
                        <i class="fas fa-grin"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Tanggal Kirim Pesan</th>
                                <th class="text-center">Balasan</th>
                                <th class="text-center">Tanggal Balasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_kritik_saran as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->Pesan ?></td>
                                    <td class="text-center"><?= tgl_indo(date('Y-m-d', $data->TanggalPesan)); ?></td>
                                    <td class="text-center">
                                        <?php if ($data->Balasan == '') : ?>
                                            <i> (Belum Ada Balasan) </i>
                                        <?php else : ?>
                                            <?= $data->Balasan ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->TanggalBalasan == '') : ?>
                                            <i> (Belum Ada Balasan) </i>
                                        <?php else : ?>
                                            <?= tgl_indo(date('Y-m-d', $data->TanggalBalasan)); ?>
                                        <?php endif; ?>
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