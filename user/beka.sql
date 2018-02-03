-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2015 at 12:24 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beka`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE IF NOT EXISTS `data_siswa` (
  `nis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tmp_lhr` varchar(30) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `sex` varchar(20) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `kebangsaan` varchar(20) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jurusan` varchar(10) NOT NULL,
  `jml_sdrtr` int(11) NOT NULL,
  `jml_sdrkdg` int(20) NOT NULL,
  `nama_ayah` varchar(20) NOT NULL,
  `pendd_ayah` varchar(4) NOT NULL,
  `pek_ayah` varchar(20) NOT NULL,
  `gaji_ayah` varchar(20) NOT NULL,
  `nama_ibu` varchar(20) NOT NULL,
  `pendd_ibu` varchar(4) NOT NULL,
  `pek_ibu` varchar(20) NOT NULL,
  `gaji_ibu` varchar(20) NOT NULL,
  `status_kawin` varchar(20) NOT NULL,
  `alamat_ortu` varchar(50) NOT NULL,
  `nama_gurupemb` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`nis`, `nama`, `tmp_lhr`, `tgl_lhr`, `sex`, `agama`, `kebangsaan`, `alamat`, `no_telp`, `kelas`, `jurusan`, `jml_sdrtr`, `jml_sdrkdg`, `nama_ayah`, `pendd_ayah`, `pek_ayah`, `gaji_ayah`, `nama_ibu`, `pendd_ibu`, `pek_ibu`, `gaji_ibu`, `status_kawin`, `alamat_ortu`, `nama_gurupemb`) VALUES
