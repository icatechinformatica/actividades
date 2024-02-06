<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_actividades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asunto_id')->unsigned()->nullable();
            $table->string('actividad', 150)->nullable();
            $table->string('userid_created', 250)->nullable();
            $table->string('userid_updated', 250)->nullable();
            $table->foreign('asunto_id')
                    ->references('id')
                    ->on('pet_asuntos')
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
        Schema::dropIfExists('pet_actividades');
    }
}
