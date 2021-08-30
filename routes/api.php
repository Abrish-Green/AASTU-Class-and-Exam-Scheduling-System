<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


//ResetEmail
//-----------------



//Registrar Routes
//------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
//Public
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------

Route::prefix('registrar')->middleware(['cors'])->group(function () {
    Route::post('sign-up',[\App\Http\Controllers\API\Admin\AdminController::class,'register']);
    Route::post('login',[\App\Http\Controllers\API\Admin\AdminController::class,'login']);
    Route::post('reset',[\App\Http\Controllers\API\Admin\AdminController::class,'resetPassword']);
    //logged
    Route::get('/colleges',[\App\Http\Controllers\API\privates\college\CollegeAccountController::class,'index']);
    Route::post('/colleges/delete/{id}',[\App\Http\Controllers\API\privates\college\CollegeAccountController::class,'destroy']);
    Route::post('/create-college',[\App\Http\Controllers\API\privates\college\CollegeAccountController::class,'store']);
    Route::post('/create-college-user',[\App\Http\Controllers\API\privates\college\CollegeUserController::class,'register']);
    Route::post('/create-college-user-email',[\App\Http\Controllers\API\privates\college\CollegeUserController::class,'sendEmailToCollege']);

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

    Route::post('updates',[ App\Http\Controllers\API\Privates\college\CollegeUserController::class,'DeanUpdater']);
    Route::post('/department/edit/{id}',[ App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'update']);
    Route::post('reset',[ App\Http\Controllers\API\Privates\college\CollegeUserController::class,'reset']);
    Route::post('departments',[ App\Http\Controllers\API\Privates\college\CollegeAccountController::class,'index']);
    Route::post('create-department',[ App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'store']);
    Route::post('create-department-user',[ App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'register']);
    Route::post('create-college-user-email',[ App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'send_email_to_head']);
    Route::post('/delete/{id}',[ App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'destroy']);
    Route::get('/{id}/departments/',[ App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'getMyDepartment']);
    Route::post('/department/heads',[ App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'getMyDepartmentHeads']);
    Route::post('/department/head/edit/{id}',[ App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'edit']);
    Route::get('/department/{id}',[ App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'show']);

    Route::post('/department-head/delete/{id}',[ App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'destroy']);



    Route::post('login',[\App\Http\Controllers\API\Privates\college\CollegeUserController::class,'login']);
});

//Protected
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->prefix('college')->group(function(){

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
    Route::post('complete_info',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'update']);
    Route::post('reset',[\App\Http\Controllers\API\Privates\department\DepartmentUserController::class,'reset']);

    Route::post('/edit/{id}',[\App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'update']);
    Route::post('/create-instructor',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'register']);
    Route::post('/create-instructor-email',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'send_email_to_instructor']);



    Route::get('/account/{id}',[\App\Http\Controllers\API\Privates\department\DepartmentAccountController::class,'show']);
    Route::post('/instructor/delete/{id}',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'destroy']);
    Route::post('/instructor/edit/{id}',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'update']);
    Route::get('/{id}/instructors',[\App\Http\Controllers\API\Privates\instructor\InstructorUserController::class,'getMyInstructors']);





    Route::post('/block/add',[\App\Http\Controllers\API\Privates\placement\PlacementController::class,'addBlock']);
    Route::post('/room/add',[\App\Http\Controllers\API\Privates\placement\PlacementController::class,'addRoom']);
    Route::post('/room/generate',[\App\Http\Controllers\API\Privates\placement\PlacementController::class,'GenerateRoomsForBlock']);
    Route::post('/class/add',[\App\Http\Controllers\API\Privates\placement\PlacementController::class,'addClass']);

    Route::post('/year/add',[\App\Http\Controllers\API\Privates\time\TimeController::class,'addYear']);
    Route::post('/semester/add',[\App\Http\Controllers\API\Privates\time\TimeController::class,'addSemester']);
    Route::post('/day/add',[\App\Http\Controllers\API\Privates\time\TimeController::class,'addDay']);
    Route::post('/timeslot/add',[\App\Http\Controllers\API\Privates\time\TimeController::class,'addTimeslot']);
    Route::post('/timeslot_data/add',[\App\Http\Controllers\API\Privates\time\TimeController::class,'addTimeslotData']);









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



Route::get('/sendbasicemail',[\App\Http\Controllers\MailController::class,'basic_email']);
Route::get('/sendhtmlemail',[\App\Http\Controllers\MailController::class,'html_email']);
Route::get('/sendattachmentemail',[\App\Http\Controllers\MailController::class,'attachment_email']);

