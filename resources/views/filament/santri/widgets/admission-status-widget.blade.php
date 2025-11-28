<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-4">
            {{-- Icon Status --}}
            <div class="p-3 bg-emerald-100 rounded-full">
                <x-heroicon-o-flag class="text-emerald-600" style="width: 2rem; height: 2rem;" />
            </div>

            <div class="flex-1">
                <h2 class="text-lg font-bold text-gray-800">
                    Status Misi Pendaftaran
                </h2>
                
                @if($admission)
                    <p class="text-sm text-gray-600">
                        No. Reg: <span class="font-mono font-bold">{{ $admission->no_pendaftaran }}</span>
                    </p>
                    <div class="mt-2">
                        @php
                            $colors = [
                                'draft' => 'bg-gray-100 text-gray-800',
                                'submitted' => 'bg-yellow-100 text-yellow-800',
                                'passed' => 'bg-green-100 text-green-800',
                                'failed' => 'bg-red-100 text-red-800',
                            ];
                            $statusLabel = [
                                'draft' => 'Draft (Belum Dikirim)',
                                'submitted' => 'Sedang Diverifikasi',
                                'passed' => 'LULUS SELEKSI',
                                'failed' => 'Maaf, Belum Lulus',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $colors[$admission->status] ?? 'bg-gray-100' }}">
                            {{ $statusLabel[$admission->status] ?? ucfirst($admission->status) }}
                        </span>
                    </div>
                @else
                    <p class="text-sm text-gray-500">
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