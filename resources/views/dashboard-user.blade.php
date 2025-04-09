<x-user-layout>
    <x-slot:title>Dashboard User</x-slot:title>

    <div class="max-w-6xl mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">
            Data Absensi - Kelas {{ $siswa->kelas }} / {{ $siswa->jurusan }}
        </h2>

        <div class="overflow-x-auto bg-white rounded-xl shadow p-4">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Status Kehadiran</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensi as $index => $item)
                        <tr class="border-b">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $item->siswa->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->created_at->translatedFormat('l, d F Y') }}</td>
                            <td class="px-4 py-2 border">
                                <span class="font-semibold {{ $item->kehadiran === 'Hadir' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $item->kehadiran }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-user-layout>
