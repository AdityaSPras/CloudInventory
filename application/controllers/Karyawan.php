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
        $IdUser        = $this->session->userdata('IdUser');
        $IdSatuan      = $this->input->post('IdSatuan');
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
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']      = 'Tambah Supplier Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Supplier Barang
            $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier', 'required|trim', [
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
        $IdUser               = $this->session->userdata('IdUser');
        $IdSupplier           = $this->input->post('IdSupplier');
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

    //---------------------------- AWAL FUNGSI UNTUK BARANG ----------------------------//
    public function barang()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['barang'] = $this->barang->daftarBarang()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK BARANG ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK BARANG MASUK ----------------------------//
    public function barang_masuk()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Barang Masuk';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['barang_masuk'] = $this->barang_masuk->daftarBarangMasuk()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang_masuk/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK BARANG MASUK ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK BARANG KELUAR ----------------------------//
    public function barang_keluar()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Barang Keluar';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['barang_keluar'] = $this->barang_keluar->daftarBarangKeluar()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/barang_keluar/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK BARANG KELUAR ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK KRITIK & SARAN ----------------------------//
    public function kritik_saran()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Kritik & Saran';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            $this->form_validation->set_rules('Pesan', 'Isi Pesan', 'required|trim', [
                'required' => 'Pesan Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/kritik_saran', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdUser = $this->session->userdata('IdUser');
                $IdPerusahaan = $this->session->userdata('IdPerusahaan');
                $Pesan = $this->input->post('Pesan', true);
                $Tanggal = time();

                $data = [
                    'IdUser' => $IdUser,
                    'IdPerusahaan' => $IdPerusahaan,
                    'Pesan' => $Pesan,
                    'Tanggal' => $Tanggal
                ];

                $this->kritik_saran->kirimKritikSaran($data, 'tb_kritik_saran');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kritik & Saran Berhasil Dikirim</div>');
                redirect('karyawan/kritik_saran');
            }
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK KRITIK & SARAN ----------------------------//

}
