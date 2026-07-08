<?php
include "koneksi.php";
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
      <a href="home.php" ><i class="bi bi-grid"></i> Dashboard</a>
      <a href="produk.php" ><i class="bi bi-box-seam"></i> Produk</a>
      <a href="form-produk.php" class="active"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
      <a href="kategori.php"><i class="bi bi-tags"></i> Kategori</a>
      <a href="logout.php"><i class="bi bi-person-lock"></i> Log-out</a>
    </aside>

    <main class="content">
 

 

<section id="kategori" class="panel">
        <div class="section-title">
          <div>
            <p>Kategori</p>
            <h2>Kategori Produk</h2>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <form action="#" method="post">
              <label class="form-label">Nama Kategori</label>
              <input type="text" name="nama_kategori" class="form-control mb-3" required maxlength="80">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi_kategori" class="form-control mb-3" rows="3"></textarea>
              <button class="btn btn-primary w-100" type="submit">Simpan Kategori</button>
            </form>
          </div>
          <div class="col-md-8">
            <table class="table table-hover align-middle">
              <thead>
                <tr><th>No</th><th>Kategori</th><th>Jumlah Produk</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody>
                <tr><td>1</td><td>Makanan</td><td>54</td><td><span class="badge text-bg-success">Aktif</span></td><td><a class="btn btn-sm btn-outline-secondary">Edit</a></td></tr>
                <tr><td>2</td><td>Minuman</td><td>28</td><td><span class="badge text-bg-success">Aktif</span></td><td><a class="btn btn-sm btn-outline-secondary">Edit</a></td></tr>
                <tr><td>3</td><td>Kerajinan</td><td>31</td><td><span class="badge text-bg-success">Aktif</span></td><td><a class="btn btn-sm btn-outline-secondary">Edit</a></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      
    </main>
  </div>
</body>
</html>