@extends('layouts.app')

@section('content')

<div class="container">
 
    <div class="row mt-3">
        <div class="col-lg-8">
        <div class="card">
                                    <div class="card-header">
                                        <strong>Personal settings</strong>
                                        <small> <a class="" href="/personal/edit">Edit</a></small>
                                    </div>
                                    <div class="card-body card-block">
       
        <table class="table table-borderless table-striped table-earning">
             
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
                <td>Gender</td>
                <td>{{$user->gender}}</td>
            </tr>
        </table>
        </div>
        </div>
    </div>
   
   
</div>
@endsection