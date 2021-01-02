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
    public function profil()
    {
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title']  = 'Profil Saya';
            $data['user']   = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['profil'] = $this->profil->dataProfil()->row_array();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/profil/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Profil
    public function ubah_profil()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Ubah Profil';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nama Lengkap
            $this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap', 'required|trim', [
                'required' => 'Nama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Alamat
            $this->form_validation->set_rules('Alamat', 'Alamat User', 'required|trim', [
                'required' => 'Alamat Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Nomor Telepon
            $this->form_validation->set_rules('NomorTelepon', 'Nomor Telepon', 'required|trim', [
                'required' => 'Nomor Telepon Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View atau Halaman Template & Ubah Profil Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/profil/ubah_profil', $data);
                $this->load->view('templates/users_footer');
            } else {
                $Email = $this->input->post('Email');
                $NamaLengkap = $this->input->post('NamaLengkap');
                $JenisKelamin = $this->input->post('JenisKelamin');
                $Alamat = $this->input->post('Alamat');
                $NomorTelepon = $this->input->post('NomorTelepon');

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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect('karyawan/profil');
                    }
                }

                $this->db->set('NamaLengkap', $NamaLengkap);
                $this->db->set('JenisKelamin', $JenisKelamin);
                $this->db->set('Alamat', $Alamat);
                $this->db->set('NomorTelepon', $NomorTelepon);
                $this->db->where('Email', $Email);
                $this->db->update('tb_user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Anda Berhasil Diubah</div>');
                redirect('karyawan/profil');
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    // Fungsi Untuk Ubah Password
    public function ubah_password()
    {
        // Melakukan Cek Session User Level Apakah Benar Yang Mengakses Fungsi Ini Sebagai Karyawan
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Ubah Password';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Lama
            $this->form_validation->set_rules('PasswordLama', 'PasswordLama', 'required|trim', [
                'required' => 'Password Lama Tidak Boleh Kosong!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Password Baru
            $this->form_validation->set_rules('PasswordBaru', 'PasswordBaru', 'required|trim|min_length[8]|matches[KonfirmasiPassword]', [
                'required' => 'Password Baru Tidak Boleh Kosong!',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Password Baru Minimal 8 Karakter!'
            ]);

            // Membuat Aturan Pengisian Form atau Inputan Untuk Konfirmasi Password
            $this->form_validation->set_rules('KonfirmasiPassword', 'KonfirmasiPassword', 'required|trim|min_length[8]|matches[PasswordBaru]', [
                'required' => 'Konfirmasi Password Tidak Boleh Kosong!',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Konfirmasi Password Minimal 8 Karakter!'
            ]);

            if ($this->form_validation->run() == false) {
                // Melakukan Load View atau Halaman Template & Ubah Password Untuk Karyawan
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/profil/ubah_password', $data);
                $this->load->view('templates/users_footer');
            } else {
                // Password Lama Salah
                $password_lama = $this->input->post('PasswordLama');
                $password_baru = $this->input->post('PasswordBaru');

                if (!password_verify($password_lama, $data['user']['Password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Salah!</div>');
                    redirect('karyawan/ubah_password');
                } else {
                    // Password Baru Tidak Boleh Sama Dengan Password Lama
                    if ($password_lama == $password_baru) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Baru Tidak Boleh Sama Dengan Password Lama!</div>');
                        redirect('karyawan/ubah_password');
                    } else {
                        // Password Berhasil Diubah
                        $enkripsi_password = password_hash($password_baru, PASSWORD_DEFAULT);

                        $this->db->set('Password', $enkripsi_password);
                        $this->db->where('Email', $this->session->userdata('Email'));
                        $this->db->update('tb_user');

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah!</div>');
                        redirect('karyawan/profil');
                    }
                }
            }
        } else {
            // Jika Session User Level Bukan Karyawan Maka Akan Diarahkan Ke Halaman Error 403
            $this->load->view('error');
        }
    }

    public function perusahaan()
    {
        if ($this->session->userdata('Level') == "Karyawan") {

            $data['title'] = 'Profil Perusahaan';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/profil/perusahaan', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK PROFIL ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK KATEGORI BARANG ----------------------------//
    public function kategori()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Kategori Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['kategori'] = $this->kategori->daftarKategori()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/kategori_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }

    public function tambah_kategori()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Tambah Kategori Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            $this->form_validation->set_rules('NamaKategori', 'Nama Kategori', 'required|trim', [
                'required' => 'Nama Kategori Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/kategori_barang/tambah_kategori', $data);
                $this->load->view('templates/users_footer');
            } else {
                $idkategori = $this->kategori->kodeKategori();
                $iduser = $this->session->userdata('IdUser');
                $idperusahaan = $this->session->userdata('IdPerusahaan');
                $nama = $this->input->post('NamaKategori');
                $keterangan = $this->input->post('Keterangan');
                $tanggal = time();

                $data = [
                    'IdKategori' => $idkategori,
                    'IdUser' => $iduser,
                    'IdPerusahaan' => $idperusahaan,
                    'NamaKategori' => $nama,
                    'Keterangan' => $keterangan,
                    'TanggalDibuat' => $tanggal
                ];

                $this->kategori->tambahKategori($data, 'tb_kategori');
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Kategori Barang Berhasil Ditambah</div>');
                redirect('karyawan/kategori');
            }
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK KATEGORI BARANG ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK SATUAN BARANG ----------------------------//
    public function satuan()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Satuan Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['satuan'] = $this->satuan->daftarSatuan()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/satuan_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }

    public function tambah_satuan()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Tambah Satuan Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            $this->form_validation->set_rules('NamaSatuan', 'Nama Kategori', 'required|trim', [
                'required' => 'Nama Satuan Barang Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/satuan_barang/tambah_satuan', $data);
                $this->load->view('templates/users_footer');
            } else {
                $idsatuan = $this->satuan->kodeSatuan();
                $iduser = $this->session->userdata('IdUser');
                $idperusahaan = $this->session->userdata('IdPerusahaan');
                $nama = $this->input->post('NamaSatuan');
                $keterangan = $this->input->post('Keterangan');
                $tanggal = time();

                $data = [
                    'IdSatuan' => $idsatuan,
                    'IdUser' => $iduser,
                    'IdPerusahaan' => $idperusahaan,
                    'NamaSatuan' => $nama,
                    'Keterangan' => $keterangan,
                    'TanggalDibuat' => $tanggal
                ];

                $this->satuan->tambahSatuan($data, 'tb_satuan');
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Satuan Barang Berhasil Ditambah</div>');
                redirect('karyawan/satuan');
            }
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK SATUAN BARANG ----------------------------//

    //---------------------------- AWAL FUNGSI UNTUK SUPPLIER BARANG ----------------------------//
    public function supplier()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Supplier Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();
            $data['supplier'] = $this->supplier->daftarSupplier()->result();

            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/supplier_barang/index', $data);
            $this->load->view('templates/users_footer');
        } else {
            $this->load->view('error');
        }
    }

    public function tambah_supplier()
    {
        if ($this->session->userdata('Level') == "Karyawan") {
            $data['title'] = 'Tambah Supplier Barang';
            $data['user'] = $this->db->get_where('tb_user', ['Email' => $this->session->userdata('Email')])->row_array();
            $data['perusahaan'] = $this->profil->dataProfil()->row_array();

            $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier', 'required|trim', [
                'required' => 'Nama Supplier Tidak Boleh Kosong!'
            ]);

            $this->form_validation->set_rules('AlamatSupplier', 'Alamat Supplier', 'required|trim', [
                'required' => 'Alamat Supplier Tidak Boleh Kosong!'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/karyawan_header', $data);
                $this->load->view('karyawan/supplier_barang/tambah_supplier', $data);
                $this->load->view('templates/users_footer');
            } else {
                $idsupplier = $this->supplier->kodeSupplier();
                $iduser = $this->session->userdata('IdUser');
                $idperusahaan = $this->session->userdata('IdPerusahaan');
                $nama = $this->input->post('NamaSupplier');
                $alamat = $this->input->post('AlamatSupplier');
                $telepon = $this->input->post('NomorTeleponSupplier');
                $email = $this->input->post('EmailSupplier');
                $keterangan = $this->input->post('Keterangan');
                $tanggal = time();

                $data = [
                    'IdSupplier' => $idsupplier,
                    'IdUser' => $iduser,
                    'IdPerusahaan' => $idperusahaan,
                    'NamaSupplier' => $nama,
                    'AlamatSupplier' => $alamat,
                    'NomorTeleponSupplier' => $telepon,
                    'EmailSupplier' => $email,
                    'Keterangan' => $keterangan,
                    'TanggalDibuat' => $tanggal
                ];

                $this->supplier->tambahSupplier($data, 'tb_supplier');
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Supplier Barang Berhasil Ditambah</div>');
                redirect('karyawan/supplier');
            }
        } else {
            $this->load->view('error');
        }
    }
    //---------------------------- AKHIR FUNGSI UNTUK SUPPLIER BARANG ----------------------------//

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
