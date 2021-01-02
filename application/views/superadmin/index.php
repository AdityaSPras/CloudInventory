<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Content Row -->
  <div class="row">

    <!-- Jumlah Perusahaan Terdaftar -->
    <div class="col-xl-6 col-md-6 mb-2">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Perusahaan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_perusahaan ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-building fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Jumlah Paket Layanan -->
    <div class="col-xl-6 col-md-6 mb-2">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Paket Layanan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_paket ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cubes fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">

    <!-- Jumlah Kritik & Saran -->
    <div class="col-xl-6 col-md-6 mb-2">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kritik & Saran</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kritik_saran ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-grin fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Jumlah Permintaan Konfirmasi Pembayaran -->
    <div class="col-xl-6 col-md-6 mb-2">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Permintaan Konfirmasi Pembayaran</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_permintaan_konfirmasi ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-bullhorn fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->
  <div class="row mb-2">

    <div class="col-sm-12 card shadow">
      <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary text-center">SELAMAT DATANG</h5>
      </div>
      <div class="card-body py-4">
        <h6 class="text-center"><b>SISTEM INFORMASI CLOUD INVENTORY</b>
          <p>Anda Telah Login Sebagai <b><?= $user['NamaLengkap']; ?></b></p>
          <p>Level User Anda : <b><?= $user['Level']; ?></b></p>
        </h6>
      </div>
    </div>

  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->