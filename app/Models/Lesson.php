<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'video_url', // Link Youtube atau File Upload
        'content_text', // Jika materi berupa teks bacaan
        'file_attachment', // Modul 7: Upload File (PDF/Doc)
        'type', // video, text, document
        'sort_order',
        'is_preview' // Apakah bisa ditonton gratis sebelum beli?
    ];

    // Relasi: Materi milik 1 Modul
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
