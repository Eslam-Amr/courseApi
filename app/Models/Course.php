<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['description','name','price','discount'];
    // public function rate()
    // {
    //     return $this->hasManyThrough(Course::class,Rate::class);
    // }
    public function course()
    {
        return $this->hasOne(Wishlist::class,'course_id','id');

    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}

