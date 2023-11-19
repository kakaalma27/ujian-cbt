<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
  
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    /**
     * @param  integer  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "guru", "admin"][$value],
        );
    }
    

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }

    public function usersJawabans()
    {
        return $this->belongsTo(UsersJawaban::class, 'user_jawaban_id', 'id');
    }

}