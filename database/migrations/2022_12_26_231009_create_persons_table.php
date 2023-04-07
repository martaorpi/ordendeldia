<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("dni")->nullable();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->date("date_birth")->nullable();
            $table->enum('sex', ['masculino', 'femenino', 'indefinido']);
            $table->text("physical_address")->nullable();
            $table->enum('civil_state', ['soltero/a', 'casado/a', 'viudo/a/divorciado/a']);
            $table->string("phone")->nullable();
            $table->enum('nacionality', ['Argentina','Bolivia', 'Brasil', 'Chile', 'Paraguay','Uruguay','otro'])->default('Argentina');
            $table->string("ocupation")->nullable();
            $table->enum('instruction_grade', ['Primario','Secundario', 'Terciario', 'Universitario', 'Ninguno']);
            //$table->boolean("disability")->default(0);
            //$table->text("extra_information")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('persons');
    }
};
