<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetOrganismosActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_organismos_actividades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('actividad_id')->unsigned()->nullable();
            $table->bigInteger('id_organo')->unsigned()->nullable();
            $table->jsonb('options')->nullable();
            $table->text('observacion')->nullable();
            $table->string('userid_created', 250)->nullable();
            $table->string('userid_updated', 250)->nullable();
            $table->foreign('actividad_id')
                    ->references('id')
                    ->on('pet_actividades')
                    ->onDelete('no action')
                    ->onUpdate('cascade');
            $table->foreign('id_organo')
                    ->references('id')
                    ->on('organos')
                    ->onDelete('no action')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_organismos_actividades');
    }
}
