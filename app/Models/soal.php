<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table = "soals";

    protected $fillable = [
        'user_id',
        'kelas_id',
        'pelajaran_id',
        'isi_soal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id','id');
    }

    public function jawaban()
{
    return $this->belongsTo(jawaban::class, 'soal_id', 'id');
}

}
