<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'id_fakultas',
        'id_prodi',
        'nip',
        'nama_pegawai',
        'no_hp',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
