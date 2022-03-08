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
                                        <strong>{{ __("workoutSection.title")}}</strong> 
                                    </div>
                                    <div class="card-body card-block">
        {{Form::model($workout,[
            "method"=>"PUT",
            "action"=>["\App\Http\Controllers\WorkoutSectionController@update",$workout],
            'files'=>true
    ])}}


    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('title',__("workoutSection.FormTitle"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::text('title',null,["class"=>"form-control"])}}
        </div>
    </div> 

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('slug',__("workoutSection.FormSlug"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::text('slug',null,["class"=>"form-control"])}}
        </div>
    </div> 

    
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('description',__("workoutSection.FormDesc"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::textarea('description',null,["class"=>"form-control"])}}
        </div>
    </div> 

   
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('workout_section_id',__("workoutSection.FormSection"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::select('workout_section_id',$sections,null,["class"=>"custom-select"])}}
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