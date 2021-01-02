-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 06:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u737418190_cloudinventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_aktivasi`
--

CREATE TABLE `tb_aktivasi` (
  `IdAktivasi` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdPembayaran` varchar(15) NOT NULL,
  `IdPaket` int(11) NOT NULL,
  `AwalAktif` date NOT NULL,
  `AkhirAktif` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `IdBarang` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdKategori` varchar(15) NOT NULL,
  `IdSatuan` varchar(15) NOT NULL,
  `NamaBarang` varchar(100) NOT NULL,
  `Gambar` varchar(255) NOT NULL,
  `HargaJual` int(11) NOT NULL,
  `Stok` int(11) NOT NULL,
  `StokMinimum` int(11) NOT NULL,
  `TanggalBarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `IdBarangKeluar` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdBarang` varchar(15) NOT NULL,
  `HargaKeluar` int(11) NOT NULL,
  `TanggalKeluar` date NOT NULL,
  `JumlahKeluar` int(11) NOT NULL,
  `TotalKeluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`IdBarangKeluar`, `IdUser`, `IdPerusahaan`, `IdBarang`, `HargaKeluar`, `TanggalKeluar`, `JumlahKeluar`, `TotalKeluar`) VALUES
('ID-BRK-0001', 'ID-ADM-002', 'ID-PRH-001', 'ID-BRG-0001', 121, '2020-12-30', 212, 25652);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_masuk`
--

CREATE TABLE `tb_barang_masuk` (
  `IdBarangMasuk` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdBarang` varchar(15) NOT NULL,
  `IdSupplier` varchar(15) NOT NULL,
  `HargaBeli` int(11) NOT NULL,
  `TanggalMasuk` date NOT NULL,
  `JumlahMasuk` varchar(30) NOT NULL,
  `TotalMasuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`IdBarangMasuk`, `IdUser`, `IdPerusahaan`, `IdBarang`, `IdSupplier`, `HargaBeli`, `TanggalMasuk`, `JumlahMasuk`, `TotalMasuk`) VALUES
('ID-BRM-0001', 'ID-ADM-002', 'ID-PRH-001', 'ID-BRG-0001', 'ID-SPL-0001', 12, '2020-12-30', '12', 144);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `IdKategori` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `NamaKategori` varchar(50) NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `TanggalKategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kritik_saran`
--

CREATE TABLE `tb_kritik_saran` (
  `IdKritikSaran` int(11) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `Pesan` text NOT NULL,
  `Tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `IdPaket` int(11) NOT NULL,
  `Nama` varchar(25) NOT NULL,
  `JumlahBarang` int(11) NOT NULL,
  `JumlahKaryawan` int(11) NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`IdPaket`, `Nama`, `JumlahBarang`, `JumlahKaryawan`, `Harga`) VALUES
(1, 'Gratis', 15, 2, 0),
(2, 'Premium', 150, 5, 30000),
(3, 'Enterprise', 500, 10, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `IdPembayaran` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdPaket` int(11) NOT NULL,
  `SubBayar` int(11) NOT NULL,
  `TotalBayar` int(11) NOT NULL,
  `BuktiPembayaran` varchar(255) NOT NULL,
  `TanggalPembayaran` datetime NOT NULL,
  `TipePembayaran` int(11) NOT NULL,
  `Status` enum('Belum Dikonfirmasi','Pembayaran Diterima','Pembayaran Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `IdPerusahaan` varchar(15) NOT NULL,
  `IdPaket` int(11) NOT NULL,
  `NamaPerusahaan` varchar(100) NOT NULL,
  `NamaPemilik` varchar(100) NOT NULL,
  `AlamatPerusahaan` text NOT NULL,
  `NomorTeleponPerusahaan` varchar(20) NOT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `EmailPerusahaan` varchar(100) NOT NULL,
  `Logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`IdPerusahaan`, `IdPaket`, `NamaPerusahaan`, `NamaPemilik`, `AlamatPerusahaan`, `NomorTeleponPerusahaan`, `Fax`, `EmailPerusahaan`, `Logo`) VALUES
('ID-PRH-001', 1, 'PT. Datayasa Komputer', 'Lilis Yuningsih', 'Jl. Raya Puputan No.86, Denpasar Timur', '0361244445', '264773', 'info@datayasa.com', 'Datayasa_Komputer.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `IdSatuan` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `NamaSatuan` varchar(50) NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `TanggalSatuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `IdSupplier` varchar(15) NOT NULL,
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `NamaSupplier` varchar(100) NOT NULL,
  `AlamatSupplier` text NOT NULL,
  `NomorTeleponSupplier` varchar(20) DEFAULT NULL,
  `EmailSupplier` varchar(100) DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `TanggalSupplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `IdToken` int(11) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `IdUser` varchar(15) NOT NULL,
  `IdPerusahaan` varchar(15) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Alamat` text DEFAULT NULL,
  `JenisKelamin` varchar(15) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `NomorTelepon` varchar(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Level` enum('Super Admin','Admin','Karyawan') NOT NULL,
  `Status` enum('Aktif','Tidak Aktif') NOT NULL,
  `TanggalDibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`IdUser`, `IdPerusahaan`, `NamaLengkap`, `Alamat`, `JenisKelamin`, `Foto`, `NomorTelepon`, `Email`, `Password`, `Level`, `Status`, `TanggalDibuat`) VALUES
('1', '', 'Cloud Inventory', 'Jl. Raya Puputan No.86, Denpasar Timur', NULL, 'Icon1.png', '+62 851 5617 5274', 'admin@cloud.com', '$2y$10$FA6m.yVX3bYks1E5bUQvRuLKNuh3IFMjluvfXX4ZKNhy29drkgZYC', 'Super Admin', 'Aktif', 1608269508),
('ID-ADM-002', 'ID-PRH-001', 'Lilis Yuningsih', 'Jl. Jayagiri No.8A, Denpasar Timur', 'Perempuan', 'LIS1.png', '+62 812 3627 9999', 'lilis@stikom-bali.ac.id', '$2y$10$njt9x5a7R1cA9q7MhmtPY.R9iOafpxJobT19a2pyTKTfV5UbzGqn6', 'Admin', 'Aktif', 1608272261);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aktivasi`
--
ALTER TABLE `tb_aktivasi`
  ADD PRIMARY KEY (`IdAktivasi`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`IdBarang`);

--
-- Indexes for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  ADD PRIMARY KEY (`IdBarangKeluar`);

--
-- Indexes for table `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  ADD PRIMARY KEY (`IdBarangMasuk`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`IdKategori`);

--
-- Indexes for table `tb_kritik_saran`
--
ALTER TABLE `tb_kritik_saran`
  ADD PRIMARY KEY (`IdKritikSaran`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`IdPaket`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`IdPembayaran`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`IdPerusahaan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`IdSatuan`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`IdSupplier`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`IdToken`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kritik_saran`
--
ALTER TABLE `tb_kritik_saran`
  MODIFY `IdKritikSaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `IdPaket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `IdToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;