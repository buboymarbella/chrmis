<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $masters = \App\Answer::where('master_id',$id)->first();
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$answer = \App\Answer::where('master_id',$id)->first();
		
		return view('update.answer_records', compact('masters','answer'));
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
	
		$answer = \App\Answer::where('master_id',$id)->first();
		$answer->a34 = $request->a34;
		$answer->b34 = $request->b34;
		$answer->ab34_yes = $request->ab34_yes;
		$answer->a35 = $request->a35;
		$answer->a35_yes = $request->a35_yes;
		
		$answer->b35 = $request->b35;
		$answer->b35_date = $request->b35_date;
		$answer->b35_status = $request->b35_status;
		$answer->a36 = $request->a36;
		$answer->a36_yes = $request->a36_yes;
		
		$answer->a37 = $request->a37;
		$answer->a37_yes = $request->a37_yes;
		$answer->a38 = $request->a38;
		$answer->a38_yes = $request->a38_yes;
		$answer->b38 = $request->b38;
		
		$answer->b38_yes = $request->b38_yes;
		$answer->a39 = $request->a39;
		$answer->a39_yes = $request->a39_yes;
		$answer->a40 = $request->a40;
		$answer->a40_yes = $request->a40_yes;
		
		$answer->b40 = $request->b40;
		$answer->b40_yes = $request->b40_yes;
		$answer->c40 = $request->c40;
		$answer->c40_yes = $request->c40_yes;
		$answer->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Update Other Info Records"]);
		$ledger->save();
		
		return redirect()->route('other_info', $id)->with('success', 'Records Successfully Added!');
    }

    public function destroy($id)
    {
        //
    }
}
