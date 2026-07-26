<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'user_id',
        'folder_id',
        'nomor_dokumen',
        'judul',
        'deskripsi',
        'file_path',
        'tanggal_dokumen',
        'versi',
        'status'
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
    ];

    /**
     * Relasi ke kategori dokumen
     */
    public function kategori()
    {
        return $this->belongsTo(JenisUsaha::class, 'kategori_id');
    }

    /**
     * Relasi ke user pengunggah
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke folder
     */
    
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * Scope untuk filter berdasarkan folder
     */
    public function scopeInFolder($query, $folderId)
    {
        return $query->where('folder_id', $folderId);
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
