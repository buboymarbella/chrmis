<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Voluntary;
use Illuminate\Http\Request;

class VoluntaryController extends Controller
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
			'name_organization' => 'required',
        ];

        $request->validate($rules);
	
		$voluntary = new \App\Voluntary;
		$voluntary->master_id = $masters;
		$voluntary->name_organization = strtoupper($request->name_organization);
		$voluntary->inclusive_from = date("Y-m-d", strtotime($request->inclusive_from));
		if($request->inclusive_to == ""){
			$voluntary->inclusive_to = "";
		}else{
			$voluntary->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		}
		$voluntary->hour_number = $request->hour_number;
		$voluntary->position = strtoupper($request->position);
		$voluntary->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Add New Child Records"]);
		$ledger->save();
		
		return redirect()->route('voluntary', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.voluntary_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Voluntary::where('id',$id)->first();
		$user_id = \App\Master::where('main_id', $masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.voluntary_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$voluntary_id = \App\Voluntary::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$voluntary_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];

        $request->validate($rules);
	
		$voluntary = \App\Voluntary::where('id',$id)->first();
		$voluntary->name_organization = strtoupper($request->name_organization);
		$voluntary->inclusive_from = date("Y-m-d", strtotime($request->inclusive_from));
		if($request->inclusive_to == ""){
			$voluntary->inclusive_to = "";
		}else{
			$voluntary->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		}
		$voluntary->hour_number = $request->hour_number;
		$voluntary->position = strtoupper($request->position);
		$voluntary->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Voluntary Records Updated"]);
		$ledger->save();
		
		return redirect()->route('voluntary', $voluntary->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        $master = \App\Voluntary::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Voluntary Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('voluntary', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
