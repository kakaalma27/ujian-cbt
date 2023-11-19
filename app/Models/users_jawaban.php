<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class users_jawaban extends Model
{
    protected $table = "users_jawabans";

    protected $fillable = [
        'user_id',
        'soal_id',
        'jawaban_id',
        'hasil',
        'hasil_detail',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Soal()
    {
        return $this->belongsTo(soal::class, 'soal_id', 'id');
    }

    public function Jawaban()
    {
        return $this->belongsTo(jawaban::class, 'jawaban_id', 'id');
    }
}
