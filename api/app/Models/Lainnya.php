<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lainnya extends Model
{
    use HasFactory;

    protected $table = 'lainnya'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'nama_lainnya',
        'no_hp',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
