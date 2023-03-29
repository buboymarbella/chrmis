<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Vocational;
use Illuminate\Http\Request;

class VocationalController extends Controller
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
		
		$vocational = new \App\Vocational;
		$vocational->master_id = $masters;
		$vocational->name_school = strtoupper($request->vocational);
		$vocational->period_from = $request->from4;
		$vocational->period_to = $request->to4;
		$vocational->course = strtoupper($request->course2);
		$vocational->year_graduated = $request->year4;
		$vocational->honor_received = strtoupper($request->honor4);
		$vocational->units_earned = $request->units_earned2;
		$vocational->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Add New Vocational Records"]);
		$ledger->save();
		
		return redirect()->route('education', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.vocational_records', compact('master'));
    }

    public function edit($id)
    {
        $vocational_id = \App\Vocational::where('id',$id)->first();
		$masters = \App\Vocational::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$vocational_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.vocational_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$vocational_id = \App\Vocational::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$vocational_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];
		
        $request->validate($rules);
		
		$vocational = \App\Vocational::where('id',$id)->first();
		$vocational->name_school = strtoupper($request->vocational);
		$vocational->period_from = $request->from4;
		$vocational->period_to = $request->to4;
		$vocational->course = strtoupper($request->course2);
		$vocational->year_graduated = $request->year4;
		$vocational->honor_received = strtoupper($request->honor4);
		$vocational->units_earned = $request->units_earned2;
		$vocational->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Vocational Updated"]);
		$ledger->save();
		
		return redirect()->route('education', $vocational->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        $master = \App\Vocational::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Vocational Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('education', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
