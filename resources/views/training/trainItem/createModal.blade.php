{{Form::open([
            "method"=>"POST",
            "action"=>"\App\Http\Controllers\TrainingPlanController@addExercise",
            'files'=>false
    ])}}

    {{Form::hidden('user_id',Auth::user()->id)}}
    {{Form::hidden('day_of_week',$day)}}
    {{Form::hidden('training_plan_id',$trainingPlan->id)}}

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('exercise',__("training.exercise"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::select('exercise',$workouts,null,["class"=>"custom-select"])}}
    
        </div>
    </div> 
    @for ($i = 0; $i < 5; $i++)
    <div class="row form-group" id="row{{$i}}">
        <div class="col col-md-3">
            {{Form::label('set',__("training.set"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-3">
        {{Form::number('set_count[]',10,["class"=>"form-control"])}}
        </div>
        <div class="col-12 col-md-1">
            X
        </div>
        <div class="col-12 col-md-3">
        {{Form::number('set_weight[]',10,["class"=>"form-control"])}}  
        </div>
        <div class="col-12 col-md-1">
        Kg
        </div>
        <div class="col-12 col-md-1">
        <a onclick="$('#row{{$i}}').remove();" >X</a>
        </div>
    </div> 
    @endfor
    </div>
      <div class="modal-footer">
        {{Form::submit(__("training.add"),["class"=>"btn btn-primary"])}}
      </div>
 

    {{Form::close()}}