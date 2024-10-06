<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupPesan extends Model
{
    use HasFactory;

    protected $table = 'group_pesan'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'nama_group',
        'kategori',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
