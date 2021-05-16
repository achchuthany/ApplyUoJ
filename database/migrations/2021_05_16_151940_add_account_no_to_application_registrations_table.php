<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountNoToApplicationRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_registrations', function (Blueprint $table) {
            $table->string('account_number',30)->nullable();
            $table->double('deposit_amount',10,2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_registrations', function (Blueprint $table) {
            $table->dropColumn('account_number');
            $table->dropColumn('deposit_amount');
        });
    }
}
