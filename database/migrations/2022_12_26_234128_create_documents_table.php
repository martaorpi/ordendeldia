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

        Schema::create('authorities', function (Blueprint $table) {
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
            $table->bigInteger('crime_id')->nullable();
            $table->bigInteger('dependence_id')->nullable();
            $table->text("title");
            $table->text("body");
            $table->enum('type', ['Denuncia', 'Contravención'])->default('Denuncia');
            $table->unsignedBigInteger('authority_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('complainant_id')->nullable();
            $table->bigInteger('victim_id')->nullable();
            $table->bigInteger('accused_id')->nullable();
            $table->dateTime("event_datetime")->nullable();
            $table->dateTime("completed_at")->nullable();
            $table->string("ex_number")->nullable();
            $table->timestamps();
        });

        /*Schema::create('document_person', function (Blueprint $table) {
            $table->bigInteger("document_id");
            $table->bigInteger("person_id");
            $table->enum('type', ['Denunciante', 'Victima', 'Denunciante/Victima', 'Denunciado']);
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorities');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('documents_has_persons');
    }
};
