<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function done(){
        $task = Task::find($id); 
        $task->done = 1; 
        $task->save(); 
        return back(); 
    }
}
