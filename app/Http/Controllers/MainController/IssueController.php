<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
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
		
	
		$issues = new \App\Issue;
		$issues->master_id = $masters;
		$issues->gov_issue = strtoupper($request->gov_issue);
		$issues->license_number = strtoupper($request->license_number);
		$issues->place_issue = strtoupper($request->place_issue);
		
		$issues->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Govt Issued ID Records"]);
		$ledger->save();
		
		return redirect()->route('issued', $masters)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.issue_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Issue::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.issue_records', compact('masters'));
    }

    public function update(Request $request,$id)
    {
		$issue_id = \App\Issue::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$issue_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
			'gov_issue' => 'required',
        ];

        $request->validate($rules);
	
		$issues = \App\Issue::where('id',$id)->first();
		$issues->gov_issue = strtoupper($request->gov_issue);
		$issues->license_number = strtoupper($request->license_number);
		$issues->place_issue = strtoupper($request->place_issue);
		
		$issues->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Govt Issued ID Records Updated"]);
		$ledger->save();
		
		return redirect()->route('issued', $issues->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy(Issue $issue)
    {
        
    }
}
