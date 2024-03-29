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
    public function session(){
        return $this->hasMany(Session::class);
    }
    public function assignment(){
        return $this->hasMany(Assignment::class);
    }
}
