<?php

namespace App\Penalty\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    protected $flillable = ['user_id','attendence_id','clear','image'];
    protected $primaryKey = 'id';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function attendence(){
        return $this->belongsTo(Attendence::class,'attendence_id','id');
    }
}
