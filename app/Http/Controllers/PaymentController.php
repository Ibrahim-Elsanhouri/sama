<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; 

class PaymentController extends Controller
{
    //
    public function show($id){
    $payment = Payment::find($id);
    return view('invoice' , compact('payment'));

    }
}
