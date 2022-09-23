<?php

namespace App\Http\Controllers;

use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class ApiTrainingPlanController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        //return TrainingPlan::all()->toJson(JSON_UNESCAPED_UNICODE);
        return TrainingPlan::all()->toArray();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TrainingPlan $trainingPlan)
    {
        return $trainingPlan->toArray();
       // return $trainingPlan->toJson(JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request, TrainingPlan $trainingPlan)
    {
        //
    }

    public function destroy(TrainingPlan $trainingPlan)
    {
        //
    }
}
