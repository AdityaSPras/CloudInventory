<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
    // Fungsi Untuk Membuat ID Perusahaan Dengan Format (ID-PRH-XXX)
    public function kodePerusahaan()
    {
        $this->db->select('RIGHT(tb_perusahaan.IdPerusahaan,3) as Kode', FALSE);
        $this->db->order_by('IdPerusahaan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_perusahaan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax        = str_pad($Kode, 3, "0", STR_PAD_LEFT);
        $KodePerusahaan = "ID-PRH-" . $KodeMax;
        return $KodePerusahaan;
    }

    // Fungsi Untuk Membuat ID Aktivasi Paket Dengan Format (ID-AKT-XXX)
    public function kodeAktivasi()
    {
        $this->db->select('RIGHT(tb_aktivasi.IdAktivasi,3) as Kode', FALSE);
        $this->db->order_by('IdAktivasi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_aktivasi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax      = str_pad($Kode, 3, "0", STR_PAD_LEFT);
        $KodeAktivasi = "ID-AKT-" . $KodeMax;
        return $KodeAktivasi;
    }

    public function statusPaket($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Menampilkan Daftar Perusahaan Dengan Menggabungkan 3 Tabel (tb_perusahaan, tb_user, dan tb_paket)
    public function dataPerusahaan()
    {
        $this->db->select('*');
        $this->db->from('tb_perusahaan');
        $this->db->join('tb_user', 'tb_user.IdPerusahaan = tb_perusahaan.IdPerusahaan');
        $this->db->join('tb_paket', 'tb_paket.IdPaket = tb_perusahaan.IdPaket');
        $this->db->where('Level', 'Admin');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Perusahaan Dengan Menggabungkan 3 Tabel (tb_perusahaan, tb_user, dan tb_paket)
    public function detailPerusahaan($where)
    {
        $this->db->select('*');
        $this->db->from('tb_perusahaan as tp');
        $this->db->where('tp.IdPerusahaan', $where);
        $this->db->join('tb_user as tu', 'tu.IdPerusahaan = tp.IdPerusahaan');
        $this->db->join('tb_paket as tpa', 'tpa.IdPaket = tp.IdPaket');
        $this->db->where('Level', 'Admin');

        return $this->db->get();
    }
}
