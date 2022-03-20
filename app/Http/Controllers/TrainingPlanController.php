<?php

namespace App\Http\Controllers;

use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingPlanController extends Controller
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

        return view("training.index",["plans"=>TrainingPlan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view("training.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_rules = [

            "title" =>"required|max:255"
            ,"user_id" =>"required"
            ,"active_from" =>"required",
            "active_to" =>"required"
        ];

        $request->validate($validation_rules);

        $fills = $request->only("title","user_id","active_from","active_to","active");
        
        $plan = TrainingPlan::create([
            "title" => $fills["title"],
            "user_id"=>$fills["user_id"],
            "active_from"=>$fills["active_from"],
            "active_to"=>$fills["active_to"],
            "active"=> $fills["active"] ?? "N"
        ]);
       
        return redirect()->route("training.edit",["trainingPlan"=>$plan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingPlan  $trainingPlan
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingPlan $trainingPlan)
    {
        $trainings = $trainingPlan->trainings->groupBy('day_of_week')->all();
         
        $week = [
            1=> "monday",
            2=> "tuesday",
            3=> "wednesday",
            4=> "thursday",
            5=> "friday",
            6=> "saturday",
            7=> "sunday",
        ];
        return view("training.show",["trainingPlan"=>$trainingPlan,"week"=>$week,'trainings'=>$trainings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingPlan  $trainingPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainingPlan $trainingPlan)
    {
        return view("training.edit",["trainingPlan"=>$trainingPlan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingPlan  $trainingPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrainingPlan $trainingPlan)
    {
        $validation_rules = [

            "title" =>"required|max:255"
            ,"user_id" =>"required"
            ,"active_from" =>"required",
            "active_to" =>"required"
        ];

        $request->validate($validation_rules);

        $fills = $request->only("title","user_id","active_from","active_to","active");
       
        $trainingPlan->update([
            "title" => $fills["title"],
            "user_id"=>$fills["user_id"],
            "active_from"=>$fills["active_from"],
            "active_to"=>$fills["active_to"],
            "active"=> (isset($fills["active"])) ? "Y":  "N"
        ]);
         
        return redirect()->route("training.edit",["trainingPlan"=>$trainingPlan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingPlan  $trainingPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingPlan $trainingPlan)
    {
        //
    }
}
