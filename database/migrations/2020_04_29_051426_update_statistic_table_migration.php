<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatisticTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->string('browser')->after('city_name')->default('null');
            $table->string('engine')->after('browser')->default('null');
            $table->string('os')->after('engine')->default('null');
            $table->string('device')->after('os')->default('null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statistics', function ($table){
            $table->dropColumn(['browser', 'engine', 'os','device']);
        });
    }
}
