<?php
include "koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id != "") {
    // Jalankan query hapus berdasarkan id_produk
    $sql = "DELETE FROM produk WHERE id_produk = '$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        // Jika berhasil, langsung kembalikan ke halaman produk
        header("Location: produk.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke halaman produk
    header("Location: produk.php");
    exit;
}
?>