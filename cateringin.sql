-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2022 pada 10.29
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cateringin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `username`, `password`) VALUES
(1, 'Kelompok5-SE', 'Kelompok5-SE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_order_history`
--

CREATE TABLE `customer_order_history` (
  `customer_order_id` int(10) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone_number` varchar(255) NOT NULL,
  `customer_order_notes` varchar(255) NOT NULL,
  `customer_first_food` varchar(255) NOT NULL,
  `customer_second_food` varchar(255) NOT NULL,
  `customer_third_food` varchar(255) NOT NULL,
  `customer_fourth_food` varchar(255) NOT NULL,
  `customer_fifth_food` varchar(255) NOT NULL,
  `catering_period` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_profile`
--

CREATE TABLE `customer_profile` (
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_password` text NOT NULL,
  `customer_status` text NOT NULL,
  `customer_password_change_token` text NOT NULL,
  `customer_phone_number` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_top_up_history`
--

CREATE TABLE `customer_top_up_history` (
  `top_up_id` int(10) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_gopay_phone_number` varchar(255) NOT NULL,
  `customer_top_up_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer_order_history`
--
ALTER TABLE `customer_order_history`
  ADD PRIMARY KEY (`customer_order_id`);

--
-- Indeks untuk tabel `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `customer_top_up_history`
--
ALTER TABLE `customer_top_up_history`
  ADD PRIMARY KEY (`top_up_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `customer_order_history`
--
ALTER TABLE `customer_order_history`
  MODIFY `customer_order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `customer_top_up_history`
--
ALTER TABLE `customer_top_up_history`
  MODIFY `top_up_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
