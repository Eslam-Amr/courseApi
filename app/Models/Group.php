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
}
