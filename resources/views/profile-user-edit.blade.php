<x-user-layout>
    <x-slot:title>Lengkapi Data Anda</x-slot:title>

    <div class="w-full max-w-xl p-5 px-10 mx-5 mt-10  rounded-lg shadow-md">
        {{-- <p>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y ') }}</p> --}}
        <form action="{{ route('user.profile-update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nis" class="block mb-1 font-medium">Nis:</label>
                <input type="text" id="nis" name="nis" placeholder="006153594"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('nis') border-red-500 @enderror">

                @error('nis')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama" class="block mb-1 font-medium">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" placeholder="Niki Ahmad Hamdani"
                value="{{ $siswa_byuser_id->name }}"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('nama') border-red-500 @enderror">

                @error('nama')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-5">
                <div class="mb-4 w-full">
                    <label for="kelas" class="block mb-1 font-medium">Kelas:</label>
                    <select
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('kelas') border-red-500 @enderror"
                        name="kelas" id="kelas" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="10">X</option>
                        <option value="11">XI</option>
                        <option value="12">XII</option>
                    </select>
            
                    @error('kelas')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="mb-4 w-full">
                    <label for="jurusan" class="block mb-1 font-medium">Jurusan:</label>
                    <select
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('jurusan') border-red-500 @enderror"
                        name="jurusan" id="jurusan" required>
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option value="RPL">RPL</option>
                        <option value="DKV">DKV</option>
                        <option value="AKL-I">AKL-I</option>
                        <option value="AKL-II">AKL-II</option>
                        <option value="OTKP">OTKP</option>
                        <option value="BR">BR</option>

                    </select>
            
                    @error('jurusan')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            

            <div class="mb-4">
                <label class="block mb-1 font-medium">Jenis Kelamin:</label>
                <div class="flex items-center gap-5">
                    <label class="flex items-center gap-2">
                        <input id="jk_checkbox" type="checkbox" name="jenis_kelamin" value="Laki-laki"
                            class="border rounded-md focus:ring focus:ring-blue-200 @error('jenis_kelamin') border-red-500 @enderror">
                        <span>Laki-laki</span>
                    </label>
            
                    <label class="flex items-center gap-2">
                        <input id="jk_checkbox" type="checkbox" name="jenis_kelamin" value="Perempuan"
                            class="border rounded-md focus:ring focus:ring-blue-200 @error('jenis_kelamin') border-red-500 @enderror">
                        <span>Perempuan</span>
                    </label>
                </div>
            
                @error('jenis_kelamin')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            
            <div class="mb-4">
                <label for="image" class="block mb-1 font-medium">Masukan Foto:</label>
                <input type="file" id="image" name="image"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('image') border-red-500 @enderror">

                @error('image')
                    <p class="text-sm text-red-500">{{ $image }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/checkbox.js') }}"></script>
    @endpush
</x-user-layout>