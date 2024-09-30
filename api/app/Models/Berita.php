<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory;

    use Sluggable;

    protected $table = 'berita'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id_user',
        'judul_berita',
        'judul_seo',
        'tgl_berita',
        'jam_berita',
        'isi_berita',
        'image',
    ];

    protected $dates = [
        'tgl_berita',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function sluggable(): array
    {
        return [
            'judul_seo' => [
                'source' => 'judul_berita'
            ]
        ];
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/berita/' . $image),
        );
    }
}
