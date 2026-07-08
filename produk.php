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
      <a href="produk.php" class="active"><i class="bi bi-box-seam"></i> Produk</a>
      <a href="form-produk.php"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
      <a href="kategori.php"><i class="bi bi-tags"></i> Kategori</a>
      <a href="logout.php"><i class="bi bi-person-lock"></i> Log-out</a>
    </aside>

    <main class="content">
 

 

      <section id="produk" class="panel">
        <div class="section-title">
          <div>
            <p>Data Produk</p>
            <h2>Produk UMKM</h2>
          </div>
          <a href="#form-produk" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>

        <form class="row g-2 mb-4" action="#produk" method="get">
          <div class="col-md-6">
            <input type="search" name="kata_kunci" class="form-control" placeholder="Cari nama produk atau SKU">
          </div>
          <div class="col-md-3">
            <select name="kategori" class="form-select">
              <option value="">Semua kategori</option>
              <option>Makanan</option>
              <option>Minuman</option>
              <option>Kerajinan</option>
              <option>Fashion</option>
            </select>
          </div>
          <div class="col-md-2">
            <select name="stok" class="form-select">
              <option value="">Semua stok</option>
              <option>Tersedia</option>
              <option>Menipis</option>
              <option>Habis</option>
            </select>
          </div>
          <div class="col-md-1 d-grid">
            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
          </div>
        </form>

        <div class="product-grid">
          <article class="product-card">
            <img src="https://asset.kompas.com/crops/DkGdTd89XNa6adESIAw7t9q8d8M=/28x18:996x663/1200x800/data/photo/2022/07/21/62d9074aee727.jpg" alt="Keripik pisang">
            <div>
              <span class="badge text-bg-success">Makanan</span>
              <h3>Keripik Pisang Manis</h3>
              <p>SKU-UMK-001</p>
              <strong>Rp18.000</strong>
              <span>Stok: 45</span>
              <div class="actions">
                <a href="#detail" class="btn btn-sm btn-outline-primary">Detail</a>
                <a href="#form-produk" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="#hapus" class="btn btn-sm btn-outline-danger">Hapus</a>
              </div>
            </div>
          </article>

          <article class="product-card">
            <img src="https://smexpo.pertamina.com/data-smexpo/images/products/4479/id-11134207-7rasj-m13vs48k9wia7b_1732849711.jpeg"alt="Tas anyaman">
            <div>
              <span class="badge text-bg-info">Kerajinan</span>
              <h3>Tas Anyaman Lokal</h3>
              <p>SKU-UMK-002</p>
              <strong>Rp125.000</strong>
              <span>Stok: 16</span>
              <div class="actions">
                <a href="#detail" class="btn btn-sm btn-outline-primary">Detail</a>
                <a href="#form-produk" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="#hapus" class="btn btn-sm btn-outline-danger">Hapus</a>
              </div>
            </div>
          </article>

          <article class="product-card">
            <img src="https://d10mgmzigw04tx.cloudfront.net/cms/f14a8e07-5f45-44bc-9b03-7dcec0157960-A.%20TORAJA%20200GR.png" alt="Kopi arabika">
            <div>
              <span class="badge text-bg-warning">Minuman</span>
              <h3>Kopi Arabika 200g</h3>
              <p>SKU-UMK-003</p>
              <strong>Rp58.000</strong>
              <span>Stok: 8</span>
              <div class="actions">
                <a href="#detail" class="btn btn-sm btn-outline-primary">Detail</a>
                <a href="#form-produk" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="#hapus" class="btn btn-sm btn-outline-danger">Hapus</a>
              </div>
            </div>
          </article>
        </div>
      </section>

      
    </main>
  </div>
</body>
</html>