<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    // Fungsi Untuk Menampilkan Jumlah Permintaan Pembayaran Paket Layanan Yang Belum Dikonfirmasi (tb_pembayaran)
    public function pembayaranBelumDikonfirmasi()
    {
        $this->db->select('*');
        $this->db->from('tb_pembayaran');
        $this->db->where('Status', 'Belum Dikonfirmasi');
        $query = $this->db->get();
        return $query;
    }
}
