<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
    //use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "departments";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_name'
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

