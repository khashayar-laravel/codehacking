@extends("layouts.admin")

@section("content")
   <style>
      th,td,tr{
         border:1px solid black;
        
      }
   </style>
   <h1>All Posts</h1>

   <table>
    <tr>
      <th>Id</th>
      <th>UserId</th>
      <th>CategoryId</th>
      <th>Photo_Id</th>
      <th>Title</th>
      <th>Body</th>
      <th>Created_at</th>
      <th>Updated_at</th>
    </tr>


      @foreach($posts as $post)
      <tr>
         <td>{{$post->id}}</td>
         <td>{{$post->user->name}}</td>
         <td>{{$post->category_id}}</td>
         <td><img height="40px" width="70px" src="{{$post->photo?$post->photo->file:'/images/defaultfolder/default.png'}}" alt=""></td>
         <td>{{$post->title}}</td>
         <td>{{$post->body}}</td>
         <td>{{$post->created_at->diffForHumans()}}</td>
         <td>{{$post->updated_at->diffForHumans()}}</td>
      </tr>
      @endforeach

   </table>


@stop