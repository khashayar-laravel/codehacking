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
use Illuminate\Support\Facades\Session;
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
	    if(trim($request->password) == ''){

		    $input = $request->except('password');

	    } else{


		    $input = $request->all();

		    $input['password'] = bcrypt($request->password);

	    }



	    if($file = $request->file('photo_id')) {


		    $name = time() . $file->getClientOriginalName();


		    $file->move('images', $name);

		    $photo = Photo::create(['file'=>$name]);


		    $input['photo_id'] = $photo->id;


	    }


	    User::create($input);
	    Session::flash("created_user","the User {$input["name"]} created !");

	    return redirect('/admin/users');


//        return $request->all();




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
		var_dump(public_path());
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


	    if(trim($request->password) == ''){

		    $input = $request->except('password');

	    } else{


		    $input = $request->all();

		    $input['password'] = bcrypt($request->password);

	    }




	    if($file = $request->file('photo_id')){


		    $name = time() . $file->getClientOriginalName();

		    $file->move('images', $name);

		    $photo = Photo::create(['file'=>$name]);


		    $input['photo_id'] = $photo->id;


	    }



	    $user->update($input);

		Session::flash("updated_user","the user {$input['name']} updated!");

	    return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::findOrFail($id);
		if($user->photo){
			unlink(public_path().$user->photo->file);
		}
		$username = $user->name;
		$user->delete();
	    Session::flash("deleted_user","the user {$username} Deleted!");
        return redirect("admin/users");
    }
}
