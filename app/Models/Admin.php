<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'cms_users';
   // public function projects(){
     //   return $this->hasMany(Project::class , 'from'); 
   // }


   
}
