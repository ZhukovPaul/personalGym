<?php

namespace App\Http\Controllers;

use App\Models\{WorkoutSection,WorkoutImage,Workout};
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Support\Facades\Storage;

class WorkoutSectionController extends Controller
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
        $sections = WorkoutSection::where("workout_section_id",null)->get();
                  
        foreach($sections as $key=>$section){
            if($section->image)
                $sections[$key]["image"] =  \Thumbnail::src( env( 'APP_URL' ) .  $section->image->path )->smartcrop(300, 220)->url( true );    
        } 
         
        return view("workout.index",["sections"=>$sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $sections = \App\Models\WorkoutSection::all("id","title");
        $sectAll = [0 => null];
        foreach ( $sections as $value) {
            $sectAll[$value["id"]] = $value["title"];
        }
        return view("workout.section.create",["sections"=>$sectAll]);
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
            "title"=>"required|max:50|unique:workout_sections",
            "file"=>"image"
        ];
       
        $request->validate($validate_rules);
        
        $fields = $request->only("title","slug","description","workout_section_id","file");
      
         
        $workoutSection = WorkoutSection::create([
            "title" => $fields["title"],
            "slug"  => ($fields["slug"]) 
                ? \Illuminate\Support\Str::slug($fields["slug"],"_")
                :\Illuminate\Support\Str::slug($fields["title"],"_"),
            "description"   =>  $fields["description"],
            "workout_section_id"=>($fields["workout_section_id"]) ? $fields["workout_section_id"] : null
        ]);


        //$workoutSection->save();
 
        if($request->hasFile("file")){
            WorkoutImage::uploadImage($request->file("file"), $workoutSection);
        }
        
        return redirect()->route("workout.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkoutSection  $workoutSection
     * @return \Illuminate\Http\Response
     */
    public function show(WorkoutSection $workoutSection)
    {

        $sections = WorkoutSection::where("workout_section_id",$workoutSection->id)->get();
                  
        foreach($sections as $key=>$section){
            if($section->image)
                $sections[$key]["image"] =  \Thumbnail::src( env( 'APP_URL' ) .  $section->image->path )->smartcrop(300, 220)->url( true );    
        } 

        $workouts = Workout::where(["workout_section_id"=>$workoutSection->id])->get();   

        foreach($workouts as $key=>$workout){
            if($workout->image)
                $workouts[$key]["image"] =  \Thumbnail::src( env( 'APP_URL' ) .  $workout->image->path )->smartcrop(300, 220)->url( true );    
        } 
        return view("workout.section.index",["section"=>$workoutSection,"workouts"=>$workouts,"sections"=>$sections]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkoutSection  $workoutSection
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkoutSection $workoutSection)
    {
        $sections = \App\Models\WorkoutSection::all("id","title");
        $sectAll = [0 => null];
        foreach ( $sections as $value) {
            $sectAll[$value["id"]] = $value["title"];
        }
  
        return view("workout.section.edit",["workout"=>$workoutSection,"sections"=>$sectAll]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkoutSection  $workoutSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkoutSection $workoutSection)
    {

        $validate_rules = [
            "title"=>"required|max:50",
            "file"=>"image"
        ];

        $request->validate($validate_rules);

        $fields = $request->only(["title","slug","description","workout_section_id","file"]); 

        $workoutSection->update([
            "title" => $fields["title"],
            "slug"  => ($fields["slug"]) 
                ? \Illuminate\Support\Str::slug($fields["slug"],"_")
                :\Illuminate\Support\Str::slug($fields["title"],"_"),
            "description"   =>  $fields["description"],
            "workout_section_id"=> ($fields["workout_section_id"]) ? $fields["workout_section_id"] : null
        ]);

        if($request->hasFile("file")){
           
            Storage::delete($workoutSection->image->path);
            $workoutSection->image->delete();

            WorkoutImage::uploadImage($request->file("file"), $workoutSection);
         
        }
        return redirect()->route("workout.index");
       
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkoutSection  $workoutSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkoutSection $workoutSection)
    {
        if($workoutSection->image){
            $workoutSection->image->delete();
        }
        $workoutSection->delete();

        return redirect()->route("workout.index");
    }
}
