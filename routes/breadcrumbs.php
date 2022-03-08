<?php

use \Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

// Home > Blog
Breadcrumbs::for('workout', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
 
    $trail->push('Упражнения', route('workout.index'));
});

Breadcrumbs::for('workoutSection', function (BreadcrumbTrail $trail, \App\Models\WorkoutSection $workoutSection) {
    $trail->parent('home');
    $trail->push('Упражнения', route('workout.index'));
    if( ! is_null($workoutSection->workout_section_id )){
        $trail->push($workoutSection->section->title, route('workout.show',["workoutSection"=>$workoutSection->section]));
    }
    $trail->push($workoutSection->title, route('workout.index'));
});

Breadcrumbs::for('workoutItem', function (BreadcrumbTrail $trail, 
\App\Models\WorkoutSection $workoutSection,
\App\Models\Workout $workout
) {
    $trail->parent('home');
    $trail->push('Упражнения', route('workout.index'));
    
    
    $trail->push($workoutSection->title, route('workout.show',["workoutSection"=>$workoutSection]));
    $trail->push($workout->title );
});
/*
// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});
*/