<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'item',
        'deskripsi',
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
