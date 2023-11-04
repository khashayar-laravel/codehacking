<?php

?>
@extends("layouts.admin")

@section("content")
    <h1>EditPage</h1>
    <div>
       <img height = "50px" src='{{$users->photo->file}}'>
    </div>
    {!! Form::model($users,(["method"=>"PATCH","action"=>["AdminUsersController@update",$users->id],"files"=>"true"])) !!}
    <div class="form-group">
        {!! Form::label("name","Enter Username:") !!}
        {!! Form::text("name",null,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label("email","Enter Email:") !!}
        {!! Form::email("email",null,["class"=>"form-control"]) !!}
    </div>


    <div class="form-group">
        {!! Form::label("is_active","Enter Status:") !!}
        {!! Form::select("is_active",array(0=>"NotActive",1=>"Active"),0,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label("role","your role:") !!}
        {!! Form::select("role_id",[""=>"SelectRole"]+$roles,0,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label("photo_id","Upload file:") !!}
        {!! Form::file("photo_id",null,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label("password","Password:") !!}
        {!! Form::password("password",["class"=>"form-control"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit("submit",["class"=>"btn btn-primary"]) !!}
    </div>
    {!! Form::close() !!}

    @include("includes.error")
@stop

