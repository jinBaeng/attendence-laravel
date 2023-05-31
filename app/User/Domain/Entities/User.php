<?php

namespace App\User\Domain\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Penalty\Domains\Entities\Penalty;
use App\Attendence\Domains\Entities\Attendence;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

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
