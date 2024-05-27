<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmeliorationsTable extends Migration
{
    public function up()
    {
        Schema::create('ameliorations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->date('date_fiche');
            $table->date('date_limite');
            $table->string('nbre_jour');
            $table->date('date_cloture1')->nullable();
            $table->string('lieu');
            $table->string('detecteur');
            $table->string('non_conformite');
            $table->text('consequence');
            $table->text('cause');
            $table->string('choix_select');
            $table->string('statut');
            $table->date('date_validation')->nullable();
            $table->date('date1')->nullable();
            $table->date('date2')->nullable();
            $table->date('date_eff')->nullable();
            $table->string('efficacite')->nullable();
            $table->text('commentaire_eff')->nullable();
            $table->unsignedBigInteger('cause_id')->nullable();
            $table->foreign('cause_id')->references('id')->on('causes');
            $table->unsignedBigInteger('risque_id')->nullable();
            $table->foreign('risque_id')->references('id')->on('risques');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ameliorations');
    }
}
