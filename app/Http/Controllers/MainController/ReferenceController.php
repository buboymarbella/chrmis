<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
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
	
		$reference = new \App\Credential;
		$reference->master_id = $masters;
		$reference->name = strtoupper($request->name);
		$reference->address = strtoupper($request->address);
		$reference->telephone_no = strtoupper($request->telephone_no);
		$reference->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Update Reference Records"]);
		$ledger->save();
		
		return redirect()->route('reference', $masters)->with('success', 'Records Successfully Added!');
    }

    
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.reference_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Credential::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.reference_records', compact('masters'));
    }

    public function update(Request $request,$id)
    {
		$credential_id = \App\Credential::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$credential_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];

        $request->validate($rules);
	
		$reference = \App\Credential::where('id',$id)->first();
		$reference->name = strtoupper($request->name);
		$reference->address = strtoupper($request->address);
		$reference->telephone_no = strtoupper($request->telephone_no);
		$reference->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Reference Record Updated"]);
		$ledger->save();
		
		return redirect()->route('reference', $reference->master_id)->with('success', 'Successfully Updated!');
    }

    public function destroy($id)
    {
		$master = \App\Credential::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Reference Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('reference', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
