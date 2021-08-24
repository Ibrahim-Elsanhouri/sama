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
    public function from(){
        return $this->belongsTo('App\Models\Admin', 'from');
    }
  // public function to(){
    //    return $this->belongsTo('App\Models\Admin' , 'to');
   // }
}
