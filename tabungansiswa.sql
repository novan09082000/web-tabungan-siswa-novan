-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Okt 2021 pada 08.56
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabungansiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akunpetugas`
--

CREATE TABLE `akunpetugas` (
  `NIM` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prodi` varchar(30) NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akunpetugas`
--

INSERT INTO `akunpetugas` (`NIM`, `nama`, `prodi`, `kelas`, `email`, `username`, `password`) VALUES
('18110054', 'Novan Tiano', 'Teknik Informatika - S1', 'reguler', 'josenoutinho@gmail.com', 'novan09082000', '$2y$10$o.ji6i6wllc1rjKfq.gopu.f3MLNUgG7gdmypamOxzC0YABCuiP7K');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datanasabah`
--

CREATE TABLE `datanasabah` (
  `No_Nasabah` varchar(20) NOT NULL,
  `No_Rekening` varchar(20) NOT NULL,
  `NIM` varchar(8) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Prodi` varchar(30) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `Gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datanasabah`
--

INSERT INTO `datanasabah` (`No_Nasabah`, `No_Rekening`, `NIM`, `Nama`, `Prodi`, `Kelas`, `Alamat`, `Saldo`, `Gambar`) VALUES
('202110180001', '2021-10-18-0001', '18110054', 'Novan Tiano', 'Teknik Informatika - S1', 'Reguler', 'Katapang', 70000, '616cf45be7b38.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapetugas`
--

CREATE TABLE `datapetugas` (
  `id` int(11) NOT NULL,
  `No_Petugas` varchar(20) NOT NULL,
  `NIM` varchar(8) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Prodi` varchar(30) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datapetugas`
--

INSERT INTO `datapetugas` (`id`, `No_Petugas`, `NIM`, `Nama`, `Prodi`, `Kelas`, `Alamat`, `Gambar`) VALUES
(1, '202110180001', '18110054', 'Novan Tiano', 'Teknik Informatika - S1', 'reguler', 'Katapang', 'Novan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `No_Transaksi` varchar(20) NOT NULL,
  `Tanggal` date NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Jenis_Transaksi` varchar(6) NOT NULL,
  `Debet` int(11) NOT NULL,
  `Kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`No_Transaksi`, `Tanggal`, `Nama`, `Jenis_Transaksi`, `Debet`, `Kredit`) VALUES
('TN-2100001', '2021-10-18', 'Novan Tiano', 'Debit', 10000, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akunpetugas`
--
ALTER TABLE `akunpetugas`
  ADD PRIMARY KEY (`NIM`);

--
-- Indeks untuk tabel `datanasabah`
--
ALTER TABLE `datanasabah`
  ADD PRIMARY KEY (`No_Nasabah`);

--
-- Indeks untuk tabel `datapetugas`
--
ALTER TABLE `datapetugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`No_Transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `datapetugas`
--
ALTER TABLE `datapetugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
