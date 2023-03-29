<?php

namespace App\Http\Controllers\MainController;

use App\Eligibility;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EligibilityController extends Controller
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
		$masters = \Crypt::decrypt($request->master_id);
	
		$eligibility = new \App\Eligibility;
		$eligibility->master_id = $masters;
		$eligibility->eligibility = strtoupper($request->eligibility);
		$eligibility->rating = $request->rating;
		$eligibility->date_examination = date("Y-m-d", strtotime($request->date_examination));
		$eligibility->examination_place = strtoupper($request->examination_place);
		$eligibility->license_number = $request->license_number;
		$eligibility->license_validity = date("Y-m-d", strtotime($request->license_validity));
		$eligibility->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Eligibility Records"]);
		$ledger->save();
		
		return redirect()->route('eligibility', $masters)->with('success', 'Records Successfully Added!');

    }
   
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		$qualification = \App\Qualification::select("*")->orderBy('eligibility','asc')->get();
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.eligibility_records', compact('master','qualification'));
    }
	
    public function edit($id)
    {
		$eligibility_id = \App\Eligibility::where('id',$id)->first();
		$qualification = \App\Qualification::select("*")->orderBy('eligibility','asc')->get();
        $masters = \App\Eligibility::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$eligibility_id->master_id)->first();
		
		$user_id = \App\Master::where('main_id',$eligibility_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.eligibility_records', compact('masters','qualification'));
    }
    
    public function update(Request $request, $id)
    {
		$eligibility_id = \App\Eligibility::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$eligibility_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];

        $request->validate($rules);
	
		$eligibility = \App\Eligibility::where('id',$id)->first();
		$eligibility->eligibility = strtoupper($request->eligibility);
		$eligibility->rating = $request->rating;
		$eligibility->date_examination = date("Y-m-d", strtotime($request->date_examination));
		$eligibility->examination_place = strtoupper($request->examination_place);
		$eligibility->license_number = $request->license_number;
		$eligibility->license_validity = date("Y-m-d", strtotime($request->license_validity));
		$eligibility->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => " Eligibility Records Updated"]);
		$ledger->save();
		
		return redirect()->route('eligibility', $eligibility->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        $master = \App\Eligibility::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Eligibility Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('eligibility', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
