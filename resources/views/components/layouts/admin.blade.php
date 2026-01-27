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
                            <h2 class="px-3 mb-2 font-bold uppercase tracking-wider text-[10px] text-slate-400">Menu
                                Navigasi</h2>
                            <nav class="space-y-1">
                                @php
                                    $userId = Auth::id();
                                    $newRegulasiCount = \App\Models\Regulasi::where('created_at', '>=', now()->subDays(7))
                                        ->whereDoesntHave('downloads', function ($query) use ($userId) {
                                            $query->where('user_id', $userId);
                                        })
                                        ->count();
                                @endphp

                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
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

                                @if(Auth::user()->role === 'admin_dpmd')
                                    <a href="{{ route('dashboard.dpmd.edit-profil') }}"
                                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard/dpmd/edit-profil') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard/dpmd/edit-profil') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard/dpmd/edit-profil') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Profil Website</span>
                                    </a>

                                    <a href="{{ route('dashboard.dpmd.desa.index') }}"
                                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard/dpmd/desa*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard/dpmd/desa*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard/dpmd/desa*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Data Desa</span>
                                    </a>
                                @endif

                                @if(Auth::user()->role === 'admin_desa')
                                    <a href="{{ route('dashboard.desa.edit') }}"
                                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard/profil-desa/edit') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard/profil-desa/edit') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard/profil-desa/edit') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Profil Desa</span>
                                    </a>
                                @endif

                                <a href="{{ route('dashboard.beritas.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                    style="{{ Request::is('dashboard/beritas*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                    onmouseover="if(!{{ Request::is('dashboard/beritas*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                    onmouseout="if(!{{ Request::is('dashboard/beritas*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                    <div class="w-5 flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm">Kelola Berita</span>
                                </a>

                                <a href="{{ route('dashboard.potensi.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                    style="{{ Request::is('dashboard/potensi*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                    onmouseover="if(!{{ Request::is('dashboard/potensi*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                    onmouseout="if(!{{ Request::is('dashboard/potensi*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                    <div class="w-5 flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm">Potensi Wisata</span>
                                </a>

                                <a href="{{ route('dashboard.regulasi.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                    style="{{ Request::is('dashboard/regulasi*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                    onmouseover="if(!{{ Request::is('dashboard/regulasi*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                    onmouseout="if(!{{ Request::is('dashboard/regulasi*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                    <div class="w-5 flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                    </div>
                                    <div class="flex justify-between items-center w-full">
                                        <span class="text-sm">Surat & Regulasi</span>
                                        @if($newRegulasiCount > 0 && Auth::user()->role === 'admin_desa')
                                            <span
                                                class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $newRegulasiCount }}</span>
                                        @endif
                                    </div>
                                </a>

                                <a href="{{ route('dashboard.dokumen.index') }}"
                                    class="flex items-center justify-between px-4 py-3 rounded-xl transition-all"
                                    style="{{ Request::is('dashboard/dokumen*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                    onmouseover="if(!{{ Request::is('dashboard/dokumen*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                    onmouseout="if(!{{ Request::is('dashboard/dokumen*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Kotak Berkas</span>
                                    </div>
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
                                            class="bg-blue-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                                    @endif
                                </a>

                                @if(Auth::user()->role === 'admin_desa')
                                    <a href="{{ route('dashboard.laporan.buat') }}"
                                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard/laporan/buat') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard/laporan/buat') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard/laporan/buat') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Buat Laporan</span>
                                    </a>
                                @endif

                                @if(Auth::user()->role === 'admin_dpmd')
                                    <a href="{{ route('pengumuman.index') }}"
                                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                        style="{{ Request::is('dashboard/pengumuman*') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                        onmouseover="if(!{{ Request::is('dashboard/pengumuman*') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                        onmouseout="if(!{{ Request::is('dashboard/pengumuman*') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Broadcast Info</span>
                                    </a>
                                @endif

                                <div class="my-2 border-t border-slate-100"></div>

                                <a href="{{ route('public.video-gallery') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all"
                                    style="{{ Request::is('layanan/galeri-video') ? 'background-color: #2b529a; color: #ffffff; font-weight: 700;' : 'color: #64748b;' }}"
                                    onmouseover="if(!{{ Request::is('layanan/galeri-video') ? 1 : 0 }}) { this.style.backgroundColor='#f1f5f9'; this.style.color='#2b529a'; }"
                                    onmouseout="if(!{{ Request::is('layanan/galeri-video') ? 1 : 0 }}) { this.style.backgroundColor='transparent'; this.style.color='#64748b'; }">
                                    <div class="w-5 flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm">Galeri Video</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-left group"
                                        style="color: #ef4444;" onmouseover="this.style.backgroundColor='#fef2f2';"
                                        onmouseout="this.style.backgroundColor='transparent';">
                                        <div class="w-5 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </div>
                                        <span class="text-sm">Logout</span>
                                    </button>
                                </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"></script>
</x-layouts.public>