<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$masters = \Crypt::decrypt($request->master_id);
		$user_id = \App\Master::where('main_id',$masters)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => 'required',
			'userfile' => 'image|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ];

        $request->validate($rules);
	
		$rating = new \App\Rating;
		$rating->master_id = $masters;
		$rating->n_rating = $request->n_rating;
		$rating->a_rating = $request->a_rating;
        // $rating->office = $request->n_rating;
		// $rating->office_group = $request->a_rating;
		$rating->s_assessment = date('Y-m-d', strtotime($request->s_assessment));
		$rating->e_assessment = date('Y-m-d', strtotime($request->e_assessment));
		if ($request->hasFile('userfile')) {
            // get image file
            $image = $request->userfile;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename =  \Auth::id()."".rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/ipcr'), $filename);
            // delete the previous image
            //Storage::delete(public_path("uploads/ipcr/$rating->filename"));
            $rating->picture = $filename;
        }else{
			$rating->picture = '';
		}
		
		$rating->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "Add New IPCR Records"]);
		$ledger->save();
		
		return redirect()->route('rating', $masters)->with('success', 'Records Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $master = \App\Master::where('main_id',$id)->first();
		return view('content.rating_records', compact('master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$masters = \App\Rating::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$masters->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		return view('update.rating_records', compact('masters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$rating_id = \App\Rating::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$rating_id->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
        $rules = [
            'master_id' => "unique:{$id}",
			'userfile' => 'image|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ];

        $request->validate($rules);
		
		$rating = \App\Rating::where('id',$id)->first();
		$rating->n_rating = $request->n_rating;
		$rating->a_rating = $request->a_rating;
		$rating->s_assessment = date('Y-m-d', strtotime($request->s_assessment));
		$rating->e_assessment = date('Y-m-d', strtotime($request->e_assessment));
		
		if ($request->hasFile('userfile')) {
            // get image file
            $image = $request->userfile;
            // get image extension
            $ext = $image->getClientOriginalExtension();
            // make a unique name
            $filename = \Auth::id()."".rand() . '.' . $ext;
            // upload the image
            $image->move(public_path('uploads/ipcr'), $filename);
            // delete the previous image
            //Storage::delete(public_path("uploads/ipcr/$rating->filename"));
            $rating->picture = $filename;
        }else{
			$rating->picture = $rating->picture;
		}
		
		$rating->save();
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "IPCR Record Updated"]);
		$ledger->save();
		
		return redirect()->route('rating', $rating->master_id)->with('success', 'Records Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = \App\Rating::where('id',$id)->first();
		$user_id = \App\Master::where('main_id',$master->master_id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'action' => "IPCR Record Deleted"]);
		$ledger->save();
		
		$master->delete();
		
		return redirect()->route('rating', $master->master_id)->with('success', 'Records Successfully Deleted!');
    }
}
