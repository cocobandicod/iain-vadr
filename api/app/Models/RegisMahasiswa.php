<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
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
        'id',
        'id_fakultas',
        'id_prodi',
        'no_hp',
        'email',
        'ukt',
        'orangtua_wali',
        'no_hp_orangtua',
        'alamat',
        'created_at',
        'updated_at'
    ];
}
