<x-admin-layout>
    <x-slot:title>Data Pengguna</x-slot:title>

    <div class="max-w-2xl px-4 py-6">

        <div class="w-full flex justify-end">
            <button class="bg-sky-700 mb-5 hover:bg-sky-800 text-white font-bold py-2 px-4 rounded">
                <a href="{{ route('admin.form-pengguna') }}" >
                    Tambah
                </a>
            </button>
        </div>

        <table class="min-w-full bg-white shadow-md rounded-xl overflow-hidden">
            <thead class="bg-sky-700 text-left text-white text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">NIP</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Mapel</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                @forelse ($penggunas as $pengguna)
                    <tr>
                        <td class="px-6 py-4">{{ $pengguna->nip }}</td>
                        <td class="px-6 py-4">{{ $pengguna->name }}</td>
                        <td class="px-6 py-4">{{ $pengguna->email }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.edit-pengguna', $pengguna->id) }}"
                               class="text-blue-600 hover:underline"><i class="bi bi-pencil-square"></i></a>
                            
                            @if (Auth::guard('admin')->user()->id === $pengguna->id)
                                <p></p>
                            @else
                                <form action="{{ route('admin.delete-pengguna', $pengguna->id) }}"
                                      method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <button type="submit" class="text-red-600 hover:underline"><i class="bi bi-person-x"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
