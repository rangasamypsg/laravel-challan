<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DeliveryType;
use Config;
use Auth;
use DB;

class DeliveryTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {		
		$keyword = $request->get('search');
        $perPage = Config::get('settings.pagination.perPage');
        if (!empty($keyword)) {
            $delivery_types = DeliveryType::where('delivery_type', 'LIKE', "%$keyword%")
							  ->orderBy('id', 'desc')
                              ->whereNull('deleted_at')
                              ->get();
        } else {
            $delivery_types = DB::table('delivery_types')
                              ->orderBy('id', 'desc')
                              ->whereNull('deleted_at')
                              ->get();                                  
        }		
	 		
        return view('DeliveryType.index',compact('delivery_types')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('DeliveryType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
		
		// validate
        $rules = array(
            'delivery_type' => 'required',			
        );
		
         // run the validation rules on the inputs from the form
         $validator = Validator::make($input, $rules);
         // if the validator fails, redirect back to the form
         if ($validator->fails()) {
		 
             // If validation falis redirect back to login.
              return redirect()->back()
                              ->withInput()
                              ->with('errors',$validator->errors()); 
			 
         } else {
			
			$deliveryType = new DeliveryType();
			$deliveryType->delivery_type = $input['delivery_type'];
            $deliveryType->save();
				
			return redirect()->route('DeliveryType.index')
                        ->with('success','Delivery Type created successfully');		
		 }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryType = DeliveryType::find($id);
        return view('DeliveryType.show',compact('deliveryType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $deliveryType = DeliveryType::find($id);
       return view('DeliveryType.edit',compact('deliveryType'));
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
        $input = $request->all();
		
		// validate
        $rules = array(
            'delivery_type' => 'required',			
        );
		
		 // run the validation rules on the inputs from the form
		 $validator = Validator::make($input, $rules);
		 // if the validator fails, redirect back to the form
		 if ($validator->fails()) {
		 
			 // If validation falis redirect back to login.
			  return redirect()->back()
							  ->withInput()
							  ->with('errors',$validator->errors()); 
			 
		 } else {
			
			$deliveryType =  DeliveryType::find($id);
			$deliveryType->delivery_type = $input['delivery_type'];
			$deliveryType->save();
				
			return redirect()->route('DeliveryType.index')
						->with('success','Record updated successfully');		
		 }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DeliveryType::find($id)->delete();
        return redirect()->route('DeliveryType.index')
                        ->with('success','Record deleted successfully');
    }
}
