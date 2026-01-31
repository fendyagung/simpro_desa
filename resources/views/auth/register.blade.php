<x-layouts.public>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Register Card -->
        <div class="max-w-sm w-full mx-auto space-y-6 bg-white p-6 rounded-2xl shadow-xl" style="max-width: 400px;">
            <div class="text-center">
                <h2 class="text-slate-500 text-sm font-medium mb-1">Buat akun untuk mengakses sistem</h2>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-400 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required autofocus value="{{ old('name') }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="John Doe">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-400 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-400 mb-1">Tingkatan Akun</label>
                    <select name="role" id="role" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        onchange="toggleDesaSelector()">
                        <option value="">-- Pilih Tingkatan --</option>
                        <option value="admin_dpmd" {{ old('role') == 'admin_dpmd' ? 'selected' : '' }}>Admin Dinas PMD
                        </option>
                        <option value="admin_desa" {{ old('role') == 'admin_desa' ? 'selected' : '' }}>Admin Desa</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <!-- Desa Selector (Hidden by default) -->
                <div id="desa_selector" style="{{ old('role') == 'admin_desa' ? '' : 'display: none;' }}">
                    <label for="desa_id" class="block text-sm font-medium text-slate-400 mb-1">Pilih Desa</label>
                    <select name="desa_id" id="desa_id"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="">-- Pilih Desa Anda --</option>
                        @foreach($availableDesas as $desa)
                            <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                {{ $desa->nama_desa }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('desa_id')" class="mt-1" />
                </div>

                <script>
                    function toggleDesaSelector() {
                        const role = document.getElementById('role').value;
                        const desaSelector = document.getElementById('desa_selector');
                        const desaInput = document.getElementById('desa_id');

                        if (role === 'admin_desa') {
                            desaSelector.style.display = 'block';
                            desaInput.setAttribute('required', 'required');
                        } else {
                            desaSelector.style.display = 'none';
                            desaInput.removeAttribute('required');
                        }
                    }
                </script>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-400 mb-1">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg text-gray-900 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <button type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Daftar
                </button>
            </form>

            <div class="text-center mt-4 border-t border-gray-100 pt-4">
                <p class="text-sm text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-500 hover:text-indigo-400">
                        Masuk disini
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.public>