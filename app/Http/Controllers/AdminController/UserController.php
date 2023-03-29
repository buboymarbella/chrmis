<?php

namespace App\Http\Controllers\AdminController;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
	//Authenticated User
    public function __construct(){
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
        $accounts = User::latest()->paginate(5);
		$count_user = User::all()->count();
        return view('admin.user_records',compact('accounts','count_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$this->authorize('viewAny', User::class);
		$office = \App\Unit::select("*")->get();
        return view('admin.add_users',compact('office'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->authorize('viewAny', User::class);
		
        // validation rules
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		
		$masters = new User;
		$masters->first_name = strtoupper($request->first_name);
		$masters->last_name = strtoupper($request->last_name);
		$masters->middle_name = strtoupper($request->middle_name);
		$masters->extension_name = strtoupper($request->extension_name);
		$masters->complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		$masters->acc_lvl =$request->acc_lvl;
		$masters->office = strtoupper($request->office);
		$masters->position = strtoupper($request->position);
		$masters->branch = strtoupper($request->branch);
		$masters->email = $request->email;
		$masters->password =  Hash::make($request->password);
		
		if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename = rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$masters->filename"));
            $masters->picture = $filename;
        }else{
			$masters->picture = 'profile.jpg';
		}
		/*if($image){
			$new_name = rand() . '.' . $image->getClientOriginalExtension();
			$image->move(public_path('uploads/profile'), $new_name);
			$masters->picture = $new_name;		
		}else{
			$masters->picture = 'profile.jpg';
		}*/
		
		$masters->save();
		
		
		return back()->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$masters = User::where('id',$id)->first();
		if(Auth::user()->acc_lvl != "Administrator"){
			$this->authorize('view', $masters);
		}else{
			$this->authorize('viewAny', User::class);
		}
		return view('admin.user_profile', compact('masters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = User::where('id',Auth::id())->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		$masters = User::where('id',$id)->first();
		$office = "";
		// if(Auth::user()->acc_lvl != "Administrator"){
		// 	$this->authorize('view', $masters);
		// 	$office = \App\Unit::select("*")->where('office',$masters->office)->groupBy("office")->orderBy("office")->get();
		// }else{
		// 	$this->authorize('viewAny', User::class);
		// 	$office = \App\Unit::select("*")->groupBy("office")->orderBy("office")->get();
		// }
        $office = \App\Unit::select("*")->get();
		return view('admin.edit_user', compact('masters','office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->authorize('viewAny', User::class);
        // validation rules
        $rules = [
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		
		$masters = User::findOrFail($id);
		$masters->first_name = strtoupper($request->first_name);
		$masters->last_name = strtoupper($request->last_name);
		$masters->middle_name = strtoupper($request->middle_name);
		$masters->extension_name = strtoupper($request->extension_name);
		$masters->complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		$masters->acc_lvl =$request->acc_lvl;
		$masters->office = strtoupper($request->office);
		$masters->position = strtoupper($request->position);
		$masters->branch = strtoupper($request->branch);
		
		if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename = rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$masters->filename"));
            $masters->picture = $filename;
        }else{
			$masters->picture = $masters->picture;
		}
		
		$masters->save();
		
		return back()->with('success', 'Records Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->authorize('viewAny', User::class);
        $users = User::where('id',$id)->first();
		$users->delete();
		
		//return redirect()->route('view_ctg_records')->with('success',"Successfully Deleted");
		return back()->with('success', 'Successfully Deleted!');
    }
}
