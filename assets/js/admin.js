const successAdmin = $('.success-flash-admin').data('flashdata');
const warningAdmin = $('.warning-flash-admin').data('flashdata');
const errorAdmin = $('.error-flash-admin').data('flashdata');

if (successAdmin) {
    Swal.fire({
        icon: 'success',
        title: successAdmin,
        showConfirmButton: true,
      })
}

if (warningAdmin) {
  Swal.fire({
      icon: 'warning',
      title: warningAdmin,
      showConfirmButton: true,
    })
}

if (errorAdmin) {
  Swal.fire({
      icon: 'error',
      title: errorAdmin,
      showConfirmButton: true,
    })
}

function hapus_karyawan(id) {
  var base_url = $('#hapus_karyawan').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_karyawan/" + id;
    }
  })
}

function hapus_kategori(id) {
  var base_url = $('#hapus_kategori').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_kategori/" + id;
    }
  })
}

function hapus_satuan(id) {
  var base_url = $('#hapus_satuan').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_satuan/" + id;
    }
  })
}

function hapus_supplier(id) {
  var base_url = $('#hapus_supplier').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_supplier/" + id;
    }
  })
}

function hapus_barang(id) {
  var base_url = $('#hapus_barang').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_barang/" + id;
    }
  })
}

function hapus_barang_masuk(id) {
  var base_url = $('#hapus_barang_masuk').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_barang_masuk/" + id;
    }
  })
}

function hapus_barang_keluar(id) {
  var base_url = $('#hapus_barang_keluar').val();

  Swal.fire({
    title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Data!',
    confirmButtonColor: '#4e73df',
    cancelButtonText: 'Batal',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = base_url + "hapus_barang_keluar/" + id;
    }
  })
}

function validasiAdminUbahKategori() {
  var NamaKategori = document.forms["formAdminUbahKategori"]["NamaKategori"].value;
  
  if (NamaKategori == '') {
    validasi('Nama Kategori Barang Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiAdminUbahSatuan() {
  var NamaSatuan = document.forms["formAdminUbahSatuan"]["NamaSatuan"].value;
  
  if (NamaSatuan == '') {
    validasi('Nama Satuan Barang Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiAdminUbahSupplier() {
  var NamaSupplier = document.forms["formAdminUbahSupplier"]["NamaSupplier"].value;
  var AlamatSupplier = document.forms["formAdminUbahSupplier"]["AlamatSupplier"].value;
  
  if (NamaSupplier == '') {
    validasi('Nama Supplier Barang Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (AlamatSupplier == '') {
    validasi('Alamat Supplier Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiAdminUbahBarangMasuk() {
  var TanggalMasuk = document.forms["formAdminUbahBarangMasuk"]["TanggalMasuk"].value;
  var IdSupplier = document.forms["formAdminUbahBarangMasuk"]["IdSupplier"].value;
  var HargaMasuk = document.forms["formAdminUbahBarangMasuk"]["HargaMasuk"].value;
  var JumlahMasuk = document.forms["formAdminUbahBarangMasuk"]["JumlahMasuk"].value;
  

if (TanggalMasuk == '') {
  validasi('Tanggal Masuk Tidak Boleh Kosong!', 'warning');
  return false;
} else if (IdSupplier == '') {
  validasi('Nama Supplier Belum Dipilih!', 'warning');
  return false;
} else if (HargaMasuk == '') {
  validasi('Total Harga Masuk Tidak Boleh Kosong!', 'warning');
  return false;
} else if (JumlahMasuk == '') {
  validasi('Jumlah Masuk Satuan Tidak Boleh Kosong!', 'warning');
  return false;
  }
}

function validasiAdminUbahBarangKeluar() {
  var TanggalKeluar = document.forms["formAdminUbahBarangKeluar"]["TanggalKeluar"].value;
  var JumlahKeluar = document.forms["formAdminUbahBarangKeluar"]["JumlahKeluar"].value;
  

if (TanggalKeluar == '') {
  validasi('Tanggal Keluar Tidak Boleh Kosong!', 'warning');
  return false;
} else if (JumlahKeluar == '') {
  validasi('Jumlah Keluar Tidak Boleh Kosong!', 'warning');
  return false;
  }
}

function validasiAdminUbahBarang() {
  var NamaBarang = document.forms["formAdminUbahBarang"]["NamaBarang"].value;
  var Stok = document.forms["formAdminUbahBarang"]["Stok"].value;
  var StokMinimum = document.forms["formAdminUbahBarang"]["StokMinimum"].value;
  var HargaJual = document.forms["formAdminUbahBarang"]["HargaJual"].value;
  var IdKategori = document.forms["formAdminUbahBarang"]["IdKategori"].value;
  var IdSatuan = document.forms["formAdminUbahBarang"]["IdSatuan"].value;
  
  if (NamaBarang == '') {
    validasi('Nama Barang Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (Stok == '') {
    validasi('Stok Awal Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (StokMinimum == '') {
    validasi('Stok Minimum Barang Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (HargaJual == '') {
    validasi('Harga Jual Satuan Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (IdKategori == '') {
    validasi('Kategori Barang Belum Dipilih!', 'warning');
    return false;
  } else if (IdSatuan == '') {
    validasi('Satuan Barang Belum Dipilih!', 'warning');
    return false;
  }
}

function validasiAdminUbahKaryawan() {
  var NamaLengkap = document.forms["formAdminUbahKaryawan"]["NamaLengkap"].value;
  var JenisKelamin = document.forms["formAdminUbahKaryawan"]["JenisKelamin"].value;
  var NomorTelepon = document.forms["formAdminUbahKaryawan"]["NomorTelepon"].value;
  var Alamat = document.forms["formAdminUbahKaryawan"]["Alamat"].value;
  var Email = document.forms["formAdminUbahKaryawan"]["Email"].value;
  var Status = document.forms["formAdminUbahKaryawan"]["Status"].value;
  var PasswordBaru = document.forms["formAdminUbahKaryawan"]["PasswordBaru"].value;
  
  if (NamaLengkap == '') {
    validasi('Nama Karyawan Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (JenisKelamin == '') {
    validasi('Jenis Kelamin Belum Dipilih!', 'warning');
    return false;
  } else if (NomorTelepon == '') {
    validasi('Nomor Handphone Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (Alamat == '') {
    validasi('Alamat Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (Email == '') {
    validasi('Email Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (Status == '') {
    validasi('Status Karyawan Belum Dipilih!', 'warning');
    return false;
  } else if (PasswordBaru !== '') {

    if(PasswordBaru.length < 8){
        validasi('Password Minimal 8 Karakter!', 'warning');
        return false;
    }
  }
}