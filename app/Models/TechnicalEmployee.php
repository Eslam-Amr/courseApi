<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

class TechnicalEmployee extends Model
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    protected $guarded=[];
    // protected $table='technical_employees';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function group(){
        return $this->belongsToMany(Group::class);
    }

}
