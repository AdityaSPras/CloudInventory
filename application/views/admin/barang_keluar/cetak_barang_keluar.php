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
            <th align="center">Tanggal Keluar</th>
            <th align="center">Nama Barang</th>
            <th align="center">Jumlah Keluar</th>
            <th align="center">Harga Satuan</th>
            <th align="center">Total Harga</th>
        </tr>
        <?php $no = 1;
        foreach ($daftar_barang_keluar as $data) { ?>
            <tr>
                <th align="center"><?= $no++ ?>.</th>
                <td align="center"><?= tgl_indo($data->TanggalKeluar) ?></td>
                <td align="center">
                    <?php if ($data->NamaBarang == '') : ?>
                        <span>Barang Telah Terhapus!</span>
                    <?php else : ?>
                        <?= $data->NamaBarang ?>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?php if ($data->NamaSatuan == '') : ?>
                        <span><?= $data->JumlahKeluar ?></span>
                    <?php else : ?>
                        <span><?= $data->JumlahKeluar ?> <?= $data->NamaSatuan ?></span>
                    <?php endif; ?>
                </td>
                <td align="center">
                    <?= rupiah($data->HargaKeluar) ?><?php if ($data->NamaSatuan == '') : ?>
                    <?php else : ?>/<?= $data->NamaSatuan ?><?php endif; ?>
                </td>
                <td align="center"><?= rupiah($data->TotalKeluar) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan="3" align="right">Total Harga Keluar:</th>
            <th colspan="3" align="center">
                <?php
                if ($TanggalAwal != '' && $TanggalAkhir != '') {
                    $user             = $this->session->userdata('IdPerusahaan');
                    $data1            = $this->db->select_sum('TotalKeluar')->from('tb_barang_keluar as tbk')->where('tbk.IdPerusahaan', $user)->where('tbk.TanggalKeluar >=', $TanggalAwal)->where('tbk.TanggalKeluar <=', $TanggalAkhir)->get();
                    $HargaKeluar      = $data1->row();
                    $TotalHargaKeluar = intval($HargaKeluar->TotalKeluar);
                } else {
                    $user             = $this->session->userdata('IdPerusahaan');
                    $data1            = $this->db->select_sum('TotalKeluar')->from('tb_barang_keluar as tbk')->where('tbk.IdPerusahaan', $user)->get();
                    $HargaKeluar      = $data1->row();
                    $TotalHargaKeluar = intval($HargaKeluar->TotalKeluar);
                }
                ?>

                <?= rupiah($TotalHargaKeluar); ?>
            </th>
        </tr>
    </table>
</body>

</html>