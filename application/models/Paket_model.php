<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket_model extends CI_Model
{
    // Fungsi Untuk Menampilkan Daftar Paket Layanan (tb_paket)
    public function dataPaket()
    {
        $query = $this->db->get('tb_paket');
        return $query;
    }

    // Fungsi Untuk Menampilkan Paket Layanan Dengan IdPaket 1 (tb_paket)
    public function paketSatu()
    {
        $this->db->select('*');
        $this->db->from('tb_paket');
        $this->db->where('IdPaket', '1');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Paket Layanan Dengan IdPaket 2 (tb_paket)
    public function paketDua()
    {
        $this->db->select('*');
        $this->db->from('tb_paket');
        $this->db->where('IdPaket', '2');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Paket Layanan Dengan IdPaket 3 (tb_paket)
    public function paketTiga()
    {
        $this->db->select('*');
        $this->db->from('tb_paket');
        $this->db->where('IdPaket', '3');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Paket Layanan (tb_paket)
    public function ubahPaket($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
