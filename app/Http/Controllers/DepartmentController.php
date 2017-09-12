<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Department;
use Config;
use Auth;
use DB;


class DepartmentController extends Controller
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
            $departments = Department::where('department_name', 'LIKE', "%$keyword%")
				->orderBy('id', 'desc')
                //->whereNull('deleted_at')
				//->paginate($perPage);
                ->get();
        } else {
            $departments = DB::table('departments')
                           ->orderBy('id', 'desc')
                           //->whereNull('deleted_at')
                           //->paginate($perPage);
                           ->get();
        }
				
        return view('Department.index',compact('departments')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('Department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
	
		$input = $request->all();
		
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'department_name' => 'required|unique:departments',			
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
			
			$department = new Department();
			$department->department_name = $input['department_name'];
            $department->save();
				
			return redirect()->route('Department.index')
                        ->with('success','Department created successfully');		
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
        $department = Department::find($id);
        return view('Department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$department = Department::find($id);
        return view('Department.edit',compact('department'));        
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
            'department_name' => 'required|unique:departments,department_name,'.$id,   			
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
			
			$department = Department::find($id);
			$department->department_name = $input['department_name'];
            $department->save();
				
			return redirect()->route('Department.index')
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
        Department::find($id)->delete();
        return redirect()->route('Department.index')
                        ->with('success','Record deleted successfully');
    }
}
