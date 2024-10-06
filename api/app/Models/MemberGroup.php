<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberGroup extends Model
{
    use HasFactory;

    protected $table = 'member_group'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id_group',
        'nama',
        'no_hp',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
