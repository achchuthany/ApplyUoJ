<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('application_year');

            //1.NAME
            $table->string('title', 20)->nullable();            //1.1
            $table->string('last_name', 255)->nullable();       //1.2
            $table->string('name_initials', 255)->nullable();   //1.3
            $table->string('full_name', 255);       //1.4

            //2. Address
            $table->string('province', 100)->nullable();        //2.3
            $table->string('district', 100)->nullable();        //2.4
            $table->unsignedSmallInteger('district_no')->nullable();   //2.4
            $table->string('nic', 20)->unique();              //2.5
            $table->string('mobile', 20)->nullable();           //2.6
            $table->string('mobile_home', 20)->nullable();           //2.6
            $table->string('email', 255)->unique();           //2.7


            //3. Education
            $table->integer('al_index_number')->unique();             //3.2
            $table->unsignedSmallInteger('al_exam_year')->nullable();   //3.1
            $table->unsignedDouble('al_z_score')->nullable();   //3.3
            $table->unsignedSmallInteger('al_english_mark')->nullable();   //3.1

            //4. Details of Citizenship
            $table->string('race', 30)->nullable();         //4.1
            $table->string('gender', 10);       //4.2
            $table->string('civil_status', 20)->nullable(); //4.3
            $table->string('religion', 30)->nullable();     //4.4
            $table->string('medium', 30)->nullable();

            $table->date('date_of_birth')->nullable();                 //4.5
            $table->string('citizenship', 100)->nullable();      //4.6
            $table->string('citizenship_type', 30)->nullable(); //4.7


            //5.Details of Parents
            $table->string('parent_full_name', 255)->nullable();        //5.1
            $table->string('parent_occupation', 255)->nullable();       //5.2
            $table->text('parent_address_work')->nullable();                   //5.3
            $table->string('parent_mobile', 20)->nullable();             //5.4
            $table->string('parent_landline', 20)->nullable();             //5.4
            $table->string('emergency_contact_name', 255)->nullable();   //5.5
            $table->string('emergency_contact_mobile', 20)->nullable();  //5.6

            $table->bigInteger('created_by_user_id')->unsigned();
            $table->foreign('created_by_user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->string('status',20)->nullable();
            $table->json('comments')->nullable();

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
        Schema::dropIfExists('students');
    }
}
