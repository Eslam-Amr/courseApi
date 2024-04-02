<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'course_id',
        'start_date',
        'end_date',
        'max_student',
        'registered_student'
    ];
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public function mentor(){
        // return $this->belongsToMany(TechnicalEmployee::class,'group_technical_employee');
        return $this->belongsToMany(TechnicalEmployee::class, 'group_technical_employee')
        ->where('role', 'mentor');
    }
    public function instractor(){
        return $this->belongsToMany(TechnicalEmployee::class, 'group_technical_employee')
        ->where('role', 'instractor');
        // return $this->belongsToMany(TechnicalEmployee::class);
    }
    public function session(){
        return $this->hasMany(Session::class);
    }
    public function assignment(){
        return $this->hasMany(Assignment::class);
    }
}
