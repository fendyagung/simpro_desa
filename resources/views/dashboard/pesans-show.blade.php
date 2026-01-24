<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-slate-50 border-b border-slate-100 flex justify-between items-center text-slate-600">
            <a href="{{ route('dashboard.pesans') }}"
                class="flex items-center gap-2 hover:text-blue-600 font-bold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Inbox
            </a>
            <div class="text-sm font-medium">{{ $pesan->created_at->format('d F Y • H:i') }}</div>
        </div>

        <div class="p-8 md:p-12">
            <div class="flex items-center gap-6 mb-10 pb-8 border-b border-slate-100">
                <div
                    class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 text-2xl font-bold uppercase">
                    {{ substr($pesan->nama, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">{{ $pesan->nama }}</h2>
                    <p class="text-slate-500">{{ $pesan->email }}</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label
                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-2">Perihal
                        / Subjek</label>
                    <h3 class="text-xl font-bold text-slate-800">{{ $pesan->subjek ?? 'Tanpa Subjek' }}</h3>
                </div>

                <div class="pt-6">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-4">Isi
                        Pesan</label>
                    <div
                        class="text-lg text-slate-700 leading-relaxed bg-slate-50 p-8 rounded-3xl border border-slate-100 min-h-[200px]">
                        {!! nl2br(e($pesan->pesan)) !!}
                    </div>
                </div>

                @if($pesan->lampiran)
                    <div class="pt-6">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-4">Lampiran</label>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
                            @php
                                $extension = pathinfo($pesan->lampiran, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp

                            @if($isImage)
                                <div class="w-20 h-20 rounded-xl overflow-hidden border border-slate-200 bg-white">
                                    <img src="{{ asset('storage/' . $pesan->lampiran) }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-20 h-20 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div>
                                <p class="text-sm font-bold text-slate-700 mb-1">File Lampiran ({{ strtoupper($extension) }})</p>
                                <a href="{{ asset('storage/' . $pesan->lampiran) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-700 text-sm font-bold underline">
                                    Lihat / Download File →
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-12 flex flex-wrap items-center gap-4">
                <a href="mailto:{{ $pesan->email }}?subject=Tanggapan: {{ $pesan->subjek ?? 'Pesan dari SIMPRO Matim' }}&body=%0A%0A--- Pesan Asli ---%0A{{ urlencode($pesan->pesan) }}"
                    class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl shadow-blue-500/20 transition-all transform hover:-translate-y-1">
                    Balas Melalui Email
                </a>
                <button onclick="copyEmail('{{ $pesan->email }}')"
                    class="px-8 py-4 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-bold rounded-2xl transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                    Salin Alamat Email
                </button>
                <button onclick="window.print()"
                    class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all">
                    Cetak Pesan
                </button>
            </div>

            <script>
                function copyEmail(email) {
                    navigator.clipboard.writeText(email).then(() => {
                        alert('Alamat email berhasil disalin ke clipboard!');
                    });
                }
            </script>
        </div>
    </div>
</x-layouts.admin>