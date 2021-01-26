<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kritik_saran_model extends CI_Model
{
    // Fungsi Untuk Kirim atau Tambah Kritik & Saran (tb_kritik_saran)
    public function kirimKritikSaran($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Menampilkan Daftar Kritik & Saran Dengan Menggabungkan 3 Tabel Secara Left Join (tb_kritik_saran, tb_user, dan tb_perusahaan)
    public function dataKritikSaran()
    {
        $this->db->select('*');
        $this->db->from('tb_kritik_saran');
        $this->db->join('tb_user', 'tb_user.IdUser = tb_kritik_saran.IdUser', 'left');
        $this->db->join('tb_perusahaan', 'tb_perusahaan.IdPerusahaan = tb_kritik_saran.IdPerusahaan', 'left');
        $this->db->order_by('IdKritikSaran', 'DESC');


        $query = $this->db->get();
        return $query;
    }

    public function daftarKritikSaranUser()
    {
        $user = $this->session->userdata('IdUser');

        $this->db->select('*');
        $this->db->from('tb_kritik_saran');
        $this->db->where('IdUser', $user);
        $this->db->order_by('IdKritikSaran', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Kritik & Saran Dengan Menggabungkan 3 Tabel Secara Left Join (tb_kritik_saran, tb_user, dan tb_perusahaan)
    public function detailKritikSaran($where)
    {
        $this->db->select('*');
        $this->db->from('tb_kritik_saran as tbs');
        $this->db->where('tbs.IdKritikSaran', $where);
        $this->db->join('tb_user as tu', 'tu.IdUser = tbs.IdUser', 'left');
        $this->db->join('tb_perusahaan as tp', 'tp.IdPerusahaan = tbs.IdPerusahaan', 'left');

        return $this->db->get();
    }

    // Fungsi Untuk Memberi Balasan Kritik & Saran (tb_kritik_saran)
    public function balasanKritikSaran($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Kritik & Saran (tb_kritik_saran)
    public function hapusKritikSaran($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
