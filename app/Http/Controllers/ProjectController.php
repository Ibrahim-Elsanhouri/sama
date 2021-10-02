<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
class ProjectController extends Controller
{
    //
    public function task(Request $request){
    //     dd($request->all()); 
         Task::create($request->all());
         return back(); 
    }
}
