<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function project(){
        return $this->belongsTo(Project::class , 'projects_id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class , 'banks_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'users_id');
    }

}
