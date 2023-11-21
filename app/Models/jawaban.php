<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    protected $table = 'jawabans';
    protected $fillable = ['soal_id', 'isi_jawaban', 'is_correct'];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }
    
}
