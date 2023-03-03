<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTariffCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tariff_categories', function (Blueprint $table) {
            $table->dropColumn('factor');
            $table->dropColumn('category');
            $table->float('amount');
            $table->enum('type', ["Ingreso","Arancel Mensual","Matrícula","Otro"]);
            $table->integer('reference_id');
            $table->string('model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tariff_categories', function (Blueprint $table) {
            $table->float('factor');
            $table->string('category');
            $table->dropColumn('amount');
            $table->dropColumn('type');
            $table->dropColumn('reference_id');
            $table->dropColumn('model');
        });
    }
}
