<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorisationsTable extends Migration
{
    public function up()
    {
        Schema::create('autorisations', function (Blueprint $table) {
            $table->id();
            $table->string('new_user');
            $table->string('list_user');
            $table->string('new_poste');
            $table->string('list_poste');
            $table->string('historiq');
            $table->string('stat');
            $table->string('new_proces');
            $table->string('list_proces');
            $table->string('eva_proces');
            $table->string('new_risk');
            $table->string('list_risk');
            $table->string('val_risk');
            $table->string('act_n_val');
            $table->string('color_para');
            $table->string('list_cause');
            $table->string('suivi_actp');
            $table->string('list_actp');
            $table->string('suivi_actc');
            $table->string('list_actc_eff');
            $table->string('list_actc');
            $table->string('fiche_am');
            $table->string('list_am');
            $table->string('val_am');
            $table->string('am_n_val');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('autorisations');
    }
}
