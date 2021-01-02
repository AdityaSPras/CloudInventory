<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->helper('rupiah_helper');
        $this->load->helper('tanggal_helper');
        $this->load->model('Paket_model', 'paket');
        $this->load->model('Perusahaan_model', 'perusahaan');
        $this->load->model('Kategori_model', 'kategori');
        $this->load->model('Satuan_model', 'satuan');
        $this->load->model('Supplier_model', 'supplier');
        $this->load->model('Barang_model', 'barang');
        $this->load->model('Kritik_saran_model', 'kritik_saran');
        $this->load->model('Profil_model', 'profil');
        $this->load->model('Users_model', 'users');
        $this->load->model('BarangMasuk_model', 'barang_masuk');
        $this->load->model('BarangKeluar_model', 'barang_keluar');
    }

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN UTAMA ADMIN -------------------------------------------------------- //
    // Fungsi Menampilkan Halaman Utama
    public function index()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {
            $data['title']                = 'Halaman Utama';
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['profil']               = $this->profil->dataProfil()->row_array();
            $data['jumlah_karyawan']      = $this->users->dataKaryawan()->num_rows();
            $data['jumlah_barang']        = $this->barang->jumlahBarang();
            $data['status_paket']         = $this->profil->statusPaket()->row_array();
            $data['jumlah_barang_masuk']  = $this->barang_masuk->jumlahBarangMasuk()->num_rows();
            $data['jumlah_barang_keluar'] = $this->barang_keluar->jumlahBarangKeluar()->num_rows();
            $data['total_pengeluaran']    = $this->barang_masuk->totalBarangMasuk();
            $data['total_pemasukan']      = $this->barang_keluar->totalBarangKeluar();
            $data['hari_ini']             = date('Y-m-d');

            // Melakukan Load View Halaman Utama Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN UTAMA ADMIN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK PROFIL -------------------------------------------------------- //
    // Fungsi Menampilkan Profil
    public function profil()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']  = 'Profil Saya';
            $data['user']   = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['profil'] = $this->profil->dataProfil()->row_array();

            // Melakukan Load View Halaman Profil Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/profil/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Profil
    public function ubah_profil()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title'] = 'Ubah Profil';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Lengkap
            $this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap Admin', 'required|trim', [
                'required' => 'Nama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Jenis Kelamin
            $this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin Admin', 'required|trim', [
                'required' => 'Pilih Jenis Kelamin Terlebih Dahulu!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat
            $this->form_validation->set_rules('Alamat', 'Alamat Admin', 'required|trim', [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nomor Telepon
            $this->form_validation->set_rules('NomorTelepon', 'Nomor Telepon Admin', 'required|trim', [
                'required' => 'Nomor Telepon Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Profil Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/profil/ubah_profil', $data);
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
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/users/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('Foto')) {
                        $old_image = $data['user']['Foto'];
                        if ($old_image != 'user_default.png') {
                            unlink(FCPATH . 'assets/img/users/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('Foto', $new_image);
                    } else {
                        $this->session->set_flashdata('error', 'Upload Foto Gagal!');
                        redirect('admin/ubah_profil');
                    }
                }

                $this->db->set('NamaLengkap', $NamaLengkap);
                $this->db->set('JenisKelamin', $JenisKelamin);
                $this->db->set('Alamat', $Alamat);
                $this->db->set('NomorTelepon', $NomorTelepon);
                $this->db->where('Email', $Email);
                $this->db->update('tb_user');

                $this->session->set_flashdata('success', 'Profil Anda Berhasil Diubah');
                redirect('admin/profil');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Password
    public function ubah_password()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title'] = 'Ubah Password';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Lama
            $this->form_validation->set_rules('PasswordLama', 'Password Lama', 'required|trim', [
                'required' => 'Password Lama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Baru
            $this->form_validation->set_rules('PasswordBaru', 'Password Baru', 'required|trim|min_length[8]|matches[KonfirmasiPassword]', [
                'required' => 'Password Baru Tidak Boleh Kosong!',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Password Baru Minimal 8 Karakter!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Konfirmasi Password
            $this->form_validation->set_rules('KonfirmasiPassword', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[PasswordBaru]', [
                'required' => 'Konfirmasi Password Tidak Boleh Kosong!',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Konfirmasi Password Minimal 8 Karakter!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Password Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/profil/ubah_password', $data);
                $this->load->view('templates/users_footer');
            } else {
                // Jika Password Lama Salah Maka Tampilkan Pesan Error
                $password_lama = $this->input->post('PasswordLama');
                $password_baru = $this->input->post('PasswordBaru');

                if (!password_verify($password_lama, $data['user']['Password'])) {
                    $this->session->set_flashdata('error', 'Password Lama Salah!');
                    redirect('admin/ubah_password');
                } else {
                    // Jika Password Lama & Password Baru Sama Maka Tampilkan Pesan Warning
                    if ($password_lama == $password_baru) {
                        $this->session->set_flashdata('warning', 'Password Baru Tidak Boleh Sama Dengan Password Lama!');
                        redirect('admin/ubah_password');
                    } else {
                        // Jika Password Berhasil Diubah Maka Tampilkan Pesan Success
                        $enkripsi_password = password_hash($password_baru, PASSWORD_DEFAULT);

                        $this->db->set('Password', $enkripsi_password);
                        $this->db->where('Email', $this->session->userdata('Email'));
                        $this->db->update('tb_user');

                        $this->session->set_flashdata('success', 'Password Berhasil Diubah');
                        redirect('admin/profil');
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
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']      = 'Profil Perusahaan';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Melakukan Load View Halaman Profil Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/profil/perusahaan', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Perusahaan
    public function ubah_perusahaan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']      = 'Ubah Profil Perusahaan';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Perusahaan
            $this->form_validation->set_rules('NamaPerusahaan', 'Nama Perusahaan', 'required|trim', [
                'required' => 'Nama Perusahaan Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Pemilik
            $this->form_validation->set_rules('NamaPemilik', 'Nama Pemilik Perusahaan', 'required|trim', [
                'required' => 'Nama Pemilik Perusahaan Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat Perusahaan
            $this->form_validation->set_rules('AlamatPerusahaan', 'Alamat Perusahaan', 'required|trim', [
                'required' => 'Alamat Perusahaan Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nomor Telepon Perusahaan
            $this->form_validation->set_rules('NomorTeleponPerusahaan', 'Nomor Telepon Perusahaan', 'required|trim', [
                'required' => 'Nomor Telepon Perusahaan Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Email Perusahaan
            $this->form_validation->set_rules('EmailPerusahaan', 'Email Perusahaan', 'required|trim|valid_email', [
                'required'    => 'Email Perusahaan Tidak Boleh Kosong!',
                'valid_email' => 'Email Salah!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Profil Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/profil/ubah_perusahaan', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdPerusahaan           = $this->session->userdata('IdPerusahaan');
                $NamaPerusahaan         = $this->input->post('NamaPerusahaan', true);
                $NamaPemilik            = $this->input->post('NamaPemilik', true);
                $AlamatPerusahaan       = $this->input->post('AlamatPerusahaan', true);
                $NomorTeleponPerusahaan = $this->input->post('NomorTeleponPerusahaan', true);
                $Fax                    = $this->input->post('Fax', true);
                $EmailPerusahaan        = $this->input->post('EmailPerusahaan', true);

                $upload_image = $_FILES['Logo']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/company/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('Logo')) {
                        $old_image = $data['perusahaan']['Logo'];
                        if ($old_image != 'company_default.png') {
                            unlink(FCPATH . 'assets/img/company/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('Logo', $new_image);
                    } else {
                        $this->session->set_flashdata('error', 'Upload Foto Gagal!');
                        redirect('admin/ubah_perusahaan');
                    }
                }

                $this->db->set('NamaPerusahaan', $NamaPerusahaan);
                $this->db->set('NamaPemilik', $NamaPemilik);
                $this->db->set('AlamatPerusahaan', $AlamatPerusahaan);
                $this->db->set('NomorTeleponPerusahaan', $NomorTeleponPerusahaan);
                $this->db->set('Fax', $Fax);
                $this->db->set('EmailPerusahaan', $EmailPerusahaan);
                $this->db->where('IdPerusahaan', $IdPerusahaan);
                $this->db->update('tb_perusahaan');

                $this->session->set_flashdata('success', 'Profil Perusahaan Berhasil Diubah');
                redirect('admin/perusahaan');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK PROFIL -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KARYAWAN -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Karyawan Perusahaan
    public function karyawan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {
            $data['title']           = 'Karyawan';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['daftar_karyawan'] = $this->users->dataKaryawan()->result();
            $data['jumlah_karyawan'] = $this->users->dataKaryawan()->num_rows();
            $data['status_paket']    = $this->profil->statusPaket()->row_array();

            // Melakukan Load View Halaman Daftar Karyawan Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/karyawan/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Karyawan Perusahaan
    public function tambah_karyawan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {
            $data['title']      = 'Tambah Karyawan';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Lengkap Karyawan
            $this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap Karyawan', 'required|trim', [
                'required' => 'Nama Karyawan Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Jenis Kelamin Karyawan
            $this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin Karyawan', 'required', [
                'required' => 'Jenis Kelamin Karyawan Harus Dipilih!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Email Karyawan
            $this->form_validation->set_rules('Email', 'Email Karyawan', 'required|trim|valid_email|is_unique[tb_user.Email]', [
                'required'    => 'Email Karyawan Tidak Boleh Kosong!',
                'valid_email' => 'Email Salah!',
                'is_unique'   => 'Email Sudah Digunakan!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Karyawan
            $this->form_validation->set_rules('Password', 'Password Karyawan', 'required|trim|min_length[8]', [
                'required'   => 'Password Karyawan Tidak Boleh Kosong!',
                'min_length' => 'Password Karyawan Minimal 8 Karakter!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Karyawan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/karyawan/tambah_karyawan', $data);
                $this->load->view('templates/users_footer');
            } else {
                $IdUser        = $this->users->kodeKaryawan();
                $IdPerusahaan  = $this->session->userdata('IdPerusahaan');
                $NamaLengkap   = $this->input->post('NamaLengkap', true);
                $Alamat        = $this->input->post('Alamat', true);
                $JenisKelamin  = $this->input->post('JenisKelamin', true);
                $NomorTelepon  = $this->input->post('NomorTelepon', true);
                $Email         = $this->input->post('Email', true);
                $Level         = 'Karyawan';
                $Status        = 'Aktif';
                $TanggalDibuat = time();

                $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/users/';

                $this->load->library('upload', $config);

                $namaFile = $_FILES['Foto']['name'];

                if ($namaFile == '') {
                    $ganti = 'user_default.png';
                } else {
                    if (!$this->upload->do_upload('Foto')) {
                        $this->session->set_flashdata('error', 'Upload Foto Gagal!');
                        redirect('admin/tambah_karyawan');
                    } else {
                        $data = array('Foto' => $this->upload->data());

                        $nama_file = $data['Foto']['file_name'];
                        $ganti     = str_replace(" ", "_", $nama_file);
                    }
                }

                $data = array(
                    'IdUser'        => $IdUser,
                    'IdPerusahaan'  => $IdPerusahaan,
                    'NamaLengkap'   => htmlspecialchars($NamaLengkap),
                    'Alamat'        => $Alamat,
                    'JenisKelamin'  => $JenisKelamin,
                    'Foto'          => $ganti,
                    'NomorTelepon'  => $NomorTelepon,
                    'Email'         => htmlspecialchars($Email),
                    'Password'      => password_hash($this->input->post('Password'), PASSWORD_DEFAULT),
                    'Level'         => $Level,
                    'Status'        => $Status,
                    'TanggalDibuat' => $TanggalDibuat
                );

                $this->users->tambahKaryawan($data, 'tb_user');
                $this->session->set_flashdata('success', 'Karyawan Berhasil Ditambah');
                redirect('admin/karyawan');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Melihat Detail Karyawan Perusahaan
    public function detail_karyawan($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                      = decrypt_url($id);
            $data['title']           = 'Detail Karyawan';
            $data['detail_karyawan'] = $this->users->detailKaryawan($id)->result();
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Karyawan Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Karyawan Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/karyawan/detail_karyawan', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Hapus Karyawan Perusahaan
    public function hapus_karyawan($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdUser' => $id);
        $Foto  = $this->users->getFoto($where);

        if ($Foto) {
            if ($Foto == 'user_default.png') {
            } else {
                unlink('./assets/img/users/' . $Foto . '');
            }
            $this->users->hapusKaryawan($where, 'tb_user');
        }

        $this->session->set_flashdata('success', 'Karyawan Berhasil Dihapus');
        redirect('admin/karyawan');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KARYAWAN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KATEGORI BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Kategori Barang Perusahaan
    public function kategori()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Kategori Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['daftar_kategori'] = $this->kategori->dataKategori()->result();

            // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/kategori_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Kategori Barang Perusahaan
    public function tambah_kategori()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']      = 'Tambah Kategori Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Kategori Barang
            $this->form_validation->set_rules('NamaKategori', 'Nama Kategori Barang', 'required|trim', [
                'required' => 'Nama Kategori Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Kategori Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/kategori_barang/tambah_kategori', $data);
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
                redirect('admin/kategori');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Kategori Barang Perusahaan
    public function detail_kategori($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                      = decrypt_url($id);
            $data['title']           = 'Detail Kategori Barang';
            $data['detail_kategori'] = $this->kategori->detailKategori($id)->result();
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Kategori Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View atau Halaman Detail Kategori Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/kategori_barang/detail_kategori', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Kategori Barang Perusahaan
    public function ubah_kategori()
    {
        $IdKategori            = $this->input->post('IdKategori');
        $NamaKategori          = $this->input->post('NamaKategori', true);
        $Keterangan            = $this->input->post('Keterangan', true);

        $data = array(
            'NamaKategori'          => $NamaKategori,
            'Keterangan'            => $Keterangan
        );

        $id    = decrypt_url($IdKategori);
        $where = array('IdKategori' => $id);

        $this->kategori->ubahKategori($where, $data, 'tb_kategori');
        $this->session->set_flashdata('success', 'Kategori Berhasil Diubah');
        redirect('admin/kategori');
    }

    // Fungsi Untuk Hapus Kategori Barang Perusahaan
    public function hapus_kategori($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdKategori' => $id);

        $this->kategori->hapusKategori($where, 'tb_kategori');
        $this->session->set_flashdata('success', 'Kategori Berhasil Dihapus');
        redirect('admin/kategori');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KATEGORI BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK SATUAN BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Satuan Barang Perusahaan
    public function satuan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']         = 'Satuan Barang';
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']    = $this->profil->dataProfil()->row_array();
            $data['daftar_satuan'] = $this->satuan->dataSatuan()->result();

            // Melakukan Load View Halaman Daftar Satuan Barang Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/satuan_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Satuan Barang Perusahaan
    public function tambah_satuan()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']      = 'Tambah Satuan Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Satuan Barang
            $this->form_validation->set_rules('NamaSatuan', 'Nama Kategori', 'required|trim', [
                'required' => 'Nama Satuan Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Satuan Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/satuan_barang/tambah_satuan', $data);
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
                redirect('admin/satuan');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Satuan Barang Perusahaan
    public function detail_satuan($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                      = decrypt_url($id);
            $data['title']           = 'Detail Satuan Barang';
            $data['detail_satuan']   = $this->satuan->detailSatuan($id)->result();
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Satuan Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Satuan Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/satuan_barang/detail_satuan', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Satuan Barang Perusahaan
    public function ubah_satuan()
    {
        $IdSatuan            = $this->input->post('IdSatuan');
        $NamaSatuan          = $this->input->post('NamaSatuan', true);
        $Keterangan          = $this->input->post('Keterangan', true);

        $data = array(
            'NamaSatuan'          => $NamaSatuan,
            'Keterangan'          => $Keterangan
        );

        $id    = decrypt_url($IdSatuan);
        $where = array('IdSatuan' => $id);

        $this->satuan->ubahSatuan($where, $data, 'tb_satuan');
        $this->session->set_flashdata('success', 'Satuan Berhasil Diubah');
        redirect('admin/satuan');
    }

    // Fungsi Untuk Hapus Satuan Barang Perusahaan
    public function hapus_satuan($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdSatuan' => $id);

        $this->satuan->hapusSatuan($where, 'tb_satuan');
        $this->session->set_flashdata('success', 'Satuan Berhasil Dihapus');
        redirect('admin/satuan');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK SATUAN BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK SUPPLIER BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Supplier Barang Perusahaan
    public function supplier()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Supplier Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['daftar_supplier'] = $this->supplier->dataSupplier()->result();

            // Melakukan Load View Halaman Daftar Supplier Barang Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/supplier_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Supplier Barang Perusahaan
    public function tambah_supplier()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']      = 'Tambah Supplier Barang';
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Supplier Barang
            $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier', 'required|trim', [
                'required' => 'Nama Supplier Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat Supplier Barang
            $this->form_validation->set_rules('AlamatSupplier', 'Alamat Supplier', 'required|trim', [
                'required' => 'Alamat Supplier Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Tambah Supplier Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/supplier_barang/tambah_supplier', $data);
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
                redirect('admin/supplier');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Supplier Barang Perusahaan
    public function detail_supplier($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                      = decrypt_url($id);
            $data['title']           = 'Detail Supplier Barang';
            $data['detail_supplier'] = $this->supplier->detailSupplier($id)->result();
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Supplier Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Supplier Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/supplier_barang/detail_supplier', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Supplier Barang Perusahaan
    public function ubah_supplier()
    {
        $IdSupplier            = $this->input->post('IdSupplier');
        $NamaSupplier          = $this->input->post('NamaSupplier', true);
        $AlamatSupplier        = $this->input->post('AlamatSupplier', true);
        $NomorTeleponSupplier  = $this->input->post('NomorTeleponSupplier', true);
        $EmailSupplier         = $this->input->post('EmailSupplier', true);
        $Keterangan            = $this->input->post('Keterangan', true);

        $data = array(
            'NamaSupplier'          => $NamaSupplier,
            'AlamatSupplier'        => $AlamatSupplier,
            'NomorTeleponSupplier'  => $NomorTeleponSupplier,
            'EmailSupplier'         => htmlspecialchars($EmailSupplier),
            'Keterangan'            => $Keterangan
        );

        $id    = decrypt_url($IdSupplier);
        $where = array('IdSupplier' => $id);

        $this->supplier->ubahSupplier($where, $data, 'tb_supplier');
        $this->session->set_flashdata('success', 'Supplier Berhasil Diubah');
        redirect('admin/supplier');
    }

    // Fungsi Untuk Hapus Supplier Barang Perusahaan
    public function hapus_supplier($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdSupplier' => $id);

        $this->supplier->hapusSupplier($where, 'tb_supplier');
        $this->session->set_flashdata('success', 'Supplier Berhasil Dihapus');
        redirect('admin/supplier');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK SUPPLIER BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Barang Perusahaan
    public function barang()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']         = 'Barang';
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']    = $this->profil->dataProfil()->row_array();
            $data['daftar_barang'] = $this->barang->dataBarang()->result();
            $data['jumlah_barang'] = $this->barang->jumlahBarang();
            $data['status_paket']  = $this->profil->statusPaket()->row_array();

            // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Perusahaan
    public function tambah_barang()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Tambah Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_kategori']   = $this->kategori->dataKategori()->result();
            $data['data_satuan']     = $this->satuan->dataSatuan()->result();
            $data['jumlah_kategori'] = $this->kategori->dataKategori()->num_rows();
            $data['jumlah_satuan']   = $this->satuan->dataSatuan()->num_rows();

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
                // Melakukan Load View Halaman Tambah Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang/tambah_barang', $data);
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
                        redirect('admin/tambah_barang');
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
                redirect('admin/barang');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Barang Perusahaan
    public function detail_barang($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                    = decrypt_url($id);
            $data['title']         = 'Detail Barang';
            $data['detail_barang'] = $this->barang->detailBarang($id)->result();
            $data['user']          = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang/detail_barang', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Barang Perusahaan
    public function ubah_barang($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Ubah Barang';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $id                      = decrypt_url($id);
            $where                   = array('IdBarang' => $id);
            // $data['detail_barang']   = $this->barang->detailBarang($id)->row();
            // $data['ubah_barang']     = $this->barang->getBarang($where, 'tb_barang')->result();
            $data['detail_barang']   = $this->barang->getBarang(array('IdBarang' => $id))->row();
            $data['data_kategori']   = $this->kategori->dataKategori()->result();
            $data['data_satuan']     = $this->satuan->dataSatuan()->result();
            $data['jumlah_kategori'] = $this->kategori->dataKategori()->num_rows();
            $data['jumlah_satuan']   = $this->satuan->dataSatuan()->num_rows();

            if ($id == NULL) {
                // Jika ID Barang Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Daftar Barang Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang/ubah_barang', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
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
                $error = $this->session->set_flashdata('error', 'Upload Gambar Gagal!');
                redirect('admin/ubah_barang/' . $IdBarang);
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
        redirect('admin/barang');
    }

    // Fungsi Untuk Hapus Barang Perusahaan
    public function hapus_barang($id)
    {
        $id     = decrypt_url($id);
        $where  = array('IdBarang' => $id);
        $Gambar = $this->barang->getGambar($where);

        if ($Gambar) {
            if ($Gambar == 'items_default.png') {
            } else {
                unlink('./assets/img/items/' . $Gambar . '');
            }
            $this->barang->hapusBarang($where, 'tb_barang');
        }

        $this->session->set_flashdata('success', 'Barang Berhasil Dihapus');
        redirect('admin/barang');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG MASUK -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Daftar Barang Masuk Perusahaan
    public function barang_masuk()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']               = 'Barang Masuk';
            $data['user']                = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']          = $this->profil->dataProfil()->row_array();
            $data['daftar_barang_masuk'] = $this->barang_masuk->daftarBarangMasuk()->result();
            $data['data_supplier']       = $this->supplier->dataSupplier()->result();
            $data['jumlah_supplier']     = $this->supplier->dataSupplier()->num_rows();


            // Melakukan Load View Halaman Daftar Barang Masuk Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/barang_masuk/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Masuk Perusahaan
    public function tambah_barang_masuk()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Tambah Barang Masuk';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_barang']     = $this->barang->dataBarang()->result();
            $data['data_supplier']   = $this->supplier->dataSupplier()->result();
            $data['jumlah_barang']   = $this->barang->dataBarang()->num_rows();
            $data['jumlah_supplier'] = $this->supplier->dataSupplier()->num_rows();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Barang Masuk
            $this->form_validation->set_rules('IdBarang', 'Nama Barang', 'required|trim', [
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
                // Melakukan Load View Halaman Tambah Barang Masuk Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang_masuk/tambah_barang_masuk', $data);
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
                redirect('admin/barang_masuk');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Menampilkan Detail Barang Masuk Perusahaan
    public function detail_barang_masuk($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                          = decrypt_url($id);
            $data['title']               = 'Detail Barang Masuk';
            $data['detail_barang_masuk'] = $this->barang_masuk->detailBarangMasuk($id)->result();
            $data['user']                = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Masuk Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Masuk Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang_masuk/detail_barang_masuk', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Barang Masuk Perusahaan
    public function ubah_barang_masuk()
    {
        $IdBarangMasuk = $this->input->post('IdBarangMasuk');
        $Barang        = $this->input->post('IdBarang');
        $Supplier      = $this->input->post('IdSupplier');
        $HargaMasuk    = $this->input->post('HargaMasuk', true);
        $JumlahMasuk   = $this->input->post('JumlahMasuk', true);
        $TanggalMasuk  = $this->input->post('TanggalMasuk', true);
        $IdSupplier    = decrypt_url($Supplier);
        $IdBarang      = decrypt_url($Barang);

        $data = array(
            'IdBarang'      => $IdBarang,
            'IdSupplier'    => $IdSupplier,
            'HargaMasuk'    => $HargaMasuk,
            'TanggalMasuk'  => $TanggalMasuk,
            'JumlahMasuk'   => $JumlahMasuk
        );

        $id    = decrypt_url($IdBarangMasuk);
        $where = array('IdBarangMasuk' => $id);

        $this->barang_masuk->ubahBarangMasuk($where, $data, 'tb_barang_masuk');
        $this->session->set_flashdata('success', 'Barang Masuk Berhasil Diubah');
        redirect('admin/barang_masuk');
    }

    // Fungsi Untuk Hapus Barang Masuk Perusahaan
    public function hapus_barang_masuk($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdBarangMasuk' => $id);

        $this->barang_masuk->hapusBarangMasuk($where, 'tb_barang_masuk');
        $this->session->set_flashdata('success', 'Barang Masuk Berhasil Dihapus');
        redirect('admin/barang_masuk');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG MASUK -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK BARANG KELUAR --------------------------------------------------------//
    // Fungsi Untuk Menampilkan Daftar Barang Keluar Perusahaan
    public function barang_keluar()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']                = 'Barang Keluar';
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']           = $this->profil->dataProfil()->row_array();
            $data['daftar_barang_keluar'] = $this->barang_keluar->daftarBarangKeluar()->result();

            // Melakukan Load View Halaman Daftar Barang Keluar Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/barang_keluar/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Tambah Barang Keluar Perusahaan
    public function tambah_barang_keluar()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title']           = 'Tambah Barang Keluar';
            $data['user']            = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']      = $this->profil->dataProfil()->row_array();
            $data['data_barang']     = $this->barang->dataBarang()->result();
            $data['jumlah_barang']   = $this->barang->dataBarang()->num_rows();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Barang Keluar
            $this->form_validation->set_rules('IdBarang', 'Nama Barang', 'required|trim', [
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
                // Melakukan Load View Halaman Tambah Barang Keluar Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang_keluar/tambah_barang_keluar', $data);
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
                redirect('admin/barang_keluar');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Mendapatkan Id Barang (Harga Barang)
    public function getBarang($id)
    {
        $id     = decrypt_url($id);
        $barang = $this->db->where('IdBarang', $id)->get('tb_barang')->row();
        echo json_encode($barang);
    }

    // Fungsi Untuk Menampilkan Detail Barang Keluar Perusahaan
    public function detail_barang_keluar($id)
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $id                           = decrypt_url($id);
            $data['title']                = 'Detail Barang Keluar';
            $data['detail_barang_keluar'] = $this->barang_keluar->detailBarangKeluar($id)->result();
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                // Jika ID Barang Keluar Tidak Ditemukan Akan Diarahkan Ke Halaman Error 404
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Barang Keluar Perusahaan Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/barang_keluar/detail_barang_keluar', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Barang Keluar Perusahaan
    public function ubah_barang_keluar()
    {
        $IdBarangKeluar = $this->input->post('IdBarangKeluar');
        $Barang         = $this->input->post('IdBarang');
        $HargaKeluar    = $this->input->post('HargaKeluar', true);
        $TanggalKeluar  = $this->input->post('TanggalKeluar', true);
        $JumlahKeluar   = $this->input->post('JumlahKeluar', true);
        $IdBarang       = decrypt_url($Barang);

        $data = array(
            'IdBarang'      => $IdBarang,
            'HargaKeluar'   => $HargaKeluar,
            'TanggalKeluar' => $TanggalKeluar,
            'JumlahKeluar'  => $JumlahKeluar,
            'TotalKeluar'    => $HargaKeluar * $JumlahKeluar
        );

        $id    = decrypt_url($IdBarangKeluar);
        $where = array('IdBarangKeluar' => $id);

        $this->barang_keluar->ubahBarangKeluar($where, $data, 'tb_barang_keluar');
        $this->session->set_flashdata('success', 'Barang Keluar Berhasil Diubah');
        redirect('admin/barang_keluar');
    }

    // Fungsi Untuk Hapus Barang Keluar Perusahaan
    public function hapus_barang_keluar($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdBarangKeluar' => $id);

        $this->barang_keluar->hapusBarangKeluar($where, 'tb_barang_keluar');
        $this->session->set_flashdata('success', 'Barang Keluar Berhasil Dihapus');
        redirect('admin/barang_keluar');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK BARANG KELUAR -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK STATUS PAKET -------------------------------------------------------- //
    // Fungsi Untuk Menampilkan Status Paket Layanan Yang Digunakan Perusahaan
    public function status_paket()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {
            $data['title']                = 'Status Paket';
            $data['user']                 = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan']           = $this->profil->dataProfil()->row_array();
            $data['status_paket']         = $this->profil->statusPaket()->row_array();

            // Melakukan Load View Halaman Status Paket Layanan Perusahaan Untuk Admin
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/status_paket/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK STATUS PAKET -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KRITIK & SARAN -------------------------------------------------------- //
    // Fungsi Untuk Memberi Kritik & Saran Kepada Penyedia Layanan
    public function kritik_saran()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Admin
        if ($this->session->userdata('Level') == "Admin") {

            $data['title'] = 'Kritik & Saran';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Isi Kritik & Saran
            $this->form_validation->set_rules('Pesan', 'Isi Kritik & Saran', 'required|trim', [
                'required' => 'Pesan Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Kirim Kritik & Saran Untuk Admin
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/kritik_saran', $data);
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
                redirect('admin/kritik_saran');
            }
        } else {
            // Jika Session User Level Bukan Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KRITIK & SARAN --------------------------------------------------------//
}
