@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('training') }}
@endsection


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
                                        <strong>{{__("training.createTitle")}} </strong> 
                                    </div>
                                    <div class="card-body card-block">
    {{Form::open([
            "method"=>"POST",
            "action"=>"\App\Http\Controllers\TrainingPlanController@store",
            'files'=>false
    ])}}

    {{Form::hidden('user_id',Auth::user()->id)}}
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('title',__("training.FormTitle"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::text('title',null,["class"=>"form-control"])}}
        
        </div>
    </div> 
     <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('active',__("training.FormActive"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::checkbox('active',"Y",["class"=>"custom-select"])}}
        
        </div>
    </div> 
  
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('active_from',__("training.FormActiveFrom"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::date('active_from', \Carbon\Carbon::now() ,["class"=>"form-control"] );}}
        
        </div>
    </div> 
    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('active_to',__("training.FormActiveTo"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::date('active_to', null ,["class"=>"form-control"]);}}
        
        </div>
    </div> 
    {{Form::submit(__("training.FormSubmit"),["class"=>"btn btn-primary"])}}
 {{Form::close()}}
    </div> 
    </div> 


</div>
</div>
@endsection