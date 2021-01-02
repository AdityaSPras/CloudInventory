<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluar_model extends CI_Model
{
    // Fungsi Untuk Tambah Barang Keluar Perusahaan (tb_barang_keluar)
    public function tambahBarangKeluar($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Barang Keluar Dengan Format (ID-BRK-XXXX)
    public function kodeBarangKeluar()
    {
        $this->db->select('RIGHT(tb_barang_keluar.IdBarangKeluar,4) as Kode', FALSE);
        $this->db->order_by('IdBarangKeluar', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_barang_keluar');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax          = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeBarangKeluar = "ID-BRK-" . $KodeMax;
        return $KodeBarangKeluar;
    }

    // Fungsi Untuk Menampilkan Jumlah Barang Keluar Milik Perusahaan Secara Harian Dengan Left Join (tb_barang_keluar, dan tb_user)
    public function jumlahBarangKeluar()
    {
        $harian = date('Y-m-d');
        $user   = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_keluar as tbk');
        $this->db->join('tb_user as tu', 'tu.IdPerusahaan = tbk.IdPerusahaan', 'left');
        $this->db->where('tbk.IdPerusahaan', $user);
        $this->db->like('TanggalKeluar', $harian);

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Total Pemasukan Dari Barang Keluar Milik Perusahaan Secara Harian (tb_barang_keluar)
    public function totalBarangKeluar()
    {
        $harian = date('Y-m-d');
        $user   = $this->session->userdata('IdPerusahaan');

        $this->db->where('TanggalKeluar', $harian);
        $this->db->select('SUM(TotalKeluar) as total');

        $query = $this->db->get_where('tb_barang_keluar', ['IdPerusahaan' => $user])->row()->total;
        return $query;
    }

    // Fungsi Untuk Menampilkan Daftar Barang Keluar Milik Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_barang_keluar, tb_user, tb_barang, dan tb_satuan)
    public function daftarBarangKeluar()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_keluar as tbk');
        $this->db->join('tb_user as tu', 'tu.IdUser = tbk.IdUser', 'left');
        $this->db->join('tb_barang as tb', 'tb.IdBarang = tbk.IdBarang', 'left');
        $this->db->join('tb_satuan as ts', 'ts.IdSatuan = tb.IdSatuan', 'left');
        $this->db->where('tbk.IdPerusahaan', $user);
        $this->db->order_by('IdBarangKeluar', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Barang Keluar Milik Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_barang_keluar, tb_user, tb_barang, dan tb_satuan)
    public function detailBarangKeluar($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_keluar as tbk');
        $this->db->where('tbk.IdBarangKeluar', $where);
        $this->db->where('tbk.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = tbk.IdUser', 'left');
        $this->db->join('tb_barang as tb', 'tb.IdBarang = tbk.IdBarang', 'left');
        $this->db->join('tb_satuan as ts', 'ts.IdSatuan = tb.IdSatuan', 'left');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Barang Keluar Milik Perusahaan (tb_barang_keluar)
    public function ubahBarangKeluar($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Barang Keluar Perusahaan (tb_barang_keluar)
    public function hapusBarangKeluar($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
