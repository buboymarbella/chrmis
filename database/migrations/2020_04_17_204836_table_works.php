<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('inclusive_from')->nullable();
			$table->string('inclusive_to')->nullable();
			$table->string('position_title')->nullable();
			$table->string('department')->nullable();
			$table->integer('salary')->nullable();
			$table->string('salary_grade')->nullable();
			$table->integer('step_increment')->nullable();
			$table->string('job_status')->nullable();
			$table->string('gov_service')->nullable();
			$table->string('workexpe_status')->nullable();
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
        Schema::dropIfExists('works');
    }
}
