<?php

namespace App\Http\Controllers;

use App\Models\{WorkoutSection,WorkoutImage,Workout,WorkoutVideo};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create(WorkoutSection $workoutSection)
    {
        return view('workout.item.create', ['workoutSection'=>$workoutSection]);
    }

    public function store(Request $request)
    {
        $validate_rules = [
            'title'=>'required|max:50|unique:workouts',
            'file'=>'image'
        ];

        $request->validate($validate_rules);
        $fields = $request->only(
            'title',
            'description',
            'difficulty',
            'file',
            'workout_section_id',
            'video'
        );

        $workout = Workout::create([
            'title' => $fields['title'],
            'slug'  => \Illuminate\Support\Str::slug($fields['title'], '_'),
            'description'   =>  $fields['description'],
            'difficulty'   =>  $fields['difficulty'],
            'workout_section_id'   =>  $fields['workout_section_id'],
        ]);

        if ($request->hasFile('file')) {
            WorkoutImage::uploadImage($request->file('file'), $workout);
        }

        if ($fields['video']) {
            WorkoutVideo::create(['src'=>$fields['video'],'workout_id'=>$workout->id ]);
        }

        return redirect()->route(
            'workout.showWorkout',
            [
                'workoutSection'=>WorkoutSection::find($fields['workout_section_id']),
                'workout'=>$workout
            ]
        );
    }

    public function show(WorkoutSection $workoutSection, $workout)
    {
        if (! ($curWorkout = Workout::where('slug', $workout)->first())) {
            abort(404);
        }

        return view(
            'workout.item.index',
            ['workout'=>$curWorkout, 'section'=>$workoutSection]
        );
    }

    public function edit(WorkoutSection $workoutSection, $workout)
    {
        if (! ($curWorkout = Workout::where('slug', $workout)->first())) {
            abort(404);
        }

        return view('workout.item.edit', [
            'workout'=>$curWorkout,
            'workoutSection'=>$workoutSection
        ]);
    }

    public function update(Request $request, $workoutSection, Workout $workout)
    {
        $validate_rules = [
            'title'=>'required|max:50',
            'file'=>'image'
        ];

        $request->validate($validate_rules);
        $fields = $request->only(
            'title',
            'description',
            'difficulty',
            'file',
            'workout_section_id',
            'video'
        );

        $workout->update([
            'title' => $fields['title'],
            'slug'  => Str::slug($fields['title'], '_'),
            'description'   =>  $fields['description'],
            'difficulty'   =>  $fields['difficulty'],
            'workout_section_id'   =>  $fields['workout_section_id'],
        ]);

        if (!$workout->video) {
            WorkoutVideo::create(['src'=>$fields['video'],'workout_id'=>$workout->id ]);
        } else {
            $workout->video->update(['src'=>$fields['video'] ]);
        }

        if ($request->hasFile('file')) {
            WorkoutImage::uploadImage($request->file('file'), $workout);
        }

        $ws = WorkoutSection::find($fields['workout_section_id']);

        return redirect()->route('workout.editWorkout', [
            'workoutSection'=>$ws,
            'workout'=>$workout
        ]);
    }

    public function destroy($workoutSection, Workout $workout)
    {
        if ($workout->image) {
            Storage::delete($workout->image->path);
            $workout->image->delete();
        }

        if ($workout->video) {
            $workout->video->delete();
        }

        $workout->delete();
        $ws = WorkoutSection::find($workout->workout_section_id);

        return redirect()->route('workout.show', ['workoutSection'=>$ws]);
    }
}
