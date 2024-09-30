<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilLembaga extends Model
{
    use HasFactory;

    protected $table = 'profil_lembaga'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'no_sk',
        'nama_lembaga',
        'alamat_lembaga',
        'no_telepon',
        'no_fax',
        'email',
        'website',
        'nama_jabatan',
        'nidn_pimpinan',
        'nama_pimpinan',
    ];
}
