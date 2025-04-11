<x-admin-layout>
    <x-slot:title>Form Pengguna</x-slot:title>

    <div class="w-full max-w-xl p-5 px-10 mx-5 mt-10 rounded-lg shadow-md bg-white">
        <form action="{{ route('admin.store-pengguna') }}" method="POST">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label for="nama" class="block mb-1 font-medium">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" placeholder="Niki Ahmad Hamdani"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block mb-1 font-medium">Email:</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block mb-1 font-medium">Password:</label>
                <input type="password" id="password" name="password" placeholder="********"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 flex-1">
                <label for="nip" class="block mb-1 font-medium">NIP:</label>
                <input type="text" id="nip" name="nip" placeholder="006153594"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-200 @error('nip') border-red-500 @enderror">
                    @error('nip')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
