<?php
use Illuminate\Support\Facades\Config;

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Limit
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
	'name' => 'Rangasamy',
	
	'pagination' => [
		'perPage' => '3',        
    ],

    'Project' => [
		'title' => 'Rangasamy',        
    ],

    'Bradken' => [
      'title' => 'RANGASAMY DELIVERY CHALLAN',
      'name' => 'For Bradken India Private Limited',
      'Permanent_address' => '<strong>Bradken India Private Limited</strong>,<br/>No. 191/3 & 191/4, Chettipalayam-Palladam Rd.,<br/>Orathukuppai Village, Chettipalayam,<br/>Coimbatore 641201, TN, India',
      'Registered_Office' => 'REGISTRED OFFICE',
      'pan_number' => 'pan_number', 
      'gst_number' => 'pan_number', 
      'c_number' => 'pan_number', 
      'place' => 'Coimbatore', 
    ],

    'Report' => [
      'yes' => 'Returnable',
      'no'  => 'Non Returnable',
      'delivery_note' => 'Delivery Note'
    ]
	
];
