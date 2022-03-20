@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('training') }}
@endsection


@section('content')
<div class="section__content section__content--p30">
<div class="container">
    
       <h1>{{__('training.createDayTraining'.$week[$day])}} </h1>

</div>
</div>
@endsection