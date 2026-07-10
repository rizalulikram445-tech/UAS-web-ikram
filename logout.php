<?php
// 1. Memulai atau memanggil sesi yang sedang aktif
session_start();

// 2. Menghapus semua variabel sesi yang terdaftar
$_SESSION = array();

// 3. Menghancurkan cookie sesi jika ada (opsional, untuk keamanan ekstra)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Menghancurkan sesi secara total di server
session_destroy();

// 5. Mengarahkan admin kembali ke halaman login dengan pesan sukses
echo "<script>
        alert('Anda telah berhasil keluar dari sistem.');
        window.location.href = 'form-login.php';
      </script>";
exit;
?>