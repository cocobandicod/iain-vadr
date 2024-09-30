<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institusi extends Model
{
    use HasFactory;

    protected $table = 'institusi'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'nama',
        'alamat',
        'kode_pos',
        'telepon',
        'fax',
        'surel',
        'website',
    ];

    protected $hidden = [
        'id',
    ];

    public function profilPengusul()
    {
        return $this->hasMany(ProfilPengusul::class, 'id_institusi');
    }
}
