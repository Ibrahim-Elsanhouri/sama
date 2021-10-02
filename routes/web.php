<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('welcome');
     // This  $data array will be passed to our PDF blade
   //  $data = [
     //   'title' => 'First PDF for Medium',
 /*       'heading' => 'Hello from 99Points.info',
        'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.  standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'        
          ];
      
      $pdf = PDF::loadView('pdf_view', $data);  
      return $pdf->download('medium.pdf'); */ 
});


Route::get('/pdf', function () {
	$data = "ابراهيم";
	$pdf = PDF::loadView('pdf.doc', compact('data'));
	return $pdf->stream('document.pdf');
  

});
Route::get('/invoice/{id}',[PaymentController::class, 'show'])->name('invoice');
Route::get('/user/statement/{id}',[UserController::class, 'statement'])->name('user.statement');
Route::get('/report',[ReportController::class, 'report'])->name('report');
Route::get('/task/{id}/done',[TaskController::class, 'done'])->name('task.done');
Route::post('/projects/task',[ProjectController::class, 'task'])->name('project.task');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
