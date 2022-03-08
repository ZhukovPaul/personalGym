@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('workoutItem',$section,$workout) }}
@endsection

@section('content')
<div class="section__content section__content--p30">
<div class="container">
    <div class="text-right">
    <small class="text-muted"><a href="{{route('workout.editWorkout',['workoutSection' => $section,'workout'=>$workout ])}}">{{__("workout.edit")}}</a></small>
    </div>
    <h2 class="title-1">{{$workout->title}}</h2>
    @if(Auth::user()->isAdmin())

      @endif
        @if($workout->image) 
            <img src="{{$workout->image->path}}" class="w-25" />
        @endif
<div class="au-card mt-3">
        <div>{!! $workout->description !!}</div>
        <div>{{$workout->difficulty}}</div>
        
        @if(count($workout->videos) > 0)
            @foreach($workout->videos as $video)
            <h3>{{$video->title}}  </h3>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video->src}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endforeach
        @endif

</div>
</div>
</div>
@endsection