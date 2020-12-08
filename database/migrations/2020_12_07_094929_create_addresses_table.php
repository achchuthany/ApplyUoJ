<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');

            $table->string('address_type', 255)->default('Permanent');
            $table->string('address_no', 255)->nullable();
            $table->string('address_street', 255)->nullable();
            $table->string('address_city', 255)->nullable();
            $table->string('address_4', 255)->nullable();
            $table->string('address_state', 255)->nullable();
            $table->string('address_country', 255)->nullable();
            $table->string('address_postal_code', 255)->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
