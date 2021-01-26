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
                <a href="<?= base_url('karyawan/tambah_barang_masuk'); ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="15%">Nama Barang</th>
                                <th class="text-center" width="15%">Supplier</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Jumlah Masuk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Tanggal Masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($daftar_barang_masuk as $data) { ?>
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
                                        <?php if ($data->NamaSupplier == '') : ?>
                                            <span class="badge rounded-pill bg-danger text-white">Supplier Telah Terhapus!</span>
                                        <?php else : ?>
                                            <?= $data->NamaSupplier ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaMasuk) ?></td>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->NamaSatuan == '') : ?>
                                            <span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $data->JumlahMasuk ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $data->JumlahMasuk ?> <?= $data->NamaSatuan ?></span>
                                        <?php endif; ?>
                                    <td class="text-center">
                                        <?= rupiah($data->HargaMasuk / $data->JumlahMasuk) ?><?php if ($data->NamaSatuan == '') : ?>
                                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= tgl_indo($data->TanggalMasuk) ?> </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("karyawan/detail_barang_masuk/" . encrypt_url($data->IdBarangMasuk) . "") ?>" class="btn btn-circle btn-info btn-sm">
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