<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'documents';

    // Primary Key yang digunakan
    protected $primaryKey = 'document_id';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'title',
        'file_path',
    ];

    // Jika tabel menggunakan timestamps
    public $timestamps = true;
}
