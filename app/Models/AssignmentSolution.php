<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSolution extends Model
{
    use HasFactory;
    protected $fillable = ['solution_link', 'note', 'date', 'assignment_id', 'user_id','group_id', 'evaluation'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // public function session(){
    //     return $this->belongsTo(Session::class,'session_id','id');
    // }
    public function group(){
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }
}
