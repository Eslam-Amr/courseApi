<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable=['course_id','user_id'];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $incrementing = false;

    protected $primaryKey = ['course_id', 'user_id'];
    public function delete()
    {
        $query = $this->newModelQuery()->where('course_id', $this->course_id)->where('user_id', $this->user_id);

        return $query->delete();
    }
}
