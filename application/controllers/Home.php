<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('rupiah_helper');
        $this->load->model('Paket_model', 'paket');
        $this->load->model('Profil_model', 'kontak');
    }

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN HOME -------------------------------------------------------- //
    public function index()
    {
        $data['paket_satu'] = $this->paket->paketSatu()->row_array();
        $data['paket_dua']  = $this->paket->paketDua()->row_array();
        $data['paket_tiga'] = $this->paket->paketTiga()->row_array();
        $data['kontak']     = $this->kontak->kontakLayanan()->row_array();

        $this->load->view('home', $data);
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN HOME -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN ERROR 404 -------------------------------------------------------- //
    public function error()
    {
        $this->load->view('error_404');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN ERROR 404 -------------------------------------------------------- //
}
