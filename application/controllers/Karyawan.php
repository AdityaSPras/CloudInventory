<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->helper('tanggal_helper');
        $this->load->model('Profil_model', 'profil');
        $this->load->model('Kategori_model', 'kategori');
        $this->load->model('Satuan_model', 'satuan');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Barang_model', 'barang');
        $this->load->model('BarangMasuk_model', 'barang_masuk');
        $this->load->model('BarangKeluar_model', 'barang_keluar');
        $this->load->model('Kritik_saran_model', 'kritik_saran');
    }

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN UTAMA KARYAWAN -------------------------------------------------------- //
    // Fungsi Menampilkan Halaman Utama
    public function index()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']                = 'Halaman Utama';
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['profil']               = $this->profil->dataProfil()->row_array();
            $data['jumlah_barang']        = $this->barang->jumlahBarang();
            $data['jumlah_barang_masuk']  = $this->barang_masuk->jumlahBarangMasuk()->num_rows();
            $data['jumlah_barang_keluar'] = $this->barang_keluar->jumlahBarangKeluar()->num_rows();
            $data['status_paket']         = $this->profil->statusPaket()->row_array();
            $data['jumlah_barang_masuk']  = $this->barang_masuk->jumlahBarangMasuk()->num_rows();
            $data['jumlah_barang_keluar'] = $this->barang_keluar->jumlahBarangKeluar()->num_rows();
            $data['total_pengeluaran']    = $this->barang_masuk->totalBarangMasuk();
            $data['total_pemasukan']      = $this->barang_keluar->totalBarangKeluar();
            $data['hari_ini']             = date('Y-m-d');

            $HariIni    = date("Y-m-d");
            $Perusahaan = $this->session->userdata('IdPerusahaan');
            $AktifPaket = $this->db->select('*')->from('tb_perusahaan as tph')->join('tb_aktivasi as ta', 'ta.IdPerusahaan = tph.IdPerusahaan', 'left')->where('tph.IdPerusahaan', $Perusahaan)->order_by('ta.IdAktivasi', 'DESC')->get()->row_array();

            if ($AktifPaket['AkhirAktif'] <= $HariIni) {
                $this->db->set('IdPaket', 1);
                $this->db->where('IdPerusahaan', $Perusahaan);
                $this->db->update('tb_perusahaan');
            }

            // Melakukan Load View Halaman Utama Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN UTAMA KARYAWAN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK PROFIL -------------------------------------------------------- //
    // Fungsi Menampilkan Profil
    public function profil()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']  = 'Profil Saya';
            $data['user']   = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['profil'] = $this->profil->dataProfil()->row_array();

            // Melakukan Load View Halaman Profil Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/profil/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Profil
    public function ubah_profil()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Ubah Profil';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Lengkap
            $this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap Karyawan', 'required|trim', [
                'required' => 'Nama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Jenis Kelamin
            $this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin Karyawan', 'required|trim', [
                'required' => 'Pilih Jenis Kelamin Terlebih Dahulu!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat
            $this->form_validation->set_rules('Alamat', 'Alamat Karyawan', 'required|trim', [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nomor Telepon
            $this->form_validation->set_rules('NomorTelepon', 'Nomor Telepon Karyawan', 'required|trim', [
                'required' => 'Nomor Telepon Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Profil Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/profil/ubah_profil', $data);
                $this->load->view('templates/users_footer');
            } else {
                $Email        = $this->input->post('Email');
                $NamaLengkap  = $this->input->post('NamaLengkap', true);
                $JenisKelamin = $this->input->post('JenisKelamin', true);
                $Alamat       = $this->input->post('Alamat', true);
                $NomorTelepon = $this->input->post('NomorTelepon', true);
                $upload_image = $_FILES['Foto']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
                    $config['max_size']      = '2048';
                    $config['upload_path']   = './assets/img/users/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('Foto')) {
                        $old_image = $data['user']['Foto'];
                        if ($old_image != 'user_default.png') {
                            unlink(FCPATH . 'assets/img/users/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('Foto', $new_image);
                    } else {
                        $this->session->set_flashdata('error', 'Upload Foto Gagal, Silahkan Coba Lagi!');
                        redirect('karyawan/ubah_profil');
                    }
                }

                $this->db->set('NamaLengkap', $NamaLengkap);
                $this->db->set('JenisKelamin', $JenisKelamin);
                $this->db->set('Alamat', $Alamat);
                $this->db->set('NomorTelepon', $NomorTelepon);
                $this->db->where('Email', $Email);
                $this->db->update('tb_user');

                $this->session->set_flashdata('success', 'Profil Anda Berhasil Diubah');
                redirect('karyawan/profil');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Password
    public function ubah_password()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Ubah Password';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Lama
            $this->form_validation->set_rules('PasswordLama', 'Password Lama', 'required|trim', [
                'required' => 'Password Lama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Baru
            $this->form_validation->set_rules('PasswordBaru', 'Password Baru', 'required|trim|min_length[8]|matches[KonfirmasiPassword]', [
                'required'   => 'Password Baru Tidak Boleh Kosong!',
                'matches'    => 'Password Tidak Sama!',
                'min_length' => 'Password Baru Minimal 8 Karakter!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Konfirmasi Password
            $this->form_validation->set_rules('KonfirmasiPassword', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[PasswordBaru]', [
                'required'   => 'Konfirmasi Password Tidak Boleh Kosong!',
                'matches'    => 'Password Tidak Sama!',
                'min_length' => 'Konfirmasi Password Minimal 8 Karakter!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Password Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/profil/ubah_password', $data);
                $this->load->view('templates/users_footer');
            } else {
                // Jika Password Lama Salah Maka Tampilkan Pesan Error
                $password_lama = $this->input->post('PasswordLama');
                $password_baru = $this->input->post('PasswordBaru');

                if (!password_verify($password_lama, $data['user']['Password'])) {
                    $this->session->set_flashdata('error', 'Password Lama Salah!');
                    redirect('karyawan/ubah_password');
                } else {
                    // Jika Password Lama & Password Baru Sama Maka Tampilkan Pesan Warning
                    if ($password_lama == $password_baru) {
                        $this->session->set_flashdata('warning', 'Password Baru Tidak Boleh Sama Dengan Password Lama!');
                        redirect('karyawan/ubah_password');
                    } else {
                        // Jika Password Berhasil Diubah Maka Tampilkan Pesan Success
                        $enkripsi_password = password_hash($password_baru, PASSWORD_DEFAULT);

                        $this->db->set('Password', $enkripsi_password);
                        $this->db->where('Email', $this->session->userdata('Email'));
                        $this->db->update('tb_user');

                        $this->session->set_flashdata('success', 'Password Berhasil Diubah');
                        redirect('karyawan/profil');
                    }
                }
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Melihat Profil Perusahaan
    public function perusahaan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']      = 'Profil Perusahaan';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Melakukan Load View Halaman Profil Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/profil/perusahaan', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK PROFIL -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KATEGORI BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Kategori Barang Perusahaan
    public function kategori()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Kategori Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['daftar_kategori'] = $this->kategori->dataKategori()->result();

            // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/kategori_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Kategori Barang Perusahaan
    public function tambah_kategori()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']      = 'Tambah Kategori Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Kategori Barang
            $this->form_validation->set_rules('NamaKategori', 'Nama Kategori Barang', 'required|trim', [
                'required' => 'Nama Kategori Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Kategori Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/kategori_barang/tambah_kategori', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdKategori      = $this->kategori->kodeKategori();
                $IdUser          = $this->session->userdata('IdUser');
                $IdPerusahaan    = $this->session->userdata('IdPerusahaan');
                $NamaKategori    = $this->input->post('NamaKategori', true);
                $Keterangan      = $this->input->post('Keterangan', true);
                $TanggalKategori = time();

                $data = [
                    'IdKategori'      => $IdKategori,
                    'IdUser'          => $IdUser,
                    'IdPerusahaan'    => $IdPerusahaan,
                    'NamaKategori'    => $NamaKategori,
                    'Keterangan'      => $Keterangan,
                    'TanggalKategori' => $TanggalKategori
                ];

                $this->kategori->tambahKategori($data, 'tb_kategori');
                $this->session->set_flashdata('success', 'Kategori Berhasil Ditambah');
                redirect('karyawan/kategori');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Kategori Barang Perusahaan
    public function ubah_kategori()
    {
        $IdKategori      = $this->input->post('IdKategori');
        $IdUser          = $this->session->userdata('IdUser');
        $NamaKategori    = $this->input->post('NamaKategori', true);
        $Keterangan      = $this->input->post('Keterangan', true);
        $TanggalKategori = time();

        $data = array(
            'IdUser'          => $IdUser,
            'NamaKategori'    => $NamaKategori,
            'Keterangan'      => $Keterangan,
            'TanggalKategori' => $TanggalKategori
        );

        $id    = decrypt_url($IdKategori);
        $where = array('IdKategori' => $id);

        $this->kategori->ubahKategori($where, $data, 'tb_kategori');
        $this->session->set_flashdata('success', 'Kategori Berhasil Diubah');
        redirect('karyawan/kategori');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KATEGORI BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK SATUAN BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Satuan Barang Perusahaan
    public function satuan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']         = 'Satuan Barang';
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']    = $this->profil->dataProfil()->row_array();
            $data['daftar_satuan'] = $this->satuan->dataSatuan()->result();

            // Melakukan Load View Halaman Daftar Satuan Barang Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/satuan_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Satuan Barang Perusahaan
    public function tambah_satuan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']      = 'Tambah Satuan Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Satuan Barang
            $this->form_validation->set_rules('NamaSatuan', 'Nama Satuan Barang', 'required|trim', [
                'required' => 'Nama Satuan Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Satuan Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/satuan_barang/tambah_satuan', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdSatuan      = $this->satuan->kodeSatuan();
                $IdUser        = $this->session->userdata('IdUser');
                $IdPerusahaan  = $this->session->userdata('IdPerusahaan');
                $NamaSatuan    = $this->input->post('NamaSatuan', true);
                $Keterangan    = $this->input->post('Keterangan', true);
                $TanggalSatuan = time();

                $data = [
                    'IdSatuan'      => $IdSatuan,
                    'IdUser'        => $IdUser,
                    'IdPerusahaan'  => $IdPerusahaan,
                    'NamaSatuan'    => $NamaSatuan,
                    'Keterangan'    => $Keterangan,
                    'TanggalSatuan' => $TanggalSatuan
                ];

                $this->satuan->tambahSatuan($data, 'tb_satuan');
                $this->session->set_flashdata('success', 'Satuan Berhasil Ditambah');
                redirect('karyawan/satuan');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Satuan Barang Perusahaan
    public function ubah_satuan()
    {
        $IdSatuan      = $this->input->post('IdSatuan');
        $IdUser        = $this->session->userdata('IdUser');
        $NamaSatuan    = $this->input->post('NamaSatuan', true);
        $Keterangan    = $this->input->post('Keterangan', true);
        $TanggalSatuan = time();

        $data = array(
            'IdUser'        => $IdUser,
            'NamaSatuan'    => $NamaSatuan,
            'Keterangan'    => $Keterangan,
            'TanggalSatuan' => $TanggalSatuan
        );

        $id    = decrypt_url($IdSatuan);
        $where = array('IdSatuan' => $id);

        $this->satuan->ubahSatuan($where, $data, 'tb_satuan');
        $this->session->set_flashdata('success', 'Satuan Berhasil Diubah');
        redirect('karyawan/satuan');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK SATUAN BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK SUPPLIER BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Supplier Barang Perusahaan
    public function supplier()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Supplier Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['daftar_supplier'] = $this->supplier->dataSupplier()->result();

            // Melakukan Load View Halaman Daftar Supplier Barang Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/supplier_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Supplier Barang Perusahaan
    public function tambah_supplier()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']      = 'Tambah Supplier Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Supplier Barang
            $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier Barang', 'required|trim', [
                'required' => 'Nama Supplier Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat Supplier Barang
            $this->form_validation->set_rules('AlamatSupplier', 'Alamat Supplier Barang', 'required|trim', [
                'required' => 'Alamat Supplier Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Supplier Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/supplier_barang/tambah_supplier', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdSupplier           = $this->supplier->kodeSupplier();
                $IdUser               = $this->session->userdata('IdUser');
                $IdPerusahaan         = $this->session->userdata('IdPerusahaan');
                $NamaSupplier         = $this->input->post('NamaSupplier', true);
                $AlamatSupplier       = $this->input->post('AlamatSupplier', true);
                $NomorTeleponSupplier = $this->input->post('NomorTeleponSupplier', true);
                $EmailSupplier        = $this->input->post('EmailSupplier', true);
                $Keterangan           = $this->input->post('Keterangan', true);
                $TanggalSupplier      = time();

                $data = [
                    'IdSupplier'           => $IdSupplier,
                    'IdUser'               => $IdUser,
                    'IdPerusahaan'         => $IdPerusahaan,
                    'NamaSupplier'         => $NamaSupplier,
                    'AlamatSupplier'       => $AlamatSupplier,
                    'NomorTeleponSupplier' => $NomorTeleponSupplier,
                    'EmailSupplier'        => htmlspecialchars($EmailSupplier),
                    'Keterangan'           => $Keterangan,
                    'TanggalSupplier'      => $TanggalSupplier
                ];

                $this->supplier->tambahSupplier($data, 'tb_supplier');
                $this->session->set_flashdata('success', 'Supplier Berhasil Ditambah');
                redirect('karyawan/supplier');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Supplier Barang Perusahaan
    public function detail_supplier($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $id                      = decrypt_url($id);
            $data['title']           = 'Detail Supplier Barang';
            $data['detail_supplier'] = $this->supplier->detailSupplier($id)->result();
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Supplier Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Supplier Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/supplier_barang/detail_supplier', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Supplier Barang Perusahaan
    public function ubah_supplier()
    {
        $IdSupplier           = $this->input->post('IdSupplier');
        $IdUser               = $this->session->userdata('IdUser');
        $NamaSupplier         = $this->input->post('NamaSupplier', true);
        $AlamatSupplier       = $this->input->post('AlamatSupplier', true);
        $NomorTeleponSupplier = $this->input->post('NomorTeleponSupplier', true);
        $EmailSupplier        = $this->input->post('EmailSupplier', true);
        $Keterangan           = $this->input->post('Keterangan', true);
        $TanggalSupplier      = time();

        $data = array(
            'IdUser'               => $IdUser,
            'NamaSupplier'         => $NamaSupplier,
            'AlamatSupplier'       => $AlamatSupplier,
            'NomorTeleponSupplier' => $NomorTeleponSupplier,
            'EmailSupplier'        => htmlspecialchars($EmailSupplier),
            'Keterangan'           => $Keterangan,
            'TanggalSupplier'      => $TanggalSupplier
        );

        $id    = decrypt_url($IdSupplier);
        $where = array('IdSupplier' => $id);

        $this->supplier->ubahSupplier($where, $data, 'tb_supplier');
        $this->session->set_flashdata('success', 'Supplier Berhasil Diubah');
        redirect('karyawan/supplier');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK SUPPLIER BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Barang Perusahaan
    public function barang()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']         = 'Barang';
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']    = $this->profil->dataProfil()->row_array();
            $data['daftar_barang'] = $this->barang->dataBarang()->result();
            $data['jumlah_barang'] = $this->barang->jumlahBarang();
            $data['status_paket']  = $this->profil->statusPaket()->row_array();

            // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Perusahaan
    public function tambah_barang()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Tambah Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_kategori']   = $this->kategori->dataKategori()->result();
            $data['data_satuan']     = $this->satuan->dataSatuan()->result();
            $data['jumlah_kategori'] = $this->kategori->dataKategori()->num_rows();
            $data['jumlah_satuan']   = $this->satuan->dataSatuan()->num_rows();
            $data['status_paket']    = $this->profil->statusPaket()->row_array();
            $data['jumlah_barang']   = $this->barang->jumlahBarang();


            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Barang
            $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'required|trim', [
                'required' => 'Nama Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Harga Jual Barang
            $this->form_validation->set_rules('HargaJual', 'Harga Jual Barang', 'required|trim', [
                'required' => 'Harga Jual Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Kategori Barang
            $this->form_validation->set_rules('IdKategori', 'Nama Kategori Barang', 'required', [
                'required' => 'Kategori Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Satuan Barang
            $this->form_validation->set_rules('IdSatuan', 'Nama Satuan Barang', 'required', [
                'required' => 'Satuan Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Stok Barang
            $this->form_validation->set_rules('Stok', 'Stok Barang', 'required|trim', [
                'required' => 'Stok Awal Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Stok Minimum Barang
            $this->form_validation->set_rules('StokMinimum', 'Stok Minimum Barang', 'required|trim', [
                'required' => 'Stok Minimum Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang/tambah_barang', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdBarang      = $this->barang->kodeBarang();
                $IdUser        = $this->session->userdata('IdUser');
                $IdPerusahaan  = $this->session->userdata('IdPerusahaan');
                $Kategori      = $this->input->post('IdKategori');
                $Satuan        = $this->input->post('IdSatuan');
                $NamaBarang    = $this->input->post('NamaBarang', true);
                $HargaJual     = $this->input->post('HargaJual', true);
                $Stok          = $this->input->post('Stok', true);
                $StokMinimum   = $this->input->post('StokMinimum', true);
                $TanggalBarang = time();
                $IdKategori    = decrypt_url($Kategori);
                $IdSatuan      = decrypt_url($Satuan);

                $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/items/';

                $this->load->library('upload', $config);

                $namaFile = $_FILES['Gambar']['name'];

                if ($namaFile == '') {
                    $ganti = 'items_default.png';
                } else {
                    if (!$this->upload->do_upload('Gambar')) {
                        $this->session->set_flashdata('error', 'Upload Gambar Gagal!');
                        redirect('karyawan/tambah_barang');
                    } else {
                        $data = array('Gambar' => $this->upload->data());

                        $nama_file = $data['Gambar']['file_name'];
                        $ganti     = str_replace(" ", "_", $nama_file);
                    }
                }

                $data = array(
                    'IdBarang'      => $IdBarang,
                    'IdUser'        => $IdUser,
                    'IdPerusahaan'  => $IdPerusahaan,
                    'IdKategori'    => $IdKategori,
                    'IdSatuan'      => $IdSatuan,
                    'NamaBarang'    => $NamaBarang,
                    'Gambar'        => $ganti,
                    'HargaJual'     => $HargaJual,
                    'Stok'          => $Stok,
                    'StokMinimum'   => $StokMinimum,
                    'TanggalBarang' => $TanggalBarang
                );

                $this->barang->tambahBarang($data, 'tb_barang');
                $this->session->set_flashdata('success', 'Barang Berhasil Ditambah');
                redirect('karyawan/barang');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Barang Perusahaan
    public function detail_barang($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $id                    = decrypt_url($id);
            $data['title']         = 'Detail Barang';
            $data['detail_barang'] = $this->barang->detailBarang($id)->result();
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang/detail_barang', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Barang Perusahaan
    public function ubah_barang($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Ubah Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_kategori']   = $this->kategori->dataKategori()->result();
            $data['data_satuan']     = $this->satuan->dataSatuan()->result();
            $data['jumlah_kategori'] = $this->kategori->dataKategori()->num_rows();
            $data['jumlah_satuan']   = $this->satuan->dataSatuan()->num_rows();
            $id                      = decrypt_url($id);
            $where                   = array('IdBarang' => $id);
            $data['ubah_barang']     = $this->barang->getIdBarang($where, 'tb_barang')->result();

            if ($id == NULL) {
                // Jika ID Barang Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang/ubah_barang', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    public function proses_ubah_barang()
    {
        $config['upload_path']   = './assets/img/items/';
        $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
        $config['max_size']      = '2048';

        $NamaFile = $_FILES['Gambar']['name'];
        $error    = $_FILES['Gambar']['error'];

        $this->load->library('upload', $config);

        $IdBarang     = $this->input->post('IdBarang');
        $Kategori     = $this->input->post('IdKategori');
        $Satuan       = $this->input->post('IdSatuan');
        $NamaBarang   = $this->input->post('NamaBarang');
        $HargaJual    = $this->input->post('HargaJual');
        $Stok         = $this->input->post('Stok');
        $StokMinimum  = $this->input->post('StokMinimum');
        $FotoLama     = $this->input->post('FotoLama');
        $IdKategori   = decrypt_url($Kategori);
        $IdSatuan     = decrypt_url($Satuan);

        if ($NamaFile == '') {
            $GambarBaru = $FotoLama;
        } else {
            if (!$this->upload->do_upload('Gambar')) {
                $error = $this->session->set_flashdata('error', 'Upload Gambar Gagal, Silahkan Coba Lagi!');
                redirect('karyawan/ubah_barang/' . $IdBarang);
            } else {
                $data       = array('Gambar' => $this->upload->data());
                $Nama_File  = $data['Gambar']['file_name'];
                $GambarBaru = str_replace(" ", "_", $Nama_File);

                if ($FotoLama == 'items_default.png') {
                } else {
                    unlink('./assets/img/items/' . $FotoLama . '');
                }
            }
        }

        $data = array(
            'IdKategori'  => $IdKategori,
            'IdSatuan'    => $IdSatuan,
            'NamaBarang'  => $NamaBarang,
            'Gambar'      => $GambarBaru,
            'HargaJual'   => $HargaJual,
            'Stok'        => $Stok,
            'StokMinimum' => $StokMinimum
        );

        $id    = decrypt_url($IdBarang);
        $where = array('IdBarang' => $id);

        $this->barang->ubahBarang($where, $data, 'tb_barang');
        $this->session->set_flashdata('success', 'Barang Berhasil Diubah');
        redirect('karyawan/barang');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG MASUK -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Barang Masuk Perusahaan
    public function barang_masuk()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']               = 'Barang Masuk';
            $data['user']                = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']          = $this->profil->dataProfil()->row_array();
            $data['daftar_barang_masuk'] = $this->barang_masuk->daftarBarangMasuk()->result();
            $data['data_supplier']       = $this->supplier->dataSupplier()->result();
            $data['jumlah_supplier']     = $this->supplier->dataSupplier()->num_rows();

            // Melakukan Load View Halaman Daftar Barang Masuk Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang_masuk/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Masuk Perusahaan
    public function tambah_barang_masuk()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Tambah Barang Masuk';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_barang']     = $this->barang->dataBarang()->result();
            $data['data_supplier']   = $this->supplier->dataSupplier()->result();
            $data['jumlah_barang']   = $this->barang->dataBarang()->num_rows();
            $data['jumlah_supplier'] = $this->supplier->dataSupplier()->num_rows();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Barang Masuk
            $this->form_validation->set_rules('IdBarang', 'Nama Barang Masuk', 'required|trim', [
                'required' => 'Nama Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Supplier Barang
            $this->form_validation->set_rules('IdSupplier', 'Nama Supplier Barang', 'required|trim', [
                'required' => 'Nama Supplier Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Harga Beli Barang
            $this->form_validation->set_rules('HargaMasuk', 'Harga Beli Barang', 'required|trim', [
                'required' => 'Harga Masuk Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Jumlah Masuk Barang
            $this->form_validation->set_rules('JumlahMasuk', 'Jumlah Masuk Barang', 'required|trim', [
                'required' => 'Jumlah Masuk Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Tanggal Masuk Barang
            $this->form_validation->set_rules('TanggalMasuk', 'Tanggal Masuk Barang', 'required|trim', [
                'required' => 'Tanggal Masuk Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Barang Masuk Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang_masuk/tambah_barang_masuk', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdBarangMasuk = $this->barang_masuk->kodeBarangMasuk();
                $IdUser        = $this->session->userdata('IdUser');
                $IdPerusahaan  = $this->session->userdata('IdPerusahaan');
                $Barang        = $this->input->post('IdBarang');
                $Supplier      = $this->input->post('IdSupplier');
                $HargaMasuk    = $this->input->post('HargaMasuk', true);
                $TanggalMasuk  = $this->input->post('TanggalMasuk', true);
                $JumlahMasuk   = $this->input->post('JumlahMasuk', true);
                $IdBarang      = decrypt_url($Barang);
                $IdSupplier    = decrypt_url($Supplier);

                $data = array(
                    'IdBarangMasuk' => $IdBarangMasuk,
                    'IdUser'        => $IdUser,
                    'IdPerusahaan'  => $IdPerusahaan,
                    'IdBarang'      => $IdBarang,
                    'IdSupplier'    => $IdSupplier,
                    'HargaMasuk'    => $HargaMasuk,
                    'TanggalMasuk'  => $TanggalMasuk,
                    'JumlahMasuk'   => $JumlahMasuk
                );

                $this->barang_masuk->tambahBarangMasuk($data, 'tb_barang_masuk');
                $this->session->set_flashdata('success', 'Barang Masuk Berhasil Ditambah');
                redirect('karyawan/barang_masuk');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Barang Masuk Perusahaan
    public function detail_barang_masuk($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $id                          = decrypt_url($id);
            $data['title']               = 'Detail Barang Masuk';
            $data['detail_barang_masuk'] = $this->barang_masuk->detailBarangMasuk($id)->result();
            $data['user']                = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Masuk Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Masuk Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang_masuk/detail_barang_masuk', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG MASUK -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG KELUAR --------------------------------------------------------//
    // Fungsi Untuk Menampilkan Daftar Barang Keluar Perusahaan
    public function barang_keluar()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']                = 'Barang Keluar';
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']           = $this->profil->dataProfil()->row_array();
            $data['daftar_barang_keluar'] = $this->barang_keluar->daftarBarangKeluar()->result();

            // Melakukan Load View Halaman Daftar Barang Keluar Perusahaan Untuk Karyawan
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang_keluar/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Keluar Perusahaan
    public function tambah_barang_keluar()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']           = 'Tambah Barang Keluar';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_barang']     = $this->barang->dataBarang()->result();
            $data['jumlah_barang']   = $this->barang->dataBarang()->num_rows();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Barang Keluar
            $this->form_validation->set_rules('IdBarang', 'Nama Barang Keluar', 'required|trim', [
                'required' => 'Nama Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Harga Keluar Barang
            $this->form_validation->set_rules('HargaKeluar', 'Harga Keluar Barang', 'required|trim', [
                'required' => 'Harga Keluar Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Jumlah Keluar Barang
            $this->form_validation->set_rules('JumlahKeluar', 'Jumlah Keluar Barang', 'required|trim', [
                'required' => 'Jumlah Keluar Barang Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Tanggal Keluar Barang
            $this->form_validation->set_rules('TanggalKeluar', 'Tanggal Keluar Barang', 'required|trim', [
                'required' => 'Tanggal Keluar Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Barang Keluar Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang_keluar/tambah_barang_keluar', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdBarangKeluar = $this->barang_keluar->kodeBarangKeluar();
                $IdUser         = $this->session->userdata('IdUser');
                $IdPerusahaan   = $this->session->userdata('IdPerusahaan');
                $Barang         = $this->input->post('IdBarang');
                $HargaKeluar    = $this->input->post('HargaKeluar', true);
                $TanggalKeluar  = $this->input->post('TanggalKeluar', true);
                $JumlahKeluar   = $this->input->post('JumlahKeluar', true);
                $IdBarang       = decrypt_url($Barang);

                $data = array(
                    'IdBarangKeluar' => $IdBarangKeluar,
                    'IdUser'         => $IdUser,
                    'IdPerusahaan'   => $IdPerusahaan,
                    'IdBarang'       => $IdBarang,
                    'HargaKeluar'    => $HargaKeluar,
                    'TanggalKeluar'  => $TanggalKeluar,
                    'JumlahKeluar'   => $JumlahKeluar,
                    'TotalKeluar'    => $HargaKeluar * $JumlahKeluar
                );

                $this->barang_keluar->tambahBarangKeluar($data, 'tb_barang_keluar');
                $this->session->set_flashdata('success', 'Barang Keluar Berhasil Dihapus');
                redirect('karyawan/barang_keluar');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Mendapatkan ID Barang (Harga Barang)
    public function getBarang($id)
    {
        $id     = decrypt_url($id);
        $barang = $this->db->where('IdBarang', $id)->get('tb_barang')->row();
        echo json_encode($barang);
    }

    // Fungsi Untuk Menampilkan Detail Barang Keluar Perusahaan
    public function detail_barang_keluar($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $id                           = decrypt_url($id);
            $data['title']                = 'Detail Barang Keluar';
            $data['detail_barang_keluar'] = $this->barang_keluar->detailBarangKeluar($id)->result();
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Keluar Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Keluar Perusahaan Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/barang_keluar/detail_barang_keluar', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG KELUAR -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KRITIK & SARAN -------------------------------------------------------- //
    // Fungsi Untuk Memberi Kritik & Saran Kepada Penyedia Layanan
    public function kritik_saran()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Kritik & Saran';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Isi Kritik & Saran
            $this->form_validation->set_rules('Pesan', 'Isi Kritik & Saran', 'required|trim', [
                'required' => 'Pesan Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Kirim Kritik & Saran Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/kritik_saran', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdUser       = $this->session->userdata('IdUser');
                $IdPerusahaan = $this->session->userdata('IdPerusahaan');
                $Pesan        = $this->input->post('Pesan', true);
                $Tanggal      = time();

                $data = [
                    'IdUser'       => $IdUser,
                    'IdPerusahaan' => $IdPerusahaan,
                    'Pesan'        => $Pesan,
                    'Tanggal'      => $Tanggal
                ];

                $this->kritik_saran->kirimKritikSaran($data, 'tb_kritik_saran');
                $this->session->set_flashdata('success', 'Kritik & Saran Berhasil Dikirim');
                redirect('karyawan/kritik_saran');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KRITIK & SARAN --------------------------------------------------------//
}
