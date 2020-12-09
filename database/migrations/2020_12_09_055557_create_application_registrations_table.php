<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_registrations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade');

            $table->bigInteger('programme_id')->unsigned();
            $table->foreign('programme_id')->references('id')->on('programmes')->onUpdate('cascade');


            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();

            $table->smallInteger('count_received')->default(0);
            $table->smallInteger('count_called')->default(0);

            $table->smallInteger('next_registration_number')->default(1);

            $table->string('status')->default('Processing');

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
        Schema::dropIfExists('application_registrations');
    }
}
