<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function project(){
        return $this->belongsTo(Project::class , 'projects_id');
    }
    public function from_user(){
        return $this->belongsTo(User::class , 'from');
    }
    public function to_user(){
        return $this->belongsTo(User::class , 'to');
    }
}
