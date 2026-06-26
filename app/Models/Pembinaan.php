<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    use HasFactory;
    protected $fillable = ['umkm_id', 'judul_pembinaan', 'tanggal', 'deskripsi', 'hasil'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
