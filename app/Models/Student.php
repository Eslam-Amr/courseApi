<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='users';
    static function boot(){
        parent::boot();
        static::addGlobalScope('user',function(Builder $bulder){
            $bulder->where('role','student');
        });
    }


    protected $guarded=[];
}
