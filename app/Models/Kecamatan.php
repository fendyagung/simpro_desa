<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['nama'];

    /**
     * Get the desas for the kecamatan.
     */
    public function desas()
    {
        return $this->hasMany(Desa::class, 'kecamatan', 'nama');
    }
}
