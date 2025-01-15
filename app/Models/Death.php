<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;

    protected $table = 'deaths';

    protected $fillable = [
        'nomor_surat_kematian',
        'nama_alm',
        'jenis_kelamin_alm',
        'alamat_alm',
        'hari_kematian',
        'tanggal_kematian',
        'pukul_kematian',
        'tempat_kematian',
        'penyebab_kematian',
        'umur_almarhum',
        'alasan_gagal',
        'foto_kk',
        'foto_ktp',
        'status_data',
        'created_by',
    ];

    protected $casts = [
        'tanggal_kematian' => 'date',
        'status_data' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by',  'id')->withDefault();
    }
}
