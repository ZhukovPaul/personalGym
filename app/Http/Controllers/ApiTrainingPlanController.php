<?php

namespace App\Http\Controllers;

use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class ApiTrainingPlanController extends Controller
{


    public function __construct()
    {
        //$this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return TrainingPlan::all()->toJson(JSON_UNESCAPED_UNICODE);
        return TrainingPlan::all()->toArray();
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
     * @param  \App\Models\TrainingPlan  $trainingPlan
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingPlan $trainingPlan)
    {
        return $trainingPlan->toArray();
       // return $trainingPlan->toJson(JSON_UNESCAPED_UNICODE);
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
        //
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
