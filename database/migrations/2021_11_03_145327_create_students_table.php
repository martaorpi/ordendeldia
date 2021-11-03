<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('career_id')->constrained();
            $table->foreignId('nationality_id')->constrained();
            $table->foreignId('province_id')->constrained();
            $table->foreignId('location_id')->constrained()->default(0);
            $table->string('location_description')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->integer('dni')->unique();
            $table->integer('year_income');
            $table->string('address_district')->nullable();
            $table->string('address_street')->nullable();
            $table->integer('address_number')->nullable();
            $table->integer('address_flat')->nullable();
            $table->string('address_departament')->nullable();
            $table->string('address_cp')->nullable();
            $table->string('slug')->unique()->default('');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
