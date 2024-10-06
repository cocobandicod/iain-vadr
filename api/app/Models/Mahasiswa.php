<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'id_fakultas',
        'id_prodi',
        'nim',
        'nama_mahasiswa',
        'no_hp',
        'email',
        'ukt',
        'orangtua_wali',
        'no_hp_orangtua',
        'alamat',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
