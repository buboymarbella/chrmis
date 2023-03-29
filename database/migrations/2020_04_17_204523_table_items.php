<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('master_id')->nullable();
			//$table->string('employee_number')->nullable();
			$table->string('item_number')->nullable();
			$table->string('position')->nullable();
			$table->string('item_status')->nullable();
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
        Schema::dropIfExists('items');
    }
}
