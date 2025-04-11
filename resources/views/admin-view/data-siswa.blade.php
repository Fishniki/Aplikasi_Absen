<x-admin-layout>
    <x-slot:title>DATA SISWA SMKN 46 JAKARTA</x-slot:title> 

    <div class="p-10">

      {{-- Pesan Sukses --}}
      @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
      @endif

      {{-- section option kelas dan jurusan --}}
      <div class="flex gap-5 py-5">
        <select id="filterKelasJurusan" class="px-3 py-2 rounded-lg w-full max-w-52">
            <option value="" disabled selected>Pilih Kelas & Jurusan</option>
            <option value="All" {{ request('kelas_jurusan') == 'All' ? 'selected' : '' }}>All</option>
            <option value="10 RPL" {{ request('kelas_jurusan') == '10 RPL' ? 'selected' : '' }}>10-RPL</option>
            <option value="10 DKV" {{ request('kelas_jurusan') == '10 DKV' ? 'selected' : '' }}>10-DKV</option>
            <option value="10 OTKP" {{ request('kelas_jurusan') == '10 OTKP' ? 'selected' : '' }}>10-OTKP</option>
            <option value="11 RPL" {{ request('kelas_jurusan') == '11 RPL' ? 'selected' : '' }}>11-RPL</option>
            <option value="11 DKV" {{ request('kelas_jurusan') == '11 DKV' ? 'selected' : '' }}>11-DKV</option>
            <option value="11 OTKP" {{ request('kelas_jurusan') == '11 OTKP' ? 'selected' : '' }}>11-OTKP</option>
            <option value="12 RPL" {{ request('kelas_jurusan') == '12 RPL' ? 'selected' : '' }}>12-RPL</option>
            <option value="12 DKV" {{ request('kelas_jurusan') == '12 DKV' ? 'selected' : '' }}>12-DKV</option>
            <option value="12 OTKP" {{ request('kelas_jurusan') == '12 OTKP' ? 'selected' : '' }}>12-OTKP</option>
        </select>
    </div>
  
      <div class="overflow-y-auto max-h-[500px]"> {{-- Scroll aktif jika lebih dari 500px --}}
          <table class="w-full max-w-2xl bg-white shadow-md rounded-xl overflow-hidden">
              <thead class="bg-sky-700 text-white text-sm uppercase font-semibold">
                <tr>
                  <th class="px-6 py-3 text-left">Image</th>
                  <th class="px-6 py-3 text-left">NIS</th>
                  <th class="px-6 py-3 text-left">Nama</th>
                  <th class="px-6 py-3 text-left">Kelas</th>
                  <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-gray-600 divide-y divide-gray-200">
                  @forelse ($data_siswa as $data)
                  <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                          <div class="w-10 h-10 rounded-full overflow-hidden">
                              <img
                                  src="{{ asset('storage/' . $data->image) }}"
                                  alt=""
                                  class="w-full h-full object-cover">
                          </div>
                        </td>
                        
                        <td class="px-6 py-4">{{ $data->nis }}</td>
                        <td class="px-6 py-4">{{ $data->name }}</td>
                        <td class="px-6 py-4">{{ $data->kelas }} {{ $data->jurusan }}</td>
                        <td class="px-6 py-4">
                          <button class="text-blue-500 hover:text-blue-700 mr-3 font-medium">
                            <a href="{{ route('admin.edit-siswa', $data->id) }}"><i class="bi bi-pencil-square"></i></a>
                          </button>
                          <button class="text-red-500 hover:text-red-700 font-medium">
                            <a href="{{ route('admin.delete-siswa', $data->id) }}">
                              <i class="bi bi-file-earmark-x"></i></button>
                            </a>
                        </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="4" class="text-center py-4">Data siswa masih kosong</td>
                  </tr>
                  @endforelse
              </tbody>
            </table>
      </div>
  
      <button class="px-3 py-2 bg-sky-700 rounded-lg text-sm text-white mt-10">
          <a href="{{ route('admin.form-siswa') }}">
              Tambah Siswa
          </a>
      </button>
  </div>
  
    @push('scripts')
        <script src="{{ asset('js/filter.js') }}"></script>
    @endpush

</x-admin-layout>