@extends('layouts.app')

@section('content')
 
 
    
 
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
        @endif
        
        <div class="card">
                                    <div class="card-header">
                                        <strong>{{ __("workoutItem.title")}}</strong> 
                                    </div>
                                    <div class="card-body card-block">
        {{Form::open([
            "method"=>"POST",
            "action"=>"\App\Http\Controllers\WorkoutController@store",
            'files'=>true
    ])}}

    {{Form::hidden('workout_section_id',$workoutSection->id)}}

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('title',__("workoutItem.FormTitle"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::text('title',null,["class"=>"form-control"])}}
        </div>
    </div> 

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('difficulty',__("workoutItem.FormDifficulty"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::select('difficulty',["easy","normal","hard"],null,["class"=>"custom-select"])}}
    
        </div>
    </div> 

    
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('description',__("workoutItem.FormDesc"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::textarea('description',null,["class"=>"form-control"])}}
        </div>
    </div> 

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('video',__("workoutItem.FormVideo"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::text('video',null,["class"=>"form-control"])}}
        </div>
    </div> 

   

<div class="row form-group">
    <div class="col col-md-3">
        {{Form::label('file',__("workoutSection.FormImage"),["class"=>"form-control-label"])}}
       
    </div>
    <div class="col-12 col-md-9">
    {{Form::file('file',["class"=>"form-control"])}}
    </div>
</div> 
{{Form::submit(__("workoutSection.FormSubmit"),["class"=>"btn btn-primary"])}}
 {{Form::close()}}
        </div>
       

</div>
</div>
@endsection