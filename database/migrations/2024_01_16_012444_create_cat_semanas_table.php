<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_semanas', function (Blueprint $table) {
            $table->id();
            $table->integer('semana')->nullable();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->year('ejercicio')->nullable();
            $table->string('userid_created', 250)->nullable();
            $table->string('userid_updated', 250)->nullable();
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
        Schema::dropIfExists('cat_semanas');
    }
}
