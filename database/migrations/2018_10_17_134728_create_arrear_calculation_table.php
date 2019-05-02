<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrearCalculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrear_calculation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')->on('master_tenants');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('master_buildings');
            $table->integer('society_id')->unsigned();
            $table->foreign('society_id')->references('id')->on('master_societies');
            $table->string('month')->nullable();    
            $table->string('year')->nullable();
            $table->string('oir_year')->nullable();
            $table->string('oir_month')->nullable();
            $table->string('old_intrest_amount')->nullable();
            $table->string('difference_amount')->nullable();
            $table->string('ida_year')->nullable();
            $table->string('ida_month')->nullable();
            $table->string('difference_intrest_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('total_amount')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrear_calculation');
    }
}
