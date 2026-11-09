<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-950 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Sambutan Admin -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 overflow-hidden shadow-md sm:rounded-xl p-8 text-white">
                <h3 class="text-2xl font-bold mb-2">Selamat Datang, Administrator!</h3>
                <p class="text-blue-100 text-sm md:text-base">
                    Kelola seluruh sistem perpustakaan, data buku, peminjaman, hingga penetapan role pengguna melalui panel admin ini.
                </p>
            </div>

            <!-- Grid Menu Navigasi Admin (Diubah ke 4 kolom agar semua menu muat sejajar) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Menu 1: Manajemen Buku -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-100 flex flex-col justify-between">
                    <div>
                        <div class="text-blue-950 font-semibold text-lg mb-1">Manajemen Buku</div>
                        <p class="text-gray-500 text-sm">Kelola daftar buku, tambah, ubah, atau hapus koleksi perpustakaan.</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('admin.buku.index') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                            Kelola Buku &rarr;
                        </a>
                    </div>
                </div>

                <!-- Menu 2: Manajemen Pengguna & Role -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-100 flex flex-col justify-between">
                    <div>
                        <div class="text-blue-950 font-semibold text-lg mb-1">Manajemen Pengguna</div>
                        <p class="text-gray-500 text-sm">Kelola daftar akun pengguna dan atur penetapan role (Admin/Petugas/Siswa).</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('admin.users.index') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                            Kelola Pengguna &rarr;
                        </a>
                    </div>
                </div>

                <!-- Menu 3: Data Peminjaman -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-100 flex flex-col justify-between">
                    <div>
                        <div class="text-blue-950 font-semibold text-lg mb-1">Data Peminjaman</div>
                        <p class="text-gray-500 text-sm">Pantau daftar peminjaman dan pengembalian buku oleh anggota.</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('admin.peminjaman.index') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                            Lihat Peminjaman &rarr;
                        </a>
                    </div>
                </div>

                <!-- Menu 4: Pengembalian Buku -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-100 flex flex-col justify-between">
                    <div>
                        <div class="text-blue-950 font-semibold text-lg mb-1">Pengembalian Buku</div>
                        <p class="text-gray-500 text-sm">Proses pengembalian buku dan catat status denda atau riwayat selesai.</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('admin.pengembalian.index') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                            Proses Pengembalian &rarr;
                        </a>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-blue-100 flex flex-col justify-between">
                    <div>
                        <div class="text-blue-900 font-semibold text-lg mb-1">Profil Akun</div>
                        <p class="text-gray-500 text-sm">Kelola informasi akun dan periksa status profil Anda.</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow">
                            Edit Profil &rarr;
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>