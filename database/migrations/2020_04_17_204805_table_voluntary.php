<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableVoluntary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntaries', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('name_organization')->nullable();
			$table->string('inclusive_from')->nullable();
			$table->string('inclusive_to')->nullable();
			$table->integer('hour_number')->nullable();
			$table->string('position')->nullable();
			$table->string('voluntary_status')->nullable();
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
        Schema::dropIfExists('voluntaries');
    }
}
