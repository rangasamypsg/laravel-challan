<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('delivery_notes', function (Blueprint $table) {
            $table->increments('id');
			$table->date('challan_date');
			$table->date('financial_year');
			$table->enum('mat_will_come_back', ['Yes', 'No','Delivery Note']);
            $table->enum('currency', ['IND', 'DOL','EURO']);
			$table->string('po_number',50)->nullable();
			$table->string('carrier_name',50)->nullable();
            $table->string('place',50)->nullable();
			$table->string('vechile_number',50)->nullable();
			$table->string('challan _number',50)->nullable();
			$table->date('return_date');
			$table->integer('vendor_id')->unsigned();
			$table->integer('department_id')->unsigned();
			$table->enum('insured', ['Yes', 'No']);
			$table->integer('indentor_id')->unsigned();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('delivery_notes');
    }
}
