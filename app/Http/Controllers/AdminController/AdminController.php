<?php

namespace App\Http\Controllers\AdminController;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function view_threat_records()
    {
		Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
		$threats = \App\Threat::latest()->paginate(5);
        return view('admin.threat_records', compact('threats'));
    }
	
	public function view_deleted_records()
    {
		Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
		$records = \App\Master::onlyTrashed()->latest()->paginate(10,['*'], 'records');
		$counts =  \App\Master::onlyTrashed()->latest()->count();
        return view('admin.deleted_records', compact('records','counts'));
    }
	
	public function view_logs()
    {
		Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
		$ledgers = \App\Ledger::latest('ledgers.created_at')
							->join('users', 'ledgers.user_id', '=', 'users.id')
							->paginate(10);
		$count_logs = \App\Ledger::all()->count();
        return view('admin.view_logs', compact('ledgers','count_logs'));
    }
	
	public function delete_logs()
    {
		Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
		$ledgers = DB::table('ledgers')->delete();

		return redirect()->route('view_logs')->with('success', 'Records Successfully Deleted!');
    }
	
	public function restore_delete_record($id){
		$this->authorize('viewAny', User::class);
		$masters = \App\Master::where('id',$id);
		$masters->restore();
        return back()->with('success', 'Successfully Restore!');
	}
	
	public function permanent_delete_record($id){
		$this->authorize('viewAny', User::class);
		$masters = \App\Master::where('id',$id);
		$masters->forceDelete();
        return back()->with('success', 'Successfully Deleted!');
	}
	
	public function add_ctg_csv(){
		$this->authorize('viewAny', User::class);
        return view('admin.add_ctg_csv');
	}
	
	public function save_ctg_csv(Request $request){
		
		$rules = [
            'select_file' => 'required|mimes:csv,txt'
        ];
		
        $request->validate($rules);
		
        $upload=$request->file('select_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
		$sample = "";
		$val = [];
		$validate=[];
		/*foreach($master as $master){
			$val[] = $master->imei ;	
		}*/
		while($columns=fgetcsv($file))
        {
			if($columns[0]=="")
            {
                continue;
            }
			
				$data = array_combine($header, $columns);

				$dob  = $data['Date_of_Birth']; 
				$dob1  = $data['Date_of_Birth']; 
				$hired  = $data['Date_of_Orig']; 
				$exp = "";
				$exp1 = "";
				$v_office = "";
				$d = "";
				
				// if(\Auth::user()->acc_lvl != "Administrator"){
				// 	$v_office = \Auth::user()->office;	
				// }else{
				// 	$v_office = $request->office;
				// }
				
				if($dob == null){
					$dob == $dob;
				}elseif ($dob != null){
					$dob = date("Y-m-d", strtotime($dob)); 
					//$dob = date("Y-m-d",strtotime($data['birthdate']));
					$date = new \DateTime($dob);
					$exp = $date->modify('+65 years')->format('Y-m-d');
				}
				
				if($dob1 == null){
					$dob1 == $dob1;
				}elseif ($dob1 != null){
					//$dob1 = date("Y-m-d",strtotime($data['birthdate']));
					$dob1 = date("Y-m-d", strtotime($dob)); 
					$date1 = new \DateTime($dob1);
					$exp1 = $date1->modify('+60 years')->format('Y-m-d');
				}

				if($hired == null){
					$hired == $hired;
				}elseif ($dob != null){
					// $hired =\Carbon\Carbon::createFromFormat('d-M-y', $hired)->format('Y-m-d');
					$hired =date("Y-m-d", strtotime($hired)); 
					$b = date("Y-m-d");
					$c = date_diff(date_create($hired), date_create($b));
					$d = $c->format('%y');
				}

				$level_class = strtoupper($data['level_class']);
				$i = \App\Master::with('user')->count();
				$main_id = date("mdYhis")."".($i+1);
				$last_name=strtoupper($data['Last_Name']);
				$first_name=strtoupper($data['First_Name']);
				$middle_name=strtoupper($data['Middle_Name']);
				$extension_name=strtoupper($data['Suffix']);
				$complete_name=strtoupper($data['First_Name'])." ".strtoupper($data['Middle_Name']) ." ". strtoupper($data['Last_Name'])." ". strtoupper($data['Suffix']);
				$item_number=$data['Item_Number'];
				$position=$data['Position_Title'];
				$gender = $data['Gender'];
				if($gender == "F")
					$gender = "FEMALE";
				else{
					$gender = "MALE";
				}
				if($data['Last_Name'] != "" or $data['Last_Name'] != NULL){
					$save_master= \App\Master::firstOrNew(['main_id'=>$main_id]);
					$save_master->main_id = $main_id;
					$save_master->user_id = \Auth::id();
					$save_master->last_name=$last_name;
					$save_master->year_service = $d;
					$save_master->first_name=$first_name;
					$save_master->middle_name=$middle_name;
					$save_master->extension_name=$extension_name;
					$save_master->complete_name=$complete_name;
					$save_master->item_number=$item_number;
					$save_master->position=$position;
					$save_master->office=$data['office'];
					$save_master->gender=$gender;
					$save_master->office_group = "COORDINATING_STAFF";
					$save_master->level_class = $level_class;
					$save_master->date_hired=date("Y-m-d", strtotime($hired));
					$save_master->retirement_date = date("Y-m-d", strtotime($exp));
					$save_master->optional_retire = date("Y-m-d", strtotime($exp1));
					$save_master->dob = date("Y-m-d", strtotime($dob));
					$save_master->salary_grade=$data['SG'];
					$save_master->employ_stat='PERMANENT';
					$save_master->save();
				}
				
				$save_plantilla= new \App\Plantilla(['master_id'=>$main_id]);
				
				if($data['Last_Name'] != "" or $data['Last_Name'] != NULL){
					$save_plantilla->staff_action = "FILL";
					$save_plantilla->master_id = $main_id;
					$save_plantilla->complete_name=$complete_name;
					$save_plantilla->date_hired=date("Y-m-d", strtotime($hired));
				}else{
					$save_plantilla->staff_action = NULL;
					$save_plantilla->master_id = NULL;
					$save_plantilla->complete_name= NULL;
				}
				
				$save_plantilla->plantilla_number=$item_number;
				$save_plantilla->title=$position;
				$save_plantilla->parenthetical_title=$data['Parenthetical_Title'];;
				$save_plantilla->office_group = "COORDINATING_STAFF";
				$save_plantilla->sg=$data['SG'];
				$save_plantilla->office=$data['office'];
				$save_plantilla->level_class = $level_class;
				$save_plantilla->save();
				if($data['Last_Name'] != "" or $data['Last_Name'] != NULL){
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

					$identification = new \App\Identification(['master_id' => $main_id]);
					$identification->save();
					
					$photo = new \App\Photo;
					$photo->master_id = $main_id;
					$photo->image = "profile.jpg";
					$photo->save();
				}
		}
			if($sample ==null){
				return back()->with('success', 'Records Successfully Added!');
			}else{
				return back()->with('invalid', $sample);
			}
		
	}
	
	public function add_ltg_csv(){
		$this->authorize('viewAny', User::class);
        return view('admin.add_ltg_csv');
	}
	
	public function save_ltg_csv(Request $request){
		
		$rules = [
            'select_file' => 'required|mimes:csv,txt'
        ];
		
        $request->validate($rules);
		
        $upload=$request->file('select_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
		$sample = "";
		$val = [];
		$validate=[];
		/*foreach($master as $master){
			$val[] = $master->imei ;	
		}*/
		while($columns=fgetcsv($file))
        {
			if($columns[0]=="")
            {
                continue;
            }
			
			$data = array_combine($header, $columns);
			
				$i = \App\Master::with('user')->count();
				$main_id = date("mdYhis")."".($i+1);
				$last_name=strtoupper($data['last_name']);
				$first_name=strtoupper($data['first_name']);
				$middle_name=strtoupper($data['middle_name']);
				$extension_name=strtoupper($data['extension_name']);
				$complete_name=strtoupper($data['first_name'])." ".strtoupper($data['middle_name']) ." ". strtoupper($data['last_name'])." ". strtoupper($data['extension_name']);
				$threat= strtoupper($data['threat']);
				$alias = strtoupper($data['alias']);
				$position=$data['position'];
				$picture=$data['picture'];
				$save_master= \App\Master::firstOrNew(['main_id'=>$main_id]);
				$save_master->main_id = $main_id;
				$save_master->user_id = \Auth::id();
				$save_master->last_name=$last_name;
				$save_master->first_name=$first_name;
				$save_master->middle_name=$middle_name;
				$save_master->extension_name=$extension_name;
				$save_master->complete_name=$complete_name;
				$save_master->alias=$alias;
				$save_master->threat=$threat;
				$save_master->picture=$picture;
				$save_master->save();
				
				$address = new \App\Address(['master_id' => $main_id]);
				$address->save();
				
				$position = new \App\Position(['master_id' => $main_id, 'position' => $position]);
				$position->save();
				
				$account = new \App\Account(['master_id' => $main_id]);
				$account->save();
		}
		if($sample ==null){
			return back()->with('success', 'Records Successfully Added!');
		}else{
			return back()->with('invalid', $sample);
		}
	}

	public function search_deleted_chr(Request $request)
    {
		Paginator::useBootstrap();
		$this->authorize('viewAny', User::class);
		$search = $request->input('search');
		if(\Auth::user()->acc_lvl != "Administrator"){
			$masters = \App\Master::onlyTrashed()->latest('masters.created_at')
					->resultchr($search)
					->where('masters.office',  \Auth::user()->office)
					->paginate(10);
					
			$counts =  \App\Master::onlyTrashed()
					->resultchr($search)
					->where('masters.office',  \Auth::user()->office)
					->count();			
		}else{
			$records = \App\Master::onlyTrashed()->latest('masters.created_at')
					->resultchr($search)
					->paginate(10,['*'], 'records');
						
			$counts =  \App\Master::onlyTrashed()
						->resultchr($search)
						->count();		
		}
		
		// $records = \App\Master::onlyTrashed()->latest()->paginate(10,['*'], 'records');
        return view('admin.deleted_records', compact('records','counts'));
    }


	public function add_test(){
		$this->authorize('viewAny', User::class);
        return view('admin.admin_test');
	}
	
	public function save_test(Request $request){
		
		$rules = [
            'select_file' => 'required|mimes:csv,txt'
        ];
		
        $request->validate($rules);
		
        $upload=$request->file('select_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
		$sample = "";
		$val = [];
		$validate=[];
		/*foreach($master as $master){
			$val[] = $master->imei ;	
		}*/
		while($columns=fgetcsv($file))
        {
			if($columns[0]=="")
            {
                continue;
            }
			
				$data = array_combine($header, $columns);

				// if(\Auth::user()->acc_lvl != "Administrator"){
				// 	$v_office = \Auth::user()->office;	
				// }else{
				// 	$v_office = $request->office;
				// }

				$save_master= new \App\Candidate;
				$save_master->position=$data['position'];
				$save_master->sex=$data['sex'];
				$save_master->ballot_name=$data['ballot_name'];
				$save_master->name=$data['name'];
				$save_master->political_party=$data['political_party'];
				$save_master->place=$data['place'];
				$save_master->region=$data['region'];
				$save_master->save();
				
		}
			if($sample ==null){
				return back()->with('success', 'Records Successfully Added!');
			}else{
				return back()->with('invalid', $sample);
			}
		
	}

	public function logout () {
		//logout user
		auth()->logout();
		// redirect to homepage
		return redirect('/');
	}
	
}
