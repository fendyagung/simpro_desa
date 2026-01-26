<x-layouts.admin>
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 bg-[#2b529a] text-white">
            <h1 class="text-2xl font-bold text-white">Kotak Masuk Pesan</h1>
            <p class="text-blue-100/80 text-sm">
                @if(Auth::user()->role === 'admin_dpmd')
                    Lihat dan tindak lanjuti aspirasi serta pertanyaan dari masyarakat.
                @else
                    Daftar pesan yang pernah Anda kirimkan melalui halaman Kontak.
                @endif
            </p>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                Status & Pengirim</th>
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
                            @php
                                $isReplyNew = Auth::user()->role === 'admin_desa' && !$pesan->is_read && $pesan->balasan;
                                $isPesanNew = Auth::user()->role === 'admin_dpmd' && !$pesan->is_read;
                            @endphp
                            <tr
                                class="hover:bg-slate-50/50 transition-colors {{ $isReplyNew || $isPesanNew ? 'bg-blue-50/50' : '' }}">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div
                                                class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold uppercase border border-slate-200 shadow-sm">
                                                {{ substr($pesan->nama, 0, 1) }}
                                            </div>
                                            @if($pesan->balasan)
                                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center"
                                                    title="Sudah Dibalas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800">
                                                {{ $pesan->nama }}
                                                @if($isReplyNew || $isPesanNew)
                                                    <span
                                                        class="ml-2 px-1.5 py-0.5 bg-blue-100 text-blue-600 text-[10px] font-bold rounded">BARU</span>
                                                @endif
                                            </div>
                                            <div class="text-[10px] text-slate-400 font-medium uppercase tracking-tight">
                                                {{ Auth::user()->role === 'admin_dpmd' ? $pesan->email : 'Anda' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 max-w-md">
                                    <div class="font-semibold text-slate-700 mb-0.5">
                                        {{ $pesan->subjek ?? 'Tanpa Subjek' }}
                                    </div>
                                    <p class="text-sm text-slate-500 line-clamp-1 italic">"{{ $pesan->pesan }}"</p>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 flex flex-col">
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($pesan->created_at)->format('d/m/y') }}</span>
                                    <span
                                        class="text-[10px]">{{ \Carbon\Carbon::parse($pesan->created_at)->format('H:i') }}</span>
                                </td>
                                <td class="px-8 py-6 text-right flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.pesans.detail', $pesan->id) }}"
                                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 rounded-2xl text-sm font-bold transition-all shadow-sm group">
                                        <span>Baca</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transform group-hover:translate-x-1 transition-transform"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('dashboard.pesans.destroy', $pesan->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-red-50 text-red-500 hover:bg-red-100 rounded-xl transition-all"
                                            title="Hapus Pesan">
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