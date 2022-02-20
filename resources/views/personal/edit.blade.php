@extends('layouts.app')


@section('content')
<div class="container">
 
  
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Edit your profile</strong> Elements
                                    </div>
                                    <div class="card-body card-block">
@if ($errors->any())
<div class="alert alert-danger">
        <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
@endif

{{Form::model(Auth::user(),[
    "method"=>"POST",
    "action"=>"App\Http\Controllers\UserController@update",
    'files'=>true
    ])}}

    {{Form::hidden('id',$user->id)}}
<div class="row form-group">
    <div class="col col-md-3">
 
        {{Form::label('name',"Name",["class"=>"form-control-label"])}}   
    </div>
    <div class="col-12 col-md-9">
    {{Form::text('name',null,["class"=>"form-control"])}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
    {{Form::label('lastname',"Lastname",["class"=>"form-control-label"])}}   
        
    </div>
    <div class="col-12 col-md-9">
    {{Form::text('lastname',null,["class"=>"form-control"])}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
    {{Form::label('birthday',"Birthday",["class"=>"form-control-label"])}}   
 
    </div>
    <div class="col-12 col-md-9">
    {{Form::date('birthday',null,["class"=>"form-control"])}}
    </div>
</div> 
    
<div class="row form-group">
    <div class="col col-md-3">
    
        {{Form::label('email',"Email",["class"=>"form-control-label"])}}
    </div>
    <div class="col-12 col-md-9">
    {{Form::email('email',null,["class"=>"form-control"])}}
    </div>
</div> 

<div class="row form-group">
    <div class="col col-md-3">
        {{Form::label('user_image_id',"Image",["class"=>"form-control-label"])}}
       
    </div>
    <div class="col-12 col-md-9">
    {{Form::file('user_image_id',["class"=>"form-control"])}}
    </div>
</div> 

{{Form::submit('Apply',["class"=>"btn btn-primary"])}}
 {{Form::close()}}
</div>
</div>
</div>
@endsection