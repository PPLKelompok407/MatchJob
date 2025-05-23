<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';
    
    protected $fillable = [
        'nama',
        'alamat',
        'bagian',
        'location_type',
        'start_date',
    ];
} 