<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Workout;
use Illuminate\Http\Request;

class TrainingController extends Controller
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
    public function create(\App\Models\TrainingPlan $trainingPlan, $dayOfWeek)
    {
        $week = [
            1=> "monday",
            2=> "tuesday",
            3=> "wednesday",
            4=> "thursday",
            5=> "friday",
            6=> "saturday",
            7=> "sunday",
        ];
        //
        //return view("training.show",["trainingPlan"=>$trainingPlan,"week"=>$week,'trainings'=>$trainings]);
        
        $workouts = Workout::all(['id','title'])->keyBy("id")
        ->map(function($item){
            return $item["title"] ;
        })
        ->all();
          
        return view("training.trainItem.create",["week"=>$week,"day"=>$dayOfWeek,"workouts"=>$workouts]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
