document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="status"]');
    const alasanContainer = document.getElementById('alasanContainer');
    const buktiSakitContainer = document.getElementById('buktiSakitContainer');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            const value = this.value;

            if (value === 'Izin' || value === 'Terlambat') {
                alasanContainer.classList.remove('hidden');
                buktiSakitContainer.classList.add('hidden');
            } else if (value === 'Sakit') {
                alasanContainer.classList.add('hidden');
                buktiSakitContainer.classList.remove('hidden');
            } else {
                alasanContainer.classList.add('hidden');
                buktiSakitContainer.classList.add('hidden');
            }
        });
    });
});

function openCamera() {
    const fileInput = document.getElementById('bukti_sakit');
    fileInput.click();
}

document.addEventListener('DOMContentLoaded', function () {
    // Ambil lokasi
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lokasi = `${position.coords.latitude},${position.coords.longitude}`;
            const lokasiInput = document.getElementById('lokasi');
            if (lokasiInput) {
                lokasiInput.value = lokasi;
            }
        }, function (error) {
            console.error('Gagal mendapatkan lokasi:', error.message);
        });
    } else {
        console.warn('Geolocation tidak didukung oleh browser ini.');
    }
});

