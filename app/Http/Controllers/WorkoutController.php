<?php

namespace App\Http\Controllers;

use App\Models\{WorkoutSection,WorkoutImage,Workout};
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;

class WorkoutController extends Controller
{


    function __construct()
    {
        $this->middleware('auth');
    }

     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(WorkoutSection $workoutSection)
    {
        //dd($workoutSection);
        //
      
        return view("workout.item.create",["workoutSection"=>$workoutSection]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_rules = [
            "title"=>"required|max:50|unique:workouts",
            "file"=>"image"
        ];
       
        $request->validate($validate_rules);
        
        $fields = $request->only("title","description","difficulty","file","workout_section_id");
      
         
        $workout = Workout::create([
            "title" => $fields["title"],
            "slug"  => \Illuminate\Support\Str::slug($fields["title"],"_"),
            "description"   =>  $fields["description"],
            "difficulty"   =>  $fields["difficulty"],
            "workout_section_id"   =>  $fields["workout_section_id"],

        ]);


        //$workoutSection->save();
        
        if($request->hasFile("file")){
            WorkoutImage::uploadImage($request->file("file"), $workout);
        }
        $ws = WorkoutSection::find( $fields["workout_section_id"]);
       
        return redirect()->route("workout.showWorkout",["workoutSection"=>$ws,"workout"=>$workout]);

        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(WorkoutSection $workoutSection, $workout)
    {
        if( !($curWorkout = Workout::where("slug",$workout)->first())) 
            abort(404);
        
            //echo $workout;
        //dd($curWorkout->videos);
        return view("workout.item.index",["workout"=>$curWorkout, "section"=>$workoutSection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkoutSection $workoutSection ,  $workout)
    {
        if( !($curWorkout = Workout::where("slug",$workout)->first())) 
            abort(404);
        
            //echo $workout;
        dd($curWorkout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkoutSection $workoutSection, Workout $workout)
    {
        //
        /*
        dd($workout);
        if($workout->image){
            $workout->image->delete();
        }
        $workout->delete();
        */
       // return redirect()->route("workout.show",["workoutSection"=>$workoutSection]);
    }

    
}
