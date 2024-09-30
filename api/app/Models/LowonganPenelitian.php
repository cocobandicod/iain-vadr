<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganPenelitian extends Model
{
    use HasFactory;

    protected $table = 'lowongan_penelitian'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'tahun_anggaran',
        'jenis',
        'quota',
        'pengusul',
        'diterima',
        'total_dana',
        'tgl_berakhir',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
