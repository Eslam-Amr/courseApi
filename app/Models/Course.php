<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['description','name','price','discount'];
    public function course()
    {
        return $this->hasOne(Wishlist::class,'course_id','id');
    }
}
