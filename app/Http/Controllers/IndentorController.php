<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Indentor;
use App\Department;
use Config;
use Auth;
use DB;


class IndentorController extends Controller
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
             
            $indentors = Indentor::where('indentor_name', 'LIKE', "%$keyword%")
                            ->orderBy('id', 'desc')
                            //->whereNull('deleted_at')
                            ->get();
							
        } else {
            
			$indentors = Indentor::where('indentor_name', 'LIKE', "%$keyword%")
                            ->orderBy('id', 'desc')
                            //->whereNull('deleted_at')
                            ->get();			
			
        }		
	    return view('Indentor.index',compact('indentors')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('Indentor.create');
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
			'indentor_name' => 'required|unique:indentors',             			
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
			
			$indentor = new Indentor();
			$indentor->indentor_name = $input['indentor_name'];
		    $indentor->save();
				
			return redirect()->route('Indentor.index')
                        ->with('success','Indentor created successfully');		
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
	    $indentor = Indentor::find($id);
        return view('Indentor.show',compact('indentor'));		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$indentor = Indentor::find($id);
        return view('Indentor.edit',compact('indentor'));
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
			'indentor_name' => 'required|unique:indentors,indentor_name,'.$id,          			
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
			
			$indentor = Indentor::find($id);
			$indentor->indentor_name = $input['indentor_name'];
			$indentor->save();
				
			return redirect()->route('Indentor.index')
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
        Indentor::find($id)->delete();
        return redirect()->route('Indentor.index')
                        ->with('success','Record deleted successfully');
    }
		
}
