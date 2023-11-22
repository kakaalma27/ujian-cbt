<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersKelas extends Model
{
    protected $fillable = [
        'kelas_id',
        'user_id',
        'nama_kelas',
    ];
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
