<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('main_id')->nullable()->unique();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->string('employee_number')->nullable();
			$table->string('unit_number')->nullable();
			$table->string('item_number')->nullable();
			$table->string('date_hired')->nullable();
			$table->string('retirement_date')->nullable();
			$table->string('optional_retire')->nullable();
			$table->string('employ_stat')->nullable();
			$table->string('office')->nullable();
			$table->string('position')->nullable();
			$table->string('salary_grade')->nullable();
			$table->string('last_name')->nullable();
			$table->string('first_name')->nullable();
			$table->string('middle_name')->nullable();
			$table->string('extension_name')->nullable();
			$table->string('complete_name')->nullable();
			$table->string('dob')->nullable();
			$table->string('pob')->nullable();
			$table->string('gender')->nullable();
			$table->string('civil_status')->nullable();
			$table->string('citizenship')->nullable();
			$table->string('birth_naturalize')->nullable();
			$table->string('dual_citizen')->nullable();
			$table->string('nationality')->nullable();
			$table->string('religion')->nullable();
			$table->string('telephone_no')->nullable();
			$table->string('cellphone_no')->nullable();
			$table->string('email_address')->nullable();
			$table->string('height')->nullable();
			$table->string('weight')->nullable();
			$table->string('blood_type')->nullable();
			$table->string('date_registered')->nullable();
			$table->string('employee_status')->nullable();
			$table->string('rec_status')->nullable();
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
        Schema::dropIfExists('masters');
    }
}
