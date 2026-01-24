<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Bank Data & Regulasi</h1>
                <p class="text-blue-100/80">Kelola dokumen resmi, peraturan daerah, dan template laporan desa.</p>
            </div>
        </div>

        <div class="p-8">
            <!-- Upload Form -->
            <div class="mb-12 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Unggah Dokumen Baru
                </h3>
                <form action="{{ route('regulasi.store') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Dokumen</label>
                        <input type="text" name="judul" id="judul" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Contoh: Peraturan Bupati No. 12 Tahun 2025">
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategori" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                            <option value="">Pilih Kategori...</option>
                            <option value="Peraturan Daerah">Peraturan Daerah (Perda/Perbup)</option>
                            <option value="Format Laporan">Format Laporan</option>
                            <option value="Template Surat">Template Surat Admin</option>
                            <option value="Materi Sosialisasi">Materi Sosialisasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-semibold text-slate-700 mb-2">File Dokumen</label>
                        <input type="file" name="file" id="file" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-[10px] text-slate-400 mt-2">PDF, DOCX, XLS, PPT, ZIP (Max 10MB)</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Singkat
                            (Opsional)</label>
                        <textarea name="deskripsi" id="deskripsi" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all">
                            Unggah Dokumen
                        </button>
                    </div>
                </form>
            </div>

            <!-- Documents List -->
            <h3 class="font-bold text-slate-800 mb-6 text-lg">Daftar Dokumen Tersedia</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-sm text-slate-500 border-b border-slate-100">
                            <th class="py-4 font-semibold">Judul Dokumen</th>
                            <th class="py-4 font-semibold">Kategori</th>
                            <th class="py-4 font-semibold">Tanggal Upload</th>
                            <th class="py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @forelse($regulasis as $reg)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 pr-4">
                                    <div class="font-bold text-slate-800">{{ $reg->judul }}</div>
                                    <div class="text-xs text-slate-400">{{ $reg->deskripsi }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $reg->kategori == 'Peraturan Daerah' ? 'bg-purple-100 text-purple-700' : '' }}
                                            {{ $reg->kategori == 'Format Laporan' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $reg->kategori == 'Template Surat' ? 'bg-amber-100 text-amber-700' : '' }}
                                            {{ $reg->kategori == 'Materi Sosialisasi' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                            {{ $reg->kategori == 'Lainnya' ? 'bg-slate-100 text-slate-700' : '' }}">
                                        {{ $reg->kategori }}
                                    </span>
                                </td>
                                <td class="py-4 text-slate-500">
                                    {{ $reg->created_at->format('d M Y') }}
                                </td>
                                <td class="py-4 text-right flex justify-end gap-2">
                                    <a href="{{ asset('storage/' . $reg->file_path) }}" target="_blank"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors"
                                        title="Download">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('regulasi.destroy', $reg->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400 italic">
                                    Belum ada dokumen yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>