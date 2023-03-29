<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
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
			'position_title' => 'required',
			'inclusive_from' => 'required',
			'gov_service'=> 'required'
        ];

		
        $work = \App\Work::select('*')->where( [ ['master_id',$masters],['inclusive_to','']])->first();
		if($work){
			return back()->with('error', 'You Already have Present Job Status!');
		}

		if($request->inclusive_to == "" AND $request->gov_service == "Y"){
			$hired =date('Y-m-d', strtotime($request->inclusive_from));
			$b = date("Y-m-d");
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}elseif($request->inclusive_to != "" AND $request->gov_service == "Y"){
			$hired =date('Y-m-d', strtotime($request->inclusive_from));
			$b = date('Y-m-d', strtotime($request->inclusive_to));
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}else{
			$d=0;
		}

		$s_increment = $request->step_increment;
		if($s_increment == "" || $s_increment == null){
			$s_increment = 0;
		}else{
			$s_increment = $request->step_increment;
		}
		
        $request->validate($rules);
	
		$workexpe = new \App\Work;
		$workexpe->master_id = $masters;
		$workexpe->inclusive_from = date('Y-m-d', strtotime($request->inclusive_from));
		if($request->inclusive_to == ""){
			$workexpe->inclusive_to = "";
		}else{
			$workexpe->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		}
		$workexpe->position_title = strtoupper($request->position_title);
		$workexpe->department = strtoupper($request->department);
		$workexpe->salary = $request->salary;
		$workexpe->plantilla_number = $request->plantilla_number;
		$workexpe->salary_grade = $request->salary_grade;
		$workexpe->step_increment = $s_increment;
		$workexpe->year_exp = $d;
		$workexpe->job_status = $request->job_status;
		$workexpe->gov_service = $request->gov_service;
		$workexpe->supervisor = strtoupper($request->supervisor);
		$workexpe->agency = strtoupper($request->agency);
		$workexpe->duties = $request->duties;
		$workexpe->save();	
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Add New Work Experience Records"]);
		$ledger->save();
		
		return redirect()->route('workexpe', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.workexpe_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Work::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.workexpe_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$work_id = \App\Work::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$work_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$rules = [
            'master_id' => "unique:{$id}",
			'position_title' => 'required',
			'inclusive_from' => 'required',
			'gov_service'=> 'required'
        ];

		if($request->inclusive_to == "" AND $request->gov_service == "Y"){
			$hired =date('Y-m-d', strtotime($request->inclusive_from));
			$b = date("Y-m-d");
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}elseif($request->inclusive_to != "" AND $request->gov_service == "Y"){
			$hired =date('Y-m-d', strtotime($request->inclusive_from));
			$b = date('Y-m-d', strtotime($request->inclusive_to));
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}else{
			$d=0;
		}
		
		$s_increment = $request->step_increment;
		if($s_increment == "" || $s_increment == null || $s_increment == 0){
			$s_increment = 0;
		}else{
			$s_increment = $request->step_increment;
		}
		
        $request->validate($rules);
	
		$workexpe = \App\Work::where('id',$id)->first();
		$workexpe->inclusive_from = date('Y-m-d', strtotime($request->inclusive_from));
		if($request->inclusive_to == ""){
			$workexpe->inclusive_to = "";
		}else{
			$workexpe->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		}
		$workexpe->plantilla_number = $request->plantilla_number;
		$workexpe->position_title = strtoupper($request->position_title);
		$workexpe->department = strtoupper($request->department);
		$workexpe->salary = $request->salary;
		$workexpe->salary_grade = $request->salary_grade;
		$workexpe->step_increment = $s_increment;
		$workexpe->job_status = $request->job_status;
		$workexpe->year_exp = $d;
		$workexpe->gov_service = $request->gov_service;
		$workexpe->supervisor = strtoupper($request->supervisor);
		$workexpe->agency = strtoupper($request->agency);
		$workexpe->duties = $request->duties;
		$workexpe->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Work Experience Record Updated"]);
		$ledger->save();
		
		return redirect()->route('workexpe', $workexpe->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        $master = \App\Work::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Work Experience Records Deleted"]);
		$ledger->save();
		
		$master->delete();

		return redirect()->route('workexpe', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
