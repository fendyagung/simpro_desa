<x-layouts.public>
    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-bold text-slate-900 mb-6">Hubungi Kami</h1>
                <p class="text-slate-500 text-lg">
                    Tim kami siap membantu Anda dengan informasi mengenai tata kelola desa, potensi wisata, maupun
                    bantuan teknis sistem.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Kirim Pesan
                    </h2>

                    @if(Session::has('success'))
                        <div
                            class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">{{ Session::get('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('public.kontak.submit') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Subjek</label>
                            <select name="subjek"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                <option value="Informasi Desa Wisata">Informasi Desa Wisata</option>
                                <option value="Bantuan Teknis Laporan">Bantuan Teknis Laporan</option>
                                <option value="Pengaduan Masyarakat">Pengaduan Masyarakat</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pesan Anda</label>
                            <textarea name="pesan" rows="5" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 outline-none transition-all">{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Lampiran (Opsional)</label>
                            <input type="file" name="lampiran"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <p class="text-[10px] text-slate-400 mt-2 italic">Format: JPG, PNG, PDF (Maks 5MB)</p>
                            @error('lampiran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all transform hover:-translate-y-1">
                            Kirim Sekarang
                        </button>
                    </form>
                </div>

                <!-- Office Info -->
                <div class="space-y-12">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                            <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                            Kantor Pusat
                        </h2>
                        <div class="space-y-8">
                            <div class="flex items-start gap-5">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 mb-1">Alamat</h4>
                                    <p class="text-slate-500 text-sm leading-relaxed">Jl. Trans Flores, Borong,
                                        Kabupaten Manggarai Timur, Nusa Tenggara Timur.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-5">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 mb-1">Telepon & Email</h4>
                                    <p class="text-slate-500 text-sm">(0385) 123456 • info@dpmdmatim.go.id</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="relative h-64 bg-slate-100 rounded-[2.5rem] overflow-hidden border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                            class="w-full h-full object-cover grayscale opacity-50">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-white px-6 py-3 rounded-2xl shadow-xl font-bold text-slate-800 flex items-center gap-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full animate-ping"></div>
                                Borong, Manggarai Timur
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>