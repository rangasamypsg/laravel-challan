<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DeliveryNote extends Model
{
   use SoftDeletes;
    /**
     * The possible genders a user can be.
     */
    const Currency = ['IND','EURO'];

    /**
     * The possible genders a user can be.
     */
    const MatComeback = ['Non Returnable','Returnable','Delivery Note'];

    /**
     * The possible genders a user can be.
     */

    const Insured = ['Yes','No'];

    /**
     * The possible genders a user can be.
     */
    const MatBlongsToBkn = ['Yes','No'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "delivery_notes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_type'
    ];
    
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['deleted_at'];
	
	//custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
