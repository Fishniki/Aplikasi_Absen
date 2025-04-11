<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kehadiran Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="container mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold">Kehadiran Hari Ini</h1>
        
                {{-- Jika admin login --}}
                @auth('admin')
                    <a href="{{ route('admin.login-admin') }}" class="px-3 py-2 bg-green-300 font-medium text-center border rounded-lg text-black">
                        Dashboard Admin
                    </a>
                @endauth
        
                {{-- Jika user biasa login --}}
                @auth
                    @if (Auth::user()->role === 'user')
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 bg-green-300 font-medium text-center border rounded-lg text-black">
                            Dashboard
                        </a>
                    @endif
                @endauth
            </div>
        
            <div class="flex gap-5">
                {{-- Jika belum login sebagai admin dan user --}}
                @guest('admin')
                    @guest
                        <a href="{{ route('login') }}" class="text-sky-600 border border-sky-600 hover:text-sky-700 hover:border-sky-700 px-4 py-2 rounded">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700">
                            Register
                        </a>
                        <a href="{{ route('admin.login-admin') }}" class="px-3 py-2 bg-green-300 font-medium text-center border rounded-lg text-black">
                            Dashboard Admin
                        </a>
                    @endguest
                @endguest
            </div>
        </div>
        
        

        {{-- Filter Form --}}
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-4">
            <select name="limit" class="p-2 border rounded">
                @foreach ([10, 25, 50, 100] as $val)
                    <option value="{{ $val }}" {{ $limit == $val ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>

            <select name="kelas_jurusan" class="p-2 border rounded">
                <option value="">Semua Kelas</option>
                <option value="10RPL" {{ $kelas == '10RPL' ? 'selected' : '' }}>X RPL</option>
                <option value="11RPL" {{ $kelas == '11RPL' ? 'selected' : '' }}>XI RPL</option>
                <option value="12RPL" {{ $kelas == '12RPL' ? 'selected' : '' }}>XII RPL</option>
            </select>

            <input type="text" name="nis" value="{{ $nis }}" placeholder="Ketik NIS" class="p-2 border rounded" />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cari</button>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-sky-600 text-white">
                    <tr>
                        <th class="px-4 py-2 border">NIS</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Kehadiran</th>
                        <th class="px-4 py-2 border">Ket.</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensis as $absen)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border">{{ $absen->siswa->nis }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->name }}</td>
                            <td class="px-4 py-2 border">{{ $absen->siswa->kelas }} {{ $absen->siswa->jurusan }}</td>
                            <td class="px-4 py-2 border">{{ $absen->kehadiran }}</td>
                            <td class="px-4 py-2 border">
                                @if ($absen->kehadiran === 'Sakit' && $absen->bukti)
                                    <a href="{{ asset('storage/' . $absen->bukti) }}" target="_blank" class="text-blue-500 hover:underline">Lihat</a>
                                @else
                                    {{ $absen->keterangan ?? '-' }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data kehadiran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-8 text-sm text-gray-500">
            © 2025. SMKN 46 JAKARTA
        </div>
    </div>

</body>
</html>