('151201', 'Andriana Larasati', 'Purwodadi', '1998-05-12', 'perempuan', 'islam', 'Indonesia', 'Jl. KH Hasan Anwar no 13', '0811289045', 'XII ', 'IPA', 0, 1, 'Nur Rahmat', 'SMP', 'Petani', '1500000', 'Suparmi', 'SD', 'Petani', '1500000', 'menikah', 'Jl KH Hasan Anwar no 13', 'Zulfia Firdaus'),
('151202', 'Andi Teguh Rahman', 'Grobogan', '1998-03-10', 'laki-laki', 'islam', 'Indonesia', 'Jenglong Utara no 11, Purwodadi', '08576490238', 'XII', 'IPA', 0, 3, 'Suhartono', 'SMA', 'Wiraswasta', '3000000', 'Tri Wahyuni', 'SMP', 'Ibu rumah tangga', '0', 'menikah', 'Jengglong Utara, no 11 Purwodadi', 'Zulfia Firdaus'),
('151203', 'Rofifatul Rohmah', 'Grobogan', '1998-02-08', 'perempuan', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '0877563290', 'XII', 'IPA', 0, 2, 'Ahmad Syafi''i', 'SMA', 'Petani', '2500000', 'Surti', 'SMA', 'Ibu rumah tangga', '0', 'menikah', 'Jl. KH Getas Pendawa, Kuripan', 'Zulfia Firdaus'),
('151204', 'Martini Handayani', 'Grobogan', '1998-11-19', 'perempuan', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '0811267893', 'XII', 'IPA', 0, 2, 'Sardjono', 'SMA', 'TNI', '4000000', 'Khaerunisa Rahmah', 'SMA', 'Ibu rumah tangga', '0', 'menikah', 'Jl. KH Getas Pendawa, Kuripan', 'Zulfia Firdaus'),
('151205', 'Yana Permatasari', 'Grobogan', '1998-04-14', 'perempuan', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '08225678910', 'XII', 'IPA', 0, 1, 'Jamaluddin', 'SMP', 'Petani', '2000000', 'Suhartini', 'SMP', 'Wirausaha', '2000000', 'menikah', 'Jl. KH Getas Pendawa, Kuripan', 'Zulfia Firdaus'),
('151206', 'Burhanuddin Anwar', 'Grobogan', '1998-07-07', 'laki-laki', 'islam', 'Indonesia', 'Penawangan', '085768045321', 'XII', 'IPA', 0, 3, 'Kholid Anwar', 'SMP', 'Petani', '1500000', 'Afifatul Mukarroh', 'SMP', 'Petani', '1500000', 'menikah', 'Penawangan', 'Zulfia Firdaus'),
('151207', 'Slamet Riyadi', 'Grobogan', '1997-10-20', 'laki-laki', 'islam', 'Indonesia', 'Getasrejo, Purwodadi', '08145678932', 'XII', 'IPA', 0, 2, 'Muhammad Ali Rajab', 'SMA', 'Petani', '2000000', 'Anjarwati', 'SMA', 'Petani', '2000000', 'menikah', 'Getasrejo, Purwodadi', 'Zulfia Firdaus'),
('151208', 'Galih Mahardika', 'Grobogan', '1998-08-20', 'laki-laki', 'islam', 'Indonesia', 'RSS Simpang Lima, Purwodadi', '085673280123', 'XII ', 'IPA', 0, 2, 'Abdul Ginanjar', 'SMA', 'Wiraswasta', '3000000', 'Indriyati Umul Khams', 'SMA', 'Ibu rumah tangga', '0', 'menikah', 'RSS Simpang Lima, Purwodadi', 'Zulfia Firdaus'),
('151209', 'Restria Sari Jannah', 'Grobogan', '1997-09-30', 'perempuan', 'islam', 'Indonesia', 'Jl. KH Hasan Anwar, Kuripan Purwodadi', '087290189631', 'XII', 'IPA', 0, 3, 'Muhammad Rahmad', 'SMP', 'Petani', '2000000', 'Sukijah', 'SMP', 'Ibu rumah tangga', '0', 'menikah', 'Jl KH Hasan Anwar, Kuripan Purwodadi', 'Zulfia Firdaus'),
('151210', 'Harni Desy Ayuningtyas', 'Grobogan', '1998-04-08', 'perempuan', 'islam', 'Indonesia', 'Kecamatan Pulokulon, Purwodadi', '085786231053', 'XII', 'IPA', 0, 1, 'Mohaddi', 'S1 P', 'Guru', '3000000', 'Rini Anjarwati', 'SMA', 'Wirausaha', '1500000', 'menikah', 'Kecamatan Pulokulon, Purwodadi', 'Zulfia Firdaus'),
('151211', 'Muhammad Khomar', 'Grobogan', '1998-12-17', 'laki-laki', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '089980183701', 'XII', 'IPA', 0, 3, 'Ahmad Solekhul', 'SMA', 'Petani', '1500000', 'Lilis Purwitasari', 'SMA', 'Wirausaha', '1500000', 'menikah', 'Jl. KH Gentas Pendowo, Kuripan', 'Zulfia Firdaus'),
('151212', 'Erni Larasati', 'Grobogan', '1998-07-05', 'perempuan', 'islam', 'Indonesia', 'Kecamatan Rejosari, Purwodadi Grobogan', '081829045167', 'XII', 'IPA', 0, 2, 'Muhammad Rokhim', 'SMA', 'Petani', '2000000', 'Arni Rahmawati', 'SMA', 'Petani', '2000000', 'menikah', 'Kecamatan Rejosari, Purwodadi Grobogan', 'Zulfia Firdaus'),
('151213', 'Muhammad Ulin Nuha', 'Grobogan', '1996-01-09', 'laki-laki', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '081123098412', 'XII', 'IPA', 0, 3, 'Ahmad Rosyidi', 'SMA', 'Wiraswasta', '5000000', 'Jumariyah', 'SMA', 'Wirausaha', '3000000', 'menikah', 'Jl. KH Getas Pendawa, Kuripan', 'Zulfia Firdaus'),
('151214', 'Ganisha Aprilliani', 'Grobogan', '1999-05-28', 'perempuan', 'islam', 'Indonesia', 'Kecamatan Kedungrejo, Purwodadi Grobogan', '085789120421', 'XII', 'IPA', 0, 2, 'Ahmad Jalaluddin', 'SMA', 'Pensiun', '3000000', 'Masfu''atun', 'S1 P', 'Guru', '4000000', 'cerai mati', 'Kecamatan Kedungrejo, Purwodadi Grobogan', 'Zulfia Firdaus'),
('151215', 'Muhammad Afif Aniq', 'Grobogan', '1998-10-22', 'laki-laki', 'islam', 'Indonesia', 'Jl. KH Gentas Pendowo, Kuripan', '08172390183', 'XII', 'IPA', 0, 2, 'Umar Khatib', 'SMA', 'Wiraswasta', '15000000', 'Umi Khalsum', 'SMA', 'Ibu rumah tangga', '0', 'menikah', 'Jl. KH Getas Pendawa, Kuripan', 'Zulfia Firdaus'),
('151216', 'Umar Khatib', 'Grobogan', '1998-01-08', 'laki-laki', 'islam', 'Indonesia', 'Bencheharjo no 09, Kuripan', '085761091001', 'XII', 'IPA', 0, 1, 'Mohammad Solikin', 'SMA', 'Petani', '2000000', 'Suhartini', 'SMA', 'Wirausaha', '3000000', 'menikah', 'Bencheharjo no 09, Kuripan', 'Zulfia Firdaus'),
('151217', 'Agung Pambudi Luhur Wijayanto', 'Grobogan', '1998-12-23', 'laki-laki', 'islam', 'Indonesia', 'Jl Tulungrejo Kec. Purwodadi, Kab. Grobogan', '081567390298', 'XII', 'IPA', 0, 4, 'Edi Bramantyo', 'S1', 'Guru SD', '4500000', 'Eni Rahmawati', 'S1', 'Guru SD', '4500000', 'menikah', 'Jl Tulungrejo Kec. Purwodadi Kab.Grobogan', 'Umi Khotimah Nur Jan');

