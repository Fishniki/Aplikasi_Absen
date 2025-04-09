const filterKelasJurusan = document.getElementById('filterKelasJurusan');

filterKelasJurusan.addEventListener('change', function () {
    const value = this.value;

    if (value) {
        window.location.href = `?kelas_jurusan=${value}`;
    }
});
