@extends('layouts.app')


@section('content')
<div class="container">
  
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Edit your profile</strong> Elements
                                    </div>
                                    <div class="card-body card-block">
{{Form::open(["method"=>"POST","action"=>"App\Http\Controllers\UserController@update",'id'=>$user->id])}}
<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Name</label>
    </div>
    <div class="col-12 col-md-9">
    {{Form::text('name',$user->name,["class"=>"form-control"])}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Lastname</label>
    </div>
    <div class="col-12 col-md-9">
    {{Form::text('lastname',$user->lastname,["class"=>"form-control"])}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Birthday</label>
    </div>
    <div class="col-12 col-md-9">
    {{Form::date('birthday',$user->birthday,["class"=>"form-control"])}}
    </div>
</div> 
    
<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Email</label>
    </div>
    <div class="col-12 col-md-9">
    {{Form::email('email',$user->email,["class"=>"form-control"])}}
    </div>
</div> 

 {{Form::close()}}
</div>
</div>
</div>
@endsection