<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
		date_default_timezone_set('Asia/Manila');
    }

    public function index()
    {
        $office = \App\Unit::select("*")->get();
		return view('content.performance_mgt_monitoring',compact('office'));
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
		if($request->chr_prep == "" || $request->super_prep  == "" || $request->chr_coaching  == "" || $request->super_coaching  == "" || $request->chr_activities  == "" || $request->super_activities  == "" || $request->chr_grade  == "" || $request->super_grade  == ""){
            $rules = [
                'master_id' => 'required',
                'supervisor' => 'required',
                'remarks' => 'required',
                'semester' => 'required',
            ];
        }else{
            $rules = [
                'master_id' => 'required',
                'supervisor' => 'required',
                'semester' => 'required',
            ];
        }
        $select_year = date('Y', strtotime($request->chr_prep));
        $request->validate($rules);
		$performance = new \App\Performance;
		$performance->master_id = $masters;
        $performance->semester = strtoupper($request->semester);
        $performance->selected_year = $select_year;
		$performance->supervisor = strtoupper($request->supervisor);
		$performance->ipcr_prep_chr = date('Y-m-d', strtotime($request->chr_prep));
		$performance->ipcr_prep_supervisor = date('Y-m-d', strtotime($request->super_prep));
		$performance->coaching_chr = date('Y-m-d', strtotime($request->chr_coaching));
		$performance->coaching_supervisor = date('Y-m-d', strtotime($request->super_coaching));
		$performance->activities_chr = date('Y-m-d', strtotime($request->chr_activities));
		$performance->activities_supervisor = date('Y-m-d', strtotime($request->super_activities));
		$performance->grading_chr = date('Y-m-d', strtotime($request->chr_grade));
		$performance->grading_supervisor = date('Y-m-d', strtotime($request->super_grade));
        $performance->remarks = strtoupper($request->remarks);
		
		$performance->save();
		
        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Performance Records"]);
		$ledger->save();
		
		return redirect()->route('performance', $masters)->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.performance_records', compact('master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masters = \App\Performance::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.performance_records', compact('masters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $masters = \App\Performance::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        if($request->chr_prep == "" || $request->super_prep  == "" || $request->chr_coaching  == "" || $request->super_coaching  == "" || $request->chr_activities  == "" || $request->super_activities  == "" || $request->chr_grade  == "" || $request->super_grade  == ""){
            $rules = [
                'supervisor' => 'required',
                'remarks' => 'required',
                'semester' => 'required',
            ];
        }else{
            $rules = [
                'supervisor' => 'required',
                'semester' => 'required',
            ];
        }
        $select_year = date('Y', strtotime($request->chr_prep));
        $request->validate($rules);
	
        $performance = \App\Performance::where('id',$id)->first();
        $performance->semester = strtoupper($request->semester);
        $performance->selected_year = $select_year;
		$performance->supervisor = strtoupper($request->supervisor);
		$performance->ipcr_prep_chr = date('Y-m-d', strtotime($request->chr_prep));
		$performance->ipcr_prep_supervisor = date('Y-m-d', strtotime($request->super_prep));
		$performance->coaching_chr = date('Y-m-d', strtotime($request->chr_coaching));
		$performance->coaching_supervisor = date('Y-m-d', strtotime($request->super_coaching));
		$performance->activities_chr = date('Y-m-d', strtotime($request->chr_activities));
		$performance->activities_supervisor = date('Y-m-d', strtotime($request->super_activities));
		$performance->grading_chr = date('Y-m-d', strtotime($request->chr_grade));
		$performance->grading_supervisor = date('Y-m-d', strtotime($request->super_grade));
        $performance->remarks = strtoupper($request->remarks);
		
		$performance->save();
		
        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Performance Record Updated"]);
		$ledger->save();
		
		return redirect()->route('performance', $masters->master_id)->with('success', 'Records Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = \App\Performance::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Performance Records Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('performance', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
