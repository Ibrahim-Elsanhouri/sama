<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; 
use App\Models\Project; 

class ReportController extends Controller
{
    //
    public function report(Request $request){

//dd($request->to , $request->from );
$payments = Payment::whereBetween('payment_date', [$request->from, $request->to])->get();
$projects = Project::whereBetween('created_at', [$request->from, $request->to])->get();
//dd($payments , $projects); 
 return view('report' , compact('payments' , 'projects')); 
    }
}
