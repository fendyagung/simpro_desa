<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white">
            <h1 class="text-2xl font-bold">Kelola Profil Promosi Desa</h1>
            <p class="text-blue-100/80">Perbarui informasi desa Anda untuk meningkatkan daya tarik bagi wisatawan dan
                publik.</p>
        </div>

        <form action="{{ route('dashboard.desa.update') }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="nama_desa" class="block text-sm font-semibold text-slate-700 mb-2">Nama Desa</label>
                    <input type="text" name="nama_desa" id="nama_desa" value="{{ old('nama_desa', $desa->nama_desa) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                </div>
                <div>
                    <label for="kecamatan" class="block text-sm font-semibold text-slate-700 mb-2">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $desa->kecamatan) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="kepala_desa" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kepala
                        Desa</label>
                    <input type="text" name="kepala_desa" id="kepala_desa"
                        value="{{ old('kepala_desa', $desa->kepala_desa) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                </div>
                <div>
                    <label for="foto_profil" class="block text-sm font-semibold text-slate-700 mb-2">Foto Utama / Banner
                        Desa</label>
                    <input type="file" name="foto_profil" id="foto_profil"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-[10px] text-slate-400 mt-2 italic">Format: JPG, JPEG, PNG (Maks 5MB)</p>
                </div>
            </div>

            <div>
                <label for="video_youtube" class="block text-sm font-semibold text-slate-700 mb-2">Link Video Promosi
                    (YouTube URL) - <span class="text-slate-400 font-normal">Opsional</span></label>
                <input type="url" name="video_youtube" id="video_youtube"
                    value="{{ old('video_youtube', $desa->video_youtube) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                    placeholder="Contoh: https://www.youtube.com/watch?v=...">
                <p class="text-[10px] text-slate-400 mt-2 italic">Bagikan keindahan desa Anda melalui video YouTube yang
                    menarik.</p>
            </div>

            <!-- Detailed Statistics -->
            <div class="border-t border-slate-100 pt-8">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Statistik & Data Desa
                </h3>

                <!-- Demographics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <label for="jumlah_penduduk" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah
                            Penduduk (Jiwa)</label>
                        <input type="number" name="jumlah_penduduk" id="jumlah_penduduk"
                            value="{{ old('jumlah_penduduk', $desa->jumlah_penduduk) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 1500">
                    </div>
                    <div>
                        <label for="jumlah_kk" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Kepala
                            Keluarga (KK)</label>
                        <input type="number" name="jumlah_kk" id="jumlah_kk"
                            value="{{ old('jumlah_kk', $desa->jumlah_kk) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 350">
                    </div>
                </div>

                <!-- Geographic & Economic -->
                <div class="space-y-6">
                    <div>
                        <label for="luas_wilayah" class="block text-sm font-semibold text-slate-700 mb-2">Luas Wilayah
                            (dengan satuan)</label>
                        <input type="text" name="luas_wilayah" id="luas_wilayah"
                            value="{{ old('luas_wilayah', $desa->luas_wilayah) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 12.5 km² atau 1.500 Ha">
                    </div>

                    <div>
                        <label for="deskripsi_batas" class="block text-sm font-semibold text-slate-700 mb-2">Batas-batas
                            Wilayah</label>
                        <textarea name="deskripsi_batas" id="deskripsi_batas" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Utara: Desa A, Selatan: Laut Sawu, Timur: Sungai Wae Bobo...">{{ old('deskripsi_batas', $desa->deskripsi_batas) }}</textarea>
                    </div>

                    <div>
                        <label for="potensi_ekonomi" class="block text-sm font-semibold text-slate-700 mb-2">Potensi
                            Ekonomi / Mata Pencaharian Utama</label>
                        <textarea name="potensi_ekonomi" id="potensi_ekonomi" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 80% penduduk adalah petani kopi Robusta, sisanya nelayan dan pedagang...">{{ old('potensi_ekonomi', $desa->potensi_ekonomi) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8">
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lengkap &
                    Narasi Profil</label>
                <textarea name="deskripsi" id="deskripsi" rows="8"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                    placeholder="Ceritakan sejarah, keindahan alam, budaya, dan alasan mengapa orang harus berkunjung ke desa Anda...">{{ old('deskripsi', $desa->deskripsi) }}</textarea>
            </div>

            <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex items-center justify-between">
                <div>
                    <h4 class="font-bold text-emerald-900 mb-1">Promosikan Sebagai Desa Wisata</h4>
                    <p class="text-sm text-emerald-700/80">Jika diaktifkan, desa Anda akan muncul di bagian "Destinasi
                        Unggulan" pada halaman beranda utama.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_desa_wisata" value="1" class="sr-only peer" {{ $desa->is_desa_wisata ? 'checked' : '' }}>
                    <div
                        class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500">
                    </div>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>