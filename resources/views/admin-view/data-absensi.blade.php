<x-admin-layout>
    <x-slot:title>Data Absensi</x-slot:title>

    <div class="max-w-5xl px-4 py-6">
        {{-- Filter --}}
        <div class="flex justify-between items-center gap-4 mb-6">

            <div class="flex gap-4">
                <div>
                    <label for="kelas_jurusan" class="block text-sm font-medium text-gray-700">Kelas & Jurusan</label>
                    <select id="kelas_jurusan" class="w-full  p-2 border rounded">
                        <option value="">-- Pilih --</option>
                        <option value="10RPL" {{ request('kelas_jurusan') == '10RPL' ? 'selected' : '' }}>X RPL</option>
                        <option value="11RPL" {{ request('kelas_jurusan') == '11RPL' ? 'selected' : '' }}>XI RPL</option>
                        <option value="12RPL" {{ request('kelas_jurusan') == '12RPL' ? 'selected' : '' }}>XII RPL</option>
                    </select>
                </div>
    
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" class="w-full p-2 border rounded" value="{{ request('tanggal') }}">
                </div>
            </div>

            <button onclick="goToEdit()" class="bg-sky-700 hover:bg-sky-800 text-white font-bold px-3 py-2 rounded">
                Perbarui
            </button>
        </div>

        {{-- Table Absensi --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead class="bg-sky-700 text-white text-sm">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">NIS</th>
                        <th class="px-4 py-2 border">Kehadiran</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($absensis as $index => $absen)
                        <tr>
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->name }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->nis }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($absen->kehadiran) }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($absen->created_at)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border">
                                @if ($absen->kehadiran === 'Sakit' && $absen->bukti)
                                    <button onclick="showImagePopup('{{ asset('storage/' . $absen->bukti) }}')" 
                                            class="text-blue-600 hover:underline">
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
                            <td colspan="5" class="px-4 py-2 border text-center text-gray-500">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- popup image --}}
            <!-- Modal Container -->
            <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-4 rounded-lg max-w-sm w-full">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold">Bukti Sakit</h3>
                        <button onclick="closeImagePopup()" class="text-gray-500 hover:text-black">&times;</button>
                    </div>
                    <img id="popupImage" src="" alt="Bukti Gambar" class="w-full h-auto object-cover rounded">
                </div>
            </div>

        </div>
    </div>

    {{-- Auto Submit --}}
    <script>
        const kelasJurusan = document.getElementById('kelas_jurusan');
        const tanggal = document.getElementById('tanggal');

        function updateUrl() {
            const params = new URLSearchParams(window.location.search);
            params.set('kelas_jurusan', kelasJurusan.value);
            params.set('tanggal', tanggal.value);
            window.location.search = params.toString();
        }

        kelasJurusan.addEventListener('change', updateUrl);
        tanggal.addEventListener('change', updateUrl);


        function goToEdit() {
        const kelas = document.getElementById('kelas_jurusan').value;
        const tanggal = document.getElementById('tanggal').value;
        if (!kelas || !tanggal) {
            alert('Harap pilih kelas dan tanggal terlebih dahulu.');
            return;
        }
        const url = `{{ route('admin.edit-absensi') }}?kelas_jurusan=${kelas}&tanggal=${tanggal}`;
        window.location.href = url;
    }

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
