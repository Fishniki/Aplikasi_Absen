<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">

    <div class="min-h-screen flex items-center justify-center">
        <div class=" rounded-lg p-8 w-full max-w-4xl flex flex-col md:flex-row">

            <!-- Form Login -->
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-xl font-semibold mb-2">Kehadiran Tercatat,</h2>
                <h2 class="text-xl font-semibold mb-4">Proses Belajar Terpantau</h2>
                <p class="mb-6 text-sm text-gray-600">Masuk untuk memantau kehadiran dengan praktis.</p>

                <form method="POST" action="{{ route('admin.store-login') }}">
                    @csrf

                    @if (session('Error'))
                        <div class="mb-4 text-red-500 text-sm">
                            {{ session('Error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email"
                            class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring focus:border-blue-300 @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring focus:border-blue-300 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" id="nip" name="nip" placeholder="NIP"
                            class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring focus:border-blue-300 @error('nip') border-red-500 @enderror"
                            value="{{ old('nip') }}">
                        @error('nip')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded w-full hover:bg-indigo-700 transition">
                        Login Sekarang
                    </button>
                </form>

            </div>

            <!-- Gambar -->
            <div class="w-full md:w-1/2 flex items-center justify-center">
                <div class="w-96  flex items-center justify-center">
                    <img src="https://asset.kompas.com/crops/NojQDwXxMMXCBFrwsUm1EgEJmZY=/0x500:6750x5000/1200x800/data/photo/2022/10/31/635f66ec6820a.jpg"
                        class="" alt="">

                </div>
            </div>
        </div>

        <div class="absolute bottom-4 text-xs text-gray-500">
            2025. SMKN 46 JAKARTA
        </div>
    </div>

</body>

</html>
