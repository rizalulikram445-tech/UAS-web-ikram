<?php

include "koneksi.php";

$kata_kunci = isset($_GET['kata_kunci']) ? $_GET['kata_kunci'] : "";
$kategori   = isset($_GET['kategori']) ? $_GET['kategori'] : "";
$stok       = isset($_GET['stok']) ? $_GET['stok'] : "";

$sql = "
SELECT produk.*, kategori_produk.nama_kategori
FROM produk
JOIN kategori_produk
ON produk.id_kategori = kategori_produk.id_kategori
WHERE 1=1
";

if($kata_kunci != ""){
    $sql .= " AND (
        produk.nama_produk LIKE '%$kata_kunci%'
        OR produk.sku LIKE '%$kata_kunci%'
    )";
}

if($kategori != ""){
    $sql .= " AND kategori_produk.nama_kategori='$kategori'";
}

if($stok == "Tersedia"){
    $sql .= " AND produk.stok > 20";
}

if($stok == "Menipis"){
    $sql .= " AND produk.stok BETWEEN 1 AND 20";
}

if($stok == "Habis"){
    $sql .= " AND produk.stok = 0";
}

$query = mysqli_query($koneksi, $sql);

$warna = [
    "Makanan"   => "text-bg-success",
    "Minuman"   => "text-bg-warning",
    "Kerajinan" => "text-bg-info",
    "Fashion"   => "text-bg-secondary"
];

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
      <nav class="nav flex-column gap-2">
        <a href="home.php" class="nav-link text-white active bg-primary rounded"><i class="bi bi-grid me-2"></i> Dashboard</a>
        <a href="produk.php" class="nav-link text-white"><i class="bi bi-box-seam me-2"></i> Produk</a>
        <a href="form-produk.php" class="nav-link text-white"><i class="bi bi-plus-circle me-2"></i> Tambah Produk</a>
        <a href="kategori.php" class="nav-link text-white"><i class="bi bi-tags me-2"></i> Kategori</a>
        <a href="logout.php" class="nav-link text-danger mt-5" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="bi bi-person-lock me-2"></i> Log-out</a>
      </nav>
    </aside>
    <main class="content">
 

 

      <section id="produk" class="panel">
        <div class="section-title">
          <div>
            <p>Data Produk</p>
            <h2>Produk UMKM</h2>
          </div>
          <a href="form-produk.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
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

      

<?php
while($data = mysqli_fetch_assoc($query)){
?>

<article class="product-card">

   <img src="img/<?php echo $data['gambar_produk']; ?>" alt="<?php echo $data['nama_produk']; ?>">

    <div>

       <span class="badge <?php echo $warna[$data['nama_kategori']]; ?>">
    <?php echo $data['nama_kategori']; ?>
</span>

        <h3>
            <?php echo $data['nama_produk']; ?>
        </h3>

        <p>
            <?php echo $data['sku']; ?>
        </p>

        <strong>
            Rp<?php echo number_format($data['harga'],0,',','.'); ?>
        </strong>

        <span>
            Stok : <?php echo $data['stok']; ?>
        </span>

        <div class="actions">

            <a href="form-produk.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-sm btn-outline-primary">
                Detail
            </a>

            <a href="form-produk.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-sm btn-outline-secondary">
                Edit
            </a>

            <a href="hapus.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-sm btn-outline-danger">
                Hapus
            </a>

        </div>

    </div>

</article>

<?php
}
?>

</div>


        </div>
      </section>

 <footer>
  <div class="footer">
    <h3>Produk UMKM</h3>
    <p>Menyediakan barang-barang dan berbagai macam sembako</p>
    <p>📍Alamat: Jalan No.15 tgk. Imam Mujahid Fillah</p>
    <p>☎️No:082152147841</p>
  </div>
  </footer>

<script src="js/script.js"></script>
      
    </main>
  </div>
</body>
</html>