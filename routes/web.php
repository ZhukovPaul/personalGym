<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutSectionController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('personal')->name('personal')->group(function () {
    Route::get('/', [UserController::class, 'show'])->name('.index');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit', [UserController::class, 'update'])->name('update');
});

Route::get('/login/vk', [LoginController::class, 'redirectToVkProvider'])->name('login.vk');
Route::get('/login/vk/callback', [LoginController::class, 'handleVkProviderCallback'])->name('login.callback');

Route::prefix('workout')->name('workout')->group(function () {
    Route::get('/', [WorkoutSectionController::class, 'index'])->name('.index');
    Route::get('/create', [WorkoutSectionController::class, 'create'])->name('.create')->middleware("can:create,App\Models\WorkoutSection");
    Route::post('/', [WorkoutSectionController::class, 'store']);

    Route::get('/{workoutSection:slug}/', [WorkoutSectionController::class, 'show'])->name('.show');
    Route::get('/{workoutSection:slug}/edit', [WorkoutSectionController::class, 'edit'])->name('.edit');
    Route::put('/{workoutSection:slug}/update', [WorkoutSectionController::class, 'update']);
    Route::get('/{workoutSection:slug}/destroy', [WorkoutSectionController::class, 'destroy'])->name('.destroy');

    Route::get('/{workoutSection:slug}/create', [WorkoutController::class, 'create'])->name('.createWorkout');
    Route::get('/{workoutSection:slug}/{workout:slug}', [WorkoutController::class, 'show'])->name('.showWorkout');
    Route::get('/{workoutSection:slug}/{workout:slug}/edit', [WorkoutController::class, 'edit'])->name('.editWorkout');
    Route::put('/{workoutSection:slug}/{workout:slug}/update', [WorkoutController::class, 'update']);
    Route::get('/{workoutSection:slug}/{workout:slug}/destroy', [WorkoutController::class, 'destroy'])->name('.destroyWorkout');

    Route::post('/workoutStore', [WorkoutController::class, 'store']);
});

Route::prefix('training')->name('training')->group(function () {
    Route::get('/', [TrainingPlanController::class, 'index'])->name('.index');
    Route::get('/create', [TrainingPlanController::class, 'create'])->name('.create');

    Route::get('/{trainingPlan:id}', [TrainingPlanController::class, 'show'])->name('.show');
    Route::get('/{trainingPlan:id}/{dayOfWeek}/create', [TrainingController::class, 'create'])->name('.trainCreate');
    Route::get('/{trainingPlan:id}/{dayOfWeek}/createmodal', [TrainingController::class, 'createModal'])->name('.trainCreateModal');
    Route::post('/', [TrainingPlanController::class, 'store']);
    Route::post('/addExercise', [TrainingPlanController::class, 'addExercise']);
    Route::get('/edit/{trainingPlan:id}', [TrainingPlanController::class, 'edit'])->name('.edit');
    Route::put('/update/{trainingPlan:id}', [TrainingPlanController::class, 'update']);
});
