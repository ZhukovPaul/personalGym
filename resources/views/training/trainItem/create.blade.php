@extends('layouts.app')

@section('breadscrumbs')
  {{ Breadcrumbs::render('training') }}
@endsection


@section('content')
 
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">{{__("training.addExercise")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{Form::open([
            "method"=>"POST",
            "action"=>"\App\Http\Controllers\TrainingPlanController@addExercise",
            'files'=>false
    ])}}

    {{Form::hidden('user_id',Auth::user()->id)}}
    {{Form::hidden('day_of_week',$day)}}
    {{Form::hidden('training_plan_id',$trainingPlan->id)}}

    <div class="row form-group">
        <div class="col col-md-3">
            {{Form::label('exercise',__("training.exercise"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-9">
        {{Form::select('exercise',$workouts,null,["class"=>"custom-select"])}}
    
        </div>
    </div> 
    @for ($i = 0; $i < 5; $i++)
    <div class="row form-group" id="row{{$i}}">
        <div class="col col-md-3">
            {{Form::label('set',__("training.set"),["class"=>"form-control-label"])}}
        </div>
        <div class="col-12 col-md-3">
        {{Form::number('set_count[]',10,["class"=>"form-control"])}}
        </div>
        <div class="col-12 col-md-1">
            X
        </div>
        <div class="col-12 col-md-3">
        {{Form::number('set_weight[]',10,["class"=>"form-control"])}}  
        </div>
        <div class="col-12 col-md-1">
        Kg
        </div>
        <div class="col-12 col-md-1">
        <a onclick="$('#row{{$i}}').remove();" >X</a>
        </div>
    </div> 
    @endfor
    </div>
      <div class="modal-footer">
        {{Form::submit(__("training.add"),["class"=>"btn btn-primary"])}}
      </div>
 

    {{Form::close()}}
    </div>
  </div>
</div> 

 

<link href="/css/theme.css" rel="stylesheet" media="all">
<div class="section__content section__content--p30">
<div class="container">
    
   
 
      
        
        <div class="card">
                                    <div class="card-header">
                                        <strong>{{__('training.createDayTraining'.$week[$day])}} </strong> 
                                    </div>
                                    <div class="card-body card-block">
 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
{{__("training.addExercise")}}
</button>
 


    
    <!--table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>name</td>
                                                    <td>role</td>
                                                    <td>type</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role admin">admin</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                                <option selected="selected">Full Control</option>
                                                                <option value="">Post</option>
                                                                <option value="">Watch</option>
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 135.783px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-p6-container"><span class="select2-selection__rendered" id="select2-property-p6-container" title="Full Control">Full Control</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" checked="checked">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">user</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                                <option value="">Full Control</option>
                                                                <option value="" selected="selected">Post</option>
                                                                <option value="">Watch</option>
                                                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 135.783px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-52-container"><span class="select2-selection__rendered" id="select2-property-52-container" title="Post">Post</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">user</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                                <option value="">Full Control</option>
                                                                <option value="" selected="selected">Post</option>
                                                                <option value="">Watch</option>
                                                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 135.783px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-e5-container"><span class="select2-selection__rendered" id="select2-property-e5-container" title="Watch">Watch</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role member">member</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                                <option selected="selected">Full Control</option>
                                                                <option value="">Post</option>
                                                                <option value="">Watch</option>
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 135.783px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-g6-container"><span class="select2-selection__rendered" id="select2-property-g6-container" title="Full Control">Full Control</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table-->

</div>
</div>
</div>
</div>
@endsection