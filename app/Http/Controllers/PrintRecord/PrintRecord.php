<?php

namespace App\Http\Controllers\PrintRecord;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RatingResultOutstanding implements FromCollection, WithHeadings
{
	private $startDate;
	private $endDate;
	private $office;

    public function __construct($startDate,$endDate,$office) 
    {
        $this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->office = $office;
    }

    public function collection()
    {
        $get_outstanding_vsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$this->office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $this->startDate],['ratings.e_assessment', '<=', $this->endDate] ])
										->orWhere([ ['masters.office',$this->office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $this->startDate],['ratings.e_assessment', '<=', $this->endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();
        $result = array();
        foreach($get_outstanding_vsatisfactory as $record){
            $result[] = array(
               'complete_name' => $record->complete_name,
               'position' => $record->position,
               'salary_grade' => $record->salary_grade,
               'office' => $record->office,
               'rating' => $record->n_rating // Custom data
            );
         }
         return collect($result);
    }

    public function headings(): array
    {
        return [
            'Name', 'Position Title', 'SG', 'Office/Unit', 'Rating'
        ];
    }
}
class PrintRecord extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	
	public function print_pds_page1($id){
		$child_count = \App\Child::with('master')->where('master_id',$id)->count();
		$child = \App\Child::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get(); 
		$num_row = $child_count;
		
		if($num_row ==0){
			$num_row += 10;
		}elseif($num_row ==1){
			$num_row += 9;
		}elseif($num_row ==2){
			$num_row += 7;
		}elseif($num_row ==3){
			$num_row += 5;
		}elseif($num_row ==4){
			$num_row += 3;
		}elseif($num_row ==5){
			$num_row += 1;
		}elseif($num_row ==6){
			$num_row -= 1;
		}elseif($num_row ==7){
			$num_row -= 3;
		}elseif($num_row ==8){
			$num_row -= 5;
		}elseif($num_row ==9){
			$num_row -= 7;
		}elseif($num_row ==10){
			$num_row -= 9;
		}elseif($num_row ==11){
			$num_row -= 11;
		}elseif($num_row ==12){
			$num_row -= 13;
		}else{
			$num_row += 0;
		}
			
		$master = \App\Master::where('main_id',$id)->first();//Master Model
		$address =  \App\Address::with('master')->where('master_id',$id)->first();
		$idnumber =  \App\Identification::with('master')->where('master_id',$id)->first();
		$spouse = \App\Spouse::with('master')->where('master_id',$id)->first();//Spouse Model
		$father = \App\Father::with('master')->where('master_id',$id)->first();//Father Model
		$mother = \App\Mother::with('master')->where('master_id',$id)->first();//Mother Model
		$elementary = \App\Elementary::with('master')->where('master_id',$id)->first();//Elementary Model
		$high = \App\High::with('master')->where('master_id',$id)->first();//High Model
		
		$counts_vocational = \App\Vocational::with('master')->where('master_id',$id)->count();
		$vocational1 = \App\Vocational::with('master')->where('master_id',$id)->skip(0)->take(1)->orderBy('created_at','desc')->get(); 
		$vocational2 = \App\Vocational::with('master')->where('master_id',$id)->skip(1)->take($counts_vocational)->orderBy('created_at','desc')->get(); //Vocational Model
		
		$counts_graduate = \App\Graduate::with('master')->where('master_id',$id)->count();
		$graduate1 = \App\Graduate::with('master')->where('master_id',$id)->skip(0)->take(1)->orderBy('created_at','desc')->get(); 
		$graduate2 = \App\Graduate::with('master')->where('master_id',$id)->skip(1)->take($counts_graduate)->orderBy('created_at','desc')->get(); //Graduate 
		
		
		$counts_college = \App\College::with('master')->where('master_id',$id)->count();
		$college1 = \App\College::with('master')->where('master_id',$id)->skip(0)->take(1)->orderBy('created_at','desc')->get(); 
		$college2 = \App\College::with('master')->where('master_id',$id)->skip(1)->take($counts_college)->orderBy('created_at','desc')->get(); 
		
		$college = \App\College::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();//College Model
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.print_pds_page1',compact('master', 'address','idnumber', 'child_count', 
		                                        'spouse', 'father', 'mother', 'elementary',
												'high', 'college1','college2','counts_college',
												'vocational1','vocational2','counts_vocational',
												'graduate1','graduate2','counts_graduate',
												'child_count', 'child','num_row'
												));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function print_pds_page2($id){
		$workexpe =  \App\Work::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		$eligibility =  \App\Eligibility::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();
		$workexpe_count = \App\Work::with('master')->where('master_id',$id)->count();
		$eligibility_count = \App\Eligibility::with('master')->where('master_id',$id)->count();
		
		$num_row1 = $eligibility_count;
		if($num_row1 ==0){
			$num_row1 += 6;
		}elseif($num_row1 ==1){
			$num_row1 += 4;
		}elseif($num_row1 ==2){
			$num_row1 += 2;
		}elseif($num_row1 ==3){
			$num_row1 += 0;
		}elseif($num_row1 == 4){
			$num_row1 -=2 ;
		}elseif($num_row1 == 5){
			$num_row1 -=4 ;
		}elseif($num_row1 == 6){
			$num_row1 -=6 ;
		}elseif($num_row1 > 6){
			$num_row1 -= $num_row1;
		}
		
		$num_row = $workexpe_count - 1;
		
		if($num_row == 0){
			$num_row += 17;
		}elseif($num_row ==1){
			$num_row += 15;
		}elseif($num_row ==2){
			$num_row += 13;
		}elseif($num_row ==3){
			$num_row += 11;
		}elseif($num_row ==4){
			$num_row += 9;
		}elseif($num_row ==5){
			$num_row += 7;
		}elseif($num_row ==6){
			$num_row += 5;
		}elseif($num_row ==7){
			$num_row += 3;
		}elseif($num_row ==8){
			$num_row += 1;
		}elseif($num_row ==9){
			$num_row -= 1;
		}elseif($num_row ==10){
			$num_row -= 3;
		}elseif($num_row ==11){
			$num_row -= 5;
		}elseif($num_row ==12){
			$num_row -= 7;
		}elseif($num_row ==13){
			$num_row -= 9;
		}elseif($num_row ==14){
			$num_row -= 11;
		}elseif($num_row ==15){
			$num_row -= 13;
		}elseif($num_row ==16){
			$num_row -= 15;
		}elseif($num_row ==17){
			$num_row -= 17;
		}elseif($num_row ==17){
			$num_row -= 17;
		}elseif($num_row > 19){
			$num_row -= $num_row;
		}
		

		
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.print_pds_page2',compact('workexpe','eligibility','num_row1','num_row',));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function print_pds_page3($id){
		$voluntary =  \App\Voluntary::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		//$training =  \App\Training::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		
		$counts_training = \App\Training::with('master')->where('master_id',$id)->count();
		$training = \App\Training::with('master')->where('master_id',$id)->skip(0)->take(21)->orderBy('inclusive_from','desc')->get(); 
		$training2 = \App\Training::with('master')->where('master_id',$id)->skip(21)->take($counts_training)->orderBy('inclusive_from','desc')->get(); //Vocational Model
		
		$voluntary_count = \App\Voluntary::with('master')->where('master_id',$id)->count();
		$training_count = \App\Training::with('master')->where('master_id',$id)->count();
		
		$num_row1 = $voluntary_count;
		if($num_row1 ==0){
			$num_row1 += 6;
		}elseif($num_row1 ==1){
			$num_row1 += 4;
		}elseif($num_row1 ==2){
			$num_row1 += 2;
		}elseif($num_row1 ==3){
			$num_row1 += 0;
		}elseif($num_row1 == 4){
			$num_row1 -=2 ;
		}elseif($num_row1 == 5){
			$num_row1 -=4 ;
		}elseif($num_row1 == 6){
			$num_row1 -=6 ;
		}elseif($num_row1 > 6){
			$num_row1 -= $num_row1;
		}
		
		$num_row = $training_count;
		if($num_row ==0){
			$num_row += 21;
		}elseif($num_row ==1){
			$num_row += 19;
		}elseif($num_row ==2){
			$num_row += 17;
		}elseif($num_row ==3){
			$num_row += 15;
		}elseif($num_row ==4){
			$num_row += 13;
		}elseif($num_row ==5){
			$num_row += 11;
		}elseif($num_row ==6){
			$num_row += 9;
		}elseif($num_row ==7){
			$num_row += 7;
		}elseif($num_row ==8){
			$num_row += 5;
		}elseif($num_row ==9){
			$num_row += 3;
		}elseif($num_row ==10){
			$num_row += 1;
		}elseif($num_row ==11){
			$num_row -= 1;
		}elseif($num_row ==12){
			$num_row -= 3;
		}elseif($num_row ==13){
			$num_row -= 5;
		}elseif($num_row ==14){
			$num_row -= 7;
		}elseif($num_row ==15){
			$num_row -= 9;
		}elseif($num_row ==16){
			$num_row -= 11;
		}elseif($num_row ==17){
			$num_row -= 13;
		}elseif($num_row ==18){
			$num_row -= 15;
		}elseif($num_row ==19){
			$num_row -= 17;
		}elseif($num_row ==20){
			$num_row -= 19;
		}elseif($num_row ==21){
			$num_row -= 22;
		}elseif($num_row > 21){
			$num_row -= $num_row;
		}

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.print_pds_page3',compact('training','training2','voluntary','voluntary_count','training_count','num_row1','num_row','counts_training'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function print_pds_page4($id){
		$answer =  \App\Answer::with('master')->where('master_id',$id)->first();
		$photo =  \App\Photo::with('master')->where('master_id',$id)->first();
		$issue = \App\Issue::with('master')->where('master_id',$id)->get();
		$reference =  \App\Credential::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.print_pds_page4',compact('answer','reference','issue','photo'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function print_pds_page5($id){
		$workexpe =  \App\Work::with('master')->where('master_id',$id)->orderBy('inclusive_from','desc')->get();
		$eligibility =  \App\Eligibility::with('master')->where('master_id',$id)->orderBy('created_at','desc')->get();
		$workexpe_count = \App\Work::with('master')->where('master_id',$id)->count();
		$eligibility_count = \App\Eligibility::with('master')->where('master_id',$id)->count();
	
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.workexpe_sheet',compact('workexpe'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function print_pds_page6($id){
		$commendation =  \App\Commendation::with('master')->where('master_id',$id)->orderBy('commendation_date','desc')->get();
	
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.commendation_sheet',compact('commendation'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function training_cport()
	{
		$training = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->where('schoolings.cport','=', NULL)
								->orWhere([ ['schoolings.cport', '']])
								->groupBy('schoolings.master_id')
								->orderBy('masters.salary_grade', 'DESC')
								->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cport',compact('training'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
        //return \Excel::download(new RatingResultOutstanding($startDate,$endDate,$office), 'outstanding_very_satisfactory.xlsx');
    }
	
	public function training_cpbc()
	{
		$training = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->JOIN('trainings','schoolings.master_id','=','trainings.master_id')
								->where( [ 
											['schoolings.cport','CPORT'],
											['schoolings.cpbc','!=','CPBC'],
										])
                                ->groupBy(
											['trainings.master_id'], 
										)
								->orderBy('masters.salary_grade', 'DESC')
								->get();
		
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpbc',compact('training'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	public function training_cpbsc()
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
								->orderBy('masters.date_hired', 'DESC')
								->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpbsc',compact('masters'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
        
		
    }
	
	public function training_cpasc()
	{
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
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpasc',compact('masters'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }
	
	//Download
	
	public function training_cport_download()
	{
		$masters = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->where('schoolings.cport','!=','CPORT')
								->groupBy('schoolings.master_id')
								->orderBy('masters.date_hired', 'ASC')
								->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cport',compact('masters'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->download('cport.pdf');
    }
	
	public function training_cpbc_download()
	{
		$training = \App\Master::select('*')
								->JOIN('schoolings','masters.main_id','=','schoolings.master_id')
								->JOIN('trainings','schoolings.master_id','=','trainings.master_id')
								->where( [ 
											['schoolings.cport','CPORT'],
											['schoolings.cpbc','!=','CPBC'],
										])
								->orderBy('masters.date_hired', 'DESC')
								->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpbc',compact('training'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->download('result.pdf'); 
    }
	
	public function training_cpbsc_download()
	{
		\App\Master::latest('ratings.n_rating')
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
								->orderBy('masters.date_hired', 'DESC')
								->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpbsc',compact('training'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->download('cport.pdf');
		
    }
	
	public function training_cpasc_download()
	{
		$training = \App\Master::select('*')
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
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.training_cpasc',compact('training'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->download('cport.pdf');
    }
	
	
	public function rating_download($id)
	{
		$masters = \App\Rating::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$file_path = public_path('uploads/ipcr/'.$masters->picture);
		return response()->download($file_path);
    }
	
	public function advanced_result(Request $request)
    {
		$name = $request->input('name');
		$office = $request->input('office');
		$sg = $request->input('sg');
		$bt = $request->input('bt');
		if(\Auth::user()->acc_lvl != "Administrator"){
			if($name == "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" &&  $office != "N/A" && $sg == "N/A" &&  $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['masters.office', $office],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			
			}elseif($office != "" && $name == "" &&  $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $bt != "N/A" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $name == "" && $office == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $office != "" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($sg != "N/A" && $bt == "N/A" && $name == "" && $office == "" ){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.salary_grade', $sg],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}else{
				$masters = \App\Master::select('masters.main_id','masters.position','masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->join('addresses', 'addresses.master_id', '=', 'masters.main_id')
						->where([
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}
		}else{
			
			if($name == "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" &&  $office != "N/A" && $sg == "N/A" &&  $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['masters.office', $office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $name == "" &&  $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.office', $office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $bt != "N/A" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $name == "" && $office == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.blood_type', $bt],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($sg != "N/A" && $bt == "N/A" && $name == "" && $office == "" ){
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.salary_grade', $sg],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}else{
				$masters = \App\Master::select('masters.main_id','masters.position','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->orderBy('masters.created_at','DESC')
						->get();
			}
			
		}
		/*
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.search_result',compact('masters'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
		*/
		
		return view('print.advanced_result', compact('masters','name','office','bt','sg'));
    }
	
	public function view_advanced_result(Request $request)
    {
		$name = $request->input('name');
		$office = $request->input('office');
		$sg = $request->input('sg');
		$bt = $request->input('bt');
		if(\Auth::user()->acc_lvl != "Administrator"){
			if($name == "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" &&  $office != "N/A" && $sg == "N/A" &&  $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['masters.office', $office],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			
			}elseif($office != "" && $name == "" &&  $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $bt != "N/A" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $name == "" && $office == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $office != "" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($sg != "N/A" && $bt == "N/A" && $name == "" && $office == "" ){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->where([
									['masters.salary_grade', $sg],
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}else{
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->join('users', 'users.id', '=', 'masters.user_id')
						->join('addresses', 'addresses.master_id', '=', 'masters.main_id')
						->where([
									['users.office',\Auth::user()->office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}
		}else{
			
			if($name == "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" && $office == "" && $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($name != "" &&  $office != "N/A" && $sg == "N/A" &&  $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.complete_name','LIKE','%'.$name.'%'],
									['masters.office', $office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $name == "" &&  $sg == "N/A" && $bt == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.office', $office],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($office != "" && $bt != "N/A" && $name == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.office', $office],
									['masters.blood_type', $bt],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($bt != "N/A" && $name == "" && $office == "" && $sg == "N/A"){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.blood_type', $bt],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}elseif($sg != "N/A" && $bt == "N/A" && $name == "" && $office == "" ){
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->where([
									['masters.salary_grade', $sg],
								])
						->orderBy('masters.created_at','DESC')
						->get();
			}else{
				$masters = \App\Master::select('masters.id','masters.complete_name','masters.office','masters.blood_type','masters.salary_grade')
						->orderBy('masters.created_at','DESC')
						->get();
			}
			
		}
		
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.view_advance_result',compact('masters'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'PORTRAIT');
		return $pdf->stream();
    }

	//PERFORMANCE MGT MONITORING
	public function performance_mgt_monitoring_report(Request $request)
    {
		$office = $request->input('office');
		$year = $request->input('start_year');
		$semester = $request->input('semester');
		
		$performance = \App\Performance::select('performances.*','masters.office','masters.salary_grade','masters.complete_name','masters.position')
						->join('masters', 'performances.master_id', '=', 'masters.main_id')
						->where( [['masters.office',$office],['masters.item_number','!=',NULL],['performances.semester',$semester],['performances.selected_year',$year]])
						->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.performance_mgt_monitoring_report',compact('performance'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->stream();

		// return view('print.performance_mgt_monitoring_report');
    }

	public function download_staffing_result($id)
    {
		$plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->get();
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.staffing_planing_result',compact('plantilla'));
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download();
		
		//return response()->download('print.staffing_planing_result',compact('plantilla'));

		// return Excel::download($plantilla, 'plantilla.xlsx');
	}

	public function print_demog_result_bt(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);

		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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
			$demographics_bt = LarapexChart::barChart()
			->setTitle("CLASSIFICATION OF CIVILIAN HUMAN RESOURCES AT $t_office")
			->addData('MALE', [$bt_a, $bt_ap, $bt_am, $bt_b, $bt_bp, $bt_bm, $bt_o, $bt_op, $bt_om, $bt_ab, $bt_abp, $bt_abm])
			->addData('FEMALE', [$fbt_a, $fbt_ap, $fbt_am, $fbt_b, $fbt_bp, $fbt_bm, $fbt_o, $fbt_op, $fbt_om, $fbt_ab, $fbt_abp, $fbt_abm])
			->setXAxis(['A', 'A+', 'A-', 'B', 'B+', 'B-','O','O+','O-','AB','AB+','AB-']);

			return view('print.demographics_bt_result',compact('demographics_bt','master_count',
			'bt_a','bt_ap','bt_am','bt_b','bt_bp','bt_bm','bt_o','bt_op','bt_om','bt_ab','bt_abp','bt_abm',
			'fbt_a','fbt_ap','fbt_am','fbt_b','fbt_bp','fbt_bm','fbt_o','fbt_op','fbt_om','fbt_ab','fbt_abp','fbt_abm','office'));
	}

	public function print_demog_result_cs(Request $request){
		//CIVIL STATUS
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);

		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
							->count();

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
		$demographics_cs = LarapexChart::barChart()
							->setTitle("CLASSIFICATION OF CHR AT $t_office BASED")
							->addData('CIVIL STATUS', [$status_single, $status_married, $status_widowed, $status_separated, $status_others])
							->setXAxis(['Single', 'Married', 'Widowed', 'Separated', 'Others']);

		return view('print.demographics_cs_result',compact('demographics_cs','master_count','status_others','status_widowed','status_separated','status_single','status_married','office'));
	}

	public function print_demog_result_ig(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);
		
		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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

		$demographics_ig = LarapexChart::pieChart()
							->setTitle("CLASSIFICATION OF CHR AT $t_office")
							->addData([$indigenous, $indigenous_no])
							->setLabels(['Indigenous Member', 'Non-indigenous Member']);
		
		return view('print.demographics_ig_result',compact('demographics_ig','master_count','indigenous_no','indigenous','office'));
	}

	public function print_demog_result_pwd(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);
		
		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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

		$demographics_pwd = LarapexChart::pieChart()
							->setTitle("CLASSIFICATION OF CHR AT $t_office")
							->addData([$pwd, $pwd_no])
							->setLabels(['PWD Member', 'Non-PWD Member']);
		
		return view('print.demographics_pwd_result',compact('demographics_pwd','master_count','pwd_no','pwd','office'));
	}

	public function print_demog_result_sex(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);
		
		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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

		$demographics = LarapexChart::pieChart()
							->setTitle("CLASSIFICATION OF CHR AT $t_office")
							->addData([$male_count, $female_count])
							->setLabels(['MALE', 'FEMALE']);
		
		return view('print.demographics_s_result',compact('demographics','master_count','male_count','female_count','office'));
	}

	public function print_demog_result_sp(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);
		
		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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
		
		$demographics_solo = LarapexChart::pieChart()
					->setTitle("CLASSIFICATION OF CHR AT $t_office")
					->addData([$solo, $solo_no])
					->setLabels(['Solo Parent', 'Non-Solo Parent']);
					
		return view('print.demographics_sp_result',compact('demographics_solo','master_count','solo_no','solo','office'));
	}

	public function print_demog_result_te(Request $request){
		$office = $request->input('office');
		$variable = $request->input('variable');
		
		$t_office = strtoupper(str_replace('_', ' ',$office));
		$t_variable = strtoupper($variable);
		
		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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
		
		$demographics_eligibility = LarapexChart::barChart()
							->setTitle("CLASSIFICATION OF CHR AT $t_office")
							->addData('CIVIL STATUS', [$eligibility_csp, $eligibility_cssp, $eligibility_bar, $eligibility_board, $eligibility__healthw_barangay,$eligibility_barangay_nutrition,$eligibility_barangay_official,$eligibility_fhonor_grad,$eligibility_honor_grad,$eligibility_sanggunian,$eligibility_scientific,$eligibility_skills,$eligibility_veteran,$eligibility_edp,$eligibility_others])
							->setXAxis(['CSP', 'CSSP', 'RA1080 Bar', 'RA1080 Board', 'RA7883','PD1569','RA7160','Res.1302714','PD907','RA10156','PD997','MC11,s.1996','EO 132/790','Res.90-083','OTHERS']);
				
					
		return view('print.demographics_te_result',compact('demographics_eligibility','master_count','eligibility_csp','eligibility_cssp','eligibility_bar','eligibility_board','eligibility__healthw_barangay','eligibility_barangay_nutrition','eligibility_barangay_official','eligibility_fhonor_grad','eligibility_honor_grad','eligibility_sanggunian','eligibility_scientific','eligibility_skills','eligibility_veteran','eligibility_edp','eligibility_others','office'));
	}

	public function download_demog_result_yb(Request $request)
	{
		$office = $request->input('office');
		$date_dob = $request->date_dob;
		$num_year = $request->no_years;
		$year_retirees = $request->year_retirees;

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
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.demographics_yb_result',compact('master_count','year_b','year_count','office','date_dob'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("year_of_birth_$date_dob.pdf");
    }

	public function download_demog_result_yr(Request $request)
	{
		$office = $request->input('office');
		$year_retirees = $request->year_retirees;

		$master_count = \App\Master::select('*')
							->where([ ['office',$office],['item_number','!=',NULL],['deleted_at',NULL]])
							->orWhere([ ['office_group',$office],['item_number','!=','N/A'],['deleted_at',NULL]])
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
		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.demographics_yr_result',compact('master_count','year_rb','year_rcount','office'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("year_of_birth_$year_retirees.pdf");
    }

	public function download_demog_result_ys(Request $request)
	{
		$office = $request->input('office');
		$num_year = $request->num_year;

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

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.demographics_ys_result',compact('master_count','service','service_count','office'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("year_of_service_$num_year.pdf");
    }

	public function download_result_outstanding(Request $request)
	{
		$startDate = date('Y-m-d', strtotime($request->startDate));
		$endDate = date('Y-m-d', strtotime($request->endDate));
		$office = $request->office;

		$get_outstanding_vsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();

		$programma_array = array('Name', 'Position Title', 'SG', 'Office/Unit', 'Rating');

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.outstanding_result',compact('get_outstanding_vsatisfactory'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		//return $pdf->download("outstanding_very_satisfactory.pdf");
		return \Excel::download(new RatingResultOutstanding($startDate,$endDate,$office), 'outstanding_very_satisfactory.xlsx');
    }
	
	public function download_result_satisfactory(Request $request)
	{
		$startDate = date('Y-m-d', strtotime($request->startDate));
		$endDate = date('Y-m-d', strtotime($request->endDate));
		$office = $request->office;

		$get_satifactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.satisfactory_result',compact('get_satifactory'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
	//	return $pdf->download("download_result_satisfactory.pdf");
        return \Excel::download(new RatingResultOutstanding($startDate,$endDate,$office), 'download_result_satisfactory.xlsx');
    }

	public function download_result_poor(Request $request)
	{
		$startDate = date('Y-m-d', strtotime($request->startDate));
		$endDate = date('Y-m-d', strtotime($request->endDate));
		$office = $request->office;

		$get_unsatisfactory_poor =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Outstanding'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Satisfactory'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Very Satisfactory'],['ratings.a_rating','!=','Outstanding'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orderBy('ratings.n_rating','desc')
										->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.poor_result',compact('get_unsatisfactory_poor'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		//return $pdf->download("download_result_poor.pdf");
         return \Excel::download(new RatingResultOutstanding($startDate,$endDate,$office), 'download_result_poor.xlsx');
    }
	
	public function download_national_award(Request $request)
	{
		$date_commendation = $request->date_commendation;
		$office = $request->office;

		$national_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->orWhere( [['commendations.type_awards','NATIONAL AWARDS'],['masters.office_group',$office],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.awards_demog_national',compact('national_awards','date_commendation','office'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("national_awards.pdf");
        
    }

	public function download_incentives_award(Request $request)
	{
		$date_commendation = $request->date_commendation;
		$office = $request->office;

		$incentives_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
						->join('masters', 'commendations.master_id', '=', 'masters.main_id')
						->where( [['commendations.type_awards','OTHER INCENTIVES'],['masters.item_number','!=',NULL]])
						->whereYear('commendation_date', '=', $date_commendation)
						->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.awards_demog_incentives',compact('incentives_awards','date_commendation'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("incentives_awards.pdf");
    }

	public function download_honor_award(Request $request)
	{
		$date_commendation = $request->date_commendation;
		$office = $request->office;

		$honor_awards = \App\Commendation::select('commendations.commendation_date','commendations.type_awards','commendations.commendation','masters.*')
		->join('masters', 'commendations.master_id', '=', 'masters.main_id')
		->where( [['commendations.type_awards','HONOR AWARDS'],['masters.item_number','!=',NULL]])
		->whereYear('commendation_date', '=', $date_commendation)
		->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.awards_demog_honor',compact('honor_awards','date_commendation'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("honor_awards.pdf");
    }

	public function download_staffing_office_plan($id)
	{
		$plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.staffing_office_plan',compact('plantilla'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("staffing_office_plan.pdf");
    }

	public function download_computer_asst_matrix($id)
	{
		$plantilla = \App\Plantilla::select('*')->where([ ['office_group',$id],['master_id',NULL] ])->get();

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.computer_asst_matrix',compact('plantilla'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("computer_asst_matrix.pdf");
    }
	
	public function download_tat_costing(Request $request)
	{
		$start = date('Y-m-d', strtotime($request->start_date));
		$end = date('Y-m-d', strtotime($request->end_date));
		$status = strtoupper($request->status);
		
		$sum_cost = array();
		
		if($status == "DONE"){
			$masters = \App\Costing::select('*')
									->whereBetween( 'rai_date',[$start,$end ])
									->where('status',$status)
									->get();
		}elseif($status == "PENDING"){
			$masters = \App\Costing::select('*')
								->whereBetween( 'publication_date',[$start,$end ])
								->where('status',$status)
								->get();
		}elseif($status == "ALL"){
			$masters = \App\Costing::select('*')
								->whereBetween( 'publication_date',[$start,$end ])
								->get();
		}

		$pdf = \App::make('dompdf.wrapper');
		$html = view('print.tat_costing_report',compact('masters'));
		//$html = view('print.training_cport');
		$pdf->loadHTML($html)->setPaper('LEGAL', 'LANDSCAPE');
		return $pdf->download("tat_costing_report.pdf");
    }
}
