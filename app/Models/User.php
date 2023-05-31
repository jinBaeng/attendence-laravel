<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
// use Laravel\Sanctum\HasApiTokens;
// use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'studentID',
        'password',
        'group',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function attendences()
    {
        return $this->hasMany(Attendence::class,'user_id','id');
    }
    public function penalties(){
        return $this->hasMany(Penalty::class,'user_id','id');
    }
    public function findForPassport($username){
        return $this->where('id', $username)->first();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $primaryKey = 'id';
    protected $keyType = 'string';

}
