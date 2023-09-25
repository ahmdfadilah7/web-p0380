-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2023 at 01:15 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-p0380`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `pelanggan_id`, `nama_penerima`, `no_penerima`, `alamat`, `created_at`, `updated_at`) VALUES
(5, 4, 'Rudi Salim', '0898126828', 'Kp. Jauh\r\nDesa Terdekat, Kec. Dimana - Mana', '2023-06-09 01:03:13', '2023-06-09 01:03:13'),
(6, 5, 'Siti Paridah', '08134797460', 'Terminal Condong Catur, Jl. Cemara, No.20', '2023-06-09 16:58:06', '2023-06-09 16:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `nama_bank`, `logo_bank`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'images/Bank-BCA-HYN6.webp', '2023-05-31 21:20:20', '2023-05-31 21:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_diskon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL,
  `stok_minimum` int DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kategori_id`, `kode_barang`, `nama_barang`, `foto_barang`, `harga_beli`, `harga_barang`, `diskon`, `harga_diskon`, `stok`, `stok_minimum`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(10, 2, 'TMKW00003', 'Modifikasi Kulit Wanita Uk\' Besar', 'images/Barang-Tas-Rotan-wanita-uk\'-besar-DaUv.jpg', '600000', '800000', NULL, NULL, 31, 5, 1, 2, '2023-06-09 00:35:03', '2023-06-20 00:57:11'),
