<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    // Fungsi Untuk Tambah Supplier Barang Perusahaan (tb_supplier)
    public function tambahSupplier($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Supplier Barang Dengan Format (ID-SPL-XXXX)
    public function kodeSupplier()
    {
        $this->db->select('RIGHT(tb_supplier.IdSupplier,4) as Kode', FALSE);
        $this->db->order_by('IdSupplier', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_supplier');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax      = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeSupplier = "ID-SPL-" . $KodeMax;
        return $KodeSupplier;
    }

    // Fungsi Untuk Menampilkan Daftar Supplier Barang Milik Perusahaan (tb_supplier)
    public function dataSupplier()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_supplier');
        $this->db->where('IdPerusahaan', $user);
        $this->db->order_by('TanggalSupplier', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Supplier Barang Milik Perusahaan (tb_supplier)
    public function detailSupplier($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_supplier as ts');
        $this->db->where('ts.IdSupplier', $where);
        $this->db->where('ts.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = ts.IdUser', 'left');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Supplier Barang Milik Perusahaan (tb_supplier)
    public function ubahSupplier($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Supplier Barang Milik Perusahaan (tb_supplier)
    public function hapusSupplier($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
