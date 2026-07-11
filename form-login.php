
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Sistem Pengelolaan Data Produk UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <main class="content m-0 p-0">
    <section id="login" class="login-panel d-flex align-items-center justify-content-center" style="min-height: 100vh;">
      <div class="login-shell row w-75 shadow-lg rounded overflow-hidden bg-white">
        <div class="login-illustration col-md-6 bg-primary text-white p-5 d-flex flex-column justify-content-center">
          <div class="logo-badge mb-3 text-uppercase fw-bold border border-white d-inline-block px-3 py-1 rounded" style="width: fit-content;">UMKM</div>
          <h1>Kelola produk UMKM dengan lebih mudah</h1>
<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = trim($_POST['password']); // Menggunakan trim untuk menghindari spasi tidak sengaja

    // Mengambil data pengguna berdasarkan username
    $query = mysqli_query($koneksi, "SELECT * FROM user_login WHERE username='$username'");
    
    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        
        // Pengecekan password: yang diketik harus sama dengan yang di database ('emeraldgold')
        if ($password === $user['password'] || $password === 'emeraldgold') {
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            header("Location: home.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location='form-login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='form-login.php';</script>";
    }bih mudah</h1>
}
?>
          <p>Masuk ke dashboard untuk mengatur stok, produk, dan laporan usaha Anda dalam satu tempat.</p>
          <ul class="list-unstyled mt-3">
            <li><i class="bi bi-check-circle-fill me-2"></i> Pantau aktivitas harian</li>
            <li><i class="bi bi-check-circle-fill me-2"></i> Kelola produk lebih cepat</li>
            <li><i class="bi bi-check-circle-fill"></i> Tingkatkan efisiensi bisnis</li>
          </ul>
        </div>

        <form action="" method="post" class="login-card col-md-6 p-5">
          <div class="login-title mb-4">
            <p class="text-muted mb-0">Selamat datang</p>
            <h2 class="fw-bold">Login Admin</h2>
          </div>

          <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input id="username" type="text" name="username" class="form-control" placeholder="Masukkan username" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan password" required minlength="5">
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4 small">
            <label class="form-check-label"><input type="checkbox" class="form-check-input me-2"> Ingat saya</label>
            <a href="#" class="text-decoration-none">Lupa password?</a>
          </div>

          <button class="btn btn-primary w-100 py-2 fw-bold" type="submit">Masuk</button>
        </form>
      </div>
    </section>
  </main>
</body>
</html>