<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    // Fungsi Untuk Tambah Karyawan Perusahaan (tb_user)
    public function tambahKaryawan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID User Admin Dengan Format (ID-ADM-XXX)
    public function kodeAdmin()
    {
        $this->db->select('RIGHT(tb_user.IdUser,3) as Kode', FALSE);
        $this->db->order_by('IdUser', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_user');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax   = str_pad($Kode, 3, "0", STR_PAD_LEFT);
        $KodeAdmin = "ID-ADM-" . $KodeMax;
        return $KodeAdmin;
    }

    // Fungsi Untuk Membuat ID User Karyawan Dengan Format (ID-KRY-XXX)
    public function kodeKaryawan()
    {
        $this->db->select('RIGHT(tb_user.IdUser,3) as Kode', FALSE);
        $this->db->order_by('IdUser', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_user');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax      = str_pad($Kode, 3, "0", STR_PAD_LEFT);
        $KodeKaryawan = "ID-KRY-" . $KodeMax;
        return $KodeKaryawan;
    }

    // Fungsi Untuk Menampilkan Daftar Karyawan Perusahaan Berdasarkan Level User Karyawan (tb_user)
    public function dataKaryawan()
    {
        $user       = $this->session->userdata('IdPerusahaan');
        $perusahaan = $this->db->where('IdPerusahaan', $user)->get('tb_perusahaan')->row();
        $paket      = $this->db->where('IdPaket', $perusahaan->IdPaket)->get('tb_paket')->row();

        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('IdPerusahaan', $user);
        $this->db->like('Level', 'Karyawan');
        $this->db->limit($paket->JumlahKaryawan);
        $this->db->order_by('TanggalDibuat', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Karyawan Perusahaan Berdasarkan Level User Karyawan (tb_user)
    public function detailKaryawan($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_user as tb');
        $this->db->where('tb.IdUser', $where);
        $this->db->where('IdPerusahaan', $user);
        $this->db->like('Level', 'Karyawan');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Mendapatkan Foto Karyawan Perusahaan
    public function getFoto($where)
    {
        $this->db->order_by('IdUser', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get_where('tb_user', $where);
        $data  = $query->row();
        $Foto  = $data->Foto;

        return $Foto;
    }

    // Fungsi Untuk Hapus Karyawan Perusahaan (tb_user)
    public function hapusKaryawan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
