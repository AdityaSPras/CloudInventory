<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Perusahaan_model', 'perusahaan');
        $this->load->model('Users_model', 'users');
    }

    // -------------------------------------------------------- AWAL FUNGSI UNTUK HALAMAN LOGIN & PROSES LOGIN -------------------------------------------------------- //
    public function login()
    {
        // Jika User Sudah Login Maka Akan Diarahkan Ke Halaman Utama Sesuai Level Usernya
        if ($this->session->userdata('Email')) {
            if ($this->session->userdata('Level') == "Super Admin") {
                redirect('superadmin/index');
            } elseif ($this->session->userdata('Level') == "Admin") {
                redirect('admin/index');
            } elseif ($this->session->userdata('Level') == "Karyawan") {
                redirect('karyawan/index');
            }
        }

        // Membuat Aturan Pengisian Form atau Inputan Untuk Email
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email', [
            'required'    => 'Email Tidak Boleh Kosong!',
            'valid_email' => 'Email Salah!'
        ]);

        // Membuat Aturan Pengisian Form atau Inputan Untuk Password
        $this->form_validation->set_rules('Password', 'Password', 'trim|required', [
            'required' => 'Password Tidak Boleh Kosong!'
        ]);

        if ($this->form_validation->run() == false) {

            // Melakukan Load View atau Halaman Template & Ubah Password Untuk Super Admin
            $data['title'] = 'Masuk | Cloud Inventory';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/masuk');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    // Fungsi Proses Login (Private)
    private function _login()
    {
        $email      = $this->input->post('Email');
        $password   = $this->input->post('Password');
        $user       = $this->db->get_where('tb_user', ['Email' => $email])->row_array();
        $perusahaan = $this->db->get_where('tb_perusahaan', ['IdPaket'])->row_array();

        if ($user) {
            if ($user['Status'] == 'Aktif') {
                if (password_verify($password, $user['Password'])) {
                    $data = [
                        'IdUser'       => $user['IdUser'],
                        'IdPerusahaan' => $user['IdPerusahaan'],
                        'Email'        => $user['Email'],
                        'Level'        => $user['Level'],
                        'IdPaket'      => $perusahaan['IdPaket']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['Level'] == "Super Admin") {
                        redirect('superadmin/index');
                    } elseif ($user['Level'] == "Admin") {
                        redirect('admin/index');
                    } elseif ($user['Level'] == "Karyawan") {
                        redirect('karyawan/index');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password Salah!');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('warning', 'Akun Tidak Aktif!');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Akun Tidak Terdaftar!');
            redirect('auth/login');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK HALAMAN LOGIN & PROSES LOGIN -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK REGISTRASI -------------------------------------------------------- //
    public function registration()
    {
        // Jika User Sudah Login Maka Akan Diarahkan Ke Halaman Utama Sesuai Level Usernya
        if ($this->session->userdata('Email')) {
            if ($this->session->userdata('Level') == "Super Admin") {
                redirect('superadmin/index');
            } elseif ($this->session->userdata('Level') == "Admin") {
                redirect('admin/index');
            } elseif ($this->session->userdata('Level') == "Karyawan") {
                redirect('karyawan/index');
            }
        }

        $this->form_validation->set_rules('NamaPerusahaan', 'NamaPerusahaan', 'required|trim', [
            'required' => 'Nama Perusahaan Tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('NamaPemilik', 'NamaPemilik', 'required|trim', [
            'required' => 'Nama Pemilik Perusahaan Tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('AlamatPerusahaan', 'AlamatPerusahaan', 'required|trim', [
            'required' => 'Alamat Perusahaan Tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('NomorTeleponPerusahaan', 'NomorTeleponPerusahaan', 'required|trim', [
            'required' => 'Nomor Telepon Perusahaan Tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('EmailPerusahaan', 'EmailPerusahaan', 'required|trim|valid_email|is_unique[tb_perusahaan.EmailPerusahaan]', [
            'required'    => 'Email Perusahaan Tidak Boleh Kosong!',
            'valid_email' => 'Email Perusahaan Salah!',
            'is_unique'   => 'Email Perusahaan Sudah Digunakan!'
        ]);

        $this->form_validation->set_rules('NamaLengkap', 'NamaLengkap', 'required|trim', [
            'required' => 'Nama Admin Tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('Email', 'Email', 'required|trim|valid_email|is_unique[tb_user.Email]', [
            'required'    => 'Email Admin Tidak Boleh Kosong!',
            'valid_email' => 'Email Admin Salah!',
            'is_unique'   => 'Email Admin Sudah Digunakan!'
        ]);

        $this->form_validation->set_rules('Password1', 'Password', 'required|trim|min_length[8]|matches[Password2]', [
            'required'   => 'Password Tidak Boleh Kosong!',
            'matches'    => 'Password Tidak Sama!',
            'min_length' => 'Password Minimal 8 Karakter!'
        ]);

        $this->form_validation->set_rules('Password2', 'Password', 'required|trim|matches[Password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Daftar | Cloud Inventory';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/daftar');
            $this->load->view('templates/auth_footer');
        } else {
            $IdPerusahaan = $this->perusahaan->kodePerusahaan();
            $IdAdmin = $this->users->kodeAdmin();
            $EmailPerusahaan = $this->input->post('EmailPerusahaan', true);
            $Email = $this->input->post('Email', true);

            $data_perusahaan = [
                'IdPerusahaan'           => $IdPerusahaan,
                'IdPaket'                => 1,
                'NamaPerusahaan'         => $this->input->post('NamaPerusahaan', true),
                'NamaPemilik'            => htmlspecialchars($this->input->post('NamaPemilik', true)),
                'AlamatPerusahaan'       => $this->input->post('AlamatPerusahaan', true),
                'NomorTeleponPerusahaan' => $this->input->post('NomorTeleponPerusahaan', true),
                'EmailPerusahaan'        => htmlspecialchars($EmailPerusahaan),
                'Logo'                   => 'company_default.png',
            ];

            $data_admin = [
                'IdUser'        => $IdAdmin,
                'IdPerusahaan'  => $IdPerusahaan,
                'NamaLengkap'   => htmlspecialchars($this->input->post('NamaLengkap', true)),
                'Foto'          => 'user_default.png',
                'Email'         => htmlspecialchars($Email),
                'Password'      => password_hash($this->input->post('Password1'), PASSWORD_DEFAULT),
                'Level'         => 'Admin',
                'Status'        => 'Tidak Aktif',
                'TanggalDibuat' => time()
            ];

            $token      = base64_encode(random_bytes(32));

            $user_token = [
                'Email'   => $Email,
                'Token'   => $token,
                'Tanggal' => time()
            ];

            $this->db->insert('tb_perusahaan', $data_perusahaan);
            $this->db->insert('tb_user', $data_admin);
            $this->db->insert('tb_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('warning', 'Akun Anda Berhasil Dibuat, Silahkan Cek Email Anda Untuk Melakukan Aktivasi Akun!');
            redirect('auth/login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');

        $config = array();
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'karuniamulticomputer@gmail.com';
        $config['smtp_pass'] = 'karunia01092019';
        $config['smtp_port'] = 465;
        $config['mailtype']  = 'html';
        $config['charset']   = 'utf-8';

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");

        $this->email->from('karuniamulticomputer@gmail.com', 'Cloud Inventory');
        $this->email->to($this->input->post('Email'));

        if ($type == 'verify') {
            $this->email->subject('Aktivasi Akun Cloud Inventory');
            $this->email->message('Klik Link Untuk Melakukan Aktivasi Akun Anda : <a href="' . base_url() . 'auth/verify?Email=' . $this->input->post('Email') . '&Token=' . urlencode($token) . '">Aktivasi</a>');
        } elseif ($type == 'lupapass') {
            $this->email->subject('Reset Password Akun Cloud Inventory');
            $this->email->message('Klik Link Untuk Melakukan Reset Password Akun Anda : <a href="' . base_url() . 'auth/resetpassword?Email=' . $this->input->post('Email') . '&Token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('Email');
        $token = $this->input->get('Token');
        $user  = $this->db->get_where('tb_user', ['Email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tb_token', ['Token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['Tanggal'] < (60 * 60 * 24)) {
                    $this->db->set('Status', 'Aktif');
                    $this->db->where('Email', $email);
                    $this->db->update('tb_user');

                    $this->db->delete('tb_token', ['Email' => $email]);

                    $this->session->set_flashdata('success', $email . ' Aktivasi Akun Anda Berhasil, Silahkan Login!');
                    redirect('auth/login');
                } else {
                    $this->db->delete('tb_user', ['Email' => $email]);
                    $this->db->delete('tb_token', ['Email' => $email]);

                    $this->session->set_flashdata('error', 'Aktivasi Akun Anda Gagal, Waktu Token Habis!');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Aktivasi Akun Anda Gagal, Token Salah!');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Aktivasi Akun Anda Gagal, Email Salah!');
            redirect('auth/login');
        }
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK REGISTRASI -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK LOGOUT -------------------------------------------------------- //
    public function logout()
    {
        $this->session->unset_userdata('Email');
        $this->session->unset_userdata('Level');

        $this->session->set_flashdata('success', 'Berhasil Keluar');
        redirect('auth/login');
    }
    // -------------------------------------------------------- AKHIR FUNGSI UNTUK LOGOUT -------------------------------------------------------- //

    // -------------------------------------------------------- AWAL FUNGSI UNTUK LUPA PASSWORD -------------------------------------------------------- //
    public function lupaPassword()
    {
        // Jika User Sudah Login Maka Akan Diarahkan Ke Halaman Utama Sesuai Level Usernya
        if ($this->session->userdata('Email')) {
            if ($this->session->userdata('Level') == "Super Admin") {
                redirect('superadmin/index');
            } elseif ($this->session->userdata('Level') == "Admin") {
                redirect('admin/index');
            } elseif ($this->session->userdata('Level') == "Karyawan") {
                redirect('karyawan/index');
            }
        }

        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email', [
            'required'    => 'Email Tidak Boleh Kosong!',
            'valid_email' => 'Email Salah!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password | Cloud Inventory';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('Email');
            $user  = $this->db->get_where('tb_user', ['Email' => $email, 'Status' => 'Aktif'])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'Email'   => $email,
                    'Token'   => $token,
                    'Tanggal' => time()
                ];

                $this->db->insert('tb_token', $user_token);
                $this->_sendEmail($token, 'lupapass');

                $this->session->set_flashdata('success', 'Cek Email Anda Untuk Reset Password!');
                redirect('auth/lupapassword');
            } else {
                $this->session->set_flashdata('error', 'Email Tidak Terdaftar atau Akun Belum Aktif!');
                redirect('auth/lupapassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('Email');
        $token = $this->input->get('Token');

        $user = $this->db->get_where('tb_user', ['Email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tb_token', ['Token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->gantiPassword();
            } else {
                $this->session->set_flashdata('error', 'Reset Password Gagal, Token Salah!');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Reset Password Gagal, Email Salah!');
            redirect('auth/login');
        }
    }

    public function gantiPassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('Password1', 'Password Baru', 'required|trim|min_length[8]|matches[Password2]', [
            'required'   => 'Password Tidak Boleh Kosong!',
            'matches'    => 'Password Tidak Sama!',
            'min_length' => 'Password Minimal 8 Karakter!'
        ]);

        $this->form_validation->set_rules('Password2', 'Konfirmasi Password', 'required|trim|matches[Password1]', [
            'required'   => 'Konfirmasi Password Tidak Boleh Kosong!',
            'matches'    => 'Password Tidak Sama!',
            'min_length' => 'Password Minimal 8 Karakter!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password | Cloud Inventory';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/ganti_password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('Password1'), PASSWORD_DEFAULT);
            $email    = $this->session->userdata('reset_email');

            $this->db->set('Password', $password);
            $this->db->where('Email', $email);
            $this->db->update('tb_user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('success', 'Password Berhasil Direset, Silahkan Login!');
            redirect('auth/login');
        }
    }
    // -------------------------------------------------------- AWAL FUNGSI UNTUK LUPA PASSWORD -------------------------------------------------------- //
}
