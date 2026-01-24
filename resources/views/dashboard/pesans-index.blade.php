<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white">
            <h1 class="text-2xl font-bold text-white">Kotak Masuk Pesan</h1>
            <p class="text-blue-100/80 text-sm">Lihat dan tindak lanjuti aspirasi serta pertanyaan dari masyarakat.</p>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Pengirim</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Subjek & Pesan</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Tanggal</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($pesans as $pesan)
                            <tr
                                class="hover:bg-slate-50/50 transition-colors {{ !$pesan->is_read ? 'bg-blue-50/30' : '' }}">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold uppercase">
                                            {{ substr($pesan->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div
                                                class="font-bold text-slate-800 {{ !$pesan->is_read ? 'text-blue-700' : '' }}">
                                                {{ $pesan->nama }}
                                                @if(!$pesan->is_read)
                                                    <span class="inline-block w-2 h-2 bg-blue-500 rounded-full ml-1"></span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-slate-400">{{ $pesan->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 max-w-md">
                                    <div class="font-semibold text-slate-700 mb-1">
                                        {{ $pesan->subjek ?? 'Tanpa Subjek' }}
                                    </div>
                                    <p class="text-sm text-slate-500 line-clamp-1">{{ $pesan->pesan }}</p>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500">
                                    {{ $pesan->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('dashboard.pesans.detail', $pesan->id) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-blue-500 hover:text-blue-600 rounded-xl text-sm font-bold transition-all shadow-sm">
                                        Baca Pesan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div
                                        class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">Belum ada pesan masuk di kotak masuk Anda.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($pesans->hasPages())
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                {{ $pesans->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>