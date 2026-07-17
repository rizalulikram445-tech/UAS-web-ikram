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

document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            
            // Kecepatan durasi animasi (makin besar angkanya, makin lambat)
            const speed = 40; 
            
            const updateCount = () => {
                const currentCount = +counter.innerText.replace(/\./g, ''); // Hapus format titik saat kalkulasi
                const inc = Math.ceil(target / speed);

                if (currentCount < target) {
                    const nextCount = currentCount + inc;
                    
                    // Jika hasil pertambahan melebihi target, langsung kunci di angka target
                    if (nextCount > target) {
                        counter.innerText = target.toLocaleString('id-ID');
                    } else {
                        counter.innerText = nextCount.toLocaleString('id-ID');
                        setTimeout(updateCount, 20); // Interval pemicu animasi (milidetik)
                    }
                } else {
                    counter.innerText = target.toLocaleString('id-ID');
                }
            };
            
            // Jalankan fungsi jika target di atas 0
            if (target > 0) {
                updateCount();
            } else {
                counter.innerText = "0";
            }
        });
    });