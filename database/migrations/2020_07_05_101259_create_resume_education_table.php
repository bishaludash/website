<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id')->index();
            $table->string('school_name');
            $table->string('school_location');
            $table->string('degree')->nullable();
            $table->string('field_of_study')->nullable();
            $table->date('edu_start_date')->nullable();
            $table->date('edu_end_date')->nullable();
            $table->text('achievements')->nullable();
            $table->boolean('is_deleted')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('resume_education');
    }
}
