<x-layouts.admin>
    @if(Auth::user()->role === 'admin_desa')
        <!-- Automatic Confirmation for Accepted Reports -->
        @php
            $hasAccepted = \App\Models\Laporan::whereHas('desa', function ($q) {
                $q->where('user_id', Auth::id());
            })->where('status', 'diterima')->where('updated_at', '>', now()->subDays(1))->exists();
        @endphp

        @if($hasAccepted)
            <div
                class="mb-6 p-6 bg-white border-2 border-emerald-500 rounded-2xl flex items-center gap-4 shadow-lg shadow-emerald-500/10 animate-bounce-subtle">
                <div class="p-3 bg-emerald-500 rounded-full text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 text-lg">Kabar Gembira!</h4>
                    <p class="text-emerald-700 font-medium">Laporan Anda sudah diterima oleh Admin DPMD.</p>
                </div>
            </div>
        @endif
    @endif

    <!-- Welcome Section -->
    <div class="mb-8 p-8 bg-[#2b529a] rounded-3xl text-white shadow-xl shadow-blue-900/10 relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-blue-100/80">
                @if(Auth::user()->role === 'admin_dpmd')
                    Panel Monitoring Pusat DPMD Kabupaten Manggarai Timur.
                @else
                    Ini adalah dashboard desa {{ $data['desa_nama'] ?? 'Anda' }}. Kelola profil dan pantau
                    informasi terkini.
                @endif
            </p>
        </div>
        <div class="absolute top-0 right-0 -mt-12 -mr-12 w-64 h-64 bg-white/10 rounded-full blur-3xl">
        </div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl">
        </div>
    </div>

    @if(isset($data['pengumuman']) && $data['pengumuman'])
        @php
            $umum = $data['pengumuman'];
            $bgClass = $umum->tipe == 'darurat' ? 'bg-red-50 border-red-200 text-red-800' :
                ($umum->tipe == 'penting' ? 'bg-amber-50 border-amber-200 text-amber-800' : 'bg-blue-50 border-blue-200 text-blue-800');
            $iconColor = $umum->tipe == 'darurat' ? 'text-red-500' :
                ($umum->tipe == 'penting' ? 'text-amber-500' : 'text-blue-500');
        @endphp
        <div class="mb-8 p-6 {{ $bgClass }} border rounded-2xl flex items-start gap-4">
            <div class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $iconColor }}" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-1">{{ $umum->judul }}</h3>
                <p class="leading-relaxed">{{ $umum->isi }}</p>
                <p class="text-xs mt-3 opacity-70">Diposting: {{ $umum->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @if(Auth::user()->role === 'admin_dpmd')
            <!-- DPMD Stats -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Total Desa</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ $data['total_desa'] }} Desa</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Laporan Masuk</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ $data['total_laporan'] }} Laporan</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Perlu Review</h3>
                <p class="text-2xl font-bold text-orange-600 mt-1">{{ $data['laporan_pending'] }} Pending
                </p>
            </div>
        @else
            <!-- Desa Stats -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Total Laporan</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ $data['total_laporan'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Laporan Diterima</h3>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $data['laporan_diterima'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <h3 class="text-slate-500 text-sm font-medium">Status Akun</h3>
                <p class="text-lg font-bold text-green-600 mt-1">Terverifikasi</p>
            </div>
        @endif
    </div>

    @if(Auth::user()->role === 'admin_dpmd')
        <!-- DPMD MONITORING: List of Villages -->
        <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 mb-8">
            <div class="p-6 border-b border-slate-50">
                <h3 class="font-bold text-lg text-slate-800">Monitoring Data Desa</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500 font-medium">
                        <tr>
                            <th class="px-6 py-4">Nama Desa</th>
                            <th class="px-6 py-4">Kecamatan</th>
                            <th class="px-6 py-4">Laporan</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($data['desas'] as $desa)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-700">{{ $desa->nama_desa }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $desa->kecamatan }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold">{{ $desa->laporans_count }}
                                        Laporan</span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('dashboard.desa.toggle-wisata', $desa->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 rounded-full text-[10px] font-bold transition-all shadow-sm
                                                                                                {{ $desa->is_desa_wisata ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                            {{ $desa->is_desa_wisata ? 'WISATA: AKTIF' : 'BUKAN WISATA' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('dashboard.desa.detail', $desa->id) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium italic">Lihat
                                        Detail →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Recent Activity Section -->
    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
        <div class="p-6 border-b border-slate-50">
            <h3 class="font-bold text-lg text-slate-800">Aktivitas Laporan Terbaru</h3>
        </div>
        <div class="p-0">
            @if($data['recent_laporans']->isEmpty())
                <div class="p-8 text-center text-slate-400 italic">Belum ada aktivitas laporan.</div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach($data['recent_laporans'] as $laporan)
                        <a href="{{ route('dashboard.laporan.detail', $laporan->id) }}"
                            class="block p-4 hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-800">{{ $laporan->judul }}</p>
                                <p class="text-xs text-slate-500">
                                    @if(Auth::user()->role === 'admin_dpmd')
                                        Oleh: {{ $laporan->desa->nama_desa }} |
                                    @endif
                                    Kategori: {{ ucfirst($laporan->kategori) }} |
                                    {{ $laporan->tanggal_laporan }}
                                </p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold
                                                                                                                        {{ $laporan->status === 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                                                                                                                        {{ $laporan->status === 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                                                                                                        {{ $laporan->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>