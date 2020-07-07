<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id');
            $table->string('r_user_fname');
            $table->string('r_user_lname');
            $table->string('r_user_avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('state_province')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('skills');
            $table->text('summary');
            $table->boolean('is_deleted');
            $table->timestamps();

            $table->foreign('resume_id')->references('id')->on('resume_collects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_users');
    }
}
