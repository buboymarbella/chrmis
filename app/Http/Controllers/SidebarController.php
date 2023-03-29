<?php

namespace App\Http\Controllers;

use App\Master;
use App\User;
use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class SidebarController extends Controller
{
     //Authenticated User
    public function __construct(){
        $this->middleware('auth');
    }
	
	public function view_records()
    {
		Paginator::useBootstrap();
		//pagination
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}

		if(\Auth::user()->acc_lvl != "Administrator" && \Auth::user()->acc_lvl == "User"){
			$masters = Master::latest('masters.created_at')
						->where('masters.email',\Auth::user()->email)
						->groupBy('masters.email')
						->paginate(10,['*'], 'masters');
						
			$counts = Master::latest('masters.created_at')
						->where('masters.email',\Auth::user()->email)
						->count();
		}elseif(\Auth::user()->acc_lvl == "Manager"){
			$masters = Master::latest('masters.created_at')
						->where('masters.office',\Auth::user()->office)
						->groupBy('masters.email')
						->paginate(10,['*'], 'masters');
						
			$counts = Master::latest('masters.created_at')
						->where('masters.email',\Auth::user()->email)
						->count();
		}else{
			$masters = Master::with('user')->latest()->paginate(10,['*'], 'masters');
			$counts = Master::with('user')->count();
		}
        return view('content.view_records',compact('masters','counts'));
		
    }

	public function view_records_2()
    {
		Paginator::useBootstrap();
		//pagination
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = Master::latest('masters.created_at')
						->where('masters.office',\Auth::user()->office)
						->get();
						
			$counts = Master::latest('masters.created_at')
						->where('masters.office',\Auth::user()->office)
						->count();
		}else{
			$masters = Master::with('user')->get();
			$counts = Master::with('user')->count();
		}

        return json_encode($masters);
    }
	
	public function training_matrix()
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
		$count_cport = 	\App\Master::select('masters.*','schoolings.cport','schoolings.cpbc','schoolings.cpbc')
						->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
						->where([ ['schoolings.cport',NULL]])
						->orWhere([ ['schoolings.cport', '']])
						->count();
						
		$count_cpbc = \App\Master::select('*')
						->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
						->where( [ ['schoolings.cport','CPORT'],['schoolings.cpbc','!=','CPBC'] ])
						->count();
		$count_cpbsc = \App\Master::select('*')
						->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
						->where([ ['schoolings.cport','CPORT'],['schoolings.cpbc','CPBC'],['schoolings.cpbsc','!=','CPBSC']])
						->count();
		$count_cpasc = \App\Master::select('*')
						->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
						->where([ ['schoolings.cport','CPORT'],['schoolings.cpbc','CPBC'],['schoolings.cpbsc','CPBSC'],['schoolings.cpasc','!=','CPASC']])
						->count();
						
		$total = $count_cport + $count_cpbc + $count_cpbsc + $count_cpasc;

        return view('content.training_matrix',compact('count_cport','count_cpbc','count_cpbsc','count_cpasc','total'));
    }
	
	public function tat_costing_report()
    {
		Paginator::useBootstrap();
		$master = \App\Master::all();
		$office = \App\Master::select("*")->groupBy("office")->orderBy("office")->get();
		return view('content.tat_costing_report',compact('master','office'));
    }
	
	public function training_accomp_report()
    {
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
		$master = \App\Master::all();
		$office = \App\Master::select("*")->groupBy("office")->orderBy("office")->get();
		return view('content.training_accomp_report',compact('master','office'));
    }
	
	public function view_tat_records()
    {
		Paginator::useBootstrap();
		$masters = \App\Costing::select("costings.*","plantillas.plantilla_number")
				->join('plantillas','costings.plantilla_number','plantillas.id')
				->orderBy("rai_date_e",'desc')
				->paginate(10,['*'], 'masters');
		$master_count = \App\Costing::select("costings.*","plantillas.plantilla_number")
				->join('plantillas','costings.plantilla_number','plantillas.id')
				->orderBy("rai_date_e",'desc')
				->count();
		$office = \App\Master::select("*")->groupBy("office")->orderBy("office")->get();
		return view('content.view_tat_records',compact('masters','office','master_count'));
    }
	
	public function image_gallery()
    {
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
		//pagination
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = Master::latest('masters.created_at')
						->join('users', 'masters.user_id', '=', 'users.id')
						->join('photos', 'masters.main_id', '=', 'photos.master_id')
						->where('users.office',\Auth::user()->office)
						->paginate(12);
			$counts = Master::latest('masters.created_at')
						->join('photos', 'masters.main_id', '=', 'photos.master_id')
						->join('users', 'masters.user_id', '=', 'users.id')
						->where('users.office',\Auth::user()->office)
						->count();
		}else{
			$masters = Master::latest('masters.created_at')
						->join('photos', 'masters.main_id', '=', 'photos.master_id')
						->paginate(12);
			$counts = Master::latest('masters.created_at')
						->join('photos', 'masters.main_id', '=', 'photos.master_id')
						->paginate(12);
		}
        return view('content.gallery',compact('masters','counts'));
    }

	public function staffing_plan()
	{	
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$plantilla_jsw_1st = \App\Plantilla::select('*')->where( [ ['office_group','COORDINATING_STAFF'],['level_class','1ST'],['staff_action',NULL]])->count();
		$plantilla_jsw_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','COORDINATING_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','COORDINATING_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_uc_1st = \App\Plantilla::select('*')->where( [ ['office_group','UNIFIED_COMMAND'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_uc_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','UNIFIED_COMMAND'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','UNIFIED_COMMAND'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_afpsus_1st = \App\Plantilla::select('*')->where( [ ['office_group','AFPWSSUS'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_afpsus_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','AFPWSSUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','AFPWSSUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_pers_1st = \App\Plantilla::select('*')->where( [ ['office_group','PERSONAL_STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_pers_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','PERSONAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','PERSONAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_special_1st = \App\Plantilla::select('*')->where( [ ['office_group','SPECIAL STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_special_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','SPECIAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','SPECIAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_kbus_1st = \App\Plantilla::select('*')->where( [ ['office_group','KBUS'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_kbus_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','KBUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','KBUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$a =  $plantilla_jsw_1st + $plantilla_pers_1st + $plantilla_special_1st + $plantilla_uc_1st + $plantilla_afpsus_1st + $plantilla_kbus_1st;
		$b =  $plantilla_jsw_2nd + $plantilla_pers_2nd + $plantilla_special_2nd + $plantilla_uc_2nd + $plantilla_afpsus_2nd + $plantilla_kbus_2nd;
		$c = $a + $b;

		$staffing_chart = LarapexChart::barChart()
			->setTitle('ACTUAL VACANT PLANTILLA POSITIONS AT GUAS')
			->addData('Vacant 1st Level', [$plantilla_jsw_1st, $plantilla_pers_1st,$plantilla_special_1st,$plantilla_uc_1st,$plantilla_afpsus_1st,$plantilla_kbus_1st])
			->addData('Vacant 2nd Level', [$plantilla_jsw_2nd, $plantilla_pers_2nd, $plantilla_special_2nd,$plantilla_uc_2nd,$plantilla_afpsus_2nd,$plantilla_kbus_2nd])
			->setXAxis(['J-STAFF', 'P-STAFF', 'S-STAFF', 'UCS', 'AFPWSSUS', 'KBUS']);
		// $staffing_chart = LarapexChart::barChart()
		// 	->setTitle('San Francisco vs Boston.')
		// 	->setSubtitle('Wins during season 2021.')
		// 	->addData('San Francisco', [6, 9, 3, 4, 10, 8])
		// 	->addData('Boston', [7, 3, 8, 2, 6, 4])
		// 	->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

		return view('content.staffing_plan_report',compact(
			'plantilla_jsw_1st','plantilla_jsw_2nd','plantilla_uc_1st','plantilla_uc_2nd',
			'plantilla_afpsus_1st','plantilla_afpsus_2nd','plantilla_pers_1st','plantilla_pers_2nd',
			'plantilla_special_1st','plantilla_special_2nd','c','plantilla_kbus_2nd','plantilla_kbus_1st','staffing_chart'
		));
	}

	public function computer_asst_matrix()
	{	
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$plantilla_jsw_1st = \App\Plantilla::select('*')->where( [ ['office_group','COORDINATING_STAFF'],['level_class','1ST'],['staff_action',NULL]])->count();
		$plantilla_jsw_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','COORDINATING_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','COORDINATING_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_uc_1st = \App\Plantilla::select('*')->where( [ ['office_group','UNIFIED_COMMAND'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_uc_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','UNIFIED_COMMAND'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','UNIFIED_COMMAND'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_afpsus_1st = \App\Plantilla::select('*')->where( [ ['office_group','AFPWSSUS'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_afpsus_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','AFPWSSUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','AFPWSSUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_pers_1st = \App\Plantilla::select('*')->where( [ ['office_group','PERSONAL_STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_pers_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','PERSONAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','PERSONAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_special_1st = \App\Plantilla::select('*')->where( [ ['office_group','SPECIAL STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_special_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','SPECIAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','SPECIAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$plantilla_kbus_1st = \App\Plantilla::select('*')->where( [ ['office_group','KBUS'],['level_class','1ST'],['master_id',NULL]])->count();
		$plantilla_kbus_2nd = \App\Plantilla::select('*')
				->where( [ ['office_group','KBUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
				->orWhere( [ ['office_group','KBUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
				->count();

		$a =  $plantilla_jsw_1st + $plantilla_pers_1st + $plantilla_special_1st + $plantilla_uc_1st + $plantilla_afpsus_1st + $plantilla_kbus_1st;
		$b =  $plantilla_jsw_2nd + $plantilla_pers_2nd + $plantilla_special_2nd + $plantilla_uc_2nd + $plantilla_afpsus_2nd + $plantilla_kbus_2nd;
		$c = $a + $b;

		$staffing_chart = LarapexChart::barChart()
			->setTitle('ACTUAL VACANT PLANTILLA POSITIONS AT GUAS')
			->addData('Vacant 1st Level', [$plantilla_jsw_1st, $plantilla_pers_1st,$plantilla_special_1st,$plantilla_uc_1st,$plantilla_afpsus_1st,$plantilla_kbus_1st])
			->addData('Vacant 2nd Level', [$plantilla_jsw_2nd, $plantilla_pers_2nd, $plantilla_special_2nd,$plantilla_uc_2nd,$plantilla_afpsus_2nd,$plantilla_kbus_2nd])
			->setXAxis(['J-STAFF', 'P-STAFF', 'S-STAFF', 'UCS', 'AFPWSSUS', 'KBUS']);

		return view('content.comp_asst_matrix',compact(
			'plantilla_jsw_1st','plantilla_jsw_2nd','plantilla_uc_1st','plantilla_uc_2nd',
			'plantilla_afpsus_1st','plantilla_afpsus_2nd','plantilla_pers_1st','plantilla_pers_2nd',
			'plantilla_special_1st','plantilla_special_2nd','c','plantilla_kbus_2nd','plantilla_kbus_1st','staffing_chart'
		));

	}

	public function awards_demog_date(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$office = \App\Unit::select("*")->get();
		return view('content.awards_demog_date',compact('office'));
	}

	public function performance_rating(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$office = \App\Unit::select("*")->get();
		return view('content.performance_rating',compact('office'));
	}

	public function awards_demog_national(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$date_commendation = $request->date_commendation;
		$office = $request->office;
		Paginator::useBootstrap();

        $national_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->paginate(20,['*'], 'national_awards');

		$national_awards_count = \App\Commendation::select('commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();
		
		return view('content.awards_demog_national',compact('national_awards','national_awards_count','date_commendation','office'));
	}

	public function awards_demog_honor(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$date_commendation = $request->date_commendation;
		$office = $request->office;
		Paginator::useBootstrap();
        $honor_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','HONOR AWARDS'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->paginate(20,['*'], 'honor_awards');

		$honor_awards_count = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','HONOR AWARDS'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();
		
		return view('content.awards_demog_honor',compact('honor_awards','honor_awards_count','date_commendation','office'));
	}

	public function awards_demog_incentives(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$date_commendation = $request->date_commendation;
		$office = $request->office;
		Paginator::useBootstrap();
        $incentives_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','OTHER INCENTIVES'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->paginate(20,['*'], 'incentives_awards');

		$incentives_awards_count = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','OTHER INCENTIVES'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->count();
		
		return view('content.awards_demog_incentives',compact('incentives_awards','incentives_awards_count','date_commendation','office'));
	}

	public function demographics(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$qualification = \App\Qualification::select("*")->orderBy('eligibility','asc')->get();
		$office = \App\Unit::select("*")->get();
		return view('content.demographics',compact('office','qualification'));
	}

	public function performance_mgt_monitoring(Request $request)
	{
		$office = \App\Unit::select("*")->get();
		return view('content.performance_mgt_monitoring',compact('office'));
	}
	
	public function staffing_office_plan($id)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
        $plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->get();
        $count_plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->count();
		
		return view('content.staffing_plan_office_report',compact('plantilla','count_plantilla','id'));
	}

	public function computer_asst_matrix_office($id)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
        $plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->paginate(10,['*'], 'plantilla');
        $count_plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->count();
		
		return view('content.comp_asst_matrix_report',compact('plantilla','count_plantilla','id'));
	}

	public function comp_asst_matrix_vacant_pos($id)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		Paginator::useBootstrap();
        $master = \App\Plantilla::select('*')->where([ ['plantilla_number',$id],['master_id',NULL] ])->first();
		$sg = $master->sg - 4;
        $count_plantilla = \App\Plantilla::select('*')->where([ ['plantilla_number',$id],['master_id',NULL] ])->count();
		// $candidate = \App\Master::select('*')->where([ ['salary_grade','>',$sg],['salary_grade','<',$master->sg] ])->get();
		$candidate = \App\Master::select('masters.*',DB::raw('SUM(works.year_exp) as sum_year'))
						->join('works','masters.main_id','works.master_id')
						->where([ ['masters.salary_grade','>',$sg],['masters.salary_grade','<',$master->sg],['works.gov_service','Y'] ])
						->get();
		return view('content.comp_asst_matrix_vacant_pos',compact('master','count_plantilla','id','candidate'));
	}

	public function addToComp(Request $request,$id)
    {
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
        // $candidate = Master::findOrFail($id);
		$candidate = \App\Master::select('*')->where([ ['main_id',$id] ])->first();
        $comp = session()->get('comp', []);
		$com = [];
		$training =[];
		$c1 =[];
		$g1 =[];
		$r1 =[];
		$d1 =[];
		$v1 =[];
		$commendation = \App\Commendation::select('*')->where([ ['master_id',$id] ,['type_awards',"!=",'OTHER INCENTIVES']])->get();
		$commendation1 = \App\Commendation::select('*')->where([ ['master_id',$id],['type_awards','OTHER INCENTIVES'] ])->count();

		$commendation_afp = \App\Commendation::select('*')->where([ ['master_id',$id] ,['type_awards',"!=",'OTHER INCENTIVES'],['type_awards',"!=",'NATIONAL AWARDS'],['commendation',"!=",'DND AWARD'],['commendation',"!=",'MAJOR SERVICE AWARD (COMMAND PLAQUE)'],['commendation',"!=",'CIVIL SERVICE COMMISSION PAGASA AWARDS'],['commendation',"!=",'CHIEF OF OFFICE'],['commendation',"!=",'CHIEF OF OFFICE']])->count();
		$commendation_president = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','PRESIDENT LINGKOD BAYAN']])->count();
		$commendation_pagasa = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','CIVIL SERVICE COMMISSION PAGASA AWARDS']])->count();
		$commendation_dangal = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','OUTSTANDING PUBLIC']])->count();
		$commendation_major_service = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','MAJOR SERVICE AWARD (COMMAND PLAQUE)']])->count();
		$commendation_dnd = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','DND AWARD']])->count();
		$commendation_chief = \App\Commendation::select('*')->where([ ['master_id',$id] ,['commendation','CHIEF OF OFFICE']])->count();
		
		$college = \App\College::select('*')->where([ ['master_id',$id] ])->get();
		$graduate = \App\Graduate::select('*')->where([ ['master_id',$id],['type_schooling','Masteral']])->get();
		$doctorate = \App\Graduate::select('*')->where([ ['master_id',$id],['type_schooling','Doctorate']])->get();
		$vocational = \App\Vocational::select('*')->where([ ['master_id',$id]])->get();

		$rating = \App\Rating::select('*')->where([ ['master_id',$id]])->orderBy('created_at','desc')->first();
		
		$career = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','CPBC']])
				->orWhere([ ['master_id',$id],['training_program','CPORT']])
				->orWhere([ ['master_id',$id],['training_program','CPBSC']])
				->orWhere([ ['master_id',$id],['training_program','CPASC']])
				->get();
		$career1 = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','!=','CPBC'],['training_program','!=','CPORT'],['training_program','!=','CPBSC'] ,['training_program','!=','CPASC']])
				->sum('number_hours');
		
		$cport = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','CPORT']])
				->count();

		$cpbc = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','CPBC']])
				->count();
		
		$cpbsc = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','CPBSC']])
				->count();

		$cpasc = \App\Training::select('*')
				->where([ ['master_id',$id],['training_program','CPASC']])
				->count();

		$cpbc >= 1 ? $cpbc = 1 : $cpbc = 0;
	    $cpbsc >= 1? $cpbsc = 2 : $cpbsc = 0;
		$cpasc >= 1 ? $cpasc = 2 : $cpasc = 0;

		$commendation_president >= 1 ? $commendation_president = 5 : $commendation_president = 0;
		$commendation_pagasa >= 1 ? $commendation_pagasa =4.5 : $commendation_pagasa=0;
		$commendation_dangal >= 1 ? $commendation_dangal =4: $commendation_dangal=0;
		$commendation_major_service >= 1 ? $commendation_major_service =2.5 : $commendation_major_service=0;
		$commendation_dnd >= 1 ? $commendation_dnd =3.5 : $commendation_dnd=0;
		$commendation_chief >= 1 ? $commendation_chief =2 : $commendation_chief=0;
		$commendation_afp >= 1 ? $commendation_afp = 3 : $commendation_afp =0;
		
		$commendation_total = $commendation1 * 0.25;
		if($commendation_total > 5){
			$commendation_total = 5;
		}else{
			$commendation_total = $commendation1 * 0.25;
		}


		$t_commendation = $commendation_total + $commendation_president + $commendation_pagasa + $commendation_dangal + $commendation_major_service + $commendation_dnd + $commendation_chief + $commendation_afp;

		$t_commendation > 10 ? $t_commendation = 10 : $t_commendation=$t_commendation;

		$work_exp = \App\Work::select('*')
				->where([ ['master_id',$id],['gov_service','Y']])
				->sum('year_exp');

		foreach($commendation as $commendation){
			$com[] = $commendation->commendation;
		}

		foreach($career as $career){
			$training[] = $career->training_program;
		}

		foreach($vocational as $vocational){
			$v1[] = $vocational->course;
		}

		// foreach($rating as $rating){
		// 	$r1[] = $rating->n_rating." / ".$rating->s_assessment."-".$rating->e_assessment;
		// }
		
		$col1  = 0;
		$grad1 = 0;
		$doc1  = 0;
		
		foreach($college as $college){

			if($college->units_earned == ""){
				$c1[] = $college->course;
				$col1 = 1;
			}
			// else{
			// 	$c1[] = "Not graduated-".$college->course."-".$college->units_earned." Unit's";
			// }
			
		}
		
		foreach($graduate as $graduate){

			if($graduate->units_earned == ""){
				$g1[]  = $graduate->course;
				$grad1 = 1;
			}
			// else{
			// 	$g1[] = "Not graduated-".$graduate->course."-".$graduate->units_earned." Unit's";;
			// }
			
		}

		foreach($doctorate as $doctorate){

			if($doctorate->units_earned == ""){
				$d1[] = $doctorate->course;
				$doc1 = 1;
			}
			// else{
			// 	$d1[] = "Not graduated-".$doctorate->course."-".$doctorate->units_earned." Unit's";
			// }
			
		}
		$educ_grade = 0;
		if($col1 != 0 && $grad1 == 0 && $doc1 == 0) {
			$educ_grade = 10;
		}
		
		if($col1 != 0 && $grad1 != 0){
			$educ_grade = 12;
		}

		if($col1 != 0 && $grad1 != 0 && $doc1 != 0){
			$educ_grade = 15;
		}

		$com = join(",",$com);
		$training = join(",",$training);
		$c1 =join(",",$c1);
		$g1 =join(",",$g1);
		$r1 =join(",",$r1);
		$d1 =join(",",$d1);
		$v1 =join(",",$v1);

		$r = "";
		$rating_total = "";
		if(!empty($rating->n_rating)){
			$r = $rating->n_rating." / ".date("d M Y", strtotime($rating->s_assessment))."-".date("d M Y", strtotime($rating->e_assessment));
			$rating_total = 30 * $rating->n_rating / 5;
		}else{
			$r = "N/A";
			$rating_total = 0;
		}
		
		
		$training_other = $career1 / 24;

		if($training_other > 5){
			$training_other = 5;
		}else{
			$training_other = $career1 / 24;
		}

		if(!isset($comp[$id])){
			$comp[$id] = [
                "name" => $candidate->complete_name,
                "salary_grade" => $candidate->salary_grade,
				"position" => $candidate->position,
				"office" => $candidate->office,
				"dob" => $candidate->dob,
				"college" => json_encode($c1), 
				"educ_points" => $educ_grade,
				"vocational" => json_encode($v1),
				"graduate" => json_encode($g1),
				"doctorate" => json_encode($d1),
				"commendation" => json_encode($com),
				"career" => json_encode($training),
				"career1" => $career1,
				"rating" => $r,
				"exp" => $work_exp,
				"rating_total" => $rating_total,
				"training_other" => $training_other + $cpbc + $cpbsc + $cpasc,
				"commendation_total" => $t_commendation,
				"commendation1" => $commendation1
            ];
		}

        session()->put('comp',$comp);
		
		return redirect()->back()->with('none', 'Candidate added successfully!');
        
    }

	public function remove(Request $request)
    {
        if($request->id) {
            $comp = session()->get('comp');
            if(isset($comp[$request->id])) {
                unset($comp[$request->id]);
                session()->put('comp', $comp);
            }
            session()->flash('none', 'Candidate removed successfully');
        }
    }

	public function fill_up_rate_date(Request $request)
	{
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$office = \App\Unit::select("*")->get();
		return view('content.fill_up_rate_date',compact('office'));
	}

	public function fill_up_rate(Request $request)
	{	
		$startDate = date('Y-m-d', strtotime($request->start_date));
		$endDate = date('Y-m-d', strtotime($request->end_date));
		$office = $request->office;
		if($office == "all"){
			$rules = [
				'office' => 'required',
			];
			
			$guas = \App\Plantilla::select('*')->count();
			$vacant = \App\Plantilla::select('*')->where( [ ['master_id',NULL]])->count();
			$filled = \App\Plantilla::select('*')->where([ ['master_id','!=',NULL]])->count();
			$total_fv = \App\Plantilla::select('*')->count();

			$vacant == 0 ? $total_vacant = 0 : $total_vacant = round($vacant / $total_fv * 100,2);
			$filled == 0 ? $total_filled = 0 : $total_filled = round($filled / $total_fv * 100,2);

			$first_level_vacant = \App\Plantilla::select('*')->where([['level_class','1ST'],['staff_action',NULL]])->count();
			$second_level_vacant = \App\Plantilla::select('*')
					->where( [ ['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id','']])
					->count();
			$first_level_filled = \App\Plantilla::select('*')->where([['level_class','1ST'],['master_id','!=',NULL]])->count();
			$second_level_filled = \App\Plantilla::select('*')
					->where( [['level_class','2ND_TECH'],['master_id','!=',NULL]])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id','!=',NULL]])
					->count();
		}else{
			$rules = [
				'office' => 'required',
				'start_date' => 'required',
				'end_date' => 'required'
			];
			$guas = \App\Plantilla::select('*')->count();
			$vacant = \App\Plantilla::select('*')->where( [ ['master_id',NULL]])->count();
			$filled = \App\Plantilla::select('*')->where([ ['master_id','!=',NULL] ,['date_hired','>=',$startDate],['date_hired','<=',$endDate]])->count();
			$total_fv = \App\Plantilla::select('*')->count();

			$vacant == 0 ? $total_vacant = 0 : $total_vacant = round($vacant / $total_fv * 100,2);
			$filled == 0 ? $total_filled = 0 : $total_filled = round($filled / $total_fv * 100,2);

			$first_level_vacant = \App\Plantilla::select('*')->where([['level_class','1ST'],['staff_action',NULL]])->count();
			$second_level_vacant = \App\Plantilla::select('*')
					->where( [ ['level_class','2ND_TECH'],['master_id',NULL] ,['date_hired','>=',$startDate],['date_hired','<=',$endDate]])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id',NULL],['date_hired','>=',$startDate],['date_hired','<=',$endDate]])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id',''],['date_hired','>=',$startDate],['date_hired','<=',$endDate]])
					->count();
			$first_level_filled = \App\Plantilla::select('*')->where([['level_class','1ST'],['master_id','!=',NULL],['date_hired','>=',$startDate],['date_hired','<=',$endDate]])->count();
			$second_level_filled = \App\Plantilla::select('*')
					->where( [['level_class','2ND_TECH'],['master_id','!=',NULL],['date_hired','>=',$startDate],['date_hired','<=',$endDate]])
					->orWhere( [ ['level_class','2ND_SUPERVISORY'],['master_id','!=',NULL],['date_hired','>=',$startDate],['date_hired','<=',$endDate]])
					->count();
		}
		$request->validate($rules);
		$piechart_fill_up = LarapexChart::piechart()
		->setTitle('FILL-UP RATE REPORT')
		->addData([$total_vacant, $total_filled])
		->setColors(['#0057ff','#feb019'])
		->setLabels(["Vacant Percentage", "Filled Percentage"]);
		return view('content.fill_up_rate_report',compact(
			'guas','vacant','first_level_vacant','second_level_vacant','filled','first_level_filled','second_level_filled','piechart_fill_up','startDate','endDate','office'));

	}

	public function fill_up_rate_office_report($id){
		if (!\Gate::allows('isManager', Auth::user()->office)) {
			abort(404,'Sorry you cant do this action');
	  	}
		$guas = \App\Plantilla::select('*')->count();
		$vacant = \App\Plantilla::select('*')->where( 'staff_action',NULL)->count();
		$filled = \App\Plantilla::select('*')->where('staff_action','fill')->count();
		$first_level_vacant = \App\Plantilla::select('*')->where([['level_class','1ST'],['staff_action',NULL]])->count();
		$second_level_vacant = \App\Plantilla::select('*')
				->where( [ ['level_class','2ND_TECH'],['staff_action',NULL] ])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['staff_action',NULL]])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['staff_action','']])
				->count();
		$first_level_filled = \App\Plantilla::select('*')->where([['level_class','1ST'],['staff_action','fill']])->count();
		$second_level_filled = \App\Plantilla::select('*')
				->where( [['level_class','2ND_TECH'],['staff_action','fill'] ])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['staff_action','fill']])
				->count();

		$group = \App\Plantilla::select('*')->where('office_group',$id)->count();
		$vacant_group = \App\Plantilla::select('*')->where([ ['office_group',$id], ['staff_action',NULL] ])->count();
		$filled_group = \App\Plantilla::select('*')->where([ ['office_group',$id], ['staff_action','fill'] ])->count();
		$first_level_vacant_group = \App\Plantilla::select('*')->where([['office_group',$id],['level_class','1ST'],['staff_action',NULL]])->count();
		$second_level_vacant_group = \App\Plantilla::select('*')
				->where( [ ['level_class','2ND_TECH'],['office_group',$id],['staff_action',NULL] ])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['office_group',$id],['staff_action',NULL]])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['office_group',$id],['staff_action','']])
				->count();
		$first_level_filled_group = \App\Plantilla::select('*')->where([['level_class','1ST'],['office_group',$id],['staff_action','fill']])->count();
		$second_level_filled_group = \App\Plantilla::select('*')
				->where( [['level_class','2ND_TECH'],['office_group',$id],['staff_action','fill'] ])
				->orWhere( [ ['level_class','2ND_SUPERVISORY'],['office_group',$id],['staff_action','fill']])
				->count();

		$piechart_fill_up = LarapexChart::piechart()
				->setTitle('FILL-UP RATE REPORT')
				->addData([$vacant, $filled])
				->setColors(['#0057ff','#feb019'])
				->setLabels(['Vacant', 'Filled']);

		$var = trim($id);
		$replace = str_replace('_', ' ', $var);
		return view('content.fill_up_rate_office_report',compact(
			'guas','vacant','first_level_vacant','second_level_vacant','filled','first_level_filled','second_level_filled','piechart_fill_up','replace',
			'group','vacant_group','first_level_vacant_group','second_level_vacant_group','filled_group','first_level_filled_group','second_level_filled_group'
		
		));

	}
	
}
