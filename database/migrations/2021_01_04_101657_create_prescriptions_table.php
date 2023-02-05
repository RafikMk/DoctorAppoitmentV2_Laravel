<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('ailment')->default('');
            $table->string('symptoms')->default('');
       
            $table->unsignedBigInteger('booking_id');

           
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->string('date')->default('');;
            $table->text('medicine')->default('');;
            $table->text('procedure')->default('');;
            $table->text('feedback')->default('');;
            $table->string('signature')->default('');;
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
        Schema::dropIfExists('prescriptions');
    }
}
