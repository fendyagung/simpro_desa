<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource (Admin View).
     */
    public function index()
    {
        $regulasis = Regulasi::latest()->get();
        return view('dashboard.regulasi.index', compact('regulasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:Format Laporan,Peraturan Daerah,Template Surat,Materi Sosialisasi,Lainnya',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240', // Max 10MB
        ]);

        $filePath = $request->file('file')->store('regulasi', 'public');

        Regulasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard.regulasi.index')->with('success', 'Dokumen berhasil diunggah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulasi $regulasi)
    {
        if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
            Storage::disk('public')->delete($regulasi->file_path);
        }

        $regulasi->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Display a listing of the resource (Public/User View).
     */
    public function publicIndex()
    {
        $regulasis = Regulasi::latest()->get()->groupBy('kategori');
        return view('public.bank-data', compact('regulasis'));
    }
}
