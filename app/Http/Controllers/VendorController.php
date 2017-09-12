<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vendor;
use App\State;
use Config;
use Auth;
use DB;

class VendorController extends Controller
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
            $vendors = Vendor::where('vendor_name', 'LIKE', "%$keyword%")
				->orderBy('id', 'desc')
                //->whereNull('deleted_at')
				->get();
        } else {
            $vendors = DB::table('vendors')
                       ->orderBy('id', 'desc')
                       //->whereNull('deleted_at')
                       ->get();
        }
			
        return view('Vendor.index',compact('vendors')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = $this->__state_list();
        return view('Vendor.create',compact('states'));
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
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'vendor_name' => 'required|unique:vendors',  			
            'address_line_1' => 'required',
            //'postal_code' => 'min:6|max:6',
            'gst_number' => 'required|min:15|max:15|alpha_num',			
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
			
			$vendor = new Vendor();
			$vendor->vendor_name = $input['vendor_name'];
			$vendor->vendor_code = $input['vendor_code'];
			$vendor->address_line_1 = ( !empty( $input['address_line_1'] ) ? $input['address_line_1'] : '' );
			$vendor->address_line_2 = ( !empty( $input['address_line_2'] ) ? $input['address_line_2'] : '');
			$vendor->city = ( !empty( $input['city'] ) ? $input['city'] : '');
			$vendor->postal_code = ( !empty( $input['postal_code'] ) ? $input['postal_code'] : '');
			$vendor->state_id = ( !empty( $input['state_id'] ) ? $input['state_id'] : '');
			$vendor->state_code = ( !empty( $input['state_code'] ) ? $input['state_code'] : '');
            $vendor->gst_number = $input['gst_number'];
            $vendor->save();
				
			return redirect()->route('Vendor.index')
                        ->with('success','Vendor created successfully');		
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
        $vendor = Vendor::find($id);
        return view('Vendor.show',compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $states = $this->__state_list();

		return view('Vendor.edit',compact('vendor','states'));
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
        // read more on validation at http://laravel.com/docs/validation
         $rules = array(
            'vendor_name' => 'required|unique:vendors,vendor_name,'.$id, 			
            'address_line_1' => 'required',
            //'postal_code' => 'min:6|max:6',
            'gst_number' => 'required|min:15|max:15|alpha_num',
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
			
			$vendor = Vendor::find($id);
			$vendor->vendor_name = $input['vendor_name'];
			$vendor->vendor_code = $input['vendor_code'];
			$vendor->address_line_1 = ( !empty( $input['address_line_1'] ) ? $input['address_line_1'] : '' );
			$vendor->address_line_2 = ( !empty( $input['address_line_2'] ) ? $input['address_line_2'] : '');
			$vendor->city = ( !empty( $input['city'] ) ? $input['city'] : '');
			$vendor->postal_code = ( !empty( $input['postal_code'] ) ? $input['postal_code'] : '');
			$vendor->state_id = ( !empty( $input['state_id'] ) ? $input['state_id'] : '');
			$vendor->state_code = ( !empty( $input['state_code'] ) ? $input['state_code'] : '');
            $vendor->gst_number = $input['gst_number'];
            $vendor->save();
				
			return redirect()->route('Vendor.index')
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
        Vendor::find($id)->delete();
        return redirect()->route('Vendor.index')
                        ->with('success','Record deleted successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __state_list()
    {
		return State::orderBy('id','ASC')->get();	
    }
}
