document.addEventListener("DOMContentLoaded", function () {

    // ==========================
    // SHOW / HIDE PASSWORD
    // ==========================
    const password = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    if (password && togglePassword) {
        togglePassword.addEventListener("click", function () {

            if (password.type === "password") {
                password.type = "text";
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                password.type = "password";
                this.innerHTML = '<i class="bi bi-eye"></i>';
            }

        });
    }

    // ==========================
    // VALIDASI KATEGORI
    // ==========================
    const formKategori = document.querySelector("#kategori form");

    if (formKategori) {

        formKategori.addEventListener("submit", function (e) {

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

        });

    }

    // ==========================
    // COUNTER ANIMATION
    // ==========================
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {

        const target = +counter.getAttribute('data-target');

        const speed = 40;

        const updateCount = () => {

            const currentCount = +counter.innerText.replace(/\./g, '');

            const inc = Math.ceil(target / speed);

            if (currentCount < target) {

                const nextCount = currentCount + inc;

                if (nextCount > target) {
                    counter.innerText = target.toLocaleString('id-ID');
                } else {
                    counter.innerText = nextCount.toLocaleString('id-ID');
                    setTimeout(updateCount, 20);
                }

            } else {

                counter.innerText = target.toLocaleString('id-ID');

            }

        };

        if (target > 0) {
            updateCount();
        } else {
            counter.innerText = "0";
        }

    });

});