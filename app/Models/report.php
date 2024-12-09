<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'report_id';
    protected $fillable = [
        'name',
        'status',
        'incident_date',
        'incident_desc',
        'report_status',
        'evidence'
    ];

    public $timestamps = true;
}
