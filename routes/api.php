<?php
use App\Http\Controllers\Api\Auth\{
	AuthenticateUserController,
	RegisterUserController
};

use App\Http\Controllers\Api\{
	TaskController,
	TagController,
};


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\Priority;
use App\Models\Tag;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->group(function () {
	Route::post('login', [AuthenticateUserController::class, 'store']);
	Route::post('register', [RegisterUserController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function () {
	Route::post('logout', [AuthenticateUserController::class, 'destroy'])->name('logout');
	Route::resource('tasks', TaskController::class);

	Route::get('user/completed-tasks', [TaskController::class, 'completed']);
	Route::get('user/archived-tasks', [TaskController::class, 'archived']);

	Route::match(['put', 'patch'], '/tasks/{task}/completed', [TaskController::class, 'complete']);
	Route::match(['put', 'patch'], '/tasks/{task}/incomplete', [TaskController::class, 'incomplete']);
	Route::match(['put', 'patch'], '/tasks/{task}/archive', [TaskController::class, 'archive']);
	Route::match(['put', 'patch'], '/tasks/{task}/restore', [TaskController::class, 'restore']);


	Route::get('priority-levels', function() {
		return Priority::cases();
	});

	Route::get('tags', function() {
		return response()->json(Tag::all());
	});


});
