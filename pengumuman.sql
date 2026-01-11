-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2025 pada 14.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengumuman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `kategori` varchar(20) NOT NULL DEFAULT 'pengumuman',
  `btn_text` varchar(200) DEFAULT NULL,
  `btn_link` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `kategori`, `btn_text`, `btn_link`) VALUES
(13, 'Daftar Kategori Lomba Classmeeting SMP Negeri 27 Surabaya', '<p>Classmeeting SMP Negeri 27 Surabaya tahun ini menghadirkan berbagai jenis lomba yang dirancang untuk mengembangkan sportivitas, kerja sama tim, kreativitas, serta kemampuan berpikir strategis para siswa. Seluruh kegiatan dibagi ke dalam beberapa kategori, mulai dari E-Sport, olahraga, hingga lomba kreativitas non-game.</p><p>Melalui kegiatan ini, diharapkan seluruh siswa dapat berpartisipasi aktif, menyalurkan minat dan bakatnya, serta mempererat kebersamaan antar kelas setelah menyelesaikan ujian semester. Mari jadikan Classmeeting tahun ini sebagai ajang yang seru, positif, dan penuh prestasi!</p><p><br></p><p><strong><em><u>Pelaksanaan Classmeet pada 12 - 17 Desember 2025 </u></em></strong></p><p><br></p><h2><strong class=\"ql-size-small\">Daftar Lomba Classmeeting</strong></h2><h3><strong class=\"ql-size-small\">Kategori E-Sport</strong></h3><ol><li><strong class=\"ql-size-small\">Mobile Legends</strong></li><li><strong class=\"ql-size-small\">Free Fire</strong></li><li><strong class=\"ql-size-small\">Magic Chess Go Go</strong></li><li><strong class=\"ql-size-small\">Geoguessr</strong></li><li><strong class=\"ql-size-small\">Catur (via Chess.com)</strong></li></ol><h3><strong class=\"ql-size-small\">Kategori Olahraga</strong></h3><ol><li><strong class=\"ql-size-small\">Futsal</strong></li><li><strong class=\"ql-size-small\">Handball</strong></li><li><strong class=\"ql-size-small\">Basket 3 on 3 Putra/Putri</strong></li></ol><h3><strong class=\"ql-size-small\">Kategori Non-Game / Kreativitas</strong></h3><ol><li><strong class=\"ql-size-small\">Lomba Kebersihan Kelas</strong></li></ol><p><br></p>', '1764729306_photo_6161050760309836608_w.jpg', '2025-12-03 17:35:06', 'pengumuman', 'Klik Disini', 'https://whatsapp.com/channel/0029Vase7nC3gvWgXpWvhi1V'),
(14, 'jadwal hari ini', '<p>asdasdasd<strong>asdasdasd</strong>asdasd</p>', '1766494080_photo_6206120639580540104_y.jpg', '2024-12-23 12:48:00', 'iklan', '', ''),
(15, 'Selamat datang di Adiwiyata SMPN 27 ', '<p>Situs ini adalah Situs Informasi yang telah dibuat dan diperbaiki sedemikian rupa sehingga dapat digunakan dengan baik dan benar </p><p>selamat membaca teman teman yang saya cintai dan saya banggakan </p><p><br></p><p><br></p><p><strong>selamat membaca </strong></p>', '1766495403_photo_6145187929962253235_y.jpg', '2025-12-23 13:10:03', 'akademik', 'Halo', 'google.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
