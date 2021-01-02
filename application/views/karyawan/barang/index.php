<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center">Daftar <?= $title; ?></h4>
                <h6 class="m-0 font-weight-bold text-primary text-center">( <?= $perusahaan['NamaPerusahaan']; ?> )</h6>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon-split">
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
                                <th width="5%" class="text-center">No</th>
                                <th width="30%" class="text-center">Nama Barang</th>
                                <th width="20%" class="text-center">Gambar Barang</th>
                                <th width="20%" class="text-center">Stok</th>
                                <th width="15%" class="text-center">Harga</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($barang as $data) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++ ?>.</th>
                                    <td class="text-center"><?= $data->NamaBarang ?></td>
                                    <td class="text-center"><img src="<?= base_url('assets/img/items/') . $data->Gambar ?>" alt="" width="60px"></td>
                                    <td class="text-center"><?= $data->Stok ?> <?= $data->NamaSatuan ?></td>
                                    <td class="text-center"><?= rupiah($data->HargaJual) ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-circle btn-info btn-sm mb-2">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="#" class="btn btn-circle btn-warning btn-sm mb-2">
                                            <i class="fas fa-pen"></i>
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