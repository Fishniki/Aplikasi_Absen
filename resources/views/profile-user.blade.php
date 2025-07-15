<x-user-layout>
    <x-slot:title>Profile</x-slot:title>


    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="w-full flex justify-end mb-5">
            @if ($siswa_byuser_id->lengkap === "sudah") 
                <button class="px-3 py-2 bg-sky-700 text-white rounded-lg font-medium cursor-not-allowed" disabled>
                    Profile
                </button>
            @else
                <button class="px-3 py-2 bg-sky-700 text-white rounded-lg font-medium">
                    <a href="{{ route('user.profile-edit', Auth::user()->id) }}">Edit Profile</a>
                </button>
            @endif
        </div>
            @if (@session('error'))
                <p class="px-3 py-2 bg-red-200 text-red-500 border border-red-500 mb-3">{{ session('error') }}</p>
            @elseif (@session('success'))
                <p class="px-3 py-2 bg-green-200 text-green-500 border border-green-500 mb-3">{{ session('success') }}</p>
            @endif
        <div class="bg-white shadow-md rounded-xl overflow-hidden p-6">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <!-- Profile Image -->
                <div class="w-40 h-40 shrink-0">
                    <img
                        src="{{ asset('storage/' . $siswa_byuser_id->image) }}"
                        alt="Foto Profil"
                        class="w-full h-full object-cover rounded-xl shadow-sm border border-gray-200"
                    >
                </div>

                <!-- Profile Info -->
                <div class="flex-1 space-y-2 text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $siswa_byuser_id->name }}</h2>
                    <p class="text-gray-600"><strong>NIS:</strong> {{ $siswa_byuser_id->nis }}</p>
                    <p class="text-gray-600"><strong>Kelas:</strong> {{ $siswa_byuser_id->kelas }}</p>
                    <p class="text-gray-600"><strong>Jurusan:</strong> {{ $siswa_byuser_id->jurusan }}</p>
                    <p class="text-gray-600"><strong>Jenis Kelamin:</strong> {{ $siswa_byuser_id->jenis_kelamin }}</p>
                </div>
            </div>
        </div>
    </div>

</x-user-layout>
