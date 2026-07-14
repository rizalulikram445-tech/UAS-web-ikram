<?php
session_start();
// 1. Proteksi Halaman: Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit;
}
include "koneksi.php";

// 2. Proses Simpan Kategori Baru ke Database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan_kategori'])) {
    $nama_kategori = mysqli_real_escape_string($koneksi, trim($_POST['nama_kategori']));
    $deskripsi_kategori = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi_kategori']));
    
    // Cek apakah nama kategori sudah ada sebelumnya
    $cek_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_produk WHERE nama_kategori = '$nama_kategori'");
    if(mysqli_num_rows($cek_kategori) > 0) {
        echo "<script>alert('Nama kategori sudah terdaftar!');</script>";
    } else {
        // Simpan ke tabel kategori_produk
        $insert = mysqli_query($koneksi, "INSERT INTO kategori_produk (nama_kategori, deskripsi_kategori, status_kategori) VALUES ('$nama_kategori', '$deskripsi_kategori', 'aktif')");
        if($insert) {
            echo "<script>alert('Kategori berhasil ditambahkan!'); window.location='kategori.php';</script>";
        } else {
            echo "<script>alert('Gagal menambah kategori: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

// 3. Ambil data kategori dan hitung jumlah produk terkait secara dinamis lewat query SQL
$sqlKategori = "SELECT kp.*, (SELECT COUNT(*) FROM produk WHERE produk.id_kategori = kp.id_kategori) AS jumlah_produk FROM kategori_produk kp ORDER BY kp.id_kategori ASC";
$queryKategori = mysqli_query($koneksi, $sqlKategori);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kategori - Sistem Pengelolaan Data Produk UMKM</title>
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
        <a href="form-produk.php" class="nav-link text-white"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
        <a href="kategori.php" class="nav-link text-white active bg-primary rounded"><i class="bi bi-tags me-2"></i> Kategori</a>
        <a href="logout.php" class="nav-link text-danger mt-5" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="bi bi-person-lock me-2"></i> Log-out</a>
      </nav>
    </aside>

    <main class="content p-4">
      <section id="kategori" class="panel bg-white p-4 border rounded shadow-sm">
        <div class="section-title mb-4">
          <p class="text-muted mb-0">Manajemen Data</p>
          <h2 class="fw-bold">Kategori Produk</h2>
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <div class="p-3 bg-light border rounded">
              <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle me-1"></i> Tambah Kategori</h5>
              <form action="kategori.php" method="post">
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Nama Kategori</label>
                  <input type="text" name="nama_kategori" class="form-control" required maxlength="80" placeholder="Contoh: Pakaian">
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Deskripsi</label>
                  <textarea name="deskripsi_kategori" class="form-control" rows="3" placeholder="Deskripsi singkat mengenai kategori..."></textarea>
                </div>
                <button class="btn btn-primary w-100 fw-bold" type="submit" name="simpan_kategori">Simpan Kategori</button>
              </form>
            </div>
          </div>

          <div class="col-md-8">
            <div class="table-responsive">
              <table class="table table-hover align-middle border">
                <thead class="table-dark">
                  <tr>
                    <th style="width: 8%;">No</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  if (mysqli_num_rows($queryKategori) == 0): 
                  ?>
                    <tr>
                      <td colspan="5" class="text-center text-muted p-4">Belum ada data kategori.</td>
                    </tr>
                  <?php 
                  else:
                    while($row = mysqli_fetch_assoc($queryKategori)): 
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td class="fw-semibold"><?= htmlspecialchars($row['nama_kategori']); ?></td>
                      <td class="text-muted small"><?= htmlspecialchars($row['deskripsi_kategori'] ?? '-'); ?></td>
                      <td>
                        <span class="badge bg-secondary"><?= $row['jumlah_produk']; ?> Produk</span>
                      </td>
                      <td>
                        <span class="badge bg-success text-capitalize"><?= htmlspecialchars($row['status_kategori']); ?></span>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

<script src="nkategori.js"></script>

</body>
</html>