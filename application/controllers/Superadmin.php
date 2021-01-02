<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->helper('rupiah_helper');
        $this->load->helper('tanggal_helper');
        $this->load->model('Paket_model', 'paket');
        $this->load->model('Perusahaan_model', 'perusahaan');
        $this->load->model('Pembayaran_model', 'pembayaran');
        $this->load->model('Kritik_saran_model', 'kritik_saran');
    }

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN UTAMA SUPER ADMIN -------------------------------------------------------- //
    // Fungsi Menampilkan Halaman Utama
    public function index()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title']                        = 'Halaman Utama';
            $data['user']                         = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['jumlah_perusahaan']            = $this->perusahaan->dataPerusahaan()->num_rows();
            $data['jumlah_paket']                 = $this->paket->dataPaket()->num_rows();
            $data['jumlah_permintaan_konfirmasi'] = $this->pembayaran->pembayaranBelumDikonfirmasi()->num_rows();
            $data['jumlah_kritik_saran']          = $this->kritik_saran->dataKritikSaran()->num_rows();

            // Melakukan Load View Halaman Utama Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN UTAMA SUPER ADMIN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK PROFIL SUPER ADMIN -------------------------------------------------------- //
    // Fungsi Menampilkan Profil
    public function profil()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title'] = 'Profil Saya';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Melakukan Load View Halaman Profil Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/profil/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Profil
    public function ubah_profil()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title'] = 'Ubah Profil';
            $data['user']  = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Lengkap
            $this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap Super Admin', 'required|trim', [
                'required' => 'Nama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat
            $this->form_validation->set_rules('Alamat', 'Alamat Super Admin', 'required|trim', [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nomor Telepon
            $this->form_validation->set_rules('NomorTelepon', 'Nomor Telepon Super Admin', 'required|trim', [
                'required' => 'Nomor Telepon Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View Halaman Ubah Profil Untuk Super Admin
                $this->load->view('templates/super_admin_header', $data);
                $this->load->view('superadmin/profil/ubah_profil', $data);
                $this->load->view('templates/users_footer');
            } else {
                $Email        = $this->input->post('Email');
                $NamaLengkap  = $this->input->post('NamaLengkap', true);
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
                        $this->session->set_flashdata('error', 'Upload Foto Gagal!');
                        redirect('superadmin/ubah_profil');
                    }
                }

                $this->db->set('NamaLengkap', $NamaLengkap);
                $this->db->set('Alamat', $Alamat);
                $this->db->set('NomorTelepon', $NomorTelepon);
                $this->db->where('Email', $Email);
                $this->db->update('tb_user');

                $this->session->set_flashdata('success', 'Profil Anda Berhasil Diubah');
                redirect('superadmin/profil');
            }
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Password
    public function ubah_password()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

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
                // Melakukan Load View Halaman Ubah Password Untuk Super Admin
                $this->load->view('templates/super_admin_header', $data);
                $this->load->view('superadmin/profil/ubah_password', $data);
                $this->load->view('templates/users_footer');
            } else {
                // Jika Password Lama Salah Maka Tampilkan Pesan Error
                $password_lama = $this->input->post('PasswordLama');
                $password_baru = $this->input->post('PasswordBaru');

                if (!password_verify($password_lama, $data['user']['Password'])) {
                    $this->session->set_flashdata('error', 'Password Lama Salah!');
                    redirect('superadmin/ubah_password');
                } else {
                    // Jika Password Lama & Password Baru Sama Maka Tampilkan Pesan Warning
                    if ($password_lama == $password_baru) {
                        $this->session->set_flashdata('warning', 'Password Baru Tidak Boleh Sama Dengan Password Lama!');
                        redirect('superadmin/ubah_password');
                    } else {
                        // Jika Password Berhasil Diubah Maka Tampilkan Pesan Success
                        $enkripsi_password = password_hash($password_baru, PASSWORD_DEFAULT);

                        $this->db->set('Password', $enkripsi_password);
                        $this->db->where('Email', $this->session->userdata('Email'));
                        $this->db->update('tb_user');

                        $this->session->set_flashdata('success', 'Password Berhasil Diubah');
                        redirect('superadmin/profil');
                    }
                }
            }
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK PROFIL -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK PAKET -------------------------------------------------------- //
    // Fungsi Menampilkan Daftar Paket
    public function paket()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title']        = 'Paket';
            $data['daftar_paket'] = $this->paket->dataPaket()->result_array();
            $data['user']         = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Melakukan Load View Halaman Daftar Paket Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/paket/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Ubah Paket Layanan
    public function ubah_paket()
    {
        $IdPaket         = $this->input->post('IdPaket');
        $Nama            = $this->input->post('Nama', true);
        $JumlahBarang    = $this->input->post('JumlahBarang', true);
        $JumlahKaryawan  = $this->input->post('JumlahKaryawan', true);
        $Harga           = $this->input->post('Harga', true);

        $data = array(
            'Nama'           => $Nama,
            'JumlahBarang'   => $JumlahBarang,
            'JumlahKaryawan' => $JumlahKaryawan,
            'Harga'          => $Harga
        );

        $id    = decrypt_url($IdPaket);
        $where = array('IdPaket' => $id);

        $this->paket->ubahPaket($where, $data, 'tb_paket');
        $this->session->set_flashdata('success', 'Paket Berhasil Diubah');
        redirect('superadmin/paket');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK PAKET -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK PERUSAHAAN -------------------------------------------------------- //
    // Fungsi Menampilkan Daftar Perusahaan
    public function perusahaan()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title']      = 'Perusahaan';
            $data['perusahaan'] = $this->perusahaan->dataPerusahaan()->result();
            $data['user']       = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Melakukan Load View Halaman Daftar Perusahaan Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/perusahaan/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Menampilkan Detail Perusahaan
    public function detail_perusahaan($id)
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $id                        = decrypt_url($id);
            $data['title']             = 'Detail Perusahaan';
            $data['detail_perusahaan'] = $this->perusahaan->detailPerusahaan($id)->result();
            $data['user']              = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            if ($id == NULL) {
                redirect('error');
            } else {
                // Melakukan Load View Halaman Detail Kritik & Saran Untuk Super Admin
                $this->load->view('templates/super_admin_header', $data);
                $this->load->view('superadmin/perusahaan/detail_perusahaan', $data);
                $this->load->view('templates/users_footer');
            }
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK PERUSAHAAN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK KRITIK & SARAN -------------------------------------------------------- //
    // Fungsi Menampilkan Daftar Kritik & Saran
    public function kritik_saran()
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title']        = 'Kritik & Saran';
            $data['kritik_saran'] = $this->kritik_saran->dataKritikSaran()->result();
            $data['user']         = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Melakukan Load View Halaman Daftar Kritik & Saran Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/kritik_saran/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Menampilkan Detail Kritik & Saran
    public function detail_kritik_saran($id)
    {
        // Melakukan Cek Session Level User Apakah Benar Yang Mengakses Fungsi Ini Sebagai Super Admin
        if ($this->session->userdata('Level') == "Super Admin") {

            $data['title']               = 'Detail Kritik & Saran';
            $id                          = decrypt_url($id);
            $data['detail_kritik_saran'] = $this->kritik_saran->detailKritikSaran($id)->result();
            $data['user']                = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Melakukan Load View Halaman Detail Kritik & Saran Untuk Super Admin
            $this->load->view('templates/super_admin_header', $data);
            $this->load->view('superadmin/kritik_saran/detail_kritik_saran', $data);
            $this->load->view('templates/users_footer');
        } else {
            // Jika Session Level User Bukan Super Admin Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Hapus Kritik & Saran
    public function hapus_kritik_saran($id)
    {
        $id    = decrypt_url($id);
        $where = array('IdKritikSaran' => $id);

        $this->kritik_saran->hapusKritikSaran($where, 'tb_kritik_saran');
        $this->session->set_flashdata('success', 'Kritik & Saran Berhasil Dihapus');
        redirect('superadmin/kritik_saran');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK KRITIK & SARAN -------------------------------------------------------- //
}