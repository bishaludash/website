<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableResumeEducationAddDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume_education', function (Blueprint $table) {
            $table->dropColumn('edu_start_date');
            $table->dropColumn('edu_end_date');
            $table->string('edu_start_year')->nullable();
            $table->string('edu_end_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume_education', function (Blueprint $table) {
            $table->dropColumn('edu_start_year');
            $table->dropColumn('edu_end_year');
        });
    }
}
