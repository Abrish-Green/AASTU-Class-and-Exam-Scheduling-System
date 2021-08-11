<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Registrar Routes
//------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//Public
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::prefix('registrar')->group(function () {
    Route::post('sign-up',[\App\Http\Controllers\API\Admin\AdminController::class,'register']);
    Route::post('login',[\App\Http\Controllers\API\Admin\AdminController::class,'login']);
});

//Protected
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->prefix('admin')->group(function(){
    Route::get('/user',[\App\Http\Controllers\API\Admin\AdminController::class,'admin']);
    Route::post('/logout',[\App\Http\Controllers\API\Admin\AdminController::class,'logout']);
});






//College Routes
//------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//Public
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::prefix('college')->group(function () {
    Route::post('sign-up',[\App\Http\Controllers\API\Privates\college\CollegeUserController::class,'register']);
    Route::post('login',[\App\Http\Controllers\API\Privates\college\CollegeUserController::class,'login']);
});

//Protected
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->prefix('college')->group(function(){
    Route::apiResource('/user', App\Http\Controllers\API\Privates\college\CollegeAccountController::class);
    Route::get('/current',[App\Http\Controllers\API\Privates\college\CollegeUserController::class,'currentCollegeUser']);
    Route::post('/logout',[\App\Http\Controllers\API\Privates\college\CollegeUserController::class,'logout']);
});








//Department Routes
//------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//Public
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::prefix('department')->group(function () {
    Route::post('sign-up',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'register']);
    Route::post('login',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'login']);
});

//Protected
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->prefix('department')->group(function(){
    Route::get('/current',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'currentDepartmentUser']);
    Route::apiResource('/user',\App\Http\Controllers\Api\Privates\department\DepartmentAccountController::class);
    Route::post('/logout',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'logout']);
});







//Department Routes
//------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//Public
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::prefix('instructor')->group(function () {
    Route::post('sign-up',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'register']);
    Route::post('login',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'login']);
});

//Protected
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->prefix('instructor')->group(function(){
    Route::get('/user',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'currentUser']);
    Route::put('/update/{id}',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'update']);
    Route::delete('/delete/{id}',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'delete']);
    Route::post('/logout',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'logout']);
});
