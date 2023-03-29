<?php

namespace App\Http\Controllers\AdminController;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $masters = User::where('id',$id)->first();
		if(Auth::user()->acc_lvl != "Administrator"){
			$this->authorize('view', $masters);
		}else{
			$this->authorize('viewAny', User::class);
		}
		return view('admin.change_password', compact('masters'));
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
        // validation rules
        $rules = [
            'password' => ['required', 'string', 'min:8', 'confirmed', 'unique:users'],
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		
		$masters = User::findOrFail($id);
		
		if(Auth::user()->acc_lvl != "Administrator"){
			$this->authorize('view', $masters);
		}else{
			$this->authorize('viewAny', User::class);
		}
		
		$masters->password =  Hash::make($request->password);
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
        //
    }
}
