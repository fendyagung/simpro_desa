<x-layouts.admin>
    @if(Auth::user()->role === 'admin_desa')
        <!-- Automatic Confirmation for Accepted Reports -->
        @php
            $hasAccepted = \App\Models\Laporan::whereHas('desa', function ($q) {
                $q->where('user_id', Auth::id());
            })->where('status', 'diterima')->where('updated_at', '>', now()->subMinutes(30))->exists();
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
            <a href="#monitoring-desa"
                class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-blue-200 transition-all group">
                <h3 class="text-slate-500 text-sm font-medium group-hover:text-blue-600 transition-colors">Total
                    Desa/Kelurahan</h3>
                <p class="text-2xl font-bold text-slate-800 mt-1 flex items-center justify-between">
                    <span>{{ $data['total_desa'] }} Desa</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </p>
            </a>
            <a href="#laporan-terbaru"
                class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-blue-200 transition-all group">
                <h3 class="text-slate-500 text-sm font-medium group-hover:text-blue-600 transition-colors">Laporan Masuk
                </h3>
                <p class="text-2xl font-bold text-slate-800 mt-1 flex items-center justify-between">
                    <span>{{ $data['total_laporan'] }} Laporan</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </p>
            </a>
            <a href="#laporan-terbaru"
                class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg hover:border-orange-200 transition-all group">
                <h3 class="text-slate-500 text-sm font-medium group-hover:text-orange-600 transition-colors">Perlu Review
                </h3>
                <p class="text-2xl font-bold text-orange-600 mt-1 flex items-center justify-between">
                    <span>{{ $data['laporan_pending'] }} Pending</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-orange-200 group-hover:text-orange-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </p>
            </a>

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
        <div id="monitoring-desa"
            class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 mb-8 scroll-mt-24">

            <div class="p-6 border-b border-slate-50">
                <h3 class="font-bold text-lg text-slate-800">Monitoring Data Desa</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500 font-medium">
                        <tr>
                            <th colspan="4" class="px-6 py-3">
                                <!-- Search Box v4.0 (Flexbox approach) -->
                                <div
                                    class="flex items-center max-w-md bg-white border border-slate-300 rounded-xl focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all overflow-hidden leading-none">
                                    <div class="pl-4 pr-4 text-slate-400 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="desaSearch" placeholder="Cari desa atau kecamatan..."
                                        class="w-full py-2.5 pr-4 text-sm bg-transparent border-none focus:ring-0 focus:outline-none placeholder-slate-400">
                                </div>
                            </th>
                        </tr>
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
    <div id="laporan-terbaru"
        class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 scroll-mt-24">

        <div class="p-6 border-b border-slate-50">
            <h3 class="font-bold text-lg text-slate-800">Aktivitas Laporan Terbaru</h3>
        </div>
        <div class="p-0">
            @if($data['recent_laporans']->isEmpty())
                <div class="p-8 text-center text-slate-400 italic">Belum ada aktivitas laporan.</div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach($data['recent_laporans'] as $laporan)
                        <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between gap-4">
                            <div class="flex-1">
                                <a href="{{ route('dashboard.laporan.detail', $laporan->id) }}">
                                    <p class="font-bold text-slate-800 hover:text-blue-600 transition-colors">
                                        {{ $laporan->judul }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        @if(Auth::user()->role === 'admin_dpmd')
                                            Oleh: {{ $laporan->desa->nama_desa }} |
                                        @endif
                                        Kategori: {{ ucfirst($laporan->kategori) }} |
                                        {{ $laporan->tanggal_laporan }}
                                    </p>
                                </a>
                            </div>
                            <div class="flex items-center gap-3">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap {{ $laporan->status === 'pending' ? 'bg-orange-100 text-orange-700' : '' }} {{ $laporan->status === 'diterima' ? 'bg-green-100 text-green-700' : '' }} {{ $laporan->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                                @if(Auth::user()->role === 'admin_dpmd' && $laporan->desa)
                                    <a href="{{ route('dashboard.desa.detail', $laporan->desa->id) }}"
                                        class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-xs font-medium transition-colors flex items-center gap-1.5 whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Profil Desa
                                    </a>
                                    <form action="{{ route('dashboard.laporan.destroy', $laporan->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors shadow-sm group-has-hover:scale-110"
                                            title="Hapus Laporan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <script>
        document.getElementById('desaSearch').addEventListener('input', function (e) {
            const searchText = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cityName = row.querySelector('td:first-child').textContent.toLowerCase();
                const kecamatan = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (cityName.includes(searchText) || kecamatan.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-layouts.admin>