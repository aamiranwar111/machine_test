<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/', [TestController::class,'index'])->name('home');
 Route::post('/user_add', [TestController::class,'store_user'])->name('user_add');
 Route::get('/get_question', [TestController::class,'get_question'])->name('get_question');
 Route::post('/post_answer', [TestController::class,'post_answer'])->name('post_answer');