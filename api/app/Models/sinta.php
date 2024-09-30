<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sinta extends Model
{
    use HasFactory;

    protected $table = 'sinta'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'sinta_score',
        'y3r',
        'article',
        'citation',
        'hindex',
        'buku',
        'hki',
    ];

    public function profilPengusul()
    {
        return $this->belongsTo(ProfilPengusul::class, 'id_user', 'id_user');
    }
}
