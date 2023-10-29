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
    <?php
//        $users = App\User::all();
//    dd($users);
    ?>
    @if($users)

        <h1>A Fancy Table</h1>
        <table id="customers">
            <tr>
                <th> UserId </th>
                <th> UserName </th>
                <th> Email </th>
                <th> Role </th>
                <th> Status </th>
                <th> Created_at </th>
                <th> Updated_at </th>

            </tr>
{{--        <?php--}}
{{--		        dd($users);--}}
{{--            ?>--}}
        @foreach($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name ? $user->name : "-"}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? $user->role->name : "HasNoRole"}}</td>
                    <td>{{$user->is_active == 1 ? "Active" : "NotActive"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at}}</td>

                </tr>

        @endforeach

        </table>
    @endif


@stop