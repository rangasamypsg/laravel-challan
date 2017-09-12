<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DeliveryNote;
use App\DeliveryItem;
use App\Department;
use App\Vendor;
use App\Uom;
use App\Indentor;
use App\State;
use Config;
use Auth;
use DB;

class DeliveryNoteController extends Controller
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
            $delivery_notes = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->where('vendor_name', 'LIKE', "%$keyword%")
                    ->orderBy('id', 'desc')
                    //->whereNull('deleted_at')
                    ->get();
        } else {
           
            $delivery_notes = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.created_at', 'desc')	
					//->whereNull('d.deleted_at')
					->get();
        
        }
				
        return view('DeliveryNote.index',compact('delivery_notes')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Session::forget('itemscount');
        $deliveryNote = $this->__multipleDeliveryNotes();
        //$currencys = $deliveryNote['currencys'];
        $matComeBacks = $deliveryNote['matComeBacks'];
        $insureds = $deliveryNote['insureds'];
        $matBelongsToBkns = $deliveryNote['matBelongsToBkns'];
        $vendors = $deliveryNote['vendors'];
        $indentors = $deliveryNote['indentors'];
        $departments = $deliveryNote['departments'];
        $uoms = $deliveryNote['uoms'];
         
        return view('DeliveryNote.create',compact('matComeBacks','insureds','matBelongsToBkns','vendors','indentors','departments','uoms'));
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
	    $deliveryItems = Input::get('deliveryItem');
		$itemscount = count($deliveryItems); 
        Session::put('itemscount',$itemscount); 
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'mat_will_come_back' => 'required',	
            'carrier_name' => 'required',			
            'place' => 'required',			
            //'vechile_number' => 'required|min:13|max:13|alpha_num',
            'vechile_number' => 'required',
            'return_date' => 'sometimes|required',
            'vendor_id' => 'required',
            'indentor_id' => 'sometimes|required',
            'department_id' => 'sometimes|required',
            'matl_belongs_to_bkn' => 'sometimes|required',			
            'insured' => 'sometimes|required',             		            			
            'deliveryItem.*.description' => 'required',             		            			
            'deliveryItem.*.hsn_code' => 'required',             		            			
            'deliveryItem.*.uom' => 'required',            		            			
            'deliveryItem.*.qty' => 'required',             		            			
            'deliveryItem.*.rate' => 'required',            		            			
           /* 'deliveryItem.*.c_percentage' => 'required',            		            			
            'deliveryItem.*.s_percentage' => 'required',            		            			
            'deliveryItem.*.i_percentage' => 'required',*/            		            			                         		            			
        );

        /* $m = 0;   
         foreach ($deliveryItems  as $key => $deliveryItem) {
             $rules["deliveryItem.$m.description"] = 'required';             
             $rules["deliveryItem.$m.hsn_code"] = 'required';             
             $rules["deliveryItem.$m.uom"] = 'required';             
             $rules["deliveryItem.$m.qty"] = 'required';             
             $rules["deliveryItem.$m.rate"] = 'required';             
            // $rules["deliveryItem.$m.c_percentage"] = 'required';             
            // $rules["deliveryItem.$m.s_percentage"] = 'required';             
            // $rules["deliveryItem.$m.i_percentage"] = 'required';             
             $m++;
         } */   
		
        /* echo "<pre>";
        print_r($request);
        exit; */

         // run the validation rules on the inputs from the form
         $validator = Validator::make($input, $rules);
         // if the validator fails, redirect back to the form
         if ($validator->fails()) {
			//echo "<pre>";
			//print_r($validator->errors()); exit;
		    // If validation falis redirect back to login.
              return redirect()->back()
                              ->withInput()
                              ->with('errors',$validator->errors()); 
			 
         } else {
		
            $materialWillComback = "Non Returnable";
            if ( isset( $input['mat_will_come_back'] ) && $input['mat_will_come_back'] === 'Returnable' ) {
                    $materialWillComback = "Returnable";
            }elseif ( isset( $input['mat_will_come_back'] ) && $input['mat_will_come_back'] === 'Delivery Note' ) {
                    $materialWillComback = "Delivery Note";
            }

            $deliveryNote = new DeliveryNote();
			$deliveryNote->challan_date = $input['challan_date'];
			$deliveryNote->financial_year = $input['financial_year'];
			$deliveryNote->mat_will_come_back = $materialWillComback;
			//$deliveryNote->currency = ( !empty( $input['currency'] ) ? $input['currency'] : '');
			//$deliveryNote->po_number = ( !empty( $input['po_number'] ) ? $input['po_number'] : '');
			$deliveryNote->carrier_name = ( !empty( $input['carrier_name'] ) ? $input['carrier_name'] : '');
			$deliveryNote->place = ( !empty( $input['place'] ) ? $input['place'] : '');
			$deliveryNote->vechile_number = ( !empty( $input['vechile_number'] ) ? $input['vechile_number'] : '');
			$deliveryNote->challan_number = ( !empty( $input['challan_number'] ) ? $input['challan_number'] : '');
			$deliveryNote->return_date = ( !empty( $input['return_date'] ) ? date('Y-m-d', strtotime($input['return_date'])) : '');
			$deliveryNote->vendor_id = ( !empty( $input['vendor_id'] ) ? $input['vendor_id'] : '');
            if($input['mat_will_come_back'] != "Delivery Note") {
               $deliveryNote->department_id = ( !empty( $input['department_id'] ) ? $input['department_id'] : '');
			   $deliveryNote->indentor_id = ( !empty( $input['indentor_id'] ) ? $input['indentor_id'] : '');
            }
            $deliveryNote->matl_belongs_to_bkn = ( !empty( $input['matl_belongs_to_bkn'] ) ? $input['matl_belongs_to_bkn'] : '');
            $deliveryNote->insured = ( !empty( $input['insured'] ) ? $input['insured'] : '');
			$deliveryNote->save();
            
            $dbDeliveryItems = [];
            foreach($deliveryItems as $delivery_item){
                
                $deliveryItem = new DeliveryItem();
                $deliveryItem->delivery_note_id = $deliveryNote->id; 
                $deliveryItem->description = ( !empty( $delivery_item['description'] ) ? $delivery_item['description'] : '');
                $deliveryItem->hsn_code = ( !empty( $delivery_item['hsn_code'] ) ? $delivery_item['hsn_code'] : '');
                $deliveryItem->uom = ( !empty( $delivery_item['uom'] ) ? $delivery_item['uom'] : '');
                $deliveryItem->qty = ( !empty( $delivery_item['qty'] ) ? $delivery_item['qty'] : '');
                $deliveryItem->rate = ( !empty( $delivery_item['rate'] ) ? $delivery_item['rate'] : '');
                $deliveryItem->total = ( !empty( $delivery_item['total'] ) ? $delivery_item['total'] : '');
                $deliveryItem->c_percentage = ( !empty( $delivery_item['c_percentage'] ) ? $delivery_item['c_percentage'] : '');
                $deliveryItem->c_amount = ( !empty( $delivery_item['c_amount'] ) ? $delivery_item['c_amount'] : '');
                $deliveryItem->s_percentage = ( !empty( $delivery_item['s_percentage'] ) ? $delivery_item['s_percentage'] : '');
                $deliveryItem->s_amount = ( !empty( $delivery_item['s_amount'] ) ? $delivery_item['s_amount'] : '');
                $deliveryItem->i_percentage = ( !empty( $delivery_item['i_percentage'] ) ? $delivery_item['i_percentage'] : '');
                $deliveryItem->i_amount = ( !empty( $delivery_item['i_amount'] ) ? $delivery_item['i_amount'] : '');
                $deliveryItem->sub_total = ( !empty( $deliveryItems[0]['txt_sub_total'] ) ? $deliveryItems[0]['txt_sub_total'] : '');
                $deliveryItem->cgst_total = ( !empty( $deliveryItems[0]['txt_cgst_total'] ) ? $deliveryItems[0]['txt_cgst_total'] : '');
                $deliveryItem->sgst_total = ( !empty( $deliveryItems[0]['txt_sgst_total'] ) ? $deliveryItems[0]['txt_sgst_total'] : '');
                $deliveryItem->igst_total = ( !empty( $deliveryItems[0]['txt_igst_total'] ) ? $deliveryItems[0]['txt_igst_total'] : '');
                $deliveryItem->all_gst_total = ( !empty( $deliveryItems[0]['txt_all_gst_total'] ) ? $deliveryItems[0]['txt_all_gst_total'] : '');
                $dbDeliveryItems[] = $deliveryItem->attributesToArray();
            }

            DB::table('delivery_items')->insert($dbDeliveryItems);
            Session::forget('itemscount');
           	
            return redirect()->route('DeliveryNote.showBillDetail', $deliveryNote->id)->with('success','Delivery Note created successfully');            
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
        $deliveryNote = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","d.carrier_name","d.place","d.vechile_number","d.challan_number","d.return_date","d.matl_belongs_to_bkn","d.insured"
                    ,"v.vendor_name","v.address_line_1","v.address_line_2","v.postal_code","v.state_id","v.state_code","v.gst_number"
                    ,"dep.department_name","ind.indentor_name","s.state_name")
					->join('vendors as v', 'd.vendor_id', '=', 'v.id')
					->leftjoin('departments as dep', 'd.department_id', '=', 'dep.id')
					->leftjoin('states as s', 's.id', '=', 'v.state_id')
					->leftjoin('indentors as ind', 'd.indentor_id', '=', 'ind.id')
                    ->where('d.id', '=', $id)
					->orderBy('d.created_at', 'desc')	
					//->whereNull('d.deleted_at')
					->first();

         $deliveryItems = DB::table('delivery_items as di')
					->select("di.id","di.delivery_note_id","di.description","di.hsn_code","di.uom","di.qty","di.rate","di.total","di.c_percentage","di.c_amount","di.s_percentage","di.s_amount","di.i_percentage","di.i_amount","di.sub_total","di.cgst_total","di.sgst_total","di.igst_total","di.all_gst_total","u.uom_name")
                    ->leftjoin('uom as u', 'di.uom', '=', 'u.id')
					->where('di.delivery_note_id', '=', $id)
					->get();    

       /* echo "<pre>";
        print_r($deliveryItems);
        exit; */

        return view('DeliveryNote.show',compact('deliveryNote','deliveryItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBillDetails($id)
    {
        $deliveryNote = DeliveryNote::find($id);

        //echo Config::get('settings.Bradken.Permanent_address');
        $deliveryNote = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","d.carrier_name","d.place","d.vechile_number","d.challan_number","d.return_date","d.matl_belongs_to_bkn","d.insured"
                    ,"v.vendor_name","v.address_line_1","v.address_line_2","v.postal_code","v.state_id","v.state_code","v.gst_number"
                    ,"dep.department_name","ind.indentor_name","s.state_name")
					->join('vendors as v', 'd.vendor_id', '=', 'v.id')
					->leftjoin('departments as dep', 'd.department_id', '=', 'dep.id')
					->leftjoin('states as s', 's.id', '=', 'v.state_id')
					->leftjoin('indentors as ind', 'd.indentor_id', '=', 'ind.id')
                    ->where('d.id', '=', $id)
					->orderBy('d.created_at', 'desc')	
					//->whereNull('d.deleted_at')
					->first();

         $deliveryItems = DB::table('delivery_items as di')
					->select("di.id","di.delivery_note_id","di.description","di.hsn_code","di.uom","di.qty","di.rate","di.total","di.c_percentage","di.c_amount","di.s_percentage","di.s_amount","di.i_percentage","di.i_amount","di.sub_total","di.cgst_total","di.sgst_total","di.igst_total","di.all_gst_total","u.uom_name")
                    ->leftjoin('uom as u', 'di.uom', '=', 'u.id')
					->where('di.delivery_note_id', '=', $id)
					->get();    

        /* echo "<pre>";
        print_r($deliveryItems);
        exit; */ 

        return view('DeliveryNote.showBillDetail',compact('deliveryNote','deliveryItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getDepartmentList(Request $request){
        
		if($request->ajax()) {
			$input = $request->all();                    
        	$departmentId = $input['departmentId'];
			$indentors = DB::table('indentors as i')
					->select("i.id","i.indentor_name","d.id as department_id","d.department_name")
					->leftjoin('departments as d', 'i.department_id', '=', 'd.id')
					->orderBy('i.created_at', 'desc')
					//->whereNull('i.deleted_at')
					->where('i.id', '=', $indentorId)
					->first();    
                       
            if($indentors) {
                $response = array(
                    'status' => 'success',
                    'department_id' =>  $indentors->department_id,
                    'department_name' =>  $indentors->department_name,
                );
            } else {
                $response = array(
                    'status' => 'false',                    
                );
            }
            
            return response()->json($response);
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getVendorList(Request $request){
        
		if($request->ajax()) {
			$input = $request->all();                    
        	$vendorId = $input['vendorId'];
			$vendors = Vendor::find($vendorId);

            if($vendors) {

                $response = array(
                    'status' => 'success',
                    'vendor_details' =>  $vendors->vendor_code.' '.$vendors->address_line_1.' '.$vendors->address_line_2.' '.$vendors->city.' '.$vendors->postal_code.' '.$vendors->gst_number
                );
            } else {
                $response = array(
                    'status' => 'false',                    
                );
            }
            
            return response()->json($response);
        }
	}


    public function __incrementIndentor($number){

       $indentors = Indentor::orderBy('id','DESC')->first();;
        
        if(!empty($indentors['id'])) {
            $incrementVal = "00".$indentors['id']++;    
        } else {
            $incrementVal = 001;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getMaterialList(Request $request){
        
       if($request->ajax()) {
			$input = $request->all();                    
        	$materialId = $input['material_id'];

            switch($materialId){

                case "Returnable":
                case "Non Returnable":
                    $deliveryNotes = DeliveryNote::orderBy('id','DESC')->first();
                    if(!empty($deliveryNotes['id'])) {
                        $id = $deliveryNotes['id'];  
                        $incrementVal = "00".++$id;                       
                       // $incrementVal = ($input < 10) ? "00". ++$id : ++$id;
                    } else {
                        $incrementVal = "001";
                    }
                    $response = array(
                        'status' => 'success',
                        'challan_number' =>  $incrementVal                        
                    );
                    return response()->json($response);
                    break;
                case "Delivery Note":
                    $deliveryNotess = DeliveryNote::orderBy('id','DESC')->first();
                    if(!empty($deliveryNotess['id'])) {
                        $id = $deliveryNotess['id'];  
                        $incrementVal = "N-00".++$id;
                       // $incrementVal = ($input < 10) ? "N-00". ++$id : "N-".++$id;                       
                    } else {
                        $incrementVal = "N-001";
                    }                    
                    $response = array(
                        'status' => 'success',
                        'challan_number' =>  $incrementVal                        
                    );
                    return response()->json($response);
                    break;
    
            }
        }
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReturnableReports(Request $request)
    {
        $delivery_notes = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					//->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.yes'))
					->get();
                  
         return view('DeliveryNote.showReturnableReports',compact('delivery_notes')); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNonReturnableReports(Request $request)
    {
        $delivery_notes = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					//->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.no'))
					->get();
       
        return view('DeliveryNote.showNonReturnableReports',compact('delivery_notes')); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeliveryNoteReports(Request $request)
    {
        $delivery_notes = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					//->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.delivery_note') )
					->get();
     
        return view('DeliveryNote.showDeliveryNoteReports',compact('delivery_notes')); 
    }



    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __multipleDeliveryNotes()
    {
        //$currencys = DeliveryNote::Currency;
        $matComeBacks = DeliveryNote::MatComeback;
        $insureds = DeliveryNote::Insured;
        $matBelongsToBkns = DeliveryNote::MatBlongsToBkn;
        $vendors = Vendor::orderBy('vendor_name','ASC')->get();
        $indentors = Indentor::orderBy('indentor_name','ASC')->get();
        $departments = Department::orderBy('department_name','ASC')->get();
        $uoms = Uom::orderBy('uom_name','ASC')->get();
      
		return $deliveryNotes = compact('matComeBacks','insureds','matBelongsToBkns','vendors','indentors','departments','uoms');	
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __getStateName($id)
    {
        $states = DB::table('states as s')
					->select("s.id","s.state_name")
					->where('s.id', '=', $id)
					->first(); 

        $state = (!empty($states) ? $states->state_name : '');

        return $state;
    }
}
