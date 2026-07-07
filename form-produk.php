<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pengelolaan Data Produk UMKM ikram</title>
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
 

 

      <section id="form-produk" class="panel">
        <div class="section-title">
          <div>
            <p>Create / Update</p>
            <h2>Form Produk</h2>
          </div>
        </div>

        <form action="#" method="post" class="row g-3">
          <input type="hidden" name="id_produk" value="">
          <div class="col-md-6">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required maxlength="120">
          </div>
          <div class="col-md-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" required maxlength="40">
          </div>
          <div class="col-md-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-select" required>
              <option value="">Pilih kategori</option>
              <option value="1">Makanan</option>
              <option value="2">Minuman</option>
              <option value="3">Kerajinan</option>
              <option value="4">Fashion</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required min="0" step="100">
          </div>
          <div class="col-md-4">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required min="0" step="1">
          </div>
          <div class="col-md-4">
            <label class="form-label">Status</label>
            <select name="status_produk" class="form-select" required>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" maxlength="500"></textarea>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan Produk</button>
            <button class="btn btn-outline-secondary" type="reset">Reset</button>
          </div>
        </form>
      </section>


      
    </main>
  </div>
</body>
</html>