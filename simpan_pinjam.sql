-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2022 pada 15.24
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpan_pinjam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `status`) VALUES
('A-00001', 'Menink', 'Sampang', 'Aktif'),
('A-00002', 'Ari', 'Nganjuk', 'Aktif'),
('A-00003', 'Sinta', 'Rembang', 'Aktif'),
('A-00004', 'Hendy', 'Madiun', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `bukti_transaksi_an` varchar(10) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `periode_angsuran` int(11) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `jasa` varchar(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `bukti_transaksi_an`, `id_pinjaman`, `id_anggota`, `tanggal`, `periode_angsuran`, `nominal`, `jasa`, `keterangan`) VALUES
(1, 'R-00000001', 1, 'A-00001', '2022-04-25', 1, '186667.00', '1%', 'Bayar Angsuran Menink ke 1'),
(2, 'R-00000002', 1, 'A-00001', '2022-04-25', 2, '186667.00', '1%', 'Bayar Angsuran Menink ke 2'),
(5, 'R-00000003', 1, 'A-00001', '2022-04-28', 3, '186667.00', '1%', 'Bayar Angsuran Menink ke 3'),
(6, 'R-00000004', 2, 'A-00002', '2022-04-29', 1, '330000.00', '1%', 'Bayar Angsuran Ari'),
(7, 'R-00000005', 2, 'A-00002', '2022-04-29', 2, '330000.00', '1%', 'Bayar Angsuran Ari ke 2'),
(8, 'R-00000006', 3, 'A-00003', '2022-06-14', 1, '1100000.00', '1%', 'Angsuran ke 1'),
(9, 'R-00000007', 3, 'A-00003', '2022-07-14', 2, '1100000.00', '1%', 'Angsuran Ke 2 Sinta'),
(10, 'R-00000008', 4, 'A-00004', '2022-07-14', 1, '210000.00', '1%', 'Angsuran Ke 1 Hendy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_akun`
--

CREATE TABLE `daftar_akun` (
  `kode_akun` varchar(10) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `pos_laporan` varchar(50) NOT NULL,
  `pos_akun` varchar(50) NOT NULL,
  `saldo_normal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_akun`
--

INSERT INTO `daftar_akun` (`kode_akun`, `akun`, `pos_laporan`, `pos_akun`, `saldo_normal`) VALUES
('1-101', 'Kas', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-102', 'Bank', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-103', 'Piutang Uang', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-104', 'Piutang Sembako dan Barang', 'Laporan Posisi Keuangan', 'Aset Lancar', 'Debit'),
('1-201', 'Inventaris', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Debit'),
('1-202', 'Akumulasi Penyusutan inventaris', 'Laporan Posisi Keuangan', 'Aset Tetap', 'Kredit'),
('2-101', 'Simpanan Sukarela', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-102', 'Tabungan Lebaran', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-103', 'Dana Pengurus', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-104', 'Dana Karyawan', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-105', 'Dana Pendidikan', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-106', 'Dana Sosial', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-107', 'Pajak Belum Dibayar', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('2-108', 'SHU Tahun Lalu', 'Laporan Posisi Keuangan', 'Kewajiban', 'Kredit'),
('3-101', 'Simpanan Pokok ', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-102', 'Simpanan Wajib', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-103', 'Hibah', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-104', 'Cadang Koperasi', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-105', 'SHU Belum Dibagi/SHU Tahun Berjalan', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('3-106', 'Cadangan Resiko Koperasi', 'Laporan Posisi Keuangan', 'Ekuitas', 'Kredit'),
('4-101', 'Jasa Piutang', 'Laporan Perhitungan Hasil Usaha', 'Pendapatan', 'Kredit'),
('4-102', 'Provisi', 'Laporan Perhitungan Hasil Usaha', 'Pendapatan', 'Kredit'),
('4-103', 'Pendapatan Lain Lain ', 'Laporan Perhitungan Hasil Usaha', 'Pendapatan', 'Kredit'),
('4-104', 'Pendapatan Retail ', 'Laporan Perhitungan Hasil Usaha', 'Pendapatan', 'Kredit'),
('5-101', 'Biaya Organisasi', 'Laporan Perhitungan Hasil Usaha', 'Beban', 'Debit'),
('5-102', 'Biaya RAT ', 'Laporan Perhitungan Hasil Usaha', 'Beban', 'Debit'),
('5-103', 'Biaya Operasional', 'Laporan Perhitungan Hasil Usaha', 'Beban', 'Debit'),
('5-104', 'Biaya Administrasi dan Umum', 'Laporan Perhitungan Hasil Usaha', 'Beban', 'Debit'),
('5-105', 'Biaya Penyusutan Inventaris', 'Laporan Perhitungan Hasil Usaha', 'Beban', 'Debit'),
('6-101', 'Pajak', 'Laporan Perhitungan Hasil Usaha', 'Pajak', 'Debit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `bukti_transaksi_p` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `provisi` varchar(5) NOT NULL,
  `lama_angsur` varchar(15) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status_pinjam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `bukti_transaksi_p`, `id_anggota`, `nominal`, `tanggal_pinjam`, `provisi`, `lama_angsur`, `keterangan`, `status_pinjam`) VALUES
(1, 'P-00000001', 'A-00001', '2000000.00', '2022-04-24', '1%', '12', 'Pinjaman Menink', 'Belum Lunas'),
(2, 'P-00000002', 'A-00002', '3000000.00', '2022-04-28', '1%', '10', 'Pinjaman Ari', 'Belum Lunas'),
(3, 'P-00000003', 'A-00003', '10000000.00', '2022-05-31', '1%', '10 Bulan', 'Pinjaman Sinta', 'Belum Lunas'),
(4, 'P-00000004', 'A-00004', '1000000.00', '2022-06-01', '1%', '5 Bulan', 'Pinjaman Hendy', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo_awal`
--

CREATE TABLE `saldo_awal` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pos_laporan` varchar(50) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `debit` decimal(15,2) NOT NULL,
  `kredit` decimal(15,2) NOT NULL,
  `pos_akun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo_awal`
--

INSERT INTO `saldo_awal` (`id`, `kode_akun`, `keterangan`, `tanggal_transaksi`, `pos_laporan`, `akun`, `debit`, `kredit`, `pos_akun`) VALUES
(1, '3-101', 'Simpanan Pokok Awal', '2022-01-01', 'Laporan Posisi Keuangan', 'Simpanan Pokok ', '0.00', '1000000.00', 'Ekuitas'),
(2, '3-102', 'kaaf', '2022-01-01', 'Laporan Posisi Keuangan', 'Simpanan Wajib', '0.00', '2000000.00', 'Ekuitas'),
(3, '3-103', 'ajkfa', '2022-01-01', 'Laporan Posisi Keuangan', 'Hibah', '0.00', '3000000.00', 'Ekuitas'),
(4, '3-104', 'akjfakf', '2022-01-01', 'Laporan Posisi Keuangan', 'Cadang Koperasi', '0.00', '4000000.00', 'Ekuitas'),
(5, '3-105', 'ghj', '2022-01-01', 'Laporan Posisi Keuangan', 'SHU Belum Dibagi/SHU Tahun Berjalan', '0.00', '0.00', 'Ekuitas'),
(6, '3-106', 'jahjfka', '2022-01-01', 'Laporan Posisi Keuangan', 'Cadangan Resiko Koperasi', '0.00', '6000000.00', 'Ekuitas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `bukti_transaksi_s` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `saldo` decimal(15,2) NOT NULL,
  `jenis_simpanan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `bukti_transaksi_s`, `id_anggota`, `saldo`, `jenis_simpanan`, `tanggal`) VALUES
(1, 'S-00000001', 'A-00001', '3000000.00', 'Simpanan Pokok', '2022-04-24'),
(2, 'S-00000002', 'A-00001', '7000000.00', 'Simpanan Sukarela', '2022-04-27'),
(3, 'S-00000003', 'A-00002', '5000000.00', 'Simpanan Pokok', '2022-04-27'),
(4, 'S-00000004', 'A-00002', '50000.00', 'Simpanan Wajib', '2022-05-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pos_saldo` varchar(10) NOT NULL,
  `pos_laporan` varchar(50) NOT NULL,
  `bukti_transaksi` varchar(10) NOT NULL,
  `bukti_transaksi_kop` varchar(10) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `debit` decimal(15,2) NOT NULL,
  `kredit` decimal(15,2) NOT NULL,
  `pos_akun` varchar(50) NOT NULL,
  `ref` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_akun`, `keterangan`, `tanggal_transaksi`, `pos_saldo`, `pos_laporan`, `bukti_transaksi`, `bukti_transaksi_kop`, `akun`, `debit`, `kredit`, `pos_akun`, `ref`) VALUES
(1, '1-101', 'Pendapatan', '2022-04-12', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000001', '', 'Kas', '1000000.00', '0.00', 'Aset Lancar', 'JU'),
(2, '4-103', 'Pendapatan', '2022-04-12', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000001', '', 'Pendapatan Lain Lain ', '0.00', '1000000.00', 'Pendapatan', 'JU'),
(3, '5-105', 'Penyusutan inventaris', '2022-04-30', 'Debit', 'Laporan Perhitungan Hasil Usaha', 'JP-0000001', '', 'Biaya Penyusutan Inventaris', '100000.00', '0.00', 'Beban', 'JP'),
(4, '1-202', 'Penyusutan inventaris', '2022-04-30', 'Kredit', 'Laporan Posisi Keuangan', 'JP-0000001', '', 'Akumulasi Penyusutan inventaris', '0.00', '100000.00', 'Aset Tetap', 'JP'),
(5, '1-103', 'Pinjaman Menink', '2022-04-24', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000002', 'P-00000001', 'Piutang Uang', '2000000.00', '0.00', 'Aset Lancar', 'JU'),
(6, '1-101', 'Pinjaman Menink', '2022-04-24', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000002', 'P-00000001', 'Kas', '0.00', '1980000.00', 'Aset Lancar', 'JU'),
(7, '4-102', 'Pinjaman Menink', '2022-04-24', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000002', 'P-00000001', 'Provisi', '0.00', '20000.00', 'Pendapatan', 'JU'),
(8, '1-101', 'Bayar Angsuran Menink ke 1', '2022-04-25', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000003', 'R-00000001', 'Kas', '186667.00', '0.00', 'Aset Lancar', 'JU'),
(9, '1-103', 'Bayar Angsuran Menink ke 1', '2022-04-25', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000003', 'R-00000001', 'Piutang Uang', '0.00', '166667.00', 'Aset Lancar', 'JU'),
(10, '4-101', 'Bayar Angsuran Menink ke 1', '2022-04-25', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000003', 'R-00000001', 'Jasa Piutang', '0.00', '20000.00', 'Pendapatan', 'JU'),
(11, '1-101', 'Bayar Angsuran Menink ke 2', '2022-04-25', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000004', 'R-00000002', 'Kas', '186667.00', '0.00', 'Aset Lancar', 'JU'),
(12, '1-103', 'Bayar Angsuran Menink ke 2', '2022-04-25', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000004', 'R-00000002', 'Piutang Uang', '0.00', '166667.00', 'Aset Lancar', 'JU'),
(13, '4-101', 'Bayar Angsuran Menink ke 2', '2022-04-25', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000004', 'R-00000002', 'Jasa Piutang', '0.00', '20000.00', 'Pendapatan', 'JU'),
(14, '1-101', 'Setor Simpanan Pokok Menink', '2022-04-24', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000005', 'S-00000001', 'Kas', '3000000.00', '0.00', 'Aset Lancar', 'JU'),
(15, '3-101', 'Setor Simpanan Pokok Menink', '2022-04-24', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000005', 'S-00000001', 'Simpanan Pokok ', '0.00', '3000000.00', 'Ekuitas', 'JU'),
(16, '6-101', 'Bayar Pajak', '2022-04-26', 'Debit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000006', '', 'Pajak', '100000.00', '0.00', 'Pajak', 'JU'),
(17, '2-107', 'Bayar Pajak', '2022-04-26', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000006', '', 'Pajak Belum Dibayar', '0.00', '100000.00', 'Kewajiban', 'JU'),
(18, '1-101', 'Setor Simpanan Sukarela Menink', '2022-04-27', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000007', 'S-00000002', 'Kas', '7000000.00', '0.00', 'Aset Lancar', 'JU'),
(19, '2-101', 'Setor Simpanan Sukarela Menink', '2022-04-27', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000007', 'S-00000002', 'Simpanan Sukarela', '0.00', '7000000.00', 'Kewajiban', 'JU'),
(20, '1-101', 'Setor Simpanan Pokok Ari', '2022-04-27', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000008', 'S-00000003', 'Kas', '5000000.00', '0.00', 'Aset Lancar', 'JU'),
(21, '3-101', 'Setor Simpanan Pokok Ari', '2022-04-27', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000008', 'S-00000003', 'Simpanan Pokok ', '0.00', '5000000.00', 'Ekuitas', 'JU'),
(28, '1-101', 'Bayar Angsuran Menink ke 3', '2022-04-28', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000009', 'R-00000003', 'Kas', '186667.00', '0.00', 'Aset Lancar', 'JU'),
(29, '1-103', 'Bayar Angsuran Menink ke 3', '2022-04-28', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000009', 'R-00000003', 'Piutang Uang', '0.00', '166667.00', 'Aset Lancar', 'JU'),
(30, '4-101', 'Bayar Angsuran Menink ke 3', '2022-04-28', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000009', 'R-00000003', 'Jasa Piutang', '0.00', '20000.00', 'Pendapatan', 'JU'),
(31, '1-103', 'Pinjaman Ari', '2022-04-28', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000010', 'P-00000002', 'Piutang Uang', '3000000.00', '0.00', 'Aset Lancar', 'JU'),
(32, '1-101', 'Pinjaman Ari', '2022-04-28', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000010', 'P-00000002', 'Kas', '0.00', '2970000.00', 'Aset Lancar', 'JU'),
(33, '4-102', 'Pinjaman Ari', '2022-04-28', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000010', 'P-00000002', 'Provisi', '0.00', '30000.00', 'Pendapatan', 'JU'),
(34, '1-101', 'Bayar Angsuran Ari', '2022-04-29', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000011', 'R-00000004', 'Kas', '330000.00', '0.00', 'Aset Lancar', 'JU'),
(35, '1-103', 'Bayar Angsuran Ari', '2022-04-29', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000011', 'R-00000004', 'Piutang Uang', '0.00', '300000.00', 'Aset Lancar', 'JU'),
(36, '4-101', 'Bayar Angsuran Ari', '2022-04-29', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000011', 'R-00000004', 'Jasa Piutang', '0.00', '30000.00', 'Pendapatan', 'JU'),
(37, '1-101', 'Bayar Angsuran Ari ke 2', '2022-04-29', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000012', 'R-00000005', 'Kas', '330000.00', '0.00', 'Aset Lancar', 'JU'),
(38, '1-103', 'Bayar Angsuran Ari ke 2', '2022-04-29', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000012', 'R-00000005', 'Piutang Uang', '0.00', '300000.00', 'Aset Lancar', 'JU'),
(39, '4-101', 'Bayar Angsuran Ari ke 2', '2022-04-29', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000012', 'R-00000005', 'Jasa Piutang', '0.00', '30000.00', 'Pendapatan', 'JU'),
(40, '1-101', 'Setor Simpanan Wajib Ari', '2022-05-31', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000013', 'S-00000004', 'Kas', '50000.00', '0.00', 'Aset Lancar', 'JU'),
(41, '3-102', 'Setor Simpanan Wajib Ari', '2022-05-31', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000013', 'S-00000004', 'Simpanan Wajib', '0.00', '50000.00', 'Ekuitas', 'JU'),
(42, '1-103', 'Pinjaman Sinta', '2022-05-31', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000014', 'P-00000003', 'Piutang Uang', '10000000.00', '0.00', 'Aset Lancar', 'JU'),
(43, '1-101', 'Pinjaman Sinta', '2022-05-31', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000014', 'P-00000003', 'Kas', '0.00', '9900000.00', 'Aset Lancar', 'JU'),
(44, '4-102', 'Pinjaman Sinta', '2022-05-31', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000014', 'P-00000003', 'Provisi', '0.00', '100000.00', 'Pendapatan', 'JU'),
(45, '1-101', 'Angsuran ke 1', '2022-06-14', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000015', 'R-00000006', 'Kas', '1100000.00', '0.00', 'Aset Lancar', 'JU'),
(46, '1-103', 'Angsuran ke 1', '2022-06-14', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000015', 'R-00000006', 'Piutang Uang', '0.00', '1000000.00', 'Aset Lancar', 'JU'),
(47, '4-101', 'Angsuran ke 1', '2022-06-14', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000015', 'R-00000006', 'Jasa Piutang', '0.00', '100000.00', 'Pendapatan', 'JU'),
(48, '1-101', 'Angsuran Ke 2 Sinta', '2022-07-14', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000016', 'R-00000007', 'Kas', '1100000.00', '0.00', 'Aset Lancar', 'JU'),
(49, '1-103', 'Angsuran Ke 2 Sinta', '2022-07-14', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000016', 'R-00000007', 'Piutang Uang', '0.00', '1000000.00', 'Aset Lancar', 'JU'),
(50, '4-101', 'Angsuran Ke 2 Sinta', '2022-07-14', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000016', 'R-00000007', 'Jasa Piutang', '0.00', '100000.00', 'Pendapatan', 'JU'),
(51, '1-103', 'Pinjaman Hendy', '2022-06-01', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000017', 'P-00000004', 'Piutang Uang', '1000000.00', '0.00', 'Aset Lancar', 'JU'),
(52, '1-101', 'Pinjaman Hendy', '2022-06-01', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000017', 'P-00000004', 'Kas', '0.00', '990000.00', 'Aset Lancar', 'JU'),
(53, '4-102', 'Pinjaman Hendy', '2022-06-01', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000017', 'P-00000004', 'Provisi', '0.00', '10000.00', 'Pendapatan', 'JU'),
(54, '1-101', 'Angsuran Ke 1 Hendy', '2022-07-14', 'Debit', 'Laporan Posisi Keuangan', 'JU-0000018', 'R-00000008', 'Kas', '210000.00', '0.00', 'Aset Lancar', 'JU'),
(55, '1-103', 'Angsuran Ke 1 Hendy', '2022-07-14', 'Kredit', 'Laporan Posisi Keuangan', 'JU-0000018', 'R-00000008', 'Piutang Uang', '0.00', '200000.00', 'Aset Lancar', 'JU'),
(56, '4-101', 'Angsuran Ke 1 Hendy', '2022-07-14', 'Kredit', 'Laporan Perhitungan Hasil Usaha', 'JU-0000018', 'R-00000008', 'Jasa Piutang', '0.00', '10000.00', 'Pendapatan', 'JU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` char(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`) VALUES
('U0001', 'wita', '808d2f39b041023a64204bed4a11f29f', 'Wita Dwi Hariyani', 'admin'),
('U0002', 'endah', 'c04d34d48ba14064d47e7ac90bbf3bb9', 'Endah Widyastuti', 'ketua');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`);

--
-- Indeks untuk tabel `daftar_akun`
--
ALTER TABLE `daftar_akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `saldo_awal`
--
ALTER TABLE `saldo_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saldo_awal`
--
ALTER TABLE `saldo_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
