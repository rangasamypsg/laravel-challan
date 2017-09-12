<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Uom;
use Config;
use Auth;
use DB;

class UomController extends Controller
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
            $uoms = Uom::where('uom_name', 'LIKE', "%$keyword%")
					->orderBy('id', 'desc')
                   // ->whereNull('deleted_at')
                    ->get();
        } else {
			$uoms = DB::table('uom')
                    ->orderBy('id', 'desc')
                   // ->whereNull('deleted_at')
				    ->get();
		}
				
        return view('Uom.index',compact('uoms')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Uom.create');
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
		
		$rules = array(
            'uom_name' => 'required|unique:uom',			
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
			
			$uom = new Uom();
			$uom->uom_name = $input['uom_name'];
            $uom->save();
				
			return redirect()->route('Uom.index')
                        ->with('success','Uom created successfully');		
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
        $uom = Uom::find($id);
        return view('Uom.show',compact('uom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uom = Uom::find($id);
        return view('Uom.edit',compact('uom'));
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
		
		$rules = array(
            'uom_name' => 'required|unique:uom,uom_name,'.$id,			
        );
		
         // run the validation rules on the inputs from the form
         $validator = Validator::make($input, $rules);
         // if the validator fails, redirect back to the form
         if ($validator->fails()) {
		 
			//echo "<pre>";
			//print_r($validator); exit;
		 
             // If validation falis redirect back to login.
              return redirect()->back()
                              ->withInput()
                              ->with('errors',$validator->errors()); 
			 
         } else {
			
			$uom = Uom::find($id);
			$uom->uom_name = $input['uom_name'];
            $uom->save();
				
			return redirect()->route('Uom.index')
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
        Uom::find($id)->delete();
        return redirect()->route('Uom.index')
                        ->with('success','Record deleted successfully');
    }
}