-- --------------------------------------------------------

--
-- Table structure for table `guru_bk`
--

CREATE TABLE IF NOT EXISTS `guru_bk` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `ijazah` varchar(4) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `kata_sandi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_bk`
--

INSERT INTO `guru_bk` (`nip`, `nama`, `pangkat`, `ijazah`, `jabatan`, `username`, `kata_sandi`) VALUES
('19802874829031829', 'Umi Khotimah Nur Jannah', 'Kepala Bagian BK', 'S1', 'Guru BK', 'umikhotim', 'afafb9f6bc0f42252a5c55cf1817adc7'),
('1982903891256729', 'Rahma Dewi Lestari', 'Staff Guru BK', 'S1', 'Guru BK', 'rahmade', 'bd03ca94d4c656586b1b1e686fd88a9b'),
('24010312120017', 'Agung Setyoadi', 'staff BK', 'S1', 'Guru BK ', 'agungs', '84d961568a65073a3bcf0eb216b2a576');

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE IF NOT EXISTS `konseling` (
`id_konseling` int(10) NOT NULL,
  `nis` int(30) NOT NULL,
  `tgl_konseling` date NOT NULL,
  `jns_konseling` varchar(50) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `masalah` text NOT NULL,
  `pemecahan` text NOT NULL,
  `catatan` text NOT NULL,
  `guru_pembimbing` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `konseling`
--

INSERT INTO `konseling` (`id_konseling`, `nis`, `tgl_konseling`, `jns_konseling`, `semester`, `masalah`, `pemecahan`, `catatan`, `guru_pembimbing`) VALUES
(27, 151202, '2015-09-14', 'bimbingan individu', '1', 'bolos saat pelajaran', 'diberi sanksi untuk membersihkan kamar mandi sekolah', 'tidak ada banget', 'Umi Khotimah Nur Jannah'),
(28, 151201, '2015-09-14', 'konseling kelompok', '1', 'Membolos sekolah tidak ada kabar selama 3 hari.', 'Guru bimbingan konseling melakukan visitasi kerumah siswa untuk mengetahui kabar dari siswa yang bersangkutan.', 'perlu adanya pengawasan dari orang tua siswa.', 'Umi Khotimah Nur Jannah'),
(29, 151213, '2015-09-15', 'konseling individu', '1', 'Merokok sembunyi-sembunyi di kamar mandi pada saat jam pelajaran berlangsung.', 'Membuang rokok yang dimiliki oleh siswa dan diberikan peringatan keras yang bisa menimbulkan efek jera terhadap siswa.', 'melakukan pengawasan khusus oleh guru-guru yang mengajar siswa selama siswa bersekolah.', 'Agung Setyoadi'),
(30, 151215, '2015-09-15', 'bimbingan individu', '1', 'Siswa melakukan tindakan mencuri hape teman sekelas pada saat jam pelajaran olahraga. siswa masuk kedalam kelas yang saat itu sedang kosong karena semua siswa sedang berada di lapangan. Perbuatan siswa terekam oleh cctv sekolah.', 'Guru bimbingan konseling memberikan pendekatan bimbingan individu karena masalah yang dilakukan oleh siswa termasuk masalah berat sehingga perlu adanya penanganan khusus. Serta siswa dikenai denda sesuai dengan barang yang telah dia curi.', 'Jika siswa melakukan perbuatan yang sama maka akan dilaporkan kepada pihak yang berwajib.', 'Umi Khotimah Nur Jannah'),
(31, 151209, '2015-09-16', 'konseling individu', '1', 'Siswa diketahui tidak memakai seragam dengan logo sekolah dan bed bendera merah putih.', 'Diberi peringatan keras dan dikenai denda sebesar 10.000 per bed yang tidak dipakai.', 'Diawasi dengan ketat.', 'Rahma Dewi Lestari');

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE IF NOT EXISTS `kuisioner` (
`id_kuisioner` int(11) NOT NULL,
  `kuisioner` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `kuisioner`
--

INSERT INTO `kuisioner` (`id_kuisioner`, `kuisioner`) VALUES
(8, 'Hobi yang ingin anda kembangkan adalah?'),
(9, 'Dimanakah alamat rumah anda?'),
(12, 'Bagaimakah anda berangkat sekolah?'),
(13, 'Apakah anda seorang yang introvert?'),
(14, 'Bagaimanakah cara menghadapi diri sendri?'),
(16, 'Berapa lamakah kamu ingin menjomblo?'),
(17, 'Berapakah sehari kamu bermain bersama teman diluar rumah?'),
(19, 'Apakah orang tua dirumah mengawasi dengan siapa kamu bermain?'),
(20, 'Apakah jurusan yang akan anda ambil pada saat kuliah nanti?'),
(21, 'Apakah anda memiliki teman untuk berbagi cerita tentang privasi anda?'),
(22, 'Apa yang akan anda lakukan jika terdapat sahabat anda mencontek didepan anda?'),
(23, 'Apakah motto hidup anda?'),
(24, 'Sebutkan ciri-ciri teman yang anda sukai?'),
(25, 'Seberapa seringkah anda membuka internet?'),
(26, 'Bagaimana cara anda menghadapi masalah yang sedang anda hadapi sekarang?'),
(27, 'Apakah anda orang yang pemaaf?'),
(28, 'Menurut anda apa yang harus dilakukan jika anda salah kepada orang tua anda?'),
(29, 'Apakah orang tua anda mendukung setiap tindakan yang anda lakukan?'),
(30, 'Dimanakah anda ingin bekerja?');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
`kode_pelanggaran` int(11) NOT NULL,
  `nis` int(15) NOT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `id_pelanggaran` varchar(30) NOT NULL,
  `sanksi` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`kode_pelanggaran`, `nis`, `tgl_pelanggaran`, `id_pelanggaran`, `sanksi`) VALUES
(35, 151209, '2015-09-09', '1241', 'Diberi peringatan dan membersihkan toilet sekolah.'),
(36, 151204, '2015-09-11', '1239', 'Diberikan peringatan keras.'),
(37, 151213, '2015-09-15', '1240', 'Diskors selama 3 hari dan dilakukan pengawasan khusus.'),
(38, 151215, '2015-09-16', '1238', 'Dikenai denda sesuai dengan yang dicuri dan diberi peringatan keras.'),
(39, 151208, '2015-09-16', '1237', 'Diberi peringatan keras dan dikenai hukuman membersihkan toilet sekolah.'),
(40, 151202, '2015-09-15', '1237', 'Diberi peringatan keras dan dikenai hukuman membersihkan toilet sekolah.'),
(41, 151202, '2015-09-16', '1240', 'Diberi peringatan khusus, dikenai hukuman membersihkan toilet sekolah selama 1 minggu penuh.');

-- --------------------------------------------------------

--
-- Table structure for table `poin_pelanggaran`
--

CREATE TABLE IF NOT EXISTS `poin_pelanggaran` (
`id_pelanggaran` int(11) NOT NULL,
  `jenis_pelanggaran` varchar(30) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1247 ;

--
-- Dumping data for table `poin_pelanggaran`
--

INSERT INTO `poin_pelanggaran` (`id_pelanggaran`, `jenis_pelanggaran`, `poin`) VALUES
(1237, 'Merokok di sekolah', 25),
(1238, 'Mencuri', 50),
(1239, 'Membolos tanpa ijin', 35),
(1240, 'Berkelahi', 40),
(1241, 'Tidak berseragam lengkap', 15),
(1242, 'Berbuat tidak senonok', 100),
(1246, 'Membunuh', 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
 ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `guru_bk`
--
ALTER TABLE `guru_bk`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `konseling`
--
ALTER TABLE `konseling`
 ADD PRIMARY KEY (`id_konseling`);

--
-- Indexes for table `kuisioner`
--
ALTER TABLE `kuisioner`
 ADD PRIMARY KEY (`id_kuisioner`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
 ADD PRIMARY KEY (`kode_pelanggaran`), ADD KEY `id_pelanggaran` (`id_pelanggaran`);

--
-- Indexes for table `poin_pelanggaran`
--
ALTER TABLE `poin_pelanggaran`
 ADD PRIMARY KEY (`id_pelanggaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konseling`
--
ALTER TABLE `konseling`
MODIFY `id_konseling` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `kuisioner`
--
ALTER TABLE `kuisioner`
MODIFY `id_kuisioner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
MODIFY `kode_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `poin_pelanggaran`
--
ALTER TABLE `poin_pelanggaran`
MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1247;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
