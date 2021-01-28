<!DOCTYPE html>
<html>

<style>
    body {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    #head {
        border-collapse: collapse;
        width: 100%;
    }

    #isi {
        border-collapse: collapse;
        width: 100%;
    }

    #isi td {
        border: 1px solid #000;
        padding: 8px;
        font-size: 12px;
    }

    #isi th {
        border: 1px solid #000;
        padding: 8px;
        font-size: 12px;
    }

    #isi th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
    }
</style>

<body>
    <table id="head">
        <tr>
            <th align="left" colspan="2">
                <img src="<?= base_url('assets/img/company/') . $perusahaan['Logo']; ?>" alt="Logo Perusahaan" width="70px">
            </th>
            <th align="center" colspan="5">
                <h2><?= $perusahaan['NamaPerusahaan']; ?></h2>
                <h5><?= $perusahaan['AlamatPerusahaan']; ?></h5>
            </th>
        </tr>
    </table>
    <hr>
    <br>
    <h3 align="center"><?= $title; ?></h3>
    <table id="isi">
        <tr>
            <th align="center">No</th>
            <th align="center">Nama Barang</th>
            <th align="center">Kategori Barang</th>
            <th align="center">Harga Jual</th>
            <th align="center">Stok</th>
        </tr>
        <?php $no = 1;
        foreach ($daftar_barang as $data) { ?>

            <?php
            $BarangMasuk        = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
            $BarangKeluar       = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();
            $JumlahBarangMasuk  = $BarangMasuk->row();
            $JumlahBarangKeluar = $BarangKeluar->row();
            $TotalStok          = intval($data->Stok) + (intval($JumlahBarangMasuk->JumlahMasuk) - intval($JumlahBarangKeluar->JumlahKeluar));
            ?>

            <tr>
                <th align="center">
                    <?php if ($TotalStok == 0) { ?>
                        <span><b color="red">
                                <?= $no++ ?>.
                            </b></span>
                    <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                        <?= $no++ ?>.
                    <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                        <span><b color="#FFA500">
                                <?= $no++ ?>.
                            </b></span>
                    <?php } ?>
                </th>
                <td align="center">
                    <?php if ($TotalStok == 0) { ?>
                        <span><b color="red">
                                <?= $data->NamaBarang ?>
                            </b></span>
                    <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                        <?= $data->NamaBarang ?>
                    <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                        <span><b color="#FFA500">
                                <?= $data->NamaBarang ?>
                            </b></span>
                    <?php } ?>
                </td>
                <td align="center">
                    <?php if ($TotalStok == 0) { ?>
                        <span><b color="red">
                                <?php if ($data->NamaKategori == '') : ?>
                                    <span>Kategori Barang Telah Terhapus!</span>
                                <?php else : ?>
                                    <?= $data->NamaKategori ?>
                                <?php endif; ?>
                            </b></span>
                    <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                        <?php if ($data->NamaKategori == '') : ?>
                            <span>Kategori Barang Telah Terhapus!</span>
                        <?php else : ?>
                            <?= $data->NamaKategori ?>
                        <?php endif; ?>
                    <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                        <span><b color="#FFA500">
                                <?php if ($data->NamaKategori == '') : ?>
                                    <span>Kategori Barang Telah Terhapus!</span>
                                <?php else : ?>
                                    <?= $data->NamaKategori ?>
                                <?php endif; ?>
                            </b></span>
                    <?php } ?>
                </td>
                <td align="center">
                    <?php if ($TotalStok == 0) { ?>
                        <span><b color="red">
                                <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                                <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                            </b></span>
                    <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                        <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                        <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                    <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                        <span><b color="#FFA500">
                                <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                                <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                            </b></span>
                    <?php } ?>
                </td>
                <td align="center">
                    <?php if ($TotalStok == 0) { ?>
                        <span><b color="red">Kosong</b></span>
                    <?php } elseif ($TotalStok > $data->StokMinimum) { ?>
                        <span><?= $TotalStok ?> <?= $data->NamaSatuan ?></span>
                    <?php } elseif ($TotalStok <= $data->StokMinimum) { ?>
                        <span><b color="#FFA500">
                                <?= $TotalStok ?> <?= $data->NamaSatuan ?>
                            </b></span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <p>
        <span style="font-size:13px"><b>Keterangan:</b></span>
    <p>
        <span><b color="red" style="font-size:11px">* Stok Barang Habis</b></span><br>
        <span><b color="#FFA500" style="font-size:11px">* Stok Barang Hampir Habis</b></span><br>
        <span style="font-size:11px"><b>* Stok Barang Normal</b></span><br>
    </p>
</body>

</html>