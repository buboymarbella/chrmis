<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Other;
use Illuminate\Http\Request;

class OtherController extends Controller
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
		
	
		$other = new \App\Other;
		$other->master_id = $masters;
		$other->skills = strtoupper($request->skills);
		$other->recognition = strtoupper($request->recognition);
		$other->association_member = strtoupper($request->association);
		$other->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Skills\Recog\Assoc Records"]);
		$ledger->save();
		
		return redirect()->route('skills', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.other_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Other::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.other_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$other_id = \App\Other::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$other_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];
		
		$request->validate($rules);
	
		$other = \App\Other::where('id',$id)->first();
		$other->skills = strtoupper($request->skills);
		$other->recognition = strtoupper($request->recognition);
		$other->association_member = strtoupper($request->association);
		$other->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' =>"Skills\Recog\Assoc Record Updated"]);
		$ledger->save();
		
		return redirect()->route('skills', $other->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
		$master = \App\Other::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Skills\Recog\Assoc Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('skills', $master->master_id)->with('success', 'Records Deleted!');
    }
}
