<?php

namespace App\Http\Controllers\MainController;

use App\Costing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CostingController extends Controller
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
		/*
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		
		return view('content.workexpe_records', compact('master'));
		*/
		$unit = \App\Unit::select('*')->orderBy('created_at','DESC')->get();
		$position = \App\Position::select("*")->orderBy('title','asc')->get();
		$autocomplete =\App\Plantilla::select("plantilla_number",'sg','plantillas.id')
						->where([['master_id',null],['deleted_at',null]])
						->orWhere([['master_id',''],['deleted_at',null]])
						->get();
		return view('content.add_tat_costing_report',compact('autocomplete','position','unit'));
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$to_check = strtoupper($request->plantilla);
        $plantilla = \App\Costing::select('*')->where('plantilla_number',$to_check)->first();

        //validate plantilla if exist
        if($plantilla){
            return back()->with('error', 'Plantilla Already Publish!');
        }

        // validation rules
        $rules = [
            'plantilla' => 'required',
			'publication_date' => 'required'
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		$livesearch = $request->plantilla;
		$plantillas =  \App\Plantilla::where('id',$livesearch)->first();
		
		$costing = new Costing;
		$complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		$costing->plantilla_number = strtoupper($plantillas->id);
		$costing->position =  strtoupper($plantillas->title);
		$costing->office = strtoupper($plantillas->office);
		$costing->salary_grade = strtoupper($plantillas->sg);
		
		$costing->publication_cost = $request->publication_cost;
		$costing->publication_date = date("Y-m-d", strtotime($request->publication_date));
		$costing->publication_date_e = date("Y-m-d", strtotime($request->publication_date_e));
		
		$costing->assestment_cost = $request->assessment_cost;
		$costing->assestment_date = date("Y-m-d", strtotime($request->assessment_date));
		$costing->assestment_date_e = date("Y-m-d", strtotime($request->assessment_date_e));
		
		$costing->local_delib_cost = $request->local_cost;
		$costing->local_delib_date = date("Y-m-d", strtotime($request->local_date));
		$costing->local_delib_date_e = date("Y-m-d", strtotime($request->local_date_e));
		
		$costing->ghq_delib_cost = $request->ghq_cost;
		$costing->ghq_delib_date = date("Y-m-d", strtotime($request->ghq_date));
		$costing->ghq_delib_date_e = date("Y-m-d", strtotime($request->ghq_date_e));
		
		$costing->resolution_cost = $request->release_cost;
		$costing->resolution_date = date("Y-m-d", strtotime($request->release_date));
		$costing->resolution_date_e = date("Y-m-d", strtotime($request->release_date_e));
		
		$costing->directive_cost = $request->directives_cost;
		$costing->directive_date = date("Y-m-d", strtotime($request->directives_date));
		$costing->directive_date_e = date("Y-m-d", strtotime($request->directives_date_e));
		
		$costing->requirement_cost = $request->submission_cost;
		$costing->requirement_date = date("Y-m-d", strtotime($request->submission_date));
		$costing->requirement_date_e = date("Y-m-d", strtotime($request->submission_date_e));
		
		$costing->appointment_cost = $request->approval_cost;
		$costing->appointment_date = date("Y-m-d", strtotime($request->approval_date));
		$costing->appointment_date_e = date("Y-m-d", strtotime($request->approval_date_e));
		
		$costing->rai_cost = $request->rai_cost;
		$costing->rai_date = date("Y-m-d", strtotime($request->rai_date));
		$costing->rai_date_e = date("Y-m-d", strtotime($request->rai_date_e));
		
		$publication =  date("Y-m-d", strtotime($request->publication_date));
		$rai = date("Y-m-d", strtotime($request->rai_date_e));
		$today = date("Y-m-d");
		$diff = date_diff(date_create($publication), date_create($rai));
		$days_summary = $diff->format('%d');
		
		$all_cost = $request->rai_cost + $request->submission_cost + $request->approval_cost + $request->directives_cost + $request->release_cost + $request->ghq_cost +  $request->local_cost + $request->assessment_cost + $request->publication_cost;
		
		
		$costing->summary_cost = $all_cost;
		$costing->summary_date = $days_summary;
		
		$costing->last_name = strtoupper($request->last_name);
		$costing->first_name = strtoupper($request->first_name);
		$costing->middle_name =strtoupper($request->middle_name);
		$costing->extension_name = strtoupper($request->extension_name);
		$costing->complete_name = $complete_name;
		$costing->remarks = $request->remarks;
		
		if($request->rai_date_e == ""){
			$costing->status = "PENDING";
		}else{
			$costing->status = "DONE";
		}
		
		$costing->save();
		
		return back()->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Costings  $costings
     * @return \Illuminate\Http\Response
     */
    public function show(Costings $costings)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Costings  $costings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		/*
        $user_id = Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		*/
		//$nationality = \App\Nationality::all();

		$unit = \App\Unit::select('*')->orderBy('created_at','DESC')->get();
		$position = \App\Position::select("*")->orderBy('title','asc')->get();
		$autocomplete =\App\Plantilla::select("plantilla_number",'sg','id')
						->where([['master_id',null],['deleted_at',null]])
						->orWhere([['master_id',''],['deleted_at',null]])
						->get();

		$master = \App\Costing::select("costings.*","plantillas.plantilla_number","plantillas.id as plantilla_id")
				->join('plantillas','costings.plantilla_number','plantillas.id')
				->where([ ['costings.id',$id],['costings.deleted_at',null]])
				->first();
		
		return view('update.costing_records', compact('master','autocomplete','position','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costings  $costings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // validation rules
        $rules = [
            'plantilla' => 'required',
			'publication_date' => 'required'
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		
		$livesearch = $request->plantilla;
		$plantillas =  \App\Plantilla::where('id',$livesearch)->first();

		$costing = Costing::where('id',$id)->first();
		$complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		$costing->plantilla_number = strtoupper($plantillas->id);
		$costing->position =  strtoupper($plantillas->title);
		$costing->office = strtoupper($plantillas->office);
		$costing->salary_grade = strtoupper($plantillas->sg);

		$costing->publication_cost = $request->publication_cost;
		$costing->publication_date = date("Y-m-d", strtotime($request->publication_date));
		$costing->publication_date_e = date("Y-m-d", strtotime($request->publication_date_e));
		
		$costing->assestment_cost = $request->assessment_cost;
		$costing->assestment_date = date("Y-m-d", strtotime($request->assessment_date));
		$costing->assestment_date_e = date("Y-m-d", strtotime($request->assessment_date_e));
		
		$costing->local_delib_cost = $request->local_cost;
		$costing->local_delib_date = date("Y-m-d", strtotime($request->local_date));
		$costing->local_delib_date_e = date("Y-m-d", strtotime($request->local_date_e));
		
		$costing->ghq_delib_cost = $request->ghq_cost;
		$costing->ghq_delib_date = date("Y-m-d", strtotime($request->ghq_date));
		$costing->ghq_delib_date_e = date("Y-m-d", strtotime($request->ghq_date_e));
		
		$costing->resolution_cost = $request->release_cost;
		$costing->resolution_date = date("Y-m-d", strtotime($request->release_date));
		$costing->resolution_date_e = date("Y-m-d", strtotime($request->release_date_e));
		
		$costing->directive_cost = $request->directives_cost;
		$costing->directive_date = date("Y-m-d", strtotime($request->directives_date));
		$costing->directive_date_e = date("Y-m-d", strtotime($request->directives_date_e));
		
		$costing->requirement_cost = $request->submission_cost;
		$costing->requirement_date = date("Y-m-d", strtotime($request->submission_date));
		$costing->requirement_date_e = date("Y-m-d", strtotime($request->submission_date_e));
		
		$costing->appointment_cost = $request->approval_cost;
		$costing->appointment_date = date("Y-m-d", strtotime($request->approval_date));
		$costing->appointment_date_e = date("Y-m-d", strtotime($request->approval_date_e));
		
		$costing->rai_cost = $request->rai_cost;
		$costing->rai_date = date("Y-m-d", strtotime($request->rai_date));
		$costing->rai_date_e = date("Y-m-d", strtotime($request->rai_date_e));
		
		$publication =  date("Y-m-d", strtotime($request->publication_date));
		$rai = date("Y-m-d", strtotime($request->rai_date_e));
		$today = date("Y-m-d");
		$diff = date_diff(date_create($publication), date_create($rai));
		$days_summary = $diff->format('%d');
		
		$all_cost = $request->rai_cost + $request->submission_cost +  $request->approval_cost + $request->directives_cost + $request->release_cost + $request->ghq_cost +  $request->local_cost + $request->assessment_cost + $request->publication_cost;
		
		
		$costing->summary_cost = $all_cost;
		$costing->summary_date = $days_summary;
		
		$costing->last_name = strtoupper($request->last_name);
		$costing->first_name = strtoupper($request->first_name);
		$costing->middle_name =strtoupper($request->middle_name);
		$costing->extension_name = strtoupper($request->extension_name);
		$costing->complete_name = $complete_name;
		$costing->remarks = $request->remarks;
		
		if($request->rai_date_e == ""){
			$costing->status = "PENDING";
		}else{
			$costing->status = "DONE";
		}
		
		$costing->save();
		
		return back()->with('success', 'Records Successfully Added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Costings  $costings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = Costing::where('id',$id)->first();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Delete $master->plantilla_number Records"]);
		$ledger->save();
		
		$master->delete();
		
		//return redirect()->route('view_ctg_records')->with('success',"Successfully Deleted");
		return back()->with('success', 'Successfully Deleted!');
    }
}
