<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_model extends CI_Model
{
    // Fungsi Untuk Tambah Satuan Barang Perusahaan (tb_kategori)
    public function tambahSatuan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Satuan Barang Dengan Format (ID-SAT-XXXX)
    public function kodeSatuan()
    {
        $this->db->select('RIGHT(tb_satuan.IdSatuan,4) as Kode', FALSE);
        $this->db->order_by('IdSatuan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_satuan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax    = str_pad($Kode, 4, "0", STR_PAD_LEFT);
        $KodeSatuan = "ID-SAT-" . $KodeMax;
        return $KodeSatuan;
    }

    // Fungsi Untuk Menampilkan Daftar Satuan Barang Milik Perusahaan (tb_satuan)
    public function dataSatuan()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_satuan');
        $this->db->where('IdPerusahaan', $user);
        $this->db->order_by('IdSatuan', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Satuan Barang Milik Perusahaan (tb_satuan)
    public function detailSatuan($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_satuan as ts');
        $this->db->where('ts.IdSatuan', $where);
        $this->db->where('ts.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = ts.IdUser', 'left');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Ubah Satuan Barang Milik Perusahaan (tb_satuan)
    public function ubahSatuan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Hapus Satuan Barang Milik Perusahaan (tb_satuan)
    public function hapusSatuan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
