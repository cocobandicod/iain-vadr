<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id_user',
        'judul_pengumuman',
        'tgl_pengumuman',
        'isi_pengumuman',
        'file_pengumuman',
    ];

    protected $dates = [
        'tgl_pengumuman',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    protected function filePengumuman(): Attribute
    {
        return Attribute::make(
            get: fn ($filePengumuman) => url('/storage/pengumuman/' . $filePengumuman),
        );
    }
}
