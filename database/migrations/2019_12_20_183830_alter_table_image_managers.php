<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImageManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_managers', function (Blueprint $table) {
            $table->integer('foreign_id')->nullable()->index();
            $table->string('source')->nullable();
            $table->string('file_name')->nullable();
            $table->string('extension')->nullable();
            $table->string('file_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_managers', function (Blueprint $table) {
            $table->dropColumn('foreign_id');
            $table->dropColumn('source');
            $table->dropColumn('file_name');
            $table->dropColumn('extension');
            $table->dropColumn('file_size');
        });
    }
}
