@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('workoutSection',$section) }}
@endsection

@section('content')
<div class="section__content section__content--p30">
<div class="container">
    <h2 class="title-1">{{Str::upper( $section->title )}} 
      @if(Auth::user()->isAdmin())
      <small class="text-muted"><a href="{{route('workout.createWorkout',['workoutSection'=>$section])}}">{{__("workout.addWorkout")}}</a></small>
      @endif
    </h2>
    
    



    @if(count($workouts) < 1)
      <div class="alert alert-secondary mt-3" role="alert">
      {{__("workout.noWorkouts")}}
			</div>
    @else
    <div class="row mt-4">
        @foreach($workouts as $workout )
        <div class="col-4">
        <div class="card shadow-sm">
          
        <a href="{{route('workout.showWorkout', ['workoutSection' => $section,'workout'=>$workout ]);}}" >
          @if($workout->image)
            <img  class="bd-placeholder-img card-img-top" src="{{$workout->image}}">
          @else
            <img  class="bd-placeholder-img card-img-top" src="/images/no-image.png">
          @endif
        </a>
        
            <div class="card-body">
              <p class="card-text mb-3">{{$workout->title}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('workout.show', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.view")}}</a>
                  @if(Auth::user()->isAdmin())
                  <a href="{{route('workout.editWorkout', ['workoutSection' => $section,'workout'=>$workout ]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.edit")}}</a>
                  <a href="{{route('workout.destroyWorkout', ['workoutSection' => $section,'workout'=>$workout ]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.delete")}}</a>
                  @endif
                </div>
                <!--small class="text-muted">9 mins</small-->
              </div>
            </div>
          </div>
         
        </div>
        @endforeach
    </div>
    @endif


     
</div>
</div>
@endsection