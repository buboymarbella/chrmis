<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
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
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => 'required',
        ];

		$masters = \Crypt::decrypt($request->master_id);
		
        $request->validate($rules);
		$check = \App\Elementary::where('master_id',$masters)->first();
		if(!empty($check)){
			return redirect()->route('education', $masters)->with('success', 'Records Successfully Added!');
		}
		
		$elem = new \App\Elementary;
		$elem->master_id = $masters;
		$elem->name_school = strtoupper($request->elem);
		$elem->period_from = $request->from1;
		$elem->period_to = $request->to1;
		$elem->year_graduated = $request->year1;
		$elem->honor_received = strtoupper($request->honor1);
		$elem->save();
		
		$high = new \App\High;
		$high->master_id = $masters;
		$high->high_name_school = strtoupper($request->high);
		$high->high_high_period_from = $request->from2;
		$high->high_period_to = $request->to2;
		$high->high_year_graduated = $request->year2;
		$high->high_honor_received = strtoupper($request->honor2);
		$high->save();

		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Add New Education Records"]);
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
		return view('content.education_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Elementary::where('master_id',$id)->first();
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$elem = \App\Elementary::where('master_id',$id)->first();
		$high = \App\High::where('master_id',$id)->first();
		
		return view('update.education_records', compact('masters','elem','high'));
    }

    public function update(Request $request, $id)
    {
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
        ];
		
        $request->validate($rules);
	
		$elem = \App\Elementary::where('master_id',$id)->first();
		$elem->name_school = strtoupper($request->elem);
		$elem->period_from = $request->from1;
		$elem->period_to = $request->to1;
		$elem->year_graduated = $request->year1;
		$elem->honor_received = strtoupper($request->honor1);
		$elem->save();
		
		$high = \App\High::where('master_id',$id)->first();
		$high->high_name_school = strtoupper($request->high);
		$high->high_period_from = $request->from2;
		$high->high_period_to = $request->to2;
		$high->high_year_graduated = $request->year2;
		$high->high_honor_received = strtoupper($request->honor2);
		$high->save();

		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Add New Education Records"]);
		$ledger->save();
		
		return redirect()->route('education', $id)->with('success', 'Records Successfully Added!');
    }

    public function destroy($id)
    {
        //
    }
}
