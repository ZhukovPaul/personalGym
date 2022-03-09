@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('workoutItem',$section,$workout) }}
@endsection

@section('content')
<div class="section__content section__content--p30">
<div class="container">
  @if(Auth::user()->isAdmin())
    <div class="text-right">
    <small class="text-muted"><a href="{{route('workout.editWorkout',['workoutSection' => $section,'workout'=>$workout ])}}">{{__("workout.edit")}}</a></small>
    </div>
  @endif
      <div class="au-card mt-3">
        <div class="row">
          <div class="col-4">
            
          @if($workout->image) 
            <img src="{{$workout->image->path}}" class="w-100" />
          @endif
            <div>{{$workout->difficulty}}</div>
          </div>
          <div class="col-8"> 
          <h2 class="title-1">{{$workout->title}}</h2>
        <div>{!! $workout->description !!}</div>
         
        
        @if($workout->video)
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$workout->video->src}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @endif
        </div>
        </div>
</div>
</div>
</div>
@endsection