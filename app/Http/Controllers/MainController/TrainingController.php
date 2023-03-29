<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
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
		
		$request_training = $request->ghq_training;
        $rules = [
            'master_id' => 'required',
			'inclusive_from' => 'required',
			'hour_numbers' => 'required',
        ];
		
        $request->validate($rules);
		$master = \App\Master::where('main_id',$masters)->first();
		$training_program = \App\Training::select('*')
									->where([ ['master_id',$masters], ['training_program','CPORT']])
									->orWhere([ ['master_id',$masters], ['training_program','CPBC']])
									->orWhere([ ['master_id',$masters], ['training_program','CPBSC']])
									->orWhere([ ['master_id',$masters], ['training_program','CPASC']])
									->get();
		foreach($training_program as $training_program){
			if($training_program->training_program == $request_training || $training_program->training_program == $request_training || $training_program->training_program == $request_training || $training_program->training_program == $request_training){
				return redirect()->back()->with('errors', 'Records Already Exist!'); 
			}
		}
		$select_training = \App\Schooling::select('*')->where('master_id',$masters)->first();
		// $accomplishment = \App\Accomplishment::select('*')->where('master_id',$masters)->first();
		
		
		// $year = date('Y', strtotime($request->inclusive_from));
		
		// if($accomplishment->year_training == null || $accomplishment->year_training == ""){
		// 	$accomplishment->year_training = $year;
		// 	$accomplishment->number_hours = $request->hour_numbers;
		// }elseif($accomplishment->year_training == $year){
		// 	$accomplishment->number_hours += $request->hour_numbers;
		// }elseif($accomplishment->year_training != $year){
		// 	$new_accomplishment = new \App\Accomplishment;
		// 	$new_accomplishment->master_id = $accomplishment->master_id;
		// 	$new_accomplishment->year_training = $year;
		// 	$new_accomplishment->number_hours = $request->hour_numbers;
		// 	$new_accomplishment->save();
		// }else{
		// 	$accomplishment->year_training = "";
		// 	$accomplishment->number_hours = "";
		// }
		// $accomplishment->save();
		
		if($request_training != "N/A"){
			$training_matrix = \App\Schooling::where('master_id',$masters)->first();
			//$training_matrix->master_id = $masters;
			if($request_training == "CPORT"){
				$training_matrix->cport = strtoupper($request_training);
				$training_matrix->cport_date = date('Y-m-d', strtotime($request->inclusive_from));
			}elseif($request_training == "CPBC"){
				$training_matrix->cpbc = strtoupper($request_training);
				$training_matrix->cpbc_date = date('Y-m-d', strtotime($request->inclusive_from));
			}elseif($request_training == "CPBSC"){
				$training_matrix->cpbsc = strtoupper($request_training);
				$training_matrix->cpbsc_date = date('Y-m-d', strtotime($request->inclusive_from));
			}elseif($request_training == "CPASC"){
				$training_matrix->cpasc = strtoupper($request_training);
				$training_matrix->cpasc_date = date('Y-m-d', strtotime($request->inclusive_from));
			}else{
				$request_training = "";
			}
			$training_matrix->save();	
		}
		
		$training = new \App\Training;
		$training->master_id = $masters;
		if($request_training != "N/A"){
			$training->training_program = strtoupper($request_training);
		}else{
			$training->training_program = strtoupper($request->training_program);
		}
		$training->inclusive_from = date('Y-m-d', strtotime($request->inclusive_from));
		$training->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		$training->number_hours = $request->hour_numbers;
		$training->level_class =  strtoupper($master->level_class);
		$training->type_ld = strtoupper($request->type_ld);
		$training->conducted = strtoupper($request->conducted);
		$training->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Add Training Records"]);
		$ledger->save();
			
		return redirect()->route('training', $masters)->with('success', 'Records Successfully Added!');
		
    }
	
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.training_records', compact('master'));
    }

    public function edit($id)
    {
        $masters = \App\Training::where('id',$id)->first();
		$training_title = "";
		$v_training_title = "";
		/*$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		*/
		
		if($masters->training_program == 'CPORT'){
			$training_title = "N/A";
			$v_training_title = "CPORT";
		}elseif($masters->training_program == 'CPBC'){
			$training_title = "N/A";
			$v_training_title = "CPORT";
		}elseif($masters->training_program == 'CPBSC'){
			$training_title = "N/A";
			$v_training_title = "CPORT";
		}elseif($masters->training_program == 'CPASC'){
			$training_title = "N/A";
			$v_training_title = "CPORT";
		}else{
			$training_title = $masters->training_program;
			$v_training_title = "N/A";
		}
		return view('update.training_records', compact('masters','training_title','v_training_title'));
    }

    public function update(Request $request, $id)
    {
		$training_id = \App\Training::where('id',$id)->first();
		
		$user_id = \App\Master::where('main_id',$training_id->master_id)->first();
		
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$request_training = $request->ghq_training;
        $rules = [
            'master_id' => "unique:{$id}",
			'inclusive_from' => 'required',
			'hour_numbers' => 'required',
        ];
		
		$request->validate($rules);
		
		$masters = $training_id->master_id;
		$training_matrix = \App\Schooling::where('master_id',$masters)->first();
		
			if($request_training != "N/A"){
					
				//$training_matrix->master_id = $masters;
				if($request_training == "CPORT"){
					$training_matrix->cport = strtoupper("CPORT");
					$training_matrix->cport_date = date('Y-m-d', strtotime($request->inclusive_from));
				}elseif($request_training == "CPBC"){
					$training_matrix->cpbc = strtoupper("CPBC");
					$training_matrix->cpbc_date = date('Y-m-d', strtotime($request->inclusive_from));
				}elseif($request_training == "CPBSC"){
					$training_matrix->cpbsc = strtoupper("CPBSC");
					$training_matrix->cpbsc_date = date('Y-m-d', strtotime($request->inclusive_from));
				}elseif($request_training == "CPASC"){
					$training_matrix->cpasc = strtoupper("CPASC");
					$training_matrix->cpasc_date = date('Y-m-d', strtotime($request->inclusive_from));
				}else{
					$request_training = "";
				}	
				
			}
			//$training_matrix->master_id = $masters;
			
			
			/*	
			if($training_id->training_program == "CPBC"){
				$training_count = \App\Training::where('training_program','CPBC')->count();
				//$training_matrix->master_id = $masters;
				if($training_count <= 0){
					$training_matrix->cpbc = "";
					$training_matrix->cpbc_date = "";
				}
			}*/
			
		
		$training_matrix->save();
		
		$training = \App\Training::where('id',$id)->first();
		
		$accomplishment = \App\Accomplishment::select('*')->where('year_training', date('Y', strtotime($training->inclusive_from)))->first();
		$a_accomplishment = \App\Accomplishment::select('*')->where('year_training', date('Y', strtotime($training->inclusive_from)))->get();
		
		$new_array = array();
		foreach($a_accomplishment as $new_accomp){
			array_push($new_array,$new_accomp->year_training);
		}
		
		$year = date('Y', strtotime($request->inclusive_from));
		
		if($accomplishment->year_training == null || $accomplishment->year_training == ""){
			$accomplishment->year_training = $year;
			$accomplishment->number_hours = $request->hour_numbers;
		}elseif($accomplishment->year_training == $year){
			
			if($training->number_hours < $request->hour_numbers){
				$total_hours = $training->number_hours - $request->hour_numbers;
				$accomplishment->number_hours -= $total_hours;
			}
			
			if($training->number_hours > $request->hour_numbers){
				$total_hours = $training->number_hours - $request->hour_numbers;
				$accomplishment->number_hours += $total_hours;
			}
		}else{
			$accomplishment->year_training = "";
			$accomplishment->number_hours = "";
		}
		$accomplishment->save();
		
		if($request_training != "N/A"){
			$training->training_program = strtoupper($request_training);
		}else{
			$training->training_program = strtoupper($request->training_program);
		}
		$training->inclusive_from = date('Y-m-d', strtotime($request->inclusive_from));
		$training->inclusive_to = date('Y-m-d', strtotime($request->inclusive_to));
		$training->number_hours = $request->hour_numbers;
		$training->type_ld = strtoupper($request->type_ld);
		$training->conducted = strtoupper($request->conducted);
		$training->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Training Records Updated"]);
		$ledger->save();
		
		return redirect()->route('training', $training->master_id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        
		/*$masters = \App\Schooling::where('master_id',$master->master_id)->first();
		if($master->training_program == "CPORT"){
			$masters->cport = "";
			$masters->cport_date = "";
		}elseif($master->training_program == "CPBC"){
			$masters->cpbc = "";
			$masters->cpbc_date = "";
		}elseif($master->training_program == "CPBSC"){
			$masters->cpbsc = "";
			$masters->cbpsc_date = "";
		}elseif($master->training_program == "CPBSC"){
			$masters->cpasc = "";
			$masters->cpasc_date = "";
		}
		
		$masters->save();
		*/
		// $training_matrix = \App\Schooling::where('master_id',$master->master_id)->first();
		
		// 	if($request_training != "N/A"){
					
		// 		//$training_matrix->master_id = $masters;
		// 		if($request_training == "CPORT"){
		// 			$training_matrix->cport = strtoupper("CPORT");
		// 			$training_matrix->cport_date = date('Y-m-d', strtotime($request->inclusive_from));
		// 		}elseif($request_training == "CPBC"){
		// 			$training_matrix->cpbc = strtoupper("CPBC");
		// 			$training_matrix->cpbc_date = date('Y-m-d', strtotime($request->inclusive_from));
		// 		}elseif($request_training == "CPBSC"){
		// 			$training_matrix->cpbsc = strtoupper("CPBSC");
		// 			$training_matrix->cpbsc_date = date('Y-m-d', strtotime($request->inclusive_from));
		// 		}elseif($request_training == "CPASC"){
		// 			$training_matrix->cpasc = strtoupper("CPASC");
		// 			$training_matrix->cpasc_date = date('Y-m-d', strtotime($request->inclusive_from));
		// 		}else{
		// 			$request_training = "";
		// 		}	
				
		// 	}
		// 	//$training_matrix->master_id = $masters;
			
			
		// 	/*	
		// 	if($training_id->training_program == "CPBC"){
		// 		$training_count = \App\Training::where('training_program','CPBC')->count();
		// 		//$training_matrix->master_id = $masters;
		// 		if($training_count <= 0){
		// 			$training_matrix->cpbc = "";
		// 			$training_matrix->cpbc_date = "";
		// 		}
		// 	}*/
			
		
		// $training_matrix->save();

		// $accomplishment = \App\Accomplishment::select('*')->where('master_id',$master->master_id)->first();
		// $training = \App\Training::where('id',$id)->first();
		
		// if($accomplishment->year_training){
		// 	$accomplishment->number_hours -= $training->number_hours;
		// }
		// $accomplishment->save();
		
		$master = \App\Training::where('id',$id)->first();
		$training_program = \App\Training::select('*')
									->where([ ['master_id',$master->master_id], ['training_program','CPORT']])
									->orWhere([ ['master_id',$master->master_id], ['training_program','CPBC']])
									->orWhere([ ['master_id',$master->master_id], ['training_program','CPBSC']])
									->orWhere([ ['master_id',$master->master_id], ['training_program','CPASC']])
									->get();
		if($master->training_program == 'CPORT'){
			foreach($training_program as $training_program){
				if($training_program->training_program == 'CPBC' || $training_program->training_program == 'CPBSC' || $training_program->training_program == 'CPASC'){
					return redirect()->route('training', $master->master_id)->with('errors', 'Please Delete CPBC, CPBSC, CPASC Trainings!');
				}
			}

		}elseif($master->training_program == 'CPBC'){
			foreach($training_program as $training_program){
				if( $training_program->training_program == 'CPBSC' || $training_program->training_program == 'CPASC'){
					return redirect()->route('training', $master->master_id)->with('errors', 'Please Delete CPBSC, CPASC Trainings!');
				}
			}
		}elseif($master->training_program == 'CPBSC'){
			foreach($training_program as $training_program){
				if( $training_program->training_program == 'CPASC'){
					return redirect()->route('training', $master->master_id)->with('errors', 'Please Delete CPASC Training!');
				}
			}
		}
		
		
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$training = \App\Training::where('id',$id)->first();
		$schooling = \App\Schooling::where('master_id',$training->master_id)->first();
		$training_matrix = \App\Schooling::where('master_id',$training->master_id)->first();
		if($training->training_program == 'CPORT'){
			$training_matrix->cport = NULL;
			$training_matrix->cport_date = NULL;
			$training_matrix->cpbc = NULL;
			$training_matrix->cpbc_date = NULL;
			$training_matrix->cpbsc = NULL;
			$training_matrix->cpbsc_date = NULL;
			$training_matrix->cpasc = NULL;
			$training_matrix->cpasc_date = NULL;
		}elseif($training->training_program == 'CPBC'){
			$training_matrix->cpbc = NULL;
			$training_matrix->cpbc_date = NULL;
			$training_matrix->cpbsc = NULL;
			$training_matrix->cpbsc_date = NULL;
			$training_matrix->cpasc = NULL;
			$training_matrix->cpasc_date = NULL;
		}elseif($training->training_program == 'CPBSC'){
			$training_matrix->cpbsc = NULL;
			$training_matrix->cpbsc_date = NULL;
			$training_matrix->cpasc = NULL;
			$training_matrix->cpasc_date = NULL;
		}elseif($training->training_program == 'CPASC'){
			$training_matrix->cpasc = NULL;
			$training_matrix->cpasc_date = NULL;
		}
		$training_matrix->save();

		$training->delete();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Training Record Deleted"]);
		$ledger->save();
		
		return redirect()->route('training', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
