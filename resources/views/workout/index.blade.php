@extends('layouts.app')
 
@section('title', __("workout.indexTitle") ) 
 
@section('breadscrumbs')
  {{ Breadcrumbs::render('workout') }}
@endsection

@section('content') 
<div class="section__content section__content--p30">
<div class="container">
    <h2 class="title-1">{{__("workout.indexTitle")}} 
      @if(Auth::user()->isAdmin())
      <small class="text-muted"><a href="{{route('workout.create')}}">{{__("workout.addSection")}}</a></small>

      @endif
    </h2>
    
    @if(count($sections) < 1)
      <div class="alert alert-secondary mt-3" role="alert">
      {{__("workout.noSections")}}
			</div>
    @else
    <div class="row mt-4">
        @foreach($sections as $section )
        <div class="col-3">
        <div class="card shadow-sm">
          
        <a href="{{route('workout.show', ['workoutSection' => $section->slug]);}}" >
          @if($section->image)
            <img  class="bd-placeholder-img card-img-top" src="{{$section->image}}">
          @else
            <img  class="bd-placeholder-img card-img-top" src="/images/no-image.png">
          @endif
        </a>
        
            <div class="card-body">
              <p class="card-text mb-3">{{$section->title}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('workout.show', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.view")}}</a>
                  @if(Auth::user()->isAdmin())
                  <a href="{{route('workout.edit', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.edit")}}</a>
                  <a href="{{route('workout.destroy', ['workoutSection' => $section->slug]);}}" class="btn btn-sm btn-outline-secondary">{{__("workout.delete")}}</a>
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