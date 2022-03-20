@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('training') }}
@endsection


@section('content')
<div class="section__content section__content--p30">
<div class="container">
   
      
    <h2 class="title-1">{{__("training.indexTitle")}} 
      @if(Auth::user()->isAdmin())
      <small class="text-muted"><a href="{{route('training.create')}}">{{__("training.addPlan")}}</a></small>
      @endif
    </h2>
    @if(count($plans) < 1)
      <div class="alert alert-secondary mt-3" role="alert">
      {{__("training.noPlans")}}
			</div>
    @else
    <ul>
        @foreach($plans as $plan)
        <li><a href="{{route('training.show',['trainingPlan'=>$plan])}}">{{$plan->title}}</a></li>
        @endforeach
    </ul>
    
    @endif

</div>
</div>
@endsection