<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Vendor extends Model
{
	
	// use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "vendors";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_name','gst_number'
    ];
    
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    //protected $dates = ['deleted_at'];
	
	//custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
}