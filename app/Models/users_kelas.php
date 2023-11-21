<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_kelas extends Model
{
    protected $fillable = [
        'kelas_id',
        'user_id',
        'nama',
        'nama_kelas'
    ];

    public function kelas()
    {
        return $this->belongsTo(users_kelas::class, 'kelas_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
