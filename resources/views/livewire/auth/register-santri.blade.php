<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 py-12 sm:px-6 lg:px-8 font-sans">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Pendaftaran Ma'had
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Khusus Mahasiswa Baru
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl shadow-gray-200/50 sm:rounded-xl sm:px-10 border border-gray-100">

            @if($step === 1)
                <form wire:submit.prevent="checkNim" class="space-y-6">
                    <div>
                        <label for="nim" class="block text-sm font-semibold text-gray-700">
                            Masukkan NIM Anda
                        </label>
                        <div class="mt-2 relative rounded-md shadow-sm">
                            <input 
                                wire:model="nim" 
                                id="nim" 
                                type="text" 
                                required 
                                autofocus
                                maxlength="9" 
                                minlength="9"
                                pattern="[0-9]*"
                                inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                class="block w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm placeholder-gray-400"
                                placeholder="Contoh: 243111087"
                            >
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            Pastikan NIM berjumlah tepat 9 digit angka.
                        </p>
                        @error('nim') 
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>

                    <div>
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-wait">
                            <span wire:loading.remove>Cek Data & Lanjut</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memeriksa...
                            </span>
                        </button>
                    </div>
                </form>
            @endif @if($step === 2)
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-r-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-emerald-800">Data Ditemukan</h3>
                            <div class="mt-2 text-sm text-emerald-700">
                                <p class="font-bold text-lg">{{ $studentData['nama_lengkap'] }}</p>
                                <p>{{ $studentData['prodi'] }} - {{ $studentData['fakultas'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="register" class="space-y-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Buat Password Akun</label>
                        <div class="mt-1">
                            <input wire:model="password" id="password" type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        </div>
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Ulangi Password</label>
                        <div class="mt-1">
                            <input wire:model="password_confirmation" id="password_confirmation" type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
                            Selesaikan Pendaftaran
                        </button>
                        <button type="button" wire:click="$set('step', 1)" class="mt-4 w-full text-center text-sm text-gray-500 hover:text-gray-700 underline decoration-gray-300 hover:decoration-gray-500 underline-offset-2">
                            Batal / Cek NIM Lain
                        </button>
                    </div>
                </form>
            @endif </div>
    </div>
</div>