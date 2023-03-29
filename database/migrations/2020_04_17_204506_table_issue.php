<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableIssue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('gov_issue')->nullable();
			$table->string('license_number')->nullable();
			$table->string('place_issue')->nullable();
			$table->string('date_issue')->nullable();
			$table->string('gov_status')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
