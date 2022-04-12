@extends('layouts.app')

@section('title', $workout->title ) 

@section('breadscrumbs')
  {{ Breadcrumbs::render('workoutItem',$section,$workout) }}
@endsection

@section('content')
<h1 class="title-1 mb-2">{{$workout->title}}
@if(Auth::user()->isAdmin())
    
    <small class="text-muted"><a href="{{route('workout.editWorkout',['workoutSection' => $section,'workout'=>$workout ])}}">{{__("workout.edit")}}</a></small>
    
  @endif
</h1>
 
 
  
      <div class="au-card mt-3">
      
        <div class="row">
          <div class="col-12">
            
          @if($workout->image) 
            <img src="{{$workout->image->getPath()}}" class="w-100 mb-3" />
          @endif
            <div>{{$workout->difficulty}}</div>
          </div>
          <div class="col-12"> 
          
        <div class="px-3">{!! $workout->description !!}</div>
         
        
        @if($workout->video)
          <div class="mt-2">
            <iframe width="100%" height="415" src="https://www.youtube.com/embed/{{$workout->video->src}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        @endif
        </div>
        </div>
  
</div>
@endsection