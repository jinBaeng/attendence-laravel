<?php

namespace App\Attendence\Domains\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User\Domain\Entities\User;

class Attendence extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','check','reason','created_at'];
    protected $primaryKey = 'id';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function penalty(){
        return $this->hasOne(penalty::class,'attendence_id','id');
    }
}
