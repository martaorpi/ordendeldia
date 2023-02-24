<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthsToCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->integer('month_1')->nullable();
            $table->integer('month_2')->nullable();
            $table->integer('month_3')->nullable();
            $table->integer('month_4')->nullable();
            $table->integer('month_5')->nullable();
            $table->integer('month_6')->nullable();
            $table->integer('month_7')->nullable();
            $table->integer('month_8')->nullable();
            $table->integer('month_9')->nullable();
            $table->integer('month_10')->nullable();
            $table->integer('month_11')->nullable();
            $table->integer('month_12')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn('month_1');
            $table->dropColumn('month_2');
            $table->dropColumn('month_3');
            $table->dropColumn('month_4');
            $table->dropColumn('month_5');
            $table->dropColumn('month_6');
            $table->dropColumn('month_7');
            $table->dropColumn('month_8');
            $table->dropColumn('month_9');
            $table->dropColumn('month_10');
            $table->dropColumn('month_11');
            $table->dropColumn('month_12');
        });
    }
}
