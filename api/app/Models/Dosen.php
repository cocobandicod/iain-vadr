<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'id_fakultas',
        'id_prodi',
        'nidn',
        'nama_dosen',
        'no_hp',
        'jabatan',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
