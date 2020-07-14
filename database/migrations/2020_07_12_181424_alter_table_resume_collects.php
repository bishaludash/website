<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableResumeCollects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume_collects', function (Blueprint $table) {
            $table->string('uuid', 40)->change();
            $table->index('uuid');
            $table->boolean('status')->nullable()->change();
            $table->string('message')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume_collects', function (Blueprint $table) {
            $table->boolean('status')->nullable(false)->change();
            $table->string('message')->nullable(false)->change();
        });
    }
}
