<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 

class RatingResultOutstanding implements FromCollection, WithHeadings
{
    public function collection($startDate,$endDate,$office)
    {
        $get_outstanding_vsatisfactory =  \App\Rating::select('ratings.n_rating','ratings.a_rating','ratings.s_assessment','ratings.e_assessment','masters.*')
										->join('masters','ratings.master_id','=','masters.main_id')
										->where([ ['masters.office_group',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
										->orWhere([ ['masters.office',$office ],['masters.item_number','!=',NULL],['ratings.a_rating','!=','Satisfactory'],['ratings.a_rating','!=','Unsatisfactory'],['ratings.a_rating','!=','Poor'],['ratings.s_assessment', '>=', $startDate],['ratings.e_assessment', '<=', $endDate] ])
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
