<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('programme_id')->unsigned();
            $table->foreign('programme_id')->references('id')->on('programmes')->onUpdate('cascade');

            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');

            $table->bigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade');


            $table->string('reg_no')->nullable();
            $table->string('index_no')->nullable();

            $table->date('registration_date')->nullable();
            $table->date('effective_date')->nullable();

            $table->decimal('gpa')->nullable();

            $table->string('status')->default('Invited');

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
        Schema::dropIfExists('enrolls');
    }
}
