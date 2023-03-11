<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseSet;
use App\Models\Training;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('training.index', ['plans' => TrainingPlan::all()]);
    }

    public function create()
    {
        return view('training.create');
    }

    public function store(Request $request)
    {
        $validation_rules = [

            'title' => 'required|max:255'
            , 'user_id' => 'required'
            , 'active_from' => 'required',
            'active_to' => 'required'
        ];

        $request->validate($validation_rules);

        $fills = $request->only('title', 'user_id', 'active_from', 'active_to', 'active');

        $plan = TrainingPlan::create([
            'title' => $fills['title'],
            'user_id' => $fills['user_id'],
            'active_from' => $fills['active_from'],
            'active_to' => $fills['active_to'],
            'active' => $fills['active'] ?? 'N'
        ]);

        return redirect()->route('training.edit', ['trainingPlan' => $plan]);
    }


    public function addExercise(Request $request)
    {
        $data = $request->only(
            'training_plan_id',
            'user_id',
            'day_of_week',
            'exercise',
            'set_count',
            'set_weight'
        );

        $training = Training::where(
            ['training_plan_id' => $data['training_plan_id'],
                'day_of_week' => $data['day_of_week']
            ]
        )->first();

        if (is_null($training)) {
            $training = new Training([
                'title' => '',
                'training_plan_id' => $data['training_plan_id'],
                'day_of_week' => $data['day_of_week']
            ]);

            $training->save();
        }

        $trainingId = $training->id;

        $exercise = Exercise::where(['training_id' => $trainingId,
            'workout_id' => $data['exercise']])->first();

        if (is_null($exercise)) {
            $exercise = Exercise::create([
                'training_id' => $trainingId,
                'workout_id' => (int)$data['exercise'],
                'sort' => 100
            ]);

            for ($i = 0; $i < count($data['set_count']); $i++) {
                ExerciseSet::create([
                    'sort' => $i * 100,
                    'exercise_id' => $exercise->id,
                    'weight' => $data['set_weight'][$i],
                    'count' => $data['set_count'][$i]
                ]);
            }
        }

        return redirect()->route(
            'training.edit',
            ['trainingPlan' => $data['training_plan_id']]
        );
    }

    public function show(TrainingPlan $trainingPlan)
    {
        $trainings = $trainingPlan->trainings->groupBy('day_of_week')->all();

        $week = [
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
            7 => 'sunday',
        ];

        $dayTrainings = [];
        foreach ($trainings as $dayNumber => $training) {
            $curTraining = $training->first();
            foreach ($curTraining->exercises as $exercise) {
                $curExercise = [];
                $curExercise['sets'] = $exercise->sets;
                $curExercise['exercise'] = $exercise->workout;
                $dayTrainings[$dayNumber][] = $curExercise;
            }
        }

        return view('training.show', [
            'trainingPlan' => $trainingPlan,
            'week' => $week,
            'trainings' => $dayTrainings
        ]);
    }

    public function apiTraining($trainingPlan)
    {
        return '4';
        //dd($trainingPlan);
    }

    public function edit(TrainingPlan $trainingPlan)
    {
        return view('training.edit', ['trainingPlan' => $trainingPlan]);
    }

    public function update(Request $request, TrainingPlan $trainingPlan)
    {
        $validation_rules = [
            'title' => 'required|max:255'
            , 'user_id' => 'required'
            , 'active_from' => 'required',
            'active_to' => 'required'
        ];

        $request->validate($validation_rules);

        $fills = $request->only('title', 'user_id', 'active_from', 'active_to', 'active');

        $trainingPlan->update([
            'title' => $fills['title'],
            'user_id' => $fills['user_id'],
            'active_from' => $fills['active_from'],
            'active_to' => $fills['active_to'],
            'active' => (isset($fills['active'])) ? 'Y' : 'N'
        ]);

        return redirect()->route('training.edit', ['trainingPlan' => $trainingPlan]);
    }

    public function destroy(TrainingPlan $trainingPlan)
    {
        //
    }
}
