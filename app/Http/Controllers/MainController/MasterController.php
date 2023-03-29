<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Auth;
use Image;
use App\Master;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class MasterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
		date_default_timezone_set('Asia/Manila');
    }
	
    public function index()
    {
		// $clientIP = \Request::ip();
		// $ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Login"]);
		// $ledger->save();

		if(Auth::user()->acc_lvl == 'User'){
			$ms =  \App\Master::where('email',Auth::user()->email)->first();
			return redirect()->route('masters.show', $ms->main_id);
		}
		Paginator::useBootstrap();
        //pagination
		$first = array();
		$second = array();
		$third = array();
		$fourt = array();
		$dateOfBirth = "";
		
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = Master::latest('masters.created_at')
						->where('masters.office',\Auth::user()->office)
						->orderBy('masters.salary_grade')
						->paginate(10);
						
			$masters1 = Master::latest('masters.created_at')
						->where('masters.office',\Auth::user()->office);
						
			$counts = Master::latest('masters.created_at')
						->join('users', 'masters.user_id', '=', 'users.id')
						->where('users.office',\Auth::user()->office)
						->count();
			$masters1 = Master::select('*')->where('office',Auth::user()->office)->get();		
			
			foreach($masters1 as $master1){
		
				if($master1->dob == "NULL" && $master1->dob == ""){
					$dateOfBirth = "";
				}elseif($master1->dob != "NULL" && $master1->dob != ""){
					$dateOfBirth = $master1->dob;
					$newDate = date("Y-m-d", strtotime($dateOfBirth));
					
					$today = date("Y-m-d");
					$diff = date_diff(date_create($newDate), date_create($today));
					$age = $diff->format('%y');
					
					if($age >=50 && $age <= 65){
						array_push($first,$master1->dob);
					}elseif($age >=40 && $age <= 49){
						array_push($second,$master1->dob);
					}elseif($age >=30 && $age <= 39){
						array_push($third,$master1->dob);
					}elseif($age >=18 && $age <= 29){
						array_push($fourt,$master1->dob);
					}else{
						echo "";
					}
				}
			}
			
		}else{
			$masters = Master::latest('masters.created_at')
						->orderBy('masters.salary_grade')
						->paginate(10);
						
			$masters1 = Master::all();
			
			foreach($masters1 as $master1){
				
				if($master1->dob == "NULL" && $master1->dob == ""){
					$dateOfBirth = "";
				}elseif($master1->dob != "NULL" && $master1->dob != ""){
					$dateOfBirth = $master1->dob;
					$newDate = date("Y-m-d", strtotime($dateOfBirth));
					
					$today = date("Y-m-d");
					$diff = date_diff(date_create($newDate), date_create($today));
					$age = $diff->format('%y');
					
					if($age >=50 && $age <= 65){
						array_push($first,$master1->dob);
					}elseif($age >=40 && $age <= 49){
						array_push($second,$master1->dob);
					}elseif($age >=30 && $age <= 39){
						array_push($third,$master1->dob);
					}elseif($age >=18 && $age <= 29){
						array_push($fourt,$master1->dob);
					}else{
						echo "";
					}
				}
			}
						
			$counts = Master::with('user')->count();
		}
		if(\Auth::user()->acc_lvl != "Administrator"){
			$count_chr = Master::with('user')->where( [ ['employ_stat','PERMANENT'], ['office',Auth::user()->office], ])->count();
			$count_job_order = Master::with('user')->where([ ['employ_stat','JOB ORDER'], ['office',Auth::user()->office], ])->count();
			$count_temporary = Master::with('user')->where([ ['employ_stat','TEMPORARY'], ['office',Auth::user()->office], ])->count();
			$count_casual = Master::with('user')->where([ ['employ_stat','CASUAL'], ['office',Auth::user()->office], ])->count();
			$count_female = Master::with('user')->where([ ['gender','FEMALE'], ['office',Auth::user()->office], ])->count();
			$count_male = Master::with('user')->where([ ['gender','MALE'], ['office',Auth::user()->office], ])->count();
			$a1 = Master::with('user')->where( [ ['blood_type','A'], ['office',Auth::user()->office], ])->count();
			$a2 = Master::with('user')->where( [ ['blood_type','A+'], ['office',Auth::user()->office], ])->count();
			$a3 = Master::with('user')->where( [ ['blood_type','A-'], ['office',Auth::user()->office], ])->count();
			$b1 = Master::with('user')->where( [ ['blood_type','B'], ['office',Auth::user()->office], ])->count();
			$b2 = Master::with('user')->where( [ ['blood_type','B+'], ['office',Auth::user()->office], ])->count();
			$b3 = Master::with('user')->where( [ ['blood_type','B-'], ['office',Auth::user()->office], ])->count();
			$o1 = Master::with('user')->where( [ ['blood_type','O'], ['office',Auth::user()->office], ])->count();
			$o2 = Master::with('user')->where( [ ['blood_type','O+'], ['office',Auth::user()->office], ])->count();
			$o3 = Master::with('user')->where( [ ['blood_type','O-'], ['office',Auth::user()->office], ])->count();
			$ab1 = Master::with('user')->where( [ ['blood_type','AB'], ['office',Auth::user()->office], ])->count();
			$ab2 = Master::with('user')->where( [ ['blood_type','AB+'], ['office',Auth::user()->office], ])->count();
			$ab3 = Master::with('user')->where( [ ['blood_type','AB-'], ['office',Auth::user()->office], ])->count();

			$total = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office] ])->count();
			$vacant = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office], ['master_id',NULL] ])->count();
			$filled = \App\Plantilla::select('*')->where([ ['office',Auth::user()->office], ['master_id',NULL] ])->count();

			$vacant == 0 ? $total_vacant = 0 : $total_vacant = round( ($vacant / $total) * 100);
			$filled == 0 ? $total_filled = 0 : $total_filled = round( ($filled / $total) * 100);

			$vacant_cs = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','COORDINATING_STAFF'],['staff_action',NULL]])->count();
			$vacant_uc = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','UNIFIED_COMMAND'],['master_id',NULL]])->count();
			$vacant_afp = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','AFPWSSUS'],['master_id',NULL]])->count();
			$vacant_ps = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','PERSONAL_STAFF'],['master_id',NULL]])->count();
			$vacant_ss = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','SPECIAL STAFF'],['master_id',NULL]])->count();

			$plantilla_jsw_1st = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','COORDINATING_STAFF'],['level_class','1ST'],['staff_action',NULL]])->count();
			$plantilla_jsw_2nd = \App\Plantilla::select('*')
					->where( [ ['office',Auth::user()->office],['office_group','COORDINATING_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['office',Auth::user()->office],['office_group','COORDINATING_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->count();

			$plantilla_uc_1st = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','UNIFIED_COMMAND'],['level_class','1ST'],['master_id',NULL]])->count();
			$plantilla_uc_2nd = \App\Plantilla::select('*')
					->where( [ ['office',Auth::user()->office],['office_group','UNIFIED_COMMAND'],['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['office',Auth::user()->office],['office_group','UNIFIED_COMMAND'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->count();

			$plantilla_afpsus_1st = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','AFPWSSUS'],['level_class','1ST'],['master_id',NULL]])->count();
			$plantilla_afpsus_2nd = \App\Plantilla::select('*')
					->where( [ ['office',Auth::user()->office],['office_group','AFPWSSUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['office',Auth::user()->office],['office_group','AFPWSSUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->count();

			$plantilla_pers_1st = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','PERSONAL_STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
			$plantilla_pers_2nd = \App\Plantilla::select('*')
					->where( [ ['office',Auth::user()->office],['office_group','PERSONAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['office',Auth::user()->office],['office_group','PERSONAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->count();

			$plantilla_special_1st = \App\Plantilla::select('*')->where( [ ['office',Auth::user()->office],['office_group','SPECIAL STAFF'],['level_class','1ST'],['master_id',NULL]])->count();
			$plantilla_special_2nd = \App\Plantilla::select('*')
					->where( [ ['office',Auth::user()->office],['office_group','SPECIAL_STAFF'],['level_class','2ND_TECH'],['master_id',NULL] ])
					->orWhere( [ ['office',Auth::user()->office],['office_group','SPECIAL_STAFF'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
					->count();
		}else{
			$a1 = Master::with('user')->where( [ ['blood_type','A'] ])->count();
			$a2 = Master::with('user')->where( [ ['blood_type','A+']])->count();
			$a3 = Master::with('user')->where( [ ['blood_type','A-']])->count();
			$b1 = Master::with('user')->where( [ ['blood_type','B']])->count();
			$b2 = Master::with('user')->where( [ ['blood_type','B+']])->count();
			$b3 = Master::with('user')->where( [ ['blood_type','B-']])->count();
			$o1 = Master::with('user')->where( [ ['blood_type','O']])->count();
			$o2 = Master::with('user')->where( [ ['blood_type','O+']])->count();
			$o3 = Master::with('user')->where( [ ['blood_type','O-']])->count();
			$ab1 = Master::with('user')->where( [ ['blood_type','AB']])->count();
			$ab2 = Master::with('user')->where( [ ['blood_type','AB+']])->count();
			$ab3 = Master::with('user')->where( [ ['blood_type','AB-']])->count();

			$count_chr = Master::with('user')->where('employ_stat','PERMANENT')->count();
			$count_job_order = Master::with('user')->where('employ_stat','JOB ORDER')->count();
			$count_temporary = Master::with('user')->where('employ_stat','TEMPORARY')->count();
			$count_casual = Master::with('user')->where('employ_stat','CASUAL')->count();$count_female = Master::with('user')->where('gender','FEMALE')->count();
			$count_male = Master::with('user')->where('gender','MALE')->count();

			$total = \App\Plantilla::select('*')->count();
			$vacant = \App\Plantilla::select('*')->where( 'master_id',NULL)->count();
			$filled = \App\Plantilla::select('*')->where('master_id','!=',NULL)->count();

			$vacant == 0 ? $total_vacant = 0 : $total_vacant = round( ($vacant / $total) * 100);
			$filled == 0 ? $total_filled = 0 : $total_filled = round( ($filled / $total) * 100);

			$vacant_cs = \App\Plantilla::select('*')->where( [ ['office_group','COORDINATING_STAFF'],['staff_action',NULL]])->count();
			$vacant_uc = \App\Plantilla::select('*')->where( [ ['office_group','UNIFIED_COMMAND'],['master_id',NULL]])->count();
			$vacant_afp = \App\Plantilla::select('*')->where( [ ['office_group','AFPWSSUS'],['master_id',NULL]])->count();
			$vacant_ps = \App\Plantilla::select('*')->where( [ ['office_group','PERSONAL_STAFF'],['master_id',NULL]])->count();
			$vacant_ss = \App\Plantilla::select('*')->where( [ ['office_group','SPECIAL STAFF'],['master_id',NULL]])->count();

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
		}

		// $piechart_age = LarapexChart::piechart()
		// 			->setTitle('AGE BRACKET')
		// 			->setSubtitle("CIVHR")
		// 			->addData([sizeof($first),sizeof($second),sizeof($third),sizeof($fourt)])
		// 			->setColors(['#0057ff','#feb019','#80effe','#2ccdc9'])
		// 			->setLabels(["Age 50-65 (".sizeof($first).")", "Age 40-49 (".sizeof($second).")", "Age 30-39 (".sizeof($third).")", "Age 18-29 (".sizeof($fourt).")"]);
        
        // $barchart_bt = LarapexChart::barChart()
        //             ->setTitle('BLOOD TYPE')
        //             ->setSubtitle("CIVHR")
		// 			->setColors(['#feb019'])
        //             ->addData('BLOOD TYPE', [$a1, $a2, $a3, $b1, $b2, $b3, $o1, $o2, $o3, $ab1, $ab2, $ab3])
        //             ->setXAxis(['A', 'A+', 'A-', 'B', 'B+', 'B-','O', 'O+','O-','AB','AB+','AB-']);

		
		

		// $plantilla_kbus_1st = \App\Plantilla::select('*')->where( [ ['office_group','KBUS'],['level_class','1ST'],['master_id',NULL]])->count();
		// $plantilla_kbus_2nd = \App\Plantilla::select('*')
		// 		->where( [ ['office_group','KBUS'],['level_class','2ND_TECH'],['master_id',NULL] ])
		// 		->orWhere( [ ['office_group','KBUS'],['level_class','2ND_SUPERVISORY'],['master_id',NULL]])
		// 		->count();

		return view('content.dashboard',compact('masters','first','second','third','fourt','counts','count_chr','count_casual','count_job_order','count_temporary','count_female','count_male','total_vacant','total_filled','vacant_cs','vacant_uc','vacant_afp','vacant_ps','vacant_ss',
		'plantilla_jsw_1st', 'plantilla_pers_1st','plantilla_special_1st','plantilla_uc_1st','plantilla_afpsus_1st',
		'plantilla_jsw_2nd', 'plantilla_pers_2nd', 'plantilla_special_2nd','plantilla_uc_2nd','plantilla_afpsus_2nd'
		));
		
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$position = \App\Position::select("*")->orderBy('title','asc')->get();
		if(\Auth::user()->acc_lvl != "Administrator"){
			$office = \App\Unit::select("*")->where([ ['unit',Auth::user()->office] ])->get();
			$autocomplete =\App\Plantilla::select("plantilla_number",'sg','id')
						->where([['master_id',null],['deleted_at',null]])
						->orWhere([['master_id',''],['deleted_at',null]])
						->get();
		}else{
			$office = \App\Unit::select("*")->get();
			$autocomplete =\App\Plantilla::select("plantilla_number",'sg','id')
						->where([['master_id',null],['deleted_at',null]])
						->orWhere([['master_id',''],['deleted_at',null]])
						->get();
		}
        return view('content.add_records',compact('autocomplete','office','position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		// return dump(date('Y-m-d H:i:s'));
        $i = Master::with('user')->count();
		$main_id = date("mdYhis")."".($i+1);
		
         // validation rules
        $rules = [
			'main_id' => 'unique:masters',
            'last_name' => 'required',
			'first_name' => 'required',
			'email' => 'unique:users',
			'dob' => 'required',
			'dob' => 'required',
			'select_file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
		$request->validate($rules);

		$livesearch = $request->livesearch;
		// if($livesearch != "" ){
		// 	$plantilla =  \App\Plantilla::where('id',$livesearch)->first();
		// }
		$dob  = $request->dob; 
		$dob1  = $request->dob; 
		$hired  = $request->date_hired; 
		$exp = "";
		$exp1 = "";
		$office = "";
		$v_office = "";
		$d = "";
		
		$complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		if($livesearch != "" ){
			$plantillas =  \App\Plantilla::where('id',$livesearch)->first();
			$plantillas->master_id = $main_id;
			$plantillas->complete_name = $complete_name;
			$plantillas->staff_action = 'fill';
			$plantillas->save();
		}

		// if(\Auth::user()->acc_lvl != "Administrator"){
		// 	$v_office = \Auth::user()->office;	
		// }else{
		// 	$v_office = $request->office;
		// }
		
		if($dob == null){
			$dob == $dob;
		}elseif ($dob != null){
			$dob = \Carbon\Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d');
			//$dob = date("Y-m-d",strtotime($data['birthdate']));
			$date = new \DateTime($dob);
			$exp = $date->modify('+65 years')->format('Y-m-d');
		}
		
		if($dob1 == null){
			$dob1 == $dob1;
		}elseif ($dob1 != null){
			//$dob1 = date("Y-m-d",strtotime($data['birthdate']));
			$dob1 = \Carbon\Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d');
			$date1 = new \DateTime($dob1);
			$exp1 = $date1->modify('+60 years')->format('Y-m-d');
		}

		if($hired == null){
			$hired == $hired;
		}elseif ($dob != null){
			$hired =\Carbon\Carbon::createFromFormat('m/d/Y', $hired)->format('Y-m-d');
			$b = date("Y-m-d");
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}
		
		$masters = new Master;
		$masters->main_id = $main_id;
		$masters->user_id = Auth::id();
		$masters->employee_number = strtoupper($request->employee_number);
		$masters->employ_stat = strtoupper($request->employ_stat);
		if($livesearch != "" ){
			$plantilla =  \App\Plantilla::where('id',$livesearch)->first();
			$office = $plantilla->office;
			$masters->item_number = $plantilla->plantilla_number;
			$masters->position = $plantilla->title;
			$masters->salary_grade = $plantilla->sg;
			$masters->office = $plantilla->office;
			$masters->level_class = strtoupper($plantilla->level_class);
			$masters->office_group = strtoupper($plantilla->office_group);
		}else{
			$masters->item_number = NULL;
			$masters->position = strtoupper($request->position);
			$masters->salary_grade = NULL;
			$masters->office = $request->office;
			$masters->level_class = NULL;
			$masters->office_group = NULL;
		}
		$masters->date_hired = date("Y-m-d", strtotime($hired));
		$masters->retirement_date = date("Y-m-d", strtotime($exp));
		$masters->optional_retire = date("Y-m-d", strtotime($exp1));
		$masters->year_service = $d;
		// $masters->office = strtoupper($v_office);
		$masters->last_name = strtoupper($request->last_name);
		$masters->first_name = strtoupper($request->first_name);
		$masters->middle_name =strtoupper($request->middle_name);
		$masters->extension_name = strtoupper($request->extension_name);
		$masters->complete_name =$complete_name;
		$masters->gender = strtoupper($request->gender);
		$masters->dob = date("Y-m-d", strtotime($request->dob));
		$masters->pob = strtoupper($request->pob);
		$masters->civil_status = strtoupper($request->civil_status);
		$masters->citizenship = strtoupper($request->citizenship);
		$masters->birth_naturalize = strtoupper($request->birth_naturalize);
		$masters->dual_citizen = strtoupper($request->dual_citizen);
		$masters->religion = strtoupper($request->religion);
		$masters->height = strtoupper($request->height);
		$masters->weight = strtoupper($request->weight);
		$masters->blood_type = strtoupper($request->blood_type);
		$masters->telephone_no = $request->telephone_no;
		$masters->cellphone_no = $request->cellphone_no;
		$masters->email = $request->email_address;
		#$masters->employee_status = 'ACTIVE';
		$masters->created_at = date('Y-m-d H:i:s');
		$masters->save();
		
		$tin = $request->tin_number;
		$tin2 = wordwrap($tin, 3, "-", true);
		$identification = new \App\Identification;
		$identification->master_id = $main_id;
		$identification->gsis_number = $request->gsis_number;
		$identification->sss_number = $request->sss_number;
		$identification->philhealth_number = $request->philhealth_number;
		$identification->pagibig_number = $request->pagibig_number;
		$identification->bp_number = $request->bp_number;
		$identification->tin_number = $tin2;
		$identification->save();
		
		$address = new \App\Address(['master_id' => $main_id]);
		$address->save();
		
		$answer = new \App\Answer(['master_id' => $main_id]);
		$answer->save();
		
		$spouse = new \App\Spouse(['master_id' => $main_id]);
		$spouse->save();
		
		$mother = new \App\Mother(['master_id' => $main_id]);
		$mother->save();
		
		$father = new \App\Father(['master_id' => $main_id]);
		$father->save();
		
		$elementary = new \App\Elementary(['master_id' => $main_id]);
		$elementary->save();
		
		$schooling = new \App\Schooling(['master_id' => $main_id]);
		$schooling->save();
		
		$accomplishment = new \App\Accomplishment(['master_id' => $main_id]);
		$accomplishment->save();
		
		
		$high = new \App\High(['master_id' => $main_id]);
		$high->save();
		
	
		
		$photo = new \App\Photo;
		$photo->master_id = $main_id;
		/*if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename = rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$photo->filename"));
            $photo->image = $filename;
        }else{
			$photo->image = "profile.jpg";
		}*/
		
		if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename =  Auth::id()."".rand() . '.' . $ext;
			
			$resize_image = Image::make($image->getRealPath());
			$destinationPath = public_path('uploads/profile');
			
			$resize_image->resize(413, 531, function($constraint){
			$constraint->aspectRatio();
			})->save($destinationPath . '/' . $filename);

            // upload the image
            //$image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$masters->filename"));
            $photo->image = $filename;
        }else{
			$photo->image = "profile.jpg";
		}
		$photo->save();
		

		$user = new \App\User;
		$user->first_name = strtoupper($request->first_name);
		$user->last_name = strtoupper($request->last_name);
		$user->middle_name = strtoupper($request->middle_name);
		$user->extension_name = strtoupper($request->extension_name);
		$user->complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($request->extension_name);
		$user->acc_lvl = 'User';
		$user->office = strtoupper($office);
		$user->position = strtoupper($request->position);
		$user->branch = '';
		$user->email = $request->email_address;
		$user->password =  Hash::make('$P@ssword2020');
		
		if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename = rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$masters->filename"));
            $user->picture = $filename;
        }else{
			$user->picture = 'profile.jpg';
		}

		$user->save();
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP, 'action' => "Add New $complete_name Records"]);
		$ledger->save();
		
		return back()->with('success', 'Records Successfully Added!');
	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$training_cport = \App\Training::where([ ['master_id',$id],['training_program','CPORT'], ])->count();
		$training_cpbc = \App\Training::where([ ['master_id',$id],['training_program','CPBC'], ])->count();
		$training_cpbsc = \App\Training::where([ ['master_id',$id],['training_program','CPBSC'], ])->count();
		$training_cpasc = \App\Training::where([ ['master_id',$id],['training_program','CPASC'], ])->count();
		$count_training = \App\Schooling::where('master_id',$id)->first();
		if($count_training){
			if($training_cport <= 0){
				$count_training->cport = "";
				$count_training->cport_date = "";
			}
			
			if($training_cpbc <= 0){
				$count_training->cpbc = "";
				$count_training->cpbc_date = "";
			}
			
			if($training_cpbsc <= 0){
				$count_training->cpbsc = "";
				$count_training->cpbsc_date = "";
			}
			
			if($training_cpasc <= 0){
				$count_training->cpasc = "";
				$count_training->cpasc_date = "";
			}
			$count_training->save();
		}else{
			$ctraining = new \App\Schooling(['master_id' =>$id]);
			$ctraining->cport = "";
			$ctraining->cport_date = "";
			$ctraining->cpbc = "";
			$ctraining->cpbc_date = "";
			$ctraining->cpbsc = "";
			$ctraining->cpbsc_date = "";
			$ctraining->cpasc = "";
			$ctraining->cpasc_date = "";
			$ctraining->save();
		}
		
        $user_id = Master::where('main_id',$id)->first();
		
	
		/*
		$num_hours = array();
		$accomplishment = \App\Accomplishment::select('*')->where('master_id',$id)->first();
		$accomplishment_t = \App\Training::select('*')->where('master_id',$id)->get();
		$accomplishment_t2 = \App\Training::select('*')->where('master_id',$id)->first();
		foreach($accomplishment_t as $cost){
			array_push($num_hours,$cost->number_hours);
		}
		$total_hours = array_sum($num_hours);
		$year_t =date('Y', strtotime($accomplishment_t2->inclusive_from));
		if($accomplishment->year_training == null || $accomplishment->year_training == ""){
			$accomplishment->year_training = $year_t;
			$accomplishment->number_hours = $total_hours;
		}elseif($accomplishment->year_training == $year_t){
			$accomplishment->number_hours += $request->hour_numbers;
		}elseif($accomplishment->year_training != $year){
			$new_accomplishment = new \App\Accomplishment;
			$new_accomplishment->master_id = $accomplishment->master_id;
			$new_accomplishment->year_training = $year;
			$new_accomplishment->number_hours = $request->hour_numbers;
			$new_accomplishment->save();
		}else{
			$accomplishment->year_training = "";
			$accomplishment->number_hours = "";
		}
		$accomplishment->save();
		*/
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$masters = Master::where('main_id',$id)->first();
		
		$citizenship = "";
		$naturalize = "";
		
		if($masters->citizenship == "FP"){
			$citizenship = "Filipino";
		}elseif($masters->citizenship == "DC"){
			$citizenship = "Dual Citizenship";
		}else{
			$citizenship = "";
		}
		
		if($masters->birth_naturalize == "BB"){
			$naturalize = "By birth";
		}elseif($masters->birth_naturalize == "BN"){
			$naturalize = "By Naturalize";
		}else{
			$naturalize = "";
		}
		
		$date_h = $masters->date_hired;
		
		$first_long_pay = "";
		$second_long_pay = "";
		$third_long_pay = "";
		$forth_long_pay = "";
		$fifth_long_pay = "";
		
		$dateOfBirth = $masters->dob;
		$today = date("Y-m-d");
		$diff = date_diff(date_create($dateOfBirth), date_create($today));
		$age = $diff->format('%y');
		
		if($date_h == null || $date_h == ""){
			$date_h == $date_h;
		}elseif ($date_h != null || $date_h != ""){
			//$dob1 = date("Y-m-d",strtotime($data['birthdate']));
			//$date_h1 = \Carbon\Carbon::createFromFormat('m/d/Y', $date_h)->format('Y-m-d');
			$date1 = new \DateTime($date_h);
			$date2 = new \DateTime($date_h);
			$date3 = new \DateTime($date_h);
			$date4 = new \DateTime($date_h);
			$date5 = new \DateTime($date_h);
			$first_long_pay = $date1->modify('+5 years')->format('m/d/Y');
			$second_long_pay = $date2->modify('+10 years')->format('m/d/Y');
			$third_long_pay = $date3->modify('+15 years')->format('m/d/Y');
			$forth_long_pay = $date4->modify('+20 years')->format('m/d/Y');
			$fifth_long_pay = $date5->modify('+25 years')->format('m/d/Y');
		}
		
		
		$address =  \App\Address::with('master')->where('master_id',$id)->first();
		$identification =  \App\Identification::with('master')->where('master_id',$id)->first();
		$photo =  \App\Photo::with('master')->where('master_id',$id)->first();
		$education_elem = \App\Elementary::with('master')->where('master_id', $id)->orderBy('period_from','desc')->first();
		$education_high = \App\High::with('master')->where('master_id', $id)->orderBy('high_period_from','desc')->first();
		$family = DB::table('masters')
				->where('masters.main_id',$id)
				->join('spouses', 'masters.main_id', '=', 'spouses.master_id')
				->join('fathers', 'masters.main_id', '=', 'fathers.master_id')
				->join('mothers', 'masters.main_id', '=', 'mothers.master_id')
				->get();
		$child = \App\Child::with('master')->where('master_id', $id)->orderBy('dob','desc')->get();
		$vocational =  \App\Vocational::with('master')->where('master_id',$id)->orderBy('period_from','desc')->get();
		$college =  \App\College::with('master')->where('master_id',$id)->orderBy('period_from','desc')->get();
		$graduate =  \App\Graduate::with('master')->where('master_id',$id)->orderBy('period_from','desc')->get();
		$eligibility =  \App\Eligibility::with('master')->where('master_id',$id)->orderBy('date_examination','desc')->get();
		$workexpe =  \App\Work::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		$history =  \App\Work::with('master')->where([ ['master_id',$id],['gov_service','Y']])->orderBy('inclusive_from','desc')->get();
		$voluntary =  \App\Voluntary::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		$training =  \App\Training::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		$other =  \App\Other::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();
		$answer =  \App\Answer::with('master')->where('master_id',$id)->first();
		$reference =  \App\Credential::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();
		$rating =  \App\Rating::with('master')->where('master_id',$id)->orderBy('s_assessment','desc')->get();
		$performance =  \App\Performance::with('master')->where([ ['master_id',$id],['supervisor','!=',NULL]])->orderBy('ipcr_prep_chr','desc')->get();
		$commendation =  \App\Commendation::with('master')->where('master_id',$id)->orderBy('commendation_date','desc')->get();
		$issue = \App\Issue::with('master')->where('master_id',$id)->get();
		return view('content.profile', compact('masters','age','identification','photo','address','education_elem','education_high','vocational','college','graduate','family','child','eligibility','workexpe',
											   'voluntary','training','other','reference','answer','rating','commendation','issue','citizenship','naturalize','first_long_pay','second_long_pay','third_long_pay',
											   'forth_long_pay', 'fifth_long_pay','performance','history'
											  ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		$position = \App\Position::select("*")->orderBy('title','asc')->get();
		$office = \App\Unit::select("*")->get();
		//$nationality = \App\Nationality::all();
		$master = Master::where('main_id',$id)->first();
		$citizenship = "";
		$v_citizenship = "";
		
		if($master->citizenship == "FP"){
			$citizenship = "Filipino";
			$v_citizenship = "FP";
		}elseif($master->citizenship == "DC"){
			$citizenship = "Dual Citizenship";
			$v_citizenship = "DC";
		}else{
			$citizenship = "";
			$v_citizenship = "";
		}

		$autocomplete =\App\Plantilla::select("plantilla_number",'sg','id')
					->where([['master_id',null],['deleted_at',null]])
					->orWhere([['master_id',''],['deleted_at',null]])
                    ->get();

		$autocomplete2 =\App\Plantilla::select("plantilla_number",'sg','id','master_id')
                    ->where([['master_id','=',$id],['deleted_at',null]])
                    ->first();
					
		$identification =  \App\Identification::with('master')->where('master_id',$id)->latest()->first();
		return view('content.personal_records', compact('master','identification','citizenship','v_citizenship','autocomplete','autocomplete2','office','position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation rules
        $rules = [
            'last_name' => 'required',
			'first_name' => 'required',
        ];

        /* Custom validation error messages
        $messages = [
            'title.unique' => 'Todo Title should be unique'
        ];
		*/
		
        $request->validate($rules);

		$livesearch = $request->livesearch;
		// if($livesearch != "" ){
		// 	$plantilla =  \App\Plantilla::where('id',$livesearch)->first();
		// }
		$dob  = $request->dob; 
		$dob1  = $request->dob; 
		$exp = "";
		$exp1 = "";
		$v_office = "";
		$e_name = $request->extension_name;
		$hired  = $request->date_hired; 
		$d = "";

		$complete_name = strtoupper($request->first_name)." ".strtoupper($request->middle_name) ." ". strtoupper($request->last_name)." ". strtoupper($e_name);
		$emp_stat = "";
		$masters = Master::where('main_id',$id)->first();

		if($livesearch != "" && $request->employ_stat == 'Permanent'){
			$emp_stat = "PERMANENT";
			$plantillas =  \App\Plantilla::where('id',$livesearch)->first();
			$plantillas->master_id = $masters->main_id;
			$plantillas->complete_name = $complete_name;
			$plantillas->staff_action = 'fill';
			$plantillas->save();

			$masters->employ_stat = "PERMANENT";
			$masters->item_number = $plantillas->plantilla_number;
			$masters->position = $plantillas->title;
			$masters->salary_grade = $plantillas->sg;
			$masters->office = $plantillas->office;
			$masters->level_class = strtoupper($plantillas->level_class);
			$masters->office_group = strtoupper($plantillas->office_group);
	
		}
		//else{
		//	$emp_stat = strtoupper($request->employ_stat);
		//	$masters->item_number = NULL;
		//	$masters->position = NULL;
		//	$masters->employ_stat = strtoupper($request->employ_stat);
		//	$masters->office = $request->office;
		//	$masters->salary_grade = NULL;
		//	$masters->office = $request->office;
		//	$masters->level_class = NULL;
		//	$masters->office_group = NULL;

		//	$plantilla =  \App\Plantilla::where('master_id',$masters->main_id)->first();
		//	if($plantilla){
		//		$plantilla->master_id = NULL;
		//		$plantilla->complete_name =  NULL;
		//		$plantilla->staff_action = NULL;
		//		$plantilla->save();
		//	}
		//}

		if( $request->employ_stat != "PERMANENT"){
			$masters->item_number = NULL;
			$masters->position = NULL;
			$masters->employ_stat = strtoupper($request->employ_stat);
			$masters->office = $request->office;
			$masters->salary_grade = NULL;
			$masters->office = $request->office;
			$masters->level_class = NULL;
			$masters->office_group = NULL;

			$plantilla =  \App\Plantilla::where('master_id',$masters->main_id)->first();
			if($plantilla){
				$plantilla->master_id = NULL;
				$plantilla->complete_name =  NULL;
				$plantilla->staff_action = NULL;
				$plantilla->save();
			}
		}

		if($e_name == "N/A"){
			$e_name = "";
		}else{
			$e_name = $request->extension_name;
		}
		if(\Auth::user()->acc_lvl != "Administrator"){
			$v_office = \Auth::user()->office;	
		}else{
			$v_office = $request->office;
		}
		
		if($dob == null){
			$dob == NULL;
		}elseif ($dob != null){
			$dob = \Carbon\Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d');
			//$dob = date("Y-m-d",strtotime($data['birthdate']));
			$date = new \DateTime($dob);
			$exp = $date->modify('+65 years')->format('Y-m-d');
		}
		
		if($dob1 == null){
			$dob1 == $dob1;
		}elseif ($dob1 != null){
			//$dob1 = date("Y-m-d",strtotime($data['birthdate']));
			$dob1 = \Carbon\Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d');
			$date1 = new \DateTime($dob1);
			$exp1 = $date1->modify('+60 years')->format('m/d/Y');
		}

		if($hired == null){
			$hired == $hired;
		}elseif ($dob != null){
			$hired =\Carbon\Carbon::createFromFormat('m/d/Y', $hired)->format('Y-m-d');
			$b = date("Y-m-d");
			$c = date_diff(date_create($hired), date_create($b));
			$d = $c->format('%y');
		}

		$masters->employee_number = strtoupper($request->employee_number);
	

		// if($livesearch != "" && $request->employ_stat != "PERMANENT"){
		// 	$plantilla =  \App\Plantilla::where('id',$livesearch)->first();
		// 	$masters->item_number = NULL;
		// 	$masters->position = NULL;
		// 	$masters->salary_grade = NULL;
		// 	$masters->office = $request->office;
		// 	$masters->level_class = NULL;
		// 	$masters->office_group = NULL;
		// 	$plantilla->master_id =  NULL;
		// 	$plantilla->complete_name =  NULL;
		// 	$plantillas->staff_action = NULL;
		// 	$plantilla->save();
		// }

		$masters->date_hired 	= date("Y-m-d", strtotime($request->date_hired));
		$masters->retirement_date = date("Y-m-d", strtotime($exp));
		$masters->optional_retire = date("Y-m-d", strtotime($exp1));
		$masters->year_service = $d;
		$masters->last_name = strtoupper($request->last_name);
		$masters->first_name = strtoupper($request->first_name);
		$masters->middle_name =strtoupper($request->middle_name);
		$masters->extension_name = strtoupper($request->extension_name);
		$masters->complete_name = $complete_name;
		$masters->gender = strtoupper($request->gender);
		$masters->dob = $dob;
		$masters->pob = strtoupper($request->pob);
		$masters->civil_status = strtoupper($request->civil_status);
		$masters->citizenship = strtoupper($request->citizenship);
		$masters->birth_naturalize = strtoupper($request->birth_naturalize);
		$masters->dual_citizen = strtoupper($request->dual_citizen);
		$masters->religion = strtoupper($request->religion);
		$masters->height = strtoupper($request->height);
		$masters->weight = strtoupper($request->weight);
		$masters->blood_type = strtoupper($request->blood_type);
		$masters->telephone_no = $request->telephone_no;
		$masters->cellphone_no = $request->cellphone_no;
		$masters->email = $request->email_address;
		#$masters->employee_status = 'ACTIVE';
		$masters->save();
		
		$identification = \App\Identification::where('master_id',$id)->first();
		$identification->gsis_number = $request->gsis_number;
		$identification->sss_number = $request->sss_number;
		$identification->philhealth_number = $request->philhealth_number;
		$identification->pagibig_number = $request->pagibig_number;
		$identification->bp_number = $request->bp_number;
		$identification->tin_number = $request->tin_number;
		$identification->save();
		
		$accomplishment = \App\Accomplishment::where('master_id',$id)->first();
		$accomplishment->salary_grade = strtoupper($request->salary_grade);
		$accomplishment->save();
		
		$photo = \App\Photo::where('master_id',$id)->first();
		
		if ($request->hasFile('select_file')) {
            // get image file
            $image = $request->select_file;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename =  Auth::id()."".rand() . '.' . $ext;
			
			$resize_image = Image::make($image->getRealPath());
			$destinationPath = public_path('uploads/profile');
			
			$resize_image->resize(413, 531, function($constraint){
			$constraint->aspectRatio();
			})->save($destinationPath . '/' . $filename);

            // upload the image
            //$image->move(public_path('uploads/profile'), $filename);
            // delete the previous image
            Storage::delete(public_path("uploads/profile/$masters->filename"));
            $photo->image = $filename;
        }else{
			$photo->image = $photo->image;
		}
		$photo->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "$complete_name Records Updated"]);
		$ledger->save();
		
		//return back()->with('success', 'Records Successfully Added!');
		return redirect()->route('masters.show', $id)->with('success', 'Records Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user_id = Master::where('masters.id', $id)
		// 				->join('users', 'masters.user_id', '=', 'users.id')
		// 				->first();
		$user_id = Master::where('id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = Master::where('id',$id)->first();
		$check_plantilla = \App\Plantilla::where('master_id',$master->main_id)->first();
		if(!empty($check_plantilla)){
			$plantilla = \App\Plantilla::where('master_id',$master->main_id)->first();
			$plantilla->master_id = NULL;
			$plantilla->complete_name = NULL;
			$plantilla->staff_action = NULL;
			$plantilla->sourcing_method = NULL;
			$plantilla->save();
		}

		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(),'ip_address' => $clientIP,'action' => "Delete $master->complete_name Records"]);
		$ledger->save();
		
		$master->delete();
		
		//return redirect()->route('view_ctg_records')->with('success',"Successfully Deleted");
		return back()->with('success', 'Successfully Deleted!');
    }
	
	public function update_date_hired(){
		$master = Master::select('date_hired','year_service','id')->get();
		$work = \App\Work::select('inclusive_from','year_exp','id')
					->where('inclusive_to',NULL)
					->orWhere('inclusive_to','=','')
					->get();
		
		$b = date("Y-m-d");
		foreach($master as $master){
			$c = date_diff(date_create($master->date_hired), date_create($b));
			$d = $c->format('%y');
			DB::table('masters')->where('id',$master->id)->update(['year_service' => $d]);
		}

		foreach($work as $work){
			$c = date_diff(date_create($work->inclusive_from), date_create($b));
			$d = $c->format('%y');
			DB::table('works')->where('id',$work->id)->update(['year_exp' => $d]);
		}
		
		return back()->with('success', 'Record Successfully Updated!');
	}
}
