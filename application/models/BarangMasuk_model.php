<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasuk_model extends CI_Model
{
    // Fungsi Untuk Tambah Barang Masuk Perusahaan (tb_barang_masuk)
    public function tambahBarangMasuk($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Barang Masuk Dengan Format (ID-BRM-XXXX)
    public function kodeBarangMasuk()
    {
        $this->db->select('RIGHT(tb_barang_masuk.IdBarangMasuk,4) as Kode', FALSE);
        $this->db->order_by('IdBarangMasuk', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_barang_masuk');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax         = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeBarangMasuk = "ID-BRM-" . $KodeMax;
        return $KodeBarangMasuk;
    }

    // Fungsi Untuk Menampilkan Jumlah Barang Masuk Milik Perusahaan Secara Harian Dengan Left Join (tb_barang_masuk, dan tb_user)
    public function jumlahBarangMasuk()
    {
        $harian = date('Y-m-d');
        $user   = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_masuk as tbm');
        $this->db->join('tb_user as tu', 'tu.IdPerusahaan = tbm.IdPerusahaan', 'left');
        $this->db->where('tbm.IdPerusahaan', $user);
        $this->db->like('TanggalMasuk', $harian);

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Total Pengeluaran Dari Barang Masuk Milik Perusahaan Secara Harian (tb_barang_masuk)
    public function totalBarangMasuk()
    {
        $harian = date('Y-m-d');
        $user   = $this->session->userdata('IdPerusahaan');

        $this->db->where('TanggalMasuk', $harian);
        $this->db->select('SUM(HargaMasuk) as total');

        $query = $this->db->get_where('tb_barang_masuk', ['IdPerusahaan' => $user])->row()->total;
        return $query;
    }

    // Fungsi Untuk Menampilkan Daftar Barang Masuk Milik Perusahaan Dengan Menggabungkan 5 Tabel Secara Left Join (tb_barang_masuk, tb_user, tb_barang, tb_supplier, dan tb_satuan)
    public function daftarBarangMasuk()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_masuk as tbm');
        $this->db->join('tb_user as tu', 'tu.IdUser = tbm.IdUser', 'left');
        $this->db->join('tb_barang as tb', 'tb.IdBarang = tbm.IdBarang', 'left');
        $this->db->join('tb_supplier as ts', 'ts.IdSupplier = tbm.IdSupplier', 'left');
        $this->db->join('tb_satuan as tsa', 'tsa.IdSatuan = tb.IdSatuan', 'left');
        $this->db->where('tbm.IdPerusahaan', $user);
        $this->db->order_by('IdBarangMasuk', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Barang Keluar Milik Perusahaan Dengan Menggabungkan 5 Tabel Secara Left Join (tb_barang_masuk, tb_user, tb_barang, tb_supplier, dan tb_satuan)
    public function detailBarangMasuk($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_barang_masuk as tbm');
        $this->db->where('tbm.IdBarangMasuk', $where);
        $this->db->where('tbm.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = tbm.IdUser', 'left');
        $this->db->join('tb_barang as tb', 'tb.IdBarang = tbm.IdBarang', 'left');
        $this->db->join('tb_supplier as ts', 'ts.IdSupplier = tbm.IdSupplier', 'left');
        $this->db->join('tb_satuan as tsa', 'tsa.IdSatuan = tb.IdSatuan', 'left');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Barang Masuk Milik Perusahaan (tb_barang_masuk)
    public function ubahBarangMasuk($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Barang Keluar Perusahaan (tb_barang_masuk)
    public function hapusBarangMasuk($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
