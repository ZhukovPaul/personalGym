@extends('layouts.app')

@section('content')
<div class="section__content section__content--p30">
<div class="container">
    <h2 class="title-1">{{Str::upper( $section->title )}} 
      @if(Auth::user()->isAdmin())
      <small class="text-muted"><a href="{{route('workout.createWorkout',['workoutSection'=>$section])}}">{{__("workout.addWorkout")}}</a></small>
      @endif
    </h2>
    
     
</div>
</div>
@endsection