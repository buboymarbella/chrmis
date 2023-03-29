<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Plantilla;
use App\Unit;

class PlantillaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        Paginator::useBootstrap();
        $plantilla = Plantilla::select('*')->orderBy('created_at','DESC')->paginate(10,['*'], 'plantilla');
        $count_plantilla = Plantilla::select('*')->count();
        return view('content.view_plantilla_records',compact('plantilla','count_plantilla'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualification = \App\Qualification::select("*")->orderBy('eligibility','asc')->get();
        $position = \App\Position::select("*")->orderBy('title','asc')->get();
        $autocomplete =\App\Master::select("*")
                    ->where([['item_number',null],['employ_stat','!=','RETIRED'],['deleted_at',null]])
                    ->get();
        
        $unit = Unit::select('*')->orderBy('created_at','DESC')->get();
        return view('content.add_plantilla_records',compact('autocomplete','unit','position','qualification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $to_check = strtoupper($request->plantilla_number);
        $plantilla = Plantilla::select('*')->where('plantilla_number',$to_check)->first();

        //validate plantilla if exist
        if($plantilla){
            return back()->with('error', 'Plantilla Already Exist!');
        }
        // validation rules
        if($request->livesearch != "" ){
            $rules = [
                'plantilla_number' => 'required',
                'level_classification' => 'required',
                'position_title' => 'required',
                'staff_action' => 'required',
                'salary_grade' => 'required',
                'office' => 'required'
            ];
        }else{
            $rules = [
                'plantilla_number' => 'required',
                'level_classification' => 'required',
                'position_title' => 'required',
                'salary_grade' => 'required',
                'office' => 'required'
            ];
        }

        $request->validate($rules);
        $sg = $request->salary_grade;
        if($sg <= 9){
            $sg = "0".$sg;
        }else{
            $sg = $sg;
        }

        $masters = \App\Master::where('main_id',$request->livesearch)->first();
        $office = \App\Unit::where('unit',$request->office)->first();

        if($request->livesearch != "" ){
            $masters->item_number = $request->plantilla_number;
            $masters->position = $request->position_title;
            $masters->salary_grade = $sg;
            $masters->office = $request->office;
            $masters->level_class = $request->level_classification;
            $masters->office_group = strtoupper($office->category);
            $masters->employ_stat = "PERMANENT";
            $masters->save();
        }
       
        $plantilla = new Plantilla;
        $plantilla->master_id = $request->livesearch;
        if($request->livesearch != "" ){
         $plantilla->complete_name = $masters->complete_name;
        }
        $plantilla->plantilla_number = strtoupper($request->plantilla_number);
		$plantilla->title =  strtoupper($request->position_title);
		$plantilla->office = strtoupper($request->office);
        $plantilla->office_group = strtoupper($office->category);
		$plantilla->sg = $sg;
        $plantilla->staff_action = strtoupper($request->staff_action);
        $plantilla->sourcing_method = strtoupper($request->sourcing_method);
        $plantilla->start_date = date("Y-m-d", strtotime($request->start_date));
        $plantilla->end_date = date("Y-m-d", strtotime($request->end_date));
        $plantilla->level_class = strtoupper($request->level_classification);
        $plantilla->status = strtoupper($request->status);
        $plantilla->training = $request->hours;
        $plantilla->experience = $request->years;
        $plantilla->eligibility = $request->eligibility;
        $plantilla->save();
		
        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Plantilla $request->plantilla_number"]);
		$ledger->save();
		return back()->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qualification = \App\Qualification::select("*")->orderBy('eligibility','asc')->get();
        $position = \App\Position::select("*")->orderBy('title','asc')->get();
        $autocomplete =\App\Master::select("complete_name",'main_id')
                        ->where([['item_number',null],['employ_stat','!=','RETIRED'],['deleted_at',null] ])
                        ->get();
        $plantilla = Plantilla::where('id',$id)->first();
        $plantilla2= \App\Master::select('masters.complete_name','masters.date_hired','masters.main_id','masters.item_number')
                        ->where('masters.item_number',$plantilla->plantilla_number  )
//                        ->JOIN('masters','plantillas.master_id','=','masters.main_id')
                        ->first();
        $unit = Unit::select('*')->orderBy('created_at','DESC')->get();
//        return $plantilla2->item_number ;
        return view('update.update_plantilla_records',compact('plantilla','autocomplete','plantilla2','unit','position','qualification'));
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
        // validation rules
        if($request->livesearch != "" ){
            $rules = [
                'plantilla_number' => 'required',
                'level_classification' => 'required',
                'position_title' => 'required',
                'staff_action' => 'required',
                'salary_grade' => 'required',
                'office' => 'required'
            ];
        }else{
            $rules = [
                'plantilla_number' => 'required',
                'level_classification' => 'required',
                'position_title' => 'required',
                'salary_grade' => 'required',
                'office' => 'required'
            ];
        }


        $request->validate($rules);
        $sg = $request->salary_grade;
        $firstCharacter = substr($sg, 0, 1);
        if($firstCharacter != 0){
            if($sg <= 9){
                $sg = "0".$sg;
            }else{
                $sg = $sg;
            }
        }else{
            $sg = $sg;
        }

        
       
        // $plantillas = Plantilla::where('id',$id)->first();
        // $plantilla2 = Plantilla::where([ ['id','!=',$id], ['master_id',$plantillas->master_id]])->first();
        //  // #avoid duplication data
        //  $plantilla2 = Plantilla::where('master_id',$plantillas->master_id)->first();
        //  $plantilla2->master_id = "";
        //  $plantilla2->complete_name = "";
        //  $plantilla2->save();
       

        $plantilla = Plantilla::where('id',$id)->first();
        $office = \App\Unit::where('unit',$request->office)->first();

        if($request->livesearch != "" ){

            $masters = \App\Master::where('main_id',$request->livesearch)->first();
            $masters->item_number = $request->plantilla_number;
            $masters->position = $request->position_title;
            $masters->salary_grade = $sg;
            $masters->office = $request->office;
            $masters->level_class = $request->level_classification;
            $masters->office_group = strtoupper($office->category);
            $masters->employ_stat = "PERMANENT";
            $masters->save();
        }
        else{

            $masters = \App\Master::where('main_id',$plantilla->master_id)->get();
            foreach($masters as $masters){
                $masters->item_number = NULL;
                $masters->position = NULL;
                $masters->salary_grade = NULL;
                $masters->office = NULL;
                $masters->level_class = NULL;
                $masters->office_group = NULL;
                $masters->employ_stat = NULL;
                $masters->save();
            }
        }

        #insert into new id
        $masters2 = \App\Master::where('main_id',$request->livesearch)->first();
        if($request->livesearch != ""){
            $plantilla->master_id = $request->livesearch;
            $plantilla->complete_name = $masters2->complete_name;
            $plantilla->staff_action = strtoupper($request->staff_action);
            $plantilla->sourcing_method = strtoupper($request->sourcing_method);
        }
        else{
            $plantilla->master_id = NULL;
            $plantilla->complete_name = NULL;
            $plantilla->staff_action = NULL;
            $plantilla->sourcing_method = NULL;
        }

       
        $plantilla->plantilla_number = strtoupper($request->plantilla_number);
		$plantilla->title =  strtoupper($request->position_title);
		$plantilla->office = strtoupper($request->office);
        $plantilla->office_group = strtoupper($office->category);
		$plantilla->sg = $sg;
        
        $plantilla->start_date = date("Y-m-d", strtotime($request->start_date));
        $plantilla->end_date = date("Y-m-d", strtotime($request->end_date));
        $plantilla->level_class = strtoupper($request->level_classification);
        $plantilla->status = strtoupper($request->status);
        $plantilla->training = $request->hours;
        $plantilla->experience = $request->years;
        $plantilla->eligibility = $request->eligibility;
        $plantilla->save();

        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Update Plantilla $request->plantilla_number"]);
		$ledger->save();
		return back()->with('success', 'Records Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = \App\Plantilla::where('id',$id)->first();
		// $user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		// if (!\Gate::allows('is', $user_id)) {
		// 	  abort(404,'Sorry you cant do this action');
		// }

        if($master->master_id != NULL){
            return back()->with('error', 'Plantilla is not empty!');
        }

        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Plantilla $master->plantilla_number Deleted"]);
		$ledger->save();

        $master->delete();

        return back()->with('success', 'Successfully Deleted!');
    }

    public function autocomplete(Request $request){
		
		$movies = [];

            $search = $request->q;
            $movies =\App\Master::select("complete_name",'main_id')
					->where([['deleted_at',null] ])
            		->get();
     
        return response()->json($movies);

	}
}
