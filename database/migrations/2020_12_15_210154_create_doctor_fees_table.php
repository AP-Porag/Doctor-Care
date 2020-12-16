<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('appointment_id');
            $table->foreignId('doctor_id');
            $table->foreignId('service_id');//fees name id like (consultation,operation)
            $table->string('amount');
            $table->foreignId('type_id');//payment type (paid,dew,free,advance)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_fees');
    }
}
