<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-4">
            {{-- Icon Status (Dark Mode: Background jadi Emerald-900, Icon jadi Emerald-400) --}}
            <div class="p-3 rounded-full bg-emerald-100 dark:bg-emerald-900/50">
                <x-heroicon-o-flag class="w-8 h-8 text-emerald-600 dark:text-emerald-400" />
            </div>

            <div class="flex-1">
                {{-- Judul (Dark Mode: Putih) --}}
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                    Status Pendaftaran
                </h2>
                
                @if($admission)
                    {{-- Deskripsi (Dark Mode: Abu-abu terang) --}}
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        No. Reg: <span class="font-mono font-bold text-gray-900 dark:text-gray-200">{{ $admission->no_pendaftaran }}</span>
                    </p>

                    <div class="mt-2">
                        @php
                            // Warna Badge Status (Untuk Dark Mode kita pakai utility Ring/Border biar kontras)
                            $colors = [
                                'draft' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                'submitted' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                'passed' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
                            ];
                            $statusLabel = [
                                'draft' => 'Draft (Belum Dikirim)',
                                'submitted' => 'Sedang Diverifikasi',
                                'passed' => 'LULUS SELEKSI',
                                'failed' => 'Maaf, Belum Lulus',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $colors[$admission->status] ?? 'bg-gray-100 dark:bg-gray-700' }}">
                            {{ $statusLabel[$admission->status] ?? ucfirst($admission->status) }}
                        </span>
                    </div>
                @else
                    {{-- Pesan Kosong (Dark Mode: Abu-abu terang) --}}
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Anda belum memulai misi pendaftaran.
                    </p>
                    <div class="mt-3">
                        <x-filament::button
                            tag="a"
                            href="{{ \App\Filament\Santri\Resources\Admissions\AdmissionResource::getUrl('create') }}"
                        >
                            Mulai Pendaftaran Sekarang
                        </x-filament::button>
                    </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>