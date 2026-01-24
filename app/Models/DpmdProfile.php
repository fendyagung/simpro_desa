<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DpmdProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kadis',
        'foto_kadis',
        'logo_website',
        'sambutan_judul',
        'sambutan_teks',
        'visi',
        'misi',
        'nama_sekretaris',
        'nama_kabid_pemberdayaan',
        'nama_kabid_pemerintahan',
        'nama_kabid_ekonomi',
        'stat_total_desa',
        'stat_desa_wisata',
        'stat_spot_wisata',
        'stat_wisatawan',
        'video_promo_url',
    ];
}
