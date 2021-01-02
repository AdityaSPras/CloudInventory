<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <div class="success-flash-karyawan" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="<?= base_url('karyawan/tambah_barang_keluar'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="text text-white">Tambah <?= $title; ?></span>
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table-hover">
                    <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah Keluar</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Tanggal Keluar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_barang_keluar as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center">
                                        <?php if ($data->NamaBarang == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Barang Telah Terhapus!</span>
                                        <?php else : ?>
                                            <?= $data->NamaBarang ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaKeluar) ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->NamaSatuan == '') : ?>
                                            <span class="badge badge-warning"> <i class="fa fa-minus"></i> <?= $data->JumlahKeluar ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-warning"> <i class="fa fa-minus"></i> <?= $data->JumlahKeluar ?> <?= $data->NamaSatuan ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= rupiah($data->TotalKeluar) ?></td>
                                    <td class="text-center"><?= tgl_indo($data->TanggalKeluar) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url("karyawan/detail_barang_keluar/" . encrypt_url($data->IdBarangKeluar) . "") ?>" class="btn btn-circle btn-info btn-sm">
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