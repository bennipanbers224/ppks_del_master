<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vidios extends Model
{
    use HasFactory;

    protected $table = 'vidios';
    protected $primaryKey = 'vidios_id';
    protected $fillable = [
        'judul',
        'keterangan',
        'link',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getEmbedLinkAttribute()
    {
        preg_match('/(?:v=)([^&]+)/', $this->link, $matches);

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }
}
