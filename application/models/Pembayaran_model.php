<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    public function pilihPembayaran($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Membuat ID Pembayaran Dengan Format (ID-PEM-XXX)
    public function kodePembayaran()
    {
        $this->db->select('RIGHT(tb_pembayaran.IdPembayaran,3) as Kode', FALSE);
        $this->db->order_by('IdPembayaran', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_pembayaran');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $Kode = intval($data->Kode) + 1;
        } else {
            $Kode = 1;
        }
        $KodeMax        = str_pad($Kode, 3, "0", STR_PAD_LEFT);
        $KodePembayaran = "ID-PEM-" . $KodeMax;
        return $KodePembayaran;
    }

    // Fungsi Untuk Menampilkan Jumlah Permintaan Pembayaran Paket Layanan Yang Belum Dikonfirmasi (tb_pembayaran)
    public function pembayaranBelumDikonfirmasi()
    {
        $this->db->select('*');
        $this->db->from('tb_pembayaran');
        $this->db->where('StatusPembayaran', 'Pending');
        $this->db->like('TanggalPembayaran', '');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Riwayat Pembayaran Paket Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_pembayaran, tb_user, tb_perusahaan, dan tb_paket)
    public function riwayatPembayaran()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');
        $this->db->where('tpe.IdPerusahaan', $user);
        $this->db->order_by('IdPembayaran', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function pembayaranTerakhir()
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');
        $this->db->where('tpe.IdPerusahaan', $user);
        $this->db->order_by('IdPembayaran', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function getIdPembayaran($where, $table)
    {
        $user       = $this->session->userdata('IdPerusahaan');

        $this->db->where('IdPerusahaan', $user);

        $query = $this->db->get_where($table, $where);

        return $query;
    }

    public function bayarPaket($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi Untuk Menampilkan Daftar Pembayaran Paket Perusahaan Dengan Menggabungkan 4 Tabel Secara Left Join (tb_pembayaran, tb_user, tb_perusahaan, dan tb_paket)
    public function daftarPembayaran()
    {
        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');
        $this->db->order_by('IdPembayaran', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // Fungsi Untuk Menampilkan Detail Pembayaran Dengan Menggabungkan 4 Tabel Secara Left Join (tb_pembayaran, tb_user, tb_perusahaan, dan tb_paket)
    public function detailPembayaran($where)
    {
        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->where('tpe.IdPembayaran', $where);
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_aktivasi as ta', 'ta.IdPembayaran = tpe.IdPembayaran', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');

        return $this->db->get();
    }

    public function detailBayar($where)
    {
        $user = $this->session->userdata('IdPerusahaan');

        $this->db->select('*');
        $this->db->from('tb_pembayaran as tpe');
        $this->db->where('tpe.IdPembayaran', $where);
        $this->db->where('tpe.IdPerusahaan', $user);
        $this->db->join('tb_user as tu', 'tu.IdUser = tpe.IdUser', 'left');
        $this->db->join('tb_perusahaan as tph', 'tph.IdPerusahaan = tpe.IdPerusahaan', 'left');
        $this->db->join('tb_paket as tp', 'tp.IdPaket = tpe.IdPaket', 'left');
        $this->db->join('tb_aktivasi as ta', 'ta.IdPembayaran = tpe.IdPembayaran', 'left');

        $query = $this->db->get();
        return $query;
    }

    public function statusKonfirmasi($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Fungsi Untuk Hapus Pembayaran Perusahaan (tb_pembayaran)
    public function hapusPembayaran($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;
    }
}
