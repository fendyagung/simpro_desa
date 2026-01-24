<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white">
            <h1 class="text-2xl font-bold text-white">Edit Profil Resmi DPMD</h1>
            <p class="text-blue-100/80">Kelola informasi instansi, sambutan pimpinan, dan struktur organisasi.
            </p>
        </div>

        <form action="{{ route('dashboard.dpmd.update-profil') }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-10">
            @csrf

            <!-- Kadis Section -->
            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                    Informasi Kepala Dinas & Sambutan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <label for="nama_kadis" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                            Kepala Dinas</label>
                        <input type="text" name="nama_kadis" id="nama_kadis"
                            value="{{ old('nama_kadis', $profile->nama_kadis) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="foto_kadis" class="block text-sm font-semibold text-slate-700 mb-2">Foto
                            Kepala Dinas</label>
                        <input type="file" name="foto_kadis" id="foto_kadis"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="md:col-span-2">
                        <label for="logo_website" class="block text-sm font-semibold text-slate-700 mb-2">Logo
                            Website (Logo Manggarai Timur)</label>
                        <input type="file" name="logo_website" id="logo_website"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-[10px] text-slate-500 mt-2">Format: PNG/JPG. Disarankan logo dengan latar
                            belakang transparan.</p>
                    </div>
                    <div class="md:col-span-2">
                        <label for="video_promo_url" class="block text-sm font-semibold text-slate-700 mb-2">Link Video
                            Promosi (YouTube URL)</label>
                        <input type="url" name="video_promo_url" id="video_promo_url"
                            value="{{ old('video_promo_url', $profile->video_promo_url) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: https://www.youtube.com/watch?v=...">
                        <p class="text-[10px] text-slate-500 mt-2">Link ini akan digunakan untuk tombol "Tonton Video"
                            di halaman Beranda.</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label for="sambutan_judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul
                            Sambutan
                            (Slogan)</label>
                        <input type="text" name="sambutan_judul" id="sambutan_judul"
                            value="{{ old('sambutan_judul', $profile->sambutan_judul) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: Membangun Desa, Sejahterakan Rakyat">
                    </div>
                    <div>
                        <label for="sambutan_teks" class="block text-sm font-semibold text-slate-700 mb-2">Teks
                            Sambutan</label>
                        <textarea name="sambutan_teks" id="sambutan_teks" rows="5"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('sambutan_teks', $profile->sambutan_teks) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
                    Statistik Wilayah (Beranda)
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <label for="stat_total_desa" class="block text-sm font-semibold text-slate-700 mb-2">Total
                            Desa</label>
                        <input type="number" name="stat_total_desa" id="stat_total_desa"
                            value="{{ old('stat_total_desa', $profile->stat_total_desa) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_desa_wisata" class="block text-sm font-semibold text-slate-700 mb-2">Desa
                            Wisata</label>
                        <input type="number" name="stat_desa_wisata" id="stat_desa_wisata"
                            value="{{ old('stat_desa_wisata', $profile->stat_desa_wisata) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_spot_wisata" class="block text-sm font-semibold text-slate-700 mb-2">Spot
                            Wisata</label>
                        <input type="number" name="stat_spot_wisata" id="stat_spot_wisata"
                            value="{{ old('stat_spot_wisata', $profile->stat_spot_wisata) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="stat_wisatawan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Wisatawan</label>
                        <input type="text" name="stat_wisatawan" id="stat_wisatawan"
                            value="{{ old('stat_wisatawan', $profile->stat_wisatawan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: 12rb">
                    </div>
                </div>
            </div>

            <!-- Visi Misi Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-teal-500 rounded-full"></span>
                    Visi & Misi Instansi
                </h3>
                <div class="space-y-6">
                    <div>
                        <label for="visi" class="block text-sm font-semibold text-slate-700 mb-2">Visi</label>
                        <textarea name="visi" id="visi" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('visi', $profile->visi) }}</textarea>
                    </div>
                    <div>
                        <label for="misi" class="block text-sm font-semibold text-slate-700 mb-2">Misi (Gunakan
                            baris baru untuk setiap poin)</label>
                        <textarea name="misi" id="misi" rows="6"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('misi', $profile->misi) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Struktur Nama Pejabat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="nama_sekretaris" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                            Sekretaris
                            Dinas</label>
                        <input type="text" name="nama_sekretaris" id="nama_sekretaris"
                            value="{{ old('nama_sekretaris', $profile->nama_sekretaris) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_pemberdayaan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Nama Kabid
                            Pemberdayaan</label>
                        <input type="text" name="nama_kabid_pemberdayaan" id="nama_kabid_pemberdayaan"
                            value="{{ old('nama_kabid_pemberdayaan', $profile->nama_kabid_pemberdayaan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_pemerintahan"
                            class="block text-sm font-semibold text-slate-700 mb-2">Nama Kabid
                            Pemerintahan</label>
                        <input type="text" name="nama_kabid_pemerintahan" id="nama_kabid_pemerintahan"
                            value="{{ old('nama_kabid_pemerintahan', $profile->nama_kabid_pemerintahan) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="nama_kabid_ekonomi" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                            Kabid Ekonomi</label>
                        <input type="text" name="nama_kabid_ekonomi" id="nama_kabid_ekonomi"
                            value="{{ old('nama_kabid_ekonomi', $profile->nama_kabid_ekonomi) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                    Simpan Profil DPMD
                </button>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>