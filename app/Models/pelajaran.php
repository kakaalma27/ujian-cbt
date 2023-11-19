<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    
    protected $fillable = ['user_id', 'pelajaran', 'kode_akses'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
