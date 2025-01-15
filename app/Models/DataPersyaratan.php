<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPersyaratan extends Model
{
    protected $table = 'data_persyaratan';

    use HasFactory;

    protected $fillable = [
        'tentang_website',
        'persyaratan_kelahiran',
        'persyaratan_kematian',
        'gambar_lp',
    ];
}
