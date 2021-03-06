<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];   
    // public $timestamps = true; 

    public function project(){
        return $this->belongsTo(Project::class , 'projects_id');
    }
    public function sender(){
        return $this->belongsTo(Admin::class, 'from');
    }
  // public function to(){
    //    return $this->belongsTo('App\Models\Admin' , 'to');
   // }
}
