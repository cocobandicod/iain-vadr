<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilPengusul extends Model
{
    use HasFactory;

    protected $table = 'profil_pengusul'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id_user',
        'nidn',
        'klaster',
        'program_studi',
        'jenjang_pendidikan',
        'jabatan_akademik',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'no_ktp',
        'no_telepon',
        'no_hp',
        'alamat_surel',
        'website_personal',
    ];

    protected $hidden = [
        'id_user',
        'id_institusi',
    ];

    protected $dates = [
        'tanggal_lahir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function institusi()
    {
        return $this->belongsTo(Institusi::class, 'id_institusi');
    }

    public function sinta()
    {
        //return $this->belongsTo(Sinta::class, 'id_user');
        return $this->hasOne(Sinta::class, 'id_user', 'id_user');
    }
}
