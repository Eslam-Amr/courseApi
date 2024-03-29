<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','session_id','evaluation'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function session(){
        return $this->belongsTo(Session::class,'session_id','id');
    }
}
