<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('a34')->nullable();
			$table->string('b34')->nullable();
			$table->string('ab34_yes')->nullable();
			$table->string('a35')->nullable();
			$table->string('a35_yes')->nullable();
			$table->string('b35')->nullable();
			$table->string('b35_date')->nullable();
			$table->string('b35_status')->nullable();
			$table->string('a36')->nullable();
			$table->string('a36_yes')->nullable();
			$table->string('a37')->nullable();
			$table->string('a37_yes')->nullable();
			$table->string('a38')->nullable();
			$table->string('a38_yes')->nullable();
			$table->string('b38')->nullable();
			$table->string('b38_yes')->nullable();
			$table->string('a39')->nullable();
			$table->string('a39_yes')->nullable();
			$table->string('a40')->nullable();
			$table->string('a40_yes')->nullable();
			$table->string('b40')->nullable();
			$table->string('b40_yes')->nullable();
			$table->string('c40')->nullable();
			$table->string('c40_yes')->nullable();
			$table->string('answer_status')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
