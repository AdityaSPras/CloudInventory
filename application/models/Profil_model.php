<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_model extends CI_Model
{
    // Fungsi Untuk Menampilkan Data Profil Dengan Menggabungkan 2 Tabel (tb_user dan tb_perusahaan)
    public function dataProfil()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_user as tu');
        $this->db->join('tb_perusahaan as tp', 'tu.IdPerusahaan = tp.IdPerusahaan');
        $this->db->where('tu.IdPerusahaan', $user);

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Data Status Paket Perusahaan Dengan Menggabungkan 2 Tabel (tb_perusahaan dan tb_paket)
    public function statusPaket()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_perusahaan');
        $this->db->join('tb_paket', 'tb_paket.IdPaket = tb_perusahaan.IdPaket');
        $this->db->where('IdPerusahaan', $user);

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Kontak Layanan Dengan IdUser 1 (tb_user)
    public function kontakLayanan()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('IdUser', '1');

        $query = $this->db->get();
        return $query;
    }
}
