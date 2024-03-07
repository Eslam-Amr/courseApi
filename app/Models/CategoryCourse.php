<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    use HasFactory;
    protected $fillable=['course_id','category_id'];
protected $table='category_course';
// public function category(){
//     return $this->belongsTo(Category::class,'category_id','id');
// }
}
