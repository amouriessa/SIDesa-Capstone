<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Birth extends Model
{
    use HasFactory;

    protected $table = 'births';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor_surat',
        'nama_anak',
        'jenis_kelamin_anak',
        'hari_kelahiran',
        'tanggal_kelahiran',
        'tempat_kelahiran',
        'alamat_anak',
        'urutan_anak',
        'total_saudara',
        'nama_ayah',
        'alamat_ayah',
        'nama_ibu',
        'alamat_ibu',
        'foto_persyaratan',
        'status_data',
        'alasan_gagal',
        'foto_kk',
        'foto_akta_lahir',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_kelahiran' => 'date',
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
