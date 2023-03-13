<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('crimes')){

            Schema::create('crimes', function (Blueprint $table) {
                $table->id();
                $table->string("description");
                $table->integer("tipification_id");
                $table->integer("nation_id");
                $table->timestamps();
            });

            DB::table('crimes')
            ->insert([
                [ "id" => "1", "description" => "Simple (Art. 79)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "2", "description" => "Agravado (Art. 80)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "3", "description" => "En estado de emoción violenta (Art. 81 inc. a)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "4", "description" => "En ocasión de robo (Art. 165)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "5", "description" => "En riña (Art. 95)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "6", "description" => "Homicidio preterintencional (Art. 81 inc. b)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "7", "description" => "Homicidio resultante de abuso sexual (Art. 124)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "8", "description" => "Homicidio en defensa propia o en defensa de terceros (Art. 34 inc. 6 y 7)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "9", "description" => "Robo agravado por homicidio (Art. 165)", "tipification_id" => "1", "nation_id" => "1"],
                [ "id" => "10", "description" => "Leves (Art. 89)", "tipification_id" => "64", "nation_id" => "5"],
                [ "id" => "11", "description" => "Graves (Art. 90)", "tipification_id" => "64", "nation_id" => "5"],
                [ "id" => "12", "description" => "Gravísimas (Art. 91)", "tipification_id" => "64", "nation_id" => "5"],
                [ "id" => "13", "description" => "Agravadas (Art. 92 y 93)", "tipification_id" => "64", "nation_id" => "5"],
                [ "id" => "14", "description" => "En riña (Art. 95 y 96)", "tipification_id" => "64", "nation_id" => "5"],
                [ "id" => "15", "description" => "Provocadas de manera involuntaria (sin dolo)", "tipification_id" => "5", "nation_id" => "6"],
                [ "id" => "16", "description" => "En ocasión de siniestros viales (Art. 94)", "tipification_id" => "5", "nation_id" => "6"],
                [ "id" => "51", "description" => "Robo simple (Art. 164)", "tipification_id" => "16", "nation_id" => "15"],
                [ "id" => "52", "description" => "Robo en despoblado (Art. 166 inc. 2 y art. 167 inc. 1)", "tipification_id" => "16", "nation_id" => "15"],
                [ "id" => "53", "description" => "Robo en banda (Art. 166 inc. 2 y art. 167 inc. 1)", "tipification_id" => "16", "nation_id" => "15"],
                [ "id" => "54", "description" => "Robo con perforación o fractura de pared, cerco, techo o piso, puerta o ventana de un lugar habitado o sus dependencias inmediatas (Art. 167 inc. 3)", "tipification_id" => "16", "nation_id" => "15"],
                [ "id" => "58", "description" => "Hurto simple (Art. 162)", "tipification_id" => "20", "nation_id" => "19"],
                [ "id" => "59", "description" => "Hurto calificado", "tipification_id" => "20", "nation_id" => "19"],
                [ "id" => "60", "description" => "Despoblado y en banda", "tipification_id" => "18", "nation_id" => "15"],
                [ "id" => "61", "description" => "Por el uso de armas", "tipification_id" => "18", "nation_id" => "15"],
                [ "id" => "62", "description" => "Por la funcion", "tipification_id" => "18", "nation_id" => "15"],
                [ "id" => "63", "description" => "Por el uso de armas (arrebato)", "tipification_id" => "18", "nation_id" => "15"],
                [ "id" => "64", "description" => "Calificado", "tipification_id" => "18", "nation_id" => "15"],
                [ "id" => "65", "description" => "LEY 26904 GROOMING", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "66", "description" => "FRAUDE INFORMATICO", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "67", "description" => "VIOLACION DE SECRETOS Y DE LA PRIVACIDAD", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "68", "description" => "DISTRIBUCION DE MATERIAL PORNOGRAFICO", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "69", "description" => "ACCESO A SISTEMA INFORMATICO", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "70", "description" => "ACCESO A BANCO DE DATOS", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "71", "description" => "PUBLICIDAD DE UNA COMUNICACION ELECRONICA", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "72", "description" => "DAÑO INFORMATICO", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "73", "description" => "Simple", "tipification_id" => "78", "nation_id" => "0"],
                [ "id" => "74", "description" => "Agravado", "tipification_id" => "78", "nation_id" => "0"],
                [ "id" => "75", "description" => "SECUESTRO VIRTUAL", "tipification_id" => "149", "nation_id" => "21"],
                [ "id" => "76", "description" => "Conflicto de tierras", "tipification_id" => "100", "nation_id" => "0"]
            ]);
        }

        if (!Schema::hasTable('dependence')){

            Schema::create('dependences', function (Blueprint $table) {
                $table->id();
                $table->string("description");
                $table->integer("department_id");
                $table->integer("dsc_id");
                $table->integer("municipality_id");
                $table->integer("nation_id");
                $table->timestamps();
            });

            DB::table('dependences')
            ->insert([
                [ "id" => "1","description" => "Comisaria  1°", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"1" ],
                [ "id" => "2","description" => "Comisaria  2°", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"110", "nation_id" =>"2" ],
                [ "id" => "3","description" => "Comisaria  3°", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"3" ],
                [ "id" => "4","description" => "Comisaria  4°", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"4" ],
                [ "id" => "5","description" => "Comisaria  5°", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"110", "nation_id" =>"5" ],
                [ "id" => "6","description" => "Comisaria  6°", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"6" ],
                [ "id" => "7","description" => "Comisaria  7°", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"7" ],
                [ "id" => "8","description" => "Comisaria  8°", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"8" ],
                [ "id" => "9","description" => "Comisaria  9°", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"9" ],
                [ "id" => "10","description" => "Comisaria  10°", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"10" ],
                [ "id" => "11","description" => "Comisaria  11°", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"110", "nation_id" =>"11" ],
                [ "id" => "12","description" => "Comisaria  12°", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"12" ],
                [ "id" => "13","description" => "Comisaria  13°", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"13" ],
                [ "id" => "14","description" => "Comisaria  14°", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"42", "nation_id" =>"14" ],
                [ "id" => "15","description" => "Comisaria  15°", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"15" ],
                [ "id" => "16","description" => "Comisaria  16°", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"35", "nation_id" =>"16" ],
                [ "id" => "17","description" => "Comisaria  17°", "department_id" => "1", "dsc_id" => "14", "municipality_id" =>"7", "nation_id" =>"17" ],
                [ "id" => "18","description" => "Comisaria  18°", "department_id" => "2", "dsc_id" => "11", "municipality_id" =>"14", "nation_id" =>"18" ],
                [ "id" => "19","description" => "Comisaria  19°", "department_id" => "4", "dsc_id" => "13", "municipality_id" =>"6035", "nation_id" =>"19" ],
                [ "id" => "20","description" => "Comisaria  20°", "department_id" => "3", "dsc_id" => "9", "municipality_id" =>"6021", "nation_id" =>"20" ],
                [ "id" => "21","description" => "Comisaria  21°", "department_id" => "6", "dsc_id" => "13", "municipality_id" =>"6280", "nation_id" =>"21" ],
                [ "id" => "22","description" => "Comisaria  22°", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"63", "nation_id" =>"22" ],
                [ "id" => "23","description" => "Comisaria  23°", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"77", "nation_id" =>"23" ],
                [ "id" => "24","description" => "Comisaria  24°", "department_id" => "10", "dsc_id" => "8", "municipality_id" =>"6133", "nation_id" =>"24" ],
                [ "id" => "25","description" => "Comisaria  25°", "department_id" => "12", "dsc_id" => "7", "municipality_id" =>"98", "nation_id" =>"25" ],
                [ "id" => "26","description" => "Comisaria  26°", "department_id" => "13", "dsc_id" => "10", "municipality_id" =>"105", "nation_id" =>"26" ],
                [ "id" => "27","description" => "Comisaria  27°", "department_id" => "15", "dsc_id" => "9", "municipality_id" =>"119", "nation_id" =>"27" ],
                [ "id" => "28","description" => "Comisaria  28°", "department_id" => "14", "dsc_id" => "12", "municipality_id" =>"112", "nation_id" =>"28" ],
                [ "id" => "29","description" => "Comisaria  29°", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"126", "nation_id" =>"29" ],
                [ "id" => "30","description" => "Comisaria  30°", "department_id" => "16", "dsc_id" => "14", "municipality_id" =>"6189", "nation_id" =>"30" ],
                [ "id" => "31","description" => "Comisaria  31°", "department_id" => "18", "dsc_id" => "15", "municipality_id" =>"140", "nation_id" =>"31" ],
                [ "id" => "32","description" => "Comisaria  32°", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"147", "nation_id" =>"32" ],
                [ "id" => "33","description" => "Comisaria  33°", "department_id" => "20", "dsc_id" => "15", "municipality_id" =>"154", "nation_id" =>"33" ],
                [ "id" => "34","description" => "Comisaria  34°", "department_id" => "22", "dsc_id" => "14", "municipality_id" =>"168", "nation_id" =>"34" ],
                [ "id" => "35","description" => "Comisaria  35°", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"182", "nation_id" =>"35" ],
                [ "id" => "36","description" => "Comisaria  36°", "department_id" => "25", "dsc_id" => "9", "municipality_id" =>"6273", "nation_id" =>"36" ],
                [ "id" => "37","description" => "Comisaria  37°", "department_id" => "27", "dsc_id" => "9", "municipality_id" =>"6294", "nation_id" =>"37" ],
                [ "id" => "38","description" => "Comisaria  38°", "department_id" => "26", "dsc_id" => "8", "municipality_id" =>"6287", "nation_id" =>"38" ],
                [ "id" => "39","description" => "Comisaria  39°", "department_id" => "24", "dsc_id" => "15", "municipality_id" =>"196", "nation_id" =>"39" ],
                [ "id" => "40","description" => "Comisaria  40°", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"40" ],
                [ "id" => "41","description" => "Comisaria  41°", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"84", "nation_id" =>"41" ],
                [ "id" => "42","description" => "Comisaria  42°", "department_id" => "4", "dsc_id" => "13", "municipality_id" =>"28", "nation_id" =>"42" ],
                [ "id" => "43","description" => "Comisaria  43°", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"70", "nation_id" =>"43" ],
                [ "id" => "44","description" => "Comisaria  44°", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"133", "nation_id" =>"44" ],
                [ "id" => "45","description" => "Comisaria  45°", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"110", "nation_id" =>"45" ],
                [ "id" => "46","description" => "Comisaria  46°", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"175", "nation_id" =>"46" ],
                [ "id" => "47","description" => "Comisaria  47°", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"47" ],
                [ "id" => "48","description" => "Comisaria  48° Los Juries", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"91", "nation_id" =>"48" ],
                [ "id" => "49","description" => "Comisaria  49°", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"110", "nation_id" =>"49" ],
                [ "id" => "50","description" => "Comisaria Comunitaria de la  Mujer y Familia Nº 1", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"100" ],
                [ "id" => "51","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 2", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"102" ],
                [ "id" => "52","description" => "Comisaria Comunitaria de la  Mujer y Familia Nº 3", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"77", "nation_id" =>"101" ],
                [ "id" => "53","description" => "Comisaria Comunitaria de la  Mujer y Familia Nº 4", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"84", "nation_id" =>"104" ],
                [ "id" => "54","description" => "Drogas", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"61" ],
                [ "id" => "55","description" => "Delitos Economicos", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"62" ],
                [ "id" => "56","description" => "Delitos Comunes", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"63" ],
                [ "id" => "57","description" => "Automotores", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"67" ],
                [ "id" => "58","description" => "SubCria Estacion Simbolar", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"6063", "nation_id" =>"84" ],
                [ "id" => "59","description" => "Comisaria Comunitaria 57º Villa Balnearia", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"85" ],
                [ "id" => "60","description" => "Comisaria 60º", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"77", "nation_id" =>"200" ],
                [ "id" => "61","description" => "SubCria Villa La Punta", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"6119", "nation_id" =>"201" ],
                [ "id" => "62","description" => "SubCria Lavalle", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"6147", "nation_id" =>"204" ],
                [ "id" => "63","description" => "SubCria Sta Catalina", "department_id" => "12", "dsc_id" => "7", "municipality_id" =>"98", "nation_id" =>"203" ],
                [ "id" => "65","description" => "SubCria Villa Robles", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"189", "nation_id" =>"91" ],
                [ "id" => "66","description" => "SubCria Vilmer", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"6252", "nation_id" =>"92" ],
                [ "id" => "67","description" => "SubCria Simbolar", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"6245", "nation_id" =>"93" ],
                [ "id" => "68","description" => "SubCria Bandera Bajada", "department_id" => "10", "dsc_id" => "5", "municipality_id" =>"6126", "nation_id" =>"207" ],
                [ "id" => "69","description" => "SubCria Nueva Francia", "department_id" => "27", "dsc_id" => "9", "municipality_id" =>"6301", "nation_id" =>"95" ],
                [ "id" => "70","description" => "SubCria Laprida", "department_id" => "15", "dsc_id" => "9", "municipality_id" =>"6105", "nation_id" =>"96" ],
                [ "id" => "71","description" => "SubCria El Mojon", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"6210", "nation_id" =>"205" ],
                [ "id" => "72","description" => "Comisaria Comunitaria 58º El Charco", "department_id" => "13", "dsc_id" => "6", "municipality_id" =>"6161", "nation_id" =>"208" ],
                [ "id" => "73","description" => "Cria 53 El Bobadal", "department_id" => "13", "dsc_id" => "10", "municipality_id" =>"6154", "nation_id" =>"209" ],
                [ "id" => "74","description" => "SubCria Malbran", "department_id" => "1", "dsc_id" => "14", "municipality_id" =>"6007", "nation_id" =>"211" ],
                [ "id" => "75","description" => "SubCria Sol de Julio", "department_id" => "18", "dsc_id" => "15", "municipality_id" =>"6203", "nation_id" =>"210" ],
                [ "id" => "76","description" => "SubCria Sachayoj", "department_id" => "2", "dsc_id" => "11", "municipality_id" =>"6014", "nation_id" =>"127" ],
                [ "id" => "78","description" => "Destacamento Tapso", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"6112", "nation_id" =>"141" ],
                [ "id" => "79","description" => "SubCria Las Delicias", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"6532", "nation_id" =>"149" ],
                [ "id" => "80","description" => "SubCria Matará", "department_id" => "14", "dsc_id" => "12", "municipality_id" =>"6175", "nation_id" =>"156" ],
                [ "id" => "81","description" => "Comisaria 50°", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"166" ],
                [ "id" => "82","description" => "Comisaria 51°", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"110", "nation_id" =>"167" ],
                [ "id" => "83","description" => "Comisaria 52°", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"189", "nation_id" =>"168" ],
                [ "id" => "84","description" => "SubCria El Arenal", "department_id" => "13", "dsc_id" => "10", "municipality_id" =>"6483", "nation_id" =>"169" ],
                [ "id" => "85","description" => "SubCria Rio Hondo", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"6224", "nation_id" =>"170" ],
                [ "id" => "86","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 7", "department_id" => "15", "dsc_id" => "9", "municipality_id" =>"119", "nation_id" =>"171" ],
                [ "id" => "87","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 8", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"63", "nation_id" =>"172" ],
                [ "id" => "88","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 6", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"173" ],
                [ "id" => "89","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 9", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"126", "nation_id" =>"174" ],
                [ "id" => "90","description" => "SubCria La Dársena", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"175" ],
                [ "id" => "92","description" => "DS Nº16 - Los Flores", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"178" ],
                [ "id" => "93","description" => "Comisaria 54º", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"179" ],
                [ "id" => "94","description" => "Comisaria 55º", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"42", "nation_id" =>"180" ],
                [ "id" => "95","description" => "Base de Patrulla", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "96","description" => "USAR", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "97","description" => "Comisaria Comunitaria de la  Mujer y Familia Nº 5", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"110", "nation_id" =>"212" ],
                [ "id" => "98","description" => "Delitos complejos Banda", "department_id" => "5", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "99","description" => "SubCria Los Quirogas", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"42", "nation_id" =>"196" ],
                [ "id" => "100","description" => "SubCria Medellin", "department_id" => "3", "dsc_id" => "9", "municipality_id" =>"6028", "nation_id" =>"197" ],
                [ "id" => "101","description" => "Comisaria 56º", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"42", "nation_id" =>"213" ],
                [ "id" => "102","description" => "SubCria Costanera Sur", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"215" ],
                [ "id" => "103","description" => "SubCria Zanjon", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"214" ],
                [ "id" => "105","description" => "Departamento Estadisticas", "department_id" => "7", "dsc_id" => "0", "municipality_id" =>"0", "nation_id" =>"0", ],
                [ "id" => "107","description" => "Dirección Desarrollo Tecnológico", "department_id" => "7", "dsc_id" => "0", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "109","description" => "Subcria. La Costa", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"216" ],
                [ "id" => "111","description" => "Trata de personas", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "112","description" => "ARRESTO DOMICILIARIO", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "113","description" => "ALCAIDIA TRIBUNALES CAPITAL ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "114","description" => "ALCAIDIA TRIBUNALES BANDA ", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "115","description" => "CAPTURAS Y SECUESTROS", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "116","description" => "CENTRO UNICO DE DETENIDOS", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "117","description" => "CENTRO UNICO DE DETENIDAS B? EL RINCON ", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "119","description" => "DELITOS COMUNES BANDA ", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "120","description" => "DELITOS COMPLEJOS CAPITAL ", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "121","description" => "CUERPO GUARDIA DE INFANTERIA ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "122","description" => "LICEO POLICIAL", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "124","description" => "ESCUELA DE SUBOFICIALES ", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "125","description" => "ESCUELA DE OFICIALES ", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "126","description" => "JUZGADO FEDERAL ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "127","description" => "POLICIA FEDERAL DELEGACION SANTIAGO DEL ESTERO", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "128","description" => "CIC MUNICIPAL PAMPA ", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "129","description" => "CIC TERMAS ", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "130","description" => "CLUB SAN CARLOS ", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "131","description" => "CLINICA EL JARDIN ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "132","description" => "HOSPITAL REGIONAL ", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "133","description" => "HOSPITAL INDEPENDENCIA ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "134","description" => "HOSPITAL DIEGO ALCORTA ", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "135","description" => "HOSPITAL BANDA ", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "136","description" => "SEGURIDAD VIAL ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "138","description" => "DESTACAMENTO Nro 2 MAILIN ", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "139","description" => "DESTACAMENTO RAPELLI", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "140","description" => "D6 INVESTIGACIONES ", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "141","description" => "ESCUELA LIBERTAD- FRIAS ", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "142","description" => "DS Nro 3 ZONA SUR ", "department_id" => "7", "dsc_id" => "3", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "143","description" => "DS Nro 4 ZONA OESTE ", "department_id" => "5", "dsc_id" => "4", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "144","description" => "DS Nro 5 ZONA ESTE ", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "145","description" => "DS Nro 6 RIO HONDO ", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "146","description" => "DS Nro 7 CHOYA-GUASAYAN ", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "147","description" => "DS Nro 9 LORETO", "department_id" => "15", "dsc_id" => "9", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "148","description" => "DS Nro 12 MORENO - JUAN FELIPE IBARRA ", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "149","description" => "DS Nro 13 TABOADA - AVELLANEDA ", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "150","description" => "DS Nro 14 PINTO", "department_id" => "1", "dsc_id" => "14", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "151","description" => "DS Nro 15 OJO DE AGUA", "department_id" => "18", "dsc_id" => "15", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "153","description" => "CENTRO DE GUARDIA Y CUSTODIA DE MENOR", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "154","description" => "PUESTO CAMIONERO LORETO", "department_id" => "15", "dsc_id" => "9", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "155","description" => "PENAL VARONES", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "156","description" => "PENAL DE MUEJRES", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "157","description" => "Secretaria de Seguridad", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "159","description" => "GESTION DE LA INFORMACION CRIMINAL", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"0", "nation_id" =>"0" ],
                [ "id" => "160","description" => "Direccion General de Asuntos Judiciales", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"0", "nation_id" =>"0", ],
                [ "id" => "161","description" => "Sub Cria Villa Salavina", "department_id" => "24", "dsc_id" => "15", "municipality_id" =>"222", "nation_id" =>"222", ],
                [ "id" => "163","description" => "Sub Cria Vinara", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"220", ],
                [ "id" => "164","description" => "Division Busqueda y Captura de Profugos", "department_id" => "7", "dsc_id" => "0", "municipality_id" =>"0", "nation_id" =>"0", ],
                [ "id" => "165","description" => "SubCria Sol de Mayo", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"223", ],
                [ "id" => "166","description" => "Comisaria 59º", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"221", ],
                [ "id" => "167","description" => "Delitos Economicos Banda", "department_id" => "5", "dsc_id" => "99", "municipality_id" =>"42", "nation_id" =>"224", ],
                [ "id" => "168","description" => "Sub Cria Los Nuñez", "department_id" => "21", "dsc_id" => "1", "municipality_id" =>"3217", "nation_id" =>"219", ],
                [ "id" => "169","description" => "DSC Nro 1 ZONA NORTE", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "170","description" => "DSC Nro 2 ZONA CENTRO", "department_id" => "7", "dsc_id" => "2", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "171","description" => "DSC Nº 8   ROBLES -SARMIENTO- FIGUEROA", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"182", "nation_id" =>"182", ],
                [ "id" => "172","description" => "DSC Nro 10  PELLEGRINI- GIMENEZ", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"147", "nation_id" =>"147", ],
                [ "id" => "173","description" => "DSC Nro 11 - COPO-  ALBERDI", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"63", "nation_id" =>"63", ],
                [ "id" => "174","description" => "DSC Nro 17 ZONA OESTE- CAPITAL", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "175","description" => "DIVISION BOMBEROS", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "176","description" => "DIVISION CANES", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "177","description" => "Destacamento Colonia Tinco", "department_id" => "21", "dsc_id" => "6", "municipality_id" =>"161", "nation_id" =>"161", ],
                [ "id" => "178","description" => "DIVISION MONTADA", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "179","description" => "HOSPITAL MAMA ANTULA", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "180","description" => "CLINICA ARCADIA", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "181","description" => "DIVISION GER", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"110", ],
                [ "id" => "182","description" => "Comisaria Comunitaria de la Mujer y Familia N°12", "department_id" => "5", "dsc_id" => "5", "municipality_id" =>"86", "nation_id" =>"225", ],
                [ "id" => "183","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 10", "department_id" => "18", "dsc_id" => "15", "municipality_id" =>"140", "nation_id" =>"226", ],
                [ "id" => "184","description" => "Comisaria Comunitaria de la Mujer y Familia Nº 17", "department_id" => "7", "dsc_id" => "17", "municipality_id" =>"110", "nation_id" =>"227", ],
                [ "id" => "185","description" => "Comisaria Comunitaria Nº 11 de la Mujer y Familia", "department_id" => "7", "dsc_id" => "1", "municipality_id" =>"110", "nation_id" =>"228", ],
                [ "id" => "186","description" => "Comisaria Comunitaria Nº 13 de la Mujer y Familia", "department_id" => "23", "dsc_id" => "8", "municipality_id" =>"182", "nation_id" =>"229", ],
                [ "id" => "187","description" => "Comisaria Comunitaria Nº 14 de la Mujer y Familia", "department_id" => "19", "dsc_id" => "10", "municipality_id" =>"147", "nation_id" =>"230", ],
                [ "id" => "188","description" => "Comisaria Comunitaria Nº 15 de la Mujer y Familia", "department_id" => "16", "dsc_id" => "14", "municipality_id" =>"7", "nation_id" =>"231", ],
                [ "id" => "189","description" => "Comisaria Comunitaria Nº 16 de la Mujer y Familia", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"232", ],
                [ "id" => "190","description" => "Sub Cria San Jose del Boqueron", "department_id" => "8", "dsc_id" => "11", "municipality_id" =>"63", "nation_id" =>"217", ],
                [ "id" => "191","description" => "SubCria Maco", "department_id" => "7", "dsc_id" => "16", "municipality_id" =>"110", "nation_id" =>"218", ],
                [ "id" => "192","description" => "Sub Cria Choya", "department_id" => "9", "dsc_id" => "7", "municipality_id" =>"77", "nation_id" =>"176", ],
                [ "id" => "193","description" => "ROBO Y HURTO -CAPITAL", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"50", ],
                [ "id" => "194","description" => "Sub Cria Vilelas", "department_id" => "14", "dsc_id" => "12", "municipality_id" =>"6182", "nation_id" =>"233", ],
                [ "id" => "195","description" => "Sub Cria Weisburd", "department_id" => "17", "dsc_id" => "12", "municipality_id" =>"6196", "nation_id" =>"234", ],
                [ "id" => "196","description" => "Ciber Seguridad", "department_id" => "7", "dsc_id" => "99", "municipality_id" =>"110", "nation_id" =>"49", ],
                [ "id" => "197","description" => "Sub Cria Tomas Young", "department_id" => "11", "dsc_id" => "13", "municipality_id" =>"60", "nation_id" =>"235", ]
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('dependence_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crimes');
        Schema::dropIfExists('dependences');

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('crime_id');
            $table->dropColumn('dependence_id');
        });
    }
}
