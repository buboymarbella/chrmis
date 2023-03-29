<?php

namespace App\Http\Controllers\MainController;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
        $masters = \App\Master::where('main_id',$id)->first();
		$address =  \App\Address::with('master')->where('master_id',$id)->latest()->first();
		return view('update.address_records', compact('masters','address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
		$user_id = \App\Master::where('main_id',$id)->first();
		
		if (!\Gate::allows('is', $user_id)) {
			  abort(404,'Sorry you cant do this action');
		}
		
		
        $address = \App\Address::where('master_id',$id)->first();
		$address->residential_house = strtoupper($request->residential_house);
		$address->residential_street = strtoupper($request->residential_street);
		$address->residential_subdivision = strtoupper($request->residential_subdivision);
		$address->residential_brgy = strtoupper($request->residential_brgy);
		$address->residential_city = strtoupper($request->residential_city);
		$address->residential_province = strtoupper($request->residential_province);
		$address->residential_zipcode = strtoupper($request->residential_zipcode);
		$address->permanent_house = strtoupper($request->permanent_house);
		$address->permanent_street = strtoupper($request->permanent_street);
		$address->permanent_subdivision = strtoupper($request->permanent_subdivision);
		$address->permanent_brgy = strtoupper($request->permanent_brgy);
		$address->permanent_city = strtoupper($request->permanent_city);
		$address->permanent_province = strtoupper($request->permanent_province);
		$address->permanent_zipcode = strtoupper($request->permanent_zipcode);
		$address->save();
        
        $clientIP = \Request::ip();
		$ledger = new \App\Ledger(['user_id' => \Auth::id(), 'ip_address' => $clientIP, 'action' => "Update Address Records"]);
		$ledger->save();
		
		//return back()->with('success', 'Records Successfully Added!');
		return redirect()->route('masters.show', $id)->with('success', 'Records Successfully Added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
