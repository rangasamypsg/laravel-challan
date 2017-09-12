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
use App\Indentor;
use App\State;
use Config;
use Auth;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnableCount = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.yes'))
					->count();   

        $nonReturnableCount = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.no'))
					->count();

        $deliveryNoteCount = DB::table('delivery_notes as d')
					->select("d.id","d.challan_date","d.challan_number","d.financial_year","d.mat_will_come_back","v.id as vendor_id","v.vendor_name")
					->leftjoin('vendors as v', 'd.vendor_id', '=', 'v.id')
					->orderBy('d.id', 'desc')	
					->whereNull('d.deleted_at')
                    ->where('d.mat_will_come_back', '=', Config::get('settings.Report.delivery_note'))
					->count();
        
        return view('home',compact('returnableCount','nonReturnableCount','deliveryNoteCount'));
    }
}
