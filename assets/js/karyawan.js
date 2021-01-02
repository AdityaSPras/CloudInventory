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