<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTechnicalEmployee extends Model
{
    use HasFactory;
    protected $fillable = ['technical_employee_id', 'group_id'];
    protected $table='group_technical_employee';
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function technicalEmployee(){
        return $this->belongsTo(TechnicalEmployee::class);
    }
}
