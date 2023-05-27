<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToConvStagesTable extends Migration
{
    public function up()
    {
        Schema::table('conv_stages', function (Blueprint $table) {
            $table->unsignedBigInteger('maitre_id')->nullable();
            $table->unsignedBigInteger('chef_id')->nullable();
            $table->unsignedBigInteger('etudiant_id')->nullable();

            $table->foreign('maitre_id')->references('id')->on('maitre_de_stages');
            $table->foreign('chef_id')->references('id')->on('chef_departements');
            $table->foreign('etudiant_id')->references('id')->on('etudiants');
        });
    }

    public function down()
    {
        Schema::table('conv_stages', function (Blueprint $table) {
            $table->dropForeign(['maitre_id']);
            $table->dropForeign(['chef_id']);
            $table->dropForeign(['etudiant_id']);

            $table->dropColumn('maitre_id');
            $table->dropColumn('chef_id');
            $table->dropColumn('etudiant_id');
        });
        
    }
    
}
