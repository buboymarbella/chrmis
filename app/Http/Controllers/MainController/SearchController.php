<?php

namespace App\Http\Controllers\MainController;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use App\Plantilla;

class SearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
		date_default_timezone_set('Asia/Manila');

	
    }
	
	public function search_plantilla(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
		$plantilla = Plantilla::select('*')->result($search)->orderBy('created_at','DESC')->paginate(10,['*'], 'plantilla');
        $count_plantilla = Plantilla::select('*')->result($search)->count();
		
		return view('content.view_plantilla_records',compact('plantilla','count_plantilla'));
    }

	public function search_staff_plan(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
		$plantilla = Plantilla::select('*')->result($search)->orderBy('created_at','DESC')->paginate(10,['*'], 'plantilla');
        $count_plantilla = Plantilla::select('*')->result($search)->count();
		
		return view('content.staffing_plan_office_report',compact('plantilla','count_plantilla'));
    }

	public function search_comp_matrix(Request $request,$id)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
		// $id = $request->input('office');
        $plantilla = \App\Plantilla::select('*')->resultplantilla($search)->where([ ['office_group',$id],['master_id',NULL] ])->paginate(10,['*'], 'plantilla');
        $count_plantilla = \App\Plantilla::select('*')->resultplantilla($search)->where([ ['office_group',$id],['master_id',NULL] ])->count();
		
		return view('content.comp_asst_matrix_report',compact('plantilla','count_plantilla','id'));
    }

	public function main_search(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('keyword');
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = \App\Master::latest('masters.created_at')
					->result($search)
					->where('masters.office',  \Auth::user()->office)
					->latest('masters.created_at')
					->paginate(10);
					
			$counts =  \App\Master::latest('masters.created_at')
					->resultchr($search)
					->where('masters.office',  \Auth::user()->office)
					->count();	
		}else{
			$masters = \App\Master::latest()
					->result($search)
					->paginate(10);
			
			$counts =  \App\Master::latest()
						->resultchr($search)
						->count();
		}
		
		return view('content.view_records', compact('masters','counts'));
    }
	
	public function search_chr(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = \App\Master::latest('masters.created_at')
					->resultchr($search)
					->where('masters.office',  \Auth::user()->office)
					->paginate(10);
					
			$counts =  \App\Master::latest('masters.created_at')
					->resultchr($search)
					->where('masters.office',  \Auth::user()->office)
					->count();	
		}else{
			$masters = \App\Master::latest()
						->resultchr($search)
						->paginate(10);
						
			$counts =  \App\Master::latest()
						->resultchr($search)
						->count();		
		}
		return view('content.view_records', compact('masters','counts'));
    }

	public function search_tat(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
			
		$masters = \App\Costing::select("costings.*","plantillas.plantilla_number")
				->join('plantillas','costings.plantilla_number','plantillas.id')
				->resulttat($search)
				->orderBy("rai_date_e",'desc')
				->paginate(10,['*'], 'masters');
		$master_count = \App\Costing::select("costings.*","plantillas.plantilla_number")
				->join('plantillas','costings.plantilla_number','plantillas.id')
				->resulttat($search)
				->orderBy("rai_date_e",'desc')
				->count();	
		$office = \App\Master::select("*")->groupBy("office")->orderBy("office")->get();
		
		return view('content.view_tat_records', compact('masters','office','master_count'));
    }
	
	public function search_log(Request $request)
    {
		Paginator::useBootstrap();
		$search = $request->input('search');
		$ledgers = \App\Ledger::latest('ledgers.created_at')
							->join('users', 'ledgers.user_id', '=', 'users.id')
							->result($search)
							->paginate(10);
							
		$count_logs =  \App\Ledger::latest('ledgers.created_at')
						->join('users', 'ledgers.user_id', '=', 'users.id')
						->result($search)
						->count();	
						
        return view('admin.view_logs', compact('ledgers','count_logs'));
    }
	
	public function advanced_search()
    {
		Paginator::useBootstrap();
		$master = \App\Master::all();
		$office = \App\Master::select("*")->groupBy("office")->orderBy("office")->get();
		return view('content.advanced_search',compact('master','office'));
    }
	
	
	public function result_cport()
	{
		Paginator::useBootstrap();
		$masters = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->where('schoolings.cport','=', NULL)
								->orWhere([ ['schoolings.cport', '']])
								->groupBy('schoolings.master_id')
								->orderBy('masters.salary_grade', 'DESC')
								->get();
		return view('print.result_cport',compact('masters'));
    }
	
	public function result_cpbc()
	{
		Paginator::useBootstrap();
		$masters = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->JOIN('trainings','schoolings.master_id','=','trainings.master_id')
								->where( [ 
											['schoolings.cport','CPORT'],
											['schoolings.cpbc','!=','CPBC'],
										])
								->groupBy(
											['schoolings.master_id'], 
										)
								->orderBy('masters.salary_grade', 'DESC')
								->get();
		return view('print.result_cpbc',compact('masters'));
    }
	
	public function result_cpbsc()
	{
		$masters = \App\Master::latest('ratings.n_rating')
								->JOIN('ratings','masters.main_id','=','ratings.master_id')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->JOIN('trainings','schoolings.master_id','=','trainings.master_id')
								->where( [ 
											['schoolings.cport','CPORT'],
											['schoolings.cpbc','CPBC'],
											['schoolings.cpbsc','!=','CPBSC'],
										])
								->groupBy(
											['schoolings.master_id','ratings.master_id'], 
										)
								->orderBy('masters.salary_grade', 'DESC')
								->get();
		return view('print.result_cpbsc',compact('masters'));
    }
	
	public function result_training_accomp_report(Request $request)
	{
		Paginator::useBootstrap();
		$second_level_actual_supervisory = array();
		$second_level_actual_tech = array();
		$second_level_actual_first = array();

		$startDate = date('Y-m-d', strtotime($request->start_date));
		$endDate = date('Y-m-d', strtotime($request->end_date));

		###GUAS###
		$second_level_supervisory = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory as $cost1){
			array_push($second_level_actual_supervisory,$cost1->number_hours);
		}
		
		foreach($second_level_tech as $cost2){
			array_push($second_level_actual_tech,$cost2->number_hours);
		}	

		foreach($second_level_first as $cost3){
			array_push($second_level_actual_first,$cost3->number_hours);
		}	
		

		$second_supervisory = \App\Master::select('*')
								->where( [ ['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech= \App\Master::select('*')
								->where( [ ['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level = \App\Master::select('*')
								->where( [ ['level_class','1ST'],['deleted_at',NULL]])
								->count();
		$supervisory = $second_supervisory * 40;	
		$tech = $second_tech * 8;
		$first = $first_level * 8;

		

		$array_sum_supervisory = array_sum($second_level_actual_supervisory);
		// $array_sum_supervisory = 5000;
		$array_sum_tech = array_sum($second_level_actual_tech);
		$array_sum_first = array_sum($second_level_actual_first);


		$total_actual_level = $array_sum_supervisory + $array_sum_tech + $array_sum_first;
		$total_actual_one = $supervisory +  $tech + $first;
		

		$supervisory == 0 ? $total_supervisory = 0 : $total_supervisory = round( ($array_sum_supervisory / $supervisory) * 100);
		$tech == 0 ? $total_tech = 0 : $total_tech = round( ($array_sum_tech /  $tech) * 100);
		$first == 0 ? $total_first = 0 : $total_first = round( ($array_sum_first / $first ) * 100);

		$total_all_one = $total_supervisory +  $total_tech + $total_first;

		####END GUAS##

		#### COORDINATING STAFF ##
		$second_level_actual_supervisory_cs = array();
		$second_level_actual_tech_cs = array();
		$second_level_actual_first_cs = array();

		$second_level_supervisory_cs = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','COORDINATING_STAFF'], ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech_cs = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','COORDINATING_STAFF'],['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first_cs = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','COORDINATING_STAFF'],['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory_cs as $cost4){
			array_push($second_level_actual_supervisory_cs,$cost4->number_hours);
		}
		
		foreach($second_level_tech_cs as $cost5){
			array_push($second_level_actual_tech_cs,$cost5->number_hours);
		}	

		foreach($second_level_first_cs as $cost6){
			array_push($second_level_actual_first_cs,$cost6->number_hours);
		}	
		

		$second_supervisory_cs = \App\Master::select('*')
								->where( [ ['masters.office_group','COORDINATING_STAFF'],['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech_cs = \App\Master::select('*')
								->where( [ ['masters.office_group','COORDINATING_STAFF'],['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level_cs = \App\Master::select('*')
								->where( [ ['masters.office_group','COORDINATING_STAFF'],['level_class','1ST'],['deleted_at',NULL]])
								->count();

		$supervisory_cs = $second_supervisory_cs * 40;	
		$tech_cs = $second_tech_cs * 8;
		$first_cs = $first_level_cs * 8;

		$array_sum_supervisory_cs = array_sum($second_level_actual_supervisory_cs);
		$array_sum_tech_cs = array_sum($second_level_actual_tech_cs);
		$array_sum_first_cs = array_sum($second_level_actual_first_cs);

		$total_actual_level_cs = $array_sum_supervisory_cs + $array_sum_tech_cs + $array_sum_first_cs;

		$supervisory_cs == 0 ? $total_supervisory_cs = 0 : $total_supervisory_cs = round( ($array_sum_supervisory_cs / $supervisory_cs) * 100);
		$tech_cs == 0 ? $total_tech_cs = 0 : $total_tech_cs = round( ($array_sum_tech_cs /  $tech_cs) * 100);
		$first_cs == 0 ? $total_first_cs = 0 : $total_first_cs = round( ($array_sum_first_cs / $first_cs ) * 100);
		$total_all_two = $total_supervisory_cs +  $total_tech_cs + $total_first_cs;
		####END COORDINATING STAFF##


		#### PERSONAL STAFF ##
		$second_level_actual_supervisory_ps = array();
		$second_level_actual_tech_ps = array();
		$second_level_actual_first_ps = array();

		$second_level_supervisory_ps = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','PERSONAL_STAFF'], ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech_ps = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','PERSONAL_STAFF'],['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first_ps = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','PERSONAL_STAFF'],['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory_ps as $cost7){
			array_push($second_level_actual_supervisory_ps,$cost7->number_hours);
		}
		
		foreach($second_level_tech_ps as $cost8){
			array_push($second_level_actual_tech_ps,$cost8->number_hours);
		}	

		foreach($second_level_first_ps as $cost9){
			array_push($second_level_actual_first_ps,$cost9->number_hours);
		}	
		

		$second_supervisory_ps = \App\Master::select('*')
								->where( [ ['masters.office_group','PERSONAL_STAFF'],['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech_ps = \App\Master::select('*')
								->where( [ ['masters.office_group','PERSONAL_STAFF'],['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level_ps = \App\Master::select('*')
								->where( [ ['masters.office_group','PERSONAL_STAFF'],['level_class','1ST'],['deleted_at',NULL]])
								->count();

		$supervisory_ps = $second_supervisory_ps * 40;	
		$tech_ps = $second_tech_ps * 8;
		$first_ps = $first_level_ps * 8;

		$array_sum_supervisory_ps = array_sum($second_level_actual_supervisory_ps);
		$array_sum_tech_ps = array_sum($second_level_actual_tech_ps);
		$array_sum_first_ps = array_sum($second_level_actual_first_ps);

		$total_actual_level_ps = $array_sum_supervisory_ps + $array_sum_tech_ps + $array_sum_first_ps;

		$supervisory_ps == 0 ? $total_supervisory_ps = 0 : $total_supervisory_ps = round( ($array_sum_supervisory_ps / $supervisory_ps) * 100);
		$tech_ps == 0 ? $total_tech_ps = 0 : $total_tech_ps = round( ($array_sum_tech_ps /  $tech_ps) * 100);
		$first_ps == 0 ? $total_first_ps = 0 : $total_first_ps = round( ($array_sum_first_ps / $first_ps ) * 100);
		$total_all_three = $total_supervisory_ps +  $total_tech_ps + $total_first_ps;
		####END PERSONAL STAFF##

		#### SPECIAL STAFF ##
		$second_level_actual_supervisory_ss = array();
		$second_level_actual_tech_ss = array();
		$second_level_actual_first_ss = array();

		$second_level_supervisory_ss = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','SPECIAL_STAFF'], ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech_ss = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','SPECIAL_STAFF'],['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first_ss = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','SPECIAL_STAFF'],['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory_ss as $cost10){
			array_push($second_level_actual_supervisory_ss,$cost10->number_hours);
		}
		
		foreach($second_level_tech_ss as $cost11){
			array_push($second_level_actual_tech_ss,$cost11->number_hours);
		}	

		foreach($second_level_first_ss as $cost12){
			array_push($second_level_actual_first_ps,$cost12->number_hours);
		}	
		

		$second_supervisory_ss = \App\Master::select('*')
								->where( [ ['masters.office_group','SPECIAL_STAFF'],['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech_ss = \App\Master::select('*')
								->where( [ ['masters.office_group','SPECIAL_STAFF'],['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level_ss = \App\Master::select('*')
								->where( [ ['masters.office_group','SPECIAL_STAFF'],['level_class','1ST'],['deleted_at',NULL]])
								->count();

		$supervisory_ss = $second_supervisory_ss * 40;	
		$tech_ss = $second_tech_ss * 8;
		$first_ss = $first_level_ss * 8;

		$array_sum_supervisory_ss = array_sum($second_level_actual_supervisory_ss);
		$array_sum_tech_ss = array_sum($second_level_actual_tech_ss);
		$array_sum_first_ss = array_sum($second_level_actual_first_ss);

		$total_actual_level_ss = $array_sum_supervisory_ss + $array_sum_tech_ss + $array_sum_first_ss;

		$supervisory_ss == 0 ? $total_supervisory_ss = 0 : $total_supervisory_ss = round( ($array_sum_supervisory_ss / $supervisory_ss) * 100);
		$tech_ss == 0 ? $total_tech_ss = 0 : $total_tech_ss = round( ($array_sum_tech_ss /  $tech_ss) * 100);
		$first_ss == 0 ? $total_first_ss = 0 : $total_first_ss = round( ($array_sum_first_ss / $first_ss ) * 100);
		$total_all_four = $total_supervisory_ss +  $total_tech_ss + $total_first_ss;
		####END SPECIAL STAFF##

		#### AFPWSSUS STAFF ##
		$second_level_actual_supervisory_a = array();
		$second_level_actual_tech_a = array();
		$second_level_actual_first_a = array();

		$second_level_supervisory_a = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','AFPWSSUS'], ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech_a = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','AFPWSSUS'],['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first_a = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','AFPWSSUS'],['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory_a as $cost13){
			array_push($second_level_actual_supervisory_a,$cost13->number_hours);
		}
		
		foreach($second_level_tech_a as $cost14){
			array_push($second_level_actual_tech_a,$cost14->number_hours);
		}	

		foreach($second_level_first_a as $cost15){
			array_push($second_level_actual_first_ps,$cost15->number_hours);
		}	
		

		$second_supervisory_a= \App\Master::select('*')
								->where( [ ['masters.office_group','AFPWSSUS'],['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech_a = \App\Master::select('*')
								->where( [ ['masters.office_group','AFPWSSUS'],['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level_a = \App\Master::select('*')
								->where( [ ['masters.office_group','AFPWSSUS'],['level_class','1ST'],['deleted_at',NULL]])
								->count();

		$supervisory_a = $second_supervisory_a * 40;	
		$tech_a = $second_tech_a * 8;
		$first_a = $first_level_a * 8;

		$array_sum_supervisory_a = array_sum($second_level_actual_supervisory_a);
		$array_sum_tech_a = array_sum($second_level_actual_tech_a);
		$array_sum_first_a = array_sum($second_level_actual_first_a);

		$total_actual_level_a = $array_sum_supervisory_a + $array_sum_tech_a + $array_sum_first_a;

		$supervisory_a == 0 ? $total_supervisory_a = 0 : $total_supervisory_a = round( ($array_sum_supervisory_a / $supervisory_a) * 100);
		$tech_a == 0 ? $total_tech_a = 0 : $total_tech_a = round( ($array_sum_tech_a /  $tech_a) * 100);
		$first_a == 0 ? $total_first_a = 0 : $total_first_a = round( ($array_sum_first_a / $first_a ) * 100);
		$total_all_five = $total_supervisory_a +  $total_tech_a + $total_first_a;
		####END AFPWSSUS STAFF##


		#### UNIFIED COMMAND STAFF ##
		$second_level_actual_supervisory_uc = array();
		$second_level_actual_tech_uc = array();
		$second_level_actual_first_uc = array();

		$second_level_supervisory_uc = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','UNIFIED_COMMAND'], ['masters.level_class','2ND_SUPERVISORY'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();

		$second_level_tech_uc = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','UNIFIED_COMMAND'],['masters.level_class','2ND_TECH'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		$second_level_first_uc = \App\Training::select('masters.main_id','masters.level_class','trainings.*')
								->join('masters','trainings.master_id','=','masters.main_id')
								// ->where( [ ['year_training',$request->start_date],['salary_grade','>=',18]])
								->where( [ ['masters.office_group','UNIFIED_COMMAND'],['masters.level_class','1ST'],['employ_stat','=','PERMANENT']])
								->whereDate('trainings.inclusive_from', '>=', $startDate)->whereDate('trainings.inclusive_to', '<=', $endDate)
								->get();
		
		foreach($second_level_supervisory_uc as $cost21){
			array_push($second_level_actual_supervisory_a,$cost21->number_hours);
		}
		
		foreach($second_level_tech_uc as $cost22){
			array_push($second_level_actual_tech_a,$cost22->number_hours);
		}	

		foreach($second_level_first_uc as $cost23){
			array_push($second_level_actual_first_ps,$cost23->number_hours);
		}	
		

		$second_supervisory_uc = \App\Master::select('*')
								->where( [ ['masters.office_group','UNIFIED_COMMAND'],['level_class','2ND_SUPERVISORY'],['deleted_at',NULL]])
								->count();

		$second_tech_uc = \App\Master::select('*')
								->where( [ ['masters.office_group','UNIFIED_COMMAND'],['level_class','2ND_TECH'],['deleted_at',NULL]])
								->count();

		$first_level_uc = \App\Master::select('*')
								->where( [ ['masters.office_group','UNIFIED_COMMAND'],['level_class','1ST'],['deleted_at',NULL]])
								->count();

		$supervisory_uc = $second_supervisory_uc * 40;	
		$tech_uc = $second_tech_uc * 8;
		$first_uc = $first_level_uc * 8;

		$array_sum_supervisory_uc = array_sum($second_level_actual_supervisory_uc);
		$array_sum_tech_uc = array_sum($second_level_actual_tech_uc);
		$array_sum_first_uc = array_sum($second_level_actual_first_uc);

		$total_actual_level_uc = $array_sum_supervisory_uc + $array_sum_tech_uc + $array_sum_first_uc;

		$supervisory_uc == 0 ? $total_supervisory_uc = 0 : $total_supervisory_uc = round( ($array_sum_supervisory_uc / $supervisory_uc) * 100);
		$tech_uc == 0 ? $total_tech_uc = 0 : $total_tech_uc = round( ($array_sum_tech_uc /  $tech_uc) * 100);
		$first_uc == 0 ? $total_first_uc = 0 : $total_first_uc = round( ($array_sum_first_uc / $first_uc) * 100);
		$total_all_six = $total_supervisory_uc +  $total_tech_uc + $total_first_uc;
		####END UNIFIED COMMAND ##

		return view('print.result_training_accomp_report',compact(
			'second_level_actual_tech','second_supervisory','second_tech','first_level','tech','supervisory','first',
			'total_supervisory','total_tech','total_first','second_level_tech','second_level_actual_supervisory',
			'second_level_actual_first','total_actual_level','total_all_one','total_actual_one',

			'second_level_actual_tech_cs','second_supervisory_cs','second_tech_cs','first_level_cs','tech_cs','supervisory_cs','first_cs',
			'total_supervisory_cs','total_tech_cs','total_first_cs','second_level_tech_cs','second_level_actual_supervisory_cs',
			'second_level_actual_first_cs','total_actual_level_cs','total_all_two',

			'second_level_actual_tech_ps','second_supervisory_ps','second_tech_ps','first_level_ps','tech_ps','supervisory_ps','first_ps',
			'total_supervisory_ps','total_tech_ps','total_first_ps','second_level_tech_ps','second_level_actual_supervisory_ps',
			'second_level_actual_first_ps','total_actual_level_ps','total_all_three',

			'second_level_actual_tech_ss','second_supervisory_ss','second_tech_ss','first_level_ss','tech_ss','supervisory_ss','first_ss',
			'total_supervisory_ss','total_tech_ss','total_first_ss','second_level_tech_ss','second_level_actual_supervisory_ss',
			'second_level_actual_first_ss','total_actual_level_ss','total_all_four',

			'second_level_actual_tech_a','second_supervisory_a','second_tech_a','first_level_a','tech_a','supervisory_a','first_a',
			'total_supervisory_a','total_tech_a','total_first_a','second_level_tech_a','second_level_actual_supervisory_a',
			'second_level_actual_first_a','total_actual_level_a', 'total_all_five',

			'second_level_actual_tech_uc','second_supervisory_uc','second_tech_uc','first_level_uc','tech_uc','supervisory_uc','first_uc',
			'total_supervisory_uc','total_tech_uc','total_first_uc','second_level_tech_uc','second_level_actual_supervisory_uc',
			'second_level_actual_first_uc','total_actual_level_uc','total_all_six'
			));
						
		//return view('print.result_tat_costing_report',compact('plantilla','summary_date'7));
    }
	
	public function result_tat_costing_report(Request $request)
	{
		Paginator::useBootstrap();
		$start = date('Y-m-d', strtotime($request->start_date));
		$end = date('Y-m-d', strtotime($request->end_date));
		$status = strtoupper($request->status);

		if($status == "ALL"){
			$rules = [
				'status' => 'required'
			];
		}else{
			$rules = [
				'status' => 'required',
				'start_date'=>'required',
				'end_date'=>'required'
			];
		}

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);
		
		$sum_cost = array();
		
		if($status == "DONE"){
			$plantilla = \App\Costing::select('plantilla_number')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->count();
									
			$summary_date = \App\Costing::select('*')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->orderBy('summary_date', 'desc')
									->first();
											
				
			$summary_cost = \App\Costing::select('summary_cost')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->get();

									
			$masters = \App\Costing::select('*')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->get();
									
			$count_masters = \App\Costing::select('*')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->count();
		}elseif($status == "PENDING"){
			$plantilla = \App\Costing::select('plantilla_number')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->count();
								
			$summary_date = \App\Costing::select('*')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->orderBy('summary_date', 'desc')
								->first();
										
			
			$summary_cost = \App\Costing::select('summary_cost')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->get();

								
			$masters = \App\Costing::select('*')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->get();
								
			$count_masters = \App\Costing::select('*')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->count();
		}else{
			$plantilla = \App\Costing::select('plantilla_number')
								->count();
								
			$summary_date = \App\Costing::select('*')
								->orderBy('summary_date', 'desc')
								->first();
										
			
			$summary_cost = \App\Costing::select('summary_cost')
								->get();

								
			$masters = \App\Costing::select('*')
								->get();
								
			$count_masters = \App\Costing::select('*')
								->count();
		}
		
		foreach($summary_cost as $cost){
			array_push($sum_cost,$cost->summary_cost);
		}				
		return view('print.result_tat_costing_report',compact('plantilla','summary_date','sum_cost','masters','count_masters','start','end','status'));
	
		//return view('print.result_tat_costing_report',compact('plantilla','summary_date'7));
    }
	
	public function result_cpasc()
	{
		Paginator::useBootstrap();
		$masters = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->JOIN('trainings','schoolings.master_id','=','trainings.master_id')
								->where( [ 
											['schoolings.cport','CPORT'],
											['schoolings.cpbc','CPBC'],
											['schoolings.cpbsc','CPBSC'],
											['schoolings.cpasc','!=','CPASC'],
										])
								->groupBy('schoolings.master_id')
								->orderBy('masters.date_hired', 'DESC')
								->get();
		return view('print.result_cpasc',compact('masters'));
    }

	public function rating_report(Request $request)
    {	
	
		$rules = [
            'office' => 'required',
        ];

		$request->validate($rules);

		$startDate = date('Y-m-d', strtotime($request->start_date));
		$endDate = date('Y-m-d', strtotime($request->end_date));
		$office = $request->office;
		$count_outstanding =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','ratings.status','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Outstanding'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Outstanding'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->count();
		$count_vsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','ratings.status','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Very Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate]])
										->orWhere([  ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Very Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->count();
		$count_satisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','ratings.status','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([  ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->count();
		$count_unsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','ratings.status','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Unsatisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Unsatisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->count();
		$count_poor =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','ratings.status','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([  ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->count();
		$count_all =  \App\Plantilla::select('*')->where([ ['office_group',$office ] ])->orWhere([ ['office',$office ] ])->count();
		$count_filled = \App\Plantilla::select('*')
						->where([ ['office_group',$office ],['master_id','!=',NULL] ])
						->orWhere([ ['office',$office ],['master_id','!=',NULL] ])->count();
		$count_vacant =  \App\Plantilla::select('*')
					->where([ ['office_group',$office ],['master_id',NULL] ])
					->orWhere([ ['office',$office ],['master_id',NULL] ])->count();

		$count_outstanding == 0 ? $count_outstanding_percent = 0 : $count_outstanding_percent = round( ($count_outstanding / $count_filled) * 100);
		$count_vsatisfactory == 0 ? $count_vsatisfactory_percent = 0 : $count_vsatisfactory_percent = round( ($count_vsatisfactory / $count_filled) * 100);
		$count_satisfactory == 0 ? $count_satisfactory_percent = 0 : $count_satisfactory_percent = round( ($count_satisfactory / $count_filled) * 100);
		$count_unsatisfactory == 0 ? $count_unsatisfactory_percent = 0 : $count_unsatisfactory_percent = round( ($count_unsatisfactory / $count_filled) * 100);
		$count_poor == 0 ? $count_poor_percent = 0 : $count_poor_percent = round( ($count_poor / $count_filled) * 100);

		$get_outstanding_vsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();
		$get_satifactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();
		$get_unsatisfactory_poor =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Outstanding'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();

		$office1 = $str = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , ' ', $office);
	
		return view('content.rating_report',compact('count_all','count_filled','count_vacant','office','office1','count_outstanding','count_vsatisfactory','count_satisfactory','count_unsatisfactory','count_poor','count_outstanding_percent','count_vsatisfactory_percent','count_satisfactory_percent','count_unsatisfactory_percent','count_poor_percent','get_outstanding_vsatisfactory','get_satifactory','get_unsatisfactory_poor','startDate','endDate','office'));
	}

	public function awards_demog_report(Request $request)
	{	
		$rules = [
			'office' => 'required',
            'year' => 'required'
        ];
		
        $request->validate($rules);

		$date_commendation = $request->year;
		$office = $request->office;
		$national_awards = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$honor_awards = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['commendations.type_awards','HONOR AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','HONOR AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$incintives_awards= \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['commendations.type_awards','OTHER INCENTIVES'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','OTHER INCENTIVES'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$national_awards_female = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','FEMALE'],['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','FEMALE'],['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$national_awards_male = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','MALE'],['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','MALE'],['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$honor_awards_female = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','FEMALE'],['commendations.type_awards','HONOR AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','FEMALE'],['commendations.type_awards','HONOR AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$honor_awards_male = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','MALE'],['commendations.type_awards','HONOR AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','MALE'],['commendations.type_awards','HONOR AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$incintives_awards_female = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','FEMALE'],['commendations.type_awards','OTHER INCENTIVES'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','FEMALE'],['commendations.type_awards','OTHER INCENTIVES'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();

		$incintives_awards_male = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [ ['masters.gender','MALE'],['commendations.type_awards','OTHER INCENTIVES'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['masters.gender','MALE'],['commendations.type_awards','OTHER INCENTIVES'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();
								
		$staffing_chart = LarapexChart::barChart()
			->setTitle('GUAS AWARDEES DEMOGRAPHIC REPORT')
			->addData('Male', [$national_awards_male, $honor_awards_male,$incintives_awards_male])
			->addData('Female', [$national_awards_female, $honor_awards_female, $incintives_awards_female])
			->setXAxis(['National', 'Honor', 'Other Incentives']);

		return view('content.awards_demog_report',compact(
			'staffing_chart','national_awards','honor_awards','incintives_awards','date_commendation','office'
		));
	
	}


	public function demographics_result(Request $request)
    {
		Paginator::useBootstrap();
		$rules = [
            'variable' => 'required',
			'office' => 'required',
        ];
		
        $request->validate($rules);

		$variable = $request->input('variable');
		$office = $request->input('office');
		$date_dob = $request->start_year;
		$num_year = $request->no_years;
		$year_retirees = $request->year_retirees;
		$first = array();
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);

		#$master_count = \App\Master::select('*')->where([ ['item_number','!=',NULL],['deleted_at',NULL]])->orWhere([ ['item_number','!=','N/A'],['deleted_at',NULL]])->count();
			$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
							->count();

			//YEAR IN THE SERVICE
			$service = \App\Master::select('*')
							->where([ ['year_service',$num_year],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['year_service',$num_year],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orderBy('salary_grade','ASC')
							->paginate(10,['*'], 'service');
			
			$service_count = \App\Master::select('*')
							->where([ ['year_service',$num_year],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['year_service',$num_year],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orderBy('salary_grade','ASC')
							->count();

			//YEAR OF BIRTH
			$year_b = \App\Master::select('*')
							->where([ ['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('dob', '=', $date_dob)
							->orWhere([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('dob', '=', $date_dob)
							->get();
			
			$year_count = \App\Master::select('*')
							->where([ ['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('dob', '=', $date_dob)
							->orWhere([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('dob', '=', $date_dob)
							->count();

			//YEAR OF RETIREMENT
			$year_rb = \App\Master::select('*')
							->where([ ['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('retirement_date', '=', $year_retirees)
							->orWhere([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('retirement_date', '=', $year_retirees)
							->get();
			
			$year_rcount = \App\Master::select('*')
							->where([ ['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('retirement_date', '=', $year_retirees)
							->orWhere([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->whereYear('retirement_date', '=', $year_retirees)
							->count();

			//ELIGIBILITY
			$eligibility_csp = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','Career Service Professional'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','Career Service Professional'],['deleted_at',NULL]])
							->count();
			$eligibility_cssp = \App\Master::select('masters.*','eligibilities.eligilibity')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','Career Service SubProfessional'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','Career Service SubProfessional'],['deleted_at',NULL]])
							->count();

			$eligibility_bar = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','RA1080 Bar'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','RA1080 Bar'],['deleted_at',NULL]])
							->count();

			$eligibility_board = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','RA1080 Board'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','RA1080 Board'],['deleted_at',NULL]])
							->count();

			$eligibility__healthw_barangay = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','RA7883-Barangay Health Worker Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','RA7883-Barangay Health Worker Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_barangay_nutrition = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','PD1569-Barangay Nutrition Scholar Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','PD1569-Barangay Nutrition Scholar Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_barangay_official = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','RA7160-Barangay Official Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','RA7160-Barangay Official Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_fhonor_grad = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','CSC Res.1302714-Foreign School Honor Graduate Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','CSC Res.1302714-Foreign School Honor Graduate Eligibility'],['deleted_at',NULL]])
							->count();
			
			$eligibility_honor_grad = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','PD907-Honor Graduate Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','PD907-Honor Graduate Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_sanggunian = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','RA10156-Sanggunian Member Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','RA10156-Sanggunian Member Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_scientific = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','PD997-Scientific and Technological Specialist Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','PD997-Scientific and Technological Specialist Eligibility'],['deleted_at',NULL]])
							->count();
			
			$eligibility_skills = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','CSC MC11,s.1996, as Amended-Skills Eligibility - Category II'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','CSC MC11,s.1996, as Amended-Skills Eligibility - Category II'],['deleted_at',NULL]])
							->count();

			$eligibility_veteran = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','EO 132/790-Veteran Preference Rating'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','EO 132/790-Veteran Preference Rating'],['deleted_at',NULL]])
							->count();

			$eligibility_edp = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office',$office],['item_number','!=',NULL],['eligibility','=','CSC Res.90-083-Electronic Data Processing Specialist Eligibility'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','CSC Res.90-083-Electronic Data Processing Specialist Eligibility'],['deleted_at',NULL]])
							->count();

			$eligibility_others = \App\Master::select('masters.*','eligibilities.eligibility')
							->join('eligibilities','masters.main_id','=','eligibilities.master_id')
							->where([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','OTHERS'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['eligibility','=','OTHERS'],['deleted_at',NULL]])
							->count();	
			//CIVIL STATUS
			$status_single = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['civil_status','=','SINGLE'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['civil_status','=','SINGLE'],['deleted_at',NULL]])
							->count();
			
			$status_married = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['civil_status','=','MARRIED'],['deleted_at',NULL]])
							->orwhere([ ['office_group',$office],['item_number','!=',NULL],['civil_status','=','MARRIED'],['deleted_at',NULL]])
							->count();
							
			$status_widowed = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['civil_status','=','WIDOWED'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['civil_status','=','WIDOWED'],['deleted_at',NULL]])
							->count();

			$status_separated = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['civil_status','=','SEPARATED'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['civil_status','=','SEPARATED'],['deleted_at',NULL]])
							->count();

			$status_others = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['civil_status','=','OTHERS'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=',NULL],['civil_status','=','OTHERS'],['deleted_at',NULL]])
							->count();

			//SOLO PARENT
			$solo_no = \App\Master::select('masters.*','answers.c40')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['c40','=','No'],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['c40','=','No'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			$solo = \App\Master::select('masters.*','answers.c40_yes')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['c40','=',"Yes"],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['c40','=','Yes'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			//PWD
			$pwd_no = \App\Master::select('masters.*','answers.b40')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['b40','=','No'],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['b40','=','No'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			$pwd = \App\Master::select('masters.*','answers.b40')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['b40','=',"Yes"],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['b40','=','Yes'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();
			//INDIGENOUS
			$indigenous_no = \App\Master::select('masters.*','answers.a40_yes')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['a40','=','No'],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['a40','=','No'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			$indigenous = \App\Master::select('masters.*','answers.a40_yes')
							->join('answers','masters.main_id','=','answers.master_id')
							->where([ ['a40','=',"Yes"],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['a40','=','Yes'],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			//SEX
			$female_count = \App\Master::select('*')
							->where([ ['gender','=',"FEMALE"],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['gender','=',"FEMALE"],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();
						
			$male_count = \App\Master::select('*')
							->where([ ['gender','=',"MALE"],['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['gender','=',"MALE"],['office_group',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->count();

			//BLOOD TYPE MALE
			$bt_a = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','A'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','A'],['deleted_at',NULL]]
							)->count();
			$bt_ap = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','A+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','A+'],['deleted_at',NULL]])
							->count();
			$bt_am = \App\Master::select('*')->where([ ['office_group',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','A-'],['deleted_at',NULL]])->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','A-'],['deleted_at',NULL]])->count();

			$bt_b = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','B'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','B'],['deleted_at',NULL]])
							->count();
			$bt_bp = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','B+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','B+'],['deleted_at',NULL]])
							->count();
			$bt_bm = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','B-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','B-'],['deleted_at',NULL]])
							->count();

			$bt_o = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','O'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','O'],['deleted_at',NULL]])
							->count();
			$bt_op = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','O+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','O+'],['deleted_at',NULL]])
							->count();
			$bt_om = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','O-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','O-'],['deleted_at',NULL]])
							->count();

			$bt_ab = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','AB'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','AB'],['deleted_at',NULL]])
							->count();
			$bt_abp = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','AB+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','AB+'],['deleted_at',NULL]])
							->count();
			$bt_abm = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','MALE'],['blood_type','AB-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','MALE'],['blood_type','AB-'],['deleted_at',NULL]])
							->count();

			//BLOOD TYPE FEMALE
			$fbt_a = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','A'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','A'],['deleted_at',NULL]])
							->count();
			$fbt_ap = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','A+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','A+'],['deleted_at',NULL]])
							->count();
			$fbt_am = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','A-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','A-'],['deleted_at',NULL]])
							->count();

			$fbt_b = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','B'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','B'],['deleted_at',NULL]])
							->count();
			$fbt_bp = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','B+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','B+'],['deleted_at',NULL]])
							->count();
			$fbt_bm = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','B-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','B-'],['deleted_at',NULL]])
							->count();

			$fbt_o = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','O'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','O'],['deleted_at',NULL]])
							->count();
			$fbt_op = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','O+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','O+'],['deleted_at',NULL]])
							->count();
			$fbt_om = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','O-'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','O-'],['deleted_at',NULL]])
							->count();

			$fbt_ab = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','AB'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','AB'],['deleted_at',NULL]])
							->count();
			$fbt_abp = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','AB+'],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','AB+'],['deleted_at',NULL]])
							->count();
			$fbt_abm = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['gender','FEMALE'],['blood_type','AB-'],['deleted_at',NULL]])
							->orWhere([['office_group',$office], ['item_number','!=','N/A'],['gender','FEMALE'],['blood_type','AB-'],['deleted_at',NULL]])
							->count();
		
		$demographics_eligibility = LarapexChart::barChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData('CIVIL STATUS', [$eligibility_csp, $eligibility_cssp, $eligibility_bar, $eligibility_board, $eligibility__healthw_barangay,$eligibility_barangay_nutrition,$eligibility_barangay_official,$eligibility_fhonor_grad,$eligibility_honor_grad,$eligibility_sanggunian,$eligibility_scientific,$eligibility_skills,$eligibility_veteran,$eligibility_edp,$eligibility_others])
			->setXAxis(['CSP', 'CSSP', 'RA1080 Bar', 'RA1080 Board', 'RA7883','PD1569','RA7160','Res.1302714','PD907','RA10156','PD997','MC11,s.1996','EO 132/790','Res.90-083','OTHERS']);

		$demographics_bt = LarapexChart::barChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData('MALE', [$bt_a, $bt_ap, $bt_am, $bt_b, $bt_bp, $bt_bm, $bt_o, $bt_op, $bt_om, $bt_ab, $bt_abp, $bt_abm])
			->addData('FEMALE', [$fbt_a, $fbt_ap, $fbt_am, $fbt_b, $fbt_bp, $fbt_bm, $fbt_o, $fbt_op, $fbt_om, $fbt_ab, $fbt_abp, $fbt_abm])
			->setXAxis(['A', 'A+', 'A-', 'B', 'B+', 'B-','O','O+','O-','AB','AB+','AB-']);

		$demographics_cs = LarapexChart::barChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData('CIVIL STATUS', [$status_single, $status_married, $status_widowed, $status_separated, $status_others])
			->setXAxis(['Single', 'Married', 'Widowed', 'Separated', 'Others']);
	
		$demographics = LarapexChart::pieChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData([$male_count, $female_count])
			->setLabels(['MALE', 'FEMALE']);

		$demographics_ig = LarapexChart::pieChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData([$indigenous, $indigenous_no])
			->setLabels(['Indigenous Member', 'Non-indigenous Member']);
		
		$demographics_pwd = LarapexChart::pieChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData([$pwd, $pwd_no])
			->setLabels(['PWD Member', 'Non-PWD Member']);

		$demographics_solo = LarapexChart::pieChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office BASED ON $t_variable")
			->addData([$solo, $solo_no])
			->setLabels(['Solo Parent', 'Non-Solo Parent']);

		if($variable == "Blood Type"){
			return view('content.demographics_bt_result',compact('demographics_bt','master_count',
			'bt_a','bt_ap','bt_am','bt_b','bt_bp','bt_bm','bt_o','bt_op','bt_om','bt_ab','bt_abp','bt_abm',
			'fbt_a','fbt_ap','fbt_am','fbt_b','fbt_bp','fbt_bm','fbt_o','fbt_op','fbt_om','fbt_ab','fbt_abp','fbt_abm','office'
		));
		}elseif($variable == "Civil Status"){
			return view('content.demographics_cs_result',compact('demographics_cs','master_count','status_others','status_widowed','status_separated','status_single','status_married','office'));
		}elseif($variable == "Sex"){
			return view('content.demographics_s_result',compact('demographics','master_count','male_count','female_count','office'));
		}elseif($variable == "Solo Parent"){
			return view('content.demographics_sp_result',compact('demographics_solo','master_count','solo_no','solo','office'));
		}elseif($variable == "Year of Retirement"){
			return view('content.demographics_yr_result',compact('demographics','master_count','year_rb','year_rcount','year_retirees','office'));
		}elseif($variable == "Type of Eligibility"){
			return view('content.demographics_te_result',compact('demographics_eligibility','master_count','eligibility_csp','eligibility_cssp','eligibility_bar','eligibility_board','eligibility__healthw_barangay','eligibility_barangay_nutrition','eligibility_barangay_official','eligibility_fhonor_grad','eligibility_honor_grad','eligibility_sanggunian','eligibility_scientific','eligibility_skills','eligibility_veteran','eligibility_edp','eligibility_others','office'));
		}elseif($variable == "Indigenous Group Membership"){
			return view('content.demographics_ig_result',compact('demographics_ig','master_count','indigenous_no','indigenous','office'));
		}elseif($variable == "Year of Birth"){
			return view('content.demographics_yb_result',compact('demographics','master_count','year_b','year_count','office','date_dob'));
		}elseif($variable == "Years of Service in the AFP"){
			return view('content.demographics_ys_result',compact('demographics','master_count','service','service_count','office','num_year'));
		}elseif($variable == "PWD Membership"){
			return view('content.demographics_pwd_result',compact('demographics_pwd','master_count','pwd_no','pwd','office'));
		}else{
			return view('content.demographics_bt_result',compact('demographics','master_count','office'));
		}
    }
	
	
}
