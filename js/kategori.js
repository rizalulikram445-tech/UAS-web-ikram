document.addEventListener("DOMContentLoaded", function () {
    // Kode di dalam sini baru jalan setelah HTML selesai dimuat
});
const formKategori = document.querySelector("#kategori form");

formKategori.addEventListener("submit", function (e) {
    // Semua pengecekan dilakukan di sini
});

const inputNama = formKategori.querySelector('input[name="nama_kategori"]');
const namaKategori = inputNama.value.trim();

if (namaKategori === "") {
    alert("Nama kategori tidak boleh hanya berisi spasi kosong!");
    e.preventDefault(); 
    inputNama.focus();   
    return;
}

if (namaKategori.length > 80) {
    alert("Nama kategori maksimal 80 karakter!");
    e.preventDefault();
    inputNama.focus();
    return;
}