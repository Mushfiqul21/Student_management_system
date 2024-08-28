<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['prefix'=>'student', 'as'=>'student.'],function(){
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::post('store', [StudentController::class, 'store'])->name('store');
    Route::get('edit', [StudentController::class, 'edit'])->name('edit');
    Route::post('update/{id?}', [StudentController::class, 'update'])->name('update');
    Route::get('view/{id?}', [StudentController::class, 'view'])->name('view');
    Route::get('delete/{id?}', [StudentController::class, 'delete'])->name('delete');
});

