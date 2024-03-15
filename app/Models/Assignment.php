<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = ['type','course_id','file','descreption','start_date','dead_line','group_id'];
    public function assignmentSolution(){
        return $this->hasMany(AssignmentSolution::class);
    }
}
