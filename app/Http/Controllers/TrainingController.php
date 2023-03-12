<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingPlan;
use App\Models\Workout;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create(TrainingPlan $trainingPlan, $dayOfWeek)
    {
        $week = [
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
            7 => 'sunday',
        ];

        $workouts = Workout::all(['id', 'title'])
            ->keyBy('id')
            ->map(fn (Workout $item) => $item['title'])
            ->all();

        return view(
            'training.trainItem.create',
            [
                'trainingPlan' => $trainingPlan,
                'week' => $week,
                'day' => $dayOfWeek,
                'workouts' => $workouts,
            ]
        );
    }

    public function createModal(TrainingPlan $trainingPlan, $dayOfWeek)
    {
        $week = [
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
            7 => 'sunday',
        ];
        //
        //return view('training.show',['trainingPlan'=>$trainingPlan,'week'=>$week,'trainings'=>$trainings]);

        $workouts = Workout::all(['id', 'title'])
            ->keyBy('id')
            ->map(fn (Workout $item) => $item['title'])
            ->all();

        return view(
            'training.trainItem.createModal',
            [
                'trainingPlan' => $trainingPlan,
                'week' => $week,
                'day' => $dayOfWeek,
                'workouts' => $workouts,
            ]
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Training $training)
    {
        //
    }

    public function edit(Training $training)
    {
        //
    }

    public function update(Request $request, Training $training)
    {
        //
    }

    public function destroy(Training $training)
    {
        //
    }
}
