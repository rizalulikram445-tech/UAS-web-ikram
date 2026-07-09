<?php
include "koneksi.php";
$queryProduk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk");
$jumlahProduk = mysqli_fetch_assoc($queryProduk);

$queryKategori = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori");
$jumlahKategori = mysqli_fetch_assoc($queryKategori);

$queryStok = mysqli_query($koneksi, "SELECT SUM(stok) AS total FROM produk");
$totalStok = mysqli_fetch_assoc($queryStok);

$queryNilai = mysqli_query($koneksi, "SELECT SUM(harga*stok) AS total FROM produk");
$totalNilai = mysqli_fetch_assoc($queryNilai);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pengelolaan Data Produk UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="layout">
    <aside class="sidebar">
      <div class="brand"><i class="bi bi-shop"></i><span>UMKM Mart</span></div>
      <a href="home.php" class="active"><i class="bi bi-grid"></i> Dashboard</a>
      <a href="produk.php"><i class="bi bi-box-seam"></i> Produk</a>
      <a href="form-produk.php"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
      <a href="kategori.php"><i class="bi bi-tags"></i> Kategori</a>
      <a href="logout.php"><i class="bi bi-person-lock"></i> Log-out</a>
    </aside>

    <main class="content">
      <section id="dashboard" class="hero">
        <p>Project 1</p>
        <h1>Sistem Pengelolaan Data Produk UMKM</h1>
        <span>Kelola produk, kategori, harga, stok, dan pencarian produk dalam satu halaman modern.</span>
      </section>

      <section class="stats">
        <div><i class="bi bi-box2-heart"></i><small>Total Produk</small><strong><?= $jumlahProduk['total']; ?></strong></div>
        <div><i class="bi bi-tags"></i><small>Kategori</small><strong><?= $jumlahKategori['total']; ?></strong></div>
        <div><i class="bi bi-exclamation-triangle"></i><small>Stok Menipis</small><strong><?= $totalStok['total']; ?></strong></div>
        <div><i class="bi bi-cash-stack"></i><small>Nilai Produk</small><strong>Rp<?= number_format($totalNilai['total'],0,',','.'); ?></strong></div>
      </section>

      <section id="produk" class="panel">

      </section>

      
      


    </main>
  </div>
</body>
</html>