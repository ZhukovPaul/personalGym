@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('trainingShow',$trainingPlan) }}
@endsection

@push("css")
<link href='/vendor/fullcalendar-3.10.0/fullcalendar.css' rel='stylesheet' media="all" />
@endpush("css")


@section('content')
<div class="section__content section__content--p30">
<div class="container">
   

<div class="row">
                            <div class="col">
                              <div class="au-card">
@if(Auth::user()->isAdmin())
    <div class="text-right">
    <small class="text-muted"><a href="{{route('training.edit',['trainingPlan'=>$trainingPlan ])}}">{{__("training.editTitle")}}</a></small>
    </div>
  @endif
      <div>
          <h2>{{$trainingPlan->title}} ({{date('d.m.Y', strtotime($trainingPlan->active_from))}} - {{date('d.m.Y', strtotime($trainingPlan->active_to)) }})</h2>
      </div>
      <div class="table-responsive">
  
  
      <table class="table table-striped">
    <caption>Days of the week</caption>
    @foreach($week as $key => $day)
    <tr>
        <td    >{{__("training.$day")}} </td>
    </tr>
    <tr>
        <td>
        @if( isset($trainings[$key]))
        @foreach($trainings[$key] as $training)
            <span class="fc-event-dot"></span> <a href="">change "{{$training->title}}" training</a>
        @endforeach
        @else
            <span class="fc-event-dot"></span> <a href="{{route('training.trainCreate',['trainingPlan'=>$trainingPlan,'dayOfWeek'=>$key])}}">add training</a>
        @endif
        </td>
         
    </tr>
    @endforeach
    </table>
    </div>


    
</div>
</div>
</div>
</div>  
</div>
@endsection