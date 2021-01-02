<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    // Fungsi Untuk Tambah Kategori Barang Perusahaan (tb_kategori)
    public function tambahKategori($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Kategori Barang Dengan Format (ID-KTG-XXXX)
    public function kodeKategori()
    {
        $this->db->select('RIGHT(tb_kategori.IdKategori,4) as Kode', FALSE);
        $this->db->order_by('IdKategori', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_kategori');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax      = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeKategori = "ID-KTG-" . $KodeMax;
        return $KodeKategori;
    }

    // Fungsi Untuk Menampilkan Daftar Kategori Barang Milik Perusahaan (tb_kategori)
    public function dataKategori()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->where('IdPerusahaan', $user);
        $this->db->order_by('Idkategori', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Kategori Barang Milik Perusahaan (tb_kategori)
    public function detailKategori($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_kategori as tk');
        $this->db->where('tk.IdKategori', $where);
        $this->db->where('tk.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = tk.IdUser', 'left');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Kategori Barang Milik Perusahaan (tb_kategori)
    public function ubahKategori($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Kategori Barang Milik Perusahaan (tb_kategori)
    public function hapusKategori($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
