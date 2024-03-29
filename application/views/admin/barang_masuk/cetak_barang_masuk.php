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
    <?php if ($TanggalAwal == '' || $TanggalAkhir == '') : ?>
        <h6 align="center">Semua Tanggal</h6>
    <?php else : ?>
        <h6 align="center"><?= tgl_indo($TanggalAwal) ?> - <?= tgl_indo($TanggalAkhir) ?></h6>
    <?php endif; ?>
    <table id="isi">
        <tr>
            <th align="center">No</th>
            <th align="center">Tanggal Masuk</th>
            <th align="center">Supplier</th>
            <th align="center">Nama Barang</th>
            <th align="center">Total Harga</th>
            <th align="center">Jumlah Masuk</th>
            <th align="center">Harga Rata-Rata Satuan</th>
        </tr>
        <?php $no = 1;
        foreach ($daftar_barang_masuk as $data) { ?>
            <tr>
                <th align="center"><?= $no++ ?>.</th>
                <td align="center"><?= tgl_indo($data->TanggalMasuk) ?> </td>
                <td align="center">
                    <?php if ($data->NamaSupplier == '') : ?>
                        <span>Supplier Telah Terhapus!</span>
                    <?php else : ?>
                        <?= $data->NamaSupplier ?>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?php if ($data->NamaBarang == '') : ?>
                        <span>Barang Telah Terhapus!</span>
                    <?php else : ?>
                        <?= $data->NamaBarang ?>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?= rupiah($data->HargaMasuk) ?></td>
                </td>
                <td align="center">
                    <?php if ($data->NamaSatuan == '') : ?>
                        <span><?= $data->JumlahMasuk ?></span>
                    <?php else : ?>
                        <span><?= $data->JumlahMasuk ?> <?= $data->NamaSatuan ?></span>
                    <?php endif; ?>
                <td align="center">
                    <?= rupiah($data->HargaMasuk / $data->JumlahMasuk) ?><?php if ($data->NamaSatuan == '') : ?>
                    <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan="4" align="right">Total Harga Masuk:</th>
            <th colspan="3" align="center">
                <?php
                if ($TanggalAwal != '' && $TanggalAkhir != '') {
                    $user = $this->session->userdata('IdPerusahaan');
                    $data1 = $this->db->select_sum('HargaMasuk')->from('tb_barang_masuk as tbm')->where('tbm.IdPerusahaan', $user)->where('tbm.TanggalMasuk >=', $TanggalAwal)->where('tbm.TanggalMasuk <=', $TanggalAkhir)->get();
                    $HargaMasuk = $data1->row();
                    $TotalHargaMasuk = intval($HargaMasuk->HargaMasuk);
                } else {
                    $user = $this->session->userdata('IdPerusahaan');
                    $data1 = $this->db->select_sum('HargaMasuk')->from('tb_barang_masuk as tbm')->where('tbm.IdPerusahaan', $user)->get();
                    $HargaMasuk = $data1->row();
                    $TotalHargaMasuk = intval($HargaMasuk->HargaMasuk);
                }
                ?>

                <?= rupiah($TotalHargaMasuk); ?>
            </th>
        </tr>
    </table>
</body>

</html>