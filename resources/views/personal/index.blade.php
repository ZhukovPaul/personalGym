@extends('layouts.app')

@section('title',"Profile user: ".$user->name." " .$user->lastname )
@section('content')

<div class="container">

    <div class="row mt-3">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Personal settings</strong>
                    @auth
                    <small> <a class="" href="/personal/edit">Edit</a></small>
                    @endif
                    </div>
                <div class="card-body card-block">
         <div class="row">
             <div class="col-3 text-center">
                 @if(! is_null($user->getPersonalPhoto()))
                    <img src="{{$user->getPersonalPhoto()->getUrl()}}" class="  rounded-circle "   />
                 @endif
             </div>
             <div class="col-9">
             <table class="table table-borderless   table-earning">

            <tr>
                <td>NAME</td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td>{{$user->lastname}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td>{{date('d.m.Y', strtotime($user->birthday)) }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{$user->gender}}</td>
            </tr>
        </table>
             </div>
         </div>

        </div>
        </div>
    </div>


</div>
@endsection
