<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - SIPMA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border-t-4 border-red-500 text-center">
        
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-6">
            <svg class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">
                Akses Dibatasi
            </h2>
            <p class="mt-4 text-gray-500">
                Maaf, Anda tidak memiliki izin untuk masuk ke area ini. 
            </p>
            <div class="mt-4 text-sm bg-gray-100 p-3 rounded-lg text-gray-600 border border-gray-200 text-left">
                <p>
                    Halaman ini khusus untuk area: 
                    <strong>
                        @php
                            // Ambil segmen pertama dari URL (misal: 'admin', 'dosen', 'musyrif')
                            $panelId = request()->segment(1); 
                            
                            // Mapping nama panel ke label yang cantik
                            $panelNames = [
                                'admin'   => 'Admin / Staff Pusat',
                                'dosen'   => 'Dosen / Pengajar',
                                'musyrif' => 'Musyrif / Pembina Asrama',
                                'santri'  => 'Santri / Pendaftar',
                            ];
                        @endphp
                        
                        {{-- Tampilkan nama panel yang sesuai, atau default 'Area Terbatas' --}}
                        {{ $panelNames[$panelId] ?? 'Area Terbatas' }}
                    </strong>
                </p>
                <p class="mt-1">
                    Akun Anda terdeteksi sebagai: 
                    <span class="font-bold text-emerald-600">
                        {{ auth()->user()?->getRoleNames()->map(fn($role) => ucwords(str_replace('_', ' ', $role)))->join(' / ') ?? 'Tamu' }}
                    </span>
                </p>
            </div>
        </div>

        <div class="mt-8 space-y-3">
            @php
                $user = auth()->user();
                $homeUrl = '/';
                $homeLabel = 'Kembali ke Beranda';

                if ($user) {
                    if ($user->hasRole(['super_admin', 'staff'])) {
                        $homeUrl = '/admin';
                        $homeLabel = 'Ke Panel Admin';
                    } elseif ($user->hasRole('dosen')) {
                        $homeUrl = '/dosen';
                        $homeLabel = 'Ke Portal Dosen';
                    } elseif ($user->hasRole('musyrif')) {
                        $homeUrl = '/musyrif';
                        $homeLabel = 'Ke Portal Musyrif';
                    } elseif ($user->hasRole(['santri', 'pendaftar'])) {
                        $homeUrl = '/santri';
                        $homeLabel = 'Ke Portal Santri';
                    }
                }
            @endphp

            <a href="{{ $homeUrl }}" class="w-full flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 md:py-3 md:text-lg transition-colors shadow-sm">
                {{ $homeLabel }}
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
            <a href="/" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 md:py-3 md:text-lg transition-colors">
                Kembali ke Beranda
            </a>
        </div>
        
        <p class="mt-6 text-xs text-gray-400">
            Error Code: 403 Forbidden | SIPMA Security Guard
        </p>
    </div>

</body>
</html>