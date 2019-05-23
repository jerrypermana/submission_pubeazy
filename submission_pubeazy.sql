-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 Mei 2019 pada 08.12
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `submission_pubeazy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_bank`
--

CREATE TABLE `account_bank` (
  `kode_bank` int(3) NOT NULL,
  `rekening` int(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `atas_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account_bank`
--

INSERT INTO `account_bank` (`kode_bank`, `rekening`, `nama_bank`, `atas_nama`) VALUES
(1, 861213121, 'Bank Mandiri', 'Muhammad Jerry Permana '),
(3, 123456789, 'Bank BNI', 'Jerry Permana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `conference`
--

CREATE TABLE `conference` (
  `konferensi_id` int(11) NOT NULL,
  `nama_konferensi` varchar(250) DEFAULT NULL,
  `penyelenggara` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `ruang_id` int(11) DEFAULT NULL,
  `show_dashboard` smallint(1) DEFAULT '0',
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `conference`
--

INSERT INTO `conference` (`konferensi_id`, `nama_konferensi`, `penyelenggara`, `start_date`, `end_date`, `ruang_id`, `show_dashboard`, `input_date`, `last_update`) VALUES
(8, 'Annual Conference On Health And Food Science Technology', 'Universitas NU Surabaya', '2019-07-10', '2019-08-09', 5, 1, '2019-05-04', '2019-05-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_jam`
--

CREATE TABLE `jadwal_jam` (
  `jam_id` int(11) NOT NULL,
  `jam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_jam`
--

INSERT INTO `jadwal_jam` (`jam_id`, `jam`) VALUES
(6, '08.00-09.00 WIB'),
(7, '09.00-10.00 WIB'),
(8, '10.00-12.00 WIB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loa`
--

CREATE TABLE `loa` (
  `loa_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `status` smallint(1) DEFAULT '0',
  `tanggal_verifikasi` date DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loa`
--

INSERT INTO `loa` (`loa_id`, `paper_id`, `status`, `tanggal_verifikasi`, `input_date`, `last_update`) VALUES
(6, 4, 1, '2019-05-04', '2019-05-04', '2019-05-04'),
(7, 5, 1, '2019-05-04', '2019-05-04', '2019-05-04'),
(8, 7, 1, '2019-05-10', '2019-05-10', '2019-05-10'),
(9, 8, 1, '2019-05-11', '2019-05-11', '2019-05-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `realname` varchar(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `group_session` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`admin_id`, `email`, `realname`, `password`, `group_session`) VALUES
(1, 'admin@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'admin1@gsadasd.com', 'Jerry Permana', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loi`
--

CREATE TABLE `loi` (
  `id_loi` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `status` smallint(1) DEFAULT NULL,
  `tanggal_verifikasi` date DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loi`
--

INSERT INTO `loi` (`id_loi`, `paper_id`, `status`, `tanggal_verifikasi`, `input_date`, `last_update`) VALUES
(6, 1, 1, '2019-05-04', '2019-05-04', '2019-05-04'),
(7, 5, 1, '2019-05-04', '2019-05-04', '2019-05-04'),
(8, 7, 1, '2019-05-10', '2019-05-10', '2019-05-10'),
(9, 8, 1, '2019-05-11', '2019-05-11', '2019-05-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_email`
--

CREATE TABLE `mst_email` (
  `email_id` smallint(1) NOT NULL,
  `SMTP_Host` varchar(100) NOT NULL,
  `SMTP_User` varchar(100) NOT NULL,
  `SMTP_Pass` varchar(100) NOT NULL,
  `SMTP_Port` int(11) NOT NULL,
  `Mail_Protocol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_email`
--

INSERT INTO `mst_email` (`email_id`, `SMTP_Host`, `SMTP_User`, `SMTP_Pass`, `SMTP_Port`, `Mail_Protocol`) VALUES
(1, 'smtp.gmail.com', 'pubeazy.conf@gmail.com', 'blackberry123456', 465, 'smtp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_keyword`
--

CREATE TABLE `mst_keyword` (
  `keyword_id` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `input_date` date NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_keyword`
--

INSERT INTO `mst_keyword` (`keyword_id`, `keyword`, `input_date`, `last_update`) VALUES
(45, 'KANKER', '2019-05-04', '2019-05-04'),
(46, 'OSTEOPOROSIS', '2019-05-04', '2019-05-04'),
(47, 'FISIKA', '2019-05-04', '2019-05-04'),
(48, 'LEUKOSIT', '2019-05-10', '2019-05-10'),
(49, 'AYAM BROILER', '2019-05-10', '2019-05-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_ruang`
--

CREATE TABLE `mst_ruang` (
  `ruang_id` int(11) NOT NULL,
  `nama_ruang` varchar(255) DEFAULT NULL,
  `kuota` int(5) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_ruang`
--

INSERT INTO `mst_ruang` (`ruang_id`, `nama_ruang`, `kuota`, `input_date`, `last_update`) VALUES
(5, 'AAC Dayan Dawod', 100, '2019-05-04', '2019-05-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_subject`
--

CREATE TABLE `mst_subject` (
  `subject_id` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_subject`
--

INSERT INTO `mst_subject` (`subject_id`, `subject`, `input_date`, `last_update`) VALUES
(17, 'PHILOSOPHY', '2019-05-06', '2019-05-06'),
(18, 'AYAM BROILER', '2019-05-10', '2019-05-10'),
(19, 'AYAM', '2019-05-10', '2019-05-10'),
(20, 'DAUN KELOR', '2019-05-13', '2019-05-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_konferensi`
--

CREATE TABLE `paket_konferensi` (
  `paket_id` int(11) NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_konferensi`
--

INSERT INTO `paket_konferensi` (`paket_id`, `nama_paket`, `biaya`) VALUES
(3, 'Full Package', '1.000.000'),
(4, 'Half Package ', '500.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paper`
--

CREATE TABLE `paper` (
  `paper_id` int(11) NOT NULL,
  `konferensi_id` int(11) NOT NULL,
  `id_presenter` bigint(11) NOT NULL,
  `type_presentation` smallint(1) DEFAULT NULL,
  `judul` text,
  `abstrak` text,
  `komentar` text,
  `file_paper` varchar(255) DEFAULT NULL,
  `file_fullpaper` varchar(255) DEFAULT NULL,
  `file_ppt` varchar(250) DEFAULT NULL,
  `full_paper` smallint(1) NOT NULL DEFAULT '0',
  `v_paper` smallint(1) DEFAULT NULL,
  `v_akhir` smallint(1) NOT NULL DEFAULT '0',
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paper`
--

INSERT INTO `paper` (`paper_id`, `konferensi_id`, `id_presenter`, `type_presentation`, `judul`, `abstrak`, `komentar`, `file_paper`, `file_fullpaper`, `file_ppt`, `full_paper`, `v_paper`, `v_akhir`, `input_date`, `last_update`) VALUES
(1, 8, 1, 1, 'PENGARUH PEMBERIAN GONADOTROPIN RELEASING HORMONE (GNRH) TERHADAP PENINGKATAN KUALITAS SEMEN DOMBA WARINGIN', 'Penelitian ini bertujuan mengetahui pengaruh pemberian gonadotropin releasing hormone (GnRH) terhadap peningkatan kualitas semen domba Waringin. Penelitian ini merupakan penelitian eksperimen menggunakan tiga ekor domba Waringin dengan rancangan pola bujur sangkar latin 3 x 3 sehingga hewan percobaan akan menerima suntikan NaCl fisiologis sebagai kontrol (A), 50 Î¼g GnRH (B), dan 100 Î¼g GnRH (C). Penampungan semen dilakukan satu kali ejakulasi/minggu, selama 3 minggu. Sampel semen dikoleksi menggunakan elektroejakulator 24 jam setelah perlakuan dan diamati warna, konsistensi, volume, motilitas, konsentrasi, viabilitas, dan abnormalitas spermatozoa. Data mengenai warna dan konsistensi semen dilaporkan secara deskriptif, sedangkan volume semen, motilitas, konsentrasi, viabilitas dan abnormalitas spermatozoa dianalisis dengan analisis varian. Hasil pengamatan menunjukkan bahwa warna dan konsistensi semen yang dikoleksi pada semua kelompok perlakuan adalah krem dengan konsistensi kental. Rataan (Â±SD) volume semen (ml) pada kelompok kontrol, 50; dan 100 Î¼g GnRH masing-masing adalah 1,07Â±0,25; 1,13Â±0,15; dan 0,97Â±0,21. Rataan (Â±SD) konsentrasi spermatozoa (10 6 /ml) pada kelompok kontrol, 50; dan 100 Î¼g GnRH masing-masing adalah 1.076,67Â±902,89; 718,33Â±67,52; dan 953,33Â±513,77. Rataan (Â±SD) motilitas spermatozoa (%) pada kelompok kontrol; 50; dan 100 Î¼g GnRH masing-masing adalah 41,00Â±27,51; 52,00Â±17,52; dan 57,67Â±46,80. Rataan (Â±SD) viabilitas spermatozoa (%) pada kelompok kontrol, 50; dan 100 Î¼g GnRH masing-masing adalah 70,00Â±8,72; 77,00Â±10,15; dan 70,00Â±7,55. Rataan (Â±SD) abnormalitas spermatozoa (%) pada kelompok kontrol; 50; dan 100 Î¼g GnRH masing-masing adalah 30,00Â±24,56; 16,33Â±6,43; dan 20,00Â±13,23. Hasil analisis statistik menunjukan bahwa volume semen, konsentrasi spermatozoa, motilitas spermatozoa, viabilitas spermatozoa dan abnormalitas spermatozoa setelah pemberian GnRH menunjukkan perbedaan yang tidak signifikan (P>0,05). Disimpulkan bahwa pemberian GnRH tidak memengaruhi kualitas semen pada domba Waringin.', 'Full Paper', 'Abstrak_2019-05-14_RJI-1-0001.docx ', NULL, NULL, 0, 3, 0, '2019-05-14', '2019-05-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paper_jadwal`
--

CREATE TABLE `paper_jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `jam_id` int(11) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paper_keyword`
--

CREATE TABLE `paper_keyword` (
  `paper_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paper_keyword`
--

INSERT INTO `paper_keyword` (`paper_id`, `keyword_id`) VALUES
(1, 48),
(1, 49),
(4, 45),
(4, 46),
(5, 47),
(5, 48),
(6, 48),
(6, 49),
(7, 48),
(7, 49),
(8, 48),
(8, 49),
(9, 48),
(9, 49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paper_reviewer`
--

CREATE TABLE `paper_reviewer` (
  `paper_reviewer_id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paper_reviewer`
--

INSERT INTO `paper_reviewer` (`paper_reviewer_id`, `paper_id`, `review_id`, `input_date`, `last_update`) VALUES
(1, 1, 5, '2019-05-14', '2019-05-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paper_subject`
--

CREATE TABLE `paper_subject` (
  `paper_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paper_subject`
--

INSERT INTO `paper_subject` (`paper_id`, `subject_id`) VALUES
(1, 0),
(4, 15),
(5, 16),
(6, 18),
(6, 19),
(7, 18),
(7, 19),
(8, 18),
(8, 19),
(9, 18),
(9, 19),
(9, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `member_id` varchar(20) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `gender` smallint(1) DEFAULT NULL,
  `instansi` varchar(250) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `group_session` varchar(25) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `member_id`, `realname`, `email`, `address`, `gender`, `instansi`, `no_hp`, `password`, `image`, `group_session`, `input_date`, `last_update`) VALUES
(1, 'RJI-2-0001', 'Muhammad Jerry Permana', 'jerrypermana@unsyiah.ac.id', 'Gedung UPT Perpustakaan Unsyiah, Jl. T. Nyak Arief No.9-10, Kopelma Darussalam, Syiah Kuala', 1, ' ', '+6285277772698', 'c20ad4d76fe97759aa27a0c99bff6710', NULL, 'peserta', '2019-05-15', '2019-05-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presenter`
--

CREATE TABLE `presenter` (
  `id_presenter` int(11) NOT NULL,
  `member_id` varchar(20) NOT NULL,
  `realname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` smallint(1) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `afiliasi` varchar(50) DEFAULT NULL,
  `negara_afiliasi` varchar(50) DEFAULT NULL,
  `alamat_afiliasi` varchar(250) DEFAULT NULL,
  `url_orcid` varchar(250) DEFAULT NULL,
  `url_profil` varchar(250) DEFAULT NULL,
  `no_hp` varchar(25) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `group_session` varchar(25) NOT NULL,
  `input_date` date NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presenter`
--

INSERT INTO `presenter` (`id_presenter`, `member_id`, `realname`, `email`, `gender`, `address`, `afiliasi`, `negara_afiliasi`, `alamat_afiliasi`, `url_orcid`, `url_profil`, `no_hp`, `image`, `password`, `group_session`, `input_date`, `last_update`) VALUES
(1, 'RJI-1-0001', 'Muhammad Jerry Permana', 'jerrypermanaa@gmail.com', 1, 'Gedung UPT Perpustakaan Unsyiah, Jl. T. Nyak Arief No.9-10, Kopelma Darussalam, Syiah Kuala', 'Universitas Syiah Kuala ', 'Indonesia', 'Gedung UPT Perpustakaan Unsyiah, Jl. T. Nyak Arief No.9-10, Kopelma Darussalam, Syiah Kuala', 'https://www.facebook.com/jerryprmn', 'https://www.facebook.com/jerryprmn', '+6285277772698', 'IMAGE_RJI-1-0001.jpg', 'c20ad4d76fe97759aa27a0c99bff6710', 'presenter', '2019-05-14', '2019-05-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviewer`
--

CREATE TABLE `reviewer` (
  `reviewer_id` int(11) NOT NULL,
  `realname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status_active` smallint(1) DEFAULT NULL,
  `group_session` varchar(50) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reviewer`
--

INSERT INTO `reviewer` (`reviewer_id`, `realname`, `email`, `password`, `status_active`, `group_session`, `input_date`, `last_update`) VALUES
(5, 'Muhammad Yasir Al', 'm.jerry152@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'reviewer', '2019-05-04', '2019-05-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `status_id` int(2) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Accepted'),
(2, 'Reject'),
(3, 'Revision Required');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_peserta`
--

CREATE TABLE `transaksi_peserta` (
  `transfer_id` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `konferensi_id` int(11) DEFAULT NULL,
  `paket_id` int(11) DEFAULT NULL,
  `nama_transfer` varchar(250) DEFAULT NULL,
  `jumlah_transfer` varchar(50) DEFAULT NULL,
  `kode_bank` int(4) DEFAULT NULL,
  `tgl_transfer` date DEFAULT NULL,
  `v_transfer` smallint(1) NOT NULL DEFAULT '0',
  `file_bukti` varchar(250) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_peserta`
--

INSERT INTO `transaksi_peserta` (`transfer_id`, `id_peserta`, `konferensi_id`, `paket_id`, `nama_transfer`, `jumlah_transfer`, `kode_bank`, `tgl_transfer`, `v_transfer`, `file_bukti`, `input_date`, `last_update`) VALUES
(2, 3, 8, 3, 'Muhammad Jerry Permana', '1.000.000', 1, '2019-05-10', 1, 'Transfer_2019-05-11_2.jpg', '2019-05-11', '2019-05-11'),
(3, 1, 8, 3, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', NULL),
(4, 1, 8, 3, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', NULL),
(5, 1, 8, 3, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_presenter`
--

CREATE TABLE `transaksi_presenter` (
  `transfer_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `biaya_conf` varchar(50) DEFAULT NULL,
  `nama_transfer` varchar(250) DEFAULT NULL,
  `jumlah_transfer` varchar(50) DEFAULT NULL,
  `from_bank` varchar(50) DEFAULT NULL,
  `kode_bank` int(4) DEFAULT NULL,
  `tgl_transfer` date DEFAULT NULL,
  `v_transfer` smallint(1) DEFAULT '0',
  `file_bukti` varchar(250) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_presenter`
--

INSERT INTO `transaksi_presenter` (`transfer_id`, `paper_id`, `biaya_conf`, `nama_transfer`, `jumlah_transfer`, `from_bank`, `kode_bank`, `tgl_transfer`, `v_transfer`, `file_bukti`, `input_date`, `last_update`) VALUES
(1, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-14', '2019-05-14'),
(2, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(3, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(4, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(5, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(6, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(7, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15'),
(8, 1, '1.000.000', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-05-15', '2019-05-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_bank`
--
ALTER TABLE `account_bank`
  ADD PRIMARY KEY (`kode_bank`);

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`konferensi_id`);

--
-- Indexes for table `jadwal_jam`
--
ALTER TABLE `jadwal_jam`
  ADD PRIMARY KEY (`jam_id`);

--
-- Indexes for table `loa`
--
ALTER TABLE `loa`
  ADD PRIMARY KEY (`loa_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `loi`
--
ALTER TABLE `loi`
  ADD PRIMARY KEY (`id_loi`);

--
-- Indexes for table `mst_email`
--
ALTER TABLE `mst_email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `mst_keyword`
--
ALTER TABLE `mst_keyword`
  ADD PRIMARY KEY (`keyword_id`);

--
-- Indexes for table `mst_ruang`
--
ALTER TABLE `mst_ruang`
  ADD PRIMARY KEY (`ruang_id`);

--
-- Indexes for table `mst_subject`
--
ALTER TABLE `mst_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `paket_konferensi`
--
ALTER TABLE `paket_konferensi`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`paper_id`);

--
-- Indexes for table `paper_jadwal`
--
ALTER TABLE `paper_jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `paper_keyword`
--
ALTER TABLE `paper_keyword`
  ADD PRIMARY KEY (`paper_id`,`keyword_id`);

--
-- Indexes for table `paper_reviewer`
--
ALTER TABLE `paper_reviewer`
  ADD PRIMARY KEY (`paper_reviewer_id`);

--
-- Indexes for table `paper_subject`
--
ALTER TABLE `paper_subject`
  ADD PRIMARY KEY (`paper_id`,`subject_id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `presenter`
--
ALTER TABLE `presenter`
  ADD PRIMARY KEY (`id_presenter`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`reviewer_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `transaksi_peserta`
--
ALTER TABLE `transaksi_peserta`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `transaksi_presenter`
--
ALTER TABLE `transaksi_presenter`
  ADD PRIMARY KEY (`transfer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_bank`
--
ALTER TABLE `account_bank`
  MODIFY `kode_bank` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conference`
--
ALTER TABLE `conference`
  MODIFY `konferensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_jam`
--
ALTER TABLE `jadwal_jam`
  MODIFY `jam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loa`
--
ALTER TABLE `loa`
  MODIFY `loa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loi`
--
ALTER TABLE `loi`
  MODIFY `id_loi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mst_email`
--
ALTER TABLE `mst_email`
  MODIFY `email_id` smallint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_keyword`
--
ALTER TABLE `mst_keyword`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `mst_ruang`
--
ALTER TABLE `mst_ruang`
  MODIFY `ruang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_subject`
--
ALTER TABLE `mst_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `paket_konferensi`
--
ALTER TABLE `paket_konferensi`
  MODIFY `paket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paper`
--
ALTER TABLE `paper`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paper_jadwal`
--
ALTER TABLE `paper_jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paper_reviewer`
--
ALTER TABLE `paper_reviewer`
  MODIFY `paper_reviewer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `presenter`
--
ALTER TABLE `presenter`
  MODIFY `id_presenter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `reviewer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_peserta`
--
ALTER TABLE `transaksi_peserta`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_presenter`
--
ALTER TABLE `transaksi_presenter`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
