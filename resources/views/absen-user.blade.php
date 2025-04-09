<x-user-layout>
    <x-slot:title>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">
                Absensi Kehadiran
            </h1>
            <span class="font-medium text-sm">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}</span>
        </div>
    </x-slot:title>
    
        <div class="max-w-5xl mx-auto px-4 py-8">

            @if (@session('error'))
                <p class="px-3 py-2 bg-red-200 text-red-500 border border-red-500 mb-3">{{ session('error') }}</p>
            @elseif (@session('success'))
                <p class="px-3 py-2 bg-green-200 text-green-500 border border-green-500 mb-3">{{ session('success') }}</p>
            @endif

            <div class="bg-white p-6 rounded-xl  shadow-md flex flex-col md:flex-row gap-6 items-start">
                {{-- Gambar & Info Profil --}}
                <div class="w-full md:w-1/3 text-center md:border-r md:pr-6 md:border-gray-300">
                    {{-- Foto Profil --}}
                    <img 
                        src="{{ asset('storage/' . $siswa_byuser_id->image) }}" 
                        alt="Foto Profil" 
                        class="w-32 h-32 md:w-40 md:h-40 mx-auto object-cover rounded-full shadow-md mb-4"
                    >
                
                    {{-- Info Siswa dalam Tabel --}}
                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $siswa_byuser_id->name }}</h2>
                
                    <div class="overflow-x-auto">
                        <table class="table-auto mx-auto text-left text-sm text-gray-700">
                            <tbody>
                                <tr>
                                    <td class="pr-2 font-semibold">NIS</td>
                                    <td>: {{ $siswa_byuser_id->nis }}</td>
                                </tr>
                                <tr>
                                    <td class="pr-2 font-semibold">Kelas</td>
                                    <td>: {{ $siswa_byuser_id->kelas }}</td>
                                </tr>
                                <tr>
                                    <td class="pr-2 font-semibold">Jurusan</td>
                                    <td>: {{ $siswa_byuser_id->jurusan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
    
                {{-- Form Absensi --}}
                <div class="w-full md:w-2/3">

                    @if ($absen_hari_ini)
                        <div class="w-full items-center flex flex-col my-auto">
                            <p class="text-red-500 uppercase font-semibold text-xl ">
                                Anda sudah melakukan Absen hari ini
                            </p>
                            <h1 class="text-lg font-medium">
                                Status Absen:
                                <span class="text-green-600 uppercase">{{ $absen_hari_ini->kehadiran }}</span>
                            </h1>
                        </div>
                    @else
                        {{-- Tampilkan Form Absensi --}}
                        <form action="{{ route('user.upload-absen') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                
                            <h3 class="text-lg font-semibold">Pilih Kehadiran:</h3>
                
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status" value="Hadir" class="text-blue-600" required>
                                    Hadir
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status" value="Izin" class="text-yellow-500">
                                    Izin
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status" value="Sakit" class="text-red-500">
                                    Sakit
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status" value="Terlambat" class="text-gray-600">
                                    Terlambat
                                </label>
                            </div>
                
                            <div id="alasanContainer" class="hidden">
                                <label for="alasan" class="block font-medium mb-1">Alasan:</label>
                                <textarea name="alasan" id="alasan" rows="3" class="w-full px-3 py-2 border rounded-md">Tanpa keterangan</textarea>
                            </div>
                
                            <div id="buktiSakitContainer" class="hidden mt-4">
                                <label for="bukti_sakit" class="block font-medium mb-1">Upload Bukti Sakit:</label>
                                <input type="file" name="bukti_sakit" id="bukti_sakit" accept="image/*" capture="environment" class="mb-2">
                                <button type="button" onclick="openCamera()" class="px-3 py-1 bg-gray-600 text-white rounded-md">
                                    <i class="bi bi-camera"></i>
                                </button>
                            </div>
                
                            <input type="hidden" name="lokasi" id="lokasi">
                            <input type="hidden" name="siswa_id" value="{{ $siswa_byuser_id->id }}">
                
                            <button type="submit" class="mt-4 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                Kirim Absensi
                            </button>
                        </form>
                    @endif
                </div>
                
            </div>
        </div>

    @push('scripts')
        <script src="{{ asset('js/absensi.js') }}"></script>
    @endpush
</x-user-layout>