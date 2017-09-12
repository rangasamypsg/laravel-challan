<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_name',50);
			$table->integer('vendor_id')->unsigned();
			$table->text('address_line_1')->nullable();
			$table->text('address_line_2')->nullable();
			$table->string('city',50)->nullable();
			$table->string('postal_code',6)->nullable();
			$table->string('company_name',50);
			$table->string('mobile_number',10)->nullable();
			$table->string('email_id',50);
			$table->string('state_id',50)->nullable();
			$table->string('state_code',50)->nullable();
			$table->string('gst_number',50);
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
        Schema::drop('vendors');
    }
}
