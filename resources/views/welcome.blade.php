<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPMA - Ma'had Al-Jami'ah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;600;700&family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; }
        .font-mono { font-family: 'IBM Plex Mono', monospace; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ openModal: null }">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">M</div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">SIPMA <span class="text-emerald-600">2.0</span></h1>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Ma'had Al-Jami'ah Ronggowarsito <br> UIN Raden Mas Said Surakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Sistem Informasi Pengelolaan Ma'had Al-Jami'ah
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Satu pintu untuk manajemen akademik, kesantrian, dan pembinaan karakter.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 mb-16">
            
            <a href="/santri/login" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-500 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border-t-4 border-emerald-500">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-emerald-50 text-emerald-700 ring-4 ring-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Login Santri / Daftar Baru
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Akses KRS, KHS, dan riwayat pembayaran untuk Mahasantri.
                    </p>
                </div>
            </a>

            <a href="/dosen/login" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border-t-4 border-blue-500">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Login Pengajar
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Portal akademik untuk Dosen dan Pengajar Tutorial.
                    </p>
                </div>
            </a>

            <a href="/musyrif/login" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-amber-500 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border-t-4 border-amber-500">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-amber-50 text-amber-700 ring-4 ring-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Login Musyrif/ah
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Manajemen asrama, halaqoh, dan kedisiplinan santri.
                    </p>
                </div>
            </a>
        </div>

        <div class="relative bg-gray-900 rounded-3xl overflow-hidden px-6 py-16 sm:px-12 sm:py-20 lg:px-16">
            <div class="relative mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Pengen kuliah sambil mondok?
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                    Bergabunglah menjadi bagian dari keluarga besar Ma’had Al-Jami’ah Ronggowarsito. Daftarkan diri Anda menggunakan NIM aktif.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="/register-santri" class="rounded-md bg-white px-8 py-3.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition duration-200">
                        DAFTAR SEKARANG
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
            <button @click="openModal = 'tatacara'" class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100 hover:bg-blue-100 transition cursor-pointer text-left">
                <div class="p-2 bg-blue-200 rounded-full text-blue-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">Tata Cara Pendaftaran</h4>
                    <p class="text-sm text-blue-700">Klik untuk melihat alur lengkap.</p>
                </div>
            </button>

            <button @click="openModal = 'aturan'" class="flex items-center p-4 bg-amber-50 rounded-lg border border-amber-100 hover:bg-amber-100 transition cursor-pointer text-left">
                <div class="p-2 bg-amber-200 rounded-full text-amber-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900">Tata Tertib Ma'had</h4>
                    <p class="text-sm text-amber-700">Pahami aturan sebelum bergabung.</p>
                </div>
            </button>
        </div>
    </main>

    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="openModal" x-transition.opacity class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75" @click="openModal = null"></div>
            </div>

            <div x-show="openModal" x-transition.scale class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                <div x-show="openModal === 'tatacara'" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">📋 Alur Pendaftaran</h3>
                    <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                        <li>Siapkan NIM aktif (Sesuai tahun angkatan).</li>
                        <li>Isi formulir pendaftaran awal.</li>
                        <li>Lengkapi biodata orang tua dan berkas.</li>
                        <li>Tunggu verifikasi admin.</li>
                    </ol>
                </div>

                <div x-show="openModal === 'aturan'" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">⚠️ Tata Tertib Ringkas</h3>
                    <ul class="list-disc list-inside space-y-2 text-sm text-gray-600">
                        <li>Wajib mengikuti sholat berjamaah.</li>
                        <li>Dilarang merokok di area Ma'had.</li>
                        <li>Jam malam berlaku pukul 22.00 WIB.</li>
                    </ul>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="openModal = null" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>