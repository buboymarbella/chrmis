<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegeController extends Controller
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
			'course2' => 'required',
			'year_required' => 'required',
        ];

		$masters = \Crypt::decrypt($request->master_id);
		
        $request->validate($rules);
		
		$college = new \App\College;
		$college->master_id = $masters;
		$college->name_school = strtoupper($request->college);
		$college->period_from = $request->from4;
		$college->period_to = $request->to4;
		$college->required_years = $request->year_required;
		$college->course = strtoupper($request->course2);
		$college->year_graduated = $request->year4;
		$college->honor_received = strtoupper($request->honor4);
		$college->units_earned = $request->units_earned2;
		$college->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Add New College Records"]);
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
		return view('content.college_records', compact('master'));
    }

    public function edit($id)
    {
        $college_id = \App\College::where('id',$id)->first();
		$masters = \App\College::where('id',$id)->first();
		
		$user_id = \App\Master::where('main_id',$college_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.college_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$college_id = \App\College::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$college_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
			'course2' => 'required',
			'year_required' => 'required',
        ];
		
        $request->validate($rules);
		
		$college = \App\College::where('id',$id)->first();
		$college->name_school = strtoupper($request->college);
		$college->period_from = $request->from4;
		$college->period_to = $request->to4;
		$college->required_years = $request->year_required;
		$college->course = strtoupper($request->course2);
		$college->year_graduated = $request->year4;
		$college->honor_received = strtoupper($request->honor4);
		$college->units_earned = $request->units_earned2;
		$college->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Update College Records"]);
		$ledger->save();
		
		return redirect()->route('education', $college->master_id)->with('success', 'Records Successfully Added!');
    }

    public function destroy($id)
    {
        $master = \App\College::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Delete College Records"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('education', $master->master_id)->with('success', 'Records Successfully Added!');
    }
}
