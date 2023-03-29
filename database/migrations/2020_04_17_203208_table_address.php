<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('residential_house')->nullable();
			$table->string('residential_street')->nullable();
			$table->string('residential_subdivision')->nullable();
			$table->string('residential_brgy')->nullable();
			$table->string('residential_city')->nullable();
			$table->string('residential_province')->nullable();
			$table->string('residential_zipcode')->nullable();
			$table->string('permanent_house')->nullable();
			$table->string('permanent_street')->nullable();
			$table->string('permanent_subdivision')->nullable();
			$table->string('permanent_brgy')->nullable();
			$table->string('permanent_city')->nullable();
			$table->string('permanent_province')->nullable();
			$table->string('permanent_zipcode')->nullable();
            $table->timestamps();
			$table->foreign('master_id')
                ->references('main_id')
                ->on('masters')
				->onUpdate('cascade') // this will delete all the children rows when the parent row is deleted
                ->onDelete('cascade'); // this will delete all the children rows when the parent row is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
