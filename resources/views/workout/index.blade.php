@extends('layouts.app')

@section('content')
<div class="section__content section__content--p30">
<div class="container">
    <h2 class="title-1">Workout <small class="text-muted"><a href="{{route('workout.create')}}">Add section</a></small></h2>
    <div class="row mt-4">
        @foreach($sections as $section )
        <div class="col-4">
        <div class="card shadow-sm">
            
            <img  class="bd-placeholder-img card-img-top" src="{{$section->image}}">
            <div class="card-body">
              <p class="card-text mb-3">{{$section->title}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('workout.show', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">View</a>
                  @auth
                  <a href="{{route('workout.edit', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">Edit</a>
                  <a href="{{route('workout.destroy', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">Delete</a>
                  @endauth
                </div>
                <!--small class="text-muted">9 mins</small-->
              </div>
            </div>
          </div>
         
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection