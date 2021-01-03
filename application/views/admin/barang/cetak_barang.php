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
            <th align="center">Harga</th>
            <th align="center">Stok</th>
        </tr>
        <?php $no = 1;
        foreach ($daftar_barang as $data) { ?>
            <tr>
                <th align="center"><?= $no++ ?>.</th>
                <td align="center"><?= $data->NamaBarang ?></td>
                <td align="center">
                    <?php if ($data->NamaKategori == '') : ?>
                        <span>Kategori Barang Telah Terhapus!</span>
                    <?php else : ?>
                        <?= $data->NamaKategori ?>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?= rupiah($data->HargaJual) ?><?php if ($data->NamaSatuan == '') : ?>
                    <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                </td>
                <td align="center">
                    <?php
                    $data1 = $this->db->select_sum('JumlahMasuk')->from('tb_barang_masuk')->where('IdBarang', $data->IdBarang)->get();
                    $data2 = $this->db->select_sum('JumlahKeluar')->from('tb_barang_keluar')->where('IdBarang', $data->IdBarang)->get();


                    $bm = $data1->row();
                    $bk = $data2->row();
                    $total_stok = intval($data->Stok) + (intval($bm->JumlahMasuk) - intval($bk->JumlahKeluar));
                    ?>

                    <span><?= $total_stok ?> <?= $data->NamaSatuan ?></span>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>