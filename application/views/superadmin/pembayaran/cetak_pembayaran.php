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
            <th align="center" colspan="7">
                <img src="<?= base_url('assets/img/Icon.png') ?>" width="70px">
                <h2>CLOUD INVENTORY SYSTEM</h2>
            </th>
        </tr>
    </table>
    <hr>
    <br>
    <h3 align="center"><?= $title; ?></h3>
    <?php if ($IdPerusahaan == '') : ?>
        <h6 align="center">Semua Pembayaran</h6>
    <?php else : ?>
        <h6 align="center"><?= $perusahaan ?></h6>
    <?php endif; ?>
    <table id="isi">
        <tr>
            <th align="center">No</th>
            <th align="center">Nama Perusahaan</th>
            <th align="center">Jenis Pembayaran</th>
            <th align="center">Tanggal Pembayaran</th>
            <th align="center">Nama Paket</th>
            <th align="center">Lama Berlangganan</th>
            <th align="center">Harga Bulanan</th>
            <th align="center">Total Bayar</th>
        </tr>
        <?php $no = 1;
        foreach ($daftar_pembayaran as $data) { ?>
            <tr>
                <th align="center"><?= $no++ ?>.</th>
                <td align="center"><?= $data->NamaPerusahaan ?></td>
                <td align="center"><?= $data->TipePembayaran ?></td>
                <td align="center"><?= tgl_indo($data->TanggalPembayaran) ?></td>
                <td align="center"><?= $data->Nama ?></td>
                <td align="center"><?= $data->SubBayar ?> Bulan</td>
                <td align="center"><?= rupiah($data->HargaBulanan) ?></td>
                <td align="center"><?= rupiah($data->TotalBayar) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan="6" align="right">Total Pembayaran:</th>
            <th colspan="2" align="center">
                <?php
                if ($IdPerusahaan != '') {
                    $Data1 = $this->db->select_sum('TotalBayar')->from('tb_pembayaran as tp')->where('tp.StatusPembayaran', 'Diterima')->where('tp.IdPerusahaan', $IdPerusahaan)->get();
                    $Pembayaran = $Data1->row();
                    $TotalPembayaran = intval($Pembayaran->TotalBayar);
                } else {
                    $Data1 = $this->db->select_sum('TotalBayar')->from('tb_pembayaran')->where('StatusPembayaran', 'Diterima')->get();
                    $Pembayaran = $Data1->row();
                    $TotalPembayaran = intval($Pembayaran->TotalBayar);
                }
                ?>

                <?= rupiah($TotalPembayaran); ?>
            </th>
        </tr>
    </table>
</body>

</html>