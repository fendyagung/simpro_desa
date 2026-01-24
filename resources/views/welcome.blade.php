@php
    $dpmdProfile = \App\Models\DpmdProfile::first();
@endphp

<x-layouts.public>
    <!-- Hero Section -->
    <div class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.png') }}" alt="Desa Wisata Manggarai Timur"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16 overflow-hidden">
            <div class="marquee-wrapper mb-6">
                <div class="marquee-content shadow-lg shadow-emerald-500/20">
                    <span
                        class="inline-block py-2 px-6 rounded-full bg-amber-400 text-slate-900 text-lg md:text-xl font-bold border-2 border-white/50 backdrop-blur-sm">
                        Selamat Datang di Manggarai Timur • Permata Timur Flores • Surga Tersembunyi
                    </span>
                </div>
            </div>
            <h1
                class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight animate-fade-in-up delay-100">
                Jelajahi Surga Tersembunyi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Manggarai
                    Timur</span>
            </h1>
            <p
                class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl mx-auto leading-relaxed animate-fade-in-up delay-200">
                Temukan keindahan alam, kekayaan budaya, dan kearifan lokal desa-desa di Manggarai Timur.
                Platform resmi promosi dan transparansi desa.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-300">
                <a href="{{ route('public.desa-wisata') }}"
                    class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1 block sm:inline-block">
                    Mulai Menjelajah
                </a>
                <a href="{{ route('public.video-gallery') }}"
                    class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur-sm font-semibold rounded-full transition-all block sm:inline-block flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                            clip-rule="evenodd" />
                    </svg>
                    Tonton Video
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="relative -mt-20 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center border-r border-slate-100 last:border-0">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $dpmdProfile->stat_total_desa ?? '159' }}</div>
                <div class="text-sm text-slate-500 uppercase tracking-wider font-medium">Desa</div>
            </div>
            <div class="text-center border-r border-slate-100 last:border-0">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $dpmdProfile->stat_desa_wisata ?? '45' }}</div>
                <div class="text-sm text-slate-500 uppercase tracking-wider font-medium">Desa Wisata</div>
            </div>
            <div class="text-center border-r border-slate-100 last:border-0">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $dpmdProfile->stat_spot_wisata ?? '80' }}</div>
                <div class="text-sm text-slate-500 uppercase tracking-wider font-medium">Spot Wisata</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $dpmdProfile->stat_wisatawan ?? '12rb' }}</div>
                <div class="text-sm text-slate-500 uppercase tracking-wider font-medium">Wisatawan</div>
            </div>
        </div>
    </div>

    <!-- Featured Villages Section -->
    <section id="jelajah" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Destinasi Unggulan</h2>
                <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Kunjungi desa-desa yang menawarkan pengalaman tak terlupakan, mulai dari pegunungan berkabut hingga
                    pantai eksotis.
                </p>
            </div>

            @php
                $featuredDesas = \App\Models\Desa::where('is_desa_wisata', true)->latest()->take(3)->get();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredDesas as $desa)
                    <div
                        class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden">
                            @if($desa->foto_profil)
                                <img src="{{ asset('storage/' . $desa->foto_profil) }}" alt="{{ $desa->nama_desa }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale opacity-20">
                            @endif
                            <div
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800">
                                Desa Wisata
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center text-sm text-emerald-600 font-medium mb-3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $desa->kecamatan }}
                            </div>
                            <h3
                                class="text-xl font-bold text-slate-800 mb-2 group-hover:text-emerald-600 transition-colors">
                                {{ $desa->nama_desa }}
                            </h3>
                            <p class="text-slate-600 text-sm line-clamp-2 mb-6">
                                {{ $desa->deskripsi ?? 'Belum ada deskripsi profil untuk desa ini.' }}
                            </p>
                            <a href="{{ route('public.desa.profil', $desa->id) }}"
                                class="inline-flex items-center text-emerald-600 font-bold hover:underline">
                                Lihat Profil <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                        <p class="text-slate-400">Belum ada Destinasi Unggulan yang diumumkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('public.desa-wisata') }}"
                    class="inline-flex items-center px-10 py-4 bg-white border border-slate-200 shadow-sm text-sm font-bold rounded-2xl text-slate-700 hover:bg-slate-50 hover:border-emerald-500 hover:text-emerald-600 transition-all">
                    Lihat Semua Desa
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-emerald-700 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Anda Adalah Perangkat Desa?</h2>
            <p class="text-emerald-100 text-lg mb-8">
                Bergabunglah dengan SIMPRO DESA untuk mempromosikan potensi desa Anda dan mempermudah pelaporan
                administrasi ke Dinas PMD.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#"
                    class="px-8 py-4 bg-white text-emerald-800 font-bold rounded-full shadow-lg hover:bg-emerald-50 transition-all transform hover:-translate-y-1">
                    Login Sistem
                </a>
                <a href="#"
                    class="px-8 py-4 bg-transparent border-2 border-emerald-400 text-white font-bold rounded-full hover:bg-emerald-600 transition-all">
                    Hubungi Admin
                </a>
            </div>
        </div>
    </section>

    <style>
        .marquee-wrapper {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-layouts.public>