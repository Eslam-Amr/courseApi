<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id','user_id','date', 'assignment_id', 'instractor_id', 'mentor_id', 'number_of_attendance'
    ];
    public function instractor(){
        return $this->belongsTo(TechnicalEmployee::class,'instractor_id','id');
    }
    public function mentor(){
        return $this->belongsTo(TechnicalEmployee::class,'mentor_id','id');
    }
    public function group(){

        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function assignment(){
        return $this->belongsTo(Assignment::class,'assignment_id','id');
    }
}
