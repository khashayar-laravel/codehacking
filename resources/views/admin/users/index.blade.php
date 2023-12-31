@extends("layouts.admin");

@section("content")
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
    @if(Session::has("deleted_user"))
        {{session("deleted_user")}}
        @endif
    @if(Session::has("created_user"))
        {{session("created_user")}}
    @endif

    @if(Session::has("updated_user"))
        {{session("updated_user")}}
    @endif

    @if($users)

        <h1>A Fancy Table</h1>
        <table id="customers">
            <tr>
                <th> UserId </th>
                <th> UserName </th>
                <th> Image </th>
                <th> Email </th>
                <th> Role </th>
                <th> Status </th>
                <th> Created_at </th>
                <th> Updated_at </th>
                <th> Photo_id </th>

            </tr>

        @foreach($users as $user)
                <?php
//                    echo($user->photo->file);
                ?>

                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route("admin.users.edit",$user->id)}}">{{$user->name ? $user->name : "-"}}</a></td>
                    <td><a href="{{route("admin.users.edit",$user->id)}}"><img width="50px" src='{{$user->photo?$user->photo->file:"/defaultimage/pishfarz.jpg"}}'></a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? $user->role->name : "HasNoRole"}}</td>
                    <td>{{$user->is_active == 1 ? "Active" : "NotActive"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>{{$user->photo_id}}</td>

                </tr>

        @endforeach

            @endif





@stop