(12, 2, 'TMKW00002', 'Modifikasi Kulit Wanita Uk\' Sedang', 'images/Barang-Tas-Rotan-wanita-uk\'-sedang-P10R.jpg', '450000', '600000', NULL, NULL, 17, 8, 2, 2, '2023-06-09 15:30:10', '2023-06-13 07:31:35'),
(13, 2, 'TMKW00001', 'Modifikasi Kulit Wanita Uk\' Kecil', 'images/Barang-Tas-Rotan-wanita-uk\'-kecil-lotQ.jpg', '230000', '400000', NULL, NULL, 10, 5, 2, 2, '2023-06-09 15:30:42', '2023-06-13 04:05:08'),
(14, 3, 'TOW00003', 'Tas Original Wanita Uk\' Besar', 'images/Barang-Ukuran-Besar-PowM.jpg', '170000', '300000', NULL, NULL, 10, 5, 2, 2, '2023-06-09 15:50:45', '2023-06-13 06:30:22'),
(15, 3, 'TOW00002', 'Tas Original Wanita Uk\' Sedang', 'images/Barang-Ukuran-Sedang-uB9t.jpg', '110000', '200000', NULL, NULL, 10, 10, 2, 2, '2023-06-09 15:51:10', '2023-06-13 04:04:52'),
(16, 3, 'TOW00001', 'Tas Original Wanita Uk\' Kecil', 'images/Barang-Ukuran-Kecil-a1xl.jpg', '75000', '150000', NULL, NULL, 10, 10, 2, 2, '2023-06-09 15:51:34', '2023-06-13 04:04:44'),
(17, 6, 'TOP00003', 'Original Pria Uk\' Besar (45 Cincin)', 'images/Barang-Ukuran-Besar-(45-Cincin)-rBOV.jpg', '200000', '300000', NULL, NULL, 6, 5, 2, 2, '2023-06-09 15:53:16', '2023-06-13 04:04:35'),
(18, 6, 'TOP00002', 'Original Pria Uk\' Sedang (35 Cincin)', 'images/Barang-Ukuran-Kecil-(35-Cincin)-a6PS.jpg', '160000', '200000', NULL, NULL, 9, 10, 2, 2, '2023-06-09 15:53:54', '2023-06-13 04:04:26'),
(19, 6, 'TOP00001', 'Original Pria Uk\' Kecil (27 Cincin)', 'images/Barang-Ukuran-Kecil-(27-Cincin)-1OlR.jpg', '50000', '100000', NULL, NULL, 6, 5, 2, 2, '2023-06-09 15:54:24', '2023-06-19 16:23:06'),
(20, 5, 'TMKP00002', 'Tas Modifikasi Kulit Pria Uk\' Besar', 'images/Barang-Ukuran-Besar-Jw5h.jpg', '450000', '600000', '5', '570000', 0, 10, 2, 2, '2023-06-09 16:02:37', '2023-06-19 10:11:02'),
(21, 5, 'TMKP00001', 'Tas Modifikasi Kulit Pria Uk\' Sedang', 'images/Barang-Ukuran-Sedang-rGAE.jpg', '350000', '400000', '10', '360000', 6, 5, 2, 2, '2023-06-09 16:02:57', '2023-06-13 18:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjek_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `jasakirim_id` bigint UNSIGNED DEFAULT NULL,
  `rekening_id` bigint UNSIGNED DEFAULT NULL,
  `ongkos_kirim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 di keranjang, 1 checkout, 2 upload pembayaran, 3 konfirmasi, 4 selesai, 5 batal',
  `konfirmasi` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Belum di Konfirmasi, 1 Konfirmasi Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `kode_invoice`, `pelanggan_id`, `jasakirim_id`, `rekening_id`, `ongkos_kirim`, `total_invoice`, `status`, `konfirmasi`, `created_at`, `updated_at`) VALUES
(27, 'INVKJ9913062023MKIUP', 4, 1, 3, '12000', '582000', '4', '0', '2023-06-13 10:58:44', '2023-06-13 11:01:14'),
(28, 'INVKJ9913062023H0DDA', 4, 1, 3, '12000', '212000', '4', '0', '2023-06-13 11:01:59', '2023-06-13 11:02:24'),
(29, 'INVKJ9914062023LLUFT', 4, 2, 3, '15000', '375000', '4', '0', '2023-06-13 18:04:32', '2023-06-13 18:04:57'),
(30, 'INVKJ9919062023XWILS', 4, 1, 3, '12000', '372000', '1', '0', '2023-06-19 10:16:15', '2023-06-19 10:18:18'),
(31, 'INVKJ9919062023VKEYK', 4, 2, 3, '15000', '375000', '1', '0', '2023-06-19 10:30:02', '2023-06-19 10:34:24'),
(32, 'INVKJ9919062023EACSL', 4, 1, 3, NULL, '360000', '1', '0', '2023-06-19 10:39:07', '2023-06-19 10:54:28'),
(33, 'INVKJ9919062023ATU6N', 4, 2, 3, '15000', '215000', '3', '1', '2023-06-19 10:55:36', '2023-06-19 16:31:39'),
(34, 'INVKJ9919062023GCVWQ', 4, NULL, NULL, NULL, NULL, '0', '0', '2023-06-19 16:21:33', '2023-06-19 16:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_kirims`
--

CREATE TABLE `jasa_kirims` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jasa_kirims`
--

INSERT INTO `jasa_kirims` (`id`, `nama`, `ongkir`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'JNE', '12000', 1, 2, '2023-06-09 00:02:14', '2023-06-11 09:18:08'),
(2, 'J&T', '15000', 2, 2, '2023-06-09 17:04:35', '2023-06-11 09:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `name`, `singkatan`, `created_at`, `updated_at`) VALUES
(2, 'Tas Modifikasi Kulit Wanita', 'TMKW', '2023-05-31 20:53:11', '2023-06-13 03:05:19'),
(3, 'Tas Original Wanita', 'TOW', '2023-05-31 20:53:16', '2023-06-13 03:05:24'),
(5, 'Tas Modifikasi Kulit Pria', 'TMKP', '2023-06-09 15:42:09', '2023-06-13 03:05:29'),
(6, 'Tas Original Pria', 'TOP', '2023-06-09 15:47:14', '2023-06-13 03:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_31_164637_create_pelanggans_table', 1),
(6, '2023_05_31_165037_create_kategoris_table', 1),
(7, '2023_05_31_165152_create_barangs_table', 2),
(8, '2023_05_31_165749_create_transaksis_table', 3),
(9, '2023_06_01_021547_create_settings_table', 4),
(10, '2023_06_01_032002_create_banks_table', 5),
(11, '2023_06_01_032011_create_rekenings_table', 5),
(12, '2023_06_02_082845_create_sliders_table', 6),
(14, '2023_06_02_111829_create_invoices_table', 7),
(15, '2023_06_02_112415_add_field_invoice_id_to_transaksis', 8),
(16, '2023_06_03_112206_add_field_pelanggan_id_to_invoices', 9),
(17, '2023_06_03_134756_create_jasa_kirims_table', 10),
(18, '2023_06_03_141146_add_field_jasakirim_id_to_invoices', 11),
(19, '2023_06_03_155452_create_pembayarans_table', 12),
(20, '2023_06_03_172337_add_field_foto_to_pelanggans', 13),
(21, '2023_06_03_195658_create_alamats_table', 14),
(22, '2023_06_04_110649_add_field_total_invoice_to_invoices', 15),
(23, '2023_06_04_122759_add_field_nama_penerima_to_pelanggans', 16),
(24, '2023_06_04_140223_create_contacts_table', 17),
(25, '2023_06_04_144249_add_field_foto_to_users', 18),
(26, '2023_06_09_065310_add_field_created_by_to_jasa_kirims', 19),
(27, '2023_06_09_071248_add_field_created_by_to_sliders', 20),
(28, '2023_06_09_072340_add_field_created_by_to_barangs', 21),
(29, '2023_06_09_072425_add_field_created_by_to_rekenings', 22),
(30, '2023_06_11_161335_add_field_ongkir_to_jasa_kirims', 23),
(31, '2023_06_11_164225_add_field_ongkos_kirim_to_invoices', 24),
(32, '2023_06_11_195445_add_field_stok_minimun_to_barangs', 25),
(33, '2023_06_11_201353_create_pembelians_table', 26),
(34, '2023_06_11_201917_add_field_created_by_to_pembelians', 27),
(35, '2023_06_13_085441_add_field_kode_barang_to_barangs', 28),
(36, '2023_06_13_100140_add_field_singkatan_to_kategoris', 29),
(37, '2023_06_13_105811_add_field_harga_beli_to_barangs', 30),
(38, '2023_06_13_133134_create_suppliers_table', 31),
(39, '2023_06_13_141912_add_field_ongkos_kirim_to_pembelians', 32),
(40, '2023_06_13_142749_add_field_kode_pembelian_to_pembelians', 33),
(41, '2023_06_13_151625_add_field_diskon_to_barangs', 34),
(42, '2023_06_13_152515_add_field_harga_diskon_to_barangs', 35),
(43, '2023_06_19_231953_add_field_konfirmasi_to_invoices', 36),
(44, '2023_06_20_072006_add_field_saldo_to_settings', 37);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `name`, `foto`, `username`, `email`, `no_hp`, `tgl_lahir`, `jns_kelamin`, `nama_penerima`, `no_penerima`, `alamat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Rudi Salim', NULL, 'rudi123', 'rudi123@gmail.com', '0892829991', '2001-01-01', 'Pria', 'Rudi Salim', '0898126828', 'Kp. Jauh\r\nDesa Terdekat, Kec. Dimana - Mana', NULL, '$2y$10$/sLLlVui16zHEkTXHgvH1.R9zuBZw17N8QvhuY.XWqIO0iBx.ZBkS', NULL, '2023-06-09 01:00:12', '2023-06-09 01:03:41'),
(5, 'Siti Paridah', NULL, 'siti paridah', 'siti@gmail.com', '081347897460', '2001-07-29', 'Wanita', 'Siti Paridah', '08134797460', 'Terminal Condong Catur, Jl. Cemara, No.20', NULL, '$2y$10$3ycFXJiN3jr1mf4paA.FeOsqgK6i62x2hlv0JQuWDJCQl3k29qhum', NULL, '2023-06-09 16:52:58', '2023-06-09 16:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Menunggu Konfirmasi, 1 Berhasil, 2 Gagal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `invoice_id`, `bukti_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(14, 27, 'images/Bukti-Pembayaran-INVKJ9913062023MKIUP-nwr.webp', '1', '2023-06-13 11:01:08', '2023-06-13 11:01:13'),
(15, 28, 'images/Bukti-Pembayaran-INVKJ9913062023H0DDA-hng.webp', '1', '2023-06-13 11:02:17', '2023-06-13 11:02:22'),
(16, 29, 'images/Bukti-Pembayaran-INVKJ9914062023LLUFT-zSW.webp', '1', '2023-06-13 18:04:50', '2023-06-13 18:04:54'),
(17, 33, 'images/Bukti-Pembayaran-INVKJ9919062023ATU6N-HuW.webp', '1', '2023-06-19 11:28:22', '2023-06-19 16:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkos_kirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelians`
--

INSERT INTO `pembelians` (`id`, `kode_pembelian`, `supplier_id`, `barang_id`, `jumlah`, `harga`, `ongkos_kirim`, `total`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 'PMB00001', 1, 10, 5, '600000', '50000', '3050000', 2, 2, '2023-06-11 17:00:00', '2023-06-13 07:31:12'),
(7, 'PMB00002', 1, 12, 7, '450000', '10000', '3160000', 2, 2, '2023-06-13 07:31:35', '2023-06-13 07:31:35'),
(8, 'PMB00003', 1, 10, 12, '600000', '20000', '7220000', 2, 2, '2023-06-20 00:57:11', '2023-06-20 00:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED NOT NULL,
  `nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `bank_id`, `nama_rekening`, `no_rekening`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, 'Kios Jaya 99', '21717711', 1, 2, '2023-06-09 00:37:18', '2023-06-09 00:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_map` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_website`, `saldo`, `logo`, `favicon`, `alamat`, `google_map`, `email`, `no_telp`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 'Kios Jaya 99', '2780000', 'images/Logo-Kios-Jaya-99-NHKs.png', 'images/Favicon-Kios-Jaya-99-aDWh.png', '<p>Kios Jaya 99</p>', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.976542690506!2d106.8182876743306!3d-6.397024293593563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb9b9ebc6ce9%3A0x3f35d853d6f1c144!2sWarung%20Nako%20Kopi%20Nako%20Depok!5e0!3m2!1sid!2sid!4v1685588296364!5m2!1sid!2sid', 'kiosjaya99@gmail.com', '081272181990', '<p>Toko Jaya 99 berdiri sejak tahun 2017,</p>\r\n\r\n<p>Kami akan memberikan pengalaman belanja yang menyenangkan!</p>\r\n\r\n<p>Happy Shopping!</p>', '2023-05-31 19:59:29', '2023-06-20 00:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `gambar`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 'images/Slider-NrGt2.jpg', 1, 1, '2023-06-09 00:18:37', '2023-06-09 16:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `toko_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_supplier`, `toko_supplier`, `created_at`, `updated_at`) VALUES
(1, 'Herry', 'Herry Foundation', '2023-06-13 06:47:36', '2023-06-13 06:47:36'),
(2, 'Terry', 'Terry Foundation', '2023-06-13 06:47:48', '2023-06-13 06:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jasa_kirim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuantitas` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `invoice_id`, `barang_id`, `pelanggan_id`, `pembayaran`, `jasa_kirim`, `kuantitas`, `total`, `tanggal`, `created_at`, `updated_at`) VALUES
(34, 27, 20, 4, NULL, NULL, 1, 570000, '2023-06-13', '2023-06-13 10:58:44', '2023-06-13 10:58:44'),
(35, 28, 19, 4, NULL, NULL, 2, 200000, '2023-06-13', '2023-06-13 11:01:59', '2023-06-13 11:01:59'),
(36, 29, 21, 4, NULL, NULL, 1, 360000, '2023-06-14', '2023-06-13 18:04:32', '2023-06-13 18:04:32'),
(37, 30, 21, 4, NULL, NULL, 1, 360000, '2023-06-19', '2023-06-19 10:16:15', '2023-06-19 10:16:15'),
(38, 31, 21, 4, NULL, NULL, 1, 360000, '2023-06-19', '2023-06-19 10:30:02', '2023-06-19 10:30:02'),
(39, 32, 21, 4, NULL, NULL, 1, 360000, '2023-06-19', '2023-06-19 10:39:07', '2023-06-19 10:39:07'),
(40, 33, 19, 4, NULL, NULL, 2, 200000, '2023-06-19', '2023-06-19 10:55:36', '2023-06-19 10:55:36'),
(41, 34, 18, 4, NULL, NULL, 1, 200000, '2023-06-19', '2023-06-19 16:21:33', '2023-06-19 16:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Administrator','Pegawai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `foto`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin', NULL, 'superadmin@gmail.com', NULL, '$2y$10$UwCGQLdm1u5JVB8nGl8Goe9.5xN6kasBQkbmWXUgOy.I2JSWyRw..', 'Administrator', NULL, '2023-05-31 19:12:18', '2023-05-31 19:12:18'),
(2, 'Pegawai 11', 'pegawai_1', '', 'pegawai1@gmail.com', NULL, '$2y$10$9Ld9ZlELc8Y/0.sdiRSq/ujAKqBsdwmOvZ4YjD/Cz3jgz9saY9t3y', 'Pegawai', NULL, '2023-06-04 08:02:53', '2023-06-04 08:10:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`),
  ADD KEY `barangs_created_by_foreign` (`created_by`),
  ADD KEY `barangs_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indexes for table `jasa_kirims`
--
ALTER TABLE `jasa_kirims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jasa_kirims_created_by_foreign` (`created_by`),
  ADD KEY `jasa_kirims_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggans_username_unique` (`username`),
  ADD UNIQUE KEY `pelanggans_email_unique` (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelians_barang_id_foreign` (`barang_id`),
  ADD KEY `pembelians_created_by_foreign` (`created_by`),
  ADD KEY `pembelians_updated_by_foreign` (`updated_by`),
  ADD KEY `pembelians_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekenings_bank_id_foreign` (`bank_id`),
  ADD KEY `rekenings_created_by_foreign` (`created_by`),
  ADD KEY `rekenings_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_created_by_foreign` (`created_by`),
  ADD KEY `sliders_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_barang_id_foreign` (`barang_id`),
  ADD KEY `transaksis_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `transaksis_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `jasa_kirims`
--
ALTER TABLE `jasa_kirims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barangs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jasa_kirims`
--
ALTER TABLE `jasa_kirims`
  ADD CONSTRAINT `jasa_kirims_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jasa_kirims_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD CONSTRAINT `pembelians_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembelians_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pembelians_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pembelians_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD CONSTRAINT `rekenings_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekenings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekenings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sliders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
