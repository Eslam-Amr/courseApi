<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
class Empolyee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];

// public function employee()
// {
//     return $this->hasMany(User::class,'user_id','id');
// }
}
