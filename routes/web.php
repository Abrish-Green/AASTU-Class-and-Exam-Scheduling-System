<?php

use Illuminate\Support\Facades\Route;

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
});

Route::get('/exam',[\App\Http\Controllers\API\logic\exam\ExamScheduleController::class,'MakeFinalExamSchedule']);

Route::get('/room',[\App\Http\Controllers\API\logic\exam\ExamScheduleController::class,'AssignRoom']);


Route::get('/class',[\App\Http\Controllers\API\logic\class\ClassScheduleController::class,'MakeClassSchedule']);

Route::get('/sas',[\App\Http\Controllers\API\logic\exam\ExamScheduleController::class,'AssignRoom']);
