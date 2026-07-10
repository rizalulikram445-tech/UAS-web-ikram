<?php
session_start();
// 1. Proteksi Halaman: Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit;
}
include "koneksi.php";

// 2. Fungsi Hapus Data Produk secara Dinamis
if (isset($_GET['hapus'])) {
    $id_hapus = (int)$_GET['hapus'];
    $queryHapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = $id_hapus");
    if ($queryHapus) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk: " . mysqli_error($koneksi) . "');</script>";
    }
}

// 3. Menangkap Filter Pencarian dan Kategori dari URL
$kata_kunci = isset($_GET['kata_kunci']) ? mysqli_real_escape_string($koneksi, trim($_GET['kata_kunci'])) : '';
$kategori_filter = isset($_GET['kategori']) ? (int)$_GET['kategori'] : '';
$stok_filter = isset($_GET['stok']) ? $_GET['stok'] : '';

// Query Dasar: Menggabungkan tabel produk dengan kategori_produk
$sql = "SELECT produk.*, kategori_produk.nama_kategori FROM produk 
        JOIN kategori_produk ON produk.id_kategori = kategori_produk.id_kategori WHERE 1=1";

// Tambah kondisi filter berdasarkan input user
if (!empty($kata_kunci)) {
    $sql .= " AND (nama_produk LIKE '%$kata_kunci%' OR sku LIKE '%$kata_kunci%')";
}
if (!empty($kategori_filter)) {
    $sql .= " AND produk.id_kategori = $kategori_filter";
}
if ($stok_filter == 'Tersedia') {
    $sql .= " AND stok >= 10";
} elseif ($stok_filter == 'Menipis') {
    $sql .= " AND stok > 0 AND stok < 10";
} elseif ($stok_filter == 'Habis') {
    $sql .= " AND stok = 0";
}

$sql .= " ORDER BY produk.id_produk DESC";
$query = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produk - Sistem Pengelolaan Data Produk UMKM</title>
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
        <a href="produk.php" class="nav-link text-white active bg-primary rounded"><i class="bi bi-box-seam me-2"></i> Produk</a>
        <a href="form-produk.php" class="nav-link text-white"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
        <a href="kategori.php" class="nav-link text-white"><i class="bi bi-tags me-2"></i> Kategori</a>
        <a href="logout.php" class="nav-link text-danger mt-5" onclick="return confirm('Apakah Anda yakin logout?')"><i class="bi bi-person-lock me-2"></i> Log-out</a>
      </nav>
    </aside>

    <main class="content p-4">
      <section id="produk" class="panel bg-white p-4 border rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <p class="text-muted mb-0">Manajemen Data</p>
            <h2 class="fw-bold">Produk UMKM</h2>
          </div>
          <a href="form-produk.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Produk</a>
        </div>

        <form class="row g-2 mb-4" action="produk.php" method="get">
          <div class="col-md-5">
            <input type="search" name="kata_kunci" value="<?= htmlspecialchars($kata_kunci); ?>" class="form-control" placeholder="Cari nama produk atau SKU...">
          </div>
          <div class="col-md-3">
            <select name="kategori" class="form-select">
              <option value="">Semua Kategori</option>
              <?php
              $kat_query = mysqli_query($koneksi, "SELECT * FROM kategori_produk WHERE status_kategori='aktif'");
              while($kat = mysqli_fetch_assoc($kat_query)) {
                  $selected = ($kategori_filter == $kat['id_kategori']) ? 'selected' : '';
                  echo "<option value='".$kat['id_kategori']."' $selected>".htmlspecialchars($kat['nama_kategori'])."</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="stok" class="form-select">
              <option value="">Semua Status Stok</option>
              <option value="Tersedia" <?= $stok_filter == 'Tersedia' ? 'selected' : ''; ?>>Tersedia (>= 10)</option>
              <option value="Menipis" <?= $stok_filter == 'Menipis' ? 'selected' : ''; ?>>Menipis (< 10)</option>
              <option value="Habis" <?= $stok_filter == 'Habis' ? 'selected' : ''; ?>>Habis (= 0)</option>
            </select>
          </div>
          <div class="col-md-1 d-grid">
            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
          </div>
        </form>

        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php if (mysqli_num_rows($query) == 0): ?>
            <div class="col-12 text-center text-muted p-5">
              <i class="bi bi-box-open fs-1"></i>
              <p class="mt-2">Produk tidak ditemukan atau pangkalan data kosong.</p>
            </div>
          <?php else: ?>
            <?php while($row = mysqli_fetch_assoc($query)): 
                // Set placeholder jika gambar kosong
                $img_url = !empty($row['gambar_produk']) ? $row['gambar_produk'] : 'https://placehold.co/400x300?text=No+Image';
                
                // Pewarnaan dinamis untuk badge kategori
                $badge_color = 'bg-secondary';
                if(stripos($row['nama_kategori'], 'makanan') !== false) $badge_color = 'bg-success';
                if(stripos($row['nama_kategori'], 'minuman') !== false) $badge_color = 'bg-warning text-dark';
                if(stripos($row['nama_kategori'], 'kerajinan') !== false) $badge_color = 'bg-info text-dark';
            ?>
              <div class="col">
                <div class="card h-100 shadow-sm">
                  <img src="<?= $img_url; ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nama_produk']); ?>" style="height: 200px; object-fit: cover;">
                  <div class="card-body">
                    <span class="badge <?= $badge_color; ?> mb-2"><?= htmlspecialchars($row['nama_kategori']); ?></span>
                    <h5 class="card-title fw-bold mb-1"><?= htmlspecialchars($row['nama_produk']); ?></h5>
                    <p class="text-muted small mb-2"><?= htmlspecialchars($row['sku']); ?></p>
                    <h5 class="text-primary fw-bold">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></h5>
                    <p class="card-text mb-3 small <?= $row['stok'] < 10 ? 'text-danger fw-bold' : 'text-muted'; ?>">
                      Stok: <?= $row['stok']; ?> <?= $row['stok'] < 10 ? '(Menipis!)' : ''; ?>
                    </p>
                    <div class="d-flex gap-2 border-top pt-2">
                      <a href="form-produk.php?id=<?= $row['id_produk']; ?>" class="btn btn-sm btn-outline-secondary w-50"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <a href="produk.php?hapus=<?= $row['id_produk']; ?>" class="btn btn-sm btn-outline-danger w-50" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="bi bi-trash me-1"></i> Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </div>
</body>
</html>