<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    // Fungsi Untuk Tambah Barang Perusahaan (tb_barang)
    public function tambahBarang($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Barang Dengan Format (ID-BRG-XXXX)
    public function kodeBarang()
    {
        $this->db->select('RIGHT(tb_barang.IdBarang,4) as Kode', FALSE);
        $this->db->order_by('IdBarang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax    = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeBarang = "ID-BRG-" . $KodeMax;
        return $KodeBarang;
    }

    // Fungsi Untuk Menampilkan Jumlah Barang Milik Perusahaan (tb_barang)
    public function jumlahBarang()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('IdPerusahaan', $user);

        $query = $this->db->get();
        return $query->num_rows();
    }

    // Fungsi Untuk Menampilkan Daftar Barang Milik Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_barang, tb_user, tb_kategori, dan tb_satuan)
    public function dataBarang()
    {
        $user       = $this->session->userdata('IdPerusahaan');
        $perusahaan = $this->db->where('IdPerusahaan', $user)->get('tb_perusahaan')->row();
        $paket      = $this->db->where('IdPaket', $perusahaan->IdPaket)->get('tb_paket')->row();

        $this->db->select('*');
        $this->db->from('tb_barang as tb');
        $this->db->join('tb_user as tu', 'tu.IdUser = tb.IdUser', 'left');
        $this->db->join('tb_kategori as tk', 'tk.IdKategori = tb.IdKategori', 'left');
        $this->db->join('tb_satuan as ts', 'ts.IdSatuan = tb.IdSatuan', 'left');
        $this->db->where('tb.IdPerusahaan', $user);
        $this->db->limit($paket->JumlahBarang);
        $this->db->order_by('TanggalBarang', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Barang Milik Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_barang, tb_user, tb_kategori, dan tb_satuan)
    public function detailBarang($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang as tb');
        $this->db->where('tb.IdBarang', $where);
        $this->db->where('tb.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = tb.IdUser', 'left');
        $this->db->join('tb_kategori as tk', 'tk.IdKategori = tb.IdKategori', 'left');
        $this->db->join('tb_satuan as ts', 'ts.IdSatuan = tb.IdSatuan', 'left');

        $query = $this->db->get();
        return $query;
    }

    public function getIdBarang($where, $table)
    {
        $user       = $this->session->userdata('IdPerusahaan');

        $this->db->where('IdPerusahaan', $user);

        $query = $this->db->get_where($table, $where);

        return $query;
    }

    public function ubahBarang($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function getBarang($where, $table)
    {
        $user = $this->session->userdata('IdPerusahaan');
        $this->db->where('IdPerusahaan', $user)->get('tb_perusahaan')->row();

        return $this->db->get_where($table, $where);
    }

    // Fungsi Untuk Mendapatkan Gambar Barang Perusahaan
    public function getGambar($where)
    {
        $this->db->order_by('IdBarang', 'DESC');
        $this->db->limit(1);

        $query   = $this->db->get_where('tb_barang', $where);
        $data    = $query->row();
        $Gambar  = $data->Gambar;

        return $Gambar;
    }

    // Fungsi Untuk Hapus Barang Perusahaan (tb_barang)
    public function hapusBarang($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
