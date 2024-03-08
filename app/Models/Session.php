<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
protected $fillable=[
    'group_id',
    'user_id',
 'date'




,'assignment_id'
,'instractor_id'
,'mentor_id'
,'number_of_attendance'
];
}

