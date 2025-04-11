<x-admin-layout>
    <x-slot:title>Dashboard Admin</x-slot:title>

    <div class="px-6 py-4">
        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm">Siswa Terlambat</p>
                <h2 class="text-2xl font-bold">{{ $jumlahTerlambat }}</h2>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm">Kehadiran Hari Ini</p>
                <h2 class="text-2xl font-bold">{{ $jumlahAbsen }} / {{ $totalSiswa }}</h2>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm">Sakit Hari Ini</p>
                <h2 class="text-2xl font-bold">{{ $jumlahSakit }}</h2>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="mb-4 flex items-center gap-4">
            <select name="kelas_jurusan" class="p-2 border rounded">
                <option value="">-- Pilih Kelas --</option>
                <option value="10RPL" {{ request('kelas_jurusan') == '10RPL' ? 'selected' : '' }}>X RPL</option>
                <option value="11RPL" {{ request('kelas_jurusan') == '11RPL' ? 'selected' : '' }}>XI RPL</option>
                <option value="12RPL" {{ request('kelas_jurusan') == '12RPL' ? 'selected' : '' }}>XII RPL</option>
            </select>
            <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700">Filter</button>
        </form>

        {{-- Tabel Kehadiran --}}
        <div class="overflow-x-auto">
            <table class="w-full  border text-sm">
                <thead class="bg-sky-700 text-white text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Kehadiran</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensis as $absen)
                        <tr>
                            <td class="px-4 py-2 border">{{ $absen->id }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->name }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->kelas }} {{ $absen->siswa->jurusan }}</td>
                            <td class="px-4 py-2 border">{{ $absen->kehadiran }}</td>
                            <td class="px-4 py-2 border">
                                @if ($absen->kehadiran === 'Sakit' && $absen->bukti)
                                    <button onclick="showImagePopup('{{ asset('storage/' . $absen->bukti) }}')" 
                                            class="text-blue-500 hover:underline">
                                        Lihat Bukti
                                    </button>
                                @elseif (in_array($absen->kehadiran, ['Izin', 'Terlambat']))
                                    {{ $absen->keterangan ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data kehadiran hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Popup Modal --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-4 rounded-lg max-w-sm w-full">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-lg font-semibold">Bukti Keterangan</h3>
                <button onclick="closeImagePopup()" class="text-gray-500 hover:text-black text-xl">&times;</button>
            </div>
            <img id="popupImage" src="" class="w-full h-auto object-cover rounded">
        </div>
    </div>

    <script>
        function showImagePopup(src) {
            document.getElementById('popupImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImagePopup() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('popupImage').src = '';
        }
    </script>
</x-admin-layout>
