<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke dokumen
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }

    // Hitung jumlah dokumen
    public function getDokumenCountAttribute()
    {
        return $this->dokumen()->count();
    }

    // Scope untuk user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
