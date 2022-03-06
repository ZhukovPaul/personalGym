<?php

namespace App\Http\Controllers;

use App\Models\{WorkoutSection,WorkoutImage,Workout};
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class WorkoutSectionController extends Controller
{


    function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = WorkoutSection::all();
        //dd($sections[0]);
        foreach($sections as $key=>$section){
            $image = $sections[0]->image()->get();
            if( $image[0] )
                $sections[$key]["image"] =  \Thumbnail::src( env( 'APP_URL' ) .  $image[0]->path )->smartcrop(300, 150)->url( true );    
                 
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
        return view("workout.create",["sections"=>$sectAll]);
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
            "title"=>"required|max:50",
            "slug"=>"required|max:50|unique:workout_sections",
            "file"=>"image"
        ];
       
        $request->validate($validate_rules);
        
        $result = $request->only("title","slug","description","file");
        //

        $section = new WorkoutSection();
        $section->title = $result["title"];
        $section->slug = $result["slug"];
        $section->description = $result["description"];
         
        $section->save();
 
        if($request->hasFile("file")){
           
            $uploadPicture = $request->file("file");
            $path = "/sections/".$uploadPicture->hashName() ;
            Storage::put("/sections/", $uploadPicture); 
            $workoutImage = new WorkoutImage();
            $workoutImage->path = $path;
            $workoutImage->imageable()->associate($section);
            $workoutImage->save();
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
        //
        //dd($workoutSection);
        //dd(Workout::where()->all();)
        return view("workout.section",["section"=>$workoutSection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkoutSection  $workoutSection
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkoutSection $workoutSection)
    {
        //
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
        //
    }
}
