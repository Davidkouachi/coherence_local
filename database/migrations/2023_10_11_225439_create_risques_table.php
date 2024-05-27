<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisquesTable extends Migration
{
    public function up()
    {
        Schema::create('risques', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('page');
            $table->integer('vraisemblence')->nullable();
            $table->integer('gravite')->nullable();
            $table->integer('evaluation')->nullable();
            $table->string('cout')->nullable();
            $table->string('traitement')->nullable();
            $table->string('statut')->nullable();
            $table->integer('vraisemblence_residuel')->nullable();
            $table->integer('gravite_residuel')->nullable();
            $table->integer('evaluation_residuel')->nullable();
            $table->string('cout_residuel')->nullable();
            $table->datetime('date_validation')->nullable();
            $table->unsignedBigInteger('processus_id');
            $table->foreign('processus_id')->references('id')->on('processuses');
            $table->unsignedBigInteger('poste_id');
            $table->foreign('poste_id')->references('id')->on('postes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('risques');
    }
}
