<?php
session_start();

// 1. Proteksi Halaman: Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit;
}

include "koneksi.php";

// 2. Mengambil data statistik secara dinamis dan riil dari database
$queryProduk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk");
$jumlahProduk = mysqli_fetch_assoc($queryProduk);

$queryKategori = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori_produk WHERE status_kategori='aktif'");
$jumlahKategori = mysqli_fetch_assoc($queryKategori);

$queryStok = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk WHERE stok < 10");
$totalStok = mysqli_fetch_assoc($queryStok);

$queryNilai = mysqli_query($koneksi, "SELECT SUM(harga * stok) AS total FROM produk");
$totalNilai = mysqli_fetch_assoc($queryNilai);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Sistem Pengelolaan Data Produk UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="layout">
    <aside class="sidebar">
      <div class="brand"><i class="bi bi-shop"></i><span>UMKM Mart</span></div>
      <nav class="nav flex-column gap-2">
        <a href="home.php" class="nav-link text-white active bg-primary rounded"><i class="bi bi-grid me-2"></i> Dashboard</a>
        <a href="produk.php" class="nav-link text-white"><i class="bi bi-box-seam me-2"></i> Produk</a>
        <a href="form-produk.php" class="nav-link text-white"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
        <a href="kategori.php" class="nav-link text-white"><i class="bi bi-tags me-2"></i> Kategori</a>
        <a href="logout.php" class="nav-link text-danger mt-5" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="bi bi-person-lock me-2"></i> Log-out</a>
      </nav>
    </aside>

    <main class="content p-4">
      <section id="dashboard" class="hero bg-light p-5 rounded border mb-4 shadow-sm">
        <p class="text-primary fw-bold mb-1">Selamat Datang Kembaliiii, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <h1 class="fw-bold">Sistem Pengelolaan Data Produk UMKM</h1>
        <span class="text-white-50">Kelola produk, kategori, harga, stok, dan pencarian produk dalam satu dashboard modern yang terintegrasi.</span>
      </section>

      <section class="stats row g-4 text-center">
        <div class="col-md-3">
          <div class="p-4 bg-white border rounded shadow-sm h-100">
            <i class="bi bi-box2-heart text-primary fs-1 mb-2 d-block"></i>
            <small class="text-muted d-block mb-1">Total Produk</small>
            <strong class="fs-3 counter"data-target="<?= $jumlahProduk['total']; ?>">0</strong>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-4 bg-white border rounded shadow-sm h-100">
            <i class="bi bi-tags text-success fs-1 mb-2 d-block"></i>
            <small class="text-muted d-block mb-1">Kategori Aktif</small>
            <strong class="fs-3 counter"data-target="<?= $jumlahKategori['total']; ?>">0</strong>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-4 bg-white border rounded shadow-sm h-100">
            <i class="bi bi-exclamation-triangle text-danger fs-1 mb-2 d-block"></i>
            <small class="text-muted d-block mb-1">Stok Menipis </small>
            <strong class="fs-3 counter"data-target="<?= $totalStok['total']; ?>">0</strong>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-4 bg-white border rounded shadow-sm h-100">
            <i class="bi bi-currency-exchange text-warning fs-1 mb-2 d-block"></i>
            <small class="text-muted d-block mb-1">Nilai Aset Produk</small>
            <strong class="fs-4 d-block mt-1">Rp
              <span class="counter"data-target="<?= $totalNilai['total'] ?? 0; ?>">0</span>
            </strong>
          </div>
        </div>
      </section>
    </main>
  </div>
 
 <footer>
  <div class="footer">
    <h3>WEB Produk UMKM</h3>
    <p>Menyediakan barang-barang dan berbagai macam sembako</p>
    <p>📍Alamat: Jalan No.15 tgk. Imam Mujahid Fillah</p>
    <p>☎️No:082152147841</p>
  </div>
  </footer>

<script src="js/script.js"></script>

</body>
</html>