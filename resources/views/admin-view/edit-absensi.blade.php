<x-admin-layout>
    <x-slot:title>Edit Absensi</x-slot:title>

    <div class="max-w-5xl mx-auto px-4 py-6">
        <form action="{{ route('admin.update-absensi') }}" method="POST">
            @csrf

            <input type="hidden" name="kelas_jurusan" value="{{ $kelas_jurusan }}">
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">

            <table class="min-w-full bg-white border text-sm">
                <thead class="bg-sky-700 text-white">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">NIS</th>
                        <th class="px-4 py-2 border text-center">Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis as $index => $absen)
                        <tr>
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->name }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->nis }}</td>
                            <td class="px-4 py-2 border">
                                @foreach(['Terlambat', 'Sakit', 'Izin', 'Alfa', 'Hadir'] as $status)
                                    <label class="mr-2 inline-flex items-center">
                                        <input type="radio" name="kehadiran[{{ $absen->id }}]" value="{{ $status }}"
                                            {{ $absen->kehadiran == $status ? 'checked' : '' }} required>
                                        {{ $status }}
                                    </label>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
