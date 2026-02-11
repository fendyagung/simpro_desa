<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
<x-layouts.public>
    <div class="py-24 min-h-screen transition-colors duration-300" style="background-color: #f8fafc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="w-full lg:w-64 flex-shrink-0">
                    <div class="rounded-2xl shadow-sm overflow-hidden sticky top-28 transition-all duration-300 border border-slate-200"
                        style="background-color: #ffffff;">

                        <!-- User Profile Section -->
                        <div class="p-6 flex items-center gap-3 border-b border-slate-100">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center overflow-hidden border border-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-sm font-bold truncate text-slate-800">{{ Auth::user()->name }}</p>
                            </div>
                        </div>

                        <div class="p-4">
                            <nav class="space-y-4">
                                @php
                                    $userId = Auth::id();
                                    $newRegulasiCount = \App\Models\Regulasi::where('created_at', '>=', now()->subDays(7))
                                        ->whereDoesntHave('downloads', function ($query) use ($userId) {
                                            $query->where('user_id', $userId);
                                        })
                                        ->count();

                                    $isProfilActive = Request::is('dashboard/dpmd/edit-profil', 'dashboard/profil-desa/edit', 'dashboard/dpmd/desa*');
                                    $isKontenActive = Request::is('dashboard/beritas*', 'dashboard/potensi*', 'layanan/galeri-video*');
                                    $isAdminActive = Request::is('dashboard/regulasi*', 'dashboard/dokumen*', 'dashboard/laporan/buat', 'dashboard/pengumuman*');
                                @endphp

                                <!-- Grup 1: Utama -->
                                <div>
                                    <a href="{{ route('dashboard') }}"
                                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Dashboard</span>
                                    </a>
                                </div>

                                <!-- Grup 2: Profil & Instansi -->
                                <div>
                                    <button type="button"
                                        class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl transition-all text-left"
                                        style="{{ $isProfilActive ? 'color: #2b529a; font-weight: 700;' : 'color: #64748b;' }}"
                                        onclick="toggleAccordion('profil-menu', this)">
                                        <div class="flex items-center gap-3">
                                            <div class="w-5 flex justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                            <span class="text-sm">Profil & Instansi</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform duration-200 {{ $isProfilActive ? 'rotate-180' : '' }}"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="profil-menu"
                                        class="mt-1 space-y-1 pl-12 {{ $isProfilActive ? '' : 'hidden' }}">
                                        @if(Auth::user()->role === 'admin_dpmd')
                                            <a href="{{ route('dashboard.dpmd.edit-profil') }}"
                                                class="block py-2 text-xs transition-colors {{ Request::is('dashboard/dpmd/edit-profil') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Profil
                                                Website</a>
                                            <a href="{{ route('dashboard.dpmd.desa.index') }}"
                                                class="block py-2 text-xs transition-colors {{ Request::is('dashboard/dpmd/desa*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Data
                                                Desa</a>
                                        @endif
                                        @if(Auth::user()->role === 'admin_desa')
                                            <a href="{{ route('dashboard.desa.edit') }}"
                                                class="block py-2 text-xs transition-colors {{ Request::is('dashboard/profil-desa/edit') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Profil
                                                Desa</a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Grup 3: Kelola Konten -->
                                <div>
                                    <button type="button"
                                        class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl transition-all text-left"
                                        style="{{ $isKontenActive ? 'color: #2b529a; font-weight: 700;' : 'color: #64748b;' }}"
                                        onclick="toggleAccordion('konten-menu', this)">
                                        <div class="flex items-center gap-3">
                                            <div class="w-5 flex justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                            <span class="text-sm">Kelola Konten</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform duration-200 {{ $isKontenActive ? 'rotate-180' : '' }}"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="konten-menu"
                                        class="mt-1 space-y-1 pl-12 {{ $isKontenActive ? '' : 'hidden' }}">
                                        <a href="{{ route('dashboard.beritas.index') }}"
                                            class="block py-2 text-xs transition-colors {{ Request::is('dashboard/beritas*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Kelola
                                            Berita</a>
                                        <a href="{{ route('dashboard.potensi.index') }}"
                                            class="block py-2 text-xs transition-colors {{ Request::is('dashboard/potensi*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Potensi
                                            Wisata</a>
                                        <a href="{{ route('public.video-gallery') }}"
                                            class="block py-2 text-xs transition-colors {{ Request::is('layanan/galeri-video') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Galeri
                                            Video</a>
                                    </div>
                                </div>

                                <!-- Grup 4: Administrasi & Surat -->
                                <div>
                                    <button type="button"
                                        class="flex items-center justify-between w-full px-4 py-2.5 rounded-xl transition-all text-left"
                                        style="{{ $isAdminActive ? 'color: #2b529a; font-weight: 700;' : 'color: #64748b;' }}"
                                        onclick="toggleAccordion('admin-menu', this)">
                                        <div class="flex items-center gap-3">
                                            <div class="w-5 flex justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                                </svg>
                                            </div>
                                            <span class="text-sm">Administrasi & Surat</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform duration-200 {{ $isAdminActive ? 'rotate-180' : '' }}"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="admin-menu"
                                        class="mt-1 space-y-1 pl-12 {{ $isAdminActive ? '' : 'hidden' }}">
                                        <a href="{{ route('dashboard.regulasi.index') }}"
                                            class="flex justify-between items-center py-2 text-xs transition-colors {{ Request::is('dashboard/regulasi*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">
                                            <span>Surat & Regulasi</span>
                                            @if($newRegulasiCount > 0 && Auth::user()->role === 'admin_desa')
                                                <span
                                                    class="bg-red-500 text-white text-[9px] px-1.5 py-0.5 rounded-full">{{ $newRegulasiCount }}</span>
                                            @endif
                                        </a>
                                        <a href="{{ route('dashboard.dokumen.index') }}"
                                            class="flex justify-between items-center py-2 text-xs transition-colors {{ Request::is('dashboard/dokumen*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">
                                            <span>Kotak Berkas</span>
                                            @php
                                                if (Auth::user()->role === 'admin_dpmd') {
                                                    $unreadCount = \App\Models\Dokumen::where('is_read', false)
                                                        ->where(function ($q) {
                                                            $q->whereHas('receiverUser', function ($inner) {
                                                                $inner->where('role', 'admin_dpmd');
                                                            })->orWhere('receiver_user_id', Auth::id());
                                                        })
                                                        ->where('sender_id', '!=', Auth::id())
                                                        ->count();
                                                } else {
                                                    $unreadCount = \App\Models\Dokumen::where('is_read', false)
                                                        ->where('receiver_desa_id', function ($q) {
                                                            $q->select('id')->from('desas')->where('user_id', Auth::id())->limit(1);
                                                        })
                                                        ->count();
                                                }
                                            @endphp
                                            @if($unreadCount > 0)
                                                <span
                                                    class="bg-blue-500 text-white text-[9px] px-1.5 py-0.5 rounded-full">{{ $unreadCount }}</span>
                                            @endif
                                        </a>
                                        @if(Auth::user()->role === 'admin_desa')
                                            <a href="{{ route('dashboard.laporan.buat') }}"
                                                class="block py-2 text-xs transition-colors {{ Request::is('dashboard/laporan/buat') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Buat
                                                Laporan</a>
                                        @endif
                                        @if(Auth::user()->role === 'admin_dpmd')
                                            <a href="{{ route('pengumuman.index') }}"
                                                class="block py-2 text-xs transition-colors {{ Request::is('dashboard/pengumuman*') ? 'text-[#2b529a] font-bold' : 'text-slate-500 hover:text-[#2b529a]' }}">Broadcast
                                                Info</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all text-left group"
                                            style="color: #ef4444;" onmouseover="this.style.backgroundColor='#fef2f2';"
                                            onmouseout="this.style.backgroundColor='transparent';">
                                            <div class="w-5 flex justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </div>
                                            <span class="text-sm">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1">
                    <!-- Session Alerts -->
                    @if(session('success'))
                        <div class="mb-6 p-4 border rounded-2xl flex items-center gap-3 shadow-sm"
                            style="background-color: #f0fdf4; border-color: #dcfce7; color: #166534;">
                            <div class="p-2 rounded-lg" style="background-color: #dcfce7;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="mb-6 p-4 border rounded-2xl flex items-center gap-3 shadow-sm"
                            style="background-color: #fff1f2; border-color: #ffe4e6; color: #9d174d;">
                            <div class="p-2 rounded-lg" style="background-color: #ffe4e6;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-sm">{{ session('warning') }}</p>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleAccordion(menuId, button) {
            const menu = document.getElementById(menuId);
            const icon = button.querySelector('svg:last-child');

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
</x-layouts.public>