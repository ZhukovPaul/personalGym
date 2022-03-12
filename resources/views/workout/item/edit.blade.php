@extends('layouts.app')

@section('content')
<div class="section__content section__content--p30">
<div class="container">
    
 
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
        {{Form::model($workout,[
            "method"=>"PUT",
            "action"=>["\App\Http\Controllers\WorkoutController@update",$workoutSection,$workout],
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
        @if(!$workout->video)
        {{Form::text('video',null,["class"=>"form-control"])}}
        @else
        {{Form::text('video',$workout->video->src,["class"=>"form-control"])}}
        @endif
        </div>
    </div> 

   

<div class="row form-group">
    <div class="col col-md-3">
        {{Form::label('file',__("workoutSection.FormImage"),["class"=>"form-control-label"])}}
       
    </div>
    <div class="col-12 col-md-9">
        @if($workout->image)
        <img src="{{$workout->image->path}}" class="w-100"> 
        @endif
        {{Form::file('file',["class"=>"form-control"])}}
    </div>
</div> 
{{Form::submit(__("workoutItem.FormSubmit"),["class"=>"btn btn-secondary"])}}
<a target="_blank" href="{{route('workout.showWorkout',['workoutSection'=>$workoutSection,'workout'=>$workout])}}" class="btn btn-secondary" >{{__("workoutItem.FormView")}}</a>
 {{Form::close()}}
        </div>
       

</div>
</div>
@endsection