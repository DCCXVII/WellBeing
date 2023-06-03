<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GuestPageController;
use App\Http\Controllers\API\InstructorPageController;
use App\Http\Controllers\API\AdminPageController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('/change-password', 'changePassword')->middleware('auth:sanctum');
});

Route::controller(GuestPageController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/instructors', 'getInstructors');
    Route::get('/discipline', 'discipline');
    Route::get('/packs', 'getPacks');
    Route::get('/explore', 'explore');
    // Route::get('/courses/{id}', 'getCourseById');

});
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware('auth:sanctum')
    ->name('verification.verify');


Route::group(['prefix' => 'instructor', 'middleware' => ['auth:sanctum', 'role:instructor']], function () {
    Route::controller(InstructorPageController::class)->group(function () {
        Route::get('/dashbord', 'dashbord');
        Route::post('/create-course', 'createCourse');
        Route::get('/courses', 'getCourses');
        Route::get('/courses/{id}', 'getCourseById');
        Route::get('/discipline/{id}','getCoursesByDiscipline');
        Route::post('/create-pack', 'createpack');
        Route::post('/courses/{cid}/edit', 'editCourse');
        Route::put('/packs/{id}/edit', 'editPack');
        Route::get('/packs', 'getPack');
        Route::get('/packs/{id}', 'getPackById');
        Route::delete('/delete-course/{id}', 'deleteCourse');
        Route::delete('/delete-pack/{id}', 'deletePack');
        Route::get('/profile', 'getProfile');
        Route::put('/edit-profile', 'editProfile');
        //route for required password change 
        Route::post('/change-password', 'changePassword')->middleware('password.change');
    });
});

//Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::controller(AdminPageController::class)->group(function () {
        Route::get('/dashbord', 'dashbord');
        Route::get('/disciplines', 'getdisciplines');
        Route::post('/cretae-discipline', 'createDiscipline');
        Route::get('/discipline/{disciplineId}', 'getDisciplineDetails');
        Route::get('/instructors', 'getInstructor');
        Route::post('/instructors/create-instructor', 'craeteInstructor');
        Route::post('/instructors/{id}/activate-instructor', 'activateInstructor');
        Route::post('/instructors/{id}/desactivate-instructor', 'desactivateInstructor');
        Route::get('/courses', 'getCourses');
        Route::get('/courses/pending-courses', 'getPendingCourses');
        Route::post('courses/pending-courses/{courseId}/change-state', 'changeCourseState');
        Route::get('/packs', 'getPacks');
        Route::get('/packs/pending-packs', 'getPendingPacks');
        Route::post('/packs/pending-packs/{packId}/change-state', 'changePackState');
        Route::get('/client', 'getClinets');
        Route::get('/clinet/subscriber', 'getSubscriber');
    });
})->middleware('auth:sanctum', 'role:admin');

// Route::group(['prefix' => 'client', 'middleware' => ['auth:sanctum', 'role:client']], function () {

// });

Route::middleware('auth:sanctum', 'role:client')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'getProfile');
        Route::put('/edit-profile', 'editProfile');
        Route::post('/change-password', 'changePassword');
    });
});
