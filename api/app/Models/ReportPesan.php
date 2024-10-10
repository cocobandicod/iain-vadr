<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportPesan extends Model
{
    use HasFactory;

    protected $table = 'report_pesan'; // Specify the table name for the model

    protected $primaryKey = 'id'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'id_group',
        'id_pesan',
        'nama',
        'no_hp',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function Lainnya()
    {
        return $this->belongsTo(Lainnya::class, 'no_hp', 'no_hp');
    }

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'no_hp', 'no_hp');
    }

    public function Dosen()
    {
        return $this->belongsTo(Dosen::class, 'no_hp', 'no_hp');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'no_hp', 'no_hp');
    }

    public function GroupPesan()
    {
        return $this->belongsTo(GroupPesan::class, 'id_group', 'id');
    }
}
