<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table="cms_users"; 


    public function sender(){
        return $this->hasMany(Task::class , 'from'); 
    }
    public function receiver(){
        return $this->hasMany(Task::class , 'to'); 
    }
}
