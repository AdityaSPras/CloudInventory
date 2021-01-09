const successSuperAdmin = $('.success-flash-super-admin').data('flashdata');
const warningSuperAdmin = $('.warning-flash-super-admin').data('flashdata');
const errorSuperAdmin = $('.error-flash-super-admin').data('flashdata');

if (successSuperAdmin) {
    Swal.fire({
        icon: 'success',
        title: successSuperAdmin,
        showConfirmButton: true,
      })
}

if (warningSuperAdmin) {
  Swal.fire({
      icon: 'warning',
      title: warningSuperAdmin,
      showConfirmButton: true,
    })
}

if (errorSuperAdmin) {
  Swal.fire({
      icon: 'error',
      title: errorSuperAdmin,
      showConfirmButton: true,
    })
}

function hapus_pembayaran(id) {
  var base_url = $('#hapus_pembayaran').val();

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
      document.location.href = base_url + "hapus_pembayaran/" + id;
    }
  })
}

function hapus_kritik_saran(id) {
  var base_url = $('#hapus_kritik_saran').val();

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
      document.location.href = base_url + "hapus_kritik_saran/" + id;
    }
  })
}

function validateFormUbahPaket() {
  var Nama = document.forms["formUbahPaket"]["Nama"].value;
  var JumlahBarang = document.forms["formUbahPaket"]["JumlahBarang"].value;
  var JumlahKaryawan = document.forms["formUbahPaket"]["JumlahKaryawan"].value;
  var Harga = document.forms["formUbahPaket"]["Harga"].value;
  
  if (Nama == "") {
    validasi('Nama Paket Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (JumlahBarang == "") {
    validasi('Limit Barang Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (JumlahKaryawan == "") {
    validasi('Limit Karyawan Tidak Boleh Kosong!', 'warning');
    return false;
  } else if (Harga == "") {
    validasi('Harga Paket Tidak Boleh Kosong!', 'warning');
    return false
  }
}