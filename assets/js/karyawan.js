const successKaryawan = $('.success-flash-karyawan').data('flashdata');
const warningKaryawan = $('.warning-flash-karyawan').data('flashdata');
const errorKaryawan = $('.error-flash-karyawan').data('flashdata');

if (successKaryawan) {
    Swal.fire({
        icon: 'success',
        title: successKaryawan,
        showConfirmButton: true,
      })
}

if (warningKaryawan) {
  Swal.fire({
      icon: 'warning',
      title: warningKaryawan,
      showConfirmButton: true,
    })
}

if (errorKaryawan) {
  Swal.fire({
      icon: 'error',
      title: errorKaryawan,
      showConfirmButton: true,
    })
}

function validasiKaryawanUbahKategori() {
  var NamaKategori = document.forms["formKaryawanUbahKategori"]["NamaKategori"].value;
  
  if (NamaKategori == '') {
    validasi('Nama Kategori Barang Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiKaryawanUbahSatuan() {
  var NamaSatuan = document.forms["formKaryawanUbahSatuan"]["NamaSatuan"].value;
  
  if (NamaSatuan == '') {
    validasi('Nama Satuan Barang Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiKaryawanUbahSupplier() {
  var NamaSupplier = document.forms["formKaryawanUbahSupplier"]["NamaSupplier"].value;
  var AlamatSupplier = document.forms["formKaryawanUbahSupplier"]["AlamatSupplier"].value;
  
  if (NamaSupplier == '') {
    validasi('Nama Supplier Barang Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (AlamatSupplier == '') {
    validasi('Alamat Supplier Tidak Boleh Kosong!', 'warning');
    return false;
  }
}

function validasiKaryawanUbahBarang() {
  var NamaBarang = document.forms["formKaryawanUbahBarang"]["NamaBarang"].value;
  var Stok = document.forms["formKaryawanUbahBarang"]["Stok"].value;
  var StokMinimum = document.forms["formKaryawanUbahBarang"]["StokMinimum"].value;
  var HargaJual = document.forms["formKaryawanUbahBarang"]["HargaJual"].value;
  var IdKategori = document.forms["formKaryawanUbahBarang"]["IdKategori"].value;
  var IdSatuan = document.forms["formKaryawanUbahBarang"]["IdSatuan"].value;
  
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