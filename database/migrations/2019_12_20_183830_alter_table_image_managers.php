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
            $table->dropIndex('id');
            $table->dropColumn('id');
            $table->dropColumn('source');
        });
    }
}
