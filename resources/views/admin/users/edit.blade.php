<?php

?>
@extends("layouts.admin")

@section("content")
    <h1>EditPage</h1>
    <div>
        <img width="50px" src='{{$users->photo?$users->photo->file:"/defaultimage/pishfarz.jpg"}}'>

    </div>
    <?php
        print_r($users);
        ?>

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
        {!! Form::select("is_active",array(0=>"NotActive",1=>"Active"),$users->is_active,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group">
        {!! Form::label("role","your role:") !!}
        {!! Form::select("role_id",array(0=>"undefined",1=>"Admin",2=>"Author"),$users->role_id?$users->role_id:0,["class"=>"form-control"]) !!}
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

      {!! Form::open(["method"=>"DELETE","action"=>["AdminUsersController@destroy",$users->id]]) !!}

              <div class="form-group">
                  {!! Form::submit("Delete",["class"=>"btn btn-primary"]) !!}
              </div>
          {!! Form::close() !!}

    @include("includes.error")
@stop

<?php

    ?>
