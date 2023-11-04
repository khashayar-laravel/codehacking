<?php
namespace App\Http\Controllers;
session_start();
if(!isset($_SESSION["photo_id_20"]))
{
	$_SESSION["photo_id_20"] = 0;
}
$lifetime=315360000; // duration in seconds
setcookie(session_name(),session_id(),time()+$lifetime);



use App\Http\Requests\CreateUserRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\User;
use App\Role;

use App\Http\Requests;
use phpDocumentor\Reflection\File;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::all();
		$photos = Photo::all();
        return view("admin.users.index",compact('users','photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		print_r($_SESSION);
		$role = Role::lists("name","id")->all();
		return view("admin.users.create",compact("role"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
		$input = $request->all();
		if($file = $request->file("photo_id")){
			$file_passvand = $file->getMimeType();
			$just_passvand =  ".".substr($file_passvand,6);
			$_SESSION["photo_id_20"] += 1;
			$image_name = $_SESSION["photo_id_20"].$just_passvand;
			$file->move("images",$image_name);
			$photo = new Photo;
			$photo = Photo::create(["file"=>$image_name,"id"=>$_SESSION["photo_id_20"]]);
			$input["photo_id"] = $_SESSION["photo_id_20"];
			$input["id"] = $_SESSION["photo_id_20"];
		}
	    else{
			//$input = array_add($input,"photo_id","1000");
		    $file_passvand = "image/jpg";
		    $just_passvand =  ".".substr($file_passvand,6);
		    $_SESSION["photo_id_20"] += 1;
		    $image_name ="Default".$just_passvand;
//		    $file->move("images",$image_name);
		    $photo = new Photo;
		    $photo = Photo::create(["file"=>$image_name,"id"=>$_SESSION["photo_id_20"]]);
		    $input["photo_id"] = $_SESSION["photo_id_20"];
		    $input["id"] = $_SESSION["photo_id_20"];

	    }

		$input["password"]=bcrypt($request->password);
		User::create($input);
		return redirect("admin/users");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$users = User::find($id);
		$roles = Role::lists("name","id")->all();
        return view("admin.users.edit",compact("users","roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
		$input = $request->all();   
		$input["password"] = bcrypt($request->password);
        if($file = $request->file("photo_id"))
        {
	        $photo = new Photo;
	        $photo->find($id)->delete();
	        $file_passvand = $file->getMimeType();
	        $just_passvand =  ".".substr($file_passvand,6);
//	        $_SESSION["photo_id_20"] += 1;
	        $image_name = $id.$just_passvand;
	        //$name = time().$file->getClientOriginalName();

	        $file->move("images",$image_name);
	        $photo = Photo::create(["file"=>$image_name,"id"=>$id]);
	        $input["photo_id"] = $id;
	        $input["id"] = $id;
        }
		$user->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
