<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status');
            $table->unsignedInteger('role_id');
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('specialite')->nullable();
            $table->string('image')->nullable();
            $table->string('education')->nullable();
            $table->text('description')->nullable();
            $table->float('latitude')->default(0); ;
            $table->float('longitude')->default(0); ;
            $table->rememberToken();
            $table->timestamps();
            $table->integer('numeroOfreview')->default(0); ;
            $table->integer('totalreview')->default(0); ;


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
