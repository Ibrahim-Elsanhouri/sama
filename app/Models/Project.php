<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
   
    ];
    public function payments(){
        return $this->hasMany(Payment::class , 'projects_id'); 
    }
    public function tasks(){
        return $this->hasMany(Task::class , 'projects_id'); 
    }
    public function user(){
        return $this->belongsTo(User::class, 'users_id'); 

    }
    public function type(){
        return $this->belongsTo(Type::class, 'users_id'); 

    }
    public function hala(){
        return $this->belongsTo(Hala::class, 'users_id'); 

    }
}
