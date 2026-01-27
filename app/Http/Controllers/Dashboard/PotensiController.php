<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use App\Models\PotensiGallery;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PotensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin_dpmd') {
            $potensis = Potensi::with(['desa', 'galleries'])->latest()->paginate(10);
        } else {
            $desa = Desa::where('user_id', $user->id)->first();
            $potensis = Potensi::where('desa_id', $desa->id ?? 0)->with('galleries')->latest()->paginate(10);
        }

        return view('dashboard.potensi.index', compact('potensis'));
    }

    public function create()
    {
        return view('dashboard.potensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_potensi' => 'required|string|max:255',
            'kategori' => 'required|in:kuliner,kerajinan,event,alam,budaya,lainnya',
            'deskripsi' => 'required|string',
            'foto_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'gallery_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $desa = Desa::where('user_id', $user->id)->first();

        if (!$desa && $user->role !== 'admin_dpmd') {
            return redirect()->back()->with('error', 'Desa belum terdaftar.');
        }

        $potensi = new Potensi($request->only(['nama_potensi', 'kategori', 'deskripsi', 'lokasi']));
        $potensi->desa_id = $desa->id ?? null;

        if ($request->hasFile('foto_utama')) {
            $potensi->foto_utama = $request->file('foto_utama')->store('potensi-foto', 'public');
        }

        $potensi->save();

        // Handle Gallery Photos
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $photo) {
                $path = $photo->store('potensi-gallery', 'public');
                PotensiGallery::create([
                    'potensi_id' => $potensi->id,
                    'foto' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.potensi.index')->with('success', 'Potensi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $potensi = Potensi::with('galleries')->findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin_dpmd') {
            $desa = Desa::where('user_id', $user->id)->first();
            if ($potensi->desa_id !== ($desa->id ?? 0)) {
                abort(403);
            }
        }

        return view('dashboard.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, $id)
    {
        $potensi = Potensi::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin_dpmd') {
            $desa = Desa::where('user_id', $user->id)->first();
            if ($potensi->desa_id !== ($desa->id ?? 0)) {
                abort(403);
            }
        }

        $request->validate([
            'nama_potensi' => 'required|string|max:255',
            'kategori' => 'required|in:kuliner,kerajinan,event,alam,budaya,lainnya',
            'deskripsi' => 'required|string',
            'foto_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'gallery_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $potensi->fill($request->only(['nama_potensi', 'kategori', 'deskripsi', 'lokasi']));

        if ($request->hasFile('foto_utama')) {
            if ($potensi->foto_utama) {
                Storage::disk('public')->delete($potensi->foto_utama);
            }
            $potensi->foto_utama = $request->file('foto_utama')->store('potensi-foto', 'public');
        }

        $potensi->save();

        // Handle Gallery Photos
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $photo) {
                $path = $photo->store('potensi-gallery', 'public');
                PotensiGallery::create([
                    'potensi_id' => $potensi->id,
                    'foto' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.potensi.index')->with('success', 'Potensi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $potensi = Potensi::with('galleries')->findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin_dpmd') {
            $desa = Desa::where('user_id', $user->id)->first();
            if ($potensi->desa_id !== ($desa->id ?? 0)) {
                abort(403);
            }
        }

        if ($potensi->foto_utama) {
            Storage::disk('public')->delete($potensi->foto_utama);
        }

        foreach ($potensi->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->foto);
        }

        $potensi->delete();

        return redirect()->route('dashboard.potensi.index')->with('success', 'Potensi berhasil dihapus.');
    }

    public function destroyGallery($id)
    {
        $gallery = PotensiGallery::findOrFail($id);
        $potensi = Potensi::findOrFail($gallery->potensi_id);
        $user = Auth::user();

        if ($user->role !== 'admin_dpmd') {
            $desa = Desa::where('user_id', $user->id)->first();
            if ($potensi->desa_id !== ($desa->id ?? 0)) {
                abort(403);
            }
        }

        Storage::disk('public')->delete($gallery->foto);
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
