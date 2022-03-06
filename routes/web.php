<?php

use App\Models\User;
use App\Http\Controllers\{HomeController,UserController,WorkoutSectionController,WorkoutController,MenuController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Menu;

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

Auth::routes();
 


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix("personal")->name("personal")->group(function(){
    Route::get('/', [UserController::class, 'show'])->name('index');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit', [UserController::class, 'update'])->name('update');
});

Route::get("/login/vk",[LoginController::class,"redirectToProvider"])->name("login.vk");
Route::get("/login/vk/callback",[LoginController::class,"handleProviderCallback"])->name("login.callback");

Route::prefix("workout")->name("workout")->group(function(){
    Route::get("/",[WorkoutSectionController::class,"index"])->name(".index");
    Route::get("/create",[WorkoutSectionController::class,"create"])->name('.create')->middleware("can:create,App\Models\WorkoutSection");
    Route::post("/",[WorkoutSectionController::class,"store"]);
    Route::get("/{workoutSection:slug}/",[WorkoutSectionController::class,"show"])->name(".show");
    Route::get("/{workoutSection:slug}/edit",[WorkoutSectionController::class,"edit"])->name(".edit");
    Route::put("/{workoutSection:slug}/update",[WorkoutSectionController::class,"update"]);

    Route::get("/{workoutSection:slug}/create",[WorkoutController::class,"create"])->name(".createWorkout");
    Route::get("/{workoutSection:slug}/destroy",[WorkoutController::class,"destroy"])->name(".destroy");
});


Route::prefix("manager")->name("manager")->group(function(){
    /*Route::resource("menu",MenuController::class)->names([
        "index"=>".index",
        "create"=>".create",
    ]);
    */
});
