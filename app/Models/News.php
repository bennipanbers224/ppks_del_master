<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'title',
        'content',
        'foto',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Opsional: format waktu ketika dipanggil dari Blade
    public function getPublishedAtFormattedAttribute()
    {
        return Carbon::parse($this->published_at)->format('d M Y');
    }
}
