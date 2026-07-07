<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pengelolaan Data Produk UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="style.css?v=20260702" rel="stylesheet">
</head>
<body>
  <main class="content">
    <section id="login" class="login-panel">
      <div class="login-shell">
        <div class="login-illustration">
          <div class="logo-badge">UMKM</div>
          <h1>Kelola produk UMKM dengan lebih mudah</h1>
          <p>Masuk ke dashboard untuk mengatur stok, produk, dan laporan usaha Anda dalam satu tempat.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> Pantau aktivitas harian</li>
            <li><i class="bi bi-check-circle-fill"></i> Kelola produk lebih cepat</li>
            <li><i class="bi bi-check-circle-fill"></i> Tingkatkan efisiensi bisnis</li>
          </ul>
        </div>

        <form action="#" method="post" class="login-card">
          <div class="login-title">
            <p>Selamat datang</p>
            <h2>Login Admin</h2>
          </div>

          <label class="form-label" for="username">Username</label>
          <input id="username" type="text" name="username" class="form-control mb-3" placeholder="Masukkan username" required>

          <label class="form-label" for="password">Password</label>
          <input id="password" type="password" name="password" class="form-control mb-3" placeholder="Masukkan password" required minlength="6">

          <div class="d-flex justify-content-between align-items-center mb-3 small-text">
            <label class="form-check-label"><input type="checkbox" class="form-check-input me-2"> Ingat saya</label>
            <a href="#">Lupa password?</a>
          </div>

          <button class="btn btn-primary w-100" type="submit">Masuk</button>
        </form>
      </div>
    </section>
  </main>
</body>
</html>