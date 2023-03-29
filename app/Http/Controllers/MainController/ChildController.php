<?php

namespace App\Http\Controllers\MainController;

use App\Child;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
		$masters = \Crypt::decrypt($request->master_id);
		$user_id = \App\Master::where('main_id',$masters)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
        $rules = [
            'master_id' => 'required',
        ];

        $request->validate($rules);

		$child = new \App\Child;
		$child->master_id = $masters;
		$child->child_name = strtoupper($request->child_name);
		$child->dob =  date("Y-m-d", strtotime($request->dob));
		$child->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Add New Child Records"]);
		$ledger->save();
		
		return redirect()->route('families_records', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.child_records', compact('master'));
    }

    public function edit($id)
    {
		$child_id = \App\Child::where('id',$id)->first();
		$masters = \App\Child::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$child_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
		return view('update.child_records', compact('masters'));
    }

    public function update(Request $request,$id)
    {
		$child_id = \App\Child::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$child_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
		$rules = [
            'master_id' => "unique:{$id}",
        ];

        $request->validate($rules);
	
		$child = \App\Child::where('id',$id)->first();
		$child->child_name = strtoupper($request->child_name);
		$child->dob =  date("Y-m-d", strtotime($request->dob));
		$child->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Update Child Records"]);
		$ledger->save();
		
		return redirect()->route('families_records', $child->master_id)->with('success', 'Records Successfully Added!');
    }

    public function destroy($id)
    {
        $master = \App\Child::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Delete Child Records"]);
		$ledger->save();
		
		$master->delete();
	
		return redirect()->route('families_records', $master->master_id)->with('success', 'Records Successfully Added!');
    }
}
