
<div x-data="{ open: true }" class="bg-gray-800 text-white w-64 min-h-screen transition-all duration-300 flex
flex-col" :class="open ? 'w-64' : 'w-auto items-center'">
    <div class="p-4 flex justify-between items-center">
        <h1 class="text-lg font-semibold" x-show="open">Admin Panel</h1>
        <button @click="open = !open" class="text-white focus:outline-none">
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <nav class="mt-4 flex flex-col" :class="open ? 'w-64' : 'w-auto items-center'">
        <x-admin-sidebar-link href="/admin/dashboard" icon="bi bi-house"  :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin-sidebar-link>
        <x-admin-sidebar-link href="/admin/data-siswa" icon="bi bi-person"  :active="request()->routeIs('admin.data-siswa')">Data Siswa</x-admin-sidebar-link>
        <x-admin-sidebar-link href="/admin/absen-siswa" icon="bi bi-calendar-event"  :active="request()->routeIs('admin.absen-siswa')">Absen Siswa</x-admin-sidebar-link>
        <x-admin-sidebar-link href="/admin/data-pengguna" icon="bi bi-people"  :active="request()->routeIs('admin.data-pengguna')">Pengguna</x-admin-sidebar-link>
        <x-admin-sidebar-link href="/admin/logout" icon="bi bi-box-arrow-left"  :active="request()->routeIs('admin.logout')">Keluar</x-admin-sidebar-link>
    </nav>
</div>
