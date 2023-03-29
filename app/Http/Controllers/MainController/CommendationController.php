<?php

namespace App\Http\Controllers\MainController;

use App\Commendation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommendationController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$masters = \Crypt::decrypt($request->master_id);
		$user_id = \App\Master::where('main_id',$masters)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}

        $rules = [
            'master_id' => 'required',
			'commendation' => "required",
			'commendation_date' => "required"
        ];

        $request->validate($rules);

		$commendation_type = "";
		$commendation_title ="";

		if($request->commendation >=1 and $request->commendation <=3){
			$commendation_type = "NATIONAL AWARDS";
		}elseif($request->commendation >=4 and $request->commendation <=15){
			$commendation_type = "HONOR AWARDS";
		}elseif($request->commendation >=16 and $request->commendation <=27){
			$commendation_type = "OTHER INCENTIVES";
		}

		if($request->commendation == 1){
			$commendation_title ="President Lingkod Bayan";
		}elseif($request->commendation == 2){
			$commendation_title ="Outstanding Public";
		}elseif($request->commendation == 3){
			$commendation_title ="Civil Service Commission Pagasa Awards";
		}elseif($request->commendation == 4){
			$commendation_title ="Distinguished Honor Medal";
		}elseif($request->commendation == 5){
			$commendation_title ="Superior Honor Medal";
		}elseif($request->commendation == 6){
			$commendation_title ="AFP Civilian Human Resource of the Year Award (Supervisor)";
		}elseif($request->commendation == 7){
			$commendation_title ="AFP Civilian Human Resource of the Year Award (Employee)";
		}elseif($request->commendation == 8){
			$commendation_title ="Civilian Merit Medal";
		}elseif($request->commendation == 9){
			$commendation_title ="Adjutant General Service (AGS) Badge";
		}elseif($request->commendation == 10){
			$commendation_title ="AFP Home Defense Badge";
		}elseif($request->commendation == 11){
			$commendation_title ="Military Civic Acation Medal";
		}elseif($request->commendation == 12){
			$commendation_title ="Wounded Personnel Medal";
		}elseif($request->commendation == 13){
			$commendation_title ="Parangal sa Kapanalig ng Sandatahang Lakas ng Pilipinas (Medal & Ribbon)";
		}elseif($request->commendation == 14){
			$commendation_title ="Retirement Award (Compulsary Retirement)";
		}elseif($request->commendation == 15){
			$commendation_title ="Certificate of Honorable Service (Optional Retirement)";
		}elseif($request->commendation == 16){
			$commendation_title ="Productivity Enchanment Incentive";
		}elseif($request->commendation == 17){
			$commendation_title ="Length of Service Incentive";
		}elseif($request->commendation == 18){
			$commendation_title ="Career and Self-Development Incentive";
		}elseif($request->commendation == 19){
			$commendation_title ="Loyalty Incentive";
		}elseif($request->commendation == 20){
			$commendation_title ="Best Employee Award";
		}elseif($request->commendation == 21){
			$commendation_title ="Gantimpala Agad Award";
		}elseif($request->commendation == 22){
			$commendation_title ="Exemplary Behavior Award";
		}elseif($request->commendation == 23){
			$commendation_title ="Most Courteous Employee Award";
		}elseif($request->commendation == 24){
			$commendation_title ="Best Organization Unit Award";
		}elseif($request->commendation == 25){
			$commendation_title ="Cost Economy Measure Award";
		}elseif($request->commendation == 26){
			$commendation_title ="Miscellaneous Incentives";
		}elseif($request->commendation == 27){
			$commendation_title ="Commendation";
		}elseif($request->commendation == 28){
			$commendation_title ="DND Award";
		}elseif($request->commendation == 29){
			$commendation_title ="Major Service Award (Command Plaque)";
		}elseif($request->commendation == 30){
			$commendation_title ="Chief of Office Award";
		}else{
			$commendation_title ="";
		}
	
		$commendation = new \App\Commendation;
		$commendation->master_id = $masters;
		$commendation->type_awards = $commendation_type;
		$commendation->commendation = strtoupper($commendation_title);
		$commendation->commendation_date = date("Y-m-d", strtotime($request->commendation_date));
		$commendation->issued_by = strtoupper($request->issued_by);
		$commendation->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Commendation Records"]);
		$ledger->save();
		
		return redirect()->route('commendation', $masters)->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commendation  $commendation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.commendation_records', compact('master'));
    }

    public function edit($id)
    {
		$masters = \App\Commendation::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$masters = \App\Commendation::where('id',$id)->first();
		$user_id = \App\Master::where('main_id', $masters->master_id)
						->join('users', 'masters.user_id', '=', 'users.id')
						->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.commendation_records', compact('masters'));
    }

    public function update(Request $request, $id)
    {
		$commendation_id = \App\Commendation::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$commendation_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
			'commendation' => "required",
			'commendation_date' => "required"
        ];
		
		$request->validate($rules);

		$commendation_type = "";
		$commendation_title ="";

		if($request->commendation >=1 and $request->commendation <=3){
			$commendation_type = "NATIONAL AWARDS";
		}elseif($request->commendation >=4 and $request->commendation <=15){
			$commendation_type = "HONOR AWARDS";
		}elseif($request->commendation >=16 and $request->commendation <=27){
			$commendation_type = "OTHER INCENTIVES";
		}

		if($request->commendation == 1){
			$commendation_title ="President Lingkod Bayan";
		}elseif($request->commendation == 2){
			$commendation_title ="Outstanding Public";
		}elseif($request->commendation == 3){
			$commendation_title ="Civil Service Commission Pagasa Awards";
		}elseif($request->commendation == 4){
			$commendation_title ="Distinguished Honor Medal";
		}elseif($request->commendation == 5){
			$commendation_title ="Superior Honor Medal";
		}elseif($request->commendation == 6){
			$commendation_title ="AFP Civilian Human Resource of the Year Award (Supervisor)";
		}elseif($request->commendation == 7){
			$commendation_title ="AFP Civilian Human Resource of the Year Award (Employee)";
		}elseif($request->commendation == 8){
			$commendation_title ="Civilian Merit Medal";
		}elseif($request->commendation == 9){
			$commendation_title ="Adjutant General Service (AGS) Badge";
		}elseif($request->commendation == 10){
			$commendation_title ="AFP Home Defense Badge";
		}elseif($request->commendation == 11){
			$commendation_title ="Military Civic Acation Medal";
		}elseif($request->commendation == 12){
			$commendation_title ="Wounded Personnel Medal";
		}elseif($request->commendation == 13){
			$commendation_title ="Parangal sa Kapanalig ng Sandatahang Lakas ng Pilipinas (Medal & Ribbon)";
		}elseif($request->commendation == 14){
			$commendation_title ="Retirement Award (Compulsary Retirement)";
		}elseif($request->commendation == 15){
			$commendation_title ="Certificate of Honorable Service (Optional Retirement)";
		}elseif($request->commendation == 16){
			$commendation_title ="Productivity Enchanment Incentive";
		}elseif($request->commendation == 17){
			$commendation_title ="Length of Service Incentive";
		}elseif($request->commendation == 18){
			$commendation_title ="Career and Self-Development Incentive";
		}elseif($request->commendation == 19){
			$commendation_title ="Loyalty Incentive";
		}elseif($request->commendation == 20){
			$commendation_title ="Best Employee Award";
		}elseif($request->commendation == 21){
			$commendation_title ="Gantimpala Agad Award";
		}elseif($request->commendation == 22){
			$commendation_title ="Exemplary Behavior Award";
		}elseif($request->commendation == 23){
			$commendation_title ="Most Courteous Employee Award";
		}elseif($request->commendation == 24){
			$commendation_title ="Best Organization Unit Award";
		}elseif($request->commendation == 25){
			$commendation_title ="Cost Economy Measure Award";
		}elseif($request->commendation == 26){
			$commendation_title ="Miscellaneous Incentives";
		}elseif($request->commendation == 27){
			$commendation_title ="Commendation";
		}else{
			$commendation_title ="";
		}
	
		$commendation = \App\Commendation::where('id',$id)->first();
		$commendation->type_awards = $commendation_type;
		$commendation->commendation = strtoupper($commendation_title);
		$commendation->commendation_date = date("Y-m-d", strtotime($request->commendation_date));
		$commendation->issued_by = strtoupper($request->issued_by);
		$commendation->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Update Commendation Records"]);
		$ledger->save();
		
		return redirect()->route('commendation', $commendation->master_id)->with('success', 'Records Successfully Added!');
    }

    public function destroy($id)
    {
        $master = \App\Commendation::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Delete Commendation Records"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('commendation', $master->master_id)->with('success', 'Records Successfully Added!');
    }
}
