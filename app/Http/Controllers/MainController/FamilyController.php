<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyController extends Controller
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

    public function store(Request $request,$id)
    {
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$rules = [
            'master_id' => 'required',
        ];

        $request->validate($rules);
		$masters = \Crypt::decrypt($request->master_id);
		$rep0  = $request->sbirthdate; 
		$rep1  = $request->sdmarriage;  
		$rep2  = $request->fbirthdate; 
		$rep3  = $request->mbirthdate; 
		
		
		$check = \App\Spouse::where('master_id',$masters)->first();
		if(!empty($check)){
			return redirect()->route('families_records', $masters)->with('success', 'Records Successfully Added!');
		}
		$spouse = new \App\Spouse;
		$spouse->master_id = $masters;
		$spouse->first_name = strtoupper($request->sfirst_name);
		$spouse->last_name = strtoupper($request->slast_name);
		$spouse->middle_name = strtoupper($request->smiddle_name);
		$spouse->extension_name = strtoupper($request->sextension_name);
		$spouse->occupation = strtoupper($request->occupation);
		$spouse->employer = strtoupper($request->employer);
		$spouse->business_addr = strtoupper($request->business_address);
		$spouse->telephone_no = strtoupper($request->telephone_no);
		$spouse->save();
		
		$father = new \App\Father;
		$father->master_id = $masters;
		$father->ffirst_name = strtoupper($request->ffirst_name);
		$father->flast_name = strtoupper($request->flast_name);
		$father->fmiddle_name = strtoupper($request->fmiddle_name);
		$father->fextension_name = strtoupper($request->fextension_name);
		$father->save();
		
		$mother = new \App\Mother;
		$mother->master_id = $masters;
		$mother->mmaiden_name = strtoupper($request->maiden_name);
		$mother->mfirst_name = strtoupper($request->mfirst_name);
		$mother->mlast_name = strtoupper($request->mlast_name);
		$mother->mmiddle_name = strtoupper($request->mmiddle_name);
		$mother->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Add New Family Records"]);
		$ledger->save();
		
		//return redirect()->route('families_records', $masters)->with('success', 'Records Successfully Added!');d
		return redirect()->route('masters.show', $id)->with('success', 'Records Successfully Added!');
    }

    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.family_records', compact('master','user_id'));
    }

    public function edit($id)
    {
		$masters = \App\Spouse::where('master_id',$id)->first();
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$spouse = \App\Spouse::where('master_id',$id)->first();
		$father = \App\Father::where('master_id',$id)->first();
		$mother = \App\Mother::where('master_id',$id)->first();
		
		return view('update.family_records', compact('masters','spouse','father','mother'));
        
    }

    public function update(Request $request, $id)
    {
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$rules = [
            'master_id' => "unique:{$id}",
        ];

        $request->validate($rules);
		$rep0  = $request->sbirthdate; 
		$rep1  = $request->sdmarriage;  
		$rep2  = $request->fbirthdate; 
		$rep3  = $request->mbirthdate; 
		
		$spouse = \App\Spouse::where('master_id',$id)->first();
		$spouse->first_name = strtoupper($request->sfirst_name);
		$spouse->last_name = strtoupper($request->slast_name);
		$spouse->middle_name = strtoupper($request->smiddle_name);
		$spouse->extension_name = strtoupper($request->sextension_name);
		$spouse->occupation = strtoupper($request->occupation);
		$spouse->employer = strtoupper($request->employer);
		$spouse->business_addr = strtoupper($request->business_address);
		$spouse->telephone_no = strtoupper($request->telephone_no);
		$spouse->save();
		
		$father = \App\Father::where('master_id',$id)->first();
		$father->ffirst_name = strtoupper($request->ffirst_name);
		$father->flast_name = strtoupper($request->flast_name);
		$father->fmiddle_name = strtoupper($request->fmiddle_name);
		$father->fextension_name = strtoupper($request->fextension_name);
		$father->save();
		
		$mother = \App\Mother::where('master_id',$id)->first();
		$mother->mmaiden_name = strtoupper($request->maiden_name);
		$mother->mfirst_name = strtoupper($request->mfirst_name);
		$mother->mlast_name = strtoupper($request->mlast_name);
		$mother->mmiddle_name = strtoupper($request->mmiddle_name);
		$mother->save();
		
		$clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP,'action' => "Family Records Updated"]);
		$ledger->save();
		
		//return redirect()->route('families_records', $spouse->master_id)->with('success', 'Records Successfully Added!');
		return redirect()->route('masters.show', $id)->with('success', 'Records Successfully Updated!');
    }

    public function destroy($id)
    {
        //
    }
}
