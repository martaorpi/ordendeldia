<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencies', function (Blueprint $table) {
            $table->id();
            $table->string("short_name");
            $table->text("long_name");
            $table->text("physical_address")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum('group', ['Económicos', 'Violencia de Género', 'Robo', 'Judiciales']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('autorities', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->text("prosecution");
            $table->string("personal_prefix");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("body");
            $table->enum('type', ['Denuncia', 'Contravención', 'Parte Informativo']);
            $table->unsignedBigInteger('autority_id')->nullable();
            $table->text('prosecution')->nullable();
            $table->unsignedBigInteger('dependency_id')->nullable();
            $table->foreign('dependency_id')->references('id')->on('dependencies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime("event_datetime")->nullable();
            $table->dateTime("completed_at")->nullable();
            $table->string("ex_number")->nullable();
            $table->unsignedBigInteger('crime_id')->nullable();
            $table->foreign('crime_id')->references('id')->on('crimes');
            $table->string("states");
            $table->timestamps();
        });

        Schema::create('documents_has_persons', function (Blueprint $table) {
            $table->unsignedBigInteger("document_id");
            $table->unsignedBigInteger("person_id");
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->enum('type', ['Denunciante', 'Victima', 'Denunciante/Victima', 'Denunciado']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
