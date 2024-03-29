<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];


    // static function boot(){
    //     parent::boot();
    //     static::addGlobalScope('user',function(Builder $bulder){
    //         $bulder->where('role','student');
    //     });
    // }
    public function employee()
    {
        return $this->hasOne(Empolyee::class,'user_id','id');
    }

    public function technicalEmployees()
    {
        return $this->hasOne(TechnicalEmployee::class,'user_id','id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
    public function group(){

        return $this->belongsToMany(Group::class);
}
    protected $guarded=[];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
