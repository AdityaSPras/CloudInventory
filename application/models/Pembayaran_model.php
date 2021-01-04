<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    // Fungsi Untuk Menampilkan Jumlah Permintaan Pembayaran Paket Layanan Yang Belum Dikonfirmasi (tb_pembayaran)
    public function pembayaranBelumDikonfirmasi()
    {
        $this->db->select('*');
        $this->db->from('tb_pembayaran');
        $this->db->where('Status', 'Pending');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Riwayat Pembayaran Paket Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_pembayaran, tb_user, tb_perusahaan, dan tb_paket)
    public function riwayatPembayaran()
    {
        $user       = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');
        $this->db->where('tpe.IdPerusahaan', $user);
        $this->db->order_by('TanggalPembayaran', 'DESC');

        $query = $this->db->get();
        return $query;
    }
}
