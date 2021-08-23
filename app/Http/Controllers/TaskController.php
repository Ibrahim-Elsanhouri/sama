<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 

class TaskController extends Controller
{
    //
    public function done($id){
        $task = Task::find($id); 
        $task->done = 1; 
        $task->save(); 
        return back(); 
    }
}
