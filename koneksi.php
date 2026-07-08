<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_umkm_produk"; // Sesuaikan dengan nama database di phpMyAdmin

$koneksi = mysqli_connect($host, $user, $pass, $db);

if ($koneksi){
    echo "database terkoneksi";
}else{
    echo "database tidak terkoneksi";
}
?>