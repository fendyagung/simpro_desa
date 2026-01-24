<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function desaWisata()
    {
        $desas = \App\Models\Desa::where('is_desa_wisata', true)->get();
        return view('public.desa-wisata', compact('desas'));
    }

    public function showProfil($id)
    {
        $desa = \App\Models\Desa::findOrFail($id);
        return view('public.desa-profil', compact('desa'));
    }

    public function kuliner()
    {
        return view('public.kuliner');
    }

    public function kerajinan()
    {
        return view('public.kerajinan');
    }

    public function event()
    {
        return view('public.event');
    }

    public function panduan()
    {
        return view('public.panduan');
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function potensiWisata()
    {
        return view('public.potensi-wisata');
    }

    public function berita()
    {
        return view('public.berita');
    }

    public function showBerita($slug)
    {
        $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
        return view('public.berita-show', compact('berita'));
    }

    public function profil()
    {
        $profile = \App\Models\DpmdProfile::first();
        return view('public.profil', compact('profile'));
    }

    public function submitKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('pesans-lampiran', 'public');
        }

        \App\Models\Pesan::create($data);

        return back()->with('success', 'Pesan Anda telah berhasil dikirim ke Dinas PMD. Terima kasih!');
    }

    public function laporanDesa()
    {
        $dpmdProfile = \App\Models\DpmdProfile::first();

        // Stats for Charts
        $reportsByStatus = \App\Models\Laporan::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $reportsByCategory = \App\Models\Laporan::selectRaw('kategori, count(*) as count')
            ->where('status', 'diterima') // Focus public view on accepted/verified reports usually
            ->groupBy('kategori')
            ->pluck('count', 'kategori')
            ->toArray();

        return view('public.laporan', compact('dpmdProfile', 'reportsByStatus', 'reportsByCategory'));
    }

    public function videoGallery()
    {
        $dpmdProfile = \App\Models\DpmdProfile::first();
        $villages = \App\Models\Desa::whereNotNull('video_youtube')->latest()->get();
        return view('public.video-gallery', compact('dpmdProfile', 'villages'));
    }
}
