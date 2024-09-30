<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panduan extends Model
{
    use HasFactory;

    protected $table = 'panduan'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'judul_panduan',
        'youtube',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
