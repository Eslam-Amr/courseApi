<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable=['name','city'];
    // public function region()
    // {
    //     return $this->belongsTo(User::class,'region_id','id');
    // }
}
