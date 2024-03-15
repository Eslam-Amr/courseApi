<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSolution extends Model
{
    use HasFactory;
    protected $fillable = ['solution_link', 'note', 'date', 'assignment_id', 'user_id','group_id', 'evaluation'];
}
