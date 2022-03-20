<?php

use App\Models\User;
use App\Http\Controllers\{TrainingController,TrainingPlanController,HomeController,UserController,WorkoutSectionController,WorkoutController,MenuController};
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
    Route::get("/{workoutSection:slug}/destroy",[WorkoutSectionController::class,"destroy"])->name(".destroy");
    
    Route::get("/{workoutSection:slug}/create",[WorkoutController::class,"create"])->name(".createWorkout");
    Route::get("/{workoutSection:slug}/{workout:slug}",[WorkoutController::class,"show"])->name(".showWorkout");
    Route::get("/{workoutSection:slug}/{workout:slug}/edit",[WorkoutController::class,"edit"])->name(".editWorkout");
    Route::put("/{workoutSection:slug}/{workout:slug}/update",[WorkoutController::class,"update"]);
    Route::get("/{workoutSection:slug}/{workout:slug}/destroy",[WorkoutController::class,"destroy"])->name(".destroyWorkout");
    

    Route::post("/workoutStore",[WorkoutController::class,"store"]);
});

Route::prefix("training")->name("training")->group(function(){
    Route::get("/",[TrainingPlanController::class,"index"])->name(".index");
    Route::get("/{trainingPlan:id}",[TrainingPlanController::class,"show"])->name('.show');
    Route::get("/{trainingPlan:id}/{dayOfWeek}/create",[TrainingController::class,"create"])->name('.trainCreate');
    Route::get("/create",[TrainingPlanController::class,"create"])->name(".create");
    Route::post("/",[TrainingPlanController::class,"store"]);
    Route::get("/edit/{trainingPlan:id}",[TrainingPlanController::class,"edit"])->name(".edit");
    Route::put("/update/{trainingPlan:id}",[TrainingPlanController::class,"update"]);

});


Route::prefix("manager")->name("manager")->group(function(){
    /*Route::resource("menu",MenuController::class)->names([
        "index"=>".index",
        "create"=>".create",
    ]);
    */
});
