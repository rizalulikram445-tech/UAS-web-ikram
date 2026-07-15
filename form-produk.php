<?php
session_start();
// 1. Proteksi Halaman: Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit;
}
include "koneksi.php";

// 2. Deteksi Mode: Cek apakah ada parameter 'id' di URL untuk mode EDIT
$id_produk = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nama_produk = $sku = $id_kategori = $harga = $stok = $status_produk = $deskripsi = "";

// Jika mode EDIT, ambil data lama dari database untuk ditampilkan di form
if ($id_produk > 0) {
    $get_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = $id_produk");
    if ($data = mysqli_fetch_assoc($get_produk)) {
        $nama_produk   = $data['nama_produk'];
        $sku           = $data['sku'];
        $id_kategori   = $data['id_kategori'];
        $harga         = $data['harga'];
        $stok          = $data['stok'];
        $status_produk = $data['status_produk'];
        $deskripsi     = $data['deskripsi'];
    }
}

// 3. Proses Simpan Data (Tambah Baru ATAU Update Data Lama)
if (isset($_POST['simpan'])) {
    // Amankan input dari SQL Injection
    $nama_produk   = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $sku           = mysqli_real_escape_string($koneksi, $_POST['sku']);
    $id_kategori   = (int)$_POST['id_kategori'];
    $harga         = (float)$_POST['harga'];
    $stok          = (int)$_POST['stok'];
    $status_produk = mysqli_real_escape_string($koneksi, $_POST['status_produk']);
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar_produk = ""; 

    if ($id_produk > 0) {
        // Jika id_produk ada, jalankan query UPDATE
        $query = "UPDATE produk SET 
                    id_kategori='$id_kategori', 
                    nama_produk='$nama_produk', 
                    sku='$sku', 
                    deskripsi='$deskripsi', 
                    harga='$harga', 
                    stok='$stok', 
                    status_produk='$status_produk' 
                  WHERE id_produk=$id_produk";
    } else {
        // Jika id_produk tidak ada, jalankan query INSERT
        $query = "INSERT INTO produk (id_kategori, nama_produk, sku, deskripsi, harga, stok, gambar_produk, status_produk) 
                  VALUES ('$id_kategori', '$nama_produk', '$sku', '$deskripsi', '$harga', '$stok', '$gambar_produk', '$status_produk')";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Produk - Sistem Pengelolaan Data Produk UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="layout">
    <aside class="sidebar">
      <div class="brand"><i class="bi bi-shop"></i><span>UMKM Mart</span></div>
      <nav class="nav flex-column gap-2">
        <a href="home.php" class="nav-link text-white"><i class="bi bi-grid me-2"></i> Dashboard</a>
        <a href="produk.php" class="nav-link text-white"><i class="bi bi-box-seam me-2"></i> Produk</a>
        <a href="form-produk.php" class="nav-link text-white active bg-primary rounded"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
        <a href="kategori.php" class="nav-link text-white"><i class="bi bi-tags me-2"></i> Kategori</a>
        <a href="logout.php" class="nav-link text-danger mt-5" onclick="return confirm('Apakah Anda yakin logout?')"><i class="bi bi-person-lock me-2"></i> Log-out</a>
      </nav>
    </aside>

    <main class="content p-4">
      <section id="form-produk" class="panel bg-white p-4 border rounded shadow-sm">
        <div class="section-title mb-4">
          <p class="text-muted mb-0"><?= $id_produk > 0 ? 'Edit Data' : 'Tambah Baru'; ?></p>
          <h2 class="fw-bold">Form Produk UMKM</h2>
        </div>

        <form method="post" class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($nama_produk); ?>" class="form-control" required maxlength="120">
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold">SKU</label>
            <input type="text" name="sku" value="<?= htmlspecialchars($sku); ?>" class="form-control" required maxlength="40">
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="id_kategori" class="form-select" required>
              <option value="">Pilih kategori</option>
              <?php
              // 4. Mengambil Kategori Dinamis dari database
              $kat_query = mysqli_query($koneksi, "SELECT * FROM kategori_produk WHERE status_kategori='aktif'");
              while($kat = mysqli_fetch_assoc($kat_query)) {
                  $selected = ($id_kategori == $kat['id_kategori']) ? 'selected' : '';
                  echo "<option value='".$kat['id_kategori']."' $selected>".htmlspecialchars($kat['nama_kategori'])."</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Harga</label>
            <input type="number" name="harga" value="<?= htmlspecialchars($harga); ?>" class="form-control" required min="0" step="100">
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stok" value="<?= htmlspecialchars($stok); ?>" class="form-control" required min="0" step="1">
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Status</label>
            <select name="status_produk" class="form-select" required>
              <option value="aktif" <?= $status_produk == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
              <option value="nonaktif" <?= $status_produk == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" maxlength="500"><?= htmlspecialchars($deskripsi); ?></textarea>
          </div>
          <div class="col-12 mt-4">
            <button class="btn btn-primary px-4 me-2" type="submit" name="simpan">Simpan Produk</button>
            <a href="produk.php" class="btn btn-outline-secondary px-4">Batal</a>
          </div>
        </form>
      </section>
    </main>
  </div>

<script src="script.js"></script>

</body>
</html>