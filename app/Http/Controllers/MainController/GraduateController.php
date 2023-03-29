<?php

namespace App\Http\Controllers\MainController;

use App\Graduate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraduateController extends Controller
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
			'type_of_schooling'=>'required'
        ];
		
        $request->validate($rules);
		
		$graduate = new \App\Graduate;
		$graduate->master_id = $masters;
		$graduate->name_school = strtoupper($request->graduate);
		$graduate->period_from = $request->from4;
		$graduate->period_to = $request->to4;
		$graduate->course = strtoupper($request->course2);
		$graduate->year_graduated = $request->year4;
		$graduate->honor_received = strtoupper($request->honor4);
		$graduate->units_earned = $request->units_earned2;
		$graduate->type_schooling = $request->type_of_schooling;
		$graduate->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Add New Graduate Studies Records"]);
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
		return view('content.graduate_records', compact('master'));
    }

    public function edit($id)
    {
		$graduate_id = \App\Graduate::where('id',$id)->first();
		$masters = \App\Graduate::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$graduate_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.graduate_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$graduate_id = \App\Graduate::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$graduate_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
			'type_of_schooling'=>'required'
        ];

        $request->validate($rules);
		
		$college = \App\Graduate::where('id',$id)->first();
		$college->name_school = strtoupper($request->graduate);
		$college->period_from = $request->from4;
		$college->period_to = $request->to4;
		$college->course = strtoupper($request->course2);
		$college->year_graduated = $request->year4;
		$college->honor_received = strtoupper($request->honor4);
		$college->units_earned = $request->units_earned2;
		$college->type_schooling = $request->type_of_schooling;
		$college->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Graduate Studies Record Updated"]);
		$ledger->save();
		
		return redirect()->route('education', $college->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        $master = \App\Graduate::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' =>  "Graduate Studies Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('education', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
