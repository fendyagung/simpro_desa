<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Pusat Pengumuman & Broadcast</h1>
                <p class="text-blue-100/80">Kirim pesan penting ke seluruh Admin Desa.</p>
            </div>
        </div>

        <div class="p-8">
            <!-- Create Form -->
            <div class="mb-12 bg-amber-50 p-6 rounded-2xl border border-amber-100">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    Buat Pengumuman Baru
                </h3>
                <form action="{{ route('pengumuman.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul
                                Pengumuman</label>
                            <input type="text" name="judul" id="judul" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Contoh: Batas Akhir Pelaporan Triwulan 1">
                        </div>
                        <div>
                            <label for="tipe" class="block text-sm font-semibold text-slate-700 mb-2">Tingkat
                                Urgensi</label>
                            <select name="tipe" id="tipe" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                                <option value="info">Info Biasa (Biru)</option>
                                <option value="penting">Penting (Kuning)</option>
                                <option value="darurat">Sangat Segera / Darurat (Merah)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2">Isi Pesan</label>
                        <textarea name="isi" id="isi" rows="3" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Tuliskan detail pengumuman di sini..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                            Kirim Broadcast
                        </button>
                    </div>
                </form>
            </div>

            <!-- List -->
            <h3 class="font-bold text-slate-800 mb-6 text-lg">Riwayat Pengumuman</h3>
            <div class="space-y-4">
                @forelse($pengumumans as $umum)
                    <div
                        class="p-4 rounded-xl border {{ $umum->is_active ? 'bg-white border-slate-200' : 'bg-slate-50 border-slate-100 opacity-75' }} flex justify-between items-start gap-4">
                        <div class="flex items-start gap-4">
                            <div class="mt-1">
                                @if($umum->tipe == 'info')
                                    <span class="w-3 h-3 block rounded-full bg-blue-500"></span>
                                @elseif($umum->tipe == 'penting')
                                    <span class="w-3 h-3 block rounded-full bg-amber-500"></span>
                                @else
                                    <span class="w-3 h-3 block rounded-full bg-red-500 animate-pulse"></span>
                                @endif
                            </div>
                            <div>
                                <h4
                                    class="font-bold text-slate-800 {{ $umum->is_active ? '' : 'text-slate-500 line-through' }}">
                                    {{ $umum->judul }}
                                    @if(!$umum->is_active)
                                        <span
                                            class="ml-2 text-xs bg-slate-200 text-slate-500 px-2 py-0.5 rounded no-underline decoration-0">Nonaktif</span>
                                    @endif
                                </h4>
                                <p class="text-sm text-slate-600 mt-1 mb-2">{{ $umum->isi }}</p>
                                <p class="text-xs text-slate-400">{{ $umum->created_at->format('d M Y H:i') }} • Oleh Admin
                                    DPMD</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('pengumuman.toggle', $umum->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs font-bold px-3 py-1.5 rounded-lg border {{ $umum->is_active ? 'border-amber-200 text-amber-600 hover:bg-amber-50' : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50' }}">
                                    {{ $umum->is_active ? 'Matikan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <form action="{{ route('pengumuman.destroy', $umum->id) }}" method="POST"
                                onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-200 text-slate-400 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-400 italic">Belum ada pengumuman yang dibuat.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>