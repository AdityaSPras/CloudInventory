<?php if ($status_paket['IdPaket'] == 1) : ?>
    <?= redirect('error'); ?>
<?php else : ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12 mb-4" id="container">

            <!-- Illustrations -->
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary text-center"><?= $title; ?></h4>
                    <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
                </div>
                <div class="col-sm-12 mt-2">
                    <form action=" <?= base_url() ?>admin/cetak_barang_masuk" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <div class="input-group">
                                    <input name="TanggalAwal" placeholder="Tanggal Awal" class="form-control datepicker1" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="btn btn-secondary">
                                            <i class="fas fa-calendar fa-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="input-group">
                                    <input name="TanggalAkhir" placeholder="Tanggal Akhir" class="form-control datepicker2" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="btn btn-secondary">
                                            <i class="fas fa-calendar fa-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm mb-2">
                                <button type="reset" class="btn btn-md btn-secondary btn-icon-split">
                                    <span class="text text-white">Reset</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-undo"></i>
                                    </span>
                                </button>
                            </div>

                            <div class="col-sm mb-2 text-right">
                                <button type="submit" class="btn btn-danger btn-icon-split">
                                    <span class="text text-white">Cetak PDF</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-file-pdf"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="pagination" class="table table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal Masuk</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Jumlah Masuk</th>
                                    <th class="text-center">Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($daftar_barang_masuk as $data) { ?>
                                    <tr>
                                        <th class="text-center"><?= $no++ ?>.</th>
                                        <td class="text-center"><?= tgl_indo($data->TanggalMasuk) ?> </td>
                                        <td class="text-center">
                                            <?php if ($data->NamaSupplier == '') : ?>
                                                <span>Supplier Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaSupplier ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($data->NamaBarang == '') : ?>
                                                <span>Barang Telah Terhapus!</span>
                                            <?php else : ?>
                                                <?= $data->NamaBarang ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= rupiah($data->HargaMasuk) ?></td>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($data->NamaSatuan == '') : ?>
                                                <span><?= $data->JumlahMasuk ?></span>
                                            <?php else : ?>
                                                <span><?= $data->JumlahMasuk ?> <?= $data->NamaSatuan ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= rupiah($data->HargaMasuk / $data->JumlahMasuk) ?><?php if ($data->NamaSatuan == '') : ?>
                                            <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
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
<?php endif; ?>

<script src="<?= base_url('assets'); ?>/jquery/jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets'); ?>/datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(function() {
        $(".datepicker1").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });

    $(function() {
        $(".datepicker2").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });
</script>